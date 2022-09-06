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
//  Get Doctor List
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
// Get Doctor List by Department
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
// Add OPD-SLIP Request Query
if ($q == 'ADD_REQUEST') {
    $reqId = mysqli_real_escape_string($db, $_POST['reqId']);
    // $refId = mysqli_real_escape_string($db, $_POST['refid']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $comment = mysqli_real_escape_string($db, $_POST['comment']);
    $by = mysqli_real_escape_string($db, $_POST['staffId']);
    // $table = 'OPD_SLIP_REQUEST';

    $sql = "INSERT INTO `me_request`(`REQUEST_UUID`,`REQUEST_REFERENCE_UUID`, `REQUEST_NAME`, `REQUEST_COMMENT`, `STAFF_ID`) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "Error: " . $sql . "" . mysqli_error($stmt);
    }else{
        mysqli_stmt_bind_param($stmt,"sssss",$reqId,$id,$title,$comment,$by);
        mysqli_stmt_execute($stmt);
        echo "Form Has been submitted successfully";
    }			

    mysqli_stmt_close($stmt);
    mysqli_close($db);
}
// View Edit Request Query Response
if ($q == 'VIEW_REQUEST') {
    $request = "SELECT *, `USER_NAME` FROM `me_request` INNER JOIN `me_user` WHERE `me_request`.`STAFF_ID` = `me_user`.`USER_UUID` AND `REQUEST_UUID` = '$id'";
    $result = mysqli_query($db, $request) or die (mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr style='font-size: 12px;'>
        <td>";
        if ($row['REQUEST_NAME'] == 'cancel') {
            echo "Record Cancel Request";
        }else if ($row['REQUEST_NAME'] == 'update') {
            echo "Record Update Request";
        }
        echo"</td>
        <td>$row[REQUEST_COMMENT]</td>
        <td>";
        if ($row['REQUEST_STATUS'] == 0) {
            echo "Pending";
        }else if ($row['REQUEST_STATUS'] == 1) {
            echo "Approved";
        } else if ($row['REQUEST_STATUS'] == 2) {
            echo "Cancelled";
        } 
        echo"</td>
        <td>
            <b>By</b>: $row[USER_NAME] <br>
            <b>On</b>: $row[REQUEST_DATE_TIME]
        </td>
        <td>
            <a href='javascript:void(0);' onclick='updateRequest(this)' data-uuid='$row[REQUEST_UUID]' data-toggle='modal' data-target='#edit-request'>
                <i class='fas fa-edit'></i>
            </a>
            <a onClick='deleteRequest(this)' data-uuid='$row[REQUEST_UUID]' href='javascript:void(0);' style='color:red;'>
                <i class='fas fa-trash'></i>
            </a>
        </td>
        </tr>";
    }   
}
// Update Edit Request Query
if ($q == 'EDIT_REQUEST') {

    $title = mysqli_real_escape_string($db, $_POST['eTitle']);
    $comment = mysqli_real_escape_string($db, $_POST['eComment']);
    $by = mysqli_real_escape_string($db, $_POST['staffId']);

    if(mysqli_query($db, "UPDATE `me_request` SET `REQUEST_NAME`= '$title',`REQUEST_COMMENT`='$comment',`STAFF_ID`='$by' WHERE `REQUEST_UUID`= '$id'")) {
        echo 'Edit Request is updated successfully';
    }else {
        echo "Error: " . $sql . "" . mysqli_error($db);
    }
}
// View Update Request Query Response
if ($q == 'GET_REQUEST') {
    $request = "SELECT * FROM `me_request` WHERE `REQUEST_UUID` = '$id'";
    $result = mysqli_query($db, $request) or die (mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='modal-body'>
        <div class='form-group'>
            <label>Title</label>
            <select class='form-control select2bs4' name='eTitle' id='eTitle' style='width: 100%;'>";
            if ($row['REQUEST_NAME'] == "cancel") {
                echo "<option selected value='cancel'>Cancel Slip</option>
                <option value='update'>Update Slip</option>";
            }else if ($row['REQUEST_NAME'] == "update") {
                echo "<option value='cancel'>Cancel Slip</option>
                <option selected value='update'>Update Slip</option>";
            }
            echo "</select>
        </div>
        <div class='form-group'>
            <label>Comment</label>
            <textarea type='text' name='eComment' class='form-control' id='eComment' value='$row[REQUEST_COMMENT]' required>$row[REQUEST_COMMENT]</textarea>
        </div>
        <input type='text' name='staffId' id='staffId' value='$_SESSION[uuid]' hidden readonly>
        <input type='text' name='eId' id='eId' value='$id' hidden readonly>
        </div>
        <div class='modal-footer justify-content-between'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
        <button type='submit' name='submit' class='btn btn-primary'>Save</button>
        </div>";
    }   
}
// Request Record Delete Query
if($q == 'REMOVE_REQUEST') {
    $sql ="DELETE FROM `me_request` WHERE `REQUEST_UUID` = '$id'";
    $qsql=mysqli_query($db,$sql);
    if(mysqli_affected_rows($db) == 1)
    {  
        echo 'Form Has been submitted successfully';
    }else {
        echo "Error: " . $sql . "" . mysqli_error($db);
    }
}
?>