<?php
	require 'connection.php';

    if(isset($_POST['update-user-submit'])){
		$id =  $_POST['uid'];
		$name =  $_POST['name'];
		$status =  $_POST['status'];
        $loginId = $_POST['loginId'];
        $email = $_POST['email'];
        $permission =  $_POST['permission'];

			$sql ="UPDATE `admin` SET 
			`ADMIN_NAME`='$name',
			`ADMIN_TYPE`='$permission',
			`ADMIN_EMAIL`='$email',
			`ADMIN_USERNAME`='$loginId',
			`ADMIN_STATUS`='$status'
			WHERE `ADMIN_ID` = '$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('User record updated successfully...');window.location = '../users.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
	if(isset($_POST['update-education-submit'])){
		$id =  $_POST['eid'];
		$name =  $_POST['name'];
		$status =  $_POST['status'];
        $alais = $_POST['alais'];

		
			$sql ="UPDATE `education` SET 
			`EDUCATION_NAME`='$name',
			`EDUCATION_ALAIS`='$alais',
			`EDUCATION_STATUS`='$status' WHERE `EDUCATION_ID` = '$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Education record updated successfully...');window.location = '../education.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
	if(isset($_POST['update-patient-type-submit'])){
		$id =  $_POST['ptid'];
		$name =  $_POST['name'];
		$status =  $_POST['status'];
        $alais = $_POST['alais'];

			$sql ="UPDATE `patient_type` SET 
			`PATIENT_TYPE_NAME`='$name',
			`PATIENT_TYPE_ALAIS`='$alais',
			`PATIENT_TYPE_STATUS`='$status' WHERE `PATIENT_TYPE_ID` = '$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Patient Type record updated successfully...');window.location = '../patient_type.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
	if(isset($_POST['update-service-submit'])){
		$id =  $_POST['sid'];
		$name =  $_POST['name'];
		$status =  $_POST['status'];
        $amount = $_POST['amount'];

			$sql ="UPDATE `bill_service` SET 
			`BILL_SERVICE_NAME`='$name',
			`BILL_SERVICE_AMOUNT`='$amount',
			`SERVICE_STATUS`='$status'
			 WHERE `BILL_SERVICE_ID` = '$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Service record updated successfully...');window.location = '../services.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
	if(isset($_POST['update-dept-submit'])){
		$id =  $_POST['did'];
		$name =  $_POST['name'];
		$status =  $_POST['status'];
        $description = $_POST['description'];

			$sql ="UPDATE `department` SET 
			`DEPARTMENT_NAME`='$name',
			`DEPARTMENT_DESC`='$description',
			`DEPARTMENT_STATUS`='$status' 
			WHERE `DEPARTMENT_ID` = '$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Department record updated successfully...');window.location = '../dept.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
	if(isset($_POST['update-doctor-submit'])){
		$id =  $_POST['docid'];
		$name =  $_POST['name'];
		$phone =  $_POST['mobile'];
        $department = $_POST['department'];
		$education = implode(', ', $_POST['education']);
		$experience = $_POST['experience'];
		$status =  $_POST['status'];

			$sql ="UPDATE `doctor` SET 
			`DOCTOR_NAME`='$name',`DOCTOR_MOBILE`='$phone',
			`DEPARTMENT_ID`='$department',`DOCTOR_EDUCATION`='$education',
			`DOCTOR_EXPERIENCE`='$experience',`DOCTOR_STATUS`='$status' WHERE `DOCTOR_ID`='$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Doctor record updated successfully...');window.location = '../doctors.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
	if(isset($_POST['update-patient-submit'])){
		$id =  $_POST['pid'];
		$mrid =  $_POST['mrid'];
		$name =  $_POST['name'];
		$phone =  $_POST['phone'];
		$gender =  $_POST['gender'];
        $doctor = $_POST['doctor'];
		$type = $_POST['type'];
		$cnic = $_POST['cnic'];
		$age = $_POST['age'];
		$address = $_POST['address'];

			$sql ="UPDATE `patient` SET `PATIENT_MR_ID`='$mrid',
			`PATIENT_NAME`='$name',`PATIENT_TYPE`='$type',
			`PATIENT_MOBILE`='$phone',`PATIENT_CNIC`='$cnic',
			`PATIENT_GENDER`='$gender',`PATIENT_AGE`='$age',
			`PATIENT_ADDRESS`='$address',`DOCTOR_ID`='$doctor'
			 WHERE `PATIENT_ID` = '$id'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Patient record updated successfully...');window.location = '../patients.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}
?>