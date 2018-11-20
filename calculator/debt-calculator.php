
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Debt Calculator - Get Out of Debt Tips & Tricks</title>

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

   if(document.calc.payment.value == 0 || document.calc.payment.value == "") {
      alert("Please enter this debt's current monthly payment amount.");
      document.calc.payment.focus();
   } else
   if(document.calc.interest.value == 0 || document.calc.interest.value == "") {
      alert("Please enter this debt's annual interest rate.");
      document.calc.interest.focus();
   } else
   if(document.calc.principal.value == 0 || document.calc.principal.value == "") {
      alert("Please enter this debt's current principal balance.");
      document.calc.principal.focus();
   } else {

   	jQuery('.email-my-results').removeClass('hidden');

      var i = sn(document.calc.interest.value);
      if (i >= 1.0) {
         i = i / 100.0;
      }
      i /= 12;

      var Vpayment = sn(document.calc.payment.value);
      var Vprincipal = sn(document.calc.principal.value);

      var avgInt = 0;
      var numMonths = 0;

      if(form.fixFall.selectedIndex == 0) {

         numMonths = fixCalcMonths(Vprincipal, i, Vpayment, 0);

         avgInt = fixCalcMonths(Vprincipal, i, Vpayment, 1);
         avgInt = avgInt / numMonths;

         document.calc.monthlyInterest.value = "$" + fn(avgInt,2,1);
         document.calc.months.value = numMonths;

      } else {

         numMonths = ccCalcMonths(Vprincipal, i, Vpayment, 0);

         avgInt = ccCalcMonths(Vprincipal, i, Vpayment, 1);
         avgInt = avgInt / numMonths;

         document.calc.monthlyInterest.value = "$" + fn(avgInt,2,1);
         document.calc.months.value = numMonths; 

      }

      var numYears = numMonths / 12;
      document.calc.years.value = fn(numYears,1,0);

   }
}

function fixCalcMonths(fixPrin, fixInt, fixPmt, retType) {

   var prin = fixPrin;
   var pmt = fixPmt;
   var prinPort = 0;
   var intPort = 0;
   var count = 0;
   var accruedInt = 0;
   var i = fixInt;

   while(prin > 0) {
      intPort = Number(i * prin);
      prinPort = Number(pmt - intPort);
      prin = Number(prin - prinPort);
      accruedInt = Number(accruedInt + intPort);
      count = Number(count) + Number(1);
      if(count > 600) {
         accruedInt = "0";
         alert("Number of payments exceeds 600.  Please increase the minimum payment percent and recalculate.");
         break;
      } else {
         continue;
      }
   }

   if(retType == 0) {
      return count;
   } else {
      return accruedInt;
   }

}

function ccCalcMonths(ccPrin, ccInt, ccPmt, retType) {

   var prin = ccPrin;
   var pmt = 0;
   var prinPort = 0;
   var intPort = 0;
   var count = 0;
   var accruedInt = 0;
   var i = ccInt;

   var Vminpaydol = 15;
   var Vminpayperc = ccPmt / ccPrin;

   while(prin > 0) {
      if(Number(prin * Vminpayperc) < Vminpaydol) {
         pmt = Vminpaydol;
      } else {
         pmt = Number(Vminpayperc * prin);
      }
      intPort = Number(i * prin);
      prinPort = Number(pmt - intPort);
      prin = Number(prin - prinPort);
      accruedInt = Number(accruedInt + intPort);
      count = Number(count) + Number(1);
      if(count > 600) {
         accruedInt = "0";
         alert("Number of payments exceeds 600.  Please increase the minimum payment percent and recalculate.");
         break;
      } else {
         continue;
      }
   }

   if(retType == 0) {
      return count;
   } else {
      return accruedInt;
   }

}

function clear_results(form) {

   document.calc.monthlyInterest.value = "";
   document.calc.months.value = "";
   document.calc.years.value = "";

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
<br><h4 align="center">Debt Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Your Current Monthly Payment?
</td>
<td align="center">
<input type="text" name="payment" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (APR)?
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Amount Owed?
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Are you making "Fixed" or "Declining Minimum" payments?
</td>
<td align="center">
<select name="fixFall" size="1" onchange="clear_results(this.form)">
<option value="0">Fixed</option>
<option value="1">Declining Minimum</option>
</select>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Debt" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Average monthly interest paid over life of loan:
</td>
<td align="center">
<input type="text" name="monthlyInterest" size="15">
</td>
</tr>
<tr>
<td>
Number of months until debt payoff:
</td>
<td align="center">
<input type="text" name="months" size="15">
</td>
</tr>
<tr>
<td>
Number of years to get out of debt:
</td>
<td align="center">
<input type="text" name="years" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
