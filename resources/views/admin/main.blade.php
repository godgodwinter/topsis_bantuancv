<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from colorlib.com//polygon/adminty/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Jan 2019 06:19:49 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>{{ ucfirst(config('app.name'))}} @yield('title') </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords"
        content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="https://colorlib.com//polygon/adminty/files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset("admin-style/") }}/files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset("admin-style/") }}/files/assets/icon/feather/css/feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("admin-style/") }}/files/assets/css/style.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset("admin-style/") }}/files/assets/css/jquery.mCustomScrollbar.css">
    <script type="text/javascript" src="{{ asset("js/") }}/jquery-3.5.1.js"></script>
    {{-- sweet alert --}}
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    @yield('csshere')
</head>
<body>
    {{-- <script>
        swal("Hello world!");
    </script> --}}
    {{-- <script>
        $(document).ready(function(){
            $("button").click(function(){
              if (typeof jQuery != 'undefined') {
                alert(jQuery.fn.jquery);
                alert($().jquery);
                alert($()['jquery']);
                alert($.ui.version);
              }
            });
        });
      </script>
    <button>Check jQuery version</button> --}}
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="{{ url('/')}}/dashboard">
                            <img class="img-fluid" src="{{ asset("admin-style/") }}/files/assets/images/logo.png"
                                alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ asset("admin-style/") }}/files/assets/images/avatar-4.jpg"
                                            class="img-radius" alt="User-Profile-Image">
                                        <span> {{ Auth::user()->name }}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                        <li>
                                            <a href="{{ route('profile.show') }}">
                                                <i class="feather icon-user"></i>
                                                {{ __('Profile') }}
                                            </a>
                                        </li>
                                        <li>
                                             <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"><i class="feather icon-log-out"></i>
                                {{ __('Logout') }}
                                </a>
                        </form>

                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Menu</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="{{ url('/')}}/dashboard">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard </span>
                                    </a>

                                </li>
@php
    if((Auth::user()->tipeuser)=='kades'){
        @endphp

        <li class="">
                                    <a href="{{ url('/')}}/kades/laporan">
                                        <span class="pcoded-micon"><i class="feather icon-layout"></i></span>
                                        <span class="pcoded-mtext">Laporan </span>
                                    </a>

                                </li>
        @php
    }elseif((Auth::user()->tipeuser)=='dusun'){
        @endphp

        <li class="">
                                    <a href="{{url('/')}}/dusun/datawarga">
                                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                        <span class="pcoded-mtext">Data Warga</span>
                                    </a>
                                </li>
        <li class="">
                                    <a href="{{url('/')}}/dusun/bantuan">
                                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                        <span class="pcoded-mtext">Bantuan</span>
                                    </a>
                                </li>
        @php
    }elseif((Auth::user()->tipeuser)=='rw'){
        @endphp

        <li class="">
                                    <a href="{{url('/')}}/rw/datawarga">
                                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                        <span class="pcoded-mtext">Data Warga</span>
                                    </a>
                                </li>
        <li class="">
                                    <a href="{{url('/')}}/rw/bantuan">
                                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                        <span class="pcoded-mtext">Bantuan</span>
                                    </a>
                                </li>
        @php
    }else{
@endphp

                                {{-- @php
                                if()
                                @endphp --}}
                               <!-- <li class="">
                                    <a href="{{url('/')}}/admin/kriteria">
                                        <span class="pcoded-micon"><i class="feather icon-monitor"></i></span>
                                        <span class="pcoded-mtext">Kriteria</span>
                                    </a>
                                </li>--->
                                <li class="">
                                    <a href="{{url('/')}}/admin/datawilayah">
                                        <span class="pcoded-micon"><i class="feather icon-globe"></i></span>
                                        <span class="pcoded-mtext">Data Wilayah</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{url('/')}}/admin/datawarga">
                                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                        <span class="pcoded-mtext">Data Warga</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{url('/')}}/admin/bantuan">
                                        <span class="pcoded-micon"><i class="feather icon-codepen"></i></span>
                                        <span class="pcoded-mtext">Bantuan</span>
                                    </a>
                                </li>
                                @php
                            }
                                @endphp
                            </ul>

                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    @yield('headernav')
                                    @yield('notif')
                                    @yield('container')
                                </div>
                                {{-- <div id="styleSelector">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="{{ asset("admin-style/") }}/files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="{{ asset("admin-style/") }}/files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="{{ asset("admin-style/") }}/files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="{{ asset("admin-style/") }}/files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="{{ asset("admin-style/") }}/files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Javascript Here -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/jquery/js/jquery.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/popper.js/js/popper.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    @yield('jshere')
    <!-- j-pro js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/jquery.ui.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/jquery-cloneya.min.js">
    </script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/autoNumeric.js">
    </script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/jquery.stepper.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/custom/currency-form.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/modernizr/js/modernizr.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- data-table js -->
    <script src="{{ asset("admin-style/") }}/files/bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script
        src="{{ asset("admin-style/") }}/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js">
    </script>
    <script src="{{ asset("admin-style/") }}/files/assets/pages/data-table/js/jszip.min.js"></script>
    <script src="{{ asset("admin-style/") }}/files/assets/pages/data-table/js/pdfmake.min.js"></script>
    <script src="{{ asset("admin-style/") }}/files/assets/pages/data-table/js/vfs_fonts.js"></script>
    <script src="{{ asset("admin-style/") }}/files/bower_components/datatables.net-buttons/js/buttons.print.min.js">
    </script>
    <script src="{{ asset("admin-style/") }}/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js">
    </script>
    <script src="{{ asset("admin-style/") }}/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script
        src="{{ asset("admin-style/") }}/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="{{ asset("admin-style/") }}/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
    </script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/i18next/js/i18next.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script src="{{ asset("admin-style/") }}/files/assets/pages/data-table/js/data-table-custom.js"></script>
    <!-- notification js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/js/bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/notification/notification__.js">
    </script>
    <script src="{{ asset("admin-style/") }}/files/assets/js/pcoded.min.js"></script>
    <script src="{{ asset("admin-style/") }}/files/assets/js/vartical-layout.min.js"></script>
    <script src="{{ asset("admin-style/") }}/files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/js/script.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-23581568-13');
    </script>
</body>
<!-- Mirrored from colorlib.com//polygon/adminty/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Jan 2019 06:21:14 GMT -->
</html>
