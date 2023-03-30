@extends('auth.layouts.app')
@section('content')
<div class="panel panel-color panel-primary panel-pages">
    <div class="panel-heading bg-img">
        <div class="bg-overlay"></div>
        <h3 class="text-center m-t-10 text-white"> Sign In to <strong>Moltran</strong> </h3>
    </div>


    <div class="panel-body">
        <form id="loginForm" class="form-horizontal m-t-20" method="post" action="{{ route('login') }}">
            @csrf

            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control input-lg " type="text" placeholder="Email" name="email">
                    <div class="email-error error d-none text-danger"></div>
                    @if ($errors->has('email'))
                    <div class="error text-danger">{{ $errors->first('email') }}</div>

                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control input-lg" type="password"  placeholder="Password" name="password">
                    <div class="password-error d-none error text-danger"></div>
                    @if ($errors->has('password'))
                    <div class=" error text-danger">{{ $errors->first('password') }}</div>  
                    @endif
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-12">
                    <div class="checkbox checkbox-success">
                        <input id="checkbox-signup" type="checkbox" name="remember">
                        <label for="checkbox-signup">
                            Remember me
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group text-center m-t-40">
                <div class="col-xs-12">
                    <button class="btn btn-success btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
                </div>
            </div>

            <div class="form-group m-t-30">
                <div class="col-sm-7">
                    <a href="recoverpw.html"><i class="fa-solid fa-lock"></i> Forgot your password?</a>
                </div>
                <div class="col-sm-5 text-right">
                    <a href="register.html">Create an account</a>
                </div>
            </div>
        </form>
    </div>

</div>    
@endsection
{{-- @section('scripts')
<script>
    $(document).ready(function () {

        // laravel ajax
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // submit event
        $(document).on('submit','#loginForm', function (e) {
            e.preventDefault();

            formData = new FormData($('#loginForm')[0]);

            // ajax 
            $.ajax({
                type: "POST",
                url: "{{ route('loginAction') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);

                    if (response.status===400) {
                        $('.error').html('');
                        $('.error').removeClass('.d-none');
                        $('.email-error').text(response.errors.email);
                        $('.password-error').text(response.errors.password);
                        
                    } else {
                        $('.error').html('');
                        $('.error').addClass('.d-none');
                        $(location).attr('href', '{{ route("dashboard") }}');
                        
                    }
                    
                }
            });
            
        });





    });


</script>
    
@endsection --}}