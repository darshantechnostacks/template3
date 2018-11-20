
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Savings Goal Calculator - How Much Should I Save Each Month?</title>

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

   if(document.calc.downPay.value == "" || document.calc.downPay.value == 0) {
      alert("Please enter an amount in Line #1.");
      document.calc.downPay.focus();
   } else
      if(document.calc.intRate.value == "" || document.calc.intRate.value == 0) {
      alert("Please enter an amount in Line #3.");
      document.calc.intRate.focus();
   } else
      if(document.calc.numYears.value == "" || document.calc.numYears.value == 0) {
      alert("Please enter an amount in Line #4.");
      document.calc.numYears.focus();
   } else {

      var VdownPay = sn(document.calc.downPay.value);

      var VsaveBal = sn(document.calc.saveBal.value);

      var VnumYears = sn(document.calc.numYears.value);

      var intRate = sn(document.calc.intRate.value);

 
      intRate = intRate / 100.0;

      var factor1 = eval(intRate) + eval(1);

      var denom1 = 1;

      var count1 = 0;

      while(count1 < VnumYears) {
         denom1 = denom1 * factor1;
         count1 = eval(count1) + eval(1);
      }

      var VsaveFV = VsaveBal * denom1;

      document.calc.saveFV.value = "$" + fn(VsaveFV,2,1);

      var VsaveGap = eval(VdownPay) - eval(VsaveFV);

      document.calc.saveGap.value = "$" + fn(VsaveGap,2,1);

   
      var count2 = 0;

      var intRate2 = intRate / 12;

      var numMonths = VnumYears * 12;

      var factor2 = eval(1) + eval(intRate2);

      var denom2 = 1;
    
      while(count2 < numMonths) {
         denom2 = denom2 * factor2;
         count2 = eval(count2) + eval(1);
      }

      var Vpv = eval(denom2) - eval(1);

      Vpv = intRate2 / Vpv;

      Vpv = Vpv * VsaveGap;

      document.calc.moSave.value = "$" + fn(Vpv,2,1);

      jQuery('.email-my-results').removeClass('hidden');
   }
    
}



function help(num,txt) {

   var v_help_cell_1 = document.getElementById("help_1");
   var v_help_cell_2 = document.getElementById("help_2");

   if(num == 1) {
      v_help_cell_1.innerHTML = "<font face='arial'><small>" + txt + "</small></font>";
      v_help_cell_2.innerHTML = "";
   } else {
      v_help_cell_1.innerHTML = "";
      v_help_cell_2.innerHTML = "<font face='arial'><small>" + txt + "</small></font>";
   }
}

function clear_results(num) {

   var v_help_cell_1 = document.getElementById("help_1");
   var v_help_cell_2 = document.getElementById("help_2");

   if(num == 1) {
      v_help_cell_2.innerHTML = "";
   } else {
      v_help_cell_1.innerHTML = "";
   }

   document.calc.saveFV.value = "";
   document.calc.saveGap.value = "";
   document.calc.moSave.value = "";


}

function reset_calc(num) {

   document.calc.downPay.value = "";
   document.calc.saveBal.value = "";
   document.calc.numYears.value = "";
   document.calc.intRate.value = "";


   var v_help_cell_1 = document.getElementById("help_1");
   var v_help_cell_2 = document.getElementById("help_2");
   v_help_cell_1.innerHTML = "";
   v_help_cell_2.innerHTML = "";


   document.calc.saveFV.value = "";
   document.calc.saveGap.value = "";
   document.calc.moSave.value = "";


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
<br><h4 align="center">Savings Goal Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
1. Savings Goal
</td>
<td align="center">
<input type="text" name="downPay" size="15" onkeyup="clear_results(1)" onfocus="help(1,'Line #1: Enter the amount  your savings goal.')">
</td>
<td width="125" align="center">
<b>
Instructions
</b>
</td>
</tr>
<tr>
<td>
2. Current Savings Balance
</td>
<td align="center">
<input type="text" name="saveBal" size="15" onkeyup="clear_results(1)" onfocus="help(1,'Line #2: Enter the amount of money you already have saved that we can apply toward your future savings goal.')">
</td>
<td width="125" align="center" valign="top" rowspan="3">
<div width="120" id="help_1" align="left">
</div>
</td>
</tr>
<tr>
<td nowrap="">
3. Annual Percentage Rate Growth
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(1)" onfocus="help(1,'Line #3: Enter the annual percentage rate interest or return on investment (enter 7.5% as 7.5) that you expect your savings to grow at.')">
</td>
</tr>
<tr>
<td>
4. Number of Years
</td>
<td align="center">
<input type="text" name="numYears" size="15" onkeyup="clear_results(1)" onfocus="help(1,'Line #4: Enter the number of years between now and when you should achieve your savings goal.')">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Savings Goal" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
<td width="125" align="center">
<b>
Explanations
</b>
</td>
</tr>
<tr>
<td>
5. Current Savings Future Value
</td>
<td align="center">
<input type="text" name="saveFV" size="15" onfocus="help(2,'Line #5: This is the amount your current savings will grow to at the end of the specified number of years.')">
</td>
<td width="125" align="center" valign="top" rowspan="3">
<div width="120" id="help_2" align="left">
</div>
</td>
</tr>
<tr>
<td>
6. Savings Shortfall
</td>
<td align="center">
<input type="text" name="saveGap" size="15" onfocus="help(2,'Line #6: This is how much saving you are short from achieving your goal.')">
</td>
</tr>
<tr>
<td>
7. How Much To Save Each Month
</td>
<td align="center">
<input type="text" name="moSave" size="15" onfocus="help(2,'Line #7: This is how much money you will need to save every month to reach your future savings goal.')">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>