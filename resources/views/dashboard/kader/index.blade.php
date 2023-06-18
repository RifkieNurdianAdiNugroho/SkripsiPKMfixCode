@extends('layouts.dashboard.header')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Kader</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Data</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Data</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Kader</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card-header border-0 pt-6">
                        <form action="{{url('data/kader')}}">
                    <div class="card-title">
                       <div class="d-flex align-items-center position-relative my-1" align="right">
                             <input type="text" name="kader" class="form-control form-control-solid " 
                                   placeholder="Cari nama kader" value="{{$request->kader}}" />
                            &nbsp;
                           
                             <select class="form-control form-control-solid" 
                                     name="bidan_id" id="bidan_id" onchange="getPosyandu(this.value)">
                                @if(Auth::user()->role == 'ahli_gizi' || Auth::user()->role == 'kapus')
                                <option value="" selected disabled>
                                    Pilih Bidan
                                </option>
                                @endif
                                @foreach($bidan as $bidanKey => $bidanItem)
                                <option value="{{$bidanItem->id}}" 
                                        {{$request->bidan_id == $bidanItem->id ? 'selected':''}}>
                                    {{$bidanItem->nama}}
                                </option>
                                @endforeach
                            </select>
                            &nbsp;
                            @if(Auth::user()->role == 'ahli_gizi' || Auth::user()->role == 'kapus')
                            <select class="form-control form-control-solid" name="pos_id" id="pos_id">
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
                             <select class="form-control form-control-solid" name="pos_id">
                                        @foreach($posyandu as $posyanduKey => $posyanduItem)
                                        <option value="{{$posyanduItem->id}}" 
                                                {{$request->pos_id == $posyanduItem->id ? 'selected':''}}>
                                            {{$posyanduItem->nama_pos}}
                                        </option>
                                        @endforeach
                                    </select>
                            @endif
                            &nbsp;
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                       
                    </div>
                    </div>
                    </form>
                    </div>
                <div class="card">

                    <div class="card-header border-0 pt-6">
                        @if(Auth::user()->role == 'bidan')
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <a href="{{ url('/data/kader/create') }}" class="btn btn-primary">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    Tambah Data
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_crm_table">
                            <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">No</th>
                                    <th class="min-w-125px">Nama</th>
                                    <th class="min-w-125px">No Telepon</th>
                                    <th class="min-w-125px">Alamat</th>
                                    <th class="min-w-125px">Pos</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold">
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->no_tlp}}</td>
                                        <td>
                                            <small> {{$item->alamat}}</small>
                                        </td>
                                        <td>
                                            {{$item->nama_pos}}
                                        </td>
                                        <td class="text-end">
                                            @if(Auth::user()->role == 'ahli_gizi' || Auth::user()->role == 'bidan')
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="{{ url('data/kader/edit/' . $item->id) }}"
                                                        class="menu-link px-3"
                                                        data-kt-users-table-filter="edit_row">Edit</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{ url('data/kader/delete/' . $item->id) }}"
                                                        onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')"
                                                        class="menu-link px-3"
                                                        data-kt-users-table-filter="delete_row">Delete</a>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
