<div class="flex justify-between">
    <div>
        <span class="p-2 text-black font-semibold">Tour Promotional images</span>
        <div class="text-sm text-black p-2">
            <span>Add photos that highlights this tour</span>
        </div>
    </div>
    <span class="text-orange text-sm font-semibold">Drag & Drop or Select images</span>
</div>
{{-- @php
    $ridingImages = is_array($user->tour_riding_images) ? $user->tour_riding_images : json_decode($user->tour_riding_images ?? '[]', true);
@endphp --}}
<div class="text-black ml-2 mt-8 text-sm">
    <label>5MB max per image</label>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-4">
        @for ($i = 0; $i <= 14; $i++)
            <label for="riding_images_{{ $i }}"
                class="relative flex items-center justify-center w-full aspect-square border-2 border-dashed border-gray-300 rounded-md cursor-pointer hover:border-indigo-400 transition group"
                ondragover="event.preventDefault(); this.classList.add('border-indigo-600');"
                ondragleave="this.classList.remove('border-indigo-600');"
                ondrop="handleDrop(event, {{ $i }})"
            >
                <input type="file"
                    name="riding_images[]"
                    id="riding_images_{{ $i }}"
                    accept="image/*"
                    class="hidden"
                    onchange="previewImage(this, 'preview_{{ $i }}')">
                <div id="preview_{{ $i }}" class="flex items-end {{ $i == 0 ? 'justify-between' : 'justify-end' }} w-full h-full bg-[#E6EDF5] overflow-hidden">
                    @if ($i == 0)
                        <span class="p-2 bg-white m-2 text-black rounded-2xl">Default</span>
                    @endif
                    <svg width="53" height="52" style="height: 30px; margin-bottom: 10px;" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M46.3359 26V41.1667C46.3359 42.3159 45.8794 43.4181 45.0667 44.2308C44.2541 45.0435 43.1519 45.5 42.0026 45.5H11.6693C10.52 45.5 9.4178 45.0435 8.60514 44.2308C7.79248 43.4181 7.33594 42.3159 7.33594 41.1667V10.8333C7.33594 9.68406 7.79248 8.58186 8.60514 7.7692C9.4178 6.95655 10.52 6.5 11.6693 6.5H26.8359" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M35.502 10.832H48.502" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M42.002 4.33203V17.332" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.3353 23.8346C22.7285 23.8346 24.6686 21.8945 24.6686 19.5013C24.6686 17.1081 22.7285 15.168 20.3353 15.168C17.9421 15.168 16.002 17.1081 16.002 19.5013C16.002 21.8945 17.9421 23.8346 20.3353 23.8346Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M46.3359 32.5019L39.6496 25.8156C38.837 25.0032 37.735 24.5469 36.5859 24.5469C35.4369 24.5469 34.3349 25.0032 33.5223 25.8156L13.8359 45.5019" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>                            
                    </svg>
                </div>
            </label>
        @endfor
    </div>    
    <x-input-error class="mt-2" :messages="$errors->get('riding_images')" />
</div>
{{-- <div id="drop-area">
    <img src="{{ asset('images/loader.gif') }}" id="loader" alt="Loader"
        style="margin-left: 45%;width: 10%;display: none;">
    <div class="inline-flex justify-center items-center">
        <i class="fa-regular fa-image mr-6" style="font-size: 100px;"></i>
        <p>Drop your <b>Tour images</b> here</p>
    </div>
    <input type="file" id="fileElem" accept="image/*" style="display: none;">
    <button onclick="document.getElementById('fileElem').click()">Select files</button>
</div> --}}
{{-- <div id="preview" class="inline-flex mt-10 w-full">
    @if ($images)
        @foreach ($images as $image)
        <img src="{{ asset('storage') . '/' . $image->image_path }}"><span data-id="{{ $image->id }}">X</span>
        @endforeach
    @endif
</div> --}}

<div class="mb-5 mt-5">
    <span class="p-2 text-black text-sm font-semibold">Tour Promotional videos</span>
    <div class="text-sm text-black p-2">
        <span>Provide YouTube links to any promotional videos you have</span>
        <div class="flex items-center mt-4">
            <div class="w-full">
                <x-input placeholder="https://youtube.com/promotional-video-1" value="{{ isset($tour->video_one) ? $tour->video_one : '' }}"
                    name="video_link_one" />
            </div>
        </div>
        <div class="flex items-center mt-4">
            <div class="w-full">
                <x-input placeholder="https://youtube.com/promotional-video-2" value="{{ isset($tour->video_two) ? $tour->video_two : '' }}"
                    name="video_link_two" />
            </div>
        </div>
        <div class="flex items-center mt-4">
            <div class="w-full">
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
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.style.backgroundImage = `url('${e.target.result}')`;
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
        };
        reader.readAsDataURL(input.files[0]);
        uploadFile(file);
    }
}

function handleDrop(event, index) {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const input = document.getElementById(`riding_images_${index}`);
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
        previewImage(input, `preview_${index}`);
        event.currentTarget.classList.remove('border-indigo-600');
    }
}
</script>
