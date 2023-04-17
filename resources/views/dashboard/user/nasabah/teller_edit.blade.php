@extends('layouts.dashboard.header')
@section('content')
    <div class="col-xl-12">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Filter
                    </a>
                    <!--end::Menu toggle-->
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                        id="kt_menu_620793153969a">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold">Status:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-kt-select2="true"
                                        data-placeholder="Select option" data-dropdown-parent="#kt_menu_620793153969a"
                                        data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications"
                                        checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">

                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_app">Create</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--begin::Contacts-->
        <form class="form" action="{{ url('/layanan/teller_submission_update/' . $data->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="card card-flush h-lg-100" id="kt_contacts_main">
                <!--begin::Card body-->
                <div class="card-body pt-12">
                    <div class="card-header pt-10" id="kt_chat_contacts_header" style="display: block">
                        <h2 align="center" style="padding-bottom: 2%">Data Nasabah</h2>
                    </div>
                    <!--begin::Form-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Jenis Customer</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" required name="category"
                                data-kt-ecommerce-settings-type="select2_flags" data-placeholder="Pilih Jenis">
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="nasabah"{{ $data->customer->category == 'nasabah' ? 'selected' : '' }}>
                                    Nasabah</option>
                                <option
                                    value="non_nasabah"{{ $data->customer->category == 'non_nasabah' ? 'selected' : '' }}>
                                    Non Nasabah</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Jenis Nasabah</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" required name="type"
                                data-kt-ecommerce-settings-type="select2_flags" data-placeholder="Pilih Jenis"
                                onchange="showHideBasedOnChoosetipe(this.value)">
                                <option value="" selected disabled>Pilih Tipe</option>
                                <option value="personal"{{ $data->customer->type == 'personal' ? 'selected' : '' }}>Personal
                                </option>
                                <option value="badan_usaha"{{ $data->customer->type == 'badan_usaha' ? 'selected' : '' }}>
                                    Badan Usaha</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Nama</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input required type="Nama" placeholder="Masukkan Nama Yang Sesuai"
                                class="form-control form-control-solid" name="name"
                                value="{{ $data->customer->name }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Alamat</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input required type="Alamat" placeholder="Masukkan Alamat Yang Sesuai"
                                class="form-control form-control-solid" name="address"
                                value="{{ $data->customer->address }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Nomor Telepon</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input required type="text" onkeypress="return hanyaAngka(event)"
                                placeholder="08123456789" class="form-control form-control-solid" name="phone"
                                value="{{ $data->customer->phone }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Nomor Whatsapp</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input required type="text" onkeypress="return hanyaAngka(event)"
                                placeholder="081234560987" class="form-control form-control-solid" name="whatsapp"
                                value="{{ $data->customer->whatsapp }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Email</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input required type="email" onblur="validateEmail(this);" placeholder="Masukkan Email "
                                class="form-control form-control-solid" name="email"
                                value="{{ $data->customer->email }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Pekerjaan</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" required name="profession"
                                data-kt-ecommerce-settings-type="select2_flags" data-placeholder="Pilih Jenis">
                                <option value="" selected disabled>Pilih Pekerjaan</option>
                                <option value="PNS"{{ $data->customer->profession == 'PNS' ? 'selected' : '' }}>PNS
                                </option>
                                <option value="SWASTA"{{ $data->customer->profession == 'SWASTA' ? 'selected' : '' }}>
                                    Swasta</option>
                                <option
                                    value="WIRASWASTA"{{ $data->customer->profession == 'WIRASWASTA' ? 'selected' : '' }}>
                                    Wiraswasta</option>
                                <option value="LAINNYA"{{ $data->customer->profession == 'LAINNYA' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7" id="perusahaan"
                        style="display: {{ $data->customer->type == 'personal' ? 'none' : '' }}">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Nama Perusahaan</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input required id="perusahaan_value" type="text" placeholder="Masukkan Nama Perusahaan Anda"
                                id="nama_perusahaan" class="form-control form-control-solid" name="company_name"
                                value="{{ $data->customer->company_name }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->

                    <div class="row fv-row mb-7" id="jabatan"
                        style="display: {{ $data->customer->type == 'personal' ? 'none' : '' }}">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Jabatan</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <select id="jabatan_value" class="form-select form-select-solid" required name="position"
                                data-kt-ecommerce-settings-type="select2_flags" placeholder="Pilih Jabatan"
                                id="pilih_jabatan">
                                <option value="" selected disabled>Pilih Jabatan</option>
                                <option value="KOMISARIS"{{ $data->customer->position == 'KOMISARIS' ? 'selected' : '' }}>
                                    Komisaris</option>
                                <option value="DIREKTUR"{{ $data->customer->position == 'DIREKTUR' ? 'selected' : '' }}>
                                    Direktur</option>
                                <option value="STAFF"{{ $data->customer->position == 'STAFF' ? 'selected' : '' }}>Staff
                                </option>
                            </select>
                            <!--end::Select2-->
                        </div>
                    </div>

                    <!--end::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Pendapatan Per Bulan</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" required name="income_per_month"
                                data-kt-ecommerce-settings-type="select2_flags" placeholder="Pilih">
                                <option value="" selected disabled>Pilih Pendapatan</option>
                                <option
                                    value="< Rp2.500.000"{{ $data->customer->income_per_month == '< Rp2.500.000' ? 'selected' : '' }}>
                                    < Rp2.500.000</option>
                                <option
                                    value="Rp2.500.000 sampai Rp5.000.000"{{ $data->customer->income_per_month == 'Rp2.500.000 sampai Rp5.000.000' ? 'selected' : '' }}>
                                    Rp2.500.000 sampai Rp5.000.000</option>
                                <option
                                    value="Rp5.000.000 sampai Rp10.000.000"{{ $data->customer->income_per_month == 'Rp5.000.000 sampai Rp10.000.000' ? 'selected' : '' }}>
                                    Rp5.000.000 sampai Rp10.000.000</option>
                                <option
                                    value="Rp10.000.000 sampai Rp25.000.000"{{ $data->customer->income_per_month == 'Rp10.000.000 sampai Rp25.000.000' ? 'selected' : '' }}>
                                    Rp10.000.000 sampai Rp25.000.000</option>
                                <option
                                    value="Rp25.000.000 sampai Rp50.000.000"{{ $data->customer->income_per_month == 'Rp25.000.000 sampai Rp50.000.000' ? 'selected' : '' }}>
                                    Rp25.000.000 sampai Rp50.000.000</option>
                                <option
                                    value="Rp50.000.000 sampai Rp100.000.000"{{ $data->customer->income_per_month == 'Rp50.000.000 sampai Rp100.000.000' ? 'selected' : '' }}>
                                    Rp50.000.000 sampai Rp100.000.000</option>
                                </option>
                                <option value="> Rp100.000.000">
                                    {{ $data->customer->income_per_month == '> Rp100.000.000' ? 'selected' : '' }}>>
                                    Rp100.000.000</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                    </div>
                    <!--begin::Action buttons-->
                    <div class="row" style="background-color: #F5F8FA;padding-bottom:2%">
                        <div class="col-md-9 offset-md-3">
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->

                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                    <!--end::Action buttons-->

                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Contacts-->
    </div>
    <div class="col-xl-12">
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <div class="card-header pt-10" id="kt_chat_contacts_header" style="display: block">
                    <!--begin::Card title-->
                    {{-- <div class="card-title"> --}}
                    <h2 align="center" style="padding-bottom: 2%">Jenis Layanan</h2>
                    {{-- </div> --}}
                    <!--end::Card title-->
                </div>
                <!--begin::Form-->
                <!--begin::Input group-->
                <div class="row fv-row mb-7">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                            <span class="required">Jenis Layanan</span>
                            :
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="w-50">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" required name="service"
                            data-kt-ecommerce-settings-type="select2_flags" data-placeholder="Pilih Jenis"
                            onchange="showHideBasedOnChoose(this.value)">
                            <option value="" selected disabled>Pilih Jenis Layanan</option>
                            <option value="setor_tunai"{{ $data->service == 'setor_tunai' ? 'selected' : '' }}>Setor Tunai
                            </option>
                            <option value="tarik_tunai"{{ $data->service == 'tarik_tunai' ? 'selected' : '' }}>Tarik Tunai
                            </option>
                            <option value="transfer"{{ $data->service == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="pembayaran"{{ $data->service == 'pembayaran' ? 'selected' : '' }}>Pembayaran
                            </option>
                        </select>
                        <!--end::Select2-->
                    </div>
                </div>
                @if ($data->service == 'setor_tunai' || $data->service == 'tarik_tunai' || $data->service == 'transfer')
                    <div class="row fv-row mb-7" id="rekening_tujuan">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input type="text" onkeypress="return hanyaAngka(event)" placeholder="Rekening Tujuan"
                                class="form-control form-control-solid" name="destination_account"
                                value="{{ $data->destination_account }}" id="rekening_tujuan_value" required />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-7" id="rekening_asal">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input type="text" onkeypress="return hanyaAngka(event)" placeholder="Rekening Asal"
                                class="form-control form-control-solid" name="original_account"
                                value="{{ $data->original_account }}" id="rekening_asal_value" required />
                            <!--end::Input-->
                        </div>
                    </div>
                @endif

                <div class="row fv-row mb-7" id="nominal">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <input type="text" onkeypress="return hanyaAngka(event)" placeholder="Nominal"
                            class="form-control form-control-solid" name="amount" value="{{ $data->amount }}"
                            id="nominal_value" required />
                        <!--end::Input-->
                    </div>
                </div>
                @if ($data->service == 'pembayaran')
                    <div class="row fv-row mb-7" id="merchant_id">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <input type="number"placeholder="Merchant ID" class="form-control form-control-solid"
                                name="merchant_id" value="{{ $data->merchant_id }}" id="merchant_id_value" required />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                @endif
                <div class="row" style="background-color: #F5F8FA;padding-bottom:2%">
                    <div class="col-md-9 offset-md-3">
                        <!--begin::Separator-->
                        <div class="separator mb-6"></div>
                        <!--end::Separator-->
                        <div class="d-flex justify-content-end">
                        </div>
                    </div>
                </div>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>

    <div class="col-xl-12">
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <div class="card-header pt-10" id="kt_chat_contacts_header" style="display: block">
                    <h2 align="center" style="padding-bottom: 2%">Potensi Bisnis</h2>
                </div>
                <div class="row fv-row mb-7">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                            <span class="required">Kategori</span>
                            :
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="col-md-3" style="padding-bottom: 2%">
                        <div class="d-flex mt-1">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="radio" required value="pembiayaan"
                                    name="potential_category" id="category_product_count_yes"
                                    {{ $data->potential_category == 'pembiayaan' ? 'checked' : '' }} />
                                <label class="form-check-label" for="category_product_count_yes">Pembiayaan</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="radio" required value="funding"
                                    name="potential_category" id="category_product_count_yes"
                                    {{ $data->potential_category == 'funding' ? 'checked' : '' }} />
                                <label class="form-check-label" for="category_product_count_yes">Funding</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="radio" required value="tidak_perlu"
                                    name="potential_category" id="category_product_count_yes"
                                    {{ $data->potential_category == 'tidak_perlu' ? 'checked' : '' }} />
                                <label class="form-check-label" for="category_product_count_yes">Tidak Perlu</label>
                            </div>
                            <!--end::Radio-->
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required" style="padding-bottom: 2%">Detail Potensi</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-8">
                            <!--begin::Input-->
                            <textarea required class="form-control form-control-solid" name="potential_description">{{ $data->potential_description }}</textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 offset-md-3">
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                            <div class="d-flex justify-content-center">
                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary"
                                    id="btn_sbmt" style="width: 100%; background-color:#0056A1">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 offset-md-3">
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                            <div class="d-flex justify-content-center">
                                <a href="{{ url('/layanan/teller_submission_index') }}" class="btn btn-danger"
                                    style="width: 100%; background-color: #808080">
                                    <span class="indicator-label">Back</span>
                                </a>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
    </form>
@section('scriptcustom')
    <script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>
    <script>
        function showHideBasedOnChoose(value) {
            if (value == 'setor_tunai') {
                document.getElementById('rekening_tujuan').style.display = "";
                document.getElementById('rekening_asal').style.display = "";
                document.getElementById('nominal').style.display = "";

                document.getElementById('rekening_tujuan_value').setAttribute('required', 'required');
                document.getElementById('rekening_asal_value').setAttribute('required', 'required');
                document.getElementById('nominal_value').setAttribute('required', 'required');

                document.getElementById('merchant_id').style.display = "none";
            } else {
                if (value == 'tarik_tunai') {
                    document.getElementById('rekening_tujuan').style.display = "";
                    document.getElementById('rekening_asal').style.display = "";
                    document.getElementById('nominal').style.display = "";

                    document.getElementById('rekening_tujuan_value').setAttribute('required', 'required');
                    document.getElementById('rekening_asal_value').setAttribute('required', 'required');
                    document.getElementById('nominal_value').setAttribute('required', 'required');

                    document.getElementById('merchant_id').style.display = "none";
                } else {
                    if (value == 'transfer') {
                        document.getElementById('rekening_tujuan').style.display = "";
                        document.getElementById('rekening_asal').style.display = "";
                        document.getElementById('nominal').style.display = "";

                        document.getElementById('rekening_tujuan_value').setAttribute('required', 'required');
                        document.getElementById('rekening_asal_value').setAttribute('required', 'required');
                        document.getElementById('nominal_value').setAttribute('required', 'required');

                        document.getElementById('merchant_id').style.display = "none";
                    } else {
                        if (value == 'pembayaran') {
                            document.getElementById('rekening_tujuan').style.display = "none";
                            document.getElementById('rekening_asal').style.display = "none";
                            document.getElementById('nominal').style.display = "";
                            document.getElementById('merchant_id').style.display = "";

                            document.getElementById('rekening_tujuan_value').removeAttribute('required');
                            document.getElementById('rekening_asal_value').removeAttribute('required');

                            document.getElementById('nominal_value').setAttribute('required', 'required');
                            document.getElementById('merchant_id_value').setAttribute('required', 'required');
                        } else {
                            document.getElementById('rekening_tujuan').style.display = "none";
                            document.getElementById('rekening_asal').style.display = "none";
                            document.getElementById('nominal').style.display = "none";
                            document.getElementById('merchant_id').style.display = "none";

                            document.getElementById('nominal_value').setAttribute('required', 'required');
                            document.getElementById('merchant_id_value').setAttribute('required', 'required');
                            document.getElementById('rekening_asal_value').setAttribute('required', 'required');
                            document.getElementById('rekening_tujuan_value').setAttribute('required', 'required');
                        }

                    }
                }
            }
        }
    </script>
    <script>
        function showHideBasedOnChoosetipe(value) {
            if (value == 'personal') {
                document.getElementById('perusahaan').style.display = "none";
                document.getElementById('jabatan').style.display = "none";
                document.getElementById('perusahaan_value').removeAttribute('required');
                document.getElementById('jabatan_value').removeAttribute('required');
            } else {
                if (value == 'badan_usaha') {
                    document.getElementById('perusahaan').style.display = "";
                    document.getElementById('jabatan').style.display = "";
                    document.getElementById('perusahaan_value').setAttribute('required', 'required');
                    document.getElementById('jabatan_value').setAttribute('required', 'required');
                }
            }
        }
    </script>
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    <script>
        function validateEmail(emailField) {
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

            if (reg.test(emailField.value) == false) {
                alert('Masukkan Email Dengan Benar !');
                $("#btn_sbmt").hide();
                return false;
            } else {
                $("#btn_sbmt").show();
            }

            return true;

        }
    </script>
@endsection
