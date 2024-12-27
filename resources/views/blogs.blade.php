@include('guest-header')

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
    <div class="brand-name">
        <hr>
        <b style="font-size: 32px; color:black; margin: 5% 0;">Blogs</b>
        <hr>
    </div>

    @foreach ($blogs as $blog)
        <div class="blog-info text-center">
            <div class="blog-details inline-flex">
                <div class="blog-description ml-3">
                    <a href='/blogs/{{ $blog->id }}' class="mb-5">
                        <p class="blog-title text-black text-">{{ $blog->title }}</p>
                    </a>
                    <a href='/blogs/{{ $blog->id }}' class="flex justify-center">
                        @if ($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="blog-image">
                        @elseif (getYoutubeVideoId($blog->youtube_video_link ?? ''))
                            <div style="width: 40%;">
                                <iframe width="100%" height="400"
                                    src="https://www.youtube.com/embed/{{ getYoutubeVideoId($blog->youtube_video_link ?? '') }}"
                                    frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                    </a>
                    <a href='/blogs/{{ $blog->id }}' class="flex justify-center my-5">
                        <p style="width: 60%">
                            {!! Str::limit(strip_tags($blog->content), 500, '...') !!}
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</main>

@include('footer')
