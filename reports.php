<?php
  // Session Start
  session_start();
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
  $dateRange = (isset($_GET['reservation']) ? $_GET['reservation'] : '');
  $docShare = (isset($_GET['docShare']) ? $_GET['docShare'] : '');
  $hosShare = (isset($_GET['hosShare']) ? $_GET['hosShare'] : '');
  $recShare = (isset($_GET['recShare']) ? $_GET['recShare'] : '');
  $sDate = substr($dateRange, 0, 10);
  $eDate = substr($dateRange,13);

  $startDate=date_format(date_create($sDate),"Y-m-d");
  $endDate=date_format(date_create($eDate),"Y-m-d");

  if (isset($_SESSION['uuid'])) {
  include('backend_components/connection.php');
  include('components/file_header.php');
  include('components/navbar.php');
  include('components/sidebar.php');
?>
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 offset-md-1 mt-4">
        <div class="callout callout-info">
          <h5><i class="fas fa-filter"></i>
          <?php 
            if($type=='DAILY'){
              echo"Daily Report Filter";
            }else if($type=='DATE_RANGE'){
              echo"Date Range Report Filter";
            }
          ?>
          </h5>
            <div class="row col-12">
              <div class="col-3">
                <p>Hospital's Share : <b><span><?php echo $hosShare; ?> Percent</span></b></p>
              </div>
              <div class="col-3">
                <p>Doctor's Share : <b><span><?php echo $docShare; ?> Percent</span></b></p>
              </div>
              <div class="col-3">
                <p>Reception's Share : <b><span><?php echo $recShare; ?> Percent</span></b></p>
              </div>
              <div class="col-3">
                <p>Date : <b><span><?php echo $dateVal = ($type == 'DATE_RANGE') ? $dateRange : substr("$dateRange",13); ?></span></b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
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
                    <th>Total Amount </br> Paid to MAAN Medical Complex</th>
                    <th>Reception </br> Share</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ($type == 'DAILY') {
                  
                    $reportSql ="SELECT CAST(`SLIP_DATE_TIME` AS DATE) AS `DAILY`, `me_doctors`.`DOCTOR_NAME` AS `CONSULTANT_NAME`, `me_doctors`.`DOCTOR_TYPE`,
                    COUNT(`SLIP_UUID`) AS `TOTAL_NO_OF_PATIENT`, 
                    ( (SUM(`SLIP_FEE`)*1.0 )* '$docShare')/100 AS `TOTAL_AMOUNT_PAID_TO_DOCTOR`, 
                    ( (SUM(`SLIP_FEE`)*1.0)* '$hosShare')/100 AS `TOTAL_AMOUNT_PAID_TO_CLINIC`, 
                    ( ( (SUM(`SLIP_FEE`)*1.0)* '$hosShare')/100) - ( ( (SUM(`SLIP_FEE`)*1.0)* '$recShare')/100) AS `RECEPTION_SHARE` 
                    FROM `me_slip` LEFT JOIN `me_doctors` ON `me_slip`.`SLIP_DOCTOR` = `me_doctors`.`DOCTOR_UUID` 
                    WHERE `SLIP_DOCTOR` IS NOT NULL AND `SLIP_TYPE` = 'OUTDOOR' 
                    AND CAST(`SLIP_DATE_TIME` AS Date) = current_date GROUP BY `SLIP_DOCTOR`, CAST(`SLIP_DATE_TIME` AS DATE)";
                  
                  }else if ($type == 'DATE_RANGE') {

                    $reportSql ="SELECT `me_doctors`.`DOCTOR_NAME` AS `CONSULTANT_NAME`, `me_doctors`.`DOCTOR_TYPE`,
                    COUNT(`SLIP_UUID`) AS `TOTAL_NO_OF_PATIENT`, 
                    ( (SUM(`SLIP_FEE`)*1.0 )* '$docShare')/100 AS `TOTAL_AMOUNT_PAID_TO_DOCTOR`, 
                    ((SUM(`SLIP_FEE`)*1.0)* '$hosShare')/100 AS `TOTAL_AMOUNT_PAID_TO_CLINIC`, 
                    (((SUM(`SLIP_FEE`)*1.0)* '$hosShare')/100) - (((SUM(`SLIP_FEE`)*1.0)* '$recShare')/100) AS `RECEPTION_SHARE` 
                    FROM `me_slip` LEFT JOIN `me_doctors` ON `me_slip`.`SLIP_DOCTOR` = `me_doctors`.`DOCTOR_UUID` 
                    WHERE `SLIP_DOCTOR` IS NOT NULL AND `SLIP_TYPE` = 'OUTDOOR' 
                    AND CAST(`SLIP_DATE_TIME` AS DATE) BETWEEN '$startDate' AND '$endDate' GROUP BY `SLIP_DOCTOR`";
                  
                  }
                  
                    $querySql = mysqli_query($db,$reportSql);
                    while($rs = mysqli_fetch_array($querySql))
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php 
  include ('components/footer.php');
  echo '<aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>';
  include('components/file_footer.php');
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>