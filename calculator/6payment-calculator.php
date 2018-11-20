
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Payment Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Payment Calculator
//ALL RIGHTS RESERVED
//Created: 06/06/2006
//Last Modified: 11/04/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-142-1256
//Commercial Licence Date:2012-02-07
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

   var Vprincipal = sn(document.calc.principal.value);
   var Vint_rate = sn(document.calc.interest.value);
   var Vnum_years = sn(document.calc.num_years.value);

   if(Vprincipal == 0) {
      alert("Please enter the loan's principal amount.");
      document.calc.principal.focus();
   } else
   if(Vint_rate == 0) {
      alert("Please enter the loan's annual interest rate.");
      document.calc.interest.focus();
   } else
   if(Vnum_years == 0) {
      alert("Please enter the loan's term in years.");
      document.calc.num_years.focus();
   } else {


      var i = Vint_rate;
      i = i / 100;
      i = i / 12;


      var Vnum_pmts = Vnum_years * 12;

      var Vio_payment = Vprincipal * i;

      document.calc.io_payment.value = fns(Vio_payment,2,1,1,1);

      var Vpi_payment = computeMonthlyPayment(Vprincipal, Vnum_pmts, Vint_rate);
      document.calc.pi_payment.value = fns(Vpi_payment,2,1,1,1);

      jQuery('.email-my-results').removeClass('hidden');
   }
}

function clear_results(form) {

   document.calc.io_payment.value = "";
   document.calc.pi_payment.value = "";

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
<td colspan="3">
<br><h4 align="center">Loan Payment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Principal Owed ($):
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Annual Interest rate (APR %):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Term (number of years):
</td>
<td align="center">
<input type="text" name="num_years" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Calculate Payment" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
<b>
Results
</b>
</td>
<td align="center">
<b>
Interest Only <br>Payment
</b>
</td>
<td align="center">
<b>
Principal &amp; Interest<br> Payment
</b>
</td>
</tr>
<tr>
<td>
Monthly Payment:
</td>
<td align="center">
<input type="text" name="io_payment" size="15">
</td>
<td align="center">
<input type="text" name="pi_payment" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
