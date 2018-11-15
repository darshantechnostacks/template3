
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Compare Credit Cards - Credit Card Comparison Calculator</title>

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

   if(document.calc.principal.value == "" || document.calc.principal.value ==0) {
      alert("Please enter a principal amount.");
      document.calc.principal.focus();
   } else
   if(document.calc.payment.value == "" || document.calc.payment.value ==0) {
      alert("Please enter a payment amount.");
      document.calc.payment.focus();
   } else
   if(document.calc.regIntRate1.value == "" || document.calc.regIntRate1.value ==0) {
      alert("Please enter a regular interest rate for Card #1.");
      document.calc.regIntRate1.focus();
   } else
   if(document.calc.regIntRate2.value == "" || document.calc.regIntRate2.value ==0) {
      alert("Please enter a regular interest rate for Card #2.");
      document.calc.regIntRate1.focus();
   } else
   if((document.calc.introIntRate1.value.length == 0) && document.calc.introMonths1.value.length > 0) {
      alert("Please enter an introductory interest rate for Card #1. Otherwise, if Card #1 has no introductory offer, please leave both introductory fields blank for Card #1.");
      document.calc.introIntRate1.focus();
   } else
   if((document.calc.introIntRate2.value.length == 0) && document.calc.introMonths2.value.length > 0) {
      alert("Please enter an introductory interest rate for Card #2. Otherwise, if Card #2 has no introductory offer, please leave both introductory fields blank for Card #2.");
      document.calc.introIntRate2.focus();
   } else
   if((document.calc.introMonths1.value == "" || document.calc.introMonths1.value ==0) && document.calc.introIntRate1.value.length > 0) {
      alert("Please enter the number of months the introductory interest rate will last for Card #1. Otherwise, if Card #1 has no introductory offer, please leave both introductory fields blank for Card #1.");
      document.calc.introMonths1.focus();
   } else
   if((document.calc.introMonths2.value == "" || document.calc.introMonths2.value ==0) && document.calc.introIntRate2.value.length > 0) {
      alert("Please enter the number of months the introductory interest rate will last for Card #2. Otherwise, if Card #2 has no introductory offer, please leave both introductory fields blank for Card #2.");
      document.calc.introMonths2.focus();
   } else {

   	jQuery('.email-my-results').removeClass('hidden');
      var Vprincipal = sn(document.calc.principal.value);
      var Vpayment = sn(document.calc.payment.value);

      //CALC CARD #1

      var VannFee1 = sn(document.calc.annFee1.value);
      if(VannFee1 == 0 || VannFee1 =="") {
         VannFee1 = 0;
      } else {
         VannFee1 = VannFee1 / 12;
      }

      var prin1 = Vprincipal;
      var pmt1 = Vpayment;

      var prin1 = Vprincipal;
      var pmt1 = Vpayment;
      var prinPort1 = 0;
      var intPort1 = 0;
      var count1 = 0;
      var accumInt1 = 0;
      var dailyCount1 = 0;
      var tempInt1 = 0;

      //IF INTRO RATE, DO FOLLOWING:
      var VintroMonths1 = sn(document.calc.introMonths1.value);
      if(VintroMonths1 == 0 || VintroMonths1 =="") {
         VintroMonths1 = 0;
      }

      if(VintroMonths1 > 0 && document.calc.introIntRate1.value.length > 0) {

         var VintroIntRate1 = sn(document.calc.introIntRate1.value);
            VintroIntRate1 = VintroIntRate1 / 100.0;

         if(document.calc.compound1.selectedIndex == 0) {
            VintroIntRate1 /= 12;
         } else {
            VintroIntRate1 /= 365;
         }

         if(document.calc.compound1.selectedIndex == 1) {
            while(count1 < VintroMonths1) {
               dailyCount1 = 0;
               tempInt1 = 0;
               while(dailyCount1 < 31) {
                  tempInt1 = Number(VintroIntRate1 * prin1);
                  accumInt1 = Number(accumInt1) +  + Number(tempInt1);
                  prin1 = Number(prin1) + Number(tempInt1);
                  dailyCount1 = dailyCount1 + 1;
               }
               prin1 = Number(prin1) - Number(pmt1);
               count1 = count1 + 1
               if(count1 > 1000) {
                  alert("Given the entered balance, payment and interest rate, card #1 will never be paid off. Please increase the payment amount.");
                  document.calc.payment.focus();
                  break;
               } else {
                  continue;
               }
            }

         } else {
            while(count1 < VintroMonths1) {
               intPort1 = Number(VintroIntRate1 * prin1);
               prinPort1 = Number(pmt1 - intPort1);
               prin1 = Number(prin1 - prinPort1);
               accumInt1 = Number(accumInt1 + intPort1);
               count1 = count1 + 1
               if(count1 > 1000) {
                  alert("Given the entered balance, payment and interest rate, card #1 will never be paid off. Please increase the payment amount.");
                  document.calc.payment.focus();
                  break;
               } else {
                  continue;
               }
            }
         }
      }
      // END INTRO CALC

      //document.calc.nPer2.value = prin1;
      //document.calc.totalCosts2.value = accumInt1;

      //BEGIN REGULAR INTEREST CALC

      var VregIntRate1 = sn(document.calc.regIntRate1.value);
      VregIntRate1 = VregIntRate1 / 100.0;

      if(document.calc.compound1.selectedIndex == 0) {
         VregIntRate1 /= 12;
      } else {
         VregIntRate1 /= 365;
      }

      if(document.calc.compound1.selectedIndex == 1) {
      while((prin1 * ( 1 + VregIntRate1)) > pmt1) {
      //while(count1 < 2) {
            dailyCount1 = 0;
            tempInt1 = 0;
            while(dailyCount1 < 31) {
               tempInt1 = Number(VregIntRate1 * prin1);
               accumInt1 = Number(accumInt1) +  + Number(tempInt1);
               prin1 = Number(prin1) + Number(tempInt1);
               dailyCount1 = dailyCount1 + 1;
            }
            prin1 = Number(prin1) - Number(pmt1);
            count1 = count1 + 1
            if(count1 > 1000) {
               alert("Given the entered balance, payment and interest rate, card #1 will never be paid off. Please increase the payment amount.");
               document.calc.payment.focus();
               break;
            } else {
               continue;
            }
         }
         //FINAL INTEREST PAYMENT
         dailyCount1 = 0;
         tempInt1 = 0;
         while(dailyCount1 < 31) {
            tempInt1 = Number(VregIntRate1 * prin1);
            accumInt1 = Number(accumInt1) +  + Number(tempInt1);
            prin1 = Number(prin1) + Number(tempInt1);
            dailyCount1 = dailyCount1 + 1;
         }
         count1 = count1 + 1

      } else {
         while((prin1 * ( 1 + VregIntRate1)) > pmt1) {
            intPort1 = Number(VregIntRate1 * prin1);
            prinPort1 = Number(pmt1 - intPort1);
            prin1 = Number(prin1 - prinPort1);
            accumInt1 = Number(accumInt1 + intPort1);
            count1 = count1 + 1
            if(count1 > 1000) {
               alert("Given the entered balance, payment and interest rate, card #1 will never be paid off. Please increase the payment amount.");
               document.calc.payment.focus();
               break;
            } else {
               continue;
            }
         }
      //FINAL INTEREST PAYMENT
         intPort1 = Number(VregIntRate1 * prin1);
         accumInt1 = Number(accumInt1 + intPort1);
         count1 = count1 + 1
      }

      VannFee1 = VannFee1 * count1;

      var VtotalCosts1 = Number(VannFee1) + Number(accumInt1);

      document.calc.totalCosts1.value = "$" + fn(VtotalCosts1,2,1);
      document.calc.nPer1.value = count1; 

      //CALC CARD #2

      var VannFee2 = sn(document.calc.annFee2.value);
      if(VannFee2 == 0 || VannFee2 =="") {
   VannFee2 = 0;
      } else {
         VannFee2 = VannFee2 / 12;
      }

      var prin2 = Vprincipal;
      var pmt2 = Vpayment;

      var prin2 = Vprincipal;
      var pmt2 = Vpayment;
      var prinPort2 = 0;
      var intPort2 = 0;
      var count2 = 0;
      var accumInt2 = 0;
      var dailyCount2 = 0;
      var tempInt2 = 0;

      //IF INTRO RATE, DO FOLLOWING:
      var VintroMonths2 = sn(document.calc.introMonths2.value);
      if(VintroMonths2 == 0 || VintroMonths2 =="") {
         VintroMonths2 = 0;
      }

      if(VintroMonths2 > 0 && document.calc.introIntRate1.value.length > 0) {

         var VintroIntRate2 = sn(document.calc.introIntRate2.value);
         VintroIntRate2 = VintroIntRate2 / 100.0;

         if(document.calc.compound2.selectedIndex == 0) {
            VintroIntRate2 /= 12;
         } else {
            VintroIntRate2 /= 365;
         }

         if(document.calc.compound2.selectedIndex == 1) {
            while(count2 < VintroMonths2) {
               dailyCount2 = 0;
               tempInt2 = 0;
               while(dailyCount2 < 31) {
                  tempInt2 = Number(VintroIntRate2 * prin2);
                  accumInt2 = Number(accumInt2) +  + Number(tempInt2);
                  prin2 = Number(prin2) + Number(tempInt2);
                  dailyCount2 = dailyCount2 + 1;
               }
               prin2 = Number(prin2) - Number(pmt2);
               count2 = count2 + 1
               if(count2 > 1000) {
                  alert("Given the entered balance, payment and interest rate, card #2 will never be paid off. Please increase the payment amount.");
                  document.calc.payment.focus();
                  break;
               } else {
                  continue;
               }
            }

         } else {
            while(count2 < VintroMonths2) {
               intPort2 = Number(VintroIntRate2 * prin2);
               prinPort2 = Number(pmt2 - intPort2);
               prin2 = Number(prin2 - prinPort2);
               accumInt2 = Number(accumInt2 + intPort2);
               count2 = count2 + 1
               if(count2 > 1000) {
                  alert("Given the entered balance, payment and interest rate, card #2 will never be paid off. Please increase the payment amount.");
                  document.calc.payment.focus();
                  break;
               } else {
                  continue;
               }
            }
         }
      }
      // END INTRO CALC

      //document.calc.nPer2.value = prin2;
      //document.calc.totalCosts2.value = accumInt2;

      //BEGIN REGULAR INTEREST CALC

      var VregIntRate2 = sn(document.calc.regIntRate2.value);
      VregIntRate2 = VregIntRate2 / 100.0;

      if(document.calc.compound2.selectedIndex == 0) {
         VregIntRate2 /= 12;
      } else {
         VregIntRate2 /= 365;
      }

      if(document.calc.compound2.selectedIndex == 1) {
      while((prin2 * ( 1 + VregIntRate2)) > pmt2) {
      //while(count2 < 2) {
            dailyCount2 = 0;
            tempInt2 = 0;
            while(dailyCount2 < 31) {
               tempInt2 = Number(VregIntRate2 * prin2);
               accumInt2 = Number(accumInt2) +  + Number(tempInt2);
               prin2 = Number(prin2) + Number(tempInt2);
               dailyCount2 = dailyCount2 + 1;
            }
            prin2 = Number(prin2) - Number(pmt2);
            count2 = count2 + 1
            if(count2 > 1000) {
               alert("Given the entered balance, payment and interest rate, card #2 will never be paid off. Please increase the payment amount.");
               document.calc.payment.focus();
               break;
            } else {
               continue;
            }
         }
         //FINAL INTEREST PAYMENT
         dailyCount2 = 0;
         tempInt2 = 0;
         while(dailyCount2 < 31) {
            tempInt2 = Number(VregIntRate2 * prin2);
            accumInt2 = Number(accumInt2) +  + Number(tempInt2);
            prin2 = Number(prin2) + Number(tempInt2);
            dailyCount2 = dailyCount2 + 1;
         }
         count2 = count2 + 1;

      } else {
         while((prin2 * ( 1 + VregIntRate2)) > pmt2) {
            intPort2 = Number(VregIntRate2 * prin2);
            prinPort2 = Number(pmt2 - intPort2);
            prin2 = Number(prin2 - prinPort2);
            accumInt2 = Number(accumInt2 + intPort2);
            count2 = count2 + 1;
            if(count2 > 2000) {
               alert("Given the entered balance, payment and interest rate, card #2 will never be paid off. Please increase the payment amount.");
               document.calc.payment.focus();
               break;
            } else {
               continue;
            }
         }
      //FINAL INTEREST PAYMENT
         intPort2 = Number(VregIntRate2 * prin2);
         accumInt2 = Number(accumInt2 + intPort2);
         count2 = count2 + 1;
      }

      VannFee2 = VannFee2 * count2;

      var VtotalCosts2 = Number(VannFee2) + Number(accumInt2);

      document.calc.totalCosts2.value = "$" + fn(VtotalCosts2,2,1);
      document.calc.nPer2.value = count2; 

   }


}


