// let currentDT = new Date().toLocaleString().replace(',', '');
if (document.getElementById('inputDT')) { document.getElementById('inputDT').value = currentDT; }

// Display Clock in AM/PM on Slip Page   
function display_ct7() {
  let x = new Date();
  let amPm = x.getHours() >= 12 ? ' PM' : ' AM';
  hours = x.getHours() % 12;
  hours = hours ? hours : 12;
  hours = hours.toString().length == 1 ? 0 + hours.toString() : hours;
  let minutes = x.getMinutes().toString()
  minutes = minutes.length == 1 ? 0 + minutes : minutes;
  let seconds = x.getSeconds().toString()
  seconds = seconds.length == 1 ? 0 + seconds : seconds;
  let month = (x.getMonth() + 1).toString();
  month = month.length == 1 ? 0 + month : month;
  let dt = x.getDate().toString();
  dt = dt.length == 1 ? 0 + dt : dt;
  let x1 = month + "/" + dt + "/" + x.getFullYear();
  x1 = x1 + " - " + hours + ":" + minutes + ":" + seconds + " " + amPm;
  if (document.getElementById('clockDT')) { document.getElementById('clockDT').innerHTML = x1; }
  display_c7();
}
// Refresh Clock in AM/PM after every one second
function display_c7() {
  myTime = setTimeout('display_ct7()', 1000) // Refresh rate in milli seconds
}
display_c7(); // Clock Function Call

// Reset Model Data
function setPopModel() { document.getElementById("editBody").innerHTML = ""; }

// Slip Type and Subtype Model Popup Function 
$(function () {
  $('#select').hide();
  $('#subType').prop('required', false);
  $('#type').change(function () {
    $('#select').hide();
    $('#subType').prop('required', false);
    if (this.options[this.selectedIndex].value == 'INDOOR') {
      $('#select').show();
      $('#subType').prop('required', true);
    }
  });
});

// Slip Type and Subtype Model Popup Function for Patient table
$(function () {
  $('#patSelect').hide();
  $('#patSubType').prop('required', false);
  $('#patType').change(function () {
    $('#patSelect').hide();
    $('#patSubType').prop('required', false);
    if (this.options[this.selectedIndex].value == 'INDOOR') {
      $('#patSelect').show();
      $('#patSubType').prop('required', true);
    }
  });
});

// Switch Doctor List 
function switchDocList(e) {
  let addDoc = document.getElementById("addDoc");
  if (e == 'me') {
    addDoc.style.display = "none";
    list = 'me';
  } else if (e == 'vt') {
    addDoc.style.display = "flex";
    list = 'vt';
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("doctor").innerHTML = this.responseText;
    }
  }
  xmlhttp.open("GET", `backend_components/slip_handler.php?q=GET_DOCTOR&id=${list}`, true);
  xmlhttp.send();
}

// Dept Change Request for Regular Doctor
function showDoctor(str) {
  if (str == "" || list == "" || list == "vt") { return; }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("doctor").innerHTML = this.responseText;
    }
  }
  xmlhttp.open("GET", `backend_components/slip_handler.php?q=GET_DOCTOR_BY_DEPT&id=${list}&val=${str}`, true);
  xmlhttp.send();
}

// Update Request for visiting Doctor 
function updateDoctor() {
  let visitId = document.getElementById("doctor");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      visitId.innerHTML = this.responseText;
    } else { console.log("There is an error in updating the visiting doctor record."); }
  }
  xmlhttp.open("GET", `backend_components/slip_handler.php?q=GET_DOCTOR&id=${list}`, true);
  xmlhttp.send();
}

// Ajax Call for Adding New Visiting Doctor 
$(document).ready(function ($) {
  $('#visitorDoctor').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var dname = $("input#vtName").val();
    if (dname == "") {
      $("#err-msg").fadeIn().text("Doctor Name required.");
      $("input#vtName").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: "backend_components/doctor_handler.php?q=ADD_VT_DOCTOR",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function () {
        let el = document.querySelector("#cancel");
        el.click();
        updateDoctor();
        $(function () {
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
        });
      }
    });
  });
  return false;
});

// Slip Print Function
function printSlip(id, type) {
  location.href = `slip_print.php?type=${type}&sid=${id}`
}

// Slip Print Function
function printSlipRecord(sid) {
  let id = sid.getAttribute("data-uuid");
  let type = sid.getAttribute("data-type");
  printSlip(id, type);
}

// Edit Slip Model View
function editSlip(str) {
  console.log("clicked Id: ", str.getAttribute("data-uuid"), str.getAttribute("data-type"), str.getAttribute("data-subtype"));
  let uuid = str.getAttribute("data-uuid");
  let type = str.getAttribute("data-type");
  if (uuid == "" || type == "") { return; }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("editSlipForm").innerHTML = this.responseText;
      console.log("Response From Doctor By Id: ", this.responseText);
    }
  }
  xmlhttp.open("GET", `backend_components/slip_handler.php?q=EDIT-SLIP-BY-ID&id=${uuid}&val=${type}`, true);
  xmlhttp.send();
}

