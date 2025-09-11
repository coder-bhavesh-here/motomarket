@include('new-header')
@php
    $filterLabels = [
        "road" => "Road",
        "adventure" => "Adventure",
        "enduro" => "Enduro",
        "Beginner" => "Beginner",
        "Intermediate" => "Intermediate",
        "Expert" => "Expert",
        "own_bike" => "Bring own bike",
        "rental_included" => "Bike rental or included",
        "0" => "Bring own riding gear",
        "1" => "Riding gear rental or included",
        "yes" => "Two-up riding on a bike allowed",
        "no" => "Single rider per bike"
    ];
@endphp 
<style>
    .gray-button {
        padding: 12px 20px !important;
    }
    td {
        border: unset;
    }

    .select2-container--default .select2-selection--multiple {
        border-color: #d1d5db;
        line-height: 1.5rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #1E293B !important;
        color: white !important;
        border: 1px solid white;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
    }

    .select2 select2-container select2-container--default {
        margin-bottom: 8px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover,
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
        background-color: #1E293B !important;
    }
</style>
<main class="mt-2 px-6">
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > Tour Search Results</p>
    <div class="grid grid-cols-1 wommd:grid-cols-2">
        <form action="/explore-tours" method="GET" class="grid grid-cols-1 wommd:grid-cols-2">
            <input type="text" value="{{ $search }}" name="search" class="mt-3 w-full rounded-md text-black">
            <button class="wommd:ml-5 wommd:w-1/2 mt-2 button-text text-base font-bold">Search</button>
        </form>
        <div class="grid grid-cols-1 wommd:grid-cols-2">
            {{-- <div
                class="p-2 wommd:justify-self-end wommd:col-span-3 max-w-44 bg-[#F1F5F9] mt-2 flex items-center cursor-pointer rounded border border-[#556B2F]">
                <img src="{{ asset('images/save.png') }}" alt="">
                <span class="text-green underline font-bold text-sm ml-3">save this search</span>
            </div> --}}
            <div></div>
            <div class="mt-2 flex items-center cursor-pointer justify-self-end" onclick="openFilterModal()">
                <img src="{{ asset('images/filter.png') }}" alt="">
                <span class="text-green underline font-bold text-sm ml-3">Edit Filters</span>
            </div>
        </div>
    </div>
    @if(!empty($filters))
    <div class="flex flex-wrap gap-2 my-4">
        @foreach($filters as $key => $value)
            @if(is_array($value))
                @foreach($value as $val)
                    @if ($val != '' && $key!='search')
                        <span class="bg-slate-800 text-white text-sm px-3 py-1 rounded flex items-center gap-2">
                            {{ $key == "countries" ? $val : "" }}
                            {{ $key == "tour_type" ? ucfirst($val) . ' tours' : "" }}
                            {{ $key == "tour_level" ? ucfirst($val) . ' tours' : "" }}
                            {{ $key == "bike_options" ? $filterLabels[$val] : "" }}
                            {{ $key == "riding_gear" ? $filterLabels[$val] : "" }}
                            {{ $key == "two_riding" ? $filterLabels[$val] : "" }}
                            <button type="button" style="color: white !important;" onclick="removeFilter('{{ $key }}', '{{ $val }}')" class="ml-1">
                                &times;
                            </button>
                        </span>
                    @endif
                @endforeach
            @else
                @if ($key !== 'currency' && $key!='search' && $value !='')
                    <span class="bg-slate-800 text-white text-sm px-3 py-1 rounded flex items-center gap-2">
                        {{ $key == "min_days" ? $value." days at least" : "" }}
                        @php
                            if(isset($filters['currency']) && $filters['currency'] !=''){
                                $filterCurrency = $filters['currency'];
                            } else {
                                $filterCurrency = '';
                            }
                        @endphp
                        {{ $key == "max_price" ? $value." ".$filterCurrency." MAX" : "" }}
                        {{ $key == "start" ? \Carbon\Carbon::parse($value)->format('d M Y') . ' or after' : "" }}
                        <button type="button" style="color: white !important;" onclick="removeFilter('{{ $key }}')" class="ml-1">
                            &times;
                        </button>
                    </span>
                @endif
            @endif
        @endforeach
    </div>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex justify-center">
        <div id="tours-container" style="max-width: 1620px;">
            @foreach ($tours as $tour)
                @if ($tour->status === 'published')
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
                            <div class="tour-description womsm:col-span-2 relative">
                                @php
                                    if(isset($tour->user->tour_nickname) && $tour->user->tour_nickname != '') {
                                        $link = "/tour-operator/".$tour->user->tour_nickname;
                                    }
                                    else {
                                        $link = "#";
                                    }
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
                                    <p class="text-base womsm:text-lg wommd:text-xl font-semibold text-black">{{ $tour->title }}</p>
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
                                            Rider{{$tour->max_riders > 1 ? "s" : ""}} & {{ $tour->guides }} Guide{{$tour->guides > 1 ? "s" : ""}}</span></span>
                                    <span class="badge">
                                        <img src="{{ asset('images') . '/bike.svg' }}" alt="">
                                        <span>{{ $tour->bike_option === 'Bike rental' ? "Bike rental or own bike" :  ($tour->bike_option === 'Bike included' ? "Bike is included" : "Bring your own bike")}}</span></span>
                                    <span class="badge">
                                        <img src="{{ asset('images') . '/helmet.svg' }}" alt="">
                                        <span>{{ $tour->two_up_riding ? "Two up riding available" : "Two up riding not available" }}</span></span>
                                </div>
                                <div class="relative flex items-center justify-between font-semibold bottom-0 w-full">
                                    <div class="left" style="min-width: 110px;">
                                        @if ($tour->prices->count() > 0)
                                        @php
                                            $currency = $tour->user->tour_currency;
                                            $symbol = match ($currency) {
                                                'euro' => '€',
                                                'usd' => '$',
                                                'gbp' => '£',
                                                default => '€',
                                            };
                                        @endphp

                                            <span
                                                class="text-lg womsm:text-xl wommd:text-2xl text-black">{{ $symbol.' ' . number_format($tour->prices[0]->price, 2) }}</span>
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
                @endif
            @endforeach
        </div>
    </div>
    <div class="text-center">
        <button onclick="loadMoreTours();" class="button-text load-more">Load More
        </button>
    </div>
    <div id="loading" class="text-center hidden mb-10">
        <div
            class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-green border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]">
        </div>
    </div>
