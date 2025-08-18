<x-app-layout>
    <div class="container text-center mt-10">
        <div class="text-2xl text-orange font-bold mt-6">ERROR::429</div>
        <h3 class="text-xl text-orange font-semibold mt-6">Too Many Requests</h3>
        <p class="text-lg font-medium text-black mt-6">Whoa! You're sending too many requests. Please wait for a minute and try again.</p>
        <button class="primary-button mt-3" onclick="window.location.href='{{ url()->previous() }}'">
            Go Back
        </button>        
    </div>
</x-app-layout>
