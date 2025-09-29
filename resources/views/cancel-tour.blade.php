@include('new-header')
<style>
    ul li {
        margin-top: 1.25rem;
    }
</style>
<wireui:scripts />

<div class="sm:px-6 lg:px-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</div>
@include('footer')
