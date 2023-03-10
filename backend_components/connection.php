<?php
    // Create connection
    $db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'test_medeast' ) or die(mysqli_error($db));

    $backup_db = mysqli_connect('localhost', 'root', '') or 
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($backup_db, 'backup_nxt_hospital') or die(mysqli_error($backup_db));
?>