
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Interest Rate Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Interest Rate Calculator
//ALL RIGHTS RESERVED
//Created: 10/11/2002
//Last Modified: 08/07/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-73-1256
//Commercial Licence Date:2012-02-07
//*******************************************


function clearStuff() {
  document.getElementById("report").innerHTML = "";
}

function computeIntRate(myNumPmts, myPrin, myPmtAmt, myGuess) {

var myDecRate = 0;

if(myGuess.length == 0 || myGuess == 0) {
   var myDecGuess = 10;
   } else {
   var myDecGuess = myGuess;
   if(myDecGuess >= 1) {
      myDecGuess = myDecGuess /100;
      }
   }

var myDecRate = myDecGuess / 12;
var myNewPmtAmt = 0;
var pow = 1;
var j = 0;

for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(myDecRate));
}

myNewPmtAmt = (myPrin * pow * myDecRate) / (pow - 1);

//2 DEC PLACE AMOUNT
var decPlace2Rate = (eval(myDecGuess) + eval(.01)) / 12;
var decPlace2Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace2Rate));
}
var decPlace2PmtAmt = (myPrin * pow * decPlace2Rate) / (pow - 1);
decPlace2Amt = eval(decPlace2PmtAmt) - eval(myNewPmtAmt);

//3 DEC PLACE AMOUNT
var decPlace3Rate = (eval(myDecGuess) + eval(.001)) / 12;
var decPlace3Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace3Rate));
}
var decPlace3PmtAmt = (myPrin * pow * decPlace3Rate) / (pow - 1);
decPlace3Amt = eval(decPlace3PmtAmt) - eval(myNewPmtAmt);

//4 DEC PLACE AMOUNT
var decPlace4Rate = (eval(myDecGuess) + eval(.0001)) / 12;
var decPlace4Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace4Rate));
}
var decPlace4PmtAmt = (myPrin * pow * decPlace4Rate) / (pow - 1);
decPlace4Amt = eval(decPlace4PmtAmt) - eval(myNewPmtAmt);

//5 DEC PLACE AMOUNT
var decPlace5Rate = (eval(myDecGuess) + eval(.00001)) / 12;
var decPlace5Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace5Rate));
}
var decPlace5PmtAmt = (myPrin * pow * decPlace5Rate) / (pow - 1);
decPlace5Amt = eval(decPlace5PmtAmt) - eval(myNewPmtAmt);

var myPmtDiff = 0;

if(myNewPmtAmt < myPmtAmt) {

   while(myNewPmtAmt < myPmtAmt) {

      myPmtDiff = eval(myPmtAmt) - eval(myNewPmtAmt);
      if(myPmtDiff > decPlace2Amt) {
         myDecRate = eval(myDecRate) + eval(.01 / 12);
      } else
      if(myPmtDiff > decPlace3Amt) {
         myDecRate = eval(myDecRate) + eval(.001 / 12);
      } else
      if(myPmtDiff > decPlace4Amt) {
         myDecRate = eval(myDecRate) + eval(.0001 / 12);
      } else
      if(myPmtDiff > decPlace5Amt) {
         myDecRate = eval(myDecRate) + eval(.00001 / 12);
      } else {
         myDecRate = eval(myDecRate) + eval(.000001 / 12);
      }

      pow = 1
      j = 0;
      
      for (j = 0; j < myNumPmts; j++) {
         pow = pow * (eval(1) + eval(myDecRate));
      }
      myNewPmtAmt = (myPrin * pow * myDecRate) / (pow - 1);
   }

} else {


   while(myNewPmtAmt > myPmtAmt) {

      myPmtDiff = eval(myNewPmtAmt) - eval(myPmtAmt);
      if(myPmtDiff > decPlace2Amt) {
         myDecRate = eval(myDecRate) - eval(.01 / 12);
      } else
      if(myPmtDiff > decPlace3Amt) {
         myDecRate = eval(myDecRate) - eval(.001 / 12);
      } else
      if(myPmtDiff > decPlace4Amt) {
         myDecRate = eval(myDecRate) - eval(.0001 / 12);
      } else
      if(myPmtDiff > decPlace5Amt) {
         myDecRate = eval(myDecRate) - eval(.00001 / 12);
      } else {
         myDecRate = eval(myDecRate) - eval(.000001 / 12);
      }

      pow = 1
      j = 0;
      
      for (j = 0; j < myNumPmts; j++) {
         pow = pow * (eval(1) + eval(myDecRate));
      }
      myNewPmtAmt = (myPrin * pow * myDecRate) / (pow - 1);
   }


}

