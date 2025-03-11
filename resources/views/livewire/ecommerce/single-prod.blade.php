<div> {{-- Open --}}

    <div class="bg-white dark:bg-[#262626] p-6 rounded-lg shadow-md mt-10">
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Product Image -->
            <div class="relative">
                <img class="w-full h-[200px] md:h-[300px] lg:h-[350px] object-cover rounded-xl" 
                     src="{{ asset(Storage::url($product->images[0]->url)) }}" 
                     alt="{{ $product->prod_slug }}">
            </div>

            <!-- Product Details -->
            <div>
                <h1 class="text-2xl font-bold text-black dark:text-white">
                    {{ ucwords($product->prod_name) }}
                </h1>
                <p class="text-black dark:text-white mt-2">
                    {{ ucfirst($product->prod_short_description) }}
                </p>
                <p class="{{ $product->prod_quantity > 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ $product->prod_quantity > 10 ? 'In Stock' : 'Low in Stock (' . (int) $product->prod_quantity. ')' }}
                </p>

                <livewire:ecommerce.add-to-cart-form :product_id="$product->id" wire:key="add-to-cart-{{ $product->id }}" />

                <p class="text-black dark:text-white mt-2">
                    <strong>Category: </strong>{{ ucwords($product->productCategories->pluck('prod_cat_name')->join(', ')) }}
                </p>
            </div>
        </div>

        @if ($product && $product->images->count() > 1)
            
    
        <!-- Slider -->
        <div data-hs-carousel='{
            "loadingClasses": "opacity-0",
            "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500",
            "isAutoPlay": true
        }' class="relative mt-6">
            <div class="hs-carousel relative overflow-hidden w-full min-h-60 bg-white rounded-lg">
                <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">

                    @foreach($product->images as $img)
                        <div class="hs-carousel-slide">
                            <div class="flex justify-center h-full bg-gray-100 p-6 dark:bg-neutral-900">
                                <img class="object-cover w-40 h-40 md:w-60 md:h-60" 
                                     src="{{ asset(Storage::url($img->url)) }}" 
                                     alt="{{ $product->prod_slug }}">
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>

            <button type="button" class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span class="text-2xl" aria-hidden="true">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </span>
                <span class="sr-only">Previous</span>
            </button>
            <button type="button" class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span class="sr-only">Next</span>
                <span class="text-2xl" aria-hidden="true">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </span>
            </button>

            <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 flex gap-x-2"></div>
        </div>

        @else
        <p class="text-center text-gray-500">{{ __('No images available for this product.') }}</p>
        @endif
        <!-- End Slider -->

        <!-- Tabs Section -->
        <div class="mt-6 border-t border-gray-400 dark:border-gray-700 pt-4">
            <div class="flex space-x-6 text-black dark:text-white font-medium">
                <a href="#" class="border-b-2 border-black dark:border-white pb-2">Description</a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Reviews (0)</a>
            </div>

            <!-- Expandable Description -->
            <p class="text-black dark:text-white mt-4">
                {{ Str::limit($product->prod_description, 100) }} 
                <span x-data="{ expanded: false }">
                    <span x-show="expanded" x-cloak>{{ substr($product->prod_description, 100) }}</span>
                    <button @click="expanded = !expanded" class="ml-2 text-blue-600 dark:text-blue-400 hover:underline">
                        <span x-show="!expanded">View More</span>
                        <span x-show="expanded" x-cloak>View Less</span>
                    </button>
                </span>
            </p>
        </div>
    </div>

</div> {{-- Close --}}
