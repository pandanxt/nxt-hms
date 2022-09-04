<?php 
    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";

    // Add Room Query
    if($q == 'ADD_ROOM') {
        $uid =  mysqli_real_escape_string($db, $_POST['uuId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $rate = mysqli_real_escape_string($db, $_POST['rate']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);

        $sql = "SELECT * FROM `me_room` WHERE `ROOM_NAME` = ?";
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
                        $sql = "INSERT INTO `me_room`(`ROOM_UUID`, `ROOM_NAME`, `ROOM_RATE`, `STAFF_ID`) VALUES (?,?,?,?)";
                        mysqli_stmt_execute($stmt);
                    
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo "Error: " . $sql . "" . mysqli_error($stmt);
                        }else{
                            mysqli_stmt_bind_param($stmt,"ssss",$uid,$name,$rate,$by);
                            mysqli_stmt_execute($stmt);
                            echo "New Room Saved Successfully";
                        }			
                    }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);

    }

    // Room Status Update
    if ($q == 'STATUS_ROOM') {
        if(mysqli_query($db, "UPDATE `me_room` SET `ROOM_STATUS`= '$val' WHERE `ROOM_UUID` = '$id'")) {
            echo 'Room Status Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Update Medeast User Query
    if ($q == 'EDIT_ROOM') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuid']);
        $name = mysqli_real_escape_string($db, $_POST['roomName']);
        $rate = mysqli_real_escape_string($db, $_POST['roomRate']);
        
        if(mysqli_query($db, "UPDATE `me_room` SET `ROOM_NAME`='$name',`ROOM_RATE`='$rate' WHERE `ROOM_UUID` = '$uuid'"))
        {
            echo 'Room Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }	
    }

    // Medeast Delete Query
    if($q == 'DELETE_ROOM') {
        if(mysqli_query($db, "DELETE FROM `me_room` WHERE `ROOM_UUID` ='$id'")) {
            // echo 'User Deleted Successfully';
            echo '<script>window.location = "../room.php?action=deleted";</script>';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Get Medeast Room by Id
    if ($q == 'GET-ROOM-BY-ID') { 

        $user = "SELECT * FROM `me_room` WHERE `ROOM_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='row'>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                <div class='row'><label>Uuid:</label> &nbsp;<p> $row[ROOM_UUID]</p></div>
                <div class='row'><label>Name:</label> &nbsp;<p> $row[ROOM_NAME]</p></div>";
                if ($_SESSION['role'] == "admin") {  
                    echo "<div class='row'>
                    <label>Options: </label>
                    &nbsp;
                    <label class='switch' style='margin-top: 3px;'>";
                        if ($row['ROOM_STATUS'] == 0) {
                            echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['ROOM_UUID']."' value='".$row['ROOM_STATUS']."'>";                          
                        }elseif ($row['ROOM_STATUS'] == 1) {
                            echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['ROOM_UUID']."' value='".$row['ROOM_STATUS']."'>";
                        }
                    echo "<span class='slider round'></span>
                    </label>
                    &nbsp;
                    <a href='javascript:void(0);' onclick='editRoom(this);' data-uuid='$row[ROOM_UUID]' data-toggle='modal' data-target='#edit-room'>
                        <i class='fas fa-edit'></i>
                    </a>
                    &nbsp;
                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/room_handler.php?q=DELETE_ROOM&id=$row[ROOM_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                    </div>";
                }
                echo "</div>
                </div>
                <div class='col-md-6'>
                <div class='col-md-12 clearfix'>
                    <div class='row'><label>Date:</label>&nbsp;<p> $row[ROOM_DATE_TIME]</p></div>
                    <div class='row'><label>Rate:</label> &nbsp;<p> $row[ROOM_RATE]</p></div>
                    </div>
                </div>
            </div>";
            }
        }
    }

    // Edit Medeast User by Id
    if ($q == 'EDIT-ROOM-BY-ID') { 
    
        $user = "SELECT * FROM `me_room` WHERE `ROOM_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='row'>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' class='form-control' name='roomName' id='roomName' placeholder='Enter Room Name ...' value='$row[ROOM_NAME]' required>
                    </div>
                    </div>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Rate</label>
                        <input type='number' class='form-control' name='roomRate' id='roomRate' value='$row[ROOM_RATE]' placeholder='Enter Room Rate ...' required>
                    </div>
                    </div>
                </div>
                <input type='text' name='uuid' id='uuid' value='$row[ROOM_UUID]' hidden readonly>";
                }
            }
    }    
?>