function clear_results(form) {

   document.calc.totalCosts1.value = "";
   document.calc.nPer1.value = ""; 
   document.calc.totalCosts2.value = "";
   document.calc.nPer2.value = ""; 
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
<tr><td colspan="3">
<br><h4 align="center">Credit Card Comparison Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Balance To Use For Comparison:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Fixed Monthly Payment Amount:<br>
Must be greater than monthly interest charge
</td>
<td align="center">
<input type="text" name="payment" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center">
<b>Comparison</b>
</td>
<td align="center">
<b>Card #1</b>
</td>
<td align="center">
<b>Card #2</b>
</td>
</tr>
<tr>
<td>
Annual Fee (optional):
</td>
<td align="center">
<input type="text" name="annFee1" size="15" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" name="annFee2" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Introductory Annual Interest Rate (optional):
</td>
<td align="center">
<input type="text" name="introIntRate1" size="15" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" name="introIntRate2" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Term For Introductory Rate (# months - optional):
</td>
<td align="center">
<input type="text" name="introMonths1" size="15" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" name="introMonths2" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Regular Annual Interest Rate:
</td>
<td align="center">
<input type="text" name="regIntRate1" size="15" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" name="regIntRate2" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Compounding Period:
</td>
<td align="center">
<select name="compound1" size="1" onchange="clear_results(this.form)">
<option value="0">Monthly</option>
<option value="1">Daily</option>
</select>
</td>
<td align="center">
<select name="compound2" size="1" onchange="clear_results(this.form)">
<option value="0">Monthly</option>
<option value="1">Daily</option>
</select>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" value="Compare Credit Cards" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Number Of Payments Until Pay Off:
</td>
<td align="center">
<input type="text" name="nPer1" size="15">
</td>
<td align="center">
<input type="text" name="nPer2" size="15">
</td>
</tr>
<tr>
<td>
Total Costs:
</td>
<td align="center">
<input type="text" name="totalCosts1" size="15">
</td>
<td align="center">
<input type="text" name="totalCosts2" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
