<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $page_title }}</title>
  <link rel="shortcut icon" href="{{ url('/img/gbdoelogo.png') }}">
  <meta name="description" content="Board of Elementary Examination, Gilgit Baltistan.">
  <meta name="author" content="Board of Elementary Examination, Gilgit Baltistan">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ url('/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/css/buttons.bootstrap4.min.css') }}">

  <!-- Jquery Confirm -->
  <link rel="stylesheet" href="{{ url('/css/jquery-confirm.css') }}">

  <!-- Modals -->
  <link rel="stylesheet" href="{{ url('/css/toastr.min.css') }}">

  <!-- Select 2 -->
  <link rel="stylesheet" href="{{ url('/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('/css/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/css/datepicker.css') }}">
  <link rel="stylesheet" href="{{ url('/css/tempusdominus.min.css') }}">


  <!-- Summernote Editor -->
  <link rel="stylesheet" href="{{ url('/css/summernote-bs4.min.css') }}">


  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/pace.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/pace-theme-flash.css') }}">
  <link rel="stylesheet" href="{{ url('css/preloader.css') }}">


  <!-- Custom Styling -->
  <link rel="stylesheet" href="{{ url('css/customstyle.css') }}">
  
</head>
<body class="sidebar-collapse sidebar-mini pace-done">
<div class="col-8 align-self-center someBlock"></div>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @if(auth()->user()->user_role == 1)
          <a href="{{ url('admin/dashboard') }}" class="nav-link"><span class="fa fa-tachometer-alt"></span>&nbsp;&nbsp;Home</a>
        @elseif(auth()->user()->user_role == 2)
          <a href="{{ url('assessmentcenter/dashboard') }}" class="nav-link"><span class="fa fa-tachometer-alt"></span>&nbsp;&nbsp;Home</a>
        @else
          <a href="{{ url('dataentry/index') }}" class="nav-link"><span class="fa fa-tachometer-alt"></span>&nbsp;&nbsp;Home</a>
        @endif
      </li>
      <li class="nav-item d-none d-sm-inline-block text-danger">
        <a href="{{ route('users.signout') }}" class="nav-link"><span class="fa fa-lock"></span>&nbsp;&nbsp;Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      @if(auth()->user()->user_role == 1)
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      

      <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="{{ url('/img/default-prof-img.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>

          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="{{ url('/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>

          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="{{ url('/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>

          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ url('/img/gbdoelogo_white.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BEE, GB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ auth()->user()->image == '' ? url('/img/default-prof-img.jpg') : url(auth()->user()->image) }}" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            @if(auth()->user()->user_role == 1)
              <a href="{{ url('admin/dashboard') }}" class="nav-link">
            @elseif(auth()->user()->user_role == 2)
              <a href="{{ url('assessmentcenter/dashboard') }}" class="nav-link">
            @else
              <a href="{{ url('dataentry/index') }}" class="nav-link">
            @endif
            
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(auth()->user()->user_role == 1)
              <li class="nav-item {{ $selected_main_menu == 'districts' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'districts' ? 'active':'' }}">
                  <i class="nav-icon fas fa-building"></i>
                  <p>
                    Districts
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/districts/index') }}" class="nav-link {{ $selected_sub_menu == 'districts_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/districts/create') }}" class="nav-link {{ $selected_sub_menu == 'districts_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'tehsils' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'tehsils' ? 'active':'' }}">
                  <i class="nav-icon fas fa-book-reader"></i>
                  <p>
                    Tehsils
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/tehsils/index') }}" class="nav-link {{ $selected_sub_menu == 'tehsils_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/tehsils/create') }}" class="nav-link {{ $selected_sub_menu == 'tehsils_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item {{ $selected_main_menu == 'sessions' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'sessions' ? 'active':'' }}">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>
                    Sessions
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/sessions/index') }}" class="nav-link {{ $selected_sub_menu == 'sessions_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/sessions/create') }}" class="nav-link {{ $selected_sub_menu == 'sessions_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'semesters' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'semesters' ? 'active':'' }}">
                  <i class="nav-icon fas fa-mountain"></i>
                  <p>
                    Semesters
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/semesters/index') }}" class="nav-link {{ $selected_sub_menu == 'semesters_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/semesters/create') }}" class="nav-link {{ $selected_sub_menu == 'semesters_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'banks' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'banks' ? 'active':'' }}">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                    Banks
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/banks/index') }}" class="nav-link {{ $selected_sub_menu == 'banks_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/banks/create') }}" class="nav-link {{ $selected_sub_menu == 'banks_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item {{ $selected_main_menu == 'fees' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'fees' ? 'active':'' }}">
                  <i class="nav-icon fas fa-file-medical-alt"></i>
                  <p>
                    Fees
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/fees/index') }}" class="nav-link {{ $selected_sub_menu == 'fees_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/fees/create') }}" class="nav-link {{ $selected_sub_menu == 'fees_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/fees/generatefeedetails') }}" class="nav-link {{ $selected_sub_menu == 'fees_details' ? 'active open':'' }}">
                      <i class="far fa-money-bill-alt nav-icon"></i>
                      <p>Fee Details</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- <li class="nav-item {{ $selected_main_menu == 'fees_groups' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'fees_groups' ? 'active':'' }}">
                  <i class="nav-icon fas fa-object-ungroup"></i>
                  <p>
                    Fee Groups
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/feegroups/index') }}" class="nav-link {{ $selected_sub_menu == 'fees_groups_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/feegroups/create') }}" class="nav-link {{ $selected_sub_menu == 'fee_groups_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li> -->

              <li class="nav-item {{ $selected_main_menu == 'classes' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'classes' ? 'active':'' }}">
                  <i class="nav-icon fas fa-city"></i>
                  <p>
                    Classes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/classes/index') }}" class="nav-link {{ $selected_sub_menu == 'classes_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/classes/create') }}" class="nav-link {{ $selected_sub_menu == 'classes_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'subjects' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'subjects' ? 'active':'' }}">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Subjects
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/subjects/index') }}" class="nav-link {{ $selected_sub_menu == 'subjects_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/subjects/create') }}" class="nav-link {{ $selected_sub_menu == 'subjects_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'subject_groups' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'subject_groups' ? 'active':'' }}">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Subject Groups
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/subjectgroups/index') }}" class="nav-link {{ $selected_sub_menu == 'subject_groups_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/subjectgroups/create') }}" class="nav-link {{ $selected_sub_menu == 'subject_groups_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'datesheets' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'datesheets' ? 'active':'' }}">
                  <i class="nav-icon fas fa-align-center"></i>
                  <p>
                    Datesheets
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/datesheets/index') }}" class="nav-link {{ $selected_sub_menu == 'datesheets_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/datesheets/create') }}" class="nav-link {{ $selected_sub_menu == 'datesheets_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/datesheets/printdatesheets') }}" class="nav-link {{ $selected_sub_menu == 'print_datesheets' ? 'active open':'' }}">
                      <i class="far fa-window-restore nav-icon"></i>
                      <p>Print Datesheet</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'institutions' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'institutions' ? 'active':'' }}">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                    Institutions
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/institutions/index') }}" class="nav-link {{ $selected_sub_menu == 'institutions_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/institutions/create') }}" class="nav-link {{ $selected_sub_menu == 'institutions_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'students' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'students' ? 'active':'' }}">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>
                    Students
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/students/index') }}" class="nav-link {{ $selected_sub_menu == 'students_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>View All</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/students/create') }}" class="nav-link {{ $selected_sub_menu == 'students_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/students/search') }}" class="nav-link {{ $selected_sub_menu == 'search_students' ? 'active open':'' }}">
                      <i class="far fa-flag nav-icon"></i>
                      <p>Search</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'exams' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'exams' ? 'active':'' }}">
                  <i class="nav-icon fas fa-balance-scale-left"></i>
                  <p>
                    Exams
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/exams/editmarksbysearch') }}" class="nav-link {{ $selected_sub_menu == 'exams_index' ? 'active open':'' }}">
                      <i class="far fa-edit nav-icon"></i>
                      <p>Edit Marks</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/exams/updatemarksbycenters') }}" class="nav-link {{ $selected_sub_menu == 'update_marks_by_centers' ? 'active open':'' }}">
                      <i class="far fa-edit nav-icon"></i>
                      <p>Edit Marks By Centers</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/exams/generateslips') }}" class="nav-link {{ $selected_sub_menu == 'exams_slips' ? 'active open':'' }}">
                      <i class="far fa-file-alt nav-icon"></i>
                      <p>Generate Slips</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/exams/generateawardsheetbydata') }}" class="nav-link {{ $selected_sub_menu == 'exams_awardsheets' ? 'active open':'' }}">
                      <i class="far fa-calendar-alt nav-icon"></i>
                      <p>Generate Awardsheets</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/exams/generategazette') }}" class="nav-link {{ $selected_sub_menu == 'exams_gazettes' ? 'active open':'' }}">
                      <i class="far fa-clipboard nav-icon"></i>
                      <p>Generate Gazettes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/exams/generatemarksheetsbysearch') }}" class="nav-link {{ $selected_sub_menu == 'exams_marksheets' ? 'active open':'' }}">
                      <i class="far fa-address-card nav-icon"></i>
                      <p>Generate Marksheets</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ $selected_main_menu == 'importsexports' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'importsexports' ? 'active':'' }}">
                  <i class="nav-icon fas fa-flag"></i>
                  <p>
                    Import / Export
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/importsexports/import') }}" class="nav-link {{ $selected_sub_menu == 'import' ? 'active open':'' }}">
                      <i class="far fa-folder nav-icon"></i>
                      <p>Import</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/importsexports/export') }}" class="nav-link {{ $selected_sub_menu == 'export' ? 'active open':'' }}">
                      <i class="far fa-folder-open nav-icon"></i>
                      <p>Export</p>
                    </a>
                  </li>
                </ul>
              </li>
              
          @endif

          @if(auth()->user()->user_role == 3)

            <li class="nav-item {{ $selected_main_menu == 'students' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'students' ? 'active':'' }}">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>
                    Students
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('dataentry/students/searchbycenter') }}" class="nav-link {{ $selected_sub_menu == 'students_index' ? 'active open':'' }}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>Search</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('dataentry/students/create') }}" class="nav-link {{ $selected_sub_menu == 'students_create' ? 'active open':'' }}">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Create</p>
                    </a>
                  </li>
                </ul>
              </li>

          @endif

          @if(auth()->user()->user_role == 2)
            <li class="nav-item {{ $selected_main_menu == 'marks_update' ? ' menu-is-opening menu-open':'' }}">
                <a href="#" class="nav-link {{ $selected_main_menu == 'marks_update' ? 'active':'' }}">
                  <i class="nav-icon fas fa-balance-scale-left"></i>
                  <p>
                    Exams
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('assessmentcenter/marks/editmarksbysearch') }}" class="nav-link {{ $selected_sub_menu == 'marks_index' ? 'active open':'' }}">
                      <i class="far fa-edit nav-icon"></i>
                      <p>Update Marks</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('assessmentcenter/marks/updatemarksbycenters') }}" class="nav-link {{ $selected_sub_menu == 'update_marks_by_centers' ? 'active open':'' }}">
                      <i class="far fa-edit nav-icon"></i>
                      <p>Edit Marks By Centers</p>
                    </a>
                  </li>
                </ul>
              </li>
          @endif

          <li class="nav-header">Options</li>
          @if(auth()->user()->user_role == 1)
          <li class="nav-item">
            <a href="{{ url('admin/settings/index') }}" class="nav-link {{ $selected_sub_menu == 'settings_index' ? 'active open':'' }}">
              <i class="nav-icon far fa fa-cog text-info"></i>
              <p class="text">Settings</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/failedjobs/index') }}" class="nav-link {{ $selected_sub_menu == 'failed_jobs_index' ? 'active open':'' }}">
              <i class="nav-icon far fa fa-times-circle text-warning"></i>
              <p class="text">Failed Jobs</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('users.signout') }}" class="nav-link">
              <i class="nav-icon far fa fa-lock text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Powered by <a href="#">Highlander Connection &copy;</a>.</strong> Heli Chowk, Near FCNA HQ, Jutial Gilgit
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('/js/jquery.min.js') }}"></script>
<script src="{{ url('/js/moment.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select 2 -->
<script src="{{ url('/js/select2.full.min.js') }}"></script>
<!-- Form Validations -->
<script src="{{ url('/js/jquery.validate.min.js') }}"></script>
<script src="{{ url('/js/additional-methods.min.js') }}"></script>
<!-- Jquer Confirm -->

<script src="{{ url('/js/jquery-confirm.js') }}"></script>

<!-- Datatables -->
<script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('/js/jszip.min.js') }}"></script>
<script src="{{ url('/js/pdfmake.min.js') }}"></script>
<script src="{{ url('/js/vfs_fonts.js') }}"></script>
<script src="{{ url('/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/js/buttons.colVis.min.js') }}"></script>
<!--Modals-->

<script src="{{ url('/js/toastr.min.js') }}"></script>
<script src="{{ url('/js/pace.min.js') }}"></script>

<script src="{{ url('/js/bootstrap-wizard.js') }}"></script>
<script src="{{ url('/js/inputmask.min.js') }}"></script>
<script src="{{ url('/js/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('/js/printThis.js') }}"></script>
<script src="{{ url('/js/datepicker.js') }}"></script>
<script src="{{ url('/js/tompusdominus.min.js') }}"></script>


<script src="{{ url('/js/summernote-bs4.min.js') }}"></script>
<script src="{{ url('/js/jquery.preloader.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ url('/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/js/demo.js') }}"></script>

@stack('scripts')

</body>
</html>
