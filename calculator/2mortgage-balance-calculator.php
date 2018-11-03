
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Mortgage Balance Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>

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


function calc_balance(form) {

   var v_principal = sn(document.calc.principal.value);
   var v_interest = sn(document.calc.interest.value);
   var v_payment = sn(document.calc.payment.value);
   var v_years = sn(document.calc.years.value);

   if(v_principal == 0) {
      alert("Please enter the original mortgage amount.");
      document.calc.principal.focus();
   } else
   if(v_interest == 0) {
      alert("Please enter the mortgage's annual interest rate.");
      document.calc.interest.focus();
   } else
   if(v_years == 0) {
      alert("Please enter the mortgage's repayment term in number of years.");
      document.calc.years.focus();
   } else
   if(v_payment == 0) {
      alert("Please enter the mortgage's monthly payment amount.");
      document.calc.payment.focus();
   } else
   if(document.calc.monthStart.selectedIndex == 0 && document.calc.pmtsMade.value == "" && document.calc.pmtsLeft.value == "") {
      alert("Please either choose a first payment month and enter a year, or enter the number of payments made, or enter the number of payments remaining.");
      document.calc.monthStart.focus();
   } else
   if(document.calc.monthStart.selectedIndex > 0 && (document.calc.yearStart.value == "" || document.calc.yearStart.value.length < 4)) {
      alert("Please enter the 4-digit year the mortgage was originated.");
      document.calc.yearStart.focus();
   } else {

      var v_npr = v_years * 12;
      var v_pmts_made_in = sn(document.calc.pmtsMade.value);
      var v_pmts_left = sn(document.calc.pmtsLeft.value);
      var v_start_month = document.calc.monthStart.selectedIndex;
      var v_start_year = sn(document.calc.yearStart.value);

      var apr = v_interest;
      if(apr >= 1) {
         apr /= 100;
      }
      apr /= 12;

      var chk_pmt_int = v_principal * apr;


      if(chk_pmt_int > v_payment) {
         alert("The mortgage terms you entered are not valid. Please either lower the principal, lower the interest rate, or increase the payment amount, or a combination of all three.");
         document.calc.principal.focus();
      } else {

         var v_pmts_made = 0;

         if(document.calc.monthStart.selectedIndex > 0) {
            var now = new Date();
            var now_month = Number(now.getMonth()) + Number(1);
            var now_year = now.getFullYear();

            var tot_now_months = Number(now_year * 12) + Number(now_month);
            var tot_start_months = Number(v_start_year * 12) + Number(v_start_month);
            var v_pmts_made = Number(tot_now_months) - Number(tot_start_months);
         } else
         if(v_pmts_made_in > 0) {
            v_pmts_made = v_pmts_made_in;
         } else {
            v_pmts_made = Number(v_npr) - Number(v_pmts_left);
         }


         var prin = v_principal;
         var int_port = 0;
         var prin_port = 0;
         
         for(var i=0; i<v_pmts_made; i++) {
            int_port = Math.round(prin * apr * 100) / 100;
            prin_port = Number(v_payment) - Number(int_port);
            prin = Number(prin) - Number(prin_port);
         }

         document.calc.num_pmts_made.value = v_pmts_made;
         document.calc.balance.value = fns(prin,2,1,1,1);
      }
jQuery('.email-my-results').removeClass('hidden');
   }
}


function clear_results(form) {

document.calc.num_pmts_made.value = "";
document.calc.balance.value = "";

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
<br><h4 align="center">Mortgage Balance Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Original mortgage amount:
</td>
<td align="center">
<input type="text" name="principal" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual interest rate:
</td>
<td align="center">
<input type="text" name="interest" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Original term (# of years):
</td>
<td align="center">
<input type="text" name="years" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Monthly payment amount (principal and interest portion only):
</td>
<td align="center">
<input type="text" name="payment" size="15" value="" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
<strong>Option #1</strong> - Select month and enter the 4-digit year of first payment:
</td>
<td align="center">
<select name="monthStart" size="1" onchange="clear_results(this.form)">
<option value="0">Month</option>
<option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">May</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Aug</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>
<input type="text" name="yearStart" value="" size="6" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
<strong>Option #2</strong> - Number of payments made:
</td>
<td align="center">
<input type="text" name="pmtsMade" size="5" onkeyup="clear_results(this.form)">
</td></tr><tr>
<td>
<strong>Option #3</strong> - Number of payments remaining:
</td>
<td align="center">
<input type="text" name="pmtsLeft" size="5" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Remaining Mortgage Balance" onclick="calc_balance(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Number of mortgage payments made:
</td>
<td align="center">
<input type="text" name="num_pmts_made" size="15">
</td>
</tr>
<tr>
<td>
Estimated remaining mortgage balance:
</td>
<td align="center">
<input type="text" name="balance" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                           
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
