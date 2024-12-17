<input type="hidden" id="description_val" value="{{ isset($tour->tour_description) ? $tour->tour_description : '' }}">
<input type="hidden" id="included_val" value="{{ isset($tour->included) ? $tour->included : '' }}">
<input type="hidden" id="not_included_val" value="{{ isset($tour->not_included) ? $tour->not_included : '' }}">
<input type="hidden" id="tour_meeting_location_notes_val"
    value="{{ isset($tour->tour_meeting_location_notes) ? $tour->tour_meeting_location_notes : '' }}">
<div class="mt-5">
    <x-head.tinymce-config />
    <div class="mb-5">
        <span class="p-2">Tour Description</span>
        <div class="text-sm text-gray-500 mt-2 p-2">
            <span>Write an exciting description about the tour. Keep it short yet punchy!</span>
        </div>
        <x-textarea class="editorBlock" id="description" name="description" />
        <div>
        </div>
    </div>
    <hr>
    <div class="mb-5 mt-5">
        <span class="p-2">What's included in the tour?</span>
        <div class="text-sm text-gray-500 mt-2 p-2">
            <span>Explain what is included in the tour</span>
        </div>
        <x-textarea class="editorBlock" id="included" name="included" />
    </div>
    <hr>
    <div class="mt-5">
        <span class="p-2">What's not included in the tour?</span>
        <div class="text-sm text-gray-500 mt-2 p-2">
            <span>Explain what is not included in the tour</span>
        </div>
        <x-textarea class="editorBlock" id="not_included" name="not_included" />
    </div>
    <hr>
    <div class="flex items-center mt-4">
        <div class="w-1/6">
            Tour start meeting location
        </div>
        <div class="w-5/6">
            <x-input value="{{ isset($tour->tour_start_location) ? $tour->tour_start_location : '' }}"
                name="tour_start_location" id="tour_start_location" />
            <span class="flex text-sm
                text-gray-500">Provide a google maps link or a link to the
                location in a
                map</span>
        </div>
    </div>
    <hr>
    <div class="mt-5">
        <span class="p-2">Tour meeting location notes</span>
        <div class="text-sm text-gray-500 mt-2 p-2">
            <span>Any additional notes on getting to the starting point, time, address etc.</span>
        </div>
        <x-textarea class="editorBlock" id="tour_meeting_location_notes" name="tour_meeting_location_notes" />
    </div>
</div>
