
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Credit Card Payment Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">

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


var pmt_num_arr = new Array();
var pmt_amt_arr = new Array();
var int_port_arr = new Array();
var prin_port_arr = new Array();
var prin_arr = new Array();


function computeForm(form) {

   var Vprincipal = sn(document.calc.principal.value);
   var Vinterest = sn(document.calc.interest.value);
   var Vfixed_pmt = sn(document.calc.fixed_pmt.value);

   if(Vprincipal == 0) {
      alert("Please enter the balance on your credit card.");
      document.calc.principal.focus();
   } else
   if(Vinterest == 0) {
      alert("Please enter the credit card's annual interest rate.");
      document.calc.interest.focus();
   } else
   if(document.calc.pmtMethod[1].checked && Vfixed_pmt == 0) {
      alert("Please enter the fixed payment amount you could afford to pay each month.");
      document.calc.fixed_pmt.focus();
   } else {

   	jQuery('.email-my-results').removeClass('hidden');

      var i = Vinterest;
      if(Vinterest >= 1) {
         i /= 100;
      }
      i /= 12;

      var Vminpayperc = document.calc.minpayperc.options[document.calc.minpayperc.selectedIndex].value;
      var Vmin_pmt = Vminpayperc * Vprincipal;

      var Vpmt_amt = 0;
      var Vpmt_method = 0;

      if(document.calc.pmtMethod[0].checked) {
         Vpmt_amt = Vmin_pmt;
         Vpmt_method = 0;
      } else {
         Vpmt_amt = Vfixed_pmt;
         Vpmt_method = 1;
      }

      var prin = Vprincipal;
      var count = 0;
      var int_port = 0;
      var prin_port = 0;
      var accum_int = 0;

      var Vpmt_rows = "";

      while(prin > 0) {

         count += 1;

         if(Vpmt_method == 0) {
            Vpmt_amt = Vminpayperc * prin;
            if(Vpmt_amt < 10) {
               Vpmt_amt = 10;
            }
         }


         if((prin * (Number(1) + Number(i))) > Vpmt_amt) {

            int_port = i * prin;
            prin_port = Number(Vpmt_amt) - Number(int_port);
            accum_int += int_port;
            prin = Number(prin) - Number(prin_port);

         } else {

            int_port = i * prin;
            prin_port = prin;
            Vpmt_amt = Number(prin) + Number(int_port);
            accum_int += int_port;
            prin = 0;

         }

         pmt_num_arr[count] = count;
         pmt_amt_arr[count] = fns(Vpmt_amt,2,1,1,1);
         int_port_arr[count] = fns(int_port,2,1,1,1);
         prin_port_arr[count] = fns(prin_port,2,1,1,1);
         prin_arr[count] = fns(prin,2,1,1,1);

         if(count > 1000) {
            alert("At the terms you entered your balance will never be paid off. Please increase the payment amount until this alert does not show up.");

            return;
            break;
         }


      }


      document.calc.num_pmts.value = count;

      var Vnum_years = count / 12;
      document.calc.num_years.value = fns(Vnum_years,0,0,0,0);

      document.calc.int_paid.value = fns(accum_int,2,1,1,1);
      document.calc.prin_paid.value = fns(Vprincipal,2,1,1,1);

      var v_summary = "";

      if(Vpmt_method == 0) {
         v_summary += "If you make the " + fns(Vminpayperc * 100,1,1,2,1) + " minimum payments per month, ";
         v_summary += "it will take you " + count + " months to pay off your existing balance.  You will ";
         v_summary += "pay " + fns(accum_int,2,1,1,1) + " in interest while paying off this balance.";

      } else {
         
         v_summary += "If you make " + fns(Vfixed_pmt,2,1,1,1) + " payments per month, it will take ";
         v_summary += "you " + count + " months to pay off your existing balance.  You will ";
         v_summary += "pay " + fns(accum_int,2,1,1,1) + " in interest while paying off this balance.";

      }

      var v_summary_cell = document.getElementById("summary");
      v_summary_cell.innerHTML = "<font face='arial'><small><strong>Summary:</strong> " + v_summary + "</small></font>";
      console.log('populating form');
      pmtSchedule(form);

   }
}

