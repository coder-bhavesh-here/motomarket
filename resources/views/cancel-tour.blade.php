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
    <div class="flex my-4 font-semibold text-black">Choose one option</div>
    <div class="grid grid-cols-1 wommd:grid-cols-2 max-w-screen-womsm gap-6 mt-4">
        <div class="max-w-[200px]">
            <div id="refundAction" class="cancel-options">
                Cancel </br>&</br> refund
            </div>
            <span class="text-black font-medium">95% of paid amount</span>
        </div>
        <div class="max-w-[200px]">
            <div id="creditsAction" class="cancel-options">
                Cancel </br>&</br> credits
            </div>
            <div class="text-black font-medium">100% of paid amount as credits</div>
            <div class="text-red-500">[Use within 24 months]</div>
        </div>
    </div>
</div>
@include('footer')
