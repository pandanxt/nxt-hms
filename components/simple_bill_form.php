  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
            <!-- <h1>Generate Bill</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Bill</li>
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
          <form action="backend_components/bill_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

              <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="col-md-6" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-6">
                        <label>Patient MR-ID: </label>
                        <input type="text" name="mrid" id="inputMR1" class="form-control" readonly/>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Patient Type: </label>
                        <input type="text" name="type" class="form-control" value="<?php echo $type; ?>" readonly/>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                    <label>Patient Name: </label>
                      <input type="text" name="name" class="form-control" placeholder="Enter Name ..." required/>
                    </div>
                  </div>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-6">
                    <label>Patient Mobile: </label>
                      <input type="text" name="phone" class="form-control" placeholder="Enter Phone ..." required/>
                    </div>
                    <div class="form-group col-md-6" id="cnic">
                      <label>Patient CNIC: </label>
                      <input type="text" name="cnic" class="form-control" placeholder="Enter CNIC ..."/>
                    </div>
                  </div>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-6">
                    <label>Patient Gender</label>
                      <select class="form-control select2bs4" name="gender">
                        <option selected="selected" value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Patient Age: </label>
                      <input type="text" name="age" class="form-control" placeholder="Enter Age ..."/>
                    </div>
                  </div>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-6">
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
                    <div class="form-group col-md-6">
                      <label>Patient Address</label>
                      <textarea name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                    </div>
                  </div>
                 <!-- Date and time -->
                 <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-6">
                    <label>Admission Date</label>
                      <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" name="admissionTime" class="form-control datetimepicker-input" placeholder="Admission Date ..." data-target="#reservationdatetime"/>
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Discharge Date</label>
                      <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                        <input type="text" name="dischargeTime" class="form-control datetimepicker-input" placeholder="Discharge Date ..." data-target="#reservationdatetime2"/>
                        <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <label>Bill Services</label>
                <?php
                $service = 'SELECT `BILL_SERVICE_ID`, `BILL_SERVICE_NAME`, `BILL_SERVICE_AMOUNT` FROM `bill_service` WHERE `SERVICE_STATUS` = "active"';
                $result = mysqli_query($db, $service) or die (mysqli_error($db));
                  while ($row = mysqli_fetch_array($result)) {
                    $id = $row['BILL_SERVICE_ID'];  
                    $name = $row['BILL_SERVICE_NAME'];
                    $amount = $row['BILL_SERVICE_AMOUNT'];
                    echo '<div class="clearfix">';
                    echo '<div class="icheck-primary d-inline">';
                    echo ' <input style="" type="checkbox" value="'.$name.'" data-amount="'.$amount.'" name="service[]" id="checkboxPrimary'.$id.'" onchange="addPrice(this)">';
                    echo ' <label style="text-align:center;" for="checkboxPrimary'.$id.'">'.$name.'</label> <label style="float:right;" for="checkboxPrimary'.$id.'">Rs - '.$amount.'</label> ';
                    echo '</div>';
                    echo '</div>';
                  }
                ?> 
                <div class="col-md-12" style="display:flex;margin:0; margin-top: 25px;padding:0;">
                    <div class="form-group col-md-3">
                      <label>Serv Charges</label>
                      <input type="number" class="form-control" name="totalBill" id="totalBill" placeholder="Service Charges" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Total Bill</label>
                      <input type="number" name="finalBill" class="form-control" id="finalBill" placeholder="Total Value" readonly>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Admit Days</label>
                      <input type="number" name="admitDay" onchange="myDayFunction(this)" id="day" placeholder="Admit Day ..." class="form-control"/>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Discount</label>
                      <input type="number" name="discount" class="form-control" onchange="myChangeFunction(this)" id="discount" placeholder="Discount">
                      <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
                    </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <script>
            var sum = 1;
            let addPrice = (elem) => {
              let value = parseFloat(elem.getAttribute("data-amount").replace(/\$|,/g, ''), 2);
              elem.checked ? (sum += value) : (sum -= value);
              
              var totalPrice = sum;
              console.log(totalPrice);
              document.getElementById('totalBill').value = totalPrice;
              console.log(sum);
            };

            function myDayFunction(day) {
              var totalBill = document.getElementById('totalBill');
              var finalBill = document.getElementById('finalBill');
              if(day==0){
                totalPrice = sum*1;
                console.log(totalBill.value);
                totalBill.value = totalPrice;
                finalBill.value = totalPrice;
              }else{
                totalPrice = sum*day.value;
                console.log(totalBill.value);
                totalBill.value = totalPrice;
                finalBill.value = totalPrice;
              }
            }

            function myChangeFunction(discount) {
              var finalBill = document.getElementById('finalBill');
              var totalBill = document.getElementById('totalBill');
              finalBill.value = totalBill.value - discount.value;
            }
            var currentDT = new Date().toLocaleString().replace(',','');
            var unid = Date.now() +"-"+ "ME";
            var MR_ID = unid.slice(6,16);
            document.getElementById('inputMR1').value = MR_ID;
          </script>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="simple-bill-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>