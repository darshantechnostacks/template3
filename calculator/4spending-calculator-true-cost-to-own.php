
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Spending Calculator - True Cost To Own</title>

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

   if(document.calc.principal.value == "" || document.calc.principal.value == 0) {
      alert("Please enter the dollar amount of a purhcase you are contemplating.");
      document.calc.principal.focus();
   } else
   if(document.calc.interest.value == "" || document.calc.interest.value == 0) {
      alert("Please enter the annual interest rate you would expect to earn if you invested the money rather than spend it.");
      document.calc.interest.focus();
   } else
   if(document.calc.payments.value == "" || document.calc.payments.value == 0) {
      alert("Please enter the number of years you would allow your investment to grow.");
      document.calc.payments.focus();
   } else {


      var i = sn(document.calc.interest.value);
      i = i / 100.0;
      i /= 12;


      var pow = sn(document.calc.principal.value);
      var displayPrin = sn(document.calc.principal.value);

      var Vpayments = sn(document.calc.payments.value );
    
      for (var j = 0; j < Vpayments*12; j++) {

         pow = (pow * i) + (pow *1);
      }

      var Vfv = pow;

      document.calc.fv.value = "$" + fn(pow,2,1);

      var Vtotalint = Number(Vfv) - Number(displayPrin);

      document.calc.totalint.value = "$" + fn(Vtotalint,2,1);

      var v_summary = "If you spend $" + fn(displayPrin,2,1) + " on an unnecessary ";
      v_summary += "product or service, and you could otherwise invest that money ";
      v_summary += "for " + Vpayments + " years, then spending ";
      v_summary += "the $" + fn(displayPrin,2,1) + " could cost ";
      v_summary += "you $"  + fn(Vtotalint,2,1) + " in forgone interest earnings. ";
      v_summary += "This would bring the real price-tag of what you are spending your ";
      v_summary += "money on to $" + fn(pow,2,1) + ". So the question you ";
      v_summary += "should ask yourself is: Is what I am spending my money on ";
      v_summary += "worth $" + fn(pow,2,1) + "?";

      var v_sum_cell = document.getElementById("summary");
      v_sum_cell.innerHTML = "<font face='arial'><small>" + v_summary + "</small></font>";
      
      jQuery('.email-my-results').removeClass('hidden');
   }

}

function clear_results(form) {

   var v_sum_cell = document.getElementById("summary");
   v_sum_cell.innerHTML = " ";

   document.calc.fv.value = "";
   document.calc.totalint.value = "";


}

function reset_calc(form) {

   var v_sum_cell = document.getElementById("summary");
   v_sum_cell.innerHTML = " ";


   document.calc.interest.value = "";
   document.calc.principal.value = "";
   document.calc.principal.value = "";
   document.calc.payments.value = "";

   document.calc.fv.value = "";
   document.calc.totalint.value = "";


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
<br><h4 align="center">Spending Calculator – True Cost To Own
</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter the dollar amount of an unnecessary, non-investment type expenditure you are contemplating:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr><tr>
<td>
Enter the annual interest rate (%) you feel you could earn if you were to invest the money rather than spend it:
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr><tr>
<td>
Enter the number of years remaining in your lifetime ( or number of years until retirement, if applicable):
</td>
<td align="center">
<input type="text" name="payments" size="15" onkeyup="clear_results(this.form)">
</td>
</tr><tr>
<td align="center" colspan="2">
<input type="button" value="Calculate True Cost To Spend" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Forgone interest earnings:
</td>
<td align="center">
<input type="text" name="totalint" size="15">
</td>
</tr><tr>
<td>
Real cost of expenditure:
</td>
<td align="center">
<input type="text" name="fv" size="15">
</td>
</tr><tr>
<td colspan="2" id="summary">
</td>
</tr></tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>