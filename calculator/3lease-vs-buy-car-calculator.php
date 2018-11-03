
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Lease vs. Buy Car Calculator</title>

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




function FVsingleDep(prin, intRate, numMonths, numCompPerYr) {

var i = 0;
var intEarn = 0;
var singleFV = prin;

intRate /= 100;

if(numCompPerYr == "" || numCompPerYr == 0) {
   numCompPerYr = 12;
}
intRate /= numCompPerYr;

var numPeriods = numMonths / 12 * numCompPerYr;

singleFV = Math.pow((eval(1) + eval(intRate)), numPeriods) * singleFV;

return singleFV;

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

   if(document.calc.lsCost.value == "" || document.calc.lsCost.value == 0) {
      alert("Please enter cost of the car you are considering leasing on Line #1A.");
      document.calc.lsCost.focus();
   } else
   if(document.calc.lnCost.value == "" || document.calc.lnCost.value == 0) {
      alert("Please enter cost of the car you are considering buying on Line #1B.");
      document.calc.lnCost.focus();
   } else
   if(document.calc.lsTaxRate.value == "" || document.calc.lsTaxRate.value == 0) {
      alert("Please enter the applicable sales tax rate on Line #2A.");
      document.calc.lsTaxRate.focus();
   } else
   if(document.calc.lnTaxRate.value == "" || document.calc.lnTaxRate.value == 0) {
      alert("Please enter the applicable sales tax rate on Line #2B.");
      document.calc.lnTaxRate.focus();
   } else
   if(document.calc.lsMonths.value == "" || document.calc.lsMonths.value == 0) {
      alert("Please enter the term of the lease (number of months) on Line #7A.");
      document.calc.lsMonths.focus();
   } else
   if(document.calc.lnMonths.value == "" || document.calc.lnMonths.value == 0) {
      alert("Please enter the term of the loan (number of months) on Line #7B.");
      document.calc.lnMonths.focus();
   } else
   if((document.calc.lnPmt.value == "" || document.calc.lnPmt.value == 0) && (document.calc.lnIntRate.value == "" || document.calc.lnIntRate.value == "")) {
      alert("If you leave the loan's monthly payment amount (Line #9B) blank, then you must enter an interest rate on Line #8B.");
      document.calc.lnIntRate.focus();
   } else
   if((document.calc.lsPmt.value == "" || document.calc.lsPmt.value == 0) && (document.calc.lsIntRate.value == "" || document.calc.lsIntRate.value == "")) {
      alert("If you leave the lease's monthly payment amount (Line #9A) blank, then you must enter an interest rate on Line #8A.");
      document.calc.lsIntRate.focus();
   } else {

      //CALC BUY COSTS

      var VlnCost = sn(document.calc.lnCost.value);
      var VlnTaxRate = sn(document.calc.lnTaxRate.value);
      var VlnSalesTax = 0;

      if(VlnTaxRate >= 1) {
         VlnTaxRate /= 100;
      }
      VlnSalesTax = VlnTaxRate * VlnCost;

      var VlnFees = sn(document.calc.lnFees.value);

      var VlnGrossPurchase = Number(VlnCost) + Number(VlnSalesTax) + Number(VlnFees);

      //Initialize value to accumulate prin for forgone int calc
      var VlnUpFrontFVamt = 0;

      var VlnDownPay = sn(document.calc.lnDownPay.value);
      //Add downpayment to amount for figuring forgone interest
      VlnUpFrontFVamt = Number(VlnUpFrontFVamt) + Number(VlnDownPay);

      VlnFinanceAmt = Number(VlnCost) - Number(VlnDownPay);

      var VlnTradeIn = sn(document.calc.lnTradeIn.value);
      //Subtract tradein allowance from amount to finance.
      VlnFinanceAmt = Number(VlnFinanceAmt) - Number(VlnTradeIn);

      var VlnRebate = sn(document.calc.lnRebate.value);
      //Subtract from amount to figure forgone interest
      VlnUpFrontFVamt = Number(VlnUpFrontFVamt) - Number(VlnRebate);

      //Add Sales tax amount to figure forgone interest
      VlnUpFrontFVamt = Number(VlnUpFrontFVamt) + Number(VlnSalesTax);

      //Add Fees amount to figure forgone interest
      VlnUpFrontFVamt = Number(VlnUpFrontFVamt) + Number(VlnFees);


      var VlnMonths = sn(document.calc.lnMonths.value);
      var VlnPmt = 0;
      var VlnIntRate = document.calc.lnIntRate.value;
      if(VlnIntRate == "") {
         VlnPmt = sn(document.calc.lnPmt.value);
      } else {
         VlnIntRate = sn(VlnIntRate);
         VlnPmt = computeMonthlyPayment(VlnFinanceAmt, VlnMonths, VlnIntRate);
      }

      document.calc.lnMoPmt.value = "$" + fn(VlnPmt,2,1);

      var VlnTotPmt = VlnMonths * VlnPmt;
      document.calc.lnTotPmt.value = "$" + fn(VlnTotPmt,2,1);

      var VlnIntExp = Number(VlnTotPmt) - Number(VlnFinanceAmt);
      document.calc.lnIntExp.value = "$" + fn(VlnIntExp,2,1);

      var VlnUpFront = Number(VlnSalesTax) + Number(VlnFees) - Number(VlnRebate);
      document.calc.lnUpFront.value = "$" + fn(VlnUpFront,2,1);

      var VlnResale = document.calc.lnResale.value;
      var VlnDeprecExp = 0;
      if(VlnResale == "") {
         VlnDeprecExp = getDeprec(VlnCost,VlnMonths);
      } else {
         VlnResale = sn(VlnResale);
         VlnDeprecExp = Number(VlnCost) - Number(VlnResale);
      }
      document.calc.lnDeprecExp.value = "$" + fn(VlnDeprecExp,2,1);

      //Compute forgone interest if upfront cash less rebate > 0
      var VannSaveRate = sn(document.calc.annSaveRate.value);
      var VlnUpFrontFV = 0;
      var VlnForgoneInt = 0;
      if(VlnUpFrontFVamt > 0) {
         VlnUpFrontFV = FVsingleDep(VlnUpFrontFVamt, VannSaveRate, VlnMonths, 12);
         VlnForgoneInt = Number(VlnUpFrontFV) - Number(VlnUpFrontFVamt);
      }
      document.calc.lnForgoneInt.value = "$" + fn(VlnForgoneInt,2,1);

      var VlnTotCost = Number(VlnIntExp) + Number(VlnUpFront) + Number(VlnDeprecExp) + Number(VlnForgoneInt);
      document.calc.lnTotCost.value = "$" + fn(VlnTotCost,2,1);

      var VlnAvgAnnCost = VlnTotCost / (VlnMonths / 12);
      document.calc.lnAvgAnnCost.value = "$" + fn(VlnAvgAnnCost,2,1);

      //CALC LEASE COSTS

      var VlsCost = sn(document.calc.lsCost.value);

      var VlsGrossCapCost = VlsCost;

      var VlsDownPay = sn(document.calc.lsDownPay.value);

      var VlsTradeIn = sn(document.calc.lsTradeIn.value);

      var VlsRebate = sn(document.calc.lsRebate.value);

      var VlsTotCapCostReduct = Number(VlsDownPay) + Number(VlsTradeIn) + Number(VlsRebate);

      var VlsNetCapCost = Number(VlsGrossCapCost) - Number(VlsTotCapCostReduct);

      var VlsMonths = sn(document.calc.lsMonths.value);

      var VlsResale = document.calc.lsResale.value;
      var VlsDeprecExp = 0;
      if(VlsResale == "") {
         VlsDeprecExp = getDeprec(VlsCost,VlsMonths);
      } else {
         VlsResale = sn(VlsResale);
         VlsDeprecExp = Number(VlsCost) - Number(VlsResale);
      }
      //document.calc.lsDeprecExp.value = "$" + fn(VlsDeprecExp,2,1);

      var VlsTaxRate = sn(document.calc.lsTaxRate.value);
      VlsTaxRate /= 100;

      var VlsPmt = document.calc.lsPmt.value;
      var VlsIntRate = sn(document.calc.lsIntRate.value);
      VlsIntRate /= 100;

      var VlsResidual = 0;
      var VlsMonthlyDeprec = 0;
      var VlsMoneyFactor = 0;
      var VlsLeaseRate = 0;
      var VlsMoPmt = 0;
      if(VlsPmt == 0 || VlsPmt == "") {
         VlsResidual = Number(VlsCost) - Number(VlsDeprecExp);
         VlsMonthlyDeprec = (Number(VlsNetCapCost) - Number(VlsResidual)) / VlsMonths;
         VlsMoneyFactor = VlsIntRate / 24;
         VlsLeaseRate = (Number(VlsNetCapCost) + Number(VlsResidual)) * VlsMoneyFactor;
         VlsMoPmt = Number(VlsMonthlyDeprec) + Number(VlsLeaseRate);
         VlsMoPmt = VlsMoPmt * (Number(1) + Number(VlsTaxRate))
      } else {
        VlsMoPmt = sn(VlsPmt);
      }
      document.calc.lsMoPmt.value = "$" + fn(VlsMoPmt,2,1);

      var VlsTotPmt = VlsMoPmt * VlsMonths;
      document.calc.lsTotPmt.value = "$" + fn(VlsTotPmt,2,1);

      //Calc sales tax on cap reduction
      var VlsCapReductTax = VlsTotCapCostReduct * VlsTaxRate;

      var VlsFees = sn(document.calc.lsFees.value);

      var VlsUpFront = Number(VlsCapReductTax) + Number(VlsFees);
      document.calc.lsUpFront.value = "$" + fn(VlsUpFront,2,1);

      var VlsUpFrontFVamt = 0;
      VlsUpFrontFVamt = Number(VlsDownPay) + Number(VlsTradeIn) + Number(VlsUpFront) - Number(VlsRebate);

      //Compute forgone interest if upfront cash less rebate > 0
      var VlsUpFrontFV = 0;
      var VlsForgoneInt = 0;
      if(VlsUpFrontFVamt > 0) {
         VlsUpFrontFV = FVsingleDep(VlsUpFrontFVamt, VannSaveRate, VlsMonths, 12);
         VlsForgoneInt = Number(VlsUpFrontFV) - Number(VlsUpFrontFVamt);
      }
      document.calc.lsForgoneInt.value = "$" + fn(VlsForgoneInt,2,1);

      var VlsTotCost = Number(VlsTotPmt) + Number(VlsUpFront) + Number(VlsForgoneInt);
      document.calc.lsTotCost.value = "$" + fn(VlsTotCost,2,1);

      var VlsAvgAnnCost = VlsTotCost / (VlsMonths / 12);
      document.calc.lsAvgAnnCost.value = "$" + fn(VlsAvgAnnCost,2,1);


      //END VARIFICATION IF STATEMENT
      jQuery('.email-my-results').removeClass('hidden');
   }
    
}

