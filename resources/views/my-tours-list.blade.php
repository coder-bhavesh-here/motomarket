<x-app-layout>
    <div class="mx-10 my-2">
        <x-card class="m-5 p-5">
            <p class="text-xl">My Tours</p>
            <a class="btn btn-primary" style="float: right" href="{{ route('tours.create') }}">Create Tour</a>
            <table id="datatable" class="w-full border-collapse border-spacing-2 border border-slate-500 mt-10">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rider Capabillity</th>
                        <th>Duration</th>
                        <th>Max Riders</th>
                        <th>Max Guides</th>
                        <th>Tour Date</th>
                        <th>Total Amount</th>
                        <th>Distance</th>
                        <th>Booked At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $tour)
                        <tr>
                            <td>{{ $tour->title }}</td>
                            <td>{{ $tour->rider_capability }}</td>
                            <td>{{ $tour->duration_days }}</td>
                            <td>{{ $tour->max_riders }}</td>
                            <td>{{ $tour->guides }}</td>
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
