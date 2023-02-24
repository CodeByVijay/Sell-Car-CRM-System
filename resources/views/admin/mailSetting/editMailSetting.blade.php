@extends('partials.app')
@section('title', 'Edit Mail Configuration')
@section('main-content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Edit Mail Configuration</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Mail Configuration</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Mail Configuration Form</h4>
                    <p class="mb-30">Edit Mail Configuration</p>
                </div>
            </div>

            @include('notification')
            <form action="{{ route('admin.addEditMailSetting') }}" id="smtpEditForm" method="POST">
                @csrf
                <input type="hidden" name="mail_id" value="{{ $mailSetting->id }}">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mailer <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="mailer" required>
                            <option value="smtp" {{ $mailSetting->mailer == 'smtp' ? 'selected' : '' }}>SMTP</option>
                        </select>
                        @error('mailer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Host Name/URL <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="host" type="text" placeholder="smtp.gmail.com"
                            value="{{ $mailSetting->host }}" autocomplete="off" required>
                        @error('host')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Encryption <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="encryption" required>
                            <option selected value="" disabled>Choose...</option>
                            <option value="ssl" {{ $mailSetting->encryption == 'ssl' ? 'selected' : '' }}>SSL
                            </option>
                            <option value="tls" {{ $mailSetting->encryption == 'tls' ? 'selected' : '' }}>TLS
                            </option>
                        </select>
                        @error('encryption')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Port<span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="port" placeholder="465, 587 etc" type="number"
                            autocomplete="off" value="{{ $mailSetting->port }}" required>
                        @error('port')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Username <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="username" value="{{ $mailSetting->username }}"
                            placeholder="email@example.com" type="text" autocomplete="off" required>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Password/Google App Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="password" value="{{ $mailSetting->password }}"
                            placeholder="password" type="text" autocomplete="off" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">From Address</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="from_address" value="{{ $mailSetting->from_address }}"
                            type="email" placeholder="email@example.com" autocomplete="off">
                        @error('from_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">From Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="from_name" value="{{ $mailSetting->from_name }}" type="text"
                            placeholder="eg - Marketing Mail" autocomplete="off">
                        @error('from_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-10 col-md-10 col-form-label"> </label>
                    <div class="col-sm-2 col-md-2">
                        <button class="btn btn-primary w-100" id="disableEditBtn" type="button">Submit</button>
                    </div>
                </div>


            </form>

            <!-- Default Basic Forms End -->

        </div>
    @endsection
    @push('script')
        <script>
            $(document).ready(function() {
                $('#disableEditBtn').on('click', function() {
                    $(this).attr('disabled', true)
                    $(this).html('Processing...')
                    $('#smtpEditForm').submit();
                })
            });
        </script>
    @endpush
