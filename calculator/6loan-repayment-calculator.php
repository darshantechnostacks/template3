
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Loan Repayment Calculator</title>

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

   var prin1 = sn(document.calc.principal.value);
   var rate = sn(document.calc.intRate.value);
   var numPmts1 = sn(document.calc.months.value);

   if(prin1 == 0) {
      alert("Please enter the current principal balance owed.");
      document.calc.principal.focus();
   } else 
   if(rate == 0) {
      alert("Please enter the annual interest rate percentage.");
      document.calc.intRate.focus();
   } else
   if(numPmts1 == 0) {
      alert("Please enter the term of the loan in months.");
      document.calc.months.focus();
   } else {

      var prin2 = sn(document.calc.principal.value);

      var i = rate / 100.0;

      var i1  = i / 12;
      var i2 = i / 26;

      var pmt1 = computeMonthlyPayment(prin1, numPmts1, rate);
      document.calc.moPmt.value = fns(pmt1,2,1,1,1);
      var pmt2 = pmt1 / 2;
      document.calc.biwkPmt.value = fns(pmt2,2,1,1,1);

      var count = 0;
      var prin = prin2;
      var intPort = 0;
      var prinPort = 0;
      var accumInt = 0;

      while(prin > 0) {

         if((prin + (prin * i)) > pmt2) {
            intPort = prin * i2;
            prinPort = pmt2 - intPort;
            prin = prin - prinPort;
            accumInt = accumInt + intPort;
         } else {
            intPort = prin * i2;
            prinPort = prin;
            prin = prin - prinPort;
            accumInt = accumInt + intPort;
         }

         count = count + 1;

      }

      var numPmts2 = count;

      var VmoInt = computeFixedInterestCost(prin1, rate, pmt1);
      document.calc.moInt.value = fns(VmoInt,2,1,1,1);

      var VbiwkInt = accumInt;
      document.calc.biwkInt.value = fns(VbiwkInt,2,1,1,1);

      var VintSave = Number(VmoInt) - Number(VbiwkInt);
      document.calc.intSave.value = fns(VintSave,2,1,1,1);

      var v_summary = "In essence, what you are really doing is adding a 13th payment to your annual number ";
      v_summary += "of payments, and splitting it up between 26 bi-weekly payments. In your case means ";
      v_summary += "that by paying an extra " + fns(pmt1 / 26,2,1,1,1) + " every two weeks you ";
      v_summary += "will pay off your loan in " + parseInt(numPmts2 /26*12,10) + " months instead of ";
      v_summary += "the current " + numPmts1 + " months, and save " + fns(VintSave,2,1,1,1) + " in loan ";
      v_summary += "interest in the process.";

      var v_summary_cell = document.getElementById("summary");
      v_summary_cell.innerHTML = "<font face='arial'><small><strong>Summary:</strong> " + v_summary + "</small></font>";

      jQuery('.email-my-results').removeClass('hidden');
   }
    
}

function clear_results(form) {

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   document.calc.moPmt.value = "";
   document.calc.biwkPmt.value = "";
   document.calc.moInt.value = "";
   document.calc.biwkInt.value = "";
   document.calc.intSave.value = "";

}

function reset_calc(form) {

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   document.calc.reset();

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
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<br><h4 align="center">Loan Repayment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter Amount Owed:<br>
<small>(call lender and ask for loan payoff amount if uncertain)</small>
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual interest rate (APR):
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Number Of Months To Payoff Loan In?:
</td>
<td align="center">
<input type="text" name="months" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Loan Repayment" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr><tr>
<td>
Here is your monthly payment amount:
</td>
<td align="center">
<input type="text" name="moPmt" size="15">
</td>
</tr>
<tr>
<td>
Here is your bi-weekly payment amount:
</td>
<td align="center">
<input type="text" name="biwkPmt" size="15">
</td>
</tr>
<tr>
<td>
This is your total interest paid using monthly payments:
</td>
<td align="center">
<input type="text" name="moInt" size="15">
</td>
</tr>
<tr>
<td>
This is your total interest using bi-weekly payments:
</td>
<td align="center">
<input type="text" name="biwkInt" size="15">
</td>
</tr>
<tr>
<td>
Bi-weekly Loan Repayment Interest Savings:
</td>
<td align="center">
<input type="text" name="intSave" size="15">
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
