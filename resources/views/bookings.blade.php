<x-app-layout>
    <style>
        td {
            border: unset !important;
        }
        tr {
            border-radius: 11px !important;
        }
    </style>
    @php
        $lastSegment = request()->segment(count(request()->segments()));
    @endphp

    {{-- Agar last segment numeric hai to Tour ID maan lo --}}
    @if(is_numeric($lastSegment))
        @php
            $today = now()->toDateString();
            $tour = \App\Models\Tour::with(['prices' => function ($query) use ($today) {
                $query->where('date', '>=', $today)   // future or today ke dates
                    ->orderBy('date', 'asc')       // earliest date first
                    ->limit(1);                    // sirf ek record
            }])
            ->find($lastSegment);
        @endphp
    @endif
    <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Tour Bookings/Customers</p>
            <span class="block text-orange text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Tour Bookings/Customers</span>
            @php
                $segments = request()->segments();
                $lastSegment = end($segments);
            @endphp

            <form action="{{ is_numeric($lastSegment) ? url('bookings/' . $lastSegment) : url('bookings') }}" method="GET">
                <div class="grid grid-cols-1 womsm:grid-cols-1 wommd:grid-cols-4">
                    <div class="grid">
                        <div class="font-bold text-black">
                            Tour Title
                        </div>
                        <input type="text" name="title"
                            class="mt-2 w-[80%] rounded-md text-black" placeholder="Eg: Hard Enduro Tours" value="{{$title}}">
                    </div>
                    <div class="grid">
                        <div class="font-bold text-black">
                            Tour Date
                        </div>
                        <input type="date" name="date"
                            class="mt-2 w-[80%] rounded-md text-black" placeholder="Tour Date" value="{{$date}}">
                    </div>
                    <div class="grid">
                        <div class="font-bold text-black">
                        </div>
                        <a class="flex items-center text-black underline font-bold" onclick="openFilterModal()" href="#modal">Select Tour</a>
                    </div>
                </div>
                <button type="submit" class="btn-orange mt-5">Show Bookings</button>
            </form>
            <!-- Filter Modal -->
            <div id="filterModal" class="absolute inset-0 backdrop-blur-md z-50 hidden" style="background: #00000042;">
                <div style="max-height: calc(100vh - 120px) !important;" class="bg-white rounded-lg py-4 px-2 wommd:p-8 womsm:max-w-[80%] wommd:max-w-[75%] womsm:mx-auto womsm:mt-20 relative" style="box-shadow: 0 0 10px 0px gray;">
                    <svg onclick="closeFilterModal()"
                        class="cursor-pointer absolute m-4 top-4 right-4 text-gray-500 hover:text-gray-700 w-6 h-6" width="32"
                        height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
                        <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
                    </svg>


                    <h2 class="text-base womsm:text-xl wommd:text-2xl font-semibold ml-5 wommd:ml-0 mt-4 mb-6 text-black text-left wommd:text-center">Edit Filters</h2>

                    <div class="w-full justify-items-center">
                        <form id="filterForm" class="w-full womsm:w-5/6 wommd:w-4/5 space-y-6 px-4">
                            <div class="w-full grid grid-cols-1 wommd:grid-cols-2 gap-6">
                                <div class="grid grid-cols-1">
                                    <div class="wommd:pb-6 w-full">
                                        <label for="tour" class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:mr-3 wommd:w-[-15%]">Tour</label>
                                    </div>
                                    <div class="pb-6 col-span-2 w-full">
                                        <select id="tour" name="tour"
                                            class="w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">- Select Tour -</option>
                                            @foreach ($tours as $tour)
                                                <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1">
                                    <div class="wommd:pb-6 w-full">
                                        <label for="dates" class="block text-sm womsm:text-base wommd:text-lg text-black font-medium text-left wommd:mr-3 wommd:w-[-15%]">Dates</label>
                                    </div>
                                    <div class="pb-6 col-span-2 w-full" id="dateList">
                                        <span class="text-black">No dates available.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-evenly space-x-4">
                                <button type="submit"
                                    class="womsm:px-4 womsm:py-2 bg-green text-white rounded-md hover:bg-dark-green primary-button">
                                    Show Bookings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <table class="border-separate border-spacing-y-3 w-full mt-10 block overflow-x-scroll 2xl:overflow-hidden">
                    <thead>
                        <tr class="bg-orange-600 text-white">
                            <th class="px-4 py-2 rounded-l-xl">RIDER NAME</th>
                            <th class="px-4 py-2">PAID</th>
                            <th class="px-4 py-2">INDEMNITY CONFIRMED</th>
                            <th class="px-4 py-2">PHONE</th>
                            <th class="px-4 py-2">EMAIL</th>
                            <th class="px-4 py-2">EMERGENCY CONTACT #1</th>
                            <th class="px-4 py-2">EMERGENCY CONTACT #2</th>
                            <th class="px-4 py-2 rounded-r-xl">EMERGENCY CONTACT #3</th>
                        </tr>
                    </thead>
                    <tbody style="color: black;">
                        @foreach ($bookings as $tour)
                            <tr class="{{ $loop->odd ? 'bg-[#E8E8E8]' : 'bg-[#FFF4F4]' }} rounded-xl overflow-hidden" style="border: unset">
                                <td style="text-align: center !important;" class="px-4 py-3 rounded-l-xl">{{ $tour->name }}</td>
                                @php
                                    $booking = \App\Models\Booking::find($tour->id);
                                    $priceId = $booking->tour_date_id;
                                    $price = \App\Models\TourPrice::find($priceId);
                                    $selectedDate = $price;
                                    $booking = \App\Models\Booking::where('tour_date_id', $priceId)->where('user_id', auth()->user()->id)->first();
                                    $addons = [];
                                    $addonPrices = 0;
                                    foreach($addons as $addon) {
                                        $addonPrices = $addonPrices + $addon->price;
                                    }
                                    if (isset($booking->addons) && $booking->addons != null) {
                                        $addonIds = explode(',', $booking->addons);
                                        $addons = \App\Models\Addon::with('group')->whereIn('id', $addonIds)->get();
                                    }
                                @endphp
                                <td style="text-align: center !important;" class="px-4 py-3">
                                    @if (isset($booking->amount) && isset($selectedDate->price) && $booking->amount < $selectedDate->price + $addonPrices)
                                        25%
                                    @else
                                        100%
                                    @endif
                                </td>
                                <td style="text-align: center !important;" class="px-4 py-3">YES</td>
                                <td style="text-align: center !important;" class="px-4 py-3">{{ $tour->mobile_number }}</td>
                                <td style="text-align: center !important;" class="px-4 py-3">{{ $tour->email }}</td>
                                @php
                                // dd($tour->user_id);
                                $emergencyContact = \App\Models\EmergencyContact::where('user_id', $tour->user_id)->first();
                                @endphp
                                <td class="px-10 text-xs py-3">{!!(isset($emergencyContact->emergency_contact_1_name) &&($emergencyContact->emergency_contact_1_name !='') ? $emergencyContact->emergency_contact_1_name : '-').'<br>'.(isset($emergencyContact->emergency_contact_1_phone) &&($emergencyContact->emergency_contact_1_phone !='') ? $emergencyContact->emergency_contact_1_phone : '-').'<br>'.(isset($emergencyContact->emergency_contact_1_email) &&($emergencyContact->emergency_contact_1_email !='') ? $emergencyContact->emergency_contact_1_email : '-')!!}</td>
                                <td class="px-10 text-xs py-3">{!!(isset($emergencyContact->emergency_contact_2_name) &&($emergencyContact->emergency_contact_2_name !='') ? $emergencyContact->emergency_contact_2_name : '-').'<br>'.(isset($emergencyContact->emergency_contact_2_phone) &&($emergencyContact->emergency_contact_2_phone !='') ? $emergencyContact->emergency_contact_2_phone : '-').'<br>'.(isset($emergencyContact->emergency_contact_2_email) &&($emergencyContact->emergency_contact_2_email !='') ? $emergencyContact->emergency_contact_2_email : '-')!!}</td>
                                <td class="px-10 text-xs py-3 rounded-r-xl">{!!(isset($emergencyContact->emergency_contact_3_name) &&($emergencyContact->emergency_contact_3_name !='') ? $emergencyContact->emergency_contact_3_name : '-').'<br>'.(isset($emergencyContact->emergency_contact_3_phone) &&($emergencyContact->emergency_contact_3_phone !='') ? $emergencyContact->emergency_contact_3_phone : '-').'<br>'.(isset($emergencyContact->emergency_contact_3_email) &&($emergencyContact->emergency_contact_3_email !='') ? $emergencyContact->emergency_contact_3_email : '-')!!}</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($tour->date)->format('F d, Y') }}</td>
                                <td>€ {{ $tour->amount }}</td>
                                <td>{{ \Carbon\Carbon::parse($tour->created_at)->format('F d, Y H:i A') }}</td> --}}
                                {{-- <td><a target="_blank" href="tour/{{ $tour->id }}"><u>View Tour ></u></a> --}}
                                {{-- </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $("#tour").change(function (e) { 
            e.preventDefault();
            let tourId = $(this).val();
            if(tourId) {
                $.ajax({
                    url: "{{ route('getTourDates', '') }}/" + tourId,
                    type: "GET",
                    success: function (dates) {
                        let html = "";

                        if(dates.length > 0){
                            dates.forEach(function(date, index){
                                html += `
                                    <label class="flex items-center space-x-2 mb-2">
                                        <input type="radio" name="tour_date" value="${date}" class="form-radio text-green-600">
                                        <span>${date}</span>
                                    </label>
                                `;
                            });
                        } else {
                            html = `<span class="text-black">No dates available.</span>`;
                        }

                        $("#dateList").html(html);
                    },
                    error: function () {
                        $("#dateList").html(`<span class="text-red-500">Error loading dates.</span>`);
                    }
                });
            } else {
                $("#dateList").html(`<span class="text-black">No dates available.</span>`);
            }
        });
        function openFilterModal() {
            document.getElementById('filterModal').classList.remove('hidden');
            document.body.style.overflowY = "hidden";
        }

        function closeFilterModal() {
            document.getElementById('filterModal').classList.add('hidden');
            document.body.style.overflowY = "scroll";
        }
    </script>
</x-app-layout>
