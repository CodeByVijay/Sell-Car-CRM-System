@extends('auth.app')
@section('title', 'Reset Password')
@section('content')
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('admin/vendors/images/forgot-password.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Reset Password</h2>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <h6 class="mb-20">Enter your new password, confirm and submit</h6>
                        <form action="{{ route('reset_password_post') }}" method="POST" id="resetForm">
                            @csrf
                            <input type="hidden" name="email" value="{{ $checkToken->email }}">
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name="password" id="password"
                                    placeholder="New Password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>

                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="input-group custom">
                                <input type="password" name="con_password" id="con_password"
                                    class="form-control form-control-lg" placeholder="Confirm New Password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <span id="msgSpan"></span>
                            @error('con_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="showPwd">
                                    <label class="custom-control-label weight-400" for="showPwd">Show Password</label>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">

                                        <input class="btn btn-primary btn-lg btn-block" id="submitResetBtn" type="button"
                                            value="Submit">

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
        // Show-Hide Password
        $(document).on('click', '#showPwd', function() {
            var x = document.getElementById("password");
            var y = document.getElementById("con_password");
            if (x.type === "password" && y.type === 'password') {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        })
        // Show-Hide Password End

        $(document).ready(function() {
            // Check Password & Confirm Password same
            let updatePWDBtn = $('#submitResetBtn');
            updatePWDBtn.attr('disabled', true)
            let msg = $("#msgSpan");
            msg.html('')
            $("#password, #con_password").on('keyup', function() {
                var password = $("#password").val();
                var confirmPassword = $("#con_password").val();
                if (password.length === 0 && password.length === 0) {
                    msg.html('')
                    updatePWDBtn.attr('disabled', true)
                } else {
                    if (password != confirmPassword) {
                        msg.html("Password does not match !").css("color", "red");
                        updatePWDBtn.attr('disabled', true)
                    } else {
                        msg.html("Password match !").css("color", "green");
                        updatePWDBtn.attr('disabled', false)
                    }
                }
            });
            // Check Password & Confirm Password same


            $('#submitResetBtn').on('click', function() {
                let btn = $(this)
                btn.attr('disabled', true);
                btn.val('Please Wait..');
                $('#resetForm').submit();
            })
        });
    </script>
@endpush
