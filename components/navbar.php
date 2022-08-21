<style>
  .bill-button {
    background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
  }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <!------*********------>
      <!------Home Icon------>
      <!------*********------> 

      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">
          <i class="fas fa-home"></i> Home
        </a>
      </li>

      <!------*****************------>
      <!------Create Slip Icon------>
      <!------*****************------> 

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-plus"></i> Slip
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_patient_slip.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Slip
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="indoor_patient_slip.php" class="dropdown-item"> -->
          <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-indoor">
            <i class="fas fa-procedures mr-2"></i> Indoor Slip
          </a>
        <div class="dropdown-divider"></div>
          <a href="outdoor_patient_slip.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Outdoor Slip
          </a>
        </div>
       </li>

      <!------*****************------>
      <!------Create Bill Icon------>
      <!------*****************------> 

       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-plus"></i> Bill
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_slip_record.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Bill
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-procedures mr-2"></i> Indoor Bill
          </a>
        </div>
       </li>

      <!------*****************------>
      <!------Indoor Patient Icon------>
      <!------*****************------> 
      <?php if ($_SESSION['type'] == "admin") {  ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="patient_record.php" class="nav-link">
          <i class="fas fa-users"></i> Patients
        </a>
      </li>
      <?php } ?>
      <!------*****************------>
      <!------Patient Slip Icon------>
      <!------*****************------> 

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-wallet"></i> Slip Records
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_slip_record.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Records
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-procedures mr-2"></i> Indoor Records
          </a>
        <div class="dropdown-divider"></div>
          <a href="outdoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Outdoor Records
          </a>
        </div>
       </li>

      <!------*****************------>
      <!------Patient Bill Icon------>
      <!------*****************------> 

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-wallet"></i> Bill Records
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_bill_record.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Records
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_bill_record.php" class="dropdown-item">
            <i class="fas fa-procedures mr-2"></i> Indoor Records
          </a>
        <div class="dropdown-divider"></div>
          <a href="outdoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Outdoor Records
          </a>
        </div>
       </li>
     
    </ul> 

    <!------******************------>
    <!------Right Navbar Links------>
    <!------******************------> 

    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="javascript:void(0);" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <?php
        // if ($_SESSION['type'] == "admin") { 
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" onClick="getRequestNotification();" href="javascript:void(0);">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">&nbsp;</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificationId">
        </div>
      </li>
      <?php
        // }
      ?>
      <!-- ./Profile Box -->
      <li class="nav-item dropdown user-menu">
        <?php
         if (isset($_SESSION['userid'])) { 
          echo '<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/avatar.png" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">'.$_SESSION['name'].'</span>';
            }else{
              echo '<a href="profile.php" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar.png" class="user-image img-circle elevation-2" alt="User Image">
              <span class="d-none d-md-inline">Mobeen Shah</span>';
            } 
        ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
          <?php if (isset($_SESSION['userid'])) {

            echo '<img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            <p>'.$_SESSION['fullname'].'
              <small>Member since '.$_SESSION['savetime'].'</small>
            </p>';
            }
            ?>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
           <?php if (isset($_SESSION['userid'])) echo '<a href="view_user.php?id='.$_SESSION['userid'].'" class="btn btn-default btn-flat">Profile</a>'; ?>
            <button type="button" class="btn btn-default btn-flat float-right" data-toggle="modal" data-target="#modal-sm">Logout</button>
          </li>
        </ul>
      </li>
      <!--./Setting Box -->
      <?php if (isset($_SESSION['userid']) && $_SESSION['type'] == "admin") {  ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
          <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Settings</span>
          <div class="dropdown-divider"></div>
          <a href="doctors.php" class="dropdown-item">
            Medeast Doctors <span class="float-right text-muted text-sm"><i class="fas fa-user-md"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="visiting-doctors.php" class="dropdown-item">
            Visitor Doctors <span class="float-right text-muted text-sm"><i class="fas fa-user-md"></i></span>
          </a>
          <div class="dropdown-divider"></div>  
          <a href="dept.php" class="dropdown-item">
            Departments <span class="float-right text-muted text-sm"><i class="fas fa-building"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="room.php" class="dropdown-item">
             Rooms <span class="float-right text-muted text-sm"><i class="fas fa-procedures"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="users.php" class="dropdown-item">
             Users <span class="float-right text-muted text-sm"><i class="fas fa-users"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="add_user.php?id=<?php echo $_SESSION['userid']; ?>" class="dropdown-item">
             Edit Profile <span class="float-right text-muted text-sm"><i class="fas fa-user-edit"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="change_password.php" class="dropdown-item">
             Change Password <span class="float-right text-muted text-sm"><i class="fas fa-unlock-alt"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-sm">
             Logout <span class="float-right text-muted text-sm"><i class="fas fa-sign-out-alt"></i></span>
          </a>                
        </div>
      </li>
      <?php } ?> 
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!------*******************------>
  <!------Choose Patient Type------>
  <!------*******************------> 

  <div class="modal fade" id="modal-indoor">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Choose Indoor Patient Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="indoor_patient_slip.php">
            <div class="modal-body">
                  <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
                  <?php
                      $indoorType = 'SELECT `TYPE_ALAIS`, `TYPE_NAME` FROM `indoor_type` WHERE `TYPE_STATUS` = "1"';
                      $result = mysqli_query($db, $indoorType) or die (mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                          $id = $row['TYPE_ALAIS'];  
                          $name = $row['TYPE_NAME'];
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
        </div>
      </div>

      
    <!-- **
    *
    *  Logout Popup Model
    *
    ** -->

  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm To Logout</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you Sure? You want to Logout&hellip;</p>
          <p>Or click <b>Cancel</b> to continue &hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <a type="submit" href="logout.php" class="btn btn-danger">Log Out</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<!-- **
*  View Request Model Popup Here 
** -->
<div class="modal fade" id="view-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true" onclick="setPopModel();">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post" id="VIEW-OPD-SLIP">
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr style="font-size: 12px;">
              <th>Title</th>
              <th>Comment</th>
              <th>Reference</th>
              <th>Request By</th>
              <?php if ($_SESSION['type'] == "admin") { ?>
              <th>  Options-  </th>
              <?php } ?>
            </tr>
            </thead>
            <tbody id="requestBody"></tbody>
          </table>
          <?php if (isset($_SESSION['userid']) && $_SESSION['type'] == "admin") {  ?>
          <div id="editBody">
          </div>
          <?php } ?>
        </div>
        <?php if (isset($_SESSION['userid']) && $_SESSION['type'] == "admin") {  ?>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="setPopModel();">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary" id="updateRecord" onclick="updateRqRecord();">Save</button>
        </div>
        <?php } ?>
      </form>
    </div>
  </div>
</div>
<script>
  let recordType,requestId, requestStatus;
  // Send Update Record of request Date
  function updateRqRecord() {
    let type, dept, doctor, fee, procedure;
    let slipId = document.getElementById('slipId').value;

    if (recordType == 'outdoor') {
      type = document.getElementById('docType').value;
      fee = document.getElementById('fee').value;
      if (type == 0) {
        dept = document.getElementById('meDept').value;
        doctor = document.getElementById('meDoctor').value;
      }else if (type == 1) {
        dept = document.getElementById('vtDept').value;
        doctor = document.getElementById('vtDoctor').value;
      }
    }else if (recordType == 'indoor') {
      type = document.getElementById('indoorType').value;
      dept = document.getElementById('dept').value;
      doctor = document.getElementById('doctor').value;
      procedure = document.getElementById('procedure').value;
    }else if (recordType == 'emergency') {
      doctor = document.getElementById('doctor').value;
    }
        
    let values = {
      'name': document.getElementById('name').value,
      'fee': fee ? fee : null,
      'procedure': procedure ? procedure : null,
      'table': recordType,
      'type': type ? type : null,
      'dept': dept ? dept : null,
      'doctor': doctor
    };
    //name required
    let rname = $("input#name").val();
    if(rname == "" || dept == "" || doctor == ""){
        $("#err-msg").fadeIn().text("Fields can't be empty.");
        $("input#name").focus();
        return false;
    }
    // ajax
    $.ajax({
        type:"POST",
        url: `backend_components/ajax_handler.php?q=upRqRecord&id=${slipId}`,
        data: values, // get all form field value in serialize form
        success: function(){   
        updateRequestStatus(requestId, requestStatus);
          $(function() {
              var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });
              Toast.fire({
                icon: 'success',
                title: 'Request Has be updated Successfully.'
              })
          });
          autoRefresh();
        }
    });
  }
  // Update Request Status
  function updateRequestStatus(id,status){
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        // console.log("Request Status updated: ",this.responseText);
      }else { 
        // console.log("There is an error in updating the visiting doctor record."); 
      }
    }
    xmlhttp.open("GET",`backend_components/ajax_handler.php?q=upRqStatus&val=${status}&id=${id}`,true);
    xmlhttp.send();
  }
  // Reset Model Data
  function setPopModel() {
    document.getElementById("editBody").innerHTML= "";
  }
  // Get Request Data
  function getRequestNotification(){
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("notificationId").innerHTML=this.responseText;
        // console.log("Response From Request: ", this.responseText);
      }
    }
    xmlhttp.open("GET","backend_components/ajax_handler.php?q=GET-ALL-REQUEST",true);
    xmlhttp.send();
  }
  
  // Get Request Data against slip Id
  function getRequest(str){
      if (str=="") {return;}
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("requestBody").innerHTML=this.responseText;
            // console.log("Response From Slip Request: ", this.responseText);
          }
        }
      xmlhttp.open("GET","backend_components/ajax_handler.php?q=VIEW-REQUEST-BY-ID&id="+str,true);
      xmlhttp.send();
  }

  // Get Request Data Record
  function openRequestedRecord(str) {
    let elem = document.getElementById("view-record");
    recordType = elem.getAttribute("data-type"); 
    requestId = elem.getAttribute("data-id");
    requestStatus = elem.getAttribute("data-status");
    if (str=="") {return;}
        let xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("editBody").innerHTML=this.responseText;
            // console.log("Response From Request Record: ", this.responseText);
          }
        }
      xmlhttp.open("GET","backend_components/ajax_handler.php?q=VIEW-REQUEST-RECORD&id="+str+"&val="+recordType,true);
      xmlhttp.send();
  }
  // Delete Record and update request status
  function deleteRequestRecord(str) {
    let elem = document.getElementById("deleteRecord");
    recordType = elem.getAttribute("data-name"); 
    let recordId = elem.getAttribute("data-id");
    let val = confirm('Please confirm deletion');
      if (val === true) {
        if (str=="") {return;}
          let xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              $(function() {
                  var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    icon: 'success',
                    title: 'Requested Record Deleted Successfully.'
                  })
              });
              autoRefresh();
            }
          }
        xmlhttp.open("GET","backend_components/ajax_handler.php?q=REMOVE-REQUEST-RECORD&id="+str+"&rid="+recordId+"&val="+recordType,true);
        xmlhttp.send();
      }else {
        // Do whatever if the user clicks cancel.
        return;
      }
  }

  // Cancel Request
  function cancelRequest(str){
    let val = confirm('Please confirm deletion');
      if (val === true) {
        if (str=="") {return;}
        // Do whatever if the user clicked ok.
        let xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            $(function() {
                var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });
                Toast.fire({
                  icon: 'success',
                  title: 'Request Cancelled Successfully.'
                })
            });
            autoRefresh();
          }
        }
        xmlhttp.open("GET","backend_components/ajax_handler.php?q=cancelRqStatus&id="+str,true);
        xmlhttp.send();
      } else {
        // Do whatever if the user clicks cancel.
        return;
      }
  }
    // Switch Doctor List 
    function switchDocList(e) { 
    let meDoctor = document.getElementById("meDoc");
    let vtDoctor = document.getElementById("vtDoc"); 
    let selDoctor = document.getElementById("doctor");
    let selDept = document.getElementById("dept");
    let selvDoctor = document.getElementById("visitDoctor");
    let selvDept = document.getElementById("visitDept");

    if (e == 0) {
      meDoctor.style.display = "flex"; 
      vtDoctor.style.display = "none"; 
      selDoctor.required = true; 
      selDept.required = true;

      selvDoctor.required = false; 
      selvDept.required = false;
    }
    if (e == 1) {
      meDoctor.style.display = "none"; 
      vtDoctor.style.display = "flex"; 
      selvDoctor.required = true; 
      selvDept.required = true;

      selDoctor.required = false; 
      selDept.required = false;
    }
  }
  // Dept Change Request for Regular Doctor
  function showDoctor(str) {
    if (str=="") {return;}
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("doctor").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET","getDoctor.php?q="+str,true);
    xmlhttp.send();
  }
  // Update Request for visiting Doctor 
  function updateDoctor() {
    let visitId = document.getElementById("visitDoctor");
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        visitId.innerHTML=this.responseText;
      }
      // else { 
      //   console.log("There is an error in updating the visiting doctor record."); 
      // }
    }
    xmlhttp.open("GET","getDoctor.php?q=0",true);
    xmlhttp.send();
  }
  // Show add Visitor Doctor Field
  function showFields() {
    let showVtField = document.getElementById("showVisitField");
    if (showVtField.style.display === "none") {
      showVtField.style.display = "block";
    } else {
      showVtField.style.display = "none";
    }
  }
  // Ajax Call for Adding New Visiting Doctor 
  function saveVtDoctor() {
    let values = {
          'docName': document.getElementById('docName').value,
          'userId': document.getElementById('userId').value
        };
        //name required
        let dname = $("input#docName").val();
        if(dname == ""){
            $("#err-msg").fadeIn().text("Doctor Name required.");
            $("input#docName").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/ajax_handler.php?q=adVtDoc",
            data: values, // get all form field value in serialize form
            success: function(){   
            updateDoctor();
              $(function() {
                  var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    icon: 'success',
                    title: 'New Visitor Doctor Successfully Saved.'
                  })
              });
            }
        });
  }
  function autoRefresh(){
    setTimeout(() => {
      window.location = window.location.href;
    }, 1000);    
  }
</script>