
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Present Value Calculator - NPV</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">




function PVsingleAmt(f_fv, f_rate, f_yrs, f_cpy) {

   var f_prin = f_fv;
   var f_i = f_rate;
   var f_npr = f_yrs * f_cpy;

   var f_count = 0;
   var f_factor = 1;
   
   f_i /= 100;
   f_i /= f_cpy;
   var f_pow = Number(1) + Number(f_i);


   while(f_count < f_npr) {


     f_factor = f_factor * f_pow;
     f_count += 1;

   }

   f_prin = f_fv / f_factor;
   return f_prin;

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

function computeForm(form) {

if(document.calc.fv.value.length == 0 || document.calc.fv.value == "0") {
   alert("Please enter the future value amount.");
   document.calc.fv.focus();
} else 
if(document.calc.rate.value.length == 0 || document.calc.rate.value == "0") {
   alert("Please enter the discount rate.");
   document.calc.rate.focus();
} else
if(document.calc.years.value.length == 0 || document.calc.years.value == "0") {
   alert("Please enter the number of years.");
   document.calc.years.focus();
} else {
  
   var Vfv = sn(document.calc.fv.value);
   var Vrate = sn(document.calc.rate.value);
   var Vyears = sn(document.calc.years.value);
   var Vcpy = document.calc.cpy.options[document.calc.cpy.selectedIndex].value;

   var Vpv = PVsingleAmt(Vfv, Vrate, Vyears, Vcpy);

   form.pv.value = "$" + fn(Vpv,2,1);
   jQuery('.email-my-results').removeClass('hidden');
}

}

function clearResults(form) {

   document.calc.pv.value = "";

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
<br><h4 align="center">Present Value Calculator – NPV</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Future Value ($):
</td>
<td align="center">
<input type="text" name="fv" size="15" onkeyup="clearResults(this.form)">
</td>
</tr>
<tr>
<td>
Discount / Inflation Rate (%):
</td>
<td align="center">
<input type="text" name="rate" size="15" onkeyup="clearResults(this.form)">
</td>
</tr>
<tr>
<td>
Number of Years:
</td>
<td align="center">
<input type="text" name="years" size="15" onkeyup="clearResults(this.form)">
</td>
</tr>
<tr>
<td>
Compound Interval:
</td>
<td align="center">
<select name="cpy" size="1" onchange="clearResults(this.form)">
<option value="365">Daily</option>
<option value="52">Weekly</option>
<option value="12">Monthly</option>
<option value="4">Quarterly</option>
<option value="1" selected="">Annually</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Present Value" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Present Value:
</td>
<td align="center">
<input type="text" name="pv" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
