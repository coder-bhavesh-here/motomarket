<x-app-layout>
    <div class="container text-center mt-10">
        <div class="text-2xl text-orange font-bold mt-6">ERROR::500</div>
        <h3 class="text-xl text-orange font-semibold mt-6">Something went wrong</h3>
        <button class="primary-button mt-3" onclick="window.location.href='{{ url()->previous() }}'">
            Go Back
        </button>        
    </div>
</x-app-layout>
