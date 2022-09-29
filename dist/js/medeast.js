let currentDT = new Date().toLocaleString().replace(',','');
let unid = Date.now() +"-"+ "ME";
let MR_ID = unid.slice(6,16);

let recordRefId, requestId, requestStatus;

if(document.getElementById('mrid')){document.getElementById('mrid').value = MR_ID;}
if(document.getElementById('inputDT')){document.getElementById('inputDT').value = currentDT;}

function display_ct7() {
  let x = new Date();
  let ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
  hours = x.getHours( ) % 12;
  hours = hours ? hours : 12;
  hours=hours.toString().length==1? 0+hours.toString() : hours;

  let minutes=x.getMinutes().toString()
  minutes=minutes.length==1 ? 0+minutes : minutes;

  let seconds=x.getSeconds().toString()
  seconds=seconds.length==1 ? 0+seconds : seconds;

  let month=(x.getMonth() +1).toString();
  month=month.length==1 ? 0+month : month;

  let dt=x.getDate().toString();
  dt=dt.length==1 ? 0+dt : dt;

  let x1=month + "/" + dt + "/" + x.getFullYear(); 
  x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
  if(document.getElementById('clockDT')){document.getElementById('clockDT').innerHTML = x1;}
  display_c7();
}

function display_c7(){
  let refresh=1000; // Refresh rate in milli seconds
  mytime=setTimeout('display_ct7()',refresh)
}

display_c7();

// $(function () {
//     $('.select2').select2()
//     $('.select2bs4').select2({theme: 'bootstrap4'})
//     $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//     $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//     $('[data-mask]').inputmask()
//     $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
//     $('#reservationdatetime2').datetimepicker({ icons: { time: 'far fa-clock' } });
//     $('#reservation').daterangepicker()
//     $('#reservationtime').daterangepicker({
//       timePicker: true,
//       timePickerIncrement: 30,
//       locale: {
//         format: 'MM/DD/YYYY hh:mm A'
//       }
//     })
//     $('#daterange-btn').daterangepicker(
//       {
//         ranges   : {
//           'Today'       : [moment(), moment()],
//           'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//           'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
//           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//           'This Month'  : [moment().startOf('month'), moment().endOf('month')],
//           'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//         },
//         startDate: moment().subtract(29, 'days'),
//         endDate  : moment()
//       },
//       function (start, end) {
//         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
//       }
//     )
//     //Timepicker
//     $('#timepicker').datetimepicker({
//       format: 'LT'
//     })
//     //Bootstrap Duallistbox
//     $('.duallistbox').bootstrapDualListbox()

//     $("input[data-bootstrap-switch]").each(function(){
//       $(this).bootstrapSwitch('state', $(this).prop('checked'));
//     })
//   })
  // BS-Stepper Init
  // document.addEventListener('DOMContentLoaded', function () {
  //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  // })

  // DropzoneJS Demo Code Start
  // if(Dropzone.autoDiscover) Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  // let previewNode;
  // if (document.querySelector("#template")) {
  //   previewNode = document.querySelector("#template")
  //   previewNode.id = ""
  //   let previewTemplate = previewNode.parentNode.innerHTML
  //   previewNode.parentNode.removeChild(previewNode)
  // }

  // let myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  //   url: "/target-url", // Set the url
  //   thumbnailWidth: 80,
  //   thumbnailHeight: 80,
  //   parallelUploads: 20,
  //   previewTemplate: previewTemplate,
  //   autoQueue: false, // Make sure the files aren't queued until manually added
  //   previewsContainer: "#previews", // Define the container to display the previews
  //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  // })

  // myDropzone.on("addedfile", function(file) {
  //   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  // })

  // myDropzone.on("totaluploadprogress", function(progress) {
  //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  // })

  // myDropzone.on("sending", function(file) {
  //   document.querySelector("#total-progress").style.opacity = "1"
  //   file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  // })

  // myDropzone.on("queuecomplete", function(progress) {
  //   document.querySelector("#total-progress").style.opacity = "0"
  // })

  // document.querySelector("#actions .start").onclick = function() {
  //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  // }
  // document.querySelector("#actions .cancel").onclick = function() {
  //   myDropzone.removeAllFiles(true)
  // }

  // Request Functions starts

  
