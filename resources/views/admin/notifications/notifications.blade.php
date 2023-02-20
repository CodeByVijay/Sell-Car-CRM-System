@extends('partials.app')
@section('title', 'Notification')
@section('main-content')
    @push('style')
        <style>
            .employee {
                color: blue;
                font-weight: 600;
                cursor: pointer;
            }
        </style>
    @endpush

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Notification</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notification</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Notification</h4>
                    <p class="mb-30">Notification</p>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                @include('notification')

                <div class="card-box mb-30">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#sendNotificationModal"
                        class="float-right btn btn-primary btn-sm my-3 mx-2" id="sendNotification"><i class="dw dw-email2"></i>
                        Send Notification</a>
                    <div class="pt-20 pb-20 table-responsive">
                        <table class="checkbox-datatable table nowrap table-bordered table-striped table-hover"
                            id="mailSettingTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    {{-- <th>Mailer</th> --}}
                                    <th>Sender Name</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $key => $row)
                                    <tr>
                                        <td class="no-sort">
                                            {{ $key + 1 }}
                                        </td>
                                        {{-- <td>{{ $row->mailer }}</td> --}}
                                        <td>{{ $row->sender_name }}</td>
                                        <td>{{ $row->subject }}</td>
                                        <td>{!! wordwrap($row->msg,50,"<br>\n") !!}</td>
                                        <td>
                                            <form action="{{ route('admin.deleteNotification', $row->id) }}"
                                                id="notificationDelete{{ $row->id }}" method="get">
                                                <a class="dropdown-item notificationDelete" data-id="{{ $row->id }}"
                                                    href="javascript:void(0)"><i class="dw dw-delete-3 btn btn-danger"></i></a>
                                            </form>
                                            {{-- <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.editMailSettingForm', $row->id) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <form action="{{ route('admin.deleteMailSetting', $row->id) }}"
                                                        id="mailDelete{{ $row->id }}" method="get">
                                                        <a class="dropdown-item mailDelete" data-id="{{ $row->id }}"
                                                            href="javascript:void(0)"><i class="dw dw-delete-3"></i>
                                                            Delete</a>
                                                    </form>
                                                </div>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Test mail Model --}}
            <div class="modal fade" id="sendNotificationModal" tabindex="-1" aria-labelledby="sendNotificationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sendNotificationModalLabel">Test Mail Send</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="sendNotificationForm" method="post" action="{{ route('admin.sendNotification') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="emp_id" class="col-form-label">Select Employee:</label>
                                    <select name="emp_id" id="emp_id" class="form-control" required>
                                        <option value="" selected disabled>Choose Employee</option>
                                        <option value="0">All Employees</option>
                                        @foreach ($employees as $row)
                                        <option value="{{$row->id}}">{{$row->title}} {{$row->name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-form-label">Subject:</label>
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                </div>

                                <div class="form-group">
                                    <label for="to" class="col-form-label">Message:</label>
                                    <textarea class="form-control" name="msg"
                                        placeholder="Message" required></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send Notification</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Test Mail Model  --}}

        @endsection
        @push('script')
            <script>
                $('#mailSettingTable').DataTable();

                // Delete Configuration
                $(document).on('click', '.notificationDelete', function(e) {
                    e.preventDefault();
                    notificationId = $(this).data('id')
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
                            $(`#notificationDelete${notificationId}`).submit()
                        }
                    })
                })
                // Delete Configuration

            </script>
        @endpush
