<x-app-layout>
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

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8">
                <div class="w-full">
                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

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
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                                required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="nickname" :value="__('Nickname')" />
                            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)"
                                required autofocus autocomplete="nickname" />
                            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
                        </div>
                        <div>
                            <x-input-label for="dob" :value="__('DOB')" />
                            <input type="date" name="dob" id="dob" class="w-full border-[#d1d5db] rounded-md" value="{{$user->dob}}">
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div>
                            <x-input-label for="mobile_number" :value="__('Contact')" />
                            <x-text-input id="mobile_number" name="mobile_number" type="text" class="mt-1 block w-full" :value="old('mobile_number', $user->mobile_number)"
                                required autofocus autocomplete="mobile_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('mobile_number')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                                required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <input type="hidden" id="description_val" value="">
                            <x-input-label for="description" :value="__('Introduce Yourself')" />
                            <x-head.tinymce-config />
                            <x-textarea class="editorBlock" id="description" name="description" />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Add upto 5 photos showcasing your riding')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
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
        </div>
    </div>
</x-app-layout>
