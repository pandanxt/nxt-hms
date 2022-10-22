let data, patient_id, list = 'me';
// Add unique Id for New Slip and visiting doctor
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("slipId")) { document.getElementById("slipId").value = `SLP${unique_id}`; }
if (document.getElementById("patId")) { document.getElementById("patId").value = localStorage.getItem('patient_id'); }
if (document.getElementById("name")) { document.getElementById("name").value = localStorage.getItem('patient_name'); }
if (document.getElementById("phone")) { document.getElementById("phone").value = localStorage.getItem('patient_mobile'); }
// Get Slip Id to Assign to slipId Variable
function getPatientId(id) { 
    localStorage.setItem('patient_id', id.getAttribute("data-mrid"));
    localStorage.setItem('patient_name', id.getAttribute("data-name"));
    localStorage.setItem('patient_mobile', id.getAttribute("data-mobile"));
    console.log("Patient MRID: ", patient_id);    
}

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