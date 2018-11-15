
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Mortgage Payoff Calculator - Extra Payments</title>

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

function computeForm(form) {

   var v_principal = sn(document.calc.principal.value);
   var i = sn(document.calc.interest.value);
   v_noYears = sn(document.calc.noYears.value);
   v_origPmt = sn(document.calc.origPmt.value);

   var alert_txt = "";

   if(v_principal == 0) {
      alert("Please enter the principal balance of your current mortgage.");
      document.calc.principal.focus();
   } else
      if(i == 0) {
      alert("Please enter the interest rate of your current mortgage.");
      document.calc.interest.focus();
   } else
   if(v_origPmt == 0) {
      alert_txt = "Please enter your current monthly mortgage payment ";
      alert_txt += "(principal and interest portion only).";
      alert(alert_txt);
      document.calc.origPmt.focus();
   } else
   if(v_noYears == 0) {
      alert_txt = "Please enter the number of years you would ";
      alert_txt += "like to pay off your mortgage in.";
      alert(alert_txt);
      document.calc.noYears.focus();
   } else {

      if (i >= 1.0) {
        i = i / 100.0;
      }

      i /= 12;

      var noMonths = v_noYears * 12;

      var pow = 1;

      for (var j = 0; j < noMonths; j++) {

        pow = pow * (1 + i);

      }

      var newPmt = (v_principal * pow * i) / (pow - 1);

      if(newPmt <= v_origPmt) {
         alert_txt = "Given the terms you entered your mortgage is already scheduled ";
         alert_txt += "to be paid off in less than " + v_noYears + " years.";
         alert(alert_txt);
         return;

      } else {

         var v_pmtAdd = Number(newPmt) - Number(v_origPmt);

         document.calc.pmtAdd.value = fns(v_pmtAdd,2,1,1,1);

         var prin = sn(document.calc.principal.value);
         var count = 0;
         var prinPort = 0;
         var intPort = 0;
         var accumInt = 0;
         var pmt = sn(document.calc.origPmt.value);

         while(Number(prin) > Number(pmt)) {
            intPort = prin * i;
            accumInt = Number(accumInt) + Number(intPort)
            prinPort = Number(pmt) - Number(intPort);
            prin = Number(prin) - Number(prinPort);
            count = Number(count) + Number(1);

            if(count > 600) {
               alert_txt = "At the terms you entered your mortgage will never be paid off. Please ";
               alert_txt += "either decrease the principal or increase the monthly payment amount.";
               alert(alert_txt);
               clear_results(form);
               return;
               break;
            }
         }


         var v_origInt = accumInt;
         var v_newInt = (Number(newPmt * noMonths)) - Number(v_principal);
         var v_intSave = Number(v_origInt) - Number(v_newInt);

         document.calc.intSave.value = fns(v_intSave,2,1,1,1);

         var v_summary = "If you would like to pay off your mortgage ";
         v_summary += "in " + v_noYears + " years instead of the ";
         v_summary += "current " + fns(count / 12,1,0,0,0) + " years, you will ";
         v_summary += "need to start making a second monthly mortgage payment ";
         v_summary += "in the amount of " + fns(v_pmtAdd,2,1,1,1) + ". This will ";
         v_summary += "cut your current mortgage interest cost ";
         v_summary += "from " + fns(accumInt,2,1,1,1) + " down ";
         v_summary += "to " + fns(v_newInt,2,1,1,1) + ", a savings ";
         v_summary += "of " + fns(v_intSave,2,1,1,1) + " in interest charges.";

         var v_summary_cell = document.getElementById("summary");
         v_summary_cell.innerHTML = "<font face='arial'><small><strong>Summary:</strong> " + v_summary + "</small></font>";

         jQuery('.email-my-results').removeClass('hidden');

      }

   }

}

function clear_results(form) {

   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   document.calc.pmtAdd.value = "";
   document.calc.intSave.value = "";

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
                                <table class="fmcalc" cellpadding='4' cellspacing='0'>
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                        <br><h4 align=center>Mortgage Payoff Calculator – Extra Payments</h4>
                                        <div class="fmcalc-separator"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Enter the principal balance owed:
                                        </td>
                                        <td align="center">
                                        <input type="text" name="principal" size="15" onKeyUp="clear_results(this.form)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Enter the interest rate:
                                        </td>
                                        <td align="center">
                                        <input type="text" name="interest" size="15" onKeyUp="clear_results(this.form)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Enter the regular monthly payment (principal & interest only):
                                        </td>
                                        <td align="center">
                                        <input type="text" name="origPmt" size="15" onKeyUp="clear_results(this.form)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Number of years to pay-off mortgage in:
                                        </td>
                                        <td align="center">
                                        <input type="text" name="noYears" size="15" onKeyUp="clear_results(this.form)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" colspan="2">
                                        <input type="button" value="Calculate" onClick="computeForm(this.form)" />
                                        <input type="button" value="Reset" onClick="reset_calc(this.form)" />
                                        <div class="fmcalc-separator"></div>
                                        <div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Extra payment (monthly) required:
                                        </td>
                                        <td align="center">
                                        <input type="text" name="pmtAdd" size="15" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Interest savings:
                                        </td>
                                        <td align="center">
                                        <input type="text" name="intSave" size="15" />
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
