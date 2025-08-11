<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <span class="block text-orange text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Tour Bookings/Customers</span>
            <div>
                <table id="datatable" class="w-full border-collapse border-spacing-2 border border-slate-500 mt-10">
                    <thead>
                        <tr>
                            <th>RIDER NAME</th>
                            <th>PAID</th>
                            <th>INDEMNITY CONFIRMED</th>
                            <th>PHONE</th>
                            <th>EMAIL</th>
                            <th>EMERGENCY CONTACT #1</th>
                            <th>EMERGENCY CONTACT #2</th>
                            <th>EMERGENCY CONTACT #3</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $tour)
                            <tr>
                                <td>{{ $tour->name }}</td>
                                <td>25%</td>
                                <td>YES</td>
                                <td>{{ $tour->mobile_number }}</td>
                                <td>{{ $tour->email }}</td>
                                @php
                                // dd($tour->user_id);
                                $emergencyContact = \App\Models\EmergencyContact::where('user_id', $tour->user_id)->first();
                                @endphp
                                <td>{{(isset($emergencyContact->emergency_contact_1_name) &&($emergencyContact->emergency_contact_1_name !='') ? $emergencyContact->emergency_contact_1_name : '-').(isset($emergencyContact->emergency_contact_1_phone) &&($emergencyContact->emergency_contact_1_phone !='') ? $emergencyContact->emergency_contact_1_phone : '-').(isset($emergencyContact->emergency_contact_1_email) &&($emergencyContact->emergency_contact_1_email !='') ? $emergencyContact->emergency_contact_1_email : '-')}}</td>
                                <td>{{(isset($emergencyContact->emergency_contact_2_name) &&($emergencyContact->emergency_contact_2_name !='') ? $emergencyContact->emergency_contact_2_name : '-').(isset($emergencyContact->emergency_contact_2_phone) &&($emergencyContact->emergency_contact_2_phone !='') ? $emergencyContact->emergency_contact_2_phone : '-').(isset($emergencyContact->emergency_contact_2_email) &&($emergencyContact->emergency_contact_2_email !='') ? $emergencyContact->emergency_contact_2_email : '-')}}</td>
                                <td>{{(isset($emergencyContact->emergency_contact_3_name) &&($emergencyContact->emergency_contact_3_name !='') ? $emergencyContact->emergency_contact_3_name : '-').(isset($emergencyContact->emergency_contact_3_phone) &&($emergencyContact->emergency_contact_3_phone !='') ? $emergencyContact->emergency_contact_3_phone : '-').(isset($emergencyContact->emergency_contact_3_email) &&($emergencyContact->emergency_contact_3_email !='') ? $emergencyContact->emergency_contact_3_email : '-')}}</td>
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
