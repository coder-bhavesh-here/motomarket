@include('new-header')
<style>
    td {
        border: unset;
    }

    .select2-container--default .select2-selection--multiple {
        border-color: #d1d5db;
        line-height: 1.5rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #1E293B !important;
        color: white !important;
        border: 1px solid white;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
    }

    .select2 select2-container select2-container--default {
        margin-bottom: 8px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover,
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
        background-color: #1E293B !important;
    }
</style>
<main class="mt-2 px-6">
    <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > Tour Management</p>
    <span class="block text-orange text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Tour Management</span>
    <div class="w-full grid grid-cols-1 womsm:grid-cols-2 items-center justify-between">
        <form action="/tour-management" method="GET" class="w-full flex">
            <input type="text" value="{{ $search }}" placeholder="Eg: Hard Enduro Tours" name="search" class="mt-3 w-[59%] mr-3 rounded-md text-black">
            <button class="wommd:ml-5 max-w-[218px] mt-2 btn-orange font-bold">Search Your Tours</button>
        </form>
        <span class="justify-self-end bg-slate-100 p-3 max-w-44 border border-orange-500 rounded-md font-semibold text-orange"><a href="/tours/create">+  Add a new tour</a></span>
    </div>
    
    <div class="flex mt-8 mb-14">
        <a href="/tour-management"><span class="cursor-pointer text-center management-option px-6 py-2">Live</span></a>
        <a href="/draft-tour-management"><span class="cursor-pointer text-center ml-4 active-management-option management-option bg-yellow px-6 py-2">Draft</span></a>
        <a href="/hidden-tour-management"><span class="cursor-pointer text-center ml-4 management-option px-6 py-2">Hidden</span></a>
        <a href="/deleted-tour-management"><span class="cursor-pointer text-center ml-4 management-option px-6 py-2">Deleted</span></a>
    </div>
    <div class="w-full">
        {{-- a full width div with bg-parrot class and Live text with bold in it --}}
        <div class="bg-yellow text-white text-center text-xl font-bold py-4">
            <span class="text-lg uppercase">Drafts</span>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="tours-container">
        @foreach ($tours as $tour)
            @if ($tour->status === 'draft')
                <div class="tour-info rounded-3xl">
                    <a href='/tour/{{ $tour->id }}'>
                        <p class="py-2 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">{{ $tour->title }}</p>
                    </a>
                    <div class="tour-details grid grid-cols-1 womsm:grid-cols-4">
                        <div class="h-[80px] womsm:h-auto">
                            <a href='/tour/{{ $tour->id }}'>
                                {{-- <img class="aspect-square rounded-t-lg womsm:rounded-tr-none womsm:rounded-l-lg object-cover h-full w-full"
                                    src="https://worldonmoto.com/storage/uploads/1732685873_2.jpg"
                                    alt="Tour photo"> --}}
                                <img class="aspect-square rounded-t-lg womsm:rounded-tr-none womsm:rounded-l-lg object-cover h-full w-full"
                                    src="{{ isset($tour->images) && isset($tour->images[0]->image_path) ? asset('storage') . '/' . $tour->images[0]->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                                    alt="Tour photo">
                            </a>
                        </div>
                        <div class="tour-description womsm:col-span-3 grid grid-cols-2 wommd:grid-cols-3 relative">
                            <div class="wommd:col-span-2">
                                <div class="badges mt-5 flex flex-wrap items-center">
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/tower.svg' }}" alt="">
                                        <span>{{ $tour->rider_capability }}</span>
                                    </span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/indicator.svg' }}" alt="">
                                        <span>{{ $tour->riding_style }}</span>
                                    </span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/hourglass.svg' }}" alt="">
                                        <span>{{ $tour->duration_days }} days</span>
                                    </span>
                                    @if ($tour->prices->count() > 0)
                                        <span class="edit-badge">
                                            <img src="{{ asset('images') . '/cal.svg' }}" alt="">
                                            <span>{{ $tour->prices[0]->date . ($tour->prices->count() > 1 ? ' (+' . ($tour->prices->count() - 1) . ' more)' : '') }}</span>
                                        </span>
                                    @endif
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/earth.svg' }}" alt="">
                                        <span>{{ $tour->countries }}</span></span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/people.svg' }}" alt="">
                                        <span>{{ $tour->max_riders }}
                                            Riders & {{ $tour->guides }} Guides</span></span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/bike.svg' }}" alt="">
                                        <span>{{ \Illuminate\Support\Str::limit($tour->riding_style_info, $limit = 15, $end = '...') }}</span></span>
                                    <span class="edit-badge">
                                        <img src="{{ asset('images') . '/helmet.svg' }}" alt="">
                                        <span>{{ $tour->bike_option }}</span></span>
                                </div>
                            </div>
                            <ul class="tour-stats text-black" style="font-size: 14px !important; list-style: none;">
                                <li class="flex justify-between"><span class="font-medium">Number of clicks:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Unanswered questions:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Number of people saved:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Number of Reviews:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Tour Ratings:</strong></span><span class="font-semibold">N/A</span></li>
                                <li class="flex justify-between"><span class="font-medium">Bookings:</strong></span><span class="font-semibold">N/A</span></li>
                            </ul>
                            <div class="relative col-span-2 flex items-center justify-start font-semibold bottom-0 w-full mt-2">
                                <div class="flex items-center gap-2">
                                    <a href='/tours/create?activeStep=0&tour_id={{ $tour->id }}' class="edit-button text-xs wommd:text-sm">Edit</a>
                                    <a href='/bookings' class="edit-button text-xs wommd:text-sm">Bookings</a>
                                    <a href='/tour/{{ $tour->id }}' class="edit-button text-xs wommd:text-sm">View</a>
                                    <a href='#' class="edit-button text-xs wommd:text-sm">Hide</a>
                                    <a href='/tour/{{ $tour->id }}' class="delete-button text-xs wommd:text-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</main>

@include('footer')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
