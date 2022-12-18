<?php 
  // Session Start
  session_start();
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');

  if (isset($_SESSION['uuid'])) {  
    include('backend_components/connection.php');
    include('components/file_header.php');
    include('components/navbar.php');
    include('components/sidebar.php');

    if($sid) {
      // Query to get Slip Details 
      $billSql ="SELECT `a`.*, `b`.`USER_NAME`, `c`.*	FROM `me_bill` AS `a` 
      INNER JOIN `me_user` AS `b` ON `b`.`USER_UUID` = `a`.`STAFF_ID` 
      INNER JOIN `me_emergency` AS `c` ON `c`.`EMERGENCY_UUID` = `a`.`BILL_UUID` WHERE `BILL_UUID` = '$sid'";
      $billsql = mysqli_query($db,$billSql);
      $bill_row = mysqli_fetch_array($billsql);
  ?>
  <div class="content-wrapper">
    <section class="container invoice">
      <div class="receipt">
        <div class="orderNo">MR ID# <b><?php echo $bill_row['BILL_MRID']; ?></b>
      </div>
      <div class="headerSubTitle"><?php echo $bill_row['BILL_DATE_TIME']; ?></div>
      <div><img class="titleLogo" src="dist/img/hospital-logo.png" alt="Medeast Hospital Logo"></div>
      <div id="date">C-1 Commercial Office Block,</br> Paragon City, Lahore.</div>
      <div id="date">042 37165549, 0320 4707070, 0300 4133102</div>
      <div class="headerSubTitle mt-2 mb-2"><?php echo 'Emergency Bill'; ?></div>
      <div class="col-sm-12">
        <small>Patient Name# <b><?php echo $bill_row['BILL_NAME']; ?></b></small><br>
        <small>Patient Phone# <b><?php echo $bill_row['BILL_MOBILE']; ?></b></small>
      </div>
      <table class="table table-bordered table-custom">
        <thead>
          <tr style="width:100%;">
            <th style="width:75%;" class="right-chars">&nbsp;Particular</th>
            <th style="width:25%;" class="right-chars">&nbsp;Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (!empty($bill_row['ES_MO_FEE'])) {
          ?>  
          <tr>
            <td class="right-chars">&nbsp;Emergency/MO Fee</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['ES_MO_FEE']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['INJECTION_IM'])) {
          ?> 
          <tr>
            <td class="right-chars">&nbsp;Injection I/M</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['INJECTION_IM']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['INJECTION_IV'])) {
          ?> 
          <tr>
            <td class="right-chars">&nbsp;Injection I/V</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['INJECTION_IV']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['IV_LINE_IN_OUT'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;I/V Line (In/Out)</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['IV_LINE_IN_OUT']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['INFUSION_ANTIBIOTIC'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Infusion + Antibiotic</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['INFUSION_ANTIBIOTIC']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['PER_STITCH_IN'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Per Stitch In</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['PER_STITCH_IN']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['PER_STITCH_OUT'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Per Stitch Out</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['PER_STITCH_OUT']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['BSF_BSR'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;BSF / BSR</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['BSF_BSR']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['SHORT_STAY'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Short Stay</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['SHORT_STAY']; ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['BP'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Blood Pressure-BP</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['BP'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['ECG'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;ECG</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['ECG'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['DRIP'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Drip (500ml/1000ml)</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['DRIP'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['DRIP_VENOFER'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Drip Venofar</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['DRIP_VENOFER'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['DRESSING_SMALL_LARGE'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Dressing Charges</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['DRESSING_SMALL_LARGE'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['NEBULIZATION'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Nebulization</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['NEBULIZATION'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['MONITOR_CHARGE'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Monitor Charges <small>(2-3 Hours)</small></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['MONITOR_CHARGE'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['CTG'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;CTG</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['CTG'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['FOLEY_CATHETER'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Foley Catheter</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['FOLEY_CATHETER'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['STOMACH_WASH'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Stomach WasH</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['STOMACH_WASH'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['BLOOD_TRANSFUSION'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Blood Transfusion</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['BLOOD_TRANSFUSION'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['ASCITIC_DIAGNOSTIC_THERAPEUTIC'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Ascitic <br><small>(Diagnostic/Therapeutic)</small></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['ASCITIC_DIAGNOSTIC_THERAPEUTIC'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Pleural Fuid <br><small>(TAP Diagnostic/Therapeutic)</small></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['ENDO_TRACHEAL_TUBE'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Endo Tracheal Tube</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['ENDO_TRACHEAL_TUBE'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['ENEMA'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Enema</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['ENEMA'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['LUMBER_PUNCTURE'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;Lumber Puncture</td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['LUMBER_PUNCTURE'] ?></td>
          </tr>
          <?php
            }
            if (!empty($bill_row['OTHER_TEXT_1'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_1'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_1'] ?></td>
          </tr>
          <?php
            }
          if (!empty($bill_row['OTHER_TEXT_2'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_2'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_2'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_3'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_3'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_3'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_4'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_4'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_4'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_5'])) {
          ?>
          <tr>
          <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_5'] ?></td>
          <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_5'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_6'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_6'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_6'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_7'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_7'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_7'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_8'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_8'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_8'] ?></td>
          </tr>
          <?php
            }
          if (!empty($bill_row['OTHER_TEXT_9'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_9'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_9'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_10'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_10'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_10'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_11'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_11'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_11'] ?></td>
          </tr>
          <?php
          }
          if (!empty($bill_row['OTHER_TEXT_12'])) {
          ?>
          <tr>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_TEXT_12'] ?></td>
            <td class="right-chars">&nbsp;<?php echo $bill_row['OTHER_12'] ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <div class="flex">
        <div class="totals">
          <div class="section">
            <div class="row">
              <div class="col2"><b>Total Amount: </b></div>
              <div class="col3"><b class="nxt">&#8360;-<?php echo $bill_row['BILL_AMOUNT']; ?></b></div>
            </div>
            <?php if (!empty($bill_row['BILL_DISCOUNT']) || $bill_row['BILL_DISCOUNT'] != 0) { ?>
            <div class="row">
              <div class="col2"><b>Discount: </b></div>
              <div class="col3"><b class="nxt">&#8360;-<?php echo $bill_row['BILL_DISCOUNT']; ?></b></div>
            </div>
            <?php } if (!empty($bill_row['BILL_TOTAL']) || (!empty($bill_row['BILL_DISCOUNT']))) { ?>
            <div class="row">
              <div class="col2"><b>Payables: </b></div>
              <div class="col3"><b class="nxt">&#8360;-<?php echo $bill_row['BILL_TOTAL']; ?></b></div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="keepIt mt-2">Keep your bill!</div>
      <div class="keepItBody">Computer generated Receipt, Does not require signature or stamp. Bring this original receipt when revisiting MEDEAST.</div>
      <br>
      <div style="display:flex;">
        <div class="staffFooter">Staff# <span><?php echo $bill_row['USER_NAME']; ?></span></div>
        <div class="brandFooter">Powered by: <span>PandaNxt</span></div>
      </div>
      </div>
    </section>
  </div>
  <script> window.addEventListener("load", window.print());</script>
  <?php
    }
    echo '</div>';
    // REQUIRED SCRIPTS 
    include('components/file_footer.php');
  }else{
    echo '<script type="text/javascript">window.location = "login.php";</script>';
  } 
?>