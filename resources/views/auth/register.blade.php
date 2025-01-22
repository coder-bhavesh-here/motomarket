<html>
{{--  This page should be responsive --}}

<head>
    <title>Register | World On Moto</title>
    @vite('resources/css/app.css')
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet"> --}}
</head>

<body class="bg-gray-100">
    <div class="w-full flex flex-col lg:flex-row sm:justify-center sm:items-center sm:h-screen">
        <!-- Image Section -->
        <div class="hidden xl:block xl:w-[65%]">
            <div id="imageSlider" class="relative h-screen w-full overflow-hidden">
                <!-- Slider Images -->
                <div class="slider-images h-screen w-full">
                    <img class="h-screen w-full object-cover absolute opacity-0 transition-opacity duration-1000 ease-in-out"
                        src="{{ asset('images/bike1.jpg') }}" alt="Bike Image 1">
                    <img class="h-screen w-full object-cover absolute opacity-0 transition-opacity duration-1000 ease-in-out"
                        src="{{ asset('images/bike2.jpg') }}" alt="Bike Image 2">
                    <img class="h-screen w-full object-cover absolute opacity-0 transition-opacity duration-1000 ease-in-out"
                        src="{{ asset('images/bike3.jpg') }}" alt="Bike Image 3">
                    <img class="h-screen w-full object-cover absolute opacity-0 transition-opacity duration-1000 ease-in-out"
                        src="{{ asset('images/bike4.jpg') }}" alt="Bike Image 4">
                    <img class="h-screen w-full object-cover absolute opacity-0 transition-opacity duration-1000 ease-in-out"
                        src="{{ asset('images/bike5.jpg') }}" alt="Bike Image 5">
                    <img class="h-screen w-full object-cover absolute opacity-0 transition-opacity duration-1000 ease-in-out"
                        src="{{ asset('images/bike6.jpg') }}" alt="Bike Image 6">
                </div>
            </div>
        </div>

        <!-- Register Section -->
        <div class="w-full xl:w-[35%] bg-white shadow-md">
            <div
                class="flex flex-col justify-center lg:justify-start lg:pt-20 items-center min-h-screen sm:w-full lg:h-full">
                <!-- Logo and Header -->
                <div class="flex flex-row justify-center items-center mb-6">
                    <img class="w-28 lg:w-28" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <div class="ml-4">
                        <h1 class="text-4xl lg:text-4xl font-bold text-gray-800 logo-text">WORLD ON MOTO</h1>
                        <p class="text-2xl lg:text-lg text-gray-600">Explore the world on a motorbike</p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="w-full mx-auto mt-8 p-6 bg-white">

                    <h2 class="text-3xl lg:text-2xl font-semibold text-gray-700 mb-4 text-center">Create your account
                    </h2>

                    <form method="POST" action="{{ route('register') }}" class="space-y-2">
                        @csrf

                        <!-- Name -->
                        <div class="flex items-center">
                            <label style="min-width: 118px; text-align: right;" for="name"
                                class="block text-2xl lg:text-sm font-medium text-gray-700 mr-2">Name</label>
                            <input id="name" name="name" type="text"
                                class="sm:max-md:min-w-[320px] sm:max-w-[calc(100%-162px)] w-full mt-1 px-3 py-2 border rounded-lg shadow-sm"
                                value="{{ old('name') }}" autocomplete="name">
                        </div>

                        <!-- Email -->
                        <div class="flex items-center">
                            <label style="min-width: 118px; text-align: right;" for="email"
                                class="block text-2xl lg:text-sm font-medium text-gray-700 mr-2">Email</label>
                            <input id="email" name="email" type="email"
                                class="sm:max-md:min-w-[320px] sm:max-w-[calc(100%-162px)] w-full mt-1 px-3 py-2 border rounded-lg shadow-sm"
                                value="{{ old('email') }}" autocomplete="email">
                        </div>

                        <!-- Password -->
                        <div class="flex items-center">
                            <label style="min-width: 118px; text-align: right;" for="password"
                                class="block text-2xl lg:text-sm font-medium text-gray-700 mr-2">Password</label>
                            <div class="flex items-center w-full">
                                <input id="password" name="password" type="password"
                                    class="sm:max-md:min-w-[340px] w-full mt-1 px-3 py-2 border rounded-lg shadow-sm"
                                    autocomplete="new-password">
                                <span id="showHidePassword"
                                    class="ml-3 inset-y-0 right-3 flex items-center cursor-pointer">
                                    {{-- <i class="fa fa-eye" id="showHidePassword"></i> --}}
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"
                                            stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center justify-center" style="margin-top: 30px !important;">
                            <input type="checkbox" id="terms-conditions" name="terms-conditions" class="w-4 h-4">
                            <label for="terms-conditions" class="ml-2 text-2xl lg:text-sm text-gray-600 font-medium">
                                Accept <a href="#" class="text-green underline">Terms and Condition</a> & <a
                                    href="#" class="text-green underline">Privacy Policy</a>
                            </label>
                        </div>

                        <div class="text-center">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-2xl lg:text-sm" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-2xl lg:text-sm" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-2xl lg:text-sm" />
                        </div>

                        <!-- Sign Up Button -->
                        <div class="text-center">
                            <button type="submit"
                                class="w-2/4 py-2 px-4 primary-button text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:ring-green-500">
                                Sign up
                            </button>
                        </div>
                    </form>

                    <!-- Sign In Link -->
                    <div class="text-center mt-6">
                        <p class="text-2xl lg:text-sm text-gray-600">Have an account? <br><a
                                href="{{ route('login') }}" class="text-black underline font-medium">Sign in here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('#imageSlider .slider-images img');
        let currentIndex = 0;

        const showImage = (index) => {
            images.forEach((img, i) => {
                img.style.opacity = i === index ? '1' : '0';
            });
        };

        const startSlider = () => {
            setInterval(() => {
                currentIndex = (currentIndex + 1) % images.length;
                showImage(currentIndex);
            }, 5000);
        };

        showImage(currentIndex);
        startSlider();
    });
    const showHidePass = document.getElementById('showHidePassword');
    const userPassword = document.getElementById('password');

    showHidePass.addEventListener('click', function(e) {
        let showHideAttr = userPassword.getAttribute('type');

        if (showHideAttr === 'password') {
            showHideAttr = 'text';
        } else {
            showHideAttr = 'password';
        }
        userPassword.setAttribute('type', showHideAttr);
    });
</script>

</html>
