<?php 
  // Start Session 
  session_start();
  $q = intval($_GET['q']);
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
 
?>
    <label>Consultant/Surgeon</label>

    <select class="form-control select2bs4" name="doctor" style="width: 100%;">
    <option disabled selected>Select Consultant Name</option>
<?php
    $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "active" AND `DEPARTMENT_ID` = '.$q;
    $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['DOCTOR_ID'];  
        $name = $row['DOCTOR_NAME'];
        echo '<option value="'.$id.'">'.$name.'</option>'; 
    }
?>
    </select>
<?php  
    mysqli_close($db);

// Form Script Files
include('components/form_script.php');
?>