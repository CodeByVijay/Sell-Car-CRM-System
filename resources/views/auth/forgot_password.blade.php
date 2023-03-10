@extends('auth.app')
@section('title', 'Forgot Password')
@section('content')
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('admin/vendors/images/forgot-password.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        @include('notification')
                        <div class="login-title">
                            <h2 class="text-center text-primary">Forgot Password</h2>
                        </div>
                        <h6 class="mb-20">Enter your email address to reset your password</h6>
                        <form action="{{ route('forgot_password_post') }}" method="post" id="forgotPasswordForm">
                            @csrf
                            <div class="input-group custom">
                                <input type="email" name="email" class="form-control form-control-lg"
                                    placeholder="Email" value="{{old('email')}}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i></span>
                                </div>
                            </div>
                            @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" id="forgotPassBtn" type="button" value="Submit">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('login') }}">Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#forgotPassBtn').on('click',function(){
            let btn = $(this)
            btn.attr('disabled',true);
            btn.val('Please Wait..');
            $('#forgotPasswordForm').submit();
        })
    });
</script>
@endpush
