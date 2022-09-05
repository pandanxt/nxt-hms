// Add unique Id for New Dept
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
uuid = 'DEPT' + String(uuid).slice(-6);
document.getElementById("uuId").value = uuid;

// Ajax Call for Adding New Department 
$(document).ready(function($){
  // on submit...
  $('#addDept').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      //name required
      var name = $("input#name").val();
      if(name == ""){
          $("#err-msg").fadeIn().text("Required Field.");
          $("input#name").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: "backend_components/dept_handler.php?q=ADD_DEPT",
          data: $(this).serialize(), // get all form field value in serialize form
          success: function(){   
          let el = document.querySelector("#close-button");
          el.click();
          // updateDoctorList();
            $(function() {
                var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                Toast.fire({
                  icon: 'success',
                  title: 'New Department Successfully Saved.'
                });
                autoRefresh();
            });
          }
      });
  });  
  return false;
});

// Ajax Call for Editing Department
$(document).ready(function($){
    // on submit...
    $('#editDept').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var name = $("input#deptName").val();
        //uuId required
        var uuId = $("input#uuid").val();
        console.log("Edit Response data: ", name, uuId);
        if(name == "" || uuId == ""){
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#deptName").focus();
            $("input#uuid").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/dept_handler.php?q=EDIT_DEPT",
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
                    title: 'Department Updated Successfully.'
                  });
                  autoRefresh();
              });
            }
        });
    });  
    return false;
});

function handleStatus(status) {
  if(status.value !== null && status.value != ''){
    let val;
      if (status.value == 1) { val = 0;} else { val = 1;}
      // ajax
      $.ajax({
        type:"POST",
        url: `backend_components/dept_handler.php?q=STATUS_DEPT&id=${status.dataset.uuid}&val=${val}`,
        success: function(){   
          $(function() {
              var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000
              });
              Toast.fire({
                icon: 'success',
                title: 'Department Status Updated.'
              });
          });
        }
      });
    return false;
  }else {
      $(function() {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000
          });
          Toast.fire({
            icon: 'error',
            title: 'Something Went Wrong.'
          });
          autoRefresh();
      });
    return false;
  }
}

function autoRefresh(){
  setTimeout(() => {
    window.location = window.location.href;
  }, 1000);    
}
function getDept(str){
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid=="") {return;}
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("viewDept").innerHTML=this.responseText;
            console.log("Response From Dept By Id: ", this.responseText);
        }
        }
    xmlhttp.open("GET",`backend_components/dept_handler.php?q=GET-DEPT-BY-ID&id=${uuid}`,true);
    xmlhttp.send();
 }

 function editDept(str){
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid=="") {return;}
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("editForm").innerHTML=this.responseText;
            console.log("Response From User By Id: ", this.responseText);
        }
        }
    xmlhttp.open("GET",`backend_components/dept_handler.php?q=EDIT-DEPT-BY-ID&id=${uuid}`,true);
    xmlhttp.send();
}