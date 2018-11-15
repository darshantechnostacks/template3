
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Interest Only Mortgage Calculator</title>

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

   var v_prin = sn(document.calc.principal.value);
   var v_rate = sn(document.calc.intRate.value);
   var v_years = sn(document.calc.numYears.value);

   if(v_prin == 0) {
      alert("Please enter the mortgage's principal amount.");
      document.calc.principal.focus();
   } else
   if(v_rate == 0 || v_rate > 25) {
      alert("Please enter the mortgage's annual interest rate (maximum of 25%).");
      document.calc.intRate.focus();
   } else
   if(v_years == 0 || v_years > 40) {
      alert("Please enter the mortgage's term in number of years (maximum of 40 years).");
      document.calc.numYears.focus();
   } else {

      var v_ann_tax = sn(document.calc.annualTax.value);

      var v_mo_tax =0;
      if(v_ann_tax == 0) {
         v_ann_tax = 0;
         v_mo_tax =0;
      } else {
         v_ann_tax = v_ann_tax;
         v_mo_tax = v_ann_tax / 12;
         v_mo_tax *= 100;
         v_mo_tax = Math.round(v_mo_tax);
         v_mo_tax /= 100;
      }

      var v_ann_ins = sn(document.calc.annualIns.value);
      var v_mo_ins =0;
      if(v_ann_ins == 0) {
         v_ann_ins = 0;
         v_mo_ins =0;
      } else {
         v_ann_ins = v_ann_ins;
         v_mo_ins = v_ann_ins / 12;
         v_mo_ins *= 100;
         v_mo_ins = Math.round(v_mo_ins);
         v_mo_ins /= 100;
      }

      var v_mo_PMI = sn(document.calc.monthlyPMI.value);
      var v_mo_assoc = sn(document.calc.monthlyAssoc.value);

      var v_other_pmts = Number(v_mo_tax) + Number(v_mo_ins) + Number(v_mo_PMI) + Number(v_mo_assoc);

      var v_npr = v_years * 12;

      var v_pi_pmt = computeMonthlyPayment(v_prin, v_npr, v_rate);

      var v_tot_pi_pmt = Number(v_pi_pmt) + Number(v_other_pmts);

      document.calc.monthlyPI.value = fns(v_pi_pmt,2,1,1,1);
      document.calc.otherPmtsPI.value = fns(v_other_pmts,2,1,1,1);
      document.calc.monthlyPmtPI.value = fns(v_tot_pi_pmt,2,1,1,1);

      var io_rate_perc = v_rate;
      if(io_rate_perc >= 1) {
         io_rate_perc /= 100;
      }
      io_rate_perc /= 12;
      var v_io_pmt = v_prin * io_rate_perc;
      var v_tot_io_pmt = Number(v_io_pmt) + Number(v_other_pmts);

      document.calc.monthlyIO.value = fns(v_io_pmt,2,1,1,1);
      document.calc.otherPmtsIO.value = fns(v_other_pmts,2,1,1,1);
      document.calc.monthlyPmtIO.value = fns(v_tot_io_pmt,2,1,1,1);
      createReport(form);
   }


}


function clear_results(form) {

   document.calc.monthlyPI.value = "";
   document.calc.otherPmtsPI.value = "";
   document.calc.monthlyPmtPI.value = "";

   document.calc.monthlyIO.value = "";
   document.calc.otherPmtsIO.value = "";
   document.calc.monthlyPmtIO.value = "";

}