function getDeprec(p,m) {

   var numYrs = m / 12;

   var deprec = 0;
   var accumDeprec = 0;
   var deprecPerc = 0;
   var dYrCnt = 0;

   var ageFact = new Array(0,24,16,12,8,6,5,4,3,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);

   while(dYrCnt < numYrs) {
      dYrCnt = Number(dYrCnt) + Number(1);
      deprecPerc = sn(document.getElementById("yr" + dYrCnt + "").value);
      if(deprecPerc == 0) {
         deprecPerc = ageFact[dYrCnt];
      }
      deprec = deprecPerc / 100 * p;
      accumDeprec = Number(accumDeprec) + Number(deprec);
   
   }

   return accumDeprec;

}

function help(help_id,txt) {

   var help_cell = document.getElementById("help_" + help_id + "");
   help_cell.innerHTML = "<font face='arial'><small>" + txt + "</small></font>";

   for(var i = 1; i<3; i++) {

      if(i != help_id) {

         var clear_cell = document.getElementById("help_" + i + "");
         clear_cell.innerHTML = "";
      }
   }

}


function clear_results(form) {

      document.calc.lnMoPmt.value = "";
      document.calc.lnTotPmt.value = "";
      document.calc.lnIntExp.value = "";
      document.calc.lnUpFront.value = "";
      document.calc.lnDeprecExp.value = "";
      document.calc.lnForgoneInt.value = "";
      document.calc.lnTotCost.value = "";
      document.calc.lnAvgAnnCost.value = "";
      document.calc.lsMoPmt.value = "";
      document.calc.lsTotPmt.value = "";
      document.calc.lsUpFront.value = "";
      document.calc.lsForgoneInt.value = "";
      document.calc.lsTotCost.value = "";
      document.calc.lsAvgAnnCost.value = "";

}

