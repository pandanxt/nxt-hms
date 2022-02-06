<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No#</th>
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Mobile</th>
                    <!-- <th>CNIC</th> -->
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Doctor</th>
                    <!-- <th>Patient Bill</th> -->
                    <th>Created</th>
                    <!-- <th>Discharge</th> -->
                    <!-- <th>User Name</th> -->
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`DOCTOR_NAME` FROM `patient` INNER JOIN `doctor` WHERE `patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                       $date = substr($rs['PATIENT_DATE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[PATIENT_ID]
                           <br> <a href='add_bill.php?id=$rs[PATIENT_ID]' style='color:green;'>
                              <i class='fas fa-wallet'></i> Bill
                            </a>
                        </td>
                        <td>$rs[PATIENT_MR_ID]</td>
                        <td>$rs[PATIENT_NAME]</td>
                        <td>$rs[PATIENT_TYPE]</td>
                        <td>$rs[PATIENT_MOBILE]</td>
                        <td>$rs[PATIENT_GENDER]</td>
                        <td>$rs[PATIENT_AGE]</td>
                        <td>$rs[PATIENT_ADDRESS]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$date</td> 
                        <td style='display:flex;'>
                            <a href='view_patient.php?id=$rs[PATIENT_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_patient.php?id=$rs[PATIENT_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='backend_components/delete_handler.php?patId=$rs[PATIENT_ID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
                        </tr>"; 
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