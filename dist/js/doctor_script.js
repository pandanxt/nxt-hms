// Add unique Id for New DOCTOR
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("uuId")) { document.getElementById("uuId").value = `DOC${unique_id}`; }

// Ajax Call for Adding New Doctor 
$(document).ready(function ($) {
    $('#addDoctor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        var uid = $("input#uuId").val();
        var name = $("input#name").val();
        var mobile = $("input#mobile").val();
        var dept = $("input#department").val();
        if (uid == "" || name == "" || mobile == "" || dept == "") {
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#name").focus();
            $("input#mobile").focus();
            $("input#department").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=ADD_DOCTOR",
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
// Ajax Call for Editing Doctor
$(document).ready(function ($) {
    $('#editDoctor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        var name = $("input#docName").val();
        var mobile = $("input#docMobile").val();
        var dept = $("input#docDepartment").val();
        if (name == "" || mobile == "" || dept == "") {
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#docName").focus();
            $("input#docMobile").focus();
            $("input#docDepartment").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=EDIT_DOCTOR",
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
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=ADD_VT_DOCTOR",
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
// Ajax Call for Editing Visiting Doctor
$(document).ready(function ($) {
    $('#editVisitor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        var name = $("input#vtEtName").val();
        if (name == "") {
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#vtEtName").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=EDIT_VT_DOCTOR",
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
// Get Doctor By Id
function getDoctor(str) {
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("viewDoctor").innerHTML = this.responseText;
        }
    }
    xmlHttp.open("GET", `backend_components/doctor_handler.php?q=GET_DOCTOR_BY_ID&id=${uuid}`, true);
    xmlHttp.send();
}
// Edit Doctor By Id
function editDoctor(str) {
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("editMeForm").innerHTML = this.responseText;
        }
    }
    xmlHttp.open("GET", `backend_components/doctor_handler.php?q=EDIT_DOCTOR_BY_ID&id=${uuid}`, true);
    xmlHttp.send();
}
// Get Visiting Doctor By Id
function getVtDoctor(str) {
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("viewDoctor").innerHTML = this.responseText;
        }
    }
    xmlHttp.open("GET", `backend_components/doctor_handler.php?q=GET_VT_DOCTOR_BY_ID&id=${uuid}`, true);
    xmlHttp.send();
}
// Edit Visiting Doctor By Id
function editVisitor(str) {
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("editVtForm").innerHTML = this.responseText;
        }
    }
    xmlHttp.open("GET", `backend_components/doctor_handler.php?q=EDIT_VT_DOCTOR_BY_ID&id=${uuid}`, true);
    xmlHttp.send();
}
// Delete Doctor
function deleteDoctor(str) {
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    let checkConfirm = confirm('Please confirm deletion');
    if (checkConfirm) {
      // ajax
      $.ajax({
        type: "POST",
        url: `backend_components/doctor_handler.php?q=DELETE_DOCTOR&id=${uuid}`,
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

// Update Doctor Status
function handleStatus(status) {
    if (status.value !== null && status.value != '') {
        let val;
        if (status.value == 1) { val = 0; } else { val = 1; }
        $.ajax({
            type: "POST",
            url: `backend_components/doctor_handler.php?q=STATUS_DOCTOR&id=${status.dataset.uuid}&val=${val}`,
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