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
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <a class="btn btn-primary" style="float: right" href="{{ route('tours.create') }}">Create Tour</a>
                <table id="datatable" class="w-full border-collapse border-spacing-2 border border-slate-500 mt-10">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Total Bookings</th>
                            <th>Liked/Saved By</th>
                            <th>Latest Planned Tour on</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tours as $tour)
                            <tr style="cursor: pointer" onclick="window.location.href = 'tour/{{ $tour->id }}'">
                                <td>{{ $tour->title }}</td>
                                <td>
                                    <span
                                        class="{{ $tour->status === 'draft' ? 'badge' : 'badge-positive' }}">{{ ucfirst($tour->status) }}</span>
                                </td>
                                <td>{{ isset($bookingsCount[$tour->id]) ? $bookingsCount[$tour->id] : 0 }}</td>
                                <td>{{ isset($savedCount[$tour->id]) ? $savedCount[$tour->id] : 0 }}</td>
                                <td>{{ isset($upcomingTours[$tour->id]) ? $upcomingTours[$tour->id] : '-' }}</td>
                                <td>{{ $tour->created_at }}</td>
                                <td>
                                    <a class="ml-3 fa-solid fa-eye" href="tour/{{ $tour->id }}"
                                        onmouseover="openModal({{ $tour->id }})"></a>
                                    <a class="ml-3 fa-solid fa-pencil"
                                        href="tours/create?tour_id={{ $tour->id }}&activeStep=0"></a>
                                    {{-- <i class="ml-3 fa-solid fa-trash" /> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div x-data="{ open: false, tourId: null }" x-show="open" class="modal" x-on:close="open = false" style="display: none;">
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-black bg-opacity-50 absolute inset-0 closeModal"></div>
            <div class="bg-white rounded-lg p-6 shadow-xl z-10 w-3/4">
                <button class="absolute top-2 right-2 text-red-500 closeModal">X</button>
                <div x-show="tourId" class="tour-content max-h-[80vh] overflow-y-auto">
                    <!-- Tour content will load here -->
                    <div x-text="tourId"></div> <!-- Replace with dynamic content loading -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".closeModal").click(function(e) {
            e.preventDefault();
            $(".modal").hide();
            $('.tour-content').html("");
        });

        function openModal(tourId) {
            // Set tourId to be passed for fetching
            $(".modal").show();
            this.tourId = tourId;
            this.open = true;

            // Fetch the tour content via AJAX
            fetch(`/tour/${tourId}`)
                .then(response => response.text())
                .then(data => {
                    let tempElement = document.createElement('div');

                    tempElement.innerHTML = data;
                    let headerTag = tempElement.querySelector('header');
                    let footerTag = tempElement.querySelector('footer');
                    if (headerTag) {
                        headerTag.remove();
                    }
                    if (footerTag) {
                        footerTag.remove();
                    }
                    document.querySelector('.tour-content').innerHTML = tempElement.innerHTML;
                    $(".slider").slick({
                        dots: true,
                        infinite: true,
                        speed: 300,
                        slidesToShow: 1,
                        centerMode: true,
                        variableWidth: true,
                    });
                })
                .catch(error => console.log('Error fetching tour content:', error));
        }
    </script>

    </script>
</x-app-layout>
