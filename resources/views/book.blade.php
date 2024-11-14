@include('guest-header')
<wireui:scripts />
<div class="px-4 py-6">
    <p>Go Back to <strong>Hard Enduro Tours Bulgaria - Wild Bulgaria</strong></p>

    <div class="mt-4">
        <h2 class="text-2xl font-semibold">Select a Date</h2>
        <div class="mt-2 space-y-2">
            @foreach ($tourDates as $date)
                <x-button label="{{ $date->date }} €{{ number_format($date->price, 2) }}"
                    wire:click="selectDate({{ $date->id }})" />
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Your Details</h2>
        <x-input label="Your Name" placeholder="Please provide your formal full name" wire:model="name" />
        <x-datetime-picker label="DOB" placeholder="yyyy - mm - dd" without-time wire:model="dob" />

        <x-select label="Your Nationality" placeholder="Select your nationality" wire:model="nationality">
            @foreach ($nationalities as $nationality)
                <x-select.option label="{{ $nationality }}" value="{{ $nationality }}" />
            @endforeach
        </x-select>

        <x-input label="Driving License Number" placeholder="Please type your driving licence number here"
            wire:model="licenseNumber" />
        <x-input label="Mobile Number" placeholder="Your mobile phone number" wire:model="mobileNumber" />
        <x-input label="Your Address" placeholder="Your address" wire:model="address" />
        <x-input label="Country" placeholder="Country" wire:model="country" />
        <x-input label="Postcode" placeholder="Postcode" wire:model="postcode" />
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Add-Ons</h2>
        <p>Select all the add-ons for this tour from the list below.</p>

        <div class="mt-2 space-y-2">
            @foreach ($tour->addOns as $addOn)
                <x-checkbox label="{{ $addOn['name'] }} €{{ number_format($addOn['price'], 2) }}"
                    wire:model="selectedAddOns" value="{{ $addOn['id'] }}" />
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Total Tour Price</h2>
        <p>Total Tour Price: <strong>€{{ number_format(5000, 2) }}</strong></p>
        <p>Pay today (10%): <strong>€{{ number_format(5000 * 0.1, 2) }}</strong></p>
        <p>Pay before the 30th August 2024 (90%): <strong>€{{ number_format(5000 * 0.9, 2) }}</strong></p>
    </div>

    <div class="mt-4">
        <x-checkbox label="Please agree to our tour terms and cancellation policy. You can read it here->"
            wire:model="agreeTerms" />
    </div>

    <div class="mt-4">
        <x-button primary label="Confirm & Pay" wire:click="confirmAndPay" />
    </div>
</div>
@include('footer')
