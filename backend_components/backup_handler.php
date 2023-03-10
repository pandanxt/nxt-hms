<?php

    // Start Session 
session_start();
// Query Params
$q = (isset($_GET['q']) ? $_GET['q'] : '');
$id = (isset($_GET['id']) ? $_GET['id'] : '');
$val = (isset($_GET['val']) ? $_GET['val'] : '');
// Connection File
include "connection.php";
// Add Doctor Query
if($q == 'BACKUP_TABLE') {
    $tables = array();

    if (isset($_POST['slipBackup']) ) array_push($tables, "me_slip","me_slip_history");
    if (isset($_POST['billBackup']) ) array_push($tables, "me_bill","me_bill_history", "me_emergency", "me_emergency_history", "me_indoor", "me_indoor_history");
    if (isset($_POST['departmentBackup']) ) array_push($tables, "me_department");
    if (isset($_POST['doctorBackup']) ) array_push($tables, "me_doctors");
    if (isset($_POST['roomBackup']) ) array_push($tables, "me_room");
    if (isset($_POST['serviceBackup']) ) array_push($tables, "me_services");
    if (isset($_POST['serviceSlipBackup']) ) array_push($tables, "me_service_slip","me_service_slip_history");
    if (isset($_POST['followUpBackup']) ) array_push($tables, "me_followup_slip","me_followup_slip_history");
    if (isset($_POST['patientBackup']) ) array_push($tables, "me_patient","me_patient_history");

    if (!$db) { die("Source Connection failed: " . mysqli_connect_error()); }

    // Check if destination connection is successful
    if (!$backup_db) { die("BackUp Database Connection failed: " . mysqli_connect_error()); }

    foreach ($tables as $table) {
        if ($table === "me_slip"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            slipBackupTable($table, $backup_db, $result);

        }
        if ($table === "me_slip_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            slipHistoryBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_bill"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            billBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_bill_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            billHistoryBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_emergency"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            emergencyBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_emergency_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            emergencyHistoryBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_indoor"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            indoorBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_indoor_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            indoorHistoryBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_department"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            departmentBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_doctors"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            doctorBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_room"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            roomBackupTable($table, $backup_db, $result);
        }
        if ($table === "me_services"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            serviceBackupTable($table);
        }
        if ($table === "me_service_slip"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            serviceSlipBackupTable($table);
        }
        if ($table === "me_service_slip_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            serviceSlipHistoryBackupTable($table);
        }
        if ($table === "me_followup_slip"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            followupSlipBackupTable($table);
        }
        if ($table === "me_followup_slip_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            followupSlipHistoryBackupTable($table);
        }
        if ($table === "me_patient"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            patientBackupTable($table);
        }
        if ($table === "me_patient_history"){
            // Query to select data from source table
            $selectQuery = "SELECT * FROM $table";
            // Execute the select query
            $result = mysqli_query($db, $selectQuery);
            // Check if select query was successful
            if (!$result) {
                die("Select query failed: " . mysqli_error($db));
            }
            patientHistoryBackupTable($table);
        }
        // Add more else if statements for additional tables
    }
    // Close the connections
    mysqli_close($db);
    mysqli_close($backup_db);
    // }
}


// slipBackupTable
function slipBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// slipHistoryBackupTable
function slipHistoryBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// billBackupTable
function billBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// billHistoryBackupTable
function billHistoryBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// departmentBackupTable
function departmentBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// doctorBackupTable
function doctorBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// roomBackupTable
function roomBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// patientBackupTable
function patientBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// patientHistoryBackupTable
function patientHistoryBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// serviceBackupTable
function serviceBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}
// serviceSlipBackupTable
function serviceSlipBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// serviceSlipHistoryBackupTable
function serviceSlipHistoryBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

// followupSlipBackupTable
function followupSlipBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}
// followupSlipHistoryBackupTable
function followupSlipHistoryBackupTable($table, $backup_db, $result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the row already exists in the destination table
        $checkQuery = "SELECT * FROM $table WHERE `SLIP_UUID` = '".$row['SLIP_UUID']."'";

        // Execute the check query
        $checkResult = mysqli_query($backup_db, $checkQuery);

        // Check if check query was successful
        if (!$checkResult) {
            die("Check query failed: " . mysqli_error($backup_db));
        }

        // Insert row into destination table if it doesn't exist already
        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO $table (
                `SLIP_UUID`, 
                `SLIP_MRID`, 
                `SLIP_NAME`, 
                `SLIP_MOBILE`, 
                `SLIP_DISPOSAL`, 
                `SLIP_DEPARTMENT`, 
                `SLIP_DOCTOR`, 
                `SLIP_DATE_TIME`, 
                `SLIP_STATUS`, 
                `SLIP_DELETE`, 
                `SLIP_FEE`, 
                `SLIP_PROCEDURE`,
                `SLIP_TYPE`, 
                `SLIP_SUB_TYPE`, 
                `STAFF_ID`) VALUES (
                '" . $row['SLIP_UUID'] . "', 
                '" . $row['SLIP_MRID'] . "', 
                '" . $row['SLIP_NAME'] . "', 
                '" . $row['SLIP_MOBILE'] . "',
                '" . $row['SLIP_DISPOSAL'] . "', 
                '" . $row['SLIP_DEPARTMENT'] . "', 
                '" . $row['SLIP_DOCTOR'] . "',
                '" . $row['SLIP_DATE_TIME'] . "', 
                '" . $row['SLIP_STATUS'] . "', 
                '" . $row['SLIP_DELETE'] . "',
                '" . $row['SLIP_FEE'] . "', 
                '" . $row['SLIP_PROCEDURE'] . "', 
                '" . $row['SLIP_TYPE'] . "',
                '" . $row['SLIP_SUB_TYPE'] . "', 
                '" . $row['STAFF_ID'] . "')";

            // Execute the insert query
            $insertResult = mysqli_query($backup_db, $insertQuery);
            // Check if insert query was successful
            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($backup_db));
            }
        }
    }
}

?>