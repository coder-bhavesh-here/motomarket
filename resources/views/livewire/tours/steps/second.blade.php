<div class="mt-5">
    <x-head.tinymce-config />
    <div class="mb-5">
        <span class="p-2">Tour Description</span>
        <div class="text-sm text-gray-500 mt-2 p-2">
            <span>Write an exciting description about the tour. Keep it short yet punchy!</span>
        </div>
        <x-textarea class="editorBlock" id="description" name="description" />
        <div>
            @push('scripts')
                <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
                <script>
                    ClassicEditor
                        .create(document.querySelector('.editorBlock'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            @endpush
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
</div>
