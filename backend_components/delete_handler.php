<?php
    require 'connection.php';

    if(isset($_GET['billId']))
    {
        $sql ="DELETE FROM `bill_record` WHERE `BILL_ID`='$_GET[billId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../bill.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['deptId']))
    {
        $sql ="DELETE FROM `department` WHERE `DEPARTMENT_ID` ='$_GET[deptId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../dept.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['docId']))
    {
        $sql ="DELETE FROM `doctor` WHERE `DOCTOR_ID` ='$_GET[docId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../doctors.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['eduId']))
    {
        $sql ="DELETE FROM `education` WHERE `EDUCATION_ID` ='$_GET[eduId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../education.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['patId']))
    {
        $sql ="DELETE FROM `patient` WHERE `PATIENT_ID` ='$_GET[patId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../patients.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['patTypeId']))
    {
        $sql ="DELETE FROM `patient_type` WHERE `PATIENT_TYPE_ID` ='$_GET[patTypeId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../patient_type.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['serId']))
    {
        $sql ="DELETE FROM `bill_service` WHERE `BILL_SERVICE_ID` ='$_GET[serId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../services.php?action=deleted';</script>";
        }
    }
    if(isset($_GET['userId']))
    {
        $sql ="DELETE FROM `admin` WHERE `ADMIN_ID` ='$_GET[userId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../users.php?action=deleted';</script>";
        }
    }
?>