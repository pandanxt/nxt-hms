<?php
    require 'connection.php';

    $name = $_POST['name'];
    $status =  $_POST['status'];
    $saveOn = date("Y-m-d H:i:s");

    if (isset($_POST['user-submit'])) {
        
        $loginId = $_POST['loginId'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $permission =  $_POST['permission'];

        echo '<script> console.log('.$name.' '.$permission.' '.$email.' '.$loginId.' '.$password.' '.$status.' '.$saveOn.');</script>';
    
        if (empty($email)||empty($loginId)) {
            header("Location: ../add_user.php?error=emptyfields&email=".$email."&loginId=".$loginId);
            exit();
        }else{
            $sql = "SELECT * FROM `admin` WHERE `ADMIN_USERNAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_user.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$loginId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_user.php?error=userNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `admin`(`ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `ADMIN_SAVE_TIME`) VALUES (?,?,?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_user.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"sssssss",$name,$permission,$email,$loginId,$password,$status,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Admin is Successfully Added");window.location = "../add_user.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['dept-submit'])) {
        
        $description =  $_POST['description'];
        // $saveBy = $_POST[''];
        echo '<script> console.log('.$name.' '.$description.' '.$status.' '.$saveOn.');</script>';
    
        if (empty($name)) {
            header("Location: ../add_dept.php?error=emptyfields&email=".$name);
            exit();
        }else{
            $sql = "SELECT * FROM `department` WHERE `DEPARTMENT_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_dept.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_dept.php?error=descriptionNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `department`(`DEPARTMENT_NAME`, `DEPARTMENT_DESC`, `DEPARTMENT_STATUS`, `DEPARTMENT_SAVE_TIME`) VALUES (?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_dept.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssss",$name,$description,$status,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Department is Successfully Added");window.location = "../add_dept.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['service-submit'])) {
        
        $amount =  $_POST['amount'];
        // $saveBy = $_POST[''];
        echo '<script> console.log('.$name.' '.$amount.' '.$status.' '.$saveOn.');</script>';
    
        if (empty($name)) {
            header("Location: ../add_service.php?error=emptyfields&service=".$name);
            exit();
        }else{
            $sql = "SELECT * FROM `bill_service` WHERE `BILL_SERVICE_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_service.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_service.php?error=serviceNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `bill_service` (`BILL_SERVICE_NAME`, `BILL_SERVICE_AMOUNT`, `SERVICE_STATUS`, `SERVICE_SAVE_TIME`) VALUES (?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_service.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssss",$name,$amount,$status,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Service is Successfully Added");window.location = "../add_service.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['doctor-submit'])) {
        
        $mobile =  $_POST['mobile'];
        $department =  $_POST['department'];
        $education = implode(', ', $_POST['education']);
        $experience =  $_POST['experience'];
        // $saveBy = $_POST[''];
        echo '<script> console.log('.$name.' '.$mobile.' '.$department.' '.$education.' '.$experience.' '.$status.' '.$saveOn.');</script>';
    
        if (empty($name)) {
            header("Location: ../add_doctor.php?error=emptyfields&service=".$name);
            exit();
        }else{
            $sql = "SELECT * FROM `doctor` WHERE `DOCTOR_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_doctor.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_doctor.php?error=doctorNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `doctor`(`DOCTOR_NAME`, `DOCTOR_MOBILE`, `DEPARTMENT_ID`, `DOCTOR EDUCATION`, `DOCTOR_EXPERIENCE`, `DOCTOR_STATUS`, `DOCTOR_SAVE_TIME`) VALUES (?,?,?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_doctor.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"sssssss",$name,$mobile,$department,$education,$experience,$status,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Doctor is Successfully Added");window.location = "../add_doctor.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
?>    