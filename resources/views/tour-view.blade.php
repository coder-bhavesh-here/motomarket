<div class="brand-name">
    <hr>
    <b style="font-size: 32px; color:black; margin: 5% 0;">{{ $tour->title }} - {{ $tour->countries }}</b>
    <hr>
    <div class="slider">
        @foreach ($tour->images as $image)
            <img src="{{ asset('storage') . '/' . $image->image_path }}" class="slide-images" alt="" srcset="">
        @endforeach
    </div>
</div>
<div class="tour-details mt-5">
    <hr>
    <ul>
        <li>We will be touring in: <b>{{ $tour->countries }}</b></li>
        <li>This tour is open to <b>{{ $tour->rider_capability }}</b> riders. Please let us know if you have
            specific requirements.
        </li>
        <li>This tour is
            <b>{{ $tour->riding_style == 'Road' ? 'Road - Adventure on the road; its a road trip' : '' }}
                {{ $tour->riding_style == 'Adventure' ? 'Adventure - Adventure ride on and off road' : '' }}
                {{ $tour->riding_style == 'Enduro' ? 'Enduro - Almost all of the trip is off road' : '' }}</b>
            {{ $tour->riding_style_info != '' ? "( Note: $tour->riding_style_info)" : '' }}
        </li>
        <li>Tour duration is: <b>{{ $tour->duration_days }} days with {{ $tour->rest_days }} rest day.</b></li>
        <li>Maximum number of riders is <b>{{ $tour->max_riders }}</b> and will include <b>{{ $tour->guides }}
                or more guides.</b>
        </li>
        <li><b>{{ $tour->bike_option }}</b>.
            {{ $tour->bike_specification != '' ? 'Note: ' . $tour->bike_specification : '' }}
        </li>
        <li>{{ $tour->two_up_riding ? 'The tour is for 2-up riding.' : 'The tour is not for 2-up riding. Only the rider on the bike.' }}
        </li>
        <li>We will covering: <b>{{ $tour->tour_distance }}Kms</b></li>
        @if ($tour->support == 'Fully Supported with support vehicle')
            <li><b>{{ $tour->support }}</b>: A support vehicle will be availble for complete support during the trip
            </li>
        @endif
        @if ($tour->support == 'Fully Supported without a support vehicle')
            <li><b>{{ $tour->support }}</b>: No support vehicle but the guide(s) and the team will support you with
                technical and riding assistance</li>
        @endif
        @if ($tour->support == 'Group supports each other')
            <li><b>{{ $tour->support }}</b>: The group needs to support each other for technical and riding assistance
            </li>
        @endif
        @if ($tour->support == 'No Support')
            <li><b>{{ $tour->support }}</b>: You need to be self-sufficient. There is no support or assistance planned
                for the trip</li>
        @endif
    </ul>
