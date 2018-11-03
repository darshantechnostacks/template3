
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Balloon Mortgage Calculator</title>

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


function calc_min(form) {

   var v_prin = sn(document.calc.principal.value);
   var v_rate = v_rate = sn(document.calc.intRate.value);
   var v_min_pmt_span = document.getElementById("min_pmt");

   var v_min_pmt = 0;

   if(v_prin > 0 && v_rate > 0) {

      v_min_pmt = Math.ceil(v_rate / 100 / 12 * v_prin);
      v_min_pmt_span.innerHTML = "(must be at least " + fns(v_min_pmt,2,1,1,1) + ")";

   } else {

      v_min_pmt_span.innerHTML = "";

   }

   clear_results(document.calc);


}


function computeForm(form) {

   var v_prin = sn(document.calc.principal.value);
   var v_rate = sn(document.calc.intRate.value);
   var v_pmt = sn(document.calc.pmt.value);
   var v_due_years = sn(document.calc.due_years.value);

   var v_min_pmt = Math.ceil(v_rate / 100 / 12 * v_prin);

   if(v_prin == 0) {
      alert("Please enter the mortgage's principal amount.");
      document.calc.principal.focus();
   } else
   if(v_rate == 0) {
      alert("Please enter the mortgage's annual interest rate.");
      document.calc.intRate.focus();
   } else
   if(v_pmt == 0) {
      alert("Please enter the desired monthly payment amount.");
      document.calc.pmt.focus();
   } else
   if(v_pmt < v_min_pmt) {
      alert("Please enter a payment amount that is greater than " + fns(v_min_pmt,2,1,1,1) + ".");
      document.calc.pmt.focus();
   } else
   if(v_due_years == 0) {
      alert("Please enter the number of years before mortgage is payable in full.");
      document.calc.due_years.focus();
   } else {


      var prin = v_prin;
      var int_port = 0;
      var prin_port = 0;
      var rate = v_rate / 100 / 12;
      var due_pmts = v_due_years * 12;

      for(var i = 0; i<due_pmts; i++) {

         int_port = Math.round(rate * prin * 100) / 100;
         prin_port = Number(v_pmt) - Number(int_port)
         prin = Number(prin) - Number(prin_port);


      }

      document.calc.bal_due.value = fns(prin,2,1,1,1);
     monthlyAmortSched(form);
   }

}



