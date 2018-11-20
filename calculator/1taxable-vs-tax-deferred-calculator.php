<!DOCTYPE html>
<html lang="en-US" >
<head>
<meta charset="UTF-8" />
<title>Taxable vs Tax Deferred Calculator</title>

<?php include_once 'include/header.php'; ?>

<script Language='JavaScript'>


function ATEarnSingleDep(prin, intRate, numMonths, numCompPerYr, fedStTaxRate) {

var i = 0;
var intEarn = 0;
var singleFV = prin;

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

var numPeriods = numMonths / 12 * numCompPerYr;

var accumAnnInt = 0;
var accumTotEarn = 0;
var tax = 0;

for(i=1; i <= numPeriods; i++) {
   intEarn = singleFV * intRate;
   accumAnnInt = eval(accumAnnInt) + eval(intEarn);
   accumTotEarn = eval(accumTotEarn) + eval(intEarn);
   singleFV = eval(singleFV) + eval(intEarn);

   if(i % numCompPerYr == 0) {
      tax = fedStTaxRate * accumAnnInt;
      accumTotEarn = eval(accumTotEarn) - eval(tax);
      singleFV = eval(singleFV) - eval(tax);
      accumAnnInt = 0;
   }
   
}

return accumTotEarn;

}



function ATPEarnSingleDep(prin, intRate, numMonths, numCompPerYr, fedStTaxRate, percTaxable) {

var i = 0;
var intEarn = 0;
var singleFV = prin;

var rate = intRate / 100;

var tax_rate = fedStTaxRate;
if(fedStTaxRate == "" || fedStTaxRate == 0) {
   tax_rate = 0;
} else {
   tax_rate /= 100;
}

var perc_taxable = percTaxable;
if(percTaxable == "" || percTaxable == 0) {
   perc_taxable = 0;
} else {
   perc_taxable /= 100;
}

if(numCompPerYr == "" || numCompPerYr == 0) {
   numCompPerYr = 12;
}
rate /= numCompPerYr;

var numPeriods = numMonths / 12 * numCompPerYr;

var accumAnnInt = 0;
var accumTotEarn = 0;
var tax = 0;
var taxable = 0;

for(i=1; i <= numPeriods; i++) {
   intEarn = singleFV * rate;
   accumAnnInt = eval(accumAnnInt) + eval(intEarn);
   accumTotEarn = eval(accumTotEarn) + eval(intEarn);
   singleFV = eval(singleFV) + eval(intEarn);

   if(i % numCompPerYr == 0) {
      taxable = accumAnnInt * perc_taxable;
      tax = tax_rate * taxable;
      accumTotEarn = eval(accumTotEarn) - eval(tax);
      singleFV = eval(singleFV) - eval(tax);
      accumAnnInt = 0;
   }
   
}

return accumTotEarn;

}



function computeAnnYieldSS(myYears, myPrin, myFV, myGuess, myCPY) {

var myDecRate = 0;

if(myGuess.length == 0 || myGuess == 0) {
   var myDecGuess = 6;
   } else {
   var myDecGuess = myGuess;
   if(myDecGuess >= 1) {
      myDecGuess = myDecGuess /100;
      }
   }

var myDecRate = myDecGuess / myCPY;
var myNewFV = 0;
var pow = 1;
var j = 0;

var myNPR = myYears * myCPY;

for (j = 0; j < myNPR; j++) {
   pow = pow * (eval(1) + eval(myDecRate));
}

myNewFV = (myPrin * pow);

//2 DEC PLACE AMOUNT
var decPlace2Rate = (eval(myDecGuess) + eval(.01)) / myCPY;
var decPlace2Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNPR; j++) {
   pow = pow * (eval(1) + eval(decPlace2Rate));
}
var decPlace2FV = (myPrin * pow);
decPlace2Amt = eval(decPlace2FV) - eval(myNewFV);

//3 DEC PLACE AMOUNT
var decPlace3Rate = (eval(myDecGuess) + eval(.001)) / myCPY;
var decPlace3Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNPR; j++) {
   pow = pow * (eval(1) + eval(decPlace3Rate));
}
var decPlace3FV = (myPrin * pow);
decPlace3Amt = eval(decPlace3FV) - eval(myNewFV);

//4 DEC PLACE AMOUNT
var decPlace4Rate = (eval(myDecGuess) + eval(.0001)) / myCPY;
var decPlace4Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNPR; j++) {
   pow = pow * (eval(1) + eval(decPlace4Rate));
}
var decPlace4FV = (myPrin * pow);
decPlace4Amt = eval(decPlace4FV) - eval(myNewFV);

//5 DEC PLACE AMOUNT
var decPlace5Rate = (eval(myDecGuess) + eval(.00001)) / myCPY;
var decPlace5Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNPR; j++) {
   pow = pow * (eval(1) + eval(decPlace5Rate));
}
var decPlace5FV = (myPrin * pow);
decPlace5Amt = eval(decPlace5FV) - eval(myNewFV);

var myPmtDiff = 0;

