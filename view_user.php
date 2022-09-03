<?php 
  // Session Starts
  session_start(); 
  if (isset($_SESSION['uuid'])) {
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
  <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <?php
          $id = (isset($_GET['id']) ? $_GET['id'] : '');
          $query = "SELECT * FROM `me_user` WHERE `USER_UUID` = '$id'";
          $result = mysqli_query($db,$query);
          if (mysqli_num_rows($result)>0) 
          {
            while ($row=mysqli_fetch_array($result)) 
            {
          ?>
            <div class="card">
              <div class="card-header d-flex p-0">
                <h1 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h1>
                <?php echo '<h3 class="card-title p-3">'.$row["USER_NAME"].'</h3>'; ?>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="col-md-12 clearfix">
                         <?php echo '<div class="row "><label>User Name: </label>&nbsp; <p>'.$row["USER_NAME"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label>User Email: </label>&nbsp; <p>'.$row["USER_ROLE"].'</p></div>'; ?>
                         <?php if ($_SESSION['role'] == "admin") {  ?>
                         <?php echo '<div class="row"><label>Status: </label>&nbsp; <p>'.$row["USER_STATUS"].'&nbsp; <a href="#"><i class="fas fa-exchange-alt"></i></a></p></div>'; ?>
                         <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row "><label>Created On: </label>&nbsp; <p>'.$row["USER_DATE_TIME"].'</p></div>'; ?>
                          <?php if ($_SESSION['role'] == "admin") {  ?>
                          <?php echo '<div class="row"><label>Options: </label>&nbsp; <p>';
                            echo '<a href="add_user.php?id='.$row["USER_UUID"].'"><i class="fas fa-edit"></i></a>';
                            echo '&nbsp; <a href="backend_components/delete_handler.php?userId='.$row["USER_UUID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                            echo '</p></div>';
                          } 
                          ?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.Footer -->
<?php 
    }
  }   
  // Footer File
  include ('components/footer.php'); 
  echo '</div>';
  // Table Script File
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>