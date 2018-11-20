
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Mortgage Affordability Calculator - How Much House Can I Afford</title>

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

var VmonthlyRent = sn(document.calc.monthlyRent.value);
var VintRate = sn(document.calc.intRate.value);
var VnumYears = sn(document.calc.numYears.value);

if(VmonthlyRent == 0) {
  alert("Please enter your monthly rent payment.");
  document.calc.monthlyRent.focus();
} else
if(VintRate == 0) {
  alert("Please enter the expected mortgage interest rate.");
  document.calc.intRate.focus();
} else
if(VnumYears == 0) {
  alert("Please enter the number of years you will finance the home for.");
  document.calc.numYears.focus();
} else {

  var Vtaxes = sn(document.calc.taxes.value);
  var Vinsurance = sn(document.calc.insurance.value);

  var VmonthlyTaxes = Vtaxes / 12;
  var VmonthlyIns = Vinsurance / 12;

  var Vreduction = Number(VmonthlyTaxes) + Number(VmonthlyIns);
  VmonthlyRent = Number(VmonthlyRent) - Number(Vreduction);

  var i = VintRate;
  if(i >= 1.0) {
    i = i / 100.0;
  }
  i /= 12;

  var noMonths = VnumYears * 12;

  //ZERO DOWN
  var pow_0 = 1;

  for (var j_0 = 0; j_0 < noMonths; j_0++) {
     pow_0 = pow_0 * (1 + i);
  }

  var Rprincipal_0 = ((pow_0 - 1) * VmonthlyRent) / (pow_0 * i);

  document.calc.mortgageSize_0.value = fns(Rprincipal_0,2,1,1,1);

  var VdownPayment_0 = 0;

  document.calc.downPayment_0.value = fns(VdownPayment_0,2,1,1,1);

  var VhomePrice_0 = Number(Rprincipal_0) + Number(VdownPayment_0);
  document.calc.homePrice_0.value = fns(VhomePrice_0,2,1,1,1);

  //5% DOWN
  var pow_5 = 1;

  for (var j_5 = 0; j_5 < noMonths; j_5++) {
     pow_5 = pow_5 * (1 + i);
  }

  var Rprincipal_5 = ((pow_5 - 1) * VmonthlyRent) / (pow_5 * i);

  document.calc.mortgageSize_5.value = fns(Rprincipal_5,2,1,1,1);

  var VdownPayment_5 = Number(Rprincipal_5 / .95) - Number(Rprincipal_5);

  document.calc.downPayment_5.value = fns(VdownPayment_5,2,1,1,1);

  var VhomePrice_5 = Number(Rprincipal_5) + Number(VdownPayment_5);
  document.calc.homePrice_5.value = fns(VhomePrice_5,2,1,1,1);

  //10% DOWN
  var pow_10 = 1;

  for (var j_10 = 0; j_10 < noMonths; j_10++) {
     pow_10 = pow_10 * (1 + i);
  }

  var Rprincipal_10 = ((pow_10 - 1) * VmonthlyRent) / (pow_10 * i);

  document.calc.mortgageSize_10.value = fns(Rprincipal_10,2,1,1,1);

  var VdownPayment_10 = Number(Rprincipal_10 / .90) - Number(Rprincipal_10);

  document.calc.downPayment_10.value = fns(VdownPayment_10,2,1,1,1);

  var VhomePrice_10 = Number(Rprincipal_10) + Number(VdownPayment_10);
  document.calc.homePrice_10.value = fns(VhomePrice_10,2,1,1,1);

  jQuery('.email-my-results').removeClass('hidden');
}
}


function clear_results(form) {

document.calc.mortgageSize_0.value = "";
document.calc.downPayment_0.value = "";
document.calc.homePrice_0.value = "";
document.calc.mortgageSize_5.value = "";
document.calc.downPayment_5.value = "";
document.calc.homePrice_5.value = "";
document.calc.mortgageSize_10.value = "";
document.calc.downPayment_10.value = "";
document.calc.homePrice_10.value = "";

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
<table class="fmcalc" cellpadding="2" cellspacing="0">
<tbody>
<tr>
<td colspan="4">
<br><h4 align="center">Mortgage Affordability Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" nowrap="">
Rent payment you can afford:
</td>
<td align="center">
<input type="text" name="monthlyRent" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" nowrap="">
Expected mortgage interest rate:
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" nowrap="">
Mortgage term (years):
</td>
<td align="center">
<input type="text" name="numYears" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" nowrap="">
Expected annual property taxes:
</td>
<td align="center">
<input type="text" name="taxes" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" nowrap="">
Expected annual insurance:
</td>
<td align="center">
<input type="text" name="insurance" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="How Much House Can I Afford?" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
<b>
Downpayment %
</b>
</td>
<td align="center">
<b>
0%
</b>
</td>
<td align="center">
<b>
5%
</b>
</td>
<td align="center">
<b>
10%
</b>
</td>
</tr>
<tr>
<td nowrap="">
Mortgage you can afford:
</td>
<td align="center">
<input type="text" name="mortgageSize_0" size="14">
</td>
<td align="center">
<input type="text" name="mortgageSize_5" size="14">
</td>
<td align="center">
<input type="text" name="mortgageSize_10" size="14">
</td>
</tr>
<tr>
<td nowrap="">
Down payment amount:
</td>
<td align="center">
<input type="text" name="downPayment_0" size="14">
</td>
<td align="center">
<input type="text" name="downPayment_5" size="14">
</td>
<td align="center">
<input type="text" name="downPayment_10" size="14">
</td>
</tr>
<tr>
<td nowrap="">
Price of home:
</td>
<td align="center">
<input type="text" name="homePrice_0" size="14">
</td>
<td align="center">
<input type="text" name="homePrice_5" size="14">
</td>
<td align="center">
<input type="text" name="homePrice_10" size="14">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
