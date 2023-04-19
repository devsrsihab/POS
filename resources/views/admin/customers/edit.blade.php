<div class="panel-body">
    <form id="customerUpdateForm" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $customer->name }}">
            <div class="name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="text" class="form-control" id="email" placeholder="Enter email" value="{{ $customer->email }}">
            <div class="email-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter phone" value="{{ $customer->phone }}">
            <div class="phone-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="adress">Adress</label>
            <input name="adress" type="text" class="form-control" id="adress" placeholder="Enter adress" value="{{ $customer->adress }}">
            <div class="adress-error text-danger error d-none "></div>
        </div>
        
        <div class="form-group">
            <label for="photo">Photo</label>
            <input name="photo" type="file" class="form-control" id="photo" >
            <img style="height:90px;margin-top:15px" src="{{ asset('uploads/Customers/'. $customer->photo) }}" alt="">
            <div class="photo-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="shop">Shop Name</label>
            <input name="shop" type="text" class="form-control" id="shop" placeholder="Enter Shop Name" value="{{ $customer->shop }}">
            <div class="shop-error text-danger error d-none "></div>
        </div>
        {{-- bank Details --}}
        <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input name="bank_name" type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name" value="{{ $customer->bank_name }}">
            <div class="bank_name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="branch_name">Branch Name</label>
            <input name="branch_name" type="text" class="form-control" id="branch_name" placeholder="Enter Branch Name" value="{{ $customer->branch_name }}">
            <div class="branch_name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="account_holder">Account Holder Name</label>
            <input name="account_holder" type="text" class="form-control" id="account_holder" placeholder="Enter Account Holder Name" value="{{ $customer->account_holder }}">
            <div class="account_holder-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input name="account_number" type="text" class="form-control" id="account_number" placeholder="Enter Account Number" value="{{ $customer->account_number }}">
            <div class="account_number-error text-danger error d-none "></div>
        </div>
        {{--  bank details end --}}
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city"  placeholder="Enter City" value="{{ $customer->city }}">
            <div class="city-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->