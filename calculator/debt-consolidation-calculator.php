
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Debt Consolidation Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">

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

	jQuery('.email-my-results').removeClass('hidden');
	
   var VtaxRate = sn(document.calc.incomeTax.value);
   if(VtaxRate >= 1) {
      VtaxRate /= 100;
   }

   var accumTotBal = 0;
   var accumRate = 0;
   var accumTotPmt = 0;
   var accumCount = 0;
   var accumTotFees = 0;

   var VloanType = 0;
   var Vprincipal = 0;
   var Vpayment = 0;
   var Vrate = 0;
   var VAnnFees = 0;
   var VbeforeTaxInt = 0;
   var VbeforeTaxInt = 0;
   var accumBeforeTaxInt = 0;
   var accumAfterTaxInt = 0;

   var maxConsumerRate = 0;

   var i = 0;

   while(i < 10) {

      i += 1;

      var v_prin_fld = document.getElementById("prin" + i + "");
      var v_pmt_fld = document.getElementById("pmt" + i + "");
      var v_intRate_fld = document.getElementById("intRate" + i + "");
      var v_annFees_fld = document.getElementById("annFees" + i + "");

      var Vprincipal = sn(v_prin_fld.value);
      var Vpayment = sn(v_pmt_fld.value);
      var Vrate = sn(v_intRate_fld.value);
      var VannFees = sn(v_annFees_fld.value)

      if(Vprincipal > 0 && Vrate > 0) {

         var v_debt_fld = document.getElementById("debt"+ i + "");

         var VloanType = v_debt_fld.options[v_debt_fld.selectedIndex].value;

         if(Vrate >= 1) {
            Vrate /= 100;
         }
         if(maxConsumerRate < Vrate) {
            maxConsumerRate = Vrate;
         }
         Vrate /= 12;

         VbeforeTaxInt = Vprincipal * Vrate;
         if(VloanType == 1) {
            VafterTaxInt = VbeforeTaxInt * (1 - VtaxRate);
         } else {
            VafterTaxInt = VbeforeTaxInt;
         }

         accumCount = Number(accumCount) + Number(1);
         accumRate = Number(accumRate) + Number(Vrate);
         accumTotBal = Number(accumTotBal) + Number(Vprincipal);
         accumTotPmt = Number(accumTotPmt) + Number(Vpayment);
         accumTotFees = Number(accumTotFees) + Number(VannFees);
         accumBeforeTaxInt = Number(accumBeforeTaxInt) + Number(VbeforeTaxInt);
         accumAfterTaxInt = Number(accumAfterTaxInt) + Number(VafterTaxInt);

      }

   }

   if(accumTotBal <= 0) {
      alert("Please enter at least one debt before computing the debt consolidation.");
      document.calc.prin1.focus();
   } else {
      var VcashOut = sn(document.calc.cashOut.value);
      if(maxConsumerRate >= 1) {
         maxConsumerRate /= 100;
      }
      maxConsumerRate /= 12;

      VbeforeTaxInt = VcashOut * maxConsumerRate;
      VafterTaxInt = VbeforeTaxInt;
      accumBeforeTaxInt = Number(accumBeforeTaxInt) + Number(VbeforeTaxInt);
      accumAfterTaxInt = Number(accumAfterTaxInt) + Number(VafterTaxInt);
    
      //TOTALS

      var VtotCur = Number(accumTotBal) + Number(VcashOut);
      document.calc.totCur.value = fns(VtotCur,2,1,1,1);

      var VcloseCost = sn(document.calc.closeCost.value);
      var VtotProp = Number(VtotCur) + Number(VcloseCost); 
      document.calc.totProp.value =  fns(VtotProp,2,1,1,1);

      var VeffRateCur = accumBeforeTaxInt / VtotCur * 12 * 100;
      document.calc.effRateCur.value = fns(VeffRateCur,2,0,2,1) + "";

      var VnewRate = sn(document.calc.newRate.value);
      var VeffRateProp = VnewRate;
      document.calc.effRateProp.value = fns(VeffRateProp,2,0,2,1) + "";

      var VeffRateCurTax = accumAfterTaxInt / VtotCur * 12 * 100;
      document.calc.effRateCurTax.value = fns(VeffRateCurTax,2,0,2,1) + "";

      var VeffRatePropTax = VeffRateProp * (1 - VtaxRate);
      document.calc.effRatePropTax.value = fns(VeffRatePropTax,2,0,2,1) + "";

      var VtotPmtCur = accumTotPmt + (accumTotFees / 12);
      document.calc.totPmtCur.value = fns(VtotPmtCur,2,1,1,1);

      var VnewTerm = document.calc.newTerm.options[document.calc.newTerm.selectedIndex].value;
      var VtotPmtProp = computeMonthlyPayment(VtotProp, VnewTerm, VnewRate)
      document.calc.totPmtProp.value = fns(VtotPmtProp,2,1,1,1);

      if(VtotPmtCur < VtotPmtProp) { //If new payment less than old one

         document.calc.moSave.value = "N/A";
         document.calc.annSave.value = "N/A";
         document.calc.fiveYrSave.value = "N/A";
         document.calc.ultYearsSaved.value = "N/A";
         document.calc.ultTotYears.value = "N/A";
         document.calc.ultIntSaved.value = "N/A";

      } else { //If new payment greater than old one

         var VmoSave = VtotPmtCur - VtotPmtProp;
         document.calc.moSave.value= fns(VmoSave,2,1,1,1);

         var VannSave = VmoSave * 12;
         document.calc.annSave.value = fns(VannSave,2,1,1,1);

         var VfiveYrSave = VannSave * 5;
         document.calc.fiveYrSave.value = fns(VfiveYrSave,2,1,1,1);

         //ULTIMATE SAVINGS REPORT
         var oldNumPmtsLeft = computeNPR(VtotProp, VnewRate, VtotPmtCur);
         var oldYearsLeft = oldNumPmtsLeft / 12;
         document.calc.ultTotYears.value = fns(oldYearsLeft,1,0,0,0);

         var newTotYears = VnewTerm / 12;
         var VultYearsSaved = newTotYears - oldYearsLeft;
         document.calc.ultYearsSaved.value = fns(VultYearsSaved,1,0,0,0);

         var oldLoanInterest = computeFixedInterestCost(VtotProp, VnewRate, VtotPmtCur);
         var newLoanInterest = computeFixedInterestCost(VtotProp, VnewRate, VtotPmtProp);
         var VultIntSaved = newLoanInterest - oldLoanInterest;
         document.calc.ultIntSaved.value = fns(VultIntSaved,2,1,1,1);
      }
   }
}

