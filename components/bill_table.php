<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Serial No#</th>
                    <th>MRID</th>
                    <th>Mobile</th>
                    <th>CNIC</th>
                    <th>Discharge Date | Time</th>
                    <th>Bill Date | Time</th>
                    <th>Bill Services</th>
                    <th>Bill Total Amount</th>
                    <th>Bill Discount</th>
                    <th>Bill Final Total</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `patient_bill`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr>
                        <td>$rs[BILL_ID]</td>
                        <td>$rs[PATIENT_MR_ID]</td>
                        <td>$rs[PATIENT_MOBILE]</td>
                        <td>$rs[PATIENT_CNIC]</td>
                        <td>$rs[DISCHARGE_DATE_TIME]</td>
                        <td>$rs[BILL_DATE_TIME]</td>
                        <td>$rs[BILL_SERVICE_ID]</td>
                        <td>$rs[BILL_TOTAL_AMOUNT]</td>
                        <td>$rs[BILL_DISCOUNT]</td>
                        <td>$rs[BILL_FINAL_TOTAL]</td>
                        <td style='display:flex;'>
                            <a href='view_bill.php?id=$rs[BILL_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='backend_components/update_handler.php?id=$rs[BILL_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='backend_components/delete_handler.php?id=$rs[BILL_ID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
                        </tr>"; 
                        
                        // if(isset($_SESSION[adminid]))
                        // {
                        //       echo "<a href='patient.php?editid=$rs[patientid]'>Edit</a> | <a href='viewpatient.php?delid=$rs[patientid]'>Delete</a> <hr>
                        // <a href='patientreport.php?patientid=$rs[patientid]'>View Report</a>";
                        // }
                          
                      }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>