@php
    $currency = $tour->user->tour_currency;
    $symbol = match ($currency) {
        'euro' => '€',
        'usd' => '$',
        'gbp' => '£',
        default => '€',
    };
@endphp
<div class="tour-info rounded-3xl">
    <div class="tour-details grid womsm:flex grid-cols-1 womsm:grid-cols-3">
        <div class="h-[90px] womsm:h-auto">
            <a href='/tour/{{ $tour->id }}' target="_blank">
                @php
                    $tour->images = $tour->images->sortBy('index')->first();
                @endphp
                <img class="aspect-square rounded-t-lg womsm:rounded-tr-none womsm:rounded-l-lg object-cover h-full w-full"
                    src="{{ isset($tour->images) && isset($tour->images->image_path) ? asset('storage') . '/' . $tour->images->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                    alt="Tour photo">
            </a>
        </div>
        <div class="tour-description relative womsm:col-span-2">
            @php
                $nickname = trim($tour->user->tour_nickname ?? '');
                $link = $nickname !== '' ? "/tour-operator/" . $nickname : "#";
            @endphp
            <a href="{{ $link }}">
                <div class="inline-flex justify-center items-center my-3">
                    @php
                        $profile_picture =
                            $tour->user->tour_profile_picture != ''
                                ? $tour->user->tour_profile_picture
                                : ($tour->user->profile_picture != ''
                                    ? $tour->user->profile_picture
                                    : '');
                        $tour_operation_name =
                            $tour->user->tour_operation_name != ''
                                ? $tour->user->tour_operation_name
                                : ($tour->user->name != ''
                                    ? $tour->user->name
                                    : '');
                    @endphp
                    @if ($profile_picture != '')
                        <img src="{{ asset('storage') . '/' . ($tour->user->tour_profile_picture != '' ? $tour->user->tour_profile_picture : $tour->user->profile_picture) }}"
                            alt="Tour operator picture"
                            style="width: 40px; height: 40px; border-radius: 20px;">
                    @endif
                        <span class="text-xl font-semibold text-black tour-owner ml-4">{{ $tour_operation_name }}</span>
                </div>
            </a>
            <a href='/tour/{{ $tour->id }}' target="_blank">
                <p class="py-2 text-base womsm:text-lg wommd:text-xl font-semibold text-black">{{ $tour->title }}</p>
            </a>
            <p>
                <a href='/tour/{{ $tour->id }}' class="text-xs womsm:text-sm wommd:text-base text-black font-normal">
                    {!! Str::limit(strip_tags($tour->tour_description), 350) !!}
                </a>
            </p>
            <div class="badges mt-5 flex flex-wrap items-center">
                <span class="badge">
                    <img src="{{ asset('images') . '/tower.svg' }}" alt="">
                    <span>{{ str_replace(',', ', ', $tour->rider_capability) }}</span>
                </span>
                <span class="badge">
                    <img src="{{ asset('images') . '/indicator.svg' }}" alt="">
                    <span>{{ $tour->riding_style === 'Road' ? "Road Trip (Adventure on the road, its a road trip)" : ($tour->riding_style === 'Adventuer' ? "Adventure (Adventure ride on and off road)" : "Enduro (Almost all of the trip is off road)") }}</span>
                </span>
                <span class="badge">
                    <img src="{{ asset('images') . '/hourglass.svg' }}" alt="">
                    <span>{{ isset($tour->prices[0]) && isset($tour->prices[0]->duration_days) ? $tour->prices[0]->duration_days : 0 }} days</span>
                </span>
                @if ($tour->prices->count() > 0)
                    <span class="badge">
                        <img src="{{ asset('images') . '/cal.svg' }}" alt="">
                        <span>{{ $tour->prices[0]->date . ($tour->prices->count() > 1 ? ' (+' . ($tour->prices->count() - 1) . ' more)' : '') }}</span>
                    </span>
                @endif
                <span class="badge">
                    <img src="{{ asset('images') . '/earth.svg' }}" alt="">
                    <span>{{ str_replace(',', ', ', $tour->countries) }}</span></span>
                <span class="badge">
                    <img src="{{ asset('images') . '/people.svg' }}" alt="">
                    <span>{{ $tour->max_riders }}
                        Riders & {{ $tour->guides }} Guide{{$tour->guides > 1 ? "s" : ""}}</span></span>
                <span class="badge">
                    <img src="{{ asset('images') . '/bike.svg' }}" alt="">
                    <span>{{ $tour->bike_option === 'Bike rental' ? "Bike rental or own bike" :  ($tour->bike_option === 'Bike included' ? "Bike is included" : "Bring your own bike")}}</span></span>
                <span class="badge">
                    <img src="{{ asset('images') . '/helmet.svg' }}" alt="">
                    <span>{{ $tour->two_up_riding ? "Two up riding available" : "Two up riding not available" }}</span></span>
            </div>
            <div class="relative flex items-center justify-between font-semibold bottom-0 w-full">
                <div class="left"  style="min-width: 110px;">
                    @if ($tour->prices->count() > 0)
                        <span
                            class="text-lg womsm:text-xl wommd:text-2xl text-black">{{ $symbol . ' ' . number_format($tour->prices[0]->price, 2) }}</span>
                    @endif
                </div>
                <div class="links flex items-center">
                    <a href='/tour/{{ $tour->id }}' class="button-text">Tour Details</a>
                    @if ($tour->is_favourite)
                        <a class="unfavourite">
                            <img style="height: 50px !important; max-width: 50px !important; width: 50px !important;"
                                src="{{ asset('images') . '/heart-filled.svg' }}"
                                data-id="{{ $tour->id }}">
                        </a>
                    @else
                        <a class="favourite">
                            <img style="height: 50px !important; max-width: 50px !important; width: 50px !important;"
                                src="{{ asset('images') . '/heart-plain.svg' }}"
                                data-id="{{ $tour->id }}">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>