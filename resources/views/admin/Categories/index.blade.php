@extends('admin.layouts.app')
@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Categories Tables</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">SR.POS</a></li>
                    <li><a href="#">Categories Tables</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4">
                        <h3 class="panel-title pull-left">Categories</h3>
                        <a title="Create" formActionUrl="{{ route('categories.store') }}" href="{{ route('categories.create') }}" class="bootModal btn btn-primary pull-right">Add categories</a>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Categories as $Categorie )
                      
                                            <tr>
                                                <td>{{  $Categorie->id }}</td>
                                                <td>{{  $Categorie->cate_name }}</td>
                                                <td>
                                                    <a formActionUrl="{{ route('categories.update',$Categorie->id) }}" href="{{ route('categories.edit',$Categorie->id) }}" class="bootModal btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>

                                                    <form action="{{ route('categories.destroy',$Categorie->id) }}" delete-link="{{ route('categories.destroy',$Categorie->id) }}" class="delete-form" style="display:inline-block;">
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
                            title: 'Categorie '+title,
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

                          $('.cate_name-error').text(response.errors.cate_name);
       
                            
                        }
                        else
                        {
                            dialog.modal('hide');
                          $('.error').html('');
                          $('.error').addClass('d-none');
                          formId === '#categorieCreateForm' ? msg = 'Created' : msg = 'Updated';
                          toastr.success('Categorie Successfullly ' +msg +'!', 'Categorie '+ msg + '');
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
                            formId !== '#categorieCreateForm' || formId !== '#categorieUpdateForm' ? msg = 'Deleted' : msg = '';
                          toastr.success('Categorie Successfullly ' +msg +'!', 'Categorie '+ msg + '');
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
