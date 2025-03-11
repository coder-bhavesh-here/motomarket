@include('new-header')
<style>
    td {
        border: unset;
    }

    .select2-container--default .select2-selection--multiple {
        border-color: #d1d5db;
        line-height: 1.5rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #1E293B !important;
        color: white !important;
        border: 1px solid white;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
    }

    .select2 select2-container select2-container--default {
        margin-bottom: 8px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover,
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
        background-color: #1E293B !important;
    }
</style>
<main class="mt-2 px-6">
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > Tour Search Results</p>
    <div class="grid grid-cols-1 wommd:grid-cols-2">
        <form action="/explore-tours" method="GET" class="grid grid-cols-1 wommd:grid-cols-2">
            <input type="text" value="{{ $search }}" name="search" class="mt-3 w-full rounded-md text-black">
            <button class="wommd:ml-5 wommd:w-1/2 mt-2 button-text text-base font-bold">Search for tours</button>
        </form>
        <div class="grid grid-cols-2 wommd:grid-cols-4">
            <div
                class="p-2 wommd:justify-self-end wommd:col-span-3 max-w-44 bg-[#F1F5F9] mt-2 flex items-center cursor-pointer rounded border border-[#556B2F]">
                <img src="{{ asset('images/save.png') }}" alt="">
                <span class="text-green underline font-bold text-sm ml-3">save this search</span>
            </div>
            <div class="mt-2 flex items-center cursor-pointer justify-self-end" onclick="openFilterModal()">
                <img src="{{ asset('images/filter.png') }}" alt="">
                <span class="text-green underline font-bold text-sm ml-3">Edit Filters</span>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="tours-container">
        @foreach ($tours as $tour)
            @if ($tour->status === 'published')
                <div class="tour-info rounded-3xl">
                    <div class="tour-details grid grid-cols-1 womsm:grid-cols-3">
                        <div class="h-[90px] womsm:h-auto">
                            <a href='/tour/{{ $tour->id }}'>
                                <img class="aspect-square rounded-t-lg womsm:rounded-tr-none womsm:rounded-l-lg object-cover h-full w-full"
                                    src="{{ isset($tour->images) && isset($tour->images[0]->image_path) ? asset('storage') . '/' . $tour->images[0]->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                    alt="Tour photo">
                            </a>
                        </div>
                        <div class="tour-description womsm:col-span-2">
                            <div class="inline-flex justify-center items-center my-3">
                                @php
                                    $profile_picture =
                                        $tour->user->tour_profile_picture != ''
                                            ? $tour->user->tour_profile_picture
                                            : ($tour->user->profile_picture != ''
                                                ? $tour->user->profile_picture
                                                : '');
                                    $tour_operation_name =
                                        $tour->user->tour_operation_name != ''
                                            ? $tour->user->tour_operation_name
                                            : ($tour->user->name != ''
                                                ? $tour->user->name
                                                : '');
                                @endphp
                                @if ($profile_picture != '')
                                    <img src="{{ asset('storage') . '/' . ($tour->user->tour_profile_picture != '' ? $tour->user->tour_profile_picture : $tour->user->profile_picture) }}"
                                        alt="Tour operator picture"
                                        style="width: 40px; height: 40ox; border-radius: 20px;">
                                @endif
                                <a href="#" class="underline">
                                    <span
                                        class="text-xl font-semibold text-black tour-owner ml-4">{{ $tour_operation_name }}</span>
                                </a>
                            </div>
                            <a href='/tour/{{ $tour->id }}'>
                                <p class="py-2 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">{{ $tour->title }}</p>
                            </a>
                            <p>
                                <a href='/tour/{{ $tour->id }}' class="text-sm womsm:text-base wommd:text-lg text-black font-normal">
                                    {{ Str::limit(strip_tags($tour->tour_description), 700) }}
                                </a>
                            </p>
                            <div class="badges mt-5 flex flex-wrap items-center">
                                <span class="badge">
                                    <img src="{{ asset('images') . '/tower.svg' }}" alt="">
                                    <span>{{ $tour->rider_capability }}</span>
                                </span>
                                <span class="badge">
                                    <img src="{{ asset('images') . '/indicator.svg' }}" alt="">
                                    <span>{{ $tour->riding_style }}</span>
                                </span>
                                <span class="badge">
                                    <img src="{{ asset('images') . '/hourglass.svg' }}" alt="">
                                    <span>{{ $tour->duration_days }} days</span>
                                </span>
                                @if ($tour->prices->count() > 0)
                                    <span class="badge">
                                        <img src="{{ asset('images') . '/cal.svg' }}" alt="">
                                        <span>{{ $tour->prices[0]->date . ($tour->prices->count() > 1 ? ' (+' . ($tour->prices->count() - 1) . ' more)' : '') }}</span>
                                    </span>
                                @endif
                                <span class="badge">
                                    <img src="{{ asset('images') . '/earth.svg' }}" alt="">
                                    <span>{{ $tour->countries }}</span></span>
                                <span class="badge">
                                    <img src="{{ asset('images') . '/people.svg' }}" alt="">
                                    <span>{{ $tour->max_riders }}
                                        Riders & {{ $tour->guides }} Guides</span></span>
                                <span class="badge">
                                    <img src="{{ asset('images') . '/bike.svg' }}" alt="">
                                    <span>{{ \Illuminate\Support\Str::limit($tour->riding_style_info, $limit = 15, $end = '...') }}</span></span>
                                <span class="badge">
                                    <img src="{{ asset('images') . '/helmet.svg' }}" alt="">
                                    <span>{{ $tour->bike_option }}</span></span>
                            </div>
                            <div class="flex items-center justify-between font-semibold">
                                <div class="left">
                                    @if ($tour->prices->count() > 0)
                                        <span
                                            class="text-lg womsm:text-xl wommd:text-2xl text-black">{{ '£' . number_format($tour->prices[0]->price, 0, '.', ',') }}</span>
                                    @endif
                                </div>
                                <div class="links flex items-center">
                                    <a href='/tour/{{ $tour->id }}' class="button-text">Tour Details</a>
                                    @if ($tour->is_favourite)
                                        <a class="unfavourite">
                                            <img style="height: 50px; width: 50px;"
                                                src="{{ asset('images') . '/heart-filled.svg' }}"
                                                data-id="{{ $tour->id }}">
                                        </a>
                                    @else
                                        <a class="favourite">
                                            <img style="height: 50px; width: 50px;"
                                                src="{{ asset('images') . '/heart-plain.svg' }}"
                                                data-id="{{ $tour->id }}">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="text-center">
        <button onclick="loadMoreTours();" class="button-text">Load More
        </button>
    </div>
    <div id="loading" class="text-center hidden mb-10">
        <div
            class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-green border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]">
        </div>
    </div>