myDecRate = myDecRate * 12 * 100;

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


function getMissing(form) {

   var filled = 0;

   if(document.calc.principal.value.length > 0) {
      filled = filled + 1;
   }
   if(document.calc.interest.value.length > 0) {
      filled = filled + 1;
   }
   if(document.calc.payments.value.length > 0) {
      filled = filled + 1;
   }
   if(document.calc.payment.value.length > 0) {
      filled = filled + 1;
   }

   if(filled < 3) {
      alert("Three of the four fields must contain a value in order to calculate the missing loan term.");
   } else {

      if(document.calc.principal.value.length > 0) {
         Vprincipal = sn(document.calc.principal.value);
      } else {
         Vprincipal = 0;
      }
      if(document.calc.interest.value.length > 0) {
         Vinterest = sn(document.calc.interest.value);
      } else {
         Vinterest = 0;
      }
      if(document.calc.payments.value.length > 0) {
         Vpayments = sn(document.calc.payments.value);
      } else {
         Vpayments = 0;
      }

      if(document.calc.payment.value.length > 0) {
         Vpayment =sn(document.calc.payment.value);
      } else {
         Vpayment = 0;
      }

      if(Vprincipal > 0 && Vinterest > 0 && Vpayments > 0 && Vpayment > 0) {
         alert("One empty field please.");
      } else
      if(document.calc.payment.value == "" || document.calc.payment.value == 0) {
         getPmt(form);
      } else
      if(document.calc.principal.value == "" || document.calc.principal.value == 0) {
         getPrin(form);
      } else
      if(document.calc.payments.value == "" || document.calc.payments.value == 0) {
         getPmts(form);
      } else
      if(document.calc.interest.value == "" || document.calc.interest.value == 0) {
         getInt(form);
      }
      monthlyAmortSched(form);
      jQuery('.email-my-results').removeClass('hidden');
   }

}


function getPmt(form) {

   var i = sn(document.calc.interest.value);
   if (i >= 1.0) {
      i = i / 100.0;
   }
   i /= 12;

   var noMonths = sn(document.calc.payments.value);
   var pow = 1;

   for (var j = 0; j < noMonths; j++) {
      pow = pow * (1 + i);
   }

   var Rpayment = (Vprincipal * pow * i) / (pow - 1);

   document.calc.payment.value = fns(Rpayment,2,1,1,1);

}


function getPrin(form) {

   var i = sn(document.calc.interest.value);
   if (i >= 1.0) {
      i = i / 100.0;
   }
   i /= 12;

   var noMonths = sn(document.calc.payments.value);
   var pow = 1;

   for (var j = 0; j < noMonths; j++) {
      pow = pow * (1 + i);
   }

   var Rprincipal = ((pow - 1) * Vpayment) / (pow * i);

   document.calc.principal.value = fns(Rprincipal,2,1,1,1);

}

function getPmts(form) {

   var i = sn(document.calc.interest.value);
   if (i >= 1.0) {
      i = i / 100.0;
   }
   i /= 12;

   var prin = sn(document.calc.principal.value);
   var count = 0;
   var prinPort = 0;
   var intPort = 0;
   var pmt = sn(document.calc.payment.value);

   while(Number(prin) > 0) {
      intPort = prin * i;
      prinPort = pmt - intPort;
      prin = prin - prinPort;
      count = count +1;
   }

   var Rcount = count;
   var pmtPart = parseInt(prin / pmt * 100, 10);

   document.calc.payments.value = Rcount;

}

