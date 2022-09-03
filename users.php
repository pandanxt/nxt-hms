<?php 
  // Session Starts
  session_start();
  if (isset($_SESSION['uuid'])) {
  // Connection File
  include('backend_components/connection.php');
  // Table Header File
  include('components/table_header.php');
  // Navbar File
  include('components/navbar.php');
  // Sidebar File
  include('components/sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <div class="col-sm-2"><a type="submit" class="btn btn-block btn-primary btn-sm" href="add_user.php"><i class="fas fa-plus"></i> New User</a></div> -->
          <div class="col-sm-2">
            <a href="javascript:void(0);" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#add-user">
              <i class="fas fa-plus"></i> NEW USER
            </a>
          </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style='font-size: 14px;'>
                    <th>Full Name</th>
                    <th>Permissions</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT * FROM `me_user`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr style='font-size: 12px;'>
                        <td>
                        <label class='switch'>";
                        if ($rs['USER_STATUS'] == 0) {
                          echo "<input type='checkbox' onchange='handleStatus(this);' data-room='".$rs['USER_UUID']."' value='".$rs['USER_STATUS']."'>";                          
                        }elseif ($rs['USER_STATUS'] == 1) {
                          echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-room='".$rs['USER_UUID']."' value='".$rs['USER_STATUS']."'>";
                        }
                        echo "<span class='slider round'></span>
                        </label>
                        $rs[USER_NAME]</td>
                        <td>$rs[USER_ROLE]</td>
                        <td>$rs[USER_EMAIL]</td>
                        <td>$rs[USER_ID]</td>
                        <td><b>On</b>: $rs[USER_DATE_TIME]</td>
                        <td style='display:flex;'>
                            <a href='view_user.php?id=$rs[USER_UUID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_user.php?id=$rs[USER_UUID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?userId=$rs[USER_UUID]' style='color:red;'>
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
  </div>
  <!-- **
  *  Add User Model Popup Here 
  ** -->
  <div class="modal fade" id="add-user">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action="javascript:void(0)" method="post" id="addUser">
        <div class="modal-body">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter Full Name ..." required>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" name="loginId" id="loginId" placeholder="Enter Unique Login ID ..." required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Enter Valid Email ..." pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Enter Strong Password ..." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Permission</label>
                    <select class="form-control select2bs4" name="userPermission" id="userPermission" style="width: 100%;">
                      <option selected="selected" value="admin">Admin</option>
                      <option value="user">Staff</option>
                    </select>
                  </div>
                </div>
              </div>
              <input type="text" name="userId" id="userId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- **
  *  Add User Model Popup Ends Here 
  ** -->
  <script type="text/javascript">
      // Ajax Call for Adding New Visiting Doctor 
      $(document).ready(function($){
        // on submit...
        $('#addUser').submit(function(e){
            e.preventDefault();
            $("#err-msg").hide();
            //name required
            var name = $("input#userName").val();
            //email required
            var email = $("input#userEmail").val();
            //loginId required
            var loginId = $("input#loginId").val();
            //password required
            var password = $("input#userPassword").val();

            if(name == "" || name == "" || loginId == "" || password == ""){
                $("#err-msg").fadeIn().text("Required Fields.");
                $("input#userName").focus();
                $("input#userEmail").focus();
                $("input#loginId").focus();
                $("input#userPassword").focus();
                return false;
            }
            // ajax
            $.ajax({
                type:"POST",
                url: "backend_components/ajax_handler.php?q=adUser",
                data: $(this).serialize(), // get all form field value in serialize form
                success: function(){   
                let el = document.querySelector("#close-button");
                el.click();
                // updateDoctorList();
                  $(function() {
                      var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                      });
                      Toast.fire({
                        icon: 'success',
                        title: 'New User Successfully Saved.'
                      });
                      autoRefresh();
                  });
                }
            });
        });  
        return false;
      });

      function handleStatus(status) {
        if(status.value !== null && status.value != ''){
          let val;
            if (status.value == 1) { val = 0;} else { val = 1;}
            // ajax
            $.ajax({
              type:"POST",
              url: `backend_components/ajax_handler.php?q=stUser&id=${status.dataset.room}&val=${val}`,
              success: function(){   
                $(function() {
                    var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 1000
                    });
                    Toast.fire({
                      icon: 'success',
                      title: 'MedEast User Status Updated.'
                    });
                });
              }
            });
          return false;
        }else {
            $(function() {
                var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                Toast.fire({
                  icon: 'error',
                  title: 'Something Went Wrong.'
                });
                autoRefresh();
            });
          return false;
        }
      }

      function autoRefresh(){
        setTimeout(() => {
          window.location = window.location.href;
        }, 1000);    
      }
</script>
<?php
  // Footer File
  include ('components/footer.php');
  echo '</div>';
  // Table Script
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>