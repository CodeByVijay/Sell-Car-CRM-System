@extends('partials.app')
@section('title', 'Mail Setting')
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
                        <h4>Mail Setting</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mail Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Mail Setting</h4>
                    <p class="mb-30">Mail Setting</p>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                @include('notification')

                <div class="card-box mb-30">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#sendTestMailModal"
                        class="float-right btn btn-primary btn-sm my-3 mx-2" id="sendTestMail"><i class="dw dw-email2"></i>
                        Send Test Mail</a>
                    <a href="{{ route('admin.mailSettingCreate') }}" class="float-right btn btn-success btn-sm my-3 mx-2"><i
                            class="dw dw-add-user"></i> Add Mail Configuration</a>
                    <div class="pt-20 pb-20 table-responsive">
                        <table class="checkbox-datatable table nowrap table-bordered table-striped table-hover"
                            id="mailSettingTable">
                            <thead>
                                <tr>
                                    <th class="no-sort">Status</th>
                                    {{-- <th>Mailer</th> --}}
                                    <th>Host</th>
                                    <th>Port</th>
                                    <th>Username</th>
                                    <th>Encryption</th>
                                    <th>From Address</th>
                                    <th>From Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mailSettings as $key => $row)
                                    <tr>
                                        <td class="no-sort">
                                            @if ($row->status == 1)
                                                <span class="badge badge-primary">Currently Used</span>
                                            @else
                                                <form action="{{ route('admin.useMailSetting', $row->id) }}"
                                                    id="useMail{{ $row->id }}" method="get">
                                                    <a class="dropdown-item useMail" data-id="{{ $row->id }}"
                                                        href="javascript:void(0)">
                                                        <span class="btn btn-success" style="cursor: pointer;">Use</span>
                                                    </a>
                                                </form>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $row->mailer }}</td> --}}
                                        <td>{{ $row->host }}</td>
                                        <td>{{ $row->port }}</td>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ strtoupper($row->encryption) }}</td>
                                        <td>{{ $row->from_address }}</td>
                                        <td>{{ $row->from_name }}</td>
                                        <td>
                                            <div class="dropdown">
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
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Test mail Model --}}
            <div class="modal fade" id="sendTestMailModal" tabindex="-1" aria-labelledby="sendTestMailModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sendTestMailModalLabel">Test Mail Send</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="sendTestMailForm" method="post" action="{{ route('admin.sendTestMail') }}">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="emp_id" id="emp_id">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="to" class="col-form-label">To Email:</label>
                                    <input type="email" class="form-control" name="to"
                                        placeholder="email@example.com">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send Test Mail</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Test Mail Model  --}}

        @endsection
        @push('script')
            <script>
                $('#mailSettingTable').DataTable({
                    "columnDefs": [{
                        "targets": [0,7],
                        "orderable": false
                    }]
                });

                // Delete Configuration
                $(document).on('click', '.mailDelete', function(e) {
                    e.preventDefault();
                    mailId = $(this).data('id')
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
                            $(`#mailDelete${mailId}`).submit()
                        }
                    })
                })
                // Delete Configuration


                // Use Mail Configuration
                $(document).on('click', '.useMail', function(e) {
                    e.preventDefault();
                    mailId = $(this).data('id')
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to be used this mail configuration further communication!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, used it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(`#useMail${mailId}`).submit()
                        }
                    })
                })
                // Use Mail Configuration end
            </script>
        @endpush
