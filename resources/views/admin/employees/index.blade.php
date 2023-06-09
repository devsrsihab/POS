@extends('admin.layouts.app')
@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Employees Tables</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">SR.POS</a></li>
                    <li><a href="#">Employees Tables</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4">
                        <h3 class="panel-title pull-left">Employees</h3>
                        <a title="Create" formActionUrl="{{ route('employees.store') }}" href="{{ route('employees.create') }}" class="bootModal btn btn-primary pull-right">Add Employee</a>
                    </div>
                    <div class="panel-body mt-5">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Adress</th>
                                                <th>Experience</th>
                                                <th>Photo</th>
                                                <th>Salary</th>
                                                <th>Vacation</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employees as $employe )
                      
                                            <tr>
                                                <td>{{  $employe->id }}</td>
                                                <td>{{  $employe->name }}</td>
                                                <td>{{  $employe->phone }}</td>
                                                <td>{{  $employe->email }}</td>
                                                <td>{{  $employe->adress }}</td>
                                                <td>{{  $employe->experience }}</td>
                                                <td><img style="height: 35px; object-fit:cover" src="{{ asset('uploads/employees/'.$employe->photo) }}" alt="employe-photo"></td>
                                                <td>{{ $employe->salary }}</td>
                                                <td>{{ $employe->vacation }}</td>
                                                <td>{{ $employe->city }}</td>
                                                <td>
                                                    <a formActionUrl="{{ route('employees.update',$employe->id) }}" href="{{ route('employees.edit',$employe->id) }}" class="bootModal btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>

                                                    <form action="{{ route('employees.destroy',$employe->id) }}" delete-link="{{ route('employees.destroy',$employe->id) }}" class="delete-form" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a  href="" class=" btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>

                                                    </form>

                                                </td>
                                            </tr>

                          
                                            @empty
                                                
                                            <tr>
                                                <td class="text-danger" colspan="10">No Data Found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End row -->
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            // laravel csrf token ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let dialog ='';
            let formActionUrl = '';
            let formId = '';
            let msg ='';

            // modal calling
            $(document).on('click', '.bootModal', function(e) {
                e.preventDefault();

                let modalUrl = $(this).attr('href');
                formActionUrl = $(this).attr('formActionUrl');
                let title = $(this).attr('title');
                // ajax
                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(res) {
                        // console.log(res);

                        //bootmodal
                         dialog = bootbox.dialog({
                            title: 'Employe '+title,
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(res)
                        formId = '#'+ $('.modalContent').find('form').attr('id');


                    }
                });

            });


            // form submit
            $(document).on('submit',formId, function (e) {
                e.preventDefault();


                // form data object
                let formData = new FormData($(formId)[0]);

                $.ajax({
                    type: "POST",
                    url: formActionUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);

                        // show error
                        if (response.status === 400)
                        {
                          $('.error').html('');
                          $('.error').removeClass('d-none');

                          $('.name-error').text(response.errors.name);
                          $('.phone-error').text(response.errors.phone);
                          $('.email-error').text(response.errors.email);
                          $('.adress-error').text(response.errors.adress);
                          $('.experience-error').text(response.errors.experience);
                          $('.photo-error').text(response.errors.photo);
                          $('.salary-error').text(response.errors.salary);
                          $('.vacation-error').text(response.errors.vacation);
                          $('.city-error').text(response.errors.city);
                            
                        }
                        else
                        {
                            dialog.modal('hide');
                          $('.error').html('');
                          $('.error').addClass('d-none');
                          formId === '#employeCreateForm' ? msg = 'Created' : msg = 'Updated';
                          toastr.success('Employee Successfullly ' +msg +'!', 'Employee '+ msg + '');
                          $('.table').load(location.href+' .table');
        
                            
                        }
                        
                    }
                });                
            });

            // confirmation delete
            $(document).on('click','.delete-form', function (e) {
                e.preventDefault();

                //token
                let csrf = $(this).find('input[name="_token"]').val();
                //delete link
                let deleteLink = $(this).attr('action');

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                //ajax 
                $.ajax({
                    type: "POST",
                    url: deleteLink,
                    data: {'_token':csrf,'_method':'DELETE'},
               
                    success: function (response) {

                        if (response.status===200)
                        {
                            formId !== '#employeCreateForm' || formId !== '#employeUpdateForm' ? msg = 'Deleted' : msg = '';
                          toastr.success('Employee Successfullly ' +msg +'!', 'Employee '+ msg + '');
                          $('.table').load(location.href+' .table');
                            
                        } else {
                            
                        }
                        
                    }
                });

                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
                
            });
        });
    </script>
@endsection
