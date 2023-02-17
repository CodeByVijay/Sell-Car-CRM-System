@extends('partials.app')
@section('title', 'Dashboard')
@section('main-content')
    @push('style')
        <style>
            .table_box {
                border: 1px solid #edecec;
            }

            .table_box input {
                width: 17px;
                height: 17px;
            }

            select.status,
            select.assign_box,
            .show_page select {
                background-position: center right;
                border: none;
                background-color: transparent;
                padding: 5px;
                color: #777;
                border-bottom: 1px solid #999;
            }

            select.status:focus-visible,
            select.assign_box:focus-visible,
            .show_page select:focus-visible,
            .select_box select:focus-visible {
                outline: none;
            }

            thead.table_head {
                background: #edecec;
            }

            .table_box td,
            .table_box th {
                padding: 20px 15px;
                text-transform: uppercase;
            }

            a.vrm_box {
                color: #777;
                text-decoration: underline;
            }

            a.vrm_box:hover {
                color: #680089;
            }

            .table_box th {
                text-transform: uppercase;
                color: #333;
            }

            .table_box td {
                color: #777;
            }

            .table_main {
                margin-top: 50px;
                margin-bottom: 50px;
            }

            .table_body tr:nth-child(even) {
                background: #edecec;
            }

            p.actions i {
                color: #680089;
                font-size: 13px;
            }

            p.actions a {
                border: 1px solid #680089;
                color: #680089;
                display: inline-block;
                padding: 3px 8px;
                border-radius: 5px;
                margin: 2px;
            }

            p.actions a:hover {
                background: #680089;
            }

            p.actions a:hover i {
                color: #fff;
            }

            .top_search_box {
                display: flex;
                justify-content: space-between;
            }

            .show_page select,
            .select_box select,
            .select_box input {
                width: 100%;
                border: none;
                background-color: transparent;
                border-bottom: 1px solid #ddd;
                padding: .75em .75em .75em 0;
                color: #000;
                margin-bottom: 5px;
                background-position: center right;

            }

            .search_box button {
                position: absolute;
                right: 0;
                background: none;
                width: auto;
                height: auto;
                box-shadow: none;
                padding: .75em;
                color: #000;
            }

            .search_box input {
                color: #000;
                border: none;
                background: transparent;
                border-bottom: 1px solid #ddd;
                padding-left: 0;
            }

            .search_box {
                position: relative;
            }

            .span_label {
                color: #680089;
                font-size: 13px;
            }

            .search_box_main {
                margin-top: 35px;
            }

            .select_box {
                padding-right: 10px;
            }

            section.search_box_main .row {
                margin-bottom: 15px;
            }

            .select_box input {
                padding-right: 0;
            }

            p.actions {
                text-align: right;
                max-width: 100px;
            }

            .tab_section ul li a.active,
            .tab_section ul li a:hover {
                color: #680089;
            }

            .tab_section ul li a.active:after,
            .tab_section ul li a:hover:after {
                opacity: 1;
                background: #680089;
            }

            .tab_section ul li a:after {
                position: absolute;
                width: 100%;
                height: 3px;
                opacity: 0;
                background: #000;
                content: '';
                left: 0;
                bottom: -5px;
            }

            .select_box input:focus-visible {
                outline: none;
            }

            td.action_box select {
                display: none;
                background-color: transparent;
                background-position: 25px center;
                padding: 4px 10px;
                border: 1px solid #680089;
                border-radius: 5px;
                margin: 2px;
                color: #680089;
                width: 45px;
                background-image: url('https://dorksd10.sg-host.com/wp-content/uploads/2023/02/down_arrow-removebg-preview.png');
                float: right;
            }

            .tab_section ul li a span {
                font-weight: bold;
                margin-left: 5px;
            }

            td.action_box select:focus-visible {
                outline: none;
            }

            .search_box input:focus-visible {
                outline: none;
            }

            .create_btn,
            .filter_btn {
                text-align: right;
                margin-top: 30px;
            }


            .filter_btn button {
                box-shadow: none;
                background: #1302ff;
                color: #fff;
                text-align: center;
                font-weight: 600;
                width: 25%;
                padding: 15px 0;
                border: none;
                border-radius: 30px;
            }

            .create_btn button {
                box-shadow: none;
                background: #680089;
                color: #fff;
                text-align: center;
                font-weight: 600;
                width: 100%;
                padding: 15px 0;
                border: none;
                border-radius: 30px;
            }

            .create_btn {
                text-align: right;
                margin-top: 30px;
                max-width: 310px;
                float: right;
                width: 100%;
            }

            .tab_section ul {
                padding: 0;
                list-style: none;
                margin: 0;
                display: flex;
                gap: 40px;
                width: 100%;
            }

            .tab_section ul li a {
                color: #000;
                text-decoration: none;
                width: max-content;
                position: relative;
                display: flex;
            }

            section.tab_section_main {
                margin-top: 45px;
            }

            .tab_section {
                display: flex;
                overflow-x: scroll;
                padding-bottom: 25px;
            }

            .tab_section ul li {
                width: max-content;
            }

            @media screen and (max-width: 767px) {
                section.search_box_main .col-md-2 {
                    margin-bottom: 10px;
                }

                .top_search_box {
                    flex-wrap: wrap;
                }

                .search_box,
                .search_box input,
                .show_page {
                    width: 100%;
                }

                .select_box {
                    padding-right: 0;
                }
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">2020</div>
                        <div class="weight-600 font-14">Contact</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart2"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">400</div>
                        <div class="weight-600 font-14">Deals</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart3"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">350</div>
                        <div class="weight-600 font-14">Campaign</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart4"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">$6060</div>
                        <div class="weight-600 font-14">Worth</div>
                    </div>
                </div>
            </div>
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
                    {{-- <div class="row">
                <div class="col-md-12">
                    <div class="top_search_box">
                        <div class="search_box">

                            <input type="text" placeholder="Search" name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>

                        </div>
                        <div class="show_page">
                            <select>
                                <option>Show per page</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                            </select>
                            <span class="span_label">Show Per Page</span>
                        </div>
                    </div>
                    </div>
                    </div> --}}
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
                        <button type="submit">Create valuation</button>
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
                                <li class="filterOpTab"><a href="javascript:void(0)" data-option='dealt-needs-delivery'
                                        class="filterTab">Dealt-Needs
                                        Delivery<span></span></a></li>
                                <li class="filterOpTab"><a href="javascript:void(0)" data-option='delivery-arranged'
                                        class="filterTab">Delivery
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
                            {{-- <div class="pd-20">
                        <h4 class="text-blue h4">Data Table with Checckbox select</h4>
                            </div> --}}
            <div class="pt-20 pb-20 table-responsive">
                <table class="checkbox-datatable table nowrap filterDataTable" id="valuationTable">
                    <thead>
                        <tr>
                            <th>
                                <div class="dt-checkbox">
                                    <input type="checkbox" name="select_all" value="1" id="master">
                                    <span class="dt-checkbox-label"></span>
                                </div>
                            </th>
                            <th>Set Status</th>
                            <th>Assign to</th>
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

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Search Option Hide Show
            $('.search_box_main').hide();
            $('#searchOptions').click(function() {
                $('.search_box_main').toggle('slow');
            })
            // Search Option Hide ShowEnd

            // Checkbox Selection
            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });
            // Checkbox Selection End

        });
        let table = '#valuationTable';

        $('.filterTab').click(function() {
            $('.filterTab').removeClass('active');
            $('.filterOpTab a span').html('')
            let option = $(this).data('option')
            $(this).addClass('active')
            let tbl = $('.filterDataTable').attr('id', option)
            table = `#${option}`;
            loadData(option, table);
        })

        let filterOptionData = 'all';
        loadData(filterOptionData, table);

        function loadData(filterOption, table) {
            let dataTable = $(`${table}`)
            $.ajax({
                type: "post",
                url: "{{ route('admin.loadData') }}",
                data: {
                    "option": filterOption
                },
                success: function(response) {
                    // console.log(response)
                    $('#table_body').empty();
                    if (response.msg === 'success' && response.data !== null) {
                        $.each(response.data, function(key, value) {
                            $('#table_body').append(`<tr>
                                                <td><div class="dt-checkbox">
                                    <input type="checkbox" name="select_all" value="1" class="sub_chk">
                                    <span class="dt-checkbox-label"></span></div></td>
                                                <td>
                                                    <select class="status">
                                                        <option>Set status</option>
                                                        <option>Pending</option>
                                                        <option>In progress</option>
                                                        <option>Accepted</option>
                                                        <option>Undecided</option>
                                                        <option>Dealt-Needs Delivery</option>
                                                        <option>Delivery Arranged</option>
                                                        <option>Delivered</option>
                                                        <option>Declined</option>
                                                        <option>Cancelled</option>
                                                        <option>Offer made</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="assign_box">
                                                        <option>Assign to</option>
                                                        <option>Lounds, Chris</option>
                                                        <option>Judd, Steve</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="https://dorksd10.sg-host.com/crm/details.php?vrm=${value.registration}" class="vrm_box"><span class="vrm">${value.registration}</span></a>
                                                </td>
                                                <td><span class="cust_name">${value.full_name}</span></td>
                                                <td><span class="make">${value.make}</span></td>
                                                <td><span class="postcode">${value.postcode}</span></td>
                                                <td><span class="tags">-</span></td>
                                                <td class="action_box">
                                                    <p class="actions">
                                                        <a href="#"><i class="fa fa-paper-plane-o"></i></a>
                                                        <a href="https://dorksd10.sg-host.com/crm/details.php?vrm=${value.registration}"><i class='fa fa-arrow-right'></i></a>
                                                        <select>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                        </select>
                                                    </p>
                                                </td>
                                            </tr>`);
                        })
                    } else {
                        $('#table_body').append(
                            `<tr><td colspan="9" class="text-center"><span>No Data Found.</span></td></tr>`);
                    }
                    $('.filterOpTab .active span').html(`(${response.count})`)


                    dataTable.DataTable({
                        'scrollCollapse': true,
                        'autoWidth': false,
                        // 'responsive': true,
                        "retrieve": true,
                        "lengthMenu": [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        "language": {
                            "info": "_START_-_END_ of _TOTAL_ entries",
                            searchPlaceholder: "Search",
                            paginate: {
                                next: '<i class="ion-chevron-right"></i>',
                                previous: '<i class="ion-chevron-left"></i>'
                            }
                        },
                        'columnDefs': [{
                            'targets': 0,
                            'searchable': false,
                            'orderable': false,
                            'className': 'dt-body-center',
                        }],
                        'order': [
                            [1, 'asc']
                        ]
                    });
                }
            });
        }
    </script>
@endpush
