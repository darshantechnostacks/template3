
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Arm Mortgage Calculator - Adjustable Rate Mortgage</title>

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


function computeForm(report) {
   var Vprincipal = sn(document.calc.principal.value);
   var Vfixed_rate = sn(document.calc.fixed_rate.value);
   var Vadj_start_rate = sn(document.calc.adj_start_rate.value);
   var Vadj_start_months = sn(document.calc.adj_start_months.value);
   var Vadj_rate_cap = sn(document.calc.adj_rate_cap.value);
   var Vadjust_amt = sn(document.calc.adjust_amt.value);

   var alert_txt = "";

   if(Vprincipal == 0) {
      alert("Please enter the mortgage's principal amount.");
      document.calc.principal.focus();
   } else
   if(Vadjust_amt == 0) {
      alert_txt = "Please enter the expected amount of each adjustment (eg.";
      alert_txt += " '.25' if rates are expected to increase or '-.25' if";
      alert_txt += " rates are expected to decrease).";
      alert(alert_txt);
      document.calc.adjust_amt.focus();
   } else
   if(Vfixed_rate == 0) {
      alert("Please enter the annual interest rate for the fixed mortgage.");
      document.calc.fixed_rate.focus();
   } else
   if(Vadj_start_rate == 0) {
      alert("Please enter the interest rate for the fully amortizing adjustable mortgage.");
      document.calc.adj_start_rate.focus();
   } else
   if(Vadj_start_months == 0) {
      alert_txt = "Please enter the number of months the rate will ";
      alert_txt += "be fixed for the fully amortizing ";
      alert_txt += "adjustable mortgage.";
      alert(alert_txt);
      document.calc.adj_start_months.focus();
   } else
   if(Vadj_rate_cap == 0) {
      alert_txt = "Please enter the maximum allowable interest rate ";
      alert_txt += "(rate cap) for the fully amortizing ";
      alert_txt += "adjustable rate mortgage.";
      alert(alert_txt);
      document.calc.adj_rate_cap.focus();
   } else {


      var VnumYears_idx = document.calc.numYears.selectedIndex;
      var VnumYears = document.calc.numYears.options[VnumYears_idx].value;
      var term_months = VnumYears * 12;

      if(Vprincipal < 100) {
         alert("Please enter a mortgage loan amount that is greater than $100.");
         document.calc.principal.focus();
      } else
      if(Vprincipal > 100000000) {
         alert("Please enter a mortgage loan amount that is less than $100,000,000.");
         document.calc.principal.focus();
      } else
      if(Vadjust_amt > 3) {
         alert("Rate adjustment amount must be less than or equal to 3.000%.");
         document.calc.adjust_amt.focus();
      } else
      if(Vadjust_amt < -3) {
         alert("Rate adjustment amount must be greater than or equal to -3.000%.");
         document.calc.adjust_amt.focus();
      } else
      if(Vadj_start_rate > 25) {
         alert_txt = "Please enter a starting interest rate for the ";
         alert_txt += "fully amortizing adjustable rate mortgage that ";
         alert_txt += "is less than or equal to 25.000%.";
         alert(alert_txt);
         document.calc.adj_start_rate.focus();
      } else
      if(Vadj_rate_cap < 5) {
         alert_txt = "Please enter a rate cap for the fully amortizing ";
         alert_txt += "adjustable rate mortgage that is greater than ";
         alert_txt += "or equal to 5.000%.";
         alert(alert_txt);
         document.calc.adj_rate_cap.focus();
      } else
      if(Vadj_rate_cap > 25) {
         alert_txt = "Please enter a rate cap for the fully amortizing ";
         alert_txt += "adjustable rate mortgage that is less ";
         alert_txt += "than or equal to 25.000%.";
         alert(alert_txt);
         document.calc.adj_rate_cap.focus();
      } else
      if(Vadj_start_months > 120) {
         alert_txt = "Number of months before adjustments for the fully ";
         alert_txt += "amortizing adjustable rate mortgage must be ";
         alert_txt += "less than or equal to 120.";
         alert(alert_txt);
         document.calc.adj_start_months.focus();
      } else {



         var Vfixed_pmt = computeMonthlyPayment(Vprincipal, term_months, Vfixed_rate);
         Vfixed_pmt = Math.round(Vfixed_pmt * 100) / 100;
         document.calc.fixed_pmt.value = fns(Vfixed_pmt,2,1,1,1);

         var Vadj_start_pmt = computeMonthlyPayment(Vprincipal, term_months, Vadj_start_rate);
         //Vadj_start_pmt = Math.round(Vadj_start_pmt * 100) / 100;
         document.calc.adj_start_pmt.value = fns(Vadj_start_pmt,2,1,1,1);

         var fix_rate = Vfixed_rate;
         var adj_rate = Vadj_start_rate;

         var fix_pmt = Vfixed_pmt;
         var adj_pmt = Vadj_start_pmt;

         var fix_accum_pmts = 0;
         var adj_accum_pmts = 0;

         var fix_prin = Vprincipal;
         var fix_int_port = 0;
         var fix_accum_int = 0;
         var fix_prin_port = 0;
         var fix_accum_prin = 0;

         var adj_prin = Vprincipal;
         var adj_int_port = 0;
         var adj_accum_int = 0;
         var adj_prin_port = 0;
         var adj_accum_prin = 0;

         var cnt = 0;
         var adj_adjust_nprs = 0;
         var Vadjust_months = 12;
         var adj_new_term_months = 0;

         var fix_i = 0;
         var adj_i = 0;

         var pmtRows = "";

         while(cnt < term_months) {

            cnt += 1;

            if(cnt <= Vadj_start_months) {
               adj_rate = Vadj_start_rate;
            } else {
               if((Number(cnt)-Number(1)) % Vadjust_months == 0) {
                  adj_adjust_nprs += 1;
                  adj_new_term_months = Number(term_months) - Number(cnt) + Number(1);
                  adj_rate = Number(adj_adjust_nprs * Vadjust_amt) + Number(Vadj_start_rate);
                  if(adj_rate < 2) {
                     adj_rate = 2;
                  }
                  if(adj_rate > Vadj_rate_cap) {
                     adj_rate = Vadj_rate_cap;
                  }
                  adj_pmt = computeMonthlyPayment(adj_prin, adj_new_term_months, adj_rate);
                  //adj_pmt = Math.round(adj_pmt * 100) / 100;
               }
            }


            fix_i = fix_rate / 100 / 12;
            adj_i = adj_rate / 100 / 12;

            if(cnt < term_months) {

               fix_int_port = Math.round(fix_prin * fix_i * 100) / 100;
               fix_accum_int += fix_int_port;
               fix_prin_port= Number(fix_pmt) - Number(fix_int_port);
               fix_accum_prin = Number(fix_accum_prin) + Number(fix_prin_port);
               fix_prin = Number(fix_prin) - Number(fix_prin_port);

               adj_int_port = Math.round(adj_prin * adj_i * 100) / 100;
               adj_accum_int += adj_int_port;
               adj_prin_port= Number(adj_pmt) - Number(adj_int_port);
               adj_accum_prin = Number(adj_accum_prin) + Number(adj_prin_port);
               adj_prin = Number(adj_prin) - Number(adj_prin_port);

            } else {

               fix_int_port = Math.round(fix_prin * fix_i * 100) / 100;
               fix_accum_int += fix_int_port;
               fix_prin_port= fix_prin;
               fix_accum_prin = Number(fix_accum_prin) + Number(fix_prin_port);
               fix_prin = Number(fix_prin) - Number(fix_prin_port);
               fix_pmt = Number(fix_prin_port) + Number(fix_int_port);

               adj_int_port = Math.round(adj_prin * adj_i * 100) / 100;
               adj_accum_int += adj_int_port;
               adj_prin_port= adj_prin;
               adj_accum_prin = Number(adj_accum_prin) + Number(adj_prin_port);
               adj_prin = Number(adj_prin) - Number(adj_prin_port);
               adj_pmt = Number(adj_prin_port) + Number(adj_int_port);
            }

            fix_accum_pmts += fix_pmt;
            adj_accum_pmts += adj_pmt;


                pmtRows = "" + pmtRows + "<tr><td align=right><font face='arial'>";
                pmtRows += "<small>" + cnt + "</small></font></td><td align=right>";
                pmtRows += "<font face='arial'><small>" + fns(fix_pmt,2,1,1,1) + "</small>";
                pmtRows += "</font></td><td align=right><font face='arial'>";
                pmtRows += "<small>" + fns(fix_prin,2,1,1,1) + "</small>";
                pmtRows += "</font></td><td align=right><font face='arial'>";
                pmtRows += "<small>" + fns(adj_pmt,2,1,1,1) + "</small>";
                pmtRows += "</font></td><td align=right><font face='arial'>";
                pmtRows += "<small>" + fns(adj_prin,2,1,1,1) + "</small>";
                pmtRows += "</font></td></tr>";


         }

         document.calc.fixed_total_pmts.value = fns(fix_accum_pmts,2,1,1,1);
         document.calc.fixed_total_int.value = fns(fix_accum_int,2,1,1,1);
         document.calc.fixed_max_pmt.value = fns(Vfixed_pmt,2,1,1,1);


         document.calc.adj_total_pmts.value = fns(adj_accum_pmts,2,1,1,1);
         document.calc.adj_total_int.value = fns(adj_accum_int,2,1,1,1);
         var Vadj_max_pmt = 0;
         if(adj_pmt > Vadj_start_pmt) {
            Vadj_max_pmt = adj_pmt;
         } else {
            Vadj_max_pmt = Vadj_start_pmt;
         }
         document.calc.adj_max_pmt.value = fns(Vadj_max_pmt,2,1,1,1);

         var fix_max_rate = fix_rate;

         var adj_max_rate = 0;
         if(adj_rate > Vadj_start_rate) {
            adj_max_rate = adj_rate;
         } else {
            adj_max_rate = Vadj_start_rate;
         }

            var part1 = "<center><font face='arial'>";
            part1 += "<big><strong>Adjustable Rate Mortgage vs. Fixed Mortgage Summary</strong>";
            part1 += "</big></font></center></br />";


            var part2 = "<center><table border=1 cellpadding=2 cellspacing=0 bordercolor='#EEEEEE'>";
            part2 += "<tr bgcolor='silver'><td colspan='3'><font face='arial'><small>";
            part2 += "<b>Comparisons</b></small></font></td><td align='center'>";
            part2 += "<font face='arial'><small><b>Fixed Mortgage</b></small></font>";
            part2 += "</td><td align='center'><font face='arial'><small><b>";
            part2 += "Fully Amortizing ARM</b></small></font></td>";
            part2 += "</tr><tr><td colspan='3'><font face='arial'><small>Mortgage loan amount:";
            part2 += "</small></font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vprincipal,2,1,1,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vprincipal,2,1,1,1) + "</small></font>";
            part2 += "</td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Mortgage term:</small>";
            part2 += "</font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + VnumYears + " years</small></font></td><td align='right'>";
            part2 += "<font face='arial'><small>" + VnumYears + " years</small></font></td>";
            part2 += "</td></tr><tr><td colspan='3'><font face='arial'>";
            part2 += "<small>Beginning interest rate:</small></font></td><td align='right'>";
            part2 += "<font face='arial'><small>" + fns(Vfixed_rate,3,0,2,1) + "</small>";
            part2 += "</font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vadj_start_rate,3,0,2,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Maximum interest rate:</small>";
            part2 += "</font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vfixed_rate,3,0,2,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(adj_max_rate,3,0,2,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Beginning monthly payment:</small>";
            part2 += "</font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vfixed_pmt,2,1,1,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vadj_start_pmt,2,1,1,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Maximum monthly payment:";
            part2 += "</small></font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vfixed_pmt,2,1,1,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vadj_max_pmt,2,1,1,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Interest rate cap:</small></font></td>";
            part2 += "<td align='right'><font face='arial'><small>N/A</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vadj_rate_cap,3,0,2,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Expected rate adjustment amount:";
            part2 += "</small></font></td><td align='right'><font face='arial'><small>N/A</small>";
            part2 += "</font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(Vadjust_amt,2,0,2,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Initial fixed rate period:</small>";
            part2 += "</font></td><td align='right'><font face='arial'><small>N/A</small></font></td>";
            part2 += "<td align='right'><font face='arial'><small>" + Vadj_start_months + " months";
            part2 += "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Total payments:</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(fix_accum_pmts,2,1,1,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(adj_accum_pmts,2,1,1,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Total interest:</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(fix_accum_int,2,1,1,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(adj_accum_int,2,1,1,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan='3'><font face='arial'><small>Ending principal balance:</small>";
            part2 += "</font></td><td align='right'><font face='arial'>";
            part2 += "<small>" + fns(fix_prin,2,1,1,1) + "</small></font></td>";
            part2 += "<td align='right'><font face='arial'>";
            part2 += "<small>" + fns(adj_prin,2,1,1,1) + "</small></font></td>";
            part2 += "</tr>";
            part2 += "<tr><td colspan=5><center><font face='arial'><b>";
            part2 += "Schedule of Payments</b></font></br /><font face='arial'><small><small>";
            part2 += "Please allow for slight rounding differences.</small></small></font>";
            part2 += "</center></td></tr><tr bgcolor='silver'><td align='center'>";
            part2 += "<font face='arial'><small><b>Pmt</b></small></font></td>";
            part2 += "<td align='center' colspan='2'><font face='arial'><small><b>Fixed Mortgage</b>";
            part2 += "</small></font></td><td align='center' colspan='2'><font face='arial'>";
            part2 += "<small><b>Fully Amortizing ARM</b></small></font></td>";
            part2 += "<tr bgcolor='silver'>";
            part2 += "<td align='center'><font face='arial'><small><b>#</b></small></font></td>";
            part2 += "<td align='center'><font face='arial'><small><b>Payment</b></small></font></td>";
            part2 += "<td align='center'><font face='arial'><small><b>Balance</b></small>";
            part2 += "</font></td><td align='center'><font face='arial'><small><b>Payment</b>";
            part2 += "</small></font></td><td align='center'><font face='arial'><small>";
            part2 += "<b>Balance</b></small></font></td>";
            part2 += "</tr>";

            var part3 = ("" + pmtRows + "");

            var part4 = "</table>";

            var schedule = (part1 + "" + part2 + "" + part3 + "" + part4 + "");

            document.getElementById("report").innerHTML = schedule;
            jQuery('.email-my-results').removeClass('hidden');

      }
   }
}

