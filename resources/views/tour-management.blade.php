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
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Tour Management</p>
    <span class="block text-orange text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Tour Management</span>
    <div class="w-full grid grid-cols-1 womsm:grid-cols-2 items-center justify-between">
        <form action="/tour-management" method="GET" class="w-full flex">
            <input type="text" value="{{ $search }}" placeholder="Eg: Hard Enduro Tours" name="search" class="mt-3 w-[59%] mr-3 rounded-md text-black">
            <button class="wommd:ml-5 max-w-[218px] mt-2 btn-orange font-bold">Search Your Tours</button>
        </form>
        <span class="justify-self-end bg-slate-100 p-3 max-w-44 border border-orange-500 rounded-md font-semibold text-orange"><a href="/tours/create">+ Add a new tour</a></span>
    </div>
    
    <div class="flex mt-8 mb-14">
        <a href="/tour-management"><span class="cursor-pointer text-center bg-parrot active-management-option management-option px-6 py-2">Live</span></a>
        <a href="/draft-tour-management"><span class="cursor-pointer text-center ml-4 management-option px-6 py-2">Draft</span></a>
        <a href="/hidden-tour-management"><span class="cursor-pointer text-center ml-4 management-option px-6 py-2">Hidden</span></a>
        <a href="/deleted-tour-management"><span class="cursor-pointer text-center ml-4 management-option px-6 py-2">Deleted</span></a>
    </div>
    <div class="w-full">
        {{-- a full width div with bg-parrot class and Live text with bold in it --}}
        <div class="bg-parrot text-white text-center text-xl font-bold py-4">
            <span class="text-lg uppercase">Live Tours</span>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="tours-container">
        @foreach ($tours as $tour)
            @if ($tour->status === 'published')
                <div class="tour-info rounded-3xl">
                    <a href='/tour/{{ $tour->id }}' target="_blank">
                        <p class="py-2 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">{{ $tour->title }}</p>
                    </a>
                    <div class="tour-details grid grid-cols-1 womsm:grid-cols-4">
                        <div class="h-[80px] womsm:h-auto">
                            <a href='/tour/{{ $tour->id }}' target="_blank">
                                {{-- <img class="aspect-square rounded-t-lg womsm:rounded-tr-none womsm:rounded-l-lg object-cover h-full w-full"
                                    src="https://worldonmoto.com/storage/uploads/1732685873_2.jpg"
                                    alt="Tour photo"> --}}
                                <img class="aspect-square rounded-t-lg womsm:rounded-tr-none womsm:rounded-l-lg object-cover h-full w-full"
                                    src="{{ isset($tour->images) && isset($tour->images[0]->image_path) ? asset('storage') . '/' . $tour->images[0]->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                    alt="Tour photo">
                            </a>
                        </div>
                        <div class="tour-description womsm:col-span-3 grid grid-cols-2 wommd:grid-cols-3 relative">
                            <div class="wommd:col-span-2">
                                <div class="badges mt-5 flex flex-wrap items-center">
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/tower.svg' }}" alt="">
                                        <span>{{ $tour->rider_capability }}</span>
                                    </span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/indicator.svg' }}" alt="">
                                        <span>{{ $tour->riding_style }}</span>
                                    </span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/hourglass.svg' }}" alt="">
                                        <span>{{ $tour->duration_days }} days</span>
                                    </span>
                                    @if ($tour->prices->count() > 0)
                                        <span class="edit-badge">
                                            <img src="{{ asset('images') . '/cal.svg' }}" alt="">
                                            <span>{{ $tour->prices[0]->date . ($tour->prices->count() > 1 ? ' (+' . ($tour->prices->count() - 1) . ' more)' : '') }}</span>
                                        </span>
                                    @endif
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/earth.svg' }}" alt="">
                                        <span>{{ $tour->countries }}</span></span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/people.svg' }}" alt="">
                                        <span>{{ $tour->max_riders }}
                                            Riders & {{ $tour->guides }} Guides</span></span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/bike.svg' }}" alt="">
                                        <span>{{ \Illuminate\Support\Str::limit($tour->riding_style_info, $limit = 15, $end = '...') }}</span></span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/helmet.svg' }}" alt="">
                                        <span>{{ $tour->bike_option }}</span></span>
                                </div>
                            </div>
                            <ul class="tour-stats text-black" style="font-size: 14px !important; list-style: none;">
                                <li class="flex justify-between"><span class="font-medium">Number of clicks:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Unanswered questions:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Number of people saved:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Number of Reviews:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Tour Ratings:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Bookings:</strong></span><span class="font-semibold">N/A</span></li>
                            </ul>
                            <div class="relative col-span-2 flex items-center justify-start font-semibold bottom-0 w-full mt-2">
                                <div class="flex items-center gap-2">
                                    <a href='/tours/create?activeStep=0&tour_id={{ $tour->id }}' class="edit-button text-xs wommd:text-sm">Edit</a>
                                    <a href='/bookings' class="edit-button text-xs wommd:text-sm">Bookings</a>
                                    <a href='/tour/{{ $tour->id }}' target="_blank" class="edit-button text-xs wommd:text-sm">View</a>
                                    <a class="gray-button text-xs wommd:text-sm">Hide</a>
                                    <a 
                                        href='/tours/delete/{{ $tour->id }}'
                                        onclick="return confirm('Are you sure you want to delete this tour?')"
                                        class="delete-button text-xs wommd:text-sm">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</main>

