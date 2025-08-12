<x-app-layout>
    <div>
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8">
                @if ($user !== null)
                    <div class="flex flex-col items-center">
                        <img class="img-with-preview" src="{{ asset('storage') . '/' . ($user->profile_picture != '' ? $user->profile_picture : $user->profile_picture) }}"
                                            alt="Tour operator picture"
                                            style="width: 320px; height: 320ox; border-radius: 20px;">
                        <span class="text-green text-2xl font-semibold mt-4">{{$user->name}}</span>
                        <span class="text-green text-lg font-medium mt-4">{{ '@'.$user->nickname}}</span>
                        <span class="text-black text-lg font-normal mt-4">{{ $user->contact_number}} | {{ $user->email }}</span>
                        <span class="mt-6 text-black">
                            {!!$user->introduction!!}
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
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                            @foreach ($user->riding_images as $imagePath)
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
                        
                    </div>
                @else
                    No Profile Found
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
