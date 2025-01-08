@include('guest-header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
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
        <b style="font-size: 32px; color:black; margin: 5% 0;">FAQs</b>
        <hr>
    </div>

    @foreach ($blogs as $key => $blog)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $key }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                        aria-controls="collapse{{ $key }}">
                        {{ $blog->title }}
                    </button>
                </h2>
                <div id="collapse{{ $key }}" class="accordion-collapse show"
                    aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body flex justify-items-center">
                        @if ($blog->image)
                            <img style="width: 200px" src="{{ asset('storage/' . $blog->image) }}" alt="FAQ Image"
                                class="blog-image">
                        @elseif (getYoutubeVideoId($blog->youtube_video_link ?? ''))
                            <div style="width: 40%;">
                                <iframe width="100%" height="400"
                                    src="https://www.youtube.com/embed/{{ getYoutubeVideoId($blog->youtube_video_link ?? '') }}"
                                    frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                        <p class="ml-3" style="width: 60%">
                            {!! Str::limit(strip_tags($blog->content), 500, '...') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</main>

@include('footer')
