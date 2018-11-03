<!DOCTYPE html>
<html lang="en-US" >
<head>
<meta charset="UTF-8" />
<title>The Easiest Way To Save For Retirement Calculator</title>

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

   if(document.calc.price.value == "" || document.calc.price.value == 0) {
      alert("Please enter the dollar amount of spent each time your purchase the good or service.");
      document.calc.price.focus();
   } else
   if(document.calc.every.value == "" || document.calc.every.value == 0) {
      alert("Please enter the number of times you make the purchase per selected period.");
      document.calc.every.focus();
   } else
   if(document.calc.interest.value == "" || document.calc.interest.value == 0) {
      alert("Please enter the annual interest rate you would expect to earn if you invested the money rather than spend it.");
      document.calc.interest.focus();
   } else
   if(document.calc.years.value == "" || document.calc.years.value == 0) {
      alert("Please enter the number of years you would like to calculate opportunity costs for.");
      document.calc.years.focus();
   } else {


      var i = sn(document.calc.interest.value);
      if (i >= 1.0) {
         i = i / 100.0;
      }
      i /= 12;


      var Vprice = sn(document.calc.price.value);
      var Vprin = 0;
      var Vevery = sn(document.calc.every.value);
      var Vperiods = document.calc.period.options[document.calc.period.selectedIndex].value;


      var displayPrin = sn(document.calc.price.value);
      var Vtotal_spent = 0;

      var Vyears = sn(document.calc.years.value );
      var Vmonths = Vyears * 12;
      var count = 1;

      var buys_per_month = 0;
      var spend_per_month = 0;

      if(Vperiods == "day") {
         buys_per_month = 30.4 / Vevery;
      } else
      if(Vperiods == "week") {
         buys_per_month = 52 / 12 / Vevery;
      } else
      if(Vperiods == "month") {
         buys_per_month = 1 / Vevery;
      } else
      if(Vperiods == "year") {
         buys_per_month = 1/(12 * Vevery);
      }

      var months_per_spend = 1;
      if(buys_per_month < 1) {
         months_per_spend = 1 / buys_per_month;
         spend_per_month = 0;
      } else {
         spend_per_month = buys_per_month * Vprice;
      }


      var no_spend = 0;

      while(count <= Vmonths) {

         count += 1;
         no_spend += 1;

         Vprin = Vprin * (1 + i);

         Vprin += spend_per_month;
         Vtotal_spent += spend_per_month;

         if(spend_per_month == 0 && no_spend >= months_per_spend) {
            no_spend = 0;
            Vprin += Vprice;
            Vtotal_spent += Vprice;
         }


      }
   


      document.calc.total_spent.value = "$" + fn(Vtotal_spent,2,1);

      var Vtotal_int = Number(Vprin) - Number(Vtotal_spent);
      document.calc.total_int.value = "$" + fn(Vtotal_int,2,1);

      document.calc.fv.value = "$" + fn(Vprin,2,1);

      var Vperiod_text = "";

      if(Vevery == 1) {
         Vperiod_text = Vperiods;
      } else {
         Vperiod_text = Vevery + " " + Vperiods + "s";
      }

      var v_summary = "If you spend $" + fn(Vprice,2,1) + " on an unnecessary product ";
      v_summary += "or service every " + Vperiod_text + ", over the course ";
      v_summary += "of " + Vyears + " years you will end up ";
      v_summary += "spending $" + fn(Vtotal_spent,2,1) + ". If you were to ";
      v_summary += "instead choose to invest ";
      v_summary += "the $" + fn(Vprice,2,1) + " every " + Vperiod_text + " rather ";
      v_summary += "than spend it on an unnecessary product or service, ";
      v_summary += "you could earn $" + fn(Vtotal_int,2,1) + " in interest. ";
      v_summary += "This would bring the real price-tag of what you are spending ";
      v_summary += "your money on to $" + fn(Vprin,2,1) + ". So the question ";
      v_summary += "you should ask yourself is this: Is what I am periodically ";
      v_summary += "spending my money on worth the $" + fn(Vtotal_int,2,1) + " interest ";
      v_summary += "earnings that I am passing up in the process?";


      var v_sum_cell = document.getElementById("summary");
      v_sum_cell.innerHTML = "<font face='arial'><small>" + v_summary + "</small></font>";
      
      jQuery('.email-my-results').removeClass('hidden');
   }

}

function clear_results(form) {

   var v_sum_cell = document.getElementById("summary");
   v_sum_cell.innerHTML = " ";

   document.calc.total_spent.value = "";
   document.calc.total_int.value = "";
   document.calc.fv.value = "";


}

function reset_calc(form) {

   var v_sum_cell = document.getElementById("summary");
   v_sum_cell.innerHTML = " ";

   document.calc.interest.value = "";
   document.calc.price.value = "";
   document.calc.every.value = "";
   document.calc.period.selectedIndex = 0;
   document.calc.years.value = "";

   document.calc.total_spent.value = "";
   document.calc.total_int.value = "";
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
<br><h4 align="center">The Easiest Way To Save For Retirement Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter the dollar amount of any unnecessary, periodic expenditure:
</td>
<td align="center">
<input type="text" name="price" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
How often do you normally make this expenditure?
</td>
<td align="center">
every
<input type="text" name="every" size="3" onkeyup="clear_results(this.form)">
<select name="period" size="1" onchange="clear_results(this.form)">
<option value="day">Day(s)</option>
<option value="week">Week(s)</option>
<option value="month">Month(s)</option>
<option value="year">Year(s)</option>
</select>
</td>
</tr>
<tr>
<td>
Enter the annual interest rate (%) you feel you could earn if you were to invest the money rather than spend it:
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter the number of years you would like to calculate the opportunity costs for:
</td>
<td align="center">
<input type="text" name="years" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Total dollars that will be spent:
</td>
<td align="center">
<input type="text" name="total_spent" size="15">
</td>
</tr>
<tr>
<td>
Forgone interest earnings:
</td>
<td align="center">
<input type="text" name="total_int" size="15">
</td>
</tr>
<tr>
<td>
Real cost of expenditure:
</td>
<td align="center">
<input type="text" name="fv" size="15">
</td>
</tr>
<tr>
<td colspan="2" id="summary">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                    <br/><br/><br/><br/><br/>
                </main>
<?php include_once 'include/footer.php'; ?>
            </div></div></div></body></html>