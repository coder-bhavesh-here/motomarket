<div>
    <table class="table table-borderless table-centered w-full" id="addonTable">
        <p class="text-xl mb-4">Tour Add-Ons: </p>
        <tr>
            <th class="w-2/5">Addon</th>
            <th class="w-2/5">Price</th>
            <th class="w-1/5"></th>
        </tr>
        @if (count($addons) > 0)
            @foreach ($addons as $addon_key => $addon)
                <tr>
                    <td><input type="text" placeholder="Riding with a passenger. 2 up riding on one bike"
                            class="w-full" value="{{ $addon->addon }}" name="addon[{{ $addon_key }}][addon]" /></td>
                    <td><input type="text" value="{{ $addon->addon_price }}" name="addon[{{ $addon_key }}][price]"
                            placeholder="300" /></td>
                    <td>
                        @if ($addon_key == 0)
                            <button type="button" name="add" id="addAddon" class="btn-info">Add More</button>
                        @else
                            <button type="button" class="btn-danger remove-tr">Remove</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td><input type="text" placeholder="Riding with a passenger. 2 up riding on one bike" class="w-full"
                        name="addon[0][addon]" /></td>
                <td><input type="text" name="addon[0][price]" placeholder="300" /></td>
                <td><button type="button" name="add" id="addAddon" class="btn-info">Add More</button></td>
            </tr>
        @endif
    </table>
    <p class="text-center m-5">You can run the same tour multiple times during the year.<br> If so select the dates and
        price by adding a new tour line.</p>
</div>

<script type="text/javascript">
    var addonI = {{ count($addons) }};
    $("#addAddon").click(function() {
        ++addonI;
        $("#addonTable").append('<tr><td><input type="text" class="w-full" name="addon[' + addonI +
            '][addon]" placeholder="Riding with a passenger. 2 up riding on one bike" class="form-control" /></td><td><input type="text" name="addon[' +
            addonI +
            '][price]" placeholder="300" class="form-control" /></td><td><button type="button" class="btn-danger remove-tr">Remove</button></td></tr>'
        );
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
