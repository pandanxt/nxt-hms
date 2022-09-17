<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
      <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MedEast Healthcare</span>
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
            <!------Create Patient Bill------>
            <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link">
                <i class="nav-icon fa fa-clipboard"></i>
                <p>Create Bills<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="emergency_bill_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Bill</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="indoor_bill_record.php" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Bill</p>  
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="outdoor_slip_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Outdoor Bill</p>
                        </a>
                    </li>
                  </small>
                </ul>
            </li>
             <!------Patient Bill Record------>
             <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link">
                <i class="nav-icon fa fa-print"></i>
                <p>Bill Records<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="emergency_bill_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Bills</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                    <a href="indoor_bill_record.php" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Bills</p>  
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="outdoor_slip_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Outdoor Bills</p>
                        </a>
                    </li>
                  </small>
                </ul>
            </li>         
            <!------Patient Record------>
            <li class="nav-item">
                <a href="patient_record.php" class="nav-link">
                <i class="nav-icon fas fa-user-injured"></i>
                <p>Patients</p>
                </a>
            </li>
            <!------Medeast Reports------>
            <li class="nav-item">
                <a href="reports.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Reports</p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
