<?php 
  // Session Start
  session_start(); 
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
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

    <!-- Table Data of Patient -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No#</th>
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Admission</th>
                    <th>Discharge</th>
                    <th>Payment</th>
                    <!-- <th>Discount</th>
                    <th>Total</th> -->
                    <th>Staff</th>
                    <!-- <th>Date|Time</th> -->
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    if ($type == "gynae" || $type == "gensurgery") {
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `indoor_gensurgery_bill` INNER JOIN `admin` WHERE `indoor_gensurgery_bill`.`CREATED_BY` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                    }else if ($type == "genillness") {
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `indoor_genillness_bill` INNER JOIN `admin` WHERE `indoor_genillness_bill`.`CREATED_BY` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                    }else if ($type == "eye") {
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `indoor_eye_bill` INNER JOIN `admin` WHERE `indoor_eye_bill`.`CREATED_BY` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                    }
                      // $sql ="SELECT *,`ADMIN_USERNAME` FROM `indoor_gensurgery_bill` INNER JOIN `admin` WHERE `indoor_gensurgery_bill`.`CREATED_BY` = `admin`.`ADMIN_ID`";
                      // $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                      //  $date = substr($rs['DATE_TIME'],0, 21);
                       $admDate = substr($rs['ADMISSION_DATE'],0, 21);
                       $disDate = substr($rs['DISCHARGE_DATE'],0, 21);
                        echo "<tr>
                        <td>$rs[BILL_ID]</td>
                        <td>$rs[MR_ID]</td>
                        <td>$rs[PATIENT_NAME]</td>
                        <td>$rs[MOBILE]</td>
                        <td style='font-size: 14px;'>$admDate</td>
                        <td style='font-size: 14px;'>$disDate</td>
                        <td style='display:flex; font-size: 14px;'>
                          Sub: $rs[TOTAL_AMOUNT]
                          <br>
                          Discount: $rs[DISCOUNT]
                          <br>
                          Total: $rs[TOTAL] 
                        </td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td style='display:flex;'>
                            <a href='indoor_bill_print.php?type=$type&sid=$rs[BILL_ID]' style='color:green;'>
                              <i class='fas fa-wallet'></i> Print
                            </a>";
                            if ($_SESSION['type'] == "admin") {  
                            echo "<br>
                            <a href='indoor_bill.php?id=$rs[SLIP_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?ibrId=$rs[SLIP_ID]' style='color:red;'>
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