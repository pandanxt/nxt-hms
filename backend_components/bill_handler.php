<?php
  // Start Session 
  session_start();
  // Connection File
  include('connection.php');
  // Query Params
  $q = (isset($_GET['q']) ? $_GET['q'] : '');
  $id = (isset($_GET['id']) ? $_GET['id'] : '');
  $val = (isset($_GET['val']) ? $_GET['val'] : '');
  // Save Indoor Surgery Patient Data Query 
  // if (isset($_POST['indoor-submit'])) {
  //   // Post Variables from Form
  //   $mrid = $_POST['mrid'];
  //   $name = $_POST['name'];
  //   $phone = $_POST['phone'];
  //   $type = $_POST['type'];

  //   $doc = $_POST['doctor'];
  //   $pro = $_POST['procedure'];

  //   $admdate = $_POST['admdate'];
  //   // $disdate = $_POST['disdate'];

  //   if ($type == "genillness") {
  //     $prChargeThree = $_POST['prChargeThree'];
  //     $moChargeTwo = $_POST['moChargeTwo'];
  //     $monChargeTwo = $_POST['monChargeTwo'];
  //     $oxChargeTwo = $_POST['oxChargeTwo'];
  //     $nurChargeTwo = $_POST['nurChargeTwo'];
  //     $conChargeThree = $_POST['conChargeThree']; 
  //   }
  //   if ($type == "gensurgery" || $type == "gynae") {
  //     $adCharge = $_POST['adCharge'];
  //     $surCharge = $_POST['surCharge'];
  //     $anesCharge = $_POST['anesCharge'];
  //     $opCharge = $_POST['opCharge'];
  //     $chargeLR = $_POST['chargeLR'];
  //     $pedCharge = $_POST['pedCharge'];
  //     $prChargeThree = $_POST['prChargeThree'];
  //     $nurCharge = $_POST['nurCharge'];
  //     $nurStCharge = $_POST['nurStCharge'];
  //     $moChargeTwo = $_POST['moChargeTwo'];
  //     $conChargeThree = $_POST['conChargeThree'];
  //     $ctg = $_POST['ctg'];
  //     $rrCharge = $_POST['rrCharge'];
  //     $other = $_POST['other'];
  //     $otherText = $_POST['otherText'];
  //   }
  //   $tbill = $_POST['tbill'];
  //   $discount = $_POST['discount'];
  //   $fbill = $_POST['fbill'];
  //   $by = $_POST['by'];
  //   $status = "paid";

  //   // Query to check if data exists 
  //   $sql = "SELECT * FROM `indoor_bill` WHERE `SLIP_ID` = ?";
  //   $stmt = mysqli_stmt_init($db);
          
  //     if (!mysqli_stmt_prepare($stmt,$sql)) {
  //         echo '<script type="text/javascript">window.location = "indoor_patient_bill.php?action=billAlreadyCreated";</script>';
  //         exit();
  //     }else{
  //         mysqli_stmt_bind_param($stmt,"s",$sid);
  //         mysqli_stmt_execute($stmt);
  //         mysqli_stmt_store_result($stmt);
  //         $resultCheck = mysqli_stmt_num_rows($stmt);

  //         $sql = "INSERT INTO `indoor_bill`(
  //         `MR_ID`,
  //         `SLIP_ID`,
  //         `PATIENT_NAME`,
  //         `MOBILE`,
  //         `ADMISSION_DATE`,
  //         `ADMISSION_CHARGE`,
  //         `SURGEON_CHARGE`,
  //         `ANESTHETIST_CHARGE`,
  //         `OPERATION_CHARGE`,
  //         `LABOUR_ROOM_CHARGE`,
  //         `PEDIATRIC_CHARGE`,
  //         `PRIVATE_ROOM_CHARGE`,
  //         `NURSURY_CHARGE`,
  //         `NURSURY_STAFF_CHARGE`,
  //         `MO_CHARGE`,
  //         `CONSULTANT_CHARGE`,
  //         `CTG_CHARGE`,
  //         `RECOVERY_ROOM_CHARGE`,
  //         `MONITOR_CHARGE`,
  //         `NURSING_CHARGE`,
  //         `OXYGEN_CHARGE`,
  //         `OTHER`,
  //         `OTHER_TEXT`,
  //         `TOTAL_AMOUNT`,
  //         `DISCOUNT`,
  //         `TOTAL`,
  //         `CREATED_BY`
  //        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         
  //         // mysqli_stmt_execute($stmt);
            
  //         if (!mysqli_stmt_prepare($stmt,$sql)) {
  //             echo '<script type="text/javascript">window.location = "indoor_patient_bill.php?action=sqlerror";</script>';
  //             echo "<script>alert('Sqlerror due to DB Query...');</script>";
  //             exit();
  //         }else{    
  //                 mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssssss",
  //                 $mrid,$sid,$name,$phone,$admdate,$adCharge,$surCharge,$anesCharge,
  //                 $opCharge,$chargeLR,$pedCharge, $prChargeThree,$nurCharge,$nurStCharge,$moChargeTwo,
  //                 $conChargeThree,$ctg,$rrCharge,$monChargeTwo,$nurChargeTwo, $oxChargeTwo,
  //                 $other,$otherText,$tbill,$discount,$fbill,$by);
  //             mysqli_stmt_execute($stmt);
  //             // Update Status of the receipt
  //             $updateSql ="UPDATE `indoor_slip` SET `BILL_STATUS`='$status' WHERE `indoor_slip`.`SLIP_ID`='$sid'";
  //             if($querySql = mysqli_query($db,$updateSql))
  //             {
  //                 $printQuery = "SELECT `BILL_ID` FROM `indoor_bill` ORDER BY `BILL_ID` DESC LIMIT 1";
  //                 $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
  //                 $pResult = mysqli_fetch_array($printsql);
      
  //                 if ($pResult > 0) {
  //                   echo '<script type="text/javascript">window.location = "indoor_bill_print.php?sid='.$pResult['BILL_ID'].'";</script>';
  //                 }
  //             }else
  //             {
  //               echo mysqli_error($db);
  //             }  
  //               exit();
  //           }			
  //       }
  //   mysqli_stmt_close($stmt);
  //   mysqli_close($db);
  // }

