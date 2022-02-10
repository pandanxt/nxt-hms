<?php session_start(); ?>
  <!-- Connection -->
  <?php include('backend_components/connection.php'); ?>
  <!-- table-header -->
  <?php include('components/table_header.php'); ?>
   <!-- Navbar -->
   <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
              <i class="fas fa-plus"></i> New Bill
            </button>
          </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Patient Bills</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <?php include('components/bill_table.php'); ?>
    <!-- /.content -->
  </div>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Choose Patient Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="add_bill.php">
              <div class="modal-body">
                    <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
                    <?php
                        $p_type = 'SELECT `PATIENT_TYPE_NAME`, `PATIENT_TYPE_ALAIS` FROM `patient_type` WHERE `PATIENT_TYPE_STATUS` = "active"';
                        $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                            $id = $row['PATIENT_TYPE_ALAIS'];  
                            $name = $row['PATIENT_TYPE_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }
                      ?>
                    </select>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <!-- /.Footer -->
    <?php include ('components/footer.php'); ?>
    <!-- /.Footer -->
  </div>
<!-- ./wrapper -->
<!-- Table Script -->
<?php include('components/table_script.php'); ?>