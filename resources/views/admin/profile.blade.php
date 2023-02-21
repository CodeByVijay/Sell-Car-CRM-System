@extends('partials.app')
@section('title', 'Profile')
@section('main-content')
    @push('style')
        <style>
            .error {
                color: red;
                font-weight: 600;
            }
        </style>
    @endpush

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="min-height-200px">

                @include('notification')

                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                        class="fa fa-pencil"></i></a>
                                <img src="{{ asset('admin/src/images') }}/{{ auth()->user()->image != null ? auth()->user()->image : 'avatar.png' }}"
                                    avatar.png alt="" class="avatar-photo">
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('profile.changeProfileImage') }}" id="profileImageForm"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body pd-5">
                                                    <div class="img-container my-2">
                                                        <img id="image"
                                                            src="{{ asset('admin/src/images') }}/{{ auth()->user()->image != null ? auth()->user()->image : 'avatar.png' }}"
                                                            alt="Picture" class="img-fluid img-thumbnail">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="file" name="profile_img" id="profile_img"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Update" class="btn btn-primary">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-center h5 mb-0">{{ auth()->user()->title }} {{ auth()->user()->name }}</h5>
                            <p class="text-center text-muted font-14">
                                {{ auth()->user()->is_admin == 1 ? 'Admin' : 'Managment Team' }}</p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                <ul>
                                    <li>
                                        <span>Email Address:</span>
                                        {{ auth()->user()->email }}
                                    </li>
                                    <li>
                                        <span>Phone Number:</span>
                                        {{ auth()->user()->mobile }}
                                    </li>
                                    <li>
                                        <span>State:</span>
                                        {{ auth()->user()->state }}
                                    </li>
                                    <li>
                                        <span>Country:</span>
                                        {{ auth()->user()->country }}
                                    </li>
                                    <li>
                                        <span>Postcode:</span>
                                        {{ auth()->user()->postcode }}
                                    </li>
                                    <li>
                                        <span>Full Address:</span>
                                        {!! wordwrap(auth()->user()->address, '20', '<br>') !!}
                                        <br>{{ auth()->user()->state }}<br>{{ auth()->user()->country }}<br>
                                        {{ auth()->user()->postcode }}

                                    </li>
                                </ul>
                            </div>
                            <div class="profile-social">

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#setting"
                                                role="tab">Profile Settings</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">

                                        <!-- Setting Tab start -->
                                        <div class="tab-pane fade show active height-100-p" id="setting" role="tabpanel">
                                            <div class="profile-setting">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
                                                        <form action="{{ route('profile.changeProfileInfo') }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <select name="title" id=""
                                                                    class="form-control form-control-lg">
                                                                    <option value="Mr"
                                                                        {{ auth()->user()->title == 'Mr' ? 'selected' : '' }}>
                                                                        Mr.</option>
                                                                    <option value="Mrs"
                                                                        {{ auth()->user()->title == 'Mrs' ? 'selected' : '' }}>
                                                                        Mrs.
                                                                    </option>
                                                                    <option value="Miss"
                                                                        {{ auth()->user()->title == 'Miss' ? 'selected' : '' }}>
                                                                        Miss
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <input name="name" class="form-control form-control-lg"
                                                                    type="text" value="{{ auth()->user()->name }}">
                                                                    @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control form-control-lg" type="email"
                                                                    name="email" value="{{ auth()->user()->email }}"
                                                                    required>
                                                                    @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Date of birth</label>
                                                                <input class="form-control form-control-lg date-picker"
                                                                    type="text" name="date_of_birth"
                                                                    value="{{ auth()->user()->date_of_birth }}">
                                                                    @error('date_of_birth')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Gender</label>
                                                                <div class="d-flex">
                                                                    <div class="custom-control custom-radio mb-5 mr-20">
                                                                        <input type="radio" id="customRadio4"
                                                                            name="gender" class="custom-control-input"
                                                                            {{ auth()->user()->gender == 'Male' ? 'checked' : '' }} value="Male">
                                                                        <label class="custom-control-label weight-400"
                                                                            for="customRadio4">Male</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-5">
                                                                        <input type="radio" id="customRadio5"
                                                                            name="gender" class="custom-control-input"
                                                                            {{ auth()->user()->gender == 'Female' ? 'checked' : '' }} value="Female">
                                                                        <label class="custom-control-label weight-400"
                                                                            for="customRadio5">Female</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-5">
                                                                        <input type="radio" id="customRadio6"
                                                                            name="gender" class="custom-control-input"
                                                                            {{ auth()->user()->gender == 'Others' ? 'checked' : '' }} value="Others">
                                                                        <label class="custom-control-label weight-400"
                                                                            for="customRadio6">Other</label>
                                                                    </div>
                                                                </div>
                                                                @error('gender')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="country" value="{{ auth()->user()->country }}">
                                                                    @error('country')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>State/Province/Region</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="state" value="{{ auth()->user()->state }}">
                                                                    @error('state')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Postal Code</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="postcode"
                                                                    value="{{ auth()->user()->postcode }}">
                                                                    @error('postcode')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="mobile" value="{{ auth()->user()->mobile }}"
                                                                    required>
                                                                    @error('mobile')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <textarea name="address" class="form-control">{{ auth()->user()->address }}</textarea>
                                                                @error('address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            </div>

                                                            <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Update Information">
                                                            </div>
                                                        </form>
                                                    </li>
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Change Password</h4>
                                                        <form action="{{ route('profile.changePassword') }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Current Password:</label>
                                                                <input type="password" value="{{ old('password') }}"
                                                                    name="password" id="cpassword"
                                                                    class="form-control form-control-lg"
                                                                    placeholder="Current Password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>New Password:</label>
                                                                <input type="password" value="{{ old('newPassword') }}"
                                                                    name="newPassword" id="npassword"
                                                                    class="form-control form-control-lg"
                                                                    placeholder="New Password">
                                                                    @error('newPassword')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Confirm New Password:</label>
                                                                <input type="password" name="con_password"
                                                                    id="cnpassword" class="form-control form-control-lg"
                                                                    value="{{ old('con_password') }}"
                                                                    placeholder="Confirm New Password">
                                                                <span id="msgSpan"></span>
                                                                @error('con_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox mb-5">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="showPwd">
                                                                    <label class="custom-control-label weight-400"
                                                                        for="showPwd">Show Password</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-0">
                                                                <input type="submit" id="updatePWDBtn"
                                                                    class="btn btn-primary" value="Save & Update">
                                                            </div>
                                                        </form>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <!-- Setting Tab End -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
            var x = document.getElementById("cpassword");
            var y = document.getElementById("npassword");
            var z = document.getElementById("cnpassword");
            if (x.type === "password" && y.type === 'password' && z.type === 'password') {
                x.type = "text";
                y.type = "text";
                z.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
                z.type = "password";
            }
        })
        // Show-Hide Password End

        // Check Password & Confirm Password same
        let updatePWDBtn = $('#updatePWDBtn');
        updatePWDBtn.attr('disabled', true)
        let msg = $("#msgSpan");
        msg.html('')
        $("#npassword, #cnpassword").on('keyup', function() {
            var password = $("#npassword").val();
            var confirmPassword = $("#cnpassword").val();
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


        // Profile Image Validation
        $("#profileImageForm").validate({
            rules: {
                profile_img: {
                    required: true,
                    extension: "jpg|jpeg|png"
                }
            },
            messages: {
                profile_img: {
                    required: "Please upload file.",
                    extension: "Please upload file in these format only (jpg, jpeg, png)."
                }
            },
        });
    </script>
@endpush
