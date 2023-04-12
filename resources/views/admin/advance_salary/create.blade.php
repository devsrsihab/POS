<div class="panel-body">
    <form id="advanceSalariesCreateForm" method="post">
        @csrf

        <div class="form-group">
            <label for="employe_id">Name</label>
            <select class="form-control" id="employe_id" name="employe_id">
                <option selected disabled>Select Name</option>
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

                @foreach ($remainingMonths as $remainingMonth )
                <option value=" {{ date('n', strtotime($remainingMonth)) }} ">{{ $remainingMonth }}</option>
                    
                @endforeach
               

            </select>
            <div class="month-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <input name="year" type="hidden" class="form-control" id="year" value="{{ date('Y') }}">
        </div>
        <div class="form-group">
            <label for="advance_salary">Amount</label>
            <input name="advance_salary" type="text" class="form-control" id="advance_salary" placeholder="Enter advance_salary">
            <div class="advance_salary-error text-danger error d-none "></div>
        </div>

        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
    </form>
</div><!-- panel-body -->