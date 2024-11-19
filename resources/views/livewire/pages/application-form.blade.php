
<div>
    <div class="p-8 mx-auto my-24 max-w-7xl">
       <div class="grid grid-cols-2 mx-auto gap-x-8">
        <div>
            <h2 class="mb-6 text-2xl font-bold text-gray-800 dark:text-neutral-200">{{ __('Summary of dogs to be adopted.') }}</h2>
            <div class="flex flex-col mb-6 bg-white border shadow-sm lg:mb-10 rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="p-4 md:p-10">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                          <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                              <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                  <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">Avatar</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">Name</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">Age</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">Gender</th>
                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse ($selected_dogs as $adoptionCart )
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            <div class="flex-shrink-0 relative overflow-hidden h-[70px] sm:w-[70px] sm:h-[70px] w-full rounded-full">
                                                <img class="absolute top-0 object-cover size-full start-0" src="{{ Storage::url($adoptionCart->dog->dog_image[0]['dog_image']) }}" alt="{{ $adoptionCart->dog->dog_name }}">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                            <div class="flex flex-col">
                                                <h5 class="font-bold">{{ $adoptionCart->dog->dog_name }}</h5>
                                                <span class="text-xs italic text-gray-500">{{ $adoptionCart->dog->breed->breed_name ?? 'No Breed Information' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">{{ $adoptionCart->dog->dog_age }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">{{ Str::ucfirst($adoptionCart->dog->dog_gender) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            {{ __('No dog information found for this adoption cart entry.') }}
                                        </td>
                                    </tr>
                                    @endforelse


                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-amber-400" href="{{ route('page.dogs') }}">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                {{ __('Back to Dogs') }}
            </a>
        </div>

        <div class="w-full">
            <h2 class="mb-6 text-2xl font-bold text-gray-500 dark:text-neutral-100">{{ __('Application Details') }}</h2>

            @if (session()->has('message'))
                <div class="mb-4 text-green-600">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="submit" class="w-full">
                <div class="mb-4">
                    <label class="block mb-4 text-sm text-gray-500 dark:text-neutral-400">{{ __('What type of home do you live in?') }} <span class="text-sm text-red-600">*</span></label>
                    <select wire:model.blur="type_of_home" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" >
                        <option value="" selected>Select type</option>
                        <option value="home">Home</option>
                        <option value="apartment">Apartment</option>
                        <option value="villa">Villa</option>
                        <option value="other">Other</option>
                    </select>
                    @error('type_of_home') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="py-8 lg:py-10" x-data="{ isOwnHome: false }">

                    <div class="mb-4">
                        <input x-model="isOwnHome" wire:model.blur="is_own_home" type="checkbox" value="0" class="shrink-0 mt-0.5 border-gray-200 rounded text-amber-600 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800" id="hs-owner-home-checkbox">
                        <label for="hs-owner-home-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ __('Do you own the home that you live in?. Please check if applicable') }}</label>
                        @error('is_own_home') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div x-show="isOwnHome" class="w-full mb-6 bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <div class="p-4 md:p-10">
                            <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Owners Name') }}</label>
                            <input type="text" wire:model.blur="owners_name" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100">
                            @error('owbers_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                    </div>


                </div>


                <div class="mb-4">
                    <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Home address') }} <span class="text-sm text-red-600">*</span></label>
                    <input type="text" wire:model.blur="temporary_address" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100">
                    @error('temporary_address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Permanent address') }} <span class="text-sm text-red-600">*</span></label>
                    <input type="text" wire:model.blur="permanent_address" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" >
                    @error('permanent_address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="py-8 lg:py-10" x-data="{ hasAnyPet: false }">
                    <div class="flex mb-4">
                        <input x-model="hasAnyPet" wire:model.blur="has_any_pet" type="checkbox" value="0" class="shrink-0 mt-0.5 border-gray-200 rounded text-amber-600 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800" id="hs-pet-checkbox">
                        <label for="hs-pet-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ __('Do you currently have any pets?') }}</label>
                        @error('has_any_pet') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div x-show="hasAnyPet" class="w-full mb-6 bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <div class="p-4 md:p-10">
                            <div class="grid grid-cols-2 mx-auto gap-x-6">
                                @foreach ($pet_details as $indexKey => $pet )
                                <div class="mb-4">
                                    <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Pet Name') }}</label>
                                    <input type="text" wire:model.blur="pet_details.{{ $indexKey }}.pet_name" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100">
                                    @error('pet_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Pet Species') }}</label>
                                    <input type="text" wire:model.blur="pet_details.{{ $indexKey }}.species" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100">
                                    @error('species') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="flex justify-end col-span-2">
                                    <button type="button" wire:click.prevent="removePet({{ $indexKey }})"class="text-sm text-red-600">
                                        <div class="flex flex-row items-center align-middle gap-x-2 group-[&:hover]:text-red-700">
                                            <svg class="flex-shrink-0 size-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            {{ __('Remove') }}
                                        </div>
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" wire:click.prevent="addPet" class="flex flex-row items-center px-4 py-2 mt-2 text-sm text-white rounded-md shadow-md gap-x-2 bg-amber-500 hover:bg-amber-600">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 4c-1.71 0-2.75.33-3.35.61C13.88 4.23 13 4 12 4s-1.88.23-2.65.61C8.75 4.33 7.71 4 6 4c-3 0-5 8-5 10c0 .83 1.32 1.59 3.14 1.9c.64 2.24 3.66 3.95 7.36 4.1v-4.28c-.59-.37-1.5-1.04-1.5-1.72c0-1 2-1 2-1s2 0 2 1c0 .68-.91 1.35-1.5 1.72V20c3.7-.15 6.72-1.86 7.36-4.1C21.68 15.59 23 14.83 23 14c0-2-2-10-5-10M4.15 13.87c-.5-.12-.89-.26-1.15-.37c.25-2.77 2.2-7.1 3.05-7.5c.54 0 .95.06 1.32.11c-2.1 2.31-2.93 5.93-3.22 7.76M9 12a1 1 0 0 1-1-1c0-.54.45-1 1-1a1 1 0 0 1 1 1c0 .56-.45 1-1 1m6 0a1 1 0 0 1-1-1c0-.54.45-1 1-1a1 1 0 0 1 1 1c0 .56-.45 1-1 1m4.85 1.87c-.29-1.83-1.12-5.45-3.22-7.76c.37-.05.78-.11 1.32-.11c.85.4 2.8 4.73 3.05 7.5c-.25.11-.64.25-1.15.37"/></svg>

                                {{ __('Add another pet') }}
                            </button>

                        </div>
                    </div>
                </div>

                <div class="w-full mb-6 bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="grid grid-cols-2 p-4 mx-auto md:p-10 gap-x-6">
                        <div class="mb-4">
                            <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Preferred date to interview') }} <span class="text-sm text-red-600">*</span></label>
                            <input type="date" wire:model.blur="preferred_date" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" >
                            @error('preferred_date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Preferred time to interview') }} <span class="text-sm text-red-600">*</span></label>
                            <input type="time" wire:model.blur="preferred_time" list="time-options" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" >
                            <datalist id="time-options">
                                <option value="09:00">
                                <option value="09:30">
                                <option value="10:00">
                                <option value="10:30">
                                <option value="11:00">
                                <option value="11:30">
                                <option value="12:00">
                            </datalist>
                            @error('preferred_time') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex mb-4">
                            <input wire:model.blur="can_visit_shelter" value="1" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-amber-600 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-amber-500 dark:checked:border-amber-500 dark:focus:ring-offset-gray-800" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ __('Can visit in the shelter?') }}</label>
                            @error('can_visit_shelter') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col w-full mb-4 bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="p-4 md:p-10">
                        <label class="block mb-4 text-white dark:text-neutral-100">{{ __('Contact Details') }}</label>
                        @foreach($contact_details as $index => $contact)
                            <div class="grid grid-cols-2 gap-4 mb-2">
                                <div>
                                    <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Phone Number') }} <span class="text-sm text-red-600">*</span></label>
                                    <input wire:key='contact-{{ $index }}' type="text" wire:model.blur="contact_details.{{ $index }}.phone_number" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" >
                                    @error('contact_details.'.$index.'.phone_number') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block mb-4 text-gray-500 dark:text-neutral-400">{{ __('Telephone Number') }} <span class="text-sm text-red-600">*</span></label>
                                    <input wire:key='contact-{{ $index }}' type="text" wire:model.blur="contact_details.{{ $index }}.telephone_number" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 bg-slate-100" >
                                    @error('contact_details.'.$index.'.telephone_number') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex justify-end col-span-2">
                                    <button wire:key='contact-btn-{{ $index }}' type="button" wire:click.prevent="removeContact({{ $index }})" class="text-sm text-red-600">
                                        <div class="flex flex-row items-center align-middle gap-x-2 group-[&:hover]:text-red-700">
                                            <svg class="flex-shrink-0 size-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            {{ __('Remove') }}
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" wire:click.prevent="addContact" class="flex flex-row items-center px-4 py-2 mt-2 text-sm text-white rounded-md shadow-md gap-x-2 bg-amber-500 hover:bg-amber-600">
                            <svg class="flex-shrink-0 size-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                              </svg>

                            {{ __('Add another contact') }}
                        </button>
                    </div>
                </div>

                <div class="mt-8">
                    <button wire:loading.attr="disabled" type="submit" class="w-full py-4 text-white rounded-md shadow-md bg-amber-500 hover:bg-amber-700">
                        {{ __('Submit') }}

                        <div wire:loading>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                        </div>
                    </button>
                </div>
            </form>
        </div>
       </div>
    </div>
</div>
