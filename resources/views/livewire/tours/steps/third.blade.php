{{-- <div class="flex justify-between"> --}}
    <div class="ml-2 mb-4">
        <div class="font-bold text-black">
            Tour Promotional images
        </div>
        <div class="text-sm text-black italic">
            <span>Add photos that highlights this tour</span>
        </div>
    </div>
    {{-- <span class="text-orange text-sm font-semibold">Drag & Drop or Select images</span> --}}
{{-- </div> --}}
{{-- @php
    $ridingImages = is_array($user->tour_riding_images) ? $user->tour_riding_images : json_decode($user->tour_riding_images ?? '[]', true);
@endphp --}}
<div class="text-black ml-2 mt-8 text-sm">
    <a href="#" style="text-decoration: none;" onclick="document.getElementById('bulkImageInput').click()" class="underline mb-4 inline-block">
        <span class="p-3 bg-[#f7f7f7] rounded-[10px] border-2 border-dashed border-[#bababa] cursor-pointer"><strong class="text-orange">Upload Multiple Images</strong> (5MB max)</span>
    </a>
    <input type="file" id="bulkImageInput" multiple accept="image/*" class="hidden" />    
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-4">
        {{-- @for ($i = 0; $i <= 14; $i++)
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
        @endfor --}}
        @for ($i = 0; $i <= 14; $i++)
    @php
        $image = collect($images)->firstWhere('index', $i);
        // $image = isset($images[$i]) ? $images[$i] : null;
    @endphp

    <label for="riding_images_{{ $i }}"
        class="relative flex items-center justify-center w-full aspect-square border-2 border-dashed border-gray-300 rounded-md cursor-pointer hover:border-indigo-400 transition group"
        ondragover="event.preventDefault(); this.classList.add('border-indigo-600');"
        ondragleave="this.classList.remove('border-indigo-600');"
        ondrop="handleDrop(event, {{ $i }})"
    >
        <input type="file"
            name="riding_images[{{ $i }}]"
            id="riding_images_{{ $i }}"
            accept="image/*"
            class="hidden"
            onchange="previewImage(this, 'preview_{{ $i }}')">

        <div id="preview_{{ $i }}" class="flex items-end {{ $i == 0 ? 'justify-between' : 'justify-end' }} w-full h-full bg-[#E6EDF5] overflow-hidden relative">
            @if ($i == 0)
                <span class="p-2 bg-white m-2 text-black rounded-2xl z-20">Default</span>
            @endif

            @if ($image)
                <button
                    type="button"
                    class="absolute top-1 right-1 z-20 bg-orange-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-orange-600"
                    onclick="deleteImage({{ $image->id }}, {{ $image->index }})"
                    title="Delete Image">
                    &times;
                </button>
                {{-- Show existing image --}}
                <img src="{{ asset('storage/' . $image->image_path) }}"
                     alt="Uploaded Image"
                     class="absolute w-full h-full object-cover z-0 riding-image-{{ $image->index }}" />
            @else
                {{-- Show placeholder icon --}}
                <svg width="53" height="52" style="height: 30px; margin-bottom: 10px;" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M46.3359 26V41.1667C46.3359 42.3159 45.8794 43.4181 45.0667 44.2308C44.2541 45.0435 43.1519 45.5 42.0026 45.5H11.6693C10.52 45.5 9.4178 45.0435 8.60514 44.2308C7.79248 43.4181 7.33594 42.3159 7.33594 41.1667V10.8333C7.33594 9.68406 7.79248 8.58186 8.60514 7.7692C9.4178 6.95655 10.52 6.5 11.6693 6.5H26.8359" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M35.502 10.832H48.502" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M42.002 4.33203V17.332" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20.3353 23.8346C22.7285 23.8346 24.6686 21.8945 24.6686 19.5013C24.6686 17.1081 22.7285 15.168 20.3353 15.168C17.9421 15.168 16.002 17.1081 16.002 19.5013C16.002 21.8945 17.9421 23.8346 20.3353 23.8346Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M46.3359 32.5019L39.6496 25.8156C38.837 25.0032 37.735 24.5469 36.5859 24.5469C35.4369 24.5469 34.3349 25.0032 33.5223 25.8156L13.8359 45.5019" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>                            
                </svg>
            @endif
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

