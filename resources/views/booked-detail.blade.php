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
<div class="w-full grid grid-cols-1 xl:grid-cols-4">
    <div class="m-10">
        <div class="rounded-2xl bg-[#556B2F0F]">
            <img class="max-h-[300px] rounded-lg object-cover h-full w-full"
                src="{{ isset($tour->images) && isset($tour->images[0]->image_path) ? asset('storage') . '/' . $tour->images[0]->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                alt="Tour photo">
            {{-- <img class="max-h-[300px] rounded-xl object-cover h-full w-full"
                src="https://images.wanderon.in/blogs/new/2023/03/stones-at-chandrataal-lake-1.jpg"
                alt="Tour photo"> --}}
            <div class="content p-10">
                <div class="inline-flex justify-center items-center">
                    <span class="text-black font-bold text-lg womsm:text-xl wommd:text-2xl">YOUR BOOKING</span>
                <span><a href="/tour/{{ $tour->id }}" class="text-green font-semibold ml-2 text-xs womsm:text-sm wommd:text-base"><u>Change</u></a></span>
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
                </div>
                <div class="mt-6 border-t inline-flex items-center justify-between border-black pt-4 w-full">
                    <input type="hidden" id="tour_price" value="{{ number_format($selectedDate->price + $addonPrices, 2) }}">
                    <span class="text-black font-semibold">Total</span> 
                    <strong>
                        <span class="text-2xl text-black" id="total_price">{{$symbol}} {{ number_format($selectedDate->price + $addonPrices, 2) }}</span>
                    </strong>
                </div>
                <div class="mt-4">
                    <div id="validation-errors" class="text-red-600 mb-4 hidden"></div>
                    @if ($selectedDate->date < now()->addMonths(2))
                        @php
                            // Pay 100% of the total price
                            $pay = $totalPrice = $selectedDate->price + $addonPrices;
                        @endphp
                    @else
                        @php
                            // Pay 25% of the total price
                            $totalPrice = ($selectedDate->price + $addonPrices) * 0.25;
                            $pay = $selectedDate->price + $addonPrices;
                        @endphp
                        <button class="make-payment primary-button w-full mb-4" data-id="{{ $selectedDate->id }}"
                            data-price="{{ $totalPrice }}" id="payWithStripe">Pay 25% - <span
                                id="twentyFivePay">{{$symbol}} {{ $totalPrice }}</span></button>
                    @endif
                    <button class="make-payment primary-button w-full" data-id="{{ $selectedDate->id }}"
                        data-price="{{ $pay }}" id="payWithStripe">Pay 100% - {{ $symbol }} <span id="hundredPay">{{ $pay }}</span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-3">
        <div class="px-4 py-6">
            <span>Quick Links</span>
        </div>
    </div>
</div>
@include('footer')
