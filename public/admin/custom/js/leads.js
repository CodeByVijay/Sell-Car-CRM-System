$(document).ready(function () {
    // Search Option Hide Show
    $('.search_box_main').hide();
    $('#searchOptions').click(function () {
        $('.search_box_main').toggle('slow');
    })
    // Search Option Hide ShowEnd

    // Checkbox Selection
    $('#master').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    // Checkbox Selection End

});

// Load Data Code
let table = '#valuationTable';

$('.filterTab').click(function () {
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
        url: "/admin/get-valuation-data",
        data: {
            "option": filterOption
        },
        success: function (response) {
            // console.log(response)
            $('#table_body').empty();

            if (response.msg === 'success' && response.data !== null) {

                $.each(response.data, function (key, value) {

                    $('#table_body').append(`<tr id="${value.id}">
                                        <td><div class="dt-checkbox">
                            <input type="checkbox" data-id="${value.id}" class="sub_chk">
                            <span class="dt-checkbox-label"></span></div></td>
                                        <td>
                                            <select class="status" id="setStatus" data-id="${value.id}">
                                                <option value="">Set status</option>
                                                <option value="pending" ${value.status == 'pending' ? 'selected' : ''}>Pending</option>
                                                <option value="in-progress" ${value.status == 'in-progress' ? 'selected' : ''}>In Progress</option>
                                                <option value="accepted" ${value.status == 'accepted' ? 'selected' : ''}>Accepted</option>
                                                <option value="undecided" ${value.status == 'undecided' ? 'selected' : ''}>Undecided</option>
                                                <option value="dealt-needs-delivery" ${value.status == 'dealt-needs-delivery' ? 'selected' : ''}>Dealt-Needs Delivery</option>
                                                <option value="delivery-arranged" ${value.status == 'delivery-arranged' ? 'selected' : ''}>Delivery Arranged</option>
                                                <option value="delivered" ${value.status == 'delivered' ? 'selected' : ''}>Delivered</option>
                                                <option value="declined" ${value.status == 'declined' ? 'selected' : ''}>Declined</option>
                                                <option value="cancelled" ${value.status == 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                                <option value="offer-made" ${value.status == 'offer-made' ? 'selected' : ''}>Offer made</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)">${value.assign_to !== null ? '<div class="btn-group-sm assignTochange" data-id="' + value.assign_to + '" data-lead="' + value.id + '"><button type="button" class="btn btn-success">' + value.emp_title + " " + value.emp_name + '</button><button type="button" class="btn btn-info"><i class="fa fa-refresh" aria-hidden="true"></i></button></div>' : '<button type="button" class="btn btn-info btn-sm assignTochange" data-id="" data-lead="' + value.id + '">Assign To <i class="fa fa-refresh" aria-hidden="true"></i></button>'}</a>
                                        </td>
                                        <td>
                                            <a href="https://dorksd10.sg-host.com/crm/details.php?vrm=${value.registration}" class="vrm_box"><span class="vrm">${value.registration}</span></a>
                                        </td>
                                        <td><span class="cust_name">${value.full_name}</span></td>
                                        <td><span class="make">${value.make}</span></td>
                                        <td><span class="postcode">${value.postcode}</span></td>
                                        <td><span class="tags">-</span></td>
                                        <td class="action_box">

                                        <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i>
                                                View</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i>
                                                Edit</a>


                                                <a class="dropdown-item leadDelete" data-id="${value.id}" href="javascript:void(0)"><i
                                                        class="dw dw-delete-3"></i>
                                                    Delete</a>

                                        </div>
                                    </div>

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
// Load Data Code End

//Lead Status Change Code
$(document).on("change", "#setStatus", function () {
    let tr = $(this);
    let id = $(this).data('id');
    let status = $(this).val();
    let getTabOption = $('.filterOpTab .active').data('option')

    Swal.fire({
        title: 'Are you sure?',
        text: "You change status this lead!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/admin/change-valuation-status",
                data: { "valuation_id": id, "status": status },
                success: function (response) {
                    if (response.msg === 'success') {
                        tr.closest('tr').remove();
                        loadData(getTabOption, table);
                    }
                }
            });
        } else {
            loadData(getTabOption, table);
        }
    })
})
//Lead Status Change Code End

//Assign Employee
$(document).on('click', '.assignTochange', function () {
    let emp_id = $(this).data('id');
    let lead_id = $(this).data('lead');
    let model = $('#empDataModel');
    $('#employees_List').val(emp_id)
    $('#leadId').val(lead_id)
    model.modal('show')
})

$(document).on('click', '#assignLead', function () {
    var allLeads = [];
    $(".sub_chk:checked").each(function () {
        allLeads.push($(this).data('id'));
    });
    let getTabOption = $('.filterOpTab .active').data('option')

    let emp_id = $('#employees_List').val()
    let lead_id = $('#leadId').val()
    if (emp_id !== null) {
        $.ajax({
            type: "post",
            url: "/admin/employee-assign-lead",
            data: { "emp_id": emp_id, "lead_id": lead_id, "all_leads": allLeads },
            success: function (response) {
                if (response.msg === 'success') {
                    $('#empDataModel').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Leads has been assigned.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#master").prop('checked', false);
                    loadData(getTabOption, table);
                }
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select any one employee!',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    }
})
//Assign Employee End

// Assign Multiple leads Modal
$(document).on('click', '.multipleLeadAssign', function () {
    var allLeads = [];
    $(".sub_chk:checked").each(function () {
        allLeads.push($(this).data('id'));
    });
    if (allLeads.length > 0) {
        let model = $('#empDataModel');
        model.modal('show')
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select atleast one lead!',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    }
})
// Assign Multiple leads Modal End



// Multiple leads Delete
$(document).on('click', '.multipleLeadDelete', function () {
    let getTabOption = $('.filterOpTab .active').data('option')
    var allLeads = [];
    $(".sub_chk:checked").each(function () {
        allLeads.push($(this).data('id'));
    });
    if (allLeads.length > 0) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You archive seleceted leads!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, archived it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/admin/archive-lead",
                    data: { "leads": allLeads, },
                    success: function (response) {
                        if (response.msg === 'success') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Leads has been archived.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#master").prop('checked', false);
                            loadData(getTabOption, table);
                        }
                    }
                });
            } else {
                loadData(getTabOption, table);
            }
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select atleast one lead!',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    }
})
// Multiple leads Delete End

// Single Lead Delete
$(document).on('click', '.leadDelete', function () {
    let getTabOption = $('.filterOpTab .active').data('option')
    let lead_id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You archive this lead!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, archived it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/admin/archive-lead",
                data: { "lead_id": lead_id, },
                success: function (response) {
                    if (response.msg === 'success') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Lead has been archived.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        // tr.closest('tr').remove();
                        loadData(getTabOption, table);
                    }
                }
            });
        } else {
            loadData(getTabOption, table);
        }
    })

})

// Single Lead Delete End

