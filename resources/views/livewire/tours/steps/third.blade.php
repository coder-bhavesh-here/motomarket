<div id="drop-area">
    <img src="{{ asset('images/loader.gif') }}" id="loader" alt="Loader"
        style="margin-left: 45%;width: 10%;display: none;">
    <div class="inline-flex justify-center items-center">
        <i class="fa-regular fa-image mr-6" style="font-size: 100px;"></i>
        <p>Drop your <b>Tour images</b> here</p>
    </div>
    <input type="file" id="fileElem" accept="image/*" style="display: none;">
    <button onclick="document.getElementById('fileElem').click()">Select files</button>
</div>
<div id="preview" class="inline-flex mt-10 w-full">
    @foreach ($images as $image)
        <img src="{{ asset('storage') . '/' . $image->image_path }}"><span data-id="{{ $image->id }}">X</span>
    @endforeach
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
                <x-input placeholder="https://youtube.com/promotional-video-1" value="{{ isset($tour->video_one) ? $tour->video_one : '' }}"
                    name="video_link_one" />
            </div>
        </div>
        <div class="flex items-center mt-4">
            <div class="w-1/6">
                Video Link 2
            </div>
            <div class="w-5/6">
                <x-input placeholder="https://youtube.com/promotional-video-2" value="{{ isset($tour->video_two) ? $tour->video_two : '' }}"
                    name="video_link_two" />
            </div>
        </div>
        <div class="flex items-center mt-4">
            <div class="w-1/6">
                Video Link 3
            </div>
            <div class="w-5/6">
                <x-input placeholder="https://youtube.com/promotional-video-3" value="{{ isset($tour->video_three) ? $tour->video_three : '' }}"
                    name="video_link_three" />
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
        let uploadUrl = '{{ route('tours.upload') }}';
        let formData = new FormData();
        $("#loader").show();
        formData.append('file', file);
        const url = new URL(window.location.href);
        let tour_id = parseInt(url.searchParams.get("tour_id")) || undefined;
        console.log("tour_id", tour_id);

        formData.append('tour_id', tour_id);

        fetch(uploadUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                $("#loader").hide();
                console.log(data);
                $("#preview").append("<img src='{{ asset('storage') }}/uploads/" + data.file + "'><span data-id='" +
                    data.image_id + "'>X</span>");
                // alert(data.success);
            })
            .catch(() => {
                alert('File upload failed');
            });
    }
    $("#preview span").click(function(e) {
        $(this).prev('img').hide();
        $(this).hide();
        const tourImageId = $(this).attr('data-id');
        let deleteUrl = '{{ route('tourImage.delete') }}';
        $.ajax({
            type: "POST",
            url: deleteUrl,
            data: {
                "_token": "{{ csrf_token() }}",
                tourImageId
            },
            dataType: "json",
            success: function(response) {
                console.log(response.success)
            }
        });
    });
</script>
