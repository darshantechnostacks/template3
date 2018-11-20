
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Budget Calculator - Converts Irregular Payments to Monthly</title>

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


function calc_line(ln) {

   var v_pmt_fld = document.getElementById("pmt" + ln);
   var v_ppYr_fld = document.getElementById("ppYr" + ln);
   var v_moAmt_fld = document.getElementById("moAmt" + ln);

   var v_pmt = sn(v_pmt_fld.value);
   var v_ppYr = sn(v_ppYr_fld.value);
   if(v_pmt > 0 && v_ppYr > 0) {
      var v_moAmt = ((v_ppYr * v_pmt) / 12);
      v_moAmt_fld.value = fns(v_moAmt,2,1,1,1);
   } else {
      v_moAmt_fld.value = "";
   }

   compute(document.calc);

}


function compute(form)  {

   var v_accum_pmt = 0;

   for(var i = 1; i<11; i++) {
      var v_pmt_fld = document.getElementById("pmt" + i);
      var v_ppYr_fld = document.getElementById("ppYr" + i);
      var v_moAmt_fld = document.getElementById("moAmt" + i);

      var v_pmt = sn(v_pmt_fld.value);
      var v_ppYr = sn(v_ppYr_fld.value);
      if(v_pmt > 0 && v_ppYr > 0) {
         var v_moAmt = ((v_ppYr * v_pmt) / 12);
         v_moAmt_fld.value = fns(v_moAmt,2,1,1,1);
         v_accum_pmt += v_moAmt;
      } else {
         v_moAmt_fld.value = "";
      }

   }

   jQuery('.email-my-results').removeClass('hidden');
   document.calc.total.value = fns(v_accum_pmt,2,1,1,1);

}


