
@if (session()->has('message'))
    <div class="mb-6 text-sm text-green-600 alert alert-success">
        {{ session('message') }}
    </div>
@endif

<form wire:submit.prevent='submit'>
    <div class="grid gap-4">
    <!-- Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
            <label for="firstname" class="sr-only">{{ __('First Name') }}</label>
            <input type="text" name="firstname" id="firstname" wire:model.blur='first_name' class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="First Name">
            @error('first_name') <span class="text-xs text-red-600 error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="lastname" class="sr-only">{{ __('Last Name') }}</label>
            <input type="text" name="lastname" id="lastname" wire:model.blur='last_name' class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="Last Name">
            @error('last_name') <span class="text-xs text-red-600 error">{{ $message }}</span> @enderror
        </div>
    </div>
    <!-- End Grid -->

    <div>
        <label for="email" class="sr-only">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" wire:model.blur='email' autocomplete="email" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="Email">
        @error('email') <span class="text-xs text-red-600 error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="phone" class="sr-only">{{ __('Phone Number') }}</label>
        <input type="text" name="phone" id="phone" wire:model.blur='phone' class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="Phone Number">
        @error('phone') <span class="text-xs text-red-600 error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="subject" class="sr-only">{{ __('Subject') }}</label>
        <input type="subject" name="subject" id="subject" wire:model.blur='subject' autocomplete="subject" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="subject">
        @error('subject') <span class="text-xs text-red-600 error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="hs-about-contacts-1" class="sr-only">{{ __('Details') }}</label>
        <textarea id="hs-about-contacts-1" name="hs-about-contacts-1" wire:model.blur='message' rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" placeholder="Details"></textarea>
        @error('message') <span class="text-xs text-red-600 error">{{ $message }}</span> @enderror
    </div>
    </div>
    <!-- End Grid -->

    <div class="grid mt-4">
    <button wire:loading.attr="disabled" type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-black border border-transparent rounded-lg gap-x-2 bg-amber-400 hover:bg-amber-500 disabled:opacity-50 disabled:pointer-events-none">
        {{ __('Send inquiry') }}
        <div wire:loading>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
        </div>
    </button>
    </div>

    <div class="mt-3 text-center">
        <p class="text-sm text-gray-500 dark:text-neutral-500">
            {{ __( "We'll get back to you asap.") }}
        </p>
    </div>
</form>
