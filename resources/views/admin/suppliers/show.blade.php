<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" style="border-radius:50%" width="150px" src="{{ asset('uploads/Suppliers/'.$supplier->photo) }}"><span class="text-black-50"><h3>{{ $supplier->name }}</h3></span><span> </span></div>
        </div>
        <div class="col-md-7 border-right">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="">Supplier Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Name</h4>
                            <h5 class="text-capitalize">{{ $supplier->name }}</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Phone</h4>
                            <h5 class="text-capitalize">{{ $supplier->phone }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Email</h4>
                            <h5 class="text-capitalize">{{ $supplier->email }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Address</h4>
                            <h5 class="text-capitalize">{{ $supplier->adress }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Type</h4>
                            <h5 class="text-capitalize">
                                {{ $supplier->type === 1 ? 'Distrubutor' : ''  }}
                                {{ $supplier->type === 2 ? 'Whole Seller' : ''  }}
                                {{ $supplier->type === 3 ? 'Brochure' : ''  }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Bank Name</h4>
                            <h5 class="text-capitalize">
                                {{ $supplier->branch_name }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>AccountHolder</h4>
                            <h5 class="text-capitalize">
                                {{ $supplier->account_holder }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Account Number</h4>
                            <h5 class="text-capitalize">
                                {{ $supplier->account_number }}
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>City</h4>
                            <h5 class="text-capitalize">
                                {{ $supplier->city }}
                            </h5>
                        </div>
                    </div>
   
 

                </div>

        </div>

    </div>
</div>
</div>
</div>