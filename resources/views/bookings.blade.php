<x-app-layout>
    <style>
        td {
            border: unset !important;
        }
        tr {
            border-radius: 11px !important;
        }
    </style>
    <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Tour Bookings/Customers</p>
            <span class="block text-orange text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Tour Bookings/Customers</span>
            <form action="/bookings" method="GET">
                <div class="grid grid-cols-1 womsm:grid-cols-1 wommd:grid-cols-4">
                    <input type="text" name="title"
                        class="mt-5 w-[80%] rounded-md text-black" placeholder="Eg: Hard Enduro Tours">
                    <input type="date" name="date"
                        class="mt-5 w-[80%] rounded-md text-black" placeholder="Tour Date">
                </div>
                <button type="submit" class="btn-orange mt-5">Show Bookings</button>
            </form>
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
</x-app-layout>