// Send Update Record of request Date
function updateRqRecord() {
  let type, dept, doctor, fee, procedure;
  let slipId = document.getElementById('slipId').value;

  if (recordType == 'outdoor') {
    type = document.getElementById('docType').value;
    fee = document.getElementById('fee').value;
    if (type == 0) {
      dept = document.getElementById('meDept').value;
      doctor = document.getElementById('meDoctor').value;
    }else if (type == 1) {
      dept = document.getElementById('vtDept').value;
      doctor = document.getElementById('vtDoctor').value;
    }
  }else if (recordType == 'indoor') {
    type = document.getElementById('indoorType').value;
    dept = document.getElementById('dept').value;
    doctor = document.getElementById('doctor').value;
    procedure = document.getElementById('procedure').value;
  }else if (recordType == 'emergency') {
    doctor = document.getElementById('doctor').value;
  }
      
  let values = {
    'name': document.getElementById('name').value,
    'fee': fee ? fee : null,
    'procedure': procedure ? procedure : null,
    'table': recordType,
    'type': type ? type : null,
    'dept': dept ? dept : null,
    'doctor': doctor
  };
  //name required
  let rname = $("input#name").val();
  if(rname == "" || dept == "" || doctor == ""){
      $("#err-msg").fadeIn().text("Fields can't be empty.");
      $("input#name").focus();
      return false;
  }
  // ajax
  $.ajax({
      type:"POST",
      url: `backend_components/ajax_handler.php?q=upRqRecord&id=${slipId}`,
      data: values, // get all form field value in serialize form
      success: function(){   
      updateRequestStatus(requestId, requestStatus);
        $(function() {
            var Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });
            Toast.fire({
              icon: 'success',
              title: 'Request Has be updated Successfully.'
            })
        });
        autoRefresh();
      }
  });
}

// Update Request Status
function updateRequestStatus(id,status){
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      // console.log("Request Status updated: ",this.responseText);
    }else { 
      // console.log("There is an error in updating the visiting doctor record."); 
    }
  }
  xmlhttp.open("GET",`backend_components/ajax_handler.php?q=upRqStatus&val=${status}&id=${id}`,true);
  xmlhttp.send();
}

// Reset Model Data
function setPopModel() {
  document.getElementById("editBody").innerHTML= "";
}

// Get Request Data
function getRequestNotification(){
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("notificationId").innerHTML=this.responseText;
      console.log("Response From Request: ", this.responseText);
    }
  }
  xmlhttp.open("GET","backend_components/slip_handler.php?q=GET_ALL_REQUEST_NOTIFICATION",true);
  xmlhttp.send();
}

// Get Request Data Record
function openRequestedRecord(str) {
  let elem = document.getElementById("view-record");
  recordRefId = elem.getAttribute("data-refId"); 
  requestId = elem.getAttribute("data-id");
  requestStatus = elem.getAttribute("data-status");
  if (str=="") {return;}
      let xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("editBody").innerHTML=this.responseText;
          // console.log("Response From Request Record: ", this.responseText);
        }
      }
    xmlhttp.open("GET","backend_components/slip_handler.php?q=VIEW-REQUEST-RECORD&id="+str+"&val="+recordType,true);
    xmlhttp.send();
}

