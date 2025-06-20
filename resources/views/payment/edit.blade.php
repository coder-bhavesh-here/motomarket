<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8">
                <span class="text-orange text-xl font-semibold">Tour Payment Settings</span>
                <div class="w-full">
                    <form method="POST" action="{{ route('payment.update') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <label class="font-bold text-black mr-2" for="tour_currency">Tour Currency</label>
                            <input type="radio" name="tour_currency" class="ml-2" <?= $user->tour_currency == 'euro' ? 'checked' : ''?> value="euro" id="euro"><label class="ml-1 text-black" for="euro">€ - Euro </label>
                            <input type="radio" name="tour_currency" class="ml-2" <?= $user->tour_currency == 'gbp' ? 'checked' : ''?> value="gbp" id="gbp"><label class="ml-1 text-black" for="gbp">£ - GBP </label>
                            <input type="radio" name="tour_currency" class="ml-2" <?= $user->tour_currency == 'usd' ? 'checked' : ''?> value="usd" id="usd"><label class="ml-1 text-black" for="usd">$ - USD </label>
                            <x-input-error class="mt-2" :messages="$errors->get('tour_currency')" />
                        </div>
                        <div>
                            <x-input-label for="bank_name" :value="__('Bank Name')" />
                            <x-text-input id="bank_name" name="bank_name" type="text" class="mt-1 block w-full" :value="old('bank_name', $user->bank_name)" placeholder="Eg: HSBC"/>
                            <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />
                        </div>
                        <div>
                            <x-input-label for="bank_operating_country" :value="__('Bank Operating Country')" />
                            <x-text-input id="bank_operating_country" name="bank_operating_country" type="text" class="mt-1 block w-full" :value="old('bank_operating_country', $user->bank_operating_country)" placeholder="United Kingdom"/>
                            <x-input-error class="mt-2" :messages="$errors->get('bank_operating_country')" />
                        </div>
                        <div>
                            <x-input-label for="iban" :value="__('IBAN')" />
                            <x-text-input id="iban" name="iban" type="text" class="mt-1 block w-full" :value="old('iban', $user->iban)" />
                            <x-input-error class="mt-2" :messages="$errors->get('iban')" />
                        </div>
                        <div>
                            <x-input-label for="swift_bic" :value="__('SWIFT / BIC')" />
                            <x-text-input id="swift_bic" name="swift_bic" type="text" class="mt-1 block w-full" :value="old('swift_bic', $user->swift_bic)" />
                            <x-input-error class="mt-2" :messages="$errors->get('swift_bic')" />
                        </div>
                        <div>
                            <x-input-label for="bank_account_number" :value="__('Bank Account Number')" />
                            <x-text-input id="bank_account_number" name="bank_account_number" type="text" class="mt-1 block w-full" :value="old('bank_account_number', $user->bank_account_number)" />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_account_number')" />
                        </div>
                        <div>
                            <x-input-label for="sort_code" :value="__('Sort Code')" />
                            <x-text-input id="sort_code" name="sort_code" type="text" class="mt-1 block w-full" :value="old('sort_code', $user->sort_code)" />
                            <x-input-error class="mt-2" :messages="$errors->get('sort_code')" />
                        </div>
                        <div>
                            <x-input-label for="account_name" :value="__('Account Name')" />
                            <x-text-input id="account_name" name="account_name" type="text" class="mt-1 block w-full" :value="old('account_name', $user->account_name)" />
                            <x-input-error class="mt-2" :messages="$errors->get('account_name')" />
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
    
</x-app-layout>
