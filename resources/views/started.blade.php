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
    <title>معا نحيا</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/dashboard/app-assets/images/pages/logo.jpg')}}">
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
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2">
                <div class="auth-inner py-2">
                    <!-- Login v1 -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="brand-logo">
                                <img class="round"
                                     src="{{asset('assets/dashboard/app-assets/images/pages/logo.jpg')}}"
                                     alt="avatar" height="80" width="80">

                            </a>


                            <h4 class="card-title mb-1">مرحبا بك في معاً نحيا 👋</h4>
                            <p class="card-text mb-2">اختر النوع الحساب اللذي ستدخل به </p>


                            <button class="btn btn-primary btn-block" tabindex="4">
                                <a class="btn btn-primary btn-block" href="admin/login"> اشراف</a>
                            </button>
                            <button class="btn btn-primary btn-block" tabindex="4">
                                <a class="btn btn-primary btn-block" href="association/login"> جمعية</a>
                            </button>

                        </div>
                    </div>
                    <!-- /Login v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->

</body>
<!-- END: Body-->

</html>
