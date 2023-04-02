<div class="panel-body">
    <form id="advanceSalariesCreateForm" method="post">
        @csrf

        <div class="form-group">
            <label for="employe_id">Name</label>
            <select class="form-control" id="employe_id" name="employe_id">
                <option selected disabled>Select Type</option>
                @forelse ($employees as $employe )

                <option value="{{ $employe->id }}">{{ $employe->name }}</option>

                @empty
                    
                @endforelse
              </select>
            <div class="employe_id-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="month">Month</label>
            <select class="form-control" id="month" name="month">
                <option selected disabled>Select Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">Jun</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">Octobor</option>
                <option value="11">November</option>
                <option value="12">December</option>

            </select>
            <div class="month-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input name="year" type="text" class="form-control" id="year" placeholder="Enter Year">
            <div class="year-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="advance_salary">advance_salary</label>
            <input name="advance_salary" type="text" class="form-control" id="advance_salary" placeholder="Enter advance_salary">
            <div class="advance_salary-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->