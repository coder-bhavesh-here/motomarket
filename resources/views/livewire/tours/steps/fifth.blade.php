<form id="addonForm" enctype="multipart/form-data">
    <div class="container mx-auto px-4 py-8">
        @php
            $currency = auth()->user()->tour_currency;
            $symbol = match ($currency) {
                'euro' => '€',
                'usd' => '$',
                'gbp' => '£',
                default => '€',
            };
        @endphp
        <div class="mb-4">
            <button type="button" id="addGroupBtn" class="custom-orange-btn">
                + Add-On Group
            </button>
        </div>
        <div id="addonGroupsWrapper" class="space-y-10">
            @foreach($addonGroups as $gIndex => $group)
                <div class="p-6 rounded bg-[#F1F5F9] border relative addon-group" data-group-index="{{ $gIndex }}">
                    <div class="flex justify-between items-center mb-4">
                        <label class="font-bold text-lg">Add on Group Name</label>
                        <input type="text" name="groups[{{ $gIndex }}][name]" class="w-[80%] border rounded p-2" value="{{ $group->name }}" required />
                        <img src="{{ asset('images/delete-enabled.svg') }}" class="remove-group" style="width: 20px;">
                    </div>
                    <input type="hidden" name="groups[{{ $gIndex }}][id]" value="{{ $group->id }}">
                    <div class="flex gap-4 mb-6 justify-center">
                        <label>
                            <input type="checkbox" name="groups[{{ $gIndex }}][is_required]" {{ $group->is_required ? 'checked' : '' }} />
                            Customer must select an add-on in this group
                        </label>
                        <label>
                            <input type="checkbox" name="groups[{{ $gIndex }}][is_multiple]" {{ $group->is_multiple ? 'checked' : '' }} />
                            Customer can select multiple add-ons in this group
                        </label>
                    </div>
            
                    <div class="space-y-6 addon-items">
                        @foreach($group->addons as $aIndex => $addon)
                        <input type="hidden" name="groups[{{ $gIndex }}][addons][{{ $aIndex }}][id]" value="{{ $addon->id }}">
                            <div class="flex items-start items-center gap-4">
                                <img src="{{ asset('images/delete-enabled.svg') }}" class="remove-addon" style="width: 20px;">
                                <div class="flex flex-col items-center gap-1">
                                    <div class="w-24 h-24 relative group border border-black border-dashed rounded flex items-center justify-center bg-gray-100 cursor-pointer overflow-hidden hover:bg-gray-200 transition dropzone">
                                        <input type="file" accept="image/*" class="absolute inset-0 opacity-0 z-10 cursor-pointer file-input" name="groups[{{ $gIndex }}][addons][{{ $aIndex }}][image]" />
                                        <img src="{{ asset("storage/".$addon->image_path) }}" class="preview-image absolute inset-0 object-cover w-full h-full {{ $addon->image_path ? '' : 'hidden' }}" />
                                        <div class="icon-placeholder text-gray-400 z-0 pointer-events-none {{ $addon->image_path ? 'hidden' : '' }}">
                                            <!-- Same SVG icon here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full space-y-2">
                                    <input type="text" name="groups[{{ $gIndex }}][addons][{{ $aIndex }}][name]" class="w-full border rounded p-2" value="{{ $addon->name }}" required />
                                    <div class="flex items-center">
                                        <span class="inline-block p-2 mr-2 bg-gray-200 rounded">{{ $symbol }}</span>
                                        <input type="text" step="0.01" name="groups[{{ $gIndex }}][addons][{{ $aIndex }}][price]" class="form-control w-full border rounded p-2" value="{{ $addon->price }}" required />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <div class="flex justify-center mt-4">
                        <button type="button" class="custom-orange-btn add-addon">+ New Add on</button>
                    </div>
                </div>
            @endforeach
        </div>            
    </div>
</form>
@push('scripts')
<script>
let groupIndex = {{ count($addonGroups) }};