function getInt(form) {

   var prin = sn(document.calc.principal.value);
   var pmt = sn(document.calc.payment.value);
   var nPer = sn(document.calc.payments.value);
   var guess = 10;

   var i = computeIntRate(nPer, prin, pmt, guess);

   document.calc.interest.value = fns(i,3,0,2,1);

}


function monthlyAmortSched(form) {

   var Vprincipal = sn(document.calc.principal.value);
   var VintRate = sn(document.calc.interest.value);
   var Vpayments = sn(document.calc.payments.value);
   var pmtAmt = sn(document.calc.payment.value);

   if(Vprincipal == 0) {
      alert("Please compute the top section of the calculator before creating the amortization schedule.");
      document.calc.principal.focus();
   } else
   if(VintRate == 0) {
      alert("Please compute the top section of the calculator before creating the amortization schedule.");
      document.calc.interest.focus();
   } else
   if(Vpayments == 0) {
      alert("Please compute the top section of the calculator before creating the amortization schedule.");
      document.calc.payments.focus();
   } else 
   if(pmtAmt == 0) {
      alert("Please compute the top section of the calculator before creating the amortization schedule.");
      document.calc.payment.focus();
   } else {

      var prin = Vprincipal;
      var Vint = VintRate;


      if(Vint >= 1) {
         Vint /= 100;
      }
      Vint /= 12;

      var nPer = Vpayments;

      var intPort = 0;
      var accumInt = 0;
      var prinPort = 0;
      var accumPrin = 0;
      var count = 0;
      var pmtRow = "";
      var pmtNum = 0;

      var today = new Date();
      var dayFactor = today.getTime();
      var pmtDay = today.getDate();
      var loanMM = today.getMonth() + 1;

      var loanYY = today.getYear();
      if(loanYY < 1900) {
         loanYY += 1900;
      }

      var loanDate = (loanMM + "/" + pmtDay + "/" + loanYY);
      var monthMS = 86400000 * 30.4;
      var pmtDate = 0;
      var displayPmtAmt = 0;

      var accumYearPrin = 0;
      var accumYearInt = 0;

      while(count < nPer) {

         if(count < (nPer - 1)) {

            intPort = prin * Vint;
            intPort *= 100;
            intPort = Math.round(intPort);
            intPort /= 100;

            accumInt = Number(accumInt) + Number(intPort);
            accumYearInt = Number(accumYearInt) + Number(intPort);

            prinPort = Number(pmtAmt) - Number(intPort);
            prinPort *= 100;
            prinPort = Math.round(prinPort);
            prinPort /= 100;

            accumPrin = Number(accumPrin) + Number(prinPort);
            accumYearPrin = Number(accumYearPrin) + Number(prinPort);

            prin = Number(prin) - Number(prinPort);

            displayPmtAmt = Number(prinPort) + Number(intPort);

         } else {

            intPort = prin * Vint;
            intPort *= 100;
            intPort = Math.round(intPort);
            intPort /= 100;

            accumInt = Number(accumInt) + Number(intPort);
            accumYearInt = Number(accumYearInt) + Number(intPort);

            prinPort = prin;

            accumPrin = Number(accumPrin) + Number(prinPort);
            accumYearPrin = Number(accumYearPrin) + Number(prinPort);

            prin = 0;

            //pmtAmt = Number(intPort) + Number(prinPort);
            displayPmtAmt = Number(prinPort) + Number(intPort);
         }

         count = Number(count) + Number(1);

         pmtNum = Number(pmtNum) + Number(1);

         dayFactor = Number(dayFactor) + Number(monthMS);

         pmtDate = new Date(dayFactor);

         pmtMonth = pmtDate.getMonth();

         pmtMonth = pmtMonth + 1;

         pmtYear = pmtDate.getYear();
         if(pmtYear < 1900) {
            pmtYear += 1900;
         }


         pmtString = (pmtMonth + "/" + pmtDay + "/" + pmtYear);

         pmtRow += "<tr><td align=right><font face='arial'><small>" + pmtNum + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + pmtString + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(prinPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(intPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(displayPmtAmt,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(prin,2,1,1,1) + "</small></font></td></tr>";

         if(pmtMonth == 12 || count == nPer) {

            pmtRow += "<tr bgcolor='#dddddd'><td align=right><font face='arial'><small>Total</small></font></td>";
            pmtRow += "<td align=left><font face='arial'><small>" + pmtYear + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearPrin,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearInt,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td></tr>";

            accumYearPrin = 0;
            accumYearInt = 0;

         }

         if(count > 600) {

            alert("Using your current entries you will never pay off this loan.");

            break;

         } else {

            continue;

         }

      }


      var part1 = "<br /><br /><center>";
      part1 += "<font face='arial'><big><strong>Amortization Schedule</strong></big></font></center>";

      var part2 = "<center><table border=1 cellpadding=2 cellspacing=0>";
      part2 += "<tr><td colspan=6><font face='arial'><small><strong>Loan Date: " + loanDate + "<br />";
      part2 += "Principal: " + fns(Vprincipal,2,1,1,1) + "<br />";
      part2 += "# of Payments: " + nPer + "<br />";
      part2 += "Interest Rate: " + fns(VintRate,3,0,2,1) + "<br />";
      part2 += "Payment: " + fns(pmtAmt,2,1,1,1) + "</strong></small></font></td></tr>";
      part2 += "<tr><td colspan=6><center><font face='arial'><strong>Schedule of Payments</strong></font><br />";
      part2 += "<font face='arial'><small><small>Please allow for slight rounding differences.";
      part2 += "</small></small></font></center></td></tr><tr bgcolor='silver'>";
      part2 += "<td align='center'><font face='arial'><small><strong>Pmt #</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Date</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Principal</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Interest</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Payment</strong></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><strong>Balance</strong></small></font></td></tr>";

      var part4 = "<tr><td colspan='2'>";
      part4 += "<font face='arial'><small><strong>Grand Total</strong></small></font></td>";
      part4 += "<td align=right><font face='arial'>";
      part4 += "<small><strong>" + fns(accumPrin,2,1,1,1) + "</strong></small></font></td>";
      part4 += "<td align=right><font face='arial'><small>";
      part4 += "<strong>" + fns(accumInt,2,1,1,1) + "</strong></small></font></td>";
      part4 += "<td> </td><td> </td></tr></table><br /><center>";
      var schedule = (part1 + "" + part2 + "" + pmtRow + "" + part4 + "");
      document.getElementById("report").innerHTML = schedule;

   }

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
<td colspan="6">
<br><h4 align="center">Interest Rate Calculator – Solves For Missing Loan Term</h4>
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td align="center"><b>No. of Payments</b></td>
<td align="center"><b>Interest Rate</b></td>
<td align="center"><b>Loan Amount</b></td>
<td align="center"><b>Monthly Payment</b></td>
</tr>
<tr>
<td align="center">
<input type="text" name="payments" size="5">
</td>
<td align="center">
<input type="text" name="interest" size="6">
</td>
<td align="center">
<input type="text" name="principal" size="12">
</td>
<td align="center">
<input type="text" name="payment" size="9">
</td>
<td align="center">
<input type="button" value="Calculate" onclick="getMissing(this.form)">
</td>
<td align="center">
<input type="reset" value="Reset" onclick="clearStuff()">
</td>
</tr>
</tbody>
</table>
<div id="report"></div>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