function monthlyAmortSched(form) {
   var v_prin = sn(document.calc.principal.value);
   var v_rate = sn(document.calc.intRate.value);
   var v_pmt = sn(document.calc.pmt.value);
   var v_due_years = sn(document.calc.due_years.value);

   var v_min_pmt = Math.ceil(v_rate / 100 / 12 * v_prin);

   if(v_prin == 0) {
      alert("Please enter the mortgage's principal amount.");
      document.calc.principal.focus();
   } else
   if(v_rate == 0) {
      alert("Please enter the mortgage's annual interest rate.");
      document.calc.intRate.focus();
   } else
   if(v_pmt == 0) {
      alert("Please enter the desired monthly payment amount.");
      document.calc.pmt.focus();
   } else
   if(v_pmt < v_min_pmt) {
      alert("Please enter a payment amount that is greater than " + fns(v_min_pmt,2,1,1,1) + ".");
      document.calc.pmt.focus();
   } else
   if(v_due_years == 0) {
      alert("Please enter the number of years before mortgage is payable in full.");
      document.calc.due_years.focus();
   } else {

      var VnumPmts = v_due_years * 12;

      var pmtAmt = v_pmt;

      var prin = v_prin;

      var rate = v_rate;

      if(rate >= 1) {
         rate /= 100;
         }
      rate /= 12;

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
      var loanMM = today.getMonth() + 1;
      var loanYY = today.getYear();
      if(loanYY < 1900) {
         loanYY += 1900;
      }
      var loanDate = (loanMM + "/" + pmtDay + "/" + loanYY);
      var monthMS = 86400000 * 30.4;
      var pmtDate = 0;
      var displayPmtAmt = 0;
      var accumYearPrin = 0;
      var accumYearInt = 0;

      while(count < VnumPmts) {

            intPort = prin * rate;
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


         count = Number(count) + Number(1);

         pmtNum = Number(pmtNum) + Number(1);

         dayFactor = Number(dayFactor) + Number(monthMS);

         pmtDate = new Date(dayFactor);

         pmtMonth = pmtDate.getMonth();

         pmtMonth = pmtMonth + 1;

         pmtYear = pmtDate.getYear();
         if(pmtYear < 1900) {
            pmtYear += 1900;
         }


         pmtString = (pmtMonth + "/" + pmtDay + "/" + pmtYear);

         pmtRow += "<tr><td align=right><font face='arial'><small>" + pmtNum + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + pmtString + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(prinPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(intPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(displayPmtAmt,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(prin,2,1,1,1) + "</small></font></td></tr>";
 

         if(pmtMonth == 12 || count == nPer) {

            pmtRow += "<tr bgcolor='#dddddd'><td align=right><font face='arial'><small>Total</small></font></td>";
            pmtRow += "<td align=left><font face='arial'><small>" + pmtYear + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearPrin,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearInt,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td></tr>";


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

      var part1 = "<br /><br /><center><font face='arial'>";
      part1 += "<big><strong>Amortization Schedule</strong></big></font></center>";


      var part2 = "<center><table border=1 cellpadding=2 cellspacing=0>";
      part2 += "<tr><td colspan=6><font face='arial'><small><b>Loan ";
      part2 += "Date: " + loanDate + "<br />Principal: " + fns(v_prin,2,1,1,1) + "<br /># of ";
      part2 += "Payments: " + nPer + "<br />Interest Rate: " + fns(v_rate,3,0,2,1) + "<br />";
      part2 += "Payment: " + fns(pmtAmt,2,1,1,1) + "<br />";
      part2 += "Balance due after " + v_due_years + " years: " + fns(prin,2,1,1,1) + "<br />";
      part2 += "</b></small></font></td></tr><tr><td colspan=6>";
      part2 += "<center><font face='arial'><b>Schedule of Payments</b></font><br /><font face='arial'>";
      part2 += "<small><small>Please allow for slight rounding differences.</small></small></font></center></td></tr>";
      part2 += "<tr bgcolor='silver'><td align='center'><font face='arial'><small><b>Pmt #</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Date</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Principal</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Interest</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Payment</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Balance</b></small></font></td></tr>";

      var part3 = ("" + pmtRow + "");

      var part4 = "<tr><td colspan='2'><font face='arial'><small><b>Grand Total</b></small></font></td>";
      part4 += "<td align=right><font face='arial'><small><b>" + fns(accumPrin,2,1,1,1) + "</b></small></font></td>";
      part4 += "<td align=right><font face='arial'><small><b>" + fns(accumInt,2,1,1,1) + "</b></small></font></td>";
      part4 += "<td> </td><td> </td></tr></table><br />";


      var schedule = (part1 + "" + part2 + "" + part3 + part4 + "");
     document.getElementById('amortization_schedule').innerHTML = schedule;

     jQuery('.email-my-results').removeClass('hidden');

   }

}

function clear_results(form) {

   document.calc.bal_due.value = "";

}

function reset_calc(form) {
  document.getElementById('amortization_schedule').innerHTML = "";
   var v_min_pmt_span = document.getElementById("min_pmt");
   v_min_pmt_span.innerHTML = "";

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
<br><h4 align="center">Balloon Mortgage Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td nowrap="">
Mortgage loan amount:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="calc_min(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Annual interest rate (APR):
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="calc_min(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Desired monthly mortgage payment <span id="min_pmt"></span>:
</td>
<td align="center">
<input type="text" name="pmt" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Years before loan balloons:
</td>
<td align="center">
<input type="text" name="due_years" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" name="compute" value="Calculate Balloon At End Of Term" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td nowrap="">
Mortgage balloon after specified number of years:
</td>
<td align="center">
<input type="text" name="bal_due" size="15">
</td>
</tr>
<tr>
<td colspan="2" align="center" id="amortization_schedule">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
