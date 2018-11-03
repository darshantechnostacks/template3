
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Expense Calculator - Figure Monthly Living Expenses</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>

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

function compute(form)  {

   var VtotalPerc = 0;
   var VtotalAmt = 0;
   var VprintRows = "";
   var VdisburseRows = "";

   var Vincome = sn(document.calc.income.value);

   if(Vincome == 0) {
      alert("Please enter an income amount before entering expense amounts.");
      document.calc.income.focus();
   } else {

      var VdisburseTotal = sn(document.calc.disburseTotal.value);
      if(VdisburseTotal.length == 0) {
         VdisburseTotal = 0;
      }

      if(Vincome == "") {
         Vincome = 0;
      } else {
         Vincome = Vincome;
      }

      for(var i = 1; i < 16; i++) {

         var amt_cell = document.getElementById("amt" + i + "");
         var perc_cell = document.getElementById("perc" + i + "");
         var exp_cell = document.getElementById("exp" + i + "");

         if(amt_cell.value.length > 0) {
            var Vamt = sn(amt_cell.value);
            var Vperc = Vamt / Vincome * 100;
            perc_cell.value = fn(Vperc,2,0) + "%";
            VtotalAmt = Number(VtotalAmt) + Number(Vamt);
            VtotalPerc = Number(VtotalPerc) + Number(Vperc);
            VprintRows += "<tr><td><font face='arial'><small><strong>" + exp_cell.value + "</strong>";
            VprintRows += "</small></font></td><td align='right'>";
            VprintRows += "<font face='arial'><small>$" + fn(Vamt,2,1) + "<small></font></td>";
            VprintRows += "<td align='right'><font face='arial'><small>" + perc_cell.value + "<small></font>";
            VprintRows += "</td></tr>";
            var VdisburseAmt = VdisburseTotal * Vperc / 100;
            VdisburseRows += "<tr><td><font face='arial'><small><strong>" + exp_cell.value + "</strong></small></font></td>";
            VdisburseRows += "<td align='right'>";
            VdisburseRows += "<font face='arial'><small>$" + fn(VdisburseAmt,2,1) + "<small></font></td>";
            VdisburseRows += "<td align='right'><font face='arial'><small>" + perc_cell.value + "<small></font>";
            VdisburseRows += "</td></tr>";
         }

      }


      if(VtotalAmt > Vincome) {
         alert("The total of the expenses you have entered exceeds the income amount you entered.");
      }
      document.calc.totalAmt.value = fn(VtotalAmt,2,1);
      document.calc.totalPerc.value = fn(VtotalAmt / Vincome * 100,2,0) + "%";

      document.calc.printRows.value = VprintRows;
      document.calc.disburseRows.value = VdisburseRows;

      jQuery('.email-my-results').removeClass('hidden');
   }

}


function displayResults(form) {

   compute(document.calc);

   var part1 = "<head><title>Expense Percentage Report</title></head>";
   part1 += "<body bgcolor='#FFFFFF'><br /><br /><center>";
   part1 += "<font face='arial'><big><strong>Expense Percentage Report</strong></big></center></center>";


   var part2 = "<center><table border='1' cellpadding='4' cellspacing='0'><tr>";
   part2 += "<td bgcolor='silver'><font face='arial'><small><strong>Expense Category</strong></small></font></td>";
   part2 += "<td bgcolor='silver'><font face='arial'><small><strong>Periodic Amount</strong></small></font></td>";
   part2 += "<td bgcolor='silver'><font face='arial'><small><strong>Percentage</strong></small></font></td></tr>";

   var part3 = ("" + document.calc.printRows.value + "");

   var part4 = "<tr><td><font face='arial'><small><strong>Totals</strong></small></font></td>";
   part4 += "<td align='right'><font face='arial'>";
   part4 += "<small><strong>$" + document.calc.totalAmt.value + "</strong></small></font></td>";
   part4 += "<td align='right'><font face='arial'>";
   part4 += "<small><strong>" + document.calc.totalPerc.value + "</strong></small></font></td>";
   part4 += "</tr></table><br /><form method='post'>";
   part4 += "<input type='button' value='Close Window' onClick='window.close()'>";
   part4 += "</form></center></body></html>";

   var schedule = (part1 + "" + part2 + "" + part3 + part4 + "");

   reportWin = window.open("","","width=500,height=300,toolbar=yes,menubar=yes,scrollbars=yes");
   reportWin.document.write(schedule);
   reportWin.document.close();

}

