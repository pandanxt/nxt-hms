<?php
require 'connection.php';
    if (isset($_POST['simple-bill-submit'])) {

        $name = $_POST['name'];
        $mrid = $_POST['mrid'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $doctor = $_POST['doctor'];
        $type = $_POST['type'];
        $cnic = $_POST['cnic'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $by = $_POST['by']; 

        $serviceBox=$_POST['service'];  
        $serv="";  
        foreach($serviceBox as $serv1){ $serv .= $serv1.","; }  
        $admissionTime = $_POST['admissionTime']; 
        $dischargeTime = $_POST['dischargeTime'];
        $admitDay = $_POST['admitDay'];
        $totalBill = $_POST['totalBill'];
        $discount = $_POST['discount'];
        $finalBill = $_POST['finalBill'];

        $sql = "SELECT * FROM `patient` WHERE `PATIENT_MOBILE` = ? AND `PATIENT_MR_ID` = ?";
        $stmt = mysqli_stmt_init($db);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../add_bill.php?type=$type&action=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$phone,$mrid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
                
                if ($resultCheck > 0) {
                    header("Location: ../add_bill.php?type=$type&action=nameTaken");
                    exit();
                }else{
                        $sqlPatient = "INSERT INTO `patient`
                        (`PATIENT_MR_ID`,
                          `PATIENT_NAME`,
                           `PATIENT_TYPE`,
                            `PATIENT_MOBILE`,
                             `PATIENT_CNIC`,
                              `PATIENT_GENDER`,
                               `PATIENT_AGE`,
                                `PATIENT_ADDRESS`,
                                 `DOCTOR_ID`,
                                  `PATIENT_DATE_TIME`,
                                    `CREATED_BY`
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        mysqli_stmt_execute($stmt);
                    
                        if (!mysqli_stmt_prepare($stmt,$sqlPatient)) {
                            header("Location: ../add_bill.php?type=$type&action=sqlerror");
                            exit();
                        }else{
                            mysqli_stmt_bind_param($stmt,"sssssssssss", $mrid,$name,$type,$phone,$cnic,$gender,$age,$address,$doctor,$dischargeTime,$by);
                            mysqli_stmt_execute($stmt);

                            $sqlBill = "INSERT INTO `bill_record`(
                                    `MR_ID`,
                                    `MOBILE`,
                                    `CNIC`,
                                    `ADMISSION_DATE`,
                                    `DISCHARGE_DATE`,
                                    `ADMIT_DAYS`,
                                    `BILL_DATE`,
                                    `SERVICES`,
                                    `BILL_AMOUNT`,
                                    `DISCOUNT`,
                                    `TOTAL`,
                                    `CREATED_BY`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                                    mysqli_stmt_execute($stmt);
                        
                                if (!mysqli_stmt_prepare($stmt,$sqlBill)) {
                                    header("Location: ../add_bill.php?type=$type&action=sqlerror");
                                    exit();
                                }else{                                
                                    mysqli_stmt_bind_param($stmt,"ssssssssssss",$mrid,$phone,$cnic,$admissionTime,$dischargeTime,$admitDay,$dischargeTime,$serv,$totalBill,$discount,$finalBill,$by);
                                    mysqli_stmt_execute($stmt);
                                    echo '<script type="text/javascript">window.location = "../bill.php?action=saved";</script>';								
                                    exit();
                                }			
                        }			
                }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

  ?>  