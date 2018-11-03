
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Credit Card Minimum Payment Calculator</title>

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

function computeForm(form) {

if(document.calc.principal.value == 0 || document.calc.principal.value == "") {
   alert("Please enter the balance on your credit card.");
   document.calc.principal.focus();
} else
if(document.calc.interest.value == 0 || document.calc.interest.value == "") {
   alert("Please enter the credit card's annual interest rate.");
   document.calc.interest.focus();
} else
if(document.calc.minpaydol.value == 0 || document.calc.minpaydol.value == "") {
   alert("Please enter the minimum dollar payment amount.");
   document.calc.minpaydol.focus();
} else
if(document.calc.minpayperc.value == 0 || document.calc.minpayperc.value == "") {
   alert("Please enter the percentage your credit card company uses to compute your minimum payment amount.");
   document.calc.minpayperc.focus();
} else {


   var i = sn(document.calc.interest.value);
   if (i >= 1.0) {
      i = i / 100.0;
   }
   i /= 12;

   var j = sn(document.calc.minpayperc.value);
   if (j >= 1.0) {
      j = j / 100.0;
   }

   var prin = sn(document.calc.principal.value);
   var displayPrin = "$" + fn(prin,2,1);

   var pmt = 0;
   var prinPort = 0;
   var intPort = 0;
   var count = 0;
   var accruedInt = 0;

   var Vminpaydol = sn(document.calc.minpaydol.value);
    
   while(prin > 0) {
      if(Number(prin * j) < Vminpaydol) {
         pmt = Vminpaydol;
      } else {
         pmt = Number(j * prin);
      }
      intPort = Number(i * prin);
      prinPort = Number(pmt - intPort);
      prin = Number(prin - prinPort);
      accruedInt = Number(accruedInt + intPort);
      count = count + 1
      if(count > 600) {
         break;
      } else {
         continue;
      }
   }

   var displayInt = "$" + fn(accruedInt,2,1);
   document.calc.ccInt.value = displayInt;

   var displayPmts = parseInt(count,10);
   document.calc.nPer.value = displayPmts;

   var displayYears = fn(count / 12,2,0);
   document.calc.years.value = displayYears;

   var moInvest = accruedInt / count;
   var countInv = 0;
   var investPrin = moInvest;
   var accumEarnings = 0;
   var investIntPort = 0;
   var investPrinPort = 0;
   var investInt = .07 / 12;

   while(countInv < count) {
      investintPort = Number(investInt * investPrin);
      investPrin = Number(investPrin) + Number(investintPort) + Number(moInvest);
      countInv = countInv + 1
      if(countInv > 600) { break; } else { continue;}
   }

   var displayLostInt = "$" + fn(investPrin,2,1);
   document.calc.lostInt.value = displayLostInt;

   var totLost = Number(accruedInt) + Number(investPrin);
   var displayTotLost = "$" + fn(totLost,2,1);
   document.calc.totalCost.value = displayTotLost;

   var sum_cell = document.getElementById("summary");
   var v_summary = "<strong>Summary:</strong> If you make only the minimum monthly payment suggested by your credit card statement, ";
   v_summary += "by the time you pay off your " + displayPrin + " balance ";
   v_summary += "you will have made " + displayPmts + " payments ";
   v_summary += "(that's " + displayYears + " years!) and you will have ";
   v_summary += "paid " + displayInt + " in interest charges!<br /><br />Plus, if you were ";
   v_summary += "investing the average monthly interest charge -- instead of sending it ";
   v_summary += "to the credit card company -- at only a 7% return, you could have ";
   v_summary += "earned roughly " + displayLostInt + " during the ";
   v_summary += "same " + displayYears + "-year period. That represents a total ";
   v_summary += "cost of " + displayTotLost + "!!";

   sum_cell.innerHTML = "<font face='arial'><small>" + v_summary + "</small></font>";

   jQuery('.email-my-results').removeClass('hidden');
   }
}

function clear_results(form) {

   document.calc.ccInt.value = "";
   document.calc.nPer.value = "";
   document.calc.years.value = "";
   document.calc.lostInt.value = "";
   document.calc.totalCost.value = "";

   var sum_cell = document.getElementById("summary");
   sum_cell.innerHTML = " ";

}

function reset_calc(form) {

   document.calc.principal.value = "";
   document.calc.interest.value = "";
   document.calc.minpayperc.value = "3";
   document.calc.minpaydol.value = "10";

   document.calc.ccInt.value = "";
   document.calc.nPer.value = "";
   document.calc.years.value = "";
   document.calc.lostInt.value = "";
   document.calc.totalCost.value = "";

   var sum_cell = document.getElementById("summary");
   sum_cell.innerHTML = " ";

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
<br><h4 align="center">Credit Card Minimum Payment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Balance Owed:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate:
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Minimum Percent Payment:
</td>
<td align="center">
<input type="text" name="minpayperc" size="15" value="3" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Minimum Dollar Payment:
</td>
<td align="center">
<input type="text" name="minpaydol" size="15" value="10" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Minimum Payment Cost" onclick="computeForm(this.form)">
<input type="reset" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Total Interest Paid:
</td>
<td align="center">
<input type="text" name="ccInt" size="15">
</td>
</tr>
<tr>
<td>
Total # of Payments Made:
</td>
<td align="center">
<input type="text" name="nPer" size="15">
</td>
</tr>
<tr>
<td>
Years Until Debt Is Paid Off:
</td>
<td align="center">
<input type="text" name="years" size="15">
</td>
</tr>
<tr>
<td>
Foregone Interest Earnings:
</td>
<td align="center">
<input type="text" name="lostInt" size="15">
</td>
</tr>
<tr>
<td>
Total Estimated Opportunity Cost:
</td>
<td align="center">
<input type="text" name="totalCost" size="15">
</td>
</tr>
<tr>
<td valign="top" colspan="2" id="summary">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
