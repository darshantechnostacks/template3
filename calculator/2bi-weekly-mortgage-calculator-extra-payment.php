
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Bi-Weekly Mortgage Calculator - (Includes Optional Extra Payment &amp; Amortization Schedule)</title>
<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>

function computeMonthlyPayment(prin, numPmts, intRate) {

var pmtAmt = 0;

if(intRate == 0) {
   pmtAmt = prin / numPmts;
} else {
     intRate = intRate / 100.0 / 12;

   var pow = 1;
   for (var j = 0; j < numPmts; j++)
      pow = pow * (1 + intRate);

   pmtAmt = (prin * pow * intRate) / (pow - 1);

}

return pmtAmt;

}




function computeFixedInterestCost(principal, intRate, pmtAmt) { 

   var i = eval(intRate);
   i /= 100;
   i /= 12;

   var prin = eval(principal);
   var intPort = 0;
   var accumInt = 0;
   var prinPort = 0;
   var pmtCount = 0;
   var testForLast = 0;


   //CYCLES THROUGH EACH PAYMENT OF GIVEN DEBT
   while(prin > 0) {

      testForLast = (prin * (1 + i));

      if(pmtAmt < testForLast) {
         intPort = prin * i;
         accumInt = eval(accumInt) + eval(intPort);
         prinPort = eval(pmtAmt) - eval(intPort);
         prin = eval(prin) - eval(prinPort);
      } else {
      //DETERMINE FINAL PAYMENT AMOUNT
      intPort = prin * i;
      accumInt = eval(accumInt) + eval(intPort);
      prinPort = prin;
      prin = 0;
      }

      pmtCount = eval(pmtCount) + eval(1);

      if(pmtCount > 1000 || accumInt > 1000000000) {
         prin = 0;
      }

   }

return accumInt;

}




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



function computeIntRate(myNumPmts, myPrin, myPmtAmt, myGuess) {

var myDecRate = 0;

if(myGuess.length == 0 || myGuess == 0) {
   var myDecGuess = 10;
   } else {
   var myDecGuess = myGuess;
   if(myDecGuess >= 1) {
      myDecGuess = myDecGuess /100;
      }
   }

var myDecRate = myDecGuess / 12;
var myNewPmtAmt = 0;
var pow = 1;
var j = 0;

for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(myDecRate));
}

myNewPmtAmt = (myPrin * pow * myDecRate) / (pow - 1);

//2 DEC PLACE AMOUNT
var decPlace2Rate = (eval(myDecGuess) + eval(.01)) / 12;
var decPlace2Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace2Rate));
}
var decPlace2PmtAmt = (myPrin * pow * decPlace2Rate) / (pow - 1);
decPlace2Amt = eval(decPlace2PmtAmt) - eval(myNewPmtAmt);

//3 DEC PLACE AMOUNT
var decPlace3Rate = (eval(myDecGuess) + eval(.001)) / 12;
var decPlace3Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace3Rate));
}
var decPlace3PmtAmt = (myPrin * pow * decPlace3Rate) / (pow - 1);
decPlace3Amt = eval(decPlace3PmtAmt) - eval(myNewPmtAmt);

//4 DEC PLACE AMOUNT
var decPlace4Rate = (eval(myDecGuess) + eval(.0001)) / 12;
var decPlace4Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace4Rate));
}
var decPlace4PmtAmt = (myPrin * pow * decPlace4Rate) / (pow - 1);
decPlace4Amt = eval(decPlace4PmtAmt) - eval(myNewPmtAmt);

//5 DEC PLACE AMOUNT
var decPlace5Rate = (eval(myDecGuess) + eval(.00001)) / 12;
var decPlace5Amt = 0;
pow = 1;
j=0;
for (j = 0; j < myNumPmts; j++) {
   pow = pow * (eval(1) + eval(decPlace5Rate));
}
var decPlace5PmtAmt = (myPrin * pow * decPlace5Rate) / (pow - 1);
decPlace5Amt = eval(decPlace5PmtAmt) - eval(myNewPmtAmt);

var myPmtDiff = 0;

if(myNewPmtAmt < myPmtAmt) {

   while(myNewPmtAmt < myPmtAmt) {

      myPmtDiff = eval(myPmtAmt) - eval(myNewPmtAmt);
      if(myPmtDiff > decPlace2Amt) {
         myDecRate = eval(myDecRate) + eval(.01 / 12);
      } else
      if(myPmtDiff > decPlace3Amt) {
         myDecRate = eval(myDecRate) + eval(.001 / 12);
      } else
      if(myPmtDiff > decPlace4Amt) {
         myDecRate = eval(myDecRate) + eval(.0001 / 12);
      } else
      if(myPmtDiff > decPlace5Amt) {
         myDecRate = eval(myDecRate) + eval(.00001 / 12);
      } else {
         myDecRate = eval(myDecRate) + eval(.000001 / 12);
      }

      pow = 1
      j = 0;
      
      for (j = 0; j < myNumPmts; j++) {
         pow = pow * (eval(1) + eval(myDecRate));
      }
      myNewPmtAmt = (myPrin * pow * myDecRate) / (pow - 1);
   }

} else {


   while(myNewPmtAmt > myPmtAmt) {

      myPmtDiff = eval(myNewPmtAmt) - eval(myPmtAmt);
      if(myPmtDiff > decPlace2Amt) {
         myDecRate = eval(myDecRate) - eval(.01 / 12);
      } else
      if(myPmtDiff > decPlace3Amt) {
         myDecRate = eval(myDecRate) - eval(.001 / 12);
      } else
      if(myPmtDiff > decPlace4Amt) {
         myDecRate = eval(myDecRate) - eval(.0001 / 12);
      } else
      if(myPmtDiff > decPlace5Amt) {
         myDecRate = eval(myDecRate) - eval(.00001 / 12);
      } else {
         myDecRate = eval(myDecRate) - eval(.000001 / 12);
      }

      pow = 1
      j = 0;
      
      for (j = 0; j < myNumPmts; j++) {
         pow = pow * (eval(1) + eval(myDecRate));
      }
      myNewPmtAmt = (myPrin * pow * myDecRate) / (pow - 1);
   }


}

