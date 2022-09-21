<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>

    @yield('css_design')

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>معاَ نحيا</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
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
          href="{{asset('assets/dashboard/app-assets/css-rtl/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css-rtl/pages/app-invoice-list.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css-rtl/custom-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/css/style-rtl.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ml-auto">

            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                                                                                         data-feather="moon"></i></a>
            </li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                                                                                   data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1"
                           data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>

            {{--            <li class="nav-item dropdown dropdown-notification mr-25">--}}
            {{--                <x-notification-menu count="10"/>--}}
            {{--            </li>--}}

            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="javascript:void(0);"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span
                            class="user-name font-weight-bolder">{{Auth::user()->name}}</span>
                    </div>
                    <span class="avatar">

                        <img class="round"
                             src="{{asset(Auth::user()->image_path)??asset('assets/dashboard/app-assets/images/portrait/small/avatar-s-11.jpg')}}"
                             alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{route('logout')}}"
                       onclick="event.preventDefault(); document.getElementById('logout').submit();">
                        <i class="mr-50" data-feather="power"></i> Logout
                    </a>

                    <form action="{{route('logout')}}" method="post" id="logout" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{route('adminHome.index')}}">
                    <span class="brand-logo">
                        <img class="round" style="border: #0D7091"
                             src="{{asset('assets/dashboard/app-assets/images/pages/logo.jpg')}}"
                             alt="avatar" height="40" width="40">
                    </span>
                    <h2 class="brand-text">معاً نحيا</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('profile.edit')}}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="User">{{Auth::user()->name}}</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('adminHome.index')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">الصفحة الرئيسية </span>
                </a>
            </li>
            @if(Auth::user()->is_super_admin ===1)

                <li><a class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                        </svg>
                        <span class="menu-item text-truncate" data-i18n="Analytics">المشرفين</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('admins.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                                <span class="menu-item text-truncate" data-i18n="List">عرض المشرفين </span></a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('admins.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                                <span class="menu-item text-truncate" data-i18n="List">إنشاء مشرف </span></a>
                        </li>
                    </ul>
                </li>
            @endif
            <li><a class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate" data-i18n="Analytics">الجمعيات</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('associations.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="List">عرض الجمعيات </span></a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('associations.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="List">إنشاء جمعية </span></a>
                    </li>
                </ul>
            </li>

            <li><a class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate" data-i18n="Analytics">الاقسام</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('categories.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="List">عرض الاقسام </span></a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('categories.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span class="menu-item text-truncate" data-i18n="List">إنشاء قسم </span></a>
                    </li>
                </ul>
            </li>


            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('adminProjects.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">المشاريع </span>
                </a>
            </li>


            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('requests.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">الطلبات </span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('logout')}}"
                   onclick="event.preventDefault(); document.getElementById('logout').submit();">
                    <i class="mr-50" data-feather="power"></i> تسجيل خروج
                </a>

                <form action="{{route('logout')}}" method="post" id="logout" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="col-6 mb-0">@yield('page-title', 'Page Title')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            @yield("content")
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a
                class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span
                class="d-none d-sm-inline-block">, All rights Reserved</span></span><span
            class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
{{--<script src="{{asset('assets/dashboard/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>--}}
<script src="{{asset('assets/dashboard/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script
    src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script
    src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/dashboard/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/dashboard/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/js/scripts/pages/app-invoice-list.js')}}"></script>
<!-- END: Page JS-->


@yield('scripts')

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
