
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Money Saving Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>
function FVmonDep(prin,intRate,monDep,numMonths) {

var i = 0;
var int = 0;

intRate /= 100;
intRate /= 12;

if(prin == "" || prin == 0) {
   prin = 0;
}

for(i=1; i <= numMonths; i++) {
   int = prin * intRate;
   prin = eval(prin) + eval(int);
   prin = eval(prin) + eval(monDep);
}

return prin;

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


function calcSave(form) {


   var VnowAge = sn(document.calc.nowAge.value);
   var VretireAge = sn(document.calc.retireAge.value);
   var VdieAge = sn(document.calc.dieAge.value);
   var VnameBrand = sn(document.calc.nameBrand.value);
   var Vgeneric = sn(document.calc.generic.value);
   var VbuyTimes = sn(document.calc.buyTimes.value);
   var VintRate = sn(document.calc.intRate.value);

   if(VnowAge == 0) {
      alert("Please enter your current age.");
      document.calc.nowAge.focus();
   } else
   if(VretireAge == 0) {
      alert("Please enter the age you expect to retire at.");
      document.calc.retireAge.focus();
   } else
   if(VdieAge == 0) {
      alert("Please enter the age you expect to live until.");
      document.calc.dieAge.focus();
   } else
   if(VnameBrand == 0) {
      alert("Please enter the price your are paying for a higher priced name brand item or service.");
      document.calc.nameBrand.focus();
   } else
   if(Vgeneric == 0) {
      alert("Please enter the price of a generic equivalent.");
      document.calc.generic.focus();
   } else
   if(VbuyTimes == 0) {
      alert("Please enter the number of time you purchase this item per month.");
      document.calc.buyTimes.focus();
   } else
   if(VintRate == 0) {
      alert("Please enter the annual interest rate you expect to earn.");
      document.calc.intRate.focus();
   } else {


      var yrsTillRetire = Number(VretireAge) - Number(VnowAge);

      var lifeYrs = Number(VdieAge) - Number(VnowAge);
      var retireYrs = Number(VdieAge) - Number(VretireAge);

      var feachSave = Number(VnameBrand) - Number(Vgeneric);

      var fmoSave = feachSave * VbuyTimes;

      document.calc.eachSave.value = fns(feachSave,2,1,1,1);
      document.calc.moSave.value = fns(fmoSave,2,1,1,1);
      var fannSave = fmoSave * 12;
      document.calc.annSave.value = fns(fannSave,2,1,1,1);
      document.calc.retireSave.value = fns(fannSave * retireYrs,2,1,1,1);
      document.calc.lifeSave.value = fns(fannSave * lifeYrs,2,1,1,1);

      var i = VintRate;
      i /= 100;
      i /= 12;

      var ma = fmoSave;

      var prin = feachSave;

      var pmts = ((Number(VretireAge) - Number(VnowAge)) * 12);

      var v_retire_save = FVmonDep(feachSave, VintRate, fmoSave, pmts);

      document.calc.retireInvest.value = fns(v_retire_save,2,1,1,1);

      var npr = (Number(VdieAge) - Number(VretireAge)) * 12;
    
      var pow = 1;

      for(var j = 0; j < npr; j++) {

         pow = pow * (1 + i);

      }

      var moPmt = (v_retire_save * pow * i) / (pow - 1);

      document.calc.moIncome.value = fns(moPmt,2,1,1,1);

      var totPmts = npr * moPmt;
    
      document.calc.dieInvest.value = fns(totPmts,2,1,1,1);

      var v_summary = "<strong>Summary:</strong>  If you were to permanently switch from ";
      v_summary += "the " + fns(VnameBrand,2,1,1,1) + " product to ";
      v_summary += "the " + fns(Vgeneric,2,1,1,1) + " product, and then invested ";
      v_summary += "the resulting monthly savings in an investment that ";
      v_summary += "earned " + fns(VintRate,2,0,2,1) + " per year, between now and ";
      v_summary += "age " + VretireAge + ", you would then be able to ";
      v_summary += "withdraw " + fns(moPmt,2,1,1,1) + " from your investment ";
      v_summary += "each month ... for the rest of your life!";

      var v_summary_cell = document.getElementById("summary");
      v_summary_cell.innerHTML = "<font face='arial'><small>" + v_summary + "</small></font>";

      jQuery('.email-my-results').removeClass('hidden');

   }

}

function clear_results(form) {

   document.calc.eachSave.value = "";
   document.calc.moSave.value = "";
   document.calc.annSave.value = "";
   document.calc.retireSave.value = "";
   document.calc.lifeSave.value = "";
   document.calc.retireInvest.value = "";
   document.calc.moIncome.value = "";
   document.calc.dieInvest.value = "";

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

}

function reset_calc(form) {

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   document.calc.reset();

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
<br><h4 align="center">Money Saving Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Your Current Age:
</td>
<td align="center">
<input type="text" name="nowAge" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Expected Retirement Age:
</td>
<td align="center">
<input type="text" name="retireAge" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Expected Lifespan:
</td>
<td align="center">
<input type="text" name="dieAge" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Price paid for a higher priced name-brand product:
</td>
<td align="center">
<input type="text" name="nameBrand" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Price for lower-cost functional equivalent (generic):
</td>
<td align="center">
<input type="text" name="generic" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Number times you purchase this item per month:
</td>
<td align="center">
<input type="text" name="buyTimes" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Expected return on investment for savings:
</td>
<td align="center">
<input type="text" name="intRate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Money Savings" onclick="calcSave(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Savings per purchase:
</td>
<td align="center">
<input type="text" name="eachSave" size="15">
</td>
</tr>
<tr>
<td>
Savings per month:
</td>
<td align="center">
<input type="text" name="moSave" size="15">
</td>
</tr>
<tr>
<td>
Savings per year:
</td>
<td align="center">
<input type="text" name="annSave" size="15">
</td>
</tr>
<tr>
<td>
Savings between now and retirement:
</td>
<td align="center">
<input type="text" name="retireSave" size="15">
</td>
</tr>
<tr>
<td>
Savings over expected lifetime:
</td>
<td align="center">
<input type="text" name="lifeSave" size="15">
</td>
</tr>
<tr>
<td>
How much your investment will be worth at retirement age:
</td>
<td align="center">
<input type="text" name="retireInvest" size="15">
</td>
</tr>
<tr>
<td>
How much you would be able to withdraw from your investment during each month of your expected retirement:
</td>
<td align="center">
<input type="text" name="moIncome" size="15">
</td>
</tr>
<tr>
<td>
Total future value of invested savings between now and your life expectancy:
</td>
<td align="center">
<input type="text" name="dieInvest" size="15">
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
                </main>
<?php include_once 'include/footer.php'; ?>