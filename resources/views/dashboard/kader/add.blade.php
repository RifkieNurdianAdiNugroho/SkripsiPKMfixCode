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
                        <li class="breadcrumb-item text-muted">Data</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Tambah</li>
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
                <div class="card">
                    <div class="card-body py-4">

                        <form class="form" action="{{ url('data/kader/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Nama Lengkap</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Nama Lengkap."></i>
                                </label>
                                <input type="text" required class="form-control form-control-solid" name="nama"
                                    value="" placeholder="Cth : Sari Kumala Sari" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">No Telepon</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Alamat Lengkap"></i>
                                </label>
                                <input type="number" required class="form-control form-control-solid" name="no_tlp"
                                    value="" placeholder="Cth : 085608xxxxxx" />
                            </div>

                             <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Alamat Lengkap</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Alamat Lengkap"></i>
                                </label>
                                <input type="text" required class="form-control form-control-solid" name="alamat"
                                    value="" placeholder="Cth : Jalan Raya Lembu Suro No.1, Krajan, Kejayan, Kec. Kejayan, Pasuruan, Jawa Timur 67172" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Posyandu</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Posyandu"></i>
                                </label>
                                <select class="form-control form-control-solid" name="posyandu_id">
                                    <option value="" selected disabled>
                                        Pilih Pos
                                    </option>
                                    @foreach($pos as $posKey => $posItem)
                                    <option value="{{$posItem->id}}" >
                                        {{$posItem->nama_pos}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="separator mb-6"></div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('/data/kader') }}" class="btn btn-danger me-3">
                                    <span class="indicator-label">Batal</span>
                                </a>
                                <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Bersihkan</button>
                                <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary" id="btn_sbmt">
                                    <span class="indicator-label">Simpan</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptcustom')
    <script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>
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