</div>
<div class="features p-6 inline-flex justify-center w-full">
    <div class="included w-1/2">
        <hr>
        <div class="header inline-flex justify-center items-center">
            <svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title></title>
                <desc></desc>
                <defs></defs>
                <g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
                    <g fill="#000000" id="Icon-41">
                        <path
                            d="M6,52 C6,53.103 6.897,54 8,54 C9.103,54 10,53.103 10,52 C10,50.897 9.103,50 8,50 C6.897,50 6,50.897 6,52 M59.706,30.261 L54.218,52.247 C53.345,55.742 50.904,58 48,58 L33,58 C30.234,58 28.338,56.916 26.504,55.868 C24.823,54.907 23.234,54 21,54 L19,54 C18.448,54 18,53.553 18,53 C18,52.447 18.448,52 19,52 L21,52 C23.766,52 25.662,53.084 27.496,54.132 C29.177,55.093 30.766,56 33,56 L48,56 C50.376,56 51.79,53.717 52.278,51.763 L57.77,29.758 C58.128,28.429 58.08,27.468 57.631,26.882 C57.073,26.153 55.892,26 55,26 L41,26 C39.86,26 38.832,25.624 38,25.005 L38,29 C38,34.047 34.047,38 29,38 C28.448,38 28,37.553 28,37 C28,36.447 28.448,36 29,36 C32.925,36 36,32.925 36,29 L36,9 C36,4.552 33.449,2 29,2 C27.374,2 26,3.374 26,5 L26,15 C26,20.83 21.682,25.467 16,25.957 L16,59 C16,59.553 15.552,60 15,60 L1,60 C0.448,60 0,59.553 0,59 L0,21 C0,20.447 0.448,20 1,20 L15,20 C15.552,20 16,20.447 16,21 C16,21.553 15.552,22 15,22 L2,22 L2,58 L14,58 L14,25 C14,24.447 14.448,24 15,24 C20.047,24 24,20.047 24,15 L24,5 C24,2.243 26.243,0 29,0 C34.551,0 38,3.448 38,9 L38,21 C38,22.683 39.318,24 41,24 L55,24 C56.925,24 58.384,24.576 59.218,25.665 C60.065,26.771 60.229,28.317 59.706,30.261"
                            id="thumb-up"></path>
                    </g>
                </g>
            </svg>
            <span class="ml-3 text-xl">Included</span>
        </div>
        <div class="include-details">
            {!! $tour->included !!}
        </div>
    </div>
    <div class="not-included w-1/2">
        <hr>
        <div class="header inline-flex justify-center items-center">
            <svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title></title>
                <desc></desc>
                <defs></defs>
                <g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
                    <g fill="#000000" id="Icon-41">
                        <path
                            d="M6,52 C6,53.103 6.897,54 8,54 C9.103,54 10,53.103 10,52 C10,50.897 9.103,50 8,50 C6.897,50 6,50.897 6,52 M59.706,30.261 L54.218,52.247 C53.345,55.742 50.904,58 48,58 L33,58 C30.234,58 28.338,56.916 26.504,55.868 C24.823,54.907 23.234,54 21,54 L19,54 C18.448,54 18,53.553 18,53 C18,52.447 18.448,52 19,52 L21,52 C23.766,52 25.662,53.084 27.496,54.132 C29.177,55.093 30.766,56 33,56 L48,56 C50.376,56 51.79,53.717 52.278,51.763 L57.77,29.758 C58.128,28.429 58.08,27.468 57.631,26.882 C57.073,26.153 55.892,26 55,26 L41,26 C39.86,26 38.832,25.624 38,25.005 L38,29 C38,34.047 34.047,38 29,38 C28.448,38 28,37.553 28,37 C28,36.447 28.448,36 29,36 C32.925,36 36,32.925 36,29 L36,9 C36,4.552 33.449,2 29,2 C27.374,2 26,3.374 26,5 L26,15 C26,20.83 21.682,25.467 16,25.957 L16,59 C16,59.553 15.552,60 15,60 L1,60 C0.448,60 0,59.553 0,59 L0,21 C0,20.447 0.448,20 1,20 L15,20 C15.552,20 16,20.447 16,21 C16,21.553 15.552,22 15,22 L2,22 L2,58 L14,58 L14,25 C14,24.447 14.448,24 15,24 C20.047,24 24,20.047 24,15 L24,5 C24,2.243 26.243,0 29,0 C34.551,0 38,3.448 38,9 L38,21 C38,22.683 39.318,24 41,24 L55,24 C56.925,24 58.384,24.576 59.218,25.665 C60.065,26.771 60.229,28.317 59.706,30.261"
                            id="thumb-up"></path>
                    </g>
                </g>
            </svg>
            <span class="ml-3 text-xl">Not Included</span>
        </div>
        <div class="include-details">
            {!! $tour->not_included !!}
        </div>
    </div>
</div>
<div class="description p-6">
    <hr>
    <div class="header">Description</div>
    {!! $tour->tour_description !!}
</div>

<div class="description p-6">
    <hr>
    <div class="header">Meetup Notes</div>
    {!! $tour->tour_meeting_location_notes !!}
    <hr>
</div>
{{--  Tour Questions --}}
<div class="tour-questions p-6">
    <hr>
    <div class="header">Tour Questions</div>
    {{-- Ask a question --}}
    @if (Auth::check())
        <form action="/tour-questions/ask/{{ $tour->id }}" method="post">
            @csrf
            <x-input type="text" label="Question" name="question" />
            <x-button type="submit" outline positive label="Ask" />
        </form>
    @endif
    @if ($tour->tourQuestions->isEmpty())
        <div class="text-center text-2xl">No questions yet.</div>
    @else
        @foreach ($tour->tourQuestions as $question)
            <div style="box-shadow: gray 0px 0px 10px -6px;" class="p-4">
                <div><b>Question (by {{ $question->questionedBy->name }}) on
                        {{ \Carbon\Carbon::parse($question->created_at)->format('F d, Y') }}:</b>
                    {{ $question->question }}</div>
                @if ($question->is_answered)
                    @if (Auth::check() && Auth::user()->id == $question->answered_by)
                        <form action="/tour-questions/answer/{{ $question->id }}" method="post">
                            @csrf
                            <x-input type="text" label="Answer" name="answer" value="{{ $question->answer }}" />
                            <x-button type="submit" outline positive label="Update" />
                        </form>
                    @else
                        <div><b>Answer (By Tour Host):</b>{{ $question->answer }}
                        </div>
                    @endif
                @else
                    @if (Auth::check() && Auth::user()->id == $tour->user_id)
                        {{-- Answer the question if the user is the tour creator --}}
                        <form action="/tour-questions/answer/{{ $question->id }}" method="post">
                            @csrf
                            <x-input type="text" label="Answer" name="answer" />
                            <x-button type="submit" outline positive label="Answer" />
                        </form>
                    @endif
                @endif
            </div>
        @endforeach
    @endif
    <hr>
</div>
<div class="tour-prices p-6 text-2xl text-center">
    <b>
        <div class="header">Tour Prices</div>
    </b>
    @foreach ($tour->prices as $price)
        <div>
            <div class="inline-flex justify-center items-center price">
                <div>{{ \Carbon\Carbon::parse($price->date)->format('F d, Y') }}</div>
                <div class="ml-16">€ {{ $price->price }}</div>
                <div class="ml-16"><x-button onClick="window.location.href='/book/{{ $price->id }}'" outline
                        positive label="Book" /></div>
            </div>
        </div>
    @endforeach
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
