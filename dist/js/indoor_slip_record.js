let data;
let slipId;
// Get Slip Id to Assign to slipId Variable
function getSlipId(id){ slipId = id;}
// Update Indoor Request
function updateIndoorRequest(str){
  if (str=="") {return;}
    var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("EDIT-INDOOR-SLIP").innerHTML=this.responseText;
          console.log("Response From Slip Request: ", this.responseText);
        }
      }
  xmlhttp.open("GET","backend_components/ajax_indoor_slip_record.php?q=GET-INDOOR-SLIP&id="+str,true);
  xmlhttp.send();
}
// Delete Indoor Request
function deleteIndoorRequest(str){
    if (str=="") {return;}
    slipId = str;
    let checkConfirm = confirm('Please confirm deletion');
    if (checkConfirm) {
        // ajax
        $.ajax({
            type:"POST",
            url: `backend_components/ajax_indoor_slip_record.php?q=REMOVE-INDOOR-REQUEST&id=${slipId}`,
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
// Get Request Data against slip Id
function getIndoorRequest(str){
    if (str=="") {return;}
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("requestBody").innerHTML=this.responseText;
          console.log("Response From Slip Request: ", this.responseText);
        }
      }
    xmlhttp.open("GET","backend_components/ajax_indoor_slip_record.php?q=VIEW-INDOOR-SLIP&id="+str,true);
    xmlhttp.send();
}

// Ajax Call for Adding New Edit Request 
$(document).ready(function($){
  $('#GENERATE-INDOOR-SLIP').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      var title = $("input#title").val();
      var comment = $("input#comment").val();
      if(title == "" || comment == ""){
          $("#err-msg").fadeIn().text("Required Field.");
          $("input#title").focus();
          $("input#comment").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: `backend_components/ajax_indoor_slip_record.php?q=GENERATE-INDOOR-SLIP&id=${slipId}`,
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
  $('#EDIT-INDOOR-SLIP').submit(function(e){
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
          url: `backend_components/ajax_indoor_slip_record.php?q=EDIT-INDOOR-SLIP&id=${id}`,
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

function autoRefresh(){
  setTimeout(() => {
    window.location = window.location.href;
  }, 1000);    
}

function printSlip(sid) {
  window.open(`print-page.php?type=indoor&sid=${sid}`, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1000,height=800");
}               
