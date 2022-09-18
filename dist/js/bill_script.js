
let disDate = new Date();
document.getElementById('disdate').value = disDate;
       
function genSurgeryTotal() {
  var adCharge = document.getElementById("adCharge").value;
  var surCharge = document.getElementById("surCharge").value;
  var anesCharge = document.getElementById("anesCharge").value;
  var opCharge = document.getElementById("opCharge").value;
  var chargeLR = document.getElementById("chargeLR").value;
  var pedCharge = document.getElementById("pedCharge").value;
  var prChargeThree = document.getElementById("prChargeThree").value;
  var nurCharge = document.getElementById("nurCharge").value;
  var nurStCharge = document.getElementById("nurStCharge").value;
  var moCharge = document.getElementById("moCharge").value;
  var conCharge = document.getElementById("conCharge").value;
  var ctg = document.getElementById("ctg").value;
  var rrCharge = document.getElementById("rrCharge").value;
  var other = document.getElementById("other").value;
  var totalBill = +adCharge + +surCharge + +anesCharge+ +opCharge + +chargeLR + +pedCharge+ +prChargeThree + +nurCharge+ +nurStCharge + +moCharge+ +conCharge+ +ctg+ +rrCharge+ +other;
  document.getElementById("totalBill").value = totalBill;
  console.log("this is the total result:" ,totalBill);
}

function genIllnessTotal() {
  var prChargeThree = document.getElementById("prChargeThree").value;
  var moChargeTwo = document.getElementById("moChargeTwo").value;
  var monChargeTwo = document.getElementById("monChargeTwo").value;
  var oxChargeTwo = document.getElementById("oxChargeTwo").value;
  var nurChargeTwo = document.getElementById("nurChargeTwo").value;
  var conChargeThree = document.getElementById("conChargeThree").value;
  
  var totalBill = +prChargeThree + +moChargeTwo + +monChargeTwo+ +oxChargeTwo + +nurChargeTwo + +conChargeThree;
  document.getElementById("totalBill").value = totalBill;
  console.log("this is the total result:" ,totalBill);
}

function feeFunction(fee) {
  var finalBill = document.getElementById('finalBill');
  var discount = document.getElementById('discount');
  finalBill.value = fee.value - discount.value;
  console.log("this is the final result:" ,finalBill.value);
}

function discFunction(discount) {
  var finalBill = document.getElementById('finalBill');
  var totalBill = document.getElementById('totalBill');
  finalBill.value = totalBill.value - discount.value;
  console.log("this is the final result:" ,finalBill.value);
}

function getFee(fee) {
  var finalBill = document.getElementById('finalBill');
  var discount = document.getElementById('discount');
  finalBill.value = fee.value - discount.value;
  console.log("this is the final result:" ,finalBill.value);
}

function getMonTotal(){
  var monChargeOne = document.getElementById("monChargeOne").value;
  document.getElementById("monChargeTwo").value = monChargeOne*1000;
}

function getPrTotal(){
  var prChargeOne = document.getElementById("prChargeOne").value;
  var prChargeTwo = document.getElementById("prChargeTwo").value;
  document.getElementById("prChargeThree").value = prChargeOne*prChargeTwo;
}

function getNurTotal(){
  var nurChargeOne = document.getElementById("nurChargeOne").value;
  document.getElementById("nurChargeTwo").value = nurChargeOne*1000;
}

function getOxTotal(){
  var oxChargeOne = document.getElementById("oxChargeOne").value;
  document.getElementById("oxChargeTwo").value = oxChargeOne*7000;
}

function getConDay(day){
  document.getElementById("conChargeThree").value = document.getElementById("conChargeOne").value * day.value;
}

function getConCharge(charge) {
  var conChargeTwo = document.getElementById('conChargeTwo');
  var conChargeThree = document.getElementById('conChargeThree');
  conChargeThree.value = charge.value * conChargeTwo.value;
  console.log("this is the final result:" ,conChargeThree.value);
}
function getMoTotal(){
  var moChargeOne = document.getElementById("moChargeOne").value;
  document.getElementById("moChargeTwo").value = moChargeOne*1000;
}

// Emergency Scripts
  function calculateTotal() {
      var moCharge = document.getElementById("moCharge").value;
      var injectionIM = document.getElementById("injectionIM").value;
      var injectionIV = document.getElementById("injectionIV").value;
      var ivLine = document.getElementById("ivLine").value;
      var ivInfusion = document.getElementById("ivInfusion").value;
      var stitchInTotal = document.getElementById("stitchInTotal").value;
      var stitchOutTotal = document.getElementById("stitchOutTotal").value;
      var bsf = document.getElementById("bsf").value;
      var shortStay = document.getElementById("shortStay").value;
      var bp = document.getElementById("bp").value;
      var ecg = document.getElementById("ecg").value;
      var other1 = document.getElementById("other1").value;
      var other2= document.getElementById("other2").value;
      var other3 = document.getElementById("other3").value;
      var other4 = document.getElementById("other4").value;
      var other5 = document.getElementById("other5").value;
      var other6 = document.getElementById("other6").value;
      var other7 = document.getElementById("other7").value;
      var other8 = document.getElementById("other8").value;
      var other9 = document.getElementById("other9").value;
      var other10 = document.getElementById("other10").value;
      var other11 = document.getElementById("other11").value;
      var other12 = document.getElementById("other12").value;
      var totalBill = +moCharge+ +injectionIM+ +injectionIV+ +ivLine+ +ivInfusion+ +stitchInTotal+ +stitchOutTotal+ +bsf+ +shortStay+ +bp+ +ecg+ +other1+ +other2+ +other3+ +other4+ +other5+ +other6+ +other7+ +other8+ +other9+ +other10+ +other11+ +other12;
      document.getElementById("totalBill").value = totalBill;
      console.log("this is the total result:" ,totalBill);
  }

  function discFunction(discount) {
    var finalBill = document.getElementById('finalBill');
    var totalBill = document.getElementById('totalBill');
    finalBill.value = totalBill.value - discount.value;
    console.log("this is the final result:" ,finalBill.value);
  }

  function getStitchInTotal(){
    var stitchIn = document.getElementById("stitchIn").value;
    document.getElementById("stitchInTotal").value = stitchIn*300;
  }

  function getStitchOutTotal(){
    var stitchOut = document.getElementById("stitchOut").value;
    document.getElementById("stitchOutTotal").value = stitchOut*100;
  }