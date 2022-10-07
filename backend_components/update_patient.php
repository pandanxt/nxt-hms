<?php
    // $sql="SELECT * FROM `patient` 
    // INNER JOIN `doctor` INNER JOIN `patient_type` 
    // WHERE `patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` 
    // AND `patient`.`PATIENT_TYPE` = `patient_type`.`PATIENT_TYPE_ALAIS` 
    // AND `patient`.`PATIENT_ID` = '$_GET[id]'";
    // $qsql = mysqli_query($db,$sql);
    // $rsedit = mysqli_fetch_array($qsql);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Patient</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Patient</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> MedEast Patient</h3>
            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="backend_components/update_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Patient MR-ID</label>
                  <input type="text" name="mrid" class="form-control" value="<?php echo $rsedit['PATIENT_MR_ID']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" value="<?php echo $rsedit['PATIENT_NAME']; ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Mobile No.</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" value="<?php echo $rsedit['PATIENT_MOBILE']; ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Gender</label>
                  <select class="form-control select2bs4" name="gender" style="width: 100%;">
                    <option selected="selected" value="<?php echo $rsedit['PATIENT_GENDER']; ?>"><?php echo $rsedit['PATIENT_GENDER']; ?></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                 <!-- /.form-group -->
                 <div class="form-group">
                  <label id="doctor">Medical Officer (MO)</label>
                  <select class="form-control select2bs4" name="doctor" style="width: 100%;">
                  <option value="<?php echo $rsedit['DOCTOR_ID']; ?>" selected><?php echo $rsedit['DOCTOR_NAME']; ?></option>
                    <?php
                      $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "active"';
                      $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DOCTOR_ID'];  
                          $name = $row['DOCTOR_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="pid" value="<?php echo $rsedit['PATIENT_ID']; ?>" hidden/>
              <div class="form-group">
                  <label>Patient Type</label>
                  <select class="form-control select2bs4" name="type" onchange="typeFun();" id="typeSelect" style="width: 100%;" required>
                  <option value="<?php echo $rsedit['PATIENT_TYPE_ALAIS']; ?>" selected><?php echo $rsedit['PATIENT_TYPE_NAME']; ?></option>
                  <?php
                      // $p_type = 'SELECT `PATIENT_TYPE_NAME`, `PATIENT_TYPE_ALAIS` FROM `patient_type` WHERE `PATIENT_TYPE_STATUS` = "active"';
                      // $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
                      //   while ($row = mysqli_fetch_array($result)) {
                      //     $id = $row['PATIENT_TYPE_ALAIS'];  
                      //     $name = $row['PATIENT_TYPE_NAME'];
                      //     echo '<option value="'.$id.'">'.$name.'</option>'; 
                      // }
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group" id="cnic">
                  <label>Patient CNIC</label>
                  <input type="tel" name="cnic" class="form-control" id="inputCnic1" value="<?php echo $rsedit['PATIENT_CNIC']; ?>"/>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Age</label>
                  <input type="number" name="age" class="form-control" id="inputAge1" value="<?php echo $rsedit['PATIENT_AGE']; ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Address</label>
                  <textarea style="height: 120px;" name="address" type="text" class="form-control" id="inputAddress" required><?php echo $rsedit['PATIENT_ADDRESS']; ?></textarea>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="update-patient-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
