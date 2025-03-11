<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <x-button wire:click="checkout">
        Checkout
    </x-button>

    {{-- <a href="{{(!Auth::check() && Auth::id()) ? redirect->route('login') : ''}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-black transition border border-transparent gap-x-2 rounded-xl bg-amber-400 hover:bg-amber-500 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-amber-500 uppercase tracking-widest font-semibold justify-center py-3 mt:md-0 mt:lg-5">
        Checkout
    </a> --}}
</div>
