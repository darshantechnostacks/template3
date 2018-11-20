
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Debt Reduction Calculator (With Amortization Schedule)</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">


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

if(document.debt.principal.value == "" || document.debt.principal.value == 0) {
   alert("Please enter the principal amount (how much you owe as of today).");
   document.debt.principal.focus();
} else
if(document.debt.interest.value == "" || document.debt.interest.value == 0) {
   alert("Please enter an annual interest rate.");
   document.debt.interest.focus();
} else
if(document.debt.origPmt.value == "" || document.debt.origPmt.value == 0) {
   alert("Please enter your current monthly payment amount.");
   document.debt.origPmt.focus();
} else {

   var i = sn(document.debt.interest.value);
   var display_rate = i;

    if (i >= 1.0) {
       i = i / 100.0;
    }

    i /= 12;

   var prin1 = sn(document.debt.principal.value);
   if(prin1 == "") {
      prin1 = 0;
   } else {
      prin1 = prin1;
   }

   var prin2 = sn(document.debt.principal.value);
   if(prin2 == "") {
      prin2 = 0;
   } else {
      prin2 = prin2;
   }

   var prin3 = sn(document.debt.principal.value);
   if(prin3 == "") {
      prin3 = 0;
   } else {
      prin3 = prin3;
   }

   var pmt1 = sn(document.debt.origPmt.value);
   if(pmt1 == "") {
      pmt1 = 0;
   } else {
      pmt1 = pmt1;
   }

   var VpmtAdd = sn(document.debt.pmtAdd.value);
   if(VpmtAdd == "") {
      VpmtAdd = 0;
   } else {
      VpmtAdd = VpmtAdd;
   }

   var pmt2 = Number(pmt1) + Number(VpmtAdd);
  
   var prinPort1 = 0;
   var prinPort2 = 0;
   var intPort1 = 0;
   var intPort2 = 0;
   var count1 = 0;
   var count2 = 0;
   var accumInt1 = 0;
   var accumInt2 = 0;
    
   while(prin1 > 0) {
      intPort1 = i * prin1;
      accumInt1 = Number(accumInt1) + Number(intPort1);
      prinPort1 = Number(pmt1) - Number(intPort1);
      prin1 = Number(prin1) - Number(prinPort1);
      count1 = count1 + 1
      if(count1 > 600) { break; } else { continue;}
                    
   }

   while(prin2 > 0) {
      intPort2 = Number(i * prin2);
      accumInt2 = Number(accumInt2) + Number(intPort2);
      prinPort2 = Number(pmt2 - intPort2);
      prin2 = Number(prin2 - prinPort2);
      count2 = count2 + 1
      if(count2 > 600) { break; } else { continue;}
   }

   var VoldNPR = count1;
   document.debt.oldNPR.value = fn(VoldNPR,0,0);

   var VnewNPR = count2;
   document.debt.newNPR.value = fn(VnewNPR,0,0);

   var timSave = (count1 - count2);
   document.debt.timeSave.value = fn(timSave,0,0);

   var VoldIntCost = Number(accumInt1);
   document.debt.oldIntCost.value = "$" + fn(VoldIntCost,2,1);

   var VnewIntCost = Number(accumInt2);
   document.debt.newIntCost.value = "$" + fn(VnewIntCost,2,1);


   var VintSave = Number(accumInt1) - Number(accumInt2);
   document.debt.intSave.value = "$" + fn(VintSave,2,1);


   var Vroi = 0;
   if(VintSave > 0) {
      Vroi = (VintSave / (count2 / 12)) / (VpmtAdd * 12);
   } else {
      Vroi = 0;
   }
   document.debt.roi.value = fn(display_rate,2,0) + "%";



   var yearSave = 0;

   if(timSave / 12 < 1) {
      yearSave = 0;
   } else {
      yearSave = timSave / 12;
   }

   var sum_cell = document.getElementById("summary");
   var v_summary = "If you add $" + fn(VpmtAdd,2,1) + " to your monthly payment, you will pay off this ";
   v_summary += "debt in " + count2 + " payments instead of " + count1 + ", and you will ";
   v_summary += "save $" + fn(VintSave,2,1) + " in interest charges.  This savings ";
   v_summary += "translates into a guaranteed, tax-free, average annual return ";
   v_summary += "of " + fn(display_rate,2,0) + "%.  And that's not even considering ";
   v_summary += "the emotional returns you'll get when you pay off this ";
   v_summary += "debt " + timSave + "-months (" + fn(yearSave,2,0) + " ";
   v_summary += "years, " + (timSave %12) + " months) ahead of schedule!";


   sum_cell.innerHTML = "<font face='arial'><small>" + v_summary + "</small></font>";

   document.debt.Hprin.value = prin3;
   document.debt.HintRate.value = i;
   document.debt.Hpmt2.value = pmt2;
   createReport(form);
   jQuery('.email-my-results').removeClass('hidden');
   }

}

