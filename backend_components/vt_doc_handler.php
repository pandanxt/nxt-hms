<?php
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";
  
// Add Visiting Doctor Query
if($q == 'ADD_DOCTOR') {
    $uuid = mysqli_real_escape_string($db, $_POST['uuId']);
    $name = mysqli_real_escape_string($db, $_POST['docName']);
    $by = mysqli_real_escape_string($db, $_POST['staffId']);

    $sql = "SELECT * FROM `vt_doctor` WHERE `VISITOR_NAME` = ?";
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
                    $sql = "INSERT INTO `vt_doctor`(`VISITOR_UUID`,`VISITOR_NAME`, `STAFF_ID`) VALUES (?,?,?)";
                    mysqli_stmt_execute($stmt);
                
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "Error: " . $sql . "" . mysqli_error($stmt);
                    }else{
                        mysqli_stmt_bind_param($stmt,"sss",$uuid,$name,$by);
                        mysqli_stmt_execute($stmt);
                        echo "New Visiting Doctor Added Successfully";
                    }			
                }
        }
    mysqli_stmt_close($stmt);
    mysqli_close($db);

}

// Visiting Doctor Status Update
if ($q == 'STATUS_DOCTOR') {
    if(mysqli_query($db, "UPDATE `vt_doctor` SET `VISITOR_STATUS`= '$val' WHERE `VISITOR_UUID` = '$id'")) {
        echo 'Status Updated Successfully';
    } else {
        echo "Error: " . $sql . "" . mysqli_error($db);
    }
}

// Update Medeast Dept Query
if ($q == 'EDIT_DOCTOR') {
    $uuid = mysqli_real_escape_string($db, $_POST['uuid']);
    $name = mysqli_real_escape_string($db, $_POST['vtName']);
    
    if(mysqli_query($db, "UPDATE `vt_doctor` SET `VISITOR_NAME`='$name' WHERE `VISITOR_UUID` = '$uuid'"))
    {
        echo 'Doctor Updated Successfully';
    } else {
        echo "Error: " . $sql . "" . mysqli_error($db);
    }	
}

// Medeast Delete Query
if($q == 'DELETE_DOCTOR') {
    if(mysqli_query($db, "DELETE FROM `vt_doctor` WHERE `VISITOR_UUID` ='$id'")) {
        // echo 'User Deleted Successfully';
        echo '<script>window.location = "../visiting-doctors.php?action=deleted";</script>';
    } else {
        echo "Error: " . $sql . "" . mysqli_error($db);
    }
}

// Get Medeast Room by Id
if ($q == 'GET-DOCTOR-BY-ID') { 

    $user = "SELECT * FROM `vt_doctor` WHERE  `VISITOR_UUID` = '$id'";
    $result = mysqli_query($db, $user) or die (mysqli_error($db));
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck != 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='row'>
            <div class='col-md-6'>
            <div class='col-md-12 clearfix'>
            <div class='row'><label>Uuid:</label> &nbsp;<p> $row[VISITOR_UUID]</p></div>
            <div class='row'><label>Date:</label> &nbsp;<p> $row[VISITOR_DATE_TIME]</p></div>
            </div>
            </div>
            <div class='col-md-6'>
            <div class='col-md-12 clearfix'>
                <div class='row'><label>Name:</label>&nbsp;<p> $row[VISITOR_NAME]</p></div>";
                if ($_SESSION['role'] == "admin") {  
                    echo "<div class='row'>
                    <label>Options: </label>
                    &nbsp;
                    <label class='switch' style='margin-top: 3px;'>";
                        if ($row['VISITOR_STATUS'] == 0) {
                            echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['VISITOR_UUID']."' value='".$row['VISITOR_STATUS']."'>";                          
                        }elseif ($row['VISITOR_STATUS'] == 1) {
                            echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['VISITOR_UUID']."' value='".$row['VISITOR_STATUS']."'>";
                        }
                    echo "<span class='slider round'></span>
                    </label>
                    &nbsp;
                    <a href='javascript:void(0);' onclick='editDoctor(this);' data-uuid='$row[VISITOR_UUID]' data-toggle='modal' data-target='#edit-doctor'>
                        <i class='fas fa-edit'></i>
                    </a>
                    &nbsp;
                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/vt_doc_handler.php?q=DELETE_DOCTOR&id=$row[VISITOR_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                    </div>";
                }
            echo "</div>
            </div>
        </div>";
        }
    }
}

// Edit Medeast User by Id
if ($q == 'EDIT-DOCTOR-BY-ID') { 

    $user = "SELECT * FROM `vt_doctor` WHERE `VISITOR_UUID` = '$id'";
    $result = mysqli_query($db, $user) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "
                <input type='text' name='uuid' id='uuid' value='$row[VISITOR_UUID]' hidden readonly>
                <div class='row'>
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control' name='vtName' id='vtName' placeholder='Enter Doctor Name ...' value='$row[VISITOR_NAME]' required>
                    </div>
                </div>
            </div>";
            }
        }
} 
?>