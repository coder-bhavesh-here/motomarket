<div>
    <script src="https://cdn.tiny.cloud/1/p10nmid4pz95pwmednu4mx08efe3spi3kk5jgqiltnms1rme/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent($("#description_val").val());
                });
            }
        });
        tinymce.init({
            selector: 'textarea#included', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent($("#included_val").val());
                });
            }
        });
        tinymce.init({
            selector: 'textarea#not_included', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent($("#not_included_val").val());
                });
            }
        });
        tinymce.init({
            selector: 'textarea#tour_meeting_location_notes', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent($("#tour_meeting_location_notes_val").val());
                });
            }
        });
        tinymce.init({
            selector: 'textarea#content', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent($("#content_val").val());
                });
            }
        });
    </script>
</div>
