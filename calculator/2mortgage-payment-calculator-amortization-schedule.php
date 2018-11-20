
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Mortgage Payment Calculator - with Amortization Schedule</title>

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
   var Vprincipal = sn(document.calc.principal.value);
   var VintRate = sn(document.calc.intRate.value);
   var VnumYears = sn(document.calc.numYears.value);

   if(Vprincipal == 0) {
      alert("Please enter the mortgage's principal amount.");
      document.calc.principal.focus();
   } else
   if(VintRate == 0) {
      alert("Please enter the mortgage's annual interest rate.");
      document.calc.intRate.focus();
   } else
   if(VnumYears == 0) {
      alert("Please enter the mortgage's term in number of years.");
      document.calc.numYears.focus();
   } else {

      var VannualTax = sn(document.calc.annualTax.value);
      var VmonthlyTax =0;
      VmonthlyTax = VannualTax / 12;
      VmonthlyTax *= 100;
      VmonthlyTax = Math.round(VmonthlyTax);
      VmonthlyTax /= 100;

      var VannualInsurance = sn(document.calc.annualInsurance.value);
      var VmonthlyInsurance = 0;
      VmonthlyInsurance = VannualInsurance / 12;
      VmonthlyInsurance *= 100;
      VmonthlyInsurance = Math.round(VmonthlyInsurance);
      VmonthlyInsurance /= 100;

      var VmonthlyPMI = sn(document.calc.monthlyPMI.value);

      var VotherPmts = Number(VmonthlyTax) + Number(VmonthlyInsurance) + Number(VmonthlyPMI);

      var VnumPmts = VnumYears * 12;

      var VpmtAmt = computeMonthlyPayment(Vprincipal, VnumPmts, VintRate);
      var VtotalMtgPmt = Number(VpmtAmt) + Number(VotherPmts);

      document.calc.monthlyPI.value = fns(VpmtAmt,2,1,1,1);
      document.calc.otherPmts.value = fns(VotherPmts,2,1,1,1);
      document.calc.monthlyPmt.value = fns(VtotalMtgPmt,2,1,1,1);
      monthlyAmortSched(form);
   }

}

