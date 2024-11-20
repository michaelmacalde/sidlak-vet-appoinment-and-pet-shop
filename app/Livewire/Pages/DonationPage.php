<?php

namespace App\Livewire\Pages;

use App\Mail\DonationMail;
use Livewire\Component;
use App\Models\Donation\Donation;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Luigel\Paymongo\Facades\Paymongo;

#[Layout('layouts.app')]
#[Title('Make a Donation')]
class DonationPage extends Component
{
    // Donation related properties
    public $user_id;
    public $donor_email = '';
    public $donor_name = '';
    public $donor_phone_number = '';
    public $donor_address = '';
    public $donor_amount = 100;
    public $donor_payment_method = '';
    public $donor_message = '';
    public $donation_number;
    public $donor_payment_intent_id;
    public $created_at;

    // New card-related properties
    public $card_name = '';
    public $card_number = '';
    public $expiration_month = '';
    public $expiration_year = '';
    public $cvv = '';

    public $paymentIntent = null;
    public $paymentIntent_id;
    public $paymentMethod;
    public $createPaymentIntent;


    // initialize variables
    public function mount()
    {
        $this->donation_number = 'DON-' . strtoupper(Str::random(10));
    }

    // validate data kag update sang payment method selected
    public function updated($property)
    {
        if ($property === 'donor_payment_method' && $this->donor_payment_method !== 'card') {
            // Reset card fields when payment method is changed to non-card
            $this->reset(['card_name', 'card_number', 'expiration_month', 'expiration_year', 'cvv']);
        }
        $this->validateOnly($property);
    }

    // validate data
    protected function rules()
    {
        $rules = [
            'user_id' => 'nullable|exists:users,id',
            'donor_email' => 'required|email',
            'donor_name' => 'required|min:3|max:100',
            'donor_phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
            'donor_address' => 'nullable|string|max:255',
            'donor_amount' => 'required|numeric|min:100|max:999999.99',
            'donor_payment_method' => 'required|in:gcash,card,paymaya,grab_pay',
            'donor_message' => 'nullable|string|max:500',
        ];

        // Add card validation rules only when card payment method is selected
        if ($this->donor_payment_method === 'card') {
            $rules['card_name'] = 'required|string|min:3|max:100';
            $rules['card_number'] = 'required|numeric|digits:16';
            $rules['expiration_month'] = 'required|numeric|min:1|max:12';
            $rules['expiration_year'] = 'required|numeric|min:' . date('Y') . '|max:' . (date('Y') + 15);
            $rules['cvv'] = 'required|numeric|digits:3';
        }

        return $rules;
    }

    // sanitize data input
    protected function sanitizeInput($input)
    {
        if (is_string($input)) {
            $sanitized = strip_tags($input);
            $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
            return trim($sanitized);
        }
        return $input;
    }

