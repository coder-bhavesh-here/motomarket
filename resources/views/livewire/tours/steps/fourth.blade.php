<div>
    <table class="table table-borderless table-centered w-full" id="dateTable">
        <p class="text-xl mb-4">Tour Dates & Price: </p>
        <tr>
            <th class="w-2/5">Tour Date</th>
            <th class="w-2/5">Price</th>
            <th class="w-1/5"></th>
        </tr>
        <tr>
            <td><input type="date" name="date[0][date]" /></td>
            <td><input type="text" name="date[0][qty]" placeholder="Price on the date" /></td>
            <td><button type="button" name="add" id="addDate" class="btn-info">Add More</button></td>
        </tr>
    </table>
    <p class="text-center m-5">You can run the same tour multiple times during the year.<br> If so select the dates and
        price by adding a new tour line.</p>
    <hr>

    <table class="table table-borderless table-centered w-full" id="addonTable">
        <p class="text-xl mb-4">Tour Add-Ons: </p>
        <tr>
            <th class="w-2/5">Addon</th>
            <th class="w-2/5">Price</th>
            <th class="w-1/5"></th>
        </tr>
        <tr>
            <td><input type="text" placeholder="Riding with a passenger. 2 up riding on one bike" class="w-full"
                    name="addon[0][addon]" /></td>
            <td><input type="text" name="addon[0][price]" placeholder="300" /></td>
            <td><button type="button" name="add" id="addAddon" class="btn-info">Add More</button></td>
        </tr>
    </table>
    <p class="text-center m-5">You can run the same tour multiple times during the year.<br> If so select the dates and
        price by adding a new tour line.</p>
</div>

<script type="text/javascript">
    var i = 0;
    $("#addDate").click(function() {
        ++i;
        $("#dateTable").append('<tr><td><input type="date" name="date[' + i +
            '][date]" placeholder="Tour Date" class="form-control" /></td><td><input type="text" name="date[' +
            i +
            '][qty]" placeholder="Price on the date" class="form-control" /></td><td><button type="button" class="btn-danger remove-tr">Remove</button></td></tr>'
        );
    });
    $("#addAddon").click(function() {
        ++i;
        $("#addonTable").append('<tr><td><input type="text" class="w-full" name="addon[' + i +
            '][addon]" placeholder="Riding with a passenger. 2 up riding on one bike" class="form-control" /></td><td><input type="text" name="addon[' +
            i +
            '][qty]" placeholder="300" class="form-control" /></td><td><button type="button" class="btn-danger remove-tr">Remove</button></td></tr>'
        );
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
