<?php
  // Session Start
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
        <h2 class="text-center display-4">MedEast Report</h2>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Report by:</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Any" style="width: 100%;">
                                        <option>Doctor</option>
                                        <option>Department</option>
                                        <option>Other Services</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sort Order:</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>ASC</option>
                                        <option>DESC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Order By:</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>Title</option>
                                        <option>Date</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="Lorem ipsum">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr style='font-size: 14px;text-align:center;'>
                                <th>Consultant </br> Name</th>
                                <th>Total Number </br> of Patient</th>
                                <th>Total Amount </br> Paid to Doctor</th>
                                <th>Total Amount </br> Paid to MedEast</th>
                                <th>Reception </br> Share</th>
                                <!-- <th>Created</th> -->
                                <!-- <th>Options</th> -->
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Brig. (R) Dr. Shamim Akhtar</td>
                                    <td>1</td>
                                    <td>1400</td>
                                    <td>600</td>
                                    <td>100</td>
                                </tr>
                            <?php
                                // $sql ="SELECT *,`DEPARTMENT_NAME`, `ADMIN_USERNAME` FROM `doctor` INNER JOIN `admin` INNER JOIN `department` WHERE `doctor`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `doctor`.`DEPARTMENT_ID` = `department`.`DEPARTMENT_ID`";
                                // $qsql = mysqli_query($db,$sql);
                                // while($rs = mysqli_fetch_array($qsql))
                                // { 
                                //     $date = substr($rs['DOCTOR_DATE_TIME'],0, 21);
                                //     echo "<tr style='font-size: 12px;'>
                                //     <td>$rs[DOCTOR_ID]</td>
                                //     <td>$rs[DOCTOR_NAME]</td>
                                //     <td>$rs[DOCTOR_MOBILE]</td>
                                //     <td>$rs[DEPARTMENT_NAME]</td>
                                //     <td>$rs[DOCTOR_STATUS]</td>
                                //     <td>
                                //         <b>By</b>: $rs[ADMIN_USERNAME] <br>
                                //         <b>On</b>: ".$date."
                                //     </td>
                                //     <td style='display:flex;'>
                                //         <a href='view_doctor.php?id=$rs[DOCTOR_ID]' style='color:green;'>
                                //         <i class='fas fa-info-circle'></i> Details
                                //         </a><br>
                                //         <a href='add_doctor.php?id=$rs[DOCTOR_ID]'>
                                //         <i class='fas fa-edit'></i> Edit
                                //         </a><br>
                                //         <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?docId=$rs[DOCTOR_ID]' style='color:red;'>
                                //         <i class='fas fa-trash'></i> Delete
                                //         </a>
                                //     </td>
                                //     </tr>"; 
                                // }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

<?php 
// Footer File
include ('components/footer.php');
echo '</div>';
// Table Script File
include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>