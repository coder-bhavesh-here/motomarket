<div id="dateContainer">
    @php
        $currency = auth()->user()->tour_currency;
        $symbol = match ($currency) {
            'euro' => '€',
            'usd' => '$',
            'gbp' => '£',
            default => '€',
        };
        $initialCount = isset($prices) && $prices ? count($prices) : 0;
    @endphp
    @forelse($prices ?? [] as $i => $price)
        <div class="mb-6 p-4">
            <div class="grid grid-cols-5 gap-4 font-semibold mb-2">
                <div>Tour start date</div>
                <div>Tour end date</div>
                <div>Number of rest days</div>
                <div>Tour Price</div>
                <div></div>
            </div>
            <div class="grid grid-cols-5 gap-4 items-center">
                <input type="date" name="date[{{ $i }}][date]" value="{{ $price->date }}" class="w-full" />
                <input type="date" name="date[{{ $i }}][end_date]" value="{{ $price->end_date }}" class="w-full" />
                <input type="number" name="date[{{ $i }}][rest_days]" value="{{ $price->rest_days }}" class="w-full" />
                <div class="flex items-center">
                    <span class="inline-block p-2 mr-2 bg-gray-200 rounded">{{ $symbol }}</span>
                    <input type="text" name="date[{{ $i }}][price]" value="{{ $price->price }}" class="w-full" />
                </div>
                <img class="remove-row" src="{{asset('images/delete-enabled.svg')}}" alt="" srcset="">
            </div>
        </div>
    @empty
        <div class="mb-6 p-4">
            <div class="grid grid-cols-5 gap-4 font-semibold mb-2">
                <div>Tour start date</div>
                <div>Tour end date</div>
                <div>Number of rest days</div>
                <div>Tour Price</div>
                <div></div>
            </div>
            <div class="grid grid-cols-5 gap-4 items-center">
                <input type="date" name="date[0][date]" class="w-full" />
                <input type="date" name="date[0][end_date]" class="w-full" />
                <input type="number" name="date[0][rest_days]" class="w-full" />
                <div class="flex items-center">
                    <span class="inline-block p-2 mr-2 bg-gray-200 rounded">{{ $symbol }}</span>
                    <input type="text" name="date[0][price]" class="w-full" />
                </div>
                <img class="remove-row" src="{{asset('images/delete-enabled.svg')}}" alt="" srcset="">
            </div>
        </div>
    @endforelse
</div>
<div class="flex items-center">
    <button type="button" id="addRow" class="btn custom-orange-btn">+ Add a new date</button>
    <span class="font-medium text-black italic text-sm ml-4">You can run this tour multiple times a year</br>Add a new date and price here </span>
</div>
@push('scripts')
<script type="text/javascript">
    let rowIndex = {{ $initialCount }};
    const symbol = @json($symbol); // safely pass PHP variable to JS

    $('#addRow').on('click', function () {
        $(".remove-row").attr('src', "{{asset('images/delete-enabled.svg')}}");
        const newRow = `
            <div class="mb-6 p-4">
                <div class="grid grid-cols-5 gap-4 font-semibold mb-2">
                    <div>Tour start date</div>
                    <div>Tour end date</div>
                    <div>Number of rest days</div>
                    <div>Tour Price</div>
                    <div></div>
                </div>
                <div class="grid grid-cols-5 gap-4 items-center">
                    <input type="date" name="date[${rowIndex}][date]" class="w-full" />
                    <input type="date" name="date[${rowIndex}][end_date]" class="w-full" />
                    <input type="number" name="date[${rowIndex}][rest_days]" class="w-full" />
                    <div class="flex items-center">
                        <span class="inline-block p-2 mr-2 bg-gray-200 rounded">${symbol}</span>
                        <input type="text" name="date[${rowIndex}][price]" class="w-full" />
                    </div>
                    <img class="remove-row" src="{{asset('images/delete-enabled.svg')}}" alt="" srcset="">
                </div>
            </div>`;
        
        $('#dateContainer').append(newRow);
        rowIndex++;
    });

    $(document).on("change", "input[name^='date'][name$='[date]']", function () {
        // Get selected start date
        let startDate = $(this).val();

        // Find the corresponding end date picker in the same parent/container
        let endDateInput = $(this).closest('div').find("input[name^='date'][name$='[end_date]']");

        // Set the min attribute so end date can't be less than start date
        endDateInput.attr("min", startDate);

        // If the current end date is before the start date, reset it
        if (endDateInput.val() && endDateInput.val() < startDate) {
            endDateInput.val(startDate);
        }
    });

    // Remove row using event delegation
    $(document).on('click', '.remove-row', function () {
        var count = $('.remove-row').length;
        if (count === 1) {
            $(".remove-row").attr('src', "{{asset('images/delete-disabled.svg')}}");
            return false;
        }
        $(this).closest('.mb-6').remove();
    });
</script>
@endpush