@extends('partials.app')
@section('title', 'Add New Employee')
@section('main-content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Add New Employee</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Employee</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Employee Details Forms</h4>
                    <p class="mb-30">Add New Employee</p>
                </div>
            </div>
            <form action="{{ route('admin.addEditEmployee') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Select Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="title" required>
                            <option selected value="" disabled>Choose...</option>
                            <option value="Mr" @if (old('title') == 'Mr') {{ 'selected' }} @endif>Mr.</option>
                            <option value="Mrs" @if (old('title') == 'Mrs') {{ 'selected' }} @endif>Mrs.
                            </option>
                            <option value="Miss" @if (old('title') == 'Miss') {{ 'selected' }} @endif>Miss
                            </option>
                        </select>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Full Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="name" type="text" placeholder="Full Name"
                            value="{{ old('name') }}" autocomplete="off" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mobile Number <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mobile_no" placeholder="Mobile Number" type="text"
                            minlength="7" maxlength="15" autocomplete="off" value="{{ old('mobile_no') }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        @error('mobile_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="email@example.com" type="email" autocomplete="off" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="passwordInput">Password <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-8">
                        <input class="form-control" name="password" value="{{ old('password') }}" placeholder="Password"
                            type="text" autocomplete="off" id="passwordInput" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" id="generatePassword" class="btn btn-success btn-sm">Generate Password</button>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Date of
                        Birth <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control date-picker" value="{{ old('date_of_birth') }}" name="date_of_birth"
                            placeholder="Choose Date of birth" type="text" autocomplete="off" required>
                        @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Select Gender <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="gender" required>
                            <option selected value="" disabled>Choose...</option>
                            <option value="Male" @if (old('gender') == 'Male') {{ 'selected' }} @endif>Male
                            </option>
                            <option value="Female" @if (old('gender') == 'Female') {{ 'selected' }} @endif>Female
                            </option>
                            <option value="Others" @if (old('gender') == 'Others') {{ 'selected' }} @endif>Others
                            </option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="address" value="{{ old('address') }}" type="text"
                            placeholder="Address" autocomplete="off">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">State</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="state" value="{{ old('state') }}" type="text"
                            placeholder="State" autocomplete="off">
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Country</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="country" value="{{ old('country') }}" type="text"
                            placeholder="Country" autocomplete="off">
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Postcode</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="postcode" value="{{ old('postcode') }}" type="text"
                            placeholder="Postcode" autocomplete="off">
                        @error('postcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-10 col-md-10 col-form-label"> </label>
                    <div class="col-sm-2 col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                    </div>
                </div>


            </form>

            <!-- Default Basic Forms End -->

        </div>
    @endsection

    @push('script')
        <script>
            $(document).ready(function () {
                $('#generatePassword').on('click',()=>{
                    // let randomPassword = Math.random().toString(36).slice(-10);
                    var randPassword = new Array(10).fill("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz").map(x => (function(chars) { let umax = Math.pow(2, 32), r = new Uint32Array(1), max = umax - (umax % chars.length); do { crypto.getRandomValues(r); } while(r[0] > max); return chars[r[0] % chars.length]; })(x)).join('');
                    $('#passwordInput').val(randPassword)
                })
            });
        </script>
    @endpush
