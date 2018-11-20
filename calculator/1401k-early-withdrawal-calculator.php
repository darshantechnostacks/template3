<!DOCTYPE html>
<html lang="en-US" >
<head>
<meta charset="UTF-8" />
<title>401(k) Early Withdrawal Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>

function FVsingleDep(prin, intRate, numMonths, numCompPerYr) {

var i = 0;
var intEarn = 0;
var singleFV = prin;

intRate /= 100;

if(numCompPerYr == "" || numCompPerYr == 0) {
   numCompPerYr = 12;
}
intRate /= numCompPerYr;

var numPeriods = numMonths / 12 * numCompPerYr;

singleFV = Math.pow((eval(1) + eval(intRate)), numPeriods) * singleFV;

return singleFV;

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

      if(document.calc.balance.value.length == 0 || document.calc.balance.value == 0) {
         alert("Please enter the balance of your plan.");
         document.calc.balance.focus();
      } else 
      if(document.calc.cur_age.value.length == 0 || document.calc.cur_age.value == 0) {
         alert("Please enter your current age.");
        document.calc.cur_age.focus();
      } else
      if(document.calc.ret_age.value.length == 0 || document.calc.ret_age.value == 0) {
         alert("Please enter the age you expect to retire at.");
         document.calc.ret_age.focus();
      } else
      if(document.calc.fed_tax.value.length == 0 || document.calc.fed_tax.value == 0) {
         alert("Please enter your federal tax rate percentage.");
         document.calc.fed_tax.focus();
      } else
      if(document.calc.state_tax.value.length == 0) {
         alert("Please enter your state tax rate percentage. If none, enter 0 (zero).");
         document.calc.state_tax.focus();
      } else
      if(document.calc.roi.value.length == 0 || document.calc.roi.value == 0) {
         alert("Please enter expected annual rate of return.");
         document.calc.roi.focus();
      } else {

         var v_balance = sn(document.calc.balance.value);
         var v_cur_age = sn(document.calc.cur_age.value);
         var v_ret_age = sn(document.calc.ret_age.value);
         var v_fed_tax = sn(document.calc.fed_tax.value);
         var v_state_tax = sn(document.calc.state_tax.value);
         var v_roi = sn(document.calc.roi.value);

         if(v_cur_age > v_ret_age) {
            alert("Your retirement age must be greater than your current age.");
            document.calc.ret_age.focus();
         } else 
         if(v_state_tax > 12) {
            alert("Your state tax percentage must be less than 12%.");
            document.calc.state_tax.focus();
         } else {


            var v_sum_cur_pre_tp_val = v_balance;
            document.calc.sum_cur_pre_tp_val.value = "$" + fn(v_sum_cur_pre_tp_val,2,1);

            var v_rol_cur_pre_tp_val = v_balance;
            document.calc.rol_cur_pre_tp_val.value = "$" + fn(v_rol_cur_pre_tp_val,2,1);


            var v_sum_penalty = v_sum_cur_pre_tp_val * .10;
            document.calc.sum_penalty.value = "$" + fn(v_sum_penalty,2,1);

            var v_rol_penalty = 0;
            document.calc.rol_penalty.value = "$" + fn(v_rol_penalty,2,1);


            var v_tot_tax_rate = Number(v_fed_tax) + Number(v_state_tax);
            var v_tot_tax_perc = v_tot_tax_rate / 100;

            var v_sum_tax_paid = v_sum_cur_pre_tp_val * v_tot_tax_perc;
            document.calc.sum_tax_paid.value = "$" + fn(v_sum_tax_paid,2,1);

            var v_rol_tax_paid = 0;
            document.calc.rol_tax_paid.value = "$" + fn(v_rol_tax_paid,2,1);


            var v_sum_left_now = Number(v_sum_cur_pre_tp_val) - Number(v_sum_penalty) - Number(v_sum_tax_paid);
            document.calc.sum_left_now.value = "$" + fn(v_sum_left_now,2,1);

            var v_rol_left_now = Number(v_rol_cur_pre_tp_val);
            document.calc.rol_left_now.value = "$" + fn(v_rol_left_now,2,1);


            var v_ret_yrs = Number(v_ret_age) - Number(v_cur_age);
            var v_ret_months = v_ret_yrs * 12;
            var v_ret_rate = (Number(100) - Number(v_tot_tax_rate)) / 100 * v_roi;


            var v_sum_fv_bt = FVsingleDep(v_sum_left_now, v_ret_rate, v_ret_months, 1)
            document.calc.sum_fv_bt.value = "$" + fn(v_sum_fv_bt,2,1);

            var v_rol_fv_bt = FVsingleDep(v_rol_left_now, v_roi, v_ret_months, 1)
            document.calc.rol_fv_bt.value = "$" + fn(v_rol_fv_bt,2,1);


            var v_sum_fv_taxes = 0;
            document.calc.sum_fv_taxes.value = "$" + fn(v_sum_fv_taxes,2,1);

            var v_rol_fv_taxes = v_rol_fv_bt * v_tot_tax_perc;
            document.calc.rol_fv_taxes.value = "$" + fn(v_rol_fv_taxes,2,1);


            var v_sum_fv_net = v_sum_fv_bt;
            document.calc.sum_fv_net.value = "$" + fn(v_sum_fv_net,2,1);

            var v_rol_fv_net = Number(v_rol_fv_bt) - Number(v_rol_fv_taxes);
            document.calc.rol_fv_net.value = "$" + fn(v_rol_fv_net,2,1);

            jQuery('.email-my-results').removeClass('hidden');
         }


      }

}

