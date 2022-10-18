<?php
  // Session Start
  session_start();
  $dateRange = (isset($_GET['dateRange']) ? $_GET['dateRange'] : '');
  $docShare = (isset($_GET['docShare']) ? $_GET['docShare'] : '');
  $hosShare = (isset($_GET['hosShare']) ? $_GET['hosShare'] : '');
  $recShare = (isset($_GET['recShare']) ? $_GET['recShare'] : '');

    // $date = new DateTime($dateRange);
    // // $date = new DateTime('7 days ago');
    // echo $date->format('Y-m-d');
    // $range = $date->format('Y-m-d');

  if (isset($_SESSION['uuid'])) {
  include('backend_components/connection.php');
  include('components/table_header.php');
  include('components/navbar.php');
  include('components/sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h2 class="text-center display-4">MedEast Report</h2>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- <form action="">
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
            </form> -->
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr style='font-size: 14px;text-align:center;'>
                                    <th>Consultant </br> Name</th>
                                    <th>Total Number </br> of Patient</th>
                                    <th>Total Amount </br> Paid to Doctor</th>
                                    <th>Total Amount </br> Paid to MedEast</th>
                                    <th>Reception </br> Share</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql ='SELECT CAST(SLIP_DATE_TIME AS Date) AS DAILY, `me_doctors`.`DOCTOR_NAME` AS `CONSULTANT_NAME`, `me_doctors`.`DOCTOR_TYPE`,
                                COUNT(`SLIP_UUID`) AS `TOTAL_NO_OF_PATIENT`, 
                                ((SUM(`SLIP_FEE`)*1.0)*"'.$docShare.'")/100 AS `TOTAL_AMOUNT_PAID_TO_DOCTOR`, 
                                ((SUM(`SLIP_FEE`)*1.0)*"'.$hosShare.'")/100 AS `TOTAL_AMOUNT_PAID_TO_CLINIC`, 
                                (((SUM(`SLIP_FEE`)*1.0)*"'.$hosShare.'")/100) - (((SUM(`SLIP_FEE`)*1.0)*"'.$recShare.'")/100) AS `RECEPTION_SHARE` 
                                FROM `me_slip` LEFT JOIN `me_doctors` ON `me_slip`.`SLIP_DOCTOR` = `me_doctors`.`DOCTOR_UUID` 
                                WHERE `SLIP_DOCTOR` IS NOT NULL AND `SLIP_TYPE` = "OUTDOOR" AND CAST(SLIP_DATE_TIME AS Date) = current_date GROUP BY SLIP_DOCTOR, CAST(Slip_Date_Time AS Date)';
                                $qsql = mysqli_query($db,$sql);
                                while($rs = mysqli_fetch_array($qsql))
                                { 
                                    $recTotal = $rs['TOTAL_AMOUNT_PAID_TO_CLINIC'] - $rs['RECEPTION_SHARE'];
                                    echo "<tr style='font-size: 12px;'>
                                    <td>$rs[CONSULTANT_NAME]</td>
                                    <td>$rs[TOTAL_NO_OF_PATIENT]</td>
                                    <td>$rs[TOTAL_AMOUNT_PAID_TO_DOCTOR]</td>
                                    <td>$rs[TOTAL_AMOUNT_PAID_TO_CLINIC]</td>
                                    <td>$recTotal</td>
                                    
                                    </tr>"; 
                                }
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