
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Compound Interest Calculator (Daily To Yearly)</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Compound Interest Calculator
//ALL RIGHTS RESERVED
//Created: 01/17/2001
//Last Modified: 05/04/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-20-1256
//Commercial Licence Date:2012-02-07
//*******************************************



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

function computeForm(form)  {

   if(document.calc.interest.value == "") {
      alert("Please enter the Interest Rate.");
   } else 
   if(document.calc.moAdd.value == "") {
      alert("Please enter the Monthly Addition.");
   } else
   if(document.calc.payments.value == "") {
      alert("Please enter the Number of Years.");
   } else {
    jQuery('.email-my-results').removeClass('hidden');
      var i = sn(document.calc.interest.value);
      i /= 100

      var VcompDays = 0;
      var maxCompsPerYr = 0;

      if(document.calc.compInt.selectedIndex == 0) {
         i /= 365;
         VcompDays = 1;
         maxCompsPerYr = 365;
      } else
      if(document.calc.compInt.selectedIndex == 1) {
         i /= 52;
         VcompDays = 7;
         maxCompsPerYr = 52;
      } else
      if(document.calc.compInt.selectedIndex == 2) {
         i /= 12;
         VcompDays = 30;
         maxCompsPerYr = 12;
      } else
      if(document.calc.compInt.selectedIndex == 3) {
         i /= 4;
         VcompDays = 91;
         maxCompsPerYr = 4;
      } else
      if(document.calc.compInt.selectedIndex == 4) {
         i /= 2;
         VcompDays = 182;
         maxCompsPerYr = 2;
      } else
      if(document.calc.compInt.selectedIndex == 5) {
         i /= 1;
         VcompDays = 365;
         maxCompsPerYr = 1;
      }

      var ma = sn(document.calc.moAdd.value);

      var VperiodDays = 0;
      var maxAddsPerYr = 0;

      if(document.calc.period.selectedIndex == 0) {
         VperiodDays = 1;
         maxAddsPerYr = 365;
      } else
      if(document.calc.period.selectedIndex == 1) {
         VperiodDays = 7;
         maxAddsPerYr = 52;
      } else
      if(document.calc.period.selectedIndex == 2) {
         VperiodDays = 14;
         maxAddsPerYr = 26;
      } else
      if(document.calc.period.selectedIndex == 3) {
         VperiodDays = 15;
         maxAddsPerYr = 24;
      } else
      if(document.calc.period.selectedIndex == 4) {
         VperiodDays = 30;
         maxAddsPerYr = 12;
      } else
      if(document.calc.period.selectedIndex == 5) {
         VperiodDays = 61;
         maxAddsPerYr = 6;
      } else
      if(document.calc.period.selectedIndex == 6) {
         VperiodDays = 91;
         maxAddsPerYr = 4;
      } else
      if(document.calc.period.selectedIndex == 7) {
         VperiodDays = 182;
         maxAddsPerYr = 2;
      } else
      if(document.calc.period.selectedIndex == 8) {
         VperiodDays = 365;
         maxAddsPerYr = 1;
      }

      //IF DEPOSIT FREQUENCY EQUALS COMPOUNDING FREQUENCY
      if(VperiodDays == VcompDays) {

         var ma = sn(document.calc.moAdd.value);
         var prin = sn(document.calc.principal.value);
         var origPrin = prin;
         var pmts = sn(document.calc.payments.value);
         pmts = Number(pmts * maxCompsPerYr);
         var count = 0;
    
         while(count < pmts) {

            newprin = prin + ma;
            prin = (newprin * i) + Number(prin + ma);
            count = count + 1;

         }

         var Vfv = prin;
         document.calc.fv.value = "$" + fn(prin,2,1);

         var totinv = Number(count * ma) + Number(origPrin);
         document.calc.totDeposits.value = "$" + fn(totinv,2,1);

         var Vtotalint = Number(prin - totinv);
         document.calc.totalint.value = "$" + fn(Vtotalint,2,1);


      //IF DEPOSITS ARE LESS FREQUENT THAN COMPOUNDING FREQUENCY
      } else
      if(VperiodDays > VcompDays) {
 
         var prin = sn(document.calc.principal.value);
         var origPrin = prin;

         var pmts = sn(document.calc.payments.value);
         pmts = pmts * 365;

         var maxComps = Number(pmts * maxCompsPerYr);
         var maxAdds = Number(pmts * maxAddsPerYr);

         var count = 0;
         var accumAdd = Number(ma);
         var numAdds = 1;
         var countAddDays = 0;
         var countCompDays = 0;
         var numComps = 0;
         var accumComp = 0;
         var currentInt = 0;
         prin =  Number(prin) + Number(ma);
    
         while(count < pmts) {

            //Add Addition if interval is met
            if(countAddDays == VperiodDays && numAdds < maxAdds) {
               prin = Number(prin) + Number(ma);
               accumAdd = Number(accumAdd) + Number(ma);
               accumPrin = Number(accumPrin) + Number(prin);
               numAdds = Number(numAdds) + Number(1);
               countAddDays = 1;
            } else {
               countAddDays = Number(countAddDays) + Number(1);
            }

            //Compound interest if interval is met
            if(countCompDays == VcompDays && numComps < maxComps) {
               accumComp = Number(accumComp) + Number(prin * i)
               prin = Number(prin * i) + Number(prin);
               currentInt = Number(prin * i);
               numComps = Number(numComps) + Number(1);
               countCompDays = 1;
            } else {
               countCompDays = Number(countCompDays) + Number(1);
            }

            count = Number(count) + Number(1);

         }

         var Vfv = prin;
         document.calc.fv.value = "$" + fn(prin,2,1);

         var totinv = Number(accumAdd) + Number(origPrin);
         document.calc.totDeposits.value = "$" + fn(totinv,2,1);

         var Vtotalint = Number(prin - totinv);
         document.calc.totalint.value = "$" + fn(Vtotalint,2,1);

      //IF DEPOSITS ARE MORE FREQUENT THAN COMPOUNDING FREQUENCY
      } else {

         if(document.calc.period.selectedIndex == 5) {
            VperiodDays = 60;
         }
 
         var prin = sn(document.calc.principal.value);
         var origPrin = prin;

         var pmts = sn(document.calc.payments.value);
         pmts = pmts * 365;

         var maxComps = Number(pmts * maxCompsPerYr);
         var maxAdds = Number(pmts * maxAddsPerYr);

         var count = 0;
         var accumAdd = 0;
         var numAdds = 0;
         var countAddDays = 0;
         var countCompDays = 0;
         var numComps = 0;
         var accumComp = 0;
         var depositIntervalDays = 0;
         var periodsPast = 0;
         var accumPrin = 0;
         var prinAvg = 0;

         var periodsPerComp = parseInt(VcompDays / VperiodDays,0);
    
         while(count < pmts) {
            //while(count < document.calc.testNum.value) {

            depositIntervalDays = Number(depositIntervalDays) + Number(1);

            //Accumulate period balances to figure average balance
            if(depositIntervalDays == VperiodDays || countCompDays == VcompDays) {
               periodsPast = Number(periodsPast) + Number(1);
               depositIntervalDays = 0;
            }

            //Add Addition if interval is met
            if(countAddDays == VperiodDays && numAdds < maxAdds) {
               prin = Number(prin) + Number(ma);
               accumAdd = Number(accumAdd) + Number(ma);
               accumPrin = Number(accumPrin) + Number(prin);
               prinAvg = accumPrin / periodsPast;
               numAdds = Number(numAdds) + Number(1);
               countAddDays = 1;
            } else {
               countAddDays = Number(countAddDays) + Number(1);
            }

            //Compound interest if interval is met
            if(countCompDays == (VcompDays - 1) && numComps < maxComps) {
               periodsPast = 0;
               prin = Number(prinAvg * i) + Number(prin);
               accumPrin = 0;
               accumComp = Number(accumComp) + Number(prinAvg * i)
               numComps = Number(numComps) + Number(1);
               countCompDays = 1;
            } else {
               countCompDays = Number(countCompDays) + Number(1);
            }

            count = Number(count) + Number(1);

         }

         var Vfv = prin;
         document.calc.fv.value = "$" + fn(prin,2,1);

         var totinv = Number(accumAdd) + Number(origPrin);
         document.calc.totDeposits.value = "$" + fn(totinv,2,1);

         var Vtotalint = Number(prin - totinv);
         document.calc.totalint.value = "$" + fn(Vtotalint,2,1);


      //END IF ELSE STATEMENT THAT DETERMINES WHICH ROUTINE TO RUN
      }

   //END NESTED IF TO CHECK FOR NON-NUMERIC ENTRIES
   }

}

