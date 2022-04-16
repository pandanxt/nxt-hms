<?php 
  // Session Starts
  session_start();
  if (isset($_SESSION['userid'])) {
  // Connection File
  include('backend_components/connection.php');
  // Table Header File
  include('components/table_header.php');
  // Navbar File
  include('components/navbar.php');
  // Sidebar File
  include('components/sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2"><a type="submit" class="btn btn-block btn-primary btn-sm" href="add_user.php"><i class="fas fa-plus"></i> New User</a></div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
<?php 
  // User Table File
  include('components/user_table.php'); 
  echo '</div>';
  // Footer File
  include ('components/footer.php');
  echo '</div>';
  // Table Script
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>