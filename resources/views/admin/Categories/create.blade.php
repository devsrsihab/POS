<div class="panel-body">
    <form id="employeCreateForm" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input name="cate_name" type="text" class="form-control" id="name" placeholder="Enter Name">
            <div class="name-error text-danger error d-none "></div>
        </div>       

        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
    </form>
</div><!-- panel-body -->