// Class definition
var et_list_waiting = function() {
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
                { orderable: false, targets: 6 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            handleDeleteRows();
        });
    }
    var handleSearchDatatableWaiting = () => {
        const filterSearch = document.querySelector('[data-list-waiting-filter="search"]');
              filterSearch.addEventListener('keyup', function(e) {
              datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function() {
            table = document.querySelector('#et_t_waiting');

            if (!table) {
                return;
            }

            initDatatable();
            handleSearchDatatableWaiting();
        }
    };
}();

var et_list_success = function() {
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
                { orderable: false, targets: 6 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            handleDeleteRows();
        });
    }

    var handleSearchDatatableSuccess = () => {
        const filterSearch = document.querySelector('[data-list-success-filter="search"]');
              filterSearch.addEventListener('keyup', function(e) {
              datatable.search(e.target.value).draw();
        });
    }
    // Public methods
    return {
        init: function() {
            table = document.querySelector('#et_t_success');

            if (!table) {
                return;
            }

            initDatatable();
            handleSearchDatatableSuccess();
        }
    };
}();


var et_list_failed = function() {
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
                { orderable: false, targets: 6 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            handleDeleteRows();
        });
    }

    var handleSearchDatatableFailed = () => {
        const filterSearch = document.querySelector('[data-list-failed-filter="search"]');
              filterSearch.addEventListener('keyup', function(e) {
              datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function() {
            table = document.querySelector('#et_t_failed');

            if (!table) {
                return;
            }

            initDatatable();
            handleSearchDatatableFailed();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    et_list_success.init();
    et_list_waiting.init();
    et_list_failed.init();
});