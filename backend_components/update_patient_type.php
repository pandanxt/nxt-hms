<?php
    $sql="SELECT * FROM `patient_type` WHERE `PATIENT_TYPE_ID` = '$_GET[id]' ";
    $qsql = mysqli_query($db,$sql);
    $rsedit = mysqli_fetch_array($qsql);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Patient Type</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Patient Type</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-building"></i> MedEast Patient Type</h3>

            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="backend_components/update_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Patient Type</label>
                  <input type="text" name="name" class="form-control" id="inputText1" value="<?php echo $rsedit['PATIENT_TYPE_NAME']; ?>" required>
                </div>
                <!-- /.form-group -->
               <div class="form-group">
                  <label>Type Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;">
                    <option selected="selected" value="active">Active</option>
                    <option value="unactive">Unactive</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="ptid" value="<?php echo $rsedit['PATIENT_TYPE_ID']; ?>" hidden/>
              <!-- <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script> -->
              <div class="form-group">
                  <label>Type Alais</label>
                  <input type="text" name="alais" value="<?php echo $rsedit['PATIENT_TYPE_ALAIS']; ?>" class="form-control" id="inputText2"  required>
                </div> 
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit"name="update-patient-type-submit" class="btn btn-block btn-primary">Update</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  