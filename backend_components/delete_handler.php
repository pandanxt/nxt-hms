<?php
    require 'connection.php';

    // Department Delete Query
    if(isset($_GET['deptId']))
    {
        $sql ="DELETE FROM `department` WHERE `DEPARTMENT_ID` ='$_GET[deptId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../dept.php?action=deleted';</script>";
        }
    }
    // Doctor Delete Query
    if(isset($_GET['docId']))
    {
        $sql ="DELETE FROM `doctor` WHERE `DOCTOR_ID` ='$_GET[docId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../doctors.php?action=deleted';</script>";
        }
    }
    // Patient Type Delete Query
    if(isset($_GET['patTypeId']))
    {
        $sql ="DELETE FROM `patient_type` WHERE `PATIENT_TYPE_ID` ='$_GET[patTypeId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../patient_type.php?action=deleted';</script>";
        }
    }
    // Admin Delete Query
    if(isset($_GET['userId']))
    {
        $sql ="DELETE FROM `admin` WHERE `ADMIN_ID` ='$_GET[userId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../users.php?action=deleted';</script>";
        }
    }
    // Room Delete Query 
    if(isset($_GET['roomId']))
    {
        $sql ="DELETE FROM `room` WHERE `ROOM_ID` ='$_GET[roomId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../room.php?action=deleted';</script>";
        }
    }
    // Emergency Slip Record Delete Query
    if(isset($_GET['esrId']))
    {
        $sql ="DELETE FROM `emergency_slip` WHERE `SLIP_ID` ='$_GET[esrId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../emergency_slip_record.php?action=deleted';</script>";
        }
    }
    // Indoor Slip Record Delete Query
    if(isset($_GET['isrId']))
    {
        $sql ="DELETE FROM `indoor_slip` WHERE `SLIP_ID` ='$_GET[isrId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../indoor_slip_record.php?action=deleted';</script>";
        }
    }
    // Outdoor Slip Record Delete Query
    if(isset($_GET['osrId']))
    {
        $sql ="DELETE FROM `outdoor_slip` WHERE `SLIP_ID` ='$_GET[osrId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../outdoor_slip_record.php?action=deleted';</script>";
        }
    }
    // Emergency Bill Record Delete Query
    if(isset($_GET['ebrId']))
    {
        $sql ="DELETE FROM `emergency_bill` WHERE `SLIP_ID` ='$_GET[ebrId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../emergency_bill_record.php?action=deleted';</script>";
        }
    }
    // Indoor Bill Record Delete Query
    if(isset($_GET['ibrId']))
    {
        $sql ="DELETE FROM `indoor_bill` WHERE `SLIP_ID` ='$_GET[ibrId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../indoor_bill_record.php?action=deleted';</script>";
        }
    }
    // Patient Record Delete Query
    if(isset($_GET['prId']))
    {
        $sql ="DELETE FROM `me_patient` WHERE `PATIENT_MR_ID` ='$_GET[prId]'";
        $qsql=mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) == 1)
        {
            echo "<script>window.location = '../patient_record.php?action=deleted';</script>";
        }
    }

?>