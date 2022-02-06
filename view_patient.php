<?php 
    session_start(); 
    $id = (isset($_GET['id']) ? $_GET['id'] : ''); 
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
          
          $query = "SELECT * FROM `patient` 
          INNER JOIN `doctor` INNER JOIN `patient_type`
          WHERE `doctor`.`DOCTOR_ID` = `patient`.`DOCTOR_ID`
          AND `patient_type`.`PATIENT_TYPE_ALAIS` = `patient`.`PATIENT_TYPE`
          AND `PATIENT_ID` = $id";
          $result = mysqli_query($db,$query);
          if (mysqli_num_rows($result)>0) 
          {
              while ($row=mysqli_fetch_array($result)) 
              {
                $date = substr($row['PATIENT_DATE_TIME'],0, 15);
                $time = substr($row['PATIENT_DATE_TIME'],16, 50);
         
          ?>
            <div class="card">
              <div class="card-header d-flex p-0">
                <?php echo '<h3 class="card-title p-3">'.$row["PATIENT_NAME"].'</h3>'; ?>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Patient Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tab 3</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="col-md-12 clearfix">
                         <?php echo '<div class="row "><label>MR ID: </label>&nbsp; <p>'.$row["PATIENT_MR_ID"].'</p></div>'; ?>
                         <?php echo '<div class="row "><label>Name: </label>&nbsp; <p>'.$row["PATIENT_NAME"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label>Mobile: </label>&nbsp; <p>'.$row["PATIENT_MOBILE"].'</p></div>'; ?>
                         <?php
                            if ($row["PATIENT_TYPE"] == "indoor") {
                              echo '<div class="row"><label>CNIC: </label>&nbsp; <p>'.$row["PATIENT_CNIC"].'</p></div>';
                            }
                          ?>
                         <?php echo '<div class="row"><label>Gender: </label>&nbsp; <p>'.$row["PATIENT_GENDER"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label>Age: </label>&nbsp; <p>'.$row["PATIENT_AGE"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label>Address: </label>&nbsp; <p>'.$row["PATIENT_ADDRESS"].'</p></div>'; ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row"><label>Patient Type: </label>&nbsp; <p>'.$row["PATIENT_TYPE_NAME"].'</p></div>'; ?>
                          <?php echo '<div class="row"><label>Doctor: </label>&nbsp; <p>'.$row["DOCTOR_NAME"].'</p></div>'; ?>
                          <?php echo '<div class="row "><label>Date: </label>&nbsp; <p>'. $date.'</p></div>'; ?>
                          <?php echo '<div class="row"><label>Time: </label>&nbsp; <p>'.$time.'</p></div>'; ?>
                          <?php echo '<div class="row"><label>Options: </label>&nbsp; <p>';
                            echo '<a href="add_service.php?id='.$row["PATIENT_ID"].'"><i class="fas fa-edit"></i></a>';
                            echo '&nbsp; <a href="backend_components/delete_handler.php?serId='.$row["PATIENT_ID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                            echo '</p></div>'; 
                          ?>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
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
  <!-- /.Footer -->
  <?php include ('components/footer.php'); ?>
</div>
<!-- ./wrapper -->
<!-- Table Script -->
<?php //include('components/table_script.php'); ?>