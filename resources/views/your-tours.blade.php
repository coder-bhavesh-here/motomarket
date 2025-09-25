<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mx-14 my-2">
        <span class="text-green text-xl font-bold womsm:text-2xl wommd:text-3xl">
            Your Tours
        </span>
        <div class="flex mt-4 mb-14">
            <span class="w-56 text-center active-option px-6 py-2">Upcoming Tours</span>
            <span class="w-56 text-center ml-4 normal-option px-6 py-2">Past Tours</span>
            <span class="w-56 text-center ml-4 normal-option px-6 py-2">Cancelled Tours</span>
        </div>
        <div id="upcomingTours" class="w-full justify-items-center">
            <div class="w-full grid grid-cols-1 womsm:grid-cols-2 wommd:grid-cols-3 gap-4 wommd:gap-16">
                @foreach ($tours as $tour)
                @php
                    $today = \Carbon\Carbon::now();
                    $startDate = \Carbon\Carbon::parse('2025-11-20');
                    $daysToGo = $startDate->greaterThan($today) ? $today->diffInDays($startDate) : 0;
                    $digits = str_split((string) floor($daysToGo)); // Split digits as array
                @endphp
                <div class="w-full justify-items-center masterDiv" id="masterDiv{{ $tour->id }}">
                    <div class="max-w-[320px] wommd:max-w-[500px] ">
                        <a class="block relative" href='/tour/{{ $tour->id }}'>
                            {{-- <img class="aspect-square rounded-lg object-cover h-full w-full"
                                src="https://worldonmoto.com/storage/uploads/1732685873_2.jpg"
                                alt="Tour photo"> --}}
                            @php
                                $firstImage = $tour->images->sortBy('index')->first();
                            @endphp
                            <img class="aspect-square rounded-lg object-cover h-full w-full"
                                src="{{ isset($firstImage) && isset($firstImage->image_path) ? asset('storage') . '/' . $firstImage->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                alt="Tour photo">
                            
                            @if($daysToGo > 0)
                                <div class="absolute top-2 right-2 rounded-md p-2 flex flex-col items-center">
                                    <div class="flex space-x-1">
                                        <@foreach ($digits as $digit)
                                            <span class="bg-white text-green text-2xl font-bold rounded w-8 h-10 flex items-center justify-center">
                                                {{ $digit }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <span class="text-sm font-semibold text-white mt-1">DAYS TO GO</span>
                                </div>
                            @endif
                        </a>
                        <div class="flex justify-between mt-2">
                            <span class="text-green font-bold max-h-5 max-w-[70%] block text-sm wommd:text-base overflow-hidden">{{ Str::limit(strip_tags($tour->title), 40) }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="flex items-center">
                                <span><img style="width: 17px; height: 23px;" src="{{ asset('images') . '/map-pin.png' }}" alt=""></span>
                                <span class="ml-1 text-sm font-medium wommd:text-base">{{ $tour->countries }}</span>
                            </span>
                            <span class="text-green font-semibold text-sm wommd:text-base">20-Nov-2025</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="pastTours" class="hidden w-full justify-items-center">
            <div class="w-full grid grid-cols-1 womsm:grid-cols-2 wommd:grid-cols-3 gap-4 wommd:gap-16">
                @foreach ($tours as $tour)
                <div class="w-full justify-items-center masterDiv" id="masterDiv{{ $tour->id }}">
                    <div class="max-w-[320px] wommd:max-w-[500px] ">
                        <a class="block relative" href='/tour/{{ $tour->id }}'>
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
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="flex items-center">
                                <span><img style="width: 17px; height: 23px;" src="{{ asset('images') . '/map-pin.png' }}" alt=""></span>
                                <span class="ml-1 text-sm font-medium wommd:text-base">{{ $tour->countries }}</span>
                            </span>
                            <span class="text-green font-semibold text-sm wommd:text-base">20-Nov-2025</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="cancelledTours" class="hidden w-full justify-items-center">
            <div class="w-full grid grid-cols-1 womsm:grid-cols-2 wommd:grid-cols-3 gap-4 wommd:gap-16">
                @foreach ($tours as $tour)
                <div class="w-full justify-items-center masterDiv" id="masterDiv{{ $tour->id }}">
                    <div class="max-w-[320px] wommd:max-w-[500px] ">
                        <a class="block relative" href='/tour/{{ $tour->id }}'>
                            {{-- <img class="aspect-square rounded-lg object-cover h-full w-full"
                                src="https://worldonmoto.com/storage/uploads/1732685873_2.jpg"
                                alt="Tour photo"> --}}
                            @php
                                $tour->images = $tour->images->sortBy('index')->first();
                            @endphp
                            <img class="aspect-square rounded-lg object-cover h-full w-full"
                                src="{{ isset($tour->images) && isset($tour->images->image_path) ? asset('storage') . '/' . $tour->images->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                alt="Tour photo">
                            <div class="absolute top-2 right-2 rounded-md p-2 flex flex-col items-center">
                                <span class="border-2 border-solid text-red-600 border-red-600 rounded-lg bg-white text-lg font-bold p-2">Cancelled</span>
                            </div>
                        </a>
                        <div class="flex justify-between mt-2">
                            <span class="text-green font-bold max-h-5 max-w-[70%] block text-sm wommd:text-base overflow-hidden">{{ Str::limit(strip_tags($tour->title), 40) }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="flex items-center">
                                <span><img style="width: 17px; height: 23px;" src="{{ asset('images') . '/map-pin.png' }}" alt=""></span>
                                <span class="ml-1 text-sm font-medium wommd:text-base">{{ $tour->countries }}</span>
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
        
        $(document).on("click", ".normal-option", function(e) {
            const val = $(this).text();
            $('.active-option').addClass('normal-option');
            $('.active-option').removeClass('active-option');
            $(this).addClass('active-option');
            $(this).removeClass('normal-option');
            switch (val) {
                case "Upcoming Tours":
                    $("#upcomingTours").show();
                    $("#pastTours").hide();
                    $("#cancelledTours").hide();
                    break;
                case "Past Tours":
                    $("#upcomingTours").hide();
                    $("#pastTours").show();
                    $("#cancelledTours").hide();
                    break;
                case "Cancelled Tours":
                    $("#upcomingTours").hide();
                    $("#pastTours").hide();
                    $("#cancelledTours").show();
                    break;
                default:
                    break;
            }
        });
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
