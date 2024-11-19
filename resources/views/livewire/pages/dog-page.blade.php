
<div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto lg:my-12">
    <div class="grid lg:grid-cols-6 gap-y-8 lg:gap-y-0 lg:gap-x-3">
        <!-- Sidebar -->
        <div class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
            <div class="sticky top-0 py-8 start-0 lg:ps-8">
                <a href="{{ route('page.dogs') }}">
                    <h4 class="mb-6 text-xl font-semibold dark:text-white">
                        {{ __('Breeds') }}
                    </h4>
                </a>

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
                <div class="space-y-5 lg:space-y-8">
                    <!-- Card Blog -->
                    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
                        <!-- Grid -->
                        <div class="grid gap-6 lg:grid-cols-2">
                            @foreach ($dogs as $dog )
                                <x-dog-page.dog-card :$dog/>
                            @endforeach
                        </div>
                        <!-- End Grid -->
                    </div>
                    <!-- End Card Blog -->

                    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto mt-16 py-6">
                        {{-- {{ $dogs->links() }} --}}
                        {{ $dogs->links('vendor.pagination.dog-pagination') }}
                    </div>

                </div>
            </div>
        </div>
        <!-- End Content -->


    </div>
</div>

