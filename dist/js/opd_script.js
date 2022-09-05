  // Add unique Id for New Slip and visiting doctor
  let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
  slipId = 'SOPD' + String(uuid).slice(-6);
  vtId = 'VTDO' + String(uuid).slice(-6);
  document.getElementById("slipId").value = slipId;
  document.getElementById("uuId").value = vtId;

  let list = 'me';
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
    xmlhttp.open("GET",`backend_components/opd_handler.php?q=GET_DOCTOR&id=${list}`,true);
    xmlhttp.send();
  }

  // Dept Change Request for Regular Doctor
  function showDoctor(str) {
    if (str=="" || list =="") {return;}
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("doctor").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET",`backend_components/opd_handler.php?q=GET_DOCTOR_BY_DEPT&id=${list}&val=${str}`,true);
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
    xmlhttp.open("GET",`backend_components/opd_handler.php?q=GET_DOCTOR&id=${list}`,true);
    xmlhttp.send();
  }

  // Ajax Call for Adding New Visiting Doctor 
  $(document).ready(function($){
    // on submit...
    $('#visitorDoctor').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var dname = $("input#docName").val();
        if(dname == ""){
            $("#err-msg").fadeIn().text("Doctor Name required.");
            $("input#docName").focus();
            return false;
        }
        $("#cancel").click();
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/vt_doc_handler.php?q=ADD_DOCTOR",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){   
            updateDoctor();
              $(function() {
                  var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    icon: 'success',
                    title: 'New Visitor Doctor Successfully Saved.'
                  })
              });
            }
        });
    });  
    return false;
  });

  // Ajax Call for Adding New Slip 
$(document).ready(function($){
    // on submit...
    $('#addSlip').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        var uuid = $("input#slipId").val();
        var mrid = $("input#mrid").val();
        var name = $("input#name").val();
        var doctor = $("input#doctor").val();
        var dept = $("input#dept").val();
        var phone = $("input#phone").val();
        var fee = $("input#fee").val();
        var address = $("input#address").val();
        var staffId = $("input#staffId").val();
        var gender = $("input#gender").val();
        var age = $("input#age").val();

        if(uuid == "" || mrid == "" || name == "" || doctor == "" || dept == "" || phone == "" || fee == "" || address == "" || staffId == "" || gender == "" || age == ""){
            $("#err-msg").fadeIn().text("Required Field.");
            $("input#uuId").focus();
            $("input#mrid").focus();
            $("input#name").focus();
            $("input#doctor").focus();
            $("input#dept").focus();
            $("input#phone").focus();
            $("input#fee").focus();
            $("input#address").focus();
            $("input#staffId").focus();
            $("input#gender").focus();
            $("input#age").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/opd_handler.php?q=ADD_SLIP",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(res){   

            //parse json
            res = JSON.parse(res);
            console.log(res);
            // updateDoctorList();
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

function printSlip(str) {
    window.open(`print-page.php?type=outdoor&sid=${str}`,"_blank", 
     "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1000,height=800");
}

function autoRefresh(){
    setTimeout(() => {
      window.location = window.location.href;
    // window.location = "outdoor_slip_record.php";   
    }, 1000);    
}