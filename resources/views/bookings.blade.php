<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('tours.profile')" :active="request()->routeIs('tours.profile')">
                {{ __('Tour Profile') }}
            </x-nav-link>
            <x-nav-link :href="route('tours.settings')" :active="request()->routeIs('tours.settings')">
                {{ __('Tour Creation Settings') }}
            </x-nav-link>
            <x-nav-link :href="route('tours')" :active="request()->routeIs('tours')">
                {{ __('Tour Advertising') }}
            </x-nav-link>
            <x-nav-link :href="route('bookings')" :active="request()->routeIs('bookings')">
                {{ __('Booking Orders') }}
            </x-nav-link>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table id="datatable" class="w-full border-collapse border-spacing-2 border border-slate-500 mt-10">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Tour Date</th>
                            <th>Total Amount</th>
                            <th>Booked At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $tour)
                            <tr>
                                <td>{{ $tour->title }}</td>
                                <td>{{ $tour->name }}</td>
                                <td>{{ $tour->mobile_number }}</td>
                                <td>{{ \Carbon\Carbon::parse($tour->date)->format('F d, Y') }}</td>
                                <td>€ {{ $tour->amount }}</td>
                                <td>{{ \Carbon\Carbon::parse($tour->created_at)->format('F d, Y H:i A') }}</td>
                                <td><a target="_blank" href="tour/{{ $tour->id }}"><u>View Tour ></u></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
