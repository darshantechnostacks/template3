
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Payment Calculator</title>

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

   var Vprice = sn(document.calc.price.value);
   var VdownPmt = sn(document.calc.downPmt.value);
   var Vtrade = sn(document.calc.trade.value);
   var Vpayments = sn(document.calc.payments.value);
   var Vinterest = sn(document.calc.interest.value);

   if (Vprice == 0) {
      alert("Please enter the price of the car.");
      document.calc.price.focus();
   } else
   if (document.calc.interest.value == null || document.calc.interest.value.length == 0) {
      alert("Please enter the loan's annual interest rate (enter a zero for no-interest loans).");
      document.calc.interest.focus();
   } else
   if (Vinterest < 0 || Vinterest > 20) {
      alert("Please enter the loan's annual interest rate (number from 0 to 20, entered as a whole number, i.e., enter 10% as 10).");
      document.calc.interest.focus();
   } else
   if (Vpayments == 0) {
      alert("Please enter the loan's term in number of months.");
      document.calc.payments.focus();
   } else {

      var VloanAmt = Number(Vprice) - Number(VdownPmt) - Number(Vtrade);
      var Vpayment = 0;

      if(Vinterest == 0) {

         Vpayment = VloanAmt / Vpayments;
         document.calc.payment.value = fns(Vpayment,2,1,1,1);

      } else {

         var Vpayment = computeMonthlyPayment(VloanAmt, Vpayments, Vinterest);
         document.calc.payment.value = fns(Vpayment,2,1,1,1);

      }

      document.calc.loanAmt.value = fns(VloanAmt,2,1,1,1);

      jQuery('.email-my-results').removeClass('hidden');

   }
}

function clear_results(form) {

   document.calc.loanAmt.value = "";
   document.calc.payment.value = "";

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
<br><h4 align="center">Car Payment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Car purchase price ($):
</td>
<td align="center">
<input type="text" name="price" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Down payment ($):
</td>
<td align="center">
<input type="text" name="downPmt" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Trade-in allowance ($):
</td>
<td align="center">
<input type="text" name="trade" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Interest Rate (%):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Loan term (# months):
</td>
<td align="center">
<input type="text" name="payments" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Car Payment" onclick="computeForm(this.form)">
<input type="reset" value="Clear">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Loan amount:
</td>
<td align="center">
<input type="text" name="loanAmt" size="15">
</td>
</tr>
<tr>
<td>
Monthly car payment:
</td>
<td align="center">
<input type="text" name="payment" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
