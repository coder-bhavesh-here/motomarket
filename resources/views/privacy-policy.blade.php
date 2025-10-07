@include('new-header')
<div class="mt-2 px-6">
    <div style="height: 90vh;">
        <iframe 
            src="{{ asset('docs/privacy-policy.pdf') }}" 
            width="100%" 
            height="100%" 
            style="border:none;">
        </iframe>
    </div>
</div>
@include('footer')