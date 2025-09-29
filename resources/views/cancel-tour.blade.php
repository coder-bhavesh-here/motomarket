@include('new-header')
<style>
    ul li {
        margin-top: 1.25rem;
    }
</style>
<wireui:scripts />

<div class="sm:px-6 lg:px-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <span class="text-red-700 opacity-75">You are about to cancel the tour.</span>
    <p class="mt-4 mb-2 font-semibold text-[#0F172A] text-lg womsm:text-xl wommd:text-2xl">
        {{ $tour->title }} - {{ $tour->countries }}
    </p>
</div>
@include('footer')
