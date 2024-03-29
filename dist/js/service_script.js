// Add unique Id for New Services
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("uuId")) { document.getElementById("uuId").value = `SER${unique_id}`; }

// Ajax Call for Adding New Services 
$(document).ready(function ($) {
  $('#addService').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var uid = $("input#uuId").val();
    var name = $("input#name").val();
    var rate = $("input#rate").val();
    if (uid == "" || name == "" || rate == "") {
      $("#err-msg").fadeIn().text("Required Field.");
      $("input#uuId").focus();
      $("input#name").focus();
      $("input#rate").focus();
      return false;
    }
    $.ajax({
      type: "POST",
      url: "backend_components/service_handler.php?q=ADD_SERVICE",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {
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
// Ajax Call for Editing Service
$(document).ready(function ($) {
  $('#editService').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var name = $("input#serName").val();
    var rate = $("input#serRate").val();
    var uuId = $("input#uuid").val();
    if (name == "" || rate == "" || uuId == "") {
      $("#err-msg").fadeIn().text("Required Fields.");
      $("input#serName").focus();
      $("input#serRate").focus();
      $("input#uuid").focus();
      return false;
    }
    $.ajax({
      type: "POST",
      url: "backend_components/service_handler.php?q=EDIT_SERVICE",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (res) {
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
// Update Service Status
function handleStatus(status) {
  if (status.value !== null && status.value != '') {
    let val;
    if (status.value == 1) { val = 0; } else { val = 1; }
    $.ajax({
      type: "POST",
      url: `backend_components/service_handler.php?q=STATUS_SERVICE&id=${status.dataset.uuid}&val=${val}`,
      success: function (res) {
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
        });
      }
    });
    return false;
  } else { return false; }
}
// Get Service By Id
function getService(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewService").innerHTML = this.responseText;
    }
  }
  xmlHttp.open("GET", `backend_components/service_handler.php?q=GET_SERVICE_BY_ID&id=${uuid}`, true);
  xmlHttp.send();
}
// Edit Service By Id
function editService(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("editServiceForm").innerHTML = this.responseText;
    }
  }
  xmlHttp.open("GET", `backend_components/service_handler.php?q=EDIT_SERVICE_BY_ID&id=${uuid}`, true);
  xmlHttp.send();
}

// Delete Service
function deleteService(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/service_handler.php?q=DELETE_SERVICE&id=${uuid}`,
      success: function (res) {
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
        });
        autoRefresh();
      }
    });
  } else {
    return;
  }
}
