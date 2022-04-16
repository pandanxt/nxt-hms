<?php 
  session_start(); 
  if (isset($_SESSION['userid'])) {

    include('backend_components/connection.php');
    include('components/form_header.php');
    include('components/navbar.php'); 
    include('components/sidebar.php');

    if (isset($_POST['user-submit'])) {
      $status =  $_POST['status'];
      $loginId = $_POST['loginId'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $permission =  $_POST['permission'];
      $by = $_POST['by'];


          $sql = "SELECT * FROM `admin` WHERE `ADMIN_USERNAME` = ?";
          $stmt = mysqli_stmt_init($db);
          
          if (!mysqli_stmt_prepare($stmt,$sql)) {
              // header("Location: ../add_user.php?action=sqlerror");
              echo '<script type="text/javascript">window.location = "add_user.php?action=sqlerror";</script>';
              exit();
          }else{
              mysqli_stmt_bind_param($stmt,"s",$loginId);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              $resultCheck = mysqli_stmt_num_rows($stmt);
                  
                  if ($resultCheck > 0) {
                      // header("Location: ../add_user.php?action=nameTaken");
                      echo '<script type="text/javascript">window.location = "add_user.php?action=nameTaken";</script>';
                      exit();
                      }else{
                              $sql = "INSERT INTO `admin`(`ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `CREATED_BY`, `ADMIN_SAVE_TIME`) VALUES (?,?,?,?,?,?,?,?)";
                              mysqli_stmt_execute($stmt);
                          
                              if (!mysqli_stmt_prepare($stmt,$sql)) {
                                  // header("Location: ../add_user.php?action=sqlerror");
                                  echo '<script type="text/javascript">window.location = "add_user.php?action=sqlerror";</script>';
                                  exit();
                              }else{
                                  mysqli_stmt_bind_param($stmt,"ssssssss",$name,$permission,$email,$loginId,$password,$status,$by,$saveOn);
                                  mysqli_stmt_execute($stmt);
                              
                                  echo '<script type="text/javascript">window.location = "add_user.php?action=saved";</script>';								
                                  exit();
                              }			
                      }
              }
      mysqli_stmt_close($stmt);
      mysqli_close($db);
  }

   if (empty($_GET['id'])) {
    // include('components/user_form.php'); 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
            <!-- <h1>Create New User</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create New User</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-users"></i> MedEast User</h3>

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
                  <label>Full Name</label>
                  <input type="text" class="form-control" name="name" id="inputText1" placeholder="Enter Full Name Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Login ID</label>
                  <input type="text" class="form-control" name="loginId" id="inputLoginId1" placeholder="Enter Login ID Here ..." required>
                </div>
                <!-- /.form-group -->
                 <!-- /.form-group -->
                 <div class="form-group">
                  <label>User Status</label>
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
                  <label>Email Address</label>
                  <input type="email" class="form-control" name="email" id="inputEmail1" placeholder="Enter Valid Email Here ..." pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>User Password</label>
                  <input type="password" class="form-control" name="password" id="inputPassword1" placeholder="Enter Password Here ..." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Permissions</label>
                  <select class="form-control select2bs4" name="permission" style="width: 100%;">
                    <option selected="selected" value="admin">Admin</option>
                    <option value="user">Sub-Admin</option>
                  </select>
                  <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="user-submit" class="btn btn-block btn-primary">Submit</button>
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
    include('backend_components/update_user.php');
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