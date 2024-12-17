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
            <x-nav-link :href="route('bookings')" :active="request()->routeIs('bookings')">
                {{ __('Booking Orders') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Bank Details -->
                <form method="post" action="{{ route('tours.settings.update') }}">
                    @csrf
                    @method('patch')
                    <div>
                        <h3 class="text-md font-semibold">{{ __('Bank Details to Receive Payments') }}</h3>

                        <!-- Bank Name -->
                        <div class="mt-5">
                            <x-input-label for="bank_name" :value="__('Name of the Bank')" />
                            <x-text-input id="bank_name" name="bank_name" type="text" class="block w-full mt-1"
                                value="{{ old('bank_name', isset($tour_setting->bank_name) && $tour_setting->bank_name != '' ? $tour_setting->bank_name : '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />
                        </div>

                        <!-- Bank Operating Country -->
                        <div class="mt-5">
                            <x-input-label for="bank_country" :value="__('Bank Operating Country')" />
                            <select id="bank_country" name="bank_country"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Select Country --</option>
                                @foreach (config('countries.list') as $countryCode => $countryName)
                                    <option value="{{ $countryCode }}"
                                        {{ old('bank_country', isset($tour_setting->bank_country) && $tour_setting->bank_country != '' ? $tour_setting->bank_country : '') == $countryCode ? 'selected' : '' }}>
                                        {{ $countryName }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('bank_country')" />
                        </div>

                        <!-- IBAN -->
                        <div class="mt-5">
                            <x-input-label for="iban" :value="__('IBAN')" />
                            <x-text-input id="iban" name="iban" type="text" class="block w-full mt-1"
                                value="{{ old('iban', isset($tour_setting->iban) && $tour_setting->iban != '' ? $tour_setting->iban : '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('iban')" />
                        </div>

                        <!-- SWIFT/BIC -->
                        <div class="mt-5">
                            <x-input-label for="swift" :value="__('SWIFT/BIC')" />
                            <x-text-input id="swift" name="swift" type="text" class="block w-full mt-1"
                                value="{{ old('swift', isset($tour_setting->swift) && $tour_setting->swift != '' ? $tour_setting->swift : '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('swift')" />
                        </div>

                        <!-- Bank Account Number -->
                        <div class="mt-5">
                            <x-input-label for="account_number" :value="__('Bank Account Number')" />
                            <x-text-input id="account_number" name="account_number" type="text"
                                class="block w-full mt-1"
                                value="{{ old('account_number', isset($tour_setting->account_number) && $tour_setting->account_number != '' ? $tour_setting->account_number : '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('account_number')" />
                        </div>

                        <!-- Sort Code -->
                        <div class="mt-5">
                            <x-input-label for="sort_code" :value="__('Sort Code')" />
                            <x-text-input id="sort_code" name="sort_code" type="text" class="block w-full mt-1"
                                value="{{ old('sort_code', isset($tour_setting->sort_code) && $tour_setting->sort_code != '' ? $tour_setting->sort_code : '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('sort_code')" />
                        </div>

                        <!-- Account Name -->
                        <div class="mt-5">
                            <x-input-label for="account_name" :value="__('Account Name')" />
                            <x-text-input id="account_name" name="account_name" type="text" class="block w-full mt-1"
                                value="{{ old('account_name', isset($tour_setting->account_name) && $tour_setting->account_name != '' ? $tour_setting->account_name : '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('account_name')" />
                        </div>
                        <div class="flex items-center mt-4 gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
