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
                    <th>Mobile</th>
                    <!-- <th>CNIC</th> -->
                    <!-- <th>Discharge Date | Time</th> -->
                    <th>Date</th>
                    <!-- <th>Bill Services</th> -->
                    <!-- <th>Bill Total Amount</th> -->
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `patient_bill`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['BILL_DATE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[BILL_ID]</td>
                        <td>$rs[PATIENT_MR_ID]</td>
                        <td>$rs[PATIENT_MOBILE]</td>
                        <td>$date</td>
                        <td>$rs[BILL_DISCOUNT]</td>
                        <td>$rs[BILL_FINAL_TOTAL]</td>
                        <td style='display:flex;'>
                            <a href='view_bill.php?id=$rs[BILL_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_bill.php?action=edit&id=$rs[BILL_ID]'>
                              <i class='fas fa-edit'></i> Edit
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