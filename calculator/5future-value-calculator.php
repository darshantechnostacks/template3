
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Future Value Calculator</title>

<?php include_once 'include/header.php'; ?>
<script>

function deflatePV(deflatePrin, deflatePerc, deflateYears) {

//CALC INFLATION
if (deflatePerc >= 1.0) {
   deflatePerc /= 100;
}

deflatePerc = eval(1) + eval(deflatePerc);

var deflateYrCnt = 0;
var deflateFactor = 1;
while(deflateYrCnt < deflateYears) {

deflateYrCnt = eval(deflateYrCnt) + eval(1);

deflateFactor = deflateFactor / deflatePerc;

}

deflatedPV = deflatePrin * deflateFactor;

return deflatedPV;

}



function ATFVMultiDep(prin, intRate, numYrs, depAmt, numDepPerYr, numCompPerYr, fedStTaxRate) {

var i = 0;
var intEarn = 0;
var multiFV = prin;

if(intRate >= 1) {
   intRate /= 100;
}

if(fedStTaxRate == "" || fedStTaxRate == 0) {
   fedStTaxRate = 0;
} else {
   if(fedStTaxRate >= 1) {
      fedStTaxRate /= 100;
   }
}

if(numCompPerYr == "" || numCompPerYr == 0) {
   numCompPerYr = 12;
}
intRate /= numCompPerYr;

var numMonths = numYrs * 12;

var numPeriods = numMonths / 12 * numCompPerYr;
var monthsBetweenDep = 12 / numDepPerYr;
var monthsBetweenComp = 12 / numCompPerYr

var accumAnnInt = 0;
var accumTotEarn = 0;
var tax = 0;
var accumDep = 0;
var accumNumDep = 0;
var accumNumComp = 0;
var numTaxYears = 0;

for(i=1; i <= numMonths; i++) {
   if(i % monthsBetweenDep == 0) {
      multiFV = eval(multiFV) + eval(depAmt);
      accumDep = eval(accumDep) + eval(depAmt);
      accumNumDep = eval(accumNumDep) + eval(1);
   }
   if(i % monthsBetweenComp == 0) {
      intEarn = multiFV * intRate;
      accumAnnInt = eval(accumAnnInt) + eval(intEarn);
      accumTotEarn = eval(accumTotEarn) + eval(intEarn);
      multiFV = eval(multiFV) + eval(intEarn);
      accumNumComp = eval(accumNumComp) + eval(1);
   }

   if(i % 12 == 0) {
      tax = fedStTaxRate * accumAnnInt;
      accumTotEarn = eval(accumTotEarn) - eval(tax);
      multiFV = eval(multiFV) - eval(tax);
      accumAnnInt = 0;
      numTaxYears = eval(numTaxYears) + eval(1);
   }
   
}

return multiFV;

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


function computeForm(form)  {

   var Vprincipal = sn(document.calc.principal.value);
   var VdepositAmt = sn(document.calc.depositAmt.value);
   var VintRate = sn(document.calc.interest.value);
   var Vyears = sn(document.calc.years.value);
   var VtaxRate = sn(document.calc.taxRate.value);
   var VinflateRate = sn(document.calc.inflateRate.value);


   if(VdepositAmt == 0) {
      alert("Please enter the periodic deposit amount.");
      document.calc.depositAmt.focus();
   } else
   if(VintRate == 0) {
      alert("Please enter the Interest Rate.");
      document.calc.interest.focus();
   } else 
   if(Vyears == 0) {
      alert("Please enter the Number of Years.");
      document.calc.years.focus();
   } else {
  
      var Vprin = Vprincipal;

      var Vinterval = document.calc.interval.options[document.calc.interval.selectedIndex].value;

      var VgrossFV = ATFVMultiDep(Vprincipal, VintRate, Vyears, VdepositAmt, Vinterval, 12, 0);
      document.calc.grossFV.value = fns(VgrossFV,2,1,1,1);


      var VafterTaxFV = ATFVMultiDep(Vprincipal, VintRate, Vyears, VdepositAmt, Vinterval, 12, VtaxRate);
      document.calc.afterTaxFV.value = fns(VafterTaxFV,2,1,1,1);


      var VafterInflateFV = deflatePV(VafterTaxFV, VinflateRate, Vyears);

      document.calc.afterInflateFV.value = fns(VafterInflateFV,2,1,1,1);
    jQuery('.email-my-results').removeClass('hidden');
   }

}

function clear_results(form) {

   document.calc.grossFV.value = "";
   document.calc.afterTaxFV.value = "";
   document.calc.afterInflateFV.value = "";

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
<br><h4 align="center">Future Value Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Beginning Savings Balance:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter the <select name="interval" onchange="clear_results(this.form)">
<option value="12">Monthly</option>
<option value="52">Weekly</option>
<option value="4">Quarterly</option>
<option value="1">Annual</option>
</select> deposit amount:
</td>
<td align="center">
<input type="text" name="depositAmt" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (% ROI):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Number Of Years:
</td>
<td align="center">
<input type="text" name="years" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Tax Rate (Combined State and Fed %):
</td>
<td align="center">
<input type="text" name="taxRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Rate of Inflation (%):
</td>
<td align="center">
<input type="text" name="inflateRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Future Value" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Nominal Future Value (Unadjusted):
</td>
<td align="center">
<input type="text" name="grossFV" size="15"></td>
</tr>
<tr>
<td>
After-Tax Future Value:
</td>
<td align="center">
<input type="text" name="afterTaxFV" size="15"></td>

</tr>
<tr>
<td>
Future Value After Taxes And Inflation:
</td>
<td align="center">
<input type="text" name="afterInflateFV" size="15"></td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