function createReport(form) {

   var alert_txt = "";

   if(document.calc.monthlyPI.value == 0 || document.calc.monthlyPI.value == "") {
      alert_txt = "Please enter compute the top section of the calculator ";
      alert_txt += "before attempting to create the printer friendly report.";
      alert(alert_txt);
      document.calc.principal.focus();
   } else {

      var v_prin = sn(document.calc.principal.value);
      var v_rate = sn(document.calc.intRate.value);
      if(v_rate < 1) {
         v_rate *= 100;
      }
      var v_years = sn(document.calc.numYears.value);

      var v_ann_tax = sn(document.calc.annualTax.value);

      var v_mo_tax =0;
      if(v_ann_tax == 0) {
         v_ann_tax = 0;
         v_mo_tax =0;
      } else {
         v_ann_tax = v_ann_tax;
         v_mo_tax = v_ann_tax / 12;
         v_mo_tax *= 100;
         v_mo_tax = Math.round(v_mo_tax);
         v_mo_tax /= 100;
      }

      var v_ann_ins = sn(document.calc.annualIns.value);
      var v_mo_ins =0;
      if(v_ann_ins == 0) {
         v_ann_ins = 0;
         v_mo_ins =0;
      } else {
         v_ann_ins = v_ann_ins;
         v_mo_ins = v_ann_ins / 12;
         v_mo_ins *= 100;
         v_mo_ins = Math.round(v_mo_ins);
         v_mo_ins /= 100;
      }

      var v_mo_PMI = sn(document.calc.monthlyPMI.value);
      var v_mo_assoc = sn(document.calc.monthlyAssoc.value);

      var rows = "";

      var head = "<br />";
      head += "<br /><center><font face='arial'><strong>Interest-Only Vs. ";
      head += "Principal-Interest<br />Mortgage Payment Comparison</strong></font></center><br />";

      var titles = "<center><table border=1 cellpadding=2 cellspacing=0><tr>";
      titles += "<td colspan=3><font face='arial'><small><b>Principal: ";
      titles += "" + fns(v_prin,2,1,1,1) + "<br />Interest ";
      titles += "Rate: " + fns(v_rate,3,0,2,1) + "<br />";
      titles += "Term: " + v_years + " years</b></small></font></td></tr>";
      titles += "<tr bgcolor='silver'><td align='center'><font face='arial'><small>";
      titles += "<b>Descriptions</b></small></font></td><td align='center'>";
      titles += "<font face='arial'><small><b>Interest<br />Only</b></small></font>";
      titles += "</td><td align='center'><font face='arial'><small><b>Principal";
      titles += "<br />& Interest</b></small></font></td></tr>";

      rows += "<tr><td align='left'><font face='arial'><small>Mortgage payment</small></font></td>";
      rows += "<td align=right><font face='arial'>";
      rows += "<small>" + document.calc.monthlyIO.value + "</small></font></td>";
      rows += "<td align=right><font face='arial'>";
      rows += "<small>" + document.calc.monthlyPI.value + "</small>";
      rows += "</font></td></tr>";

      rows += "<tr><td align='left'><font face='arial'><small>Monthly property taxes</small>";
      rows += "</font></td><td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_tax,2,1,1,1) + "</small></font></td>";
      rows += "<td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_tax,2,1,1,1) + "</small></font></td></tr>";

      rows += "<tr><td align='left'><font face='arial'><small>Monthly insurance</small>";
      rows += "</font></td><td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_ins,2,1,1,1) + "</small></font></td>";
      rows += "<td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_ins,2,1,1,1) + "</small></font></td></tr>";

      rows += "<tr><td align='left'><font face='arial'><small>Monthly PMI ";
      rows += "(Private Mortgage Insurance)</small></font></td><td align=right>";
      rows += "<font face='arial'><small>" + fns(v_mo_PMI,2,1,1,1) + "</small>";
      rows += "</font></td><td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_PMI,2,1,1,1) + "</small></font></td></tr>";

      rows += "<tr><td align='left'><font face='arial'><small>Monthly association dues</small>";
      rows += "</font></td><td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_assoc,2,1,1,1) + "</small></font></td>";
      rows += "<td align=right><font face='arial'>";
      rows += "<small>" + fns(v_mo_assoc,2,1,1,1) + "</small></font></td></tr>";

      rows += "<tr><td align='left'><font face='arial'><small>Total monthly payments</small>";
      rows += "</font></td><td align=right><font face='arial'>";
      rows += "<small>" + document.calc.monthlyPmtIO.value + "</small></font></td>";
      rows += "<td align=right><font face='arial'>";
      rows += "<small>" + document.calc.monthlyPmtPI.value + "</small></font></td></tr>";

      var foot = "</table>";

      var schedule = (head + "" + titles + "" + rows + "" + foot);

      document.getElementById('printout').innerHTML = schedule;
      jQuery('.email-my-results').removeClass('hidden');
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
<br><h4 align="center">Interest Only Mortgage Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Mortgage amount:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Mortgage interest rate (%):
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Mortgage loan term (# years):
</td>
<td align="center">
<input type="text" name="numYears" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Optional: Annual real estate taxes:
</td>
<td align="center">
<input type="text" name="annualTax" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Optional: Annual homeowners insurance:
</td>
<td align="center">
<input type="text" name="annualIns" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Optional: Monthly PMI:
</td>
<td align="center">
<input type="text" name="monthlyPMI" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" nowrap="">
Optional: Monthly association dues:
</td>
<td align="center">
<input type="text" name="monthlyAssoc" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" name="calc_button" value="Calculate Mortgage Payments" onclick="computeForm(this.form)">
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
Interest Only Mortgage
</b>
</td>
<td align="center">
<b>
Principal &amp; Interest Mortgage
</b>
</td>
</tr>
<tr>
<td nowrap="">
Monthly Principal and Interest Payment:
</td>
<td align="center">
<input type="text" name="monthlyIO" size="15">
</td>
<td align="center">
<input type="text" name="monthlyPI" size="15">
</td>
</tr>
<tr>
<td nowrap="">
Monthly Taxes, Insurance, PMI and dues:
</td>
<td align="center">
<input type="text" name="otherPmtsIO" size="15">
</td>
<td align="center">
<input type="text" name="otherPmtsPI" size="15">
</td>
</tr>
<tr>
<td nowrap="">
Total monthly mortgage payment:
</td>
<td align="center">
<input type="text" name="monthlyPmtIO" size="15">
</td>
<td align="center">
<input type="text" name="monthlyPmtPI" size="15">
</td>
</tr>
<tr>
<td colspan="3" id="printout"></td>
</tr>
</tbody>
</table>
</form>
                            
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
