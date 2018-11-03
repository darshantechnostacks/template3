
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Savings Account Calculator - How Long To Reach My Goal</title>

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

function computeForm(form)  {

   if(document.calc.goal.value.length == 0) {
      alert("Please enter your savings goal.");
      document.calc.goal.focus();
   } else 
   if(document.calc.moAdd.value.length == 0) {
      alert("Please enter the Monthly Addition.");
      document.calc.moAdd.focus();
   } else
   if(document.calc.interest.value.length == 0) {
      alert("Please enter the Annual Interest Rate.");
      document.calc.interest.focus();
   } else {
  

      var i = sn(document.calc.interest.value);

      if (i >= 1.0) {
         i /= 100;
         } 
      i /= 12;

      var ma = sn(document.calc.moAdd.value);
 
      var prin = sn(document.calc.principal.value);
      var Vgoal = sn(document.calc.goal.value);
      var VmoAdd = sn(document.calc.moAdd.value);
      var count = 0;

      while(prin < Vgoal) {
         prin += VmoAdd;
         prin = (prin * i) + Number(prin);
         count = count + 1;
         if(count > 1200) {
            alert("It will take you more than 100 years to reach your goal");
            break;
         } else {
            continue;
         }
      }


      if(count >1200) {
         document.calc.months.value = "1200+";
         document.calc.years.value = "100+";
      } else {
         document.calc.months.value = count;
         document.calc.years.value = fn(count/12,2,1);
      }
      jQuery('.email-my-results').removeClass('hidden');

   }

}


function clear_results(form) {

   document.calc.months.value = "";
   document.calc.years.value = "";

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
<br><h4 align="center">Savings Account Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Current Savings Account Balance:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Savings Goal:
</td>
<td align="center">
<input type="text" name="goal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Monthly Savings Deposit:
</td>
<td align="center">
<input type="text" name="moAdd" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (ROI):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Time To Reach Savings Goal" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
# Months To Reach Savings Goal:
</td>
<td align="center">
<input type="text" name="months" size="15">
</td>
</tr>
<tr>
<td>
# Years To Reach Savings Goal:
</td>
<td align="center">
<input type="text" name="years" size="15">
</td>

</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>