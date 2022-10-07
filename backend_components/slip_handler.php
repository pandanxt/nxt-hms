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

        if ($type == 'INDOOR') {
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $fee = NULL;
            $procedure = mysqli_real_escape_string($db, $_POST['procedure']);
            $subType = mysqli_real_escape_string($db, $_POST['subType']);
        }else if ($type == 'OUTDOOR') {
            $fee = mysqli_real_escape_string($db, $_POST['fee']);
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $procedure = NULL;
            $subType = NULL;
        }else if ($type == 'EMERGENCY') {
            $dept = NULL;
            $fee = NULL;
            $procedure = NULL;
            $subType = NULL;
        }
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
            mysqli_stmt_bind_param($stmt,"ss",$patId,$phone);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                
            if ($resultCheck > 0) {
            $slipQuery = "INSERT INTO `me_slip`(
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`, 
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            mysqli_stmt_execute($stmt);
                
                if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                    $result = [];
                    $result['status'] = "error";
                    $result['message'] = "SQL Database Error!";
                    echo json_encode($result);
                exit();
                }else{
                // Get Data of Patient from DB
                $patientQuery = "SELECT * FROM `me_patient` WHERE `PATIENT_MR_ID` = '$patId' OR `PATIENT_MOBILE` = '$phone'";
                $psql = mysqli_query($db,$patientQuery);
                while($prs = mysqli_fetch_array($psql))
                {
                    mysqli_stmt_bind_param($stmt,"sssssssssss", $slipId,$prs['PATIENT_MR_ID'],$name,$prs['PATIENT_MOBILE'],$dept,$doctor,$fee,$procedure,$type,$subType,$by);
                    if (mysqli_stmt_execute($stmt)) {
                        $printQuery = "SELECT `SLIP_UUID` FROM `me_slip` ORDER BY `SLIP_DATE_TIME` DESC LIMIT 1";
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
                    mysqli_stmt_bind_param($stmt,"sssssss", $patId,$name,$phone,$gender,$age,$address,$by);
                    if (mysqli_stmt_execute($stmt)){
                        $slipQuery = "INSERT INTO `me_slip`(
                            `SLIP_UUID`, 
                            `SLIP_MRID`, 
                            `SLIP_NAME`, 
                            `SLIP_MOBILE`, 
                            `SLIP_DEPARTMENT`, 
                            `SLIP_DOCTOR`, 
                            `SLIP_FEE`, 
                            `SLIP_PROCEDURE`, 
                            `SLIP_TYPE`, 
                            `SLIP_SUB_TYPE`, 
                            `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                            $result = [];
                            $result['status'] = "error";
                            $result['message'] = "SQL Database Error!";
                            echo json_encode($result);
                            exit();
                        }else{
                            mysqli_stmt_bind_param($stmt,"sssssssssss", $slipId,$patId,$name,$phone,$dept,$doctor,$fee,$procedure,$type,$subType,$by);
                                if (mysqli_stmt_execute($stmt)) {
                                    $printQuery = "SELECT `SLIP_UUID`,`SLIP_TYPE` FROM `me_slip` ORDER BY `SLIP_DATE_TIME` DESC LIMIT 1";
                                    $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                                    $pResult = mysqli_fetch_array($printsql);
                                    if ($pResult > 0) {
                                        $result = [];
                                        $result['status'] = "success";
                                        $result['message'] = "Patient slip and record is created successfully.";
                                        $result['data'] = [];
                                        $result['data']['id'] = $pResult['SLIP_UUID'];
                                        $result['data']['type'] = $pResult['SLIP_TYPE'];
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

    // Delete Patient Data Query
    if($q == 'DELETE_SLIP') {
        if(mysqli_query($db, "DELETE FROM `me_slip` WHERE `SLIP_UUID` ='$id'")) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
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

    // Add OPD-SLIP Request Query
    if ($q == 'ADD_REQUEST') {
        $reqId = mysqli_real_escape_string($db, $_POST['reqId']);
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $comment = mysqli_real_escape_string($db, $_POST['comment']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

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
        $request = "SELECT *, `USER_NAME` FROM `me_request` INNER JOIN `me_user` WHERE `me_request`.`STAFF_ID` = `me_user`.`USER_UUID` AND `REQUEST_REFERENCE_UUID` = '$id'";
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

    // Get Add Requests Query
    if ($q == 'GET_ALL_REQUEST_NOTIFICATION') { 
        echo "<span class='dropdown-item dropdown-header'>Request Notifications</span>
        <div class='dropdown-divider'></div>";
            $request = 'SELECT *, `USER_NAME`,`SLIP_TYPE`,`SLIP_SUB_TYPE` FROM `me_request` 
            INNER JOIN `me_user` INNER JOIN `me_slip` WHERE `me_request`.`STAFF_ID` = `me_user`.`USER_UUID` 
            AND `me_request`.`REQUEST_REFERENCE_UUID` = `me_slip`.`SLIP_UUID` AND `me_request`.`REQUEST_STATUS` = 0 ORDER BY `me_request`.`REQUEST_UUID` DESC';
        
            $result = mysqli_query($db, $request) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck == 0) {
                echo "<span class='dropdown-item text-center'>No Record Found</span>";
            }else {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<a href='javascript:void(0);' onClick='getRequestById(this);' data-uuid='$row[REQUEST_UUID]' data-toggle='modal' data-target='#view-request' class='dropdown-item'> 
                    <small><span class='float-left left badge badge-primary mr-4 mt-1'>SLIP</span></small>"; 
                    echo "<span class='text-center'><b>$row[REQUEST_NAME] request</b></span>
                    <span class='float-right right badge badge-primary'>$row[SLIP_TYPE]</span>
                    </a>
                    <div class='dropdown-divider'></div>";
                }
            }
    }

    // View Specific Request Query Response
    if ($q == 'VIEW_REQUEST_BY_ID') {
        $request = "SELECT *, `USER_NAME`,`SLIP_TYPE`,`SLIP_SUB_TYPE` FROM `me_request` 
        INNER JOIN `me_user` INNER JOIN `me_slip` WHERE `me_request`.`STAFF_ID` = `me_user`.`USER_UUID` 
        AND `me_request`.`REQUEST_REFERENCE_UUID` = `me_slip`.`SLIP_UUID` AND `REQUEST_UUID` = '$id'";
        $result = mysqli_query($db, $request) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $rid = $row['REQUEST_REFERENCE_UUID'];
            echo "<tr style='font-size: 12px;'>
            <td>
                <b>$row[REQUEST_NAME]&nbsp;request</b></br>
                <p>$row[REQUEST_COMMENT]</p>
            </td>
            <td>";
            if ($row['SLIP_TYPE'] != 'OUTDOOR' || $row['SLIP_TYPE'] != 'EMERGENCY') {
                echo $row['SLIP_TYPE'].'_'.$row['SLIP_SUB_TYPE'];
            }else {
                echo $row['SLIP_TYPE'].'_PATIENT';
            }
            echo "</td>
            <td>
                <b>By</b>: $row[USER_NAME] <br>
                <b>On</b>: $row[REQUEST_DATE_TIME]
            </td>";
            if ($_SESSION['role'] == "admin") {
                echo "<td>
                    <a href='javascript:void(0);' id='view-record' onclick='openRequestedRecord(this)' data_refId='$row[REQUEST_REFERENCE_UUID]' data-status='$row[REQUEST_STATUS]' data-id='$id' data-type=''>
                        <i class='fas fa-info-circle'></i> View
                    </a></br>
                    <a onClick='cancelRequest($row[REQUEST_UUID])' href='javascript:void(0);' style='color:red;'>
                        <small><i class='fas fa-trash'></i> Request</small>
                    </a></br>
                    <a onClick='deleteRequestRecord($row[REQUEST_UUID])' id='deleteRecord' data-id='$row[REQUEST_REFERENCE_UUID]' href='javascript:void(0);' style='color:red;'>
                    <small><i class='fas fa-trash'></i> Record</small>
                    </a></br>
                </td>";
            }
            echo "</tr>";
        }   
    }

    // View Specific Request Record Query Response
    if ($q == 'VIEW-REQUEST-RECORD') {
        if ($val == 'outdoor') {
            $request ="SELECT *,`ADMIN_USERNAME`,`DEPARTMENT_NAME` FROM `outdoor_slip` INNER JOIN `admin` INNER JOIN `department` WHERE `outdoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `outdoor_slip`.`DEPT_ID` = `department`.`DEPARTMENT_ID` AND `outdoor_slip`.`SLIP_ID` = $id";
            $result = mysqli_query($db, $request) or die (mysqli_error($db)); 
        }else if($val == 'indoor') {
            $request ="SELECT *,`ADMIN_USERNAME`,`DEPARTMENT_NAME` FROM `indoor_slip` INNER JOIN `admin` INNER JOIN `department` WHERE `indoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `indoor_slip`.`DEPT_ID` = `department`.`DEPARTMENT_ID` AND `indoor_slip`.`SLIP_ID` = $id";
            $result = mysqli_query($db, $request) or die (mysqli_error($db));
        }else if($val == 'emergency') {
            $request ="SELECT *,`ADMIN_USERNAME` FROM `emergency_slip` INNER JOIN `admin` WHERE `emergency_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `emergency_slip`.`SLIP_ID` = $id";
            $result = mysqli_query($db, $request) or die (mysqli_error($db));
        }
        while ($rs = mysqli_fetch_array($result)) {
            echo "<div class='row col-md-12'>
            <div class='col-md-6'>
            <p><small><b>MRID#</b> <span>$rs[SLIP_MR_ID]</span></small></p>
            </div>
            <div class='col-md-6'>
            <p><small><b>Mobile:</b> <span>$rs[SLIP_MOBILE]</span></small></p>
            </div>
            </div>
            <input type='number' name='slipId' id='slipId' value='$id' disabled hidden>
            <input type='text' name='slipType' id='slipType' value='$val' disabled hidden>
            <div class='row col-md-12'>
            <div class='form-group col-md-6 text-field'>
                <input type='text' name='name' class='input form-control' id='name' value='$rs[SLIP_NAME]' required>
                <label class='label'>Patient Name</label>
            </div>";
            if ($val == 'emergency') {
                echo "<div class='form-group col-md-6'>
                <select class='form-control select2bs4' name='doctor' style='width: 100%;' id='doctor'>
                <option selected='selected' disabled='disabled' value='$rs[DOCTOR_NAME]'>$rs[DOCTOR_NAME]</option>";
                    $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "1" AND `DEPARTMENT_ID` = 21';
                    $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['DOCTOR_ID'];  
                        $name = $row['DOCTOR_NAME'];
                        echo '<option value="'.$name.'">'.$name.'</option>'; 
                    }
                echo "</select>
                </div>";
            }
            if ($val == 'indoor') {
                $newType;
                if ($rs['SLIP_TYPE'] == 'gynae') {
                    $newType = 'Gynae Patient';
                }else if ($rs['SLIP_TYPE'] == 'gensurgery') {
                    $newType = 'General Surgery';
                }else if ($rs['SLIP_TYPE'] == 'genillness') {
                    $newType = 'General Illness';
                }else if ($rs['SLIP_TYPE'] == 'eye') {
                    $newType = 'Eye Patient';
                }
                echo "
                <div class='form-group col-md-6'>
                    <select class='form-control select2bs4' name='indoorType' id='indoorType' style='width: 100%;'>
                    <option selected='selected' disabled='disabled' value='$rs[SLIP_TYPE]'>$newType</option>";
                        $indoorType = 'SELECT `TYPE_ALAIS`, `TYPE_NAME` FROM `indoor_type` WHERE `TYPE_STATUS` = "1"';
                        $result = mysqli_query($db, $indoorType) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['TYPE_ALAIS'];  
                            $name = $row['TYPE_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }
                    echo "</select>
                </div>
            </div>
            <div class='row col-md-12'>
                <div class='form-group col-md-6'>
                <select class='form-control select2bs4' id='dept' name='dept' style='width: 100%;' onchange='showDoctor(this.value)'>
                <option selected='selected' disabled='disabled' value='$rs[DEPT_ID]'>$rs[DEPARTMENT_NAME]</option>";
                    $dept = 'SELECT `DEPARTMENT_ID`, `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_STATUS` = "1"';
                    $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['DEPARTMENT_ID'];  
                        $name = $row['DEPARTMENT_NAME'];
                        echo '<option value="'.$id.'">'.$name.'</option>'; 
                    }
                echo "</select>
                </div>
                <div class='form-group col-md-6'>
                    <select class='form-control select2bs4' name='doctor' style='width: 100%;' id='doctor'>
                    <option selected='selected' disabled='disabled' value='$rs[DOCTOR_NAME]'>$rs[DOCTOR_NAME]</option>";
                        $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "1"';
                        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DOCTOR_ID'];  
                            $name = $row['DOCTOR_NAME'];
                            echo '<option value="'.$name.'">'.$name.'</option>'; 
                        }
                    echo "</select>
                </div>
            </div>
            <div class='row'>
                <div class='form-group col-md-12'>
                    <textarea style='height: 80px;width:93%; margin-left:2%;' name='procedure' id='procedure' placeholder='Enter Procedure/Surgery Details Here ...' value='$rs[SLIP_PROCEDURE]' type='text' class='form-control' required>$rs[SLIP_PROCEDURE]</textarea>
                </div>
            </div>";
            }
            if ($val == 'outdoor') {
            echo "<div class='form-group col-md-6 text-field'>
                <input type='number' name='fee' class='input form-control' id='fee' value='$rs[SLIP_FEE]' required>
                <label class='label'>Consultant Fee</label>
            </div>";
            }
            echo "</div>";
            if ($val == 'outdoor') {
            echo "<input type='number' name='docType' id='docType' value='$rs[D_TYPE]' disabled hidden>";
            if ($rs['D_TYPE'] == 0){
            echo "<div class='col-md-12' id='meDoc' style='display:flex;margin:0;padding:0;'>
                <div class='form-group col-md-6'>
                <select class='form-control select2bs4' id='meDept' name='meDept' style='width: 100%;' onchange='showDoctor(this.value)'>
                <option selected='selected' disabled='disabled' value='$rs[DEPT_ID]'>$rs[DEPARTMENT_NAME]</option>";
                    $dept = 'SELECT `DEPARTMENT_ID`, `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_STATUS` = "1"';
                    $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['DEPARTMENT_ID'];  
                        $name = $row['DEPARTMENT_NAME'];
                        echo '<option value="'.$id.'">'.$name.'</option>'; 
                    }
                echo "</select>
                </div>
                <div class='form-group col-md-6'>
                    <select class='form-control select2bs4' id='meDoctor' name='meDoctor' style='width: 100%;'>
                    <option selected='selected' disabled='disabled' value='$rs[DOCTOR_NAME]'>$rs[DOCTOR_NAME]</option>";
                        $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "1"';
                        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DOCTOR_ID'];  
                            $name = $row['DOCTOR_NAME'];
                            echo '<option value="'.$name.'">'.$name.'</option>'; 
                        }
                    echo "</select>
                </div>
            </div>
            
                </div>";
            }
            if ($rs['D_TYPE'] == 1){
            echo "<div class='col-md-12' id='vtDoc' style='margin:0;padding:0;display:flex;'>
                <div class='form-group col-md-6'>
                <select class='form-control select2bs4' id='vtDept' name='vtDept' style='width: 100%;'>
                <option selected='selected' disabled='disabled' value='$rs[DEPT_ID]'>$rs[DEPARTMENT_NAME]</option>";
                    $dept = 'SELECT `DEPARTMENT_ID`, `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_STATUS` = "1"';
                    $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['DEPARTMENT_ID'];  
                        $name = $row['DEPARTMENT_NAME'];
                        echo '<option value="'.$id.'">'.$name.'</option>'; 
                    }
                echo "</select>
                </div>
                <div class='form-group col-md-6'>
                    <select class='form-control select2bs4' id='vtDoctor' name='vtDoctor' style='width: 100%;'>
                    <option selected='selected' disabled='disabled' value='$rs[DOCTOR_NAME]'>$rs[DOCTOR_NAME]</option>";
                        $doctor = 'SELECT `VISITOR_ID`, `VISITOR_NAME` FROM `visitor_doctor` WHERE `VISITOR_STATUS` = "1"';
                        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['VISITOR_ID'];  
                            $name = $row['VISITOR_NAME'];
                            echo '<option value="'.$name.'">'.$name.'</option>'; 
                        }
                    echo "</select>
                    <span id='addDoc'>
                        <a href='javascript:void(0);' onclick='showFields();'><i class='fas fa-plus'></i> VISITOR DOCTOR</a>
                    </span>
                    <div id='showVisitField' style='display:none;'>
                        <form action='javascript:void(0)' method='post'>
                        <input type='text' name='userId' id='userId' value='$_SESSION[userid]' hidden readonly>
                        <div class='input-group mt-2'>
                            <input type='text' class='form-control' placeholder='Doctor Name' aria-label='Doctor Name' aria-describedby='basic-addon2' name='docName' id='docName' required>
                            <div class='input-group-append'>
                                <button class='btn btn-outline-primary' id='visitorDoctor' onclick='saveVtDoctor();' type='submit'>Save</button>
                            </div>
                        </div>
                        </form>    
                    </div>
                </div>
            </div>";
            }
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
            // echo "Error: " . $sql . "" . mysqli_error($stmt);
            $result = [];
            $result['status'] = "error";
            $result['message'] = "SQL Database Error!";
            echo json_encode($result);
        }else{
            mysqli_stmt_bind_param($stmt,"ssss",$followId,$id,$fee,$by);
            if (mysqli_stmt_execute($stmt)) {
                $printQuery = "SELECT `SLIP_UUID` FROM `me_followup_slip` ORDER BY `SLIP_DATE_TIME` DESC LIMIT 1";
                $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                $pResult = mysqli_fetch_array($printsql);

                if ($pResult > 0) {
                    $result = [];
                    $result['status'] = "success";
                    $result['message'] = "Follow Up Slip Created Successfully.";
                    $result['data'] = [];
                    $result['data']['id'] = $pResult['SLIP_UUID'];
                    $result['data']['type'] = "FOLLOWUP_SLIP";
                    echo json_encode($result);
                }
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
            // echo "Error: " . $sql . "" . mysqli_error($stmt);
            $result = [];
            $result['status'] = "error";
            $result['message'] = "SQL Database Error!";
            echo json_encode($result);
        }else{
            mysqli_stmt_bind_param($stmt,"sssssss",$serviceId,$id,$val,$service,$discount,$finalBill,$by);
            if (mysqli_stmt_execute($stmt)) {
                $printQuery = "SELECT `SLIP_UUID` FROM `me_service_slip` ORDER BY `SLIP_DATE_TIME` DESC LIMIT 1";
                $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                $pResult = mysqli_fetch_array($printsql);

                if ($pResult > 0) {
                    $result = [];
                    $result['status'] = "success";
                    $result['message'] = "Service Slip Created Successfully.";
                    $result['data'] = [];
                    $result['data']['id'] = $pResult['SLIP_UUID'];
                    $result['data']['type'] = "SERVICE_SLIP";
                    echo json_encode($result);
                }
            }
        }			

        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

    // Delete Follow Up Slip Query
    if($q == 'DELETE_FOLLOW_SLIP') {
        if(mysqli_query($db, "DELETE FROM `me_followup_slip` WHERE `SLIP_UUID` ='$id'")) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
    
    // Delete Service Slip Query
    if($q == 'DELETE_SERVICE_SLIP') {
        if(mysqli_query($db, "DELETE FROM `me_service_slip` WHERE `SLIP_UUID` ='$id'")) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
?>