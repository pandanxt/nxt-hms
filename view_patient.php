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
  <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <?php
          $id = (isset($_GET['id']) ? $_GET['id'] : '');
          $sql="SELECT *, `DOCTOR_NAME`
          FROM `emergency_patient` 
          INNER JOIN `doctor` WHERE 
          `PATIENT_ID` = " .$id. " AND 
          `emergency_patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
          
          $qsql = mysqli_query($db,$sql);
          $row = mysqli_fetch_array($qsql);
          
          $date = $row['PATIENT_DATE_TIME'];
          $_SESSION['MRID'] = $row['PATIENT_MR_ID'];
        ?>
            <div class="card">
              <div class="card-header d-flex p-0">
              <h1 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h1>
                <?php echo '<h3 class="card-title p-3">'.$row["PATIENT_NAME"].'</h3>'; ?>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                         <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">MR ID: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_MR_ID"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Name: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_NAME"].'</p></div>'; ?>
                         <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Mobile: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_MOBILE"].'</p></div>'; ?>
                         <?php
                            // if ($row["PATIENT_TYPE"] == "indoor") {
                              // echo '<div class="row"><label>CNIC: </label>&nbsp; <p>'.$row["PATIENT_CNIC"].'</p></div>';
                            // }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Doctor: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["DOCTOR_NAME"].'</p></div>'; ?>
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Gender: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_GENDER"].'</p></div>'; ?>
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Age: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_AGE"].'&nbsp;Years</p></div>'; ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row "><label style="margin-bottom: 0px !important;">Date: </label>&nbsp; <p style="margin-bottom: 0px !important;">'. $date.'</p></div>'; ?>
                          <!-- <?php //echo '<div class="row"><label style="margin-bottom: 0px !important;">Patient Type: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_TYPE"].'</p></div>'; ?> -->
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Address: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_ADDRESS"].'</p></div>'; ?>
                          <?php echo '<div class="row"><label>Options: </label>&nbsp; <p>';
                            echo '<a href="add_service.php?id='.$row["PATIENT_ID"].'"><i class="fas fa-edit"></i></a>';
                            echo '&nbsp; <a href="backend_components/delete_handler.php?serId='.$row["PATIENT_ID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                            echo '</p></div>'; 
                          ?>    
                        </div>
                      </div>
                    </div>
                    
                    <!-- Patient Records of Bill -->
                        <div class="row">
                          <div class="col-12">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>S.No#</th>
                                <th>Bill Date</th>
                                <th>Bill Services</th>
                                <th>Days</th>
                                <th>Admission</th>
                                <th>Discharge</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Option</th>
                              </tr>
                              </thead>
                              <tbody>
                                  <?php
                                      $MRID = $_SESSION['MRID'];

                                      $sql ="SELECT * FROM `emergency_patient` WHERE `emergency_patient`.`PATIENT_MR_ID` =  '$MRID'";
                                      $qsql = mysqli_query($db,$sql);
                                      while($rs = mysqli_fetch_array($qsql))
                                      { 
                                        $date = $rs['BILL_DATE'];
                                        $service=$rs['SERVICES'];

                                        $str = strval($service); 
                                        $str1 = RemoveChar($str); 
                                        echo "<tr>
                                        <td>$rs[BILL_ID]</td>
                                        <td>$rs[BILL_DATE]</td>
                                        <td><small>$service</small></td>
                                        <td>$rs[ADMIT_DAYS]</td>
                                        <td>$rs[ADMISSION_DATE]</td>
                                        <td>$rs[DISCHARGE_DATE]</td>
                                        <td>$rs[DISCOUNT]</td>
                                        <td>$rs[TOTAL]</td>
                                        <td>
                                            <a href='bill_invoice.php?id=$rs[BILL_ID]'><i class='fas fa-solid fa-print'></i></a><br>
                                            <a href='view_bill.php?id=$rs[BILL_ID]' style='color:green;'><i class='fas fa-info-circle'></i></a><br>
                                            <a href='backend_components/delete_handler.php?billId=$rs[BILL_ID]' style='color:red;'><i class='fas fa-trash'></i></a>
                                        </td>
                                        </tr>"; 
                                      }
                                  ?>
                              </tbody>
                            </table>
                          </div>
                      <!-- /.col -->
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
  // Footer File
  include_once('components/footer.php');
  echo '</div>';
  // Table Script File
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>