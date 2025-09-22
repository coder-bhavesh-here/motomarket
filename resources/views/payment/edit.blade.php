@include('tour-operator-profile-header')
    <style>
        .btn-orange {
            min-height: 36px !important;
            color: white !important;
            border-radius: 5px !important;
            border: unset !important;
            font-weight: 700 !important;
            padding: 14px 20px !important;
            font-size: 16px !important;
        }
    </style>
    <div>
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8">
                <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('profiles') }}">Settings</a></u> > Tour Payment Settings</p>
                <span class="block text-orange text-xl womsm:text-2xl wommd:text-3xl font-bold my-6">Tour Payment Settings</span>
                <div class="w-full">
                    <form method="POST" action="{{ route('payment.update') }}" class="mt-6 space-y-6 w-full wommd:w-3/5">
                        @csrf
                        <div class="flex">
                            <label class="font-bold text-black mr-2" for="tour_currency">Tour Currency</label>
                            <div class="flex items-center"><input type="radio" name="tour_currency" class="ml-4" <?= $user->tour_currency == 'euro' ? 'checked' : ''?> value="euro" id="euro"><label class="ml-2 text-black" for="euro">€ - Euro </label></div>
                            <div class="flex items-center"><input type="radio" name="tour_currency" class="ml-10" <?= $user->tour_currency == 'gbp' ? 'checked' : ''?> value="gbp" id="gbp"><label class="ml-2 text-black" for="gbp">£ - GBP </label></div>
                            <div class="flex items-center"><input type="radio" name="tour_currency" class="ml-10" <?= $user->tour_currency == 'usd' ? 'checked' : ''?> value="usd" id="usd"><label class="ml-2 text-black" for="usd">$ - USD </label></div>
                            <x-input-error class="mt-2" :messages="$errors->get('tour_currency')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="bank_name">Bank Name</label>
                            <x-text-input id="bank_name" name="bank_name" type="text" class="mt-1 block w-full" :value="old('bank_name', $user->bank_name)" placeholder="Eg: HSBC"/>
                            <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="bank_operating_country">Bank Operating Country</label>
                            <x-text-input id="bank_operating_country" name="bank_operating_country" type="text" class="mt-1 block w-full" :value="old('bank_operating_country', $user->bank_operating_country)" placeholder="United Kingdom"/>
                            <x-input-error class="mt-2" :messages="$errors->get('bank_operating_country')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="iban">IBAN</label>
                            <x-text-input id="iban" name="iban" type="text" class="mt-1 block w-full" :value="old('iban', $user->iban)" />
                            <x-input-error class="mt-2" :messages="$errors->get('iban')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="swift_bic">SWIFT / BIC</label>
                            <x-text-input id="swift_bic" name="swift_bic" type="text" class="mt-1 block w-full" :value="old('swift_bic', $user->swift_bic)" />
                            <x-input-error class="mt-2" :messages="$errors->get('swift_bic')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="bank_account_number">Bank Account Number</label>
                            <x-text-input id="bank_account_number" name="bank_account_number" type="text" class="mt-1 block w-full" :value="old('bank_account_number', $user->bank_account_number)" />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_account_number')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="sort_code">Sort Code</label>
                            <x-text-input id="sort_code" name="sort_code" type="text" class="mt-1 block w-full" :value="old('sort_code', $user->sort_code)" />
                            <x-input-error class="mt-2" :messages="$errors->get('sort_code')" />
                        </div>
                        <div>
                            <label class="font-bold text-black" for="account_name">Account Name</label>
                            <x-text-input id="account_name" name="account_name" type="text" class="mt-1 block w-full" :value="old('account_name', $user->account_name)" />
                            <x-input-error class="mt-2" :messages="$errors->get('account_name')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button type="submit" class="btn-orange w-full">Save</button>
                            <a href="/profiles" class="btn-orange w-full text-center">Close</a>
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
@include('footer')