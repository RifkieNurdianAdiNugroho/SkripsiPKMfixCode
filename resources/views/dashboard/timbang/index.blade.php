@extends('layouts.dashboard.header')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Data Timbang</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Data</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Timbang</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Pos</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Pos" />
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tr>
                                <th colspan="2" rowspan="2">Nama Posyandu</th>
                                <th colspan="2" rowspan="2">Nama Anak</th>
                                <th colspan="2" rowspan="2">Nama Ortu</th>
                                <th colspan="6" style="text-align: center;">Mei</th>
                                <th colspan="6" style="text-align: center;">Juni</th>
                                <th colspan="6" style="text-align: center;">Agustus</th>
                            </tr>

                            <tr>
                                <th colspan="2" style="text-align: center;">Umur</th>
                                <th colspan="2" style="text-align: center;">TB</th>
                                <th colspan="2" style="text-align: center;">BB</th>

                                <th colspan="2" style="text-align: center;">Umur</th>
                                <th colspan="2" style="text-align: center;">TB</th>
                                <th colspan="2" style="text-align: center;">BB</th>

                                <th colspan="2" style="text-align: center;">Umur</th>
                                <th colspan="2" style="text-align: center;">TB</th>
                                <th colspan="2" style="text-align: center;">BB</th>
                            </tr>

                            <tr>
                                <td colspan="2">Klobuk Wetan</td>
                                <td colspan="2">Bani</td>
                                <td colspan="2">Khairy</td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>


                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>

                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Klobuk Wetan</td>
                                <td colspan="2">Karmila</td>
                                <td colspan="2">Khairy</td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>

                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>

                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control form-control-solid">
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptcustom')
<script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>
<script type="text/javascript">
    "use strict";

    // Class definition
    var crmList = function() {
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
                'columnDefs': [{
                        orderable: false,
                        targets: 0
                    }, // Disable ordering on column 0 (checkbox)
                    {
                        orderable: false,
                        targets: 4
                    }, // Disable ordering on column 4 (actions)
                ]
            });

            // Re-init functions on datatable re-draws
            datatable.on('draw', function() {
                // handleDeleteRows();
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Handle status filter dropdown
        var handleStatusFilter = () => {
            const filterStatus = document.querySelector('[data-kt-user-table-filter="status"]');
            $(filterStatus).on('change', e => {
                let value = e.target.value;
                if (value === 'all') {
                    value = '';
                }
                datatable.column(1).search(value).draw();
            });
        }


        // Delete cateogry



        // Public methods
        return {
            init: function() {
                table = document.querySelector('#kt_crm_table');

                if (!table) {
                    return;
                }

                initDatatable();
                handleSearchDatatable();
                handleStatusFilter();

            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        crmList.init();
    });
</script>
@endsection