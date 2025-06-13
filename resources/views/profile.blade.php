<x-app-layout>
    <div class="grid grid-cols-1 wommd:grid-cols-2">
        <div class="text-center justify-self-center mt-52">
            <div class="text-[#0F172A] font-bold text-xs womsm:text-sm wommd:text-base mb-4">PERSONAL PROFILE</div>
            <div class="justify-center items-center flex">
                <img id="profile-picture-img" style="height: 300px; width: 300px;"
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/uploads/profile.jpg') }}"
                    alt="Profile Picture" class="rounded-full">
                <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-green.png') }}" class="ml-2">
            </div>
            <div class="mt-4 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">{{ $user->name }}</div>
            <div class="flex justify-center mt-4">
                <div class="text-base italic" style="max-width: 300px; text-align: left">This is your personal account. You will use the details here when you book a tour as a rider.</div>
            </div>
            <div class="grid gap-y-6 mt-12">
                <a href="/profile" class="primary-button">My Details</a>
                <a class="primary-button">My Tours</a>
                <a class="primary-button">Favourites</a>
                <a href="/emergency-contacts" class="primary-button">ICE</a>
                <a class="primary-button">Verification</a>
            </div>
        </div>

        <div class="text-center justify-self-center">
            <div class="bg-[#FB5605] rounded-xl text-white p-4 flex items-center">
                <div>
                    <div class="text-left text-xl font-bold">Enable tour operator profile</div>
                    <div style="max-width: 350px; text-align: left;">You can post a moto tour as a tour operator. To do so, you need to create a tour operator profile. First enable your tour profile.</div>
                </div>
                <div class="ml-8">
                    <input type="checkbox" name="" id="tour_profile" class="h-6 w-6 rounded-md enable-profile" {{ $user->tour_profile_enabled ? 'checked' : '' }}>
                </div>
            </div>
            <div class="text-[#0F172A] text-sm my-4">Agree to <a href="#" class="font-bold underline" style="color: #FB5605;">Tour Operator Terms of Service</a><input type="checkbox" name="terms" {{ $user->is_tour_policy_checked ? 'checked' : '' }} style="border-color: #FB5605;" id="terms" class="rounded ml-4 enable-profile"></div>
            <div class="text-[#0F172A] font-bold text-xs womsm:text-sm wommd:text-base my-4">TOUR OPERATOR PROFILE</div>
            <div id="disabled">
                <div class="justify-center items-center flex">
                    <img id="profile-picture-img" style="height: 300px; width: 300px;"
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
                    <img id="profile-picture-img" style="height: 300px; width: 300px;"
                        src="{{ $user->tour_profile_picture ? asset('storage/' . $user->tour_profile_picture) : asset('storage/uploads/profile.jpg') }}"
                        alt="Tour Profile Picture" class="rounded-full">
                    <img style="width: 30px; height: 24px;" src="{{ asset('images/camera-green.png') }}" class="ml-2">
                </div>
                <div class="mt-4 text-lg womsm:text-xl wommd:text-2xl font-semibold text-black">Your Tour Profile</div>
                <div class="flex justify-center mt-4">
                    <div class="text-base italic" style="max-width: 300px; text-align: left">If you are a tour operator, you can open a tour operator account with us. Then you can advertise tours on WorldonMoto.com</div>
                </div>
                <div class="grid gap-y-6 mt-12">
                    <a href="/profile" class="primary-button">Tour Profile</a>
                    <a class="primary-button">Payment Settings</a>
                    <a href="/tour-management" class="primary-button">Tour Management</a>
                    <a class="primary-button">Customers / Bookings</a>
                    <a class="primary-button">Team</a>
                    <a class="primary-button">Reports</a>
                    <a class="primary-button">Verification</a>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(".enable-profile").click(function (e) { 
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
</x-app-layout>