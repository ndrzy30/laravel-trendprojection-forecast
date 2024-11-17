<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Admin | @yield('title')</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Gradient Able is trending dashboard template made using Bootstrap 5 design framework. Gradient Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="codedthemes">
    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon">
    <!-- map-vector css -->
    <link rel="stylesheet" href="../assets/css/plugins/jsvectormap.min.css">
    <!-- [Google Font : Poppins] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fb034efa9e.js" crossorigin="anonymous"></script>
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('../assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('../assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('../assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('../assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('../assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('../assets/css/style-preset.css') }}">
    {{-- Data tables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css">
    {{--  --}}
    <script src="{{ asset('selectbox/dselect.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('selectbox/dselect.scss') }}">
    @stack('chart')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true"
    data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <h4 class="text-primary">SPP OBAT<i class="fa-solid fa-stethoscope"></i></h4>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link"><span class="pc-micon">
                                <i class="ph ph-gauge"></i></span><span class="pc-mtext">Dashboard</span></a>
                    </li>
                    <li class="pc-item pc-caption">
                        <i class="ph ph-suitcase"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('medicine.index') }}" class="pc-link"><span class="pc-micon">
                                <i class="fa-solid fa-capsules me-2"></i></span><span class="pc-mtext">Data
                                Obat</span></a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('sales.index') }}" class="pc-link"><span class="pc-micon">
                                <i class="fa-brands fa-shopify me-2"></i></span><span class="pc-mtext">Data
                                Penjualan</span></a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon">
                                <i class="ph ph-tree-structure"></i> </span><span class="pc-mtext">Trend
                                Projection</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="{{ route('train.index') }}">Model</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('predict.index') }}">Prediksi</a>
                            </li>
                        </ul>
                    </li>
                    </li>
                    {{-- <li class="pc-item">
                        <a href="{{ route('report') }}" class="pc-link"><span class="pc-micon">
                                <i class="fa-solid fa-paperclip me-2"></i></span><span
                                class="pc-mtext">Laporan</span></a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="m-header">
            <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <h4 class="text-light pt-2">SPP OBAT<i class="fa-solid fa-stethoscope"></i></h4>
            </a>
        </div>
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ph ph-list"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ph ph-list"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img src="{{ asset('../assets/images/user/avatar-2.jpg') }}" alt="user-image"
                                class="user-avtar">
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 225px)">
                                    <ul class="list-group list-group-flush w-100">
                                        <li class="list-group-item">
                                            <a href="{{ route('logout') }}" class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-power"></i>
                                                    <span>Logout</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container content">
        @yield('main')
    </div>


    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm-6 my-1">
                    <p class="m-0">Gradient Able &#9829; crafted by Team <a href="https://codedthemes.com/"
                            target="_blank">Codedthemes</a></p>
                </div>
                <div class="col-sm-6 ms-auto my-1">
                    <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">
                        <li class="list-inline-item"><a href="../index.html">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    {{-- <!-- [Page Specific JS] start -->
    <script src="{{ asset('../assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/world.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/world-merc.js') }}"></script>
    <script src="{{ asset('../assets/js/pages/dashboard-sales.js') }}"></script> --}}
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('../assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('../assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/feather.min.js') }}"></script>




    {{-- @include('sweetalert::alert') --}}

    <script>
        layout_change('light');
    </script>

    <script>
        $(document).ready(function() {
            new DataTable('#example', {
                responsive: true,
                scrollX: true
            });
        })
    </script>


    <script>
        layout_sidebar_change('light');
    </script>



    <script>
        change_box_container('false');
    </script>


    <script>
        layout_caption_change('true');
    </script>




    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        header_change("header-1");
    </script>

</body>
<!-- [Body] end -->

</html>
