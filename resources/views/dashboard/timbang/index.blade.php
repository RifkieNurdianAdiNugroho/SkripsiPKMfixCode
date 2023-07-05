@extends('layouts.dashboard.header')
@section('content')
<style type="text/css">
    input[type="number"]:okeh{background-color:red;}
</style>
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
                                @if($role != 'bidan')
                                <select class="form-control form-control-solid" 
                                        name="bidan_id" id="bidan_id" onchange="getPosyandu(this.value)" required>
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
                                @if(Auth::user()->role == 'ahli_gizi' || Auth::user()->role == 'kapus')
                                <select class="form-control form-control-solid" name="pos_id" id="pos_id" required>
                                 @if($request->bidan_id != null)
                                    <option value="" selected disabled>
                                        Pilih Pos
                                    </option>
                                    @foreach($posyandu as $posyanduKey => $posyanduItem)
                                    <option value="{{$posyanduItem->id}}" 
                                            {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                        {{$posyanduItem->nama_pos}}
                                    </option>
                                    @endforeach
                                    @else
                                     <option value="" selected disabled>
                                        <small>(Pos) Pilih Bidan Terlebih Dahulu</small>
                                    </option>
                                    @endif
                                </select>
                                @else
                                 <select class="form-control form-control-solid" name="pos_id" required>
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
                                @endif
                                &nbsp;

                                
                                <select class="form-control form-control-solid" 
                                        name="jenis_kelamin" id="jenis_kelamin" >
                                    <option value="" selected disabled>
                                        Pilih Kelamin
                                    </option>
                                    <option value="L" {{$request->jenis_kelamin == 'L' ? 'selected':''}}>
                                        L
                                    </option>
                                    <option value="P" {{$request->jenis_kelamin == 'P' ? 'selected':''}}>
                                        P
                                    </option>
                                </select>
                                &nbsp;
                                
                                <input type="text" name="balita" class="form-control form-control-solid " 
                                       placeholder="Cari nama balita" value="{{$request->balita}}" />
                                &nbsp;
                                <input type="text" name="ortu" class="form-control form-control-solid " 
                                       placeholder="Cari nama ortu" value="{{$request->ortu}}"/>
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
                        @if(count($data) > 0)
                        <div class="d-flex align-items-center position-relative my-1">
                            @if($role == 'ahli_gizi' || $role == 'bidan')
                            <button class="btn btn-primary" name="save" value="0" type="submit" onclick="return confirm('Apakah yakin untuk menyimpan data?')">
                                Simpan Data Timbang &nbsp;<i class="fa fa-save"></i>
                            </button>
                            @endif
                            @if($role == 'ahli_gizi')
                            &nbsp;&nbsp;
                            <button class="btn btn-warning" name="hitung" value="1" type="submit" onclick="return confirm('Apakah yakin untuk menghitung data?')">
                                Hitung Data Timbang &nbsp;<i class="fa fa-calculator"></i>
                            </button>
                            
                            @endif
                            
                            &nbsp;&nbsp;
                            <a class="btn btn-success" href="{{url('data/jadwal/timbang/export')}}">
                                Export Data Timbang &nbsp;<i class="fa fa-file-excel"></i>
                            </a>
                           
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        @if(count($data) > 0)
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tr>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Pos & Bidan</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Anak</th>
                                <th colspan="2" rowspan="2" style="padding-top: 6%">Nama Ortu</th>
                                @if(isset($data['bulan']))
                                @foreach($data['bulan'] as $bulanKey => $bulanItem)
                                <th colspan="6" style="text-align: center;">{{$bulanItem}}</th>
                                @endforeach
                                
                                @endif
                               
                            </tr>
                            
                            <tr>
                                @if(isset($data['bulan']))
                                    @foreach($data['bulan'] as $bulanKey => $bulanItem)
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">Umur</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">TB</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">BB</th>
                                    <th colspan="2" style="text-align: center;padding-bottom: 2%;">Status Gizi</th>
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
                                    <td colspan="2">
                                        {{$balitaItem['pos']}}<br>
                                        (Bidan : {{$balitaItem['bidan']}})
                                    </td>
                                    <td colspan="2">
                                        {{$balitaItem['nama']}}<br>
                                        ({{$balitaItem['jenis_kelamin']}})
                                    </td>
                                    <td colspan="2">{{$balitaItem['ortu']}}</td>
                                    <input type="hidden" name="balita_id[]" value="{{$balitaItem['balita_id']}}">

                                     @foreach($data['bulan'] as $bulanKeyOne => $bulanItemOne)
                                    <td colspan="2">
                                        <input type="number" name="umur[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" readonly value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['umur']}}" 
                                        class="form-control form-control-solid umur">
                                    </td>
                                   
                                    <td colspan="2">
                                    @if($data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['umur'] >= 60)
                                     <input type="number" step="0.01" name="tb[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" 
                                    {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['input']}}
                                    value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['tb']}}"
                                        class="form-control form-control-solid tb" style="background-color: red;">
                                    @else
                                     <input type="number" step="0.01" name="tb[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" 
                                    {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['input']}}
                                    value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['tb']}}"
                                        class="form-control form-control-solid tb" >
                                    @endif
                                   
                                    </td>
                                    <td colspan="2">
                                        @if($data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['umur'] >= 60)
                                        <input type="number" step="0.01" name="bb[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" 
                                        {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['input']}}
                                        value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['bb']}}"
                                        class="form-control form-control-solid bb" style="background-color: red;">
                                        @else
                                        <input type="number" step="0.01" name="bb[{{$balitaItem['balita_id']}}][{{$data['jadwal'][$bulanKeyOne]['jadwal_id']}}]" 
                                        {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['input']}}
                                        value="{{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['bb']}}"
                                        class="form-control form-control-solid bb">
                                        @endif
                                    </td>
                                    <td colspan="2">
                                        {{$data['hasil'][$data['jadwal'][$bulanKeyOne]['jadwal_id']][$balitaKey]['status_gizi']}}
                                    </td>
                                    @endforeach
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

    function getPosyandu(val) {
        $.ajax({
                type: 'get',
                url: "{{url('/user/bidan/posyandu')}}"+"/"+ val,
                dataType: 'json',
                success: function (data) {
                    var temp = [];
                    $.each(data, function (key, value) {
                        temp.push({
                            v: value,
                            k: key
                        });
                    });

                    var x = document.getElementById("pos_id");
                    $('#pos_id').empty();
                    var opt_head = document.createElement('option');
                    opt_head.text = 'Pilih Pos';
                    opt_head.value = '0';
                    opt_head.disabled = true;
                    opt_head.selected = true;
                    x.appendChild(opt_head);
                    for (var i = 0; i < temp[0].v.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = temp[0].v[i].id;
                        opt.text = temp[0].v[i].nama_pos;
                        x.appendChild(opt);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
       }
</script>
@endsection