document.getElementById('addGroupBtn').addEventListener('click', function () {
    const wrapper = document.getElementById('addonGroupsWrapper');
    const groupHtml = `
        <div class="p-6 rounded bg-[#F1F5F9] border relative addon-group" data-group-index="${groupIndex}">
            <div class="flex justify-between items-center mb-4">
                <label class="font-bold text-lg">Add on Group Name</label>
                <input type="text" name="groups[${groupIndex}][name]" class="w-[80%] border rounded p-2" required />
                <img src="{{asset('images/delete-enabled.svg')}}" class="remove-group" style="width: 20px;"> 
            </div>

            <div class="flex gap-4 mb-6 justify-center">
                <label><input type="checkbox" name="groups[${groupIndex}][is_required]" /> Customer must select an add-on in this group</label>
                <label><input type="checkbox" name="groups[${groupIndex}][is_multiple]" /> Customer can select multiple add-ons in this group</label>
            </div>

            <div class="space-y-6 addon-items">
                <!-- Add-on Items Go Here -->
            </div>

            <div class="flex justify-center mt-4">
                <button type="button" class="custom-orange-btn add-addon">+ New Add on</button>
            </div>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', groupHtml);
    groupIndex++;
});

document.addEventListener('click', function (e) {
    // Add-on item within group
    if (e.target.classList.contains('add-addon')) {
        const groupDiv = e.target.closest('.addon-group');
        const groupIdx = groupDiv.getAttribute('data-group-index');
        const addonItems = groupDiv.querySelector('.addon-items');

        const addonIndex = addonItems.children.length;
        const itemHtml = `
            <div class="flex items-start items-center gap-4">
                <img src="{{asset('images/delete-enabled.svg')}}" class="remove-addon" style="width: 20px;"> 
                <div class="flex flex-col items-center gap-1">
                    <div class="w-24 h-24 relative group border border-black border-dashed rounded flex items-center justify-center bg-gray-100 cursor-pointer overflow-hidden hover:bg-gray-200 transition dropzone">
                        <input type="file" accept="image/*" class="absolute inset-0 opacity-0 z-10 cursor-pointer file-input" name="groups[${groupIdx}][addons][${addonIndex}][image]" />
                        <img src="" class="preview-image hidden absolute inset-0 object-cover w-full h-full" />
                        <div class="icon-placeholder text-gray-400 z-0 pointer-events-none">
                            <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.75 12.5V19.7917C22.75 20.3442 22.5217 20.8741 22.1154 21.2648C21.7091 21.6555 21.158 21.875 20.5833 21.875H5.41667C4.84203 21.875 4.29093 21.6555 3.8846 21.2648C3.47827 20.8741 3.25 20.3442 3.25 19.7917V5.20833C3.25 4.6558 3.47827 4.12589 3.8846 3.73519C4.29093 3.34449 4.84203 3.125 5.41667 3.125H13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.334 5.20703H23.834" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.584 2.08203V8.33203" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.75065 11.4596C10.9473 11.4596 11.9173 10.5269 11.9173 9.3763C11.9173 8.22571 10.9473 7.29297 9.75065 7.29297C8.55403 7.29297 7.58398 8.22571 7.58398 9.3763C7.58398 10.5269 8.55403 11.4596 9.75065 11.4596Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22.75 15.6253L19.4068 12.4108C19.0005 12.0202 18.4495 11.8008 17.875 11.8008C17.3005 11.8008 16.7495 12.0202 16.3432 12.4108L6.5 21.8753" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full space-y-2">
                    <input type="text" name="groups[${groupIdx}][addons][${addonIndex}][name]" class="w-full border rounded p-2" placeholder="e.g. Riding with a passenger..." required />
                    <div class="flex items-center">
                        <span class="inline-block p-2 mr-2 bg-gray-200 rounded">{{$symbol}}</span>
                        <input type="text" step="0.01" name="groups[${groupIdx}][addons][${addonIndex}][price]" class="form-control w-full border rounded p-2" required />
                    </div>
                </div>
            </div>
        `;
        addonItems.insertAdjacentHTML('beforeend', itemHtml);
    }

    // Remove group
    if (e.target.classList.contains('remove-group')) {
        e.target.closest('.addon-group').remove();
    }

    // Remove individual add-on
    if (e.target.classList.contains('remove-addon')) {
        e.target.closest('.flex').remove();
    }
});
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('file-input')) {
        const fileInput = e.target;
        const file = fileInput.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (evt) {
            const preview = fileInput.closest('.dropzone').querySelector('.preview-image');
            const icon = fileInput.closest('.dropzone').querySelector('.icon-placeholder');

            preview.src = evt.target.result;
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
});

</script>
@endpush