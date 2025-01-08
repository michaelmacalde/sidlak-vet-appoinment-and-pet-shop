@php
    $statusConfig = [
        'pending' => [
            'bg_class' => 'bg-orange-100 text-orange-800 rounded-full dark:bg-orange-500/10 dark:text-orange-500',
            'icon' => '<svg class="size-4" width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
        ],
        'approved' => [
            'bg_class' => 'bg-green-100 text-green-800 rounded-full dark:bg-green-500/10 dark:text-green-500',
            'icon' => '<svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>',
        ],
        'rejected' => [
            'bg_class' => 'bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500',
            'icon' => '<svg class="size-4" width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
        ],
    ];

@endphp

<div class="flex flex-col">

    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700">
          <!-- Header -->
            <div class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
              <!-- Input -->
              <div class="sm:col-span-1">
                <label for="hs-as-table-product-review-search" class="sr-only">Search</label>
                <div class="relative">
                  <input type="text" id="hs-as-table-product-review-search" name="hs-as-table-product-review-search" class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg ps-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Search">
                  <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4">
                    <svg class="text-gray-400 shrink-0 size-4 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                  </div>
                </div>
              </div>
              <!-- End Input -->

              <div class="sm:col-span-2 md:grow">
                <div class="flex justify-end gap-x-2">
                  <div class="hs-dropdown [--placement:bottom-right] relative inline-block">

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-48 z-10 bg-white shadow-md rounded-lg p-2 mt-2 dark:divide-neutral-700 dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-as-table-table-export-dropdown">
                      <div class="py-2 first:pt-0 last:pb-0">
                        <span class="block px-3 py-2 text-xs font-medium text-gray-400 uppercase dark:text-neutral-600">
                          Options
                        </span>
                        <a class="flex items-center px-3 py-2 text-sm text-gray-800 rounded-lg gap-x-3 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300" href="#">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg>
                          Copy
                        </a>
                        <a class="flex items-center px-3 py-2 text-sm text-gray-800 rounded-lg gap-x-3 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300" href="#">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                          Print
                        </a>
                      </div>
                      <div class="py-2 first:pt-0 last:pb-0">
                        <span class="block px-3 py-2 text-xs font-medium text-gray-400 uppercase dark:text-neutral-600">
                          Download options
                        </span>
                        <a class="flex items-center px-3 py-2 text-sm text-gray-800 rounded-lg gap-x-3 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300" href="#">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                          </svg>
                          Excel
                        </a>
                        <a class="flex items-center px-3 py-2 text-sm text-gray-800 rounded-lg gap-x-3 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300" href="#">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z"/>
                          </svg>
                          .CSV
                        </a>
                        <a class="flex items-center px-3 py-2 text-sm text-gray-800 rounded-lg gap-x-3 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300" href="#">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                          </svg>
                          .PDF
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="hs-dropdown [--placement:bottom-right] relative inline-block" data-hs-dropdown-auto-close="inside">
                    <button id="hs-as-table-table-filter-dropdown" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                      <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M7 12h10"/><path d="M10 18h4"/></svg>
                      Filter
                      <span class="text-xs font-semibold text-blue-600 border-gray-200 ps-2 border-s dark:border-neutral-700 dark:text-blue-500">
                        1
                      </span>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-48 z-10 bg-white shadow-md rounded-lg mt-2 dark:divide-neutral-700 dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-as-table-table-filter-dropdown">
                      <div class="divide-y divide-gray-200 dark:divide-neutral-700">
                        <label for="hs-as-filters-dropdown-all" class="flex py-2.5 px-3">
                          <input type="checkbox" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-as-filters-dropdown-all" checked>
                          <span class="text-sm text-gray-800 ms-3 dark:text-neutral-200">All</span>
                        </label>
                        <label for="hs-as-filters-dropdown-published" class="flex py-2.5 px-3">
                          <input type="checkbox" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-as-filters-dropdown-published">
                          <span class="text-sm text-gray-800 ms-3 dark:text-neutral-200">Published</span>
                        </label>
                        <label for="hs-as-filters-dropdown-pending" class="flex py-2.5 px-3">
                          <input type="checkbox" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-as-filters-dropdown-pending">
                          <span class="text-sm text-gray-800 ms-3 dark:text-neutral-200">Pending</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-800">
              <tr>
                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                      Adoption #
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                      Dog Name
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                      Date
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                      Status
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-end"></th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                @forelse ($adoptionRequests as $key => $adoptionRequest)
                    @php
                        $currentStatus = $adoptionRequest->status;
                    @endphp
                    <tr wire:key="adoptionRequest-{{ $adoptionRequest->id}}" class="bg-white hover:bg-gray-50 dark:bg-neutral-900 dark:hover:bg-neutral-800">
                        <td class="align-top size-px whitespace-nowrap">
                         <span class="block p-6 text-sm text-gray-600 dark:text-neutral-400">{{$adoptionRequest->adoption_number}}</span>
                        </td>

                        <td class="align-top size-px whitespace-nowrap">
                            <a type="button" class="block p-6" wire:key='{{ $adoptionRequest->id }}' wire:click.prevent="viewRequest({{ $adoptionRequest->id }})">
                                <div class="flex items-center gap-x-3">
                                <img class="inline-block size-[38px] rounded-full  object-cover" src="{{ asset(Storage::url($adoptionRequest->dog->dog_image[0]['dog_image'])) }}" alt="{{ $adoptionRequest->dog->dog_name }}">
                                <div class="grow">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $adoptionRequest->dog->dog_name }}</span>
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">{{ $adoptionRequest->dog->breed->breed_name }}</span>
                                </div>
                                </div>
                            </a>
                        </td>

                        <td class="align-top size-px whitespace-nowrap">
                        <a class="block p-6" href="#">
                            <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $adoptionRequest->created_at->diffForHumans() }}</span>
                        </a>
                        </td>

                        <td class="align-top size-px whitespace-nowrap">
                            <a class="block p-6" href="#">
                                <span class="py-2 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium {{ $statusConfig[$currentStatus]['bg_class'] }}">
                                    {!! $statusConfig[$currentStatus]['icon'] !!}
                                    {{ Str::upper($currentStatus) }}
                                </span>
                                {{-- <span class="py-2 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium
                                    @if($adoptionRequest->status == 'pending')
                                        bg-orange-100 text-orange-800 rounded-full dark:bg-orange-500/10 dark:text-orange-500
                                    @elseif($adoptionRequest->status == 'approved')
                                        bg-green-100 text-green-800 rounded-full dark:bg-green-500/10 dark:text-green-500
                                    @elseif($adoptionRequest->status == 'rejected')
                                        bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500
                                    @endif

                                ">

                                    @if($adoptionRequest->status == 'pending')
                                        <svg class="size-4" width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        {{ Str::upper($adoptionRequest->status) }}
                                    @endif

                                    @if($adoptionRequest->status == 'approved')
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                        {{ Str::upper($adoptionRequest->status) }}
                                    @endif

                                    @if($adoptionRequest->status == 'rejected')
                                        <svg class="size-4" width="16" height="16"  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                        {{ Str::upper($adoptionRequest->status) }}
                                    @endif
                                </span> --}}
                            </a>
                        </td>

                        <td class="size-px whitespace-nowrap">
                            <div class="flex flex-row items-center justify-content-between">

                                <button wire:key='{{ $adoptionRequest->id }}' wire:click.prevent="viewRequest({{ $adoptionRequest->id }})"  type="button" class="block" >
                                    <span class="px-6 py-1.5">
                                      <span class="inline-flex items-center justify-center gap-2 px-2 py-1 text-sm font-medium text-gray-700 align-middle transition-all bg-white border rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                          <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                                          <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        View
                                      </span>
                                    </span>
                                  </button>

                                  <button wire:click.prevent="removeAdoptionRequest({{ $adoptionRequest->id }})" type="submit" class="text-red-500 hover:text-red-700">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                      </svg>
                                  </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="flex items-center justify-center py-4">
                                <span class="text-gray-500 dark:text-gray-400">
                                    No adoption requests yet.
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforelse


            </tbody>
          </table>
          <!-- End Table -->

          <!-- Footer -->
          <div class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
            <div class="max-w-sm space-y-3">
              <select class="block px-3 py-2 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option selected>5</option>
                <option>6</option>
              </select>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Prev
                </button>

                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  Next
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
              </div>
            </div>
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>


    <x-modal id="view-modal" :maxWidth="'xxl'" wire:model="isModalOpen">
        <div class="w-full mx-auto text-center lg:mb-10">
            <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ 'Adoption Request' }}</h4>
            <p class="text-sm text-gray-600 dark:text-gray-200">Detailed information about the adoption request</p>
        </div>

        @if ($viewAdoptionRequest)
            <!-- Grid -->
            <div class="grid gap-5 md:grid-cols-3">

                <div>
                    @if ($viewAdoptionRequest->dog)
                        <img class="inline-block w-auto h-[15rem] rounded-lg object-cover"
                             src="{{ asset(Storage::url($viewAdoptionRequest->dog->dog_image[0]['dog_image'] ?? 'default.jpg')) }}"
                             alt="{{ $viewAdoptionRequest->dog->dog_name ?? 'No name available' }}">
                    @else
                        <p class="text-gray-500 dark:text-neutral-500">No dog information available.</p>
                    @endif
                </div>

                <div class="lg:col-span-2">
                    <div class="grid space-y-3">

                        <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Adoption # :
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-semibold">
                                    {{ $viewAdoptionRequest->adoption_number ?? 'No adoption number' }}
                                </span>
                            </dd>
                        </dl>

                        <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Dog name :
                            </dt>
                            <dd class="text-gray-800 dark:text-neutral-200">

                                <span class="inline-flex items-center px-4 py-2 text-green-800 bg-green-100 rounded-full gap-x-1 text-md font-lg dark:bg-green-500/10 dark:text-green-500">

                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 56 56"><path fill="currentColor" fill-rule="evenodd" d="M16.881 50.83c-.202-.014-.404-.025-.605-.043c-1.13-.106-2.167-.475-3.087-1.14c-1.587-1.15-2.602-2.679-3.006-4.602a8.149 8.149 0 0 1-.147-2.188a9.757 9.757 0 0 1 .498-2.521c.439-1.308 1.1-2.495 1.937-3.589A14.948 14.948 0 0 1 14.6 34.5a18.334 18.334 0 0 0 2.031-2.077c.788-.935 1.5-1.926 2.205-2.924c.622-.882 1.234-1.77 1.894-2.622a16.959 16.959 0 0 1 1.605-1.83c.73-.707 1.536-1.305 2.486-1.694a6.161 6.161 0 0 1 2.224-.462a9.855 9.855 0 0 1 2.579.273a7.418 7.418 0 0 1 3.387 1.867c.662.63 1.222 1.344 1.742 2.09c.553.792 1.06 1.613 1.583 2.424c.59.913 1.2 1.812 1.88 2.662a18.325 18.325 0 0 0 2.242 2.344a15.79 15.79 0 0 1 2.611 2.909a12.18 12.18 0 0 1 1.518 2.979a9.4 9.4 0 0 1 .504 2.556c.07 1.332-.16 2.606-.765 3.804c-.56 1.11-1.37 2.003-2.386 2.71c-.748.521-1.555.917-2.443 1.137a6.49 6.49 0 0 1-.957.167c-.045.004-.088.012-.132.02c-.042.023-.088.005-.133.01c-.037.006-.075-.01-.11.012h-.828c-.033-.023-.07-.007-.105-.011h-.175c-.706-.023-1.391-.17-2.075-.329c-1.157-.27-2.292-.625-3.444-.918a21.385 21.385 0 0 0-2.83-.538a13.409 13.409 0 0 0-1.992-.062c-.53.018-1.058.1-1.58.197c-1.03.194-2.039.47-3.049.746c-1.068.294-2.136.585-3.23.764c-.445.072-.89.134-1.343.13c-.093-.002-.185.012-.279.01c-.12-.007-.237.014-.355-.013m20.41-45.81c1.488.179 2.626.936 3.495 2.129c.595.818.97 1.736 1.202 2.717a9.8 9.8 0 0 1 .245 2.57a11.205 11.205 0 0 1-1.12 4.546a9.43 9.43 0 0 1-1.886 2.668c-.703.688-1.498 1.238-2.426 1.581c-.652.24-1.322.36-2.016.318c-1.202-.069-2.223-.547-3.08-1.381c-.732-.712-1.23-1.574-1.575-2.527a8.93 8.93 0 0 1-.47-2.057a9.994 9.994 0 0 1-.06-1.446c.035-1.138.24-2.246.61-3.322a10.273 10.273 0 0 1 1.709-3.147c.64-.794 1.387-1.466 2.283-1.962a5.63 5.63 0 0 1 2.112-.686c.023-.013.048-.007.071-.009h.071c.035-.004.071.012.102-.012h.488c.031.025.067.008.101.012h.072c.023 0 .048-.005.072.008M3.045 22.6c.023-.454.105-.9.224-1.339c.232-.853.61-1.63 1.2-2.295a4.33 4.33 0 0 1 2.448-1.418c.792-.156 1.574-.09 2.342.148c.884.272 1.665.736 2.36 1.34c1.078.935 1.852 2.086 2.387 3.402a8.815 8.815 0 0 1 .666 3.218a7.539 7.539 0 0 1-.226 2.023c-.227.885-.609 1.69-1.217 2.38a4.322 4.322 0 0 1-2.612 1.453c-.766.124-1.519.04-2.255-.198c-.99-.321-1.84-.873-2.588-1.588a8.66 8.66 0 0 1-1.76-2.402a9.25 9.25 0 0 1-.896-2.787c-.025-.173-.046-.346-.07-.518c-.018-.079-.01-.16-.03-.238c-.009-.033-.004-.064-.005-.098c-.006-.041.013-.086-.013-.127v-.634c.04-.058.02-.122.024-.184c.004-.046-.008-.095.021-.137m10.453-10.158c.005-1.258.184-2.391.605-3.483c.317-.825.753-1.579 1.36-2.228c.653-.702 1.429-1.204 2.365-1.441c.936-.238 1.856-.17 2.76.157c.797.29 1.492.745 2.11 1.32c.985.916 1.69 2.023 2.193 3.264c.32.788.54 1.604.665 2.445c.071.476.112.957.122 1.44a9.947 9.947 0 0 1-.128 1.817c-.209 1.256-.635 2.426-1.395 3.46a5.32 5.32 0 0 1-1.751 1.555a4.47 4.47 0 0 1-2.522.536c-.806-.061-1.55-.325-2.243-.736c-.904-.535-1.636-1.257-2.246-2.107a10.024 10.024 0 0 1-1.534-3.325a11.078 11.078 0 0 1-.332-2a6.138 6.138 0 0 1-.029-.674m39.5 10.895v.146c-.055 1.213-.38 2.354-.903 3.442a9.148 9.148 0 0 1-1.59 2.319c-.835.885-1.804 1.576-2.957 1.99a5.366 5.366 0 0 1-2.137.33a4.4 4.4 0 0 1-2.829-1.194c-.658-.612-1.091-1.364-1.365-2.21a6.832 6.832 0 0 1-.32-2.338c.054-1.752.607-3.344 1.567-4.801a8.613 8.613 0 0 1 1.112-1.366c.857-.854 1.837-1.51 2.998-1.883a5.277 5.277 0 0 1 2.025-.252a4.39 4.39 0 0 1 2.749 1.21c.696.657 1.136 1.468 1.401 2.38c.147.503.233 1.018.25 1.543v.147a9.116 9.116 0 0 0 0 .537"/></svg>
                                    {{ $viewAdoptionRequest->dog->dog_name ?? 'No name available' }}
                                </span>

                            </dd>
                        </dl>

                        <!-- Add other fields with null checks -->
                        <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Breed :
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-normal">
                                    {{ $viewAdoptionRequest->dog->breed->breed_name ?? 'No breed' }}
                                </span>
                                <address class="text-xs not-italic text-gray-500 font-xs dark:text-neutral-500">
                                    {{ Str::ucfirst($viewAdoptionRequest->dog->dog_size) ?? 'No address available' }}
                                </address>
                            </dd>
                        </dl>

                        <!-- Add other fields with null checks -->
                        <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Age :
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-semibold">
                                    {{ $viewAdoptionRequest->dog->dog_age ?? 'No age' }}
                                </span>
                            </dd>
                        </dl>

                        <!-- Add other fields with null checks -->
                        <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Status :
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-semibold">
                                    {{
                                        Str::upper($viewAdoptionRequest->status) ?? 'No status'
                                    }}
                                </span>
                            </dd>
                        </dl>


                    </div>
                </div>
                <!-- Additional columns -->
            </div>
            <!-- End Grid -->
            <div class="grid gap-5 md:grid-cols-3">


                {{-- <div>
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
                </div> --}}


            </div>

        @else
            <p class="text-gray-500 dark:text-neutral-500">No adoption request selected.</p>
        @endif
    </x-modal>

  </div>
