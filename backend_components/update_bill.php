<?php
      $sql="SELECT *, `DOCTOR_NAME`, `PATIENT_ADMISSION_DATE_TIME` 
            FROM `patient` 
            INNER JOIN `doctor` 
            INNER JOIN `patient_record` 
            WHERE 
            `PATIENT_ID` = " .$_GET['id']. " AND 
            `patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND 
            `patient`.`PATIENT_MR_ID` = `patient_record`.`PATIENT_MR_ID`";
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
                    echo ' <input style="" type="checkbox" value="'.$id.'" data-amount="'.$amount.'" name="service[]" id="checkboxPrimary'.$id.'" onchange="addPrice(this)">';
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
                    <input type="text" name="admissionTime" value="<?php echo $patdata['PATIENT_ADMISSION_DATE_TIME'] ; ?>" id="admissionTime" class="form-control"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Discharge Date | Time</label>
                    <input type="text" name="dischargeTime" id="dischargeTime" class="form-control"/>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-6">
                      <label>Admit Days</label>
                      <input type="text" name="admitDay" id="admitDay" class="form-control"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Discount</label>
                    <input type="number" name="discount" class="form-control" onchange="myChangeFunction(this)" id="discount" placeholder="Enter Discount Here ...">
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-6">
                        <label>Service Charges</label>
                        <input type="number" class="form-control" name="totalBill" id="totalBill" placeholder="Enter Total Amount of Bill " readonly/>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Final Bill</label>
                        <input type="number" name="finalBill" class="form-control" id="finalBill" placeholder="Total Value Shows here ..." readonly>
                      </div>
                </div>
                
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <script>
            let sum = 0;
            let addPrice = (elem) => {
            let value = parseFloat(elem.getAttribute("data-amount").replace(/\$|,/g, ''), 2);
            elem.checked ? (sum += value) : (sum -= value);
            let days = document.getElementById('admitDay').value;
            if(days==0){
              var totalPrice = sum;
              console.log(totalPrice);
            }else{
              var totalPrice = sum*days;
              console.log(totalPrice);
            }
            
            document.getElementById('totalBill').value = totalPrice;
            console.log(sum);
            };
            
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

<script type = "text/javascript" >
  var date2 = new Date();
  var date1 = new Date("<?php echo $patdata['PATIENT_DATE_TIME'] ; ?>");
  document.getElementById('dischargeTime').value = date2;
  // console.log(x);
  var Difference_In_Time = date2.getTime() - date1.getTime();
  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
  Difference_In_Days = Math.round(Difference_In_Days);
  document.getElementById('admitDay').value = Difference_In_Days;
  console.log(Difference_In_Days);
</script>