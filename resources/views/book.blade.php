@include('new-header')
@php
    $currency = $tour->user->tour_currency;
    $symbol = match ($currency) {
        'euro' => '€',
        'usd' => '$',
        'gbp' => '£',
        default => '€',
    };
@endphp
<style>
    ul li {
        margin-top: 1.25rem;
    }
    .iti__country-container button {
            border: unset !important;
        }
        .iti {
            width: 100% !important;
        }
</style>
<wireui:scripts />

<!-- Filter Modal -->
<div id="filterModal" class="absolute inset-0 backdrop-blur-sm z-50 hidden" style="background: #ffffff70;">
    <div class="bg-white rounded-lg py-4 px-2 wommd:p-8 womsm:max-w-[80%] wommd:max-w-[75%] womsm:mx-auto womsm:mt-20 relative" style="box-shadow: 0 0 10px 0px gray;">
        <svg onclick="closeFilterModal()"
            class="cursor-pointer absolute m-4 top-4 right-4 text-gray-500 hover:text-gray-700 w-6 h-6" width="32"
            height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
            <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2" stroke-linecap="round" />
        </svg>


        <h2 class="text-base womsm:text-xl wommd:text-2xl font-semibold ml-5 wommd:ml-0 mt-4 mb-6 text-black text-left wommd:text-center">Payment and Refund Policy</h2>

        <div class="w-full justify-items-center">
            <div class="w-4/5 wommd:w-3/4 text-[#0F172A] font-bold text-sm womsm:text-base wommd:text-lg">
                Here are our payment and refund policies in brief:
            </div>
            <div class="flex justify-center">
                <ul style="list-style: disc;" class="pt-2 p-8 w-4/5 wommd:w-3/4 text-[#0F172A] font-normal text-xs womsm:text-sm wommd:text-base">
                    <li>Full Payment: For tours starting less than 60 days from the booking date, full payment is required at the time of booking.</li>
                    <li>Partial Payment: For tours starting more than 60 days from the booking date, a payment of 25% of the total tour price or the full payment required to confirm the booking. The remaining balance must be paid no later than 30 days before the tour start date.</li>
                    <li>For tours booked with a 25% deposit, full payment is due 30 days before the tour start date.</li>
                    <li>Ample notice and reminders will be provided to help ensure timely payment.</li>
                    <li>You may cancel a tour up to 30 days before the tour start date.</li>
                    <li>You can request a refund to their original payment method 30 days before the tour start date.</li>
                    <li>Refunds will be processed after deducting a 5% servicing and bank handling charges.</li>
                    <li>Users can opt to receive 100% of the payment as platform credit.</li>
                    <li>Credits can be used to book future tours on the platform and are valid for 24 months from the date of issuance.</li>
                    <li>If a user is unable to attend a tour after making the full payment for the booking they may transfer their booking to another WorldOnMoto.com member.</li>
                </ul>
            </div>
            <div class="w-4/5 wommd:w-3/4">
                <a target="_blank" href="/terms-of-use" class="text-green underline text-xs womsm:text-sm wommd:text-base">Read the full terms here</a>
            </div>
            <div class="flex justify-evenly space-x-4">
                <button type="button" onclick="closeFilterModal()"
                    class="mt-8 womsm:px-8 womsm:py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 primary-button">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<div class="w-full grid grid-cols-1 xl:grid-cols-5">
    <div class="col-span-3">
        <div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="sm:px-6 lg:px-8">
                <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('explore-tours') }}">Tour Search</a></u> > <u><a href="/tour/{{ $tour->id }}">Tour Details</a></u> > Booking</p>
                <p class="my-4 font-semibold text-[#0F172A] text-lg womsm:text-xl wommd:text-2xl">
                    {{ $tour->title }} - {{ $tour->countries }}
                </p>
                {{-- <div class="font-extrabold text-black mt-2 text-lg womsm:text-xl wommd:text-2xl">
                    YOUR BOOKING
                </div>
                <div class="text-sm womsm:text-base wommd:text-lg my-2 text-[#0F172A] inline-flex justify-center">
                    <span>{{ \Carbon\Carbon::parse($selectedDate->date)->format('F jS, Y') }}</span>
                    <span><a href="/tour/{{ $tour->id }}" class="text-green font-semibold ml-2 text-xs womsm:text-sm wommd:text-base"><u>Change</u></a></span>
                </div> --}}
            </div>
            <div class="mt-5">
                {{-- <h2 class="text-2xl font-semibold">Select a Date</h2> --}}
                <input type="hidden" value="{{ $tour->id }}" id="tour_id">
                <input type="hidden" value="{{ $selectedDate->date }}" id="date">
                {{-- <div class="mt-2 space-y-2">
                    @foreach ($tourDates as $date)
                        <a href="/book/{{ $date->id }}" class="mb-2"><span
                                class="book-date {{ $date->id == $selectedDate->id ? 'selected' : '' }}">
                                {{ \Carbon\Carbon::parse($date->date)->format('F d, Y') }}
                                (€{{ number_format($date->price, 2) }})
                            </span></a>
                    @endforeach
                </div> --}}
            </div>
        
            <div class="mt-6">
                <div class="my-6 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <div class="w-full">
                            <span class="form-label font-medium text-[#000F22]">Full Name</span>
                            <div class="items-center">
                                <x-input id="name" placeholder="Please provide your formal full name" value="{{auth()->user()->name.' '.auth()->user()->last_name}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-6 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <div class="w-full">
                            <span class="form-label font-medium text-[#000F22]">Nationality</span>
                            <div class="items-center">
                                <select name="nationality" style="width: 100%" id="nationality" class="border border-[#d6d3d1] rounded">
                                    <option value="">- Select Nationality -</option>
                                    @foreach (config('countries.list') as $countryName)
                                        <option value="{{ $countryName }}" {{($nationality == $countryName ? "selected" : '')}}>
                                            {{ $countryName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-6 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <div class="w-full">
                            <span class="form-label font-medium text-[#000F22]">Your Address</span>
                            <div class="items-center">
                                <x-textarea id="address" placeholder="Please provide your address">{{ auth()->user()->address }}</x-textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-6 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <div class="w-full">
                            <span class="form-label font-medium text-[#000F22]">Country</span>
                            <div class="items-center">
                                {{-- <x-input id="country" placeholder="Please provide country" /> --}}
                                <select name="country" style="width: 100%" id="country" class="border border-[#d6d3d1] rounded">
                                    <option value="">- Select country -</option>
                                    @foreach (config('countries.list') as $countryName)
                                        <option value="{{ $countryName }}" {{($country == $countryName ? "selected" : '')}}>
                                            {{ $countryName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-6 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <div class="w-full">
                            <span class="form-label font-medium text-[#000F22]">Postcode</span>
                            <div class="items-center">
                                <x-input id="postcode" value="{{$pincode}}" placeholder="Please provide postal code" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-6 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <div class="w-full">
                            <span class="form-label font-medium text-[#000F22]">Mobile</span>
                            <div class="items-center">
                                <x-text-input class="block w-full" id="mobile_number" placeholder="Please provide mobile number" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-6 mt-4 flex flex-col justify-evenly items-center">
            @php
                $addonPrices = 0;
            @endphp
            @foreach ($addons as $addon)
                @php
                    $addonPrices = $addonPrices + $addon->price;
                @endphp
            @endforeach
            @if ($selectedDate->date < now()->addMonths(2))
                @php
                    // Pay 100% of the total price
                    $pay = $totalPrice = $selectedDate->price + $addonPrices;
                @endphp
            @else
                @php
                    // Pay 25% of the total price
                    $totalPrice = ($selectedDate->price + $addonPrices) * 0.25;
                    $pay = $selectedDate->price + $addonPrices;
                @endphp
                    <button class="make-payment primary-button w-1/2 mb-4" data-id="{{ $selectedDate->id }}"
                        data-price="{{ $totalPrice }}" id="payWithStripe">Book now - 25% (<span
                        id="twentyFivePay">{{$symbol}} {{ number_format($totalPrice, 2) }}</span>)</button>
                @endif
            <button class="make-payment primary-button w-1/2" data-id="{{ $selectedDate->id }}"
            data-price="{{ $pay }}" id="payWithStripe">Book now - 100% ({{ $symbol }} <span id="hundredPay">{{ number_format($pay, 2) }}</span>)</button>
        </div>
    </div>
    <div class="m-10 col-span-2">
        <div class="rounded-2xl bg-[#556B2F0F]">
            @php
                $tour->images = $tour->images->sortBy('index')->first();
            @endphp
            <img class="max-h-[300px] rounded-lg object-cover h-full w-full"
                src="{{ isset($tour->images) && isset($tour->images->image_path) ? asset('storage') . '/' . $tour->images->image_path : 'https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg' }}"
                alt="Tour photo">
            {{-- <img class="max-h-[300px] rounded-xl object-cover h-full w-full"
                src="https://images.wanderon.in/blogs/new/2023/03/stones-at-chandrataal-lake-1.jpg"
                alt="Tour photo"> --}}
            <div class="content p-10">
                <div class="inline-flex justify-center items-center">
                    <span class="text-black font-bold text-lg womsm:text-xl wommd:text-2xl">YOUR BOOKING</span>
                <span><a href="/tour/{{ $tour->id }}" class="text-green font-semibold ml-2 text-xs womsm:text-sm wommd:text-base"><u>Change</u></a></span>
                </div>
                <div class="title">
                    <p class="my-4 font-semibold text-[#0F172A] text-base womsm:text-lg wommd:text-xl">
                        {{ $tour->title }} - {{ $tour->countries }}
                    </p>
                </div>
                <div class="dates mt-2 text-black text-sm womsm:text-base wommd:text-lg font-medium">
                    <div class="mt-6">START DATE</div>
                    <div>{{ \Carbon\Carbon::parse($selectedDate->date)->format('F jS, Y') }}</div>
                    <div class="mt-6">END DATE</div>
                    <div>{{ \Carbon\Carbon::parse($selectedDate->end_date)->format('F jS, Y') }}</div>
                </div>
                <div class="text-[#000F22] addons-selected mt-6">
                    <div class="font-semibold text-sm womsm:text-base wommd:text-lg">Add ons selected:</div>
                    <div id="addonsShow" class="font-medium">
                        @php
                            $addonPrices = 0;
                        @endphp
                        {{-- @dd($addons); --}}
                        @foreach ($addons as $addon)
                            <div class='w-full mt-4 inline-flex justify-between'>
                                <span>{{ $addon->group->name }} - {{ $addon->name }}</span><span style="min-width: 100px;text-align: right;"> {{$symbol}} {{ $addon->price }} </span>
                            </div>
                            @php
                                $addonPrices = $addonPrices + $addon->price;
                            @endphp
                        @endforeach
                    </div>
                </div>
                <div class="mt-6 border-t border-black pt-4 text-[#000F22]">
                    <div class="inline-flex justify-between w-full">
                        <span>Add ons price</span>
                        <span>{{$symbol}} <span id="addonPrice">{{ number_format($addonPrices, 2) }}</span></span>
                    </div>
                    <div class="mt-2 inline-flex justify-between w-full">
                        <span>Tour price</span>
                        <span>{{$symbol}} {{number_format($selectedDate->price, 2)}}</span>
                    </div>
                </div>
                <div class="mt-6 border-t inline-flex items-center justify-between border-black pt-4 w-full">
                    <input type="hidden" id="tour_price" value="{{ number_format($selectedDate->price + $addonPrices, 2) }}">
                    <span class="text-black font-semibold">Total</span> 
                    <strong>
                        <span class="text-2xl text-black" id="total_price">{{$symbol}} {{ number_format($selectedDate->price + $addonPrices, 2) }}</span>
                    </strong>
                </div>
                <div class="mt-4">
                    <div id="validation-errors" class="text-red-600 mb-4 hidden"></div>
                    @if ($selectedDate->date < now()->addMonths(2))
                        @php
                            // Pay 100% of the total price
                            $pay = $totalPrice = $selectedDate->price + $addonPrices;
                        @endphp
                    @else
                        @php
                            // Pay 25% of the total price
                            $totalPrice = ($selectedDate->price + $addonPrices) * 0.25;
                            $pay = $selectedDate->price + $addonPrices;
                        @endphp
                        <button class="make-payment primary-button w-full mb-4" data-id="{{ $selectedDate->id }}"
                            data-price="{{ $totalPrice }}" id="payWithStripe">Book now - 25% (<span
                                id="twentyFivePay">{{$symbol}} {{ number_format($totalPrice, 2) }}</span>)</button>
                    @endif
                    <button class="make-payment primary-button w-full" data-id="{{ $selectedDate->id }}"
                        data-price="{{ $pay }}" id="payWithStripe">Book now - 100% ({{ $symbol }} <span id="hundredPay">{{ number_format($pay, 2) }}</span>)</button>
                </div>
            </div>
        </div>
        <div class="text-xs womsm:text-sm wommd:text-base text-[#0F172A]">
            @php
                $tourDate = \Carbon\Carbon::parse($selectedDate->date);
                $fullPaymentDue = $tourDate->copy()->subDays(60)->format('jS F, Y');
            @endphp
            @if (now()->diffInDays($tourDate) > 60)
                <div class="mt-4 italic">Since your tour is <b>more than 60 days</b> away, you can secure your spot by either paying the <b>full tour price now</b> or <b>making a 25% deposit</b>.</div>
                <div class="mt-4 italic">If you choose the <b>deposit option</b>, the <b>remaining balance</b> must <b>be paid</b> in full by <b>{{$fullPaymentDue}}</b>.</div>
            @else
                <div class="mt-4 italic">
                    For tours starting in <b>less than 60 days</b>, <b>full payment is required</b> to confirm your booking.
                </div>
                <div class="mt-4 italic">
                    For tours starting <b>more than 60 days away</b>, you can <b>secure your spot with a 25%</b> deposit of the tour price.
                </div>
            @endif
            <div class="mt-4 italic">Read more about our: <a onclick="openFilterModal()" class="text-green underline cursor-pointer">payment terms and refund policy</a>.</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>
<script>
    const phoneInput = document.querySelector("#mobile_number");
    const iti = window.intlTelInput(phoneInput, {
        separateDialCode: true,
        strictMode: true,
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
    });
    const storedNumber = "{{ auth()->user()->contact_number }}";
    if (storedNumber) {
        iti.setNumber(storedNumber); // Will auto-select country & fill number
    }
</script>
<script>
    function openFilterModal() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        document.getElementById('filterModal').classList.remove('hidden');
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
    }
    const notyf = new Notyf({
        position: { x: 'center', y: 'top' },
        duration: 3000, // optional, toast visible 3 seconds
        dismissible: true
    });
    function validateForm() {
        const requiredFields = {
            name: "Name",
            nationality: "Nationality",
            mobile_number: "Mobile Number",
            address: "Address",
            country: "Country",
            postcode: "Postcode"
        };
        Object.keys(requiredFields).forEach(field => {
            $(`#${field}`).removeClass('border-1 border-red-400 ring-1 ring-red-300');
        });

        let errors = [];

        // Check each required field
        Object.entries(requiredFields).forEach(([field, label]) => {
            const $fieldEl = $(`#${field}`);
            if (!$fieldEl.val()) {
                errors.push(`${label} is required`);
                $fieldEl.addClass('border-1 border-red-400 ring-1 ring-red-300'); // add red border
            }
        });

        if (!iti.isValidNumber()) {
            errors.push('Please enter a valid phone number');
            $("#mobile_number").addClass('border-1 border-red-400 ring-1 ring-red-300');
        }

        // Display errors if any
        // const errorDiv = $("#validation-errors");
        // if (errors.length > 0) {
        //     errorDiv.html(errors.join('<br>')).removeClass('hidden');
        //     return false;
        // }
        if (errors.length > 0) {
            errors.forEach(err => {
                notyf.error(err);
            });
            return false;
        }
        // errorDiv.addClass('hidden');
        return true;
    }

    $(".make-payment").click(function(e) {
        showLoader();
        e.preventDefault();
        // First validate the form
        if (!validateForm()) {
            hideLoader();
            return false;
        }
        const id = $(this).data("id");
        const price = $(this).data("price");
        const addons = $("input[name='addons[]']:checked")
            .map(function() {
                return $(this).val();
            }).get().join(",");
        const date = $("#date").val();
        const amount = $("#total_price").html();
        const name = $("#name").val();
        const nationality = $("#nationality").val();
        const mobile_number = iti.getNumber();
        const address = $("#address").val();
        const country = $("#country").val();
        const postcode = $("#postcode").val();
        $.ajax({
            type: "POST",
            url: "/payment",
            data: {
                id,
                price,
                addons,
                date,
                amount,
                name,
                nationality,
                mobile_number,
                address,
                country,
                postcode
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                hideLoader();
                window.location.href = response.redirect_url;
            }
        });
    });

    $(document).ready(function() {
        const basePrice = parseFloat($("#tour_price").val().replace(',', '')); // Get the base tour price

        function calculateTotalPrice() {
            let totalPrice = basePrice;
            $("#addonsShow").html('');
            $(".selectedAddOns:checked").each(function() {
                tempPrice = $(this).data("price");
                tempName = $(this).data("value");
                $("#addonsShow").append("<div class='w-full mt-4 inline-flex justify-between'><span>"+ tempName +"</span><span>"+ tempPrice +"£</span></div>");
                totalPrice += parseFloat(tempPrice.replace(',', ''));
            });
            const addonPrice = totalPrice - basePrice;
            $("#total_price").html(totalPrice.toFixed(2));
            $("#addonPrice").html(addonPrice.toFixed(2));
            // $("#addonPrice").parent().attr("data-price", addonPrice.toFixed(2));
            $("#hundredPay").html(totalPrice.toFixed(2));
            $("#hundredPay").parent().attr("data-price", totalPrice.toFixed(2));
            $("#twentyFivePay").html((totalPrice * 0.25).toFixed(2));
            $("#twentyFivePay").parent().attr("data-price", (totalPrice * 0.25).toFixed(2));
        }
        $(".selectedAddOns").on("click", function() {
            calculateTotalPrice();
        });
    });
</script>
@include('footer')
