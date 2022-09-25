// Add unique Id for New Bill
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
if (document.getElementById("billId")) {document.getElementById("billId").value = String(uuid).slice(-6) +'-BID';}

// let disDate = new Date();
// document.getElementById('disdate').value = disDate;
       
function genSurgeryTotal() {
  let adCharge = document.getElementById("adCharge").value;
  let surCharge = document.getElementById("surCharge").value;
  let anesCharge = document.getElementById("anesCharge").value;
  let opCharge = document.getElementById("opCharge").value;
  let chargeLR = document.getElementById("chargeLR").value;
  let pedCharge = document.getElementById("pedCharge").value;
  let prChargeThree = document.getElementById("prChargeThree").value;
  let nurCharge = document.getElementById("nurCharge").value;
  let nurStCharge = document.getElementById("nurStCharge").value;
  let moCharge = document.getElementById("moCharge").value;
  let conCharge = document.getElementById("conCharge").value;
  let ctg = document.getElementById("ctg").value;
  let rrCharge = document.getElementById("rrCharge").value;
  let other = document.getElementById("other").value;
  let totalBill = +adCharge + +surCharge + +anesCharge+ +opCharge + +chargeLR + +pedCharge+ +prChargeThree + +nurCharge+ +nurStCharge + +moCharge+ +conCharge+ +ctg+ +rrCharge+ +other;
  document.getElementById("totalBill").value = totalBill;
  console.log("this is the total result:" ,totalBill);
}

function genIllnessTotal() {
  let prChargeThree = document.getElementById("prChargeThree").value;
  let moChargeTwo = document.getElementById("moChargeTwo").value;
  let monChargeTwo = document.getElementById("monChargeTwo").value;
  let oxChargeTwo = document.getElementById("oxChargeTwo").value;
  let nurChargeTwo = document.getElementById("nurChargeTwo").value;
  let conChargeThree = document.getElementById("conChargeThree").value;
  
  let totalBill = +prChargeThree + +moChargeTwo + +monChargeTwo+ +oxChargeTwo + +nurChargeTwo + +conChargeThree;
  document.getElementById("totalBill").value = totalBill;
  console.log("this is the total result:" ,totalBill);
}

function feeFunction(fee) {
  let finalBill = document.getElementById('finalBill');
  let discount = document.getElementById('discount');
  finalBill.value = fee.value - discount.value;
  console.log("this is the final result:" ,finalBill.value);
}

function discFunction(discount) {
  let finalBill = document.getElementById('finalBill');
  let totalBill = document.getElementById('totalBill');
  finalBill.value = totalBill.value - discount.value;
  console.log("this is the final result:" ,finalBill.value);
}

function getFee(fee) {
  let finalBill = document.getElementById('finalBill');
  let discount = document.getElementById('discount');
  finalBill.value = fee.value - discount.value;
  console.log("this is the final result:" ,finalBill.value);
}

function getMonTotal(){
  let monChargeOne = document.getElementById("monChargeOne").value;
  document.getElementById("monChargeTwo").value = monChargeOne*1200;
}

function getPrTotal(){
  let prChargeOne = document.getElementById("prChargeOne").value;
  let prChargeTwo = document.getElementById("prChargeTwo").value;
  document.getElementById("prChargeThree").value = prChargeOne*prChargeTwo;
}

function getNurTotal(){
  let nurChargeOne = document.getElementById("nurChargeOne").value;
  document.getElementById("nurChargeTwo").value = nurChargeOne*1000;
}

function getOxTotal(){
  let oxChargeOne = document.getElementById("oxChargeOne").value;
  document.getElementById("oxChargeTwo").value = oxChargeOne*7000;
}

function getConDay(day){
  document.getElementById("conChargeThree").value = document.getElementById("conChargeOne").value * day.value;
}

