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

    $videoId = getYoutubeVideoId($blog->youtube_video_link ?? '');
@endphp
<main class="mt-6">
    <a class="btn btn-primary m-0" href="/blogs">Blogs</a>
    <div class="blog-container flex flex-col justify-center items-center">
        <h1 class="blog-title text-3xl text-black my-5">{{ $blog->title }}</h1>
        <div class="blog-media mb-4 flex justify-center" style="width: 40%">
            @if ($blog->image)
                <img width="70%" src="http://92.205.108.194/wom-admin/public/storage/{{ $blog->image }}"
                    alt="Blog Image" class="blog-full-image">

                {{-- <img width="70%" src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="blog-full-image"> --}}
            @elseif ($videoId)
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $videoId }}"
                    frameborder="0" allowfullscreen></iframe>
            @endif
        </div>
        <div class="blog-content m-7 w-3/5">
            {!! $blog->content !!}
        </div>
    </div>
</main>

@include('footer')
