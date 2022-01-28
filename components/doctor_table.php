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
                    <th>Status</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`DEPARTMENT_NAME` FROM `doctor` INNER JOIN `department` WHERE `doctor`.`DEPARTMENT_ID` = `department`.`DEPARTMENT_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['DOCTOR_SAVE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[DOCTOR_ID]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[DOCTOR_MOBILE]</td>
                        <td>$rs[DEPARTMENT_NAME]</td>
                        <td>$rs[DOCTOR_EDUCATION]</td>
                        <td>$rs[DOCTOR_EXPERIENCE]</td>
                        <td>$rs[DOCTOR_STATUS]</td>
                        <td>$date</td>
                        <td style='display:flex;'>
                            <a href='view_doctor.php?id=$rs[DOCTOR_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_doctor.php?id=$rs[DOCTOR_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='backend_components/delete_handler.php?docId=$rs[DOCTOR_ID]' style='color:red;'>
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