myDecRate = myDecRate * 12 * 100;

return myDecRate;

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


function calcMonths(form) {

   var VnumMonths = document.calc.getMonths.options[document.calc.getMonths.selectedIndex].value;
   document.calc.months.value = VnumMonths;

   clear_results(form);

}

function calc_pmts_made(my_bal, my_rate, my_pmt, my_pmts, my_type) {

   var my_dec_rate = my_rate;
   if(my_dec_rate >= 1) {
      my_dec_rate /= 100;
   }
   my_dec_rate /= 12;

   var my_prin = my_bal;
   var my_int_port = 0;
   var my_print_port = 0;
   var my_accum_int = 0;
   var my_pmt_cnt = 0;
   
   while(my_pmt_cnt < my_pmts) {

      my_pmt_cnt = Number(my_pmt_cnt) + Number(1);

      my_int_port = my_prin * my_dec_rate;
      my_accum_int = Number(my_accum_int) + Number(my_int_port);
      my_prin_port = Number(my_pmt) - Number(my_int_port);
      my_prin = Number(my_prin) - Number(my_prin_port);

   }

   if(my_type == 0) {
      return my_prin;
   } else {
      return my_accum_int;
   }

}


function calc_loan(my_bal, my_rate, my_pmt, my_pmts, my_ppy, my_type) {

   var my_dec_rate = my_rate;
   if(my_dec_rate >= 1) {
      my_dec_rate /= 100;
   }
   my_dec_rate /= my_ppy;

   var my_prin = my_bal;
   var my_int_port = 0;
   var my_print_port = 0;
   var my_accum_int = 0;
   var my_pmt_cnt = 0;

   //0 = pmts_left;
   //1 = interest_left;
   //2 = balance after my_pmts;

   if(my_type < 2) {
   
      while(my_prin > 0) {

         my_pmt_cnt = Number(my_pmt_cnt) + Number(1);

         if(my_pmt < (my_prin * (1 + my_dec_rate))) {
            my_int_port = my_prin * my_dec_rate;
            my_accum_int = Number(my_accum_int) + Number(my_int_port);
            my_prin_port = Number(my_pmt) - Number(my_int_port);
            my_prin = Number(my_prin) - Number(my_prin_port);
         } else {
            my_int_port = my_prin * my_dec_rate;
            my_accum_int = Number(my_accum_int) + Number(my_int_port);
            my_prin_port = Number(my_prin);
            my_prin = 0;
         }

      }

   } else {

      while(my_pmt_cnt < my_pmts) {

         my_pmt_cnt = Number(my_pmt_cnt) + Number(1);

         if(my_pmt < (my_prin * (1 + my_dec_rate))) {
            my_int_port = my_prin * my_dec_rate;
            my_accum_int = Number(my_accum_int) + Number(my_int_port);
            my_prin_port = Number(my_pmt) - Number(my_int_port);
            my_prin = Number(my_prin) - Number(my_prin_port);
         } else {
            my_int_port = my_prin * my_dec_rate;
            my_accum_int = Number(my_accum_int) + Number(my_int_port);
            my_prin_port = Number(my_prin);
            my_prin = 0;
         }

      }


   }

   if(my_type == 0) {
      return my_pmt_cnt;
   } else
   if(my_type == 1)  {
      return my_accum_int;
   } else {
      return my_prin;
   }

}

