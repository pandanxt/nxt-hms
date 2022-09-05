<?php 
  // Start Session 
  session_start();
  $q = (isset($_GET['q']) ? $_GET['q'] : '');
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
 
?>
    <option disabled selected value="">----- Select Consultant Name -----</option>
    <?php
    if ($q != 'vt') {
        $doctor = "SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctor` WHERE `DOCTOR_STATUS` = 1 AND `DEPARTMENT_UUID` = '$q'";
        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['DOCTOR_UUID'];  
            $name = $row['DOCTOR_NAME'];
            echo '<option value="'.$name.'">'.$name.'</option>'; 
        }   
    } else {
        $doctor = 'SELECT `VISITOR_UUID`, `VISITOR_NAME` FROM `vt_doctor` WHERE `VISITOR_STATUS` = "1"';
        $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['VISITOR_UUID'];  
            $name = $row['VISITOR_NAME'];
            echo '<option value="'.$name.'">'.$name.'</option>'; 
        }   
    }
    ?>
    </select>
<?php  
    mysqli_close($db);

// Form Script Files
include('components/form_script.php');
?>