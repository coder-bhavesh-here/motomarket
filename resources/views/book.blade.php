@include('guest-header')
<wireui:scripts />
<div class="px-4 py-6">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <p style="font-size: 18px">
        < Go Back to <strong><a href="/tour/{{ $tour->id }}">{{ $tour->title }}</a></strong> >
    </p>

    <div class="mt-5">
        {{-- <h2 class="text-2xl font-semibold">Select a Date</h2> --}}
        <input type="hidden" value="{{ $tour->id }}" id="tour_id">
        <input type="hidden" value="{{ $selectedDate->date }}" id="date">
        <div class="mt-2 space-y-2">
            @foreach ($tourDates as $date)
                <a href="/book/{{ $date->id }}" class="mb-2"><span
                        class="book-date {{ $date->id == $selectedDate->id ? 'selected' : '' }}">
                        {{ \Carbon\Carbon::parse($date->date)->format('F d, Y') }}
                        (€{{ number_format($date->price, 2) }})
                    </span></a>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Your Details</h2>

        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Your Name
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        <x-input id="name" placeholder="Please provide your formal full name" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Date of Birth
                </div>
                <div class="w-1/6">
                    <div class="items-center">
                        <input class="w-full" type="date" name="dob" id="dob">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Your Nationality
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        <x-input id="nationality" placeholder="Please provide your nationality" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Driving licence number
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        <x-input id="driving_license_number" placeholder="Please provide driving licence number" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Mobile Number
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        <x-input id="mobile_number" placeholder="Please provide mobile number" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Your Address
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        <x-textarea id="address" placeholder="Please provide your address" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Country
                </div>
                <div class="w-5/6">
                    <div class="items-center">
                        <x-input id="country" placeholder="Please provide country" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-10 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="w-1/6">
                    Postcode
                </div>
                <div class="w-1/6">
                    <div class="items-center">
                        <x-input id="postcode" placeholder="Please provide postal code" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="mt-6">
        <div class="my-10 sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold">Add-Ons</h2>
            <p class="my-2">Select all the add-ons for this tour from the list below.</p>

            <div class="mt-2 space-y-2">
                @foreach ($tour->addOns as $addOn)
                    <div class="inline-flex w-full items-center p-3 addon-div">
                        <input type="checkbox" name="addons[]" class="selectedAddOns" value="{{ $addOn->id }}"
                            id="{{ $addOn->id }}" data-id="{{ $addOn->id }}"
                            data-price="{{ number_format($addOn->addon_price, 2) }}">
                        <label for="{{ $addOn->id }}" class="ml-2">{{ $addOn->addon }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-6">
        <input type="hidden" id="tour_price" value="{{ number_format($selectedDate->price, 2) }}">
        <h2 class="text-xl font-semibold">Total Tour Price : <strong>€<span
                    id="total_price">{{ number_format($selectedDate->price, 2) }}</span></strong></h2>
    </div>

    <div class="mt-4">
        <x-checkbox label="Please agree to our tour terms and cancellation policy. You can read it here->"
            wire:model="agreeTerms" />
    </div>

    <div class="mt-4">
        <x-button primary label="Confirm Booking" id="confirmBooking" />
        {{-- stripe integration --}}
        {{-- On the application, while making a booking user will have two options to choose from:
        If the tour date is less than 2 month away, user will have to pay with 100% of the total price.
        If the tour date is more than 2 month away, user will have to pay with 25% of the total price.
        All the payments will be made through stripe. Also, the payment will be credited to the account of CJ only at this time. --}}
        @if ($selectedDate->date < now()->addMonths(2))
            @php
                // Pay 100% of the total price
                $pay = $totalPrice = $selectedDate->price;
            @endphp
        @else
            @php
                // Pay 25% of the total price
                $totalPrice = $selectedDate->price * 0.25;
                $pay = $selectedDate->price;
            @endphp
            <button class="make-payment primary-button" data-id="{{ $selectedDate->id }}"
                data-price="{{ $totalPrice }}" id="payWithStripe">Pay 25% - <span
                    id="twentyFivePay">{{ $totalPrice }}</span>£</button>
        @endif
        <button class="make-payment primary-button" data-id="{{ $selectedDate->id }}"
            data-price="{{ $pay }}" id="payWithStripe">Pay 100% - <span
                id="hundredPay">{{ $pay }}</span>£</button>
    </div>
</div>
<script>
    // on click of .make-payment send the id and price to makePayment route
    $(".make-payment").click(function(e) {
        const id = $(this).data("id");
        const price = $(this).data("price");
        $.ajax({
            type: "POST",
            url: "/payment",
            data: {
                id,
                price
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            success: function(response) {
                window.location.href = response.redirect_url;
            }
        });
    });
    $(document).ready(function() {
        const basePrice = parseFloat($("#tour_price").val().replace(',', '')); // Get the base tour price

        function calculateTotalPrice() {
            let totalPrice = basePrice;
            $(".selectedAddOns:checked").each(function() {
                totalPrice += parseFloat($(this).data("price").replace(',', ''));
            });
            $("#total_price").html(totalPrice.toFixed(2));
            $("#hundredPay").html(totalPrice.toFixed(2));
            $("#hundredPay").parent().attr("data-price", totalPrice.toFixed(2));
            $("#twentyFivePay").html((totalPrice * 0.25).toFixed(2));
            $("#twentyFivePay").parent().attr("data-price", (totalPrice * 0.25).toFixed(2));
        }
        $(".selectedAddOns").on("click", function() {
            calculateTotalPrice();
        });
    });
    $("#confirmBooking").click(function(e) {
        const addons = $("input[name='addons[]']:checked")
            .map(function() {
                return $(this).val();
            }).get().join(",");
        const tour_id = $("#tour_id").val();
        const date = $("#date").val();
        const amount = $("#total_price").html();
        const name = $("#name").val();
        const dob = $("#dob").val();
        const nationality = $("#nationality").val();
        const driving_license_number = $("#driving_license_number").val();
        const mobile_number = $("#mobile_number").val();
        const address = $("#address").val();
        const country = $("#country").val();
        const postcode = $("#postcode").val();
        $.ajax({
            type: "POST",
            url: "/book",
            data: {
                tour_id,
                date,
                amount,
                addons,
                name,
                dob,
                nationality,
                driving_license_number,
                mobile_number,
                address,
                country,
                postcode
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            success: function(response) {
                if (response.message === "Booking saved successfully") {
                    alert(response.message);
                    window.location.href = "/my-tours";
                }
            }
        });
    });
</script>
@include('footer')
