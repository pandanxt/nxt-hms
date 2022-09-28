<?php 
  // Session Start
  session_start(); 
  // $type = (isset($_GET['type']) ? $_GET['type'] : '');
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

    <!-- Table Data of Patient -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style="font-size: 14px;">
                    <th>S.No#</th>
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Payment</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`USER_NAME`,`SLIP_TYPE`,`SLIP_SUB_TYPE` FROM `me_bill` INNER JOIN `me_user` INNER JOIN `me_slip` 
                      WHERE `me_bill`.`STAFF_ID` = `me_user`.`USER_UUID` AND `me_bill`.`BILL_SLIP_UUID` = `me_slip`.`SLIP_UUID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr style='font-size: 12px;'>
                        <td>$rs[BILL_UUID]</td>
                        <td>$rs[BILL_MRID]</td>
                        <td>$rs[BILL_NAME]</td>
                        <td>$rs[BILL_MOBILE]</td>
                        <td font-size: 12px;'>
                          <b>Sub:</b> $rs[BILL_AMOUNT]<br>
                          <b>Discount:</b> $rs[BILL_DISCOUNT]<br>
                          <b>Total:</b> $rs[BILL_TOTAL] 
                        </td>
                        <td style='font-size: 12px;'>
                            <b>By: </b>$rs[USER_NAME]<br>
                            <b>On: </b>$rs[BILL_DATE_TIME]<br>
                            <b>Type: </b>";
                            if ($rs['SLIP_SUB_TYPE'] != NULL || $rs['SLIP_SUB_TYPE'] != "") {
                                echo $rs['SLIP_TYPE'].'_'.$rs['SLIP_SUB_TYPE'];
                             }else{
                                 echo $rs['SLIP_TYPE'].'_PATIENT';
                             }
                        echo "</td>
                        <td style='display:flex;'>";
                            if ($rs['SLIP_TYPE'] == 'INDOOR') {
                                echo "<a href='indoor_bill_print.php?sid=$rs[BILL_UUID]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Print
                                </a>";
                            }else if ($rs['SLIP_TYPE'] == 'EMERGENCY') {
                                echo "<a href='emergency_bill_print.php?sid=$rs[BILL_UUID]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Print
                                </a>";
                            }   
                            if ($_SESSION['role'] == "admin") {  
                            echo "<br>
                            <a href='indoor_bill.php?id=$rs[BILL_UUID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?ibrId=$rs[BILL_UUID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete
                            </a>";
                            }
                        echo "</td>
                        </tr>"; 
                      }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.Footer -->
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