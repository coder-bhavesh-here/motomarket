@include('new-header')

<wireui:scripts />
<div class="mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4 text-green px-6">Emergency Contacts</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('emergency-contacts.update') }}" method="POST" class="mx-auto p-6">
        @csrf
        @for ($i = 1; $i <= 3; $i++)
            <div class="mb-10">
                <h2 class="text-xl font-bold text-green mb-4">Emergency Contact #{{ $i }}</h2>
    
                <div class="space-y-4">
                    {{-- Name --}}
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label for="emergency_contact_{{ $i }}_name" class="sm:w-40 font-medium text-[#000F22]">Name (s)</label>
                        <input
                            type="text"
                            id="emergency_contact_{{ $i }}_name"
                            name="emergency_contact_{{ $i }}_name"
                            value="{{ old('emergency_contact_' . $i . '_name', $contact?->{'emergency_contact_' . $i . '_name'}) }}"
                            placeholder="Full name"
                            class="flex-1 w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />

                    </div>
    
                    {{-- Phone --}}
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label for="emergency_contact_{{ $i }}_phone" class="sm:w-40 font-medium text-[#000F22]">Phone Number</label>
                        <input
                            type="text"
                            id="emergency_contact_{{ $i }}_phone"
                            name="emergency_contact_{{ $i }}_phone"
                            value="{{ old('emergency_contact_' . $i . '_phone', $contact?->{'emergency_contact_' . $i . '_phone'}) }}"
                            placeholder="Phone number"
                            class="flex-1 w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
    
                    {{-- Email --}}
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label for="emergency_contact_{{ $i }}_email" class="sm:w-40 font-medium text-[#000F22]">Email Address</label>
                        <input
                            type="email"
                            id="emergency_contact_{{ $i }}_email"
                            name="emergency_contact_{{ $i }}_email"
                            value="{{ old('emergency_contact_' . $i . '_email', $contact?->{'emergency_contact_' . $i . '_email'}) }}"
                            placeholder="Email address"
                            class="flex-1 w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                </div>
            </div>
        @endfor
    
        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row justify-between mt-12 gap-4">
            <button type="button"
                class="w-full sm:w-1/2 border border-[#42552A] text-[#42552A] font-medium py-2 rounded">
                Close
            </button>
    
            <button type="submit"
                class="w-full sm:w-1/2 bg-[#42552A] text-white font-medium py-2 rounded hover:bg-[#2e3d1f]">
                Save & Exit
            </button>
        </div>
    </form>
      
</div>
@include('footer')
