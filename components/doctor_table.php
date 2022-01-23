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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Education</th>
                    <th>Experience</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `doctor`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr>
                        <td>$rs[DOCTOR_ID]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[DOCTOR_MOBILE]</td>
                        <td>$rs[DOCTOR_EDUCATION]</td>
                        <td>$rs[DOCTOR_EXPERIENCE]</td>
                        <td>$rs[DOCTOR_STATUS]</td>
                        <td>$rs[DOCTOR_SAVE_TIME]</td>
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
                  <tfoot>
                  <tr>
                    <th>S.No#</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Education</th>
                    <th>Experience</th>
                    <th>Created at</th>
                    <th>Status</th>
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