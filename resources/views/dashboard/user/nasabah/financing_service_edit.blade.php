@extends('layouts.dashboard.header')
@section('content')
    <div class="col-xl-12">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">

        </div>
        <!--begin::Contacts-->
        <form class="form" action="{{ url('/layanan/financing_service_submission_update/' . $data->id) }}" method="post"
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
                                <option value="" selected disabled>Pilih</option>
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
                                <option value="" selected disabled>Pilih</option>
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
                            <input required type="text" onkeypress="return hanyaAngka(event)" placeholder="08123456789"
                                class="form-control form-control-solid" name="phone"
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
                            <input required type="text" onkeypress="return hanyaAngka(event)" placeholder="081234560987"
                                class="form-control form-control-solid" name="whatsapp"
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
                                <option value="" selected disabled>Pilih</option>
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
                                class="form-control form-control-solid" name="company_name"
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
                                data-kt-ecommerce-settings-type="select2_flags" placeholder="Pilih Jabatan">
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
                                <option value="" selected disabled>Pilih Pendapatan </option>
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
            <div class="card-body" style="padding: 0">
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
                            <option value="" selected disabled="">Pilih Jenis Layanan</option>
                            <option value="kpr"{{ $data->service == 'kpr' ? 'selected' : '' }}>KPR</option>
                            <option value="multimanfaat"{{ $data->service == 'multimanfaat' ? 'selected' : '' }}>
                                Multimanfaat</option>
                            <option value="multiguna"{{ $data->service == 'multiguna' ? 'selected' : '' }}>Multiguna
                            </option>
                            <option
                                value="modal_kerja_commercial"{{ $data->service == 'modal_kerja_commercial' ? 'selected' : '' }}>
                                Modal kerja Komersial</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                </div>
                <div class="row fv-row mb-7" id="rekening_tujuan" style="display: none">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <input type="text" onkeypress="return hanyaAngka(event)" placeholder="Rekening Tujuan"
                            class="form-control form-control-solid" name="" value="" />
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row fv-row mb-7" id="rekening_asal" style="display: none">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <input type="text" onkeypress="return hanyaAngka(event)" placeholder="Rekening Asal"
                            class="form-control form-control-solid" name="" value="" />
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row fv-row mb-7" id="nominal" style="display: none">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <input type="text" onkeypress="return hanyaAngka(event)" placeholder="Nominal"
                            class="form-control form-control-solid" name="" value="" />
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row fv-row mb-7" id="merchant_id" style="display: none">
                    <div class="col-md-4 text-md-end">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold form-label mt-3">
                        </label>
                        <!--end::Label-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <input type="number" placeholder="Merchant ID" class="form-control form-control-solid"
                            name="{{ url('/layanan/financing_service_submission_index') }}" value="" />
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Input group-->
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
            <div class="card-body pt-12">
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
                        <div class="d-flex mt-4">
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
                                <a href="{{ url('/layanan/financing_service_submission_index') }}" class="btn btn-danger"
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
                document.getElementById('merchant_id').style.display = "none";
            } else {
                if (value == 'tarik_tunai') {
                    document.getElementById('rekening_tujuan').style.display = "";
                    document.getElementById('rekening_asal').style.display = "";
                    document.getElementById('nominal').style.display = "";
                    document.getElementById('merchant_id').style.display = "none";
                } else {
                    if (value == 'transfer') {
                        document.getElementById('rekening_tujuan').style.display = "";
                        document.getElementById('rekening_asal').style.display = "";
                        document.getElementById('nominal').style.display = "";
                        document.getElementById('merchant_id').style.display = "none";
                    } else {
                        if (value == 'pembayaran') {
                            document.getElementById('rekening_tujuan').style.display = "none";
                            document.getElementById('rekening_asal').style.display = "none";
                            document.getElementById('nominal').style.display = "";
                            document.getElementById('merchant_id').style.display = "";
                        } else {
                            document.getElementById('rekening_tujuan').style.display = "none";
                            document.getElementById('rekening_asal').style.display = "none";
                            document.getElementById('nominal').style.display = "none";
                            document.getElementById('merchant_id').style.display = "none";
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
                alert('Invalid Email Address');
                $("#btn_sbmt").hide();
                return false;
            } else {
                $("#btn_sbmt").show();
            }

            return true;

        }
    </script>
@endsection