function clear_results(form) {

   document.calc.totCur.value = "";
   document.calc.totProp.value = "";
   document.calc.effRateCur.value = "";
   document.calc.effRateProp.value = "";
   document.calc.effRateCurTax.value = "";
   document.calc.effRatePropTax.value = "";
   document.calc.totPmtCur.value = "";
   document.calc.totPmtProp.value = "";
   document.calc.moSave.value = "";
   document.calc.annSave.value = "";
   document.calc.fiveYrSave.value = "";
   document.calc.ultYearsSaved.value = "";
   document.calc.ultTotYears.value = "";
   document.calc.ultIntSaved.value = "";

}</script>
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
<td colspan="5">
<br><h4 align="center">Debt Consolidation Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td align="center"><b>Credit<br>Type</b></td>
<td align="center"><b>Balance</b></td>
<td align="center"><b>Payment</b></td>
<td align="center"><b>Interest<br>Rate</b></td>
<td align="center"><b>Annual<br>Fees</b></td>
</tr>
<tr>
<td align="center">
<select id="debt1" name="debt1" onchange="clear_results(this.form)">
<option value="1" selected="">Mortgage</option>
<option value="0">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin1" name="prin1" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt1" name="pmt1" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate1" name="intRate1" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees1" name="annFees1" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt2" name="debt2" onchange="clear_results(this.form)">
<option value="1" selected="">Mortgage</option>
<option value="0">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin2" name="prin2" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt2" name="pmt2" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate2" name="intRate2" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees2" name="annFees2" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt3" name="debt3" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin3" name="prin3" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt3" name="pmt3" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate3" name="intRate3" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees3" name="annFees3" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt4" name="debt4" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin4" name="prin4" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt4" name="pmt4" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate4" name="intRate4" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees4" name="annFees4" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt5" name="debt5" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin5" name="prin5" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt5" name="pmt5" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate5" name="intRate5" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees5" name="annFees5" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt6" name="debt6" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin6" name="prin6" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt6" name="pmt6" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate6" name="intRate6" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees6" name="annFees6" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt7" name="debt7" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin7" name="prin7" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt7" name="pmt7" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate7" name="intRate7" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees7" name="annFees7" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt8" name="debt8" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin8" name="prin8" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt8" name="pmt8" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate8" name="intRate8" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees8" name="annFees8" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt9" name="debt9" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin9" name="prin9" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt9" name="pmt9" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate9" name="intRate9" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees9" name="annFees9" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<select id="debt10" name="debt10" onchange="clear_results(this.form)">
<option value="1">Mortgage</option>
<option value="0" selected="">Credit Card</option>
<option value="0">Auto Loan</option>
<option value="0">Student Loan</option>
<option value="0">Other</option>
</select></td>
<td align="center">
<input type="text" id="prin10" name="prin10" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="pmt10" name="pmt10" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate10" name="intRate10" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="annFees10" name="annFees10" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center"><b>Additional Cash?</b>
</td>
<td align="center">
<input type="text" name="cashOut" size="12" onkeyup="clear_results(this.form)">
</td>
<td align="left" colspan="3">
<select name="purpose" size="1">
<option>Purpose...</option>
<option>Pay personal IOU's</option>
<option>Improve home</option>
<option>Vacation</option>
<option>Support family</option>
<option>Self-employment business</option>
<option>Combination of uses</option>
</select>
</td>
</tr>
<tr>
<td colspan="5" align="center">
<b>New Loan Information</b>
</td>
</tr>
<tr>
<td colspan="5">
Enter new debt consolidation loan information
(replace default entries)
</td>
</tr>
<tr>
<td colspan="4">
New interest rate (%):
</td>
<td align="center">
<input type="text" name="newRate" value="8" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4">
Loan term:
</td>
<td align="center">
<select name="newTerm" size="1" onchange="clear_results(this.form)">
<option value="60">5 Years</option>
<option value="120">10 Years</option>
<option value="180">15 Years</option>
<option value="240">20 Years</option>
<option value="300">25 Years</option>
<option value="360" selected="">30 Years</option>
</select>
</td>
</tr>
<tr>
<td colspan="4">
Estimated closing costs ($):
</td>
<td align="center">
<input type="text" name="closeCost" value="1800" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4">
Combined Fed &amp; State tax rate (%):
</td>
<td align="center">
<input type="text" name="incomeTax" value="28" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="5">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="3"><b>Results</b></td>
<td align="center"><b>Current</b></td>
<td align="center"><b>New Loan</b></td>
</tr>
<tr>
<td colspan="3">
Total debts:
</td>
<td align="center">
<input type="text" name="totCur" size="12">
</td>
<td align="center">
<input type="text" name="totProp" size="12">
</td>
</tr>
<tr>
<td colspan="3">
Effective rate before taxes:
</td>
<td align="center">
<input type="text" name="effRateCur" size="12">
</td>
<td align="center">
<input type="text" name="effRateProp" size="12">
</td>
</tr>
<tr>
<td colspan="3">
Effective rate after taxes:
</td>
<td align="center">
<input type="text" name="effRateCurTax" size="12">
</td>
<td align="center">
<input type="text" name="effRatePropTax" size="12">
</td>
</tr>
<tr>
<td colspan="3">
Total monthly payment:
</td>
<td align="center">
<input type="text" name="totPmtCur" size="12">
</td>
<td align="center">
<input type="text" name="totPmtProp" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Monthly savings:
</td>
<td align="center">
<input type="text" name="moSave" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Annual savings:
</td>
<td align="center">
<input type="text" name="annSave" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Five year savings:
</td>
<td align="center">
<input type="text" name="fiveYrSave" size="12">
</td>
</tr>
<tr>
<td colspan="5"><b>How To Maximize Your Savings (See Below...)</b></td>
</tr>
<tr>
<td colspan="5">
Now suppose you chose to continue paying the same old payments instead of your NEW LOWER PAYMENTS. This would cause the savings to pay down principal faster thus shortening the cost of the new loan as well... without you ever paying more than you are already paying.
</td>
</tr>
<tr>
<td colspan="4">
Total years saved if old higher payments are made on new loan:
</td>
<td align="center">
<input type="text" name="ultYearsSaved" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Total years until debt free if savings are paid to principal:
</td>
<td align="center">
<input type="text" name="ultTotYears" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Total interest cost saved over life of loan if savings are applied to principal:
</td>
<td align="center">
<input type="text" name="ultIntSaved" size="12">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
