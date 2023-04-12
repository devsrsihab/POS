<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" style="border-radius:50%;object-fit:cover" width="150px" src="{{ asset('uploads/employees/'.$employee->photo) }}"><span class="text-black-50"><h3>{{ $employee->name }}</h3></span><span> </span></div>
        </div>
        <div class="col-md-7 border-right">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="">Supplier Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Name</h4>
                            <h5 class="text-capitalize">{{ $employee->name }}</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Phone</h4>
                            <h5 class="text-capitalize">{{ $employee->phone }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Email</h4>
                            <h5 class="text-capitalize">{{ $employee->email }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Address</h4>
                            <h5 class="text-capitalize">{{ $employee->adress }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Experience</h4>
                            <h5 class="text-capitalize">
                                {{ $employee->experience }} Year
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Salary</h4>
                            <h5 class="text-capitalize">
                                {{ $employee->salary }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Vacation</h4>
                            <h5 class="text-capitalize">
                                {{ $employee->vacation }} Day
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>City</h4>
                            <h5 class="text-capitalize">
                                {{ $employee->city }}
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