<div id="drop-area">
    <div class="inline-flex justify-center items-center">
        <i class="fa-regular fa-image mr-6" style="font-size: 100px;"></i>
        <p>Drop your <b>Tour images</b> here</p>
    </div>
    <input type="file" id="fileElem" accept="image/*" style="display: none;">
    <button onclick="document.getElementById('fileElem').click()">Select files</button>
</div>

<div class="mb-5 mt-5">
    <span class="p-2">Tour Promotional videos</span>
    <div class="text-sm text-gray-500 mt-2 p-2">
        <span>Provide YouTube links to any promotional videos you have for this tour</span>
        <div class="flex items-center mt-4">
            <div class="w-1/6">
                Video Link 1
            </div>
            <div class="w-5/6">
                <x-input placeholder="https://youtube.com/promotional-video-1" wire:model="video_link_one" />
            </div>
        </div>
        <div class="flex items-center mt-4">
            <div class="w-1/6">
                Video Link 2
            </div>
            <div class="w-5/6">
                <x-input placeholder="https://youtube.com/promotional-video-2" wire:model="video_link_two" />
            </div>
        </div>
        <div class="flex items-center mt-4">
            <div class="w-1/6">
                Video Link 3
            </div>
            <div class="w-5/6">
                <x-input placeholder="https://youtube.com/promotional-video-3" wire:model="video_link_three" />
            </div>
        </div>
    </div>
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
