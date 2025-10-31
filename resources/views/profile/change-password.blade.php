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
    <div>
        <div class="sm:px-6 lg:px-8">
            <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Your Details</p>
            <span class="block text-green text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Your Details</span>
            <div class="w-full">
                <form method="POST" action="{{ route('profile.updates') }}" class="mt-6 space-y-6 w-full wommd:w-3/5" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="font-bold text-black" for="name">Current password</label>
                        <x-text-input type="password" id="current_password" name="current_password" type="text" class="mt-1 block w-full" :value="old('current_password')"
                            required autofocus autocomplete="current_password" />
                        <x-input-error class="mt-2" :messages="$errors->get('current_password')" />
                    </div>
                    <div>
                        <label class="font-bold text-black" for="last_name">New Password</label>
                        <x-text-input type="password" id="new_password" name="new_password" type="text" class="mt-1 block w-full" :value="old('new_password')"
                            required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('new_password')" />
                    </div>
                    <div>
                        <label class="font-bold text-black" for="last_name">Confirm Password</label>
                        <x-text-input type="password" id="new_password_confirmation" name="new_password_confirmation" type="text" class="mt-1 block w-full" :value="old('new_password_confirmation')"
                            required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('new_password_confirmation')" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button type="submit" class="btn-green w-full">Save</button>
                        <a href="/profiles" class="btn-green w-full text-center">Close</a>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
