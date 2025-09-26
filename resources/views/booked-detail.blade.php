@include('new-header')
@php
    $currency = $tour->user->tour_currency;
    $symbol = match ($currency) {
        'euro' => '€',
        'usd' => '$',
        'gbp' => '£',
        default => '€',
    };
@endphp
<style>
    ul li {
        margin-top: 1.25rem;
    }
</style>
<wireui:scripts />

<div class="sm:px-6 lg:px-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('explore-tours') }}">Tour Search</a></u> > <u><a href="/tour/{{ $tour->id }}">Tour Details</a></u> > Booking</p>
    <p class="mt-4 mb-2 font-semibold text-[#0F172A] text-lg womsm:text-xl wommd:text-2xl">
        {{ $tour->title }} - {{ $tour->countries }}
    </p>
    <div class="inline-flex justify-center items-center mb-3">
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
        <a href="#" class="underline">
            <span
                class="text-sm womsm:text-base wommd:text-lg font-semibold text-black tour-owner ml-4">{{ $tour_operation_name }}</span>
        </a>
    </div>
</div>
<div class="w-full grid grid-cols-1 xl:grid-cols-5">
    <div class="col-span-2 m-6">
        <div class="rounded-2xl bg-[#556B2F0F]">
            @php
                $tour->images = $tour->images->sortBy('index')->first();
            @endphp
            <img class="max-h-[300px] rounded-lg object-cover h-full w-full"
                src="{{ isset($tour->images) && isset($tour->images->image_path) ? asset('storage') . '/' . $tour->images->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                alt="Tour photo">
            {{-- <img class="max-h-[300px] rounded-xl object-cover h-full w-full"
                src="https://images.wanderon.in/blogs/new/2023/03/stones-at-chandrataal-lake-1.jpg"
                alt="Tour photo"> --}}
            <div class="content p-10">
                <div class="inline-flex justify-center items-center">
                    <span class="text-black font-bold text-lg womsm:text-xl wommd:text-2xl">YOUR BOOKING</span>
                {{-- <span><a href="/tour/{{ $tour->id }}" class="text-green font-semibold ml-2 text-xs womsm:text-sm wommd:text-base"><u>Change</u></a></span> --}}
                </div>
                <div class="title">
                    <p class="my-4 font-semibold text-[#0F172A] text-base womsm:text-lg wommd:text-xl">
                        {{ $tour->title }} - {{ $tour->countries }}
                    </p>
                </div>
                <div class="dates mt-2 text-black text-sm womsm:text-base wommd:text-lg font-medium">
                    <div class="mt-6">START DATE</div>
                    <div>{{ \Carbon\Carbon::parse($selectedDate->date)->format('F jS, Y') }}</div>
                    <div class="mt-6">END DATE</div>
                    <div>{{ \Carbon\Carbon::parse($selectedDate->end_date)->format('F jS, Y') }}</div>
                </div>
                <div class="text-[#000F22] addons-selected mt-6">
                    <div class="font-semibold text-sm womsm:text-base wommd:text-lg">Add ons selected:</div>
                    <div id="addonsShow" class="font-medium">
                        @php
                            $addonPrices = 0;
                        @endphp
                        @foreach ($addons as $addon)
                            <div class='w-full mt-4 inline-flex justify-between'>
                                <span>{{ $addon->group->name }} - {{ $addon->name }}</span><span> {{$symbol}} {{ $addon->price }} </span>
                            </div>
                            @php
                                $addonPrices = $addonPrices + $addon->price;
                            @endphp
                        @endforeach
                    </div>
                </div>
                <div class="mt-6 border-t border-black pt-4 text-[#000F22]">
                    <div class="inline-flex justify-between w-full">
                        <span>Add ons price</span>
                        <span>{{$symbol}} <span id="addonPrice">{{ $addonPrices }}</span></span>
                    </div>
                    <div class="mt-2 inline-flex justify-between w-full">
                        <span>Tour price</span>
                        <span>{{$symbol}} {{$selectedDate->price}}</span>
                    </div>
                    <div class="mt-2 inline-flex justify-between w-full">
                        <span>Already Paid</span>
                        <span>{{$symbol}} {{$booking->amount}}</span>
                    </div>
                </div>
                <div class="mt-6 border-t inline-flex items-center justify-between border-black pt-4 w-full">
                    <input type="hidden" id="tour_price" value="{{ number_format($selectedDate->price + $addonPrices, 2) }}">
                    <span class="text-black font-semibold">Total Due</span> 
                    <strong>
                        <span class="text-2xl text-black" id="total_price">{{$symbol}} {{ number_format(($selectedDate->price + $addonPrices) - $booking->amount, 2) }}</span>
                    </strong>
                </div>
                <div class="mt-4">
                    <div id="validation-errors" class="text-red-600 mb-4 hidden"></div>
                    @if ($booking->amount < $selectedDate->price + $addonPrices)
                        @php
                            $pay = ($selectedDate->price + $addonPrices) - $booking->amount;
                        @endphp
                        <button class="make-payment primary-button w-full" data-id="{{ $booking->id }}"
                            data-price="{{ $pay }}" id="payWithStripe">Pay 75% - {{ $symbol }} <span id="hundredPay">{{ $pay }}</span></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-3">
        <div class="py-6">
            <div>
                <span class="text-black font-bold text-xl">Quick Links</span>
            </div>
            <div class="inline-flex mt-2">
                <span class="underline text-black text-lg font-normal">
                    <a href="/tour/{{$tour->id}}">Tour Page</a>
                </span>
                <span class="underline text-black text-lg font-normal ml-4">
                    <a href="/tour-operator/{{$tour->user->tour_nickname}}">Tour Operator Info</a>
                </span>
            </div>
            <div class="mt-8">
                <span class="text-black font-bold text-xl">Your Actions</span>
            </div>
            <div class="mt-2 text-black">
                <ul class="ml-5" style="list-style: disc">
                    @if ($booking->amount < $selectedDate->price + $addonPrices)
                        <li>Pay the outstanding amount before the {{\Carbon\Carbon::parse($selectedDate->date)->format('F jS, Y')}}</li>
                    @endif
                    <li>Agree to the tour operator indemnity terms</li>
                    <li>Learn about sports and travel insurance for additional safety</li>
                    <li>Make the travel arrangements to get to the starting point</li>
                    <li>Driving License Proof</li>
                    <li>Confirm your ICE (emergency contacts) are up to date</li>
                </ul>
            </div>
            {{-- <div class="mt-8">
                <span class="text-black font-bold text-xl">Meeting Location Details </span>
            </div>
            <div class="mt-2 text-black">
                {!! $tour->tour_meeting_location_notes !!}
            </div> --}}
            <div class="mt-4 text-black">
                @if ($embedUrl!='')
                <div class="flex flex-col mt-5 mr-5">
                    <span class="text-black flex mb-3 mt-3 font-bold text-xl">Tour Start Location </span>
                    {{-- <span style="font-weight: 900" class="flex mb-2 text-black text-sm womsm:text-lg wommd:text-xl">TOUR MEETING LOCATION</span> --}}
                    @if (str_contains($embedUrl, 'google.com'))
                        <iframe 
                            src="{{$embedUrl}}" 
                            width="100%" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <a onmouseover="this.style.color='black'" class="text-black font-bold" href="{{ Str::startsWith($embedUrl, ['http://', 'https://']) ? $embedUrl : 'https://' . $embedUrl }}" target="_blank">    
                            Location
                        </a>
                    @endif
                </div>
                @endif
                @if ($tour->tour_meeting_location_notes !='')
                <div class="mt-5">
                    <span class="text-black font-bold flex mb-3 mt-3 text-xl">Meeting Location Details </span>
                    {!!$tour->tour_meeting_location_notes!!}
                </div>
                @endif
                {{-- <a class="underline italic" href="{{ $tour->tour_start_location }}">{{ $tour->tour_start_location }}</a> --}}
            </div>
            @if (count($otherUser) > 0)
            <div class="mt-8">
                <span class="text-black font-bold text-xl">Who’s joining you</span>
            </div>
            <div class="mt-2 text-black">
                @if (count($otherUser) > 0)
                    @foreach ($otherUser as $user)
                    <img src="{{ asset('storage') . '/' . ($user->profile_picture != '' ? $user->profile_picture : '') }}"
                        alt="Other users picture"
                        style="width: 40px; height: 40px; border-radius: 20px;">
                    @endforeach
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    $(".make-payment").click(function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        const price = $(this).data("price");
        $.ajax({
            type: "POST",
            url: "/payment",
            data: {
                id,
                price,
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                window.location.href = response.redirect_url;
            }
        });
    });
</script>
@include('footer')
