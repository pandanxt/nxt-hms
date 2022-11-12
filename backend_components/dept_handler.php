<?php
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";
    // Add Department Query
    if($q == 'ADD_DEPT') {
        $uid = mysqli_real_escape_string($db, $_POST['uuId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

        $sql = "SELECT * FROM `me_department` WHERE `DEPARTMENT_NAME` = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysqli_error($db);
            echo json_encode($result);
        }else{
            mysqli_stmt_bind_param($stmt,"s",$name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    $result = [];
                    $result['status'] = "error";
                    $result['message'] = "Name Already Taken!";
                    echo json_encode($result);
                }else{
                    $sql = "INSERT INTO `me_department`(`DEPARTMENT_UUID`,`DEPARTMENT_NAME`, `STAFF_ID`) VALUES (?,?,?)";
                    mysqli_stmt_execute($stmt);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        $result = [];
                        $result['status'] = "error";
                        $result['message'] = mysqli_error($db);
                        echo json_encode($result);
                    }else{
                        mysqli_stmt_bind_param($stmt,"sss",$uid,$name,$by);
                        mysqli_stmt_execute($stmt);
                        $result = [];
                        $result['status'] = "success";
                        $result['message'] = $name." Saved Successfully";
                        echo json_encode($result);
                    }			
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    } 
    // Department Status Update 
    if ($q == 'STATUS_DEPT') {
        if(mysqli_query($db, "UPDATE `me_department` SET `DEPARTMENT_STATUS`= '$val' WHERE `DEPARTMENT_UUID` = '$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Department Status Updated";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysqli_error($db);
            echo json_encode($result);
        }
    }
    // Update  Department Query
    if ($q == 'EDIT_DEPT') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuid']);
        $name = mysqli_real_escape_string($db, $_POST['deptName']);

        if(mysqli_query($db, "UPDATE `me_department` SET `DEPARTMENT_NAME`='$name' WHERE `DEPARTMENT_UUID` = '$uuid'"))
        {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Department Updated Successfully";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysqli_error($db);
            echo json_encode($result);
        }	
    }
    // Delete Department Query
    if($q == 'DELETE_DEPT') {
        if(mysqli_query($db, "DELETE FROM `me_department` WHERE `DEPARTMENT_UUID` ='$id'")) {
            $result = [];
            $result['status'] = "success";
            $result['message'] = "Department Deleted Successfully";
            echo json_encode($result);
        } else {
            $result = [];
            $result['status'] = "error";
            $result['message'] = mysqli_error($db);
            echo json_encode($result);
        }
    }
    // Get Room by Id
    if ($q == 'GET_DEPT_BY_ID') { 

        $user = "SELECT * FROM `me_department` WHERE `DEPARTMENT_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='row'>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                <div class='row'><label>Uuid:</label> &nbsp;<p> $row[DEPARTMENT_UUID]</p></div>
                <div class='row'><label>Date:</label>&nbsp;<p> $row[DEPARTMENT_DATE_TIME]</p></div>";
                if ($_SESSION['role'] == "admin") {  
                    echo "<div class='row'>
                    <label>Options: </label>
                    &nbsp;
                    <label class='switch' style='margin-top: 3px;'>";
                        if ($row['DEPARTMENT_STATUS'] == 0) {
                            echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['DEPARTMENT_UUID']."' value='".$row['DEPARTMENT_STATUS']."'>";                          
                        }elseif ($row['DEPARTMENT_STATUS'] == 1) {
                            echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['DEPARTMENT_UUID']."' value='".$row['DEPARTMENT_STATUS']."'>";
                        }
                    echo "<span class='slider round'></span>
                    </label>
                    &nbsp;
                    <a href='javascript:void(0);' onclick='editDept(this);' data-uuid='$row[DEPARTMENT_UUID]' data-toggle='modal' data-target='#edit-dept'>
                        <i class='fas fa-edit'></i>
                    </a>
                    &nbsp;
                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/room_handler.php?q=DELETE_DEPT&id=$row[DEPARTMENT_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                    </div>";
                }
                echo "</div>
                </div>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                    <div class='row'><label>Name:</label> &nbsp;<p> $row[DEPARTMENT_NAME]</p></div>
                    </div>
                </div>
            </div>";
            }
        }
    }
    // Edit Department by Id
    if ($q == 'EDIT_DEPT_BY_ID') { 
    
        $user = "SELECT * FROM `me_department` WHERE `DEPARTMENT_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='row'>
                    <div class='col-md-12'>
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control' name='deptName' id='deptName' placeholder='Enter Department Name ...' value='$row[DEPARTMENT_NAME]' required>
                    </div>
                    </div>
                </div>
                <input type='text' name='uuid' id='uuid' value='$row[DEPARTMENT_UUID]' hidden readonly>";
                }
            }
    }   
?>