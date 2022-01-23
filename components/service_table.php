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
                        echo "<tr>
                        <td>$rs[BILL_SERVICE_ID]</td>
                        <td>$rs[BILL_SERVICE_NAME]</td>
                        <td>$rs[BILL_SERVICE_AMOUNT]</td>
                        <td>$rs[SERVICE_STATUS]</td>
                        <td>$rs[SERVICE_SAVE_TIME]</td>
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
                    <th>Service</th>
                    <th>Charges</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Option</th>
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