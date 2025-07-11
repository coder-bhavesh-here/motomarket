@include('new-header')

@php
    function getYoutubeVideoId($url)
    {
        preg_match(
            '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches,
        );
        return $matches[1] ?? null;
    }
@endphp
<main class="mt-6">
    <div class="brand-name ml-16">
        <b style="font-size: 24px; color:black; margin: 5% 0;">WoM Blog</b>
    </div>

    <div class="grid grid-cols-1 p-16 womsm:grid-cols-2 wommd:grid-cols-4 gap-6">
        @foreach ($blogs as $blog)
            <div class="rounded-2xl overflow-hidden shadow-md bg-white">
                <div class="relative">
                    <a href="/blogs/{{ $blog->id }}">
                        <img class="w-full h-56 object-cover rounded-t-3xl" src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image">
                    </a>
            
                    <div class="absolute top-2 right-2 bg-[#596a37] text-white text-sm font-semibold px-2 py-1 rounded-md">
                        {{ \Carbon\Carbon::parse($blog->created_at)->format('Y') }}
                    </div>
                </div>
            
                <div class="p-4">
                    <a href="/blogs/{{ $blog->id }}">
                        <h3 class="text-lg font-bold text-[#0F172A] mb-2 leading-snug">
                            {{ Str::upper($blog->title) }}
                        </h3>
                    </a>
            
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {!! Str::limit(strip_tags($blog->content), 150, '...') !!}
                    </p>
                </div>
            </div>        
        @endforeach
    </div>
</main>

@include('footer')
