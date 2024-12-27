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
                <a href="{{ route('blogsbyrankothcj.create') }}" class="btn btn-primary">Create New Blog</a>
                {{-- <ul> --}}
                @foreach ($blogs as $blog)
                    <div class="m-5">
                        <x-card class="flex justify-between items-center">
                            <div><strong>{{ $blog->title }}</strong></div>
                            <div>
                                <a href="{{ route('blogsbyrankothcj.edit', $blog->id) }}"><button
                                        class="p-2">Edit</button></a>
                                <form action="{{ route('blogsbyrankothcj.destroy', $blog->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2" type="submit">Delete</button>
                                </form>
                            </div>
                        </x-card>
                    </div>
                @endforeach
                {{-- </ul> --}}
            </div>
        </div>
    </div>
</x-app-layout>