function getConCharge(charge) {
  let conChargeTwo = document.getElementById('conChargeTwo');
  let conChargeThree = document.getElementById('conChargeThree');
  conChargeThree.value = charge.value * conChargeTwo.value;
  console.log("this is the final result:" ,conChargeThree.value);
}
function getMoTotal(){
  let moChargeOne = document.getElementById("moChargeOne").value;
  document.getElementById("moChargeTwo").value = moChargeOne*1000;
}

  function getStitchInTotal(){
    let stitchIn = document.getElementById("stitchIn").value;
    document.getElementById("stitchInTotal").value = stitchIn*350;
  }

  function getStitchOutTotal(){
    let stitchOut = document.getElementById("stitchOut").value;
    document.getElementById("stitchOutTotal").value = stitchOut*150;
  }

  // Emergency Calculate Total Script
  function calculateEmergencyTotal() {
      let moCharge = document.getElementById("moCharge").value;
      let injectionIM = document.getElementById("injectionIM").value;
      let injectionIV = document.getElementById("injectionIV").value;
      let ivLine = document.getElementById("ivLine").value;
      let infusionAntibiotic = document.getElementById("infusionAntibiotic").value;
      let stitchInTotal = document.getElementById("stitchInTotal").value;
      let stitchOutTotal = document.getElementById("stitchOutTotal").value;
      let bsf = document.getElementById("bsf").value;
      let shortStay = document.getElementById("shortStay").value;
      let bp = document.getElementById("bp").value;

      let ecg = document.getElementById("ecg").value;
      let drip = document.getElementById("drip").value;
      let venofar = document.getElementById("venofar").value;
      let stomachWash = document.getElementById("stomachWash").value;
      let foleyCath = document.getElementById("foleyCath").value;
      let ctg = document.getElementById("ctg").value;
      let dressing = document.getElementById("dressing").value;
      let nebulization = document.getElementById("nebulization").value;
      let monChargeTwo = document.getElementById("monChargeTwo").value;
      let enema = document.getElementById("enema").value;

      let bloodTransfusion = document.getElementById("bloodTransfusion").value;
      let ett = document.getElementById("ett").value;
      let ascitic = document.getElementById("ascitic").value;
      let pleuralFuid = document.getElementById("pleuralFuid").value;
      let lumberPuncture = document.getElementById("lumberPuncture").value;

      let other1 = document.getElementById("other1").value;
      let other2= document.getElementById("other2").value;
      let other3 = document.getElementById("other3").value;
      let other4 = document.getElementById("other4").value;
      let other5 = document.getElementById("other5").value;
      let other6 = document.getElementById("other6").value;
      let other7 = document.getElementById("other7").value;
      let other8 = document.getElementById("other8").value;
      let other9 = document.getElementById("other9").value;
      let other10 = document.getElementById("other10").value;
      let other11 = document.getElementById("other11").value;
      let other12 = document.getElementById("other12").value;

      let totalBill = +moCharge+ +injectionIM+ +injectionIV+ +ivLine+ +infusionAntibiotic+ +stitchInTotal+ +stitchOutTotal+ +bsf+ +shortStay+ +bp+ +ecg+ +drip+ +venofar+ +stomachWash+ +foleyCath+ +ctg+ +dressing+ +nebulization+ +monChargeTwo+ +enema+ +bloodTransfusion+ +ett+ +ascitic+ +pleuralFuid+ +lumberPuncture+ +other1+ +other2+ +other3+ +other4+ +other5+ +other6+ +other7+ +other8+ +other9+ +other10+ +other11+ +other12;
      document.getElementById("totalBill").value = totalBill;
      console.log("this is the total result:" ,totalBill);
  }

  function discFunction(discount) {
    let finalBill = document.getElementById('finalBill');
    let totalBill = document.getElementById('totalBill');
    finalBill.value = totalBill.value - discount.value;
    console.log("this is the final result:" ,finalBill.value);
  }

  // ADD EMERGENCY BILL AJAX CALL
  $(document).ready(function($){
    // on submit...
    $('#addEmergencyBill').submit(function(e){
        e.preventDefault();
        $("#err-msg").hide();
        //slipId required
        let slipId = $("input#slipId").val();
        //billId required
        let billId = $("input#billId").val();
        //mrId required
        let mrId = $("input#mrId").val();
        //name required
        let name = $("input#name").val();
        //phone required
        let phone = $("input#phone").val();
        if(name == "" || slipId == "" || phone == "" || mrId == "" || billId == ""){
            $("#err-msg").fadeIn().text("Required Field.");
            $("input#slipId").focus();
            $("input#billId").focus();
            $("input#mrId").focus();
            $("input#name").focus();
            $("input#phone").focus();
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "backend_components/bill_handler.php?q=ADD_EMERGENCY_BILL",
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
                printBill(res.data['id'], res.data['type']);
                // autoRefresh();
              });
            }
        });
    });  
    return false;
  });

// Bill Print Function
function printBill(id,type) {
  if (type == 'EMERGENCY_BILL') {
    location.href =`emergency_bill_print.php?sid=${id}`;
  }
}
