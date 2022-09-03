<?php 
  // Session Starts
  session_start(); 
  $patid = (isset($_GET['patid']) ? $_GET['patid'] : '');
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
          $patSql="SELECT `a`.*,`b`.`ADMIN_USERNAME` FROM `patient` AS `a` INNER JOIN `admin` AS `b` ON `a`.`CREATED_BY` = `b`.`ADMIN_ID` WHERE `PATIENT_ID` = " .$patid;
          
          $qsql = mysqli_query($db,$patSql);
          $row = mysqli_fetch_array($qsql);
          
          $date = substr($row["CREATED_ON"],0,24);
        ?>
            <div class="card">
              <div class="card-header d-flex p-0">
                <h1 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h1>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active">
                   
                        <!-- /.card -->
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-user"></i>&nbsp;
                                Patient Medical History
                            </h3>
                          </div>
                          <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="true">Profile</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-emergency-tab" data-toggle="pill" href="#custom-content-above-emergency" role="tab" aria-controls="custom-content-above-emergency" aria-selected="false">Emergency Record</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-indoor-tab" data-toggle="pill" href="#custom-content-above-indoor" role="tab" aria-controls="custom-content-above-indoor" aria-selected="false">Indoor Record</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-outdoor-tab" data-toggle="pill" href="#custom-content-above-outdoor" role="tab" aria-controls="custom-content-above-outdoor" aria-selected="false">Outdoor Record</a>
                              </li>
                            </ul>
                            <div class="tab-custom-content">
                              <p class="lead mb-0"><?php echo $row["PATIENT_NAME"]; ?></p>
                            </div>
                            <div class="tab-content" id="custom-content-above-tabContent">
                              <div class="tab-pane fade show active" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                              <!-- ***
                              ** Patient Personal Details
                              *** -->
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="col-md-12 clearfix">
                                    <?php echo '<div class="row"><label>MR ID: </label>&nbsp; <h5>'.$row["PATIENT_MR_ID"].'</h5></div>'; ?>
                                    <?php echo '<div class="row"><label>Mobile: </label>&nbsp; <h5>'.$row["PATIENT_MOBILE"].'</h5></div>'; ?>
                                    <?php echo '<div class="row"><label>Age: </label>&nbsp; <h5>'.$row["PATIENT_AGE"].'&nbsp;Years - '.$row["PATIENT_GENDER"].'</h5></div>'; ?>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="col-md-12 clearfix">
                                      <?php echo '<div class="row"><label>Address: </label>&nbsp; <h5>'.$row["PATIENT_ADDRESS"].'</h5></div>'; ?>
                                      <?php echo '<div class="row "><label>Date: </label>&nbsp; <h5>'. $date.'</h5></div>'; ?>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="col-md-12 clearfix">
                                      <?php echo '<div class="row"><label>Created By: </label>&nbsp; <h5>'.$row["ADMIN_USERNAME"].'</h5></div>'; ?>
                                      
                                      <?php 
                                        if ($_SESSION['role'] == "admin") {
                                          echo '<div class="row"><label>Options: </label>&nbsp; <h5>';
                                          echo '<a href="edit_patient.php?patid='.$row["PATIENT_ID"].'"><i class="fas fa-edit"></i></a>';
                                          echo '&nbsp; <a href="backend_components/delete_handler.php?prid='.$row["PATIENT_ID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                                          echo '</h5></div>'; 
                                        }
                                      ?>    
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="custom-content-above-emergency" role="tabpanel" aria-labelledby="custom-content-above-emergency-tab">                          
                              <!--**
                                * Patient Records of Bill
                                **-->
                                <div class="row">
                                  <div class="col-12">
                                      <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr style="font-size: 14px;">
                                          <th>S.No#</th>
                                          <th>MR-ID</th>
                                          <th>Name</th>
                                          <th>Mobile</th>
                                          <th>Doctor</th>
                                          <th>Created</th>
                                          <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME` FROM `emergency_slip` INNER JOIN `admin` INNER JOIN `doctor` WHERE `emergency_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `emergency_slip`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                                            $sql ="SELECT `a`.*,`b`.`ADMIN_USERNAME`,`c`.`DOCTOR_NAME` FROM `emergency_slip` AS `a` INNER JOIN `admin` AS `b` ON `a`.`STAFF_ID` = `b`.`ADMIN_ID` INNER JOIN `doctor` AS `c` ON `a`.`DOCTOR_ID` = `c`.`DOCTOR_ID` WHERE `a`.`SLIP_MR_ID` = '$row[PATIENT_MR_ID]'";
                                          //   $sql ="SELECT * FROM `emergency_slip`";
                                            $qsql = mysqli_query($db,$sql);
                                            while($rs = mysqli_fetch_array($qsql))
                                            { 
                                            $date = substr($rs['SLIP_DATE_TIME'],0, 21);
                                              echo "<tr style='font-size: 12px;'>
                                              <td>$rs[SLIP_ID]</td>
                                              <td>$rs[SLIP_MR_ID]</td>
                                              <td>$rs[SLIP_NAME]</td>
                                              <td>$rs[SLIP_MOBILE]</td>
                                              <td>$rs[DOCTOR_NAME]</td>
                                              <td>
                                                  <b>By</b>: $rs[ADMIN_USERNAME] <br>
                                                  <b>On</b>: ".$date."
                                              </td> 
                                              <td style='display:flex;'>";
                                                if($rs['BILL_STATUS'] == "pending"){
                                                  echo "<a href='emergency_patient_bill.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                                    <i class='fas fa-wallet'></i> Bill</a>
                                                    <br> 
                                                    <a href='emergency_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                                    <i class='fas fa-wallet'></i> Print</a>";
                                                    if ($_SESSION['role'] == "admin") {  
                                                    echo "<br>
                                                    <a href='emergency_patient_slip.php?epsid=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                                                    <br>
                                                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" 
                                                    href='backend_components/delete_handler.php?esrId=$rs[SLIP_ID]' style='color:red;'>
                                                    <i class='fas fa-trash'></i> Delete</a>";
                                                    }
                                              }else{
                                                  echo "<a href='emergency_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                                  <i class='fas fa-wallet'></i> Print</a>";
                                                  if ($_SESSION['role'] == "admin") {  
                                                  echo "<br>
                                                  <a href='emergency_patient_slip.php?epsid=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                                                  <br>
                                                  <a onClick=\"javascript: return confirm('Please confirm deletion');\" 
                                                  href='backend_components/delete_handler.php?esrId=$rs[SLIP_ID]' style='color:red;'>
                                                  <i class='fas fa-trash'></i> Delete</a>";
                                                  }
                                              }
                                                
                                              echo "</td></tr>"; 
                                            }
                                        ?>
                                        </tbody>
                                      </table>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane fade" id="custom-content-above-indoor" role="tabpanel" aria-labelledby="custom-content-above-indoor-tab">
                                  <!--**
                                * Patient Records of Bill
                                **-->
                                <div class="row">
                                  <div class="col-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                      <thead>
                                      <tr style="font-size: 14px;">
                                        <th>S.No#</th>
                                        <th>MR-ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Procedure</th>
                                        <th>Type</th>
                                        <th>Doctor</th>
                                        <th>Created</th>
                                        <th>Options</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                          // $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME` FROM `indoor_slip` INNER JOIN `admin` INNER JOIN `doctor` WHERE `indoor_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `indoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                                          $sql ="SELECT `a`.*,`b`.`ADMIN_USERNAME`,`c`.`DOCTOR_NAME` FROM `indoor_slip` AS `a` INNER JOIN `admin` AS `b` ON `a`.`STAFF_ID` = `b`.`ADMIN_ID` INNER JOIN `doctor` AS `c` ON `a`.`DOCTOR_ID` = `c`.`DOCTOR_ID` WHERE `a`.`SLIP_MR_ID` = '$row[PATIENT_MR_ID]'";
                                          //   $sql ="SELECT * FROM `emergency_slip`";
                                          $qsql = mysqli_query($db,$sql);
                                          while($rs = mysqli_fetch_array($qsql))
                                          { 
                                          $date = substr($rs['SLIP_DATE_TIME'],0, 21);
                                          echo "<tr style='font-size: 12px;'>
                                          <td>$rs[SLIP_ID]</td>
                                            <td>$rs[SLIP_MR_ID]</td>
                                            <td>$rs[SLIP_NAME]</td>
                                            <td>$rs[SLIP_MOBILE]</td>
                                            <td>$rs[SLIP_PROCEDURE]</td>
                                            <td>$rs[SLIP_TYPE]</td>
                                            <td>$rs[DOCTOR_NAME]</td>
                                            <td>
                                                <b>By</b>: $rs[ADMIN_USERNAME] <br>
                                                <b>On</b>: ".$date."
                                            </td> 
                                            <td style='display:flex;'>";

                                            if($rs['BILL_STATUS'] == "pending"){
                                              echo "<a href='indoor_patient_bill.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                                <i class='fas fa-wallet'></i> Bill</a>
                                                <br> 
                                                <a href='indoor_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                                <i class='fas fa-wallet'></i> Print</a>";
                                                if ($_SESSION['role'] == "admin") {  
                                                echo "<br>
                                                <a href='add_patient.php?id=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                                                <br>
                                                <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?isrId=$rs[SLIP_ID]' style='color:red;'>
                                                <i class='fas fa-trash'></i> Delete</a>";
                                                }
                                              }else{
                                              echo "<a href='indoor_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                              <i class='fas fa-wallet'></i> Print</a>";
                                              if ($_SESSION['role'] == "admin") {  
                                              echo "<br>
                                              <a href='add_patient.php?id=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                                              <br>
                                              <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?isrId=$rs[SLIP_ID]' style='color:red;'>
                                              <i class='fas fa-trash'></i> Delete</a>";
                                            }
                                            }
                                              
                                            echo "</td>
                                            </tr>"; 
                                          }
                                      ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane fade" id="custom-content-above-outdoor" role="tabpanel" aria-labelledby="custom-content-above-outdoor-tab">
                              
                                <!--**
                                * Patient Records of Bill
                                **-->
                                <div class="row">
                                  <div class="col-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                      <thead>
                                      <tr style="font-size: 14px;">
                                        <th>S.No#</th>
                                        <th>MR-ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Department</th>
                                        <th>Consultant</th>
                                        <th>Fee</th>
                                        <th>Created</th>
                                        <th>Options</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                          // $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME`,`DEPARTMENT_NAME` FROM `outdoor_slip` INNER JOIN `admin` INNER JOIN `doctor` INNER JOIN `department` WHERE `outdoor_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `outdoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `outdoor_slip`.`DEPT_ID` = `department`.`DEPARTMENT_ID`";
                                          $sql ="SELECT `a`.*,`b`.`ADMIN_USERNAME`,`c`.`DEPARTMENT_NAME` FROM `outdoor_slip` AS `a` INNER JOIN `admin` AS `b` ON `a`.`STAFF_ID` = `b`.`ADMIN_ID` INNER JOIN `department` AS `c` ON `a`.`DEPT_ID` = `c`.`DEPARTMENT_ID` WHERE `a`.`SLIP_MR_ID` = '$row[PATIENT_MR_ID]'";
                                          //   $sql ="SELECT * FROM `emergency_slip`";
                                          $qsql = mysqli_query($db,$sql);
                                          while($rs = mysqli_fetch_array($qsql))
                                          { 
                                          $date = substr($rs['SLIP_DATE_TIME'],0, 21);
                                            echo "<tr style='font-size: 12px;'>
                                            <td>$rs[SLIP_ID]</td>
                                            <td>$rs[SLIP_MR_ID]</td>
                                            <td>$rs[SLIP_NAME]</td>
                                            <td>$rs[SLIP_MOBILE]</td>
                                            <td>$rs[DEPARTMENT_NAME]</td>
                                            <td>$rs[DOCTOR_NAME] <button class='btn badge badge-info'>";
                                            if ($rs['D_TYPE'] == 1) echo "Visiting Doctor"; else echo "MedEast Doctor";
                                            echo "</button></td>
                                            <td>$rs[SLIP_FEE]</td>
                                            <td>
                                                <b>By</b>: $rs[ADMIN_USERNAME] <br>
                                                <b>On</b>: ".$date."
                                            </td> 
                                            <td>
                                              <a href='outdoor_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                                              <i class='fas fa-wallet'></i> Print</a>";
                                              if ($_SESSION['role'] == "admin") {  
                                                  echo "<a href='add_patient.php?id=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                                                  <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?osrId=$rs[SLIP_ID]' style='color:red;'>
                                                  <i class='fas fa-trash'></i> Delete</a>";
                                              }
                                            echo "</td>
                                            </tr>"; 
                                          }
                                      ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                          <!-- /.card -->
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