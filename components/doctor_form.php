<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Create New Doctor</h1> -->
            <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create New Doctor</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-user-md"></i> MedEast Doctor</h3>

            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="backend_components/php_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Doctor Name</label>
                  <input type="text" class="form-control" name="name" id="inputText1" placeholder="Enter Full Name Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Mobile No.</label>
                  <input type="tel" class="form-control" name="mobile" id="inputLoginId1" placeholder="Enter Mobile No. with '-' " pattern="[0-9]{4}-[0-9]{7}" title="Please Enter Phone number with '-'" required>
                </div>
                <!-- /.form-group -->
                 <!-- /.form-group -->
                 <div class="form-group">
                  <label>Department</label>
                  <select class="form-control select2bs4" name="department" style="width: 100%;">
                  <option disabled selected>Select Department</option>
                    <?php
                      $dept = 'SELECT `DEPARTMENT_ID`,`DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_STATUS` = "active"';
                      $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DEPARTMENT_ID'];  
                          $name = $row['DEPARTMENT_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>    
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                <div class="form-group">
                  <label>Education</label>
                  <select class="select2bs4" multiple="multiple" name="education[]" data-placeholder="Select a State"
                          style="width: 100%;">
                          <?php
                      $edu = 'SELECT `EDUCATION_NAME`,`EDUCATION_ALAIS` FROM `education` WHERE `EDUCATION_STATUS` = "active"';
                      $result = mysqli_query($db, $edu) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['EDUCATION_ALAIS'];  
                          $name = $row['EDUCATION_NAME'];
                          echo '<option value="'.$id.'">'.$id.' | '.$name.'</option>'; 
                      }
                    ?>    
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Experience</label>
                  <input type="text" class="form-control" name="experience" id="inputPassword1" placeholder="Enter Experience Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;">
                    <option selected="selected" value="1">Active</option>
                    <option value="0">Unactive</option>
                  </select>
                  <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="doctor-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  