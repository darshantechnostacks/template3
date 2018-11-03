<!DOCTYPE html>
<html lang="en-US" >
<head>
<meta charset="UTF-8" />
<title>Roth IRA Calculator</title>

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



function computeAnnualPayment(prin, years, intRate) {

var pmtAmt = 0;

if(intRate == 0) {
   pmtAmt = prin / years;
} else {
   
   if (intRate >= 1.0) {
     intRate = intRate / 100.0;
   }

   var pow = 1;
   for (var j = 0; j < years; j++)
      pow = pow * (1 + intRate);

   pmtAmt = (prin * pow * intRate) / (pow - 1);

}

return pmtAmt;

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


function calc_conversion(form) {

   var v_now_age = sn(document.calc.now_age.value);
   var v_retire_age = sn(document.calc.retire_age.value);
   var v_retire_yrs = sn(document.calc.retire_yrs.value);
   var v_pre_ret_roi = sn(document.calc.pre_ret_roi.value);
   var v_post_ret_roi = sn(document.calc.post_ret_roi.value);
   var v_pre_ret_tax_rate = sn(document.calc.pre_ret_tax_rate.value);
   var v_post_ret_tax_rate = sn(document.calc.post_ret_tax_rate.value);
   var v_ira_bal_ded = sn(document.calc.ira_bal_ded.value);
   var v_ira_bal_non_ded = sn(document.calc.ira_bal_non_ded.value);
   var v_tax_paid_from = document.calc.tax_paid_from.selectedIndex;

   if(v_now_age == 0) {
      alert("Please enter your current age.");
      document.calc.now_age.focus();
   } else
   if(v_retire_age == 0) {
      alert("Please enter the age you expect to retire at.");
      document.calc.retire_age.focus();
   } else
   if(v_retire_yrs == 0) {
      alert("Please enter the number of years you would like to receive income from your investments during retirement.");
      document.calc.retire_yrs.focus();
   } else
   if(v_pre_ret_roi == 0) {
      alert("Please enter annual percentage return you expect to earn between now and retirement.");
      document.calc.pre_ret_roi.focus();
   } else
   if(v_post_ret_roi == 0) {
      alert("Please enter annual percentage return you expect to earn after retirement.");
      document.calc.post_ret_roi.focus();
   } else
   if(v_pre_ret_tax_rate == 0) {
      alert("Please enter your current federal tax bracket (10,15,25,28,33 or 35).");
      document.calc.pre_ret_tax_rate.focus();
   } else
   if(v_post_ret_tax_rate == 0) {
      alert("Please enter the federal tax bracket you expect to be in during retirement (10,15,25,28,33 or 35).");
      document.calc.post_ret_tax_rate.focus();
   } else
   if(v_ira_bal_ded == 0) {
      alert("Please enter the current amount of your Traditional IRA.");
      document.calc.ira_bal_ded.focus();
   } else {

      var v_trad_ded_port = Number(v_ira_bal_ded) - Number(v_ira_bal_non_ded);
      document.calc.trad_ded_port.value = fns(v_trad_ded_port,0,1,1,1);
      var v_roth_ded_port = 0;
      document.calc.roth_ded_port.value = "n/a";


      var v_trad_non_ded_port = v_ira_bal_non_ded;
      document.calc.trad_non_ded_port.value = fns(v_ira_bal_non_ded,0,1,1,1);
      var v_roth_non_ded_port = 0;
      document.calc.roth_non_ded_port.value = "n/a";

      var v_trad_con_amt = 0;
      document.calc.trad_con_amt.value = "n/a";
      var v_roth_con_amt = v_ira_bal_ded;
      document.calc.roth_con_amt.value = fns(v_ira_bal_ded,0,1,1,1);

      var v_con_tax_liab = v_pre_ret_tax_rate / 100 * v_trad_ded_port;

      var v_trad_con_tax_paid = 0;
      var v_roth_con_tax_paid = 0;
      var v_trad_side_acct_con = 0;
      var v_roth_side_acct_con = 0;


      if(v_tax_paid_from == 0) {

         v_trad_side_acct_con = v_con_tax_liab;
         document.calc.trad_side_acct_con.value = fns(v_con_tax_liab,0,1,1,1);

         v_roth_side_acct_con = 0;
         document.calc.roth_side_acct_con.value = "n/a";

         v_trad_con_tax_paid = 0;
         document.calc.trad_con_tax_paid.value = "n/a";

         v_roth_con_tax_paid = 0;
         document.calc.roth_con_tax_paid.value = "n/a";

      } else {

         v_trad_side_acct_con = 0;
         document.calc.trad_side_acct_con.value = "n/a";

         v_roth_side_acct_con = 0;
         document.calc.roth_side_acct_con.value = "n/a";

         v_trad_con_tax_paid = 0;
         document.calc.trad_con_tax_paid.value = "n/a";

         v_roth_con_tax_paid = v_con_tax_liab * -1;
         document.calc.roth_con_tax_paid.value = fns(v_roth_con_tax_paid,0,1,1,1);

      }

      var v_trad_compare_bal = Number(v_trad_ded_port) + Number(v_trad_non_ded_port) + Number(v_trad_con_amt) + Number(v_trad_con_tax_paid) + Number(v_trad_side_acct_con);
      document.calc.trad_compare_bal.value = fns(v_trad_compare_bal,0,1,1,1);

      var v_roth_compare_bal = Number(v_roth_ded_port) + Number(v_roth_non_ded_port) + Number(v_roth_con_amt) + Number(v_roth_con_tax_paid) + Number(v_roth_side_acct_con);
      document.calc.roth_compare_bal.value = fns(v_roth_compare_bal,0,1,1,1);


      //NUMBER OF YEARS/MONTHS TO ACCUMULATE EARNINGS
      var v_accum_yrs = Number(v_retire_age) - Number(v_now_age);
      var v_accum_months = v_accum_yrs * 12;



      //STANDARD IRA DEDUCTABLE BALANCE AT END OF ACCUMULATION PERIOD
      var v_trad_accum_ded_bal = FVsingleDep(v_trad_ded_port, v_pre_ret_roi, v_accum_months, 1);
      document.calc.trad_accum_ded_bal.value = fns(v_trad_accum_ded_bal,0,1,1,1);

      //ROTH IRA DEDUCTABLE BALANCE AT END OF ACCUMULATION PERIOD
      var v_roth_accum_ded_bal = 0;
      document.calc.roth_accum_ded_bal.value = "n/a";



      //STANDARD IRA NON-DEDUCTABLE BALANCE AT END OF ACCUMULATION PERIOD
      var v_trad_accum_non_ded_bal = FVsingleDep(v_trad_non_ded_port, v_pre_ret_roi, v_accum_months, 1);
      document.calc.trad_accum_non_ded_bal.value = fns(v_trad_accum_non_ded_bal,0,1,1,1);

      //ROTH IRA NON-DEDUCTABLE BALANCE AT END OF ACCUMULATION PERIOD
      var v_roth_accum_non_ded_bal = 0;
      document.calc.roth_accum_non_ded_bal.value = "n/a";


      //N/A - STANDARD SIDE OF ROTH IRA BALANCE AT END OF ACCUMULATION PERIOD
      var v_trad_accum_bal = 0;
      document.calc.trad_accum_bal.value = "n/a";

      //ROTH IRA BALANCE AT END OF ACCUMULATION PERIOD
      var v_roth_accum_bal = FVsingleDep(v_roth_compare_bal, v_pre_ret_roi, v_accum_months, 1);
      document.calc.roth_accum_bal.value = fns(v_roth_accum_bal,0,1,1,1);


      //PRE-RETIREMENT ROI ADJUSTED FOR TAX RATE
      var v_pre_ret_roi_adj = v_pre_ret_roi * (Number(1) - Number(v_pre_ret_tax_rate / 100));

      var v_trad_accum_side_bal = 0;
      var v_roth_accum_side_bal = 0;

      if(v_tax_paid_from == 0) {

         //ESTIMATE VALUE OF FORGONE INVESTMENT IF PAID TAX OUT OF NON-IRA FUNDS
         v_trad_accum_side_bal = FVsingleDep(v_trad_side_acct_con, v_pre_ret_roi_adj, v_accum_months, 1);
         document.calc.trad_accum_side_bal.value = fns(v_trad_accum_side_bal,0,1,1,1);

         document.calc.roth_accum_side_bal.value = "n/a";

      } else {

         document.calc.trad_accum_side_bal.value = "n/a";
         document.calc.roth_accum_side_bal.value = "n/a";

      }


      //ESTIMATED VALUE AT RETIREMENT (END OF ACCUMULATION STAGE)
      var v_trad_accum_end_bal = Number(v_trad_accum_ded_bal) + Number(v_trad_accum_non_ded_bal) + Number(v_trad_accum_side_bal) + Number(v_trad_accum_bal);
      document.calc.trad_accum_end_bal.value = fns(v_trad_accum_end_bal,0,1,1,1);

      var v_roth_accum_end_bal = Number(v_roth_accum_ded_bal) + Number(v_roth_accum_non_ded_bal) + Number(v_roth_accum_side_bal) + Number(v_roth_accum_bal);
      document.calc.roth_accum_end_bal.value = fns(v_roth_accum_end_bal,0,1,1,1);

      //POST RETIREMENT ROI ADJUSTED FOR POST-RETIREMENT TAX BRACKET
      var v_post_retire_at_roi = Number(1) - Number(v_post_ret_tax_rate / 100);

      //ANNUAL AFTER TAX INCOME FROM DEDUCTIBLE PORTION OF STANDARD IRA
      var v_trad_dist_ded_ann_inc_1 = computeAnnualPayment(v_trad_accum_ded_bal, v_retire_yrs, v_post_ret_roi);
      var v_trad_dist_ded_ann_inc_2 = v_trad_dist_ded_ann_inc_1 * v_post_retire_at_roi;
      var v_trad_dist_ded_ann_inc = v_trad_dist_ded_ann_inc_2;
      document.calc.trad_dist_ded_ann_inc.value = fns(v_trad_dist_ded_ann_inc,0,1,1,1);

      var v_roth_dist_ded_ann_inc = 0;
      document.calc.roth_dist_ded_ann_inc.value = "n/a";

      //ANNUAL AFTER TAX INCOME FROM NON-DEDUCTIBLE PORTION OF STANDARD IRA
      var v_trad_dist_non_ded_ann_inc_1 = computeAnnualPayment(v_trad_accum_non_ded_bal, v_retire_yrs, v_post_ret_roi);
      var v_trad_dist_non_ded_ann_inc_2 = (v_trad_dist_non_ded_ann_inc_1 * v_post_retire_at_roi) + (v_ira_bal_non_ded / v_retire_yrs * (v_post_ret_tax_rate / 100));
      var v_trad_dist_non_ded_ann_inc = v_trad_dist_non_ded_ann_inc_2;
      document.calc.trad_dist_non_ded_ann_inc.value = fns(v_trad_dist_non_ded_ann_inc,0,1,1,1);

      var v_roth_dist_non_ded_ann_inc = 0;
      document.calc.roth_dist_non_ded_ann_inc.value = "n/a";


      //ANNUAL AFTER TAX INCOME FROM FORGONE SIDE ACCOUNT OF STANDARD IRA
      var v_trad_dist_side_ann_inc = computeAnnualPayment(v_trad_accum_side_bal, v_retire_yrs, (v_post_ret_roi * v_post_retire_at_roi));
      document.calc.trad_dist_side_ann_inc.value = fns(v_trad_dist_side_ann_inc,0,1,1,1);

      var v_roth_dist_side_ann_inc = 0;
      document.calc.roth_dist_side_ann_inc.value = "n/a";


      //ANNUAL AFTER TAX INCOME FROM FORGONE SIDE ACCOUNT OF STANDARD IRA
      var v_trad_dist_ann_inc = 0;
      document.calc.trad_dist_ann_inc.value = "n/a";

      var v_roth_dist_ann_inc = computeAnnualPayment(v_roth_accum_end_bal, v_retire_yrs, v_post_ret_roi);
      document.calc.roth_dist_ann_inc.value = fns(v_roth_dist_ann_inc,0,1,1,1);


      //TOTAL ANNUAL AFTER TAX INCOME DURING RETIREMENT
      var v_trad_tot_ann_inc = Number(v_trad_dist_ded_ann_inc) + Number(v_trad_dist_non_ded_ann_inc) + Number(v_trad_dist_side_ann_inc) + Number(v_trad_dist_ann_inc);
      document.calc.trad_tot_ann_inc.value = fns(v_trad_tot_ann_inc,0,1,1,1);

      //TOTAL ANNUAL AFTER TAX INCOME DURING RETIREMENT
      var v_roth_tot_ann_inc = Number(v_roth_dist_ded_ann_inc) + Number(v_roth_dist_non_ded_ann_inc) + Number(v_roth_dist_side_ann_inc) + Number(v_roth_dist_ann_inc);
      document.calc.roth_tot_ann_inc.value = fns(v_roth_tot_ann_inc,0,1,1,1);


      //TOTAL MONTHLY AFTER TAX INCOME DURING RETIREMENT
      var v_trad_tot_mon_inc = v_trad_tot_ann_inc / 12;
      document.calc.trad_tot_mon_inc.value = fns(v_trad_tot_mon_inc,0,1,1,1);

      //TOTAL MONTHLY AFTER TAX INCOME DURING RETIREMENT
      var v_roth_tot_mon_inc = v_roth_tot_ann_inc / 12;
      document.calc.roth_tot_mon_inc.value = fns(v_roth_tot_mon_inc,0,1,1,1);
    jQuery('.email-my-results').removeClass('hidden');
   }
}

function clear_results(form) {

   document.calc.trad_ded_port.value = "";
   document.calc.roth_ded_port.value = "";
   document.calc.trad_non_ded_port.value = "";
   document.calc.roth_non_ded_port.value = "";
   document.calc.trad_con_amt.value = "";
   document.calc.roth_con_amt.value = "";
   document.calc.trad_side_acct_con.value = "";
   document.calc.roth_side_acct_con.value = "";
   document.calc.trad_con_tax_paid.value = "";
   document.calc.roth_con_tax_paid.value = "";
   document.calc.trad_compare_bal.value = "";
   document.calc.roth_compare_bal.value = "";
   document.calc.trad_accum_ded_bal.value = "";
   document.calc.roth_accum_ded_bal.value = "";
   document.calc.trad_accum_non_ded_bal.value = "";
   document.calc.roth_accum_non_ded_bal.value = "";
   document.calc.trad_accum_bal.value = "";
   document.calc.roth_accum_bal.value = "";
   document.calc.trad_accum_side_bal.value = "";
   document.calc.roth_accum_side_bal.value = "";
   document.calc.trad_accum_end_bal.value = "";
   document.calc.roth_accum_end_bal.value = "";
   document.calc.trad_dist_ded_ann_inc.value = "";
   document.calc.roth_dist_ded_ann_inc.value = "";
   document.calc.trad_dist_non_ded_ann_inc.value = "";
   document.calc.roth_dist_non_ded_ann_inc.value = "";
   document.calc.trad_dist_side_ann_inc.value = "";
   document.calc.roth_dist_side_ann_inc.value = "";
   document.calc.trad_dist_ann_inc.value = "";
   document.calc.roth_dist_ann_inc.value = "";
   document.calc.trad_tot_ann_inc.value = "";
   document.calc.roth_tot_ann_inc.value = "";
   document.calc.trad_tot_mon_inc.value = "";
   document.calc.roth_tot_mon_inc.value = "";


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
<br><h4 align="center">Roth IRA Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
Current age:
</td>
<td align="center">
<input type="text" name="now_age" size="15" maxlength="25" value="55" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Estimated retirement age:
</td>
<td align="center">
<input type="text" name="retire_age" size="15" maxlength="25" value="65" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Number of years to receive income from IRA:
</td>
<td align="center">
<input type="text" name="retire_yrs" size="15" maxlength="25" value="20" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Pre-retirement rate of return on investments (% before tax):
</td>
<td align="center">
<input type="text" name="pre_ret_roi" size="15" maxlength="25" value="8" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Post-retirement rate of return on investments (% before tax):
</td>
<td align="center">
<input type="text" name="post_ret_roi" size="15" maxlength="25" value="8" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Estimated federal income tax bracket (%):
</td>
<td align="center">
<input type="text" name="pre_ret_tax_rate" size="15" maxlength="25" value="25" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Estimated tax bracket during retirement (%):
</td>
<td align="center">
<input type="text" name="post_ret_tax_rate" size="15" maxlength="25" value="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Current IRA balance:
</td>
<td align="center">
<input type="text" name="ira_bal_ded" size="15" maxlength="25" value="25000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Non-deductible portion of current IRA balance:
</td>
<td align="center">
<input type="text" name="ira_bal_non_ded" size="15" maxlength="25" value="10000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
Conversion tax will be paid from:
</td>
<td align="center">
<select name="tax_paid_from" size="1" onchange="clear_results(this.form)">
<option value="0" selected="">non-IRA assets</option>
<option value="1">IRA proceeds</option>
</select>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" value="Calculate" onclick="calc_conversion(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><br>
</td>
</tr>
<tr>
<td>
<b>
At Conversion
</b>
</td>
<td align="center">
<b>
Traditional IRA
</b>
</td>
<td align="center">
&gt;<b>
Roth IRA
</b>
</td>
</tr>
<tr>
<td>
Current deductible portion of IRA:
</td>
<td align="center">
<input type="text" name="trad_ded_port" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_ded_port" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Non-deductible portion of current IRA:
</td>
<td align="center">
<input type="text" name="trad_non_ded_port" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_non_ded_port" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Forgone investment amount used to pay conversion tax:
</td>
<td align="center">
<input type="text" name="trad_side_acct_con" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_side_acct_con" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Conversion amount:
</td>
<td align="center">
<input type="text" name="trad_con_amt" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_con_amt" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Conversion tax paid from IRA:
</td>
<td align="center">
<input type="text" name="trad_con_tax_paid" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_con_tax_paid" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Comparison balance:
</td>
<td align="center">
<input type="text" name="trad_compare_bal" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_compare_bal" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
<b>
From Now Until Retirement Age
</b>
</td>
<td align="center">
<b>
Traditional IRA
</b>
</td>
<td align="center">
<b>
Roth IRA
</b>
</td>
</tr>
<tr>
<td>
Estimated deductible portion of balance:
</td>
<td align="center">
<input type="text" name="trad_accum_ded_bal" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_accum_ded_bal" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Estimated non-deductible portion of balance:
</td>
<td align="center">
<input type="text" name="trad_accum_non_ded_bal" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_accum_non_ded_bal" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Estimated of forgone investment value:
</td>
<td align="center">
<input type="text" name="trad_accum_side_bal" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_accum_side_bal" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Estimated Roth IRA balance:
</td>
<td align="center">
<input type="text" name="trad_accum_bal" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_accum_bal" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Estimated value at retirement:
</td>
<td align="center">
<input type="text" name="trad_accum_end_bal" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_accum_end_bal" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
<b>
During Retirement
</b>
</td>
<td align="center">
<b>
Traditional IRA
</b>
</td>
<td align="center">
<b>
Roth IRA
</b>
</td>
</tr>
<tr>
<td>
Annual after-tax income from deductible portion:
</td>
<td align="center">
<input type="text" name="trad_dist_ded_ann_inc" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_dist_ded_ann_inc" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Annual after-tax income from non-deductible portion:
</td>
<td align="center">
<input type="text" name="trad_dist_non_ded_ann_inc" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_dist_non_ded_ann_inc" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Annual forgone investment income:
</td>
<td align="center">
<input type="text" name="trad_dist_side_ann_inc" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_dist_side_ann_inc" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Annual Roth IRA income:
</td>
<td align="center">
<input type="text" name="trad_dist_ann_inc" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_dist_ann_inc" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
<b>
Comparison Totals
</b>
</td>
<td align="center">
<b>
Traditional IRA
</b>
</td>
<td align="center">
<b>
Roth IRA
</b>
</td>
</tr>
<tr>
<td>
Total annual after-tax income:
</td>
<td align="center">
<input type="text" name="trad_tot_ann_inc" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_tot_ann_inc" size="15" maxlength="25">
</td>
</tr>
<tr>
<td>
Total monthly after-tax income:
</td>
<td align="center">
<input type="text" name="trad_tot_mon_inc" size="15" maxlength="25">
</td>
<td align="center">
<input type="text" name="roth_tot_mon_inc" size="15" maxlength="25">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                    <br/><br/><br/><br/>
                </main>
<?php include_once 'include/footer.php'; ?>
</div></div></div></body></html>