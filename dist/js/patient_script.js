let data, slipId, serviceName, patient_id, list = 'me';
// Add unique Id for New Slip and visiting doctor
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
let mr_id = today.length = 7 ? `${today.replaceAll('/', '')}${String(uuid).slice(-4)}-MRD` : `${today.replaceAll('/', '')}${String(uuid).slice(-3)}-MRD`;
if (document.getElementById("slipId")) { document.getElementById("slipId").value = `SLP${unique_id}`; }
if (document.getElementById("patId")) { document.getElementById("patId").value = localStorage.getItem('patient_id'); }
if (document.getElementById("patientMrId")) { document.getElementById("patientMrId").value = mr_id; }
if (document.getElementById("name")) { document.getElementById("name").value = localStorage.getItem('patient_name'); }
if (document.getElementById("phone")) { document.getElementById("phone").value = localStorage.getItem('patient_mobile'); }

if (document.getElementById("uuId")) { document.getElementById("uuId").value = `DOC${unique_id}`; }
if (document.getElementById("reqId")) { document.getElementById("reqId").value = `REQ${unique_id}`; }
if (document.getElementById("followId")) { document.getElementById("followId").value = `FOL${unique_id}`; }
if (document.getElementById("serviceId")) { document.getElementById("serviceId").value = `SRS${unique_id}`; }

// Get Slip Id to Assign to slipId Variable
function getPatientId(id) {
  localStorage.setItem('patient_id', id.getAttribute("data-mrid"));
  localStorage.setItem('patient_name', id.getAttribute("data-name"));
  localStorage.setItem('patient_mobile', id.getAttribute("data-mobile"));
}

// Ajax Call for Adding New Slip
$(document).ready(function ($) {
  $('#addPatientSlip').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    let uuid = $("input#slipId").val();
    let patId = $("input#patId").val();
    let staffId = $("input#staffId").val();

    if (uuid == "" || patId == "" || staffId == "") {
      $("#err-msg").fadeIn().text("Required Field.");
      $("input#uuId").focus();
      $("input#mrId").focus();
      $("input#staffId").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: "backend_components/slip_handler.php?q=ADD_PATIENT_SLIP",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {

        //parse json
        res = JSON.parse(res);
        console.log(res);
        $(function () {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: res.status,
            title: res.message
          });
          printSlip(res.data['id'], res.data['type']);
          // autoRefresh();
        });
      }
    });
  });
  return false;
});

// Edit Patient Button Click
function editPatientId(str){
  console.log("clicked Id: ", str.getAttribute("data-mrid"));
  let mrid = str.getAttribute("data-mrid");
  if (mrid == "") { return; }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("editPatientForm").innerHTML = this.responseText;
      console.log("Response From Doctor By Id: ", this.responseText);
    }
  }
  xmlhttp.open("GET", `backend_components/slip_handler.php?q=GET_PATIENT_BY_ID&id=${mrid}`, true);
  xmlhttp.send();
}

// Ajax Call for Editing Patient Query
$(document).ready(function ($) {
  // on submit...
  $('#editPatient').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    //mrid required
    var mrid = $("input#mrid").val();
    //name required
    var name = $("input#name").val();
    //phone required
    var phone = $("input#phone").val();
    //gender required
    var gender = $("input#gender").val();
    //age required
    var age = $("input#age").val();
    //address required
    var address = $("input#address").val();
    //by required
    var by = $("input#by").val();

    if (mrid == "" || name == "" || phone == "" || gender == "" || age == "" || address == "" || by == "") {
      $("#err-msg").fadeIn().text("Required Fields.");
      $("input#mrid").focus();
      $("input#name").focus();
      $("input#phone").focus();
      $("input#gender").focus();
      $("input#age").focus();
      $("input#address").focus();
      $("input#by").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: "backend_components/slip_handler.php?q=EDIT_PATIENT",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {
        //parse json
        res = JSON.parse(res);
        console.log(res);
        let el = document.querySelector("#close-button");
        el.click();
        $(function () {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: res.status,
            title: res.message
          });
          autoRefresh();
        });
      }
    });
  });
  return false;
});

// Soft Delete Patient Record
function softDeletePatient(soft) {
  let delId = soft.getAttribute("data-mrid");
  let val = 0;
  if (delId == "") { return; }
  // slipId = delId;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=SOFT_DELETE_PATIENT&id=${delId}&val=${val}`,
      success: function () {
        $(function () {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: 'success',
            title: 'Patient Soft Deleted Successfully.'
          });
          autoRefresh();
        });
      }
    });
  } else {
    return;
  }
}

// Delete Patient Record
function deletePatient(str) {
  let delId = str.getAttribute("data-mrid");
  if (delId == "") { return; }
  // slipId = delId;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=DELETE_PATIENT&id=${delId}`,
      success: function () {
        $(function () {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: 'error',
            title: 'Patient Record Deleted Successfully.'
          });
          autoRefresh();
        });
      }
    });
  } else {
    return;
  }
}

// Ajax Call for Adding New Slip
$(document).ready(function ($) {
  $('#addPatient').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    let mrid = $("input#patientMrId").val();
    let name = $("input#patientName").val();
    let mobile = $("input#patientPhone").val();
    let by = $("input#patientBy").val();

    if (mrid == "" || name == "" || mobile == "" || by == "") {
      $("#err-msg").fadeIn().text("Required Field.");
      $("input#patientMrId").focus();
      $("input#patientName").focus();
      $("input#patientPhone").focus();
      $("input#patientBy").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: "backend_components/slip_handler.php?q=ADD_PATIENT",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {

        //parse json
        res = JSON.parse(res);
        console.log(res);
        $(function () {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: res.status,
            title: res.message
          });
          // printSlip(res.data['id'], res.data['type']);
          autoRefresh();
        });
      }
    });
  });
  return false;
});