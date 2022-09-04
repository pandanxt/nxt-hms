<?php
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";
    
    // Visiting Doctor Status Update
    if ($q == 'stVtDoc') {
        if(mysqli_query($db, "UPDATE `visitor_doctor` SET `VISITOR_STATUS`= '$val' WHERE `VISITOR_ID` = ".$id)) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    
    }
    // Medeast Doctor Status Update 
    if ($q == 'stMeDoc') {
        if(mysqli_query($db, "UPDATE `doctor` SET `DOCTOR_STATUS`= '$val' WHERE `DOCTOR_ID` = ".$id)) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }


    // Add Visiting Doctor Query
    if($q == 'adVtDoc') {
        $name = mysqli_real_escape_string($db, $_POST['docName']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);

        $sql = "SELECT * FROM `visitor_doctor` WHERE `VISITOR_NAME` = ?";
        $stmt = mysqli_stmt_init($db);
          
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "Error: " . $sql . "" . mysqli_error($stmt);
        }else{
            mysqli_stmt_bind_param($stmt,"s",$name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                
                if ($resultCheck > 0) {
                    echo "name already taken!";
                }else{
                        $sql = "INSERT INTO `visitor_doctor`(`VISITOR_NAME`, `STAFF_ID`) VALUES (?,?)";
                        mysqli_stmt_execute($stmt);
                    
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo "Error: " . $sql . "" . mysqli_error($stmt);
                        }else{
                            mysqli_stmt_bind_param($stmt,"ss",$name,$by);
                            mysqli_stmt_execute($stmt);
                            echo "Form Has been submitted successfully";
                        }			
                    }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);

    }

    // Add Medeast Doctor Query
    if($q == 'adMeDoc') {
        $name = mysqli_real_escape_string($db, $_POST['docName']);
        $mobile = mysqli_real_escape_string($db, $_POST['docMobile']);
        $department = mysqli_real_escape_string($db, $_POST['docDepartment']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);

        $sql = "SELECT * FROM `doctor` WHERE `DOCTOR_NAME` = ? OR `DOCTOR_MOBILE` = ?";
        $stmt = mysqli_stmt_init($db);
          
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "Error: " . $sql . "" . mysqli_error($stmt);
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$name,$mobile);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                
                if ($resultCheck > 0) {
                    echo "name or mobile number already taken!";
                }else{
                        $sql = "INSERT INTO `doctor`(`DOCTOR_NAME`, `DOCTOR_MOBILE`, `DEPARTMENT_ID`, `STAFF_ID`) VALUES (?,?,?,?)";
                        mysqli_stmt_execute($stmt);
                    
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo "Error: " . $sql . "" . mysqli_error($stmt);
                        }else{
                            mysqli_stmt_bind_param($stmt,"ssss",$name,$mobile,$department,$by);
                            mysqli_stmt_execute($stmt);
                            echo "Form Has been submitted successfully";
                        }			
                    }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    
    // Get Add Requests Query
    if ($q == 'GET-ALL-REQUEST') { 
        echo "<span class='dropdown-item dropdown-header'>Request Notifications</span>
        <div class='dropdown-divider'></div>";
        if ($_SESSION['role'] == "admin") {
            $request = 'SELECT *, `ADMIN_USERNAME` FROM `edit_request` INNER JOIN `admin` WHERE `edit_request`.`REQUEST_BY` = `admin`.`ADMIN_ID` AND `edit_request`.`REQUEST_STATUS` = 0 ORDER BY `edit_request`.`REQUEST_ID` DESC';
        } else if($_SESSION['role'] == "user"){
            $request = 'SELECT *, `ADMIN_USERNAME` FROM `edit_request` INNER JOIN `admin` WHERE `edit_request`.`REQUEST_BY` = `admin`.`ADMIN_ID` AND `edit_request`.`REQUEST_STATUS` != 0 ORDER BY `edit_request`.`REQUEST_ID` DESC';
        }
        $result = mysqli_query($db, $request) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck == 0) {
                echo "<span class='dropdown-item text-center'>No Record Found</span>";
            }else {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<a href='javascript:void(0);' onClick='getRequest($row[REQUEST_ID]);'  data-toggle='modal' data-target='#view-request' class='dropdown-item'> 
                    <small><span class='float-left left badge badge-primary mr-4 mt-1'>SLIP</span></small>";  
                    if ($row['REQUEST_TABLE_NAME'] == 'OPD_SLIP_REQUEST') {
                        if ($row['REQUEST_NAME'] == 'cancel') {
                            echo "<span class='text-center'><b> Cancel Request</b></span>
                            <span class='float-right right badge badge-primary'>OPD</span>";
                        }else if ($row['REQUEST_NAME'] == 'update') {
                            echo "<span class='text-center'><b> Edit Request</b></span>
                            <span class='float-right right badge badge-primary'>OPD</span>";
                        }
                    }
                    if ($row['REQUEST_TABLE_NAME'] == 'INDOOR_SLIP_REQUEST') {
                        if ($row['REQUEST_NAME'] == 'cancel') {
                            echo "<span class='text-center'><b> Cancel Request</b></span>
                            <span class='float-right right badge badge-primary'>INDOOR</span>";
                        }else if ($row['REQUEST_NAME'] == 'update') {
                            echo "<span class='text-center'><b> Edit Request</b></span>
                            <span class='float-right right badge badge-primary'>INDOOR</span>";
                        }
                    }
                    if ($row['REQUEST_TABLE_NAME'] == 'EMERGENCY_SLIP_REQUEST') {
                        if ($row['REQUEST_NAME'] == 'cancel') {
                            echo "<span class='text-center'><b> Cancel Request</b></span>
                            <span class='float-right right badge badge-primary'>EMERGENCY</span>";
                        }else if ($row['REQUEST_NAME'] == 'update') {
                            echo "<span class='text-center'><b>Edit Request</b></span>
                            <span class='float-right right badge badge-primary'>EMERGENCY</span>";
                        }
                    }
                    echo "</a>
                    <div class='dropdown-divider'></div>";
                }
            }
    }
    // View Specific Request Query Response
    if ($q == 'VIEW-REQUEST-BY-ID') {
        $request = 'SELECT *, `ADMIN_USERNAME` FROM `edit_request` INNER JOIN `admin` WHERE `edit_request`.`REQUEST_BY` = `admin`.`ADMIN_ID` AND `REQUEST_ID` = "'.$id.'"';
        $result = mysqli_query($db, $request) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $rid = $row['REQUEST_TABLE_ID'];
            echo "<tr style='font-size: 12px;'>
            <td>";
            if ($row['REQUEST_NAME'] == 'cancel') {
                echo "Cancel Request";
            }else if ($row['REQUEST_NAME'] == 'update') {
                echo "Update Request";
            }
            echo"</td>
            <td>$row[REQUEST_COMMENT]</td>
            <td>";
            if ($row['REQUEST_TABLE_NAME'] == 'OPD_SLIP_REQUEST') {
                $rname = 'outdoor';
                echo "Requested on OPD Slip";
            }else if ($row['REQUEST_TABLE_NAME'] == 'INDOOR_SLIP_REQUEST') {
                $rname = 'indoor';
                echo "Requested on Indoor Slip";
            } else if ($row['REQUEST_TABLE_NAME'] == 'EMERGENCY_SLIP_REQUEST') {
                $rname = 'emergency';
                echo "Requested on Emergency Slip";
            } 
            echo"</td>
            <td>
                <b>By</b>: $row[ADMIN_USERNAME] <br>
                <b>On</b>: $row[REQUEST_ON]
            </td>";
            if ($_SESSION['role'] == "admin") {
                echo "<td>
                    <a href='javascript:void(0);' id='view-record' onclick='openRequestedRecord($rid)' data-status='$row[REQUEST_STATUS]' data-id='$id' data-type='$rname'>
                        <i class='fas fa-info-circle'></i> View
                    </a></br>
                    <a onClick='cancelRequest($row[REQUEST_ID])' href='javascript:void(0);' style='color:red;'>
                        <small><i class='fas fa-trash'></i> Request</small>
                    </a></br>
                    <a onClick='deleteRequestRecord($row[REQUEST_ID])' id='deleteRecord' data-id='$row[REQUEST_TABLE_ID]' data-name='$row[REQUEST_TABLE_NAME]' href='javascript:void(0);' style='color:red;'>
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
    // Update Request Status 
    if ($q == 'upRqStatus') {
        $val = ! $val; 
        if(mysqli_query($db, "UPDATE `edit_request` SET `REQUEST_STATUS` = '$val' WHERE `REQUEST_ID` =".$id)) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
    // Cancel Request Status 
    if ($q == 'cancelRqStatus') {
        $val = 2; 
        if(mysqli_query($db, "UPDATE `edit_request` SET `REQUEST_STATUS` = '$val' WHERE `REQUEST_ID` =".$id)) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
    if ($q == 'upRqRecord') {
        
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $doctor = mysqli_real_escape_string($db, $_POST['doctor']);
        $table = mysqli_real_escape_string($db, $_POST['table']);
        
        if ($table == 'emergency') {
            if(mysqli_query($db, "UPDATE `emergency_slip` SET `SLIP_NAME`='$name',`DOCTOR_NAME`='$doctor' WHERE `SLIP_ID` = ".$id)) {
                echo 'Form Has been submitted successfully';
            } else {
                echo "Error: " . $sql . "" . mysqli_error($db);
            }
        }else if ($table == 'outdoor') {
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $fee = mysqli_real_escape_string($db, $_POST['fee']);
            if(mysqli_query($db, "UPDATE `outdoor_slip` SET `SLIP_NAME`='$name',`DEPT_ID`='$dept',`DOCTOR_NAME`='$doctor',`SLIP_FEE`='$fee' WHERE `SLIP_ID` = ".$id)) {
                echo 'Form Has been submitted successfully';
            } else {
                echo "Error: " . $sql . "" . mysqli_error($db);
            }
        }else if ($table == 'indoor') {
            $dept = mysqli_real_escape_string($db, $_POST['dept']);
            $procedure = mysqli_real_escape_string($db, $_POST['procedure']);
            $type = mysqli_real_escape_string($db, $_POST['type']);
            $procedure = mysqli_real_escape_string($db, $_POST['procedure']);
            if(mysqli_query($db, "UPDATE `indoor_slip` SET `SLIP_NAME`='$name',`DEPT_ID`='$dept',`DOCTOR_NAME`='$doctor',`SLIP_PROCEDURE`='$procedure',`SLIP_TYPE`='$type' WHERE `SLIP_ID` = ".$id)) {
                echo 'Form Has been submitted successfully';
            } else {
                echo "Error: " . $sql . "" . mysqli_error($db);
            }
        }
        
    } 
    if ($q == 'REMOVE-REQUEST-RECORD') {
        $slipId = (isset($_GET['rid']) ? $_GET['rid'] : '');
        if ($val == 'OPD_SLIP_REQUEST') {
            $request ="DELETE FROM `outdoor_slip` WHERE `outdoor_slip`.`SLIP_ID` = $slipId";
            $result = mysqli_query($db, $request) or die (mysqli_error($db)); 
        }else if($val == 'INDOOR_SLIP_REQUEST') {
            $request ="DELETE FROM `indoor_slip` WHERE `indoor_slip`.`SLIP_ID` = $slipId";
            $result = mysqli_query($db, $request) or die (mysqli_error($db));
        }else if($val == 'EMERGENCY_SLIP_REQUEST') {
            $request ="DELETE FROM `emergency_slip` WHERE `emergency_slip`.`SLIP_ID` = $slipId";
            $result = mysqli_query($db, $request) or die (mysqli_error($db));
        }
            if(mysqli_affected_rows($db) == 1)
            {
                echo "Record Deleted Successfully";
                if(mysqli_query($db, "UPDATE `edit_request` SET `REQUEST_STATUS` = 1 WHERE `REQUEST_ID` =".$id)) {
                    echo 'Form Has been submitted successfully';
                } else {
                    echo "Error: " . $sql . "" . mysqli_error($db);
                }
            }
    }
?>