<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="TripTrack - Scan Track Explore">
    <meta property="og:description" content="Global Track & Trace Solutions for Everyday Valuables and Travel Essentials.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://triptrack.in">
    <title>TripTrack - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.min.css') }}" />
    <meta property="og:image" content="{{ asset('assets/images/triptrack-logo-main.png?v=2') }}">
    <link rel="icon" href="{{ asset('assets/images/triptrack-logo-main.png?v=2') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/datatable/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/datatable/styles.css') }}" />
    <!-- <link rel="stylesheet" href="{{asset('assets/admin/libs/quill/dist/quill.snow.css')}}" /> -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <style>
        .body-wrapper{
            background-color: #f7f8fb;
        }

        
        .body-wrapper{
            margin-left: 0px !important;
            padding-top: 0px;
        }

        body{
          background-color:#f7f8fb;
        }
    
    </style>
  </head>
<body>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ session("error") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

   
    <!-- Sidebar Start -->
    <aside class="left-sidebar" style="top: 0px;">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
          <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img">
          <img src="{{ asset('assets/images/triptrack-logo-main.png') }}" width="100" alt="">
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"  href="{{route('admin.dashboard')}}" aria-expanded="false" >
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/genrate-new-qr') ? 'active' : '' }}" href="{{route('admin.genrate-new-qr')}}" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Genrate New QR</span>
              </a>
            </li>

            <li class="sidebar-item  {{ Request::is('admin/product-categories/*') ? 'selected' : '' }} {{ Request::is('admin/products/*') ? 'selected' : '' }}">
              <a class="sidebar-link has-arrow " href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-layout-grid"></i>
                </span>
                <span class="hide-menu">Product Category</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="{{url('admin/product-categories')}}" class="sidebar-link {{ Request::is('admin/product-categories/*') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Category</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a href="{{url('admin/products')}}" class="sidebar-link {{ Request::is('admin/products/*') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Products</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Cards</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="../main/ui-cards.html" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Basic Cards</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="../main/ui-card-customs.html" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Custom Cards</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="../main/ui-card-weather.html" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Weather Cards</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="../main/ui-card-draggable.html" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Draggable Cards</span>
                  </a>
                </li>
              </ul>
            </li> -->

          </ul>
         
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->   

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
          <nav class="navbar navbar-expand-lg navbar-light">
              <ul class="navbar-nav">
              <li class="nav-item d-block d-xl-none">
                  <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
                  </a>
              </li>
              
              </ul>
              <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
              <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                  <li class="nav-item dropdown">
                      <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          <img src="{{ asset('assets/admin/images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                      </a>
                      <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                          <div class="message-body">
                          <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                              <i class="ti ti-user fs-6"></i>
                              <p class="mb-0 fs-3">My Profile</p>
                          </a>
                          <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                              <i class="ti ti-mail fs-6"></i>
                              <p class="mb-0 fs-3">My Account</p>
                          </a>
                          <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                              <i class="ti ti-list-check fs-6"></i>
                              <p class="mb-0 fs-3">My Task</p>
                          </a>
                          <a href="{{route('admin.logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                          </div>
                      </div>
                  </li>
              </ul>
              </div>
          </nav>
        </header>

        