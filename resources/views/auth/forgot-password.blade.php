<html>
{{--  This page should be responsive --}}

<head>
    <title>Reset Password | WorldonMoto</title>
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

        <div class="w-full wommd:w-[35%] bg-white shadow-md">
            <div
                class="flex flex-col wommd:justify-start pt-0 short:pt-16 wommd:pt-32 items-center min-h-screen womsm:w-full wommd:h-full px-6 py-12">
                <!-- Logo and Header -->
                <div class="flex flex-row justify-center items-center mb-16 womsm:mb-6 px-16">
                    <img src="{{ asset('images/logo-text.png') }}" class="max-w-[250px] womsm:max-w-[300px] wommd:max-w-[350px]"
                        alt="World On Moto - Explore the world on a motorbike">
                </div>

                <!-- Form Section -->

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf
                    <table>
                        <tr>
                            {{-- <td class="w-[82px]">
                            </td> --}}
                            <td colspan="2" class="w-[365px]" style="text-align: center !important;">
                                <h2 class="text-lg womsm:text-xl wommd:text-2xl font-semibold text-gray-700 mb-5 mt-5 text-center">
                                    Reset your password
                                </h2>
                                <div class="text-sm">Type the email address that you used to register.</div>
                                <div class="text-sm">We will send you a temporary password that you can login with.</div>
                                <div class="text-sm">We recommend you, once you login to the account, kindly update the password from profile section.</div>
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
                            <td colspan="2" class="w-full">
                                <div class="text-center mt-5">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm wommd:text-base" />
                                    <x-auth-session-status class="mb-4 text-sm wommd:text-base" :status="session('status')"/>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm wommd:text-base" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <button class="mt-5 w-full primary-button font-bold" style="padding: 12px">
                                    {{ __('Reset') }}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-[82px]"></td>
                            <td class="w-[283px]">
                                <div class="text-center mt-10">
                                    <p class="text-sm wommd:text-base font-medium text-gray-600">Have an account?</p>
                                    <a class="underline text-sm wommd:text-base font-bold" href="{{ route('login') }}">
                                        {{ __('Sign in here') }}
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
</script>

</html>
