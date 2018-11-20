
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Loan Interest Calculator</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Loan Interest Calculator
//ALL RIGHTS RESERVED
//Created: 12/04/2007
//Last Modified: 11/15/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-153-1256
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

   var v_prin = sn(document.calc.principal.value);
   var r = sn(document.calc.interest.value);
   var v_pmt = sn(document.calc.payment.value);

   if(v_prin == 0) {
      alert("Please enter the balance on your credit card.");
      document.calc.principal.focus();
   } else
   if(r == 0) {
      alert("Please enter the credit card's annual interest rate.");
      document.calc.interest.focus();
   } else
   if(v_pmt == 0) {
      alert("Please enter the amount you are currently paying per month.");
      document.calc.payment.focus();
   } else {


      if (r >= 1.0) {
         r = r / 100.0;
      }
      r /= 12;

      var v_int_port = Math.round(v_prin * r * 100) / 100;
      document.calc.int_port.value = fns(v_int_port,2,1,1,1);

      var alert_txt = "";

      if(v_int_port > v_pmt) {
         alert_txt += "The payment amount you entered is not large enough to cover ";
         alert_txt += "the " + fns(v_int_port,2,1,1,1) + " in interest charges ";
         alert_txt += "for the current period. Please increase the payment to more ";
         alert_txt += "than " + fns(v_int_port,2,1,1,1) + " and recalculate.";
         alert(alert_txt);
         clear_results(form);

      } else {

         var v_prin_port = Number(v_pmt) - Number(v_int_port);
         document.calc.prin_port.value = fns(v_prin_port,2,1,1,1);

         var cnt = 0;
         var acc_int = 0;

         var ck_num_pmts = 0;

         while(v_prin > 0) {

            v_int_port = Math.round(r * v_prin * 100) / 100;
            v_prin_port = Number(v_pmt) - Number(v_int_port);
            v_prin = Number(v_prin) - Number(v_prin_port);
            acc_int = Number(acc_int) + Number(v_int_port);
            cnt = Number(cnt) + Number(1);
            if(cnt > 600) {
               ck_num_pmts = 1;
               alert("Number of payments exceeds 600.  Please increase the payment amount and recalculate.");
               break;
            } else {
               continue;
            }
         }


         if(ck_num_pmts == 1) {
            clear_results(form);
         } else {
            document.calc.tot_int.value = fns(acc_int,2,1,1,1);
            document.calc.months.value = cnt;
            var v_years = cnt / 12;
            document.calc.years.value = fns(v_years,1,0,0,0);
         }

      }
      jQuery('.email-my-results').removeClass('hidden');
   }
}


function clear_results(form) {


   document.calc.int_port.value = "";
   document.calc.prin_port.value = "";
   document.calc.tot_int.value = "";
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
<br><h4 align="center">Loan Interest Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Loan Balance Owed:
</td>
<td align="center">
<input type="text" name="principal" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Annual Interest Rate (APR):
</td>
<td align="center">
<input type="text" name="interest" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Monthly Payment Amount:
</td>
<td align="center">
<input type="text" name="payment" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Interest On Loan" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Amount of Next Payment Applied to Principal:
</td>
<td align="center">
<input type="text" name="prin_port" size="15">
</td>
</tr>
<tr>
<td>
Amount of Next Payment Applied To Interest:
</td>
<td align="center">
<input type="text" name="int_port" size="15">
</td>
</tr>
<tr>
<td>
Total Interest Cost Until Loan Payoff:
</td>
<td align="center">
<input type="text" name="tot_int" size="15">
</td>
</tr>
<tr>
<td>
Number of Monthly Payments Until Loan Payoff:
</td>
<td align="center">
<input type="text" name="months" size="15">
</td>
</tr>
<tr>
<td>
Total Years Until Loan Payoff:
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
