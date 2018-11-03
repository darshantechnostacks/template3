
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Budget Calculator - Easy Household Budget Planner Tool</title>

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


function compute(form)  {

   var Vincome = sn(document.calc.income.value);

   if(Vincome == 0) {
      alert("Please enter an income amount.");
      document.calc.income.focus();
   } else {


      document.calc.char1.value = fns(Vincome * .10,2,1,1,1);
      document.calc.char2.value = fns(Vincome * .15,2,1,1,1);

      document.calc.savi1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.savi2.value = fns(Vincome * .10,2,1,1,1);

      document.calc.hous1.value = fns(Vincome * .25,2,1,1,1);
      document.calc.hous2.value = fns(Vincome * .35,2,1,1,1);

      document.calc.util1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.util2.value = fns(Vincome * .10,2,1,1,1);

      document.calc.food1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.food2.value = fns(Vincome * .15,2,1,1,1);

      document.calc.tran1.value = fns(Vincome * .10,2,1,1,1);
      document.calc.tran2.value = fns(Vincome * .15,2,1,1,1);

      document.calc.clot1.value = fns(Vincome * .02,2,1,1,1);
      document.calc.clot2.value = fns(Vincome * .07,2,1,1,1);

      document.calc.medi1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.medi2.value = fns(Vincome * .10,2,1,1,1);

      document.calc.pers1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.pers2.value = fns(Vincome * .10,2,1,1,1);

      document.calc.recr1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.recr2.value = fns(Vincome * .10,2,1,1,1);

      document.calc.debt1.value = fns(Vincome * .05,2,1,1,1);
      document.calc.debt2.value = fns(Vincome * .10,2,1,1,1);

      jQuery('.email-my-results').removeClass('hidden');
   }
} 

function clear_results(form)  {

   document.calc.char1.value = "";
   document.calc.char2.value = "";
   document.calc.savi1.value = "";
   document.calc.savi2.value = "";
   document.calc.hous1.value = "";
   document.calc.hous2.value = "";
   document.calc.util1.value = "";
   document.calc.util2.value = "";
   document.calc.food1.value = "";
   document.calc.food2.value = "";
   document.calc.tran1.value = "";
   document.calc.tran2.value = "";
   document.calc.clot1.value = "";
   document.calc.clot2.value = "";
   document.calc.medi1.value = "";
   document.calc.medi2.value = "";
   document.calc.pers1.value = "";
   document.calc.pers2.value = "";
   document.calc.recr1.value = "";
   document.calc.recr2.value = "";
   document.calc.debt1.value = "";
   document.calc.debt2.value = "";

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
<td colspan="4">
<br><h4 align="center">Budget Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr [row_input_color]="">
<td colspan="3">
Enter your net-income (annual or monthly):
</td>
<td align="center">
<input type="text" name="income" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="4">
<input type="button" value="Calculate Budget" onclick="compute(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td align="center">
<b>
Expense
</b>
</td>
<td align="center">
<b>
Range
</b>
</td>
<td align="center">
<b>
Low End
</b>
</td>
<td align="center">
<b>
High End
</b>
</td>
</tr>
<tr>
<td>
Pension &amp; Insurance
</td>
<td align="right">
10-15%
</td>
<td align="center"><input type="text" name="char1" size="12"></td>
<td align="center"><input type="text" name="char2" size="12"></td>
</tr>
<tr>
<td>
Miscellaneous
</td>
<td align="right">
5-10%
</td>
<td align="center"><input type="text" name="savi1" size="12"></td>
<td align="center"><input type="text" name="savi2" size="12"></td>
</tr>
<tr>
<td>
Housing
</td>
<td align="right">
25-35%
</td>
<td align="center"><input type="text" name="hous1" size="12"></td>
<td align="center"><input type="text" name="hous2" size="12"></td>
</tr>
<tr>
<td>
Utilities
</td>
<td align="right">
5-10%
</td>
<td align="center"><input type="text" name="util1" size="12"></td>
<td align="center"><input type="text" name="util2" size="12"></td>
</tr>
<tr>
<td>
Food
</td>
<td align="right">
5-15%
</td>
<td align="center"><input type="text" name="food1" size="12"></td>
<td align="center"><input type="text" name="food2" size="12"></td>
</tr>
<tr>
<td>
Transportation
</td>
<td align="right">
10-15%
</td>
<td align="center"><input type="text" name="tran1" size="12"></td>
<td align="center"><input type="text" name="tran2" size="12"></td>
</tr>
<tr>
<td>
Clothing
</td>
<td align="right">
2-7%
</td>
<td align="center"><input type="text" name="clot1" size="12"></td>
<td align="center"><input type="text" name="clot2" size="12"></td>
</tr>
<tr>
<td>
Medical/Health
</td>
<td align="right">
5-10%
</td>
<td align="center"><input type="text" name="medi1" size="12"></td>
<td align="center"><input type="text" name="medi2" size="12"></td>
</tr>
<tr>
<td>
Personal
</td>
<td align="right">
5-10%
</td>
<td align="center"><input type="text" name="pers1" size="12"></td>
<td align="center"><input type="text" name="pers2" size="12"></td>
</tr>
<tr>
<td>
Recreation
</td>
<td align="right">
5-10%
</td>
<td align="center"><input type="text" name="recr1" size="12"></td>
<td align="center"><input type="text" name="recr2" size="12"></td>
</tr>
<tr>
<td>
Debts
</td>
<td align="right">
5-10%
</td>
<td align="center"><input type="text" name="debt1" size="12"></td>
<td align="center"><input type="text" name="debt2" size="12"></td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
