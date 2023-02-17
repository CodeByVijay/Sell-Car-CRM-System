@extends('partials.app')
@section('title', 'Edit Employee')
@section('main-content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Edit Employee</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
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
                    <p class="mb-30">Edit Employee</p>
                </div>
            </div>
            <form action="{{ route('admin.addEditEmployee') }}" method="POST">
                @csrf
                <input type="hidden" name="emp_id" value="{{$employee->id}}">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Select Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="title" required>
                            <option selected="">Choose...</option>
                            <option value="Mr" {{$employee->title =='Mr'?'selected':'' }}>Mr.</option>
                            <option value="Mrs" {{$employee->title =='Mrs'?'selected':'' }}>Mrs.
                            </option>
                            <option value="Miss" {{$employee->title =='Miss'?'selected':'' }}>Miss
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
                            value="{{ $employee->name }}" autocomplete="off" required>
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
                            minlength="7" maxlength="15" autocomplete="off" value="{{ $employee->mobile }}" required>
                        @error('mobile_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="email" value="{{ $employee->email }}"
                            placeholder="email@example.com" type="email" autocomplete="off" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Date of
                        Birth <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control date-picker" value="{{ $employee->date_of_birth }}" name="date_of_birth"
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
                            <option selected="">Choose...</option>
                            <option value="Male" {{$employee->gender =='Male'?'selected':'' }}>Male
                            </option>
                            <option value="Female" {{$employee->gender =='Female'?'selected':'' }}>Female
                            </option>
                            <option value="Others" {{$employee->gender =='Others'?'selected':'' }}>Others
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
                        <input class="form-control" name="address" value="{{ $employee->address }}" type="text"
                            placeholder="Address" autocomplete="off">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">State</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="state" value="{{ $employee->state }}" type="text"
                            placeholder="State" autocomplete="off">
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Country</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="country" value="{{ $employee->country }}" type="text"
                            placeholder="Country" autocomplete="off">
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Postcode</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="postcode" value="{{ $employee->postcode }}" type="text"
                            placeholder="Postcode" autocomplete="off">
                        @error('postcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-10 col-md-10 col-form-label"> </label>
                    <div class="col-sm-2 col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Update</button>
                    </div>
                </div>


            </form>

            <!-- Default Basic Forms End -->

        </div>
    @endsection
