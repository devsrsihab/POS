<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-10 border-right">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="">Supplier Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Name</h4>
                            <h5 class="text-capitalize">{{ $employe->name }}</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Month</h4>
                            <h5 class="text-capitalize">{{ \Carbon\Carbon::createFromDate(null,$advanceSalary->month,null)->format('F') }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Year</h4>
                            <h5 class="text-capitalize">{{ $advanceSalary->year }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Paid Date</h4>
                            <h5 class="text-capitalize">{{ \Carbon\Carbon::parse($advanceSalary->created_at)->setTimezone('Asia/Dhaka')->format('d F Y - h:i A') }}</h5>
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