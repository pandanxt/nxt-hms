<?php
    require 'connection.php';

    if(isset($_GET['billId']))
    {
        $sql ="DELETE FROM `patient_bill` WHERE `BILL_ID`='$_GET[billId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('bill record deleted successfully..');window.location = '../bill.php';</script>";
        }
    }
    if(isset($_GET['deptId']))
    {
        $sql ="DELETE FROM `department` WHERE `DEPARTMENT_ID` ='$_GET[deptId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('department record deleted successfully..');window.location = '../dept.php';</script>";
        }
    }
    if(isset($_GET['docId']))
    {
        $sql ="DELETE FROM `doctor` WHERE `DOCTOR_ID` ='$_GET[docId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('doctor record deleted successfully..');window.location = '../doctors.php';</script>";
        }
    }
    if(isset($_GET['eduId']))
    {
        $sql ="DELETE FROM `education` WHERE `EDUCATION_ID` ='$_GET[eduId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('education record deleted successfully..');window.location = '../education.php';</script>";
        }
    }
    if(isset($_GET['patId']))
    {
        $sql ="DELETE FROM `patient` WHERE `PATIENT_ID` ='$_GET[patId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('patient record deleted successfully..');window.location = '../patients.php';</script>";
        }
    }
    if(isset($_GET['patTypeId']))
    {
        $sql ="DELETE FROM `patient_type` WHERE `PATIENT_TYPE_ID` ='$_GET[patTypeId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('patient type record deleted successfully..');window.location = '../patient_type.php';</script>";
        }
    }
    if(isset($_GET['serId']))
    {
        $sql ="DELETE FROM `bill_service` WHERE `BILL_SERVICE_ID` ='$_GET[serId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('service record deleted successfully..');window.location = '../services.php';</script>";
        }
    }
    if(isset($_GET['userId']))
    {
        $sql ="DELETE FROM `admin` WHERE `ADMIN_ID` ='$_GET[userId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>alert('user record deleted successfully..');window.location = '../users.php';</script>";
        }
    }
?>