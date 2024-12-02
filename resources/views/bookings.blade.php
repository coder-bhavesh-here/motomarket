<x-app-layout>
    <div class="mx-10 my-2">
        <x-card class="m-5 p-5">
            <p class="text-xl">My Tours</p>
            <a class="btn btn-primary" style="float: right" href="{{ route('tours.create') }}">Create Tour</a>
            <table id="datatable" class="w-full border-collapse border-spacing-2 border border-slate-500 mt-10">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Nationality</th>
                        <th>Mobile Number</th>
                        <th>Tour Date</th>
                        <th>Total Amount</th>
                        <th>Distance</th>
                        <th>Booked At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $tour)
                        <tr>
                            <td>{{ $tour->title }}</td>
                            <td>{{ $tour->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($tour->dob)->format('F d, Y') }}</td>
                            <td>{{ $tour->nationality }}</td>
                            <td>{{ $tour->mobile_number }}</td>
                            <td>{{ \Carbon\Carbon::parse($tour->date)->format('F d, Y') }}</td>
                            <td>€ {{ $tour->amount }}</td>
                            <td>{{ $tour->tour_distance }} Km</td>
                            <td>{{ \Carbon\Carbon::parse($tour->created_at)->format('F d, Y H:i A') }}</td>
                            <td><a target="_blank" href="tour/{{ $tour->id }}"><u>View Tour ></u></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    </div>
</x-app-layout>