function displayDisburse(form) {

   compute(document.calc);

   var part1 = "<head><title>Expense Percentage Disbursement Report</title>";
   part1 += "</head>" + "<body bgcolor='#FFFFFF'><br /><br /><center><font face='arial'>";
   part1 += "<big><strong>Expense Percentage Disbursement Report</strong></big></font></center>";
   part1 += "";

   var part2 = "<center><table border='1' cellpadding='4' cellspacing='0'>";
   part2 += "<tr bgcolor='silver'><td bgcolor='silver'><font face='arial'>";
   part2 += "<small><strong>Expense Category</strong></small></font></td>";
   part2 += "<td bgcolor='silver'><font face='arial'><small>";
   part2 += "<strong>Disburse Amount</strong></small></font></td>";
   part2 += "<td bgcolor='silver'><font face='arial'><small>";
   part2 += "<strong>Percentage</strong></small></font></td></tr>";


   var part3 = ("" + document.calc.disburseRows.value + "");

   var part4 = "<tr><td><font face='arial'><small><strong>Totals</strong></small></font></td>";
   part4 += "<td align='right'><font face='arial'><small>";
   part4 += "<strong>$" + fn(sn(document.calc.disburseTotal.value),2,1) + "</strong></small></font></td>";
   part4 += "<td align='right'><font face='arial'><small>";
   part4 += "<strong>" + document.calc.totalPerc.value + "</strong></small></font></td>";
   part4 += "</tr></table><br><form method='post'>";
   part4 += "<input type='button' value='Close Window' onClick='window.close()'></form>";
   part4 += "</center></body></html>";

   var schedule = (part1 + "" + part2 + "" + part3 + part4 + "");

  reportWin = window.open("","","width=500,height=300,toolbar=yes,menubar=yes,scrollbars=yes");
  reportWin.document.write(schedule);
  reportWin.document.close();

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
<br><h4 align="center">Expense Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Enter your income for whatever time-period you will be entering expense amounts for:
</td>
<td align="center">
<input type="text" name="income" size="12">
</td>
</tr>
<tr>
<td>
Expense Category Name

</td>
<td align="center">
<b>
Periodic Amount
</b>
</td>
<td align="center">
<b>
Percentage
</b>
</td></tr>
<tr>
<td>
<input type="text" id="exp1" name="exp1" size="20">
</td>
<td align="center">
$
<input type="text" id="amt1" name="amt1" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc1" name="perc1" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp2" name="exp2" size="20">
</td>
<td align="center">
$
<input type="text" id="amt2" name="amt2" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc2" name="perc2" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp3" name="exp3" size="20">
</td>
<td align="center">
$
<input type="text" id="amt3" name="amt3" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc3" name="perc3" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp4" name="exp4" size="20">
</td>
<td align="center">
$
<input type="text" id="amt4" name="amt4" size="10" onchange="compute(this.form)">
</td>
<td [cell_oupput_color_even]="" align="center">
<input type="text" id="perc4" name="perc4" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp5" name="exp5" size="20">
</td>
<td align="center">
$
<input type="text" id="amt5" name="amt5" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc5" name="perc5" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp6" name="exp6" size="20">
</td>
<td align="center">
$
<input type="text" id="amt6" name="amt6" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc6" name="perc6" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp7" name="exp7" size="20">
</td>
<td align="center">
$
<input type="text" id="amt7" name="amt7" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc7" name="perc7" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp8" name="exp8" size="20">
</td>
<td align="center">
$
<input type="text" id="amt8" name="amt8" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc8" name="perc8" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp9" name="exp9" size="20">
</td>
<td align="center">
$
<input type="text" id="amt9" name="amt9" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc9" name="perc9" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp10" name="exp10" size="20">
</td>
<td align="center">
$
<input type="text" id="amt10" name="amt10" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc10" name="perc10" size="10">
</td> 
</tr>
<tr>
<td>
<input type="text" id="exp11" name="exp11" size="20">
</td>
<td align="center">
$
<input type="text" id="amt11" name="amt11" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc11" name="perc11" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp12" name="exp12" size="20">
</td>
<td align="center">
$
<input type="text" id="amt12" name="amt12" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc12" name="perc12" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp13" name="exp13" size="20">
</td>
<td align="center">
$
<input type="text" id="amt13" name="amt13" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc13" name="perc13" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp14" name="exp14" size="20">
</td>
<td align="center">
$
<input type="text" id="amt14" name="amt14" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc14" name="perc14" size="10">
</td>
</tr>
<tr>
<td>
<input type="text" id="exp15" name="exp15" size="20">
</td>
<td align="center">
$
<input type="text" id="amt15" name="amt15" size="10" onchange="compute(this.form)">
</td>
<td align="center">
<input type="text" id="perc15" name="perc15" size="10">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Convert Expense $ to %" onclick="compute(this.form)">
<input type="reset" value="Clear Form">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
<strong>Totals:</strong>
</td>
<td align="center">
<input type="text" name="totalAmt" size="12">
</td>
<td align="center">
<input type="text" name="totalPerc" size="10">
<input type="hidden" name="printRows">
</td>
</tr>
<tr>
<td colspan="3">
If you are using the "Envelope System" to manage your money,
enter an amount of cash below to disperse to your envelopes
and the calculator will determine how much cash to place in
each of the above expense envelopes.
</td>
</tr>
<tr>
<td align="center" colspan="3">
<strong>Disbursement Amount:</strong>
<input type="text" name="disburseTotal" size="10">
<input type="hidden" name="disburseRows">
<input type="button" value="Disburse" onclick="displayDisburse(this.form)">
<input type="reset" value="Clear Form">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
