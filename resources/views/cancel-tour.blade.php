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
        font-size: 18px;
    }
</style>
<wireui:scripts />

<div class="sm:px-6 lg:px-8 justify-items-center">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <p class="mt-4 mb-2 font-semibold text-[#0F172A] text-lg womsm:text-xl wommd:text-2xl">
        {{ $tour->title }} - {{ $tour->countries }}
    </p>
    <div class="text-red-500 opacity-75 font-bold">You are about to cancel the tour.</div>
    {{-- <div class="flex my-4 font-semibold text-black">Choose one option</div> --}}
    <div class="grid grid-cols-1 wommd:grid-cols-2 max-w-screen-womsm gap-6 mt-4">
        <div class="max-w-[200px]">
            <div id="refundAction" class="cancel-options">
                Cancel </br>with</br> refund
            </div>
            <span class="text-black font-medium">95% of paid amount</span>
        </div>
        <div class="max-w-[200px]">
            <div id="creditsAction" class="cancel-options">
                Cancel </br>with</br> credits
            </div>
            <div class="text-black font-medium">100% of paid amount as credits</div>
            <div class="text-red-500">[Use within 24 months]</div>
        </div>
    </div>
    <a target="_blank" href="/terms-of-use" class="text-green underline text-xs womsm:text-sm wommd:text-base flex mt-4 font-medium">Read the full terms here</a>
</div>
<script>
$(document).ready(function () {
    $(".cancel-options").on("click", function () {
        let urlSegments = window.location.pathname.split("/"); 
        let bookingId = urlSegments[urlSegments.length - 1];
        let selectedType = this.id === "refundAction" ? "refund" : "credits";
        var notyf = new Notyf({
            duration: 2500,
            position: {
                x: 'center',
                y: 'top',
            },
            types: [
                { type: 'success', background: '#556b2f', icon: false },
                { type: 'error', background: 'red', icon: false }
            ]
        });
        if (confirm("Are you sure you want to cancel this tour with " + selectedType + "?")) {
            $.ajax({
                url: "/cancel-tour/" + bookingId,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    refund_type: selectedType
                },
                success: function (response) {
                    if (response.success) {
                        notyf.success("Booking cancelled successfully with " + selectedType);
                        setTimeout(function() {
                            window.location.href = '/your-tours'; // Redirect to /your-tours page
                        }, 2500);
                    } else {
                        notyf.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    notyf.error("Something went wrong, please try again.");
                }
            });
        }
    });
});
</script>

@include('footer')
