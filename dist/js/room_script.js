// Add unique Id for New Room
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("uuId")) { document.getElementById("uuId").value = `ROM${unique_id}`; }

// Ajax Call for Adding New Rooms 
$(document).ready(function ($) {
  $('#addRoom').submit(function (e) {
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
      url: "backend_components/room_handler.php?q=ADD_ROOM",
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
// Ajax Call for Editing Rooms
$(document).ready(function ($) {
  $('#editRoom').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var name = $("input#roomName").val();
    var rate = $("input#roomRate").val();
    var uuId = $("input#uuid").val();
    if (name == "" || rate == "" || uuId == "") {
      $("#err-msg").fadeIn().text("Required Fields.");
      $("input#roomName").focus();
      $("input#roomRate").focus();
      $("input#uuid").focus();
      return false;
    }
    $.ajax({
      type: "POST",
      url: "backend_components/room_handler.php?q=EDIT_ROOM",
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
// Update Room Status
function handleStatus(status) {
  if (status.value !== null && status.value != '') {
    let val;
    if (status.value == 1) { val = 0; } else { val = 1; }
    $.ajax({
      type: "POST",
      url: `backend_components/room_handler.php?q=STATUS_ROOM&id=${status.dataset.uuid}&val=${val}`,
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
//  Get Room By Id
function getRoom(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewRoom").innerHTML = this.responseText;
    }
  }
  xmlHttp.open("GET", `backend_components/room_handler.php?q=GET_ROOM_BY_ID&id=${uuid}`, true);
  xmlHttp.send();
}

function editRoom(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("editRoomForm").innerHTML = this.responseText;
    }
  }
  xmlHttp.open("GET", `backend_components/room_handler.php?q=EDIT_ROOM_BY_ID&id=${uuid}`, true);
  xmlHttp.send();
}

// Delete Room
function deleteRoom(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/room_handler.php?q=DELETE_ROOM&id=${uuid}`,
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