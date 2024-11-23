<!-- Card Section -->
<div class="px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-14 lg:mb-10">
    <div class="grid gap-10 md:grid-cols-4">
        <div class="md:col-span-2">
            <!-- Card -->
            <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-neutral-900">
                <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-neutral-200">
                    <div class="flex flex-row justify-center align-items-center">
                        <span>{{'Give'}}</span>
                        <svg class="mx-3 mt-1 text-red-600 size-12 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span>{{'for the Dogs'}}</span>
                    </div>
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    {{'Make a donation today.'}}
                </p>
                </div>

                @if (session()->has('message'))
                    <div class="w-full">
                        <div class="mb-4 text-green-600">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif


                <form wire:submit.prevent="save">
                    <!-- Section -->
                    <div class="py-6 border-t border-gray-200 first:pt-0 last:pb-0 first:border-transparent dark:border-neutral-700 dark:first:border-transparent">
                        <label class="inline-block mb-2 text-sm font-medium lg:mb-3 dark:text-white">
                            {{'Donation Method'}}
                        </label>

                        <div class="mt-2 space-y-3">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <!-- GCash -->
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5 mt-1">
                                        <input
                                            id="payment-gcash"
                                            name="donor_payment_method"
                                            type="radio"
                                            value="gcash"
                                            wire:model.live="donor_payment_method"
                                            class="border-gray-200 rounded-full text-amber-600 focus:ring-amber-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800"
                                        >
                                    </div>
                                    <label for="payment-gcash" class="ms-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">

                                            <img src="{{asset('imgs/gcash.png')}}" class="w-auto h-8 mb-2" />

                                        </span>
                                        <span class="block text-sm text-gray-600 dark:text-neutral-500">{{'Donate using your GCash account'}}</span>
                                    </label>
                                </div>

                                <!-- Card -->
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5 mt-1">
                                        <input
                                            id="payment-card"
                                            name="donor_payment_method"
                                            type="radio"
                                            value="card"
                                            wire:model.live="donor_payment_method"
                                            class="border-gray-200 rounded-full text-amber-600 focus:ring-amber-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800"
                                        >
                                    </div>
                                    <label for="payment-card" class="ms-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">
                                            <img src="{{asset('imgs/card.png')}}" class="w-auto h-8 mb-2" />
                                        </span>
                                        <span class="block text-sm text-gray-600 dark:text-neutral-500">{{'Donate using your credit or debit card'}}</span>
                                    </label>
                                </div>

                                <!-- PayMaya -->
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5 mt-1">
                                        <input
                                            id="payment-paymaya"
                                            name="donor_payment_method"
                                            type="radio"
                                            value="paymaya"
                                            wire:model.live="donor_payment_method"
                                            class="border-gray-200 rounded-full text-amber-600 focus:ring-amber-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800"
                                        >
                                    </div>
                                    <label for="payment-paymaya" class="ms-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">
                                            <img src="{{asset('imgs/paymaya.png')}}" class="w-auto h-8 mb-2" />
                                        </span>
                                        <span class="block text-sm text-gray-600 dark:text-neutral-500">{{'Donate using your PayMaya account'}}</span>
                                    </label>
                                </div>

                                <!-- GrabPay -->
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5 mt-1">
                                        <input
                                            id="payment-grabpay"
                                            name="donor_payment_method"
                                            type="radio"
                                            value="grab_pay"
                                            wire:model.live="donor_payment_method"
                                            class="border-gray-200 rounded-full text-amber-600 focus:ring-amber-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800"
                                        >
                                    </div>
                                    <label for="payment-grabpay" class="ms-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">
                                            <img src="{{asset('imgs/grabpay.png')}}" class="w-auto h-8 mb-2" />
                                        </span>
                                        <span class="block text-sm text-gray-600 dark:text-neutral-500">{{'Donate using your GrabPay wallet'}}</span>
                                    </label>
                                </div>
                            </div>
                            @error('donor_payment_method') <span class="mt-4 text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>
                        </div>
                        <!-- End Section -->

                    @if($donor_payment_method === 'card')
                        <div class="p-4 mb-4 bg-white border border-gray-200 shadow-sm lg:mb-5 rounded-xl md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                            <h3 class="font-medium inline-block text-sm text-gray-800 mt-2.5 mb-3 dark:text-neutral-200">{{'Card Details'}}</h3>

                            <div class="mb-3">
                            <input type="text" wire:model.blur="card_name" id="card_name" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="Name on Card">
                            @error('card_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                            <input type="text" wire:model.blur="card_number" id="card_number" class="block w-full px-3 py-3 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="1234 5678 9012 3456">
                            @error('card_number') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <span class="block mb-2 text-sm text-gray-600 dark:text-neutral-500">{{'Expiration Month'}}</span>
                                    <select wire:model.blur="expiration_month"  id="expiration_month" class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-9 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option value="">{{ __('Select Month') }}</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    @error('expiration_month') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <span class="block mb-2 text-sm text-gray-600 dark:text-neutral-500"> {{'Year'}}</span>
                                    <select wire:model.blur="expiration_year" id="expiration_year"
                                            class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-9 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option value="">{{'Year'}}</option>
                                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('expiration_year') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <span class="block mb-2 text-sm text-gray-600 dark:text-neutral-500"> {{'CVV'}}</span>
                                    <input type="text" wire:model.blur="cvv" id="cvv" class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="123">
                                    @error('cvv') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="py-6 border-t border-gray-200 first:pt-0 last:pb-0 first:border-transparent dark:border-neutral-700 dark:first:border-transparent">
                        <label class="inline-block text-sm font-medium dark:text-white">
                        {{'Amount'}}
                        </label>

                        <div class="mt-2 space-y-3">
                            <!-- Input Number -->
                            <div class="px-3 py-2 bg-gray-100 rounded-lg dark:bg-neutral-700" data-hs-input-number="">
                                <div class="flex items-center justify-between w-full gap-x-5">
                                    <div class="grow">
                                        <input type="number" wire:model.blur="donor_amount" id="donor_amount" class="w-full p-0 py-1 bg-transparent dark:bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="100" data-hs-input-number-input="" placeholder="100">

                                    </div>
                                    <div class="flex justify-end items-center gap-x-1.5">
                                        <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                        </svg>
                                        </button>
                                        <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            @error('donor_amount') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            <!-- End Input Number -->
                        </div>
                    </div>

                    <!-- Section -->
                    <div class="py-6 border-t border-gray-200 first:pt-0 last:pb-0 first:border-transparent dark:border-neutral-700 dark:first:border-transparent">
                        <label class="inline-block text-sm font-medium dark:text-white">
                        {{'Donor Details'}}
                        </label>

                        <div class="mt-2 space-y-3">
                        {{-- Donor name --}}
                        <input type="text" wire:model.blur="donor_name" id="donor_name" class="relative block w-full px-3 py-3 -mt-px text-sm border-gray-200 shadow-sm pe-11 -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg focus:z-10 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Name">
                        @error('donor_name') <span class="relative block w-full mt-1 text-sm text-red-600">{{ $message }}</span> @enderror

                        {{-- Donor email --}}
                        <input wire:model.blur="donor_email" id="donor_email" type="email" class="block w-full px-3 py-3 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Email address">
                        @error('donor_email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                        <input  type="tel" wire:model.blur="donor_phone_number" id="donor_phone_number" class="block w-full px-3 py-3 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Phone Number">
                        @error('donor_phone_number') <span class="text-sm text-red-600">{{ $message }}</span> @enderror


                        <textarea wire:model.blur="donor_address" id="donor_address" class="block w-full px-3 py-3 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Complete Address"></textarea>
                        @error('donor_address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror


                        <textarea wire:model.blur="donor_message" id="donor_message" class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="6" placeholder="Your message" rows="3"></textarea>
                        @error('donor_message') <span class="w-full text-sm text-red-600">{{ $message }}</span> @enderror

                        </div>
                    </div>

                    <div class="flex justify-end mt-5 gap-x-2">
                        <button wire:loading.attr="disabled" type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white border border-transparent rounded-lg gap-x-2 bg-amber-600 hover:bg-amber-700 focus:outline-none focus:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none">
                            {{'Donate Now'}}
                            <div wire:loading>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                            </div>
                        </button>
                    </div>

                </form>


            </div>
            <!-- End Card -->
        </div>



        <div class="md:col-span-2">
            <div class="mb-4 lg:mb-7">
                <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1542715234-bd0adb4249b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&h=500&q=80" alt="Hero Image">
            </div>
            <!-- Title -->
            <div class="max-w-2xl mx-auto mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{'Support Our Mission Through Your Generosity'}}</h2>
                <p class="mt-2 text-gray-600 dark:text-neutral-400">{{'Your donation can make a significant difference in helping us achieve our goals. Here’s everything you need to know about contributing.'}}</p>
            </div>
            <!-- End Title -->

            <div class="max-w-2xl mx-auto divide-y divide-gray-200 dark:divide-neutral-700">
                <div class="py-8 first:pt-0 last:pb-0">
                <div class="flex gap-x-5">
                    <svg class="mt-1 text-gray-500 shrink-0 size-6 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>

                    <div class="grow">
                    <h3 class="font-semibold text-gray-800 md:text-lg dark:text-neutral-200">
                       {{'How does your donation help?'}}
                    </h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">
                        {{'Your generosity fuels our efforts to make a meaningful impact. Every contribution supports the programs, resources, and services that drive our mission forward.'}}
                    </p>
                    </div>
                </div>
                </div>

                <div class="py-8 first:pt-0 last:pb-0">
                <div class="flex gap-x-5">
                    <svg class="mt-1 text-gray-500 shrink-0 size-6 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>

                    <div class="grow">
                    <h3 class="font-semibold text-gray-800 md:text-lg dark:text-neutral-200">
                        {{'Is my information secure?'}}
                    </h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">
                        {{'Absolutely. Protecting your personal and payment information is a priority for us. We utilize top-notch security protocols to ensure your data remains safe.'}}
                    </p>
                    </div>
                </div>
                </div>

                <div class="py-8 first:pt-0 last:pb-0">
                <div class="flex gap-x-5">
                    <svg class="mt-1 text-gray-500 shrink-0 size-6 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>

                    <div class="grow">
                    <h3 class="font-semibold text-gray-800 md:text-lg dark:text-neutral-200">
                        {{'Do I get a receipt for my donation?'}}
                    </h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">
                       {{'Of course! You’ll receive an acknowledgment and receipt for every donation, which can be used for your records or tax purposes.'}}
                    </p>
                    </div>
                </div>
                </div>

                <div class="py-8 first:pt-0 last:pb-0">
                <div class="flex gap-x-5">
                    <svg class="mt-1 text-gray-500 shrink-0 size-6 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>

                    <div class="grow">
                    <h3 class="font-semibold text-gray-800 md:text-lg dark:text-neutral-200">
                        {{'Can I stop donating if needed?'}}
                    </h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">
                       {{'Of course! Donations are entirely voluntary, and you’re under no obligation to continue. While no explanation is necessary, we’d greatly appreciate any feedback you’d like to share to help us grow and improve.'}}
                    </p>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>

</div>
  <!-- End Card Section -->
