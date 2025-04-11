<html>
{{--  This page should be responsive --}}

<head>
    <title>Sign in | WorldonMoto</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <style>
        td {
            padding: 0;
            border: unset;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="w-full flex flex-col wommd:flex-row sm:justify-center sm:items-center sm:h-screen">
        <!-- Image Section -->
        <div class="hidden wommd:block wommd:w-[65%]">
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
        <div class="w-full wommd:w-[35%] bg-white shadow-md">
            <div
                class="flex flex-col wommd:justify-start pt-0 short:pt-16 wommd:pt-32 items-center min-h-screen womsm:w-full wommd:h-full px-6 py-12">
                <!-- Logo and Header -->
                <div class="flex flex-row justify-center items-center mb-16 womsm:mb-6 px-16">
                    <img src="{{ asset('images/logo-text.png') }}" class="max-w-[250px] womsm:max-w-[300px] wommd:max-w-[350px]"
                        alt="World On Moto - Explore the world on a motorbike">
                </div>

                <!-- Form Section -->

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <table>
                        <tr>
                            <td class="w-[82px]">
                            </td>
                            <td class="w-[283px]">
                                <h2 class="text-lg womsm:text-xl wommd:text-2xl font-semibold text-gray-700 mb-5 mt-5 text-center">
                                    Login to your account
                                </h2>
                            </td>
                        </tr>

                        <!-- Email Address -->
                        <tr>
                            <td class="w-[82px]">
                                <label style="text-align: right;" for="email"
                                    class="block text-sm wommd:text-base font-medium text-gray-700 mr-2 mt-5">Email</label>
                            </td>
                            <td class="w-[283px]">
                                <input id="email"
                                    class="w-full mt-5 {{ is_array($errors->get('email')) && !empty($errors->get('email')) ? 'error-input' : '' }} block text-sm wommd:text-base w-full mt-1 border rounded-lg shadow-sm"
                                    type="email" name="email" :value="old('email')" autofocus
                                    autocomplete="username" />
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]">
                                <label style="text-align: right;" for="password"
                                    class="block text-sm wommd:text-base font-medium text-gray-700 mr-2 mt-2">Password</label>
                            </td>
                            <td class="w-[283px]">
                                <input id="password"
                                    class="w-full mt-2 {{ is_array($errors->get('password')) && !empty($errors->get('password')) ? 'error-input' : '' }} block text-sm wommd:text-base w-full mt-1 border rounded-lg shadow-sm"
                                    type="password" name="password" autocomplete="current-password" />
                            </td>
                            <td class="w-[82px]">
                                <span id="showHidePassword"
                                    class="ml-3 mt-2 inset-y-0 right-3 flex items-center cursor-pointer">
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
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="w-full">
                                <div class="text-center mt-5">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm wommd:text-base" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm wommd:text-base" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <button class="mt-5 w-full primary-button font-bold">
                                    {{ __('Sign in') }}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <div class="text-center mt-10">
                                    <p class="text-sm wommd:text-base font-medium text-gray-600">Forgot your password?</p>
                                    <a class="underline text-sm wommd:text-base font-bold" href="{{ route('password.request') }}">
                                        {{ __('Reset it here') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <div class="text-center mt-10">
                                    <p style="letter-spacing: -0.4;" class="text-sm wommd:text-base font-medium text-gray-600">
                                        Don’t have a WorldonMoto.com account?
                                    </p>
                                    <a class="underline text-sm wommd:text-base font-bold" href="{{ route('register') }}">
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
