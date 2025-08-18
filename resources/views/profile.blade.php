<x-app-layout>
    <style>
        a.btn-orange {
            min-height: 36px !important;
            color: white !important;
            border-radius: 5px !important;
            border: unset !important;
            font-weight: 700 !important;
            padding: 14px 20px !important;
            font-size: 16px !important;
        }
    </style>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="text-center justify-self-center mt-52">
            <div class="text-[#0F172A] font-bold text-xs womsm:text-sm wommd:text-base mb-4">PERSONAL PROFILE</div>
            <div class="justify-center items-center flex">
                <img id="profile-picture-image" style="height: 300px; width: 300px;"
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/uploads/profile.jpg') }}"
                    alt="Profile Picture" class="rounded-full">
                <label for="profile-picture-input" class="bottom-3 right-3 cursor-pointer ml-4">
                    <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-green.png') }}">
                </label>
                <input id="profile-picture-input" name="profile_picture" type="file" class="hidden" accept="image/*">
            </div>
            {{-- <div class="justify-center items-center flex">
                <img id="profile-picture-image" style="height: 300px; width: 300px;"
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/uploads/profile.jpg') }}"
                    alt="Profile Picture" class="rounded-full">
                <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-green.png') }}" class="ml-2">
            </div> --}}
            <div class="mt-4 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">{{ $user->name }}</div>
            <div class="flex justify-center mt-4">
                <div class="text-base italic" style="max-width: 300px; text-align: left">This is your personal account. You will use the details here when you book a tour as a rider.</div>
            </div>
            <a class="mt-2 block text-green" href="{{"/user/".$user->nickname}}"><u>view personal profile</u></a>
            <div class="grid gap-y-6 mt-6">
                <a href="/profile" class="primary-button">My Details</a>
                <a href="/your-tours" class="primary-button">My Tours</a>
                <a class="primary-button">Favourites</a>
                <a href="/emergency-contacts" class="primary-button">ICE</a>
                <a class="primary-button">Verification</a>
                <a href="#" class="primary-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

        <div class="text-center justify-self-center mt-4 md:mt-0">
            <div class="bg-[#FB5605] rounded-xl text-white p-4 flex items-center">
                <div>
                    <div class="text-left text-xl font-bold">Enable tour operator profile</div>
                    <div style="max-width: 350px; text-align: left;">You can post a moto tour as a tour operator. To do so, you need to create a tour operator profile. First enable your tour profile.</div>
                </div>
                <div class="ml-8">
                    <input type="checkbox" name="" id="tour_profile" class="h-6 w-6 rounded-md enable-profile" {{ $user->tour_profile_enabled ? 'checked' : '' }}>
                </div>
            </div>
            <div class="text-[#0F172A] text-sm my-4">Agree to <a href="{{ 'docs/operator-terms-service.pdf' }}" target="_blank" class="font-bold underline" style="color: #FB5605;">Tour Operator Terms of Service</a><input type="checkbox" name="terms" {{ $user->is_tour_policy_checked ? 'checked disabled' : '' }} style="border-color: #FB5605;" id="terms" class="rounded ml-4 enable-profile"></div>
            <div class="text-[#0F172A] font-bold text-xs womsm:text-sm wommd:text-base my-4">TOUR OPERATOR PROFILE</div>
            <div id="disabled">
                <div class="justify-center items-center flex">
                    <img id="profile-picture-image" style="height: 300px; width: 300px;"
                        src="{{ asset('images/circle.png') }}"
                        alt="Profile Picture" class="rounded-full">
                    <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-gray.png') }}" class="ml-2">
                </div>
                <div class="mt-4 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">Your Tour Profile</div>
                <div class="flex justify-center mt-4">
                    <div class="text-base italic" style="max-width: 300px; text-align: left">If you are a tour operator, you can open a tour operator account with us. Then you can advertise tours on WorldonMoto.com</div>
                </div>
                <div class="grid gap-y-6 mt-8">
                    <a href="#" disabled class="disabled-button">Tour Profile</a>
                    <a href="#" disabled class="disabled-button">Payment Settings</a>
                    <a href="#" disabled class="disabled-button">Tour Management</a>
                    <a href="#" disabled class="disabled-button">Customers / Bookings</a>
                    <a href="#" disabled class="disabled-button">Team</a>
                    <a href="#" disabled class="disabled-button">Reports</a>
                    <a href="#" disabled class="disabled-button">Verification</a>
                </div>
            </div>
            <div id="enabled">
                <div class="justify-center items-center flex">
                    <img id="tour-picture-img" style="height: 300px; width: 300px;"
                        src="{{ $user->tour_profile_picture ? asset('storage/' . $user->tour_profile_picture) : asset('storage/uploads/profile.jpg') }}"
                        alt="Tour Profile Picture" class="rounded-full">
                    <label for="tour-picture-input" class="bottom-3 right-3 cursor-pointer ml-4">
                        <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-green.png') }}">
                    </label>
                    <input id="tour-picture-input" name="tour_profile_picture" type="file" class="hidden" accept="image/*">
                </div>
                {{-- <div class="justify-center items-center flex">
                    <img id="profile-picture-image" style="height: 300px; width: 300px;"
                        src="{{ $user->tour_profile_picture ? asset('storage/' . $user->tour_profile_picture) : asset('storage/uploads/profile.jpg') }}"
                        alt="Tour Profile Picture" class="rounded-full">
                    <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-green.png') }}" class="ml-2">
                </div> --}}
                <div class="mt-4 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">Your Tour Profile</div>
                <div class="flex justify-center mt-4">
                    <div class="text-base italic" style="max-width: 300px; text-align: left">If you are a tour operator, you can open a tour operator account with us. Then you can advertise tours on WorldonMoto.com</div>
                </div>
                <a class="mt-2 block text-orange" href="{{"/tour-operator/".$user->tour_nickname}}"><u>view tour profile</u></a>
                <div class="grid gap-y-6 mt-6">
                    <a href="/tour-profile" class="btn-orange">Tour Profile</a>
                    <a href="/payment/edit" class="btn-orange">Payment Settings</a>
                    <a href="/tour-management" class="btn-orange">Tour Management</a>
                    <a href="/bookings" class="btn-orange">Customers / Bookings</a>
                    <a class="btn-orange">Team</a>
                    <a class="btn-orange">Reports</a>
                    <a class="btn-orange">Verification</a>
                </div>
            </div>
        </div>
        <!-- Croppie Modal -->
        <div class="w-full">
            <div id="croppie-modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden justify-center items-center">
                <div class="bg-white p-4 rounded shadow-lg text-center">
                    <div id="croppie-container" class="mt-32 mb-4"></div>
                    <img src="{{asset('images/loader.gif')}}" class="w-16 justify-self-center mb-4 hidden" id="loader">
                    <button id="crop-image-btn" class="primary-button">Crop & Save</button>
                    <button onclick="closeCroppie()" class="ml-2 btn-orange">Cancel</button>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(".enable-profile").click(function (e) { 
            showLoader();
            checkProfile();
            const tour_profile = $("#tour_profile").prop("checked") ? 1 : 0;
            const terms = $("#terms").prop("checked") ? 1 : 0;

            $.ajax({
                url: "/update-tour-profile-status", // Update this route as needed
                method: "POST",
                data: {
                    tour_profile: tour_profile,
                    terms: terms,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    hideLoader();
                    if (response.message == "You cannot disable your tour profile while you have upcoming tours.") {
                        var notyf = new Notyf({
                            duration: 3500,
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                            types: [
                                {
                                    type: 'error',
                                    background: 'red',
                                    icon: false
                                }
                            ]
                        });
                        notyf.open({
                            type: "error",
                            message: "You cannot disable your tour profile while you have upcoming tours!"
                        });
                        $("#tour_profile").prop("checked", 1);
                    }
                    console.log("Tour profile status updated");
                },
                error: function (xhr) {
                    console.error("Error updating status:", xhr.responseText);
                }
            });

        });
        $(document).ready(function () {
            checkProfile();
        });
        function checkProfile() {
            const tour_profile = $("#tour_profile").prop("checked");
            const terms = $("#terms").prop("checked");
            if (tour_profile && terms) {
                console.log('enable tour profile');
                $("#enabled").show();
                $("#disabled").hide();
            } else {
                console.log('disable tour profile');
                $("#enabled").hide();
                $("#disabled").show();
            }
        }
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const setupImageUpload = (inputId, imgId, route) => {
                const input = document.getElementById(inputId);
                const img = document.getElementById(imgId);
        
                input.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
        
                        const formData = new FormData();
                        formData.append(input.name, file);
        
                        fetch(route, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(data => {
                            if (data.status !== 'success') {
                                alert('Image upload failed');
                            }
                        })
                        .then(response => response.json())
                        .catch(err => {
                            console.error(err);
                            alert('Something went wrong');
                        });
                    }
                });
            };
        
            setupImageUpload('profile-picture-input', 'profile-picture-image', '{{ route("update.profile.picture") }}');
            setupImageUpload('tour-picture-input', 'tour-picture-img', '{{ route("update.tour.picture") }}');
        });
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let croppieInstance = null;
            let activeTarget = null;
            let uploadRoute = '';

            const croppieModal = document.getElementById('croppie-modal');
            const cropBtn = document.getElementById('crop-image-btn');
            const croppieContainer = document.getElementById('croppie-container');

            const showCroppie = (imgUrl, targetImgId, route) => {
                activeTarget = document.getElementById(targetImgId);
                uploadRoute = route;

                croppieModal.classList.remove('hidden');

                if (croppieInstance) croppieInstance.destroy();

                croppieInstance = new Croppie(croppieContainer, {
                    viewport: { width: 400, height: 400, type: 'circle' },
                    boundary: { width: 500, height: 500 },
                    showZoomer: true
                });

                croppieInstance.bind({ url: imgUrl });
            };

            window.closeCroppie = () => {
                croppieModal.classList.add('hidden');
                if (croppieInstance) croppieInstance.destroy();
                croppieInstance = null;
            };

            cropBtn.addEventListener('click', function () {
                showLoader();
                croppieInstance.result({ type: 'base64', format: 'png', size: 'original' })
                    .then(function (base64) {
                        // Preview cropped image

                        // Upload to server
                        const formData = new FormData();
                        formData.append('cropped_image', base64);

                        fetch(uploadRoute, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status !== 'success') alert('Upload failed');
                            hideLoader();
                            window.location.reload();
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Upload error');
                        });
                    });
            });

            const setupCroppieTrigger = (inputId, targetImgId, route) => {
                const input = document.getElementById(inputId);
                input.addEventListener('change', function () {
                    showLoader();
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            hideLoader();
                            showCroppie(e.target.result, targetImgId, route);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            };

            setupCroppieTrigger('profile-picture-input', 'profile-picture-image', '{{ route("update.profile.picture") }}');
            setupCroppieTrigger('tour-picture-input', 'tour-picture-img', '{{ route("update.tour.picture") }}');
        });
    </script>
</x-app-layout>