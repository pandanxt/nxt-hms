let data, slipId, serviceName, patient_id, list = 'me';
// Add unique Id for New Slip and visiting doctor
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("slipId")) { document.getElementById("slipId").value = `SLP${unique_id}`; }
if (document.getElementById("patId")) { document.getElementById("patId").value = localStorage.getItem('patient_id'); }
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
  console.log("Patient MRID: ", patient_id);
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