@extends('layouts.dashboard.header')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Posyandu</h1>
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
                        <li class="breadcrumb-item text-muted">Jadwal Vitamin</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body py-4">

                        <form class="form" action="{{ url('data/jadwal/vitamin/update/'.$data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Pos</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Pos."></i>
                                </label>
                                <select required class="form-control" name="posyandu_id">
                                    <option value="" selected disabled>Pilih Pos</option>
                                    @foreach($posyandu as $key => $item)
                                        <option value="{{$item->id}}" 
                                                {{$data->posyandu_id == $item->id ? 'selected' : ''}}>
                                            {{$item->nama_pos}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Bidan</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Bidan"></i>
                                </label>
                               <select required class="form-control" name="bidan_id">
                                    <option value="" selected disabled>Pilih Bidan</option>
                                    @foreach($bidan as $key => $item)
                                        <option value="{{$item->id}}"
                                            {{$data->bidan_id == $item->id ? 'selected' : ''}}>
                                            {{$item->nama}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Vitamin</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Nama Vitamin"></i>
                                </label>
                                <input type="text" required class="form-control form-control-solid" name="vitamin"
                                    value="{{$data->vitamin}}" placeholder="Cth : Vit A Biru" />
                            </div>

                             <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Tanggal</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Tanggal"></i>
                                </label>
                                <input type="date" value="{{$data->tanggal}}" required class="form-control form-control-solid" name="tanggal"/>
                            </div>
                            
                            <div class="separator mb-6"></div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('/data/jadwal/vitamin') }}" class="btn btn-danger me-3">
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
