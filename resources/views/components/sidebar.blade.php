<aside class="app-sidebar bg-body-secondary shadow" style="background-color:rgb(212,175,55) !important  ;">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="/" class="brand-link">
      <!--begin::Brand Image-->
      <img data-w-id="901947e3-9f91-e281-ec5c-89b6504c1a15" loading="lazy" alt=""
        src="{{asset('img/661681f6c60839d5881a158b-66181275e25270cd7740cda0_Logo.svg')}}" class="white-logo">
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2 ">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu d-flex" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="nav-icon bi bi-palette"></i>
            <p>Home</p>
          </a>
        </li>
        @can('Roles view')
        <li class="nav-item has-treeview ">
          <a href="/Role" class="nav-link">
          <i class="nav-icon bi bi-person-workspace"></i>
          <p>Roles</p>
          </a>
          <!-- <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="#" class="nav-link active">
        <i class="far fa-circle nav-icon"></i>
        <p>Active Page</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Inactive Page</p>
        </a>
        </li>
        </ul> -->
        </li>
    @endcan
        @can('permission view')
      <li class="nav-item">
        <a href="/permission" class="nav-link">
        <i class="nav-icon bi bi-toggle-on"></i>
        <p>Permissions</p>
        </a>
      </li>
    @endcan
        @can('Associate View')
      <li class="nav-item">
        <a href="/Associate" class="nav-link">
        <i class="nav-icon bi bi-person-plus-fill"></i>
        <p>Team</p>
        </a>
      </li>
    @endcan
        @can('Service View')
      <li class="nav-item">
        <a href='/services' class="nav-link">
        <i class="bi bi-x-diamond-fill"></i>
        <p>Services</p>
        </a>
      </li>
    @endcan
        @can('Customer View')
      <li class="nav-item">
        <a href="/customer" class="nav-link">
        <i class="bi bi-person"></i>
        <p>
          Customer list
        </p>
        </a>
      </li>
    @endcan
        @can('Agency View')
      <li class="nav-item">
        <a href="/agency" class="nav-link">
        <i class="bi bi-building"></i>
        <p>
          Agency
        </p>
        </a>
      </li>
    @endcan
      
    @can('Stays View')
        <li class="nav-item">
          <a href="/stays" class="nav-link">
            <img class="img-fluid"  style='filter: invert(75%);' src="{{ asset('images/cottage_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg') }}"></img>
            <p>Stays</p>
          </a>
        </li>
        @endcan
        
        @can('Cars View')
        <li class="nav-item">
          <a href="/Cars" class="nav-link">
          <img class='img-fluid' style='filter: invert(75%);' src="{{ asset('images/directions_car_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg') }}"></img>
            <p>Cars</p>
          </a>
        </li>
        @endcan
        @can('Yacht View')
        <li class="nav-item">
          <a href="/Yacht" class="nav-link">
            <img class="img-fluid"  style='filter: invert(75%);' src="{{ asset('images/sailing_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg') }}"></img>
            <p>Yatch</p>
          </a>
        </li>
        @endcan
        @can('Charters View')
        <li class="nav-item">
          <a href="/Charter" class="nav-link">
            <img class="img-fluid"  style='filter: invert(75%);' src="{{ asset('images/travel_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg') }}"></img>
            <p>Charters</p>
          </a>
        </li>
        @endcan
        @can('Booking View')
      <li class="nav-item">
        <a href="/Booking" class="nav-link">
        <i class="nav-icon bi bi-journal-check"></i>
        <p>bookings</p>
        </a>
      </li>
    @endcan
    <!-- @can('Request View')
      <li class="nav-item">
        <a href="/Requests" class="nav-link">
        <i class="nav-icon bi bi-download"></i>
        <p>Requests</p>
        </a>
      </li>
    @endcan -->
        <!-- <li class="nav-item has-treeview ">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-pc-display-horizontal"></i>
            <p>Agencies</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li>

          </ul>
        </li> -->
        @can('Sales View')
      <li class="nav-item">
        <a href="/Sales" class="nav-link">
        <i class="nav-icon bi bi-graph-up-arrow"></i>
        <p>Sales</p>
        </a>
      </li>
    @endcan
        @can('Complain View')
      <li class="nav-item">
        <a href="/Support" class="nav-link">
        <i class="nav-icon bi bi-chat-dots-fill"></i>
        <p>Support</p>
        </a>
      </li>
    @endcan
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>