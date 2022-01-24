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
                    <th>Degree</th>
                    <th>Alais</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `education`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr>
                        <td>$rs[EDUCATION_ID]</td>
                        <td>$rs[EDUCATION_NAME]</td>
                        <td>$rs[EDUCATION_ALAIS]</td>
                        <td>$rs[EDUCATION_STATUS]</td>
                        <td>$rs[EDUCATION_DATE_TIME]</td>
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