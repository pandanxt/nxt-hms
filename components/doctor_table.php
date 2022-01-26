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
                      $sql ="SELECT *,`DEPARTMENT_NAME` FROM `doctor` INNER JOIN `department` WHERE `doctor`.`DEPARTMENT_ID` = `department`.`DEPARTMENT_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr>
                        <td>$rs[DOCTOR_ID]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[DOCTOR_MOBILE]</td>
                        <td>$rs[DEPARTMENT_NAME]</td>
                        <td>$rs[DOCTOR_EDUCATION]</td>
                        <td>$rs[DOCTOR_EXPERIENCE]</td>
                        <td>$rs[DOCTOR_STATUS]</td>
                        <td>$rs[DOCTOR_SAVE_TIME]</td>
                        <td style='display:flex;'>
                            <a href='view_doctor.php?id=$rs[DOCTOR_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='backend_components/update_handler.php?id=$rs[DOCTOR_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='backend_components/delete_handler.php?id=$rs[DOCTOR_ID]' style='color:red;'>
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