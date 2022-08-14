<?php
    require 'connection.php';

    if (isset($_POST['signin'])) {

        $uid = $_POST['username'];
        $pass = $_POST['password'];    
    
        if (empty($uid)||empty($pass)) {
            header("Location: ../login.php?error=emptyfields");
        exit();
        }else{
        $sql = "SELECT * FROM `admin` WHERE `ADMIN_EMAIL` = ? OR `ADMIN_USERNAME` = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../login.php?error=sqlerror");
        exit();
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$uid,$uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($pass,$row['ADMIN_PASSWORD']);
                        if ($pwdCheck == false) {
                            header("Location: ../login.php?error=wrongpwd");
                            exit();
                        }elseif ($pwdCheck == true) {
                            session_start();
                            $_SESSION['userid'] = $row['ADMIN_ID'];
                            $_SESSION['email'] = $row['ADMIN_EMAIL'];
                            $_SESSION['fullname'] = $row['ADMIN_NAME'];
                            $_SESSION['name'] = $row['ADMIN_USERNAME'];
                            $_SESSION['savetime'] = $row['ADMIN_SAVE_TIME'];
                            $_SESSION['type'] = $row['ADMIN_TYPE'];
                            header("Location: ../index.php?login=success");
                            exit();
                        }else{
                            header("Location: ../login.php?error=wrongpwd");
                            exit();
                        }
                }else{
                    header("Location: ../login.php?error=nouser");
                    exit();
                }
            }
        }
    }

    if (isset($_POST['user-submit'])) {
        $status =  $_POST['status'];
        $loginId = $_POST['loginId'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $permission =  $_POST['permission'];
        $by = $_POST['by'];


            $sql = "SELECT * FROM `admin` WHERE `ADMIN_USERNAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_user.php?action=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$loginId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_user.php?action=nameTaken");
                        exit();
                        }else{
                                $sql = "INSERT INTO `admin`(`ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `CREATED_BY`, `ADMIN_SAVE_TIME`) VALUES (?,?,?,?,?,?,?,?)";
                                mysqli_stmt_execute($stmt);
                            
                                if (!mysqli_stmt_prepare($stmt,$sql)) {
                                    header("Location: ../add_user.php?action=sqlerror");
                                    exit();
                                }else{
                                    mysqli_stmt_bind_param($stmt,"ssssssss",$name,$permission,$email,$loginId,$password,$status,$by,$saveOn);
                                    mysqli_stmt_execute($stmt);
                                
                                    echo '<script type="text/javascript">window.location = "../add_user.php?action=saved";</script>';								
                                    exit();
                                }			
                        }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['dept-submit'])) {
        $status =  $_POST['status'];
        $description =  $_POST['description'];
        $by = $_POST['by'];
            $sql = "SELECT * FROM `department` WHERE `DEPARTMENT_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_dept.php?action=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_dept.php?action=nameTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `department`(`DEPARTMENT_NAME`, `DEPARTMENT_DESC`, `DEPARTMENT_STATUS`,`CREATED_BY`, `DEPARTMENT_SAVE_TIME`) VALUES (?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_dept.php?action=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"sssss",$name,$description,$status,$by,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">window.location = "../add_dept.php?action=saved";</script>';								
                                exit();
                            }			
                        }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['doctor-submit'])) {
        $status =  $_POST['status'];
        $mobile =  $_POST['mobile'];
        $department =  $_POST['department'];
        $education = implode(', ', $_POST['education']);
        $experience =  $_POST['experience'];
        $by = $_POST['by'];

            $sql = "SELECT * FROM `doctor` WHERE `DOCTOR_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_doctor.php?action=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_doctor.php?action=nameTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `doctor`(`DOCTOR_NAME`, `DOCTOR_MOBILE`, `DEPARTMENT_ID`, `DOCTOR_EDUCATION`, `DOCTOR_EXPERIENCE`, `DOCTOR_STATUS`, `CREATED_BY`, `DOCTOR_SAVE_TIME`) VALUES (?,?,?,?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_doctor.php?action=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssssssss",$name,$mobile,$department,$education,$experience,$status,$by,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">window.location = "../add_doctor.php?action=saved";</script>';								
                                exit();
                            }			
                        }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['indoor-type-submit'])) {
        $status =  $_POST['status'];
        $alais = $_POST['alais'];
        $by = $_POST['by'];

            $sql = "SELECT * FROM `indoor_type` WHERE `TYPE_ALAIS` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_indoor_type.php?action=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_indoor_type.php?action=nameTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `indoor_type`(`TYPE_NAME`,`TYPE_ALAIS`, `TYPE_SAVE_TIME`, `TYPE_STATUS`, `STAFF_ID`) VALUES (?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_indoor_type.php?action=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"sssss",$name,$alais,$saveOn,$status,$by);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">window.location = "../add_indoor_type.php?action=saved";</script>';								
                                exit();
                            }			
                        }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    } 
?>    