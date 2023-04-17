"use strict";

// Class definition
var reportTransaction = function() {
    // Shared variables
    var table;
    var datatable;
    var flatpickr;
    var minDate, maxDate;

    // Private functions
    var initDatatableTransaction = function() {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 8 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            //handleDeleteRows();
        });
    }

    // Init flatpickr --- more info :https://flatpickr.js.org/getting-started/
    var initFlatpickrTransaction = () => {
        const element = document.querySelector('#ft_r_date_rp_trsctn');
        flatpickr = $(element).flatpickr({
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                handleFlatpickrTransaction(selectedDates, dateStr, instance);
            },
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatableTransaction = () => {
        const filterSearch = document.querySelector('[ft_transaction="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            datatable.search(e.target.value).draw();
        });
    }


    // Filter Event
    var eventFilterTransactionReport = () => {
        const filterStatus = document.querySelector('[ft_transaction="c_eventTransaction"]');
        $(filterStatus).on('change', e => {
            let value = e.target.value;
            if (value === 'allevent') {
                value = '';
            }
            datatable.column(4).search(value).draw();
        });
    }


    // Hook export buttons
    var exportButtonsTransaction = () => {
        const documentTitle = 'Transaction Report';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                    extend: 'excelHtml5',
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle
                }
            ]
        }).container().appendTo($('#export_transaction'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#export_transaction_menu [data-exprt-Transaction]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-exprt-Transaction');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Handle flatpickr --- more info: https://flatpickr.js.org/events/
    var handleFlatpickrTransaction = (selectedDates, dateStr, instance) => {
        minDate = selectedDates[0] ? new Date(selectedDates[0]) : null;
        maxDate = selectedDates[1] ? new Date(selectedDates[1]) : null;

        // Datatable date filter --- more info: https://datatables.net/extensions/datetime/examples/integration/datatables.html
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate;
                var max = maxDate;
                var dateAdded = new Date(moment($(data[9]).text(), 'DD/MM/YYYY'));
                var dateModified = new Date(moment($(data[10]).text(), 'DD/MM/YYYY'));

                if (
                    (min === null && max === null) ||
                    (min === null && max >= dateModified) ||
                    (min <= dateAdded && max === null) ||
                    (min <= dateAdded && max >= dateModified)
                ) {
                    return true;
                }
                return false;
            }
        );
        datatable.draw();
    }

    // Handle clear flatpickr
    var handleClearFlatpickrTransaction = () => {
        const clearButton = document.querySelector('#f_rp_transaction_clear');
        clearButton.addEventListener('click', e => {
            flatpickr.clear();
        });
    }

    // Public methods
    return {
        init: function() {
            table = document.querySelector('#report_transaction');

            if (!table) {
                return;
            }

            initDatatableTransaction();
            initFlatpickrTransaction();
            exportButtonsTransaction();
            handleSearchDatatableTransaction();
            eventFilterTransactionReport();
            handleClearFlatpickrTransaction();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    reportTransaction.init();
});