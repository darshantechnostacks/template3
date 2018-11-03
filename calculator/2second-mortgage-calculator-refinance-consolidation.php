
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Second Mortgage Calculator - Refinance & Consolidation</title>

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

var VprincipalFirst = sn(document.calc.principalFirst.value);
var prinFirst = sn(document.calc.principalFirst.value);
var pmtFirst = sn(document.calc.paymentFirst.value);
var iFirst = sn(document.calc.intRateFirst.value);

var iTestFirst = iFirst / 100 / 12 * VprincipalFirst;

var VprincipalSec = sn(document.calc.principalSec.value);
var pmtSec = sn(document.calc.paymentSec.value);
var prinSec = sn(document.calc.principalSec.value);
var iSec = sn(document.calc.intRateSec.value);

var iTestSec = iSec / 100 / 12 * VprincipalSec;

var iRefin = sn(document.calc.intRateRefin.value);
var VnperRefin = sn(document.calc.nperRefin.value);
var closeCostPerc = sn(document.calc.closingCost.value);

if(VprincipalFirst == 0) {
  alert("Please enter the your first mortgage's current principal balance.");
  document.calc.principalFirst.focus();
} else
if(pmtFirst == 0) {
  alert("Please enter the amount of your first mortgage payment.");
  document.calc.paymentFirst.focus();
} else
if(iFirst == 0) {
  alert("Please enter your first mortgage's current annual interest rate.");
  document.calc.intRateFirst.focus();
} else
if(iTestFirst > pmtFirst) {
  alert("The monthly payment for your first mortgage is too low to pay off the mortgage. Please either decrease the principal, decrease the interest rate, or increase the payment amount.");
  document.calc.intRateFirst.focus();
} else
if(VprincipalSec > 0 && pmtSec == 0) {
  alert("Please enter the amount of your second mortgage payment.");
  document.calc.paymentSec.focus();
} else 
if(VprincipalSec > 0 && iSec == 0) {
  alert("Please enter your second mortgage's current annual interest rate.");
  document.calc.intRateSec.focus();
} else
if(VprincipalSec > 0 && iTestSec > pmtSec) {
  alert("The monthly payment for your 2nd mortgage is too low to pay off the mortgage. Please either decrease the principal, decrease the interest rate, or increase the payment amount.");
  document.calc.intRateSec.focus();
} else
if(iRefin == 0) {
  alert("Please enter the annual interest rate you'll be refinancing at.");
  document.calc.intRateRefin.focus();
} else
if(VnperRefin == 0) {
  alert("Please enter the number of years you are refinancing for.");
  document.calc.nperRefin.focus();
} else
if(closeCostPerc == 0) {
  alert("Please enter the closing cost percentage points.");
  document.calc.closingCost.focus(); 
} else {


  var VprinCombo = Number(VprincipalFirst) + Number(VprincipalSec);
  var closeCostAmt = 0;
  var numMtgs = 1;
  if(VprincipalSec > 0) {
     numMtgs = 2;
  }

  if(document.calc.ptsDol.selectedIndex == 0) {
     // if(closeCostPerc >= 1) {
     closeCostPerc = closeCostPerc / 100;
  // } else {
  //    closeCostPerc = closeCostPerc;
  // }
closeCostAmt = closeCostPerc * VprinCombo;
  } else {
     closeCostAmt = sn(document.calc.closingCost.value);
  }

  //CALCULATE FIRST MORTGAGE
  var intPortFirst = 0;
  var prinPortFirst = 0;
  var accumIntFirst = 0;
  var accumPrinFirst = 0;

  if (iFirst >= 1.0) {
     iFirst = iFirst / 100.0;
     var sumiFirst = iFirst;
  }
  var iFirst  = iFirst  / 12;

  var countFirst = 0;

  while(prinFirst > 0) {
     intPortFirst = prinFirst * iFirst;
     prinPortFirst = pmtFirst - intPortFirst;
     prinFirst = prinFirst - prinPortFirst;
     accumPrinFirst = accumPrinFirst + prinPortFirst;
     accumIntFirst = accumIntFirst + intPortFirst;

     countFirst = countFirst + 1;
     if(countFirst > 600) {break; } else {continue; }
  }

  var VorigInt = accumIntFirst;

  //CALCULATE SECOND MORTGAGE IF APPLICABLE

  var intPortSec = 0;
  var prinPortSec = 0;
  var accumIntSec = 0;
  var accumPrinSec = 0;

  if(numMtgs == 2) {

     if (iSec >= 1.0) {
        iSec = iSec / 100.0;
        var sumiSec = iSec;
     }
     var iSec  = iSec  / 12;

     var countSec = 0;

     while(prinSec > 0) {
        intPortSec = prinSec * iSec;
        prinPortSec = pmtSec - intPortSec;
        prinSec = prinSec - prinPortSec;
        accumPrinSec = accumPrinSec + prinPortSec;
        accumIntSec = accumIntSec + intPortSec;

        countSec = countSec + 1;
        if(countSec > 600) {break; } else {continue; }
     }

  }

  var VorigInt = Number(VorigInt) + Number(accumIntSec);

  document.calc.origInt.value = fns(VorigInt,2,1,1,1);
  //document.calc.origInt.value = fns(accumIntFirst,2,1,1,1);

  var VpaymentFirst = sn(document.calc.paymentFirst.value);
  var VpaymentSec = sn(document.calc.paymentSec.value);
  var VpmtCombo = Number(VpaymentFirst) + Number(VpaymentSec);

  //CALCULATE REFINANCING

  if (iRefin >= 1.0) {
     iRefin = iRefin / 100.0;
     var sumiRefin = iRefin;   
  }
  var iRefin  = iRefin  / 12;

  var prinRefin = 0;

  if(document.calc.yesNo.selectedIndex == 0) {
     prinRefin = VprinCombo;
  } else {
     prinRefin = Number(VprinCombo) + Number(closeCostAmt);
  }

  var pow = 1;

  for (var j = 0; j < VnperRefin *12; j++) {
     pow = pow * (1 + iRefin);
  }

  var pmtRefin = (prinRefin * pow * iRefin) / (pow - 1);

  document.calc.paymentRefin.value = fns(pmtRefin,2,1,1,1);

  var VmoSave = Number(VpmtCombo) - Number(pmtRefin);
  if(VmoSave < 0) {
     VmoSave = VmoSave * -1;
     document.calc.moSave.value = fns(VmoSave,2,1,1,1) + "";
  } else {
     document.calc.moSave.value = "(" + fns(VmoSave,2,1,1,1) + ")";
  }

  var VtotIntRefin = (pmtRefin * VnperRefin *12) - prinRefin;
  document.calc.totIntRefin.value = fns(VtotIntRefin,2,1,1,1);

  var VintSave = VorigInt - VtotIntRefin;
     if(VintSave <= 0) {
        document.calc.intSave.value = "$0.00";
     } else {
        document.calc.intSave.value = fns(VintSave,2,1,1,1);
     }

  //CALCULATE NUMBER OF MONTHS FOR SAVINGS TO OFFSET CLOSING COSTS

  var prinFirst2 = sn(document.calc.principalFirst.value);
  var prinSec2 = sn(document.calc.principalSec.value);
  var prinRefin2 = Number(VprincipalFirst) + Number(VprincipalSec);

  var intPortFirst2 = 0;
  var intPortSec2 = 0;
  var intPortRefin = 0;

  var prinPortFirst2 = 0;
  var prinPortSec2 = 0;
  var prinPortRefin2 = 0;

  var accumIntFirst2 = 0;
  var accumIntSec2 = 0;
  var accumIntRefin2 = 0;

  var accumPrinFirst2 = 0;
  var accumPrinSec2 = 0;
  var accumPrinRefin2 = 0;

  var amortIntSave = 0;

  var count3 = 0;

  while(amortIntSave < closeCostAmt) {

     intPortFirst2 = prinFirst2 * iFirst;
     intPortRefin2 = prinRefin2 * iRefin;

     prinPortFirst2 = pmtFirst - intPortFirst2;
     prinPortRefin2 = pmtRefin - intPortRefin2;

     prinFirst2 = prinFirst2 - prinPortFirst2;
     prinRefin2 = prinRefin2 - prinPortRefin2;

     accumPrinFirst2 = accumPrinFirst2 + prinPortFirst2;
     accumPrinRefin2 = accumPrinRefin2 + prinPortRefin2;

     accumIntFirst2 = accumIntFirst2 + intPortFirst2;
     accumIntCombo2 = accumIntFirst2 + accumIntSec2;

     //IF CONSOLIDATIING 2 MORTGAGES
     if(numMtgs == 2) {
        intPortSec2 = prinSec2 * iSec;
        prinPortSec2 = pmtSec - intPortSec2;
        prinSec2 = prinSec2 - prinPortSec2;
        accumPrinSec2 = accumPrinSec2 + prinPortSec2;
        accumIntSec2 = accumIntSec2 + intPortSec2;
     }

     accumIntRefin2 = accumIntRefin2 + intPortRefin2;


     amortIntSave = accumIntCombo2 - accumIntRefin2;

     count3 = count3 + 1;

     if(count3 > 600) {break; } else {continue; }

  }

  if(VintSave <= 0) {
     document.calc.closeMo.value = "N/A";
  } else {
     document.calc.closeMo.value = count3;
  }

  var fnetSave = Number(VintSave) - Number(closeCostAmt);

  var pmtUpDown = "";
  if(pmtRefin > VpmtCombo) {
     pmtUpDown = "increase by " + fns(Number(pmtRefin) - Number(VpmtCombo),2,1,1,1) + "";
  } else {
     pmtUpDown = "decrease by " + fns(Number(VpmtCombo) - Number(pmtRefin),2,1,1,1) + "";
  }

  var intSaveYesNo = "";
  if(VorigInt < VtotIntRefin) {
     intSaveYesNo = "pay an additional " + fns(Number(VtotIntRefin) - Number(VorigInt),2,1,1,1) + " in ";
     intSaveYesNo += "interest charges over the life of the mortgage.";
  } else {
     intSaveYesNo = "save " + fns(Number(VorigInt) - Number(VtotIntRefin),2,1,1,1) + " in interest ";
     intSaveYesNo += "charges over the life of the mortgage. However, in order for this refinancing to yield ";
     intSaveYesNo += "any savings at all you will need to stay in your current home for ";
     intSaveYesNo += "at least " + count3 + " months.  That's how long it will take for the monthly interest savings ";
     intSaveYesNo += "to offset the closing costs attributable to refinancing.";
  }

  if(fnetSave <= 0) {
     document.calc.netSave.value = "$0.00";
  } else {
     document.calc.netSave.value = fns(fnetSave,2,1,1,1);
  }

  var intOneDisplay = sn(document.calc.intRateFirst.value);
  var intTwoDisplay = sn(document.calc.intRateSec.value);
  var intThreeDisplay = sn(document.calc.intRateRefin.value);

  var secMtgText = "";
  if(numMtgs ==2) {
     secMtgText = " and your current " + fns(intTwoDisplay,3,0,2,1) + " mortgage";
  }

  var v_summary = "If you refinance your current " + fns(intOneDisplay,3,0,2,1) + " mortgage" + secMtgText + " into ";
  v_summary += "a single " + fns(intThreeDisplay,3,0,2,1) + " mortgage, your monthly payment ";
  v_summary += "will " + pmtUpDown + " and you will " + intSaveYesNo + "";

  var v_summary_cell = document.getElementById("summary");
  v_summary_cell.innerHTML = "<font face='arial'><small><strong>Summary:</strong> " + v_summary + "</small></font>";

  jQuery('.email-my-results').removeClass('hidden');
}

}


