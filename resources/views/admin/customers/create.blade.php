<div class="panel-body">
    <form id="customerCreateForm" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name">
            <div class="name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="text" class="form-control" id="email" placeholder="Enter email">
            <div class="email-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter phone">
            <div class="phone-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="adress">Adress</label>
            <input name="adress" type="text" class="form-control" id="adress" placeholder="Enter adress">
            <div class="adress-error text-danger error d-none "></div>
        </div>
      
        <div class="form-group">
            <label for="photo">Photo</label>
            <input name="photo" type="file" class="form-control" id="photo" >
            <div class="photo-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="shop">Shop Name</label>
            <input name="shop" type="text" class="form-control" id="shop" placeholder="Enter Shop Name" >
            <div class="shop-error text-danger error d-none "></div>
        </div>
        {{-- bank Details --}}
        <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input name="bank_name" type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name">
            <div class="bank_name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="branch_name">Branch Name</label>
            <input name="branch_name" type="text" class="form-control" id="branch_name" placeholder="Enter Branch Name">
            <div class="branch_name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="account_holder">Account Holder Name</label>
            <input name="account_holder" type="text" class="form-control" id="account_holder" placeholder="Enter Account Holder Name">
            <div class="account_holder-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input name="account_number" type="text" class="form-control" id="account_number" placeholder="Enter Account Number">
            <div class="account_number-error text-danger error d-none "></div>
        </div>
        {{--  bank details end --}}
       
       
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city"  placeholder="Enter City">
            <div class="city-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->