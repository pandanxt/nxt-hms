<?php
    // Create connection
    $db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'medeast_hms' ) or die(mysqli_error($db));
?>