function computeForm(form) {

   if(document.calc.orig_prin.value == "") {
      alert("Please enter your mortgage's original loan amount.");
      document.calc.orig_prin.focus();
   } else 
   if(document.calc.int_rate.value == "") {
      alert("Please enter your current interest rate.");
      document.calc.int_rate.focus();
   } else
   if(document.calc.months.value == "") {
      alert("Please enter your mortgage's original term in months.");
      document.calc.months.focus();
   } else
   if(document.calc.tot_mo_pmt.value == "") {
      alert("Please enter your monthly mortgage payment including tax and insurance.");
      document.calc.tot_mo_pmt.focus();
   } else
   if(document.calc.pmts_made.value == "") {
      alert("Please enter the number of payments you've already made. Enter a zero if you haven't made any payments yet.");
      document.calc.pmts_made.focus();
   } else {

      var Vorig_prin = sn(document.calc.orig_prin.value);
      var Vint_rate = sn(document.calc.int_rate.value);
      var Vmonths = sn(document.calc.months.value);
      var Vtot_mo_pmt = sn(document.calc.tot_mo_pmt.value);
      var Vpmts_made = sn(document.calc.pmts_made.value);
      var Vmo_add = sn(document.calc.mo_add.value);

      var Vwithout_pmt = computeMonthlyPayment(Vorig_prin, Vmonths, Vint_rate);
      document.calc.without_pmt.value = fns(Vwithout_pmt,2,1,1,1);
      document.calc.without_pmt_col.value = fns(Vwithout_pmt,2,1,1,1);

      var Vwithout_x_pmt = Number(Vwithout_pmt) + Number(Vmo_add);
      document.calc.without_x_pmt_col.value = fns(Vwithout_x_pmt,2,1,1,1);

      var Vwith_pmt = Vwithout_pmt / 2;
      document.calc.with_pmt_col.value = fns(Vwith_pmt,2,1,1,1);

      var Vwith_x_pmt = (Number(Vwithout_pmt) + Number(Vmo_add)) / 2;
      document.calc.with_x_pmt_col.value = fns(Vwith_x_pmt,2,1,1,1);

      var Vint_paid = calc_pmts_made(Vorig_prin,Vint_rate, Vwithout_pmt, Vpmts_made, 1);
      document.calc.int_paid.value = fns(Vint_paid,2,1,1,1);

      var Vcur_bal = calc_pmts_made(Vorig_prin,Vint_rate, Vwithout_pmt, Vpmts_made, 0);
      document.calc.cur_bal.value = fns(Vcur_bal,2,1,1,1);

      //YEARS TO PAY OFF
      var Vwithout_years =(Number( Vmonths) - Number(Vpmts_made)) / 12;
      document.calc.without_years.value = fns(Vwithout_years,1,0,0,0);

      var without_x_pmts = calc_loan(Vcur_bal, Vint_rate, Vwithout_x_pmt, 0, 12, 0);
      var Vwithout_x_years = without_x_pmts / 12;
      document.calc.without_x_years.value = fns(Vwithout_x_years,1,0,0,0);

      var with_pmts = calc_loan(Vcur_bal, Vint_rate, Vwith_pmt, 0, 26, 0);
      var Vwith_years = with_pmts / 26;
      document.calc.with_years.value = fns(Vwith_years,1,0,0,0);

      var with_x_pmts = calc_loan(Vcur_bal, Vint_rate, Vwith_x_pmt, 0, 26, 0);
      var Vwith_x_years = with_x_pmts / 26;
      document.calc.with_x_years.value = fns(Vwith_x_years,1,0,0,0);

      //INTEREST SAVINGS
      var without_int_cost = calc_loan(Vcur_bal, Vint_rate, Vwithout_pmt, 0, 12, 1);
      var Vwithout_int_savings = 0;
      document.calc.without_int_savings.value = "0";

      var without_x_int_cost = calc_loan(Vcur_bal, Vint_rate, Vwithout_x_pmt, 0, 12, 1);
      var Vwithout_x_int_savings = Number(without_int_cost) - Number(without_x_int_cost);
      document.calc.without_x_int_savings.value = fns(Vwithout_x_int_savings,2,1,1,1);

      var with_int_cost = calc_loan(Vcur_bal, Vint_rate, Vwith_pmt, 0, 26, 1);
      var Vwith_int_savings = Number(without_int_cost) - Number(with_int_cost);
      document.calc.with_int_savings.value = fns(Vwith_int_savings,2,1,1,1);

      var with_x_int_cost = calc_loan(Vcur_bal, Vint_rate, Vwith_x_pmt, 0, 26, 1);
      var Vwith_x_int_savings = Number(without_int_cost) - Number(with_x_int_cost);
      document.calc.with_x_int_savings.value = fns(Vwith_x_int_savings,2,1,1,1);

      //MONTHLY PAYMENTS ELIMINATED
      var Vwithout_pmts_elim = 0;
      document.calc.without_pmts_elim.value = "0";

      var Vwithout_x_pmts_elim = (Number(Vwithout_years) - Number(Vwithout_x_years)) * 12;
      document.calc.without_x_pmts_elim.value = fns(Vwithout_x_pmts_elim,1,0,0,0);

      var Vwith_pmts_elim = (Number(Vwithout_years) - Number(Vwith_years)) * 12;
      document.calc.with_pmts_elim.value = fns(Vwith_pmts_elim,1,0,0,0);

      var Vwith_x_pmts_elim = (Number(Vwithout_years) - Number(Vwith_x_years)) * 12;
      document.calc.with_x_pmts_elim.value = fns(Vwith_x_pmts_elim,1,0,0,0);

      //TOTAL PMT SAVINGS
      var Vwithout_pmt_savings = 0;
      document.calc.without_pmt_savings.value = "0";

      var Vwithout_x_pmt_savings = Vwithout_x_pmts_elim * Vwithout_pmt;
      document.calc.without_x_pmt_savings.value = fns(Vwithout_x_pmt_savings,2,1,1,1);

      var Vwith_pmt_savings = Vwith_pmts_elim * Vwithout_pmt;
      document.calc.with_pmt_savings.value = fns(Vwith_pmt_savings,2,1,1,1);

      var Vwith_x_pmt_savings = Vwith_x_pmts_elim * Vwithout_pmt;
      document.calc.with_x_pmt_savings.value = fns(Vwith_x_pmt_savings,2,1,1,1);

      //EQUITY AFTER 5 YEARS
      var Vwithout_bal_5 = calc_loan(Vcur_bal, Vint_rate, Vwithout_pmt, 60, 12, 2);
      var Vwithout_equity_5 = Number(Vorig_prin) - Number(Vwithout_bal_5);
      document.calc.without_equity_5.value = fns(Vwithout_equity_5,2,1,1,1);

      var Vwithout_x_bal_5 = calc_loan(Vcur_bal, Vint_rate, Vwithout_x_pmt, 60, 12, 2);
      var Vwithout_x_equity_5 = Number(Vorig_prin) - Number(Vwithout_x_bal_5);
      document.calc.without_x_equity_5.value = fns(Vwithout_x_equity_5,2,1,1,1);

      var Vwith_bal_5 = calc_loan(Vcur_bal, Vint_rate, Vwith_pmt, 130, 26, 2);
      var Vwith_equity_5 = Number(Vorig_prin) - Number(Vwith_bal_5);
      document.calc.with_equity_5.value = fns(Vwith_equity_5,2,1,1,1);

      var Vwith_x_bal_5 = calc_loan(Vcur_bal, Vint_rate, Vwith_x_pmt, 130, 26, 2);
      var Vwith_x_equity_5 = Number(Vorig_prin) - Number(Vwith_x_bal_5);
      document.calc.with_x_equity_5.value = fns(Vwith_x_equity_5,2,1,1,1);

      //EQUITY AFTER 10 YEARS
      var Vwithout_bal_10 = calc_loan(Vcur_bal, Vint_rate, Vwithout_pmt, 120, 12, 2);
      var Vwithout_equity_10 = Number(Vorig_prin) - Number(Vwithout_bal_10);
      document.calc.without_equity_10.value = fns(Vwithout_equity_10,2,1,1,1);

      var Vwithout_x_bal_10 = calc_loan(Vcur_bal, Vint_rate, Vwithout_x_pmt, 120, 12, 2);
      var Vwithout_x_equity_10 = Number(Vorig_prin) - Number(Vwithout_x_bal_10);
      document.calc.without_x_equity_10.value = fns(Vwithout_x_equity_10,2,1,1,1);

      var Vwith_bal_10 = calc_loan(Vcur_bal, Vint_rate, Vwith_pmt, 260, 26, 2);
      var Vwith_equity_10 = Number(Vorig_prin) - Number(Vwith_bal_10);
      document.calc.with_equity_10.value = fns(Vwith_equity_10,2,1,1,1);

      var Vwith_x_bal_10 = calc_loan(Vcur_bal, Vint_rate, Vwith_x_pmt, 260, 26, 2);
      var Vwith_x_equity_10 = Number(Vorig_prin) - Number(Vwith_x_bal_10);
      document.calc.with_x_equity_10.value = fns(Vwith_x_equity_10,2,1,1,1);

      //BALANCE DUE AFTER X YEARS
      document.calc.without_after_bal.value = fns(Vwith_x_years,1,0,0,0);

      var Vwithout_bal_pmts = Math.round(Vwith_x_years * 12);
      var Vwithout_bal_due = calc_loan(Vcur_bal, Vint_rate, Vwithout_pmt, Vwithout_bal_pmts, 12, 2);
      document.calc.without_bal_due.value = fns(Vwithout_bal_due,2,1,1,1);

      var Vwithout_x_bal_pmts = Math.round(Vwith_x_years * 12);
      var Vwithout_x_bal_due = calc_loan(Vcur_bal, Vint_rate, Vwithout_x_pmt, Vwithout_x_bal_pmts, 12, 2);
      document.calc.without_x_bal_due.value = fns(Vwithout_x_bal_due,2,1,1,1);

      var Vwith_bal_pmts = Math.round(Vwith_x_years * 26);
      var Vwith_bal_due = calc_loan(Vcur_bal, Vint_rate, Vwith_pmt, Vwith_bal_pmts, 26, 2);
      document.calc.with_bal_due.value = fns(Vwith_bal_due,2,1,1,1);

      var Vwith_x_bal_pmts = Math.round(Vwith_x_years * 26);
      var Vwith_x_bal_due = calc_loan(Vcur_bal, Vint_rate, Vwith_x_pmt, Vwith_x_bal_pmts, 26, 2);
      document.calc.with_x_bal_due.value = fns(Vwith_x_bal_due,2,1,1,1);

      //AVERAGE ANNUAL SAVINGS
      var Vwithout_avg_ann_save = 0;
      document.calc.without_avg_ann_save.value = "0";

      var Vwithout_x_avg_ann_save = Vwithout_x_int_savings / Vwithout_x_years;
      document.calc.without_x_avg_ann_save.value = fns(Vwithout_x_avg_ann_save,2,1,1,1);

      var Vwith_avg_ann_save = Vwith_int_savings / Vwith_years;
      document.calc.with_avg_ann_save.value = fns(Vwith_avg_ann_save,2,1,1,1);

      var Vwith_x_avg_ann_save = Vwith_x_int_savings / Vwith_x_years;
      document.calc.with_x_avg_ann_save.value = fns(Vwith_x_avg_ann_save,2,1,1,1);

      //AVERAGE MONTHLY SAVINGS
      var Vwithout_avg_mon_save = 0;
      document.calc.without_avg_mon_save.value = "0";

      var Vwithout_x_avg_mon_save = Vwithout_x_avg_ann_save / 12;
      document.calc.without_x_avg_mon_save.value = fns(Vwithout_x_avg_mon_save,2,1,1,1);

      var Vwith_avg_mon_save = Vwith_avg_ann_save / 12;
      document.calc.with_avg_mon_save.value = fns(Vwith_avg_mon_save,2,1,1,1);

      var Vwith_x_avg_mon_save = Vwith_x_avg_ann_save / 12;
      document.calc.with_x_avg_mon_save.value = fns(Vwith_x_avg_mon_save,2,1,1,1);

      //EQUIVALENT INTEREST RATE
      document.calc.without_equiv_rate.value = fns(Vint_rate,2,0,2,1);

      var without_x_total_paid = Number(Vcur_bal) + Number(without_x_int_cost);
      var without_x_equiv_pmt = without_x_total_paid / Vmonths;
      var Vwithout_x_equiv_rate = computeIntRate(Vmonths, Vcur_bal, without_x_equiv_pmt, Vint_rate);
      document.calc.without_x_equiv_rate.value = fns(Vwithout_x_equiv_rate,2,0,2,1);

      var with_total_paid = Number(Vcur_bal) + Number(with_int_cost);
      var with_equiv_pmt = with_total_paid / Vmonths;
      var Vwith_equiv_rate = computeIntRate(Vmonths, Vcur_bal, with_equiv_pmt, Vint_rate);
      document.calc.with_equiv_rate.value = fns(Vwith_equiv_rate,2,0,2,1);

      var with_x_total_paid = Number(Vcur_bal) + Number(with_x_int_cost);
      var with_x_equiv_pmt = with_x_total_paid / Vmonths;
      var Vwith_x_equiv_rate = computeIntRate(Vmonths, Vcur_bal, with_x_equiv_pmt, Vint_rate);
      document.calc.with_x_equiv_rate.value = fns(Vwith_x_equiv_rate,2,0,2,1);

      //CASH AVAILABLE AFTER X YEARS
      document.calc.without_cash_avail_yrs.value = fns(Vwithout_years,1,0,0,0);

      var Vwithout_cash_avail_30 = 0;
      document.calc.without_cash_avail_30.value = "0";

      var Vwithout_x_cash_avail_30 = FVmonDep(0, Vint_rate, Vwithout_x_pmt, Vwithout_x_pmts_elim);
      document.calc.without_x_cash_avail_30.value = fns(Vwithout_x_cash_avail_30,2,1,1,1);

      var Vwith_cash_avail_30 = FVmonDep(0, Vint_rate, Vwithout_pmt, Vwith_pmts_elim);
      document.calc.with_cash_avail_30.value = fns(Vwith_cash_avail_30,2,1,1,1);

      var Vwith_x_cash_avail_30 = FVmonDep(0, Vint_rate, Vwithout_pmt, Vwith_x_pmts_elim);
      document.calc.with_x_cash_avail_30.value = fns(Vwith_x_cash_avail_30,2,1,1,1);
      jQuery('.email-my-results').removeClass('hidden');

   }
    
}

