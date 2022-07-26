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
                  <tr style="font-size: 12px;">
                    <th>S.No#</th>
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Payments</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `emergency_bill` INNER JOIN `admin` WHERE `emergency_bill`.`CREATED_BY` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                       $date = substr($rs['DATE_TIME'],0, 21);
                        echo "<tr style='font-size: 12px;'>
                        <td>$rs[BILL_ID]</td>
                        <td>$rs[MR_ID]</td>
                        <td>$rs[PATIENT_NAME]</td>
                        <td>$rs[MOBILE]</td>
                        <td style='display:flex;'>
                          <b>SubTotal</b>: $rs[TOTAL_AMOUNT]<br>
                          <b>Discount</b>: $rs[DISCOUNT]<br>
                          <b>Total</b>: $rs[TOTAL]</td>
                        <td>
                            <b>By</b>: $rs[ADMIN_USERNAME] <br>
                            <b>On</b>: ".$date."
                        </td> 
                        <td style='display:flex;'>
                            <a href='emergency_bill_print.php?sid=$rs[BILL_ID]' style='color:green;'>
                            <i class='fas fa-wallet'></i> Print
                            </a>";
                            if ($_SESSION['type'] == "admin") {  
                            echo "<br>
                            <a href='emergency_bill.php?id=$rs[SLIP_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?ebrId=$rs[SLIP_ID]' style='color:red;'>
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