function pmtSchedule(form) {

   var pmt_count = sn(document.calc.num_pmts.value);

   if(pmt_count == 0) {
      alert("Please compute the top portion before attempting to create the payment schedule.");
      clearResults(form);

   } else {

      var row_count = 0;
      var Vpmt_rows = "";

      var today = new Date();
      var loanMM = today.getMonth() + 1;
      var loanYY = today.getYear();
      if(loanYY < 1900) {
         loanYY += 1900;
      }

      while(row_count < pmt_count) {

         row_count += 1;

         Vpmt_rows += "<tr>";
         Vpmt_rows += "<td align='right'><font face='arial'><small>" + loanMM + "/" + loanYY + "</small></font></td>";
         Vpmt_rows += "<td align='right'><font face='arial'><small>" + row_count + "</small></font></td>";
         Vpmt_rows += "<td align='right'><font face='arial'><small>" + pmt_amt_arr[row_count] + "</small></font></td>";
         Vpmt_rows += "<td align='right'><font face='arial'><small>" + int_port_arr[row_count] + "</small></font></td>";
         Vpmt_rows += "<td align='right'><font face='arial'><small>" + prin_port_arr[row_count] + "</small></font></td>";
         Vpmt_rows += "<td align='right'><font face='arial'><small>" + prin_arr[row_count] + "</small></font></td>";
         Vpmt_rows += "</tr>";

         loanMM += 1;
         if(loanMM == 13) {
            loanMM = 1;
            loanYY += 1;
         }

      }

      var part1 = "<br /><br /><center>";
      part1 += "<big><strong>Amortization Schedule</strong></big></center>";

      var Vminpayperc = document.calc.minpayperc.options[document.calc.minpayperc.selectedIndex].value;
      var Vpmt_text = "";
      if(document.calc.pmtMethod[0].checked) {
         Vpmt_text = fns(Vminpayperc * 100,1,0,2,1) + " of balance";
      } else {
         Vpmt_text = fns(document.calc.fixed_pmt.value,2,1,1,1);
      }
      var part2 = "<center><table id='sched_div' border=1 cellpadding=2 cellspacing=0 bordercolor='#CCCCCC'><tr><td colspan=6><font face='arial'><small>Principal: " + fns(document.calc.principal.value,2,1,1,1) + "<br />";
      part2 += "# of Payments: " + pmt_count + "<br />Interest Rate: " + fns(document.calc.interest.value,3,0,2,1) + "<br />";
      part2 += "Payment: " + Vpmt_text + "</strong></small></font></td></tr><tr><td colspan=6><center>";
      part2 += "<font face='arial'><strong>Schedule of Payments</strong></font><br />";
      part2 += "<font face='arial'><small><small>Please allow for slight rounding differences.";
      part2 += "</small></small></font></center></td></tr><tr><td align='center'>";
      part2 += "<font face='arial'><small><strong>Pmt Date</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Pmt #</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Pmt Amt</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Interest</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Principal</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Balance</strong></small></font></td></tr>";

      var part4 = "</table><br /><center>";

      var schedule = (part1 + "" + part2 + "" + Vpmt_rows + "" + part4 + "");

      document.getElementById("report").innerHTML = schedule;
   }
}

function clear_results(form) {

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   document.getElementById("report").innerHTML = "";

   document.calc.num_pmts.value = "";
   document.calc.num_years.value = "";
   document.calc.int_paid.value = "";
   document.calc.prin_paid.value = "";
   document.calc.pmt_rows.value = "";
}

function reset_calc(form) {
document.getElementById("report").innerHTML = "";
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
<br><h4 align="center">Credit Card Payment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td nowrap="">
Credit Card Balance Owed ($):
</td>
<td align="center">
<input type="text" name="principal" size="15" value="5000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
Annual Percentage Interest Rate (%):
</td>
<td align="center">
<input type="text" name="interest" value="12.000" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td nowrap="">
<input type="radio" name="pmtMethod" value="percent" checked="" onclick="clear_results(this.form)"> Minimum payment percentage:
</td>
<td align="center">
<select name="minpayperc" size="1" onchange="clear_results(this.form)">
<option value=".015">1.5%</option>
<option value=".02" selected="">2%</option>
<option value=".025">2.5%</option>
<option value=".03">3%</option>
<option value=".035">3.5%</option>
<option value=".04">4%</option>
<option value=".045">4.5%</option>
<option value=".05">5%</option>
</select>
</td></tr>
<tr>
<td nowrap="">
<input type="radio" name="pmtMethod" value="fixed" onclick="clear_results(this.form)"> Monthly Fixed Payment You Can Make ($):
</td>
<td align="center">
<input type="text" name="fixed_pmt" size="15" value="125.00" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Repayment Costs" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<b>
Repayment Results
</b>
</td>
</tr>
<tr>
<td>
Monthly Payments Remaining:
</td>
<td align="center">
<input type="text" name="num_pmts" size="15">
</td>
</tr>
<tr>
<td>
Years Until Full Repayment:
</td>
<td align="center">
<input type="text" name="num_years" size="15">
</td>
</tr>
<tr>
<td>
Total Interest Paid:
</td>
<td align="center">
<input type="text" name="int_paid" size="15">
</td>
</tr>
<tr>
<td>
Total Principal Paid:
</td>
<td align="center">
<input type="text" name="prin_paid" size="15">
</td>
</tr>
<tr>
<td colspan="2" id="summary">
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
