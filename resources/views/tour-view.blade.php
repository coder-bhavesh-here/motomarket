<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
@php
    $currency = $tour->user->tour_currency;
    $symbol = match ($currency) {
        'euro' => '€',
        'usd' => '$',
        'gbp' => '£',
        default => '€',
    };
@endphp
<div class="brand-name">
    <div class="ml-3 grid grid-cols-3">
        <b class="col-span-2 text-base womsm:text-xl wommd:text-2xl text-black font-semibold block mb-4">{{ $tour->title }}
            - {{ $tour->countries }}</b>
        <a href="#dates"
            class="bg-[#556b2f] rounded text-white border-0 w-20 womsm:w-28 wommd:w-40 justify-self-end h-6 womsm:h-8 wommd:h-10 text-xs womsm:text-base wommd:text-lg"
            style="display: flex; justify-content: center; align-items: center; text-decoration: none;"
            >
            See Dates
        </a>
    </div>
    @php
        $nickname = trim($tour->user->tour_nickname ?? '');
        $link = $nickname !== '' ? "/tour-operator/" . $nickname : "#";
    @endphp
    <a href="{{ $link }}">
        <div class="inline-flex justify-center items-center mx-3 mb-3">
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
                    style="width: 40px; height: 40ox; border-radius: 20px;">
            @endif
            <span class="text-xs womsm:text-sm wommd:text-base font-semibold text-black tour-owner ml-4">{{ $tour_operation_name }}</span>
        </div>
    </a>
    <div class="slider">
        @foreach ($tour->images as $image)
            <img src="{{ asset('storage') . '/' . $image->image_path }}" class="slide-images img-with-preview" alt=""
                srcset="">
        @endforeach
    </div>
</div>
<div class="tour-details mx-3 mt-5">
    <span style="font-weight: 900" class="text-black text-sm womsm:text-lg wommd:text-xl">TOUR HIGHLIGHTS</span>
    <ul class="text-[#0F172A]">
        <li class="text-xs womsm:text-sm wommd:text-base">We will be touring in: <b>{{ $tour->countries }}</b></li>
        <li class="text-xs womsm:text-sm wommd:text-base">This tour is open to <b>{{ str_replace(',',', ', $tour->rider_capability) }}</b>
            riders.{{$tour->rider_capability_info}}
        </li>
        <li class="text-xs womsm:text-sm wommd:text-base">This tour is
            <b>{{ $tour->riding_style == 'Road' ? 'Road - Adventure on the road; its a road trip' : '' }}
                {{ $tour->riding_style == 'Adventure' ? 'Adventure - Adventure ride on and off road' : '' }}
                {{ $tour->riding_style == 'Enduro' ? 'Enduro - Almost all of the trip is off road' : '' }}</b>
            {{ $tour->riding_style_info != '' ? "( Note: $tour->riding_style_info)" : '' }}
        </li>
        <li class="text-xs womsm:text-sm wommd:text-base">Tour duration is: <b>{{ $tour->duration_days }} days with
                {{ $tour->rest_days }} rest
                day.</b></li>
        <li class="text-xs womsm:text-sm wommd:text-base">Maximum number of riders is <b>{{ $tour->max_riders }}</b> and
            will include
            <b>{{ $tour->guides }}
                or more guides.</b>
        </li>
        <li class="text-xs womsm:text-sm wommd:text-base"><b>{{ $tour->bike_option }}</b>.
            {{ $tour->bike_specification != '' ? 'Note: ' . $tour->bike_specification : '' }}
        </li>
        <li class="text-xs womsm:text-sm wommd:text-base">
            {{ $tour->two_up_riding ? 'The tour is for 2-up riding.' : 'The tour is not for 2-up riding. Only the rider on the bike.' }}
        </li>
        <li class="text-xs womsm:text-sm wommd:text-base">We will covering: <b>{{ $tour->tour_distance }}Kms</b></li>
        @if ($tour->support == 'Fully Supported with support vehicle')
            <li class="text-xs womsm:text-sm wommd:text-base"><b>{{ $tour->support }}</b>: A support vehicle will be
                availble for
                complete support
                during the trip
            </li>
        @endif
        @if ($tour->support == 'Fully Supported without a support vehicle')
            <li class="text-xs womsm:text-sm wommd:text-base"><b>{{ $tour->support }}</b>: No support vehicle but the
                guide(s) and the
                team will
                support you with
                technical and riding assistance</li>
        @endif
        @if ($tour->support == 'Group supports each other')
            <li class="text-xs womsm:text-sm wommd:text-base"><b>{{ $tour->support }}</b>: The group needs to support
                each other for
                technical and
                riding assistance
            </li>
        @endif
        @if ($tour->support == 'No Support')
            <li class="text-xs womsm:text-sm wommd:text-base"><b>{{ $tour->support }}</b>: You need to be
                self-sufficient. There is no
                support or
                assistance planned
                for the trip</li>
        @endif
    </ul>
</div>
<div class="text-[#0F172A] mx-3 mt-4 text-xs womsm:text-sm wommd:text-base font-medium">
    {!! $tour->tour_description !!}
