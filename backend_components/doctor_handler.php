<?php
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";
    // Add Doctor Query
    if($q == 'ADD_DOCTOR') {
        $uid = mysqli_real_escape_string($db, $_POST['uuId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
        $department = mysqli_real_escape_string($db, $_POST['department']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

        $sql = "SELECT * FROM `me_doctors` WHERE `DOCTOR_NAME` = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "Error: " . $sql . "" . mysqli_error($stmt);
        }else{
            mysqli_stmt_bind_param($stmt,"s",$name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    echo "name or mobile number already taken!";
                }else{
                    $sql = "INSERT INTO `me_doctors`(`DOCTOR_UUID`, `DOCTOR_NAME`, `DOCTOR_MOBILE`, `DOCTOR_DEPARTMENT`, `STAFF_ID`) VALUES (?,?,?,?,?)";
                    mysqli_stmt_execute($stmt);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "Error: " . $sql . "" . mysqli_error($stmt);
                    }else{
                        mysqli_stmt_bind_param($stmt,"sssss",$uid,$name,$mobile,$department,$by);
                        mysqli_stmt_execute($stmt);
                        echo "Form Has been submitted successfully";
                    }			
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    // Edit Doctor Query
    if ($q == 'EDIT_DOCTOR') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuid']);
        $name = mysqli_real_escape_string($db, $_POST['docName']);
        $mobile = mysqli_real_escape_string($db, $_POST['docMobile']);
        $department = mysqli_real_escape_string($db, $_POST['docDepartment']);
        
        if(mysqli_query($db, "UPDATE `me_doctors` SET `DOCTOR_NAME`='$name',`DOCTOR_MOBILE`='$mobile',`DOCTOR_DEPARTMENT`='$department' WHERE `DOCTOR_UUID` = '$uuid'"))
        {
            echo 'Doctor Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }	
    }
    // Get Doctor by Id
    if ($q == 'GET_DOCTOR_BY_ID') { 

        $user = "SELECT *,`DEPARTMENT_NAME` FROM `me_doctors` INNER JOIN `me_department` WHERE  `me_doctors`.`DOCTOR_DEPARTMENT` = `me_department`.`DEPARTMENT_UUID` AND `DOCTOR_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='row'>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                <div class='row'><label>Uuid:</label> &nbsp;<p> $row[DOCTOR_UUID]</p></div>
                <div class='row'><label>Mobile:</label>&nbsp;<p> $row[DOCTOR_MOBILE]</p></div>";
                if ($_SESSION['role'] == "admin") {  
                    echo "<div class='row'>
                    <label>Options: </label>
                    &nbsp;
                    <label class='switch' style='margin-top: 3px;'>";
                        if ($row['DOCTOR_STATUS'] == 0) {
                            echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['DOCTOR_UUID']."' value='".$row['DOCTOR_STATUS']."'>";                          
                        }elseif ($row['DOCTOR_STATUS'] == 1) {
                            echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['DOCTOR_UUID']."' value='".$row['DOCTOR_STATUS']."'>";
                        }
                    echo "<span class='slider round'></span>
                    </label>
                    &nbsp;
                    <a href='javascript:void(0);' onclick='editDoctor(this);' data-uuid='$row[DOCTOR_UUID]' data-toggle='modal' data-target='#edit-doctor'>
                        <i class='fas fa-edit'></i>
                    </a>
                    &nbsp;
                    <a  href='javascript:void(0);' onClick='deleteDoctor(this)' data-uuid='$row[DOCTOR_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                    </div>";
                }
                echo "</div>
                </div>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                    <div class='row'><label>Name:</label>&nbsp;<p> $row[DOCTOR_NAME]</p></div>
                    <div class='row'><label>Dept:</label> &nbsp;<p> $row[DEPARTMENT_NAME]</p></div>
                    <div class='row'><label>Date:</label> &nbsp;<p> $row[DOCTOR_DATE_TIME]</p></div>
                    </div>
                </div>
            </div>";
            }
        }
    }
    // Edit Doctor by Id
    if ($q == 'EDIT_DOCTOR_BY_ID') { 
    
        $user = "SELECT *, `DEPARTMENT_NAME` FROM `me_doctors` INNER JOIN `me_department` WHERE `me_doctors`.`DOCTOR_DEPARTMENT` = `me_department`.`DEPARTMENT_UUID` AND `DOCTOR_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "
                    <input type='text' name='uuid' id='uuid' value='$row[DOCTOR_UUID]' hidden readonly>
                    <div class='row'>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control' name='docName' id='docName' placeholder='Enter Doctor Name ...' value='$row[DOCTOR_NAME]' required>
                    </div>
                    <div class='form-group'>
                        <label>Mobile</label>
                        <input type='text' class='form-control' name='docMobile' id='docMobile' placeholder='Enter Doctor Mobile ...' value='$row[DOCTOR_MOBILE]' required>
                    </div>
                    </div>
                    <div class='col-md-6'>
                    <div class='form-group'>
                    <label>Department</label>
                    <select class='form-control select2bs4' name='docDepartment' id='docDepartment' style='width: 100%;'>
                    <option selected value='$row[DEPARTMENT_UUID]'>$row[DEPARTMENT_NAME]</option>";

                        $dept = 'SELECT `DEPARTMENT_UUID`,`DEPARTMENT_NAME` FROM `me_department` WHERE `DEPARTMENT_STATUS` = 1';
                        $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DEPARTMENT_UUID'];  
                            $name = $row['DEPARTMENT_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }

                    echo "</select>
                  </div>
                    </div>
                </div>";
                }
            }
    }  
    // VISITING DOCTOR HANDLER
    // Add Visiting Doctor Query
    if($q == 'ADD_VT_DOCTOR') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuId']);
        $name = mysqli_real_escape_string($db, $_POST['vtName']);
        $mobile = mysqli_real_escape_string($db, $_POST['vtMobile']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);
        $type = "visitor";
        $sql = "SELECT * FROM `me_doctors` WHERE `DOCTOR_NAME` = ?";
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
                    $sql = "INSERT INTO `me_doctors`(`DOCTOR_UUID`,`DOCTOR_NAME`,`DOCTOR_MOBILE`,`DOCTOR_TYPE`, `STAFF_ID`) VALUES (?,?,?,?,?)";
                    mysqli_stmt_execute($stmt);
                
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "Error: " . $sql . "" . mysqli_error($stmt);
                    }else{
                        mysqli_stmt_bind_param($stmt,"sssss",$uuid,$name,$mobile,$type,$by);
                        mysqli_stmt_execute($stmt);
                        echo "New Visiting Doctor Added Successfully";
                    }			
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);

    }
    // Edit Visiting Doctor Query
    if ($q == 'EDIT_VT_DOCTOR') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuid']);
        $name = mysqli_real_escape_string($db, $_POST['vtEtName']);
        $mobile = mysqli_real_escape_string($db, $_POST['vtEtMobile']);
        
        if(mysqli_query($db, "UPDATE `me_doctors` SET `DOCTOR_NAME`='$name', `DOCTOR_MOBILE`='$mobile' WHERE `DOCTOR_UUID` = '$uuid'"))
        {
            echo 'Doctor Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }	
    }
    // Get Visiting Doctor By Id
    if ($q == 'GET_VT_DOCTOR_BY_ID') { 

        $user = "SELECT * FROM `me_doctors` WHERE  `DOCTOR_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='row'>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                <div class='row'><label>Uuid:</label> &nbsp;<p> $row[DOCTOR_UUID]</p></div>
                <div class='row'><label>Mobile:</label> &nbsp;<p> $row[DOCTOR_MOBILE]</p></div>
                <div class='row'><label>Date:</label> &nbsp;<p> $row[DOCTOR_DATE_TIME]</p></div>
                </div>
                </div>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                    <div class='row'><label>Name:</label>&nbsp;<p> $row[DOCTOR_NAME]</p></div>";
                    if ($_SESSION['role'] == "admin") {  
                        echo "<div class='row'>
                        <label>Options: </label>
                        &nbsp;
                        <label class='switch' style='margin-top: 3px;'>";
                            if ($row['DOCTOR_STATUS'] == 0) {
                                echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['DOCTOR_UUID']."' value='".$row['DOCTOR_STATUS']."'>";                          
                            }elseif ($row['DOCTOR_STATUS'] == 1) {
                                echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['DOCTOR_UUID']."' value='".$row['DOCTOR_STATUS']."'>";
                            }
                        echo "<span class='slider round'></span>
                        </label>
                        &nbsp;
                        <a href='javascript:void(0);' onclick='editVisitor(this);' data-uuid='$row[DOCTOR_UUID]' data-toggle='modal' data-target='#edit-doctor'>
                            <i class='fas fa-edit'></i>
                        </a>
                        &nbsp;
                        <a href='javascript:void(0);' onClick='deleteDoctor(this)' data-uuid='$row[DOCTOR_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                        </div>";
                    }
                echo "</div>
                </div>
            </div>";
            }
        }
    }
    // Edit Visiting Doctor By Id
    if ($q == 'EDIT_VT_DOCTOR_BY_ID') { 

        $user = "SELECT * FROM `me_doctors` WHERE `DOCTOR_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "
                    <input type='text' name='uuid' id='uuid' value='$row[DOCTOR_UUID]' hidden readonly>
                    <div class='row'>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label>Name</label>
                            <input type='text' class='form-control' name='vtEtName' id='vtEtName' placeholder='Enter Doctor Name ...' value='$row[DOCTOR_NAME]' required>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label>Mobile</label>
                            <input type='text' class='form-control' name='vtEtMobile' id='vtEtMobile' placeholder='Enter Doctor Mobile ...' value='$row[DOCTOR_MOBILE]'>
                        </div>
                    </div>
                </div>";
                }
            }
    }
    // Update Doctor Status 
    if ($q == 'STATUS_DOCTOR') {
        if(mysqli_query($db, "UPDATE `me_doctors` SET `DOCTOR_STATUS`= '$val' WHERE `DOCTOR_UUID` = '$id'")) {
            echo 'Status Updated successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
    // Doctor Delete Query
    if($q == 'DELETE_DOCTOR') {
        if(mysqli_query($db, "DELETE FROM `me_doctors` WHERE `DOCTOR_UUID` ='$id'")) {
            echo '<script>window.location = "../doctors.php?action=deleted";</script>';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }
?>