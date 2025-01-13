<html>
{{--  This page should be responsive --}}

<head>
    <title>Register | World On Moto</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
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
            <div class="flex flex-col justify-start pt-20 items-center min-h-screen sm:w-full lg:h-full px-6 py-12">
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
                    <h2 class="text-3xl lg:text-2xl font-semibold text-gray-700 mb-4 text-center">Create your account
                    </h2>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name"
                                class="block text-2xl lg:text-sm font-medium text-gray-700">Name</label>
                            <x-text-input id="name"
                                class="{{ is_array($errors->get('name')) && !empty($errors->get('name')) ? 'error-input' : '' }} block text-2xl lg:text-sm w-full mt-1"
                                type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-2xl lg:text-sm" />
                        </div>
                        <!-- Email Address -->
                        <div>
                            <label for="email"
                                class="block text-2xl lg:text-sm font-medium text-gray-700">Email</label>
                            <x-text-input id="email"
                                class="{{ is_array($errors->get('email')) && !empty($errors->get('email')) ? 'error-input' : '' }} block text-2xl lg:text-sm w-full mt-1"
                                type="email" name="email" :value="old('email')" autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-2xl lg:text-sm" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-2xl lg:text-sm font-medium text-gray-700">Password</label>
                            <div class="flex flex-row justify-center items-center">
                                <x-text-input id="password"
                                    class="w-full {{ is_array($errors->get('password')) && !empty($errors->get('password')) ? 'error-input' : '' }} block text-2xl lg:text-sm mt-1 mr-1"
                                    type="password" name="password" autocomplete="new-password" />
                                <i class="fa fa-eye" aria-hidden="true" id="showHidePassword"
                                    style="font-size:20px; right: 50px; top: 45%; cursor: pointer;"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-2xl lg:text-sm" />
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center">
                            <input type="checkbox" id="terms-conditions" name="terms-conditions"
                                class="mr-2 {{ is_array($errors->get('terms-conditions')) && !empty($errors->get('terms-conditions')) ? 'error-input' : '' }}">
                            <label for="terms-conditions" class="text-sm text-gray-600">
                                Accept <a href="#">Terms and Condition</a> & <a href="#">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Register Button -->
                        <div>
                            <button class="w-full primary-button">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-6">
                            <p class="text-sm text-gray-600">Already have an account?</p>
                            <a class="underline text-sm" href="{{ route('login') }}">
                                {{ __('Sign in here') }}
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
