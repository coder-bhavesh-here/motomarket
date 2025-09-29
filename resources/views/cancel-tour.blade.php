@include('new-header')
<style>
    ul li {
        margin-top: 1.25rem;
    }
    .cancel-options {
        background: #596a37;
        font-weight: bold;
        color: white;
        border-radius: 8px;
        text-align: center;
        padding: 24px;
        max-width: 200px;
        cursor: pointer;
    }
</style>
<wireui:scripts />

<div class="sm:px-6 lg:px-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <p class="mt-4 mb-2 font-semibold text-[#0F172A] text-lg womsm:text-xl wommd:text-2xl">
        {{ $tour->title }} - {{ $tour->countries }}
    </p>
    <span class="text-red-500 opacity-75 font-bold">You are about to cancel the tour.</span>
    <div class="flex my-4">Choose one option</div>
    <div class="grid grid-cols-1 wommd:grid-cols-2 max-w-screen-womsm gap-6 mt-4">
        <div>
            <div id="refundAction" class="cancel-options">
                Cancel </br>&</br> refund
            </div>
        </div>
        <div>
            <div id="creditsAction" class="cancel-options">
                Cancel </br>&</br> credits
            </div>
        </div>
    </div>
</div>
@include('footer')
