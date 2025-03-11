<?php

namespace App\Http\Middleware;

use App\Models\Donation\Donation;
use Closure;
use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $getAllPayments = Paymongo::payment()->all();

        $paymentIntent = Paymongo::paymentIntent()->all();

        dd($paymentIntent);
            // foreach ($getAllPayments as $payment) {
            //     dd($payment->payment_intent_id);
            // }

        // try{

        //     $getAllPayments = Paymongo::payment()->all();

        //     // foreach ($getAllPayments as $payment) {
        //     //     dd($payment->payment_intent_id);
        //     // }

        //     // dd($getAllPayments->payment_intent_id);

        // }catch (\Exception $e) {
        //     return redirect()->route('page.donate');
        // }
        // try {
        //     // $user = $request->user();
        //     // if ($user->payment_status != 'paid') {
        //     //     return redirect()->route('payment');
        //     // }

        //     $donations = Donation::select(['donor_payment_intent_id', 'donor_status'])
        //     ->chunk(100, function ($donations) {
        //         foreach ($donations as $donation) {
        //             if ($donation->donor_status != 'paid') {
        //                 dd($donation->donor_payment_intent_id);

        //                 $payment = Paymongo::payment()->find($donation->donor_payment_intent_id);
        //             }
        //         }
        //     });;


        //     dd($donations);
        //     $payment = Paymongo::payment()->find('pay_i35wBzLNdX8i9nKEPaSKWGib');


        //     return $next($request);

        // } catch (\Exception $e) {
        //     return redirect()->route('payment');
        // }

        return $next($request);
    }
}