function clear_results(form) {

   document.calc.sum_cur_pre_tp_val.value = "";
   document.calc.rol_cur_pre_tp_val.value = "";
   document.calc.sum_penalty.value = "";
   document.calc.rol_penalty.value = "";
   document.calc.sum_tax_paid.value = "";
   document.calc.rol_tax_paid.value = "";
   document.calc.sum_left_now.value = "";
   document.calc.rol_left_now.value = "";
   document.calc.sum_fv_bt.value = "";
   document.calc.rol_fv_bt.value = "";
   document.calc.sum_fv_taxes.value = "";
   document.calc.rol_fv_taxes.value = "";
   document.calc.sum_fv_net.value = "";
   document.calc.rol_fv_net.value = "";

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
<td colspan="3">
<br><h4 align="center">401(k) Early Withdrawal Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Current balance of your plan ($):
</td>
<td align="center">
<input type="text" name="balance" size="15" value="1000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Current age (#):
</td>
<td align="center">
<input type="text" name="cur_age" size="15" value="29" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Age you expect to retire (#):
</td>
<td align="center">
<input type="text" name="ret_age" size="15" value="65" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Federal income tax bracket (%):
</td>
<td align="center">
<input type="text" name="fed_tax" size="15" value="25" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
State income tax rate (%):
</td>
<td align="center">
<input type="text" name="state_tax" size="15" value="5" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Expected annual rate of return (%):
</td>
<td align="center">
<input type="text" name="roi" size="15" value="8" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Results

</td>
<td align="center">
<b>
Lump-Sum<br>Distribution
</b>
</td>
<td align="center">
<b>
Rollover<br>to<br>Tax-Deferred
</b>
</td>
</tr>
<tr>
<td>
Current value before taxes and penalties:
</td>
<td align="center">
<input type="text" name="sum_cur_pre_tp_val" size="15">
</td>
<td align="center">
<input type="text" name="rol_cur_pre_tp_val" size="15">
</td>
</tr>
<tr>
<td>
Penalties:
</td>
<td align="center">
<input type="text" name="sum_penalty" size="15">
</td>
<td align="center">
<input type="text" name="rol_penalty" size="15">
</td>
</tr>
<tr>
<td>
Income tax paid:
</td>
<td align="center">
<input type="text" name="sum_tax_paid" size="15">
</td>
<td align="center">
<input type="text" name="rol_tax_paid" size="15">
</td>
</tr>
<tr>
<td>
Total left now:
</td>
<td align="center">
<input type="text" name="sum_left_now" size="15">
</td>
<td align="center">
<input type="text" name="rol_left_now" size="15">
</td>
</tr>
<tr>
<td>
Future value before taxes:
</td>
<td align="center">
<input type="text" name="sum_fv_bt" size="15">
</td>
<td align="center">
<input type="text" name="rol_fv_bt" size="15">
</td>
</tr>
<tr>
<td>
Future taxes to be paid:
</td>
<td align="center">
<input type="text" name="sum_fv_taxes" size="15">
</td>
<td align="center">
<input type="text" name="rol_fv_taxes" size="15">
</td>
</tr>
<tr>
<td>
Future net available:
</td>
<td align="center">
<input type="text" name="sum_fv_net" size="15">
</td>
<td align="center">
<input type="text" name="rol_fv_net" size="15">
</td>
</tr>
</tbody>
</table>
</form>
                            
                        </div>
                    </div>
                     <br/><br/><br/><br/>
                     <br/><br/><br/><br/>
                </main>
               

<?php include_once 'include/footer.php'; ?>

            </div></div></div></body></html>