<!-- Filter Modal -->
<div id="filterModal" class="absolute inset-0 backdrop-blur-sm z-50 hidden" style="background: #ffffff70;">
    <div class="bg-white rounded-lg py-4 px-2 wommd:p-8 womsm:max-w-[80%] wommd:max-w-[75%] womsm:mx-auto womsm:mt-20 relative" style="box-shadow: 0 0 10px 0px gray;">
        <svg onclick="closeFilterModal()"
            class="cursor-pointer absolute m-4 top-4 right-4 text-gray-500 hover:text-gray-700 w-6 h-6" width="32"
            height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
            <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
        </svg>


        <h2 class="text-base womsm:text-xl wommd:text-2xl font-semibold ml-5 wommd:ml-0 mt-4 mb-6 text-black text-left wommd:text-center">Edit Filters</h2>

        <div class="w-full justify-items-center">
            <form id="filterForm" class="w-full womsm:w-5/6 wommd:w-3/4 space-y-6 px-4">
                <table class="w-full">
                    <!-- Countries -->
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">Countries</label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
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
                        </div>
                    </div>

                    <!-- Minimum Touring Days -->
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Minimum Touring Days
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <div class="flex items-center mb-2">
                                <input type="number" name="min_days" min="1"
                                    class="w-full womsm:w-2/4 rounded-md border-gray-300 shadow-sm">
                                <span class="ml-2 text-sm text-black font-medium">days</span>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">How long do you want the tour to be?
                                Type
                                the least amount of days you want tour for.
                                If you type “5” you will get tours that are five days or longer.
                            </span>
                        </div>
                    </div>
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Maximum tour price
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <div class="grid grid-cols-1 womsm:grid-cols-4 items-center mb-2 text-black font-medium text-sm">
                                <input type="number" name="max_price" min="1"
                                    class="w-full rounded-md mb-3 womsm:mb-1 border-gray-300 shadow-sm">
                                <div class="flex">
                                    <span class="womsm:ml-5 flex items-center">
                                        <input type="radio" name="currency"><span class="ml-1">EUR</span>
                                    </span>
                                    <span class="ml-4 flex items-center">
                                        <input type="radio" name="currency"><span class="ml-1">USD</span>
                                    </span>
                                    <span class="ml-4 flex items-center">
                                        <input type="radio" name="currency"><span class="ml-1">GBP</span>
                                    </span>
                                </div>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                What’s the maximum you want to spend on the tour? You can also select the currency. We will convert accordingly. EUR - Euro, USD - US dollor, GBP - UK Sterling
                            </span>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Show tours starting after
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <div class="flex items-center mb-2">
                                <input type="date" name="start" class="w-2/4 rounded-md border-gray-300 shadow-sm">
                                <span class="ml-2 text-sm text-black font-medium">days</span>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                Select the date that you want tours to be starting from or after. We will show you tours that start after the date you select.
                            </span>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Tour type
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Select the type of tour you want to do. You can select multiple options. You need to select at least one.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="road" class="mr-2">
                                    <span class="text-sm font-medium text-black">Road</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">All on the road; black
                                        top</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="adventure" class="mr-2">
                                    <span class="text-sm font-medium text-black">Adventure</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">Off and on road; dirt and
                                        road</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="enduro" class="mr-2">
                                    <span class="text-sm font-medium text-black">Enduro</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">Almost always off-road</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Tour level
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Most tours are marked as for beginners, intermediate and/or expert riders. You can select accordingly here.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_level[]" value="Beginner" class="mr-2">
                                    <span class="font-medium text-sm text-black">Beginner</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">you need support/advice from other riders</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_level[]" value="Intermediate" class="mr-2">
                                    <span class="font-medium text-sm text-black">Intermediate</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">capable most of the time need almost no help</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_level[]" value="Expert" class="mr-2">
                                    <span class="font-medium text-sm text-black">Expert</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">can help other riders and always in control</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Bike options
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Select if you are looking for tours that will rent you the bike or tours where you can bring your own bike. You can select both if you like.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="bike_options[]" value="own_bike" class="mr-2">
                                    <span class="font-medium text-black text-sm">Bring my own bike</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="bike_options[]" value="rental_included" class="mr-2">
                                    <span class="font-medium text-black text-sm">Bike rental or included</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Riding gear options
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                Select if you are looking for tours that will rent riding gear or tours where you can bring your own riding gear. You can select both if you like.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="riding_gear[]" value="0" class="mr-2">
                                    <span class="font-medium text-black text-sm">Bring my own riding gear</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="riding_gear[]" value="1" class="mr-2">
                                    <span class="font-medium text-black text-sm">Riding gear rental or included</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Two-up riding
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Select if you looking for trips that allows riding with a pillion passenger, or not or both.
                            </span>
                            <div class="space-y-2  mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="two_riding[]" value="yes" class="mr-2">
                                    <span class="text-sm font-medium text-black">Show trips that allow two-up riding on a bike</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="two_riding[]" value="no" class="mr-2">
                                    <span class="text-sm font-medium text-black">Show trips that allow a single rider per bike</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-evenly space-x-4">
                        <button type="submit"
                            class="womsm:px-4 womsm:py-2 bg-green text-white rounded-md hover:bg-dark-green primary-button">
                            Show Trips
                        </button>
                        <button type="button" onclick="closeFilterModal()"
                            class="womsm:px-4 womsm:py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 primary-button">
                            Close
                        </button>
                        <button type="button" onclick="clearFilters()"
                            class="womsm:px-4 womsm:py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 primary-button">
                            Reset to default
                        </button>
                    </div>
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

        const urlParams = new URLSearchParams(window.location.search);

        const countries = urlParams.getAll('countries[]'); // Array of selected countries
        const minDays = urlParams.get('min_days'); // Minimum days
        const maxPrice = urlParams.get('max_price'); // Maximum price
        const start = urlParams.get('start'); // Start date
        const tourType = urlParams.getAll('tour_type[]'); // Array of tour types
        const tourLevel = urlParams.getAll('tour_level[]'); // Array of tour levels
        const bikeOptions = urlParams.getAll('bike_options[]'); // Array of bike options
        const ridingGear = urlParams.getAll('riding_gear[]'); // Array of bike options
        const twoRiding = urlParams.getAll('two_riding[]'); // Array for two-riding preference
        $.ajax({
            type: "GET",
            url: "/explore-tours",
            data: {
                page: page + 1,
                countries: countries,
                minDays: minDays,
                maxPrice: maxPrice,
                start: start,
                tourType: tourType,
                tourLevel: tourLevel,
                bikeOptions: bikeOptions,
                twoRiding: twoRiding,
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
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() + $(window).height() > $(document).height() - 350) {
    //         loadMoreTours();
    //     }
    // });

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
        $("#countries").val(null).trigger("change");
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
        const urlParams = new URLSearchParams(window.location.search);

        // Populate select (multi-select) fields
        const countries = urlParams.getAll("countries[]");
        if (countries.length > 0) {
            $("#countries").val(countries).trigger("change"); // Update Select2
        }

        // Populate text/number/date inputs
        const fieldMappings = {
            "min_days": "min_days",
            "start": "start",
            "max_price": "max_price"
        };
        
        for (const param in fieldMappings) {
            const value = urlParams.get(param);
            if (value) {
                document.querySelector(`input[name="${fieldMappings[param]}"]`).value = value;
            }
        }

        // Populate checkboxes (multi-value parameters)
        const multiValueParams = ["tour_type", "tour_level", "bike_options", "riding_gear", "two_riding"];
        
        multiValueParams.forEach(param => {
            const values = urlParams.getAll(`${param}[]`);
            if (values.length > 0) {
                document.querySelectorAll(`input[name="${param}[]"]`).forEach(checkbox => {
                    if (values.includes(checkbox.value)) {
                        checkbox.checked = true;
                    }
                });
            }
        });
    });

    // Handle form submission
    // $('#filterForm').on('submit', function(e) {
    //     const formData = new FormData(this);
    //     console.log('formData', formData);
        
    //     e.preventDefault();

    //     // Show loading state
    //     $('#loading').removeClass('hidden');

    //     $.ajax({
    //         url: '/explore-tours',
    //         type: 'GET',
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         success: function(response) {
    //             $('#tours-container').html(''); // Clear existing tours
    //             response.tours.forEach(tour => {
    //                 $('#tours-container').append(tour.html);
    //             });
    //             closeFilterModal();
    //             page = 1; // Reset pagination
    //             hasMoreData = true; // Reset infinite scroll
    //         },
    //         error: function(error) {
    //             console.error('Error applying filters:', error);
    //         },
    //         complete: function() {
    //             $('#loading').addClass('hidden');
    //         }
    //     });
    // });

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
