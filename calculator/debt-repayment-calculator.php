
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Debt Repayment Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">

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

   if(document.calc.principal.value == "" || document.calc.principal.value == 0) {
      alert("Please enter the principal amount (how much you owe as of today).");
      document.calc.principal.focus();
   } else
   if(document.calc.interest.value == "" || document.calc.interest.value == 0) {
      alert("Please enter an annual interest rate.");
      document.calc.interest.focus();
   } else
   if(document.calc.origPmt.value == "" || document.calc.origPmt.value == 0) {
      alert("Please enter your current monthly payment amount.");
      document.calc.origPmt.focus();
   } else {

   	jQuery('.email-my-results').removeClass('hidden');
      var i = sn(document.calc.interest.value);
      var display_rate = i;
      if (i >= 1.0) {
         i = i / 100.0;
      }
      i /= 12;


      var prin1 = sn(document.calc.principal.value);
      var prin2 = sn(document.calc.principal.value);
      var prin3 = sn(document.calc.principal.value);

      var pmt1 = sn(document.calc.origPmt.value);
      var VpmtAdd = sn(document.calc.pmtAdd.value);
      var pmt2 = Number(pmt1) + Number(VpmtAdd);
      var prinAdd =  VpmtAdd;
      var prinPort1 = 0;
      var prinPort2 = 0;
      var intPort1 = 0;
      var intPort2 = 0;
      var count1 = 0;
      var count2 = 0;
      var accumInt1 = 0;
      var accumInt2 = 0;
    
      while((prin1 * (Number(i) + Number(1))) >= pmt1) {

         intPort1 = i * prin1;
         accumInt1 = Number(accumInt1) + Number(intPort1);
         prinPort1 = Number(pmt1) - Number(intPort1);
         prin1 = Number(prin1) - Number(prinPort1);
         count1 = count1 + 1
         if(count1 > 600) {
            break;
         } else {
            continue;
         }

      }

      intPort1 = i * prin1;
      accumInt1 = Number(accumInt1) + Number(intPort1);
      prinPort1 = prin1;
      count1 = count1 + 1
      prin1 = Number(prin1) - Number(prinPort1);

      while((prin2 * (Number(i) + Number(1))) >= pmt1) {

         intPort2 = Number(i * prin2);
         accumInt2 = Number(accumInt2) + Number(intPort2);
         prinPort2 = Number(pmt1 - intPort2);
         prin2 = Number(prin2 - prinPort2);
         count2 = count2 + 1
         if(count2 == 1) {
            prin2 = Number(prin2) - Number(prinAdd);
         }
         if(count2 > 600) {
            break;
         } else {
            continue;
         }

      }

      intPort2 = Number(i * prin2);
      accumInt2 = Number(accumInt2) + Number(intPort2);
      prinPort2 = prin2;
      count2 = count2 + 1
      prin2 = Number(prin2 - prinPort2);

      var VoldNPR = count1;
      document.calc.oldNPR.value = fns(VoldNPR,0,0,0,0);

      var VnewNPR = count2;
      document.calc.newNPR.value = fns(VnewNPR,0,0,0,0);

      var timSave = (count1 - count2);
      document.calc.timeSave.value = fns(timSave,0,0,0,0);

      var VoldIntCost = Number(accumInt1);
      document.calc.oldIntCost.value = fns(VoldIntCost,2,1,1,1);

      var VnewIntCost = Number(accumInt2);
      document.calc.newIntCost.value = fns(VnewIntCost,2,1,1,1);

      var VintSave = Number(accumInt1) - Number(accumInt2);
      document.calc.intSave.value =  fns(VintSave,2,1,1,1);

      var Vroi = 0;
      Vroi = (VintSave / (count2 / 12)) / prinAdd;
      document.calc.roi.value = fns(display_rate,2,0,2,1);

      var yearSave = 0;

      if(timSave / 12 < 1) {
         yearSave = 0;
      } else {
         yearSave = timSave / 12;
      }

      var timeSaveText = "";

      if(timSave > 11) {
         timeSaveText += "And that's not even considering the emotional returns you'll get when you ";
         timeSaveText += "pay off this debt " + timSave + "-months (" + fns(yearSave,0,0,0,0) + " years";
         timeSaveText += ", " + (timSave %12) + " months) ahead of schedule!";
      } else
      if(timSave > 0) {
         timeSaveText += "And that's not even considering the emotional returns you'll get when you ";
         timeSaveText += "pay off this debt " + timSave + "-months ahead of schedule!";
      }

      var v_results = "";
      v_results += "If you add " + fns(VpmtAdd,2,1,1,1) + " to your next scheduled ";
      v_results += "payment, you will save " + fns(VintSave,2,1,1,1) + " in interest charges ";
      v_results += "over the life of your loan. This savings translates into a guaranteed, ";
      v_results += "tax-free, average annual return ";
      v_results += "of " + fns(display_rate,2,0,2,1) + ". " + timeSaveText + "";

      var v_result_cell = document.getElementById("results");
      v_result_cell.innerHTML = "<font face='arial'><small>" + v_results + "</small></font>";

   }

}

function clear_results(form) {

   var v_result_cell = document.getElementById("results");
   v_result_cell.innerHTML = " ";

   document.calc.oldNPR.value = "";
   document.calc.newNPR.value = "";
   document.calc.timeSave.value = "";
   document.calc.oldIntCost.value = "";
   document.calc.newIntCost.value = "";
   document.calc.intSave.value =  "";
   document.calc.roi.value = "";

}

function reset_calc(form) {

   var v_result_cell = document.getElementById("results");
   v_result_cell.innerHTML = "";

   document.calc.reset();

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
<br><h4 align="center">Debt Repayment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Balance Owed:
</td>
<td align="center">
<input type="text" name="principal" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (APR):
</td>
<td align="center">
<input type="text" name="interest" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Regular Monthly Payment (Principal/ Interest Only):
</td>
<td align="center">
<input type="text" name="origPmt" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
One-time Lump Sum Addition To Next Payment:
</td>
<td align="center">
<input type="text" name="pmtAdd" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Debt Repayment" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Current Payoff Term (Months):
</td>
<td align="center">
<input type="text" name="oldNPR" size="12">
</td>
</tr>
<tr>
<td>
New Payoff Term (Months):
</td>
<td align="center">
<input type="text" name="newNPR" size="12">
</td>
</tr>
<tr>
<td>
Time Saved (Months):
</td>
<td align="center">
<input type="text" name="timeSave" size="12">
</td>
</tr>
<tr>
<td>
Original Interest Cost:
</td>
<td align="center">
<input type="text" name="oldIntCost" size="12">
</td>
</tr>
<tr>
<td>
Reduced Interest Cost:
</td>
<td align="center">
<input type="text" name="newIntCost" size="12">
</td>
</tr>
<tr>
<td>
Total Interest Savings:
</td>
<td align="center">
<input type="text" name="intSave" size="12">
</td>
</tr>
<tr>
<td>
Return On Investment For One-Time Repayment:
</td>
<td align="center">
<input type="text" name="roi" size="12">
</td>
</tr>
<tr>
<td colspan="2" id="results">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
