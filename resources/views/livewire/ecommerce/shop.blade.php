<div>

   {{-- sorting menu  BY CATEGORIES--}}
   <div class="flex items-center gap-4 mt-10 ml-6">
    <!-- Sorting Menu -->
    <div class="hs-dropdown relative inline-flex" wire:ignore.self>
      <button id="hs-dropdown-slideup-animation" type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
        <span>{{ $selectedCatName ? ucwords($selectedCatName) : 'All Categories' }} ({{ strtoupper($sortBy) }})</span>
        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
      </button>
      <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 duration-300 mt-2 min-w-60 bg-white shadow-md rounded-lg dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-slideup-animation" wire:ignore.self>
        <div class="p-1 space-y-0.5">
          <div class="relative">
                <input type="text" wire:model.live="searchCat" placeholder="Search category..."
                    class="w-full px-3 py-2 text-sm border rounded-md focus:ring focus:ring-gray-300 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white pr-10"
                    x-on:click.stop />

                @if ($searchCat)
                    <button type="button" wire:click="$set('searchCat', '')"
                        class="absolute inset-y-0 end-2 flex items-center text-gray-400 hover:text-gray-600 dark:text-white/60 dark:hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                @endif
          </div>
          <div wire:key="category-list">

        <div class="relative group">
          <a wire:click="filterByCategory(null)"
          class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 cursor-pointer">
          All Categories
          <svg class="size-4 ml-auto transition-transform group-hover:rotate-180"
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg>
          </a>

          <div class="absolute left-full top-0 hidden group-hover:block bg-white dark:bg-neutral-800 shadow-md rounded-lg border dark:border-neutral-700 min-w-40 z-20">
            <a wire:click="filterByCategoryAndOrder(null, 'asc')"
              class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 cursor-pointer">
              Price:&nbsp;Low&nbsp;to&nbsp;High(ASC)
            </a>
            <a wire:click="filterByCategoryAndOrder(null, 'desc')"
              class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 cursor-pointer">
              Price:&nbsp;High&nbsp;to&nbsp;Low(DESC)
            </a>
          </div>
        </div>

          @forelse ($categories as $prodCat)
                <div class="relative group">
                  <a wire:click="filterByCategory({{ $prodCat->id }})"
                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 cursor-pointer">
                    {{ ucwords($prodCat->prod_cat_name) }}

                    <svg class="size-4 ml-auto transition-transform group-hover:rotate-180"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                      <path d="m6 9 6 6 6-6" />
                    </svg>
                  </a>

                  <!-- Submenu for Sorting -->
                  <div class="absolute left-full top-0 hidden group-hover:block bg-white dark:bg-neutral-800 shadow-md rounded-lg border dark:border-neutral-700 min-w-40 z-20">
                    <a wire:click="filterByCategoryAndOrder({{ $prodCat->id }}, 'asc')"
                      class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 cursor-pointer">
                      Price:&nbsp;Low&nbsp;to&nbsp;High(ASC)
                    </a>
                    <a wire:click="filterByCategoryAndOrder({{ $prodCat->id }}, 'desc')"
                      class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 cursor-pointer">
                      Price:&nbsp;High&nbsp;to&nbsp;Low(DESC)
                    </a>
                  </div>
                </div>
              @empty
                <p class="text-sm text-gray-800 dark:text-neutral-400">
                  No categories found.
                </p>
              @endforelse
            
            </div>
        </div>
      </div>
    </div>
    <!-- End of Sorting Menu -->
  
    
   

    <!-- Search Bar -->
     <div class="w-80">
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
          <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
          </svg>
        </div>
        <input 
        wire:model.live="query" 
        class="py-3 ps-10 pe-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
        type="text" 
        placeholder="Search Products"
        >
        @if ($query)
        <button type="button" wire:click="$set('query', '')" class="absolute inset-y-0 end-0 flex items-center pe-3 text-gray-400 hover:text-gray-600 dark:text-white/60 dark:hover:text-white">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
        @endif
        

      </div>
    </div>
    <!-- End of Search Bar -->
  </div> 


  
  {{-- @if(session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4">
            {{ session('message') }}
        </div>
   @endif --}}
  {{-- <div x-data="{ show: @json(session()->has('success')) }"
    x-show="show"
    x-transition
    x-init="Livewire.on('itemAdded', () => { show = true; setTimeout(() => show = false, 3000) })"
    class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
    ✅ {{ session('success') }}
</div> --}}



<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto scroll-visible">
  <!-- Grid -->
  <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
    
    @forelse($products as $product)
      <div wire:key="product-{{ $product->id }}" class="group flex flex-col border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-none focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-4 dark:border-neutral-700 dark:hover:border-transparent dark:hover:shadow-black/40 dark:focus:border-transparent dark:focus:shadow-black/40">
        <p class="text-xs text-green-500 dark:text-green-400 mb-2">
          {{ $product->prod_sku }}
        </p>
      
      
        <div class="aspect-w-16 aspect-h-11">
         <a href="{{route ('page.singleProd',['prod_slug' => $product->prod_slug]) }}">
       
         {{-- images, route for product description and reviews --}}
         
         {{-- <img class="w-full h-[180px] md:h-[200px] lg:h-[250px] object-cover rounded-b-xl" src="{{ asset(Storage::url($product->images[0]->url)) }}" alt="{{ $product->prod_slug }}"> --}}
         @php
         $primary_image = $product->images->where('is_primary', true)->first() ?? $product->images->first();
        
         @endphp
        {{-- note display the image if ang is_primary is true else default image which is wla pa --}}
         <img class="w-full h-[180px] md:h-[200px] lg:h-[250px] object-cover rounded-xl" 
              src="{{ $primary_image ? asset(Storage::url($primary_image->url)) : asset('default-image.jpg') }}" 
              alt="{{ $product->prod_slug }}">
        </a>
        </div>
        <div class="flex flex-col flex-grow mt-4">
          <h5 class="text-md  text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">{{ ucwords($product->prod_name)}} {{ ($product->prod_unit == 'kg' ? ' - ' .$product->prod_weight . 'kg' : '')}}</h5>
          <p class="mt-5 text-gray-600 dark:text-neutral-400"></p>
          <div class="flex flex-wrap items-center justify-between gap-x-4 overflow-hidden max-w-full">
            <p class="text-md font-semibold text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">
              Status: 
              <span class="{{ $product->prod_quantity > 10 ? 'text-green-500 dark:text-green-400 text-xs' : 'text-red-500 dark:text-red-400 text-xs' }}">
                {{ $product->prod_quantity > 10 ? 'In Stock' : 'Low in Stock ' . ($product->prod_unit == 'kg' ? (float) $product->prod_quantity . 'kg left' :  (int) $product->prod_quantity . ' left') }}
            </span>
            </p>
            <p class="text-md font-semibold text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">
              @if(!empty($product->prod_old_price) && $product->prod_old_price > $product->prod_price)
                <del class="text-gray-500 dark:text-neutral-400">₱{{ number_format($product->prod_old_price, 2) }}</del>
             @endif
              ₱{{ number_format($product->prod_price, 2) }}
              @if($product->prod_unit == 'kg')
                <span class="text-xs font-normal  ">per kilo</span>
              @endif
            </p>
          </div>
          
        </div>
        <div class="mt-auto flex items-center gap-x-3">

          
          
    
            <div class="mt-auto ">
              <livewire:ecommerce.add-to-cart-form :product_id="$product->id" wire:key="add-to-cart-{{ $product->id }}" />
               
            </div>
    
           
           
        
           
        </div>
      </div>
    @empty
      <div class="col-span-full text-center py-10">
          <p class="text-gray-500 dark:text-neutral-400 text-lg">No products available.</p>
      </div>
    @endforelse
  </div>
</div>

  
 

</div>

































