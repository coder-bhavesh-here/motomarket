<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="sm:px-6 lg:px-8">
        <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Your Favourite Tours</p>
        {{-- <form action="/explore-tours" method="GET" class="grid grid-cols-1 wommd:grid-cols-2">
            <input type="text" value="" name="search" class="mt-3 w-full rounded-md text-black">
            <button class="wommd:ml-5 wommd:w-1/2 mt-2 button-text text-base font-bold">Search for tours</button>
        </form> --}}
        <form action="/my-favourite-tours" method="GET">
            <div class="w-full text-center">
                <div class="mb-4 text-green text-lg womsm:text-xl wommd:text-2xl font-bold">Your Favourite Tours</div>
                <input type="text" placeholder="Eg: Portugal Paradise" name="search" value="{{ $search }}" class="rounded-md mb-4" style="width: 350px">
                <div class="mb-4"><button type="submit" class="primary-button">Search</button></div>
            </div>
        </form>
        <div class="w-full justify-items-center block mt-24">
            <div class="w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4 wommd:gap-16">
                {{-- <tr>
                    <td>{{ $tour->title }}</td>
                    <td>{{ $tour->rider_capability }}</td>
                    <td>{{ $tour->duration_days }}</td>
                    <td>{{ $tour->max_riders }}</td>
                    <td>{{ $tour->guides }}</td>
                    <td>{{ $tour->tour_distance }} Km</td>
                    <td>{{ $tour->bike_option }}</td>
                    <td>
                        <a class="ml-3 fa-solid fa-eye" href="tour/{{ $tour->id }}"></a>
                    </td>
                </tr> --}}
                @foreach ($tours as $tour)
                <div class="w-full justify-items-center masterDiv" id="masterDiv{{ $tour->id }}">
                    <div class="max-w-[320px] wommd:max-w-[500px] ">
                        <a href='{{ route('tour.show', ['tourId' => $tour->id]) }}'>
                            {{-- <img class="aspect-square rounded-lg object-cover h-full w-full"
                                src="https://worldonmoto.com/storage/uploads/1732685873_2.jpg"
                                alt="Tour photo"> --}}
                            @php
                                $tour->images = $tour->images->sortBy('index')->first();
                            @endphp
                            <img class="aspect-square rounded-lg object-cover h-full w-full"
                                src="{{ isset($tour->images) && isset($tour->images->image_path) ? asset('storage') . '/' . $tour->images->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                alt="Tour photo">
                        </a>
                        <div class="flex justify-between mt-2">
                            <span class="text-green font-bold max-h-5 max-w-[70%] block text-sm wommd:text-base overflow-hidden">{{ Str::limit(strip_tags($tour->title), 40) }}</span>
                            <a href="#" class="text-[#B91C1C] text-sm wommd:text-base underline remove font-semibold" data-id="{{ $tour->id }}">Remove</a>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="flex items-center">
                                <span><img style="width: 17px; height: 23px;" src="{{ asset('images') . '/map-pin.png' }}" alt=""></span>
                                <span class="ml-1 text-sm font-medium wommd:text-base">{{ str_replace(",",", ", $tour->countries) }}</span>
                            </span>
                            <span class="text-green font-semibold text-sm wommd:text-base">20-Nov-2025</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".remove", function(e) {
            e.preventDefault();
            const tourId = $(this).attr("data-id");
            $("#masterDiv"+tourId).remove();
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
                        console.log("Tour removed from favourite", tourId);
                    }
                },
                error: function(error) {
                    window.location.href = "/login";
                }
            });
        });
    </script>
</x-app-layout>
