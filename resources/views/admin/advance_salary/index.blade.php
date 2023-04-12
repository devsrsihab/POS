@extends('admin.layouts.app')
@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Advance Salarie Tables</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">SR.POS</a></li>
                    <li><a href="#">Advance Salarie Tables</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4">
                        <h3 class="panel-title pull-left">Advance Salarie</h3>
                        <a title="Create" formActionUrl="{{ route('advanceSalaries.store') }}" href="{{ route('advanceSalaries.create') }}" class="bootModal btn btn-primary pull-right">Make A Advance Salarie</a>
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
                                                <th>Month</th>
                                                <th>Year</th>
                                                <th>Salarie Paid</th>
                                                <th>Paid Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($advanceSalaries as $advanceSalarie )
                      
                                            <tr>
                                                <td>{{  $advanceSalarie->id }}</td>
                                                <td>{{  $advanceSalarie->name }}</td>
                                                <td>{{  \Carbon\Carbon::createFromDate(null,$advanceSalarie->month,null)->format('F') }}</td>
                                                <td>{{  $advanceSalarie->year }}</td>
                                                <td>{{  $advanceSalarie->advance_salary }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($advanceSalarie->created_at)->setTimezone('Asia/Dhaka')->format('d F Y - h:i A') }}

                                                
                                                </td>

                                                <td>
                                                    <a formActionUrl="{{ route('advanceSalaries.update',$advanceSalarie->id) }}" href="{{ route('advanceSalaries.edit',$advanceSalarie->id) }}" class="bootModal btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>

                                                    <a title="Show" href="{{ route('advanceSalaries.show',$advanceSalarie->id) }}" class="bootModal btn btn-primary"><i class="fa-solid fa-eye"></i></a>

                                                    <form action="{{ route('advanceSalaries.destroy',$advanceSalarie->id) }}" delete-link="{{ route('advanceSalaries.destroy',$advanceSalarie->id) }}" class="delete-form" style="display:inline-block;">
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
                            title: 'Advance Salarie '+title,
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

                alert(formActionUrl);


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

                          $('.employe_id-error').text(response.errors.employe_id);
                          $('.month-error').text(response.errors.month);
                          $('.year-error').text(response.errors.year);
                          $('.advance_salary-error').text(response.errors.advance_salary);

                            



                        }
                        else if(response.status === 401 || response.status === 402)
                        {
                            toastr.error(response.message, response.msgTitle);

                        }

                        else
                        {
                            dialog.modal('hide');
                          $('.error').html('');
                          $('.error').addClass('d-none');
                          formId === '#advanceSalariesCreateForm' ? msg = 'Created' : msg = 'Updated';
                          toastr.success('Salarie Successfullly ' +msg +'!', 'Salarie '+ msg + '');
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
                            formId !== '#advanceSalariesCreateForm' || formId !== '#advanceSalariesUpdateForm' ? msg = 'Deleted' : msg = '';
                          toastr.success('Salarie Successfullly ' +msg +'!', 'Salarie '+ msg + '');
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
