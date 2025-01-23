<html>
{{--  This page should be responsive --}}

<head>
    <title>Login | World On Moto</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <style>
        td {
            padding: 0;
            border: unset;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="w-full flex flex-col lg:flex-row sm:justify-center sm:items-center sm:h-screen">
        <!-- Image Section -->
        <div class="hidden lg:block lg:w-[65%]">
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
        <div class="w-full lg:w-[35%] bg-white shadow-md">
            <div
                class="flex flex-col justify-center lg:justify-start lg:pt-32 items-center min-h-screen sm:w-full lg:h-full px-6 py-12">
                <!-- Logo and Header -->
                <div class="flex flex-row justify-center items-center mb-6">
                    <img class="w-28 lg:w-28" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <div class="ml-5">
                        <h1 class="font-bold text-gray-800 logo-text">WORLD ON MOTO</h1>
                        <p class="tagline-text">Explore the world on a motorbike</p>
                    </div>
                </div>

                <!-- Form Section -->

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <table>
                        <tr>
                            <td class="w-[82px]">
                            </td>
                            <td class="w-[283px]">
                                <h2 class="text-3xl lg:text-2xl font-semibold text-gray-700 mb-5 mt-5 text-center">Login
                                    to
                                    your
                                    account
                                </h2>
                            </td>
                        </tr>

                        <!-- Email Address -->
                        <tr>
                            <td class="w-[82px]">
                                <label style="text-align: right;" for="email"
                                    class="block text-2xl lg:text-sm font-medium text-gray-700 mr-2 mt-10">Email</label>
                            </td>
                            <td class="w-[283px]">
                                <input id="email"
                                    class="w-full mt-10 {{ is_array($errors->get('email')) && !empty($errors->get('email')) ? 'error-input' : '' }} block text-2xl lg:text-sm w-full mt-1 border rounded-lg shadow-sm"
                                    type="email" name="email" :value="old('email')" autofocus
                                    autocomplete="username" />
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]">
                                <label style="text-align: right;" for="password"
                                    class="block text-2xl lg:text-sm font-medium text-gray-700 mr-2 mt-2">Password</label>
                            </td>
                            <td class="w-[283px]">
                                <input id="password"
                                    class="w-full mt-2 {{ is_array($errors->get('password')) && !empty($errors->get('password')) ? 'error-input' : '' }} block text-2xl lg:text-sm w-full mt-1 border rounded-lg shadow-sm"
                                    type="password" name="password" autocomplete="current-password" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="w-full">
                                <div class="text-center mt-5">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-2xl lg:text-sm" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-2xl lg:text-sm" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <button class="mt-5 w-full primary-button">
                                    {{ __('Sign in') }}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <div class="text-center mt-10">
                                    <p class="text-sm font-medium text-gray-600">Forgot your password?</p>
                                    <a class="underline text-sm font-bold" href="{{ route('password.request') }}">
                                        {{ __('Reset it here') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <div class="text-center mt-10">
                                    <p style="letter-spacing: -0.4;" class="text-sm font-medium text-gray-600">Don’t
                                        have a
                                        WorldonMoto.com
                                        account?</p>
                                    <a class="underline text-sm font-bold" href="{{ route('register') }}">
                                        {{ __('Sign up here') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
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
