<input type="hidden" id="description_val" value="{{ isset($tour->tour_description) ? $tour->tour_description : '' }}">
<input type="hidden" id="included_val" value="{{ isset($tour->included) ? $tour->included : '' }}">
<input type="hidden" id="not_included_val" value="{{ isset($tour->not_included) ? $tour->not_included : '' }}">
<input type="hidden" id="tour_meeting_location_notes_val"
    value="{{ isset($tour->tour_meeting_location_notes) ? $tour->tour_meeting_location_notes : '' }}">
<div class="mt-5">
    <x-head.tinymce-config />
    <div class="mb-5">
        <div class="ml-2 mb-4">
            <div class="font-bold text-black">
                Tour Description
            </div>
            <div class="text-sm text-black italic">
                <span>Write an exciting description about the tour. Keep it short yet punchy!</span>
            </div>
        </div>
        <x-textarea class="editorBlock" id="description" name="description" />
    </div>
    <div class="mb-5 mt-10">
        <div class="ml-2 mb-4 mt-4">
            <div class="font-bold text-black">What's included in the tour?</div>
            <div class="text-sm text-black italic">
                <span>Explain what is included in the tour</span>
            </div>
        </div>
        <x-textarea class="editorBlock" id="included" name="included" />
    </div>
    <div class="mt-10">
        <div class="ml-2 mb-4 mt-4">
            <div class="font-bold text-black">What's not included in the tour?</div>
            <div class="text-sm text-black mt-2 italic">
                <span>Explain what is not included in the tour</span>
            </div>
        </div>
        <x-textarea class="editorBlock" id="not_included" name="not_included" />
    </div>
    <div class="mt-10">
        <div class="font-bold ml-2 text-black">Tour start meeting location</div>
        <div>
            <x-input placeholder="Google  maps link or location" value="{{ isset($tour->tour_start_location) ? $tour->tour_start_location : '' }}"
                name="tour_start_location" id="tour_start_location" />
        </div>
    </div>
    <div class="mt-10">
        <div class="ml-2 mb-4">
            <span class="font-bold text-black">Tour meeting location notes</span>
            <div class="text-sm text-black mt-2 italic">
                <span>Any additional notes on getting to the starting point, time, address etc.</span>
            </div>
        </div>
        <x-textarea class="editorBlock" id="tour_meeting_location_notes" name="tour_meeting_location_notes" />
    </div>
</div>
