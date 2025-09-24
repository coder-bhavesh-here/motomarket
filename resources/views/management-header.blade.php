<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>World On Moto</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/carousel/carousel.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/carousel/carousel.thumbs.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/carousel/carousel.lazyload.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/carousel/carousel.arrows.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased dark:bg-black dark:text-white/50 bg-[#f9fafb]">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Global Image Preview Modal -->
    <div id="globalImageModal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-85 hidden">
        <div class="relative">
            <button onclick="closeGlobalImageModal()" class="absolute top-2 right-2 text-white text-3xl font-bold" style="border: unset !important;">
                &times;
            </button>
            <img id="globalModalImage" src="" class="max-w-screen-lg max-h-screen rounded shadow-lg" />
        </div>
    </div>
    <div id="loading" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <img src="/images/loader.gif" alt="Loading..." class="w-16 h-16">
    </div>
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50" style="max-width: 1920px; width: 100%; margin: 0 auto;">
        <div class="relative min-h-screen flex flex-col selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full">
                <header class="grid grid-cols-2 items-center gap-2 wommd:grid-cols-3 pt-2 px-4">
                    <a href="{{ route('homepage') }}">
                        <div class="flex items-center lg:justify-start lg:col-start-1">
                            <img class="womsm:w-2/4 wommd:w-2/4 ml-2" src="{{ asset('images/management-logo.png') }}"
                                alt="Logo">
                        </div>
                    </a>
                    <div class="hidden wommd:block lg:justify-center lg:col-start-2">
                        {{-- <div class="hidden wommd:block lg:justify-center lg:col-start-2" style="
                            background: red;
                            color: white;
                            font-size: xx-large;
                            text-align: center;
                        ">
                        DEMO SITE <br> UNDER TESTING

                                            </div> --}}
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 hidden womsm:flex flex-1 items-center justify-end mr-8">
                            @auth
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-bold text-xs wommd:text-base rounded-md womsm:max-wommd:p-2 px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Sign in
                                </a>

                                <a href="{{ route('register') }}"
                                    class="font-bold text-xs wommd:text-base rounded-md womsm:max-wommd:p-2 px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Sign up
                                </a>
                            @endauth
                            @auth
                                @php
                                    $incompleteCount = \App\Models\IncompleteBooking::where('user_id', auth()->id())->distinct('tour_id')->count();
                                @endphp
                                <a class="relative inline-block icon-box ml-4" href="/my-incomplete-tours">
                                    <img src="{{ asset('images/motorcycle.svg') }}" alt="Bike">
                                    @if($incompleteCount > 0)
                                        <span style="background: red;" class="absolute -top-2 -right-2 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
                                            {{ $incompleteCount }}
                                        </span>
                                    @endif
                                </a>
                                <span class="relative inline-block icon-box ml-4">
                                    @php
                                        $favouriteCount = auth()->user()->favouriteTours->count();
                                    @endphp
                                    <a href="/my-favourite-tours">
                                        <svg style="margin-left: 7px; margin-top: 3px;" width="24" height="22"
                                            viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.0794 2.96982C20.5362 2.4247 19.8907 1.99217 19.1799 1.69705C18.4692 1.40192 17.7071 1.25 16.9376 1.25C16.168 1.25 15.4059 1.40192 14.6952 1.69705C13.9844 1.99217 13.3389 2.4247 12.7957 2.96982L11.9619 3.81444L11.1281 2.96982C10.5849 2.4247 9.9394 1.99217 9.22865 1.69705C8.51789 1.40192 7.75587 1.25 6.98629 1.25C6.2167 1.25 5.45468 1.40192 4.74392 1.69705C4.03317 1.99217 3.38767 2.4247 2.84443 2.96982C0.548821 5.26544 0.408053 9.14199 3.29923 12.0873L11.9619 20.75L20.6246 12.0873C23.5158 9.14199 23.375 5.26544 21.0794 2.96982Z"
                                                stroke="#D1E7AB" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        @if($favouriteCount > 0)
                                            <span style="background: red;" class="absolute -top-2 -right-2 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
                                                {{ $favouriteCount }}
                                            </span>
                                        @endif
                                    </a>
                                </span>
                            @endauth
                            <span class="ml-4">
                                @auth
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <a href="{{ url('/profiles') }}">
                                    @endauth
                                    @if (isset($user) && $user != null && $user->profile_picture)
                                        <img id="profile-picture-img" style="height: 47px; width: 47px;"
                                            src="{{ asset('storage/' . $user->profile_picture) }}"
                                            alt="Profile Picture" class="rounded-full">
                                    @else
                                        <a href="/profiles"><img src="{{ asset('images/user.png') }}" alt=""></a>
                                    @endif
                                    @auth
                                    </a>
                                @endauth
                            </span>
                        </nav>
                        <img class="block womsm:hidden justify-self-end" onclick="openPopup()"
                            src="{{ asset('images/menu.png') }}" alt="Menu">
                    @endif
                </header>

                <!-- Add this right after your existing header section -->
                <div id="fullScreenPopup"
                    class="fixed womsm:hidden inset-0 transform translate-x-full transition-transform duration-300 ease-in-out bg-[#EEEEEE]">
                    <div class="relative w-full h-full py-14 px-4">
                        <!-- Close button -->
                        <button onclick="closePopup()" style="border: unset !important"
                            class="absolute bottom-20 left-1/2 z-50">
                            <svg width="32" height="31" viewBox="0 0 32 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2"
                                    stroke-linecap="round" />
                                <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </button>

                        <!-- Content container -->
                        <div class="text-center font-semibold text-base text-black h-full overflow-y-auto p-8">
                            WorldonMoto.com
                            @auth
                                <div class="grid grid-cols-1 mt-[15%] justify-evenly h-[40%]">
                                    <div class="inline-flex justify-self-center items-center">
                                        <span class="icon-box ml-4 justify-self-end mr-2">
                                            <img src="{{ asset('images/motorcycle.svg') }}" alt="Bike">
                                        </span>
                                        <span class="justify-self-start ml-2">Open Tours</span>
                                    </div>
                                    <a class="inline-flex justify-self-center items-center" href="/my-favourite-tours">
                                        <span class="icon-box ml-4 justify-self-end mr-2">
                                            <svg style="margin-left: 7px; margin-top: 3px;" width="24" height="22"
                                                viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.0794 2.96982C20.5362 2.4247 19.8907 1.99217 19.1799 1.69705C18.4692 1.40192 17.7071 1.25 16.9376 1.25C16.168 1.25 15.4059 1.40192 14.6952 1.69705C13.9844 1.99217 13.3389 2.4247 12.7957 2.96982L11.9619 3.81444L11.1281 2.96982C10.5849 2.4247 9.9394 1.99217 9.22865 1.69705C8.51789 1.40192 7.75587 1.25 6.98629 1.25C6.2167 1.25 5.45468 1.40192 4.74392 1.69705C4.03317 1.99217 3.38767 2.4247 2.84443 2.96982C0.548821 5.26544 0.408053 9.14199 3.29923 12.0873L11.9619 20.75L20.6246 12.0873C23.5158 9.14199 23.375 5.26544 21.0794 2.96982Z"
                                                    stroke="#D1E7AB" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span class="justify-self-start ml-2">Favourite Tours</span>
                                    </a>
                                    <a href="{{ url('/profiles') }}" class="inline-flex justify-self-center items-center">
                                        @auth
                                            <span
                                                class="{{ $user && $user != null && $user->profile_picture ? '' : 'icon-box' }} ml-4 justify-self-end mr-2">
                                        @endauth
                                        @if ($user && $user != null && $user->profile_picture)
                                            <img id="profile-picture-img" style="height: 47px; width: 47px;"
                                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                                alt="Profile Picture" class="rounded-full">
                                        @else
                                                <img src="{{ asset('images/user.png') }}" alt="">
                                        @endif
                                        @auth
                                        </span>
                                            <span class="justify-self-start ml-2">My Profile</span>
                                        @endauth
                                    </a>
                                </div>
                            @else
                                <div class="bg-white p-4 text-sm font-bold mt-10 mb-4">
                                    <a style="color: black; text-decoration: none;" href="{{ route('login') }}">Sign
                                        in</a>
                                </div>
                                <div class="bg-white p-4 text-sm font-bold">
                                    <a style="color: black; text-decoration: none;" href="{{ route('register') }}">Sign
                                        up</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                <script>
                    function openPopup() {
                        const popup = document.getElementById('fullScreenPopup');
                        popup.classList.add('slide-left');
                        document.body.style.overflow = 'hidden';
                    }

                    function closePopup() {
                        const popup = document.getElementById('fullScreenPopup');
                        popup.classList.remove('slide-left');
                        document.body.style.overflow = '';
                    }
                </script>
                <script>
                    function handleDeviceCheck() {
                        let mobileBox = document.getElementById("mobileBox");
                        if (!mobileBox) {
                            mobileBox = document.createElement("div");
                            mobileBox.id = "mobileBox";
                            mobileBox.style.cssText = "color:black;display:none;justify-content:center;align-items:center;height:100vh;font-size:20px;font-weight:bold;text-align:center;padding:20px;position:fixed;top:0;left:0;width:100%;background:white;z-index:9999;";
                            mobileBox.innerText = "This functionality is only supported on larger screens";
                            document.body.appendChild(mobileBox);
                        }
                        if (/Android|iPhone|iPad|iPod|Opera Mini|IEMobile|WPDesktop/i.test(navigator.userAgent) 
                            || window.innerWidth < 720) {
                            mobileBox.style.display = "flex";   // Show
                        } else {
                            mobileBox.style.display = "none";   // Hide
                        }
                    }
                    document.addEventListener("DOMContentLoaded", handleDeviceCheck);
                    window.addEventListener("resize", handleDeviceCheck);
                </script>