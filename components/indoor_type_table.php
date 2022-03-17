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
                    <th>Alais</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Created By</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `indoor_type` INNER JOIN `admin` WHERE `indoor_type`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['TYPE_SAVE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[TYPE_ID]</td>
                        <td>$rs[TYPE_NAME]</td>
                        <td>$rs[TYPE_ALAIS]</td>
                        <td>$rs[TYPE_STATUS]</td>
                        <td>$date</td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td style='display:flex;'>
                            <a href='view_indoor_type.php?id=$rs[TYPE_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_indoor_type.php?id=$rs[TYPE_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?patTypeId=$rs[TYPE_ID]' style='color:red;'>
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