function createReport(form) {

   var Prin3 = Number(document.debt.Hprin.value);
   var i = Number(document.debt.HintRate.value);
   var pmt2 = Number(document.debt.Hpmt2.value);

   var intPort3 = 0;
   var accumInt3 = 0;
   var prinPort3 = 0;
   var accumPrin3 = 0;
   var count3 = 0;
   var pmtRow = "";
   var pmtNum = 0;
   var nowPmt = 0;

   var today = new Date();
   var dayFactor = today.getTime();
   var pmtDay = today.getDate();
   var loanMM = today.getMonth() + 1;
   var loanYY = today.getYear();
   var loanDate = (loanMM + "/" + pmtDay + "/" + loanYY);
   var monthMS = 86400000 * 30.4;
   var pmtDate = 0;

   while(Prin3 > 0) {
      if(Prin3 < pmt2) {
         intPort3 = Prin3 * i;
         accumInt3 = Number(accumInt3) + Number(intPort3);
         prinPort3 = Number(Prin3);
         accumPrin3 = Number(accumPrin3) + Number(prinPort3);
         Prin3 = 0;
      } else {
         intPort3 = Prin3 * i;
         accumInt3 = Number(accumInt3) + Number(intPort3);
         prinPort3 = Number(pmt2) - Number(intPort3);
         accumPrin3 = Number(accumPrin3) + Number(prinPort3);
         Prin3 = Number(Prin3) - Number(prinPort3);
      }
      pmtNow = Number(intPort3) + Number(prinPort3);
      count3 = Number(count3) + Number(1);
      pmtNum = Number(pmtNum) + Number(1);
      dayFactor = Number(dayFactor) + Number(monthMS);
      pmtDate = new Date(dayFactor);
      pmtMonth = pmtDate.getMonth();
      pmtMonth = pmtMonth + 1;
      pmtYear = pmtDate.getYear();
      pmtString = (pmtMonth + "/" + pmtDay + "/" + pmtYear);
      pmtRow += "<TR><TD ALIGN=RIGHT><font face='arial'><small>" + pmtNum + "</small></font></TD>";
      pmtRow += "<TD ALIGN=RIGHT><font face='arial'><small>" + pmtString + "</small></font></TD>";
      pmtRow += "<TD ALIGN=RIGHT><font face='arial'><small>" + fn(pmtNow,2,1) + "</small></font></TD>";
      pmtRow += "<TD ALIGN=RIGHT><font face='arial'><small>" + fn(prinPort3,2,1) + "</small></font></TD>";
      pmtRow += "<TD ALIGN=RIGHT><font face='arial'><small>" + fn(intPort3,2,1) + "</small></font></TD>";
      pmtRow += "<TD ALIGN=RIGHT><font face='arial'><small>" + fn(Prin3,2,1) + "</small></font></TD></TR>";
      if(count3 > 600) {
         alert("Using your current entries you will never pay off this loan.");
         break;
      } else {
         continue;
      }
    }

   var part1 = "<br /><br /><center><font face='arial'><big><strong>";


   part1 += "Amortization Schedule</strong></big></FONT></CENTER>";

   var part2 = "<CENTER><TABLE BORDER=1 CELLPADDING=4 CELLSPACING=0><TR>";
   part2 += "<TD COLSPAN=6><font face='arial'><small><B>Loan Date: " + loanDate + "";
   part2 += "<BR />Principal: $" + fn(document.debt.Hprin.value,2,1) + "";
   part2 += "<BR /># of Payments: " + count3 + "";
   part2 += "<BR />Interest Rate: " + fn(i * 12 * 100,2,0) + "%";
   part2 += "<BR />Payment: $" + fn(pmt2,2,1) + "</B></small></font></TD></TR>";
   part2 += "<TR><TD COLSPAN=6><CENTER><font face='arial'>Schedule of Payments</FONT>";
   part2 += "<BR /><font face='arial'><small><small>Please allow for slight rounding differences.";
   part2 += "</small></small></FONT></CENTER></TD></TR>";
   part2 += "<TR><TD><font face='arial'><small><B>Pmt #</B></small></font></TD>";
   part2 += "<TD ALIGN=CENTER><font face='arial'><small><B>Date</B></small></font></TD>";
   part2 += "<TD ALIGN=CENTER><font face='arial'><small><B>Payment</B></small></font></TD>";
   part2 += "<TD><font face='arial'><small><B>Principal</B></small></font></TD>";
   part2 += "<TD><font face='arial'><small><B>Interest</B></small></font></TD>";
   part2 += "<TD><font face='arial'><small><B>Balance</B></small></font></TD></TR>";

   var part3 = ("" + pmtRow + "");

   var part4 = "<TR><TD><font face='arial'><small><B>Totals</B></small></font></TD>";
   part4 += "<TD> </TD><TD> </TD><TD ALIGN=RIGHT><font face='arial'><small>";
   part4 += "<B>" + fn(accumPrin3,2,1) + "</B></small></font></TD>";
   part4 += "<TD><font face='arial'><small><B>" + fn(accumInt3,2,1) + "</B>";
   part4 += "</small></font></TD><TD> </TD></TR></TABLE><br/>";

   var schedule = (part1 + "" + part2 + "" + part3 + part4 + "");

   document.getElementById('amortization_schedule').innerHTML = schedule;
 }

