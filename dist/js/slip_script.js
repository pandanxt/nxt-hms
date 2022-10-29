let data, slipId, serviceName, list = 'me';
// Add unique Id for New Slip and visiting doctor
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let patient_id = today.length = 7 ? `${today.replaceAll('/', '')}${String(uuid).slice(-4)}-MRD` : `${today.replaceAll('/', '')}${String(uuid).slice(-3)}-MRD`;
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;

if (document.getElementById("patId")) { document.getElementById("patId").value = patient_id; }
if (document.getElementById("slipId")) { document.getElementById("slipId").value = `SLP${unique_id}`; }
if (document.getElementById("uuId")) { document.getElementById("uuId").value = `DOC${unique_id}`; }
if (document.getElementById("reqId")) { document.getElementById("reqId").value = `REQ${unique_id}`; }
if (document.getElementById("followId")) { document.getElementById("followId").value = `FOL${unique_id}`; }
if (document.getElementById("serviceId")) { document.getElementById("serviceId").value = `SRS${unique_id}`; }
// Get Slip Id to Assign to slipId Variable
function getSlipId(id) { slipId = id.getAttribute("data-uuid"); }
// Ajax Call for Adding New Slip 
$(document).ready(function ($) {
  $('#addSlip').submit(function (e) {
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
    $.ajax({
      type: "POST",
      url: "backend_components/slip_handler.php?q=ADD_SLIP",
      data: $(this).serialize(), // get all form field value in serialize form
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
          printSlip(res.data['id'], res.data['type']);
        });
      }
    });
  });
  return false;
});