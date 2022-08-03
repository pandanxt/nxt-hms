<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['userid'])) {
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
          <div class="col-sm-2">
              <a href="javascript:void(0);" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#visitor-doctor">
                <i class="fas fa-plus"></i> VISITOR DOCTOR</a>
            </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visitor Doctor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Doctor Table Data -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr style='font-size: 14px;'>
                  <th>S.No#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql ="SELECT *,`ADMIN_USERNAME` FROM `visitor_doctor` INNER JOIN `admin` WHERE `visitor_doctor`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                    $qsql = mysqli_query($db,$sql);
                    while($rs = mysqli_fetch_array($qsql))
                    { 
                    $date = substr($rs['VISITOR_DATE_TIME'],0, 21);
                    echo "<tr style='font-size: 12px;'>
                    <td>$rs[VISITOR_ID]</td>
                    <td>$rs[VISITOR_NAME]</td>
                    <td>$rs[VISITOR_STATUS]</td>
                    <td><b>By</b>: $rs[ADMIN_USERNAME] <br><b>On</b>: ".$date."</td>
                    <td>
                        <a href='view_room.php?id=$rs[VISITOR_ID]' style='color:green;'><i class='fas fa-info-circle'></i> Details</a><br>
                        <a href='add_room.php?id=$rs[VISITOR_ID]'><i class='fas fa-edit'></i> Edit</a><br>
                        <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?roomId=$rs[VISITOR_ID]' style='color:red;'><i class='fas fa-trash'></i> Delete</a>
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
    <!-- /.content -->
  </div>
  <!-- /.Footer -->
    <!-- **
    *  Outdoor Visitor Doctor Model Popup Here 
    ** -->
    <div class="modal fade" id="visitor-doctor">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Visitor Doctor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <span id="err-msg" style="display: none"></span>
          <form action="javascript:void(0)" method="post" id="visitorDoctor">
          <div class="modal-body">
                <div class="form-group">
                  <label>Doctor Name</label>
                  <input type="text" class="form-control" name="docName" id="docName" placeholder="Enter Doctor Name ..." required>
                </div>
                <input type="text" name="userId" id="userId" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- **
  *  Outdoor Visitor Doctor Model Popup Ends Here 
  ** -->
<script type="text/javascript">
// Ajax Call for Adding New Visiting Doctor 
$(document).ready(function($){
  // on submit...
  $('#visitorDoctor').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      //name required
      var dname = $("input#docName").val();
      if(dname == ""){
          $("#err-msg").fadeIn().text("Doctor Name required.");
          $("input#docName").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: "backend_components/ajax_handler.php",
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
                  title: 'New Visitor Doctor Successfully Saved.'
                });
                autoRefresh();
            });
          }
      });
  });  
  return false;
});

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
  // Table Script File
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>