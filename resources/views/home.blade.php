@include('guest-header')
<main class="mt-6">
    <div class="brand-name">
        <hr>
        <b style="font-size: 32px; color:black; margin: 5% 0;">Motorbike Tours</b>
        <hr>
    </div>
    @foreach ($tours as $tour)
        <div class="tour-info">
            <div class="inline-flex justify-center items-center mb-3 mt-2">
                <p class="tour-title">{{ $tour->title }} - {{ $tour->countries }}</p>
                <span class="tour-owner ml-4">By {{ $tour->user->name }}</span>
            </div>
            <div class="tour-details inline-flex">
                <img src="{{ isset($tour->images) && isset($tour->images[0]->image_path) ? asset('storage') . '/' . $tour->images[0]->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                    alt="Tour photo">
                <div class="tour-description ml-3 text-2xl">
                    <p>{!! substr($tour->tour_description, 0, 1000) !!}</p>
                    <div class="badges mt-5">
                        <span class="badge"><i
                                class="fa-solid fa-signal"></i><span>{{ $tour->rider_capability }}</span></span>
                        <span class="badge"><i
                                class="fa-solid fa-map-signs"></i><span>{{ $tour->riding_style }}</span></span>
                        <span class="badge"><i class="fa-solid fa-hourglass-half"></i><span>{{ $tour->duration_days }}
                                days</span></span>
                        @foreach ($tour->prices as $tourDateWise)
                            <span class="badge"><i class="fa-solid fa-calendar"></i><span>{{ $tourDateWise->date }}
                                    <b>(€{{ $tourDateWise->price }})</b></span></span>
                        @endforeach
                        <span class="badge"><i class="fa fa-map-pin"></i><span>{{ $tour->countries }}</span></span>
                        <span class="badge"><i class="fa fa-user"></i><span>{{ $tour->max_riders }}
                                Riders & {{ $tour->guides }} Guides</span></span>
                        <span class="badge"><i
                                class="fa fa-motorcycle"></i><span>{{ \Illuminate\Support\Str::limit($tour->riding_style_info, $limit = 15, $end = '...') }}
                                Guides</span></span>
                        <span class="badge"><i
                                class="fa-solid fa-star"></i><span>{{ $tour->bike_option }}</span></span>
                    </div>
                    <div class="links">
                        <a href="#"><i class="fa-solid fa-eye"></i></a>
                        <a href="#"><i class="fa-solid fa-heart"></i></a>
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                        <a href='/tour/{{ $tour->id }}'>See more&nbsp<i class="fa-solid fa-external-link"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</main>
@include('footer')
