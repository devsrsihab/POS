@extends('admin.layouts.app')
@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Expenses Tables</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">SR.POS</a></li>
                    <li><a href="#">Expenses Tables</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4 " style="margin-bottom: 15px">
                        <a href="{{ route('monthlyExpense',date('F')) }}" class="btn btn-warning pull-left"> This Month Expense</a>

                        <a href="{{ route('expenses.index') }}" style="margin: 0px 10px " class="btn btn-danger pull-left"> All Expense </a>
                        
                        <a title="Create" formActionUrl="{{ route('expenses.store') }}"
                            href="{{ route('expenses.create') }}" class="bootModal btn btn-primary pull-right">Add Expenses</a>
                    </div>
       
   
                    <div class="panel-body mt-5">
                        <div class="row" >

                            <div class="cost_div">
                                <div class="cost" style="background:#ffff9c;padding: 15px; text-align:center;">
                                    <h2>Today Total: ৳{{ $today_cost }}</h2>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Amount</th>
                                                <th>Details</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($todayExpense as $expense)
                                                <tr>
                                                    <td>{{ $expense->id }}</td>
                                                    <td>{{ $expense->amount }}</td>
                                                    <td>{{ $expense->details }}</td>
                                                    <td>{{ 
                                                    \Carbon\Carbon::createFromFormat('d-m-Y',$expense->date)
                                                    ->setTimeZone('Asia/Dhaka')
                                                    ->format('d F Y')
                                                    }}</td>

                                                    <td>
                                                        <a formActionUrl="{{ route('expenses.update', $expense->id) }}"
                                                            href="{{ route('expenses.edit', $expense->id) }}"
                                                            class="bootModal btn btn-success"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>

                                                        <form action="{{ route('expenses.destroy', $expense->id) }}"
                                                            delete-link="{{ route('expenses.destroy', $expense->id) }}"
                                                            class="delete-form" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="" class=" btn btn-danger"><i
                                                                    class="fa-regular fa-trash-can"></i></a>

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

            let dialog = '';
            let formActionUrl = '';
            let formId = '';
            let msg = '';

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
                            title: 'Expense ' + title,
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(res)
                        formId = '#' + $('.modalContent').find('form').attr('id');


                    }
                });

            });


          // form submit
          $(document).on('submit', formId, function(e) {
                e.preventDefault();

                //disabled the button
                $('#submitButton').prop('disabled', true);
       
                // form data object
                let formData = new FormData($(formId)[0]);

                $.ajax({
                    type: "POST",
                    url: formActionUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                       

                        // show error
                        if (response.status === 400) {
                            // enabled the button
                            $('#submitButton').prop('disabled', false);
                            $('.error').html('');
                            $('.error').removeClass('d-none');
                            $('.amount-error').text(response.errors.amount);
                            $('.details-error').text(response.errors.details);


                        } else {
                            // enabled the button
                            $('#submitButton').prop('disabled', false);
                            dialog.modal('hide');
                            $('.error').html('');
                            $('.error').addClass('d-none');
                            formId === '#expenseCreateForm' ? msg = 'Created' : msg = 'Updated';
                            toastr.success('Expense Successfullly ' + msg + '!', 'Expense ' + msg + '');
                            $('.table').load(location.href + ' .table');


                        }

                    }
                });



                
            });



            // confirmation delete
            $(document).on('click', '.delete-form', function(e) {
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
                            data: {
                                '_token': csrf,
                                '_method': 'DELETE'
                            },

                            success: function(response) {

                                if (response.status === 200) {
                                    formId !== '#employeCreateForm' || formId !==
                                        '#employeUpdateForm' ? msg = 'Deleted' : msg =
                                        '';
                                    toastr.success('Employee Successfullly ' + msg +
                                        '!', 'Employee ' + msg + '');
                                    $('.table').load(location.href + ' .table');
                                    $('.cost_div').load(location.href + ' .cost_div');

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
