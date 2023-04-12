<div class="panel-body">
    <form id="advanceSalariesUpdateForm" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employe_id">Name</label>
            <select class="form-control" id="employe_id" name="employe_id">
                <option selected disabled>Select Type</option>
                @forelse ($employees as $employe )

                <option {{ $employe->id===$advanceSalary->employe_id ? 'selected' : '' }} value="{{ $employe->id }}">{{ $employe->name }}</option>

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
                <option {{ $advanceSalary->month == date('n', strtotime($remainingMonth)) ? 'selected' : 'pok'  }} value="{{ date('n', strtotime($remainingMonth)) }}">{{ $remainingMonth }}</option>
                    
                @endforeach
               

            </select>
            <div class="month-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <input name="year" type="hidden" class="form-control" id="year" value="{{ date('Y') }}">
        </div>
        <div class="form-group">
            <label for="advance_salary">advance_salary</label>
            <input name="advance_salary" type="text" class="form-control" id="advance_salary" placeholder="Enter advance_salary" value="{{ $advanceSalary->advance_salary }}">
            <div class="advance_salary-error text-danger error d-none "></div>
        </div>
        
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
    </form>
</div><!-- panel-body -->