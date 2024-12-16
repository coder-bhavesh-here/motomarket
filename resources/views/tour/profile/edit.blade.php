<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('tours.profile')" :active="request()->routeIs('tours.profile')">
                {{ __('Tour Profile') }}
            </x-nav-link>
            <x-nav-link :href="route('tours.settings')" :active="request()->routeIs('tours.settings')">
                {{ __('Tour Creation Settings') }}
            </x-nav-link>
            <x-nav-link :href="route('tours')" :active="request()->routeIs('tours')">
                {{ __('Tour Advertising') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    <section>
                        <header>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('You can post a bike tour as an individual or as a tour operator (a company or a tour business). To do so, you need to complete the tour operator profile.') }}
                            </p>
                        </header>
                        <form method="post" action="{{ route('tours.profile.update') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="tour_profile_picture" :value="__('Tour Profile Picture')" />
                                <div class="profile-picture"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <img style="height: 250px; width: 250px;"
                                        src="{{ $user->tour_profile_picture ? asset('storage/' . $user->tour_profile_picture) : asset('storage/uploads/profile.jpg') }}"
                                        alt="Profile Picture" class="rounded-full w-16 h-16">
                                </div>

                                <input id="tour_profile_picture" name="tour_profile_picture" type="file"
                                    class="mt-1 block w-full text-sm text-gray-600 dark:text-gray-400 
                                              file:mr-4 file:py-2 file:px-4 
                                              file:rounded-md file:border-0 
                                              file:text-sm file:font-semibold 
                                              file:bg-indigo-50 file:text-indigo-700 
                                              hover:file:bg-indigo-100 mb-2"
                                    accept="image/*" />
                                <span class="text-gray-500">Note: For best visibility try to upload square image.</span>
                                <x-input-error class="mt-2" :messages="$errors->get('tour_profile_picture')" />
                            </div>

                            <div>
                                <x-input-label for="tour_operation_name" :value="__('Tour Operation Name')" />
                                <x-text-input id="tour_operation_name" name="tour_operation_name" type="text"
                                    class="mt-1 block w-full" :value="old('tour_operation_name', $user->tour_operation_name)" required autofocus
                                    autocomplete="tour_operation_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('tour_operation_name')" />
                            </div>

                            <div>
                                <x-input-label for="tour_contact_number" :value="__('Contact phone number')" />
                                <x-text-input id="tour_contact_number" name="tour_contact_number" type="text"
                                    class="mt-1 block w-full" :value="old('tour_contact_number', $user->tour_contact_number)" required autofocus
                                    autocomplete="tour_contact_number" />
                                <x-input-error class="mt-2" :messages="$errors->get('tour_contact_number')" />
                            </div>

                            <div>
                                <x-input-label for="tour_contact_email" :value="__('Contact email address')" />
                                <x-text-input id="tour_contact_email" name="tour_contact_email" type="email"
                                    class="mt-1 block w-full" :value="old('tour_contact_email', $user->tour_contact_email)" required autofocus
                                    autocomplete="tour_contact_email" />
                                <x-input-error class="mt-2" :messages="$errors->get('tour_contact_email')" />
                            </div>

                            <div>
                                <x-input-label for="tour_address" :value="__('Your Address')" />
                                <x-textarea id="tour_address" name="tour_address" class="mt-1 block w-full" required
                                    autofocus
                                    autocomplete="tour_address">{{ old('tour_address', $user->tour_address) }}</x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('tour_address')" />

                            </div>

                            <div>
                                <x-input-label for="tour_country" :value="__('Select Country')" />
                                <select id="tour_country" name="tour_country"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">-- Select Country --</option>
                                    @foreach (config('countries.list') as $countryCode => $countryName)
                                        <option value="{{ $countryCode }}"
                                            {{ old('tour_country', $user->tour_country) == $countryCode ? 'selected' : '' }}>
                                            {{ $countryName }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('tour_country')" />
                            </div>

                            <div>
                                <x-input-label for="tour_pincode" :value="__('Postcode')" />
                                <x-text-input id="tour_pincode" name="tour_pincode" type="text"
                                    class="mt-1 block w-full" :value="old('tour_pincode', $user->tour_pincode)" required autofocus
                                    autocomplete="tour_pincode" />
                                <x-input-error class="mt-2" :messages="$errors->get('tour_pincode')" />
                            </div>


                            <div>
                                <x-input-label for="tour_currency" :value="__('Tour Currency')" />
                                <div class="mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="tour_currency" value="EUR" class="form-radio"
                                            {{ old('tour_currency', $user->tour_currency) == 'EUR' ? 'checked' : '' }}>
                                        <span class="ml-2">€ - EUR</span>
                                    </label>
                                    <label class="inline-flex items-center ml-4">
                                        <input type="radio" name="tour_currency" value="GBP" class="form-radio"
                                            {{ old('tour_currency', $user->tour_currency) == 'GBP' ? 'checked' : '' }}>
                                        <span class="ml-2">£ - GBP</span>
                                    </label>
                                    <label class="inline-flex items-center ml-4">
                                        <input type="radio" name="tour_currency" value="USD" class="form-radio"
                                            {{ old('tour_currency', $user->tour_currency) == 'USD' ? 'checked' : '' }}>
                                        <span class="ml-2">$ - USD</span>
                                    </label>
                                </div>
                                <span class="text-gray-500">Select the currency that you will operate in. If you
                                    change this, the prices wont change automatically. You will need to change the
                                    prices manually.</span>
                                <x-input-error class="mt-2" :messages="$errors->get('tour_currency')" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
