<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>تسجيل الدخول - معا نحيا- </title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/vendors/css/vendors-rtl.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css-rtl/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css-rtl/custom-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/css/style-rtl.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content " style="background-image:url({{'assets/dashboard/back_start.jpg'}}) ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body" >
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">

                        <img class="round"
                             src="{{asset('assets/dashboard/app-assets/images/pages/logo.jpg')}}"
                             alt="avatar" height="40" width="40">
                        <h2 style="color: limegreen" class="brand-text text-green-400 ml-1">معاً</h2>
                        <h2 style="color: red" class="brand-text text-red-400 ml-1"> نحيا</h2>
                    </a>
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8  ">
                        <img class="img-fluid"
                             src="{{asset('assets/dashboard/app-assets/images/pages/background.jpg')}}" alt="Login V2"/>
                    </div>


                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title font-weight-bold mb-1">مرحبا ب معاً نحيا! 👋</h2>
                            <p class="card-text mb-2">الرجاء تسجيل الدخول الى حسابك</p>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')"/>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>


                            <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label" for="email">الايميل</label>
                                    <input class="form-control" id="email" type="text" name="email"
                                           placeholder="john@example.com" aria-describedby="email" autofocus=""
                                           tabindex="1"/>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">كلمة السر</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-password">استعادة
                                                كلمة المرور؟</a>
                                        @endif
                                    </div>

                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="password" type="password"
                                               name="password" placeholder="············" aria-describedby="password"
                                               tabindex="2"/>
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="remember-me" type="checkbox"
                                               tabindex="3"/>
                                        <label class="custom-control-label" for="remember-me"> تذكرني</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" tabindex="4">تسجيل الدخول</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/dashboard/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/dashboard/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>
