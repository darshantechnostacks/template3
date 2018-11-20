
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Personal Loan Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
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




function computeFixedInterestCost(principal, intRate, pmtAmt) { 

   var i = eval(intRate);
   i /= 100;
   i /= 12;

   var prin = eval(principal);
   var intPort = 0;
   var accumInt = 0;
   var prinPort = 0;
   var pmtCount = 0;
   var testForLast = 0;


   //CYCLES THROUGH EACH PAYMENT OF GIVEN DEBT
   while(prin > 0) {

      testForLast = (prin * (1 + i));

      if(pmtAmt < testForLast) {
         intPort = prin * i;
         accumInt = eval(accumInt) + eval(intPort);
         prinPort = eval(pmtAmt) - eval(intPort);
         prin = eval(prin) - eval(prinPort);
      } else {
      //DETERMINE FINAL PAYMENT AMOUNT
      intPort = prin * i;
      accumInt = eval(accumInt) + eval(intPort);
      prinPort = prin;
      prin = 0;
      }

      pmtCount = eval(pmtCount) + eval(1);

      if(pmtCount > 1000 || accumInt > 1000000000) {
         prin = 0;
      }

   }

return accumInt;

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

if (document.calc.price.value == 0 || document.calc.price.value.length == 0) {
   alert("Please enter the purchase price.");
   document.calc.price.focus();
} else
if (document.calc.rate.value == 0 || document.calc.rate.value.length == 0) {
   alert("Please enter the loan's annual interest rate.");
   document.calc.rate.focus();
} else
if (document.calc.months.value == 0 || document.calc.months.value.length == 0) {
   alert("Please enter the loan's term in number of months.");
   document.calc.months.focus();
} else {

   var Vprice = sn(document.calc.price.value);
   var Vdown = sn(document.calc.down.value);
   var Vrate = sn(document.calc.rate.value);
   var Vmonths = sn(document.calc.months.value);

   var Vprincipal = Number(Vprice) - Number(Vdown);
   document.calc.principal.value = "$" + fn(Vprincipal,2,1);

   var Vpayment = computeMonthlyPayment(Vprincipal, Vmonths, Vrate);
   document.calc.payment.value = "$" + fn(Vpayment,2,1);

   var Vtotal_interest = computeFixedInterestCost(Vprincipal, Vrate, Vpayment);
   document.calc.total_interest.value = "$" + fn(Vtotal_interest,2,1);

   jQuery('.email-my-results').removeClass('hidden');

   }
}

function clear_results(form) {

   document.calc.principal.value = "";
   document.calc.payment.value = "";
   document.calc.total_interest.value = "";

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
<br><h4 align="center">Personal Loan Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Loan Amount or Purchase Price:
</td>
<td align="center">
<input type="text" name="price" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Down Payment (enter 0 if none):
</td>
<td align="center">
<input type="text" name="down" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest rate (APR %):
</td>
<td align="center">
<input type="text" name="rate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Number of monthly payments:
</td>
<td align="center">
<input type="text" name="months" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Personal Loan" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Amount Financed:
</td>
<td align="center">
<input type="text" name="principal" size="15">
</td>
</tr>
<tr>
<td>
Monthly Payment:
</td>
<td align="center">
<input type="text" name="payment" size="15">
</td>
</tr>
<tr>
<td>
Total Interest Cost:
</td>
<td align="center">
<input type="text" name="total_interest" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
