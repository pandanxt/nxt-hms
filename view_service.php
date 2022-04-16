<?php 
    session_start();
?>
  <!-- Connection -->
  <?php include('backend_components/connection.php'); ?>
  <!-- table-header -->
  <?php include('components/table_header.php'); ?>
   <!-- Navbar -->
   <?php include('components/navbar.php'); ?>
  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <?php
          $id = (isset($_GET['id']) ? $_GET['id'] : '');
          $query = "SELECT * FROM `bill_service` WHERE `BILL_SERVICE_ID` = $id";
          $result = mysqli_query($db,$query);
          if (mysqli_num_rows($result)>0) 
          {
              while ($row=mysqli_fetch_array($result)) 
              {
                $date = substr($row['SERVICE_SAVE_TIME'],0, 15);
                $time = substr($row['SERVICE_SAVE_TIME'],16, 50);
         
          ?>
            <div class="card">
              <div class="card-header d-flex p-0">
                <?php echo '<h3 class="card-title p-3">'.$row["BILL_SERVICE_NAME"].'</h3>'; ?>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="col-md-12 clearfix">
                         <?php echo '<div class="row "><label>Service Name: </label>&nbsp; <p>'.$row["BILL_SERVICE_NAME"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label>Service Amount: </label>&nbsp; <p>'.$row["BILL_SERVICE_AMOUNT"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label>Status: </label>&nbsp; <p>'.$row["SERVICE_STATUS"].'&nbsp; <a href="#"><i class="fas fa-exchange-alt"></i></a></p></div>'; ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row "><label>Date: </label>&nbsp; <p>'. $date.'</p></div>'; ?>
                          <?php echo '<div class="row"><label>Time: </label>&nbsp; <p>'.$time.'</p></div>'; ?>
                          <?php echo '<div class="row"><label>Options: </label>&nbsp; <p>';
                            echo '<a href="add_service.php?id='.$row["BILL_SERVICE_ID"].'"><i class="fas fa-edit"></i></a>';
                            echo '&nbsp; <a href="backend_components/delete_handler.php?serId='.$row["BILL_SERVICE_ID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                            echo '</p></div>'; 
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
  ?>
  <?php include ('components/footer.php'); ?>
</div>
<!-- ./wrapper -->
<!-- Table Script -->
<?php include('components/table_script.php'); ?>