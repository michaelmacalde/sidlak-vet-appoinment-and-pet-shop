<div>
    <button type="button" 
    class="relative inline-flex items-center gap-x-2 text-sm font-medium rounded-lg focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-offcanvas-custom-backdrop-color"
    data-hs-overlay="#hs-offcanvas-custom-backdrop-color">

    <!-- Cart Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="font-medium text-amber-400 dark:text-neutral-400 dark:hover:text-neutral-500 hover:text-gray-400">
        <circle cx="8" cy="21" r="1"></circle>
        <circle cx="19" cy="21" r="1"></circle>
        <path d="M2.5 2.5h2.9l3.8 11.4a2 2 0 0 0 1.9 1.4h7.5a2 2 0 0 0 1.9-1.4L22 6.5H6"></path>
    </svg>

    <!-- Cart Count -->
    @if($this->cartCount > 0)
        <span class="absolute -top-1 -right-2 px-1.5 py-0.5 text-[10px] font-bold 
        text-black dark:text-white bg-white-500 border border-white dark:border-gray-800 
        rounded-full shadow-md"
        wire:poll.100ms>
        {{ $this->cartCount }}
        </span>
    
    @endif

</button>
</div>
