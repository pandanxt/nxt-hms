<?php
  // Save Indoor Surgery Patient Data Query 
  if (isset($_POST['indoor-submit'])) {
    // Post Variables from Form
    $mrid = $_POST['mrid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

    $doc = $_POST['doctor'];
    $pro = $_POST['procedure'];

    $admdate = $_POST['admdate'];
    // $disdate = $_POST['disdate'];

    if ($type == "genillness") {
      $prChargeThree = $_POST['prChargeThree'];
      $moChargeTwo = $_POST['moChargeTwo'];
      $monChargeTwo = $_POST['monChargeTwo'];
      $oxChargeTwo = $_POST['oxChargeTwo'];
      $nurChargeTwo = $_POST['nurChargeTwo'];
      $conChargeThree = $_POST['conChargeThree']; 
    }
    if ($type == "gensurgery" || $type == "gynae") {
      $adCharge = $_POST['adCharge'];
      $surCharge = $_POST['surCharge'];
      $anesCharge = $_POST['anesCharge'];
      $opCharge = $_POST['opCharge'];
      $chargeLR = $_POST['chargeLR'];
      $pedCharge = $_POST['pedCharge'];
      $prChargeThree = $_POST['prChargeThree'];
      $nurCharge = $_POST['nurCharge'];
      $nurStCharge = $_POST['nurStCharge'];
      $moChargeTwo = $_POST['moChargeTwo'];
      $conChargeThree = $_POST['conChargeThree'];
      $ctg = $_POST['ctg'];
      $rrCharge = $_POST['rrCharge'];
      $other = $_POST['other'];
      $otherText = $_POST['otherText'];
    }
    $tbill = $_POST['tbill'];
    $discount = $_POST['discount'];
    $fbill = $_POST['fbill'];
    $by = $_POST['by'];
    $status = "paid";

    // Query to check if data exists 
    $sql = "SELECT * FROM `indoor_bill` WHERE `SLIP_ID` = ?";
    $stmt = mysqli_stmt_init($db);
          
      if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo '<script type="text/javascript">window.location = "indoor_patient_bill.php?action=billAlreadyCreated";</script>';
          exit();
      }else{
          mysqli_stmt_bind_param($stmt,"s",$sid);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $resultCheck = mysqli_stmt_num_rows($stmt);

          $sql = "INSERT INTO `indoor_bill`(
          `MR_ID`,
          `SLIP_ID`,
          `PATIENT_NAME`,
          `MOBILE`,
          `ADMISSION_DATE`,
          `ADMISSION_CHARGE`,
          `SURGEON_CHARGE`,
          `ANESTHETIST_CHARGE`,
          `OPERATION_CHARGE`,
          `LABOUR_ROOM_CHARGE`,
          `PEDIATRIC_CHARGE`,
          `PRIVATE_ROOM_CHARGE`,
          `NURSURY_CHARGE`,
          `NURSURY_STAFF_CHARGE`,
          `MO_CHARGE`,
          `CONSULTANT_CHARGE`,
          `CTG_CHARGE`,
          `RECOVERY_ROOM_CHARGE`,
          `MONITOR_CHARGE`,
          `NURSING_CHARGE`,
          `OXYGEN_CHARGE`,
          `OTHER`,
          `OTHER_TEXT`,
          `TOTAL_AMOUNT`,
          `DISCOUNT`,
          `TOTAL`,
          `CREATED_BY`
         ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         
          // mysqli_stmt_execute($stmt);
            
          if (!mysqli_stmt_prepare($stmt,$sql)) {
              echo '<script type="text/javascript">window.location = "indoor_patient_bill.php?action=sqlerror";</script>';
              echo "<script>alert('Sqlerror due to DB Query...');</script>";
              exit();
          }else{    
                  mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssssss",
                  $mrid,$sid,$name,$phone,$admdate,$adCharge,$surCharge,$anesCharge,
                  $opCharge,$chargeLR,$pedCharge, $prChargeThree,$nurCharge,$nurStCharge,$moChargeTwo,
                  $conChargeThree,$ctg,$rrCharge,$monChargeTwo,$nurChargeTwo, $oxChargeTwo,
                  $other,$otherText,$tbill,$discount,$fbill,$by);
              mysqli_stmt_execute($stmt);
              // Update Status of the receipt
              $updateSql ="UPDATE `indoor_slip` SET `BILL_STATUS`='$status' WHERE `indoor_slip`.`SLIP_ID`='$sid'";
              if($querySql = mysqli_query($db,$updateSql))
              {
                  $printQuery = "SELECT `BILL_ID` FROM `indoor_bill` ORDER BY `BILL_ID` DESC LIMIT 1";
                  $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                  $pResult = mysqli_fetch_array($printsql);
      
                  if ($pResult > 0) {
                    echo '<script type="text/javascript">window.location = "indoor_bill_print.php?sid='.$pResult['BILL_ID'].'";</script>';
                  }
              }else
              {
                echo mysqli_error($db);
              }  
                exit();
            }			
        }
    mysqli_stmt_close($stmt);
    mysqli_close($db);
  }

