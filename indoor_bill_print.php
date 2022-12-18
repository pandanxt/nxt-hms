<?php
    session_start();
    $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');

    if (isset($_SESSION['uuid'])) {
      
      include('backend_components/connection.php');
      // File Header
      include('components/file_header.php'); 
      // Navbar File
      include('components/navbar.php'); 
      // Sidebar File
      include('components/sidebar.php');
      //*******************************************//
      //*Gynae, General and Illness Surgery Print*//
      //*****************************************//
            if ($sid){
              // Query to get Slip Details 
              $billSql ="SELECT `a`.*, `b`.`USER_NAME`, `c`.* ,`d`.* , `e`.`DOCTOR_NAME`	
              FROM `me_bill` AS `a` 
              INNER JOIN `me_user` AS `b` ON `b`.`USER_UUID` = `a`.`STAFF_ID` 
              INNER JOIN `me_indoor` AS `c` ON `c`.`INDOOR_UUID` = `a`.`BILL_UUID` 
              INNER JOIN `me_slip` AS `d` ON `d`.`SLIP_UUID` = `a`.`BILL_SLIP_UUID`
              INNER JOIN `me_doctors` AS `e` ON `e`.`DOCTOR_UUID` = `d`.`SLIP_DOCTOR`
              WHERE `BILL_UUID` = '$sid'";
              $billsql = mysqli_query($db,$billSql);
              $bill_row = mysqli_fetch_array($billsql);

    ?>
              <div class="content-wrapper">
              <!-- Main content -->
              <section class="container invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="page-header">
                      <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
                      <small class="float-right" style="font-size:12px;">Slip Date: <?php echo $bill_row['BILL_DATE_TIME']; ?></small>
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
                <center>
                  <h4>
                    <?php 
                    if ($bill_row['SLIP_TYPE'] == 'INDOOR') {
                      if ($bill_row['SLIP_SUB_TYPE'] == 'GYNEACOLOGY_PATIENT') {
                        echo "INDOOR GYNEACOLOGY BILL";
                      }else if ($bill_row['SLIP_SUB_TYPE'] == 'GENERAL_SURGERY_PATIENT') {
                        echo "INDOOR GENERAL SURGERY BILL";
                      }else if ($bill_row['SLIP_SUB_TYPE'] == 'GENERAL_ILLNESS_PATIENT') {
                        echo "INDOOR GENERAL ILLNESS BILL";
                      }else if ($bill_row['SLIP_SUB_TYPE'] == 'EYE_PATIENT') {
                        echo "INDOOR EYE BILL";
                      }
                    }  
                    ?>
                  </h4>
                </center>
                <!-- info row -->
                <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-6 invoice-col" style="font-size:12px;">
                <hr style="margin-top:5px;"/>
                    <?php if ($bill_row['SLIP_SUB_TYPE'] == 'EYE_PATIENT') { ?>
                        <h4><b>MR_ID# </b> <?php echo $bill_row['BILL_MRID']; ?></h4><br>
                        <h4><b>Patient Name :</b> <?php echo $bill_row['BILL_NAME']; ?></h4><br>
                        <h4><b>Contact :</b> <?php echo $bill_row['BILL_MOBILE']; ?></h4><br>
                        <h4><b>Procedure :</b> <?php echo $bill_row['SLIP_PROCEDURE']; ?></h4><br>
                    <?php }else { ?>
                        <p><b>MR_ID# </b><?php echo $bill_row['BILL_MRID']; ?></p>
                        <p><b>Patient Name :</b> <?php echo $bill_row['BILL_NAME']; ?></p>
                        <p><b>Contact :</b> <?php echo $bill_row['BILL_MOBILE']; ?></p>
                        <p><b>Procedure :</b> <?php echo $bill_row['SLIP_PROCEDURE']; ?></p>
                    <?php } ?>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6 invoice-col" style="font-size:12px;">
                  <hr style="margin-top:5px;"/>
                    <?php if ($bill_row['SLIP_SUB_TYPE'] == 'EYE_PATIENT') { ?>
                    <h4><b>Date :</b> <?php echo $bill_row['DISCHARGE_DATE_TIME']; ?></h4><br>
                    <h4><b>Staff :</b> <?php echo $bill_row['USER_NAME']; ?></h4><br>
                    <h4><b>Consultant :</b> <?php echo $bill_row['DOCTOR_NAME']; ?></h4><br>
                    <?php if (!$bill_row['BILL_DISCOUNT']) { ?>
                        <h4><b>Consultant Fee: </b> PKR - <?php echo $bill_row['BILL_TOTAL']; ?></h4><br>  
                    <?php }else{?>
                        <h4><b>Consultant Fee - Discount :</b> <?php echo $bill_row['BILL_AMOUNT']; ?> - <?php echo $bill_row['BILL_DISCOUNT']; ?></h4><br>
                        <h4><b>Total Fee :</b> PKR - <?php echo $bill_row['BILL_TOTAL']; ?></h4><br>   
                      <?php } 
                     }else { ?>
                      <p><b>Admit Dates :</b> <?php echo $bill_row['ADMISSION_DATE_TIME']; ?> - <?php echo $bill_row['DISCHARGE_DATE_TIME']; ?></p>
                      <p><b>Consultant :</b> <?php echo $bill_row['DOCTOR_NAME']; ?></p>
                      <p><b>Staff :</b> <?php echo $bill_row['USER_NAME']; ?></p>
                    <?php } ?>
                  </div>
                  <!-- /.col -->
                </div>
                <?php if ($bill_row['SLIP_SUB_TYPE'] != 'EYE_PATIENT') { ?>
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
                          if (!empty($bill_row['OTHER_TEXT_1'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_1'] ?></td>
                          <td><?php echo $bill_row['OTHER_1'] ?></td>
                        </tr>
                        <?php
                          }
                        if (!empty($bill_row['OTHER_TEXT_2'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_2'] ?></td>
                          <td><?php echo $bill_row['OTHER_2'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_3'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_3'] ?></td>
                          <td><?php echo $bill_row['OTHER_3'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_4'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_4'] ?></td>
                          <td><?php echo $bill_row['OTHER_4'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_5'])) {
                        ?>
                        <tr>
                        <td><?php echo $bill_row['OTHER_TEXT_5'] ?></td>
                        <td><?php echo $bill_row['OTHER_5'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_6'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_6'] ?></td>
                          <td><?php echo $bill_row['OTHER_6'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_7'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_7'] ?></td>
                          <td><?php echo $bill_row['OTHER_7'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_8'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_8'] ?></td>
                          <td><?php echo $bill_row['OTHER_8'] ?></td>
                        </tr>
                        <?php
                          }
                        if (!empty($bill_row['OTHER_TEXT_9'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_9'] ?></td>
                          <td><?php echo $bill_row['OTHER_9'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_10'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_10'] ?></td>
                          <td><?php echo $bill_row['OTHER_10'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_11'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_11'] ?></td>
                          <td><?php echo $bill_row['OTHER_11'] ?></td>
                        </tr>
                        <?php
                        }
                        if (!empty($bill_row['OTHER_TEXT_12'])) {
                        ?>
                        <tr>
                          <td><?php echo $bill_row['OTHER_TEXT_12'] ?></td>
                          <td><?php echo $bill_row['OTHER_12'] ?></td>
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
                    <p class="lead">Amount Due <?php echo $bill_row['BILL_DATE_TIME']; ?></p>
      
                    <div class="table-responsive">
                      <table class="table">
                      <?php if (!$bill_row['BILL_DISCOUNT']) { ?>
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>PKR - <?php echo $bill_row['BILL_AMOUNT']; ?></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>PKR - <?php echo $bill_row['BILL_TOTAL']; ?></td>
                        </tr> 
                    <?php }else{ ?>
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>PKR - <?php echo $bill_row['BILL_AMOUNT']; ?></td>
                        </tr>
                        <tr>
                          <th>Discount:</th>
                          <td>PKR - <?php echo $bill_row['BILL_DISCOUNT']; ?></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>PKR - <?php echo $bill_row['BILL_TOTAL']; ?></td>
                        </tr>
                        <?php } ?>
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
      // REQUIRED SCRIPTS 
      include('components/file_footer.php');
    } else {
      echo '<script type="text/javascript">window.location = "login.php";</script>';
    }     
?>