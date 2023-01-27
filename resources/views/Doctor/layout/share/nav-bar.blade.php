<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="{{ route('doctor.profile') }}" class="nav-link">
          <div class="nav-profile-image me-2">
            <img style="width: 55px;height: 45px; border-radius:10px;" class="" src="{{ doctorAuth()->image }}" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ doctorAuth()->name }}</span>
            <span class="text-secondary text-small">{{ doctorAuth()->degree??'Not Defined' }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('doctor.dashboard') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Live Chat</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-cellphone-link menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="">Chat Rooms</a></li>
            <li class="nav-item"> <a class="nav-link" href="">Appointment Chat</a></li>
          </ul>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <span class="menu-title">Icons</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/forms/basic_elements.html">
          <span class="menu-title">Forms</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/charts/chartjs.html">
          <span class="menu-title">Charts</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/tables/basic-table.html">
          <span class="menu-title">Tables</span>
          <i class="mdi mdi-table-large menu-icon"></i>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#user_management" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account-multiple"></i>
        </a>
        <div class="collapse" id="user_management">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="">Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="">Roles</a></li>
            <li class="nav-item"> <a class="nav-link" href="">Permissions</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
   <!-- partial -->
