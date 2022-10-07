// Add unique Id for New Room
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/','')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/','')}`;
console.log("Patient MRID: ",unique_id);

if (document.getElementById("uuId")) {document.getElementById("uuId").value =  `ROM${unique_id}`;}

// Ajax Call for Adding New Rooms 
$(document).ready(function($){
  // on submit...
  $('#addRoom').submit(function(e){
      e.preventDefault();
      $("#err-msg").hide();
      //name required
      var uid = $("input#uuId").val();
      //name required
      var name = $("input#name").val();
      //rate required
      var rate = $("input#rate").val();
      if(uid == "" || name == "" || rate == ""){
          $("#err-msg").fadeIn().text("Required Field.");
          $("input#uuId").focus();
          $("input#name").focus();
          $("input#rate").focus();
          return false;
      }
      // ajax
      $.ajax({
          type:"POST",
          url: "backend_components/room_handler.php?q=ADD_ROOM",
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
                  title: 'New Room Successfully Saved.'
                });
                autoRefresh();
            });
          }
      });
  });  
  return false;
});

// Ajax Call for Editing Rooms
$(document).ready(function($){
    // on submit...
    $('#editRoom').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var name = $("input#roomName").val();
        //rate required
        var rate = $("input#roomRate").val();
        //uuId required
        var uuId = $("input#uuid").val();
        console.log("Edit Response data: ", name, rate, uuId);
        if(name == "" || rate == "" || uuId == ""){
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#roomName").focus();
            $("input#roomRate").focus();
            $("input#uuid").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/room_handler.php?q=EDIT_ROOM",
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
                    title: 'Room Updated Successfully.'
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
        url: `backend_components/room_handler.php?q=STATUS_ROOM&id=${status.dataset.uuid}&val=${val}`,
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
                title: 'Room Status Updated.'
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

function getRoom(str){
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid=="") {return;}
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("viewRoom").innerHTML=this.responseText;
            console.log("Response From Room By Id: ", this.responseText);
        }
        }
    xmlhttp.open("GET",`backend_components/room_handler.php?q=GET-ROOM-BY-ID&id=${uuid}`,true);
    xmlhttp.send();
 }

 function editRoom(str){
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
    xmlhttp.open("GET",`backend_components/room_handler.php?q=EDIT-ROOM-BY-ID&id=${uuid}`,true);
    xmlhttp.send();
}