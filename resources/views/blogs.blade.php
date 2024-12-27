@include('guest-header')

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
                    <a href='/blog/{{ $blog->id }}' class="mb-5">
                        <p class="blog-title text-black text-">{{ $blog->title }}</p>
                    </a>
                    <a href='/blog/{{ $blog->id }}' class="flex justify-center">
                        @if ($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="blog-image">
                        @elseif ($blog->youtube_video_link)
                            <iframe src="https://www.youtube.com/embed/{{ $blog->youtube_video_link }}" frameborder="0"
                                allowfullscreen></iframe>
                        @endif
                    </a>
                    <a href='/blog/{{ $blog->id }}' class="flex justify-center my-5">
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
