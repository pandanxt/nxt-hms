<?php
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";
    // Room Status Update
    if ($q == 'stRoom') {
            if(mysqli_query($db, "UPDATE `room` SET `ROOM_STATUS`= '$val' WHERE `ROOM_ID` = ".$id)) {
                echo 'Form Has been submitted successfully';
            } else {
                echo "Error: " . $sql . "" . mysqli_error($db);
            }
    }
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
    // Medeast Doctor Status Update 
    if ($q == 'stDept') {
        if(mysqli_query($db, "UPDATE `department` SET `DEPARTMENT_STATUS`= '$val' WHERE `DEPARTMENT_ID` = ".$id)) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
    // Medeast User Status Update 
    if ($q == 'stUser') {
        if(mysqli_query($db, "UPDATE `admin` SET `ADMIN_STATUS`= '$val' WHERE `ADMIN_ID` = ".$id)) {
            echo 'Form Has been submitted successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Add Room Query
    if($q == 'adRoom') {
        $name = mysqli_real_escape_string($db, $_POST['roomName']);
        $rate = mysqli_real_escape_string($db, $_POST['roomRate']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);

        $sql = "SELECT * FROM `room` WHERE `ROOM_NAME` = ?";
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
                        $sql = "INSERT INTO `room`(`ROOM_NAME`, `ROOM_RATE`, `STAFF_ID`) VALUES (?,?,?)";
                        mysqli_stmt_execute($stmt);
                    
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo "Error: " . $sql . "" . mysqli_error($stmt);
                        }else{
                            mysqli_stmt_bind_param($stmt,"sss",$name,$rate,$by);
                            mysqli_stmt_execute($stmt);
                            echo "Form Has been submitted successfully";
                        }			
                    }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);

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
    // Add Medeast Department Query
    if($q == 'adDept') {
        $name = mysqli_real_escape_string($db, $_POST['deptName']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);

        $sql = "SELECT * FROM `department` WHERE `DEPARTMENT_NAME` = ?";
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
                        $sql = "INSERT INTO `department`(`DEPARTMENT_NAME`, `STAFF_ID`) VALUES (?,?)";
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
    // Add Medeast User Query
    if ($q == 'adUser') {
        
        $name = mysqli_real_escape_string($db, $_POST['userName']);
        $email = mysqli_real_escape_string($db, $_POST['userEmail']);
        $loginId = mysqli_real_escape_string($db, $_POST['loginId']);
        $password = mysqli_real_escape_string($db, password_hash($_POST['userPassword'], PASSWORD_DEFAULT));
        $permission = mysqli_real_escape_string($db, $_POST['userPermission']);
        $by = mysqli_real_escape_string($db, $_POST['userId']);
        
        $sql = "SELECT * FROM `admin` WHERE `ADMIN_USERNAME` = ? OR `ADMIN_EMAIL` = ?";
        $stmt = mysqli_stmt_init($db);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "Error: " . $sql . "" . mysqli_error($stmt); 
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$loginId,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                  
            if ($resultCheck > 0) {
                echo "login Id or email already taken!";
            }else{
                $sql = "INSERT INTO `admin`(`ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `CREATED_BY`) VALUES (?,?,?,?,?,?)";
                mysqli_stmt_execute($stmt);
            
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "Error: " . $sql . "" . mysqli_error($stmt);
                }else{
                    mysqli_stmt_bind_param($stmt,"ssssss",$name,$permission,$email,$loginId,$password,$by);
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
        $request = 'SELECT *, `ADMIN_USERNAME` FROM `edit_request` INNER JOIN `admin` WHERE `edit_request`.`REQUEST_BY` = `admin`.`ADMIN_ID` AND `edit_request`.`REQUEST_STATUS` = 0';
        $result = mysqli_query($db, $request) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
        
        echo "<a href='javascript:void(0);' onClick='getRequest($row[REQUEST_ID]);'  data-toggle='modal' data-target='#view-request' class='dropdown-item'>
              <i class='far fa-bell mr-2'></i>"; 
                if ($row['REQUEST_NAME'] == 'cancel') {
                    echo "Record Cancel Request";
                }else if ($row['REQUEST_NAME'] == 'update') {
                    echo "Record Update Request";
                }
              echo "<span class='float-right right badge badge-danger'>New</span>
            </a>
            <div class='dropdown-divider'></div>";
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
            </td>
            <td>
                <a href='javascript:void(0);' id='view-record' onclick='openRequestedRecord($rid)' data-status='$row[REQUEST_STATUS]' data-id='$id' data-type='$rname'>
                    <i class='fas fa-info-circle'></i>
                </a>
                <a onClick='cancelRequest($row[REQUEST_ID])' href='javascript:void(0);' style='color:red;'>
                    <i class='fas fa-trash'></i>
                </a>
            </td>
            </tr>";
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
?>