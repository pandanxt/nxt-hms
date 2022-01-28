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
                    <th>Service</th>
                    <th>Charges</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `bill_service`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['SERVICE_SAVE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[BILL_SERVICE_ID]</td>
                        <td>$rs[BILL_SERVICE_NAME]</td>
                        <td>$rs[BILL_SERVICE_AMOUNT]</td>
                        <td>$rs[SERVICE_STATUS]</td>
                        <td>$date</td>
                        <td style='display:flex;'>
                            <a href='view_service.php?id=$rs[BILL_SERVICE_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_service.php?id=$rs[BILL_SERVICE_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='backend_components/delete_handler.php?serId=$rs[BILL_SERVICE_ID]' style='color:red;'>
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