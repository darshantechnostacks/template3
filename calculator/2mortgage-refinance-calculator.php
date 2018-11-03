
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Mortgage Refinance Calculator</title>

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




function computeNPR(principal, intRate, pmtAmt) {

   var i = eval(intRate);
   if(i >= 1) {
   i /= 100;
   }
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

      if(pmtCount > 1000 || accumInt > 1000000) {
         prin = 0;
      }

   }

return pmtCount;

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

   var alert_txt = "";
   var sum_cell = document.getElementById("summary");

   var pmt1 = sn(document.calc.payment.value);
   var prin = sn(document.calc.principal.value);
   var i1 = sn(document.calc.intRate.value);

   if(document.calc.principal.value == "") {
      alert("Please enter the your mortgage's current principal balance.");
      document.calc.principal.focus();
   } else
   if(document.calc.payment.value == "") {
      alert("Please enter the amount of your mortgage payment.");
      document.calc.payment.focus();
   } else 
   if(document.calc.intRate.value == "") {
      alert("Please enter your mortgage's current annual interest rate.");
      document.calc.intRate.focus();
   } else 
   if((prin * (i1/100/12)) > pmt1) {
      alert_txt += "The payment amount you entered ($" + fn(pmt1,2,1) + ") is too small to pay off";
      alert_txt += " your mortgage ($" + fn(prin,2,1) + ")  within an accepted time frame. Please";
      alert_txt += " increase the payment amount until you no longer receive this message.";
      alert(alert_txt);
      document.calc.payment.focus();
   } else
   if(document.calc.intRate2.value == "") {
      alert("Please enter the annual interest rate you'll be refinancing at.");
      document.calc.intRate2.focus();
   } else
   if(document.calc.nper2.value == "") {
      alert("Please enter the number of years you are refinancing for.");
      document.calc.nper2.focus();
   } else
   if(document.calc.closingCost.value == "") {
      alert("Please enter the closing cost percentage points.");
      document.calc.closingCost.focus();
   } else
   if(sn(document.calc.intRate2.value) > sn(document.calc.intRate.value)) {
      alert_txt = "You've entered a refinancing rate that is higher than your present rate.  ";
      alert_txt += "The refinancing rate must be lower than your present rate in ";
      alert_txt += "order for this calculator to work.";
      alert(alert_txt);
   } else {





      var prin1 = prin;

      var closeCostAmt = 0;
      var VcloseCost = sn(document.calc.closingCost.value);
      if(document.calc.ptsDol.selectedIndex == 0) {
         var closeCostPerc = Number(VcloseCost) / 100;
         closeCostAmt = closeCostPerc * prin;
      } else {
         closeCostAmt = VcloseCost;
      }

      var i2 = sn(document.calc.intRate2.value);

      var v_orgInt = computeFixedInterestCost(prin, i1, pmt1);
      document.calc.origInt.value = "$" + fn(v_orgInt,2,1);

      var prin2 = 0;

      if(document.calc.yesNo.selectedIndex == 0) {
         prin2 = prin;
      } else {
         prin2 = Number(prin) + Number(closeCostAmt);
      }

      var v_years_2 = sn(document.calc.nper2.value);
      var Vnper2 = v_years_2 * 12;

      var fpayment2 = computeMonthlyPayment(prin2, Vnper2, i2);
      fpayment2 = Math.round(fpayment2*100)/100;
      document.calc.payment2.value = "$" + fn(fpayment2,2,1);


      var fmoSave = Number(pmt1) - Number(fpayment2);

      document.calc.moSave.value = "$" + fn(fmoSave,2,1);
    
      var ftotInt2 = computeFixedInterestCost(prin2, i2, fpayment2);
      document.calc.totInt2.value = "$" + fn(ftotInt2,2,1);

      var fintSave = Number(v_orgInt) - Number(ftotInt2);

      if(fintSave <= 0) {
         document.calc.intSave.value = "$0.00";
      } else {
         document.calc.intSave.value = "$" + fn(fintSave,2,1);
      }

      var prin3 = prin2;
      var prin4 = prin;

      var intPort3 = 0;
      var intPort4 = 0;

      var prinPort3 = 0;
      var prinPort4 = 0;

      var accumInt3 = 0;
      var accumInt4 = 0;

      var accumPrin3 = 0;
      var accumPrin4 = 0;

      var amortIntSave = 0;

      var count3 = 0;

      while(amortIntSave < closeCostAmt) {

         intPort3 = prin3 * (i2/100/12);
         intPort4 = prin4 * (i1/100/12);

         prinPort3 = Number(fpayment2) - Number(intPort3);
         prinPort4 = Number(pmt1) - Number(intPort4);

         prin3 = Number(prin3) - Number(prinPort3);
         prin4 = Number(prin4) - Number(prinPort4);

         accumPrin3 = Number(accumPrin3) + Number(prinPort3);
         accumPrin4 = Number(accumPrin4) + Number(prinPort4);

         accumInt3 = Number(accumInt3) + Number(intPort3);
         accumInt4 = Number(accumInt4) + Number(intPort4);

         amortIntSave = Number(accumInt4) - Number(accumInt3);

         count3 = Number(count3) + Number(1);

         if(count3 > 600) {break; } else {continue; }

      }


      document.calc.closeMo.value = count3;

      var fnetSave = Number(fintSave) - Number(closeCostAmt);
   
      var pmtUpDown = "";
      if(fpayment2 > pmt1) {
         pmtUpDown = "increase by $" + fn(Number(fpayment2) - Number(pmt1),2,1) + "";
      } else {
         pmtUpDown = "decrease by $" + fn(Number(pmt1) - Number(fpayment2),2,1) + "";
      }

      var intSaveYesNo = "";
      if(v_orgInt < ftotInt2) {
         intSaveYesNo = "pay an additional $" + fn(Number(ftotInt2) - Number(v_orgInt),2,1) + " in";
         intSaveYesNo += " interest charges over the life of the mortgage.";
      } else {
         intSaveYesNo = "save $" + fn(Number(v_orgInt) - Number(ftotInt2),2,1) + " in ";
         intSaveYesNo += "interest charges over the life of the mortgage. However, in order ";
         intSaveYesNo += "for this refinancing to yield any savings at all you will need to ";
         intSaveYesNo += "stay in your current home for at least " + count3 + " months.  ";
         intSaveYesNo += "That's how long it will take for the monthly interest savings to ";
         intSaveYesNo += "offset the closing costs attributable to refinancing.";
      }

      if(fnetSave <= 0) {
         document.calc.netSave.value = "$0.00";
      } else {
         document.calc.netSave.value = "$" +fn(fnetSave,2,1);
      }

      var v_summary = "If you refinance your current " + fn(i1,2,0) + "% ";
      v_summary += "mortgage to a " + fn(i2,2,0) + "% mortgage, your ";
      v_summary += "monthly payment will " + pmtUpDown + " and you will " + intSaveYesNo + "";

      sum_cell.innerHTML = "<font face='arial'><small>" + v_summary + "</small></font>";

      jQuery('.email-my-results').removeClass('hidden');
   }
    
}


