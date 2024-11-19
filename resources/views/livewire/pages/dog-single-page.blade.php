
<div>
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto lg:my-12 sm:pb-6 lg:pb-10">
        <div class="grid lg:grid-cols-6 gap-y-8 lg:gap-y-0 lg:gap-x-10">
            <!-- Sidebar -->
            <div class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
                <div class="sticky top-0 py-8 start-0 lg:ps-8">
                    <div class="mb-10">
                    <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-amber-400" href="{{ route('page.dogs') }}">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        {{ __('Back to Dogs') }}
                    </a>
                    </div>

                    <h4 class="mb-6 text-xl font-semibold dark:text-white">{{ __('Breeds') }}</h4>

                    <div class="space-y-6">
                        @foreach ($dogBreeds as $breed)
                            <x-dog-page.dog-breed-category :$breed/>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="lg:col-span-5">
                <div class="py-8 lg:pe-8">
                    <div class="space-y-5 text-gray-600 lg:space-y-8 dark:text-neutral-400">
                      <div class="grid gap-6 lg:grid-cols-2">
                        <div class="flex-shrink-1 relative rounded-xl overflow-hidden h-[200px] sm:w-[250px] sm:h-[350px] lg:w-full">
                            <div class="w-full" data-hs-carousel='{
                              "loadingClasses": "opacity-0",
                              "isAutoPlay": true
                            }' class="relative" wire:ignore>
                              <div class="relative w-full overflow-hidden bg-white rounded-lg hs-carousel min-h-96">
                                <div class="absolute top-0 bottom-0 flex transition-transform duration-700 opacity-0 hs-carousel-body start-0 flex-nowrap">
                                    @foreach ($dog['dog_image'] as $key => $image)
                                    <div class="hs-carousel-slide" wire:key="{{ $dog->secure_key }}">
                                        <div class="flex justify-center h-full overflow-hidden bg-gray-100 bg-center dark:bg-neutral-900 ">
                                        <img class="object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 rounded-xl" src="{{ asset(Storage::url($image['dog_image'])) }}" alt="{{ $dog->dog_name }}">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                              </div>

                              @if (count($dog['dog_image']) > 1)
                              <button type="button" class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10">
                                <span class="text-2xl" aria-hidden="true">
                                  <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                  </svg>
                                </span>
                                <span class="sr-only">{{ __('Previous') }}</span>
                              </button>
                              <button type="button" class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10">
                                <span class="sr-only">{{ __('Next') }}</span>
                                <span class="text-2xl" aria-hidden="true">
                                  <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                  </svg>
                                </span>
                              </button>

                              <div class="absolute flex justify-center space-x-2 hs-carousel-pagination bottom-3 start-0 end-0">
                                @foreach ($dog['dog_image'] as $key => $image)
                                <span wire:key="{{ 'dog-image-pagination-' . $key }}" class="border border-gray-400 rounded-full cursor-pointer hs-carousel-active:bg-amber-400 hs-carousel-active:border-amber-400 size-3 dark:border-neutral-600 dark:hs-carousel-active:bg-amber-400 dark:hs-carousel-active:border-amber-400"></span>
                                @endforeach
                              </div>
                              @endif

                            </div>
                        </div>

                        <div class="grow">
                            <div class="flex flex-col h-full pt-0 sm:px-6 sm:pb-6 lg:px-4 lg:pb-4">

                              <div class="flex flex-col flex-wrap justify-start mb-10 md:flex-row lg:justify-between">
                                <h3 class="text-lg font-semibold text-gray-800 sm:mb-5 lg:mb-0 sm:text-3xl group-hover:text-amber-500 dark:text-neutral-300 dark:group-hover:text-amber-500">
                                    {{ $dog->dog_name }}
                                </h3>

                                <div>
                                  <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">{{ $dog->breed->breed_name }}</span>
                                </div>
                              </div>

                              <!-- Dog details -->
                              <hr class="border-neutral-200 dark:border-neutral-700">

                              <div class="flex justify-between w-full gap-5 py-6 lg:flex-row lg:px-10 ">
                                <!-- Stats -->
                                <div class="lg:col-span-1">
                                  <h5 class="font-semibold text-gray-800 dark:text-neutral-200">{{ $dog->dog_age }}</h5>
                                  <p class="mt-2 font-bold sm:mt-3 sm:text-sm text-amber-400">{{ __('Age') }}</p>
                                </div>
                                <!-- End Stats -->

                                <!-- Stats -->
                                <div class="lg:col-span-1">
                                  <h5 class="font-semibold text-gray-800 dark:text-neutral-200">{{ $dog->dog_size }}</h5>
                                  <p class="mt-2 font-bold sm:mt-3 sm:text-sm text-amber-400">{{ __('Size') }}</p>

                                </div>
                                <!-- End Stats -->

                                <!-- Stats -->
                                <div class="lg:col-span-1">
                                  <h5 class="font-semibold text-gray-800 dark:text-neutral-200">{{ $dog->dog_gender }}</h5>
                                  <p class="mt-2 font-bold sm:mt-3 sm:text-sm text-amber-400">{{ __('Gender') }}</p>

                                </div>
                                <!-- End Stats -->


                              </div>
                              <hr class="border-neutral-200 dark:border-neutral-700">
                              <!-- End Dog detials -->

                                <p class="mt-4 text-gray-600 dark:text-neutral-400">
                                  {{ $dog->dog_short_description }}
                                </p>


                                <div class="pt-10 sm:mt-auto">
                                    <!-- Avatar -->
                                    <button wire:click.prevent="adoptDog({{ $dog->id }})" class="flex flex-row items-center justify-center w-full px-3 py-4 text-sm font-bold text-black transition border border-transparent gap-x-2 rounded-xl bg-amber-400 hover:bg-amber-500 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-amber-500">

                                        <svg  class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 56 56"><path fill="currentColor" fill-rule="evenodd" d="M16.881 50.83c-.202-.014-.404-.025-.605-.043c-1.13-.106-2.167-.475-3.087-1.14c-1.587-1.15-2.602-2.679-3.006-4.602a8.149 8.149 0 0 1-.147-2.188a9.757 9.757 0 0 1 .498-2.521c.439-1.308 1.1-2.495 1.937-3.589A14.948 14.948 0 0 1 14.6 34.5a18.334 18.334 0 0 0 2.031-2.077c.788-.935 1.5-1.926 2.205-2.924c.622-.882 1.234-1.77 1.894-2.622a16.959 16.959 0 0 1 1.605-1.83c.73-.707 1.536-1.305 2.486-1.694a6.161 6.161 0 0 1 2.224-.462a9.855 9.855 0 0 1 2.579.273a7.418 7.418 0 0 1 3.387 1.867c.662.63 1.222 1.344 1.742 2.09c.553.792 1.06 1.613 1.583 2.424c.59.913 1.2 1.812 1.88 2.662a18.325 18.325 0 0 0 2.242 2.344a15.79 15.79 0 0 1 2.611 2.909a12.18 12.18 0 0 1 1.518 2.979a9.4 9.4 0 0 1 .504 2.556c.07 1.332-.16 2.606-.765 3.804c-.56 1.11-1.37 2.003-2.386 2.71c-.748.521-1.555.917-2.443 1.137a6.49 6.49 0 0 1-.957.167c-.045.004-.088.012-.132.02c-.042.023-.088.005-.133.01c-.037.006-.075-.01-.11.012h-.828c-.033-.023-.07-.007-.105-.011h-.175c-.706-.023-1.391-.17-2.075-.329c-1.157-.27-2.292-.625-3.444-.918a21.385 21.385 0 0 0-2.83-.538a13.409 13.409 0 0 0-1.992-.062c-.53.018-1.058.1-1.58.197c-1.03.194-2.039.47-3.049.746c-1.068.294-2.136.585-3.23.764c-.445.072-.89.134-1.343.13c-.093-.002-.185.012-.279.01c-.12-.007-.237.014-.355-.013m20.41-45.81c1.488.179 2.626.936 3.495 2.129c.595.818.97 1.736 1.202 2.717a9.8 9.8 0 0 1 .245 2.57a11.205 11.205 0 0 1-1.12 4.546a9.43 9.43 0 0 1-1.886 2.668c-.703.688-1.498 1.238-2.426 1.581c-.652.24-1.322.36-2.016.318c-1.202-.069-2.223-.547-3.08-1.381c-.732-.712-1.23-1.574-1.575-2.527a8.93 8.93 0 0 1-.47-2.057a9.994 9.994 0 0 1-.06-1.446c.035-1.138.24-2.246.61-3.322a10.273 10.273 0 0 1 1.709-3.147c.64-.794 1.387-1.466 2.283-1.962a5.63 5.63 0 0 1 2.112-.686c.023-.013.048-.007.071-.009h.071c.035-.004.071.012.102-.012h.488c.031.025.067.008.101.012h.072c.023 0 .048-.005.072.008M3.045 22.6c.023-.454.105-.9.224-1.339c.232-.853.61-1.63 1.2-2.295a4.33 4.33 0 0 1 2.448-1.418c.792-.156 1.574-.09 2.342.148c.884.272 1.665.736 2.36 1.34c1.078.935 1.852 2.086 2.387 3.402a8.815 8.815 0 0 1 .666 3.218a7.539 7.539 0 0 1-.226 2.023c-.227.885-.609 1.69-1.217 2.38a4.322 4.322 0 0 1-2.612 1.453c-.766.124-1.519.04-2.255-.198c-.99-.321-1.84-.873-2.588-1.588a8.66 8.66 0 0 1-1.76-2.402a9.25 9.25 0 0 1-.896-2.787c-.025-.173-.046-.346-.07-.518c-.018-.079-.01-.16-.03-.238c-.009-.033-.004-.064-.005-.098c-.006-.041.013-.086-.013-.127v-.634c.04-.058.02-.122.024-.184c.004-.046-.008-.095.021-.137m10.453-10.158c.005-1.258.184-2.391.605-3.483c.317-.825.753-1.579 1.36-2.228c.653-.702 1.429-1.204 2.365-1.441c.936-.238 1.856-.17 2.76.157c.797.29 1.492.745 2.11 1.32c.985.916 1.69 2.023 2.193 3.264c.32.788.54 1.604.665 2.445c.071.476.112.957.122 1.44a9.947 9.947 0 0 1-.128 1.817c-.209 1.256-.635 2.426-1.395 3.46a5.32 5.32 0 0 1-1.751 1.555a4.47 4.47 0 0 1-2.522.536c-.806-.061-1.55-.325-2.243-.736c-.904-.535-1.636-1.257-2.246-2.107a10.024 10.024 0 0 1-1.534-3.325a11.078 11.078 0 0 1-.332-2a6.138 6.138 0 0 1-.029-.674m39.5 10.895v.146c-.055 1.213-.38 2.354-.903 3.442a9.148 9.148 0 0 1-1.59 2.319c-.835.885-1.804 1.576-2.957 1.99a5.366 5.366 0 0 1-2.137.33a4.4 4.4 0 0 1-2.829-1.194c-.658-.612-1.091-1.364-1.365-2.21a6.832 6.832 0 0 1-.32-2.338c.054-1.752.607-3.344 1.567-4.801a8.613 8.613 0 0 1 1.112-1.366c.857-.854 1.837-1.51 2.998-1.883a5.277 5.277 0 0 1 2.025-.252a4.39 4.39 0 0 1 2.749 1.21c.696.657 1.136 1.468 1.401 2.38c.147.503.233 1.018.25 1.543v.147a9.116 9.116 0 0 0 0 .537"/></svg>

                                        {{ __('Adopt Me') }}
                                        <div wire:loading wire:target="adoptDog({{ $dog->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                                        </div>
                                    </button>
                                    <!-- End Avatar -->
                                </div>
                            </div>
                        </div>

                      </div>
                        <br>
                        {!! $dog->dog_long_description !!}
                        <br>

                      </div>
                    </div>

                    {{-- medical records --}}
                    <div class="flex flex-col mb-24 bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 lg:mb-0">
                        <div class="px-4 py-3 bg-gray-100 border-b rounded-t-xl md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                            {{ __('Medical Records') }}
                          </p>
                        </div>
                        <div class="p-4 md:p-5 [&>ul]:list-disc [&>ul]:ml-4 [&_h1]:text-4xl [&_h2]:text-3xl [&_h3]:text-2xl [&_h4]:text-xl [&_h5]:text-lg [&_h6]:text-base">
                            <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 ">
                                @foreach ($dog->medicalRecords as $medical_record )
                                <div wire:key='{{ $dog->security_code }}' class="flex flex-col col-span-1 bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                    <div class="p-4 md:p-5">
                                      <h5 class="font-bold text-gray-800 text-md dark:text-white">
                                        {{ $medical_record->veterinarian }}
                                      </h5>
                                      <div class="mt-2 font-normal text-gray-500 dark:text-neutral-400">
                                        {!! $medical_record->description !!}
                                      </div>

                                      <div class="flex flex-row">
                                        <div class="mt-8 text-gray-800 dark:text-neutral-400">
                                            {{ __('Last Updated : ') . $medical_record->record_date }}
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content -->


        </div>

    </div>

</div>
