"use strict";

// Class definition
var reportParticipant = function() {
    // Shared variables
    var table;
    var datatable;
    var flatpickr;
    var minDate, maxDate;

    // Private functions
    var initDatatableParticipant = function() {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10
            // 'columnDefs': [
            //     { orderable: false, targets: 1 }, // Disable ordering on column 0 (checkbox)
            //     { orderable: false, targets: 9 }, // Disable ordering on column 7 (actions)
            // ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function() {
            //handleDeleteRows();
        });
    }

    // Init flatpickr --- more info :https://flatpickr.js.org/getting-started/
    var initFlatpickrParticipant = () => {
        const element = document.querySelector('#ft_r_date_rp_prtcpnt');
        flatpickr = $(element).flatpickr({
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                handleFlatpickrParticipant(selectedDates, dateStr, instance);
            },
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatableParticipant = () => {
        const filterSearch = document.querySelector('[ft_participant="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            datatable.search(e.target.value).draw();
        });
    }

    //Handle status filter dropdown
    var professionFilter = () => {
        const filterStatus = document.querySelector('[ft_participant="s_e_participant"]');
        $(filterStatus).on('change', e => {
            let value = e.target.value;
            if (value === 'all-event') {
                value = '';
            }
            datatable.column(7).search(value).draw();
        });
    }

    // Filter Location
    // var locationFilter = () => {
    //     const filterStatus = document.querySelector('[ft_participant="c_location"]');
    //     $(filterStatus).on('change', e => {
    //         let value = e.target.value;
    //         if (value === 'all-location') {
    //             value = '';
    //         }
    //         datatable.column(8).search(value).draw();
    //     });
    // }

    // Hook export buttons
    var exportButtonsParticipant = () => {
        const documentTitle = 'Participant Report';
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
        }).container().appendTo($('#export_participant'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#export_participant_menu [data-exprt-participant]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-exprt-participant');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Handle flatpickr --- more info: https://flatpickr.js.org/events/
    var handleFlatpickrParticipant = (selectedDates, dateStr, instance) => {
        minDate = selectedDates[0] ? new Date(selectedDates[0]) : null;
        maxDate = selectedDates[1] ? new Date(selectedDates[1]) : null;

        // Datatable date filter --- more info: https://datatables.net/extensions/datetime/examples/integration/datatables.html
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate;
                var max = maxDate;
                var dateAdded = new Date(moment($(data[3]).text(), 'DD/MM/YYYY'));
                var dateModified = new Date(moment($(data[4]).text(), 'DD/MM/YYYY'));

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
    var handleClearFlatpickrParticipant = () => {
        const clearButton = document.querySelector('#f_rp_participant_clear');
        clearButton.addEventListener('click', e => {
            flatpickr.clear();
        });
    }

    // Public methods
    return {
        init: function() {
            table = document.querySelector('#report_participant');

            if (!table) {
                return;
            }

            initDatatableParticipant();
            initFlatpickrParticipant();
            exportButtonsParticipant();
            handleSearchDatatableParticipant();
            professionFilter();
            //locationFilter();
            handleClearFlatpickrParticipant();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    reportParticipant.init();
});