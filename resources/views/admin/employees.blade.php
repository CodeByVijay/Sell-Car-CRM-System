@extends('partials.app')
@section('title', 'All Employees')
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
                        <h4>All Employees</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Employees</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">All Employees</h4>
                    <p class="mb-30">Employees</p>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                @include('notification')

                <div class="card-box mb-30">
                    <a href="{{ route('admin.addEmployee') }}" class="float-right btn btn-success btn-sm my-3 mx-2"><i
                            class="dw dw-add-user"></i> Add New Employee</a>
                    <div class="pt-20 pb-20 table-responsive">
                        <table class="checkbox-datatable table nowrap" id="employeesTable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="dt-checkbox">
                                            <input type="checkbox" name="select_all" value="1" id="master">
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Date of Birth</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $row)
                                    <tr>
                                        <td>
                                            <div class="dt-checkbox">
                                                <input type="checkbox" name="select_all" value="1" class="sub_chk">
                                                <span class="dt-checkbox-label"></span>
                                            </div>
                                        </td>
                                        <td><span class="employee" data-id="{{ $row->id }}"><img
                                                    src="{{ $row->image != null ? $row->image : asset('admin/src/images/avatar.png') }}"
                                                    alt="" class="img-fluid rounded" width="48"
                                                    height="48"></span></td>
                                        <td><span class="employee" data-id="{{ $row->id }}">{{ $row->name }}</span>
                                        </td>
                                        <td>{{ $row->mobile }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->date_of_birth }}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="empStatus" data-id="{{ $row->id }}"
                                                    {{ $row->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i>
                                                        View</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.empEdit', $row->id) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="changePassword({{ $row->id }})"><i
                                                            class="dw dw-password"></i>
                                                        Change Password</a>
                                                    <form action="{{ route('admin.empDelete', $row->id) }}"
                                                        id="empDelete{{ $row->id }}" method="get">
                                                        <a class="dropdown-item empDelete" data-id="{{ $row->id }}"
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


            {{-- Change Password Model --}}
            <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Change Password Model  --}}


        @endsection
        @push('script')
            <script>
                $('#employeesTable').DataTable();

                $(document).on('click', '.empStatus', function(e) {
                    e.preventDefault();
                    let checkbox = $(this)
                    let empId = checkbox.data('id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You change status this employee!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "post",
                                url: "{{ route('admin.employeeStatus') }}",
                                data: {
                                    "empId": empId
                                },
                                success: function(response) {
                                    console.log(response.status)
                                    if (response.msg === 'success') {
                                        if (response.status === 1) {
                                            Swal.fire(
                                                'Activated!',
                                                'Employee has been activated.',
                                                'success'
                                            )
                                            checkbox.prop('checked', true)
                                        } else {
                                            Swal.fire(
                                                'Blocked!',
                                                'Employee has been blocked.',
                                                'success'
                                            )
                                            checkbox.prop('checked', false)
                                        }
                                    }
                                }
                            });
                        }
                    })

                })

                $(document).on('click', '.empDelete', function(e) {
                    e.preventDefault();
                    empId = $(this).data('id')
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
                            $(`#empDelete${empId}`).submit()
                        }
                    })
                })


                // Change Password Code
                function changePassword(id) {
                    alert(id)
                }
                // Change Password Code End
            </script>
        @endpush