</div>
<div class="features mx-3 grid grid-cols-1 womsm:grid-cols-2 justify-center w-full">
    <div class="included mt-4">
        <div class="header inline-flex justify-center items-center">
            <img src="{{ asset('images/like.png') }}" alt="Included">
            <span class="ml-3 text-base womsm:text-lg wommd:text-xl font-bold text-[#556B2F]">What’s included</span>
        </div>
        <div class="text-xs mt-6 womsm:text-sm wommd:text-base wommd:mr-12 text-[#0F172A]">
            {!! $tour->included !!}
        </div>
    </div>
    <div class="not-included mt-4">
        <div class="header inline-flex justify-center items-center">
            <img src="{{ asset('images/dislike.png') }}" alt="Not Included">
            <span class="ml-3 text-base womsm:text-lg wommd:text-xl font-bold text-[#B91C1C]">What’s not included</span>
        </div>
        <div class="text-xs mt-6 womsm:text-sm wommd:text-base text-[#0F172A]">
            {!! $tour->not_included !!}
        </div>
    </div>
</div>

<div class="my-6 mx-3" id="dates">
    @php
        $grouped = $tour->prices->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('F Y'); // Group by "Month Year"
        });
        $counter = 0;
    @endphp
    @foreach ($grouped as $monthName => $prices)
        <div class="accordion mt-2" id="accordionExample">
            <div class="accordion-item" style="border: 0 !important;">
                <h2 class="accordion-header" id="heading{{ $counter }}">
                    <button class="border-0 accordion-button text-base womsm:text-lg wommd:text-xl font-bold text-black"
                        style="background-color: #f2f2f2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $counter }}" aria-controls="collapse{{ $counter }}">
                        {{ $monthName }}
                    </button>
                </h2>
                <div id="collapse{{ $counter }}" class="accordion-collapse show" style="background-color: #f2f2f2"
                    aria-labelledby="heading{{ $counter }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body justify-items-center" style="padding: 0.75rem">
                        @php
                            $tac = 0;
                        @endphp
                        @foreach ($prices as $key => $price)
                            <div
                                class="inline-flex rounded-sm w-full justify-between womsm:justify-start items-center p-3 {{ $tac % 2 === 0 ? 'bg-customlightgreen' : '' }}">
                                <div class="text-xs w-40 womsm:text-sm text-left wommd:text-base text-[#0F172A]">
                                    {{ \Carbon\Carbon::parse($price->date)->format('F d, Y') }}</div>
                                <div class="text-xs text-end womsm:text-sm wommd:text-base womsm:ml-8 w-32 wommd:ml-16 font-bold text-[#0F172A]">
                                    {{ $symbol ." " . number_format($price->price, 2) }}</div>
                                @php
                                    $hasAddons = $price->tour->addonGroups()->exists();
                                    $bookUrl = $hasAddons ? "/bookAddon/{$price->id}" : "/book/{$price->id}";
                                @endphp
                                <div class="text-xs womsm:text-sm text-right wommd:text-base womsm:ml-8 wommd:ml-16 font-bold text-[#0F172A]">
                                    <a class="text-[#556B2F]" href="{{ $bookUrl }}">BOOK</a>
                                </div>
                            </div>
                            @php
                                $counter++;
                                $tac++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{--  Tour Questions --}}
<div class="mt-4 mx-3">
    <span style="font-weight: 900" class="text-black text-sm womsm:text-lg wommd:text-xl">
        ASK THE TOUR OPERATOR A QUESTION
    </span>
    <form action="/tour-questions/ask/{{ $tour->id }}" method="post">
        @csrf
        <span class="block mt-4 text-black text-sm wommd:text-base">Ask your questions and the tour operator will answer
            them for you</span>
        <textarea class="mt-4 w-full rounded-sm" type="text" name="question"></textarea>
        <x-button class="my-4 primary-button" type="submit" label="Submit" />
    </form>
</div>
<div class="mt-4 mx-3">
    <span style="font-weight: 900" class="text-black text-sm womsm:text-lg wommd:text-xl">
        PREVIOUSLY ANSWERED QUESTIONS
    </span>
    @if ($tour->tourQuestions == null)
        <div class="text-center text-2xl">No questions yet.</div>
    @else
        @foreach ($tour->tourQuestions as $question)
            <div class="pt-4 text-black">
                <div class="text-base womsm:text-lg wommd:text-xl">Q. {{ $question->question }}</div>
                @if ($question->is_answered)
                    @if (Auth::check() && Auth::user()->id == $question->answered_by)
                        <form action="/tour-questions/answer/{{ $question->id }}" method="post">
                            @csrf
                            <x-input type="text" label="A." name="answer" value="{{ $question->answer }}" />
                            <x-button type="submit" class="primary-button mt-2" label="Update" />
                        </form>
                    @else
                        <div class="text-xs womsm:text-sm wommd:text-base mt-1 ml-1">A. {{ $question->answer }}</div>
                        @if (Auth::check() && Auth::user()->id == $tour->user_id)
                            {{-- Answer the question if the user is the tour creator --}}
                            <form action="/tour-questions/answer/{{ $question->id }}" method="post">
                                @csrf
                                <x-input type="text" label="Answer" name="answer" />
                                <x-button type="submit" outline positive label="Answer" />
                            </form>
                        @endif
                    @endif
                @endif
            </div>
        @endforeach
    @endif
</div>
<script>
    $(".slider").slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
    });
</script>
