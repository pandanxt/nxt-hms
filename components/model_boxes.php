<!-- Generate Edit Request Model Popup Here -->
<div class="modal fade" id="generate-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="ADD_REQUEST">
        <div class="modal-body">
          <div class="form-group">
            <label>Title</label>
            <select class="form-control select2bs4" name="title" id="title" style="width: 100%;">
              <option disabled selected>Select Title</option>
              <option value="cancel">Cancel Slip</option>
              <option value="update">Update Slip</option> 
            </select>
          </div>
          <div class="form-group">
            <label>Comment</label>
            <textarea type="text" name="comment" class="form-control" id="comment" placeholder="Enter Reason of Request ..." required></textarea>
          </div>
          <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
          <input type="text" name="reqId" id="reqId" hidden readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- View Request Model Popup Here -->
<!-- <div class="modal fade" id="view-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post" id="VIEW_REQUEST">
        <div class="modal-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr style="font-size: 14px;">
              <th>Title</th>
              <th>Comment</th>
              <th>Status</th>
              <th>Created</th>
              <th>Option</th>
            </tr>
            </thead>
            <tbody id="body"></tbody>
            </table>
        </div>
      </form>
    </div>
  </div>
</div> -->
  
<!-- Edit Request Model Popup Here -->
<div class="modal fade" id="edit-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="EDIT_REQUEST">
      </form>
    </div>
  </div>
</div>

<!--  View Request Model Popup With User And Admin Access -->
<div class="modal fade" id="view-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true" onclick="setPopModel();">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post" id="VIEW_REQUEST">
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr style="font-size: 12px;">
              <th>Title</th>
              <th>Comment</th>
              <th>Type</th>
              <th>Request By</th>
              <?php if ($_SESSION['role'] == "admin") { ?>
              <th>  Options-  </th>
              <?php } ?>
            </tr>
            </thead>
            <tbody id="requestBody"></tbody>
          </table>
          <?php if (isset($_SESSION['uuid']) && $_SESSION['role'] == "admin") {  ?>
          <div id="editBody">
          </div>
          <?php } ?>
        </div>
        <?php if (isset($_SESSION['uuid']) && $_SESSION['role'] == "admin") {  ?>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="setPopModel();">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary" id="updateRecord" onclick="updateRqRecord();">Save</button>
        </div>
        <?php } ?>
      </form>
    </div>
  </div>
</div>

<!-- Select Slip Type Model -->
<div class="modal fade" id="modal-slip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Slip Type</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="add_slip.php">
        <div class="modal-body">
          <select class="form-control select2bs4" name="type" id="type" style="width: 100%;" required>
            <option value="" selected disabled>Select Slip Type</option>
            <option value="OUTDOOR">OUTDOOR PATIENT SLIP</option>
            <option value="INDOOR">INDOOR PATIENT SLIP</option>
            <option value="EMERGENCY">EMERGENCY PATIENT SLIP</option>      
          </select>
          <div id="select">
            <br>
            <select class="form-control select2bs4" name="subType" id="subType" style="width: 100%;">
              <option value="" selected disabled>Select Indoor Type</option>
              <option value="GYNEACOLOGY_PATIENT">GYNEACOLOGY PATIENT</option>
              <option value="GENERAL_SURGERY_PATIENT">GENERAL SURGERY PATIENT</option>
              <option value="GENERAL_ILLNESS_PATIENT">GENERAL ILLNESS PATIENT</option>
              <option value="EYE_PATIENT">EYE PATIENT</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Log Out Popup Model -->
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
  </div>
</div>