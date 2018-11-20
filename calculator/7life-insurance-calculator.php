
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Life Insurance Calculator - How Much Do I Need?</title>

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

   var VdeathCost = sn(document.calc.deathCost.value);
   var VavgAnnExp = sn(document.calc.avgAnnExp.value);
   var VspouseAge = sn(document.calc.spouseAge.value);

   if(VdeathCost == 0) {
      alert("Please enter an amount in the Funeral costs field.");
      document.calc.deathCost.focus();
   } else
   if(VavgAnnExp == 0) {
      alert("Please enter your survivor's expected average annual living expenses.");
      document.calc.avgAnnExp.focus();
   } else
   if(VspouseAge == 0) {
      alert("Please enter your spouse's current age.");
      document.calc.spouseAge.focus();
   } else {

      var VdebtAmt = sn(document.calc.debtAmt.value);
      var VemergFund = sn(document.calc.emergFund.value);
      var VcollegeFund = sn(document.calc.collegeFund.value);

      var VspouseIncome = sn(document.calc.spouseIncome.value);
      var VannSocSec = sn(document.calc.annSocSec.value);

      var VinvestStrategy = document.calc.investStrategy.selectedIndex;
      var VcurrentAssets = sn(document.calc.currentAssets.value);

      var VnetAnnExp = Number(VavgAnnExp) - Number(VspouseIncome) - Number(VannSocSec);

      var VyearsTill90 = (Number(90) - Number(VspouseAge)) / 5;
      VyearsTill90 = Math.round(VyearsTill90) * 5;

      if(VyearsTill90 < 25) {
         VyearsTill90 = 25;
      } else
      if(VyearsTill90 > 60) {
         VyearsTill90 = 60;
      }

      investFactor = new Array();
      investFactor[0] = new Array();
      investFactor[0][25] = 20;
      investFactor[0][30] = 22;
      investFactor[0][35] = 25;
      investFactor[0][40] = 27;
      investFactor[0][45] = 30;
      investFactor[0][50] = 31;
      investFactor[0][55] = 33;
      investFactor[0][60] = 35;

      investFactor[1] = new Array();
      investFactor[1][25] = 16;
      investFactor[1][30] = 17;
      investFactor[1][35] = 19;
      investFactor[1][40] = 20;
      investFactor[1][45] = 21;
      investFactor[1][50] = 21;
      investFactor[1][55] = 22;
      investFactor[1][60] = 23;

      var VinvRateFact = 0;
      //if(VinvestStrategy == 0) {
      //VinvRateFact = conserveFactor[VyearsTill90];
      //VinvRateFact = 22;
      //} else {
      //VinvRateFact = agressFactor[VyearsTill90];
      //VinvRateFact = 33;
      //}
      VinvRateFact = investFactor[VinvestStrategy][VyearsTill90];

      var VtotLivExp = VnetAnnExp * VinvRateFact;

      var VtotMoneyNeeds = Number(VdeathCost) + Number(VdebtAmt) + Number(VemergFund) + Number(VcollegeFund) + Number(VtotLivExp);

      VinsNeeds = Number(VtotMoneyNeeds) - Number(VcurrentAssets);

      document.calc.insNeeds.value = fns(VinsNeeds,2,1,1,1);
      //document.calc.insNeeds.value = VyearsTill90;

      jQuery('.email-my-results').removeClass('hidden');
   }
}

function clear_results(form) {

   document.calc.insNeeds.value = "";

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
<br><h4 align="center">Life Insurance Need Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Funeral cost, estate taxes, etc. ($):
</td>
<td align="center">
<input type="text" name="deathCost" size="15" maxlength="25" value="5000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Total Debt - Mortgage, cars, credit cards ($):
</td>
<td align="center">
<input type="text" name="debtAmt" size="15" maxlength="25" value="2500" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Amount needed for emergency fund ($):
</td>
<td align="center">
<input type="text" name="emergFund" size="15" maxlength="25" value="5000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Amount needed for college fund ($):
</td>
<td align="center">
<input type="text" name="collegeFund" size="15" maxlength="25" value="76800" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Estimated annual living expenses ($):
</td>
<td align="center">
<input type="text" name="avgAnnExp" size="15" maxlength="25" value="29000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Surviving spouse's after-tax annual income ($):
</td>
<td align="center">
<input type="text" name="spouseIncome" size="15" maxlength="25" value="22500" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Social Security Death Benefit Estimate ($):
</td>
<td align="center">
<input type="text" name="annSocSec" size="15" maxlength="25" value="5000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Surviving spouse's current age (#):
</td>
<td align="center">
<input type="text" name="spouseAge" size="15" maxlength="25" value="35" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Total current investments (stocks, bonds, cash):
</td>
<td align="center">
<input type="text" name="currentAssets" size="15" maxlength="25" value="10000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Expected survivor's investment strategy:
</td>
<td align="center">
<select name="investStrategy" size="1" onchange="clear_results(this.form)">
<option value="0">Conservative</option>
<option value="1">Aggressive</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Life Insurance Need" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Life insurance needs:
</td>
<td align="center">
<input type="text" name="insNeeds" size="15" maxlength="25">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
