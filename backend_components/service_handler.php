<?php 
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";

    // Add Service Query
    if($q == 'ADD_SERVICE') {
        $uid =  mysqli_real_escape_string($db, $_POST['uuId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $rate = mysqli_real_escape_string($db, $_POST['rate']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

        $sql = "SELECT * FROM `me_general_service` WHERE `SERVICE_NAME` = ?";
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
                        $sql = "INSERT INTO `me_general_service`(`SERVICE_UUID`, `SERVICE_NAME`, `SERVICE_RATE`, `STAFF_ID`) VALUES (?,?,?,?)";
                        mysqli_stmt_execute($stmt);
                    
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo "Error: " . $sql . "" . mysqli_error($stmt);
                        }else{
                            mysqli_stmt_bind_param($stmt,"ssss",$uid,$name,$rate,$by);
                            mysqli_stmt_execute($stmt);
                            echo "New Service Saved Successfully";
                        }			
                    }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);

    }

    // Room Status Update
    if ($q == 'STATUS_SERVICE') {
        if(mysqli_query($db, "UPDATE `me_general_service` SET `SERVICE_STATUS`= '$val' WHERE `SERVICE_UUID` = '$id'")) {
            echo 'Service Status Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Update Medeast User Query
    if ($q == 'EDIT_SERVICE') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuid']);
        $name = mysqli_real_escape_string($db, $_POST['serName']);
        $rate = mysqli_real_escape_string($db, $_POST['serRate']);
        
        if(mysqli_query($db, "UPDATE `me_general_service` SET `SERVICE_NAME`='$name',`SERVICE_RATE`='$rate' WHERE `SERVICE_UUID` = '$uuid'"))
        {
            echo 'Service Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }	
    }

    // Medeast Delete Query
    if($q == 'DELETE_SERVICE') {
        if(mysqli_query($db, "DELETE FROM `me_general_service` WHERE `SERVICE_UUID` ='$id'")) {
            // echo 'User Deleted Successfully';
            echo '<script>window.location = "../services.php?action=deleted";</script>';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Get Medeast SERVICE by Id
    if ($q == 'GET-SERVICE-BY-ID') { 

        $user = "SELECT * FROM `me_general_service` WHERE `SERVICE_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='row'>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                <div class='row'><label>Uuid:</label> &nbsp;<p> $row[SERVICE_UUID]</p></div>
                <div class='row'><label>Name:</label> &nbsp;<p> $row[SERVICE_NAME]</p></div>";
                if ($_SESSION['role'] == "admin") {  
                    echo "<div class='row'>
                    <label>Options: </label>
                    &nbsp;
                    <label class='switch' style='margin-top: 3px;'>";
                        if ($row['SERVICE_STATUS'] == 0) {
                            echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['SERVICE_UUID']."' value='".$row['SERVICE_STATUS']."'>";                          
                        }elseif ($row['SERVICE_STATUS'] == 1) {
                            echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['SERVICE_UUID']."' value='".$row['SERVICE_STATUS']."'>";
                        }
                    echo "<span class='slider round'></span>
                    </label>
                    &nbsp;
                    <a href='javascript:void(0);' onclick='editService(this);' data-uuid='$row[SERVICE_UUID]' data-toggle='modal' data-target='#edit-service'>
                        <i class='fas fa-edit'></i>
                    </a>
                    &nbsp;
                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/service_handler.php?q=DELETE_SERVICE&id=$row[SERVICE_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                    </div>";
                }
                echo "</div>
                </div>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                    <div class='row'><label>Date:</label>&nbsp;<p> $row[SERVICE_DATE_TIME]</p></div>
                    <div class='row'><label>Rate:</label> &nbsp;<p> $row[SERVICE_RATE]</p></div>
                    </div>
                </div>
            </div>";
            }
        }
    }

    // Edit Medeast User by Id
    if ($q == 'EDIT-SERVICE-BY-ID') { 
    
        $user = "SELECT * FROM `me_general_service` WHERE `SERVICE_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='row'>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control' name='serName' id='serName' placeholder='Enter Service Name ...' value='$row[SERVICE_NAME]' required>
                    </div>
                    </div>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Rate</label>
                        <input type='number' class='form-control' name='serRate' id='serRate' value='$row[SERVICE_RATE]' placeholder='Enter Service Rate ...' required>
                    </div>
                    </div>
                </div>
                <input type='text' name='uuid' id='uuid' value='$row[SERVICE_UUID]' hidden readonly>";
                }
            }
    }    
?>