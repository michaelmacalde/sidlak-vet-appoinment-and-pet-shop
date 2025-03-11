<div>
  {{-- The best athlete wants his opponent at his best. --}}

  {{-- @if(session()->has('message') || session()->has('error_message'))
    <div class="p-2 mb-4 {{ session()->has('message') ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
        {{ session('message') ?? session('error_message') }}
    </div>
  @endif --}}

  {{-- <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-lg focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-offcanvas-custom-backdrop-color" data-hs-overlay="#hs-offcanvas-custom-backdrop-color">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="font-medium text-amber-400 dark:text-neutral-400 dark:hover:text-neutral-500 hover:text-gray-400">
        <circle cx="8" cy="21" r="1"></circle>
        <circle cx="19" cy="21" r="1"></circle>
        <path d="M2.5 2.5h2.9l3.8 11.4a2 2 0 0 0 1.9 1.4h7.5a2 2 0 0 0 1.9-1.4L22 6.5H6"></path>
    </svg>
</button> --}}

<div id="hs-offcanvas-custom-backdrop-color" class="hs-overlay hs-overlay-open:translate-x-0 hs-overlay-backdrop-open:bg-black/50 dark:hs-overlay-backdrop-open:bg-black/30 hidden -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs w-full z-[80] bg-white border-e dark:bg-neutral-800 dark:border-neutral-700" role="dialog" tabindex="-1" aria-labelledby="hs-offcanvas-custom-backdrop-color-label"  wire:ignore.self>
    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
        <h3 id="hs-offcanvas-custom-backdrop-color-label" class="font-bold text-gray-800 dark:text-white">
            Shopping Cart
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-offcanvas-custom-backdrop-color">
            <span class="sr-only">Close</span>
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
    </div>
    {{-- wire:loading.remove --}}
     <div class="p-4" > 
        <p class="text-gray-800 dark:text-neutral-400">
          <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    @if(session()->has('message') || session()->has('error_message'))
                    <div class="p-2 mb-4 {{ session()->has('message') ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                        {{ session('message') ?? session('error_message') }}
                    </div>
                   @endif
                      <thead>
                        <tr>
                          <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                            <input type="checkbox" wire:model="selectAll" wire:click="toggleSelectAll">
                          </th>
                          <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">Product Name</th>
                          <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">Image</th>
                          <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">Total Price</th>
                          <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">Quantity</th>
                        </tr>
                      </thead>
                  
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                      @forelse ($carts as $cart)
                        
                      {{-- wire:key="cart-{{ $cart->id }} --}}
                      <tr >
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                          <input type="checkbox" wire:model="selectedItems" value="{{ $cart->id }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ ucwords($cart->product->prod_name) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200"> <img class="w-[30px] h-[30px] object-cover rounded-full" src="{{ asset(Storage::url($cart->product->images[0]->url)) }}" alt="{{$cart->product->prod_slug}}"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{number_format($cart->quantity * $cart->product->prod_price,2)}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                          {{-- decrease quantity --}}
                        
                          <!-- Show Loader When Loading -->
                        <span wire:loading wire:target="decreaseQuantity({{ $cart->id }})">
                          <svg class="animate-spin h-5 w-5 text-gray-500 dark:text-white" 
                              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" 
                                  stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                          </svg>
                      </span>
                    

                        <button 
                          type="button" 
                          wire:click="decreaseQuantity({{ $cart->id }})"
                          wire:loading.attr="disabled"
                           
                          class="px-3 py-1 text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                          -
                        </button>
                  
                      <!-- Quantity -->
                      <span  class="text-lg font-semibold text-gray-900 dark:text-white  ">
                          {{ $cart->quantity }}
                      </span>
                  
                      <!-- Increase Quantity  -->

                             <!-- Show Loader When Loading -->
                         <span wire:loading wire:target="increaseQuantity({{ $cart->id }})">
                            <svg class="animate-spin h-5 w-5 text-gray-500 dark:text-white" 
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" 
                                      stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </span>

                      <button 
                          type="button" 
                          wire:click="increaseQuantity({{ $cart->id }})" 
                        
                          wire:loading.attr="disabled"
                          class="px-3 py-1 text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                          +
                      </button>
                        </td>
                      </tr>
          
                      @empty
                      <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500 dark:text-neutral-400 text-lg">
                            Cart is Empty.
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </p>
        <div class="mt-4 flex gap-3">
          {{-- <button wire:click="checkoutSelected" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Checkout Selected</button> --}}
          <button wire:click="removeSelected" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Remove Selected</button>
          @livewire('Ecommerce.checkout-btn')
        </div>
    </div>
</div>


  
</div>
