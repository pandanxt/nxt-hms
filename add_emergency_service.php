<?php session_start(); ?>
 <!-- Header Form -->
  <?php include('backend_components/connection.php'); ?>
  <!-- Header Form -->
  <?php include('components/form_header.php'); ?>

  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->
    <?php
    
    if (isset($_POST['emergency-service'])) {
        $name =  $_POST['name'];
        $amount =  $_POST['amount'];
        $status =  $_POST['status'];
        $date =  $_POST['addDate'];
        $by = $_POST['by'];

            $sql = "SELECT * FROM `emergency_service` WHERE `SERVICE_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                // header("Location: emergency_service.php?action=sqlerror");
                echo '<script type="text/javascript">window.location = "emergency_service.php?action=sqlerror";</script>';
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        // header("Location: emergency_service.php?action=nameTaken");
                        echo '<script type="text/javascript">window.location = "emergency_service.php?action=nameTaken";</script>';
                        exit();
                    }else{
                            $sql = "INSERT INTO `emergency_service` (`SERVICE_NAME`,`SERVICE_AMOUNT`, `SERVICE_STATUS`, `STAFF_ID`, `SERVICE_DATE_TIME`) VALUES (?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                // header("Location: emergency_service.php?action=sqlerror");
                                echo '<script type="text/javascript">window.location = "emergency_service.php?action=sqlerrorInsert";</script>';
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"ssss",$name,$amount,$status,$by,$date);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">window.location = "add_emergency_service.php?action=saved";</script>';								
                                exit();
                            }			
                        }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

    ?>
  <!-- Content Wrapper. Contains page content -->
  <?php 
   if (empty($_GET['id'])) {
  ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
            <!-- <h1>Create New Service</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create New Service</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-hand-holding-medical"></i> MedEast Services</h3>

            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Service Name</label>
                  <input type="text" class="form-control" name="name" id="inputText1" placeholder="Enter Service Name Here ..." required>
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Service Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;">
                    <option selected="selected" value="active">Active</option>
                    <option value="unactive">Unactive</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
              
               <div class="form-group">
                  <label>Service Amount</label>
                  <input type="number" class="form-control" name="amount" id="inputText1" placeholder="Enter Service Amount Here ..." required>
                  <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="emergency-service" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  


   <?php
    }else {
        include('backend_components/update_service.php');
    }
  ?>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include('components/form_script.php'); ?>