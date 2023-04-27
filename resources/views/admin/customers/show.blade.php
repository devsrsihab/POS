<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" style="border-radius:50%" width="150px" src="{{ asset('uploads/Customers/'.$customer->photo) }}"><span class="text-black-50"><h3>{{ $customer->name }}</h3></span><span> </span></div>
        </div>
        <div class="col-md-7 border-right">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="">customer Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Name</h4>
                            <h5 class="text-capitalize">{{ $customer->name }}</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Phone</h4>
                            <h5 class="text-capitalize">{{ $customer->phone }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Email</h4>
                            <h5 class="text-capitalize">{{ $customer->email }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Address</h4>
                            <h5 class="text-capitalize">{{ $customer->adress }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Type</h4>
                            <h5 class="text-capitalize">
                                {{ $customer->type === 1 ? 'Distrubutor' : ''  }}
                                {{ $customer->type === 2 ? 'Whole Seller' : ''  }}
                                {{ $customer->type === 3 ? 'Brochure' : ''  }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Bank Name</h4>
                            <h5 class="text-capitalize">
                                {{ $customer->branch_name }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>AccountHolder</h4>
                            <h5 class="text-capitalize">
                                {{ $customer->account_holder }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Account Number</h4>
                            <h5 class="text-capitalize">
                                {{ $customer->account_number }}
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>City</h4>
                            <h5 class="text-capitalize">
                                {{ $customer->city }}
                            </h5>
                        </div>
                    </div>
   
 

                </div>

        </div>

    </div>

    <div class="button-div text-right">
        <button type="button" class="bootbox-close-button  btn btn-danger">Close</button>
    </div>
</div>
</div>
</div>