@extends('partials.app')
@section('title', 'Archived Leads')
@section('main-content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Archive Leads</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Archive Leads</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            @include('notification')

            <div class="card-box mb-30">
                <div class="text-right">
                    <a href="{{ route('admin.addEmployee') }}" class="btn btn-success btn-sm my-3 mx-2"><i
                            class="dw dw-refresh1"></i> Restore Selected Leads</a>
                    <a href="{{ route('admin.addEmployee') }}" class="btn btn-danger btn-sm my-3 mx-2"><i
                            class="dw dw-delete-3"></i> Delete Selected Leads</a>
                </div>

                <div class="pt-20 pb-20 table-responsive">
                    <table class="checkbox-datatable table nowrap" id="archiveTable">
                        <thead>
                            <tr>
                                <th>
                                    <div class="dt-checkbox">
                                        <input type="checkbox" name="select_all" value="1" id="master">
                                        <span class="dt-checkbox-label"></span>
                                    </div>
                                </th>
                                <th>Image</th>
                                <th>VRM</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($archivedLeads as $row)
                                <tr>
                                    <td>
                                        <div class="dt-checkbox">
                                            <input type="checkbox" name="select_all" value="1" class="sub_chk">
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </td>
                                    <td><span class="lead" data-id="{{ $row->id }}"><img
                                                src="{{ $row->image != null ? $row->image : asset('admin/src/images/avatar.png') }}"
                                                alt="" class="img-fluid rounded" width="48"
                                                height="48"></span></td>
                                    <td><span class="lead" data-id="{{ $row->id }}">{{ $row->registration }}</span>
                                    </td>
                                    <td>{{ ucfirst($row->full_name) }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->contact_number }}</td>
                                    <td><span class="badge badge-primary">{{ ucfirst($row->status) }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <form action="{{ route('admin.restoreArchiveLeads') }}"
                                                    id="restoreForm{{ $row->id }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="lead_id" value="{{ $row->id }}">
                                                    <a class="dropdown-item restoreLead" href="javascript:void(0)"
                                                        data-id="{{ $row->id }}"><i class="dw dw-refresh1"></i>
                                                        Restore</a>
                                                </form>

                                                <form action="{{ route('admin.deleteArchiveLeads') }}"
                                                    id="leadDelete{{ $row->id }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="lead_id" value="{{ $row->id }}">
                                                    <a class="dropdown-item leadDelete" data-id="{{ $row->id }}"
                                                        href="javascript:void(0)"><i class="dw dw-delete-3"></i>
                                                        Permanent Delete</a>
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
    </div>

@endsection
@push('script')
    <script>
        $('#archiveTable').DataTable();
        // Checkbox Selection
        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
        // Checkbox Selection End


        // Restore Single Lead
        $(document).on('click', '.restoreLead', function(e) {
            e.preventDefault();
            leadId = $(this).data('id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You restore this lead!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#restoreForm${leadId}`).submit()
                }
            })
        })
        // Restore Single Lead



          // Delete Single Lead
          $(document).on('click', '.leadDelete', function(e) {
            e.preventDefault();
            leadId = $(this).data('id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this lead!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#leadDelete${leadId}`).submit()
                }
            })
        })
        // Delete Single Lead
    </script>

@endpush
