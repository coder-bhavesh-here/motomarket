<style>
    footer ul li {
        margin-top: 0px !important;
    }
</style>
<footer class="text-left text-lg mt-5 font-semibold">
    <div class="grid grid-cols-1 womsm:grid-cols-2 wommd:grid-cols-4 w-full p-3 wommd:p-7">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li>Contact</li>
            <li><a href="/blogs">News</a></li>
            <li><a href="/terms-of-use" target="_blank">Terms of use</a></li>
            <li><a href="/privacy-policy" target="_blank">Privacy policy</a></li>
            <div class="flex justify-start items-center align-center gap-4 mt-10">
                <a href="https://www.facebook.com/WorldonMotoAdventures" target="_blank"><img src="{{ asset('images/fb.png') }}"></a>
                <img src="{{ asset('images/yt.png') }}">
                <img src="{{ asset('images/ig.png') }}">
                <img src="{{ asset('images/in.png') }}">
            </div>
        </ul>
        <ul class="womsm:max-wommd:text-right">
            <li><a href="invite-operators">Share your tours</a></li>
            <li><a href="/partner">Partner with us</a></li>
            <li><a href="/investor">Investor outreach</a></li>
        </ul>
        <ul class="womsm:col-span-2 wommd:text-right">
            <div>WorldonMoto.com is owned and operated by MotoMob Limited.</div>
            <div>MotoMob Limited is registered in the United Kingdom.</div>
            <div class="text-base mt-10 hidden font-normal wommd:block">
                <div>MotoMob Limited</div>
                <div>1st Floor</div>
                <div>85 Great Portland Street</div>
                <div>London</div>
                <div>W1W 7LT</div>
            </div>
        </ul>
    </div>
    
    <script>function showLoader() {
        const loader = document.getElementById('loading');
        loader.classList.remove('hidden');
        loader.classList.add('flex');
    }
    
    function hideLoader() {
        const loader = document.getElementById('loading');
        loader.classList.remove('flex');
        loader.classList.add('hidden');
    }</script>
    <script>
        function closeGlobalImageModal() {
            $('#globalImageModal').addClass('hidden');
            $('#globalModalImage').attr('src', '');
        }
    
        $(document).on('click', '.img-with-preview', function () {
            const src = $(this).attr('src');
            $('#globalModalImage').attr('src', src);
            $('#globalImageModal').removeClass('hidden');
        });
    
        // Click outside image to close
        $('#globalImageModal').on('click', function (e) {
            if (e.target.id === 'globalImageModal') {
                closeGlobalImageModal();
            }
        });
    </script>
    
</footer>
</div>
</div>
</div>
@stack('scripts')
</body>

</html>
