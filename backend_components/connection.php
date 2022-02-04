<?php
    // Create connection
    // Check connection

    $db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'med_east' ) or die(mysqli_error($db));
?>