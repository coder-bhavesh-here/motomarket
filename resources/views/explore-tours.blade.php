@include('new-header')
<main class="px-28">
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > Tour Search Results</p>
    <form action="/explore-tours" method="GET">
        <input type="text" value="{{ $search }}" name="search" class="mt-5 w-1/4 rounded-md text-black">
        <button class="ml-5 button-text text-base font-bold">Search for tours</button>
    </form>
    <div class="mt-10 mb-20 flex items-center">
        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M29.6104 1.51868H1.875L12.9691 16.1283V26.2284L18.5162 29.3171V16.1283L29.6104 1.51868Z"
                stroke="#556B2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="text-green underline font-bold text-sm ml-3">Edit Filters</span>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @foreach ($tours as $tour)
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
                                alt="Tour operator picture" style="width: 40px; height: 40ox; border-radius: 20px;">
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
                            {{ Str::limit(strip_tags($tour->tour_description), 1000) }}
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
                        {{-- @foreach ($tour->prices as $tourDateWise)
                        @endforeach --}}
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
                    <div class="links">
                        @if ($tour->is_favourite)
                            <a class="unfavourite">
                                <i class="fa-solid fa-heart" data-id="{{ $tour->id }}"></i>
                            </a>
                        @else
                            <a class="favourite">
                                <i class="fa-regular fa-heart" data-id="{{ $tour->id }}"></i>
                            </a>
                        @endif
                        <a href='/tour/{{ $tour->id }}' class="button-text">Tour Details</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</main>
<script>
    $(document).on("click", ".favourite", function(e) {
        e.preventDefault();
        const icon = $(this).find("i");
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
                    icon.removeClass("fa-regular").addClass("fa-solid");
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
        const icon = $(this).find("i");
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
                    icon.removeClass("fa-solid").addClass("fa-regular");
                    $(e.currentTarget).removeClass("unfavourite").addClass("favourite");
                }
            },
            error: function(error) {
                window.location.href = "/login";
            }
        });
    });
</script>
@include('footer')
