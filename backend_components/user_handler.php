<?php

    // Start Session 
    session_start();
    // Query Params
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $val = (isset($_GET['val']) ? $_GET['val'] : '');
    // Connection File
    include "connection.php";

    // Add Medeast User Query
    if ($q == 'ADD_USER') {
        $uuid = mysqli_real_escape_string($db, $_POST['uuId']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $userId = mysqli_real_escape_string($db, $_POST['userId']);
        $password = mysqli_real_escape_string($db, password_hash($_POST['password'], PASSWORD_DEFAULT));
        $role = mysqli_real_escape_string($db, $_POST['role']);
        $by = mysqli_real_escape_string($db, $_POST['staffId']);
        
        $sql = "SELECT * FROM `me_user` WHERE `USER_ID` = ? OR `USER_EMAIL` = ?";
        $stmt = mysqli_stmt_init($db);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo "Error: " . $sql . "" . mysqli_error($stmt); 
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$userId,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                  
            if ($resultCheck > 0) {
                echo "User Id or email already taken!";
            }else{
                $sql = "INSERT INTO `me_user`(`USER_UUID`, `USER_NAME`, `USER_ROLE`, `USER_EMAIL`, `USER_ID`, `USER_PASSWORD`, `STAFF_ID`) VALUES (?,?,?,?,?,?,?)";
                mysqli_stmt_execute($stmt);
            
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "Error: " . $sql . "" . mysqli_error($stmt);
                }else{
                    mysqli_stmt_bind_param($stmt,"sssssss",$uuid,$name,$role,$email,$userId,$password,$by);
                    mysqli_stmt_execute($stmt);
                    echo "User has been created Successfully.";
                }			
            }
        }
      mysqli_stmt_close($stmt);
      mysqli_close($db);
    }
    
    // Update Medeast User Query
    if ($q == 'EDIT_USER') {
        $uuid = mysqli_real_escape_string($db, $_POST['useruuid']);
        $name = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['useremail']);
        $userId = mysqli_real_escape_string($db, $_POST['userid']);
        $role = mysqli_real_escape_string($db, $_POST['userrole']);
        
        if(mysqli_query($db, "UPDATE `me_user` SET `USER_NAME`='$name',`USER_ROLE`='$role', `USER_EMAIL`='$email', `USER_ID`='$userId' WHERE `USER_UUID` = '$uuid'"))
		{
			echo 'User Updated Successfully';
		} else {
			echo "Error: " . $sql . "" . mysqli_error($db);
		}	
    }

    // Update Medeast User Password Query
    if ($q == 'UPDATE_PASSWORD') {
        $password = mysqli_real_escape_string($db, password_hash($_POST['userpassword'], PASSWORD_DEFAULT));
        
        if(mysqli_query($db, "UPDATE `me_user` SET `USER_PASSWORD`='$password' WHERE `USER_UUID` = '$id'"))
		{
			echo 'Password Updated Successfully';
		} else {
			echo "Error: " . $sql . "" . mysqli_error($db);
		}	
    }

    // Medeast User Status Update 
    if ($q == 'STATUS_USER') {
        if(mysqli_query($db, "UPDATE `me_user` SET `USER_STATUS`= '$val' WHERE `USER_UUID` = '$id'")) {
            echo 'Status Updated Successfully';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Medeast Delete Query
    if($q == 'DELETE_USER')
    {
        if(mysqli_query($db, "DELETE FROM `me_user` WHERE `USER_UUID` ='$id'")) {
            // echo 'User Deleted Successfully';
            echo '<script>window.location = "../users.php?action=deleted";</script>';
        } else {
            echo "Error: " . $sql . "" . mysqli_error($db);
        }
    }

    // Get Medeast User by Id
    if ($q == 'GET-USER-BY-ID') { 
       
        $user = "SELECT * FROM `me_user` WHERE `USER_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='row'>
                    <div class='col-md-6'>
                      <div class='col-md-12 clearfix'>
                      <div class='row'><label>Uuid:</label> &nbsp;<p> $row[USER_UUID]</p></div>
                       <div class='row'><label>Name:</label> &nbsp;<p> $row[USER_NAME]</p></div>
                       <div class='row'><label>Email:</label> &nbsp;<p> $row[USER_EMAIL]</p></div>";

                       if ($_SESSION['role'] == "admin") {  
                        echo "<div class='row'>
                        <label>Options: </label>
                        &nbsp;
                        <label class='switch' style='margin-top: 3px;'>";
                            if ($row['USER_STATUS'] == 0) {
                                echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$row['USER_UUID']."' value='".$row['USER_STATUS']."'>";                          
                            }elseif ($row['USER_STATUS'] == 1) {
                                echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$row['USER_UUID']."' value='".$row['USER_STATUS']."'>";
                            }
                        echo "<span class='slider round'></span>
                        </label>
                        &nbsp;
                        <a href='javascript:void(0);' onclick='getUuid(this);' data-uuid='$row[USER_UUID]' data-toggle='modal' data-target='#pass-user'>
                            <i class='fas fa-key'></i>
                        </a>
                        &nbsp;
                        <a href='javascript:void(0);' onclick='editUser(this);' data-uuid='$row[USER_UUID]' data-toggle='modal' data-target='#edit-user'>
                            <i class='fas fa-edit'></i>
                        </a>
                        &nbsp;
                        <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/user_handler.php?q=DELETE_USER&id=$row[USER_UUID]' style='color:red;'><i class='fas fa-trash'></i></a>
                        </div>";
                    }

                    echo "</div>
                    </div>
                    <div class='col-md-6'>
                      <div class='col-md-12 clearfix'>
                        <div class='row'><label>User Id:</label>&nbsp;<p> $row[USER_ID]</p></div>
                        <div class='row'><label>Role:</label>&nbsp;<p> $row[USER_ROLE]</p></div>
                        <div class='row'><label>Date:</label>&nbsp;<p> $row[USER_DATE_TIME]</p></div>
                      </div>
                    </div>
                  </div>";
                }
            }
    }

    // Edit Medeast User by Id
    if ($q == 'EDIT-USER-BY-ID') { 
       
        $user = "SELECT * FROM `me_user` WHERE `USER_UUID` = '$id'";
        $result = mysqli_query($db, $user) or die (mysqli_error($db));
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='row'>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Full Name</label>
                        <input type='text' class='form-control' name='username' id='username' placeholder='Enter Full Name ...' value='$row[USER_NAME]' required>
                    </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label>Email</label>
                        <input type='email' class='form-control' name='useremail' id='useremail' value='$row[USER_EMAIL]' placeholder='Enter Valid Email ...' pattern='[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$' required>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label>User ID</label>
                        <input type='text' class='form-control' name='userid' id='userid' value='$row[USER_ID]' placeholder='Enter Unique Login ID ...' required>
                    </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label>Permission</label>
                        <select class='form-control select2bs4' name='userrole' id='userrole' style='width: 100%;'>
                          <option selected='selected' value='$row[USER_ROLE]'>$row[USER_ROLE]</option>
                          <option value='admin'>Admin</option>
                          <option value='user'>Staff</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <input type='text' name='useruuid' id='useruuid' value='$row[USER_UUID]' hidden readonly>";
                }
            }
    }
?>