</main>

<!-- Filter Modal -->
<div id="filterModal" class="absolute inset-0 backdrop-blur-sm z-50 hidden" style="background: #ffffff70;">
    <div class="bg-white rounded-lg py-4 px-2 wommd:p-8 womsm:max-w-[80%] wommd:max-w-[75%] womsm:mx-auto womsm:mt-20 relative" style="box-shadow: 0 0 10px 0px gray;">
        <svg onclick="closeFilterModal()"
            class="cursor-pointer absolute m-4 top-4 right-4 text-gray-500 hover:text-gray-700 w-6 h-6" width="32"
            height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
            <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
        </svg>


        <h2 class="text-base womsm:text-xl wommd:text-2xl font-semibold ml-5 wommd:ml-0 mt-4 mb-6 text-black text-left wommd:text-center">Edit Filters</h2>

        <div class="w-full justify-items-center">
            <form id="filterForm" class="w-full womsm:w-5/6 wommd:w-3/4 space-y-6 px-4">
                <table class="w-full">
                    <!-- Countries -->
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">Countries</label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <select id="countries" name="countries[]" multiple
                                class="w-full rounded-md border-gray-300 shadow-sm select2">
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                Add all the countries you want to travel in. Leave it empty if you want to see featured
                                trips from around the world.
                            </span>
                        </div>
                    </div>

                    <!-- Minimum Touring Days -->
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Minimum Touring Days
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <div class="flex items-center mb-2">
                                <input type="number" name="min_days" min="1"
                                    class="w-full womsm:w-2/4 rounded-md border-gray-300 shadow-sm">
                                <span class="ml-2 text-sm text-black font-medium">days</span>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">How long do you want the tour to be?
                                Type
                                the least amount of days you want tour for.
                                If you type “5” you will get tours that are five days or longer.
                            </span>
                        </div>
                    </div>
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Maximum tour price
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <div class="grid grid-cols-1 womsm:grid-cols-4 items-center mb-2 text-black font-medium text-sm">
                                <input type="number" name="max_price" min="1"
                                    class="w-full rounded-md mb-3 womsm:mb-1 border-gray-300 shadow-sm">
                                <div class="flex">
                                    <span class="womsm:ml-5 flex items-center">
                                        <input type="radio" {{ isset($filters['currency']) && $filters['currency'] == "EUR" ? "checked": "";  }} value="EUR" name="currency"><span class="ml-1">EUR</span>
                                    </span>
                                    <span class="ml-4 flex items-center">
                                        <input type="radio" {{ isset($filters['currency']) && $filters['currency'] == "USD" ? "checked": "";  }} value="USD" name="currency"><span class="ml-1">USD</span>
                                    </span>
                                    <span class="ml-4 flex items-center">
                                        <input type="radio" {{ isset($filters['currency']) && $filters['currency'] == "GBP" ? "checked": "";  }} value="GBP" name="currency"><span class="ml-1">GBP</span>
                                    </span>
                                </div>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                What’s the maximum you want to spend on the tour? You can also select the currency. We will convert accordingly. EUR - Euro, USD - US dollor, GBP - UK Sterling
                            </span>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Show tours starting after
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <div class="flex items-center mb-2">
                                <input type="date" name="start" class="w-2/4 rounded-md border-gray-300 shadow-sm">
                                <span class="ml-2 text-sm text-black font-medium">days</span>
                            </div>
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                Select the date that you want tours to be starting from or after. We will show you tours that start after the date you select.
                            </span>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Tour type
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Select the type of tour you want to do. You can select multiple options. You need to select at least one.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="road" class="mr-2">
                                    <span class="text-sm font-medium text-black">Road</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">All on the road; black
                                        top</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="adventure" class="mr-2">
                                    <span class="text-sm font-medium text-black">Adventure</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">Off and on road; dirt and
                                        road</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_type[]" value="enduro" class="mr-2">
                                    <span class="text-sm font-medium text-black">Enduro</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">Almost always off-road</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Tour level
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Most tours are marked as for beginners, intermediate and/or expert riders. You can select accordingly here.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_level[]" value="Beginner" class="mr-2">
                                    <span class="font-medium text-sm text-black">Beginner</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">you need support/advice from other riders</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_level[]" value="Intermediate" class="mr-2">
                                    <span class="font-medium text-sm text-black">Intermediate</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">capable most of the time need almost no help</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="tour_level[]" value="Expert" class="mr-2">
                                    <span class="font-medium text-sm text-black">Expert</span>
                                    <span class="text-sm font-normal ml-4 italic text-[#0F172A]">can help other riders and always in control</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Bike options
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Select if you are looking for tours that will rent you the bike or tours where you can bring your own bike. You can select both if you like.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="bike_options[]" value="own_bike" class="mr-2">
                                    <span class="font-medium text-black text-sm">Bring my own bike</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="bike_options[]" value="rental_included" class="mr-2">
                                    <span class="font-medium text-black text-sm">Bike rental or included</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Riding gear options
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                                Select if you are looking for tours that will rent riding gear or tours where you can bring your own riding gear. You can select both if you like.
                            </span>
                            <div class="space-y-2 mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="riding_gear[]" value="0" class="mr-2">
                                    <span class="font-medium text-black text-sm">Bring my own riding gear</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="riding_gear[]" value="1" class="mr-2">
                                    <span class="font-medium text-black text-sm">Riding gear rental or included</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid w-full grid-cols-2 wommd:grid-cols-3">
                        <div class="wommd:pb-6 w-full">
                            <label class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:text-right wommd:mr-3 wommd:w-[-15%]">
                            Two-up riding
                            </label>
                        </div>
                        <div class="pb-6 col-span-2 w-full">
                            <span class="text-sm font-normal text-[#0F172A] mt-2">
                            Select if you looking for trips that allows riding with a pillion passenger, or not or both.
                            </span>
                            <div class="space-y-2  mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="two_riding[]" value="yes" class="mr-2">
                                    <span class="text-sm font-medium text-black">Show trips that allow two-up riding on a bike</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="two_riding[]" value="no" class="mr-2">
                                    <span class="text-sm font-medium text-black">Show trips that allow a single rider per bike</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-evenly space-x-4">
                        <button type="submit"
                            class="womsm:px-4 womsm:py-2 bg-green text-white rounded-md hover:bg-dark-green primary-button">
                            Show Trips
                        </button>
                        <button type="button" onclick="closeFilterModal()"
                            class="womsm:px-4 womsm:py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 primary-button">
                            Close
                        </button>
                        <button type="button" onclick="clearFilters()"
                            class="womsm:px-4 womsm:py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 primary-button">
                            Reset to default
                        </button>
                    </div>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    let page = 1;
    let isLoading = false;
    let hasMoreData = true;

    function loadMoreTours() {
        if (isLoading || !hasMoreData) return;

        isLoading = true;
        showLoader();

        const urlParams = new URLSearchParams(window.location.search);

        const countries = urlParams.getAll('countries[]'); // Array of selected countries
        const minDays = urlParams.get('min_days'); // Minimum days
        const maxPrice = urlParams.get('max_price'); // Maximum price
        const start = urlParams.get('start'); // Start date
        const tourType = urlParams.getAll('tour_type[]'); // Array of tour types
        const tourLevel = urlParams.getAll('tour_level[]'); // Array of tour levels
        const bikeOptions = urlParams.getAll('bike_options[]'); // Array of bike options
        const ridingGear = urlParams.getAll('riding_gear[]'); // Array of bike options
        const twoRiding = urlParams.getAll('two_riding[]'); // Array for two-riding preference
        $.ajax({
            type: "GET",
            url: "/explore-tours",
            data: {
                page: page + 1,
                countries: countries,
                min_days: minDays,
                max_price: maxPrice,
                start: start,
                tour_type: tourType,
                tour_level: tourLevel,
                bike_options: bikeOptions,
                two_riding: twoRiding,
                search: $('input[name="search"]').val()
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.tours.length > 0) {
                    response.tours.forEach(tour => {
                        // Append the tour HTML to the container
                        $('#tours-container').append(tour.html);
                    });
                    page++;
                } else {
                    hasMoreData = false;
                    $(".load-more").attr('disabled', true);
                    $(".load-more").addClass('gray-button');
                }
                isLoading = false;
                hideLoader();
            },
            error: function(error) {
                isLoading = false;
                hideLoader();
            }
        });
    }

    // Detect when user scrolls near bottom
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 350) {
            loadMoreTours();
        }
    });

    $(document).on("click", ".favourite", function(e) {
        e.preventDefault();
        const icon = $(this).find("img");
        const tourId = icon.attr("data-id");

        $.ajax({
            type: "POST",
            url: "/mark-as-favourite",
            data: {
                tour_id: tourId
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.message === "Tour marked as favourite.!") {
                    icon.attr("src", "{{ asset('images') . '/heart-filled.svg' }}");
                    $(e.currentTarget).removeClass("favourite").addClass("unfavourite");
                }
            },
            error: function(error) {
                window.location.href = "/login";
            }
        });
    });

    $(document).on("click", ".unfavourite", function(e) {
        e.preventDefault();
        const icon = $(this).find("img");
        const tourId = icon.attr("data-id");

        $.ajax({
            type: "POST",
            url: "/delete-favourite",
            data: {
                tour_id: tourId
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.message === "Tour removed from favourite.!") {
                    icon.attr("src", "{{ asset('images') . '/heart-plain.svg' }}");
                    $(e.currentTarget).removeClass("unfavourite").addClass("favourite");
                }
            },
            error: function(error) {
                window.location.href = "/login";
            }
        });
    });

    function openFilterModal() {
        document.getElementById('filterModal').classList.remove('hidden');
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
    }

    function clearFilters() {
        $("#countries").val(null).trigger("change");
        document.getElementById('filterForm').reset();
    }

    // Initialize select2 for multiple select
    $(document).ready(function() {
        $('#countries').select2({
            placeholder: 'Select countries',
            width: '100%',
            allowClear: true,
            dropdownParent: $('#filterModal') // This ensures the dropdown appears above the modal
        });
        const urlParams = new URLSearchParams(window.location.search);

        // Populate select (multi-select) fields
        const countries = urlParams.getAll("countries[]");
        if (countries.length > 0) {
            $("#countries").val(countries).trigger("change"); // Update Select2
        }

        // Populate text/number/date inputs
        const fieldMappings = {
            "min_days": "min_days",
            "start": "start",
            "max_price": "max_price"
        };
        
        for (const param in fieldMappings) {
            const value = urlParams.get(param);
            if (value) {
                document.querySelector(`input[name="${fieldMappings[param]}"]`).value = value;
            }
        }

        // Populate checkboxes (multi-value parameters)
        const multiValueParams = ["tour_type", "tour_level", "bike_options", "riding_gear", "two_riding"];
        
        multiValueParams.forEach(param => {
            const values = urlParams.getAll(`${param}[]`);
            if (values.length > 0) {
                document.querySelectorAll(`input[name="${param}[]"]`).forEach(checkbox => {
                    if (values.includes(checkbox.value)) {
                        checkbox.checked = true;
                    }
                });
            }
        });
    });

    // Handle form submission
    // $('#filterForm').on('submit', function(e) {
    //     const formData = new FormData(this);
    //     console.log('formData', formData);
        
    //     e.preventDefault();

    //     // Show loading state
    //     $('#loading').removeClass('hidden');

    //     $.ajax({
    //         url: '/explore-tours',
    //         type: 'GET',
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         success: function(response) {
    //             $('#tours-container').html(''); // Clear existing tours
    //             response.tours.forEach(tour => {
    //                 $('#tours-container').append(tour.html);
    //             });
    //             closeFilterModal();
    //             page = 1; // Reset pagination
    //             hasMoreData = true; // Reset infinite scroll
    //         },
    //         error: function(error) {
    //             console.error('Error applying filters:', error);
    //         },
    //         complete: function() {
    //             $('#loading').addClass('hidden');
    //         }
    //     });
    // });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('filterModal');
        if (event.target === modal) {
            closeFilterModal();
        }
    }
    function removeFilter(key, value = null) {
        const url = new URL(window.location.href);

        if (value) {
            // Remove only the selected value from array params
            let params = url.searchParams.getAll(key + '[]');
            params = params.filter(v => v !== value);
            url.searchParams.delete(key + '[]');
            params.forEach(v => url.searchParams.append(key + '[]', v));
        } else {
            // Remove the whole param
            url.searchParams.delete(key);
        }
        if (key == 'max_price') {
            url.searchParams.delete('currency');
        }

        window.location.href = url.toString();
    }

</script>
@include('footer')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
