@include('new-header')
<wireui:scripts />
<div class="w-full">
    <div class="text-center text-lg womsm:text-xl wommd:text-2xl text-black font-bold">Woohoo! you are going on a adventure to {{ $tour->countries }}!</div>
    <div class="text-center">
        <div class="inline-flex justify-center items-center my-5">
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
        <div class="mt-5">
            @php
                use Carbon\Carbon;
                $now = Carbon::now()->startOfDay();
                $startDate = Carbon::parse($date)->startOfDay();
                $paymentDate = (clone $startDate)->subDays(30);
                $daysToGo = $now->diffInDays($startDate, false);
                $daysToGo = max(0, round($daysToGo));
                $digits = str_split($daysToGo);
            @endphp

            <div class="flex justify-center gap-2 mt-4">
                @foreach($digits as $digit)
                    <div class="bg-[#556B2F] text-white min-w-[70px] text-2xl womsm:text-3xl wommd:text-4xl font-bold rounded-md" style="padding: 20px 15px;">
                        {{ $digit }}
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4 text-lg womsm:text-xl wommd:text-2xl font-bold text-[#0F172A]">
                DAYS TO GO
            </div>
        </div>
        <div class="mt-6">
            <div class="mt-2">You booking is confirmed and we have informed the tour organizer about your attendance.</div>
            @if ($price > $booking->amount)
                <div class="mt-2">You will need to <strong>pay the outstanding amount</strong> before the {{ $paymentDate->format('d-M-Y') }}.</div>
            @endif
            <div class="mt-2">We have saved the booking in your account. You can <a href="/details/{{$booking->id}}" class="text-green underline">see it here</a></div>
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        <div class="w-11/12 success h-[700px]">
            <img class="aspect-square object-cover h-full w-full" src="{{ asset('images/bike2.jpg') }}" alt="Bike Image 2">
        </div>
    </div>
</div>
@include('footer')
