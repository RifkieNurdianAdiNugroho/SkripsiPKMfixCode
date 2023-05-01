@extends('layouts.dashboard.header')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Balita</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">Data</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Ubah</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Balita</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body py-4">

                        <form class="form" action="{{ url('data/balita/update/') }}/{{$data->id}}" 
                              method="post" 
                              enctype="multipart/form-data">
                        @csrf
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Nama Lengkap</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Nama Lengkap."></i>
                                </label>
                                <input type="text" required class="form-control form-control-solid" name="nama"
                                    value="{{$data->nama}}" placeholder="Cth : Sari Kumala Sari" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Nama Orang Tua</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Jabatan Fungsional"></i>
                                </label>
                                <input type="text" required class="form-control form-control-solid" name="nama_ortu"
                                    value="{{$data->nama_ortu}}" placeholder="Cth : Ahmad Fatony" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Tanggal Lahir</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Tanggal Lahir"></i>
                                </label>
                                <input type="date" required class="form-control form-control-solid" name="tgl_lahir"
                                    value="{{$data->tgl_lahir}}" placeholder="Cth : 5" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Panjang Lahir</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Panjang Lahir"></i>
                                </label>
                                <input type="number" required class="form-control form-control-solid" name="pjg_lahir"
                                    value="{{$data->pjg_lahir}}" placeholder="Cth : 5" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Berat Badan Lahir</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Berat Badan Lahir"></i>
                                </label>
                                <input type="number" required class="form-control form-control-solid" name="bb_lahir"
                                    value="{{$data->bb_lahir}}" placeholder="Cth : 4" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Jenis Kelamin</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Jenis Kelamin"></i>
                                </label>
                                <select class="form-control" name="jenis_kelamin" required>
                                    <option value="">
                                        Pilih Jenis Kelamin
                                    </option>
                                    <option value="L" {{$data->jenis_kelamin == 'L'?'selected':''}}>
                                        Laki - Laki
                                    </option>
                                    <option value="P" {{$data->jenis_kelamin == 'P'?'selected':''}}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>

                             <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Alamat Lengkap</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Alamat Lengkap"></i>
                                </label>
                                <input type="text" required class="form-control form-control-solid" name="alamat"
                                    value="{{$data->alamat}}" placeholder="Cth : Jalan Raya Lembu Suro No.1, Krajan, Kejayan, Kec. Kejayan, Pasuruan, Jawa Timur 67172" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Anak Ke</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Anak Ke"></i>
                                </label>
                                <input type="number" required class="form-control form-control-solid" name="anak_ke"
                                    value="{{$data->anak_ke}}" placeholder="Cth : 1" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Gakin</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Gakin"></i>
                                </label>
                                <select class="form-control" name="gakin" required>
                                    <option value="">
                                        Pilih Gakin
                                    </option>
                                    <option value="1" {{$data->gakin == '1'?'selected':''}}>
                                       1
                                    </option>
                                    <option value="2" {{$data->gakin == '2'?'selected':''}}>
                                       2
                                    </option>
                                </select>
                            </div>


                            <div class="separator mb-6"></div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('/data/balita') }}" class="btn btn-danger me-3">
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
