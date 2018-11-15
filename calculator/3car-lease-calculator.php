
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Lease Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>
function fns(num, places, comma, type, show) {

var sym_1 = "$";
var sym_2 = ""; 

var isNeg=0;

if(num < 0) {
   num=num*-1;
   isNeg=1;
}

var myDecFact = 1;
var myPlaces = 0;
var myZeros = "";
while(myPlaces < places) {
   myDecFact = myDecFact * 10;
   myPlaces = Number(myPlaces) + Number(1);
   myZeros = myZeros + "0";
}

onum=Math.round(num*myDecFact)/myDecFact;

integer=Math.floor(onum);

if (Math.ceil(onum) == integer) {
decimal=myZeros;
} else{
decimal=Math.round((onum-integer)* myDecFact)
}
decimal=decimal.toString();
if (decimal.length<places) {
    fillZeroes = places - decimal.length;
 for (z=0;z<fillZeroes;z++) {
    decimal="0"+decimal;
    }
 }

if(places > 0) {
  decimal = "." + decimal;
}

if(comma == 1) {
integer=integer.toString();
var tmpnum="";
var tmpinteger="";
var y=0;

for (x=integer.length;x>0;x--) {
tmpnum=tmpnum+integer.charAt(x-1);
y=y+1;
if (y==3 & x>1) {
  tmpnum=tmpnum+",";
  y=0;
}
}

for (x=tmpnum.length;x>0;x--) {
tmpinteger=tmpinteger+tmpnum.charAt(x-1);
}


finNum=tmpinteger+""+decimal;
} else {
  finNum=integer+""+decimal;
}

if(isNeg == 1) {
   if(type == 1 && show == 1) {
      finNum = "-" + sym_1 + "" + finNum + "" + sym_2;
   } else {
      finNum = "-" + finNum;
   }
} else {
   if(show == 1) {
      if(type == 1) {
         finNum = sym_1 + "" + finNum + "" + sym_2;
      } else
      if(type == 2) {
         finNum = finNum + "%";
      }

   }

}

return finNum;
}


function computeForm(form) {

var VlsCost = sn(document.calc.lsCost.value);
var VlsMonths = sn(document.calc.lsMonths.value);
var VlsIntRate = sn(document.calc.lsIntRate.value);

if(VlsCost == 0) {
  alert("Please enter cost of the car you are considering leasing.");
  document.calc.lsCost.focus();
} else
//if(document.calc.lsTaxRate.value == "" || document.calc.lsTaxRate.value == 0) {
//   alert("Please enter the applicable sales tax rate.");
//   document.calc.lsTaxRate.focus();
//} else
if(VlsMonths == 0) {
  alert("Please enter the term of the lease (number of months).");
  document.calc.lsMonths.focus();
} else
if(VlsIntRate == 0) {
  alert("Please enter the new car lending rate.");
  document.calc.lsIntRate.focus();
} else {


  //CALC LEASE COSTS

  var VlsGrossCapCost = VlsCost;

  var VlsDownPay = sn(document.calc.lsDownPay.value);

  var VlsTradeIn = sn(document.calc.lsTradeIn.value);

  var VlsTotCapCostReduct = Number(VlsDownPay) + Number(VlsTradeIn);

  var VlsNetCapCost = Number(VlsGrossCapCost) - Number(VlsTotCapCostReduct);

  var VlsResale = sn(document.calc.lsResale.value);
  var VlsDeprecExp = Number(VlsCost) - Number(VlsResale);

  var VlsTaxRate = sn(document.calc.lsTaxRate.value);
  if(VlsTaxRate >= 1) {
     VlsTaxRate /= 100;
  }

  if(VlsIntRate >= 1) {
     VlsIntRate /= 100;
  }
  var VlsResidual = 0;
  var VlsMonthlyDeprec = 0;
  var VlsMoneyFactor = 0;
  var VlsLeaseRate = 0;
  var VlsMoPmt = 0;

  VlsResidual = Number(VlsCost) - Number(VlsDeprecExp);
  VlsMonthlyDeprec = (Number(VlsNetCapCost) - Number(VlsResidual)) / VlsMonths;

  VlsMoneyFactor = VlsIntRate / 24;
  VlsLeaseRate = (Number(VlsNetCapCost) + Number(VlsResidual)) * VlsMoneyFactor;
  var VpreTaxPmt = Number(VlsMonthlyDeprec) + Number(VlsLeaseRate);
  VlsMoPmt = VpreTaxPmt * (Number(1) + Number(VlsTaxRate));

  var VtaxPmt = Number(VlsMoPmt) - Number(VpreTaxPmt);

  document.calc.lsMoPmt.value = fns(VlsMoPmt,2,1,1,1);

  document.calc.capCost.value = fns(VlsGrossCapCost,2,1,1,1);

  document.calc.leasePrice.value = fns(VlsNetCapCost,2,1,1,1);

  document.calc.residValue.value = fns(VlsResale,2,1,1,1);

  document.calc.deprecFee.value = fns(VlsMonthlyDeprec,2,1,1,1);

  document.calc.leaseFee.value = fns(VlsLeaseRate,2,1,1,1);

  document.calc.preTaxPmt.value = fns(VpreTaxPmt,2,1,1,1);

  document.calc.taxPmt.value = fns(VtaxPmt,2,1,1,1);

  jQuery('.email-my-results').removeClass('hidden');

}

}


function clear_results(form) {

document.calc.lsMoPmt.value = "";
document.calc.capCost.value = "";
document.calc.leasePrice.value = "";
document.calc.residValue.value = "";
document.calc.deprecFee.value = "";
document.calc.leaseFee.value = "";
document.calc.preTaxPmt.value = "";
document.calc.taxPmt.value = "";

}
</script>
</head>
<body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-6815 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none mortgage-payoff-calculator not_home feature-box-none footer-height-tall calculator" itemscope itemtype="https://schema.org/WebPage">
    <div class="site-container">
         <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content mb5">
                    <div class="fmcalc-inner-container fmcalc-ic-c14">
                        <div class="fmcalc-wrapper">
                        <form name="calc" method="post" action="#">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<br><h4 align="center">Car Lease Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td nowrap="">
Purchase price:
</td>
<td align="center">
<input type="text" name="lsCost" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Down payment:
</td>
<td align="center">
<input type="text" name="lsDownPay" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Trade-in allowance:
</td>
<td align="center">
<input type="text" name="lsTradeIn" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Sales tax percentage:
</td>
<td align="center">
<input type="text" name="lsTaxRate" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Term (in months):
</td>
<td align="center">
<input type="text" name="lsMonths" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
New car interest rate (APR):
</td>
<td align="center">
<input type="text" name="lsIntRate" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Car value at end of lease:
</td>
<td align="center">
<input type="text" name="lsResale" size="12" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Car Lease" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td nowrap="">
Monthly payment:
</td>
<td align="center">
<input type="text" name="lsMoPmt" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Capitalized cost:
</td>
<td align="center">
<input type="text" name="capCost" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Lease price:
</td>
<td align="center">
<input type="text" name="leasePrice" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Residual value:
</td>
<td align="center">
<input type="text" name="residValue" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Monthly depreciation fee:
</td>
<td align="center">
<input type="text" name="deprecFee" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Monthly lease fee:
</td>
<td align="center">
<input type="text" name="leaseFee" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Pre-tax montlhy payment:
</td>
<td align="center">
<input type="text" name="preTaxPmt" size="12">
</td>
</tr>
<tr>
<td nowrap="">
Monthly sales tax payment:
</td>
<td align="center">
<input type="text" name="taxPmt" size="12">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
