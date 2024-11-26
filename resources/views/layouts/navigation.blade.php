<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (Auth::user()->role === 'agency')
                        <x-nav-link :href="route('tours')" :active="request()->routeIs('tours')">
                            {{ __('Tours') }}
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'user')
                        <x-nav-link :href="route('my-tours')" :active="request()->routeIs('my-tours')">
                            {{ __('My Tours') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 w-64">
                <!-- Profile Button -->
                <x-dropdown-link :href="route('profile.edit')"
                    class="w-full text-gray-800 dark:text-gray-200 font-semibold hover:bg-gray-100 dark:hover:bg-gray-900 px-3 py-2 rounded-md transition duration-150 ease-in-out">
                    {{ Auth::user()->name }}
                </x-dropdown-link>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
            <div id="menuToggle">
                <input type="checkbox" />
                <span></span><span></span><span></span>
                <ul id="menu">
                    <a href="/dashboard">
                        <li>Dashboard</li>
                    </a>
                    <a href="/tours">
                        <li>Tours</li>
                    </a>
                    <a href="/profile">
                        <li>Profile</li>
                    </a>
                    <a href="#">
                        <form method="POST" class="w-full" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                                class="w-full p-0">
                                <li class="w-full">
                                    {{ __('Log Out') }}
                                </li>
                            </a>
                        </form>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}s
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