<div class="mb-5 mt-8">
    <div class="ml-2">
        <div class="font-bold text-black">
            Tour Promotional videos
        </div>
        <div class="text-sm text-black italic">
            <span>Provide YouTube links to any promotional videos you have</span>
        </div>
    </div>
    <div class="text-sm text-black p-2">
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
    document.addEventListener('DOMContentLoaded', function () {
        console.log("DOM fully loaded");
        const input = document.getElementById('bulkImageInput');

        input.addEventListener('change', function (e) {
            const files = e.target.files;
            if (!files.length) return;

            const allInputs = document.querySelectorAll('input[type="file"][name^="riding_images"]');
            let fileIndex = 0;

            allInputs.forEach((input, index) => {
                if (fileIndex >= files.length) return;

                const previewBox = document.getElementById('preview_' + index);

                // Check if already has an image — custom logic
                const hasExistingImage = previewBox.querySelector('img') !== null;

                if (!hasExistingImage && !input.files.length) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(files[fileIndex]);

                    input.files = dataTransfer.files;

                    previewImage(input, 'preview_' + index); // your existing preview function

                    fileIndex++;
                }
            });

            // Optionally notify user if some images couldn't be added
            if (fileIndex < files.length) {
                alert(`Only ${fileIndex} of ${files.length} images were added. Rest skipped.`);
            }
        });
    });

    function previewImageFromFile(file, index) {
        const preview = document.getElementById(`preview_${index}`);
        if (!file || !preview) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.style.backgroundImage = `url('${e.target.result}')`;
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';

            const cross = document.querySelector(`.delete-cross-${index}`);
            if (cross) cross.style.display = 'block';
        };
        reader.readAsDataURL(file);

        uploadFile(file, index);
    }

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

    function uploadFile(file, index) {
        let uploadUrl = '{{ route('tours.upload') }}';
        let formData = new FormData();
        showLoader();
        formData.append('file', file);
        formData.append('index', index); // 🆕 Pass image index
        const url = new URL(window.location.href);
        let tour_id = parseInt(url.searchParams.get("tour_id")) || undefined;
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
            if (!data.success) {
                var notyf = new Notyf({
                    duration: 2500,
                    position: {
                        x: 'center',
                        y: 'top',
                    },
                    types: [
                        {
                            type: 'error',
                            background: 'red',
                            icon: false
                        }
                    ]
                });
                hideLoader();
                notyf.error(data.message);
                return false;
            }
            if (data.success === false) {
                throw new Error(data.message || 'File upload failed');
            }
            hideLoader();
            const index = parseInt(formData.get('index'));
            // console.log("index", index);
            const newFilePath = data.file;
            // console.log("newFilePath", newFilePath);
            
            // Assuming you store images in /storage/uploads
            const imgElement = document.getElementsByClassName(`riding-image-${index}`)[0];
            console.log("imgElement", imgElement);

            if (imgElement && data.file_url) {
                // const previewBox = document.getElementById(`preview_${index}`);
                $(imgElement).prepend(`
                    <button type="button" onclick="removeImage(${data.image_id}, ${index})"
                        class="absolute top-2 right-2 bg-orange-500 text-white rounded-full w-6 h-6 flex items-center justify-center z-20 hover:bg-orange-600"
                        title="Remove Image">
                        &times;
                    </button>`);

                imgElement.src = `${data.file_url}?t=${Date.now()}`
                console.log(imgElement.src);
            }
            console.log(data);
            // Optional: update UI or handle response
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
    console.log("previewId", previewId);
    const preview = document.getElementById(previewId);
    console.log("preview", preview);
    if (input.files && input.files[0]) {
        console.log("IN INPUT");
        const file = input.files[0];
        const index = parseInt(input.id.replace("riding_images_", "")); // extract index
        const reader = new FileReader();
        if(!uploadFile(file, index)) {
            return false;
        }
        reader.onload = function (e) {
            preview.style.backgroundImage = `url('${e.target.result}')`;
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
        };
        reader.readAsDataURL(file);
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
function deleteImage(imageId, index) {
    if (!confirm("Are you sure you want to delete this image?")) return;

    // Optional: show full-page loader if needed
    showLoader();

    fetch(`/tours/images/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (response.ok) {
            // Hide image from UI
            const imageBox = document.querySelector(`.riding-image-${index}`);
            if (imageBox) {
                imageBox.remove();
            }

            // You may also reset the preview div
            const preview = document.getElementById(`preview_${index}`);
            if (preview) {
                preview.innerHTML = `
                    <svg width="53" height="52" style="height: 30px; margin-bottom: 10px;" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M46.3359 26V41.1667C46.3359 42.3159 45.8794 43.4181 45.0667 44.2308C44.2541 45.0435 43.1519 45.5 42.0026 45.5H11.6693C10.52 45.5 9.4178 45.0435 8.60514 44.2308C7.79248 43.4181 7.33594 42.3159 7.33594 41.1667V10.8333C7.33594 9.68406 7.79248 8.58186 8.60514 7.7692C9.4178 6.95655 10.52 6.5 11.6693 6.5H26.8359" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M35.502 10.832H48.502" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M42.002 4.33203V17.332" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.3353 23.8346C22.7285 23.8346 24.6686 21.8945 24.6686 19.5013C24.6686 17.1081 22.7285 15.168 20.3353 15.168C17.9421 15.168 16.002 17.1081 16.002 19.5013C16.002 21.8945 17.9421 23.8346 20.3353 23.8346Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M46.3359 32.5019L39.6496 25.8156C38.837 25.0032 37.735 24.5469 36.5859 24.5469C35.4369 24.5469 34.3349 25.0032 33.5223 25.8156L13.8359 45.5019" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>                            
                    </svg>
                `;
            }
        } else {
            alert("Failed to delete image.");
        }
    })
    .catch(() => {
        alert("An error occurred while deleting the image.");
    })
    .finally(() => {
        hideLoader();
    });
}
</script>
