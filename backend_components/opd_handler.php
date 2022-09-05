<?php
    // Start Session 
    session_start();
    // Connection File
    include('connection.php');
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
  
  // Save Patient Data Query
  if ($q == 'ADD_SLIP') {

    // Post Variables
    $uuId = mysqli_real_escape_string($db, $_POST['slipId']);  
    $mrid = mysqli_real_escape_string($db, $_POST['mrid']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $doctor = mysqli_real_escape_string($db, $_POST['doctor']);
    $dept = mysqli_real_escape_string($db, $_POST['dept']);
    $fee = mysqli_real_escape_string($db, $_POST['fee']);
    $age = mysqli_real_escape_string($db, $_POST['age']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $by = mysqli_real_escape_string($db, $_POST['staffId']);

    // Check Data from DB
    $sql = "SELECT * FROM `me_patient` WHERE `PATIENT_MR_ID` = ? OR `PATIENT_MOBILE` = ?";
    $stmt = mysqli_stmt_init($db);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        $result = [];
        $result['status'] = "error";
        $result['message'] = "SQL Database Error!";
        echo json_encode($result);
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"ss",$mrid,$phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
            
        if ($resultCheck > 0) {
          $slipQuery = "INSERT INTO `me_outdoor_slip`(`SLIP_UUID`,`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` , `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?)";
           mysqli_stmt_execute($stmt);
              
            if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                $result = [];
                $result['status'] = "error";
                $result['message'] = "SQL Database Error!";
                echo json_encode($result);
              exit();
            }else{
              // Get Data of Patient from DB
              $patientQuery = "SELECT * FROM `me_patient` WHERE `PATIENT_MR_ID` = '$mrid' OR `PATIENT_MOBILE` = '$phone'";
              $psql = mysqli_query($db,$patientQuery);
              while($prs = mysqli_fetch_array($psql))
              {
                  mysqli_stmt_bind_param($stmt,"ssssssss", $uuId,$prs['PATIENT_MR_ID'],$name,$prs['PATIENT_MOBILE'],$dept,$doctor,$fee,$by);
                if (mysqli_stmt_execute($stmt)) {
                    $printQuery = "SELECT `SLIP_UUID` FROM `me_outdoor_slip` ORDER BY `SLIP_DATE_TIME` DESC LIMIT 1";
                    $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                    $pResult = mysqli_fetch_array($printsql);

                    if ($pResult > 0) {
                        $result = [];
                        $result['status'] = "success";
                        $result['message'] = "Patient slip is created and Patient data already exists.";
                        $result['data'] = $pResult['SLIP_UUID'];
                        echo json_encode($result);
                    }
                }
              } 
            }   
          exit();
        }else if($resultCheck == 0){

            $sql = "INSERT INTO `me_patient`
          (
            `PATIENT_MR_ID`, 
            `PATIENT_NAME`, 
            `PATIENT_MOBILE`, 
            `PATIENT_GENDER`, 
            `PATIENT_AGE`, 
            `PATIENT_ADDRESS`, 
            `STAFF_ID`
          ) VALUES (?,?,?,?,?,?,?)";
          mysqli_stmt_execute($stmt);
                
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                $result = [];
                $result['status'] = "error";
                $result['message'] = "SQL Database Error!";
                echo json_encode($result);
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"sssssss", $mrid,$name,$phone,$gender,$age,$address,$by);
                
                if (mysqli_stmt_execute($stmt)){
                    $slipQuery = "INSERT INTO `me_outdoor_slip`(`SLIP_UUID`,`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` , `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?)";
                
                    if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                        $result = [];
                        $result['status'] = "error";
                        $result['message'] = "SQL Database Error!";
                        echo json_encode($result);
                        exit();
                    }else{
                        mysqli_stmt_bind_param($stmt,"ssssssss", $uuId,$mrid,$name,$phone,$dept,$doctor,$fee,$by);
                            if (mysqli_stmt_execute($stmt)) {
                                $printQuery = "SELECT `SLIP_UUID` FROM `me_outdoor_slip` ORDER BY `SLIP_DATE_TIME` DESC LIMIT 1";
                                $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                                $pResult = mysqli_fetch_array($printsql);
                                if ($pResult > 0) {
                                    $result = [];
                                    $result['status'] = "success";
                                    $result['message'] = "Patient slip is created and Patient data already exists.";
                                    $result['data'] = $pResult['SLIP_UUID'];
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

if ($q == 'GET_DOCTOR') {
    echo '<option disabled selected value="">---- Select Consultant Name ----</option>';
    if ($id == 'me') {
        $doctor = "SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctor` WHERE `DOCTOR_STATUS` = 1";
        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['DOCTOR_UUID'];  
            $name = $row['DOCTOR_NAME'];
            echo '<option value="'.$id.'">'.$name.'</option>'; 
        }
    }else if ($id == 'vt') {
        $doctor = 'SELECT `VISITOR_UUID`, `VISITOR_NAME` FROM `vt_doctor` WHERE `VISITOR_STATUS` = "1"';
        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['VISITOR_UUID'];  
            $name = $row['VISITOR_NAME'];
            echo '<option value="'.$id.'">'.$name.'</option>'; 
        }
    }
       
}
if ($q == 'GET_DOCTOR_BY_DEPT') {
    echo '<option disabled selected value="">---- Select Consultant Name ----</option>';
    if ($id == 'me') {
        $doctor = "SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctor` WHERE `DOCTOR_STATUS` = 1 AND `DEPARTMENT_UUID` = '$val'";
        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['DOCTOR_UUID'];  
            $name = $row['DOCTOR_NAME'];
            echo '<option value="'.$id.'">'.$name.'</option>'; 
        }
    }
    if ($id == 'vt') {
        $doctor = 'SELECT `VISITOR_UUID`, `VISITOR_NAME` FROM `vt_doctor` WHERE `VISITOR_STATUS` = "1"';
        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['VISITOR_UUID'];  
            $name = $row['VISITOR_NAME'];
            echo '<option value="'.$id.'">'.$name.'</option>'; 
        }
    }
       
} 

?>