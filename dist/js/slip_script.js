let data;
let slipId;
let list = 'me';

// Add unique Id for New Slip and visiting doctor
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
if (document.getElementById("patId")) {document.getElementById("patId").value = String(uuid).slice(-6) +'-MRD';}
if (document.getElementById("slipId")) {document.getElementById("slipId").value = String(uuid).slice(-6) +'-SLP';}
if (document.getElementById("uuId")) {document.getElementById("uuId").value = String(uuid).slice(-6) +'-DOC';}

// Get Slip Id to Assign to slipId Variable
function getSlipId(id){ slipId = id.getAttribute("data-uuid");}

// Switch Doctor List 
function switchDocList(e) { 
let addDoc = document.getElementById("addDoc");
if (e == 'me') {
    addDoc.style.display = "none";
    list = 'me';
}else if (e == 'vt') {
    addDoc.style.display = "flex"; 
    list = 'vt';
}
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    document.getElementById("doctor").innerHTML=this.responseText;
    }
}
xmlhttp.open("GET",`backend_components/slip_handler.php?q=GET_DOCTOR&id=${list}`,true);
xmlhttp.send();
}

// Dept Change Request for Regular Doctor
function showDoctor(str) {
if (str=="" || list =="" || list =="vt") {return;}
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    document.getElementById("doctor").innerHTML=this.responseText;
    }
}
xmlhttp.open("GET",`backend_components/slip_handler.php?q=GET_DOCTOR_BY_DEPT&id=${list}&val=${str}`,true);
xmlhttp.send();
}

// Update Request for visiting Doctor 
function updateDoctor() {
let visitId = document.getElementById("doctor");
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    visitId.innerHTML=this.responseText;
    }else { console.log("There is an error in updating the visiting doctor record."); }
}
xmlhttp.open("GET",`backend_components/slip_handler.php?q=GET_DOCTOR&id=${list}`,true);
xmlhttp.send();
}

// Auto Fresh Function
function autoRefresh(){
    setTimeout(() => {
      window.location = window.location.href;
    // window.location = "outdoor_slip_record.php";   
    }, 1000);    
}

// Ajax Call for Adding New Visiting Doctor 
$(document).ready(function($){
  $('#visitorDoctor').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      var dname = $("input#vtName").val();
      if(dname == ""){
          $("#err-msg").fadeIn().text("Doctor Name required.");
          $("input#vtName").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: "backend_components/doctor_handler.php?q=ADD_VT_DOCTOR",
          data: $(this).serialize(), // get all form field value in serialize form
          success: function(){   
          let el = document.querySelector("#cancel");
            el.click();
            updateDoctor();
              $(function() {
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
$(document).ready(function($){
    $('#addSlip').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        let uuid = $("input#slipId").val();
        let patId = $("input#patId").val();
        let staffId = $("input#staffId").val();

        if(uuid == "" || patId == "" || staffId == ""){
            $("#err-msg").fadeIn().text("Required Field.");
            $("input#uuId").focus();
            $("input#mrId").focus();
            $("input#staffId").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/slip_handler.php?q=ADD_SLIP",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(res){   

            //parse json
            res = JSON.parse(res);
            console.log(res);
              $(function() {
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
                  printSlip(res.data);
                  autoRefresh();
              });
            }
        });
    });  
    return false;
});

// Slip Print Function
function printSlip(sid) {
  window.open(`print-page.php?sid=${sid}`, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1000,height=800");
}

// Slip Print Function
function printSlipRecord(sid) {
  let str = sid.getAttribute("data-uuid");
  window.open(`print-page.php?type=outdoor&sid=${str}`, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1000,height=800");
}

function updateRequest(str){
  let req = str.getAttribute("data-uuid");
  if (req=="") {return;}
    var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("EDIT_REQUEST").innerHTML=this.responseText;
          console.log("Response From Slip Request: ", this.responseText);
        }
      }
  xmlhttp.open("GET",`backend_components/slip_handler.php?q=GET_REQUEST&id=${req}`,true);
  xmlhttp.send();
}

// Get Request Data against slip Id
function getRequest(str){
    let req = str.getAttribute("data-uuid");
    if (req=="") {return;}
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("requestBody").innerHTML=this.responseText;
          console.log("Response From Slip Request: ", this.responseText);
        }
      }
    xmlhttp.open("GET",`backend_components/slip_handler.php?q=VIEW_REQUEST&id=${req}`,true);
    xmlhttp.send();
}

// Delete Outdoor Request
function deleteRequest(str){
  let req = str.getAttribute("data-uuid");
  if (req=="") {return;}
  slipId = req;
  let checkConfirm = confirm('Please confirm deletion');
  if (checkConfirm) {
      // ajax
      $.ajax({
          type:"POST",
          url: `backend_components/slip_handler.php?q=REMOVE_REQUEST&id=${slipId}`,
          success: function(){   
          let el = document.querySelector("#close-button");
          el.click();
          $(function() {
              var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
              });
              Toast.fire({
                  icon: 'error',
                  title: 'Request Deleted Successfully.'
              });
              autoRefresh();
          });
          }
      });
  } else {
      return;
  }
}

// Ajax Call for Adding New Edit Request 
$(document).ready(function($){
  $('#ADD_REQUEST').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      var title = $("input#title").val();
      var comment = $("input#comment").val();
      var reqId = $("input#reqId").val();
      if(reqId == "" || title == "" || comment == ""){
          $("#err-msg").fadeIn().text("Required Field.");
          $("input#reqId").focus();
          $("input#title").focus();
          $("input#comment").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: `backend_components/slip_handler.php?q=ADD_REQUEST&id=${slipId}`,
          data: $(this).serialize(), // get all form field value in serialize form
          success: function(){   
          let el = document.querySelector("#close-button");
          el.click();
            $(function() {
                var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                Toast.fire({
                  icon: 'success',
                  title: 'Edit Request Successfully Generated.'
                });
                autoRefresh();
            });
          }
      });
  });  
  return false;
});

// Ajax Call for Updating Edit Request 
$(document).ready(function($){
  $('#EDIT_REQUEST').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      var title = $("input#eTitle").val();
      var comment = $("input#eComment").val();
      var id = $("input#eId").val();
      if(title == "" || comment == ""){
          $("#err-msg").fadeIn().text("Required Field.");
          $("input#eTitle").focus();
          $("input#eComment").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: `backend_components/slip_handler.php?q=EDIT_REQUEST&id=${id}`,
          data: $(this).serialize(), // get all form field value in serialize form
          success: function(){   
          let el = document.querySelector("#close-button");
          el.click();
            $(function() {
                var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                Toast.fire({
                  icon: 'success',
                  title: 'Edit Request Successfully Updated.'
                });
                autoRefresh();
            });
          }
      });
  });  
  return false;
});