// Delete Record and update request status
function deleteRequestRecord(str) {
  let elem = document.getElementById("deleteRecord");
  recordType = elem.getAttribute("data-name"); 
  let recordId = elem.getAttribute("data-id");
  let val = confirm('Please confirm deletion');
    if (val === true) {
      if (str=="") {return;}
        let xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            $(function() {
                var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });
                Toast.fire({
                  icon: 'success',
                  title: 'Requested Record Deleted Successfully.'
                })
            });
            autoRefresh();
          }
        }
      xmlhttp.open("GET","backend_components/slip_handler.php?q=REMOVE-REQUEST-RECORD&id="+str+"&rid="+recordId+"&val="+recordType,true);
      xmlhttp.send();
    }else {
      // Do whatever if the user clicks cancel.
      return;
    }
}
// Cancel Request
function cancelRequest(str){
  let val = confirm('Please confirm deletion');
    if (val === true) {
      if (str=="") {return;}
      // Do whatever if the user clicked ok.
      let xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          $(function() {
              var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });
              Toast.fire({
                icon: 'success',
                title: 'Request Cancelled Successfully.'
              })
          });
          autoRefresh();
        }
      }
      xmlhttp.open("GET","backend_components/ajax_handler.php?q=cancelRqStatus&id="+str,true);
      xmlhttp.send();
    } else {
      // Do whatever if the user clicks cancel.
      return;
    }
}

// Slip Type and Subtype Model Popup Function
$(function () {
  $('#select').hide();
  $('#subType').prop('required',false);
  $('#type').change(function () {
      $('#select').hide();
      $('#subType').prop('required',false);
      if (this.options[this.selectedIndex].value == 'INDOOR') {
          $('#select').show();
          $('#subType').prop('required',true);
      }
  });
});


// Extra Functions 

  // Get Request Data against slip Id
  function getRequestById(str){
    let req = str.getAttribute("data-uuid");
      if (req=="") {return;}
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("requestBody").innerHTML=this.responseText;
            // console.log("Response From Slip Request: ", this.responseText);
          }
        }
      xmlhttp.open("GET",`backend_components/slip_handler.php?q=VIEW_REQUEST_BY_ID&id=${req}`,true);
      xmlhttp.send();
  }
  
  // Switch Doctor List 
  function switchDocList(e) { 
    let meDoctor = document.getElementById("meDoc");
    let vtDoctor = document.getElementById("vtDoc"); 
    let selDoctor = document.getElementById("doctor");
    let selDept = document.getElementById("dept");
    let selvDoctor = document.getElementById("visitDoctor");
    let selvDept = document.getElementById("visitDept");

    if (e == 0) {
      meDoctor.style.display = "flex"; 
      vtDoctor.style.display = "none"; 
      selDoctor.required = true; 
      selDept.required = true;

      selvDoctor.required = false; 
      selvDept.required = false;
    }
    if (e == 1) {
      meDoctor.style.display = "none"; 
      vtDoctor.style.display = "flex"; 
      selvDoctor.required = true; 
      selvDept.required = true;

      selDoctor.required = false; 
      selDept.required = false;
    }
  }
  // Dept Change Request for Regular Doctor
  function showDoctor(str) {
    if (str=="") {return;}
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("doctor").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET","getDoctor.php?q="+str,true);
    xmlhttp.send();
  }
  // Update Request for visiting Doctor 
  function updateDoctor() {
    let visitId = document.getElementById("visitDoctor");
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        visitId.innerHTML=this.responseText;
      }
      // else { 
      //   console.log("There is an error in updating the visiting doctor record."); 
      // }
    }
    xmlhttp.open("GET","getDoctor.php?q=0",true);
    xmlhttp.send();
  }
  // Show add Visitor Doctor Field
  function showFields() {
    let showVtField = document.getElementById("showVisitField");
    if (showVtField.style.display === "none") {
      showVtField.style.display = "block";
    } else {
      showVtField.style.display = "none";
    }
  }
  // Ajax Call for Adding New Visiting Doctor 
  function saveVtDoctor() {
    let values = {
          'docName': document.getElementById('docName').value,
          'userId': document.getElementById('userId').value
        };
        //name required
        let dname = $("input#docName").val();
        if(dname == ""){
            $("#err-msg").fadeIn().text("Doctor Name required.");
            $("input#docName").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/ajax_handler.php?q=adVtDoc",
            data: values, // get all form field value in serialize form
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
  }
  function autoRefresh(){
    setTimeout(() => {
      window.location = window.location.href;
    }, 1000);    
  }