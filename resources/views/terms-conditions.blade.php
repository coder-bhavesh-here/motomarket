@include('new-header')
<div class="container">
    <h2 class="mb-3">Terms & Conditions</h2>

    <div style="height: 90vh;">
        <iframe 
            src="{{ asset('docs/terms-conditions.pdf') }}" 
            width="100%" 
            height="100%" 
            style="border:none;">
        </iframe>
    </div>
</div>
@include('footer')