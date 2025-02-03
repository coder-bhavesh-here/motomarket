@include('new-header')
<main class="px-28">
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > Tour Search Results</p>
    <form action="/explore-tours" method="GET">
        <input type="text" value="{{ $search }}" name="search" class="mt-5 w-1/4 rounded-md text-black">
        <button class="ml-5 button-text text-base font-bold">Search for tours</button>
    </form>
    <div class="mt-10 mb-20 flex items-center cursor-pointer" onclick="openFilterModal()">
        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M29.6104 1.51868H1.875L12.9691 16.1283V26.2284L18.5162 29.3171V16.1283L29.6104 1.51868Z"
                stroke="#556B2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="text-green underline font-bold text-sm ml-3">Edit Filters</span>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="tours-container">
        @foreach ($tours as $tour)
            @if ($tour->status === 'published')
                <div class="tour-info rounded-3xl">
                    <div class="tour-details inline-flex">
                        <a href='/tour/{{ $tour->id }}' style="width: 35%"><img
                                class="aspect-square object-cover h-full w-full"
                                src="{{ isset($tour->images) && isset($tour->images[0]->image_path) ? asset('storage') . '/' . $tour->images[0]->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                alt="Tour photo"></a>
                        <div class="tour-description">
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
                                <p class="py-2 text-3xl font-semibold text-black">{{ $tour->title }}</p>
                            </a>
                            <p>
                                <a href='/tour/{{ $tour->id }}' class="text-xl text-black font-normal">
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
                                            class="text-4xl text-black">{{ number_format($tour->prices[0]->price) . '£' }}</span>
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
<div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg p-8 max-w-2xl mx-auto mt-20 relative">
        <button onclick="closeFilterModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h2 class="text-4xl font-semibold mb-6 text-black text-center">Edit Filters</h2>

        <form id="filterForm" class="space-y-6">
            <!-- Countries -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Countries</label>
                <select id="countries" name="countries[]" multiple
                    class="w-full rounded-md border-gray-300 shadow-sm select2">
                    @foreach ($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Minimum Touring Days -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Touring Days</label>
                <input type="number" name="min_days" min="1"
                    class="w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- Price Range -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="price_range" value="0-1000" class="mr-2">
                        <span>Under £1,000</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="price_range" value="1000-2500" class="mr-2">
                        <span>£1,000 - £2,500</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="price_range" value="2500-5000" class="mr-2">
                        <span>£2,500 - £5,000</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="price_range" value="5000+" class="mr-2">
                        <span>£5,000+</span>
                    </label>
                </div>
            </div>

            <!-- Tour Start Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Show tours starting after</label>
                <input type="date" name="start_date" class="w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- Tour Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tour Type</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="tour_type[]" value="road" class="mr-2">
                        <span>Road</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="tour_type[]" value="adventure" class="mr-2">
                        <span>Adventure</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="tour_type[]" value="enduro" class="mr-2">
                        <span>Enduro</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <button type="button" onclick="clearFilters()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Clear All
                </button>
                <button type="submit" class="px-4 py-2 bg-green text-white rounded-md hover:bg-dark-green">
                    Apply Filters
                </button>
            </div>
        </form>
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