    public function save()
    {

        $validated = $this->validate();

        // Sanitize all string inputs
        $sanitizedData = array_map(
            fn($value) => $this->sanitizeInput($value),
            $validated
        );
        // create sang payment intent with paymongo
        $this->paymentCreateIntent($sanitizedData['donor_amount']);

        // kwa sng payment intent id kag store sa payment intent id variable
        $this->paymentIntent = Paymongo::paymentIntent()->find($this->paymentIntent_id)->getAttributes();

        try {

            // create sang payment method with paymongo
            $this->paymentCreateMethod($sanitizedData);

            $attachedPaymentIntent = $this->createPaymentIntent->attach($this->paymentMethod->id, 'https://sidlak-animal-welfare.test/donate');

            // create sang donation
           $donate = Donation::create([
                'donation_number' => $this->donation_number,
                'donor_payment_intent_id' => $this->paymentIntent_id,
                'donor_name' => $sanitizedData['donor_name'],
                'donor_email' => $sanitizedData['donor_email'],
                'donor_phone_number' => $sanitizedData['donor_phone_number'],
                'donor_address' => $sanitizedData['donor_address'],
                'donor_amount' => $sanitizedData['donor_amount'],
                'donor_payment_method' => $sanitizedData['donor_payment_method'],
                'donor_status' => htmlspecialchars($attachedPaymentIntent->status),
                'donor_message' => $sanitizedData['donor_message'],
            ]);

            $this->created_at =  $donate->created_at->format('Y-m-d');

            // update sang donation
            if ($attachedPaymentIntent->status == 'succeeded') {

                $donate->where('donor_payment_intent_id', $this->paymentIntent_id)->update(['donor_status' => 'paid']);

                session()->flash('message', 'Donation created successfully!');

                $this->donation_number = 'DON-' . strtoupper(Str::random(10));

                Mail::to($this->donor_email)->send(new DonationMail(
                    $this->donor_name,
                    $this->donor_email,
                    $this->donor_phone_number,
                    $this->donor_address,
                    $this->donor_amount,
                    $this->donor_payment_method,
                    $this->donor_message,
                    $this->donation_number,
                    $this->created_at
                ));

                $this->reset();

                return $this->redirect(route('page.donate'));
            }

            // update sang donation
            if ($attachedPaymentIntent->status === 'awaiting_next_action') {

                $redirectUrl = $attachedPaymentIntent->next_action['redirect']['url'];

                session()->flash('message', 'Donation created successfully!');

                Mail::to($this->donor_email)->send(new DonationMail(
                    $this->donor_name,
                    $this->donor_email,
                    $this->donor_phone_number,
                    $this->donor_address,
                    $this->donor_amount,
                    $this->donor_payment_method,
                    $this->donor_message,
                    $this->donation_number,
                    $this->created_at
                ));

                $this->reset();
                // return redirect()->away($redirectUrl); //ari sa laragon

                return redirect()->away($redirectUrl);
                // herd setup ni ang redirect url
                // redirect to paymongo payment page
                // return $this->redirect(route('donation.redirect', [
                //     'url' => $redirectUrl
                // ]));
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating donation: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.donation-page');
    }

    // create payment intent sa paymongo
    public function paymentCreateIntent($amount){
        $this->createPaymentIntent = Paymongo::paymentIntent()->create([
            'amount' => $amount,
            'payment_method_allowed' => [
                'card','paymaya','grab_pay', 'gcash',
            ],
            'payment_method_options' => [
                'card' => [
                    'request_three_d_secure' => 'automatic',
                ],
            ],
            'description' => 'Sidlak Animal Welfare Donation',
            'statement_descriptor' => 'SIDLAK ANIMAL WELFARE',
            'currency' => 'PHP',
        ]);
        // kwa sng payment intent id kag store sa payment intent id variable
        $this->paymentIntent_id = $this->createPaymentIntent->id;
    }


    // create sang payment method with paymongo
    public function paymentCreateMethod($sanitizedData){
        if ($sanitizedData['donor_payment_method'] === 'card') {

            $this->paymentMethod = Paymongo::paymentMethod()->create([
                'type' => $sanitizedData['donor_payment_method'],
                'details' => [
                    'card_number' => $sanitizedData['card_number'],
                    'exp_month' => (int)$sanitizedData['expiration_month'],
                    'exp_year' => (int)$sanitizedData['expiration_year'],
                    'cvc' => $sanitizedData['cvv'],
                ],
                'billing' => [
                    'address' => [
                        'line1' => $sanitizedData['donor_address'],
                    ],
                    'name' =>   $sanitizedData['card_name'],
                    'email' =>  $sanitizedData['donor_email'],
                    'phone' =>  $sanitizedData['donor_phone_number'],
                ],
            ]);

        }else{

            $this->paymentMethod = Paymongo::paymentMethod()->create([
                'type' => $sanitizedData['donor_payment_method'],
                'billing' => [
                    'address' => [
                        'line1' => $sanitizedData['donor_address'],
                    ],
                    'name' => $sanitizedData['donor_name'],
                    'email' => $sanitizedData['donor_email'],
                    'phone' => $sanitizedData['donor_phone_number'],
                ],
            ]);

        }
    }

}
