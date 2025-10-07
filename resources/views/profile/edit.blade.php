<x-app-layout>
    <style>
        .btn-green {
            background: #556B2F;
            min-height: 36px !important;
            color: white !important;
            border-radius: 5px !important;
            border: unset !important;
            font-weight: 700 !important;
            padding: 14px 20px !important;
            font-size: 16px !important;
        }

        .iti__country-container button {
            border: unset !important;
        }
        .iti {
            width: 100% !important;
        }
    </style>
    {{-- <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Personal Profile') }}
            </x-nav-link>
            <x-nav-link :disabled :active="request()->routeIs('dashboard')">
                {{ __('Verify & Security') }}
            </x-nav-link>
        </div>
    </x-slot> --}}

    <div>
        {{-- <div class="mx-auto sm:px-6 lg:px-8 space-y-6"> --}}
            <div class="sm:px-6 lg:px-8">
                <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Your Details</p>
                <span class="block text-green text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Your Details</span>
                <div class="w-full">
                    <form method="POST" action="{{ route('profile.updates') }}" class="mt-6 space-y-6 w-full wommd:w-3/5" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- <div>
                            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                            <div class="profile-picture" style="display: flex;justify-content: center;align-items: center;">
                                <img style="height: 250px; width: 250px;"
                                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/uploads/profile.jpg') }}"
                                    alt="Profile Picture" class="rounded-full w-16 h-16">
                            </div>
                            <div class="flex items-center justify-between">
                                <input id="profile_picture" name="profile_picture" type="file"
                                    class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400 
                                file:mr-4 file:py-2 file:px-4 
                                file:rounded-md file:border-0 
                                file:text-sm file:font-semibold 
                                file:bg-indigo-50 file:text-indigo-700 
                                hover:file:bg-indigo-100 mb-2"
                                    accept="image/*">
                            </div>
                            <div id="profile-picture-preview" style="display: flex; justify-content: center; align-items: center;">
                                <img id="profile-picture-img" style="height: 250px; width: 250px;"
                                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/uploads/profile.jpg') }}"
                                    alt="Profile Picture" class="rounded-full">
                            </div>
                            <div id="croppie-container" style="display: none;"></div>
                            <div class="w-full text-center">
                                <button id="crop-button" class="mb-2 mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md mr-5"
                                    style="display: none;">Save</button>
                            </div>
                            <span class="text-gray-500">Note: For best visibility try to upload square image.</span>
                            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />

                        </div> --}}

                        <div>
                            <label class="font-bold text-black" for="name">First Name</label>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                                required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="last_name">Last Name</label>
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)"
                                required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="nickname">Nickname</label>
                            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)"
                                required autofocus autocomplete="nickname" />
                            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="nationality">Nationality</label>
                            <select name="nationality" style="width: 100%" id="nationality">
                                <option value="">- Select Nationality -</option>
                                @foreach (config('countries.list') as $countryName)
                                    <option value="{{ $countryName }}" {{($user->nationality == $countryName ? "selected" : '')}}>
                                        {{ $countryName }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('nationality')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="address">Address</label>
                            <x-textarea 
                                id="address" 
                                name="address"  
                            >{{ $user->address }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="country">Country</label>
                            <select name="country" style="width: 100%" id="country">
                                <option value="">- Select Country -</option>
                                @foreach (config('countries.list') as $countryName)
                                    <option value="{{ $countryName }}" {{($user->country == $countryName ? "selected" : '')}}>
                                        {{ $countryName }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('country')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="pincode">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="w-full border-[#d1d5db] rounded-md" value="{{$user->pincode}}"
                             autocomplete="pincode" />
                            <x-input-error class="mt-2" :messages="$errors->get('pincode')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="dob">DOB</label>
                            <input type="date" name="dob" id="dob" class="w-full border-[#d1d5db] rounded-md" value="{{$user->dob}}">
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="contact_number">Mobile</label></br>
                            <div class="w-full">
                                <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" :value="old('contact_number', $user->contact_number)"
                                    required autofocus autocomplete="contact_number" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                        </div>

                        <div>
                            <label class="font-bold text-black" for="email">Email</label>
                            <x-text-input readonly disabled class="mt-1 block w-full" :value="old('email', $user->email)"
                                required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <input type="hidden" id="introduction_val" value="{{ $user->introduction }}">
                            <label class="font-bold text-black" for="introduction">Introduce Yourself</label>
                            <x-head.tinymce-config />
                            <x-textarea class="editorBlock" id="introduction" name="introduction" />
                        </div>
                        @php
                            $ridingImages = is_array($user->riding_images) ? $user->riding_images : json_decode($user->riding_images ?? '[]', true);
                        @endphp
                        <div>
                            <label class="font-bold text-black" for="description">Add upto 5 photos showcasing your riding</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-4">
                                @for ($i = 0; $i <= 4; $i++)
                                    <label for="riding_images_{{ $i }}"
                                        class="flex items-center justify-center w-full aspect-square border-2 border-dashed border-gray-300 rounded-md cursor-pointer hover:border-indigo-400 transition">
                                        <input type="file"
                                            name="riding_images[]"
                                            id="riding_images_{{ $i }}"
                                            accept="image/*"
                                            class="hidden"
                                            onchange="previewImage(this, 'preview_{{ $i }}')">
                        
                                        {{-- <div id="preview_{{ $i }}" class="flex items-center justify-center w-full h-full text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div> --}}
                                        <div id="preview_{{ $i }}" class="flex items-center justify-center w-full h-full overflow-hidden">
                                            @if (isset($ridingImages[$i]) && $ridingImages[$i] != '')
                                                <img src="{{ asset('storage/' . $ridingImages[$i]) }}"
                                                     alt="Riding Image {{ $i + 1 }}"
                                                     class="object-cover w-full h-full rounded-md">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                            @endif
                                        </div>
                                    </label>
                                @endfor
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('riding_images')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button type="submit" class="btn-green w-full">Save</button>
                            <a href="/profiles" class="btn-green w-full text-center">Close</a>
                        </div>    
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const croppieContainer = document.getElementById('croppie-container');
                            const profilePicturePreview = document.getElementById('profile-picture-preview');
                            const profilePictureInput = document.getElementById('profile_picture');
                            const cropButton = document.getElementById('crop-button');
                            const croppieInstance = new Croppie(croppieContainer, {
                                viewport: {
                                    width: 250,
                                    height: 250,
                                    type: 'circle'
                                },
                                boundary: {
                                    width: 300,
                                    height: 300
                                },
                                showZoomer: true
                            });

                            profilePictureInput.addEventListener('change', function(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        profilePicturePreview.style.display = 'none';
                                        croppieContainer.style.display = 'block';
                                        cropButton.style.display = 'inline-block';
                                        croppieInstance.bind({
                                            url: e.target.result
                                        });
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });

                            cropButton.addEventListener('click', function() {
                                croppieInstance.result({
                                    type: 'base64',
                                    format: 'png',
                                    size: 'viewport'
                                }).then(function(croppedImage) {
                                    const inputElement = document.createElement('input');
                                    inputElement.type = 'hidden';
                                    inputElement.name = 'cropped_image';
                                    inputElement.value = croppedImage;
                                    profilePictureInput.form.appendChild(inputElement);

                                    profilePicturePreview.style.display = 'block';
                                    profilePicturePreview.innerHTML =
                                        `<img src="${croppedImage}" class="rounded-full w-16 h-16">`;
                                    croppieContainer.style.display = 'none';
                                    cropButton.style.display = 'none';
                                });
                            });
                        });
                    </script>
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.update-password-form')
                </div>
            </div> --}}

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        {{-- </div> --}}
    </div>
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
    
            if (file && preview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="object-cover w-full h-full rounded-md" />`;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>
    <script>
        const phoneInput = document.querySelector("#contact_number");
        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            strictMode: true,
            loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
        });
        const storedNumber = "{{ old('contact_number', $user->contact_number ?? '') }}";
        if (storedNumber) {
            iti.setNumber(storedNumber); // Will auto-select country & fill number
        }

        // On form submit, replace input value with full number
        const form = phoneInput.closest('form');
        form.addEventListener("submit", function (e) {
            // prevent default first
            e.preventDefault();

            if (iti.isValidNumber()) {
                // Combine dial code + number
                const fullNumber = iti.getNumber(); // E.g. +919999999999

                // Set final value to input before real submission
                phoneInput.value = fullNumber;

                // now submit the form manually
                form.submit();
            } else {
                alert("Please enter a valid phone number.");
            }
        });
    </script>    
</x-app-layout>
