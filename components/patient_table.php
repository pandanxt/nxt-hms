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
                    <th>Admission Date | Time</th>
                    <th>Discharge Date | Time</th>
                    <!-- <th>User Name</th> -->
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `patient`";
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
                        <td>$rs[DOCTOR_ID]</td>
                        <td>$rs[ADMISSION_DATE_TIME]</td> 
                        <td>$rs[DISCHARGE_DATE_TIME]</td>
                        </tr>"; 
                        
                        // if(isset($_SESSION[adminid]))
                        // {
                        //       echo "<a href='patient.php?editid=$rs[patientid]'>Edit</a> | <a href='viewpatient.php?delid=$rs[patientid]'>Delete</a> <hr>
                        // <a href='patientreport.php?patientid=$rs[patientid]'>View Report</a>";
                        // }
                          
                      }
                  ?>
                  </tbody>
                  <tfoot>
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
                    <th>Admission Date | Time</th>
                    <th>Discharge Date | Time</th>
                    <!-- <th>User Name</th> -->
                    <th>Options</th>
                  </tr>
                  </tfoot>
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