//   Emergency Handler
// Save Patient Data Query
if (isset($_POST['emergency-bill-submit'])) {
    // Post Variables
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    // $addDate = $_POST['addDate'];
    $medicalofficer = $_POST['medicalofficer'];
    $injectionim = $_POST['injectionim'];
    $injectioniv = $_POST['injectioniv'];
    $ivline = $_POST['ivline'];
    $stitchInTotal = $_POST['stitchInTotal'];

    $stitchOutTotal = $_POST['stitchOutTotal'];
    $ivinfusion = $_POST['ivinfusion'];
    $bsf = $_POST['bsf'];
    $shortstay = $_POST['shortstay'];
    $bp = $_POST['bp'];
    $ecg = $_POST['ecg'];

    $other1 = $_POST['other1'];
    $otherText1 = $_POST['otherText1'];
    $other2 = $_POST['other2'];
    $otherText2 = $_POST['otherText2'];
    $other3 = $_POST['other3'];
    $otherText3 = $_POST['otherText3'];
    $other4 = $_POST['other4'];
    $otherText4 = $_POST['otherText4'];
    $other5 = $_POST['other5'];
    $otherText5 = $_POST['otherText5'];
    $other6 = $_POST['other6'];
    $otherText6 = $_POST['otherText6'];
    $other7 = $_POST['other7'];
    $otherText7 = $_POST['otherText7'];
    $other8 = $_POST['other8'];
    $otherText8 = $_POST['otherText8'];
    $other9 = $_POST['other9'];
    $otherText9 = $_POST['otherText9'];
    $other10 = $_POST['other10'];
    $otherText10 = $_POST['otherText10'];
    $other11 = $_POST['other11'];
    $otherText11 = $_POST['otherText11'];
    $other12 = $_POST['other12'];
    $otherText12 = $_POST['otherText12'];
    
    $tbill = $_POST['tbill'];
    $discount = $_POST['discount'];
    $fbill = $_POST['fbill'];
    $by = $_POST['by'];
    $status = "created";

    // Check Data from DB
    $sql = "SELECT * FROM `emergency_bill` WHERE `SLIP_ID` = ?";
    $stmt = mysqli_stmt_init($db);
        
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo '<script type="text/javascript">window.location = "emergency_bill.php?action=billAlreadyCreated";</script>';
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$sid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        // Insert Query
        $sql = "INSERT INTO `emergency_bill`
        (
          `MR_ID`,`SLIP_ID`, 
          `PATIENT_NAME`, 
          `MOBILE`,
          `ES_MO_CHARGE`, 
          `INJECTION_IM`, 
          `INJECTION_IV`, 
          `IV_LINE`, 
          `IV_INFUSION`, 
          `PS_IN_300`, 
          `PS_OUT_100`, 
          `BSF_BSR`, 
          `SHORT_STAY`, 
          `BP`, 
          `ECG`,
          `OTHER_1`, 
          `OTHER_TEXT_1`, 
          `OTHER_2`, 
          `OTHER_TEXT_2`,
          `OTHER_3`, 
          `OTHER_TEXT_3`,
          `OTHER_4`, 
          `OTHER_TEXT_4`,
          `OTHER_5`, 
          `OTHER_TEXT_5`,
          `OTHER_6`, 
          `OTHER_TEXT_6`,
          `OTHER_7`, 
          `OTHER_TEXT_7`,
          `OTHER_8`, 
          `OTHER_TEXT_8`,
          `OTHER_9`, 
          `OTHER_TEXT_9`,
          `OTHER_10`, 
          `OTHER_TEXT_10`,
          `OTHER_11`, 
          `OTHER_TEXT_11`,
          `OTHER_12`, 
          `OTHER_TEXT_12`,
          `TOTAL_AMOUNT`, 
          `DISCOUNT`, 
          `TOTAL`, 
          `CREATED_BY`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        // mysqli_stmt_execute($stmt);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo '<script type="text/javascript">window.location = "emergency_bill.php?action=sqlerror";</script>';
          echo "<script>alert('Sqlerror due to DB Query...');</script>";
          exit();
        }else{                                
          mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssssssssssssssssssssss",$mrid,$sid,$name,$phone,$medicalofficer,$injectionim,$injectioniv,$ivline,$ivinfusion,$stitchInTotal,$stitchOutTotal,$bsf,$shortstay,$bp,$ecg, $other1, $otherText1, $other2, $otherText2, $other3, $otherText3, $other4, $otherText4, $other5, $otherText5, $other6,  $otherText6, $other7, $otherText7, $other8, $otherText8, $other9, $otherText9, $other10, $otherText10, $other11, $otherText11, $other12, $otherText12,$tbill,$discount,$fbill,$by);
          mysqli_stmt_execute($stmt);
          // Update Status of the receipt
          $updateSql ="UPDATE `emergency_slip` SET `BILL_STATUS`='$status' WHERE `emergency_slip`.`SLIP_ID`='$sid'";
          if($querySql = mysqli_query($db,$updateSql))
          {
            $printQuery = "SELECT `BILL_ID` FROM `emergency_bill` ORDER BY `BILL_ID` DESC LIMIT 1";
            $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
            $pResult = mysqli_fetch_array($printsql);

            if ($pResult > 0) {
              echo '<script type="text/javascript">window.location = "emergency_bill_print.php?sid='.$pResult['BILL_ID'].'";</script>';
            }
          }else
          {
            echo mysqli_error($db);
          }
          exit();
        }			
    }
    mysqli_stmt_close($stmt);
    mysqli_close($db);
  }
?>