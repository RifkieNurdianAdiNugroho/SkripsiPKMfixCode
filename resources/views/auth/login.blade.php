<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head><base href="{{url('/')}}">
        <title>PKM Kejayan Gizi Posyandu - Login Page</title>
        <meta charset="utf-8" />
        <meta name="description" content="PKM Kejayan Gizi Posyandu - Login Page" />
        <meta name="keywords" content="PKM Kejayan Gizi Posyandu - Login Page" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="PKM Kejayan Gizi Posyandu - Login Page" />
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:site_name" content="PKM Kejayan Gizi Posyandu - Login Page" />
        <link rel="canonical" href="{{url('/')}}" />
        <link rel="shortcut icon" href="{{url('admin/image/logo/pkm.png')}}" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{url('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
  <!--       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> -->
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="bg-body">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid ">
                <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative">
                    <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Aside-->
               <div class="w-lg-600px p-10 p-lg-15 mx-auto">
                            <!--begin::Form-->
                            <form class="form w-100" action="{{url('login')}}" method="post">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                   
                                    <img alt="Logo" src="{{url('admin/image/logo/pkm.png')}}" class="h-60px" 
                                    style="min-height: 120px;padding-bottom: 5%;" />
                                    @if($message=Session::get('error'))
                                          <div class="alert alert-danger" role="alert">
                                                <div class="alert-text">{{ucwords($message)}}</div>
                                          </div>
                                    @endif
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <div class="text-black-400 fw-bold fs-4">Silahkan masuk dengan email dan password anda</div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" placeholder="Masukan email" id="email" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Label-->
                                         <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                        <!--end::Label-->
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Masukan Password" name="password" autocomplete="off" />
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input wrapper-->
                                        <!--begin::Meter-->
                                      
                                        <!--end::Meter-->
                                    </div>
                                     <!-- <div class="d-flex justify-content-between" style="text-align: right;"> -->
                                           
                                            <p align="right"><a style="color: #43b34b;" href="#" onclick="return alert('Silahkan hubungi admin jika lupa password')" class="link-primary fw-bolder fs-5">Lupa Password</a></p>
                                      <!--   </div> -->
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <!--begin::Submit button-->
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary" 
                                    style="background-color:#43b34b;">
                                        <span class="indicator-label">Masuk</span>
                                        <span class="indicator-progress">Mohon tunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Submit button-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
  
                <div class="d-flex flex-column flex-lg-row-fluid" 
                     style="background-image: url({{url('admin/image/logo/posyandu.jpg')}}); 
                            background-repeat: no-repeat, repeat;
                            background-size: cover;">
                  <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                      
                  </div>
                </div>
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Root-->
        <!--end::Main-->
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{url('assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{url('assets/js/scripts.bundle.js')}}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
       <!--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->
        <script type="text/javascript">
         </script>
    </body>
    <!--end::Body-->
</html>