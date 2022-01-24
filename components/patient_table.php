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
                    <th>CNIC</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Doctor</th>
                    <!-- <th>Patient Bill</th> -->
                    <th>Admission</th>
                    <th>Discharge</th>
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
                  
                        echo "<tr>
                        <td>$rs[PATIENT_ID]</td>
                        <td>$rs[PATIENT_MR_ID]</td>
                        <td>$rs[PATIENT_NAME]</td>
                        <td>$rs[PATIENT_TYPE]</td>
                        <td>$rs[PATIENT_MOBILE]</td>
                        <td>$rs[PATIENT_CNIC]</td>
                        <td>$rs[PATIENT_GENDER]</td>
                        <td>$rs[PATIENT_AGE]</td>
                        <td>$rs[PATIENT_ADDRESS]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[ADMISSION_DATE_TIME]</td> 
                        <td>$rs[DISCHARGE_DATE_TIME]</td>
                        <td></td>
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