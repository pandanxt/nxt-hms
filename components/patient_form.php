<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Patient</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create New Patient</li>
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
          <form action="backend_components/php_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Patient MR-ID</label>
                  <input type="text" name="mrid" class="form-control" id="inputMR1" readonly>
                </div>
                <div class="form-group">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" placeholder="Enter Patient Name Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Mobile No.</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter Mobile No. with '-' " pattern="[0-9]{4}-[0-9]{7}" title="Please Enter Phone number with '-'" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Gender</label>
                  <select class="form-control select2bs4" name="gender" style="width: 100%;">
                    <option selected="selected" value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                 <!-- /.form-group -->
                 <div class="form-group">
                  <label id="doctor">Medical Officer (MO)</label>
                  <select class="form-control select2bs4" name="doctor" style="width: 100%;">
                  <option disabled selected>Select Doctor Name</option>
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
              <div class="form-group">
                  <label>Patient Type</label>
                  <select class="form-control select2bs4" name="type" onchange="typeFun();" id="typeSelect" style="width: 100%;" required>
                  <option disabled selected>Select Patient Type</option>
                  <?php
                      $p_type = 'SELECT `PATIENT_TYPE_NAME`, `PATIENT_TYPE_ALAIS` FROM `patient_type` WHERE `PATIENT_TYPE_STATUS` = "active"';
                      $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['PATIENT_TYPE_ALAIS'];  
                          $name = $row['PATIENT_TYPE_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group" id="cnic">
                  <label>Patient CNIC</label>
                  <input type="tel" name="cnic" class="form-control" id="inputCnic1" placeholder="Enter Patient CNIC Here ..." pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="Please Enter CNIC number with '-'">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Age</label>
                  <input type="number" name="age" class="form-control" id="inputAge1" placeholder="Enter Patient Age Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Address</label>
                  <textarea style="height: 120px;" name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="patient-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
      
      function typeFun(){
        var typeValue = document.getElementById('typeSelect').value;
        if (typeValue !== 'indoor') {
            document.getElementById('cnic').style.display = 'none';
            document.getElementById('doctor').innerHTML = 'Consultant Name';
        }else {
            document.getElementById('cnic').style.display = 'block';
            document.getElementById('doctor').innerHTML = 'Medical Officer (MO)';
        }
        console.log(typeValue);
      }
       
      var currentDT = new Date().toLocaleString().replace(',','');
      var unid = Date.now() +"-"+ "ME";
      var MR_ID = unid.slice(6,16);
     
      // console.log(MR_ID+" | "+unid+" | "+currentDT);
      document.getElementById('inputMR1').value = MR_ID;
      // document.getElementById('inputDT').value = currentDT; 

    function display_ct7() {
      var x = new Date();
      var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
      hours = x.getHours( ) % 12;
      hours = hours ? hours : 12;
      hours=hours.toString().length==1? 0+hours.toString() : hours;

      var minutes=x.getMinutes().toString()
      minutes=minutes.length==1 ? 0+minutes : minutes;

      var seconds=x.getSeconds().toString()
      seconds=seconds.length==1 ? 0+seconds : seconds;

      var month=(x.getMonth() +1).toString();
      month=month.length==1 ? 0+month : month;

      var dt=x.getDate().toString();
      dt=dt.length==1 ? 0+dt : dt;

      var x1=month + "/" + dt + "/" + x.getFullYear(); 
      x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
      document.getElementById('clockDT').innerHTML = x1;
      display_c7();
    }
    function display_c7(){
      var refresh=1000; // Refresh rate in milli seconds
      mytime=setTimeout('display_ct7()',refresh)
      }
    display_c7();
</script>
