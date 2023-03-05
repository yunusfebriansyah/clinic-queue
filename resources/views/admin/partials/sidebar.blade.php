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
  <li class="nav-item {{ request()->is('administrator') ? 'active' : '' }}">
      <a class="nav-link" href="/administrator">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Data Master
  </div>

  <li class="nav-item {{ request()->is('administrator/users*') || request()->is('administrator/printings*') || request()->is('administrator/sizes*') || request()->is('administrator/users*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users"></i>
        <span>Pengguna</span>
    </a>
    <div id="collapseTwo" class="collapse {{ request()->is('administrator/users*') || request()->is('administrator/printings*') || request()->is('administrator/sizes*') || request()->is('administrator/users*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->is('administrator/users/doctors*') ? 'active' : '' }}" href="/administrator/users/doctors">Dokter</a>
            <a class="collapse-item {{ request()->is('administrator/users/administrators*') ? 'active' : '' }}" href="/administrator/users/administrators">Administrator</a>
            <a class="collapse-item {{ request()->is('administrator/users/patients*') ? 'active' : '' }}" href="/administrator/users/patients">Pasien</a>
        </div>
    </div>
</li>

  <li class="nav-item {{ request()->is('administrator/services*') ? 'active' : '' }}">
      <a class="nav-link" href="/administrator/services">
          <i class="fas fa-fw fa-notes-medical"></i>
          <span>Layanan</span></a>
  </li>
  <li class="nav-item {{ request()->is('administrator/events*') ? 'active' : '' }}">
      <a class="nav-link" href="/administrator/events">
          <i class="fas fa-fw fa-images"></i>
          <span>Galeri Kegiatan</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Data Berobat
  </div>

  <!-- Nav Item - Charts -->
  <li class="nav-item {{ request()->is('administrator/treatments*') ? 'active' : '' }}">
      <a class="nav-link" href="/administrator/treatments">
        <i class="fas fa-briefcase-medical"></i>
          <span>Pengobatan</span></a>
  </li>
  <li class="nav-item {{ request()->is('administrator/queues*') ? 'active' : '' }}">
      <a class="nav-link" href="/administrator/queues">
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