function clear_results(form) {

   document.calc.fv.value = "";
   document.calc.totDeposits.value = "";
   document.calc.totalint.value = "";

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
<br><h4 align="center">Compound Interest Calculator (Daily To Yearly)</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Beginning Account Balance:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter the <select name="period" size="1" onchange="clear_results(this.form)">
<option value="0">Daily</option>
<option value="1">Weekly</option>
<option value="2">Bi-weekly</option>
<option value="3">Half-monthly</option>
<option value="4" selected="">Monthly</option>
<option value="5">Bi-monthly</option>
<option value="6">Quarterly</option>
<option value="7">Semi-annual</option>
<option value="8">Annual</option>
</select>
addition ($):
</td>
<td align="center">
<input type="text" name="moAdd" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (%):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Choose Your Compounding Interval:
</td>
<td align="center">
<select name="compInt" size="1" onchange="clear_results(this.form)">
<option value="0">Daily</option>
<option value="1">Weekly</option>
<option value="2" selected="">Monthly</option>
<option value="3">Quarterly</option>
<option value="4">Semi-annual</option>
<option value="5">Annual</option>
</select>
</td>
</tr>
<tr>
<td>
Number of Years To Grow:
</td>
<td align="center">
<input type="text" name="payments" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Compound Interest" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Future Value:
</td>
<td align="center">
<input type="text" name="fv" size="15">
</td>
</tr>
<tr>
<td>
Total Deposits:
</td>
<td align="center">
<input type="text" name="totDeposits" size="15">
</td>
</tr>
<tr>
<td>
Interest Earned:
</td>
<td align="center">
<input type="text" name="totalint" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
