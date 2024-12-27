<x-app-layout>
    <input type="hidden" id="content_val" value="{{ old('content', $blog->content ?? '') }}">
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('blogsbyrankothcj.index')" :active="request()->routeIs('blogsbyrankothcj.index')">
                {{ __('Blogs') }}
            </x-nav-link>
        </div>
    </x-slot>
    <x-head.tinymce-config />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h1>{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h1>
                <form
                    action="{{ isset($blog) ? route('blogsbyrankothcj.update', $blog->id) : route('blogsbyrankothcj.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($blog))
                        @method('PUT')
                    @endif

                    <div class="flex items-center mt-4">
                        <div class="w-1/6">
                            Title
                        </div>
                        <div class="w-5/6">
                            <x-input value="{{ old('title', $blog->title ?? '') }}" name="title" id="title" />
                        </div>
                    </div>
                    <hr>
                    <div class="flex items-center mt-4">
                        <div class="w-1/6">Image</div>
                        <div class="w-5/6">
                            <input type="file" accept="image/jpeg, image/png, image/jpg, image/gif" name="image"
                                id="image" class="form-control" onchange="previewImage(event)">

                            @if (isset($blog->image))
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="mt-2"
                                    style="max-width: 150px;" id="preImage">
                            @endif
                            <div id="imagePreview" class="mt-2">
                                <!-- Preview will be displayed here -->
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="flex items-center mt-4">
                        <div class="w-1/6">YouTube Video Link</div>
                        <div class="w-5/6">
                            <x-input value="{{ old('youtube_video_link', $blog->youtube_video_link ?? '') }}"
                                name="youtube_video_link" id="youtube_video_link" />
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5">
                        <span class="p-2">Content</span>
                        <x-textarea class="editorBlock" id="content" name="content" />
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{ isset($blog) ? 'Update' : 'Create' }}</button>
                        <a href='/blogs' class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0]; // Get the selected file
            const previewDiv = document.getElementById('imagePreview');
            const existingImage = document.getElementById('existingPreview');
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            const maxSize = 10240 * 1024; // 10 MB in bytes

            // Clear any previous preview or messages
            previewDiv.innerHTML = '';
            if (existingImage) {
                existingImage.style.display = 'none';
            }

            // Validate file
            if (file) {
                if (!allowedTypes.includes(file.type)) {
                    alert('Invalid file type. Please upload a JPEG, PNG, JPG, or GIF image.');
                    return;
                }

                if (file.size > maxSize) {
                    alert('File is too large. Maximum size is 10 MB.');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result; // Set the image source
                    img.style.maxWidth = '150px'; // Set the image preview size
                    previewDiv.appendChild(img); // Add the image to the preview div
                    $("#preImage").remove();
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        }
    </script>
</x-app-layout>
