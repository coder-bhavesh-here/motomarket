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
        <div class="hidden lg:block lg:w-8/12">
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
        <div class="w-full lg:w-4/12 bg-white shadow-md">
            <div class="flex flex-col justify-start pt-20 items-center min-h-screen sm:w-full lg:h-full px-24 py-12">
                <!-- Logo and Header -->
                <div class="flex flex-row justify-center items-center mb-6">
                    <img class="w-28 lg:w-28" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <div class="ml-4">
                        <h1 class="text-4xl lg:text-4xl font-bold text-gray-800 logo-text">WORLD ON MOTO</h1>
                        <p class="text-2xl lg:text-lg text-gray-600">Explore the world on a motorbike</p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="w-full max-w-md mx-auto mt-8 p-6 bg-white">

                    <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Create your account</h2>

                    <form method="POST" action="{{ route('register') }}" class="space-y-2">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text"
                                class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                value="{{ old('name') }}" required autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email"
                                class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                value="{{ old('email') }}" required autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password"
                                    class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    required autocomplete="new-password">
                                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                                    <i class="fa fa-eye" id="showHidePassword"></i>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center" style="margin-top: 30px !important;">
                            <input type="checkbox" id="terms-conditions" name="terms-conditions" class="w-4 h-4">
                            <label for="terms-conditions" class="ml-2 text-sm text-gray-600 font-medium">
                                Accept <a href="#" class="text-green underline">Terms and Condition</a> & <a
                                    href="#" class="text-green underline">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Sign Up Button -->
                        <button type="submit"
                            class="w-full py-2 px-4 primary-button text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Sign up
                        </button>
                    </form>

                    <!-- Sign In Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">Have an account? <br><a href="{{ route('login') }}"
                                class="text-black underline font-medium">Sign in here</a></p>
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
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>
