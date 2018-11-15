
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Payment Calculator</title>

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

   var Vprice = sn(document.calc.price.value);
   var Vmonths = sn(document.calc.months.value);
   var VautoIntRate = sn(document.calc.autoIntRate.value);
   var VequityIntRate = sn(document.calc.equityIntRate.value);
   var VsaveRate = sn(document.calc.saveRate.value);

   if(Vprice == 0) {
      alert("Please enter the purchase price of the car.");
      document.calc.price.focus();
   } else
   if(Vmonths == 0) {
      alert("Please enter the number of months you will be financing the car for.");
      document.calc.months.focus();
   } else
   if(document.calc.autoIntRate.value.length == 0) {
      alert("Please the auto loan's annual interest rate.");
      document.calc.autoIntRate.focus();
   } else
   if(document.calc.equityIntRate.value.length == 0) {
      alert("Please enter the home equity loan's annual interest rate.");
      document.calc.equityIntRate.focus();
   } else
   if(VsaveRate == 0) {
      alert("Please enter the annual interest rate you expect to earn from your savings.");
      document.calc.saveRate.focus();
   } else {


      var VdownPay = sn(document.calc.downPay.value);
      var VequityLoanCosts = sn(document.calc.equityLoanCosts.value);
      var VtaxRate = sn(document.calc.taxRate.value);


      var VfinanceAmt = Number(Vprice) - Number(VdownPay);

      var VautoPmt = computeMonthlyPayment(VfinanceAmt, Vmonths, VautoIntRate);
      document.calc.autoPmt.value = fns(VautoPmt,2,1,1,1);

      var VequityPmt = computeMonthlyPayment(VfinanceAmt, Vmonths, VequityIntRate);
      document.calc.equityPmt.value = fns(VequityPmt,2,1,1,1);

      //COMPUTE INTEREST COST
      var VautoIntCost = computeFixedInterestCost(VfinanceAmt, VautoIntRate, VautoPmt);
      document.calc.autoIntCost.value = fns(VautoIntCost,2,1,1,1);

      var VequityIntCost = computeFixedInterestCost(VfinanceAmt, VequityIntRate, VequityPmt);
      document.calc.equityIntCost.value = fns(VequityIntCost,2,1,1,1);

      var VtaxSave = 0;
      if(VtaxRate >= 1) {
         VtaxRate /= 100;
      }

      VtaxSave = VequityIntCost * VtaxRate;
      document.calc.equityTaxSave.value = fns(VtaxSave,2,1,1,1);
      document.calc.autoTaxSave.value = fns(0,2,1,1,1);

      document.calc.autoNetCost.value = fns(VautoIntCost,2,1,1,1);

      VequityNetCost = Number(VequityIntCost) - Number(VtaxSave);
      document.calc.equityNetCost.value = fns(VequityNetCost,2,1,1,1);

      jQuery('.email-my-results').removeClass('hidden');
   }
}


function clear_results(form) {

   document.calc.autoPmt.value = "";
   document.calc.equityPmt.value = "";
   document.calc.autoIntCost.value = "";
   document.calc.equityIntCost.value = "";
   document.calc.equityTaxSave.value = "";
   document.calc.autoTaxSave.value = "";
   document.calc.autoNetCost.value = "";
   document.calc.equityNetCost.value = "";

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
<br><h4 align="center">Auto Loan vs. Home Equity Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Purchase price of car ($):
</td>
<td align="center">
<input type="text" name="price" size="15" maxlength="25" value="29000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Down payment amount ($):
</td>
<td align="center">
<input type="text" name="downPay" size="15" maxlength="25" value="2900" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Loan term (# of months):
</td>
<td align="center">
<input type="text" name="months" size="15" maxlength="25" value="48" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Auto loan interest rate (%):
</td>
<td align="center">
<input type="text" name="autoIntRate" size="15" maxlength="25" value="10" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Home equity loan interest rate (%):
</td>
<td align="center">
<input type="text" name="equityIntRate" size="15" maxlength="25" value="8" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Home equity loan upfront costs ($ total of fees, points, ect):
</td>
<td align="center">
<input type="text" name="equityLoanCosts" size="15" maxlength="25" value="300" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Your combined state and federal tax rate (%):
</td>
<td align="center">
<input type="text" name="taxRate" size="15" maxlength="25" value="33.8" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Your savings interest rate (%):
</td>
<td align="center">
<input type="text" name="saveRate" size="15" maxlength="25" value="2" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
<b>
Results
</b>
</td>
<td align="center">
<b>
Auto Loan
</b>
</td>
<td align="center">
<b>
Home Equity Loan
</b>
</td>
</tr>
<tr>
<td>
Monthly payment:
</td>
<td align="center">
<input type="text" name="autoPmt" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="equityPmt" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Total interest cost:
</td>
<td align="center">
<input type="text" name="autoIntCost" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="equityIntCost" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Tax savings:
</td>
<td align="center">
<input type="text" name="autoTaxSave" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="equityTaxSave" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Net cost (interest cost less tax savings):
</td>
<td align="center">
<input type="text" name="autoNetCost" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="equityNetCost" size="15" maxlength="25">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
