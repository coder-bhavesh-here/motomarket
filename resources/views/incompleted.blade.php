<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <div class="w-full text-left">
                <div class="mb-2 text-green text-lg womsm:text-xl wommd:text-2xl font-bold">Complete your bookings</div>
                <span class="text-black italic">You started to book the following tours but did not finish. You can start again from here</span>
            </div>
            <div class="w-full justify-items-center block mt-24">
                <div class="w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4 wommd:gap-16">
                    @foreach ($tours as $tour)
                    <div class="w-full justify-items-center masterDiv" id="masterDiv{{ $tour->id }}">
                        <div class="max-w-[320px] wommd:max-w-[500px] ">
                            <a href='/tour/{{ $tour->id }}'>
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
    </div>
    <script>
        $(document).on("click", ".remove", function(e) {
            e.preventDefault();
            const tourId = $(this).attr("data-id");
            $("#masterDiv"+tourId).remove();
            $.ajax({
                type: "POST",
                url: "/delete-incomplete",
                data: {
                    tour_id: tourId
                },
                dataType: "JSON",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    if (response.message === "Tour removed.!") {
                        window.location.reload();
                    }
                },
                error: function(error) {
                    window.location.href = "/login";
                }
            });
        });
    </script>
</x-app-layout>