function createReport(form) {

   var v_accum_pmt = 0;
   var tableRows = "";

   for(var i = 1; i<11; i++) {
      var v_name_fld = document.getElementById("D" + i);
      var v_pmt_fld = document.getElementById("pmt" + i);
      var v_ppYr_fld = document.getElementById("ppYr" + i);
      var v_moAmt_fld = document.getElementById("moAmt" + i);

      var v_pmt = sn(v_pmt_fld.value);
      var v_ppYr = sn(v_ppYr_fld.value);
      if(v_pmt > 0 && v_ppYr > 0) {
         var v_moAmt = ((v_ppYr * v_pmt) / 12);
         v_moAmt_fld.value = fns(v_moAmt,2,1,1,1);
         v_accum_pmt += v_moAmt;
         tableRows += "<tr><td><font face='arial'><small>" + v_name_fld.value + "</small></font></td>";
         tableRows += "<td align='right'><font face='arial'><small>" + fns(v_ppYr,0,0,0,0) + "</small></font></td>";
         tableRows += "<td align='right'><font face='arial'><small>" + fns(v_pmt,2,1,1,1) + "</small></font></td>";
         tableRows += "<td align='right'><font face='arial'><small>" + fns(v_moAmt,2,1,1,1) + "</small></font></td></tr>";
      } else {
         v_moAmt_fld.value = "";
      }

   }

   document.calc.total.value = fns(v_accum_pmt,2,1,1,1);

   var VtotalMonthly = v_accum_pmt;

   var part1 = "<head><title>Irregular Payment Budget Report</title></head>";
   part1 += "<body bgcolor= '#FFFFFF'><br /><br /><center>";
   part1 += "<font face='arial'><big><strong>";
   part1 += "Irregular Payment Budget Report";
   part1 += "</strong></big></font></center><p>";

   var part2 = "<center><table border=1 cellpadding=2 cellspacing=0>";
   part2 += "<tr bgcolor='silver'><td align='center'>";
   part2 += "<font face='arial'><small><strong>Payment Description</strong></small></font></td>";
   part2 += "<td align='center'>";
   part2 += "<font face='arial'><small><strong># of Payments<br />per Year</strong></small></font></td>";
   part2 += "<td align='center'>";
   part2 += "<font face='arial'><small><strong>Payment<br />Amount</strong></small></font></td>";
   part2 += "<td align='center'>";
   part2 += "<font face='arial'><small><strong>Monthly<br />Amount</strong></small></font></td></tr>";

   var part4 = "<tr><td align='right' colspan=3>";
   part4 += "<font face='arial'><small><strong>Amount to set aside each month:</strong></small></font></td>";
   part4 += "<td align='right'>";
   part4 += "<font face='arial'><small><strong>" + fns(VtotalMonthly,2,1,1,1) + "</strong></small></font></td></tr>";
   part4 += "</table><br /><center><form method='post'>";
   part4 += "<input type='button' value='Close Window' onClick='window.close()'>";
   part4 += "</form></center></body></html>";

   var schedule = (part1 + "" + part2 + "" + tableRows + "" + part4 + "");

   reportWin = window.open("","","width=500,height=400,toolbar=yes,menubar=yes,scrollbars=yes");

   reportWin.document.write(schedule);

   reportWin.document.close();

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
<td colspan="4">
<br><h4 align="center">Irregular Payments Budget Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="4" align="center">
Make Sure These Bills Are Included!
<select tabindex="1">
<option>Car Insurance</option>
<option>Homeowners Insurance</option>
<option>Annual Health Insurance</option>
<option>Local Property Tax</option>
<option>Annual Licenses</option>
<option>Quarterly Tuition</option>
<option>Annual Subscriptions</option>
<option>Professional Dues</option>
<option>Holiday Expenses</option>
<option>Vacation Costs</option>
<option>Seasonal Heating Oil/Propane</option>
<option>Annual Retirement Contributions</option>
</select>
</td>
</tr>
<tr>
<td align="center"> <b> Payment<br>Description </b> </td>
<td align="center"> <b> # of Pmts<br>Per Year </b> </td>
<td align="center"> <b> Amt of<br>Each Pmt </b> </td>
<td align="center"> <b> Monthly<br>Amount </b> </td>
</tr>
<tr>
<td><input type="text" tabindex="2" id="D1" name="D1" size="25"></td>
<td align="center"><input type="text" tabindex="3" id="ppYr1" name="ppYr1" size="4" onkeyup="calc_line(1)"></td>
<td align="center"><input type="text" tabindex="4" id="pmt1" name="pmt1" size="9" onkeyup="calc_line(1)"></td>
<td align="center"><input type="text" id="moAmt1" name="moAmt1" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="5" id="D2" name="D2" size="25"></td>
<td align="center"><input type="text" tabindex="6" id="ppYr2" name="ppYr2" size="4" onkeyup="calc_line(2)"></td>
<td align="center"><input type="text" tabindex="7" id="pmt2" name="pmt2" size="9" onkeyup="calc_line(2)"></td>
<td align="center"><input type="text" id="moAmt2" name="moAmt2" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="8" id="D3" name="D3" size="25"></td>
<td align="center"><input type="text" tabindex="9" id="ppYr3" name="ppYr3" size="4" onkeyup="calc_line(3)"></td>
<td align="center"><input type="text" tabindex="10" id="pmt3" name="pmt3" size="9" onkeyup="calc_line(3)"></td>
<td align="center"><input type="text" id="moAmt3" name="moAmt3" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="11" id="D4" name="D4" size="25"></td>
<td align="center"><input type="text" tabindex="12" id="ppYr4" name="ppYr4" size="4" onkeyup="calc_line(4)"></td>
<td align="center"><input type="text" tabindex="13" id="pmt4" name="pmt4" size="9" onkeyup="calc_line(4)"></td>
<td align="center"><input type="text" id="moAmt4" name="moAmt4" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="14" id="D5" name="D5" size="25"></td>
<td align="center"><input type="text" tabindex="15" id="ppYr5" name="ppYr5" size="4" onkeyup="calc_line(5)"></td>
<td align="center"><input type="text" tabindex="16" id="pmt5" name="pmt5" size="9" onkeyup="calc_line(5)"></td>
<td align="center"><input type="text" id="moAmt5" name="moAmt5" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="17" id="D6" name="D6" size="25"></td>
<td align="center"><input type="text" tabindex="18" id="ppYr6" name="ppYr6" size="4" onkeyup="calc_line(6)"></td>
<td align="center"><input type="text" tabindex="19" id="pmt6" name="pmt6" size="9" onkeyup="calc_line(6)"></td>
<td align="center"><input type="text" id="moAmt6" name="moAmt6" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="20" id="D7" name="D7" size="25"></td>
<td align="center"><input type="text" tabindex="21" id="ppYr7" name="ppYr7" size="4" onkeyup="calc_line(7)"></td>
<td align="center"><input type="text" tabindex="22" id="pmt7" name="pmt7" size="9" onkeyup="calc_line(7)"></td>
<td align="center"><input type="text" id="moAmt7" name="moAmt7" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="23" id="D8" name="D8" size="25"></td>
<td align="center"><input type="text" tabindex="24" id="ppYr8" name="ppYr8" size="4" onkeyup="calc_line(8)"></td>
<td align="center"><input type="text" tabindex="25" id="pmt8" name="pmt8" size="9" onkeyup="calc_line(8)"></td>
<td align="center"><input type="text" id="moAmt8" name="moAmt8" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="26" id="D9" name="D9" size="25"></td>
<td align="center"><input type="text" tabindex="27" id="ppYr9" name="ppYr9" size="4" onkeyup="calc_line(9)"></td>
<td align="center"><input type="text" tabindex="28" id="pmt9" name="pmt9" size="9" onkeyup="calc_line(9)"></td>
<td align="center"><input type="text" id="moAmt9" name="moAmt9" size="9"></td>
</tr>
<tr>
<td><input type="text" tabindex="29" id="D10" name="D10" size="25"></td>
<td align="center"><input type="text" tabindex="30" id="ppYr10" name="ppYr10" size="4" onkeyup="calc_line(10)"></td>
<td align="center"><input type="text" tabindex="31" id="pmt10" name="pmt10" size="9" onkeyup="calc_line(10)"></td>
<td align="center"><input type="text" id="moAmt10" name="moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Budget" tabindex="32" onclick="compute(this.form)">
<input type="reset" value="Clear Form">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="3">
Monthly total to budget for irregular payments:
</td>
<td align="center"><input type="text" name="total" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Create Report" tabindex="33" onclick="createReport(this.form)">
<input type="hidden" name="HtableRows" value="">
<input type="hidden" name="Htotal" value="">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
