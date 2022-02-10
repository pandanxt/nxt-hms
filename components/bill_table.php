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
                    <th>Patient Name</th>
                    <th>Mobile</th>
                    <th>Date</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`PATIENT_NAME` FROM `bill_record` INNER JOIN `patient` WHERE `bill_record`.`MR_ID` = `patient`.`PATIENT_MR_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['BILL_DATE'],0, 21);
                        echo "<tr>
                        <td>$rs[BILL_ID]</td>
                        <td>$rs[MR_ID]</td>
                        <td>$rs[PATIENT_NAME]</td>
                        <td>$rs[MOBILE]</td>
                        <td>$rs[BILL_DATE]</td>
                        <td>$rs[DISCOUNT]</td>
                        <td>$rs[TOTAL]</td>
                        <td style='display:flex;'>
                            <a href='view_bill.php?id=$rs[BILL_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='backend_components/delete_handler.php?billId=$rs[BILL_ID]' style='color:red;'>
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