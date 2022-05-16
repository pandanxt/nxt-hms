<?php
    session_start();
    $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
    $type = (isset($_GET['type']) ? $_GET['type'] : '');

    if (isset($_SESSION['userid'])) {
      
      include('backend_components/connection.php');
      // Form Header File
      include('components/form_header.php'); 
      // Navbar File
      include('components/navbar.php'); 
      // Sidebar File
      include('components/sidebar.php');
      //**********************************//
      //*Gynae and General Surgery Print*//
      //******************************* //
            if ($sid){
              // Query to get Slip Details 
              $billSql ="SELECT `a`.*, `b`.`ADMIN_USERNAME`	FROM `indoor_bill` AS `a` INNER JOIN `admin` AS `b` ON `b`.`ADMIN_ID` = `a`.`CREATED_BY` WHERE `BILL_ID` = ".$sid;
              $billsql = mysqli_query($db,$billSql);
              $bill_row = mysqli_fetch_array($billsql);

              $admDate = substr($bill_row['ADMISSION_DATE'],0, 24);
              $disDate = substr($bill_row['DISCHARGE_DATE'],0, 24);

              $slipSql ="SELECT `a`.*, `b`.`DOCTOR_NAME` 
              FROM `indoor_slip` AS `a` INNER JOIN `doctor` AS `b` ON `b`.`DOCTOR_ID` = `a`.`DOCTOR_ID`
              WHERE `SLIP_ID` = '$bill_row[SLIP_ID]'";
              $slipsql = mysqli_query($db,$slipSql);
              $slip_row = mysqli_fetch_array($slipsql);
            
              $doctor = $slip_row['DOCTOR_NAME'];
              $procedure = $slip_row['SLIP_PROCEDURE'];
              $type = $slip_row['SLIP_TYPE'];
              $newType;
              if ($type == 'gynae') {
                  $newType = 'Gynae Patient';
              }else if ($type == 'gensurgery') {
                  $newType = 'General Surgery Patient';
              }else if ($type == 'genillness') {
                  $newType = 'General Illness Patient';
              }else if ($type == 'eye') {
                  $newType = 'Eye Patient';
              }

    ?>
              <div class="content-wrapper">
              <!-- Main content -->
              <section class="container invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="page-header">
                      <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
                      <small class="float-right" style="font-size:12px;">Slip Date: <?php echo $bill_row['DATE_TIME']; ?></small>
                    </h2>
                    <div class="float-right" style="margin-top: -125px;">
                      <div style="display:flex;">
                        <div style="margin:5px 10px;font-size:30px;"><i class="fas fa-map"></i></div>
                        <div style="font-size:15px;">C-1 Commercial Office Block, <br> Paragon City, Lahore.</div>
                      </div>
                      <div style="display:flex;">
                        <div style="margin:15px 10px;font-size:30px;"><i class="fas fa-phone"></i></div> 
                        <div style="font-size:15px;">0300 4133102 <br>0320 4707070 <br>042 37165549</div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <hr style="margin-top:5px;"/>
                <center><h4><?php echo $newType;?></h4></center>
                <!-- info row -->
                <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                <hr style="margin-top:5px;"/>
                    <?php if ($type == "eye") { ?>
                        <h4><b>MR_ID# </b><?php echo $mrid; ?></h4><br>
                        <h4><b>Patient Name :</b> <?php echo $pname; ?></h4><br>
                        <h4><b>Contact :</b> <?php echo $phone; ?></h4><br>
                        <h4><b>Procedure :</b> <?php echo $procedure; ?></h4><br>
                    <?php }else { ?>
                        <p><b>MR_ID# </b><?php echo $bill_row['MR_ID']; ?></P>
                        <p><b>Patient Name :</b> <?php echo $bill_row['PATIENT_NAME']; ?></p>
                        <p><b>Contact :</b> <?php echo $bill_row['MOBILE']; ?></P>
                        <p><b>Procedure :</b> <?php echo $procedure; ?></p>  
                    <?php } ?>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6 invoice-col">
                  <hr style="margin-top:5px;"/>
                    <?php if ($type == "eye") { ?>
                    <h4><b>Date :</b> <?php echo $newDisdate; ?></h4><br>
                    <h4><b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME'];; ?></h4><br>
                    <h4><b>Consultant :</b> <?php echo $doctor; ?></h4><br>
                    <h4><b>Consultant Fee - Discount :</b> <?php echo $fee; ?> - <?php echo $discount; ?></h4><br>
                    <h4><b>Total Fee :</b> <?php echo $finalFee; ?></h4><br>
                    <?php }else { ?>
                      <p><b>Admit Dates :</b> <?php echo $admDate; ?> - <?php echo $disDate; ?></p>
                      <p><b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME'];; ?></p><br>
                      <p><b>Consultant :</b> <?php echo $doctor; ?></p><br>
                    <?php } ?>
                  </div>
                  <!-- /.col -->
                </div>
                <?php if ($type != "eye") { ?>
                <!-- /.row -->
                  <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                      <tr style="width:100%;">
                        <th style="width:80%;">Particular</th>
                        <th style="width:20%;">Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                          if (!empty($bill_row['ADMISSION_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Admission Charges</td>
                        <td><?php echo $bill_row['ADMISSION_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['SURGEON_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Surgeon Charges</td>
                        <td><?php echo $bill_row['SURGEON_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['ANESTHETIST_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Anesthetist Charges</td>
                        <td><?php echo $bill_row['ANESTHETIST_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['OPERATION_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Operation Charges</td>
                        <td><?php echo $bill_row['OPERATION_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['LABOUR_ROOM_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Labour Room Charges</td>
                        <td><?php echo $bill_row['LABOUR_ROOM_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['PEDIATRIC_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Pediatric Charges</td>
                        <td><?php echo $bill_row['PEDIATRIC_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['NURSURY_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Nursury Charges</td>
                        <td><?php echo $bill_row['NURSURY_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['NURSURY_STAFF_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Nursury Staff Charges</td>
                        <td><?php echo $bill_row['NURSURY_STAFF_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['MO_CHARGE'])) {
                      ?>
                      <tr>
                        <td>M O Charges</td>
                        <td><?php echo $bill_row['MO_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['CONSULTANT_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Consultant Visit Charges</td>
                        <td><?php echo $bill_row['CONSULTANT_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['CTG_CHARGE'])) {
                      ?>
                      <tr>
                        <td>CTG Charges</td>
                        <td><?php echo $bill_row['CTG_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['RECOVERY_ROOM_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Recovery Room Charges</td>
                        <td><?php echo $bill_row['RECOVERY_ROOM_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['PRIVATE_ROOM_CHARGE'])) {
                      ?>
                      <tr>
                        <td>Private Room Charges</td>
                        <td><?php echo $bill_row['PRIVATE_ROOM_CHARGE']; ?></td>
                      </tr>
                      <?php
                          } 
                          if (!empty($bill_row['OTHER_TEXT'])) {
                      ?>
                      <tr>
                        <td><?php echo $bill_row['OTHER_TEXT']; ?></td>
                        <td><?php echo $bill_row['OTHER']; ?></td>
                      </tr>
                        <?php
                            } 
                            if (!empty($bill_row['MONITOR_CHARGE'])) {
                        ?>
                        <tr>
                          <td>Monitoring Charges</td>
                          <td><?php echo $bill_row['MONITOR_CHARGE']; ?></td>
                        </tr>
                        <?php
                            } 
                            if (!empty($bill_row['NURSING_CHARGE'])) {
                        ?>
                        <tr>
                          <td>Nursing Charges</td>
                          <td><?php echo $bill_row['NURSING_CHARGE']; ?></td>
                        </tr>
                        <?php
                            } 
                            if (!empty($bill_row['OXYGEN_CHARGE'])) {
                        ?>
                        <tr>
                          <td>Oxygen Charges</td>
                          <td><?php echo $bill_row['OXYGEN_CHARGE']; ?></td>
                        </tr>
                        <?php
                            } 
                        ?>
                          
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
      
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6"></div>
                  <!-- /.col -->
                  <div class="col-6">
                    <p class="lead">Amount Due <?php echo substr($bill_row['DATE_TIME'],0, 24); ?></p>
      
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>PKR - <?php echo $bill_row['TOTAL_AMOUNT']; ?></td>
                        </tr>
                        <tr>
                          <th>Discount:</th>
                          <td>PKR - <?php echo $bill_row['DISCOUNT']; ?></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>PKR - <?php echo $bill_row['TOTAL']; ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php } ?>
              </section>
              <!-- /.content -->
            </div>
            <!-- ./wrapper -->
            <script> window.addEventListener("load", window.print());</script>
            <!-- Main Footer -->
            <?php 
            }else{
                // Get Variables from URL
                $pname = (isset($_GET['pname']) ? $_GET['pname'] : '');
                $admdate = (isset($_GET['admdate']) ? $_GET['admdate'] : '');
                $disdate = (isset($_GET['disdate']) ? $_GET['disdate'] : '');
                $mrid = (isset($_GET['mrid']) ? $_GET['mrid'] : '');
                $phone = (isset($_GET['phone']) ? $_GET['phone'] : '');
                $doctor = (isset($_GET['doc']) ? $_GET['doc'] : '');
                $type = (isset($_GET['type']) ? $_GET['type'] : '');
                $procedure = (isset($_GET['pro']) ? $_GET['pro'] : '');
                $by = (isset($_GET['by']) ? $_GET['by'] : '');

                if ($type == "gynae" || $type == "gensurgery") {  
                  $adcharge = (isset($_GET['adcharge']) ? $_GET['adcharge'] : '');
                  $surcharge = (isset($_GET['surcharge']) ? $_GET['surcharge'] : '');
                  $anescharge = (isset($_GET['anescharge']) ? $_GET['anescharge'] : '');
                  $opcharge = (isset($_GET['opcharge']) ? $_GET['opcharge'] : '');
                  $chargelr = (isset($_GET['chargelr']) ? $_GET['chargelr'] : '');
                  $pedcharge = (isset($_GET['pedcharge']) ? $_GET['pedcharge'] : '');
                  $prcharge = (isset($_GET['prcharge']) ? $_GET['prcharge'] : '');
                  $nurcharge = (isset($_GET['nurcharge']) ? $_GET['nurcharge'] : '');
                  $nurstcharge = (isset($_GET['nurstcharge']) ? $_GET['nurstcharge'] : '');
                  $mochargeTwo = (isset($_GET['mochargeTwo']) ? $_GET['mochargeTwo'] : '');
                  $conChargeThree = (isset($_GET['conChargeThree']) ? $_GET['conChargeThree'] : '');
                  $ctg = (isset($_GET['ctg']) ? $_GET['ctg'] : '');
                  $rrcharge = (isset($_GET['rrcharge']) ? $_GET['rrcharge'] : '');
                  $other = (isset($_GET['other']) ? $_GET['other'] : '');
                  $otherText = (isset($_GET['otherText']) ? $_GET['otherText'] : '');
                }

                if ($type == "genillness") {
                  $prChargeThree = (isset($_GET['prChargeThree']) ? $_GET['prChargeThree'] : '');
                  $mochargeTwo = (isset($_GET['mochargeTwo']) ? $_GET['mochargeTwo'] : '');
                  $monChargeTwo = (isset($_GET['monChargeTwo']) ? $_GET['monChargeTwo'] : '');
                  $oxChargeTwo = (isset($_GET['oxChargeTwo']) ? $_GET['oxChargeTwo'] : '');
                  $nurChargeTwo = (isset($_GET['nurChargeTwo']) ? $_GET['nurChargeTwo'] : '');
                  $conChargeThree = (isset($_GET['conChargeThree']) ? $_GET['conChargeThree'] : '');
                }

                $tbill = (isset($_GET['tbill']) ? $_GET['tbill'] : '');
                $dis = (isset($_GET['dis']) ? $_GET['dis'] : '');
                $fbill = (isset($_GET['fbill']) ? $_GET['fbill'] : '');

                $newAdmdate = substr($admdate,0, 24);
                $newDisdate = substr($disdate,0, 24);
                  
                $newType;
                  if ($type == 'gynae') {
                      $newType = 'Gynae Patient';
                  }else if ($type == 'gensurgery') {
                      $newType = 'General Surgery Patient';
                  }else if ($type == 'genillness') {
                      $newType = 'General Illness Patient';
                  }else if ($type == 'eye') {
                      $newType = 'Eye Patient';
                  }
                // Query to get Username from DB
                $adminSql ="SELECT `ADMIN_USERNAME` FROM `admin` WHERE `ADMIN_ID` =".$by;
                $asql = mysqli_query($db,$adminSql);
                $admin_row = mysqli_fetch_array($asql);
              
            ?>
              <div class="content-wrapper">
                <!-- Main content -->
                <section class="container invoice">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="page-header">
                        <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
                        <small class="float-right" style="font-size:12px;">Slip Date: <?php echo $disdate; ?></small>
                      </h2>
                      <div class="float-right" style="margin-top: -125px;">
                        <div style="display:flex;">
                          <div style="margin:5px 10px;font-size:30px;"><i class="fas fa-map"></i></div>
                          <div style="font-size:15px;">C-1 Commercial Office Block, <br> Paragon City, Lahore.</div>
                        </div>
                        <div style="display:flex;">
                          <div style="margin:15px 10px;font-size:30px;"><i class="fas fa-phone"></i></div> 
                          <div style="font-size:15px;">0300 4133102 <br>0320 4707070 <br>042 37165549</div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <hr style="margin-top:5px;"/>
                <center><h4><?php echo $newType;?></h4></center>
                  <!-- info row -->
                  <div class="row invoice-info">
                  <!-- /.col -->
                  <div class="col-sm-6 invoice-col">
                  <hr style="margin-top:5px;"/>
                  <?php if ($type == "eye") { ?>
                        <h4><b>MR_ID# </b><?php echo $mrid; ?></h4><br>
                        <h4><b>Patient Name :</b> <?php echo $pname; ?></h4><br>
                        <h4><b>Contact :</b> <?php echo $phone; ?></h4><br>
                        <h4><b>Procedure :</b> <?php echo $procedure; ?></h4><br>
                    <?php }else { ?>
                      <p><b>MR_ID# </b><?php echo $mrid; ?></P>
                      <p><b>Patient Name :</b> <?php echo $pname; ?></p>
                      <p><b>Contact :</b> <?php echo $phone; ?></P>
                      <p><b>Procedure :</b> <?php echo $procedure; ?></p>
                      <?php } ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col">
                    <hr style="margin-top:5px;"/>
                    <?php if ($type == "eye") { ?>
                      <h4><b>Date :</b> <?php echo $newDisdate; ?></h4><br>
                      <h4><b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME'];; ?></h4><br>
                      <h4><b>Consultant :</b> <?php echo $doctor; ?></h4><br>
                      <h4><b>Consultant Fee - Discount :</b> <?php echo $fee; ?> - <?php echo $discount; ?></h4><br>
                      <h4><b>Total Fee :</b> <?php echo $finalFee; ?></h4><br>
                    <?php }else { ?>
                      <p><b>Admit Dates :</b> <?php echo $newAdmdate; ?> - <?php echo $newDisdate; ?></p>
                      <p><b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME'];; ?></p>
                      <p><b>Consultant :</b> <?php echo $doctor; ?></p>
                      <?php } ?>
                    </div>
                    <!-- /.col -->
                  </div>
                  <?php if ($type != "eye") { ?>
                  <!-- /.row -->
                    <!-- Table row -->
                  <div class="row">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped table-bordered">
                        <thead>
                        <tr style="width:100%;">
                          <th style="width:80%;">Particular</th>
                          <th style="width:20%;">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                          if (!empty($adcharge)) {
                        ?>
                        <tr>
                          <td>Admission Charges</td>
                          <td><?php echo $adcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($surcharge)) {
                        ?>
                        <tr>
                          <td>Surgeon Charges</td>
                          <td><?php echo $surcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($anescharge)) {
                        ?>
                        <tr>
                          <td>Anesthetist Charges</td>
                          <td><?php echo $anescharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($opcharge)) {
                        ?>
                        <tr>
                          <td>Operation Charges</td>
                          <td><?php echo $opcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($chargelr)) {
                        ?>
                        <tr>
                          <td>Labour Room Charges</td>
                          <td><?php echo $chargelr; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($pedcharge)) {
                        ?>
                        <tr>
                          <td>Pediatric Charges</td>
                          <td><?php echo $pedcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($nurcharge)) {
                        ?>
                        <tr>
                          <td>Nursury Charges</td>
                          <td><?php echo $nurcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($nurstcharge)) {
                        ?>
                        <tr>
                          <td>Nursury Staff Charges</td>
                          <td><?php echo $nurstcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($mocharge)) {
                        ?>
                        <tr>
                          <td>M O Charges</td>
                          <td><?php echo $mocharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($concharge)) {
                        ?>
                        <tr>
                          <td>Consultant Visit Charges</td>
                          <td><?php echo $concharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($ctg)) {
                        ?>
                        <tr>
                          <td>CTG Charges</td>
                          <td><?php echo $ctg; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($rrcharge)) {
                        ?>
                        <tr>
                          <td>Recovery Room Charges</td>
                          <td><?php echo $rrcharge; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($prcharge)) {
                        ?>
                        <tr>
                          <td>Private Room Charges</td>
                          <td><?php echo $prcharge; ?></td>
                        </tr>
                        <?php
                          } 
                          if (!empty($other) && !empty($otherText)) {
                        ?>
                        <tr>
                          <td><?php echo $otherText; ?></td>
                          <td><?php echo $other; ?></td>
                        </tr>
                        <?php 
                            } 
                          if (!empty($prChargeThree)) {
                        ?>
                        <tr>
                          <td>Private Room Charges</td>
                          <td><?php echo $prChargeThree; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($mochargeTwo)) {
                        ?>
                        <tr>
                          <td>Medical Officer Charges</td>
                          <td><?php echo $mochargeTwo; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($monChargeTwo)) {
                        ?>
                        <tr>
                          <td>Monitoring Charges</td>
                          <td><?php echo $monChargeTwo; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($oxChargeTwo)) {
                        ?>
                        <tr>
                          <td>Oxygen Charges</td>
                          <td><?php echo $oxChargeTwo; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($nurChargeTwo)) {
                        ?>
                        <tr>
                          <td>Nursing Charges</td>
                          <td><?php echo $nurChargeTwo; ?></td>
                        </tr>
                        <?php
                          }  
                          if (!empty($conChargeThree)) {
                        ?>
                        <tr>
                          <td>Consultant Charges</td>
                          <td><?php echo $conChargeThree; ?></td>
                        </tr>
                        <?php
                          }  
                        ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6"></div>
                    <!-- /.col -->
                    <div class="col-6">
                      <p class="lead">Amount Due <?php echo $newDisdate; ?></p>
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>PKR - <?php echo $tbill; ?></td>
                          </tr>
                          <tr>
                            <th>Discount:</th>
                            <td>PKR - <?php echo $dis; ?></td>
                          </tr>
                          <tr>
                            <th>Total:</th>
                            <td>PKR - <?php echo $fbill; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <?php } ?>
                </section>
                <!-- /.content -->
              </div>
              <!-- ./wrapper -->
              <script> window.addEventListener("load", window.print());</script>
              <!-- Main Footer -->
  <?php 
    }
      // Footer File
      include('components/footer.php');
      echo '</div>';
      //  Form Script File
      include('components/form_script.php');
    } else {
      echo '<script type="text/javascript">window.location = "login.php";</script>';
    }     
?>