function createReport(col) {

   if(document.calc.cur_bal.value == "" || document.calc.cur_bal.value == 0) {
      alert("Please compute the top section of the form before attempting to create the payment schedule.");
      document.calc.cur_bal.focus();
   } else
      if(document.calc.int_rate.value == "" || document.calc.int_rate.value == 0) {
      alert("Please compute the top section of the form before attempting to create the payment schedule.");
      document.calc.int_rate.focus();
   } else
      if(document.calc.without_pmt_col.value == "" || document.calc.without_pmt_col.value == 0) {
      alert("Please compute the top section of the form before attempting to create the payment schedule.");
      document.calc.without_pmt_col.focus();
   } else
      if(document.calc.with_pmt_col.value == "" || document.calc.with_pmt_col.value == 0) {
      alert("Please compute the top section of the form before attempting to create the payment schedule.");
      document.calc.with_pmt_col.focus();
   } else
      if(document.calc.with_x_pmt_col.value == "" || document.calc.with_x_pmt_col.value == 0) {
      alert("Please compute the top section of the form before attempting to create the payment schedule.");
      document.calc.with_x_pmt_col.focus();
   } else {
          
      var Vprincipal = sn(document.calc.cur_bal.value);
      var VintRate = sn(document.calc.int_rate.value);

      var pmtAmt = 0;
      if(col == 1) {
         pmtAmt = sn(document.calc.without_pmt_col.value);
      } else
      if(col == 2) {
         pmtAmt = sn(document.calc.without_x_pmt_col.value);
      } else
      if(col == 3) {
         pmtAmt = sn(document.calc.with_pmt_col.value);
      } else {
         pmtAmt = sn(document.calc.with_x_pmt_col.value);
      }

      var prin = Vprincipal;
      var Vint = VintRate;
      if(Vint >= 1) {
         Vint /= 100;
      }

      var periodText = "";
      if(col > 2) {
         Vint /= 26;
         periodText = "Biweekly";
      } else {
         Vint /= 12;
         periodText = "Monthly";
      }

      var intPort = 0;
      var accumInt = 0;
      var prinPort = 0;
      var accumPrin = 0;
      var count = 0;
      var pmtRow = "";
      var pmtNum = 0;
      var reportStartDate = "";


      var Vmonth = Number(document.calc.month.selectedIndex) + Number(1);
      var Vday = Number(document.calc.day.selectedIndex) + Number(1);
      if(Vday > 28) {
         Vday = 28;
      }
      var Vyear = document.calc.year.options[document.calc.year.selectedIndex].value;
      var loanDate = (Vmonth + "/" + Vday + "/" + Vyear);

      var monthArr = new Array("blank","January","February","March","April","May","June","July","August","September","October","November","December","January");

      var biwkStrDate = monthArr[Vmonth] + " " + Vday + ", " + Vyear;

      var biwkDate = new Date(biwkStrDate);
      var biwkDay = biwkDate.getDay();
      //biwkDate = biwkDate.setDay(Vday);
      //biwkDate = biwkDate.setMonth(Vmonth);
      //biwkDate = biwkDate.setYear(Vyear);
      var biwkTime = biwkDate.getTime();
      //set to next Friday
      biwkTime = biwkTime + ((5 - biwkDay) * 86400000) - (86400000 * 14);

      //ADDED TO GO BACK TO LAST PAYMENT
      Vmonth = Number(Vmonth) - Number(1);
      if(Vmonth == 0) {
         Vmonth = 12;
         Vyear = Number(Vyear) - Number(1);
      }

      var newBiwkTime = 0;
      var nextBiwkDate = new Date();
      var nextBiwkTime = 0;
      var newNextBiwkTime = 0;
      var nextYear = 0;
      //biwkDate.setYear(Vyear);
      //biwkDate.setMonth(Vmonth);
      //biwkDate.setDate(Vday);

      var displayPmtAmt = 0;

      var accumYearPrin = 0;
      var accumYearInt = 0;

      while(prin > 0) {

         if(pmtAmt < (prin * (1 + Vint))) {

            intPort = prin * Vint;
            intPort *= 100;
            intPort = Math.round(intPort);
            intPort /= 100;

            accumInt = Number(accumInt) + Number(intPort);
            accumYearInt = Number(accumYearInt) + Number(intPort);

            prinPort = Number(pmtAmt) - Number(intPort);
            prinPort *= 100;
            prinPort = Math.round(prinPort);
            prinPort /= 100;

            accumPrin = Number(accumPrin) + Number(prinPort);
            accumYearPrin = Number(accumYearPrin) + Number(prinPort);

            prin = Number(prin) - Number(prinPort);

            displayPmtAmt = Number(prinPort) + Number(intPort);

         } else {

            intPort = prin * Vint;
            intPort *= 100;
            intPort = Math.round(intPort);
            intPort /= 100;

            accumInt = Number(accumInt) + Number(intPort);
            accumYearInt = Number(accumYearInt) + Number(intPort);

            prinPort = prin;

            accumPrin = Number(accumPrin) + Number(prinPort);
            accumYearPrin = Number(accumYearPrin) + Number(prinPort);

            prin = 0;

            //pmtAmt = Number(intPort) + Number(prinPort);
            displayPmtAmt = Number(prinPort) + Number(intPort);
         }

         count = Number(count) + Number(1);

         pmtNum = Number(pmtNum) + Number(1);

         if(col < 3) {
            Vmonth = Number(Vmonth) + Number(1);
            if(Vmonth == 13) {
               Vmonth = 1;
               Vyear = Number(Vyear) + Number(1);
            } else {
               Vmonth = Vmonth;
               Vyear = Vyear;
            }

         } else {

            biwkTime = biwkTime + (86400000 * 14);
            newBiwkTime = biwkDate.setTime(biwkTime);
            Vmonth = biwkDate.getMonth() + 1;
            Vday = biwkDate.getDate();
            Vyear = biwkDate.getYear();
            if(Vyear < 1900) {
               Vyear += 1900
            }

            nextBiwkTime = biwkTime + (86400000 * 14);
            newNextBiwkTime = nextBiwkDate.setTime(nextBiwkTime);
            nextYear = nextBiwkDate.getYear();
            if(nextYear < 1900) {
               nextYear += 1900;
            }

         }

         pmtString = (Vmonth + "/" + Vday + "/" + Vyear);

         //IF FIRST ITERATION, SET HIDDEN START DATE
         if(pmtNum == 1) {
            reportStartDate = pmtString;
         }

         pmtRow += "<tr><td align=right><font face='arial'><small>" + pmtNum + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + pmtString + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(prinPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(intPort,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(displayPmtAmt,2,1,1,1) + "</small></font></td>";
         pmtRow += "<td align=right><font face='arial'><small>" + fns(prin,2,1,1,1) + "</small></font></td></tr>";

         if(col < 3 && Vmonth == 12) {

            pmtRow += "<tr bgcolor='#dddddd'><td align=right><font face='arial'><small>Total</small></font></td>";
            pmtRow += "<td align=left><font face='arial'><small>" + Vyear + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearPrin,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearInt,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td></tr>";
            pmtRow += "";

            accumYearPrin = 0;
            accumYearInt = 0;

         }

         if(col > 2 && nextYear > Vyear) {

            pmtRow += "<tr bgcolor='#dddddd'><td align=right><font face='arial'><small>Total</small></font></td>";
            pmtRow += "<td align=left><font face='arial'><small>" + Vyear + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearPrin,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small>" + fns(accumYearInt,2,1,1,1) + "</small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td>";
            pmtRow += "<td align=right><font face='arial'><small> </small></font></td></tr>";
            pmtRow += "";
            pmtRow += "";
            pmtRow += "";

            accumYearPrin = 0;
            accumYearInt = 0;

         }

         if(count > 780) {
            alert("Using your current entries you will never pay off this loan.");
            break;
         } else {
            continue;
         }

      }

      var part1 = "<head><title>Amortization Schedule</title></head>";
      part1 += "<b";
      part1 += "od";
      part1 += "y bgcolor= '#FFFFFF'><br /><br /><center>";
      part1 += "<font face='arial'><big><strong>Amortization Schedule</strong></big></font></center>";

      var newEffectiveRate = "";
      var interestSavings = "";
      var yearSavings = 0;
      if(col == 1) {
         newEffectiveRate = document.calc.without_equiv_rate.value;
         interestSavings = document.calc.without_int_savings.value;
         yearSavings = Number(document.calc.without_years.value) - Number(document.calc.without_years.value);
      } else
      if(col == 2) {
         newEffectiveRate = document.calc.without_x_equiv_rate.value;
         interestSavings = document.calc.without_x_int_savings.value;
         yearSavings = Number(document.calc.without_years.value) - Number(document.calc.with_x_years.value);
      } else
      if(col == 3) {
         newEffectiveRate = document.calc.with_equiv_rate.value;
         interestSavings = document.calc.with_int_savings.value;
         yearSavings = Number(document.calc.without_years.value) - Number(document.calc.with_years.value);
      } else {
         newEffectiveRate = document.calc.with_x_equiv_rate.value;
         interestSavings = document.calc.with_x_int_savings.value;
         yearSavings = Number(document.calc.without_years.value) - Number(document.calc.with_x_years.value);
      }

      var part2 = "<center><table border=1 cellpadding=2 cellspacing=0>";
      part2 += "<tr><td colspan=6><font face='arial'><small><b>Start Date: " + reportStartDate + "<br />";
      part2 += "Principal: " + fns(Vprincipal,2,1,1,1) + "<br />";
      part2 += "# of " + periodText + " Payments: " + count + "<br />";
      part2 += "Current Interest Rate: " + fns(VintRate,2,1,2,1) + "<br />";
      part2 += "New Effective Interest Rate: " + newEffectiveRate + "<br />";
      part2 += "Payment: " + fns(pmtAmt,2,1,1,1) + "<br />";
      part2 += "Interest Savings: " + interestSavings + "<br />";
      part2 += "Paying Off Your Mortgage " + fns(yearSavings,1,0,0,0) + " Years Sooner</b></small></font></td></tr>";
      part2 += "<tr><td colspan=6><center><font face='arial'><b>Schedule of " + periodText + " Payments</b></font><br />";
      part2 += "<font face='arial'><small><small>Please allow for slight rounding differences.";
      part2 += "</small></small></font></center></td></tr>";
      part2 += "<tr bgcolor='silver'><td align='center'><font face='arial'><small><b>Pmt #</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Date</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Principal</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Interest</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Payment</b></small></font></td>";
      part2 += "<td align='center'><font face='arial'><small><b>Balance</b></small></font></td></tr>";

      var part4 = "<tr><td colspan='2'><font face='arial'><small><b>Grand Total</b></small></font></td>";
      part4 += "<td align=right><font face='arial'><small><b>" + fns(accumPrin,2,1,1,1) + "</b></small></font></td>";
      part4 += "<td align=right><font face='arial'><small><b>" + fns(accumInt,2,1,1,1) + "</b></small></font></td>";
      part4 += "<td> </td><td> </td></tr></table><br /><center>";
      part4 += "<form method='post'><input type='button' value='Close Window' onClick='window.close()'>";
      part4 += "</form></center></body></html>";


      var schedule = (part1 + "" + part2 + "" + pmtRow + "" + part4 + "");

      reportWin = window.open("","","width=500,height=400,toolbar=yes,menubar=yes,scrollbars=yes");

      reportWin.document.write(schedule);

      reportWin.document.close();

   }

}


function clear_results(form) {

   document.calc.without_pmt.value = "";
   document.calc.int_paid.value = "";
   document.calc.cur_bal.value = "";

   document.calc.without_pmt_col.value = "";
   document.calc.without_x_pmt_col.value = "";
   document.calc.with_pmt_col.value = "";
   document.calc.with_x_pmt_col.value = "";

   document.calc.without_years.value = "";
   document.calc.without_x_years.value = "";
   document.calc.with_years.value = "";
   document.calc.with_x_years.value = "";

   document.calc.without_int_savings.value = "";
   document.calc.without_x_int_savings.value = "";
   document.calc.with_int_savings.value = "";
   document.calc.with_x_int_savings.value = "";

   document.calc.without_pmts_elim.value = "";
   document.calc.without_x_pmts_elim.value = "";
   document.calc.with_pmts_elim.value = "";
   document.calc.with_x_pmts_elim.value = "";

   document.calc.without_pmt_savings.value = "";
   document.calc.without_x_pmt_savings.value = "";
   document.calc.with_pmt_savings.value = "";
   document.calc.with_x_pmt_savings.value = "";

   document.calc.without_equity_5.value = "";
   document.calc.without_x_equity_5.value = "";
   document.calc.with_equity_5.value = "";
   document.calc.with_x_equity_5.value = "";

   document.calc.without_equity_10.value = "";
   document.calc.without_x_equity_10.value = "";
   document.calc.with_equity_10.value = "";
   document.calc.with_x_equity_10.value = "";

   document.calc.without_after_bal.value = "";


   document.calc.without_bal_due.value = "";
   document.calc.without_x_bal_due.value = "";
   document.calc.with_bal_due.value = "";
   document.calc.with_x_bal_due.value = "";

   document.calc.without_avg_ann_save.value = "";
   document.calc.without_x_avg_ann_save.value = "";
   document.calc.with_avg_ann_save.value = "";
   document.calc.with_x_avg_ann_save.value = "";

   document.calc.without_avg_mon_save.value = "";
   document.calc.without_x_avg_mon_save.value = "";
   document.calc.with_avg_mon_save.value = "";
   document.calc.with_x_avg_mon_save.value = "";

   document.calc.without_equiv_rate.value = "";
   document.calc.without_x_equiv_rate.value = "";
   document.calc.with_equiv_rate.value ="";
   document.calc.with_x_equiv_rate.value = "";

   document.calc.without_cash_avail_yrs.value = "";

   document.calc.without_cash_avail_30.value = "";
   document.calc.without_x_cash_avail_30.value = "";
   document.calc.with_cash_avail_30.value = "";
   document.calc.with_x_cash_avail_30.value = "";

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
<td colspan="5">
<br><h4 align="center">Bi-Weekly Mortgage Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="4">
Current mortgage's beginning loan amount:
</td>
<td align="center">
<input type="text" name="orig_prin" size="12" value="150000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4">
Current interest rate (%):
</td>
<td align="center">
<input type="text" name="int_rate" size="12" value="7" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4">
Original loan term (months):
<select name="getMonths" size="1" onchange="calcMonths(this.form)">
<option value="">Calc Months</option>
<option value="60">5 years</option>
<option value="120">10 years</option>
<option value="180">15 years</option>
<option value="240">20 years</option>
<option value="300">25 years</option>
<option value="360" selected="">30 years</option>
</select>
</td>
<td align="center">
<input type="text" name="months" size="12" value="360" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4">
Total monthly payment (including tax &amp; insurance):
</td>
<td align="center">
<input type="text" name="tot_mo_pmt" size="12" value="1160.00" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="4">
Number of payments already made:
</td>
<td align="center">
<input type="text" name="pmts_made" size="12" value="14" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="3">
Date next payment due:
</td>
<td align="center" colspan="2">
<select name="month" size="1">
<option value="Jan" selected="">Jan</option>
<option value="Feb">Feb</option>
<option value="Mar">Mar</option>
<option value="Apr">Apr</option>
<option value="May">May</option>
<option value="Jun">Jun</option>
<option value="Jul">Jul</option>
<option value="Aug">Aug</option>
<option value="Sep">Sep</option>
<option value="Oct">Oct</option>
<option value="Nov">Nov</option>
<option value="Dec">Dec</option>
</select>
<select name="day" size="1">
<option value="1" selected=""> 1</option>
<option value="2"> 2</option>
<option value="3"> 3</option>
<option value="4"> 4</option>
<option value="5"> 5</option>
<option value="6"> 6</option>
<option value="7"> 7</option>
<option value="8"> 8</option>
<option value="9"> 9</option>
<option value="10"> 10</option>
<option value="11"> 11</option>
<option value="12"> 12</option>
<option value="13"> 13</option>
<option value="14"> 14</option>
<option value="15"> 15</option>
<option value="16"> 16</option>
<option value="17"> 17</option>
<option value="18"> 18</option>
<option value="19"> 19</option>
<option value="20"> 20</option>
<option value="21"> 21</option>
<option value="22"> 22</option>
<option value="23"> 23</option>
<option value="24"> 24</option>
<option value="25"> 25</option>
<option value="26"> 26</option>
<option value="27"> 27</option>
<option value="28"> 28</option>
<option value="28"> 29</option>
<option value="28"> 30</option>
<option value="28"> 31</option>
</select>
<select name="year" size="1">
<option value="1998">98</option>
<option value="1999">99</option>
<option value="2000">00</option>
<option value="2001">01</option>
<option value="2002">02</option>
<option value="2003">03</option>
<option value="2004">04</option>
<option value="2005">05</option>
<option value="2006">06</option>
<option value="2007">07</option>
<option value="2008">08</option>
<option value="2009" selected="">09</option>
<option value="2010">10</option>
<option value="2011">11</option>
<option value="2012">12</option>
<option value="2013">13</option>
<option value="2014">14</option>
<option value="2015">15</option>
<option value="2016">16</option>
<option value="2017">17</option>
<option value="2018">18</option>
</select>
</td>
</tr>
<tr>
<td colspan="4">
Extra amount you could comfortably add to the payment each month:
</td>
<td align="center">
<input type="text" name="mo_add" size="12" value="100.00" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="5">
<input type="button" value="Calculate Mortage" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="4">
Current mortgage payment less escrow:
</td>
<td align="center">
<input type="text" name="without_pmt" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Interest you've already paid:
</td>
<td align="center">
<input type="text" name="int_paid" size="12">
</td>
</tr>
<tr>
<td colspan="4">
Current approximate balance of your mortgage:
</td>
<td align="center">
<input type="text" name="cur_bal" size="12">
</td>
</tr>
<tr>
<td align="center">
<b>
Results
</b>
</td>
<td align="center">
<b>
Current
</b>
</td>
<td align="center">
<b>
Current Plus Extra
</b>
</td>
<td align="center">
<b>
Bi-Weekly
</b>
</td>
<td align="center">
<b>
Bi-Weekly plus Extra
</b>
</td>
</tr>
<tr>
<td>
Mortgage payment:
</td>
<td align="center">
<input type="text" name="without_pmt_col" size="9">
</td>
<td align="center">
<input type="text" name="without_x_pmt_col" size="9">
</td>
<td align="center">
<input type="text" name="with_pmt_col" size="9">
</td>
<td align="center">
<input type="text" name="with_x_pmt_col" size="9">
</td>
</tr>
<tr>
<td>
Years to pay off:
</td>
<td align="center">
<input type="text" name="without_years" size="9">
</td>
<td align="center">
<input type="text" name="without_x_years" size="9">
</td>
<td align="center">
<input type="text" name="with_years" size="9">
</td>
<td align="center">
<input type="text" name="with_x_years" size="9">
</td>
</tr>
<tr>
<td>
Interest savings:
</td>
<td align="center">
<input type="text" name="without_int_savings" size="9">
</td>
<td align="center">
<input type="text" name="without_x_int_savings" size="9">
</td>
<td align="center">
<input type="text" name="with_int_savings" size="9">
</td>
<td align="center">
<input type="text" name="with_x_int_savings" size="9">
</td>
</tr>
<tr>
<td>
Payments eliminated:
</td>
<td align="center">
<input type="text" name="without_pmts_elim" size="9">
</td>
<td align="center">
<input type="text" name="without_x_pmts_elim" size="9">
</td>
<td align="center">
<input type="text" name="with_pmts_elim" size="9">
</td>
<td align="center">
<input type="text" name="with_x_pmts_elim" size="9">
</td>
</tr>
<tr>
<td>
Total savings:
</td>
<td align="center">
<input type="text" name="without_pmt_savings" size="9">
</td>
<td align="center">
<input type="text" name="without_x_pmt_savings" size="9">
</td>
<td align="center">
<input type="text" name="with_pmt_savings" size="9">
</td>
<td align="center">
<input type="text" name="with_x_pmt_savings" size="9">
</td>
</tr>
<tr>
<td>
Equity after 5 years:
</td>
<td align="center">
<input type="text" name="without_equity_5" size="9">
</td>
<td align="center">
<input type="text" name="without_x_equity_5" size="9">
</td>
<td align="center">
<input type="text" name="with_equity_5" size="9">
</td>
<td align="center">
<input type="text" name="with_x_equity_5" size="9">
</td>
</tr>
<tr>
<td>
Equity after 10 years:
</td>
<td align="center">
<input type="text" name="without_equity_10" size="9">
</td>
<td align="center">
<input type="text" name="without_x_equity_10" size="9">
</td>
<td align="center">
<input type="text" name="with_equity_10" size="9">
</td>
<td align="center">
<input type="text" name="with_x_equity_10" size="9">
</td>
</tr>
<tr>
<td>
Balance<input type="text" name="without_after_bal" size="6"> years later:
</td>
<td align="center">
<input type="text" name="without_bal_due" size="9">
</td>
<td align="center">
<input type="text" name="without_x_bal_due" size="9">
</td>
<td align="center">
<input type="text" name="with_bal_due" size="9">
</td>
<td align="center">
<input type="text" name="with_x_bal_due" size="9">
</td>
</tr>
<tr>
<td align="center">
<b>
Results (continued)
</b>
</td>
<td align="center">
<b>
Current
</b>
</td>
<td align="center">
<b>
Current plus Extra
</b>
</td>
<td align="center">
<b>
Bi-Weekly
</b>
</td>
<td align="center">
<b>
Bi-Weekly plus Extra
</b>
</td>
</tr>
<tr>
<td>
Avg. monthly savings:
</td>
<td align="center">
<input type="text" name="without_avg_mon_save" size="9">
</td>
<td align="center">
<input type="text" name="without_x_avg_mon_save" size="9">
</td>
<td align="center">
<input type="text" name="with_avg_mon_save" size="9">
</td>
<td align="center">
<input type="text" name="with_x_avg_mon_save" size="9">
</td>
</tr>
<tr>
<td>
Avg. annual savings:
</td>
<td align="center">
<input type="text" name="without_avg_ann_save" size="9">
</td>
<td align="center">
<input type="text" name="without_x_avg_ann_save" size="9">
</td>
<td align="center">
<input type="text" name="with_avg_ann_save" size="9">
</td>
<td align="center">
<input type="text" name="with_x_avg_ann_save" size="9">
</td>
</tr>
<tr>
<td>
Equivalent interest rate:
</td>
<td align="center">
<input type="text" name="without_equiv_rate" size="9">
</td>
<td align="center">
<input type="text" name="without_x_equiv_rate" size="9">
</td>
<td align="center">
<input type="text" name="with_equiv_rate" size="9">
</td>
<td align="center">
<input type="text" name="with_x_equiv_rate" size="9">
</td>
</tr>
<tr>
<td>
Savings <input type="text" name="without_cash_avail_yrs" size="6"> years later:*
</td>
<td align="center">
<input type="text" name="without_cash_avail_30" size="9">
</td>
<td align="center">
<input type="text" name="without_x_cash_avail_30" size="9">
</td>
<td align="center">
<input type="text" name="with_cash_avail_30" size="9">
</td>
<td align="center">
<input type="text" name="with_x_cash_avail_30" size="9">
</td>
</tr>
<tr>
<td>
Payment Schedules:**
</td>
<td align="center">
<input type="button" value="Create" onclick="createReport(1)">
</td>
<td align="center">
<input type="button" value="Create" onclick="createReport(2)">
</td>
<td align="center">
<input type="button" value="Create" onclick="createReport(3)">
</td>
<td align="center">
<input type="button" value="Create" onclick="createReport(4)">
</td>
</tr>
<tr>
<td colspan="5">
<small>*Based upon a 10% yield of the money saved over the life of the loan.</small>
</td>
</tr>
<tr>
<td colspan="5">
<small>**Payment schedules may take a while to appear -- depending on the speed of your computer and the number of payments remaining.</small>
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
