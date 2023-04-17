// Class definition
var t_list_promo = function() {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function() {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 5 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            delRowPromo();
        });
    }


    // Delete cateogry
    var delRowPromo = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data_filter_promo="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function(e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get category name
                const promoID = parent.querySelector('[data_filter_promo="event_name"]').innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete order: " + promoID + "?",
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
                            text: "You have deleted " + promoID + "!.",
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
    var searchDataPromo = () => {
        const filterSearch = document.querySelector('[ft-l-promo-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function() {
            table = document.querySelector('#t_promo');

            if (!table) {
                return;
            }

            initDatatable();
            delRowPromo();
            searchDataPromo();
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function() {
    t_list_promo.init();

});


$(document).ready(function() {
    // Status
    let statusPromo = $("input[name='statusPromo']");
    toggle();
    $("#statusPromo").click(function() {
        toggle();
    });

    function toggle() {
        if (statusPromo.prop("checked")) {
            statusPromo.val(1);
            $('#enbl_s_p_text').removeClass("d-none");
            $('#dsbl_s_p_text').addClass("d-none");

        } else {
            statusPromo.val(0);
            $('#enbl_s_p_text').addClass("d-none");
            $('#dsbl_s_p_text').removeClass("d-none");
        }
    }
    // End
});


$(document).ready(function() {
    // Status
    let statusPromoEdit = $("input[name='statusPromoEdit']");
    toggle();
    $("#statusPromoEdit").click(function() {
        toggle();
    });

    function toggle() {
        if (statusPromoEdit.prop("checked")) {
            statusPromoEdit.val(1);
            $('#enbl_s_p_text_edit').removeClass("d-none");
            $('#dsbl_s_p_text_edit').addClass("d-none");

        } else {
            statusPromoEdit.val(0);
            $('#enbl_s_p_text_edit').addClass("d-none");
            $('#dsbl_s_p_text_edit').removeClass("d-none");
        }
    }
    // End
});