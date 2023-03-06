@extends('partials.app')
@section('title', 'All Leads')
@section('main-content')
    @push('style')
        <link rel="stylesheet" href="{{ asset('admin/custom/css/lead.css') }}">
    @endpush
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>All Leads</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Leads</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">All Valuation Leads</h4>
                    <p class="mb-30">Leads</p>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                <div class="container">
                    <div id="searchHideShow">
                        <button type="button" id="searchOptions" class="btn btn-primary">Search Options</button>
                    </div>
                </div>

                <section class="search_box_main">
                    <form action="">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>All</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                        <span class="span_label">Offer Type</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>All</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                        <span class="span_label">Offer Type</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <input type="date" name="date" placeholder="From">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <input type="date" name="date" placeholder="To">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>Min.price</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>Max.price</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>Assigned To</option>
                                            <option>Chris Lounds</option>
                                            <option>Steve Judd</option>
                                            <option>Unassigned</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>Tags</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>Collection Preference</option>
                                            <option>No Preference</option>
                                            <option>Customer Specified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>No</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                        <span class="span_label">Archived</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>All</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                        <span class="span_label">Expired</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="select_box">
                                        <select>
                                            <option>No</option>
                                            <option>For Sale Trade</option>
                                            <option>For sale Retail</option>
                                        </select>
                                        <span class="span_label">Purchased</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="filter_btn">
                                        <button type="submit">Filter Valuation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>

                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="create_btn">
                                <button type="button">Create valuation</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="tab_section_main py-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab_section">
                                    <ul>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option="all"
                                                class="active filterTab">All
                                                Valuations<span id="allValuationCount"></span></a>
                                        </li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='pending'
                                                class="filterTab">Pending<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='in-progress'
                                                class="filterTab">In
                                                Progress<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='offer-made'
                                                class="filterTab">Offer
                                                Made<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='accepted'
                                                class="filterTab">Accepted<span></span></a>
                                        </li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='undecided'
                                                class="filterTab">Undecided<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='declined'
                                                class="filterTab">Declined<span></span></a>
                                        </li>
                                        <li class="filterOpTab"><a href="javascript:void(0)"
                                                data-option='dealt-needs-delivery' class="filterTab">Dealt-Needs
                                                Delivery<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)"
                                                data-option='delivery-arranged' class="filterTab">Delivery
                                                Arranged<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='delivered'
                                                class="filterTab">Delivered<span></span></a></li>
                                        <li class="filterOpTab"><a href="javascript:void(0)" data-option='cancelled'
                                                class="filterTab">Cancelled<span></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="card-box mb-30">

                    <div class="container text-right" id="changeStatusBtnDiv">
                        <div class="btn mt-4">
                            <button class="btn btn-success btn-sm changeLeadStatus"><i class="fa fa-hourglass-start"></i> Change Status Selected Leads </button>

                        </div>
                    </div>

                    <div class="pt-20 pb-20 table-responsive">
                        <table class="checkbox-datatable table nowrap filterDataTable table-hover" id="valuationTable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="dt-checkbox">
                                            <input type="checkbox" name="select_all" value="1" id="master">
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th>Set Status</th>
                                    <th>VRM</th>
                                    <th>Customer Name</th>
                                    <th>Make</th>
                                    <th>Postcode</th>
                                    <th>Tags</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            {{-- Status Model Form --}}
            <div class="modal fade" id="statusDataModel" tabindex="-1" aria-labelledby="statusDataModelLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusDataModelLabel">Change Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="status_List" class="col-form-label">Status List:</label>
                                    <select name="employee" class="form-control" id="status_List">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="in-progress">In Progress</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="undecided">Undecided</option>
                                        <option value="dealt-needs-delivery">Dealt-Needs Delivery</option>
                                        <option value="delivery-arranged">Delivery Arranged</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="declined">Declined</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="offer-made">Offer made</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="changeLeadStatus">Change Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Status Model Form End --}}

        @endsection
        @push('script')
            <script src="{{ asset('admin/custom/js/empLeads.js') }}"></script>
        @endpush
