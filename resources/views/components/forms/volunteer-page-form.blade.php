<div>
    @if (session()->has('message'))
        <div class="mb-6 text-sm text-green-600 alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent='submit'>
        <div class="grid gap-4 lg:gap-6">
            <!-- Grid -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:gap-6">
            <div>
                <label for="v_first_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">First Name</label>
                <input wire:model='v_first_name' type="text" name="v_first_name" id="v_first_name" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('v_first_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="v_last_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Last Name</label>
                <input wire:model='v_last_name' type="text" name="v_last_name" id="v_last_name" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @error('v_last_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            </div>
            <!-- End Grid -->

            <!-- Grid -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:gap-6">
                <div>
                    <label for="v_email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Email</label>
                    <input wire:model="v_email" type="email" name="v_email" id="v_email" autocomplete="email" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    @error('v_email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="v_role" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Volunteer Role</label>
                    <select id="v_role" wire:model="v_role"  class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <option selected="">Open this select menu</option>
                        <option value="dog_walking">{{ __('Dog Walking') }}</option>
                        <option value="event_assistance">{{ __('Event Assistance') }}</option>
                        <option value="admin_support">{{ __('Admin Support') }}</option>
                        <option value="community_outreach">{{ __('Community Outreach') }}</option>
                      </select>
                      @error('v_role') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- End Grid -->

            <div>
                <label for="v_reason" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Reason for joining</label>
                <textarea id="v_reason" wire:model="v_reason" name="v_reason" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
                @error('v_reason') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
        <!-- End Grid -->

        <div class="grid mt-6">
            <button wire:loading.attr="disabled" type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white border border-transparent rounded-lg gap-x-2 bg-amber-600 hover:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none">
                {{ __('Submit Request') }}
                <div wire:loading>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                </div>
            </button>
        </div>

        {{-- <div class="mt-3 text-center">
            <p class="text-sm text-gray-500 dark:text-neutral-500">
            We'll get back to you in 1-2 business days.
            </p>
        </div> --}}
    </form>
</div>
