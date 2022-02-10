<?php
      $sql="SELECT *, `DOCTOR_NAME`
            FROM `patient` 
            INNER JOIN `doctor` 
            WHERE 
            `PATIENT_ID` = " .$_GET['id']. " AND 
            `patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
      $qsql = mysqli_query($db,$sql);
      $patdata = mysqli_fetch_array($qsql);
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Generate Bill for <?php echo $patdata['PATIENT_NAME'] ; ?></h1>
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
          <form action="backend_components/php_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12 clearfix">
                  <div style="line-height: 5px;" class="row "><label>MR-ID: </label>&nbsp; <p><?php echo $patdata['PATIENT_MR_ID'] ; ?></p></div>
                  <div style="line-height: 5px;" class="row"><label>Name: </label>&nbsp; <p><?php echo $patdata['PATIENT_NAME'] ; ?></p></div>
                  <div style="line-height: 5px;" class="row"><label>Mobile: </label>&nbsp; <p><?php echo $patdata['PATIENT_MOBILE'] ; ?></p></div>
                </div>
                
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
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                
                <div class="col-md-12 clearfix" style="margin-left:7px;">
                  <div style="line-height: 5px;" class="row"><label>Gender: </label>&nbsp; <p><?php echo $patdata['PATIENT_GENDER'] ; ?></p></div>                
                  <?php if ($patdata['PATIENT_TYPE'] == 'indoor') { ?>
                    <div style="line-height: 5px;" class="row"><label>CNIC: </label>&nbsp; <p><?php echo $patdata['PATIENT_CNIC'] ; ?></p></div>
                    <div style="line-height: 5px;" class="row"><label>Doctor: </label>&nbsp; <p><?php echo $patdata['DOCTOR_NAME'] ; ?></p></div>
                  <?php }else{ ?>
                    <div style="line-height: 5px;" class="row"><label>Consultant Name</label>&nbsp; <p><?php echo $patdata['DOCTOR_NAME'] ; ?></p></div>
                  <?php } ?>
                </div>
                <input type="text" name="phone" value="<?php echo $patdata['PATIENT_MOBILE'] ; ?>" hidden readonly>
                <input type="text" name="mrid" value="<?php echo $patdata['PATIENT_MR_ID'] ; ?>" hidden readonly>
                <input type="text" name="name" value="<?php echo $patdata['PATIENT_NAME'] ; ?>" hidden readonly>
                <input type="text" name="gender" value="<?php echo $patdata['PATIENT_GENDER'] ; ?>" hidden readonly>
                <input type="text" name="type" value="<?php echo $patdata['PATIENT_TYPE'] ; ?>" hidden readonly>
                <?php if ($patdata['PATIENT_TYPE'] == 'indoor') { ?>
                <input type="text" name="cnic" value="<?php echo $patdata['PATIENT_CNIC'] ; ?>" hidden readonly>
                <?php } ?>
                <input type="text" name="doctor" value="<?php echo $patdata['DOCTOR_NAME'] ; ?>" hidden readonly>
              
                <!-- Date and time -->
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-6">
                    <label>Admission Date | Time</label>
                      <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" name="admissionTime" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Discharge Date | Time</label>
                      <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                        <input type="text" name="dischargeTime" class="form-control datetimepicker-input" data-target="#reservationdatetime2"/>
                        <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
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
                      <input type="number" name="admitDay" onchange="myDayFunction(this)" id="day" placeholder="Admit Day" class="form-control"/>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Discount</label>
                      <input type="number" name="discount" class="form-control" onchange="myChangeFunction(this)" id="discount" placeholder="Discount">
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
              // let days = document.getElementById('admitDay').value;
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

          </script>
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