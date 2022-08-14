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
        $request = 'SELECT *, `ADMIN_USERNAME` FROM `edit_request` INNER JOIN `admin` WHERE `edit_request`.`REQUEST_BY` = `admin`.`ADMIN_ID`';
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
                <a href='javascript:void(0);' id='view-record' onclick='openRequestedRecord($rid)' data-type='$rname' data-toggle='modal' data-target='#view-record'>
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
            $request ="SELECT *,`ADMIN_USERNAME`,`DEPARTMENT_NAME` FROM `emergency_slip` INNER JOIN `admin` INNER JOIN `department` WHERE `emergency_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `emergency_slip`.`DEPT_ID` = `department`.`DEPARTMENT_ID` AND `emergency_slip`.`SLIP_ID` = $id";
            $result = mysqli_query($db, $request) or die (mysqli_error($db));
        }
        // $request ="SELECT *,`ADMIN_USERNAME`,`DEPARTMENT_NAME` FROM `outdoor_slip` INNER JOIN `admin` INNER JOIN `department` WHERE `outdoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `outdoor_slip`.`DEPT_ID` = `department`.`DEPARTMENT_ID` AND `outdoor_slip`.`SLIP_ID` = $id";
        // $result = mysqli_query($db, $request) or die (mysqli_error($db));
        while ($rs = mysqli_fetch_array($result)) {
            echo "<tr style='font-size: 12px;'>
            <td>$rs[SLIP_MR_ID]</td>
            <td>$rs[SLIP_NAME]</td>
            <td>$rs[SLIP_MOBILE]</td>
            <td>$rs[DEPARTMENT_NAME]</td>
            <td>$rs[DOCTOR_NAME] <button class='btn badge badge-info'>";
            if ($rs['D_TYPE'] == 1) echo "Visiting Doctor"; else echo "MedEast Doctor";
            echo "</button></td>
            <td>$rs[SLIP_FEE]</td>
            <td>
                <b>By</b>: $rs[ADMIN_USERNAME] <br>
                <b>On</b>: $rs[SLIP_DATE_TIME]
            </td> 
            <td style='display:flex;'>";
                if ($_SESSION['type'] == "admin") { 
                echo "<br>
                <a href='add_patient.php?id=$rs[SLIP_ID]'>
                  <i class='fas fa-edit'></i> Edit
                </a><br>
                <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?osrId=$rs[SLIP_ID]' style='color:red;'>
                  <i class='fas fa-trash'></i> Delete
                </a>";
                }
            echo "</td>
            </tr>";
        }   
    }
?>