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
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button> -->
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Patient MR-ID</label>
                  <input type="text" class="form-control" id="inputMR1" readonly>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Mobile No.</label>
                  <input type="tel" class="form-control" id="inputPhone" placeholder="Enter Mobile No. with '-' " pattern="[0-9]{4}-[0-9]{7}" title="Please Enter Phone number with '-'" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Gender</label>
                  <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected" value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <!-- /.form-group -->
                 <div class="form-group">
                  <label>Patient Address</label>
                  <textarea style="height: 38px;" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                  <!-- <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected" value="active">Medical</option>
                    <option value="unactive">Eye Specialist</option>
                  </select> -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Admission Date | Time</label>
                  <input type="text" class="form-control" id="inputDT" readonly>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Patient Name</label>
                  <input type="text" class="form-control" id="inputName1" placeholder="Enter Patient Name Here ..." required>
                  <!-- <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                          style="width: 100%;">
                    <option>Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select> -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient CNIC</label>
                  <input type="tel" class="form-control" id="inputCnic1" placeholder="Enter Patient CNIC Here ..." pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="Please Enter CNIC number with '-'" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Age</label>
                  <input type="number" class="form-control" id="inputAge1" placeholder="Enter Patient Age Here ..." required>
                  <!-- <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected" value="active">Active</option>
                    <option value="unactive">Unactive</option>
                  </select> -->
                </div>

                 <!-- /.form-group -->
                 <div class="form-group">
                  <label>Doctor Name</label>
                  <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected" value="sohaib">Dr Sohaib</option>
                    <option value="second">Dr Second</option>
                  </select>
                </div>


                 <!-- Date and time -->
                 <div class="form-group">
                 <label>Discharge Date | Time</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" class="btn btn-block btn-primary">Submit</button>
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
       
      var currentDT = new Date().toLocaleString().replace(',','');
      var unid = Date.now() +"-"+ "ME";
      var MR_ID = unid.slice(6,16);
     
      // console.log(MR_ID+" | "+unid+" | "+currentDT);
      document.getElementById('inputMR1').value = MR_ID;
      document.getElementById('inputDT').value = currentDT; 

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
