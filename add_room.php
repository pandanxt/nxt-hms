<?php 
  session_start(); 
  if (isset($_SESSION['userid'])) {

    include('backend_components/connection.php');
    include('components/form_header.php');
    include('components/navbar.php'); 
    include('components/sidebar.php');

      if (isset($_POST['room-submit'])) {
        $status =  $_POST['status'];
        $name =  $_POST['name'];
        $rate =  $_POST['rate'];
        $by = $_POST['by'];
        $date = $_POST['addDate'];
            $sql = "SELECT * FROM `room` WHERE `ROOM_NAME` = ?";
            $stmt = mysqli_stmt_init($db);
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                // header("Location: ../add_dept.php?action=sqlerror");
                echo '<script type="text/javascript">window.location = "add_room.php?action=sqlerror";</script>';
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                    
                    if ($resultCheck > 0) {
                        echo '<script type="text/javascript">window.location = "add_room.php?action=nameTaken";</script>';
                        // header("Location: ../add_dept.php?action=nameTaken");
                        exit();
                    }else{
                            $sql = "INSERT INTO `room`(`ROOM_NAME`, `ROOM_RATE`, `ROOM_STATUS`, `STAFF_ID`, `ROOM_DATE_TIME`) VALUES (?,?,?,?,?)";
                            mysqli_stmt_execute($stmt);
                        
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                // header("Location: ../add_dept.php?action=sqlerror");
                                echo '<script type="text/javascript">window.location = "add_room.php?action=sqlerror";</script>';
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"sssss",$name,$rate,$status,$by,$date);
                                mysqli_stmt_execute($stmt);
                            
                                echo '<script type="text/javascript">window.location = "add_room.php?action=saved";</script>';								
                                exit();
                            }			
                        }
                }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

  if (empty($_GET['id'])) {
?>

      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <!-- <h1>Create New Department</h1> -->
                  <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create New Room</li>
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
                  <h3 class="card-title"><i class="nav-icon fas fa-building"></i> MedEast Rooms</h3>

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
                        <label>Room Name</label>
                        <input type="text" name="name" class="form-control" id="inputText1" placeholder="Enter Room Name Here ..." required>
                      </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Room Status</label>
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
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Room Charges</label>
                        <input type="number" name="rate" class="form-control" id="inputText1" placeholder="Enter Room Charges Here ..." required>
                      </div>
                        <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit"name="room-submit" class="btn btn-block btn-primary">Submit</button>
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
  }else{
      include('backend_components/update_room.php');
  }  
  // Footer File
  include('components/footer.php');
  
  echo '</div>';
  // Form Script File
  include('components/form_script.php'); 

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>