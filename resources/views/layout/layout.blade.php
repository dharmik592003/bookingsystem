<!doctype html>
<html lang="en">
<!--begin::Head-->


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ELVIN</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE v4 | Dashboard" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!--begin::Fonts-->
  @section('style')
  @show
  <link rel="stylesheet" href="{{asset('admin/dist/css/index.css')}}" />
  <link rel="shortcut icon" href="{{ asset('images/Group 1.svg')}}" type="image/x-icon">
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="{{asset('admin/dist/css/overlayscrollbars.min.css')}}" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="{{asset('admin/dist/css/bootstrap-icons.min.css')}}" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.css')}}" />
  <!--end::Required Plugin(AdminLTE)-->
  <!-- apexcharts -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/apexcharts.css')}}" />
  <!-- jsvectormap -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/jsvectormap.min.css')}}" />
  
  <style>
    #show {
      right: -10px;
    }
  </style>

</head>

<div id="preloader"
  style="display: block; position: fixed;  width: 100%; height: 100%; background-color: #fff; z-index: 9999; display: flex; justify-content: center; align-items: center;">
  <div class="preloader-inner">
    <div class="text-primary" role="status">
      <img src="{{ asset('images/Group 1.svg') }}" alt="">
    </div>
  </div>
</div>
<script>
  window.addEventListener('load', function () {
    setTimeout(function () {
      document.getElementById('preloader').style.display = 'none';
    }, 200);
  });
</script>


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  @if(Session::has('fail'))
    <div class="alert alert-danger">
    {{Session::get('fail')}}
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
  @endif

  <!--begin::App Wrapper-->
  @csrf
  <div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body"
      style="transition: background-color 0.5s ease-in-out, backdrop-filter 0.5s ease-in-out;">
      <!--begin::Container-->
      <div class="container-fluid d-flex justify-content-between">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <li class="nav-item dropdown user-menu">
            <button href="#" class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" id="user-dropdown">
              <img
                src="{{ isset($user) && $user->profile_photo ? asset($user->profile_photo) : asset('admin/dist/assets/img/user.webp') }}"
                class="user-image rounded-circle shadow" alt="User Image" />
              <span class="">{{ isset($user) ? $user->name : 'Guest' }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" id="show">
              <!--begin::User Image-->
              <li class="user-header text-bg-primary">
                <img
                  src="{{ isset($user) && $user->profile_photo ? asset($user->profile_photo) : asset('admin/dist/assets/img/user.webp') }}"
                  class="user-image rounded-circle shadow" alt="User Image" />
                <p>
                  {{ isset($user) ? $user->name : 'Guest' }}
                  <small>{{ isset($user) ? 'Member since ' . $user->created_at : '' }}</small>
                </p>
              </li>
              @if(Session::get('loginid') == '3')
          <li class="user-footer">
          <a href="/login" class="btn btn-default btn-flat float-end">Log in</a>
          <a href="/registration" class="btn btn-default btn-flat float-end">Sign up</a>
          </li>
        @else
        <li class="user-footer">
        <a href="{{ route('profile') }}" class="btn btn-default btn-flat float-end">profile</a>
        <a href="/logout" class="btn btn-default btn-flat float-end">Sign out</a>
        </li>
      @endif
            </ul>
          </li>
        </ul>
      </div>
    </nav>


    @include('components.sidebar')

    <main class="app-main  overflow-hidden">
      @section('main')
      @show
    </main>
    @include('components.footer')
  </div>

  <script src="{{asset('/admin/dist/js/overlayscrollbars.browser.es6.min.js')}}"></script>
  <script src="{{asset('/admin/dist/js/popper.min.js')}}"></script>
  <script src="{{asset('/admin/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('/admin/dist/js/adminlte.js')}}"></script>

  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };

    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>

  <script src="{{asset('admin/dist/js/Sortable.min.js')}}"></script>

  <script>
    const connectedSortables = document.querySelectorAll('.connectedSortable');
    connectedSortables.forEach((connectedSortable) => {
      let sortable = new Sortable(connectedSortable, {
        group: 'shared',
        handle: '.card-header',
      });
    });

    const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
    cardHeaders.forEach((cardHeader) => {
      cardHeader.style.cursor = 'move';
    });
  </script>

  <script src="{{asset('admin/dist/js/apexcharts.min.js')}}"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous">
    </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @section('script')
  @show

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/ScrollTrigger.min.js"></script>
  <script>
    let navbg = document.querySelector('.app-header')
    gsap.registerPlugin(ScrollTrigger);
    gsap.to('.app-header', {
      scrollTrigger: {
        trigger: '.app-header',
        start: 'top top',
        end: '+=10',
        toggleActions: 'play none none reset',
      },
      backgroundColor: 'rgba(255, 255, 255, 0.8) ',
      backdropFilter: 'blur(20px)',
      position: 'sticky',
      top: 0,
      opacity: 1,
      y: 0
    }, {
      scrollTrigger: {
        trigger: '.app-header',
        start: 'top top',
        end: '+=10',
        toggleActions: 'play none none reset',
        scrub: true
      },
      y: -100,
      opacity: 0
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const userDropdown = document.getElementById('user-dropdown');
      const showElement = document.getElementById('show');


      if (userDropdown && showElement) {

        // Add the data-bs-popper attribute to the show element
        showElement.setAttribute('data-bs-popper', 'static');

        userDropdown.addEventListener('click', function () {
          // Check the current state of aria-expanded
          const isExpanded = userDropdown.getAttribute('aria-expanded') === 'true';

          // Toggle the aria-expanded attribute
          userDropdown.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');

          // Toggle the 'show' class on the dropdown menu
          if (isExpanded) {
            showElement.classList.remove('show');
          } else {
            showElement.classList.add('show');
          }
        });
      }});
      
  </script>


</body>

</html>