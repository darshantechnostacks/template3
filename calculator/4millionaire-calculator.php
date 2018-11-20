
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Millionaire Calculator - How To Retire With A Million Dollars</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>

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

   if(document.calc.interest.value.length == 0) {
      alert("Please enter the Interest Rate.");
      document.calc.interest.focus();
   } else 
   if(document.calc.moAdd.value.length == 0) {
      alert("Please enter the Monthly Addition.");
      document.calc.moAdd.focus();
   } else
   if(document.calc.inflateRate.value.length == 0) {
      alert("Please enter the expected annual inflation rate.");
      document.calc.inflateRate.focus();
   } else {
  
  
      var ma = sn(document.calc.moAdd.value);
      var Vprincipal = sn(document.calc.principal.value);
      var prin = Vprincipal;

      var i = sn(document.calc.interest.value);
      if (i >= 1.0) {
         i = i / 100
      }


      var VdepPerYr = document.calc.interval.options[document.calc.interval.selectedIndex].value;

      i /= VdepPerYr;

      var count = 0;

      while(prin < 1000000) {
         prin = (prin * i) + Number(prin + ma);
         count = Number(count) + Number(1);
      }

      var Vyears =  Math.round(count / VdepPerYr);
      document.calc.years.value = fn(Vyears,1,0);

      var VinflateRate = sn(document.calc.inflateRate.value);

      Vfv = deflatePV(1000000,VinflateRate,Vyears);

      document.calc.fv.value = "$" + fn(Vfv,2,1);

      jQuery('.email-my-results').removeClass('hidden');

   }

}


function clear_results(form) {

   document.calc.years.value = "";
   document.calc.fv.value = "";

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
<br><h4 align="center">Millionaire Calculator
</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter the initial investment (optional):
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter the <select name="interval" size="1" onchange="clear_results(this.form)">
<option value="12">Monthly</option>
<option value="52">Weekly</option>
<option value="4">Quarterly</option>
<option value="1">Annual</option>
</select> deposit amount:
</td>
<td align="center">
<input type="text" name="moAdd" size="15" onkeyup="clear_results(this.form)"></td>
</tr>
<tr>
<td>
Enter the annual interest rate you expect to earn (%):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)"></td>
</tr>
<tr>
<td>
Enter average annual inflation rate (%):
</td>
<td align="center">
<input type="text" name="inflateRate" size="15" onkeyup="clear_results(this.form)"></td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Number of years till your savings reaches $1 million:
</td>
<td align="center">
<input type="text" name="years" size="15"></td>
</tr>
<tr>
<td>
What $1 million will be worth in today's dollars:
</td>
<td align="center">
<input type="text" name="fv" size="15"></td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>