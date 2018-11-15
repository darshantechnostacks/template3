
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Rebate vs. Financing Comparison Calculator</title>

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




function computeFixedInterestCost(principal, intRate, pmtAmt) { 

   var i = eval(intRate);
   i /= 100;
   i /= 12;

   var prin = eval(principal);
   var intPort = 0;
   var accumInt = 0;
   var prinPort = 0;
   var pmtCount = 0;
   var testForLast = 0;


   //CYCLES THROUGH EACH PAYMENT OF GIVEN DEBT
   while(prin > 0) {

      testForLast = (prin * (1 + i));

      if(pmtAmt < testForLast) {
         intPort = prin * i;
         accumInt = eval(accumInt) + eval(intPort);
         prinPort = eval(pmtAmt) - eval(intPort);
         prin = eval(prin) - eval(prinPort);
      } else {
      //DETERMINE FINAL PAYMENT AMOUNT
      intPort = prin * i;
      accumInt = eval(accumInt) + eval(intPort);
      prinPort = prin;
      prin = 0;
      }

      pmtCount = eval(pmtCount) + eval(1);

      if(pmtCount > 1000 || accumInt > 1000000000) {
         prin = 0;
      }

   }

return accumInt;

}




function ATEarnSingleDep(prin, intRate, numMonths, numCompPerYr, fedStTaxRate) {

var i = 0;
var intEarn = 0;
var singleFV = prin;

if(intRate >= 1) {
   intRate /= 100;
}

if(fedStTaxRate == "" || fedStTaxRate == 0) {
   fedStTaxRate = 0;
} else {
   if(fedStTaxRate >= 1) {
      fedStTaxRate /= 100;
   }
}

if(numCompPerYr == "" || numCompPerYr == 0) {
   numCompPerYr = 12;
}
intRate /= numCompPerYr;

var numPeriods = numMonths / 12 * numCompPerYr;

var accumAnnInt = 0;
var accumTotEarn = 0;
var tax = 0;

for(i=1; i <= numPeriods; i++) {
   intEarn = singleFV * intRate;
   accumAnnInt = eval(accumAnnInt) + eval(intEarn);
   accumTotEarn = eval(accumTotEarn) + eval(intEarn);
   singleFV = eval(singleFV) + eval(intEarn);

   if(i % numCompPerYr == 0) {
      tax = fedStTaxRate * accumAnnInt;
      accumTotEarn = eval(accumTotEarn) - eval(tax);
      singleFV = eval(singleFV) - eval(tax);
      accumAnnInt = 0;
   }
   
}

return accumTotEarn;

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

   var VrebateAmt = sn(document.calc.rebateAmt.value);
   var VsaveIntRate = sn(document.calc.saveIntRate.value);
   var Vprice = sn(document.calc.price.value);
   var Vmonths = sn(document.calc.months.value);
   var VtaxRate = sn(document.calc.taxRate.value);

   if(document.calc.specIntRate.value.length == 0) {
      alert("Please the special dealer financing rate.");
      document.calc.specIntRate.focus();
   } else
   if(document.calc.regIntRate.value.length == 0) {
      alert("Please the regular (non-rebate) financing rate.");
      document.calc.regIntRate.focus();
   } else
   if(VrebateAmt == 0) {
      alert("Please the amount of the rebate.");
      document.calc.rebateAmt.focus();
   } else
   if(VsaveIntRate == 0) {
      alert("Please enter your savings interest rate.");
      document.calc.saveIntRate.focus();
   } else
   if(Vprice == 0) {
      alert("Please enter the price of your vehicle.");
      document.calc.price.focus();
   } else
   if(Vmonths == 0) {
      alert("Please enter the loan term expressed as number of months.");
      document.calc.months.focus();
   } else
   if(VtaxRate == 0) {
      alert("Please enter your combined state and federal tax rate.");
      document.calc.taxRate.focus();
   } else {

      var VspecIntRate = sn(document.calc.specIntRate.value);
      var VregIntRate = sn(document.calc.regIntRate.value);
      var VdownPay = sn(document.calc.downPay.value);
      var VrebateApply = document.calc.rebateApply.selectedIndex;

      //CALCULATE POTENTIAL INTEREST EARNINGS ON REBATE
      var savingsEarn = ATEarnSingleDep(VrebateAmt, VsaveIntRate, Vmonths, 12, VtaxRate);

      //COMPUTE PRINCIPAL & PAYMENT FOR SPECIAL FINANCING
      var VspecialPrin = Number(Vprice) - Number(VdownPay);
      var VspecialPmt = computeMonthlyPayment(VspecialPrin, Vmonths, VspecIntRate);

      //COMPUTE INTEREST COST FOR SPECIAL FINANCING
      var VspecialIntCost = computeFixedInterestCost(VspecialPrin, VspecIntRate, VspecialPmt);


      //IF APPLYING REBATE TO DOWNPAYMENT
      if(VrebateApply == 1) {
         VdownPay = Number(VdownPay) + Number(VrebateAmt);
      }

      //COMPUTE INTEREST COST FOR REBATE FINANCING
      var VrebatePrin = Number(Vprice) - Number(VdownPay);
      var VrebatePmt = computeMonthlyPayment(VrebatePrin, Vmonths, VregIntRate);

      var VrebateIntCost = computeFixedInterestCost(VrebatePrin, VregIntRate, VrebatePmt);

      //SUBTRACT REBATE FROM REBATE LOAN INTEREST COST
      VrebateIntCost = Number(VrebateIntCost) - Number(VrebateAmt);

      //IF INVEST REBATE INTO SAVINGS, SUBTRACT INT EARN FROM INT COST
      if(VrebateApply == 0) {
         VrebateIntCost = Number(VrebateIntCost) - Number(savingsEarn);
      }

      var VloanType = "";
      var Vsavings = 0;

      if(VrebateIntCost < VspecialIntCost) {
         Vsavings = Number(VspecialIntCost) - Number(VrebateIntCost);
         VloanType = "The <strong>Rebate</strong> is the better deal, saving you " + fns(Vsavings,2,1,1,1) + "";
         VloanType += " over the Special Dealer Financing scenario.";
      } else {
         Vsavings = Number(VrebateIntCost) - Number(VspecialIntCost);
         VloanType = "The <strong>Special Dealer Financing</strong> is the better deal";
         VloanType += ", saving you " + fns(Vsavings,2,1,1,1) + " over the Rebate scenario.";
      }

      var v_summary_cell = document.getElementById("summary");
      v_summary_cell.innerHTML = "<font face='arial'><small><strong>Result:</strong> " + VloanType + "</small></font>";
      jQuery('.email-my-results').removeClass('hidden');

   }
}

function clear_results(form) {

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

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
<td colspan="2">
<br><h4 align="center">Car Rebate vs. Financing Comparison Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td nowrap="">
Special interest rate:
</td>
<td align="center">
<input type="text" name="specIntRate" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Regular interest rate:
</td>
<td align="center">
<input type="text" name="regIntRate" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Cash rebate amount:
</td>
<td align="center">
<input type="text" name="rebateAmt" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Your savings interest rate:
</td>
<td align="center">
<input type="text" name="saveIntRate" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Car purchase price:
</td>
<td align="center">
<input type="text" name="price" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Down payment amount:
</td>
<td align="center">
<input type="text" name="downPay" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Loan term (months):
</td>
<td align="center">
<input type="text" name="months" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Your combined state and federal tax rate:
</td>
<td align="center">
<input type="text" name="taxRate" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Rebate will be:
</td>
<td align="center">
<select name="rebateApply" size="1" onchange="clear_results(this.form)">
<option value="0">Invested in savings</option>
<option value="1">Added to downpayment</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" name="compute" value="Calculate Savings" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
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
