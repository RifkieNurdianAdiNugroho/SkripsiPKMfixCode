// Class definition
var t_list_discount = function() {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatableDiscount = function() {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 6 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            delRowDiscount();
        });
    }


    // Delete cateogry
    var delRowDiscount = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data_filter_discount="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function(e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get category name
                const discountID = parent.querySelector('[data_filter_discount="event_name"]').innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete order: " + discountID + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + discountID + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function() {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: orderID + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var searchDataDiscount = () => {
        const filterSearch = document.querySelector('[ft-l-discount-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function() {
            table = document.querySelector('#t_discount');

            if (!table) {
                return;
            }

            initDatatableDiscount();
            delRowDiscount();
            searchDataDiscount();
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function() {
    t_list_discount.init();

});


$(document).ready(function() {
    // Status
    let statusDiscount = $("input[name='statusDiscount']");
    toggle();
    $("#statusDiscount").click(function() {
        toggle();
    });

    function toggle() {
        if (statusDiscount.prop("checked")) {
            statusDiscount.val(1);
            $('#enbl_s_d_text').removeClass("d-none");
            $('#dsbl_s_d_text').addClass("d-none");

        } else {
            statusDiscount.val(0);
            $('#enbl_s_d_text').addClass("d-none");
            $('#dsbl_s_d_text').removeClass("d-none");
        }
    }
    // End
});


$(document).ready(function() {
    // Status
    let statusDiscountEdit = $("input[name='statusEditDiscount']");
    toggle();
    $("#statusEditDiscount").click(function() {
        toggle();
    });

    function toggle() {
        if (statusDiscountEdit.prop("checked")) {
            statusDiscountEdit.val(1);
            $('#enbl_s_d_text_edit').removeClass("d-none");
            $('#dsbl_s_d_text_edit').addClass("d-none");

        } else {
            statusDiscountEdit.val(0);
            $('#enbl_s_d_text_edit').addClass("d-none");
            $('#dsbl_s_d_text_edit').removeClass("d-none");
        }
    }
    // End
});