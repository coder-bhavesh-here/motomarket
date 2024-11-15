<div id="drop-area">
    <div class="inline-flex justify-center items-center">
        <i class="fa-regular fa-image mr-6" style="font-size: 100px;"></i>
        <p>Drop your <b>Tour images</b> here</p>
    </div>
    <input type="file" id="fileElem" accept="image/*" style="display: none;">
    <button onclick="document.getElementById('fileElem').click()">Select files</button>
</div>

<script>
    document.getElementById("drop-area").addEventListener('click', function() {
        document.getElementById("fileElem").click();
    });
    let dropArea = document.getElementById('drop-area');
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.add('highlight'), false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.remove('highlight'), false);
    });
    dropArea.addEventListener('drop', handleDrop, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        ([...files]).forEach(uploadFile);
    }

    function uploadFile(file) {
        let url = '{{ route('tours.upload') }}';
        let formData = new FormData();

        formData.append('file', file);

        fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(data.success);
            })
            .catch(() => {
                alert('File upload failed');
            });
    }
</script>
