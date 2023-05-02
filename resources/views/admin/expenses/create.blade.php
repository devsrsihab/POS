<div class="panel-body">
    <form id="expenseCreateForm" method="post">
        @csrf
        <div class="form-group">
            <label for="amount">Amount</label>
            <input name="amount" type="text" class="form-control" id="amount" placeholder="Enter Amount">
            <div class="amount-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" name="details" id="details" cols="30" rows="10"></textarea>
            <div class="details-error text-danger error d-none "></div>
        </div>


        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
        <button id="submitButton" type="submit" class="btn btn-purple waves-effect waves-light">Save</button>
    </form>
</div><!-- panel-body -->