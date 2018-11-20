
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Capital Gains Tax Calculator & Real Estate 1031 Exchange</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Capital Gains Tax Calculator - Real Estate 1031 Exchange
//ALL RIGHTS RESERVED
//Created: 11/16/2004
//Last Modified: 11/03/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-138-1256
//Commercial Licence Date:2012-02-07
//*******************************************



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


function computeForm(form) {

   var Vpurchase = sn(document.calc.purchase.value);
   var Vsale_price = sn(document.calc.sale_price.value);
   var Vfed_rate = sn(document.calc.fed_rate.value);
   var Vstate_rate = sn(document.calc.state_rate.value);

   if(Vpurchase == 0) {
      alert("Please enter the original purchase price of the property.");
      document.calc.purchase.focus();
   } else
   if(Vsale_price == 0) {
      alert("Please enter the selling price of the property.");
      document.calc.sale_price.focus();
   } else
   if(Vfed_rate == 0) {
      alert("Please enter the federal capital gain tax rate percentage.");
      document.calc.fed_rate.focus();
   } else
   if(Vstate_rate == 0) {
      alert("Please enter the state capital gain tax rate percentage.");
      document.calc.state_rate.focus();
   } else {


      var Vimprove = sn(document.calc.improve.value);
      var Vdeprec = sn(document.calc.deprec.value);
      var Vexpenses = sn(document.calc.expenses.value);
      var Vloan_bal = sn(document.calc.loan_bal.value);

      var Vnab = Number(Vpurchase) + Number(Vimprove) - Number(Vdeprec);
      document.calc.nab.value = fns(Vnab,2,1,1,1);

      Vcap_gain = Number(Vsale_price) - Number(Vnab) - Number(Vexpenses);
      document.calc.cap_gain.value = fns(Vcap_gain,2,1,1,1);

      Vrecap = Vdeprec * .25;
      document.calc.recap.value = fns(Vrecap,2,1,1,1);

      if(Vfed_rate >= 1) {
         Vfed_rate /= 100;
      }
      Vfed_tax = (Number(Vcap_gain) - Number(Vdeprec)) * Vfed_rate;
      document.calc.fed_tax.value = fns(Vfed_tax,2,1,1,1);

      if(Vstate_rate >= 1) {
         Vstate_rate /= 100;
      }
      Vstate_tax = Vcap_gain * Vstate_rate;
      document.calc.state_tax.value = fns(Vstate_tax,2,1,1,1);

      Vtotal_tax = Number(Vrecap) + Number(Vfed_tax) + Number(Vstate_tax);
      document.calc.total_tax.value = fns(Vtotal_tax,2,1,1,1);

      Vgross = Number(Vsale_price) - Number(Vexpenses) - Number(Vloan_bal);
      document.calc.gross.value = fns(Vgross,2,1,1,1);

      Vnet = Number(Vgross) - Number(Vtotal_tax);
      document.calc.net.value = fns(Vnet,2,1,1,1);

      Vsale_equity = Vnet * 4;
      document.calc.sale_equity.value = fns(Vsale_equity,2,1,1,1);

      Vexchange_equity = Vgross * 4;
      document.calc.exchange_equity.value = fns(Vexchange_equity,2,1,1,1);

      jQuery('.email-my-results').removeClass('hidden');
   }
}

function clear_results(form) {

   document.calc.nab.value = "";
   document.calc.cap_gain.value = "";
   document.calc.recap.value = "";
   document.calc.fed_tax.value = "";
   document.calc.state_tax.value = "";
   document.calc.total_tax.value = "";
   document.calc.gross.value = "";
   document.calc.net.value = "";
   document.calc.sale_equity.value = "";
   document.calc.exchange_equity.value = "";

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
<td colspan="3">
<br><h4 align="center">Capital Gains Tax Calculator &amp; Real Estate 1031 Exchange</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Original purchase price ($):
</td>
<td align="center">
<input type="text" name="purchase" size="15" maxlength="25" value="1000000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Capital improvements ($):
</td>
<td align="center">
<input type="text" name="improve" size="15" maxlength="25" value="100000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Accumulated depreciation ($):
</td>
<td align="center">
<input type="text" name="deprec" size="15" maxlength="25" value="50000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Sales price:
</td>
<td align="center">
<input type="text" name="sale_price" size="15" maxlength="25" value="1250000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Deductible closing costs ($):
</td>
<td align="center">
<input type="text" name="expenses" size="15" maxlength="25" value="10000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Federal capital gains rate (%):
</td>
<td align="center">
<input type="text" name="fed_rate" size="15" maxlength="25" value="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
State capital gains rate (%):
</td>
<td align="center">
<input type="text" name="state_rate" size="15" maxlength="25" value="8" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Mortgage loan balances at sale ($):
</td>
<td align="center">
<input type="text" name="loan_bal" size="15" maxlength="25" value="500000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="3">
<b>
Results
</b>
</td>
</tr>
<tr>
<td>
Net adjusted basis:
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="nab" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Capital gain:
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="cap_gain" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Depreciation recapture (25%):
</td>
<td align="center">
<input type="text" name="recap" size="15" maxlength="25">
</td>
<td align="center"> </td>
</tr>
<tr>
<td>
Federal capital gains tax:
</td>
<td align="center">
<input type="text" name="fed_tax" size="15" maxlength="25">
</td>
<td align="center"> </td>
</tr>
<tr>
<td>
State capital gains tax:
</td>
<td align="center">
<input type="text" name="state_tax" size="15" maxlength="25">
</td>
<td align="center"> </td>
</tr>
<tr>
<td>
Total taxes due:
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="total_tax" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Gross equity:
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="gross" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
After-tax equity:
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="net" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Sale reinvestment (after-tax equity X 4):
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="sale_equity" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Exchange reinvestment (gross equity X 4):
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="exchange_equity" size="15" maxlength="25">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
