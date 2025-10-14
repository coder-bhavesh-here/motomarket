@include('new-header')
{{-- <div class="flex-column justify-items-center text-center"> --}}
{{-- Search form --}}
<form action="/explore-tours" method="GET">
    <div class="flex flex-col justify-center items-center">
        <p class="womsm:text-sm wommd:text-2xl font-semibold text-black mt-5">Where do you want to go?</p>
        <input type="text" name="search"
            class="mt-5 w-[80%] womsm:max-wommd:w-[60%] wommd:w-[25%] rounded-md text-black" placeholder="Eg: Portugal">
        <button type="submit" class="primary-button mt-5">Search</button>
    </div>
</form>
{{-- </div> --}}
<div class="w-auto mx-auto">
    <div class="grid grid-cols-1 womsm:grid-cols-2 wommd:grid-cols-4 p-[2%]">
        <!-- Tour Card -->
        @foreach ($tours as $tour_sr => $tour)
            @if ($tour_sr < 8)
                <div class="rounded flex flex-col p-3">
                    <a class="" href='{{ route('tour.show', ['tourId' => $tour->id]) }}'>
                        <div>
                            {{-- <div class="bg-gray-300 h-32 rounded mb-4"></div> --}}
                            @php
                                $tour->images = $tour->images->sortBy('index')->first();
                            @endphp
                            <img
                                    class="rounded-md aspect-square object-cover h-full w-full"
                                    src="{{ isset($tour->images) && isset($tour->images->image_path) ? asset('storage') . '/' . $tour->images->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                    alt="Tour photo">
                            <h3 class="text-base font-semibold mt-2 text-green truncated-text">
                                {{ $tour->title }}</h3>
                        </div>
                        <p class="text-sm text-gray-600 flex items-center align-center">
                            <span>
                                <svg class="mr-1" width="25" height="32" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_1974_642)">
                                        <path
                                            d="M19.518 10.536C19.518 16.536 12.1108 22.536 12.1108 22.536C12.1108 22.536 4.70361 16.536 4.70361 10.536C4.70361 8.41431 5.48401 6.37948 6.87313 4.87919C8.26225 3.3789 10.1463 2.53604 12.1108 2.53604C14.0753 2.53604 15.9594 3.3789 17.3485 4.87919C18.7376 6.37948 19.518 8.41431 19.518 10.536Z"
                                            fill="#7A7A7A" stroke="#7A7A7A" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12.1107 13.536C13.6448 13.536 14.8884 12.1929 14.8884 10.536C14.8884 8.87919 13.6448 7.53604 12.1107 7.53604C10.5766 7.53604 9.33301 8.87919 9.33301 10.536C9.33301 12.1929 10.5766 13.536 12.1107 13.536Z"
                                            fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_1974_642" x="-3" y="0.536041" width="30.2217" height="32"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.01 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_1974_642" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1974_642"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </span>
                            <span class="flex w-full justify-between">
                                <span class="text-sm font-semibold text-gray-600">
                                    {{ str_replace(',', ', ', $tour->countries) }}
                                </span>
                                <span class="text-sm font-semibold text-green">
                                    @php
                                        $currency = $tour->user->tour_currency;
                                        $symbol = match ($currency) {
                                            'euro' => '€',
                                            'usd' => '$',
                                            'gbp' => '£',
                                            default => '€',
                                        };
                                    @endphp
                                    {{ isset($tour->prices[0]) ? $symbol . ' ' . number_format($tour->prices[0]->price, 2) : 'N/A' }}
                                </span>
                            </span>
                        </p>
                    </a>
                </div>
            @else
            @endif
        @endforeach
    </div>
    <div class="flex items-center align-center justify-center">
        <button class="primary-button mt-5" onclick="window.location.href='/explore-tours'">
            Search
        </button>
    </div>
</div>
<div>
    <div class="grid grid-cols-1 wommd:grid-cols-2 mt-5 max-w-7xl mx-5 py-8 gap-8 justify-self-center">
        <div class="bg-[#E2E8F0] p-5 rounded-md" onclick="window.location.href='/about';">
            <a href="/about"><p class="text-xl womsm:text-2xl font-semibold m-2 text-[#0F172A]">About WorldonMoto.com</p></a>
            <p class="text-xs womsm:text-xl font-normal m-2 text-[#0F172A]">Welcome to WorldOnMoto, where motorcycle
                enthusiasts connect
                with epic adventures worldwide! Discover thrilling routes, meet passionate riders, and
                explore unforgettable journeys—all on one platform designed for riders, by riders.</p>
            <a href="/about"><button class="secondary-button mt-2">read more</button></a>
        </div>
        <div class="bg-[#E2E8F0] p-5 rounded-md" onclick="window.location.href='/blogs';" >
            <a href="/blogs"><p class="text-xl womsm:text-2xl font-semibold m-2 text-[#0F172A]">Our very first post here...</p></a>
            <p class="text-xs womsm:text-xl font-normal m-2 text-[#0F172A]">Welcome to WorldOnMoto, where motorcycle
                enthusiasts connect with epic adventures worldwide! Discover thrilling routes, meet
                passionate riders, and explore unforgettable journeys—all on one platform designed for
                riders, by riders.</p>
            <a href="/blogs"><button class="secondary-button mt-2">read more</button></a>
        </div>
    </div>
    <div
        class="mt-2 mb-10 max-w-7xl mx-5 py-8 justify-self-center justify-items-start wommd:justify-items-center text-start wommd:text-center bg-[#E2E8F0] p-5 rounded-md"
        onclick="window.location.href='/invite-operators';">
        <a href="/invite-operators"><p class="font-semibold m-2 text-xl womsm:text-2xl text-[#0F172A]">Do you organise motorbike tours?</p></a>
        <p class="text-xs womsm:text-xl m-2 wommd:py-5 wommd:px-10 text-[#0F172A]">We are inviting motorcycle adventure
            tour
            operators from around the world to join us. Together we can provide to best experience to our
            fellow riders looking to explore the world on a motorbike!</p>
            <a href="/invite-operators"><button class="secondary-button mt-2">find out more</button></a>
    </div>
</div>

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
