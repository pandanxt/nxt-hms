<?php
    require 'connection.php';
    if (!isset($_POST['bill-submit'])) {
        $name = $_POST['name'];
        $saveOn = $_POST['addDate'];
    }

    if (isset($_POST['user-submit'])) {
        $status =  $_POST['status'];
        $loginId = $_POST['loginId'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $permission =  $_POST['permission'];

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
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['dept-submit'])) {
        $status =  $_POST['status'];
        $description =  $_POST['description'];        
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
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['service-submit'])) {
        $status =  $_POST['status'];
        $amount =  $_POST['amount'];
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
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['doctor-submit'])) {
        $status =  $_POST['status'];
        $mobile =  $_POST['mobile'];
        $department =  $_POST['department'];
        $education = implode(', ', $_POST['education']);
        $experience =  $_POST['experience'];
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
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['patient-type-submit'])) {
        $status =  $_POST['status'];
        $alais = $_POST['type-alais'];
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
                                      `PATIENT_DATE_TIME`
                                        ) VALUES (?,?,?,?,?,?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_patient.php?error=sqlerror");
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssssssssss", $mrid,$name,$type,$phone,$cnic,$gender,$age,$address,$doctor,$saveOn);
                                mysqli_stmt_execute($stmt);
                                $recordUpdate = "INSERT INTO `patient_record`(
                                    `PATIENT_MR_ID`,
                                    `PATIENT_MOBILE`, 
                                    `PATIENT_CNIC`,
                                     `PATIENT_ADMISSION_DATE_TIME`
                                      ) VALUES ('$mrid','$phone','$cnic','$saveOn')";
                                  
                                  if ($query_sql = mysqli_query($db, $recordUpdate))
                                    {
                                        echo '<script type="text/javascript">alert("New Patient Record is Successfully Added");window.location = "../add_patient.php";</script>';								
                                    }else
                                        {
                                            echo mysqli_error($db);
                                        }
                                exit();
                            }			
                        }
            }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['education-submit'])) {
        
        $alais = $_POST['alais'];
        $status = $_POST['status'];
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
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    if (isset($_POST['bill-submit'])) {
        
        $serviceBox=$_POST['service'];  
        $serv="";  
        foreach($serviceBox as $serv1)  
        {  
            $serv .= $serv1.",";  
        }  
        $type = $_POST['type'];
        $mrid = $_POST['mrid'];
        $phone = $_POST['phone'];
         if ($type == 'indoor') {
            $cnic = $_POST['cnic'];
         }
        $dischargeTime = $_POST['dischargeTime'];
        $admitDay = $_POST['admitDay'];
        $totalBill = $_POST['totalBill'];
        $discount = $_POST['discount'];
        $finalBill = $_POST['finalBill'];

            $sql = "SELECT * FROM `patient_bill` WHERE `PATIENT_MR_ID` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../add_bill.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$mrid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    // if ($resultCheck > 0) {
                    //     header("Location: ../add_bill.php?error=billMridAlreadyTaken");
                    //     exit();
                    // }else{                         
                            $sql = "INSERT INTO `patient_bill`(
                                `PATIENT_MR_ID`, 
                                `PATIENT_MOBILE`, 
                                `PATIENT_CNIC`, 
                                `DISCHARGE_DATE_TIME`, 
                                `BILL_DATE_TIME`, 
                                `BILL_SERVICE_ID`, 
                                `BILL_TOTAL_AMOUNT`, 
                                `BILL_DISCOUNT`,
                                `BILL_FINAL_TOTAL`) VALUES (?,?,?,?,?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                header("Location: ../add_bill.php?error=sqlerror");
                                exit();
                            }else{                                
                                    mysqli_stmt_bind_param($stmt,"sssssssss", $mrid,$phone,$cnic,$dischargeTime,$dischargeTime,$serv,$totalBill,$discount,$finalBill);
                                    mysqli_stmt_execute($stmt);

                                    $checkQuery = "SELECT * FROM `patient_record` WHERE `PATIENT_MR_ID` = '$mrid' AND `PATIENT_MOBILE` = '$phone' ORDER BY  `RECORD_ID` LIMIT 1";
                                    $qsql = mysqli_query($db,$checkQuery);
                                    $rs = mysqli_fetch_array($qsql);
                                    $checkValue = $rs['PATIENT_DISCHARGE_DATE_TIME'];

                                    $checkBillId = "SELECT `BILL_ID` FROM `patient_bill` ORDER BY `BILL_ID` DESC LIMIT 1";
                                    $qsql = mysqli_query($db,$checkBillId);
                                    $rs = mysqli_fetch_array($qsql);
                                    $billId = $rs['BILL_ID'];
                                    // echo '<script>alert("'.$billId.'");</script>';                                   

                                    if (empty($checkValue)) {
                                        $recordUpdate = "UPDATE `patient_record` SET 
                                        `PATIENT_DISCHARGE_DATE_TIME`='$dischargeTime',`PATIENT_ADMIT_DAYS`='$admitDay', `PATIENT_BILL_ID`='$billId' 
                                        WHERE `PATIENT_MR_ID` = '$mrid' OR `PATIENT_MOBILE` = '$phone' OR `PATIENT_CNIC` = '$cnic' 
                                        ORDER BY `RECORD_ID` LIMIT 1";                                 
                                    }else {
                                        $recordUpdate = " INSERT INTO `patient_record`(
                                            `PATIENT_MR_ID`, 
                                            `PATIENT_MOBILE`, 
                                            `PATIENT_CNIC`, 
                                            `PATIENT_ADMISSION_DATE_TIME`, 
                                            `PATIENT_DISCHARGE_DATE_TIME`, 
                                            `PATIENT_ADMIT_DAYS`,
                                            `PATIENT_BILL_ID`)
                                        VALUES ('$mrid','$phone','$cnic','$dischargeTime','$dischargeTime','$admitDay','$billId')";                                 
                                    }
                                    if ($query_sql = mysqli_query($db, $recordUpdate))
                                            {
                                                echo '<script type="text/javascript">alert("New Patient Record is Successfully Added");window.location = "../add_patient.php";</script>';								
                                            }else
                                                {
                                                    echo mysqli_error($db);
                                                }
                                    
                                    exit();
                                }			
                            // }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
?>    