function clear_results(form) {

   document.debt.oldNPR.value = "";
   document.debt.newNPR.value = "";
   document.debt.timeSave.value = "";
   document.debt.oldIntCost.value = "";
   document.debt.newIntCost.value = "";
   document.debt.intSave.value = "";
   document.debt.roi.value = "";

   var sum_cell = document.getElementById("summary");
   sum_cell.innerHTML = " ";

}


function clearForm(form) {

   document.debt.principal.value = "";
   document.debt.interest.value = "";
   document.debt.origPmt.value = "";
   document.debt.pmtAdd.value = "";
   document.debt.oldNPR.value = "";
   document.debt.newNPR.value = "";
   document.debt.timeSave.value = "";
   document.debt.oldIntCost.value = "";
   document.debt.newIntCost.value = "";
   document.debt.intSave.value = "";
   document.debt.roi.value = "";

   var sum_cell = document.getElementById("summary");
   sum_cell.innerHTML = " ";


}</script>
</head>
<body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-6815 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none mortgage-payoff-calculator not_home feature-box-none footer-height-tall calculator" itemscope itemtype="https://schema.org/WebPage">
    <div class="site-container">
         <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content mb5">
                    <div class="fmcalc-inner-container fmcalc-ic-c14">
                        <div class="fmcalc-wrapper">
                        <form name="debt" method="post" action="#">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<br><h4 align="center">Debt Reduction Calculator (With Amortization Schedule)</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Amount Owed:
</td>
<td align="center">
<input type="text" name="principal" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (APR):
</td>
<td align="center">
<input type="text" name="interest" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Your Current Monthly Payment:
</td>
<td align="center">
<input type="text" name="origPmt" size="12&quot;" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Amount You Can Add To Current Payment:
</td>
<td align="center">
<input type="text" name="pmtAdd" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Debt Reduction Savings" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="clearForm(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Current Payoff Term (Months):
</td>
<td align="center">
<input type="text" name="oldNPR" size="12">
</td>
</tr>
<tr>
<td>
Revised Payoff Term (Months):
</td>
<td align="center">
<input type="text" name="newNPR" size="12">
</td>
</tr>
<tr>
<td>
Time Reduction (Months):
</td>
<td align="center">
<input type="text" name="timeSave" size="12">
</td>
</tr>
<tr>
<td>
Current Interest Cost:
</td>
<td align="center">
<input type="text" name="oldIntCost" size="12">
</td>
</tr>
<tr>
<td>
Revised Interest Cost:
</td>
<td align="center">
<input type="text" name="newIntCost" size="12">
</td>
</tr>
<tr>
<td>
Total Interest Savings:
</td>
<td align="center">
<input type="text" name="intSave" size="12">
</td>
</tr>
<tr>
<td>
Extra Payment Return On Investment (ROI):
</td>
<td align="center">
<input type="text" name="roi" size="12">
</td>
</tr>
<tr>
<td colspan="2" id="summary">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="hidden" name="Hprin" value="0">
<input type="hidden" name="HintRate" value="0">
<input type="hidden" name="Hpmt2" value="0">
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
