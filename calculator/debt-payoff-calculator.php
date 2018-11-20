
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Debt Payoff Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Debt Payoff Calculator
//ALL RIGHTS RESERVED
//Created: 01/26/2003
//Last Modified: 04/13/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1295-95-1256
//Commercial Licence Date:2009-04-01
//*******************************************



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

if(document.calc.principal.value == "" || document.calc.principal.value == 0) {
   alert("Please enter the debt's principal balance.");
   document.calc.principal.focus();
   } else
      if(document.calc.interest.value == "" || document.calc.interest.value == 0) {
      alert("Please enter the debt's annual interest rate.");
      document.calc.interest.focus();
   } else {

      var Vprincipal = sn(document.calc.principal.value);
      var Vinterest = sn(document.calc.interest.value);

      var today = new Date();
      var nowMonth = today.getMonth() + 1;
      var nowYear = today.getYear();
      if(nowYear < 1900) {
         nowYear += 1900;
      }

      var nowMonths = Number(nowYear * 12) + Number(nowMonth);

      var VgoalMonth = document.calc.goalMonth.options[document.calc.goalMonth.selectedIndex].value;

      var VgoalYear = document.calc.goalYear.options[document.calc.goalYear.selectedIndex].value;

      var VgoalMonths = Number(VgoalYear * 12) + Number(VgoalMonth);

      if(VgoalMonths <= nowMonths) {
         alert("The payoff goal month and year selected is a current or past date. Please select a future payoff goal date and try again.");
      } else {

         var VnumMonths = Number(VgoalMonths) - Number(nowMonths);

         var Vpayment = computeMonthlyPayment(Vprincipal, VnumMonths, Vinterest);

         document.calc.payment.value = "$" + fn(Vpayment,2,1);

         document.calc.numMonths.value = VnumMonths;

         var VintCost = Number(Vpayment * VnumMonths) - Number(Vprincipal);
         document.calc.intCost.value = "$" + fn(VintCost,2,1);

      }
      jQuery('.email-my-results').removeClass('hidden');

   }

}

function clear_results(form) {

   document.calc.payment.value = "";
   document.calc.numMonths.value = "";
   document.calc.intCost.value = "";
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
<br><h4 align="center">Debt Payoff Calculator</h4>
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
Annual Interest Rate (APR):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
When to Payoff Debt By?:
</td>
<td align="center">
<select name="goalMonth" size="1" onchange="clear_results(this.form)">
<option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">May</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Aug</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>
<select name="goalYear" size="1" onchange="clear_results(this.form)">
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
<option value="2027">2027</option>
<option value="2028">2028</option>
<option value="2029">2029</option>
<option value="2030">2030</option>
<option value="2031">2031</option>
<option value="2032">2032</option>
<option value="2033">2033</option>
<option value="2034">2034</option>
<option value="2035">2035</option>
<option value="2036">2036</option>
<option value="2037">2037</option>
<option value="2038">2038</option>
<option value="2039">2039</option>
<option value="2040">2040</option>
<option value="2041">2041</option>
<option value="2042">2042</option>
<option value="2043">2043</option>
<option value="2044">2044</option>
<option value="2045">2045</option>
<option value="2046">2046</option>
<option value="2047">2047</option>
<option value="2048">2048</option>
<option value="2049">2049</option>
<option value="2050">2050</option>
<option value="2051">2051</option>
<option value="2052">2052</option>
<option value="2053">2053</option>
<option value="2054">2054</option>
<option value="2055">2055</option>
<option value="2056">2056</option>
<option value="2057">2057</option>
<option value="2058">2058</option>
<option value="2059">2059</option>
<option value="2060">2060</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Debt Payoff" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Monthly Payment Needed To Achieve Payoff Goal:
</td>
<td align="center">
<input type="text" name="payment" size="15">
</td>
</tr>
<tr>
<td>
Number Of Payments Until Debt is Paid Off:
</td>
<td align="center">
<input type="text" name="numMonths" size="15">
</td>
</tr>
<tr>
<td>
Total Interest Paid Between Now and Payoff:
</td>
<td align="center">
<input type="text" name="intCost" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
