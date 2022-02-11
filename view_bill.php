<?php include_once('backend_components/connection.php'); ?>
<?php 
    session_start(); 

    function RemoveChar($str) {
    $res = str_replace( array( '\'', '"',
    ',' , ';', '<', '>' ), ' | ', $str);
    return $res;
    }

    $id = isset($_GET['id']) ? $_GET['id'] : ''; 

?>
  <!-- table-header -->
  <?php include_once('components/table_header.php'); ?>
   <!-- Navbar -->
   <?php include_once('components/navbar.php'); ?>
  <!-- Main Sidebar Container -->
  <?php include_once('components/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <?php
          $sql ="SELECT *,`DOCTOR_NAME` FROM 
          `bill_record` INNER JOIN `patient` INNER JOIN `doctor` WHERE 
          `bill_record`.`BILL_ID` =  " .$_GET['id']. " AND 
          `bill_record`.`MR_ID` = `patient`.`PATIENT_MR_ID` AND
          `bill_record`.`MOBILE` = `patient`.`PATIENT_MOBILE` AND
          `patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
          
          $qsql = mysqli_query($db,$sql);
          $row = mysqli_fetch_array($qsql);
          
          $date = $row['PATIENT_DATE_TIME'];
          $row['PATIENT_MR_ID'];
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
                            if ($row["PATIENT_TYPE"] == "indoor") {
                              echo '<div class="row"><label>CNIC: </label>&nbsp; <p>'.$row["PATIENT_CNIC"].'</p></div>';
                            }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Doctor: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["DOCTOR_NAME"].'</p></div>'; ?>
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Gender: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_GENDER"].'</p></div>'; ?>
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Age: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_AGE"].'&nbsp;Years</p></div>'; ?>
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Patient Type: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_TYPE"].'</p></div>'; ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                          <?php echo '<div class="row"><label>Options: </label>&nbsp; <p>';
                            // echo '<a href="add_bill.php?id='.$row["BILL_ID"].'"><i class="fas fa-edit"></i></a>';
                            echo '&nbsp; <a href="backend_components/delete_handler.php?billId='.$row["BILL_ID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                            echo '</p></div>'; 
                          ?>
                          <?php echo '<div class="row "><label style="margin-bottom: 0px !important;">Patient Created: </label>&nbsp; <p style="margin-bottom: 0px !important;">'. $date.'</p></div>'; ?>
                          <?php echo '<div class="row"><label style="margin-bottom: 0px !important;">Address: </label>&nbsp; <p style="margin-bottom: 0px !important;">'.$row["PATIENT_ADDRESS"].'</p></div>'; ?>
                        </div>
                      </div>
                    </div>
                    <hr/>
                    <!-- Patient Records of Bill -->
                    <div class="row">
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                         <?php 
                            echo '<label>Date | Time</label>'; 
                            echo '<div>';
                            echo '<p style="margin-bottom: 0rem !important;">Bill:&nbsp;'.$row["BILL_DATE"].'</p>';
                            echo '<p style="margin-bottom: 0rem !important;">Admission:&nbsp;'.$row["ADMISSION_DATE"].'</p>';
                            echo '<p style="margin-bottom: 0rem !important;">Discharge:&nbsp;'.$row["DISCHARGE_DATE"].'</p></div>'; 
                         ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                          <?php 
                            echo '<label>Bill Details</label>';
                            echo '<div>';
                            echo '<p style="margin-bottom: 0rem !important;">Ad Days: &nbsp;'.$row["ADMIT_DAYS"].'</p>';
                            echo '<p style="margin-bottom: 0rem !important;">Amount: &nbsp;'.$row["BILL_AMOUNT"].'</p>';
                            echo '<p style="margin-bottom: 0rem !important;">Discount: &nbsp;'.$row["DISCOUNT"].'</p>';
                            echo '<p style="margin-bottom: 0rem !important;">Final Bill: &nbsp;'.$row["TOTAL"].'</p>';
                            echo '</div>';
                          ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12 clearfix">
                          <?php 
                             $service=$row['SERVICES'];
                             $str = strval($service); 
                             $str1 = RemoveChar($str); 
                            echo '<div>';
                            echo '<label style="margin-bottom: 0px !important;">Services Given</label>';
                            echo '<p style="margin-bottom: 0rem !important;">'.$str1.'</p>';
                            echo '</div>'; 
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
  <?php include_once('components/footer.php'); ?>
</div>
<!-- ./wrapper -->
<!-- Table Script -->
<?php //include('components/table_script.php'); ?>