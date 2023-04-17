"use strict";

// Class definition
var userAdministrator = function() {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatableAdministrator = function() {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
               // { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                //{ orderable: false, targets: 4 }, // Disable ordering on column 4 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            handleDeleteRowsAdministrator();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatableUsrAdministrator = () => {
        const filterSearch = document.querySelector('[data-list-usr_admn-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Delete cateogry



    // Public methods
    return {
        init: function() {
            table = document.querySelector('#t_user_administrator');

            if (!table) {
                return;
            }

            initDatatableAdministrator();
            //handleSearchDatatableUsrAdministrator();
            handleDeleteRowsAdministrator();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    userAdministrator.init();
});