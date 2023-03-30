<div class="panel-body">
    <form id="employeUpdateForm" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $employe->name }}">
            <div class="name-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="text" class="form-control" id="email" placeholder="Enter email" value="{{ $employe->email }}">
            <div class="email-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter phone" value="{{ $employe->phone }}">
            <div class="phone-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="adress">Adress</label>
            <input name="adress" type="text" class="form-control" id="adress" placeholder="Enter adress" value="{{ $employe->adress }}">
            <div class="adress-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="experience">Experience</label>
            <input name="experience" type="text" class="form-control" id="experience" placeholder="Enter experience" value="{{ $employe->experience }}">
            <div class="experience-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input name="photo" type="file" class="form-control" id="photo" >
            <div class="photo-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input name="salary" type="text" class="form-control" id="salary" placeholder="Enter Salary" value="{{ $employe->salary }}">
            <div class="salary-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="vacation">Vacation</label>
            <input name="vacation" type="text" class="form-control" id="vacation" placeholder="Enter Vacation" value="{{ $employe->vacation }}">
            <div class="vacation-error text-danger error d-none "></div>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city"  placeholder="Enter City" value="{{ $employe->city }}">
            <div class="city-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->