function clear_results(form) {

   var sum_cell = document.getElementById("summary");
   sum_cell.innerHTML = "";

   document.calc.origInt.value = "";
   document.calc.payment2.value = "";
   document.calc.moSave.value = "";
   document.calc.totInt2.value = "";
   document.calc.intSave.value = "";
   document.calc.closeMo.value = "";
   document.calc.netSave.value = "";

}

function reset_calc(form) {

   if(confirm("Are you sure you want to reset the calculator to the default entries?")) {

      clear_results(document.calc);
      document.calc.reset();


   }

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
<br><h4 align="center">Mortgage Refinance Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter the remaining balance of your mortgage:<br>
</td>
<td align="center">
<input type="text" name="principal" value="150000" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter your monthly mortgage payment (Principal &amp; Interest Only):
</td>
<td align="center">
<input type="text" name="payment" value="997.96" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter your current interest rate:
</td>
<td align="center">
<input align="center" type="text" name="intRate" value="7" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter interest rate you will refinance at:
</td>
<td align="center">
<input type="text" name="intRate2" value="6" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter the number of years you will refinance for:
</td>
<td align="center">
<input type="text" name="nper2" value="30" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter closing costs <select name="ptsDol" size="1" onchange="clear_results(this.form)">
<option value="points">percentage points</option>
<option value="dollar">dollar amount</option>
</select> :<br>
</td>
<td align="center">
<input type="text" name="closingCost" size="15" value="2" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Are you going to finance the closing costs?
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
<input type="reset" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
This is your new mortgage payment if refinanced:
</td>
<td align="center">
<input type="text" name="payment2" size="15">
</td>
</tr>
<tr>
<td>
Monthly Payment Reduction:
</td>
<td align="center">
<input type="text" name="moSave" size="15">
</td>
</tr>
<tr>
<td>
# of months for interest savings to offset closing costs:
</td>
<td align="center">
<input type="text" name="closeMo" size="15">
</td>
</tr>
<tr>
<td>
This is how much interest you will pay under your current monthly payment plan:
</td>
<td align="center">
<input type="text" name="origInt" size="15">
</td>
</tr>
<tr>
<td>
This is how much interest you will pay under your refinanced monthly payment plan:
</td>
<td align="center">
<input type="text" name="totInt2" size="15">
</td>
</tr>
<tr>
<td>
This is how much interest you will save if you refinance:
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
<td align="center" colspan="2">
<div width="90%" align="left" id="summary">
</div>
</td>
</tr>
</tbody>
</table>
</form>
                            
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
