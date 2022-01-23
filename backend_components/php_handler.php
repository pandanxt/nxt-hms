<?php
    require 'connection.php';

    $name = $_POST['name'];
    $saveOn = date("Y-m-d H:i:s");

    if (isset($_POST['user-submit'])) {
        $status =  $_POST['status'];
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
        $status =  $_POST['status'];
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
        $status =  $_POST['status'];
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
        $status =  $_POST['status'];
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
                            $sql = "INSERT INTO `doctor`(`DOCTOR_NAME`, `DOCTOR_MOBILE`, `DEPARTMENT_ID`, `DOCTOR_EDUCATION`, `DOCTOR_EXPERIENCE`, `DOCTOR_STATUS`, `DOCTOR_SAVE_TIME`) VALUES (?,?,?,?,?,?,?)";
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
    if (isset($_POST['patient-type-submit'])) {
        $status =  $_POST['status'];
        $alais = $_POST['type-alais'];
      // $saveBy = $_POST[''];
        echo '<script> console.log('.$name.' '.$alais.' '.$saveOn.' '.$status.');</script>';
    
        if (empty($name)) {
            header("Location: ../add_patient_type.php?error=emptyfields&typeName=".$name);
            exit();
        }else{
            $sql = "SELECT * FROM `patient_type` WHERE `PATIENT_TYPE_ALAIS` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_patient_type.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_patient_type.php?error=patientTypeNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `patient_type`(`PATIENT_TYPE_NAME`,`PATIENT_TYPE_ALAIS`, `TYPE_SAVE_TIME`, `PATIENT_TYPE_STATUS`) VALUES (?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_patient_type.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssss",$name,$alais,$saveOn,$status);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Patient Type is Successfully Added");window.location = "../add_patient_type.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['patient-submit'])) {
        
        $mrid = $_POST['mrid'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $doctor = $_POST['doctor'];
        $type = $_POST['type'];
        $cnic = $_POST['cnic'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        
      // $saveBy = $_POST[''];
        echo '<script> alert('.$name.' '.$mrid.' '.$saveOn.' '.$phone.' '.$gender.' '.$doctor.' '.$type.' '.$cnic.' '.$age.' '.$address.');</script>';
    
        if (empty($name)) {
            header("Location: ../add_patient.php?error=emptyfields&patientMrId=".$mrid);
            exit();
        }else{
            $sql = "SELECT * FROM `patient` WHERE `PATIENT_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_patient.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_patient.php?error=patientNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `patient`
                            (`PATIENT_MR_ID`,
                              `PATIENT_NAME`,
                               `PATIENT_TYPE`,
                                `PATIENT_MOBILE`,
                                 `PATIENT_CNIC`,
                                  `PATIENT_GENDER`,
                                   `PATIENT_AGE`,
                                    `PATIENT_ADDRESS`,
                                     `DOCTOR_ID`,
                                       `ADMISSION_DATE_TIME`,
                                        `DISCHARGE_DATE_TIME`
                                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_patient.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"sssssssssss", $mrid,$name,$type,$phone,$cnic,$gender,$age,$address,$doctor,$saveOn,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Patient Record is Successfully Added");window.location = "../add_patient.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['education-submit'])) {
        
        $alais = $_POST['alais'];
        $status = $_POST['status'];
        
      // $saveBy = $_POST[''];
        echo '<script> alert('.$name.' '.$alais.' '.$saveOn.' '.$status.');</script>';
    
        if (empty($name)) {
            header("Location: ../add_education.php?error=emptyfields&patientMrId=".$alais);
            exit();
        }else{
            $sql = "SELECT * FROM `education` WHERE `EDUCATION_ALAIS` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_education.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$alais);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        header("Location: ../add_education.php?error=educationNameAlreadyTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `education`(
                                `EDUCATION_NAME`,
                                 `EDUCATION_ALAIS`,
                                  `EDUCATION_STATUS`,
                                   `EDUCATION_DATE_TIME`
                                   ) VALUES (?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_education.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssss", $name,$alais,$status,$saveOn);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">alert("New Education is Successfully Added");window.location = "../add_education.php";</script>';								
                                exit();
                            }			
                        }
                }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
?>    