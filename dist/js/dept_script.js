// Add unique Id for New Dept
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("uuId")) { document.getElementById("uuId").value = `DEP${unique_id}`; }

// Ajax Call for Adding New Department 
$(document).ready(function ($) {
  $('#addDept').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var name = $("input#name").val();
    if (name == "") {
      $("#err-msg").fadeIn().text("Required Field.");
      $("input#name").focus();
      return false;
    }
    $.ajax({
      type: "POST",
      url: "backend_components/dept_handler.php?q=ADD_DEPT",
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
// Ajax Call for Editing Department
$(document).ready(function ($) {
  $('#editDept').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var name = $("input#deptName").val();
    var uuId = $("input#uuid").val();
    if (name == "" || uuId == "") {
      $("#err-msg").fadeIn().text("Required Fields.");
      $("input#deptName").focus();
      $("input#uuid").focus();
      return false;
    }
    $.ajax({
      type: "POST",
      url: "backend_components/dept_handler.php?q=EDIT_DEPT",
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
// Handle Status of Department
function handleStatus(status) {
  if (status.value !== null && status.value != '') {
    let val;
    if (status.value == 1) { val = 0; } else { val = 1; }
    $.ajax({
      type: "POST",
      url: `backend_components/dept_handler.php?q=STATUS_DEPT&id=${status.dataset.uuid}&val=${val}`,
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
// Get Department
function getDept(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewDept").innerHTML = this.responseText;
    }
  }
  xmlHttp.open("GET", `backend_components/dept_handler.php?q=GET_DEPT_BY_ID&id=${uuid}`, true);
  xmlHttp.send();
}

function editDept(str) {
  console.log("clicked Id: ", str.getAttribute("data-uuid"));
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("editDeptForm").innerHTML = this.responseText;
    }
  }
  xmlHttp.open("GET", `backend_components/dept_handler.php?q=EDIT_DEPT_BY_ID&id=${uuid}`, true);
  xmlHttp.send();
}

// Delete Department Record
function deleteDept(str) {
  let uuid = str.getAttribute("data-uuid");
  if (uuid == "") { return; }
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
    // ajax
    $.ajax({
      type: "POST",
      url: `backend_components/dept_handler.php?q=DELETE_DEPT&id=${uuid}`,
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