@extends('layouts.dashboard.header')
@section('content')
<style type="text/css">
    input[type="number"]:okeh{background-color:red;}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Simulator</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Data</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Simulator</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Timbang</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <form action="{{url('data/simulator')}}">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <input type="number" name="umur" class="form-control form-control-solid " 
                                       placeholder="Umur Balita" value="{{$request->umur}}" required/>
                                &nbsp;
                                <input type="number" step="0.01" name="tb" class="form-control form-control-solid " 
                                       placeholder="Tb Balita" value="{{$request->tb}}" required/>
                                    &nbsp;
                                <input type="number" step="0.01" name="bb" class="form-control form-control-solid " 
                                       placeholder="Bb Balita" value="{{$request->bb}}" required/>
                                &nbsp;
                                <select class="form-control form-control-solid" 
                                        name="jenis_kelamin" id="jenis_kelamin" required>
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
                                &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-calculator"></i> Hitung Data Timbang</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body py-4">
                    <h2 align="center">Acuan Perhitungan</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <p align="center">Bobot Kriteria</p>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Kriteria</th>
                                                <th class="min-w-125px">Bobot</th>
                                                <th class="min-w-125px">Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>C1</td>
                                                <td>30</td>
                                                <td>Tinggi badan menurut umur dan gender</td>
                                            </tr>
                                            <tr>
                                                <td>C2</td>
                                                <td>40</td>
                                                <td>Berat badan menurut umur dan gender</td>
                                            </tr>
                                            <tr>
                                                <td>C3</td>
                                                <td>30</td>
                                                <td>Tinggi badan menurut berat badan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p align="center">Bobot Menentukan Sample</p>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2">Jenis</th>
                                                <th class="min-w-125px">Kriteria</th>
                                                <th class="min-w-125px">Bobot</th>
                                                <th class="min-w-125px">Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tinggi</td>
                                                <td>C1</td>
                                                <td>1</td>
                                                <td>Normal</td>
                                            </tr>
                                            <tr>
                                                <td>Tinggi</td>
                                                <td>C1</td>
                                                <td>0.75</td>
                                                <td>Tinggi</td>
                                            </tr>
                                            <tr>
                                                <td>Tinggi</td>
                                                <td>C1</td>
                                                <td>0.5</td>
                                                <td>Pendek</td>
                                            </tr>
                                            <tr>
                                                <td>Tinggi</td>
                                                <td>C1</td>
                                                <td>0.25</td>
                                                <td>Sangat Pendek</td>
                                            </tr>

                                             <tr>
                                                <td>Berat</td>
                                                <td>C2</td>
                                                <td>1</td>
                                                <td>Normal</td>
                                            </tr>
                                            <tr>
                                                <td>Berat</td>
                                                <td>C2</td>
                                                <td>0.75</td>
                                                <td>Obesitas</td>
                                            </tr>
                                            <tr>
                                                <td>Berat</td>
                                                <td>C2</td>
                                                <td>0.5</td>
                                                <td>Kurus</td>
                                            </tr>
                                            <tr>
                                                <td>Berat</td>
                                                <td>C2</td>
                                                <td>0.25</td>
                                                <td>Sangat Kurus</td>
                                            </tr>

                                             <tr>
                                                <td>BB/TB</td>
                                                <td>C3</td>
                                                <td>1</td>
                                                <td>Normal</td>
                                            </tr>
                                            <tr>
                                                <td>BB/TB</td>
                                                <td>C3</td>
                                                <td>0.75</td>
                                                <td>Lebih</td>
                                            </tr>
                                            <tr>
                                                <td>BB/TB</td>
                                                <td>C3</td>
                                                <td>0.5</td>
                                                <td>Kurang</td>
                                            </tr>
                                            <tr>
                                                <td>BB/TB</td>
                                                <td>C3</td>
                                                <td>0.25</td>
                                                <td>Sangat Kurang</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p align="center">Perankingan Data Benefit Gizi SAW</p>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Data</th>
                                                <th class="min-w-125px">Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>< 60</td>
                                                <td>Gizi Buruk</td>
                                            </tr>
                                            <tr>
                                                <td><= 69.9</td>
                                                <td>Gizi Kurang</td>
                                            </tr>
                                            <tr>
                                                <td><= 79.9</td>
                                                <td>Gizi Sedang</td>
                                            </tr>
                                            <tr>
                                                <td><= 100</td>
                                                <td>Gizi Baik</td>
                                            </tr>
                                            <tr>
                                                <td> > 100</td>
                                                <td>Gizi Lebih</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-4">
                    <h2 align="center">Hasil Perhitungan</h2>
                    @if(count($data) > 0)
                    <div class="row">
                        <div class="col-md-12">
                                <p align="center">Menentukan Range Alternatif dan Kriteria</p>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Type</th>
                                                <th class="min-w-125px">Range</th>
                                                <th class="min-w-125px">Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                               <td>
                                                   C1
                                               </td>
                                               <td>
                                                   {{str_replace('|',' sd ',$data['imp_c1'])}}
                                               </td>
                                               <td>
                                                   {{$data[0]}}
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   C2
                                               </td>
                                               <td>
                                                   {{str_replace('|',' sd ',$data['imp_c2'])}}
                                               </td>
                                               <td>
                                                   {{$data[1]}}
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   C3
                                               </td>
                                               <td>
                                                   {{str_replace('|',' sd ',$data['imp_c3'])}}
                                               </td>
                                               <td>
                                                   {{$data[2]}}
                                               </td>
                                           </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p align="center">
                                    TB & BB di golongkan secara sistem dengan data Kategori dan Ambang Batas serta Standar Antropometri Status Gizi Anak yang dapat dilihat di file ini 
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" style="cursor: pointer;"><b> Klik Disini</b></a> Dihalaman 14 - 42 Berdasarkan Umur dan Jenis Kelamin Anak
                                </p>
                            </div>
                    </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p align="center">Matriks Normalisasi</p>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">C1</th>
                                                <th class="min-w-125px">C2</th>
                                                <th class="min-w-125px">C3</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                               <td>
                                                   {{$data[0]}}
                                               </td>
                                               <td>
                                                   {{$data[1]}}
                                               </td>
                                               <td>
                                                   {{$data[2]}}
                                               </td>
                                           </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <p align="center">Hasil matriks Normalisasi</p>
                               
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">V1</th>
                                                <th class="min-w-125px">V2</th>
                                                <th class="min-w-125px">V3</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                               <td style="background-color: red;color: white;text-align: center;">
                                                   {{round($data['c1'])}}
                                               </td>
                                               <td style="background-color: yellow;color: black;text-align: center;">
                                                   {{round($data['c2'])}}
                                               </td>
                                               <td style="background-color: blue;color: white;text-align: center;">
                                                   {{round($data['c3'])}}
                                               </td>
                                           </tr>
                                        </tbody>
                                    </table>
                                </div>
                                 <p align="center">
                                    Per Kriteria / (MAX(Table Hasil Bobot Kriteria)) * Table Bobot Kriteria
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p align="center">Perangkingan Setiap Alternatif</p>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Hasil Kalkulasi Status Gizi</th>
                                                <th class="min-w-125px">Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="background-color: blue;color: white;text-align: center;">
                                                    {{round($data['saw'])}}
                                                </td>
                                                <td style="background-color: green;color: white;">
                                                    {{$data['status']}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p align="center">Table Benefit SAW dijumlah VI+V2+V3</p>
                            </div>
                        </div>
                    @else
                        <h4 align="center">Akan muncul ketika ada data</h4>
                    @endif
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kategori dan Ambang Batas serta Standar Antropometri Status Gizi Anak</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <embed src="{{url('acuan/standar_bobot.pdf')}}" frameborder="0" width="100%" height="600px">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scriptcustom')
<script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js" integrity="sha512-lDL6DD6x4foKuSTkRUKIMQJAoisDeojVPXknggl4fZWMr2/M/hMiKLs6sqUvxP/T2zXdrDMbLJ0/ru8QSZrnoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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