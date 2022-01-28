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
                    <th>Full Name</th>
                    <th>Permissions</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `admin`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        $date = substr($rs['ADMIN_SAVE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[ADMIN_ID]</td>
                        <td>$rs[ADMIN_NAME]</td>
                        <td>$rs[ADMIN_TYPE]</td>
                        <td>$rs[ADMIN_EMAIL]</td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td>$rs[ADMIN_PASSWORD]</td>
                        <td>$rs[ADMIN_STATUS]</td>
                        <td>$date</td>
                        <td style='display:flex;'>
                            <a href='view_user.php?id=$rs[ADMIN_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='backend_components/update_handler.php?id=$rs[ADMIN_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='backend_components/delete_handler.php?id=$rs[ADMIN_ID]' style='color:red;'>
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