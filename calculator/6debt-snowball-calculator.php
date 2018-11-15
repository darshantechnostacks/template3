
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Debt Snowball Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>
function fmcalc_26_fn(num, places, comma) {

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




function fmcalc_26_sn(num) {

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

function fmcalc_26_computeLoan(line) {


   var my_prin_cell = document.getElementById("fmcalc_26_prin" + line + "");
   var my_rate_cell = document.getElementById("fmcalc_26_intRate" + line + "");
   var my_pmt_cell = document.getElementById("fmcalc_26_pmt" + line + "");

   var my_prin = fmcalc_26_sn(my_prin_cell.value);
   var my_rate = fmcalc_26_sn(my_rate_cell.value);
   var my_pmt = fmcalc_26_sn(my_pmt_cell.value);

   var my_intLeft_cell = document.getElementById("fmcalc_26_intLeft" + line + "");
   var my_pmtLeft_cell = document.getElementById("fmcalc_26_pmtLeft" + line + "");


   var my_intPort = 0;
   var my_i = 0;
   var my_prinPort = 0;
   var my_accumInt = 0;
   var my_count = 0;

   if(my_prin > 0 && my_pmt > 0) {

      if(my_rate == 0) {
         my_i = 0;
      } else {
         my_i = my_rate;
         if(my_i >= 1) {
            my_i /= 100;
         }
         my_i /= 12;
      }

      while(my_prin > 0) {
         my_intPort = my_prin * my_i;
         my_accumInt = Number(my_accumInt) + Number(my_intPort);
         my_prinPort = Number(my_pmt) - Number(my_intPort);
         my_prin = Number(my_prin) - Number(my_prinPort);
         my_count = Number(my_count) + Number(1);
         if(my_count > 1000) {break; } else {continue; }
      }

      if(my_count >= 1000) {
         alert("At the terms you entered, debt #" + line + " will never be paid off. Please either decrease the balance, decrease the interest rate, or increase the payment amount until this message not longer pops up.");
         my_intLeft_cell.value = "ERROR";
         my_pmtLeft_cell.value = "ERROR";
      } else {
         my_intLeft_cell.value = "$" + fmcalc_26_fn(my_accumInt,2,1);
         my_pmtLeft_cell.value = my_count;
      }


   }

    fmcalc_26_clearResults(document.fmcalc_26_form);

}

function fmcalc_26_computeForm(form)  {
jQuery('.email-my-results').removeClass('hidden');
   var debtCnt = 0;
   var i = 0;
   var totalDebtInt = 0;
   var totalDebtPmts = 0;
   var max_npr = 0;

   var name_arr = new Array()
   var prin_arr = new Array()
   var adp_bal_arr = new Array()
   var rate_arr = new Array()
   var pmt_arr = new Array()
   var adp_pmt_arr = new Array()
   var npr_arr = new Array()
   var cost_arr = new Array()
   var sum_rows_arr = new Array()


   var Vschedule_head = "<tr><td><b>Pmt#</b></td>";

   var count = 0;
   var prinPort = 0;
   var intPort = 0;
   var name = "";
   var prin = 0;
   var intRate = 0;
   var intLeft = 0;
   var accumInt = 0;
   var accumPrin = 0;
   var pmt = 0;

   var Vtotalprin = 0;

   while(i < 10) {

      i = Number(i) + Number(1);

      var name_cell = document.getElementById("fmcalc_26_D" + i + "");
      var prin_cell = document.getElementById("fmcalc_26_prin" + i + "");
      var intRate_cell = document.getElementById("fmcalc_26_intRate" + i + "");
      var pmt_cell = document.getElementById("fmcalc_26_pmt" + i + "");
      var intLeft_cell = document.getElementById("fmcalc_26_intLeft" + i + "");
      var pmtLeft_cell = document.getElementById("fmcalc_26_pmtLeft" + i + "");

      name = name_cell.value;
      prin = fmcalc_26_sn(prin_cell.value);
      intRate = fmcalc_26_sn(intRate_cell.value);
      pmt = fmcalc_26_sn(pmt_cell.value);
      intLeft = fmcalc_26_sn(intLeft_cell.value);


      Vtotalprin = Number(Vtotalprin) + Number(prin);


      if(prin > 0 && pmt > 0) {

         debtCnt = Number(debtCnt) + Number(1);
         accumPrin = Number(accumPrin) + Number(prin);

         Vschedule_head = Vschedule_head + "<td align='center'><b>" + debtCnt + "</b></td>n";
         sum_rows_arr[i] = "<tr><td>" + name + "</td>n";

         accumInt = 0;
         count = 0;

         if(intRate == 0) {
            intRate = 0;
         } else {
            if(intRate >= 1) {
               intRate /= 100;
            }
            intRate /= 12;
         }

         name_arr[debtCnt] = name;
         prin_arr[debtCnt] = prin;
         adp_bal_arr[debtCnt] = prin;
         rate_arr[debtCnt] = intRate;
         pmt_arr[debtCnt] = pmt;
         adp_pmt_arr[debtCnt] = pmt;

      if(i == 1) {
         var test = prin_arr[1];
      }

         while(prin > 0) {
            intPort = prin * intRate;
            accumInt = Number(accumInt) + Number(intPort);
            prinPort = Number(pmt) - Number(intPort);
            prin = Number(prin) - Number(prinPort);
            count = Number(count) + Number(1);
            if(count > 1000) {break; } else {continue; }
         }
         totalDebtInt = Number(totalDebtInt) + (accumInt);
         totalDebtPmts = Number(totalDebtPmts) + Number(pmt);

         if(count > max_npr) {
            max_npr = count;
         }

         npr_arr[debtCnt] = count;
         cost_arr[debtCnt] = accumInt;

         pmtLeft_cell.value = count;
         intLeft_cell.value = "$" + fmcalc_26_fn(accumInt,2,1);


      } //if


    } //while

    document.fmcalc_26_form.totalprin.value = "$" + fmcalc_26_fn(Vtotalprin,2,1);
    document.fmcalc_26_form.adp_totalprin.value = "$" + fmcalc_26_fn(Vtotalprin,2,1);

    document.fmcalc_26_form.totalint.value = "$" + fmcalc_26_fn(totalDebtInt,2,1);

    document.fmcalc_26_form.totalnprs.value = max_npr;

    document.fmcalc_26_form.totalpmt.value = "$" + fmcalc_26_fn(totalDebtPmts,2,1);

    Vschedule_head = Vschedule_head + "</tr>n";
    document.fmcalc_26_form.schedule_head.value = Vschedule_head;

    var Vaccel_pmt = fmcalc_26_sn(document.fmcalc_26_form.accel_pmt.value);
    var Vadp_totalpmt = Number(totalDebtPmts) + Number(Vaccel_pmt);
    document.fmcalc_26_form.adp_totalpmt.value = "$" + fmcalc_26_fn(Vadp_totalpmt ,2,1);

    var v_summary_cell = document.getElementById("fmcalc_26_summary");

    var v_summary_txt = "The total of your current monthly debt ";
    v_summary_txt += "payments ($" + fmcalc_26_fn(totalDebtPmts,2,1) + "), plus the ";
    v_summary_txt += "additional monthly amount of $" + fmcalc_26_fn(Vaccel_pmt,2,1) + ", is ";
    v_summary_txt += "equal to $" + fmcalc_26_fn(Vadp_totalpmt,2,1) + ".  This is how ";
    v_summary_txt += "much you will allocate to paying off your debts until ";
    v_summary_txt += "all of the above debts are paid off.";

    v_summary_cell.innerHTML = v_summary_txt;


    i = 0;
    var npr_cnt = 0;
    var adp_bal = 0;
    var adp_combo_prin = accumPrin;
    var debts_paid_off = 0;
    var next_debt_paid_off = 1;
    var Vadp_totalint = 0;
    var sum_col_print = 0;

    //VARIABLES FOR EACH PAYMENT ON EACH DEBT
    var adp_bal = 0;
    var adp_intPort = 0;
    var adp_prinPort = 0;
    var adp_rate = 0;
    var adp_excess_pmt = 0;


    //AMOUNT TO APPLY TO DEBT BEING FOCUSED ON
    var adp_pmt_amt = 0;

    //TOTAL OF ADP_PMTS PER PERIOD
    var tot_period_pmts = 0;

    //DEBT THAT EXTRA IS BEING APPLIED TO
    var cur_adp_debt = 1;

    //VARIEBLE TO COLLECT CHART ROWS
    var num_pmts = 0;
    var Vschedule_cols = "";
    var Vschedule_rows = "";
    var Vsummary_head = "<tr><td><b>Name of Debt</b></td><td><b>Begin<br>Bal:<br>Pmt:</b></td>";

    //DO UNTIL ALL DEBTS ARE PAID
    while(debts_paid_off< debtCnt) {

      npr_cnt = Number(npr_cnt) + Number(1);
      i = 0;
      adp_pmt_amt = Vaccel_pmt;



      //MAKE PMTS THIS PERIOD
      while(i < debtCnt) {

         //WHICH DEBTS ARE PAID OFF

         i = Number(i) + Number(1);
         num_pmts = Number(num_pmts) + Number(1);

         //GET THIS PAYMENTS CURRENT TERMS FROM ARRAY
         adp_bal = adp_bal_arr[i];
         adp_rate = rate_arr[i];
         adp_pmt = pmt_arr[i];

         if(npr_cnt == 1) {
            sum_rows_arr[i] = sum_rows_arr[i] + "<td>$" + fmcalc_26_fn(adp_bal,0,1) + "<br>$" + fmcalc_26_fn(adp_pmt,0,1) + "</td>";
         }



         //IF THIS DEBT's BAL GREATER THAN ZERO, MAKE PMT
         if(adp_bal > 0) {
            adp_intPort = adp_bal * adp_rate;
            //adp_pmt = Number(adp_pmt) + Number(adp_pmt_amt);
            //adp_pmt_amt = 0;
            Vadp_totalint = Number(Vadp_totalint) + Number(adp_intPort);
            adp_prinPort = Number(adp_pmt) - Number(adp_intPort);
            adp_bal = Number(adp_bal) - Number(adp_prinPort);
            if(adp_bal <= 0) {
               adp_excess_pmt = Number(adp_bal * -1);
               adp_pmt = Number(adp_pmt) - Number(adp_excess_pmt);
               adp_prinPort = Number(adp_prinPort) - Number(adp_excess_pmt);
               //ADD EXCESS PMT AMT TO ACCELERATOR AMT
               adp_pmt_amt = Number(adp_pmt_amt) + Number(adp_excess_pmt);
               adp_bal = 0;
               debts_paid_off = Number(debts_paid_off) + 1;
               sum_col_print = 1;

            }
            adp_bal_arr[i] = adp_bal;
            adp_combo_prin = Number(adp_combo_prin) - Number(adp_prinPort);
         } else { //ADD PMT AMOUNT TO ACCELERATOR

            //INCREMENT NUMBER TO NEXT DEBT
            cur_adp_debt = Number(cur_adp_debt) + Number(1);

            //ADD UNEEDED PMT AMT TO ACCELERATOR AMT
            adp_pmt_amt = Number(adp_pmt_amt) + Number(adp_pmt);

            //SET THIS DEBT's PERIOD PAYMENT TO ZERO
           adp_pmt = 0;
         }

         adp_pmt_arr[i] = adp_pmt;

         if(i > 10) {
            break;
         } else {
            continue;
         }

      } //WHILE MAKING PATMENTS ON DEBTS THIS PERIOD



      i = 0;

      //IF EXCESS PAYMENT AMOUNT HAS NOT BEEN USED UP
      if(adp_pmt_amt > 0) {

         adp_combo_prin = Number(adp_combo_prin) - Number(adp_pmt_amt);

         while(i < debtCnt) {

            i = Number(i) + Number(1);

            if(adp_bal_arr[i] > 0) {

               adp_bal_arr[i] = Number(adp_bal_arr[i]) - Number(adp_pmt_amt);

               if(adp_bal_arr[i] > 0) {

                  adp_pmt_arr[i] = Number(adp_pmt_arr[i]) + Number(adp_pmt_amt);
                  adp_pmt_amt = 0;

               } else {

                  adp_pmt_arr[i] = Number(adp_pmt_arr[i]) + Number(adp_pmt_amt) + Number(adp_bal_arr[i]);
                  adp_pmt_amt = Number(adp_pmt_amt) - (Number(adp_pmt_amt) + Number(adp_bal_arr[i]));
                  if(npr_cnt == 6 && i == 1) {
                     //document.debts.test2.value = adp_pmt_amt;
                  }
                  adp_bal_arr[i] = 0;
                  debts_paid_off = Number(debts_paid_off) + 1;
                  sum_col_print = 1;

               }

            }


         }


      }

      i = 0;

      while(i < debtCnt) {

         i = Number(i) + Number(1);

         tot_period_pmts = Number(tot_period_pmts) + Number(adp_pmt_arr[i]);
         if(adp_pmt_arr[i] == 0) {
            Vschedule_cols = Vschedule_cols + "<td align='right'> </td>";
         } else {
            Vschedule_cols = Vschedule_cols + "<td align='right'>" + fmcalc_26_fn(adp_pmt_arr[i],2,1) + "</td>";
         }

         if(adp_pmt_arr[debts_paid_off] == 0 && sum_col_print == 1 || debts_paid_off == debtCnt) {
            if(i ==1) {
               Vsummary_head = Vsummary_head + "<td><b>Month " + npr_cnt + "<br>Bal:<br>Pmt:</b></td>";
            }

            if(adp_bal_arr[i] == 0) {
                sum_rows_arr[i] = sum_rows_arr[i] + "<td align='top'>$0</td>";
            } else {
            sum_rows_arr[i] = sum_rows_arr[i] + "<td align='top'>$" + fmcalc_26_fn(adp_bal_arr[i],0,1) + "<br>$" + fmcalc_26_fn(adp_pmt_arr[i],0,1) + "</td>";
            }

            if(i == debtCnt) {
               sum_col_print = 0;
            }
         }


      }



      //IF ACCUM UNEEDED AMT GREATER THAN ZERO, APPLY TO CURRENT DEBT's BALANCE
      //adp_bal_arr[cur_adp_debt] = Number(adp_bal_arr[cur_adp_debt]) - Number(adp_pmt_amt);
      //adp_combo_prin = Number(adp_combo_prin) - Number(adp_pmt_amt);

     Vschedule_rows = Vschedule_rows + "<tr><td align='right'>" + npr_cnt + "</td>" + Vschedule_cols + "</tr>r";
     tot_period_pmts = 0;
     Vschedule_cols = "";


      if(npr_cnt > 600) {
         break;
      } else {
         continue;
      }


   } //WHILE ALL DEBTS ARE NOT PAID OFF

   document.fmcalc_26_form.adp_totalnprs.value = npr_cnt;
   document.fmcalc_26_form.adp_totalint.value = "$" + fmcalc_26_fn(Vadp_totalint,2,1);

   var Vadp_npr_save = Number(max_npr) - Number(npr_cnt);
   document.fmcalc_26_form.adp_npr_save.value = Vadp_npr_save;

   var Vadp_int_save = Number(totalDebtInt) - Number(Vadp_totalint);
   document.fmcalc_26_form.adp_int_save.value = "$" + fmcalc_26_fn(Vadp_int_save,2,1);

   Vsummary_head = Vsummary_head + "</tr>";

   document.fmcalc_26_form.schedule_rows.value = Vschedule_rows;
   document.fmcalc_26_form.summary_head.value = Vsummary_head;

   i = 0;
   var Vsummary_rows = "";

   while(i < debtCnt) {

      i = Number(i) + Number(1);

      Vsummary_rows =  Vsummary_rows + "" + sum_rows_arr[i] + "</tr>";

   }

   document.fmcalc_26_form.summary_rows.value = Vsummary_rows;
   console.log('test');
   fmcalc_26_createSchedule(form);
   }


function fmcalc_26_createSchedule(form) {
   var date = new Date();
   var month = new Array(7);
   var year = date.getYear();

   var Vschedule_head = document.fmcalc_26_form.schedule_head.value;
   var Vschedule_rows = document.fmcalc_26_form.schedule_rows.value;

   month[0] = "January";
   month[1] = "February";
   month[2] = "March";
   month[3] = "April";
   month[4] = "May";
   month[5] = "June";
   month[6] = "July";
   month[7] = "August";
   month[8] = "September";
   month[9] = "October";
   month[10] = "November";
   month[11] = "December";
   if (year < 2000) { year+=1900; }
   var dateStr = month[date.getMonth()] + " " + date.getDate() + ", " + year;

   var adpPart1 = "<center><big><strong>";
   adpPart1 += "Accelerated Debt-Payoff Plan</strong></big>";
   adpPart1 += "<p><b>Payment Schedule</b></p>";
   adpPart1 += "<p></CENTER></p><p><center><table border='1' cellspacing='0' cellpadding='2'>";
   adpPart1 += "<tbody>" + Vschedule_head + "" + Vschedule_rows + "</tbody></table></center>";
   adpPart1 += "</p><p><center>Report Source: www.financialmentor.com <br />Date: ";
   adpPart1 += dateStr;
   adpPart1 += "</center></p>";
   adpPart1 += "<p><center>This report was created with ";
   adpPart1 += "<U>The Debt Snowball Calculator</U><br />Courtesy of financialmentor.com";
   adpPart1 += "<BR />Calculator can be found at https://financialmentor.com/calculator";
   adpPart1 += "</p></center>";

   document.getElementById("report").innerHTML = adpPart1;
}

function fmcalc_26_createSummary(form) {

   var date = new Date();
   var month = new Array(7);
   var year = date.getYear();

   var Vsummary_head = document.fmcalc_26_form.summary_head.value;
   var Vsummary_rows = document.fmcalc_26_form.summary_rows.value;

   month[0] = "January";
   month[1] = "February";
   month[2] = "March";
   month[3] = "April";
   month[4] = "May";
   month[5] = "June";
   month[6] = "July";
   month[7] = "August";
   month[8] = "September";
   month[9] = "October";
   month[10] = "November";
   month[11] = "December";
   if (year < 2000) { year+=1900; }
   var dateStr = month[date.getMonth()] + " " + date.getDate() + ", " + year;

   var adpPart1 = "<head><title>Accelerated Debt-Payoff Plan</title></head>";

   adpPart1 += "<";
   adpPart1 += "bo";
   adpPart1 += "d";
   adpPart1 += "y ";
   adpPart1 += ">";


   adpPart1 += "<center><font face='arial'><big><strong>Accelerated Debt-Payoff Plan</strong></big></font>";
   adpPart1 += "<p><b>Payoff Summary</b></CENTER>";
   adpPart1 += "</p><p><center><table border='1' cellspacing='0' cellpadding='2'>";
   adpPart1 += "<tbody>" + Vsummary_head + "" + Vsummary_rows + "</tbody></TABLE></center>";
   adpPart1 += "</p><p><center>Report Source: www.financialmentor.com <br />Date: ";
   adpPart1 += dateStr;
   adpPart1 += "</center></p>";
   adpPart1 += "<p><center>This report was created with ";
   adpPart1 += "<U>The Debt Snowball Calculator</U><br />Courtesy of financialmentor.com";
   adpPart1 += "<br />Calculator can be found at https://financialmentor.com/calculator";
   adpPart1 += "</p><p><form method='post'><input type='button' value='Close Window' onClick='window.close()'>";
   adpPart1 += "</form></p></center></body></html>";

      reportWin = window.open("","","width=500,height=400,toolbar=yes,menubar=yes,scrollbars=yes");
      reportWin.document.write(adpPart1);
      reportWin.document.close();

}

function fmcalc_26_clearResults(form) {

   document.fmcalc_26_form.totalprin.value = "";
   document.fmcalc_26_form.totalpmt.value = "";
   document.fmcalc_26_form.totalint.value = "";
   document.fmcalc_26_form.totalnprs.value = "";

   document.fmcalc_26_form.adp_totalprin.value = "";
   document.fmcalc_26_form.adp_totalpmt.value = "";
   document.fmcalc_26_form.adp_totalint.value = "";
   document.fmcalc_26_form.adp_totalnprs.value = "";

   document.fmcalc_26_form.adp_int_save.value = "";
   document.fmcalc_26_form.adp_npr_save.value = "";

   document.fmcalc_26_form.schedule_head.value = "";
   document.fmcalc_26_form.schedule_rows.value = "";
   document.fmcalc_26_form.summary_head.value = "";
   document.fmcalc_26_form.summary_rows.value = "";

   var v_summary_cell = document.getElementById("fmcalc_26_summary");
   v_summary_cell.innerHTML = "";
   console.log("clear!");
   document.getElementById("report").innerHTML = "";
}

function clearStuff() {
  document.getElementById("report").innerHTML = "";
  return true;
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
                        <form name="fmcalc_26_form" method="post" action="#">
<table class="fmcalc" cellspacing="0">
<tbody>
<tr>
<td colspan="7">
<br><h4 align="center">Debt Snowball Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td align="right"> </td>
<td align="center" colspan="4">
<b>
Entry Columns
</b>
</td>
<td align="center" colspan="2">
<b>
Calculated Columns
</b>
</td>
</tr>
<tr>
<td align="right">
<b>
</b><b>#</b>
</td>
<td align="center">
<b>
Creditor
</b>
</td>
<td align="center">
<b>
Balance<br>Owed ($)
</b>
</td>
<td align="center">
<b>
Interest<br>Rate (%)
</b>
</td>
<td align="center">
<b>
Payment<br>Amount ($)
</b>
</td>
<td align="center">
<b>
Interest<br>Cost
</b>
</td>
<td align="center">
<b>
# of Pmts<br>Left
</b>
</td>
</tr>
<tr>
<td align="right"><b>1</b></td>
<td align="center"><input type="text" id="fmcalc_26_D1" name="D1" size="8" tabindex="2"></td>
<td align="center"><input type="text" id="fmcalc_26_prin1" name="prin1" size="8" tabindex="3" onchange="fmcalc_26_computeLoan(1)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate1" name="intRate1" size="3" tabindex="4" onchange="fmcalc_26_computeLoan(1)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt1" name="pmt1" size="8" tabindex="5" onchange="fmcalc_26_computeLoan(1)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft1" name="intLeft1" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft1" name="pmtLeft1" size="5"></td>
</tr>
<tr>
<td align="right"><b>2</b></td>
<td align="center"><input type="text" id="fmcalc_26_D2" name="D2" size="8" tabindex="6"></td>
<td align="center"><input type="text" id="fmcalc_26_prin2" name="prin2" size="8" tabindex="7" onchange="fmcalc_26_computeLoan(2)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate2" name="intRate2" size="3" tabindex="8" onchange="fmcalc_26_computeLoan(2)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt2" name="pmt2" size="8" tabindex="9" onchange="fmcalc_26_computeLoan(2)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft2" name="intLeft2" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft2" name="pmtLeft2" size="5"></td>
</tr>
<tr>
<td align="right"><b>3</b></td>
<td align="center"><input type="text" id="fmcalc_26_D3" name="D3" size="8" tabindex="10"></td>
<td align="center"><input type="text" id="fmcalc_26_prin3" name="prin3" size="8" tabindex="11" onchange="fmcalc_26_computeLoan(3)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate3" name="intRate3" size="3" tabindex="12" onchange="fmcalc_26_computeLoan(3)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt3" name="pmt3" size="8" tabindex="13" onchange="fmcalc_26_computeLoan(3)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft3" name="intLeft3" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft3" name="pmtLeft3" size="5"></td>
</tr>
<tr>
<td align="right"><b>4</b></td>
<td align="center"><input type="text" id="fmcalc_26_D4" name="D4" size="8" tabindex="14"></td>
<td align="center"><input type="text" id="fmcalc_26_prin4" name="prin4" size="8" tabindex="15" onchange="fmcalc_26_computeLoan(4)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate4" name="intRate4" size="3" tabindex="16" onchange="fmcalc_26_computeLoan(4)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt4" name="pmt4" size="8" tabindex="17" onchange="fmcalc_26_computeLoan(4)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft4" name="intLeft4" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft4" name="pmtLeft4" size="5"></td>
</tr>
<tr>
<td align="right"><b>5</b></td>
<td align="center"><input type="text" id="fmcalc_26_D5" name="D5" size="8" tabindex="18"></td>
<td align="center"><input type="text" id="fmcalc_26_prin5" name="prin5" size="8" tabindex="19" onchange="fmcalc_26_computeLoan(5)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate5" name="intRate5" size="3" tabindex="20" onchange="fmcalc_26_computeLoan(5)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt5" name="pmt5" size="8" tabindex="21&quot;" onchange="fmcalc_26_computeLoan(5)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft5" name="intLeft5" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft5" name="pmtLeft5" size="5"></td>
</tr>
<tr>
<td align="right"><b>6</b></td>
<td align="center"><input type="text" id="fmcalc_26_D6" name="D6" size="8" tabindex="22"></td>
<td align="center"><input type="text" id="fmcalc_26_prin6" name="prin6" size="8" tabindex="23" onchange="fmcalc_26_computeLoan(6)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate6" name="intRate6" size="3" tabindex="24" onchange="fmcalc_26_computeLoan(6)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt6" name="pmt6" size="8" tabindex="25" onchange="fmcalc_26_computeLoan(6)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft6" name="intLeft6" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft6" name="pmtLeft6" size="5"></td>
</tr>
<tr>
<td align="right"><b>7</b></td>
<td align="center"><input type="text" id="fmcalc_26_D7" name="D7" size="8" tabindex="26"></td>
<td align="center"><input type="text" id="fmcalc_26_prin7" name="prin7" size="8" tabindex="27" onchange="fmcalc_26_computeLoan(7)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate7" name="intRate7" size="3" tabindex="28" onchange="fmcalc_26_computeLoan(7)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt7" name="pmt7" size="8" tabindex="29" onchange="fmcalc_26_computeLoan(7)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft7" name="intLeft7" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft7" name="pmtLeft7" size="5"></td>
</tr>
<tr>
<td align="right"><b>8</b></td>
<td align="center"><input type="text" id="fmcalc_26_D8" name="D8" size="8" tabindex="31"></td>
<td align="center"><input type="text" id="fmcalc_26_prin8" name="prin8" size="8" tabindex="32" onchange="fmcalc_26_computeLoan(8)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate8" name="intRate8" size="3" tabindex="33" onchange="fmcalc_26_computeLoan(8)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt8" name="pmt8" size="8" tabindex="34" onchange="fmcalc_26_computeLoan(8)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft8" name="intLeft8" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft8" name="pmtLeft8" size="5"></td>
</tr>
<tr>
<td align="right"><b>9</b></td>
<td align="center"><input type="text" id="fmcalc_26_D9" name="D9" size="8" tabindex="35"></td>
<td align="center"><input type="text" id="fmcalc_26_prin9" name="prin9" size="8" tabindex="36" onchange="fmcalc_26_computeLoan(9)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate9" name="intRate9" size="3" tabindex="37" onchange="fmcalc_26_computeLoan(9)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt9" name="pmt9" size="8" tabindex="39" onchange="fmcalc_26_computeLoan(9)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft9" name="intLeft9" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft9" name="pmtLeft9" size="5"></td>
</tr>
<tr>
<td align="right"><b>10</b></td>
<td align="center"><input type="text" id="fmcalc_26_D10" name="D10" size="8" tabindex="40"></td>
<td align="center"><input type="text" id="fmcalc_26_prin10" name="prin10" size="8" tabindex="41" onchange="fmcalc_26_computeLoan(10)"></td>
<td align="center"><input type="text" id="fmcalc_26_intRate10" name="intRate10" size="3" tabindex="42" onchange="fmcalc_26_computeLoan(10)"></td>
<td align="center"><input type="text" id="fmcalc_26_pmt10" name="pmt10" size="8" tabindex="43" onchange="fmcalc_26_computeLoan(10)"></td>
<td align="center"><input type="text" id="fmcalc_26_intLeft10" name="intLeft10" size="8"></td>
<td align="center"><input type="text" id="fmcalc_26_pmtLeft10" name="pmtLeft10" size="5"></td>
</tr>
<tr>
<td colspan="6">
Enter a monthly dollar amount you can add to your debt payoff plan:
</td>
<td align="center">
<input type="text" name="accel_pmt" tabindex="44" size="8" onkeyup="fmcalc_26_clearResults(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="7">
<input type="button" tabindex="45" value="Calculate Debt Snowball" onclick="fmcalc_26_computeForm(this.form)">
<input type="reset" value="Clear Form" onclick="clearStuff()">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<b>
Results
</b>
</td>
<td align="center">
<b>
Balance<br>Owed
</b>
</td>
<td align="center">
<b>
Interest<br>Rate
</b>
</td>
<td align="center">
<b>
Payment<br>Amount
</b>
</td>
<td align="center">
<b>
Interest<br>Cost
</b>
</td>
<td align="center">
<b>
# of Pmts<br>Left
</b>
</td>
</tr>
<tr>
<td colspan="2">
Current totals:
</td>
<td align="center"><input type="text" name="totalprin" size="8"></td>
<td align="center"> N/A </td>
<td align="center"><input type="text" name="totalpmt" size="8"></td>
<td align="center"><input type="text" name="totalint" size="8"></td>
<td align="center"><input type="text" name="totalnprs" size="8"></td>
</tr>
<tr>
<td colspan="2">
Debt Snowball Totals:
</td>
<td align="center"><input type="text" name="adp_totalprin" size="8"></td>
<td align="center"> N/A </td>
<td align="center"><input type="text" name="adp_totalpmt" size="8"></td>
<td align="center"><input type="text" name="adp_totalint" size="8"></td>
<td align="center"><input type="text" name="adp_totalnprs" size="8"></td>
</tr>
<tr>
<td colspan="5">
Time and interest savings from Accelerated Debt Payoff Plan:
</td>
<td align="center"><input type="text" name="adp_int_save" size="8"></td>
<td align="center"><input type="text" name="adp_npr_save" size="8"></td>
</tr>
<tr>
<td colspan="7" align="center">
<div id="fmcalc_26_summary" align="left">
</div>
<input type="hidden" name="schedule_head">
<input type="hidden" name="schedule_rows">
<input type="hidden" name="summary_head">
<input type="hidden" name="summary_rows">
</td>
</tr>
<tr>
<td align="center" colspan="7">
<input type="button" value="Create Payoff Summary" onclick="fmcalc_26_createSummary(this.form)">
</td>
</tr>
</tbody>
</table>
<div id="report"></div>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
