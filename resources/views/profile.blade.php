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
                <a class="primary-button">ICE</a>
                <a class="primary-button">Verification</a>
            </div>
        </div>

        <div id="disabled" class="text-center justify-self-center">
            <div class="bg-[#FB5605] rounded-xl text-white p-4 flex items-center">
                <div>
                    <div class="text-left text-xl font-bold">Enable tour operator profile</div>
                    <div style="max-width: 350px; text-align: left;">You can post a moto tour as a tour operator. To do so, you need to create a tour operator profile. First enable your tour profile.</div>
                </div>
                <div class="ml-8">
                    <input type="checkbox" name="" id="" class="h-6 w-6 rounded-md">
                </div>
            </div>
            <div class="text-[#0F172A] text-sm my-4">Agree to <a href="#" class="font-bold underline" style="color: #FB5605;">Tour Operator Terms of Service</a><input type="checkbox" name="terms" style="border-color: #FB5605;" id="terms" class="rounded ml-4"></div>
            <div class="text-[#0F172A] font-bold text-xs womsm:text-sm wommd:text-base my-4">TOUR OPERATOR PROFILE</div>
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
                <a href="#" disabled class="disabled-button">My Details</a>
                <a href="#" disabled class="disabled-button">My Tours</a>
                <a href="#" disabled class="disabled-button">Favourites</a>
                <a href="#" disabled class="disabled-button">ICE</a>
                <a href="#" disabled class="disabled-button">Verification</a>
            </div>
        </div>
    </div>
</x-app-layout>