</main>

<!-- Filter Modal -->
<div id="filterModal" class="fixed inset-0 backdrop-blur-sm z-50 hidden" style="background: #ffffff70;">
    <div class="bg-white rounded-lg p-8 max-w-[75%] mx-auto mt-20 relative" style="box-shadow: 0 0 10px 0px gray;">
        <svg onclick="closeFilterModal()"
            class="cursor-pointer absolute m-4 top-4 right-4 text-gray-500 hover:text-gray-700 w-6 h-6" width="32"
            height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
            <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
        </svg>


        <h2 class="text-4xl font-semibold mt-4 mb-6 text-black text-center">Edit Filters</h2>

        <div class="w-full justify-items-center">
            <form id="filterForm" class="w-3/4 space-y-6">
                <table class="w-full">
                    <!-- Countries -->
                    <tr>
                        <td class="pb-6" style="text-align: right !important;width: 30%;">
                            <label class="block text-xl font-medium text-gray-700"
                                style="margin-top: -15%;">Countries</label>
                        </td>
                        <td class="pb-6">
                            <select id="countries" name="countries[]" multiple
                                class="w-full rounded-md border-gray-300 shadow-sm select2">
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                Add all the countries you want to travel in. Leave it empty if you want to see featured
                                trips from around the world.
                            </span>
                        </td>
                    </tr>

                    <!-- Minimum Touring Days -->
                    <tr>
                        <td class="pb-6" style="text-align: right !important;width: 30%;">
                            <label class="block text-xl font-medium text-gray-700" style="margin-top: -15%;">Minimum
                                Touring Days</label>
                        </td>
                        <td class="pb-6">
                            <div class="flex items-center mb-2">
                                <input type="number" name="min_days" min="1"
                                    class="w-1/4 rounded-md border-gray-300 shadow-sm">
                                <span class="ml-2 text-sm text-black font-medium">days</span>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">How long do you want the tour to be?
                                Type
                                the least amount of days you want tour for.
                                If you type “5” you will get tours that are five days or longer.</span>
                        </td>
                    </tr>

                    <!-- Price Range -->
                    <tr>
                        <td class="pb-6" style="text-align: right !important;width: 30%;">
                            <label class="block text-xl font-medium text-gray-700" style="margin-top: -15%;">Maximum
                                tour price</label>
                        </td>
                        <td class="pb-6">
                            <div class="flex items-center mb-2 text-black font-medium text-sm">
                                <input type="number" name="min_days" min="1"
                                    class="w-1/4 rounded-md border-gray-300 shadow-sm">
                                <span class="ml-5 flex items-center">
                                    <input type="radio" name="max_price"><span class="ml-1">EUR</span>
                                </span>
                                <span class="ml-4 flex items-center">
                                    <input type="radio" name="max_price"><span class="ml-1">USD</span>
                                </span>
                                <span class="ml-4 flex items-center">
                                    <input type="radio" name="max_price"><span class="ml-1">GBP</span>
                                </span>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">What’s the maximum you want to spend
                                on the tour? You can also select the currency. We will convert accordingly. EUR - Euro,
                                USD - US dollor, GBP - UK Sterling</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="pb-6" style="text-align: right !important;width: 30%;">
                            <label class="block text-xl font-medium text-gray-700" style="margin-top: -15%;">Show
                                tours starting after</label>
                        </td>
                        <td class="pb-6">
                            <div class="flex items-center mb-2 text-black font-medium text-sm">
                                <input type="date" name="start"
                                    class="w-1/4 rounded-md border-gray-300 shadow-sm">
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">Select the date that you want tours
                                to be starting from or after. We will show you tours that start after the date you
                                select. </span>
                        </td>
                    </tr>


                    <!-- Tour Type -->
                    <tr>
                        <td class="pb-6" style="text-align: right !important;width: 30%;align-content: baseline;">
                            <label class="block text-xl font-medium text-gray-700">Tour
                                type</label>
                        </td>
                        <td class="pb-6">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">Select the type of tour you want to
                                do. You can select multiple options. You need to
                                select at least one.</span>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="road" class="mr-2">
                                    <span class="font-medium text-black">Road</span>
                                    <span class="font-normal ml-4 italic text-[#0F172A]">All on the road; black
                                        top</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="adventure" class="mr-2">
                                    <span class="font-medium text-black">Adventure</span>
                                    <span class="font-normal ml-4 italic text-[#0F172A]">Off and on road; dirt and
                                        road</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="enduro" class="mr-2">
                                    <span class="font-medium text-black">Enduro</span>
                                    <span class="font-normal ml-4 italic text-[#0F172A]">Almost always off-road</span>
                                </label>
                            </div>
                        </td>
                    </tr>

                    <!-- Buttons -->
                    <tr>
                        <td colspan="2" class="pt-6">
                            <div class="flex justify-end space-x-4">
                                <button type="button" onclick="clearFilters()"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                    Clear All
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-green text-white rounded-md hover:bg-dark-green">
                                    Apply Filters
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    let page = 1;
    let isLoading = false;
    let hasMoreData = true;

    function loadMoreTours() {
        if (isLoading || !hasMoreData) return;

        isLoading = true;
        $('#loading').removeClass('hidden');

        $.ajax({
            type: "GET",
            url: "/explore-tours",
            data: {
                page: page + 1,
                search: $('input[name="search"]').val()
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.tours.length > 0) {
                    response.tours.forEach(tour => {
                        // Append the tour HTML to the container
                        $('#tours-container').append(tour.html);
                    });
                    page++;
                } else {
                    hasMoreData = false;
                }
                isLoading = false;
                $('#loading').addClass('hidden');
            },
            error: function(error) {
                isLoading = false;
                $('#loading').addClass('hidden');
            }
        });
    }

    // Detect when user scrolls near bottom
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 350) {
            loadMoreTours();
        }
    });

    $(document).on("click", ".favourite", function(e) {
        e.preventDefault();
        const icon = $(this).find("img");
        const tourId = icon.attr("data-id");

        $.ajax({
            type: "POST",
            url: "/mark-as-favourite",
            data: {
                tour_id: tourId
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.message === "Tour marked as favourite.!") {
                    icon.attr("src", "{{ asset('images') . '/heart-filled.svg' }}");
                    $(e.currentTarget).removeClass("favourite").addClass("unfavourite");
                }
            },
            error: function(error) {
                window.location.href = "/login";
            }
        });
    });

    $(document).on("click", ".unfavourite", function(e) {
        e.preventDefault();
        const icon = $(this).find("img");
        const tourId = icon.attr("data-id");

        $.ajax({
            type: "POST",
            url: "/delete-favourite",
            data: {
                tour_id: tourId
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.message === "Tour removed from favourite.!") {
                    icon.attr("src", "{{ asset('images') . '/heart-plain.svg' }}");
                    $(e.currentTarget).removeClass("unfavourite").addClass("favourite");
                }
            },
            error: function(error) {
                window.location.href = "/login";
            }
        });
    });

    function openFilterModal() {
        document.getElementById('filterModal').classList.remove('hidden');
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
    }

    function clearFilters() {
        document.getElementById('filterForm').reset();
    }

    // Initialize select2 for multiple select
    $(document).ready(function() {
        $('#countries').select2({
            placeholder: 'Select countries',
            width: '100%',
            allowClear: true,
            dropdownParent: $('#filterModal') // This ensures the dropdown appears above the modal
        });
    });

    // Handle form submission
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        // Show loading state
        $('#loading').removeClass('hidden');

        $.ajax({
            url: '/explore-tours',
            type: 'GET',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#tours-container').html(''); // Clear existing tours
                response.tours.forEach(tour => {
                    $('#tours-container').append(tour.html);
                });
                closeFilterModal();
                page = 1; // Reset pagination
                hasMoreData = true; // Reset infinite scroll
            },
            error: function(error) {
                console.error('Error applying filters:', error);
            },
            complete: function() {
                $('#loading').addClass('hidden');
            }
        });
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('filterModal');
        if (event.target === modal) {
            closeFilterModal();
        }
    }
</script>
@include('footer')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
