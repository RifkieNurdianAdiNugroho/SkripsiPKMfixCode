@extends('layouts.dashboard.header')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ url('home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-12">
                <div class="col-lg-6">
                    <p align="center"><b>Nasabah</b></p>
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <tr>
                            <td rowspan="6" width="30%">
                                <img src="{{ url('admin/image/logo/client.webp') }}" width="100%" style="min-height: 100px;">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%">NAMA :</td>
                            <td> {{ $nasabah['nama_nasabah'] }} </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> POTENSI :</td>
                            <td> {{ $nasabah['jenis'] }} </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> PHONE :</td>
                            <td> {{ $nasabah['phone'] }} </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> EMAIL :</td>
                            <td>{{ str_replace('mailto:', '', $nasabah['email']) }} &nbsp;<a title="contact email" class="fa fa-envelope" href="{{ $nasabah['email'] }}"></a></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> WAHTSAPP :</td>
                            <td> {{ str_replace('https://wa.me/', '', $nasabah['whatsapp']) }} &nbsp;<a target="_blank" title="contact whatsapp" class="fa fa-whatsapp" href="{{ $nasabah['whatsapp'] }}"></a></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 ">
                    <p align="center"><b>Marketing Assigned</b></p>
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <tr>
                            <td rowspan="6" width="30%">
                                <img src="{{ $urlMarketing . '/' . $marketing['photo'] }}" width="100%" style="min-height: 100px;">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%">NAMA :</td>
                            <td> {{ $marketing['name'] }} </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%">TIPE :</td>
                            <td> {{ $marketing['type'] }} </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> PHONE :</td>
                            <td> {{ $marketing['phone'] }} </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> EMAIL :</td>
                            <td>{{ str_replace('mailto:', '', $marketing['email']) }} &nbsp;<a title="contact email" class="fa fa-envelope" href="{{ $marketing['email'] }}"></a></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2%"> Assigned At :</td>
                            <td>{{ $nasabah['created_at'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            @if (Auth::user()->role == 'marketing')
            <p align="right">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_crm" class="btn btn-primary">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Add Activites
                </a>
            </p>
            <hr>
            @endif
            <div class="col-lg-12">
                <p align="center"><b>Marketing Assignment Activites</b></p>
                @foreach ($history as $hr)
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <tr>
                        <td rowspan="5" width="30%">
                            @if ($hr['image'] == null)
                            <img src="{{ url('admin/image/logo/Image_not_available.png') }}" width="100%" style="max-height: 100px;">
                            @else
                            <a href="{{ $hr['attachment'] }}" download><img src="{{ $hr['attachment'] }}" width="300px" style="height: 300px;"></a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 2%">TITLE :</td>
                        <td> {{ $hr['title'] }} </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 2%">DATE :</td>
                        <td> {{ $hr['tanggal'] }} {{ $hr['jam'] }} </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 2%"> NOTE :</td>
                        <td> {{ $hr['note'] }} </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 2%"> STATUS :</td>
                        <td>{{ $hr['status'] }}</td>
                    </tr>
                </table>
                <hr>
                @endforeach
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<div class="modal fade" id="add_crm" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px modal-xl" style="max-width: 80% !important;">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ url('layanan_marketing_activites_add') }}" id="modal_add_crm_form" method="POST" enctype="multipart/form-data">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="modal_add_crm_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Add Assignment Activities</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="modal_add_crm_close" data-bs-dismiss="modal" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <div class="row fv-row mb-7">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <label class="form-label fw-bolder text-dark fs-6">Title</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="First Visit" name="title" autocomplete="off" required />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Date</label>
                        <input class="form-control form-control-lg form-control-solid" type="date" name="date_submit" id="email" autocomplete="off" required />
                    </div>
                    <!--end::Input group-->
                    <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Status</label>
                            <select aria-label="Come From"  data-placeholder="" class="form-select mb-2" name="status" style="width: 100%;" required>
                                <option value="" selected disabled>Pilih Status</option>
                                @foreach ($masterStatus as $value)
                                <option value="{{ $value->id }}">{{ $value->kategori }} -
                                    {{ $value->status }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    <div class="row fv-row mb-7" id="foreign">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <label class="form-label fw-bolder text-dark fs-6">Note</label>
                            <textarea name="note" id="" class="form-control form-control-solid" required cols="30" rows="5" placeholder="Av. de Concha Espina, 1, 28036 Madrid, Spanyol"></textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Attachment</label>
                        <input type="hidden" value="{{ $id }}" name="id">
                        <input accept="image/png, image/gif, image/jpeg" class="form-control form-control-lg form-control-solid" type="file" name="attachment"/>
                    </div>
                    <!--end::Input group-->
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" data-bs-dismiss="modal" id="modal_add_crm_cancel" class="btn btn-light me-3">Cancel</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="modal_add_crm_submit" class="btn btn-primary">
                        Add Activities
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection
@section('scriptcustom')
<script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>
@endsection