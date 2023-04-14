@extends('admin.layouts.app')
@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Products Tables</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">SR.POS</a></li>
                    <li><a href="#">Products Tables</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4">
                        <h3 class="panel-title pull-left">Products</h3>
                        <a title="Create" formActionUrl="{{ route('products.store') }}" href="{{ route('products.create') }}" class="bootModal btn btn-primary pull-right">Add Products</a>
                    </div>
                    <div class="panel-body mt-5">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Product Garage</th>
                                                <th>Product Route</th>
                                                <th>Product Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $product )
                      
                                            <tr>
                                                <td>{{  $product->id }}</td>
                                                <td>{{  $product->product_name }}</td>
                                                <td>{{  $product->product_garage }}</td>
                                                <td>{{  $product->product_route }}</td>
                                                
                                                <td><img style="height: 35px; object-fit:cover" src="{{ asset('uploads/Products/'.$product->product_image) }}" alt="employe-photo"></td>
                                                <td>
                                                    
                                                    <a title="Edit" formActionUrl="{{ route('products.update',$product->id) }}" href="{{ route('products.edit',$product->id) }}" class="bootModal btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    
                                                    <a title="Show" href="{{ route('products.show',$product->id) }}" class="bootModal btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                    
                                                    <form action="{{ route('products.destroy',$product->id) }}" delete-link="{{ route('products.destroy',$product->id) }}" class="delete-form" style="display:inline-block;">
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
                        console.log(res);

                        //bootmodal
                         dialog = bootbox.dialog({
                            title: 'Supplier '+title,
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

                          $('.product_name-error').text(response.errors.product_name);
                          $('.cat_id-error').text(response.errors.cat_id);
                          $('.sup_id-error').text(response.errors.sup_id);
                          $('.product_garage-error').text(response.errors.product_garage); 
                          $('.product_route-error').text(response.errors.product_route);
                          $('.product_image-error').text(response.errors.product_image);
                          $('.buy_date-error').text(response.errors.buy_date);
                          $('.expire_date-error').text(response.errors.expire_date);
                          $('.buying_price-error').text(response.errors.buying_price);
                          $('.selling_price-error').text(response.errors.selling_price);
                            
                        }
                        else
                        {
                            dialog.modal('hide');
                          $('.error').html('');
                          $('.error').addClass('d-none');
                          formId === '#productCreateForm' ? msg = 'Created' : msg = 'Updated';
                          toastr.success('Product Successfullly ' +msg +'!', 'Product '+ msg + '');
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
                            formId !== '#productCreateForm' || formId !== '#productUpdateForm' ? msg = 'Deleted' : msg = '';
                          toastr.success('Product Successfullly ' +msg +'!', 'Product '+ msg + '');
                          $('.table').load(location.href+' .table');
                            
                        } else {
                            toastr.success('Product Id Not Found!', 'Product 404!');

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
