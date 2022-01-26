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
            <h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> MedEast Patient Bill</h3>

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
                  <label>Bill Services</label>
                  <select class="select2bs4" name="service[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                    <?php
                      $edu = 'SELECT `BILL_SERVICE_ID`, `BILL_SERVICE_NAME` FROM `bill_service` WHERE `SERVICE_STATUS` = "active"';
                      $result = mysqli_query($db, $edu) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['BILL_SERVICE_ID'];  
                          $name = $row['BILL_SERVICE_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>    
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Bill Discount</label>
                  <input type="number" class="form-control" id="inputCnic1" placeholder="Enter Discount Here ...">
                </div>
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
               
                 <!-- Date and time -->
                 <div class="form-group">
                    <label>Discharge Date | Time</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" name="dischargeTime" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Date and time -->
                <!-- <div class="form-group">
                 <label>Bill Date | Time</label>
                    <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime2"/>
                        <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                  <label>Total Bill Amount</label>
                  <input type="number" class="form-control" name="totalBill" id="inputPhone" placeholder="Enter Total Amount of Bill " required>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="bill-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
