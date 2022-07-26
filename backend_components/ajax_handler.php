<?php
    include "connection.php";
    $name = mysqli_real_escape_string($db, $_POST['docName']);
    $by = mysqli_real_escape_string($db, $_POST['userId']);

    if(mysqli_query($db, "INSERT INTO `visitor_doctor`(`VISITOR_NAME`, `STAFF_ID`) VALUES('" . $name . "','" . $by . "')")) {
    echo 'Form Has been submitted successfully';
    } else {
    echo "Error: " . $sql . "" . mysqli_error($db);
    }
?>