//   Emergency Handler
// Save Patient Data Query
if ($q == 'ADD_EMERGENCY_BILL') {
  // Post Variables
  $billId = mysqli_real_escape_string($db, $_POST['billId']);
  $mrId = mysqli_real_escape_string($db, $_POST['mrId']);  
  $slipId = mysqli_real_escape_string($db, $_POST['slipId']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $totalBill = mysqli_real_escape_string($db, $_POST['totalBill']);
  $discount = mysqli_real_escape_string($db, $_POST['discount']);
  $finalBill = mysqli_real_escape_string($db, $_POST['finalBill']);
  $staffId = mysqli_real_escape_string($db, $_POST['staffId']);

  $moCharge = (!empty($_POST['moCharge'])) ? mysqli_real_escape_string($db, $_POST['moCharge']) : 0;  
  $injectionIM = (!empty($_POST['injectionIM'])) ? mysqli_real_escape_string($db, $_POST['injectionIM']) : 0;
  $injectionIV = (!empty($_POST['injectionIV'])) ? mysqli_real_escape_string($db, $_POST['injectionIV']) : 0;
  $ivLine = (!empty($_POST['ivLine'])) ? mysqli_real_escape_string($db, $_POST['ivLine']) : 0;
  $infusionAntibiotic = (!empty($_POST['infusionAntibiotic'])) ? mysqli_real_escape_string($db, $_POST['infusionAntibiotic']) : 0; 
  $stitchInTotal = (!empty($_POST['stitchInTotal'])) ? mysqli_real_escape_string($db, $_POST['stitchInTotal']) : 0;
  $stitchOutTotal = (!empty($_POST['stitchOutTotal'])) ? mysqli_real_escape_string($db, $_POST['stitchOutTotal']) : 0;
  $bsf = (!empty($_POST['bsf'])) ? mysqli_real_escape_string($db, $_POST['bsf']) : 0;
  $shortStay = (!empty($_POST['shortStay'])) ? mysqli_real_escape_string($db, $_POST['shortStay']) : 0;
  $bp = (!empty($_POST['bp'])) ? mysqli_real_escape_string($db, $_POST['bp']) : 0;

  $ecg = (!empty($_POST['ecg'])) ? mysqli_real_escape_string($db, $_POST['ecg']) : 0;  
  $drip = (!empty($_POST['drip'])) ? mysqli_real_escape_string($db, $_POST['drip']) : 0;
  $venofar = (!empty($_POST['venofar'])) ? mysqli_real_escape_string($db, $_POST['venofar']) : 0;
  $stomachWash = (!empty($_POST['stomachWash'])) ? mysqli_real_escape_string($db, $_POST['stomachWash']) : 0;
  $foleyCath = (!empty($_POST['foleyCath'])) ? mysqli_real_escape_string($db, $_POST['foleyCath']) : 0;
  $ctg = (!empty($_POST['ctg'])) ? mysqli_real_escape_string($db, $_POST['ctg']) : 0;
  $dressing = (!empty($_POST['dressing'])) ? mysqli_real_escape_string($db, $_POST['dressing']) : 0;
  $nebulization = (!empty($_POST['nebulization'])) ? mysqli_real_escape_string($db, $_POST['nebulization']) : 0;
  $monChargeTwo = (!empty($_POST['monChargeTwo'])) ? mysqli_real_escape_string($db, $_POST['monChargeTwo']) : 0;
  $enema = (!empty($_POST['enema'])) ? mysqli_real_escape_string($db, $_POST['enema']) : 0;

  $bloodTransfusion = (!empty($_POST['bloodTransfusion'])) ? mysqli_real_escape_string($db, $_POST['bloodTransfusion']) : 0;  
  $ett = (!empty($_POST['ett'])) ? mysqli_real_escape_string($db, $_POST['ett']) : 0;
  $ascitic = (!empty($_POST['ascitic'])) ? mysqli_real_escape_string($db, $_POST['ascitic']) : 0;
  $pleuralFuid = (!empty($_POST['pleuralFuid'])) ? mysqli_real_escape_string($db, $_POST['pleuralFuid']) : 0;
  $lumberPuncture = (!empty($_POST['lumberPuncture'])) ? mysqli_real_escape_string($db, $_POST['lumberPuncture']) : 0;

  $other1 = (!empty($_POST['other1'])) ? mysqli_real_escape_string($db, $_POST['other1']) : 0;
  $otherText1 = (!empty($_POST['otherText1'])) ? mysqli_real_escape_string($db, $_POST['otherText1']) : NULL;

  $other2 = (!empty($_POST['other2'])) ? mysqli_real_escape_string($db, $_POST['other2']) : 0;
  $otherText2 = (!empty($_POST['otherText2'])) ? mysqli_real_escape_string($db, $_POST['otherText2']) : NULL;

  $other3 = (!empty($_POST['other3'])) ? mysqli_real_escape_string($db, $_POST['other3']) : 0;
  $otherText3 = (!empty($_POST['otherText3'])) ? mysqli_real_escape_string($db, $_POST['otherText3']) : NULL;

  $other4 = (!empty($_POST['other4'])) ? mysqli_real_escape_string($db, $_POST['other4']) : 0;
  $otherText4 = (!empty($_POST['otherText4'])) ? mysqli_real_escape_string($db, $_POST['otherText4']) : NULL;

  $other5 = (!empty($_POST['other5'])) ? mysqli_real_escape_string($db, $_POST['other5']) : 0;
  $otherText5 = (!empty($_POST['otherText5'])) ? mysqli_real_escape_string($db, $_POST['otherText5']) : NULL;

  $other6 = (!empty($_POST['other6'])) ? mysqli_real_escape_string($db, $_POST['other6']) : 0;
  $otherText6 = (!empty($_POST['otherText6'])) ? mysqli_real_escape_string($db, $_POST['otherText6']) : NULL;

  $other7 = (!empty($_POST['other7'])) ? mysqli_real_escape_string($db, $_POST['other7']) : 0;
  $otherText7 = (!empty($_POST['otherText7'])) ? mysqli_real_escape_string($db, $_POST['otherText7']) : NULL;

  $other8 = (!empty($_POST['other8'])) ? mysqli_real_escape_string($db, $_POST['other8']) : 0;
  $otherText8 = (!empty($_POST['otherText8'])) ? mysqli_real_escape_string($db, $_POST['otherText8']) : NULL;

  $other9 = (!empty($_POST['other9'])) ? mysqli_real_escape_string($db, $_POST['other9']) : 0;
  $otherText9 = (!empty($_POST['otherText9'])) ? mysqli_real_escape_string($db, $_POST['otherText9']) : NULL;

  $other10 = (!empty($_POST['other10'])) ? mysqli_real_escape_string($db, $_POST['other10']) : 0;
  $otherText10 = (!empty($_POST['otherText10'])) ? mysqli_real_escape_string($db, $_POST['otherText10']) : NULL;

  $other11 = (!empty($_POST['other11'])) ? mysqli_real_escape_string($db, $_POST['other11']) : 0;
  $otherText11 = (!empty($_POST['otherText11'])) ? mysqli_real_escape_string($db, $_POST['otherText11']) : NULL;

  $other12 = (!empty($_POST['other12'])) ? mysqli_real_escape_string($db, $_POST['other12']) : 0;
  $otherText12 = (!empty($_POST['otherText12'])) ? mysqli_real_escape_string($db, $_POST['otherText12']) : NULL;

  // Check Data from DB
  $sql = "SELECT * FROM `me_bill` WHERE `BILL_SLIP_UUID` = ?";
  $stmt = mysqli_stmt_init($db);
        
  if (!mysqli_stmt_prepare($stmt,$sql)) {
  
    $result = [];
    $result['status'] = "error";
    $result['message'] = "SQL Database Error!";
    echo json_encode($result);
    exit();
  
  }else{
  
    mysqli_stmt_bind_param($stmt,"s",$slipId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
          
      if ($resultCheck > 0) {
        
        $printQuery = "SELECT `BILL_UUID` FROM `me_bill` WHERE `BILL_SLIP_UUID` = '$slipId'";
        $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
        $pResult = mysqli_fetch_array($printsql);
        $result = [];
        $result['status'] = "warning";
        $result['message'] = "Bill Data Already Exists!";
        $result['data'] = [];
        $result['data']['id'] = $pResult['BILL_UUID'];
        $result['data']['type'] = "EMERGENCY_BILL";
        echo json_encode($result);
        exit();
  
      }else if($resultCheck == 0){

        $sql = "INSERT INTO `me_bill`(
          `BILL_UUID`, 
          `BILL_MRID`, 
          `BILL_SLIP_UUID`, 
          `BILL_NAME`, 
          `BILL_MOBILE`, 
          `BILL_AMOUNT`, 
          `BILL_DISCOUNT`, 
          `BILL_TOTAL`, 
          `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?,?)";

          mysqli_stmt_execute($stmt);
          
          if (!mysqli_stmt_prepare($stmt,$sql)) {
            
            $result = [];
            $result['status'] = "error";
            $result['message'] = "SQL Database Error!";
            echo json_encode($result);
            exit();
          
          }else{
            
            mysqli_stmt_bind_param($stmt, "sssssssss", $billId, $mrId, $slipId, $name, $phone, $totalBill, $discount, $finalBill, $staffId);
              
            if (mysqli_stmt_execute($stmt)){
              
              $slipQuery = "INSERT INTO `me_emergency`(
                `EMERGENCY_UUID`,`EMERGENCY_SLIP_UUID`,`ES_MO_FEE`,`INJECTION_IM`, 
                `INJECTION_IV`,`DRIP`,`DRIP_VENOFER`,`INFUSION_ANTIBIOTIC`, 
                `IV_LINE_IN_OUT`,`DRESSING_SMALL_LARGE`,`PER_STITCH_IN`,`PER_STITCH_OUT`,
                `BSF_BSR`,`BP`,`NEBULIZATION`,`ECG`,`MONITOR_CHARGE`,`CTG`,`FOLEY_CATHETER`,
                `STOMACH_WASH`,`BLOOD_TRANSFUSION`,`ASCITIC_DIAGNOSTIC_THERAPEUTIC`,  
                `PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC`,`ENDO_TRACHEAL_TUBE`,`ENEMA`,
                `LUMBER_PUNCTURE`,`SHORT_STAY`,
                `OTHER_TEXT_1`,`OTHER_1`,`OTHER_TEXT_2`,`OTHER_2`,
                `OTHER_TEXT_3`,`OTHER_3`,`OTHER_TEXT_4`,`OTHER_4`,
                `OTHER_TEXT_5`,`OTHER_5`,`OTHER_TEXT_6`,`OTHER_6`,
                `OTHER_TEXT_7`,`OTHER_7`,`OTHER_TEXT_8`,`OTHER_8`, 
                `OTHER_TEXT_9`,`OTHER_9`,`OTHER_TEXT_10`,`OTHER_10`,
                `OTHER_TEXT_11`,`OTHER_11`,`OTHER_TEXT_12`,`OTHER_12`
              ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                  
                if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                    
                  $result = [];
                  $result['status'] = "error";
                  $result['message'] = "SQL Database Error!";
                  echo json_encode($result);
                  exit();
                
                }else{
                  
                  mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssssssssssssssss", 
                  $billId, $slipId, $moCharge, $injectionIM, $injectionIV, 
                  $drip, $venofar, $infusionAntibiotic, $ivLine, $dressing, 
                  $stitchInTotal, $stitchOutTotal, $bsf, $bp, $nebulization, 
                  $ecg, $monChargeTwo, $ctg, $foleyCath, $stomachWash, 
                  $bloodTransfusion, $ascitic, $pleuralFuid, $ett, $enema, 
                  $lumberPuncture, $shortStay, $otherText1, $other1, $otherText2, $other2, 
                  $otherText3, $other3, $otherText4, $other4, $otherText5, 
                  $other5, $otherText6, $other6, $otherText7, $other7, 
                  $otherText8, $other8, $otherText9, $other9, $otherText10, 
                  $other10, $otherText11, $other11, $otherText12, $other12);
                  
                  if (mysqli_stmt_execute($stmt)) {
                    
                    // Update Status of the receipt
                    $updateSql ="UPDATE `me_slip` SET `SLIP_STATUS`= 0 WHERE `SLIP_UUID` = '$slipId'";
                    if($querySql = mysqli_query($db,$updateSql))
                    {

                      $printQuery = "SELECT `BILL_UUID` FROM `me_bill` WHERE `BILL_UUID` = '$billId'";
                      $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                      $pResult = mysqli_fetch_array($printsql);
                      
                      if ($pResult > 0) {
                        $result = [];
                        $result['status'] = "success";
                        $result['message'] = "Patient bill against slip created successfully.";
                        $result['data'] = [];
                        $result['data']['id'] = $pResult['BILL_UUID'];
                        $result['data']['type'] = "EMERGENCY_BILL";
                        echo json_encode($result);
                      }

                    }else{
                      $result = [];
                      $result['status'] = "error";
                      $result['message'] = mysqli_error($db);
                      echo json_encode($result);
                    }                    
                  } 
                  exit();
                }   
            }
          }			
      }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($db);
}
?>