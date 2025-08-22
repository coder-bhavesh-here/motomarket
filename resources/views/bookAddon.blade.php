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
                <a href="#" class="text-green underline text-xs womsm:text-sm wommd:text-base">Read the full terms here</a>
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
        <div class="px-4 py-6">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="sm:px-6 lg:px-8">
                <p class="text-green font-semibold"><u><a href="{{ route('homepage') }}">Home</a></u> > <u><a href="{{ route('explore-tours') }}">Tour Search</a></u> > <u><a href="/tour/{{ $tour->id }}">Tour Details</a></u> > Booking</p>
                <p class="my-4 font-semibold text-[#0F172A] text-lg womsm:text-xl wommd:text-2xl">
                    {{ $tour->title }} - {{ $tour->countries }}
                </p>
                <div class="inline-flex justify-center items-center my-3">
                    @php
                        $profile_picture =
                            $tour->user->tour_profile_picture != ''
                                ? $tour->user->tour_profile_picture
                                : ($tour->user->profile_picture != ''
                                    ? $tour->user->profile_picture
                                    : '');
                        $tour_operation_name =
                            $tour->user->tour_operation_name != ''
                                ? $tour->user->tour_operation_name
                                : ($tour->user->name != ''
                                    ? $tour->user->name
                                    : '');
                    @endphp
                    @if ($profile_picture != '')
                        <img src="{{ asset('storage') . '/' . ($tour->user->tour_profile_picture != '' ? $tour->user->tour_profile_picture : $tour->user->profile_picture) }}"
                            alt="Tour operator picture"
                            style="width: 40px; height: 40px; border-radius: 20px;">
                    @endif
                    <a href="#" class="underline">
                        <span
                            class="text-sm womsm:text-base wommd:text-lg font-semibold text-black tour-owner ml-4">{{ $tour_operation_name }}</span>
                    </a>
                </div>
                <div class="font-extrabold text-black mt-2 text-lg womsm:text-xl wommd:text-2xl">
                    YOUR BOOKING
                </div>
                <div class="text-sm womsm:text-base wommd:text-lg my-2 text-[#0F172A] inline-flex justify-center">
                    <span>{{ \Carbon\Carbon::parse($selectedDate->date)->format('F jS, Y') }}</span>
                    <span><a href="/tour/{{ $tour->id }}" class="text-green font-semibold ml-2 text-xs womsm:text-sm wommd:text-base"><u>Change</u></a></span>
                </div>
            </div>
            <div class="mt-5">
                <input type="hidden" value="{{ $tour->id }}" id="tour_id">
                <input type="hidden" value="{{ $selectedDate->date }}" id="date">
            </div>
        
            <div class="mt-6 px-8">
                <div class="font-extrabold text-black mt-2 text-lg womsm:text-xl wommd:text-2xl">
                    TOUR ADD-ONs
                </div>
                <div class="flex mt-2 mb-6">
                    @foreach ($tour->addonGroups as $key => $group)
                        <h2 class="text-lg text-green underline font-bold mr-2">{{ $group->name }} {{ ($key + 1) < count($tour->addonGroups) ? "|" : '' }}</h2>
                    @endforeach
                </div>
                @foreach ($tour->addonGroups as $group)
                
                    <div class="mb-12">
                        <h2 class="text-xl text-black font-bold">{{ $group->name }}</h2>
                        <p class="text-sm text-black mb-4">
                            {{ $group->is_required ? 'Mandatory. You must select one add-on from the list below.' : 'Optional. You can select multiple options.' }}
                        </p>

                        <div class="grid grid-cols-3 gap-6">
                            @foreach ($group->addons as $addon)
                            <label class="relative block h-64 cursor-pointer group">
                                <!-- Hidden input with peer class -->
                                <input 
                                    type="checkbox"
                                    name="addons[]"
                                    value="{{ $addon->id }}"
                                    data-price="{{ $addon->price }}"
                                    data-name="{{ $group->name }} - {{ $addon->name }}"
                                    class="sr-only peer addon-checkbox"
                                />
                            
                                <!-- Addon card -->
                                <div class="overflow-hidden rounded grayscale peer-checked:grayscale-0 relative">
                                    <img 
                                        {{-- src="{{ asset('storage/addons/0d6148c6ba176fe3cf777f2044ee6a6fbe0136a3.jpg') }}"  --}}
                                        src="{{ isset($addon->image_path) && $addon->image_path != '' ? asset('storage/' . $addon->image_path) : asset('images/no-image.png') }}" 
                                        class="w-full object-cover transition duration-200"
                                    >
                            
                                    <div class="py-3 bg-white">
                                        <h3 class="font-bold text-green">{{ $addon->name }}</h3>
                                        <p class="text-green font-semibold mt-1">{{ $symbol }} {{ number_format($addon->price, 2) }}</p>
                                    </div>
                            
                                    <!-- Checkmark (hidden by default, shows on peer-checked) -->
                                </div>
                                <div class="absolute top-2 right-2 hidden peer-checked:flex items-center justify-center w-full">
                                    <img src="{{asset('images/check.png')}}" alt="Selected">
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center">
            <button class="continue primary-button w-auto mb-4" data-id="{{ $selectedDate->id }}">Complete Booking Details</button>
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
                    <div id="addonsShow" class="font-medium"></div>
                </div>
                <div class="mt-6 border-t border-black pt-4 text-[#000F22]">
                    <div class="inline-flex justify-between w-full">
                        <span>Add ons price</span>
                        <span>{{ $symbol }} <span id="addonPrice">0.00</span></span>
                    </div>
                    <div class="mt-2 inline-flex justify-between w-full">
                        <span>Tour price</span>
                        <span>{{ $symbol }} {{$selectedDate->price}}</span>
                    </div>
                </div>
                <div class="mt-6 border-t inline-flex items-center justify-between border-black pt-4 w-full">
                    <input type="hidden" id="tour_price" value="{{ number_format($selectedDate->price, 2) }}">
                    <span class="text-black font-semibold">Total</span> 
                    <strong>
                        <span class="text-2xl text-black">{{ $symbol }} </span>
                        <span class="text-2xl text-black" id="total_price">{{ number_format($selectedDate->price, 2) }}</span>
                    </strong>
                </div>
                <div class="mt-4">
                    <button class="continue primary-button w-full mb-4" data-id="{{ $selectedDate->id }}">Complete Booking Details</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
    function validateForm() {
        const requiredFields = {
            name: "Name",
            nationality: "Nationality",
            mobile_number: "Mobile Number",
            address: "Address",
            country: "Country",
            postcode: "Postcode"
        };

        let errors = [];

        // Check each required field
        Object.entries(requiredFields).forEach(([field, label]) => {
            if (!$(`#${field}`).val()) {
                errors.push(`${label} is required`);
            }
        });

        // Display errors if any
        const errorDiv = $("#validation-errors");
        if (errors.length > 0) {
            errorDiv.html(errors.join('<br>')).removeClass('hidden');
            return false;
        }

        errorDiv.addClass('hidden');
        return true;
    }

    $(".continue").click(function(e) {
        e.preventDefault();
        const addons = $("input[name='addons[]']:checked")
            .map(function() {
                return $(this).val();
            }).get().join(",");
        const date = $("#date").val();
        const tour_date_id = $(this).data('id');
        const tour_id = $("#tour_id").val();
        const amount = $("#total_price").html();
        $.ajax({
            type: "POST",
            url: "/book",
            data: {
                tour_id,
                tour_date_id,
                addons,
                date,
                amount,
            },
            dataType: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                window.location.href = response.redirect_url;
            }
        });
    });

    $(document).ready(function() {
        const basePrice = parseFloat($("#tour_price").val().replace(',', '')); // Get the base tour price
        const currencySymbol = @json($symbol);

        function calculateTotalPrice() {
            let totalPrice = basePrice;
            $("#addonsShow").html('');
            $(".addon-checkbox:checked").each(function() {
                tempPrice = $(this).data("price");
                tempName = $(this).data("name");
                $("#addonsShow").append("<div class='w-full mt-4 inline-flex justify-between'><span>"+ tempName +"</span><span>" + currencySymbol + " " + tempPrice +"</span></div>");
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
        $(".addon-checkbox").on("click", function() {
            calculateTotalPrice();
        });
    });
</script>
@include('footer')
