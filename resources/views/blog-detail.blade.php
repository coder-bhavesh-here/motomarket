@include('guest-header')

<main class="mt-6">
    <a class="btn btn-primary m-0" href="/blogs">Blogs</a>
    <div class="blog-container flex flex-col justify-center items-center">
        <h1 class="blog-title text-3xl text-black my-5">{{ $blog->title }}</h1>
        <div class="blog-media mb-4 flex justify-center">
            @if ($blog->image)
                <img width="70%" src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="blog-full-image">
            @elseif ($blog->youtube_link)
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $blog->youtube_link }}"
                    frameborder="0" allowfullscreen></iframe>
            @endif
        </div>
        <div class="blog-content m-7 w-3/5">
            {!! $blog->content !!}
        </div>
    </div>
</main>

@include('footer')
