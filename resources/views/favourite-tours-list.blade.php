<x-app-layout>
    <div class="mx-10 my-2">
        <x-card class="m-5 p-5">
            <p class="text-xl">My Favourite Tours</p>
            <table id="datatable" class="w-full border-collapse border-spacing-2 border border-slate-500 mt-10">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rider Capabillity</th>
                        <th>Duration</th>
                        <th>Max Riders</th>
                        <th>Max Guides</th>
                        <th>Distance</th>
                        <th>Bike Options</th>
                        <th>-</th>
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
                            <td>{{ $tour->tour_distance }} Km</td>
                            <td>{{ $tour->bike_option }}</td>
                            <td>
                                <a class="ml-3 fa-solid fa-eye" href="tour/{{ $tour->id }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    </div>
</x-app-layout>
