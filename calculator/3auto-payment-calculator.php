
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Auto Payment Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>
function computeMonthlyPayment(prin, numPmts, intRate) {

var pmtAmt = 0;

if(intRate == 0) {
   pmtAmt = prin / numPmts;
} else {
     intRate = intRate / 100.0 / 12;

   var pow = 1;
   for (var j = 0; j < numPmts; j++)
      pow = pow * (1 + intRate);

   pmtAmt = (prin * pow * intRate) / (pow - 1);

}

return pmtAmt;

}




function fn(num, places, comma) {

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
       finNum = "-" + finNum;
    }

  return finNum;
}




function sn(num) {

   num=num.toString();


   var len = num.length;
   var rnum = "";
   var test = "";
   var j = 0;

   var b = num.substring(0,1);
   if(b == "-") {
      rnum = "-";
   }

   for(i = 0; i <= len; i++) {

      b = num.substring(i,i+1);

      if(b == "0" || b == "1" || b == "2" || b == "3" || b == "4" || b == "5" || b == "6" || b == "7" || b == "8" || b == "9" || b == ".") {
         rnum = rnum + "" + b;

      }

   }

   if(rnum == "" || rnum == "-") {
      rnum = 0;
   }

   rnum = Number(rnum);

   return rnum;

}

function computeForm(form) {

   if(document.pmtCalcForm.principal.value == 0 || document.pmtCalcForm.principal.value == "") {
      alert("Please enter the amount financed.");
      document.pmtCalcForm.principal.focus();
   } else
   if(document.pmtCalcForm.intRate.value == 0 || document.pmtCalcForm.intRate.value == "") {
      alert("Please enter the annual interest rate.");
      document.pmtCalcForm.intRate.focus();
   } else {

      var Vprincipal = sn(document.pmtCalcForm.principal.value);
      var VintRate = sn(document.pmtCalcForm.intRate.value);

      var Vpmt12 = computeMonthlyPayment(Vprincipal, 12, VintRate);
      var Vpmt24 = computeMonthlyPayment(Vprincipal, 24, VintRate);
      var Vpmt36 = computeMonthlyPayment(Vprincipal, 36, VintRate);
      var Vpmt48 = computeMonthlyPayment(Vprincipal, 48, VintRate);
      var Vpmt60 = computeMonthlyPayment(Vprincipal, 60, VintRate);
      var Vpmt72 = computeMonthlyPayment(Vprincipal, 72, VintRate);

      document.pmtCalcForm.pmt12.value = "$" + fn(Vpmt12,2,1);
      document.pmtCalcForm.pmt24.value = "$" + fn(Vpmt24,2,1);
      document.pmtCalcForm.pmt36.value = "$" + fn(Vpmt36,2,1);
      document.pmtCalcForm.pmt48.value = "$" + fn(Vpmt48,2,1);
      document.pmtCalcForm.pmt60.value = "$" + fn(Vpmt60,2,1);
      document.pmtCalcForm.pmt72.value = "$" + fn(Vpmt72,2,1);

      jQuery('.email-my-results').removeClass('hidden');
   }
}

function clear_results(form) {

      document.pmtCalcForm.pmt12.value = "";
      document.pmtCalcForm.pmt24.value = "";
      document.pmtCalcForm.pmt36.value = "";
      document.pmtCalcForm.pmt48.value = "";
      document.pmtCalcForm.pmt60.value = "";
      document.pmtCalcForm.pmt72.value = "";

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
                        <form name="pmtCalcForm" method="post" action="#">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<br><h4 align="center">Auto Payment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Amount financed:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual interest rate:
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" name="compute" value="Calculate Auto Payment Amounts" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Auto payment for 12 months:
</td>
<td align="center">
<input type="text" name="pmt12" size="15">
</td>
</tr>
<tr>
<td>
Auto payment for 24 months:
</td>
<td align="center">
<input type="text" name="pmt24" size="15">
</td>
</tr>
<tr>
<td>
Auto payment for 36 months:
</td>
<td align="center">
<input type="text" name="pmt36" size="15">
</td>
</tr>
<tr>
<td>
Auto payment for 48 months:
</td>
<td align="center">
<input type="text" name="pmt48" size="15">
</td>
</tr>
<tr>
<td>
Auto payment for 60 months:
</td>
<td align="center">
<input type="text" name="pmt60" size="15">
</td>
</tr>
<tr>
<td>
Auto payment for 72 months:
</td>
<td align="center">
<input type="text" name="pmt72" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