if(myNewFV < myFV) {

   while(myNewFV < myFV) {

      myPmtDiff = eval(myFV) - eval(myNewFV);
      if(myPmtDiff > decPlace2Amt) {
         myDecRate = eval(myDecRate) + eval(.01 / myCPY);
      } else
      if(myPmtDiff > decPlace3Amt) {
         myDecRate = eval(myDecRate) + eval(.001 / myCPY);
      } else
      if(myPmtDiff > decPlace4Amt) {
         myDecRate = eval(myDecRate) + eval(.0001 / myCPY);
      } else
      if(myPmtDiff > decPlace5Amt) {
         myDecRate = eval(myDecRate) + eval(.00001 / myCPY);
      } else {
         myDecRate = eval(myDecRate) + eval(.000001 / myCPY);
      }

      pow = 1
      j = 0;
      
      for (j = 0; j < myNPR; j++) {
         pow = pow * (eval(1) + eval(myDecRate));
      }
      myNewFV = (myPrin * pow);
   }

} else {


   while(myNewFV > myFV) {

      myPmtDiff = eval(myNewFV) - eval(myFV);
      if(myPmtDiff > decPlace2Amt) {
         myDecRate = eval(myDecRate) - eval(.01 / myCPY);
      } else
      if(myPmtDiff > decPlace3Amt) {
         myDecRate = eval(myDecRate) - eval(.001 / myCPY);
      } else
      if(myPmtDiff > decPlace4Amt) {
         myDecRate = eval(myDecRate) - eval(.0001 / myCPY);
      } else
      if(myPmtDiff > decPlace5Amt) {
         myDecRate = eval(myDecRate) - eval(.00001 / myCPY);
      } else {
         myDecRate = eval(myDecRate) - eval(.000001 / myCPY);
      }

      pow = 1
      j = 0;
      
      for (j = 0; j < myNPR; j++) {
         pow = pow * (eval(1) + eval(myDecRate));
      }
      myNewFV = (myPrin * pow);
   }


}

myDecRate = myDecRate * myCPY * 100;

return myDecRate;

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
   var VintRate = sn(document.calc.intRate.value);
   var Vyears = sn(document.calc.years.value);

   if(Vprincipal == 0) {
      alert("Please enter the amount invested.");
      document.calc.principal.focus();
   } else 
   if(VintRate == 0) {
      alert("Please enter the expected annual rate of return.");
      document.calc.intRate.focus();
   } else
   if(Vyears == 0) {
      alert("Please enter the number of years the amount will be invested for.");
      document.calc.years.focus();
   } else
   if(document.calc.taxRate.value == "") {
      alert("Please enter your marginal tax rate.");
      document.calc.taxRate.focus();
   } else
   if(document.calc.percentTaxable.value == "") {
      alert("Please enter the percentage of the tax-deferred earnings that will be taxable.");
      document.calc.percentTaxable.focus();
   } else {


      var Vmonths = Vyears * 12;
      var VnumCompPerYr = 1;
      var VtaxRate = sn(document.calc.taxRate.value);
      var VpercentTaxable = sn(document.calc.percentTaxable.value);

      var VtaxableEarnings = ATEarnSingleDep(Vprincipal, VintRate, Vmonths, VnumCompPerYr, VtaxRate);

      var VtaxableFV = Number(Vprincipal) + Number(VtaxableEarnings);
      document.calc.taxableFV.value = fns(VtaxableFV,2,1,1,1);


      var VdeferredEarnings = ATPEarnSingleDep(Vprincipal, VintRate, Vmonths, VnumCompPerYr, VtaxRate, VpercentTaxable);

      var VdeferredFV = Number(Vprincipal) + Number(VdeferredEarnings);

      document.calc.deferredFV.value = fns(VdeferredFV,2,1,1,1);

      var VtaxableAnnYield = computeAnnYieldSS(Vyears, Vprincipal, VtaxableFV, 6, 1);
      document.calc.taxableAnnYield.value = fns(VtaxableAnnYield,2,0,2,1) + "";

      var VdeferredAnnYield = computeAnnYieldSS(Vyears, Vprincipal, VdeferredFV, 6, 1);
      document.calc.deferredAnnYield.value = fns(VdeferredAnnYield,2,0,2,1) + "";

      jQuery('.email-my-results').removeClass('hidden');
   }

}

function clear_results(form) {

   document.calc.taxableFV.value = "";
   document.calc.deferredFV.value = "";
   document.calc.taxableAnnYield.value = "";
   document.calc.deferredAnnYield.value = "";

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
<br><h4 align="center">Taxable vs Tax Deferred Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Amount invested ($):
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Expected annual rate of return (%):
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Number of years invested (#):
</td>
<td align="center">
<input type="text" name="years" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Marginal tax rate (%):
</td>
<td align="center">
<input type="text" name="taxRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Investment return that is taxable (100% taxable 8% return entered as 8):
</td>
<td align="center">
<input type="text" name="percentTaxable" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><br>
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
Taxable
</b>
</td>
<td align="center">
<b>
Tax-deferred
</b>
</td>
</tr>
<tr>
<td>
Future value:
</td>
<td align="center">
<input type="text" name="taxableFV" size="15">
</td>
<td align="center">
<input type="text" name="deferredFV" size="15">
</td>
</tr>
<tr>
<td>
Annualized yield:
</td>
<td align="center">
<input type="text" name="taxableAnnYield" size="15">
</td>
<td align="center">
<input type="text" name="deferredAnnYield" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                    <br/><br/><br/><br/>
                </main>
<?php include_once 'include/footer.php'; ?>
            </div></div></div>
</body></html>