function clear_results(form) {

document.calc.origInt.value = "";
document.calc.paymentRefin.value = "";
document.calc.moSave.value = "";
document.calc.totIntRefin.value = "";
document.calc.intSave.value = "";
document.calc.closeMo.value = "";
document.calc.netSave.value = "";

}

function reset_calc(form) {

var v_summary_cell = document.getElementById("summary");
v_summary_cell.innerHTML = "";

document.calc.reset();

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
<td colspan="3">
<br><h4 align="center">Second Mortgage Calculator – Refinance &amp; Consolidation</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2" align="center"><b>First Mortgage</b></td>
</tr>
<tr>
<td>
Balance due on first mortgage ($):<br>
<small>(call mortgage lender for payoff amount)</small>
</td>
<td align="center">
<input type="text" name="principalFirst" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Current monthly mortgage payment ($):<br>
<small>(principal and interest portion only)</small>
</td>
<td align="center">
<input type="text" name="paymentFirst" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
First mortgage interest rate (%):
</td>
<td align="center">
<input type="text" name="intRateFirst" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center"><b>Second Mortgage (Optional)</b></td>
</tr>
<tr>
<td>
Second mortgage balance due ($):<br>
<small>(call mortgage lender for payoff amount)</small>
</td>
<td align="center">
<input type="text" name="principalSec" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Second mortgage monthly payment ($):<br>
<small>(principal and interest portion only)</small>
</td>
<td align="center">
<input type="text" name="paymentSec" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Second mortgage interest rate (%):
</td>
<td align="center">
<input type="text" name="intRateSec" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center"><b>Refinance - Consolidation</b></td>
</tr>
<tr>
<td>
Interest rate you will be refinancing at (%):
</td>
<td align="center">
<input type="text" name="intRateRefin" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Refinanced loan term (# of years):
</td>
<td align="center">
<input type="text" name="nperRefin" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Expected closing costs <select name="ptsDol" size="1" onchange="clear_results(this.form)">
<option value="points">percentage points</option>
<option value="dollar">dollar amount</option>
</select> :<br>
<small>(Input points as "2" or dollar amount is .02 times principal)</small>
</td>
<td align="center">
<input type="text" name="closingCost" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Will you finance these closing costs?
</td>
<td align="center">
<select name="yesNo" size="1" onchange="clear_results(this.form)">
<option value="No">No</option>
<option value="Yes">Yes</option>
</select>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
This is the new monthly payment if you refinance:
</td>
<td align="center">
<input type="text" name="paymentRefin" size="15">
</td>
</tr>
<tr>
<td>
Monthly payment (decrease)/increase:
</td>
<td align="center">
<input type="text" name="moSave" size="15">
</td>
</tr>
<tr>
<td>
Number of months for interest savings to repay closing costs:
</td>
<td align="center">
<input type="text" name="closeMo" size="15">
</td>
</tr>
<tr>
<td>
Total interest costs with current first and second mortgages:
</td>
<td align="center">
<input type="text" name='origInt" "="' size="15">
</td>
</tr>
<tr>
<td>
Total interest costs after refinance - consolidation:
</td>
<td align="center">
<input type="text" name="totIntRefin" size="15">
</td>
</tr>
<tr>
<td>
Interest savings from refinance - consolidation:
</td>
<td align="center">
<input type="text" name="intSave" size="15">
</td>
</tr>
<tr>
<td>
Net Refinancing Savings (interest savings less closing costs):
</td>
<td align="center">
<input type="text" name="netSave" size="15">
</td>
</tr>
<tr>
<td colspan="2" id="summary">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
