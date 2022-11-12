<?php
    // Start Session 
    session_start();
    include('connection.php');
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Add Slip Query
    if ($q == 'ADD_SLIP') {
        // Post Generic Variables
        $type = mysqli_real_escape_string($db, $_POST['type']);
        $slipId = mysqli_real_escape_string($db, $_POST['slipId']);  
        $patId = mysqli_real_escape_string($db, $_POST['patId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $doctor = mysqli_real_escape_string($db, $_POST['doctor']);
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);
        // Post Type Indoor Variables   
        if ($type == 'INDOOR') {
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $fee = 0;
            $procedure = mysqli_real_escape_string($db, $_POST['procedure']);
            $subType = mysqli_real_escape_string($db, $_POST['subType']);
        // Post Type Outdoor Variables 
        }else if ($type == 'OUTDOOR') {
            $fee = mysqli_real_escape_string($db, $_POST['fee']);
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $procedure = NULL;
            $subType = NULL;
        // Post Type Emergency Variables 
        }else if ($type == 'EMERGENCY') {
            $dept = NULL;
            $fee = 0;
            $procedure = NULL;
            $subType = NULL;
        }  
        // Check if MR ID and Slip Id Exists
        if ($patId && $slipId) {
            // Patient Insert Query
            $patientQuery = "INSERT INTO `me_patient` 
            (`PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `STAFF_ID` ) 
            VALUES (?,?,?,?,?,?,?)";
            // Check DB and set in variable
            $stmt = mysqli_stmt_init($db);
            // Check if DB and Query is Correct
            if (!mysqli_stmt_prepare($stmt,$patientQuery)) {
                $result = [];
                $result['status'] = "error";
                $result['message'] = mysql_error();
                echo json_encode($result);
                exit();
            }else{
                // If SQL Query and DB is correct then bind parameters to the Query
                mysqli_stmt_bind_param($stmt,"sssssss", $patId,$name,$phone,$gender,$age,$address,$by);
                // If Patient Query is executed
                if (mysqli_stmt_execute($stmt)){
                    // Slip Insert Query
                    $slipQuery = "INSERT INTO `me_slip`(`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `SLIP_SUB_TYPE`, `STAFF_ID`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                    // Check if DB and Query is correct
                    if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                        $result = [];
                        $result['status'] = "error";
                        $result['message'] = mysql_error();
                        echo json_encode($result);
                        exit();
                    }else{
                        // If SQL Query and DB is correct then bind parameters to the Query
                        mysqli_stmt_bind_param($stmt,"sssssssssss", $slipId,$patId,$name,$phone,$dept,$doctor,$fee,$procedure,$type,$subType,$by);
                        // If Slip Query is executed
                        if (mysqli_stmt_execute($stmt)) {
                            // History Insert Query and Parameters
                            if ($type == 'EMERGENCY') {
                                $historyQuery = "INSERT INTO `me_slip_history`
                                (`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`) 
                                VALUES ('$slipId','$patId','$name','$phone',NULL,'$doctor',$fee,'$procedure','$type','$by')";
                            }else {
                                $historyQuery = "INSERT INTO `me_slip_history`
                                (`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`) 
                                VALUES ('$slipId','$patId','$name','$phone','$dept','$doctor',$fee,'$procedure','$type','$by')";
                            }
                            // Check If History Query is executed
                            if (mysqli_query($db, $historyQuery)){
                                $result = [];
                                $result['status'] = "success";
                                $result['message'] = "Patient Record Created Successfully!";
                                $result['data'] = [];
                                $result['data']['id'] = $slipId;
                                $result['data']['type'] = $type; 
                                echo json_encode($result);
                            }else {
                                $result = [];
                                $result['status'] = "error";
                                $result['message'] = mysql_error();
                                echo json_encode($result);
                                exit();
                            }
                        } 
                        exit();
                    }   
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    // Add Patient Slip
    if ($q == 'ADD_PATIENT_SLIP') {
        // Post Generic Variables
        $type = mysqli_real_escape_string($db, $_POST['type']);
        $slipId = mysqli_real_escape_string($db, $_POST['slipId']);  
        $patId = mysqli_real_escape_string($db, $_POST['patId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $doctor = mysqli_real_escape_string($db, $_POST['doctor']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);
        // Post Type Indoor Variables   
        if ($type == 'INDOOR') {
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $fee = 0;
            $procedure = mysqli_real_escape_string($db, $_POST['procedure']);
            $subType = mysqli_real_escape_string($db, $_POST['subType']);
        // Post Type Outdoor Variables 
        }else if ($type == 'OUTDOOR') {
            $fee = mysqli_real_escape_string($db, $_POST['fee']);
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $procedure = NULL;
            $subType = NULL;
        // Post Type Emergency Variables 
        }else if ($type == 'EMERGENCY') {
            $dept = NULL;
            $fee = 0;
            $procedure = NULL;
            $subType = NULL;
        }  
        // Check if MR ID and Slip Id Exists
        if ($patId && $slipId) {
            $stmt = mysqli_stmt_init($db);
            // Patient Update Query
            if(mysqli_query($db, "UPDATE `me_patient` SET `PATIENT_NAME`='$name',`PATIENT_MOBILE`='$phone',`STAFF_ID`='$by' WHERE `PATIENT_MR_ID` = '$patId'"))
            {
            // If Patient Query is executed
                // Slip Insert Query
                $slipQuery = "INSERT INTO `me_slip`(`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `SLIP_SUB_TYPE`, `STAFF_ID`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                // Check if DB and Query is correct
                if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                    $result = [];
                    $result['status'] = "error";
                    $result['message'] = mysql_error();
                    echo json_encode($result);
                    exit();
                }else{
                    // If SQL Query and DB is correct then bind parameters to the Query
                    mysqli_stmt_bind_param($stmt,"sssssssssss", $slipId,$patId,$name,$phone,$dept,$doctor,$fee,$procedure,$type,$subType,$by);
                    // If Slip Query is executed
                    if (mysqli_stmt_execute($stmt)) {
                        // History Insert Query and Parameters
                        if ($type == 'EMERGENCY') {
                            $historyQuery = "INSERT INTO `me_slip_history`
                            (`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`) 
                            VALUES ('$slipId','$patId','$name','$phone',NULL,'$doctor',$fee,'$procedure','$type','$by')";
                        }else {
                            $historyQuery = "INSERT INTO `me_slip_history`
                            (`SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`) 
                            VALUES ('$slipId','$patId','$name','$phone','$dept','$doctor',$fee,'$procedure','$type','$by')";
                        }
                        // Check If History Query is executed
                        if (mysqli_query($db, $historyQuery)){
                            $result = [];
                            $result['status'] = "success";
                            $result['message'] = "Slip Created Against $name";
                            $result['data'] = [];
                            $result['data']['id'] = $slipId;
                            $result['data']['type'] = $type; 
                            echo json_encode($result);
                        }else {
                            $result = [];
                            $result['status'] = "error";
                            $result['message'] = mysql_error();
                            echo json_encode($result);
                            exit();
                        }
                    } 
                    exit();
                }   
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    //Edit Slip By Id
    if ($q == 'EDIT_SLIP_BY_ID') {  
        if ($val == 'OUTDOOR' || $val == 'INDOOR') {
            $editQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE`, `e`.`DEPARTMENT_NAME` FROM `me_slip` AS `a` 
            INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
            INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`
            INNER JOIN `me_department` AS `e` ON `e`.`DEPARTMENT_UUID` = `a`.`SLIP_DEPARTMENT`
            WHERE `a`.`SLIP_UUID` = '$id'";
        }else {
            $editQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE` FROM `me_slip` AS `a` 
            INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
            INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`
            WHERE `a`.`SLIP_UUID` = '$id'";
        }
        $sql = mysqli_query($db,$editQuery) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($sql);
        if ($resultCheck != 0) {
            while($slip_data = mysqli_fetch_array($sql))
            {
                $mrid = $slip_data['SLIP_MRID'];
                $uuid = $slip_data['SLIP_UUID'];
                $name = $slip_data['SLIP_NAME'];
                $mobile = $slip_data['SLIP_MOBILE'];
                if ($val == 'OUTDOOR' || $val == 'INDOOR') {
                    $dept_id = $slip_data['SLIP_DEPARTMENT'];
                    $dept_name = $slip_data['DEPARTMENT_NAME'];
                }
                $doc_id = $slip_data['SLIP_DOCTOR'];
                $doc_name = $slip_data['DOCTOR_NAME'];
                $fee = $slip_data['SLIP_FEE'];
                if ($val == 'INDOOR') {
                    $procedure = $slip_data['SLIP_PROCEDURE'];
                }
            }  
            echo "<div class='row'>
                <div class='col-md-12' style='display:flex;'>
                <div class='form-group col-md-6'>
                    <label>Patient MR-ID #</label>
                    <input type='text' name='editMrid' id='editMrid' value='$mrid' class='form-control' readonly>
                </div>
                <div class='form-group col-md-6'>
                    <label>Patient Name</label>
                    <input type='text' name='editName' id='editName' value='$name' class='form-control' placeholder='Enter Patient Name Here ...'>
                </div>
                </div>";
                if ($val == 'OUTDOOR') {
                    echo "<div class='col-md-12 ml-2' style='display:flex;'>
                        <label for='switchList' class='mt-2'>Switch List: </label>&nbsp;
                        <select class='form-default' name='switchList' id='switchList' onchange='switchDocList(this.value);'>
                        <option value='me'>MedEast Doctors</option>
                        <option value='vt'>Visiting Doctors</option>
                        </select>
                        <div class='ml-2 mt-2'>
                            <span id='addDoc' style='display:none;'>
                                <a href='javascript:void(0);' data-toggle='modal' data-target='#visitor-doctor'><i class='fas fa-plus'></i> VISITOR DOCTOR</a>
                            </span>
                        </div>
                    </div>";
                }
                if ($val == 'OUTDOOR' || $val == 'INDOOR') {
                    echo "<div class='col-md-12' style='display:flex;'>
                    <div class='form-group col-md-6'>
                        <label>Department</label>
                        <select class='form-control select2' id='editDept' name='editDept' style='width: 100%;' onchange='showDoctor(this.value)'>
                        <option disabled selected value=''>---- Select Department ----</option>
                        <option selected value='$dept_id'><b>$dept_name</b></option>";
                        $dept = 'SELECT `DEPARTMENT_UUID`, `DEPARTMENT_NAME` FROM `me_department` WHERE `DEPARTMENT_STATUS` = "1"';
                        $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DEPARTMENT_UUID'];  
                            $name = $row['DEPARTMENT_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }
                    echo "</select>
                </div>
                <div class='form-group col-md-6' id='meDoc'>";
                }else{
                    echo "<div class='col-md-12' style='display:flex;'>
                    <div class='form-group col-md-12' id='meDoc'>";
                }
                    echo "<label>Consultant Name</label>
                    <select class='form-control select2' name='editDoctor' style='width: 100%;' id='doctor'>
                        <option disabled value=''>---- Select Consultant Name ----</option>
                        <option selected value='$doc_id'><b>$doc_name</b></option>";
                        $doctor = 'SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctors` WHERE `DOCTOR_TYPE` = "medeast" AND `DOCTOR_STATUS` = "1"';
                        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DOCTOR_UUID'];  
                            $name = $row['DOCTOR_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }
                    echo "</select>
                </div>
                </div>
                <div class='col-md-12' style='display:flex;'>
                <div class='form-group col-md-6'>
                    <label>Mobile No#</label>
                    <input type='tel' name='editPhone' id='editPhone' value='$mobile' class='form-control' placeholder='Enter Mobile No. without - '>
                </div>";
                if ($val == 'OUTDOOR') {
                echo "<div class='form-group col-md-6'>
                    <label>Consultant Fee</label>
                    <input type='number' name='editFee' id='editFee' value='$fee' class='form-control' placeholder='Enter Consultant Fee'>
                </div>";
                }
                echo "</div>";
                if ($val == 'INDOOR') {
                    echo "<div class='form-group col-md-12'>
                    <label>Procedure/Surgery Type</label>
                    <textarea style='height: 60px;' name='editProcedure' id='editProcedure' value='$procedure' placeholder='Enter Procedure/Surgery Details Here ...' type='text' class='form-control'>$procedure</textarea>
                    </div>";
                }
                echo "<input type='text' name='editStaff' id='editStaff' value='$_SESSION[uuid]' hidden readonly>
                <input type='text' name='slipId' id='slipId' value='$uuid' hidden readonly>
                <input type='text' name='slipType' id='slipType' value='$val' hidden readonly>
            </div>";
        }
    }
    // Edit Slip Query
    if ($q == 'EDIT_SLIP') {
        $uuid = mysqli_real_escape_string($db, $_POST['slipId']);
        $mrid = mysqli_real_escape_string($db, $_POST['editMrid']);
        $name = mysqli_real_escape_string($db, $_POST['editName']);
        $phone = mysqli_real_escape_string($db, $_POST['editPhone']);
        $type = mysqli_real_escape_string($db, $_POST['slipType']);
        $doc = mysqli_real_escape_string($db, $_POST['editDoctor']);
        $staffId = mysqli_real_escape_string($db, $_POST['editStaff']);
        if($type=='OUTDOOR'||$type=='INDOOR'){$dept=mysqli_real_escape_string($db,$_POST['editDept']);}else{$dept=NULL;}
        if($type=='OUTDOOR'){$fee=mysqli_real_escape_string($db,$_POST['editFee']);}else{$fee=0;}
        if($type=='INDOOR'){$procedure=mysqli_real_escape_string($db,$_POST['editProcedure']);}else{$procedure=NULL;}
        
        if ($type == 'INDOOR' || $type == 'OUTDOOR') {
            if(mysqli_query($db, "UPDATE `me_slip` SET `SLIP_NAME`='$name',`SLIP_MOBILE`='$phone',`SLIP_DEPARTMENT`='$dept',`SLIP_DOCTOR`='$doc',`SLIP_FEE`='$fee',`SLIP_PROCEDURE`='$procedure',`STAFF_ID` ='$staffId' WHERE `SLIP_UUID` = '$uuid'"))
            {
                $historyQuery = "INSERT INTO `me_slip_history`(
                `SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DEPARTMENT`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`) 
                VALUES ('$uuid','$mrid','$name','$phone','$dept','$doc','$fee','$procedure','$type','$staffId')";
                if (mysqli_query($db, $historyQuery)){
                    $result = [];
                    $result['status'] = "success";
                    $result['message'] = "Slip Record Updated Successfully.";
                    $result['data'] = [];
                    $result['data']['id'] = $uuid;
                    $result['data']['type'] = $type; 
                    echo json_encode($result);
                }else {
                    $result = [];
                    $result['status'] = "error";
                    $result['message'] = mysql_error();
                    echo json_encode($result);
                    exit();
                }
            }else{
                $result = [];
                $result['status'] = "error";
                $result['message'] = mysql_error();
                echo json_encode($result);
                exit();
            }	
        }else {
            if(mysqli_query($db, "UPDATE `me_slip` SET `SLIP_NAME`='$name',`SLIP_MOBILE`='$phone',`SLIP_DOCTOR`='$doc',`SLIP_FEE`='$fee',`SLIP_PROCEDURE`='$procedure',`STAFF_ID` ='$staffId' WHERE `SLIP_UUID` = '$uuid'"))
            {
                $historyQuery = "INSERT INTO `me_slip_history`(
                `SLIP_UUID`, `SLIP_MRID`, `SLIP_NAME`, `SLIP_MOBILE`, `SLIP_DOCTOR`, `SLIP_FEE`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`) 
                VALUES ('$uuid','$mrid','$name','$phone','$doc','$fee','$procedure','$type','$staffId')";
                if (mysqli_query($db, $historyQuery)){
                    $result = [];
                    $result['status'] = "success";
                    $result['message'] = "Patient slip record updated successfully.";
                    $result['data'] = [];
                    $result['data']['id'] = $uuid;
                    $result['data']['type'] = $type; 
                    echo json_encode($result);
                }else {
                    $result = [];
                    $result['status'] = "error";
                    $result['message'] = mysql_error();
                    echo json_encode($result);
                    exit();
                }
            }else{
                $result = [];
                $result['status'] = "error";
                $result['message'] = mysql_error();
                echo json_encode($result);
                exit();
            }	
        }
    }
    // Soft Delete Slip Query
    if($q == 'SOFT_DELETE_SLIP') {
        if(mysqli_query($db, "UPDATE `me_slip` SET `SLIP_DELETE` = '$val' WHERE `SLIP_UUID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Slip Deleted Successfully.";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
        }
    }
    // Delete Slip Query
    if($q == 'DELETE_SLIP') {
        if(mysqli_query($db, "DELETE FROM `me_slip` WHERE `SLIP_UUID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Slip Deleted Successfully.";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
        } 
    }
    //  Get Doctor List
    if ($q == 'GET_DOCTOR') {
        echo '<option disabled selected value="">---- Select Consultant Name ----</option>';
        if ($id == 'me') {
            $doctor = "SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctors` WHERE `DOCTOR_TYPE` = 'medeast' AND `DOCTOR_STATUS` = 1";
            $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['DOCTOR_UUID'];  
                $name = $row['DOCTOR_NAME'];
                echo '<option value="'.$id.'">'.$name.'</option>'; 
            }
        } else if ($id == 'vt') {
            $doctor = "SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctors` WHERE `DOCTOR_TYPE` = 'visitor' AND `DOCTOR_STATUS` = 1";
            $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['DOCTOR_UUID'];  
                $name = $row['DOCTOR_NAME'];
                echo '<option value="'.$id.'">'.$name.'</option>'; 
            }
        }  
    }
    // Get Doctor List by Department
    if ($q == 'GET_DOCTOR_BY_DEPT') {
        echo '<option disabled selected value="">---- Select Consultant Name ----</option>';
        if ($id == 'me') {
            $doctor = "SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctors` WHERE `DOCTOR_DEPARTMENT` = '$val' AND `DOCTOR_TYPE` = 'medeast' AND `DOCTOR_STATUS` = 1";
            $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['DOCTOR_UUID'];  
                $name = $row['DOCTOR_NAME'];
                echo '<option value="'.$id.'">'.$name.'</option>'; 
            }
        }  
    }
    // Add FOLLOWUP-SLIP Query
    if ($q == 'ADD_FOLLOW_UP_SLIP') {
        $followId = mysqli_real_escape_string($db, $_POST['followId']);
        $fee = mysqli_real_escape_string($db, $_POST['fee']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

        $sql = "INSERT INTO `me_followup_slip` (`SLIP_UUID`, `SLIP_REFERENCE_UUID`, `SLIP_FEE`, `STAFF_ID`) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            $result = [];
            $result['status'] = "error";
            $result['message'] = "SQL Database Error!";
            echo json_encode($result);
        }else{
            mysqli_stmt_bind_param($stmt,"ssss",$followId,$id,$fee,$by);
            if (mysqli_stmt_execute($stmt)) {
                $result = [];
                $result['status'] = "success";
                $result['message'] = "Follow Up Slip Created Successfully.";
                $result['data'] = [];
                $result['data']['id'] = $followId;
                $result['data']['type'] = "FOLLOWUP_SLIP";
                echo json_encode($result);
            }
        }			
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    // Add SERVICE-SLIP Query
    if ($q == 'ADD_SERVICE_SLIP') {
        $serviceId = mysqli_real_escape_string($db, $_POST['serviceId']);
        $service = mysqli_real_escape_string($db, $_POST['service']);
        $discount = mysqli_real_escape_string($db, $_POST['discount']);
        $finalBill = mysqli_real_escape_string($db, $_POST['finalBill']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

        $sql = "INSERT INTO `me_service_slip`(`SLIP_UUID`, `SLIP_REFERENCE_UUID`, `SLIP_SERVICE_NAME`, `SLIP_SERVICE_RATE`, `SLIP_SERVICE_DISCOUNT`, `SLIP_SERVICE_TOTAL`, `STAFF_ID`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            $result = [];
            $result['status'] = "error";
            $result['message'] = "SQL Database Error!";
            echo json_encode($result);
        }else{
            mysqli_stmt_bind_param($stmt,"sssssss",$serviceId,$id,$val,$service,$discount,$finalBill,$by);
            if (mysqli_stmt_execute($stmt)) {
                $result = [];
                $result['status'] = "success";
                $result['message'] = "Service Slip Created Successfully.";
                $result['data'] = [];
                $result['data']['id'] = $serviceId;
                $result['data']['type'] = "SERVICE_SLIP";
                echo json_encode($result);
            }
        }			
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    // Delete Follow Up Slip Query
    if($q == 'DELETE_FOLLOW_SLIP') {
        if(mysqli_query($db, "DELETE FROM `me_followup_slip` WHERE `SLIP_UUID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "FollowUp Slip Deleted Successfully.";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
        }
    }
    // Delete Service Slip Query
    if($q == 'DELETE_SERVICE_SLIP') {
        if(mysqli_query($db, "DELETE FROM `me_service_slip` WHERE `SLIP_UUID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Service Slip Deleted Successfully.";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
        }
    }
    // Get Slip History Query
    if ($q == 'GET_SLIP_HISTORY') {
        if ($val == 'OUTDOOR' || $val == 'INDOOR') {
            $history = "SELECT *, `USER_NAME`,`DOCTOR_NAME`,`DEPARTMENT_NAME` FROM `me_slip_history` 
            INNER JOIN `me_user` INNER JOIN `me_doctors` INNER JOIN `me_department` 
            WHERE `me_slip_history`.`STAFF_ID` = `me_user`.`USER_UUID`
            AND `me_slip_history`.`SLIP_DOCTOR` = `me_doctors`.`DOCTOR_UUID` 
            AND `me_slip_history`.`SLIP_DEPARTMENT` = `me_department`.`DEPARTMENT_UUID` 
            AND `SLIP_UUID` = '$id'";
        }else if ($val == 'EMERGENCY') {
            $history = "SELECT *, `USER_NAME`,`DOCTOR_NAME` FROM `me_slip_history` 
            INNER JOIN `me_user` INNER JOIN `me_doctors` WHERE `me_slip_history`.`STAFF_ID` = `me_user`.`USER_UUID`
            AND `me_slip_history`.`SLIP_DOCTOR` = `me_doctors`.`DOCTOR_UUID` AND `SLIP_UUID` = '$id'";
        }
        $result = mysqli_query($db, $history) or die (mysqli_error($db));
        echo "<thead>
        <tr style='font-size: 12px;'>
          <th>Name/Mobile</th>";
          if ($val != 'EMERGENCY') {echo "<th>Department/Doctor</th>";}else {echo "<th>Doctor</th>";}
          if ($val == 'OUTDOOR') {echo "<th>Fee</th>";}else if ($val == 'INDOOR') {echo "<th>Procedure</th>";}
          echo "<th>Updated</th>
        </tr>
        </thead>
        <tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr style='font-size: 12px;'>
            <td>$row[SLIP_NAME]</br>$row[SLIP_MOBILE]</td>";
            if($val != 'EMERGENCY'){echo"<td>$row[DEPARTMENT_NAME]</br>$row[DOCTOR_NAME]</td>";}else{echo"<td>$row[DOCTOR_NAME]</td>";}
            if($val == 'OUTDOOR'){echo "<td>$row[SLIP_FEE]</td>";}else if($val == 'INDOOR'){echo "<td>$row[SLIP_PROCEDURE]</td>";}
            echo "<td>$row[USER_NAME]</br>$row[SLIP_DATE_TIME]</td>
            </tr>";
        }
        echo "</tbody>";
    }
    //GET PATIENT BY ID Query
    if ($q == 'GET_PATIENT_BY_ID') {
        $patientSql="SELECT * FROM `me_patient` WHERE `me_patient`.`PATIENT_MR_ID` = '$id'";
        $querySql = mysqli_query($db,$patientSql) or die (mysqli_error($db));
        $response = mysqli_fetch_array($querySql);
        echo "<div class='row'>
            <div class='col-md-12' style='display:flex;'>
                <div class='form-group col-md-6'>
                    <label>Name</label>
                    <input type='text' name='name' class='form-control' id='name' value='$response[PATIENT_NAME]' required>
                </div>
                <div class='form-group col-md-6'>
                    <label>Mobile</label>
                    <input type='tel' name='phone' class='form-control' id='phone' value='$response[PATIENT_MOBILE]' required>
                </div>
            </div>
            <div class='col-md-12' style='display:flex;'>
                <div class='form-group col-md-6'>
                    <label>Gender</label>
                    <select class='form-control select2' name='gender' id='gender' style='width: 100%;'>
                        <option selected='selected' value='$response[PATIENT_GENDER]'>$response[PATIENT_GENDER]</option>
                        <option value='male'>Male</option>
                        <option value='female'>Female</option>
                        <option value='other'>Other</option>
                    </select>
                </div>
                <div class='form-group col-md-6'>
                    <label>Age</label>
                    <input type='number' name='age' class='form-control' id='age' value='$response[PATIENT_AGE]' required>
                </div>
            </div>   
            <div class='col-md-12'>
                <input type='text' name='mrid' id='mrid' class='form-control' value='$response[PATIENT_MR_ID]' hidden/>
                <input type='text' name='by' id='by' value='$_SESSION[uuid]' hidden readonly>
                <div class='form-group col-md-12'>
                    <label>Address</label>
                    <textarea style='height: 40px;' name='address' type='text' class='form-control' id='address' required>$response[PATIENT_ADDRESS]</textarea>
                </div>
            </div>
        </div>";
    }
    // Edit Patient Query
    if ($q == 'EDIT_PATIENT') {
        $mrid = mysqli_real_escape_string($db, $_POST['mrid']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $by = mysqli_real_escape_string($db, $_POST['by']);
        
        if(mysqli_query($db, "UPDATE `me_patient` 
            SET `PATIENT_NAME`='$name',`PATIENT_GENDER`='$gender',`PATIENT_AGE`='$age',`PATIENT_ADDRESS`='$address',`STAFF_ID`='$by' 
            WHERE `PATIENT_MR_ID` = '$mrid'")){
            $historyQuery = "INSERT INTO `me_patient_history`(`PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `STAFF_ID`)
            VALUES ('$mrid','$name','$phone','$gender','$age','$address','$by')";
            if (mysqli_query($db, $historyQuery)){
                $result = [];
                $result['status'] = "success";
                $result['message'] = $name." Record Updated Successfully!";
                echo json_encode($result);
            }else {
                $result = [];
                $result['status'] = "error";
                $result['message'] = mysql_error();
                echo json_encode($result);
                exit();
            }
        }else{
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
            exit();
        }	
    }
    // Soft Delete Patient Query
    if($q == 'SOFT_DELETE_PATIENT') {
        if(mysqli_query($db, "UPDATE `me_patient` SET `PATIENT_DELETE` = '$val' WHERE `PATIENT_MR_ID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Patient Record Deleted Successfully!";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
            exit();
        }
    }
    // Delete Patient Query
    if($q == 'DELETE_PATIENT') {
        if(mysqli_query($db, "DELETE FROM `me_patient` WHERE `PATIENT_MR_ID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Patient Record Deleted Successfully!";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
            exit();
        }
    }
    // Add Patient Query
    if ($q == 'ADD_PATIENT') {
        // Post Variables
        $name = mysqli_real_escape_string($db, $_POST['patientName']);
        $mrid = mysqli_real_escape_string($db, $_POST['patientMrId']);  
        $phone = mysqli_real_escape_string($db, $_POST['patientPhone']);
        $gender = mysqli_real_escape_string($db, $_POST['patientGender']);
        $age = mysqli_real_escape_string($db, $_POST['patientAge']);
        $address = mysqli_real_escape_string($db, $_POST['patientAddress']);
        $by = mysqli_real_escape_string($db, $_POST['patientBy']);
        // Check Data from DB
        $sql = "SELECT * FROM `me_patient` WHERE `PATIENT_MR_ID` = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysql_error();
            echo json_encode($result);
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$mrid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck == 0) {
              $patientQuery = "INSERT INTO `me_patient`
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
                if (!mysqli_stmt_prepare($stmt,$patientQuery)) {
                    $result = [];
                    $result['status'] = "error";
                    $result['message'] = mysql_error();
                    echo json_encode($result);
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt,"sssssss", $mrid,$name,$phone,$gender,$age,$address,$by);
                    if (mysqli_stmt_execute($stmt)) {
                        $historyQuery = "INSERT INTO `me_patient_history`(`PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `STAFF_ID`)
                        VALUES ('$mrid','$name','$phone','$gender','$age','$address','$by')";
                        if (mysqli_query($db, $historyQuery)){
                            $result = [];
                            $result['status'] = "success";
                            $result['message'] = $name." Record Saved Successfully!";
                            echo json_encode($result);
                        }else {
                            $result = [];
                            $result['status'] = "error";
                            $result['message'] = mysql_error();
                            echo json_encode($result);
                            exit();
                        }
                    }
                }   
              exit();
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
?>