function reset_calc(form) {

   for(var i = 1; i<3; i++) {

      var clear_cell = document.getElementById("help_" + i + "");
      clear_cell.innerHTML = "";
    
   }

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
<table class="fmcalc" cellspacing="0">
<tbody>
<tr>
<td colspan="4">
<br><h4 align="center">Lease vs. Buy Car Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td align="center">
<b> Description </b>
</td>
<td align="center">
<b> (A) Lease:</b>
</td>
<td align="center">
<b> (B) Loan:</b>
</td>
<td width="125" align="center">
<b> Instruct/Explain </b>
</td>
</tr>
<tr>
<td nowrap="">
1. Purchase price:
</td>
<td align="center">
<input type="text" name="lsCost" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #1A: ENTER: The negotiated purchase price of the car you are thinking of leasing.')" tabindex="1">
</td>
<td align="center">
<input type="text" name="lnCost" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #1B: ENTER: The negotiated purchase price of the car you are thinking of buying.')" tabindex="2">
</td>
<td width="125" align="center" valign="top" rowspan="12">
<div id="help_1" style="height: 120px; text-align: left;">
</div>
</td>
</tr>
<tr>
<td nowrap="">
2. Sales tax rate:
</td>
<td align="center">
<input type="text" name="lsTaxRate" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #2A: ENTER: The sales tax rate, expressed as a percentage (enter 7 for 7%).')" tabindex="3">
</td>
<td align="center">
<input type="text" name="lnTaxRate" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #2B: ENTER: The sales tax rate, expressed as a percentage (enter 7 for 7%).')" tabindex="4">
</td>
</tr>
<tr>
<td nowrap="">
3. Fees:
</td>
<td align="center">
<input type="text" name="lsFees" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #3A: ENTER: The combined total of the lease acquisition and title/registration fees.')" tabindex="5">
</td>
<td align="center">
<input type="text" name="lnFees" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #3B: ENTER: The vehicle title/registration fees.')" tabindex="6">
</td>
</tr>
<tr>
<td nowrap="">
4. Cash Down payment:
</td>
<td align="center">
<input type="text" name="lsDownPay" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #4A: ENTER: The amount of your cash down payment.')" tabindex="7">
</td>
<td align="center">
<input type="text" name="lnDownPay" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #4B: ENTER: The amount of your cash down payment.')" tabindex="8">
</td>
</tr>
<tr>
<td nowrap="">
5. Net Trade-in allowance:
</td>
<td align="center">
<input type="text" name="lsTradeIn" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #5A: ENTER: The amount of your net trade-in allowance.')" tabindex="9">
</td>
<td align="center">
<input type="text" name="lnTradeIn" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #5B: ENTER: The amount of your net trade-in allowance.')" tabindex="10">
</td>
</tr>
<tr>
<td nowrap="">
&gt;6. Rebates:
</td>
<td align="center">
<input type="text" name="lsRebate" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #6A: ENTER: The total amount of any rebates.')" tabindex="11">
</td>
<td align="center">
<input type="text" name="lnRebate" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #6B: ENTER: The total amount of any rebates.')" tabindex="12">
</td>
</tr>
<tr>
<td nowrap="">
7. Term (in months):
</td>
<td align="center">
<input type="text" name="lsMonths" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #7A: ENTER: The term of the lease expressed in months.')" tabindex="13">
</td>
<td align="center">
<input type="text" name="lnMonths" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #7B: ENTER: The term of the loan expressed in months.')" tabindex="14">
</td>
</tr>
<tr>
<td nowrap="">
8. Interest rate (APR):
</td>
<td align="center">
<input type="text" name="lsIntRate" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #8A: ENTER: If you would like the calculator to figure your monthly lease payment for you, enter the lease stated annual interest rate, expressed as a percentage. Otherwise, if you know the monthly lease payment amount, leave this field blank.')" tabindex="15">
</td>
<td align="center">
<input type="text" name="lnIntRate" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #8B: ENTER: If you would like the calculator to figure your monthly loan payment for you, enter the loan annual interest rate, expressed as a percentage. Otherwise, if you know the monthly loan payment amount, leave this field blank.')" tabindex="16">
</td>
</tr>
<tr>
<td nowrap="">
9. Monthly payment:
</td>
<td align="center">
<input type="text" name="lsPmt" size="10" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #9A: ENTER: If you know what your lease monthly payment will be, enter the monthly payment amount. Otherwise, leave this field blank and the calculator will estimate your lease monthly payment for you.')" tabindex="17">
</td>
<td align="center">
<input type="text" name="lnPmt" size="10" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #9B: ENTER: If you know what your loan monthly payment will be, enter the monthly payment amount. Otherwise, leave this field blank and the calculator will compute your loan monthly payment for you.')" tabindex="18">
</td>
</tr>
<tr>
<td nowrap="">
10. Security deposit:
</td>
<td align="center">
<input type="text" name="lsSecurityDeposit" size="10" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #10A: ENTER: Enter the lease security deposit amount.')" tabindex="19">
</td>
<td>
</td>
</tr>
<tr>
<td nowrap="">
11. Estimated resale value:
</td>
<td align="center">
<input type="text" name="lsResale" size="10" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #11A: ENTER: The vehicle estimated resale value (residual) at the end of the lease (varies by model, mileage and other factors). If you want the calculator to estimate the resale value for you using the annual depreciation percentages on line #13, leave this field blank.')" tabindex="20">
</td>
<td align="center">
<input type="text" name="lnResale" size="10" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #11B: ENTER: The vehicle estimated resale value (residual) at the end of the loan (varies by model, mileage and other factors). If you want the calculator to estimate the resale value for you using the annual depreciation percentages on line #13, leave this field blank.')" tabindex="21">
</td>
</tr>
<tr>
<td nowrap="">
12. Annual savings rate:
</td>
<td align="center" colspan="2">
<input type="text" name="annSaveRate" size="5" value="" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #12: ENTER: Annual interest rate at which you expect your savings to grow, expressed as a percentage.')" tabindex="22">
</td>
</tr>
<tr>
<td colspan="4" align="center">
<table border="0" cellpadding="2">
<tbody><tr>
<td>13. Year #/% Deprec.</td>
<td>1<input type="text" id="yr1" name="yr1" size="1" value="24" tabindex="23" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical falling depreciation percentages that occur in the 1st year following the lease or purchase of a new car. If you think the default amounts are not reflective of your particular car's depreciation then you can alter the percentages as preferred.')">
</td>
<td>2<input type="text" id="yr2" name="yr2" size="1" value="16" tabindex="24" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical falling depreciation percentages that occur in the 2nd each year following the leasing or buying of a new car. If you think the default amounts are not reflective of your particular vehicles depreciation then simply change the percentage.')"></td>
<td>3<input type="text" id="yr3" name="yr3" size="1" value="12" tabindex="25" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical depreciation percentage for the 3rd year following the leasing or buying of a new vehicle. If you think the default amounts are not reflective of your particular vehicles depreciation then alter as appropriate.')"></td>
<td>4<input type="text" id="yr4" name="yr4" size="1" value="8" tabindex="26" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical depreciation percentage for the 4th year following the lease or buy of a new car. If you think the default amounts are not reflective of your particular vehicles depreciation, feel free to alter the percentages as you see fit.')"></td>
<td>5<input type="text" id="yr5" name="yr5" size="1" value="6" tabindex="27" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows a typical depreciation percentage for the 5th year after leasing or buying a new vehicle. You can change the percentage if a different amount is preferred.')"></td>
<td>6<input type="text" id="yr6" name="yr6" size="1" value="5" tabindex="28" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical depreciation percentage for the 6th year after you lease or buy a car. You can change the default amount to another value if you think a different percentage is more reflective.')"></td>
<td>7<input type="text" id="yr7" name="yr7" size="1" value="4" tabindex="29" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical falling depreciation percentages that occur in the 7th each year following the purchase/lease of a new vehicle. If you think the default amounts are not reflective of your particular vehicles depreciation, feel free to alter the percentages as you see fit.')"></td>
<td>8<input type="text" id="yr8" name="yr8" size="1" value="3" tabindex="30" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical falling depreciation percentages that occur in the 8th each year following the purchase/lease of a new vehicle. If you think the default amounts are not reflective of your particular vehicles depreciation, feel free to alter the percentages as you see fit.')"></td>
<td>9<input type="text" id="yr9" name="yr9" size="1" value="2" tabindex="31" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows the typical falling depreciation percentages that occur in the 9th each year following the purchase/lease of a new vehicle. If you think the default amounts are not reflective of your particular vehicles depreciation, feel free to alter the percentages as you see fit.')"></td>
<td>10<input type="text" id="yr10" name="yr10" size="1" value="1" tabindex="32" onkeyup="clear_results(this.form)" onfocus="help(1,'Line #13: ENTER: This line shows typical depreciation for the 10th after buying or leasing a new car. If you think the default amount is not accurate go ahead and enter a preferred number.')"></td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td align="center" colspan="4">
<input type="button" value="Calculate Lease vs. Buy" onclick="computeForm(this.form)" tabindex="33">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td align="center">
<b>Description</b>
</td>
<td align="center">
<b>(A) Lease:</b>
</td>
<td align="center">
<b>(B) Buy:</b>
</td>
<td width="125" align="center">
<b>Instruct/Explain</b>
</td>
</tr>
<tr>
<td nowrap="">
14. Monthly payment:
</td>
<td align="center">
<input type="text" name="lsMoPmt" size="10" onfocus="help(2,'Line #14A: RESULT: This is the amount of your monthly lease payment -- which includes depreciation expenses, finance charges and sales taxes.')" tabindex="34">
</td>
<td align="center">
<input type="text" name="lnMoPmt" size="10" onfocus="help(2,'Line #14B: RESULT: This is the amount of your monthly loan payment.')" tabindex="35">
</td>
<td width="125" align="center" valign="top" rowspan="8">
<div id="help_2" style="height: 120px; text-align: left;">
</div>
</td>
</tr>
<tr>
<td nowrap="">
15. Total of payments:
</td>
<td align="center">
<input type="text" name="lsTotPmt" size="10" onfocus="help(2,'Line #15A: RESULT: This is the total amount of your lease payments over the term of the lease.')" tabindex="36">
</td>
<td align="center">
<input type="text" name="lnTotPmt" size="10" onfocus="help(2,'Line #15B: RESULT: This is the total amount of your loan payments over the term of the loan.')" tabindex="37">
</td>
</tr>
<tr>
<td nowrap="">
16. Total interest expense:
</td>
<td align="center">
</td>
<td align="center">
<input type="text" name="lnIntExp" size="10" onfocus="help(2,'Line #16B: RESULT: This is the total interest you will pay by the time you pay off your loan.')" tabindex="38">
</td>
</tr>
<tr>
<td nowrap="">
17. Net up-front expenses:
</td>
<td align="center">
<input type="text" name="lsUpFront" size="10" onfocus="help(2,'Line #17A: RESULT: This is the amount of your up-front lease expenses -- which includes aquisition and title/registrations fees, plus any applicable sales tax due at signing, less any applicable rebates.')" tabindex="39">
</td>
<td align="center">
<input type="text" name="lnUpFront" size="10" onfocus="help(2,'Line #17B: RESULT: This is the amount of your upfront loan expenses -- which includes sales tax and title/registrations fees, less any applicable rebates.')" tabindex="40">
</td>
</tr>
<tr>
<td nowrap="">
18. Depreciation expense:
</td>
<td align="center">
</td>
<td align="center">
<input type="text" name="lnDeprecExp" size="10" onfocus="help(2,'Line #18B: RESULT: This is the total amount your vehicles depreciation over the term of the loan.')" tabindex="41">
</td>
</tr>
<tr>
<td nowrap="">
19. Forgone Interest earnings:
</td>
<td align="center">
<input type="text" name="lsForgoneInt" size="10" onfocus="help(2,'Line #19A: RESULT: This figure represents the interest you could have earned had you invested the lease's net up-front costs for the term of the lease.')" tabindex="42">
</td>
<td align="center">
<input type="text" name="lnForgoneInt" size="10" onfocus="help(2,'Line #19B: RESULT: This figure represents the interest you could have earned had you invested the loan down-payment, trade-in allowance and net up-front costs for the term of the loan.')" tabindex="43">
</td>
</tr>
<tr>
<td nowrap="">
20. Total cost:
</td>
<td align="center">
<input type="text" name="lsTotCost" size="10" onfocus="help(2,'Line #20A: RESULT: This is your total cost over the term of the lease.')" tabindex="44">
</td>
<td align="center">
<input type="text" name="lnTotCost" size="10" onfocus="help(2,'Line #20B: RESULT: This is your total cost over the term of the loan.')" tabindex="45">
</td>
</tr>
<tr>
<td nowrap="">
21. Average cost per year:
</td>
<td align="center">
<input type="text" name="lsAvgAnnCost" size="10" onfocus="help(2,'Line #21A: RESULT: This is the average annual cost of leasing the vehicle (Total Cost divided by Lease Term years).')" tabindex="46">
</td>
<td align="center">
<input type="text" name="lnAvgAnnCost" size="10" onfocus="help(2,'Line #21B: RESULT: This This is the average annual cost of buying the vehicle (Total Cost divided by Loan Term years).')" tabindex="47">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