// Ajax Call for Editing Patient Slip Query
$(document).ready(function ($) {
  // on submit...
  $('#editSlip').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    //mrid required
    var mrid = $("input#editMrid").val();
    //name required
    var name = $("input#editName").val();
    //mobile required
    var mobile = $("input#editPhone").val();
    //dept required
    var dept = $("input#editDept").val();
    //doc required
    var doc = $("input#editDoctor").val();
    //fee required
    var fee = $("input#editFee").val();
    //procedure required
    var procedure = $("input#editProcedure").val();

    if (mrid == "" || name == "" || mobile == "" || dept == "" || doc == "" || fee == "" || procedure == "") {
      $("#err-msg").fadeIn().text("Required Fields.");
      $("input#editMrid").focus();
      $("input#editName").focus();
      $("input#editPhone").focus();
      $("input#editDept").focus();
      $("input#editDoctor").focus();
      $("input#editFee").focus();
      $("input#editProcedure").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: "backend_components/slip_handler.php?q=EDIT_SLIP",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function () {
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
            icon: 'success',
            title: 'Slip Record Updated Successfully.'
          });
          autoRefresh();
        });
      }
    });
  });
  return false;
});

// Soft Delete Slip Record
function softDeleteSlip(soft) {
  let delId = soft.getAttribute("data-uuid");
  let val = 0;
  if (delId == "") { return; }
  slipId = delId;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=SOFT_DELETE_SLIP&id=${slipId}&val=${val}`,
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
            title: 'Slip Soft Deleted Successfully.'
          });
          autoRefresh();
        });
      }
    });
  } else {
    return;
  }
}

// Delete Slip Record
function deleteSlip(str) {
  let delId = str.getAttribute("data-uuid");
  if (delId == "") { return; }
  slipId = delId;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=DELETE_SLIP&id=${slipId}`,
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
            title: 'Slip Record Deleted Successfully.'
          });
          autoRefresh();
        });
      }
    });
  } else {
    return;
  }
}

// History Slip Record
function viewHistory(str) {
  let uuid = str.getAttribute("data-uuid");
  let type = str.getAttribute("data-type");

  if (uuid == "" || type == "") { return; }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("historyTable").innerHTML = this.responseText;
      console.log("Response From Slip History: ", this.responseText);
    }
  }
  xmlhttp.open("GET", `backend_components/slip_handler.php?q=GET_SLIP_HISTORY&id=${uuid}&val=${type}`, true);
  xmlhttp.send();
}

// Get Slip Id to Assign to slipId Variable
function getSlipId(id) { slipId = id.getAttribute("data-uuid"); }

// Get Discount Function
function serviceDiscount(discount) {
  let finalBill = document.getElementById('finalBill');
  let totalBill = document.getElementById('service');
  let selected = totalBill.options[totalBill.selectedIndex];
  finalBill.value = totalBill.value - discount.value;
  serviceName = selected.getAttribute("data-name");
  console.log("this is the final result:", finalBill.value, serviceName);
}

// Onchange Enable Fields
function serviceChange(service) {
  let discount = document.getElementById('discount');
  let finalBill = document.getElementById('finalBill');
  if (discount.disabled = true) discount.disabled = false;
  finalBill.value = service.value - discount.value;
  console.log("this is the final result:", finalBill.value);
}

// Ajax Call for Adding New FollowUp Slip 
$(document).ready(function ($) {
  $('#ADD_FOLLOW_UP_SLIP').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var id = $("input#followId").val();
    var staffId = $("input#staffId").val();
    if (staffId == "" || id == "") {
      $("#err-msg").fadeIn().text("Required Field.");
      $("input#followId").focus();
      $("input#staffId").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=ADD_FOLLOW_UP_SLIP&id=${slipId}`,
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {
        //parse json
        res = JSON.parse(res);
        let el = document.querySelector("#close-button");
        el.click();
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
          printMiniSlip(res.data['id'], res.data['type']);
          autoRefresh();
        });
      }
    });
  });
  return false;
});

// Ajax Call for Adding New Service Slip 
$(document).ready(function ($) {
  $('#ADD_SERVICE_SLIP').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var id = $("input#serviceId").val();
    var staffId = $("input#staffId").val();
    if (staffId == "" || id == "") {
      $("#err-msg").fadeIn().text("Required Field.");
      $("input#serviceId").focus();
      $("input#staffId").focus();
      return false;
    }
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=ADD_SERVICE_SLIP&id=${slipId}&val=${serviceName}`,
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {
        //parse json
        res = JSON.parse(res);
        let el = document.querySelector("#close-button");
        el.click();
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
          printMiniSlip(res.data['id'], res.data['type']);
          autoRefresh();
        });
      }
    });
  });
  return false;
});

// Delete Follow Up Slip Record
function deleteFollowSlip(str) {
  let delId = str.getAttribute("data-uuid");
  if (delId == "") { return; }
  slipId = delId;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=DELETE_FOLLOW_SLIP&id=${slipId}`,
      success: function (res) {
        //parse json
        // res = JSON.parse(res);   
        $(function () {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: 'error',
            title: 'FollowUp Slip Record Deleted Successfully.'
          });
          autoRefresh();
        });
      }
    });
  } else {
    return;
  }
}
// Delete Service Slip Record
function deleteServiceSlip(str) {
  let delId = str.getAttribute("data-uuid");
  if (delId == "") { return; }
  slipId = delId;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/slip_handler.php?q=DELETE_SERVICE_SLIP&id=${slipId}`,
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
            title: 'Service Slip Record Deleted Successfully.'
          });
          autoRefresh();
        });
      }
    });
  } else {
    return;
  }
}

// Slip Print Function
function printMiniSlip(id, type) {
  location.href = `other_slip_print.php?sid=${id}&type=${type}`
}

// Slip Print Function
function printMiniSlipRecord(sid) {
  let id = sid.getAttribute("data-uuid");
  let type = sid.getAttribute("data-type");
  printMiniSlip(id, type);
}

// Auto Refresh Function 
function autoRefresh() {
  setTimeout(() => {
    window.location = window.location.href;
  }, 1000);
}