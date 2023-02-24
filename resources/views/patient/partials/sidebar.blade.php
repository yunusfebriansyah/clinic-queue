<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
          <i class="fas fa-clinic-medical"></i>
      </div>
      <div class="sidebar-brand-text mx-3">BMC</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ request()->is('patient') ? 'active' : '' }}">
      <a class="nav-link" href="/patient">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Data Berobat
  </div>

  <!-- Nav Item - Charts -->
  <li class="nav-item {{ request()->is('patient/registers*') ? 'active' : '' }}">
      <a class="nav-link" href="/patient/registers">
        <i class="fas fa-stethoscope"></i>
          <span>Pendaftaran</span></a>
  </li>
  <li class="nav-item {{ request()->is('patient/treatments*') ? 'active' : '' }}">
      <a class="nav-link" href="/patient/treatments">
        <i class="fas fa-briefcase-medical"></i>
          <span>Pengobatan</span></a>
  </li>
  <li class="nav-item {{ request()->is('patient/queues*') ? 'active' : '' }}">
      <a class="nav-link" href="/patient/queues">
        <i class="fas fa-user-md"></i>
          <span>Antrian</span></a>
  </li>

        
<hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->