function clear_results(form) {
   document.calc.fixed_pmt.value = "";
   document.calc.fixed_total_pmts.value = "";
   document.calc.fixed_total_int.value = "";
   document.calc.fixed_max_pmt.value = "";

   document.calc.adj_start_pmt.value = "";
   document.calc.adj_total_pmts.value = "";
   document.calc.adj_total_int.value = "";
   document.calc.adj_max_pmt.value = "";

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
<br><h4 align="center">ARM Mortgage Calculator – Adjustable Rate Mortgage</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3">
<b>Loan Information</b>
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Mortgage amount:
</td>
<td align="center">
<input type="text" name="principal" size="15" value="150000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Mortgage loan term:
</td>
<td align="center">
<select name="numYears" size="1" onchange="clear_results(this.form)">
<option value="30" selected="">30 years</option>
<option value="25">25 years</option>
<option value="20">20 years</option>
<option value="15">15 years</option>
<option value="12">12 years</option>
<option value="10">10 years</option>
<option value="5">5 years</option>
</select>
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Maximum adjustment (%):
</td>
<td align="center">
<input type="text" name="adjust_amt" size="15" value=".25" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3">
<b>Fixed Rate Mortgage</b>
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Fixed interest rate (%):
</td>
<td align="center">
<input type="text" name="fixed_rate" size="15" value="6.500" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3">
<b>Fully Amortized Adjustable Rate Mortgage</b>
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Beginning interest rate (%):
</td>
<td align="center">
<input type="text" name="adj_start_rate" size="15" value="5.250" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Number of months before first rate adjustment:
</td>
<td align="center">
<input type="text" name="adj_start_months" size="15" value="60" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="" colspan="2">
Interest rate cap (%):
</td>
<td align="center">
<input type="text" name="adj_rate_cap" size="15" value="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" name="compute" value="Calculate Mortgage" onclick="computeForm(0)">
<input type="reset" value="Clear">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
<b>Comparison Results</b>
</td>
<td align="center">
<b>Fixed</b>
</td>
<td align="center">
<b>ARM</b>
</td>
</tr>
<tr>
<td nowrap="">
Beginning principal and interest payment:
</td>
<td align="center">
<input type="text" name="fixed_pmt" size="15">
</td>
<td align="center">
<input type="text" name="adj_start_pmt" size="15">
</td>
</tr>
<tr>
<td nowrap="">
Total of payments:
</td>
<td align="center">
<input type="text" name="fixed_total_pmts" size="15">
</td>
<td align="center">
<input type="text" name="adj_total_pmts" size="15">
</td>
</tr>
<tr>
<td nowrap="">
Total interest:
</td>
<td align="center">
<input type="text" name="fixed_total_int" size="15">
</td>
<td align="center">
<input type="text" name="adj_total_int" size="15">
</td>
</tr>
<tr>
<td nowrap="">
Maximum monthly payment:
</td>
<td align="center">
<input type="text" name="fixed_max_pmt" size="15">
</td>
<td align="center">
<input type="text" name="adj_max_pmt" size="15">
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
