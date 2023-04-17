@extends('layouts.dashboard.header')
@section('content')
    <div class="col-xl-12">
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card body-->
            <div class="card-body pt-12">
                <div class="card-header pt-10" id="kt_chat_contacts_header" style="display: block">
                    <h2 align="center" style="padding-bottom: 2%">Assignment</h2>
                </div>
                <!--begin::Form-->
                <form class="form" action="{{ url('/layanan/marketing_assignment_store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Marketing</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <div>
                                <select aria-label="Come From" data-control="select2" data-placeholder="Come From"
                                    class="form-select mb-2" name="marketing_id">
                                    <option value="0" selected disabled>Pilih Marketing</option>
                                    @foreach ($marketing as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Select2-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <div class="col-md-4 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Nasabah</span>
                                :
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="w-50">
                            <!--begin::Select2-->
                            <div>
                                <select aria-label="Come From" data-control="select2" data-placeholder="Come From"
                                    class="form-select mb-2" name="customer_id">
                                    <option value="0" selected disabled>Pilih Nasabah</option>
                                    @foreach ($nasabah as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Select2-->
                        </div>
                    </div>
                    <!--start::Input group-->

                    <!--end::Input group-->
                    <!--end::Input group-->
                    <div class="row">
                        <div class="col-md-9 offset-md-3">
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                            <div class="d-flex justify-content-center">
                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary"
                                    style="width: 100%; background-color:#0056A1">
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
                                <a href="{{ url('/layanan/assignment_index') }}" class="btn btn-danger"
                                    style="width: 100%; background-color: #808080">
                                    <span class="indicator-label">Back</span>
                                </a>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
@section('scriptcustom')
    <script src="https://use.fontawesome.com/f2fc9ac3b2.js"></script>

@endsection
