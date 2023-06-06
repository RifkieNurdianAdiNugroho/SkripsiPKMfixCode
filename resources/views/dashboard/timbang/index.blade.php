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
                    <form action="{{url('data/jadwal/timbang')}}">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <input type="text" name="balita" class="form-control form-control-solid " 
                                   placeholder="Cari nama balita" value="{{$request->balita}}" />
                            &nbsp;
                            <input type="text" name="ortu" class="form-control form-control-solid " 
                                   placeholder="Cari nama ortu" value="{{$request->ortu}}"/>
                            &nbsp;
                            @if($role != 'bidan')
                            <select class="form-control form-control-solid" name="bidan_id">
                                <option value="" selected disabled>
                                    Pilih Bidan
                                </option>
                                @foreach($bidan as $bidanKey => $bidanIitem)
                                <option value="{{$bidanIitem->id}}" 
                                        {{$request->bidan_id == $bidanIitem->id ? 'selected':''}}>
                                    {{$bidanIitem->nama}}
                                </option>
                                @endforeach
                            </select>
                            &nbsp;
                            @endif
                             <select class="form-control form-control-solid" name="pos_id">
                                <option value="" selected disabled>
                                    Pilih Pos
                                </option>
                                @foreach($posyandu as $posyanduKey => $posyanduItem)
                                <option value="{{$posyanduItem->id}}" 
                                        {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                    {{$posyanduItem->nama_pos}}
                                </option>
                                @endforeach
                            </select>
                            &nbsp;
                            <input type="month" name="start_month" value="{{$request->start_month}}" class="form-control form-control-solid" />
                            &nbsp;
                            <input type="month" name="end_month" value="{{$request->end_month}}" class="form-control form-control-solid" />
                            &nbsp;
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    </form>
                    <form action="{{url('data/jadwal/timbang/store')}}" method="POST">
                    @csrf
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <button class="btn btn-success" name="save" type="submit" onclick="return confirm('Apakah yakin untuk menyimpan data?')">
                                <i class="fa fa-save"></i>
                            </button>
                            &nbsp;
                            <button class="btn btn-warning" name="hitung" type="submit" onclick="return confirm('Apakah yakin untuk menghitung data?')">
                                <i class="fa fa-calculator"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        @if(count($data) > 0)
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tr>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Posyandu</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Anak</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Ortu</th>
                                @if(isset($data['bulan']))
                                @foreach($data['bulan'] as $bulanKey => $bulanItem)
                                <th colspan="6" style="text-align: center;">{{$bulanItem}}</th>
                                @endforeach
                                @endif
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Status Gizi</th>
                            </tr>
                            
                            <tr>
                                @if(isset($data['bulan']))
                                    @foreach($data['bulan'] as $bulanKey => $bulanItem)
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">Umur</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">TB</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">BB</th>
                                   
                                    <input type="hidden" name="pos_id" 
                                           value="{{$data['jadwal'][$bulanKey]['jadwal_id']}}">
                                    <input type="hidden" name="bidan_id" 
                                           value="{{$data['jadwal'][$bulanKey]['bidan_id']}}">
                                    <input type="hidden" name="jadwal_id[]" 
                                           value="{{$data['jadwal'][$bulanKey]['jadwal_id']}}">
                                    @endforeach
                                @endif
                            </tr>
                                @if(isset($data['balita']))
                                @foreach($data['balita'] as $balitaKey => $balitaItem)
                                <tr>    
                                    <td colspan="2">{{$balitaItem['pos']}}</td>
                                    <td colspan="2">{{$balitaItem['nama']}}</td>
                                    <td colspan="2">{{$balitaItem['ortu']}}</td>
                                    <input type="hidden" name="balita_id[]" value="{{$balitaItem['balita_id']}}">

                                     @foreach($data['bulan'] as $bulanKeyOne => $bulanItemOne)
                                    <td colspan="2">
                                        <input type="number" name="umur[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" readonly value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['umur']}}" 
                                        class="form-control form-control-solid umur">
                                    </td>
                                   
                                    <td colspan="2">
                                    <input type="number" name="tb[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" 
 
                                    value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['tb']}}"
                                        class="form-control form-control-solid tb">
                                    </td>
                                    <td colspan="2">
                                        <input type="number" name="bb[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" 
                                        value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['bb']}}"
                                        class="form-control form-control-solid bb">
                                    </td>
                                    @endforeach
                                    <td colspan="2">
                                        {{$balitaItem['status_gizi']}}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                        </table>
                        @else
                        <p align="center">
                            Data belum ada
                        </p>
                        @endif
                    </div>
                </div>
            </form>
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
            const filterSearch = document.querySelector('[]');
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