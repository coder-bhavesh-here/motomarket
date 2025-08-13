<style>
    .select2-container--classic .select2-selection--multiple .select2-selection__choice {
        background: #1E293B !important;
        color: white !important;
    }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
    }
</style>
<form id="form-step">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Tour Title
                </div>
                <div class="w-5/6">
                    <x-input placeholder="Give your tour an exciting name"
                        value="{{ isset($tour->title) ? $tour->title : '' }}" name="title" />
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Tour Riding Style
                </div>
                <div class="w-5/6">
                    <div class="mb-6 flex items-center">
                    <x-radio id="road_trip" lg value="Road" label="Road Trip"
                        :checked="isset($tour->riding_style) && $tour->riding_style == 'Road'" name="riding_style" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Adventure on the road, its a road trip</span>
                    </div>
                    <div class="mb-6 flex items-center">
                        <x-radio id="adventure" lg value="Adventure" label="Adventure"
                            :checked="isset($tour->riding_style) && $tour->riding_style == 'Adventure'" name="riding_style" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Adventure ride on and off road</span>
                    </div>
                    <div class="mb-3 flex items-center">
                        <x-radio id="enduro" lg value="Enduro" label="Enduro"
                            :checked="isset($tour->riding_style) && $tour->riding_style == 'Enduro'" name="riding_style" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Almost all of the trip is off road</span>
                    </div>
                    <div class="text-xs italic font-normal">
                        <span>Select at least one option related to the tour</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Riding style more info
                </div>
                <div class="w-5/6">
                    <x-input
                        value="{{ isset($tour->riding_style_info) && $tour->riding_style_info ? $tour->riding_style_info : '' }}"
                        name="riding_style_info" />
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>Anything else you want to say about the riding style e.g. Mainly off road 90% fire roads 10% harder tracks</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Rider Capability
                </div>
                <div class="w-5/6">
                    <div class="mb-6 flex items-center">
                        <x-checkbox id="beginner" lg
                            label="Beginner"
                            :checked="in_array(
                                'Beginner',
                                explode(
                                    ',',
                                    isset($tour->rider_capability) && $tour->rider_capability
                                        ? $tour->rider_capability
                                        : '',
                                ),
                            )" value="Beginner" name="rider_capability[]" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Rider will need support/advice from other riders to get through</span>
                    </div>
                    <div class="mb-6 flex items-center">
                        <x-checkbox id="intermediate" lg
                            label="Intermediate"
                            :checked="in_array(
                                'Intermediate',
                                explode(
                                    ',',
                                    isset($tour->rider_capability) && $tour->rider_capability
                                        ? $tour->rider_capability
                                        : '',
                                ),
                            )" value="Intermediate" name="rider_capability[]" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Capable most of the time, but might need help when things are difficult</span>
                    </div>
                    <div class="mb-3 flex items-center">
                        <x-checkbox id="expert" lg label="Expert"
                            :checked="in_array(
                                'Expert',
                                explode(
                                    ',',
                                    isset($tour->rider_capability) && $tour->rider_capability
                                        ? $tour->rider_capability
                                        : '',
                                ),
                            )" value="Expert" name="rider_capability[]" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Can help other riders and always in control</span>
                    </div>
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>You can select multiple options. If you the tour for riders with any riding experience, select all the options</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Rider capability more info
                </div>
                <div class="w-5/6">
                    <x-input
                        value="{{ isset($tour->rider_capability_info) && $tour->rider_capability_info ? $tour->rider_capability_info : '' }}"
                        name="rider_capability_info" />
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>anything else you want to say about the rider capability for this trip e.g. If you are a novice rider, please let us know in advance</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Maximum riders
                </div>
                <div class="w-3/6">
                    <div class="w-2/6">
                        <x-input name="max_riders"
                            value="{{ isset($tour->max_riders) && $tour->max_riders ? $tour->max_riders : '' }}" />
                    </div>
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>how many maximum riders are part of the trip?</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Number of guides
                </div>
                <div class="w-3/6">
                    <div class="w-2/6">
                        <x-input name="guides"
                            value="{{ isset($tour->guides) && $tour->guides ? $tour->guides : '0' }}" />
                    </div>
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>how many guides would be part of the trip? </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Bike rental or own
                </div>
                <div class="w-5/6">
                    <div class="mb-6 flex items-center">
                        <x-radio id="included" lg
                            label="Bike is included"
                            :checked="isset($tour->bike_option) && $tour->bike_option == 'Bike included'" value="Bike included" name="bike_option" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Could be at an additional price; you can specify later</span>
                    </div>
                    <div class="mb-6 flex items-center">
                        <x-radio id="own_bike" lg
                            label="Own Bike"
                            :checked="isset($tour->bike_option) && $tour->bike_option == 'Bring own bike'" value="Bring own bike" name="bike_option" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - Rider must bring his own bike</span>
                    </div>
                    <div class="mb-3 flex items-center">
                        <x-radio id="both" lg
                            label="Own Bike or Bike Rental"
                            :checked="isset($tour->bike_option) && $tour->bike_option == 'Bike rental'" value="Bike rental" name="bike_option" />
                        <span class="font-light italic text-xs text-black">&nbsp;  - The rider can rent or bring their own</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Bike Specification
                </div>
                <div class="w-5/6">
                    <x-input name="bike_specification"
                        value="{{ isset($tour->bike_specification) && $tour->bike_specification ? $tour->bike_specification : '' }}" />
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>If the rider can bring their own bike please specify what type of bikes are allowed. e.g. Any adventure bike over 600cc. Ignore this if the bike is included or rented.</span>
                    </div>    
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Rent Gear?
                </div>
                <div class="w-5/6">
                    <div class="mb-6">
                        <x-radio id="from-us" value="1" lg label="Rider can rent gear from us"
                            :checked="isset($tour->rent_gear) && $tour->rent_gear == '1'" name="rent_gear" />
                    </div>
                    <div class="mb-3">
                        <x-radio id="own-gear" value="0" lg label="Rider needs own riding gear"
                            :checked="isset($tour->rent_gear) && $tour->rent_gear == '0'" name="rent_gear" />
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    2-up Riding?
                </div>
                <div class="w-5/6">
                    <div class="mb-6 flex items-center">
                        <x-radio id="no" lg
                            label="No" value="0"
                            :checked="isset($tour->two_up_riding) && $tour->two_up_riding == '0'" name="two_up_riding" />
                            <span class="font-light italic text-xs text-black">&nbsp; - This tour is only for the rider. So one person on the bike</span>
                    </div>
                    <div class="mb-3 flex items-center">
                        <x-radio id="yes" lg
                            label="Yes"
                            :checked="isset($tour->two_up_riding) && $tour->two_up_riding == '1'" value="1" name="two_up_riding" />
                            <span class="font-light italic text-xs text-black">&nbsp; - This tour can be done with 2 people on the bike. The rider and a passenger</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Total Distance
                </div>
                <div class="w-3/6">
                    <div class="w-2/6 flex items-center">
                        <div><x-input name="tour_distance"
                                value="{{ isset($tour->tour_distance) && $tour->tour_distance ? $tour->tour_distance : '' }}" />
                        </div>
                        <div class="ml-2"><span class="text-black text-sm"> kms</span></div>
                    </div>
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>Just provide an approximate distance</span>
                    </div>    
                </div>
            </div>
        </div>
        
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Countries
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        @php
                            $countries = isset($tour->countries) ? explode(',', $tour->countries) : [];
                        @endphp
                        <select name="countries" class="select2" style="width: 100%" multiple="multiple"
                            id="countries">
                            @foreach (config('countries.list') as $countryCode => $countryName)
                                <option value="{{ $countryCode }}"
                                    {{ in_array($countryCode, $countries) ? 'selected' : '' }}>
                                    {{ $countryName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-xs italic mt-2 font-normal text-[#636363]">
                        <span>Select all the countries that will part of the tour.</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Tour Support
                </div>
                <div class="w-5/6">
                    <div class="mb-4">
                        {{-- @dd($tour->support) --}}
                        <x-radio id="full_with_vehicle" lg label="Fully Supported with support vehicle"
                            value="Fully Supported with support vehicle" :checked="isset($tour->support) &&
                                $tour->support == 'Fully Supported with support vehicle'" name="support" />
                        <span class="font-light italic text-xs text-black ml-9">A support vehicle will be available for complete support during the trip for technical and riding assistance</span>
                    </div>
                    <div class="mb-4">
                        <x-radio id="full_without_vehicle" lg label="Fully Supported without a support vehicle"
                            :checked="isset($tour->support) &&
                                $tour->support == 'Fully Supported without a support vehicle'" value="Fully Supported without a support vehicle" name="support" />
                        <span class="font-light italic text-xs text-black ml-9">No support vehicle but the guide(s) and the team will support you with technical and riding assistance.</span>
                    </div>
                    <div class="mb-4">
                        <x-radio id="group_supports" lg label="Group supports each other" :checked="isset($tour->support) && $tour->support == 'Group supports each other'"
                            value="Group supports each other" name="support" />
                        <span class="font-light italic text-xs text-black ml-9">The group needs to support each other for technical and riding assistance</span>
                    </div>
                    <div class="mb-4">
                        <x-radio id="no_support" lg label="No Support" :checked="isset($tour->support) && $tour->support == 'No Support'" value="No Support"
                            name="support" />
                        <span class="font-light italic text-xs text-black ml-9">The rider needs to be self-sufficient. There is no support or assistance planned for the trip.</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Bike Insurance
                </div>
                <div class="w-5/6">
                    <div class="mb-4">
                        <x-radio id="included_in_price" lg label="Included in the price"
                            value="{{ App\Models\Tour::INCLUDED_IN_PRICE }}" :checked="in_array(
                                App\Models\Tour::INCLUDED_IN_PRICE,
                                explode(',', isset($tour->bike_insurance) ? $tour->bike_insurance : ''),
                            )"
                            name="bike_insurance" />
                    </div>
                    <div class="mb-4">
                        <x-radio id="addon_supplier" lg label="Add on or can be purchased from another supplier"
                            value="{{ App\Models\Tour::ADDON_OR_ANOTHER_SUPPLIER }}" :checked="in_array(
                                App\Models\Tour::ADDON_OR_ANOTHER_SUPPLIER,
                                explode(',', isset($tour->bike_insurance) ? $tour->bike_insurance : ''),
                            )"
                            name="bike_insurance" />
                    </div>
                    <div class="mb-4">
                        <x-radio id="must_purchase" lg label="The rider must purchase from a supplier"
                            value="{{ App\Models\Tour::MUST_PURCHASE }}" :checked="in_array(
                                App\Models\Tour::MUST_PURCHASE,
                                explode(',', isset($tour->bike_insurance) ? $tour->bike_insurance : ''),
                            )"
                            name="bike_insurance" />
                    </div>
                    <div class="mb-4">
                        <x-radio id="not_required" lg label="Is not required"
                            value="{{ App\Models\Tour::NOT_REQUIRED }}" :checked="in_array(
                                App\Models\Tour::NOT_REQUIRED,
                                explode(',', isset($tour->bike_insurance) ? $tour->bike_insurance : ''),
                            )" name="bike_insurance" />
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Other insurance notes
                </div>
                <div class="w-5/6">
                    <textarea id="insurance_notes" name="insurance_notes" class="mt-1 block w-full rounded-md border-gray-300"
                        rows="4">{{ isset($tour->insurance_notes) ? $tour->insurance_notes : '' }}</textarea>
                        <div class="text-xs italic mt-2 font-normal text-[#636363]">
                            <span>Specify what other cover or insurance you provide especially during an emergency, accident or breakdown.</span>
                        </div>
                </div>
            </div>
        </div>
        {{-- <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Tour Duration
                </div>
                <div class="w-3/6">
                    <div class="w-2/6 flex items-center">
                        <div><x-input name="duration_days"
                                value="{{ isset($tour->duration_days) && $tour->duration_days ? $tour->duration_days : '' }}" />
                        </div>
                        <div class="ml-2"><span>days</span></div>
                    </div>
                    <div class="text-sm text-gray-500 mt-2">
                        <span>Anything else you want to say about the riding style</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-top">
                <div class="w-1/6 font-bold text-black">
                    Number of rest days
                </div>
                <div class="w-3/6">
                    <div class="w-2/6 flex items-center">
                        <div><x-input name="rest_days"
                                value="{{ isset($tour->rest_days) && $tour->rest_days ? $tour->rest_days : '0' }}" />
                        </div>
                        <div class="ml-2"><span>days</span></div>
                    </div>
                    <div class="text-sm text-gray-500 mt-2">
                        <span>If there are any rest days, please say how many here. You might not have any rest days, in
                            such cases type '0'.</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</form>
