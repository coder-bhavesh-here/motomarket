<html>
{{--  This page should be responsive --}}

<head>
    <title>Verify Email | WorldonMoto</title>
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
        .otp-box {
            width: 50px;
            height: 50px;
            border: 1px solid #0000008c;
            text-align: center;
            font-size: 24px;
            border-radius: 6px;
            outline: none;
        }

        .otp-box:focus {
            border-color: #556b2f;
            box-shadow: 0 0 5px #556b2f;
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

                <form method="POST" action="{{ route('verify.email.otp') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <h2 style="margin-top: 5rem" class="text-lg womsm:text-xl wommd:text-2xl font-semibold text-gray-700 mb-5 text-center">
                        Verify your account
                    </h2>
                    <div class="text-center">
                        <div class="text-sm">We sent you an email to your email address <b>{{ $email }}</b></div>
                        <div class="text-sm mt-4">Please confirm the email by typing the number on the email.</div>
                    </div>
                      <div class="flex gap-2 justify-center" style="margin-top: 2.5rem;">
                        <input type="text" maxlength="1" style="max-width: 48px !important;" name="otp[]" class="otp-box" />
                        <input type="text" maxlength="1" style="max-width: 48px !important;" name="otp[]" class="otp-box" />
                        <input type="text" maxlength="1" style="max-width: 48px !important;" name="otp[]" class="otp-box" />
                        <input type="text" maxlength="1" style="max-width: 48px !important;" name="otp[]" class="otp-box" />
                        <input type="text" maxlength="1" style="max-width: 48px !important;" name="otp[]" class="otp-box" />
                        <input type="text" maxlength="1" style="max-width: 48px !important;" name="otp[]" class="otp-box" />
                    </div>
                    <div class="text-center mt-5">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm wommd:text-base" />
                        <x-auth-session-status class="mb-4 text-sm wommd:text-base" :status="session('status')"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm wommd:text-base" />
                    </div>
                    <div style="margin-top: 4rem;" class="text-center">
                        <a class="underline text-sm wommd:text-base font-bold text-green" href="{{ route('register') }}">
                            {{ __('Please register again if your email is not correct') }}
                        </a>
                    </div>
                    <button class="mt-5 w-full primary-button font-bold" style="padding: 12px">
                        {{ __('Confirm email') }}
                    </button>
                    <div style="margin-top: 1rem;" class="text-center">
                        <a class="underline text-sm wommd:text-base font-bold text-green cursor-pointer" id="resendOtpBtn">
                            {{ __('Resend Email') }}
                        </a>
                    </div>
                    {{-- <div class="text-center mt-10">
                        <a class="underline text-sm wommd:text-base font-bold text-green" href="#">
                            {{ __('Resend Email') }}
                        </a>
                    </div> --}}
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
    const inputs = document.querySelectorAll('.otp-box');
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
        });
        input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && index > 0) {
            inputs[index - 1].focus();
        }
        });
    });
    document.querySelector('form').addEventListener('submit', function(e) {
        const otpInputs = document.querySelectorAll('.otp-box');
        const otpValue = Array.from(otpInputs).map(i => i.value).join('');
        const hiddenOtp = document.createElement('input');
        hiddenOtp.type = 'hidden';
        hiddenOtp.name = 'otp';
        hiddenOtp.value = otpValue;
        this.appendChild(hiddenOtp);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script>
document.addEventListener('DOMContentLoaded', function() {
    const resendBtn = document.getElementById('resendOtpBtn');

    resendBtn.addEventListener('click', function() {
        const email = "{{ $email }}"; // Email from Blade
        var notyf = new Notyf({
        duration: 2500,
        position: {
            x: 'center',
            y: 'top',
        },
        types: [
            { type: 'success', background: '#556b2f', icon: false },
            { type: 'error', background: 'red', icon: false }
        ]
    });

        resendBtn.disabled = true; // Prevent multiple clicks

        fetch("{{ route('force-resend-email-ajax') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
            },
            body: JSON.stringify({ email: email })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                notyf.success(data.success);
            } else if (data.info) {
                notyf.open({ type: 'info', message: data.info });
            } else if (data.error) {
                notyf.error(data.error);
            }
        })
        .catch(err => {
            console.error(err);
            notyf.error('Something went wrong. Please try again.');
        })
        .finally(() => {
            resendBtn.disabled = false;
        });
    });
});
</script>
</html>
