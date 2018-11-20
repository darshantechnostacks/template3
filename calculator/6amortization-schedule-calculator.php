
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Amortization Schedule Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Loan Amortization Calculator with Amortization Schedule
//ALL RIGHTS RESERVED
//Created: 07/14/2008
//Last Modified: 04/03/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1297-158-1256
//Commercial Licence Date:2009-04-14
//*******************************************



function computeIntervalPayment(prin, numPmts, intRate, pmtInt) {

if (intRate > 1.0) {
  intRate = intRate / 100.0;
}
intRate /= pmtInt;

var pow = 1;
for (var j = 0; j < numPmts; j++)
   pow = pow * (1 + intRate);

var pmtAmt = (prin * pow * intRate) / (pow - 1);

return pmtAmt;

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

function calc_down_1(form) {

   document.lpc_5.Hdown_type.value = 1;

   var v_price = sn(document.lpc_5.price.value);
   var v_down = sn(document.lpc_5.down.value);
   if(v_down < 25) {
      v_down = v_down / 100 * v_price;
      document.lpc_5.down.value = fn(v_down,2,0);
   }
   var v_principal = 0;
   if(v_price > 0 && v_down > 0) {
      v_principal = Number(v_price) - Number(v_down);
   }

   document.lpc_5.principal.value = fn(v_principal,2,1);

   clear_results(document.lpc_5);

}

function calc_down_2(form) {

   document.lpc_5.Hdown_type.value = 2;

   var v_price = sn(document.lpc_5.price.value);
   var v_down = sn(document.lpc_5.down.value);
   if(v_down > 25) {
      v_down = v_down / v_price * 100;
      document.lpc_5.down.value = fn(v_down,2,0);
   }
   var v_principal = 0;
   if(v_price > 0 && v_down > 0) {
      v_principal = Number(v_price) - Number(v_down / 100 * v_price);
   }

   document.lpc_5.principal.value = fn(v_principal,2,1);

   clear_results(document.lpc_5);

}

function calc_prin(form) {

   var v_price = sn(document.lpc_5.price.value);
   var v_down = sn(document.lpc_5.down.value);
   var v_principal = 0;

   if(document.lpc_5.Hdown_type.value == 1) {
      v_principal = Number(v_price) - Number(v_down);
   } else {
      v_principal = Number(v_price) - Number(v_down / 100 * v_price);
   }

   document.lpc_5.principal.value = fn(v_principal,2,1);

   clear_results(document.lpc_5);
}

function computeForm(form) {

   if(document.lpc_5.principal.value == "" || document.lpc_5.principal.value == 0) {
      alert("Please enter an amount in Line #1.");
      document.lpc_5.principal.focus();
   } else
      if(document.lpc_5.rate.value == "" || document.lpc_5.rate.value == 0) {
      alert("Please enter an amount in Line #2.");
      document.lpc_5.rate.focus();
   } else {

      var v_principal = sn(document.lpc_5.principal.value);
      document.lpc_5.r_principal.value = "$" + fn(v_principal,2,1);

      var v_rate = sn(document.lpc_5.rate.value);
      document.lpc_5.r_rate.value = fn(v_rate,1,0) + "%";

      var v_term = document.lpc_5.term.options[document.lpc_5.term.selectedIndex].value;
      document.lpc_5.r_term.value = document.lpc_5.term.options[document.lpc_5.term.selectedIndex].text;

      var v_interval = document.lpc_5.interval.options[document.lpc_5.interval.selectedIndex].value;
      document.lpc_5.r_type.value = document.lpc_5.interval.options[document.lpc_5.interval.selectedIndex].text;

      var  v_npr =  v_term * v_interval;

      var r_payment = computeIntervalPayment(v_principal, v_npr, v_rate, v_interval);
      document.lpc_5.r_payment.value = "$" + fn(r_payment,2,1);
      createReport(form);
      jQuery('.email-my-results').removeClass('hidden');
   }
    
}

function clearStuff() {
  document.getElementById("report").innerHTML = "";
}

function clear_results(form) {
   document.getElementById("report").innerHTML = "";
   document.lpc_5.r_principal.value = "";
   document.lpc_5.r_rate.value = "";
   document.lpc_5.r_term.value = "";
   document.lpc_5.r_type.value = "";
   document.lpc_5.r_payment.value = "";


}


function createReport(form) {

   if(document.lpc_5.r_principal.value == "" || document.lpc_5.r_principal.value == 0) {
      alert("Please calculate the payment before clicking the [Payment Schedule] button.");
      document.lpc_5.principal.focus();
   } else {

      var v_principal = sn(document.lpc_5.r_principal.value);
      var v_rate = sn(document.lpc_5.r_rate.value);
      var v_term = document.lpc_5.term.options[document.lpc_5.term.selectedIndex].value;
      var v_interval = document.lpc_5.interval.options[document.lpc_5.interval.selectedIndex].value;

      var v_npr =  v_term * v_interval;

      var v_payment = sn(document.lpc_5.r_payment.value);

      var v_prin = v_principal;
      var v_int = v_rate;
      if(v_int >= 1) {
         v_int /= 100;
      }
      v_int /= v_interval;

      var v_int_port = 0;
      var v_accum_int = 0;
      var v_prin_port = 0;
      var v_accum_prin = 0;
      var v_count = 0;
      var v_pmt_row = "";
      var v_pmt_num = 0;


      var v_display_pmt_amt = 0;

      var v_accum_year_prin = 0;
      var v_accum_year_int = 0;

      var v_year = 1;



      while(v_count < v_npr) {

         if(v_count < (v_npr - 1)) {

            v_int_port = v_prin * v_int;
            v_int_port *= 100;
            v_int_port = Math.round(v_int_port);
            v_int_port /= 100;

            v_accum_int = Number(v_accum_int) + Number(v_int_port);
            v_accum_year_int = Number(v_accum_year_int) + Number(v_int_port);

            v_prin_port = Number(v_payment) - Number(v_int_port);
            v_prin_port *= 100;
            v_prin_port = Math.round(v_prin_port);
            v_prin_port /= 100;

            v_accum_prin = Number(v_accum_prin) + Number(v_prin_port);
            v_accum_year_prin = Number(v_accum_year_prin) + Number(v_prin_port);

            v_prin = Number(v_prin) - Number(v_prin_port);

            v_display_pmt_amt = Number(v_prin_port) + Number(v_int_port);

         } else {

            v_int_port = v_prin * v_int;
            v_int_port *= 100;
            v_int_port = Math.round(v_int_port);
            v_int_port /= 100;

            v_accum_int = Number(v_accum_int) + Number(v_int_port);
            v_accum_year_int = Number(v_accum_year_int) + Number(v_int_port);

            v_prin_port = v_prin;

            v_accum_prin = Number(v_accum_prin) + Number(v_prin_port);
            v_accum_year_prin = Number(v_accum_year_prin) + Number(v_prin_port);

            v_prin = 0;

      //pmtAmt = Number(intPort) + Number(prinPort);
            v_display_pmt_amt = Number(v_prin_port) + Number(v_int_port);
   }

   v_count = Number(v_count) + Number(1);

   v_pmt_num = Number(v_pmt_num) + Number(1);

   v_pmt_row += "<tr><td align=right><font face='arial'>";
   v_pmt_row += "<small>" + v_pmt_num + "</small></font></td>";
   v_pmt_row += "<td align=right><font face='arial'><small>" + fn(v_display_pmt_amt,2,1) + "</small>";
   v_pmt_row += "</font></td><td align=right><font face='arial'><small>" + fn(v_prin_port,2,1) + "</small>";
   v_pmt_row += "</font></td><td align=right><font face='arial'>";
   v_pmt_row += "<small>" + fn(v_int_port,2,1) + "</small>";
   v_pmt_row += "</font></td><td align=right><font face='arial'>";
   v_pmt_row += "<small>" + fn(v_prin,2,1) + "</small></font></td></tr>";


   if(v_pmt_num % v_interval == 0) {

      v_pmt_row += "<tr bgcolor='#dddddd'><td align=left>";
      v_pmt_row += "<font face='arial'><small>Year " + v_year + "</small>";
      v_pmt_row += "</font></td><td align=right><font face='arial'>";
      v_pmt_row += "<small> </small>";
      v_pmt_row += "</font></td><td align=right><font face='arial'>";
      v_pmt_row += "<small>" + fn(v_accum_year_prin,2,1) + "</small>";
      v_pmt_row += "</font></td><td align=right><font face='arial'>";
      v_pmt_row += "<small>" + fn(v_accum_year_int,2,1) + "</small></font></td>";
      v_pmt_row += "<td align=right><font face='arial'>";
      v_pmt_row += "<small> </small></font></td></tr>";

      v_year += 1;
      v_accum_year_prin = 0;
      v_accum_year_int = 0;

   }

      if(v_count > 100 * v_interval) {

         alert("Using your current entries you will never pay off this loan.");

         break;

         } else {

         continue;

         }

    }

   var v_int_text = "";

   if(v_interval == 12) {
      v_int_text = "Monthly";
   } else
   if(v_interval == 4) {
      v_int_text = "Quarterly";
   } else
   if(v_interval == 2) {
      v_int_text = "Semi-Annually";
   } else
   if(v_interval == 1) {
      v_int_text = "Annually";
   }

   var part1 = "<br /><br /><center><font face='arial'><big><strong>";
   part1 += "Amortization Schedule</strong></big></font></center>";

   var part2 = "<center><table border=1 cellpadding=2 cellspacing=0><tr><td colspan=5>";
   part2 += "<font face='arial'><small>Principal: $" + fn(v_principal,2,1) + "<br>";
   part2 += "Interest Rate: " + fn(v_rate,2,0) + "%<br>";
   part2 += "Payment Interval: " + v_int_text + "<br>";
   part2 += "# of Payments: " + v_npr + "<br>";
   part2 += "Payment: $" + fn(v_payment,2,1) + "</b></small></font></td></tr>";
   part2 += "<tr><td colspan=5><center><font face='arial'><b>Schedule of Payments</b></font><br>";
   part2 += "<font face='arial'><small><small>Please allow for slight rounding differences.";
   part2 += "</small></small></font></center></td></tr>";
   part2 += "<tr bgcolor='silver'><td align='center'><font face='arial'><small><b>Pmt #</b>";
   part2 += "</small></font></td>";
   part2 += "<td align='center'><font face='arial'><small><b>Payment</b></small></font></td>";
   part2 += "<td align='center'><font face='arial'><small><b>Principal</b></small></font></td>";
   part2 += "<td align='center'><font face='arial'><small><b>Interest</b></small></font></td>";
   part2 += "<td align='center'><font face='arial'><small><b>Balance</b></small></font></td></tr>";

   var part3 = ("" + v_pmt_row + "");

   var part4 = "<tr><td><font face='arial'><small><b>Grand Total</b></small></font></td><td> </td>";
   part4 += "<td align=right><font face='arial'><small><b>" + fn(v_accum_prin,2,1) + "</b>";
   part4 += "</small></font></td><td align=right><font face='arial'>";
   part4 += "<small><b>" + fn(v_accum_int,2,1) + "</b></small>";
   part4 += "</font></td><td> </td></tr></table><br><center>";
   part4 += "</center>";

   var schedule = (part1 + "" + part2 + "" + part3 + part4 + "");
    document.getElementById("report").innerHTML = schedule;

   }

}</script>
</head>
<body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-6815 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none mortgage-payoff-calculator not_home feature-box-none footer-height-tall calculator" itemscope itemtype="https://schema.org/WebPage">
    <div class="site-container">
         <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content mb5">
                    <div class="fmcalc-inner-container fmcalc-ic-c14">
                        <div class="fmcalc-wrapper">
                        <form name="lpc_5" method="post" action="#">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<br><h4 align="center">Amortization Schedule Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Purchase Price:
</td>
<td align="center">
<input type="text" name="price" size="15" onkeyup="calc_prin(this.form)">
</td>
</tr>
<tr>
<td>
Down Payment (if 0 leave blank):
<input type="radio" name="down_type" value="dollar" onclick="calc_down_1(this.form)" checked="">$
<input type="radio" name="down_type" value="percent" onclick="calc_down_2(this.form)">%
<input type="hidden" name="Hdown_type" value="1">
</td>
<td align="center">
<input type="text" name="down" size="15" onkeyup="calc_prin(this.form)">
</td>
</tr>
<tr>
<td>
Amount to Finance:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Interest Rate Percentage (APR):
</td>
<td align="center">
<input type="text" name="rate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Loan Term:
</td>
<td align="center">
<select name="term" size="1" onchange="clear_results(this.form)">
<option value="1">1 year</option>
<option value="2">2 year</option>
<option value="3">3 year</option>
<option value="4">4 year</option>
<option value="5">5 year</option>
<option value="7">7 year</option>
<option value="10">10 year</option>
<option value="15">15 year</option>
<option value="20">20 year</option>
<option value="25">25 year</option>
<option value="30">30 year</option>
</select>
</td>
</tr>
<tr>
<td>
Payment Type:
</td>
<td align="center">
<select name="interval" size="1" onchange="clear_results(this.form)">
<option value="12" selected="">Monthly</option>
<option value="4">Quarterly</option>
<option value="2">Semi-Annually</option>
<option value="1">Annually</option>
</select>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset" onclick="clearStuff()">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Amount Owed:
</td>
<td align="center">
<input type="text" name="r_principal" size="15">
</td>
</tr>
<tr>
<td>
Interest Rate:
</td>
<td align="center">
<input type="text" name="r_rate" size="15">
</td>
</tr>
<tr>
<td>
Term:
</td>
<td align="center">
<input type="text" name="r_term" size="15">
</td>
</tr>
<tr>
<td>
Payment Type:
</td>
<td align="center">
<input type="text" name="r_type" size="15">
</td>
</tr>
<tr>
<td>
Payment:
</td>
<td align="center">
<input type="text" name="r_payment" size="15">
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
