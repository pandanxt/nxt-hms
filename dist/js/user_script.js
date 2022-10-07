// Add unique Id for New User
 let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
 uuid = String(uuid).slice(-6) + '-USR';
 document.getElementById("uuId").value = uuid;

 let passUuid = "";
 function getUuid(str) { passUuid = str.getAttribute("data-uuid"); }
 // Ajax Call for Adding New Visiting Doctor 
 $(document).ready(function($){
   // on submit...
   $('#addUser').submit(function(e){
       e.preventDefault();
       $("#err-msg").hide();
       //uuId required
       var uuId = $("input#uuId").val();
       //name required
       var name = $("input#name").val();
       //email required
       var email = $("input#email").val();
       //loginId required
       var userId = $("input#userId").val();
       //password required
       var password = $("input#password").val();

       if(uuId == "" || name == "" || email == "" || userId == "" || password == ""){
           $("#err-msg").fadeIn().text("Required Fields.");
           $("input#uuId").focus();
           $("input#name").focus();
           $("input#email").focus();
           $("input#userId").focus();
           $("input#password").focus();
           return false;
       }
       // ajax
       $.ajax({
           type:"POST",
           url: "backend_components/user_handler.php?q=ADD_USER",
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
                   title: 'New User Successfully Saved.'
                 });
                 autoRefresh();
             });
           }
       });
   });  
   return false;
 });

 $(document).ready(function($){
    // on submit...
    $('#editUser').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var name = $("input#username").val();
        //email required
        var email = $("input#useremail").val();
        //loginId required
        var userId = $("input#userid").val();
 
        if(name == "" || email == "" || userId == ""){
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#username").focus();
            $("input#useremail").focus();
            $("input#userid").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/user_handler.php?q=EDIT_USER",
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
                    title: 'User Updated Successfully.'
                  });
                  autoRefresh();
              });
            }
        });
    });  
    return false;
  });

  $(document).ready(function($){
    // on submit...
    $('#passUser').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        //password required
        var password = $("input#userpassword").val();
 
        if(password == ""){
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#userpassword").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: `backend_components/user_handler.php?q=UPDATE_PASSWORD&id=${passUuid}`,
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
                    title: 'Password Updated Successfully.'
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
         url: `backend_components/user_handler.php?q=STATUS_USER&id=${status.dataset.uuid}&val=${val}`,
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
                 title: 'MedEast User Status Updated.'
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

 function getUser(str){
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid=="") {return;}
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("viewUser").innerHTML=this.responseText;
            console.log("Response From User By Id: ", this.responseText);
        }
        }
    xmlhttp.open("GET",`backend_components/user_handler.php?q=GET-USER-BY-ID&id=${uuid}`,true);
    xmlhttp.send();
 }

 function editUser(str){
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
    xmlhttp.open("GET",`backend_components/user_handler.php?q=EDIT-USER-BY-ID&id=${uuid}`,true);
    xmlhttp.send();
 }
 
 function editPass(str) {
  console.log("clicked Id: ", str.getAttribute("data-uuid"));
  let uuid = str.getAttribute("data-uuid");
  if (uuid=="") {return;}
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
          document.getElementById("viewUser").innerHTML=this.responseText;
          console.log("Response From User By Id: ", this.responseText);
      }
      }
  xmlhttp.open("GET",`backend_components/user_handler.php?q=GET-USER-BY-ID&id=${uuid}`,true);
  xmlhttp.send();
} 