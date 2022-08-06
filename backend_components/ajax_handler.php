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
?>