function monthlyAmortSched(form) {

   var Vprincipal = sn(document.calc.principal.value);
   var VintRate = sn(document.calc.intRate.value);
   var VnumYears = sn(document.calc.numYears.value);

   if(Vprincipal == 0) {
      alert("Please enter the mortgage's principal amount.");
      document.calc.principal.focus();
   } else
   if(VintRate == 0) {
      alert("Please enter the mortgage's annual interest rate.");
      document.calc.intRate.focus();
   } else
   if(VnumYears == 0) {
      alert("Please enter the mortgage's term in number of years.");
      document.calc.numYears.focus();
   } else {

      var VannualTax = sn(document.calc.annualTax.value);
      var VmonthlyTax =0;
      VmonthlyTax = VannualTax / 12;
      VmonthlyTax *= 100;
      VmonthlyTax = Math.round(VmonthlyTax);
      VmonthlyTax /= 100;

      var VannualInsurance = sn(document.calc.annualInsurance.value);
      var VmonthlyInsurance = 0;
      VmonthlyInsurance = VannualInsurance / 12;
      VmonthlyInsurance *= 100;
      VmonthlyInsurance = Math.round(VmonthlyInsurance);
      VmonthlyInsurance /= 100;

      var VmonthlyPMI = sn(document.calc.monthlyPMI.value);

      var VotherPmts = Number(VmonthlyTax) + Number(VmonthlyInsurance) + Number(VmonthlyPMI);

      var VnumPmts = VnumYears * 12;

      var pmtAmt = computeMonthlyPayment(Vprincipal, VnumPmts, VintRate);
      var VtotalMtgPmt = Number(pmtAmt) + Number(VotherPmts);

      var prin = Vprincipal;
      var Vint = VintRate;
      if(Vint >= 1) {
         Vint /= 100;
         }
      Vint /= 12;

      var nPer = VnumPmts;
      var intPort = 0;
      var accumInt = 0;
      var prinPort = 0;
      var accumPrin = 0;
      var count = 0;
      var pmtRow = "";
      var pmtNum = 0;

      var today = new Date();
      var dayFactor = today.getTime();
      var pmtDay = today.getDate();
      if(pmtDay > 28) {
         pmtDay = 28;
      }
      var loanMM = today.getMonth() + 1;
      var pmtMonth = loanMM;
      var loanYY = today.getYear();
      if(loanYY < 1900) {
         loanYY += 1900;
      }
      var pmtYear = loanYY;

      var loanDate = (loanMM + "/" + pmtDay + "/" + loanYY);
      var pmtDate = 0;
      var displayPmtAmt = 0;
      var accumYearPrin = 0;
      var accumYearInt = 0;

      while(count < nPer) {

         if(count < (nPer - 1)) {

            intPort = prin * Vint;
            intPort *= 100;
            intPort = Math.round(intPort);
            intPort /= 100;

            accumInt = Number(accumInt) + Number(intPort);
            accumYearInt = Number(accumYearInt) + Number(intPort);

            prinPort = Number(pmtAmt) - Number(intPort);
            prinPort *= 100;
            prinPort = Math.round(prinPort);
            prinPort /= 100;

            accumPrin = Number(accumPrin) + Number(prinPort);
            accumYearPrin = Number(accumYearPrin) + Number(prinPort);

            prin = Number(prin) - Number(prinPort);

            displayPmtAmt = Number(prinPort) + Number(intPort);

         } else {

            intPort = prin * Vint;
            intPort *= 100;
            intPort = Math.round(intPort);
            intPort /= 100;

            accumInt = Number(accumInt) + Number(intPort);
            accumYearInt = Number(accumYearInt) + Number(intPort);

            prinPort = prin;

            accumPrin = Number(accumPrin) + Number(prinPort);
            accumYearPrin = Number(accumYearPrin) + Number(prinPort);

            prin = 0;

            //pmtAmt = Number(intPort) + Number(prinPort);
            displayPmtAmt = Number(prinPort) + Number(intPort);
         }

         count = Number(count) + Number(1);

         pmtNum = Number(pmtNum) + Number(1);

         pmtMonth = pmtMonth + 1;

         if(pmtMonth > 12) {
            pmtMonth = 1;
            pmtYear += 1;
         }

         pmtString = (pmtMonth + "/" + pmtDay + "/" + pmtYear);

         pmtRow += "<tr><td align='right'><font face='arial'><small>" + pmtNum + "</small></font>";
         pmtRow += "</td><td align='right'><font face='arial'><small>" + pmtString + "</small>";
         pmtRow += "</font></td><td align='right'><font face='arial'>";
         pmtRow += "<small>" + fns(prinPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align='right'><font face='arial'>";
         pmtRow += "<small>" + fns(intPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align='right'><font face='arial'>";
         pmtRow += "<small>" + fns(displayPmtAmt,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align='right'><font face='arial'>";
         pmtRow += "<small>" + fns(prin,2,1,1,1) + "</small></font></td></tr>";

         if(pmtMonth == 12 || count == nPer) {

            pmtRow += "<tr bgcolor='#dddddd'><td align='right'><font face='arial'><small>Total</small>";
            pmtRow += "</font></td><td align='right'><font face='arial'><small>" + pmtYear + "</small>";
            pmtRow += "</font></td><td align='right'><font face='arial'>";
            pmtRow += "<small>" + fns(accumYearPrin,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align='right'><font face='arial'>";
            pmtRow += "<small>" + fns(accumYearInt,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align='right'><font face='arial'><small> </small></font></td>";
            pmtRow += "<td align='right'><font face='arial'><small> </small></font></td></tr>";

            accumYearPrin = 0;
            accumYearInt = 0;

         }

         if(count > 600) {
         alert("Using your current entries you will never pay off this loan.");
            break;
         } else {
            continue;
         }

      }

      var part1 = "<br /><br /><center><font face='arial'><big><strong>";
      part1 += "Amortization Schedule</strong></big></font></center>";

      var part2 = "<center><table border=1 cellpadding=2 cellspacing=0><tr>";
      part2 += "<td colspan=6><font face='arial'><small><strong>Loan ";
      part2 += "Date: " + loanDate + "<br />Principal: " + fns(Vprincipal,2,1,1,1) + "<br />";
      part2 += "# of Payments: " + nPer + "<br />Interest Rate: " + fns(VintRate,3,0,2,1) + "";
      part2 += "<br />Payment: " + fns(pmtAmt,2,1,1,1) + "</strong></small></font></td></tr>";
      part2 += "<tr><td colspan=6><center><font face='arial'><strong>Schedule of Payments</strong>";
      part2 += "</font><br /><font face='arial'><small><small>Please allow for slight ";
      part2 += "rounding differences.</small></small></font></center></td></tr>";
      part2 += "<tr bgcolor='silver'><td align='center'><font face='arial'><small>";
      part2 += "<strong>Pmt #</strong></small></font></td><td align='center'><font face='arial'>";
      part2 += "<small><strong>Date</strong></small></font></td><td align='center'>";
      part2 += "<font face='arial'><small><strong>Principal</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Interest</strong></small>";
      part2 += "</font></td><td align='center'><font face='arial'><small><strong>Payment</strong>";
      part2 += "</small></font></td><td align='center'><font face='arial'><small>";
      part2 += "<strong>Balance</strong></small></font></td></tr>";

      var totalPmts = Number(accumPrin) + Number(accumInt);

      var part4 = "<tr><td colspan='2'><font face='arial'><small><strong>Grand Total</strong>";
      part4 += "</small></font></td><td align='right'><font face='arial'><small>";
      part4 += "<strong>" + fns(accumPrin,2,1,1,1) + "</strong></small></font></td>";
      part4 += "<td align='right'><font face='arial'><small>";
      part4 += "<strong>" + fns(accumInt,2,1,1,1) + "</strong></small></font></td>";
      part4 += "<td><font face='arial'><small>";
      part4 += "<strong>" + fns(totalPmts,2,1,1,1) + "</strong></small></font></td>";
      part4 += "<td> </td></tr></table>";

      var schedule = (part1 + "" + part2 + "" + pmtRow + "" + part4 + "");

      document.getElementById("report").innerHTML = schedule;

      jQuery('.email-my-results').removeClass('hidden');
   }

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


   document.calc.monthlyPI.value = "";
   document.calc.otherPmts.value = "";
   document.calc.monthlyPmt.value = "";

}

function reset_calc(form) {

   var help_cell_1 = document.getElementById("help_1");
   help_cell_1.innerHTML = "";

   var help_cell_2 = document.getElementById("help_2");
   help_cell_2.innerHTML = "";

   document.calc.reset();
   document.getElementById("report").innerHTML = "";
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
<br><h4 align="center">Mortgage Payment Calculator – Amortization Schedule</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Mortgage loan amount:
</td>
<td align="center">
<input type="text" name="principal" size="15" onfocus="help(1,'ENTER: The total amount you would be borrowing to buy your house.')" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<b>Explain/Instruct</b>
</td>
</tr>
<tr>
<td>
Annual interest rate (APR):
</td>
<td align="center">
<input type="text" name="intRate" size="15" onfocus="help(1,'ENTER: The annual interest rate for this mortgage loan (e.g. enter 6% as 6).')" onkeyup="clear_results(this.form)">
</td>
<td rowspan="5" width="125" align="center" valign="top">
<div id="help_1" style="width: 120px; text-align: left;">
</div>
</td>
</tr>
<tr>
<td>
Mortgage loan term (# years):
</td>
<td align="center">
<input type="text" name="numYears" size="15" onfocus="help(1,'ENTER: The number of years you will be financing the home for.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Real estate taxes (annual):
</td>
<td align="center">
<input type="text" name="annualTax" size="15" onfocus="help(1,'The annual property tax payment you expect to pay. If you don't know then a general rule of thumb is 1.1% (home price X .011) of the purchase price per year.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Homeowners insurance (annual):
</td>
<td align="center">
<input type="text" name="annualInsurance" size="15" onfocus="help(1,'ENTER: The annual homeowner insurance payment you expect to pay. If you don't know then a reasonable estimate is 1.5% (home price X .015) of the purchase price per year.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Monthly PMI:
</td>
<td align="center">
<input type="text" name="monthlyPMI" size="15" onfocus="help(1,'ENTER: The monthly Private Mortgage Insurance (PMI) you expect to pay. If your downpayment is less than 20% of the value of the home then you may be required to pay mortgage insurance ranging between 0.02% and 0.07% of your principal balance each month (e.g, principal balance X .00043).')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" name="compute" value="Calculate Mortgage Payment" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Monthly Principal and Interest Payment:
</td>
<td align="center">
<input type="text" name="monthlyPI" size="15" onfocus="help(2,'RESULT: This how much your monthly principal and interest payment will be.')">
</td>
<td align="center">
<b>Explain/Instruct</b>
</td>
</tr>
<tr>
<td>
Monthly Taxes, Insurance and PMI payment:
</td>
<td align="center">
<input type="text" name="otherPmts" size="15" onfocus="help(2,'RESULT: This is the total of your other monthly payments (taxes, insurance &amp; PMI).')">
</td>
<td rowspan="2" width="125" align="center" valign="top">
<div id="help_2" style="width: 120px; text-align: left;">
</div>
</td>
</tr>
<tr>
<td>
Total monthly mortgage payment:
</td>
<td align="center">
<input type="text" name="monthlyPmt" size="15" onfocus="help(2,'RESULT: This is the total of all monthly payments related to your mortgage.')">
</td>
</tr>
</tbody>
</table>
<div id="report"></div>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
