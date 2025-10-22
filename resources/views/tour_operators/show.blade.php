<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8">
                @if ($user !== null)
                    <div class="flex flex-col items-center">
                        <img class="img-with-preview" src="{{ asset('storage') . '/' . ($user->tour_profile_picture != '' ? $user->tour_profile_picture : $user->profile_picture) }}"
                                            alt="Tour operator picture"
                                            style="width: 320px; height: 320ox; border-radius: 20px;">
                        <span class="text-green text-2xl font-semibold mt-2">{{$user->tour_operation_name}}</span>
                        <span class="text-green text-lg font-medium mt-2">{{ '@'.$user->tour_nickname}}</span>
                        <span class="text-black text-lg font-normal mt-2">{{ $user->tour_contact_number}} | {{ $user->tour_contact_email }}</span>
                        <span class="mt-2 px-8 text-green text-lg underline font-semibold"><a href="/explore-tours/{{$user->tour_nickname}}">See All {{$user->tour_operation_name}} Tours</a></span>
                        <span class="mt-4 px-8 text-black">
                            {!!$user->tour_introduction!!}
                        </span>
                        @php
                            function renderVideo($url) {
                                if (preg_match('/youtube\.com\/watch\?v=([^\&]+)/', $url, $matches) || 
                                    preg_match('/youtu\.be\/([^\?]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                    return '<iframe src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
                                }
                                if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                    return '<iframe src="https://player.vimeo.com/video/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
                                }
                                if (preg_match('/\.(mp4|webm|ogg)$/i', $url)) {
                                    return '<video width="640" height="360" controls><source src="' . $url . '" type="video/mp4">Your browser does not support the video tag.</video>';
                                }
                                return '<p>Unsupported video format or link.</p>';
                            }
                        @endphp
                        <div class="w-full grid grid-cols-1 wommd:grid-cols-2 gap-6 mt-4">
                            @if ($user->company_showcase_link1 !='')
                                <div class="responsive-iframe-container py-4">
                                    {!! renderVideo($user->company_showcase_link1) !!}
                                </div>
                            @endif
                            @if ($user->company_showcase_link2 !='')
                                <div class="responsive-iframe-container py-4">
                                    {!! renderVideo($user->company_showcase_link2) !!}
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                            @foreach ($user->tour_riding_images as $imagePath)
                            @php
                            $tempimagePath = storage_path('app/public/' . $imagePath); // full path
                            [$width, $height] = getimagesize($tempimagePath);
                            $isRectangle = $width >= ($height * 1.5);
                            @endphp
                                <div class="break-inside-avoid {{$isRectangle ? 'col-span-2' : ''}} overflow-hidden rounded-lg shadow">
                                    <img 
                                        src="{{ asset('storage/' . $imagePath) }}" 
                                        alt="Tour Riding Image"
                                        class="w-full h-full object-cover rounded img-with-preview"
                                        loading="lazy"
                                    >
                                </div>
                            @endforeach
                        </div>
                        <div class="w-auto mx-auto">
                            @if ($tours->count() > 0)
                                <div class="flex justify-between px-8">
                                    <span class="text-green text-lg font-semibold">Upcoming tours by {{$user->tour_operation_name}}</span>
                                    <span class="text-green underline font-semibold"><a href="/explore-tours/{{$user->tour_nickname}}">See All</a></span>
                                </div>
                            @endif
                            <div class="grid grid-cols-1 womsm:grid-cols-2 wommd:grid-cols-4 px-5 py-2">
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
                        </div>
                    </div>
                @else
                    No Profile Found
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
