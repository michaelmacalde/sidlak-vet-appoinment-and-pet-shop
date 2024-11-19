
<div>
    <div class="w-full mt-5 lg:mt-8">
        <!-- SearchBox -->
        <div class="relative">
          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
              <svg class="flex-shrink-0 text-gray-400 size-4 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
              </svg>
            </div>
            <input wire:model.live="query"  class="block w-full py-3 text-sm border-gray-200 rounded-lg ps-10 pe-4 focus:border-amber-400 focus:ring-amber-400 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" type="text" placeholder="Search available dog for adoption" value="" data-hs-combo-box-input="">
          </div>
          @if(!empty($query))
          <!-- SearchBox Dropdown -->
          <div class="absolute z-50 w-full bg-gray-100 rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.05)] dark:bg-neutral-900" data-hs-combo-box-output="gh">
            <div class="max-h-[500px] p-2 overflow-y-auto overflow-hidden [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500" data-hs-combo-box-output-items-wrapper="ghgh">

            @if(count($dogs) > 0)
                @foreach($dogs as $dog)
                <a class="flex items-center px-3 py-2 rounded-lg gap-x-3 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="{{ route('page.dog.single', $dog->dog_slug) }}">

                    <div class="flex items-center justify-center rounded-full bg-center object-cover bg-gray-200 size-6 overflow-hidden me-2.5">
                        <img class="object-cover" src="{{ asset(Storage::url($dog->dog_image[0]['dog_image'])) }}" alt="{{ $dog->name }}" />
                    </div>

                    <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Compose an email" data-hs-combo-box-value="{{ $dog->breed->dog_name }}">{{ $dog->dog_name }} ({{ $dog->breed->breed_name }})</span>
                    <span class="text-xs text-gray-400 ms-auto dark:text-neutral-500" data-hs-combo-box-search-text="Gmail" data-hs-combo-box-value="{{ $dog->status }}">{{ $dog->status }}</span>
                </a>
                @endforeach
            @endif

            </div>
          </div>
          @endif
          <!-- End SearchBox Dropdown -->
        </div>
        <!-- End SearchBox -->
    </div>
</div>
