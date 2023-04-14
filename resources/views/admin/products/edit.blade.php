<div class="panel-body">
    <form id="employeUpdateForm" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $supplier->name }}">
            <div class="name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="text" class="form-control" id="email" placeholder="Enter email" value="{{ $supplier->email }}">
            <div class="email-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter phone" value="{{ $supplier->phone }}">
            <div class="phone-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="adress">Adress</label>
            <input name="adress" type="text" class="form-control" id="adress" placeholder="Enter adress" value="{{ $supplier->adress }}">
            <div class="adress-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="type">Supplier Type</label>
            <select class="form-control" id="type" name="type">
              <option selected >Select Type</option>
              <option value="1"{{ $supplier->type == 1 ? 'selected' : '' }}>Distrubutor</option>
              <option value="2"{{ $supplier->type == 2 ? 'selected' : '' }}>Whole Seller</option>
              <option value="3"{{ $supplier->type == 3 ? 'selected' : '' }}>Brochure</option>
            </select>
            <div class="type-error text-danger error d-none "></div>

          </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input name="photo" type="file" class="form-control" id="photo" >
            <img style="height:90px;margin-top:15px" src="{{ asset('uploads/Suppliers/'. $supplier->photo) }}" alt="">
            <div class="photo-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="shop">Shop Name</label>
            <input name="shop" type="text" class="form-control" id="shop" placeholder="Enter Shop Name" value="{{ $supplier->shop }}">
            <div class="shop-error text-danger error d-none "></div>
        </div>
        {{-- bank Details --}}
        <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input name="bank_name" type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name" value="{{ $supplier->bank_name }}">
            <div class="bank_name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="branch_name">Branch Name</label>
            <input name="branch_name" type="text" class="form-control" id="branch_name" placeholder="Enter Branch Name" value="{{ $supplier->branch_name }}">
            <div class="branch_name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="account_holder">Account Holder Name</label>
            <input name="account_holder" type="text" class="form-control" id="account_holder" placeholder="Enter Account Holder Name" value="{{ $supplier->account_holder }}">
            <div class="account_holder-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input name="account_number" type="text" class="form-control" id="account_number" placeholder="Enter Account Number" value="{{ $supplier->account_number }}">
            <div class="account_number-error text-danger error d-none "></div>
        </div>
        {{--  bank details end --}}
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city"  placeholder="Enter City" value="{{ $supplier->city }}">
            <div class="city-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->