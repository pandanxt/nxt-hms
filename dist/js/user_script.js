// Add unique Id for New User
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
if (document.getElementById("uuId")) { document.getElementById("uuId").value = `USR${unique_id}`; }

// Ajax Call for Adding New User 
$(document).ready(function ($) {
  $('#addUser').submit(function (e) {
    e.preventDefault();
    $("#err-msg").hide();
    var uuId = $("input#uuId").val();
    var name = $("input#name").val();
    var email = $("input#email").val();
    var userId = $("input#userId").val();
    var password = $("input#password").val();
    if (uuId == "" || name == "" || email == "" || userId == "" || password == "") {
      $("#err-msg").fadeIn().text("Required Fields.");
      $("input#uuId").focus();
      $("input#name").focus();
      $("input#email").focus();
      $("input#userId").focus();
      $("input#password").focus();
      return false;
    }
    $.ajax({
      type: "POST",
      url: "backend_components/user_handler.php?q=ADD_USER",
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

// Update User Status Query
function handleStatus(status) {
  if (status.value !== null && status.value != '') {
    let val;
    if (status.value == 1) { val = 0; } else { val = 1; }
    $.ajax({
      type: "POST",
      url: `backend_components/user_handler.php?q=STATUS_USER&id=${status.dataset.uuid}&val=${val}`,
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