<html>
{{--  This page should be responsive --}}

<head>
    <title>Login | World On Moto</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="w-full flex flex-col lg:flex-row sm:justify-center sm:items-center sm:h-screen">
        <!-- Image Section -->
        <div class="hidden lg:block lg:w-8/12">
            {{-- A slider of images images/bike1.jpg, images/bike2.jpg, images/bike3.jpg, images/bike4.jpg, images/bike5.jpg, images/bike6.jpg --}}
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

        <!-- Login Section -->
        <div class="w-full lg:w-4/12 bg-white shadow-md">
            <div class="flex flex-col justify-center items-center min-h-screen sm:w-full lg:h-full px-6 py-12">
                <!-- Logo and Header -->
                <div class="flex flex-row justify-center items-center mb-6">
                    <img class="w-28 lg:w-28" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <div class="ml-4">
                        <h1 class="text-3xl lg:text-3xl font-bold text-gray-800 logo-text">WORLD ON MOTO</h1>
                        <p class="text-2xl lg:text-lg text-gray-600">Explore the world on a motorbike</p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="w-full max-w-2xl">
                    <h2 class="text-3xl lg:text-2xl font-semibold text-gray-700 mb-4 text-center">Login to your account
                    </h2>

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email"
                                class="block text-2xl lg:text-sm font-medium text-gray-700">Email</label>
                            <x-text-input id="email" class="block text-2xl lg:text-sm w-full mt-1" type="email"
                                name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-2xl lg:text-sm" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-2xl lg:text-sm font-medium text-gray-700">Password</label>
                            <x-text-input id="password" class="block text-2xl lg:text-sm w-full mt-1" type="password"
                                name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-2xl lg:text-sm" />
                        </div>

                        <!-- Remember Me -->
                        <div>
                            <button class="w-full primary-button">
                                {{ __('Sign in') }}
                            </button>
                        </div>

                        <!-- Forgot Password -->
                        <div class="text-center mt-4">
                            <p class="text-sm text-gray-600">Forgot your password?</p>
                            <a class="underline text-sm" href="{{ route('password.request') }}">
                                {{ __('Reset it here') }}
                            </a>
                        </div>

                        <!-- Sign Up Link -->
                        <div class="text-center mt-6">
                            <p class="text-sm text-gray-600">Don't have a WorldOnMoto account?</p>
                            <a class="underline text-sm" href="{{ route('register') }}">
                                {{ __('Sign up here') }}
                            </a>
                        </div>
                    </form>
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
            }, 5000); // Change image every 5 seconds
        };

        // Initial Display
        showImage(currentIndex);
        startSlider();
    });
</script>

</html>
