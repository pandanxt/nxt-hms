<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
      <img src="dist/img/medeast-logo-icon.png" alt="MAAN MEDICAL" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MAAN MEDICAL</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!------Create Patient Slip------>
            <li class="nav-item">
              <a type="button" class="dropdown-item nav-link" data-toggle="modal" data-target="#modal-slip" href="javascript:void(0);">
                <i class="nav-icon fa fa-clipboard"></i>
                <p>Create Slip</p>
                </a>
            </li>
            <!------Patient Slip Record------>
            <li class="nav-item">
              <a type="button" href="slips.php" class="dropdown-item nav-link">
              <i class="nav-icon fa fa-print"></i>
              <p>Slip Records</p>
              </a>
            </li>
            <!------FollowUp Record------>
            <li class="nav-item">
                <a href="followup_slip.php" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>FollowUp Slips</p>
                </a>
            </li>
            <!------Service Record------>
            <li class="nav-item">
                <a href="service_slip.php" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>Service Slips</p>
                </a>
            </li>
            <!------Patient Record------>
            <li class="nav-item">
                <a href="patient_record.php" class="nav-link">
                <i class="nav-icon fas fa-user-injured"></i>
                <p>Patients</p>
                </a>
            </li>
            <!------NXT Reports------>
            <li class="nav-item">
              <a type="button" class="dropdown-item nav-link" data-toggle="modal" data-target="#modal-report" href="javascript:void(0);">
                <i class="nav-icon fa fa-chart-pie"></i>
                <p>Reports</p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
