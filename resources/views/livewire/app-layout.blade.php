<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, materialpro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, materialpro admin lite design, materialpro admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Material Pro Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ $page_title }}</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.png') }}">
    <!-- Custom CSS -->
    <link href="{{ url('assets/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/select2-bootstrap4.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    @livewireStyles
    @powerGridStyles
    <link href="{{ url('assets/css/custom_styles.css') }}" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand ms-4" href="index.html">
                        <!-- Logo icon -->
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img style="max-width:80%;" src="{{ url('assets/images/gb-it-logo.png') }}" alt="homepage"
                                class="dark-logo" />

                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-white d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-lg-none d-md-block ">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white "
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <span style="font-size:30px;cursor:pointer;color:#fff; margin-top:10px;" id="myMenu"
                            onclick="openNav()">&#9776;</span>

                        <li class="nav-item search-box">
                            <a class="nav-link text-muted" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search" style="display: none;">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a style="background: transparent !important;"
                                class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ url('img/avatar5.png') }}" alt="user"
                                    class="profile-pic me-2">{{ auth()->user()->user_name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ auth()->user()->role_id == 1 ? route('admin.settings.index') : (auth()->user()->role_id == 2 ? route('bank.settings.index') : route('company.settings.index')) }}"><span class="fa fa-cog"></span> Settings</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('users.signout') }}"><span
                                            class="fa fa-power-off"></span> Logout</a></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside id="mySidenav" class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div id="scroll-sidebar" class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a
                                class="{{ $selected_sub_menu == 'admin_dashboard' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ auth()->user()->role_id == 1 ? route('admin.index') : (auth()->user()->role_id == 2 ? route('bank.index') : route('company.index')) }}" aria-expanded="false"><i
                                    class="mdi me-2 mdi-gauge"></i><span class="hide-menu">Dashboard</span></a></li>
                        @if(auth()->user()->role_id == 1)
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_districts' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.districts.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-chart-areaspline"></i><span
                                        class="hide-menu">Districts</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_categories' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.categories.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-cellphone-link"></i><span
                                        class="hide-menu">Categories</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                class="{{ $selected_sub_menu == 'admin_domains' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.domains.index') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-domain"></i><span
                                    class="hide-menu">Domains</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_performance_measures' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.performancemeasures.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-speedometer"></i><span class="hide-menu">Measures</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_schemes' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.schemes.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-chart-bar"></i><span class="hide-menu">Schemes</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_phases' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.phases.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-calendar-clock"></i><span class="hide-menu">Phases</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_companies' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.companies.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-home-modern"></i><span class="hide-menu">Companies</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                class="{{ $selected_sub_menu == 'admin_projects' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.projects.index') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-projector-screen"></i><span class="hide-menu">Projects</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                class="{{ $selected_sub_menu == 'admin_projects_activities' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.activities.index') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-reorder-horizontal"></i><span class="hide-menu">Activities</span></a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_company_financials' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ auth()->user()->role_id == 1 ? route('admin.companyfinancials.index') : route('bank.companyfinancials.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-currency-inr"></i><span class="hide-menu">Financials</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_company_installments' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ auth()->user()->role_id == 1 ? route('admin.companyinstallments.index') : route('bank.companyinstallments.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-format-list-bulleted-type"></i><span
                                        class="hide-menu">Installments</span></a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 1)
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_company_performance_measures' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.companyperformancemeasures.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-clock"></i><span class="hide-menu">Performance</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_roles' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.roles.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-account-convert"></i><span class="hide-menu">Roles</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_users' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('admin.users.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-account-switch"></i><span class="hide-menu">Users</span></a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 3)
                            <li class="sidebar-item"> <a
                                    class="{{ $selected_sub_menu == 'admin_profile' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('company.profile.index') }}" aria-expanded="false">
                                    <i class="mdi me-2 mdi-account-outline"></i><span class="hide-menu">Profile</span></a>
                            </li>
                            <li class="sidebar-item"> <a
                                class="{{ $selected_sub_menu == 'admin_project_activities' ? 'active' : '' }} sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('company.projectsandactivities.index') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-reorder-horizontal"></i><span class="hide-menu">Project And Activities</span></a>
                            </li>
                        @endif
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <div id="sidebar-footer" class="sidebar-footer">
                <div class="row">
                    <div class="col-6 link-wrap">
                        <!-- item-->
                        <a id="perma-link" href="{{ auth()->user()->role_id == 1 ? route('admin.settings.index') : (auth()->user()->role_id == 2 ? route('bank.settings.index') : route('company.settings.index')) }}" class="link" data-toggle="tooltip" title=""
                            data-original-title="Settings"><i class="ti-settings"></i></a>
                    </div>
                    <div class="col-6 link-wrap">
                        <!-- item-->
                        <a id="link-2" href="{{ route('users.signout') }}" class="link" data-toggle="tooltip" title=""
                            data-original-title="Logout"><i class="mdi mdi-power"></i></a>
                    </div>
                </div>
            </div>
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div id="page_wrapper" class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            {{ $slot }}
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> Powered By <a href="#">The Highlanders Connection © </a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ url('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('/js/moment.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/app-style-switcher.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ url('assets/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ url('assets/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <script src="{{ url('assets/js/block-ui.js') }}"></script>
    <script src="{{ url('assets/js/Chart.js') }}"></script>
    <script src="{{ url('/js/select2.full.min.js') }}"></script>
    @stack('scripts')

    @livewireScripts
    @powerGridScripts

    <script>

        window.addEventListener('blockUI', event => {
            $.blockUI({
                message: '<div style="width: 5rem; height: 5rem; border-width: 10px;"  class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>',
                overlayCSS: {
                    backgroundColor: "#000",
                    opacity: 0.5,
                    cursor: "wait",
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: "transparent",
                },
            });
        })

        window.addEventListener('unblockUI', event=>{
            $.unblockUI();
        })

        function openNav() {
            document.getElementById("mySidenav").style.width = "240px";
            document.getElementById("scroll-sidebar").style.width = "240px";
            document.getElementById("page_wrapper").style.marginLeft = "240px";
            $('#mySidenav a').css('width', '100%');
            $('#sidebar-footer').css('display', 'block');
            $('#mySidenav .hide-menu').css('display', 'block');
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "80px";
            document.getElementById("scroll-sidebar").style.width = "80px";
            document.getElementById("page_wrapper").style.marginLeft = "90px";
            $('#mySidenav a').css('width', '50px');
            $('#sidebar-footer').css('display', 'none');
            $('#mySidenav .hide-menu').css('display', 'none');
        }

        $("#myMenu").click(function() {
            return (this.tog = !this.tog) ? openNav() : closeNav();
        });

        /* function openNav() {
            document.getElementById("mySidenav").style.width = "240px";
            document.getElementById("scroll-sidebar").style.width = "240px";
            document.getElementById("page_wrapper").style.marginLeft = "240px";
            $('#mySidenav a').css('width', '100%');
            $('#sidebar-footer').css('display', 'block');
            $('#mySidenav .hide-menu').css('display', 'block');
        }
        */
        window.addEventListener('click', function(e) {
            if (!document.getElementById('mySidenav').contains(e.target) && !document.getElementById('myMenu')
                .contains(e.target)) {
                // Clicked in box
                closeNav();

            }
        });

        $(document).ready(function() {
            $('#mySidenav').mouseover(function() {
                openNav();
            });

            $('#mySidenav').mouseleave(function() {
                closeNav
            });
        });
    </script>
</body>

</html>
