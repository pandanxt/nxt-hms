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
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `education`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        $date = substr($rs['EDUCATION_DATE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[EDUCATION_ID]</td>
                        <td>$rs[EDUCATION_NAME]</td>
                        <td>$rs[EDUCATION_ALAIS]</td>
                        <td>$rs[EDUCATION_STATUS]</td>
                        <td>$date</td>
                        <td style='display:flex;'>
                        <a href='view_education.php?id=$rs[EDUCATION_ID]' style='color:green;'>
                          <i class='fas fa-info-circle'></i> Details
                        </a><br>
                        <a href='add_education.php?id=$rs[EDUCATION_ID]'>
                          <i class='fas fa-edit'></i> Edit
                        </a><br>
                        <a href='backend_components/delete_handler.php?eduId=$rs[EDUCATION_ID]' style='color:red;'>
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