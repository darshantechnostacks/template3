<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Interest Calculator – Simple vs. Compound Interest Calculator</title>

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

   var Vprincipal = sn(document.calc.principal.value);
   var Vinterest = sn(document.calc.interest.value);
   var Vyears = sn(document.calc.years.value);

   if(Vprincipal == 0) {
      alert("Please enter the one-time deposit amount.");
      document.calc.principal.focus();
   } else 
   if(Vinterest == 0) {
      alert("Please enter the annual interest rate.");
      document.calc.interest.focus();
   } else
   if(Vyears == 0) {
      alert("Please enter the number of years.");
      document.calc.years.focus();
   } else {
  
      var i = Vinterest;

      if (i >= 1.0) {
         i = i / 100.0;
      }
      i /= 12;

      var Vmonths = Vyears * 12;

      var Vmo_int = Vprincipal * i;
      document.calc.mo_int.value = fns(Vmo_int,2,1,1,1);

      var Vtot_int = Vmo_int * Vmonths;
      document.calc.tot_int.value = fns(Vtot_int,2,1,1,1);

      var Vtot_fv = FVsingleDep(Vprincipal, Vinterest, Vmonths, 12);
      document.calc.tot_fv.value = fns(Vtot_fv,2,1,1,1);

      var Vtot_fv_int= Number(Vtot_fv) - Number(Vprincipal) - Number(Vtot_int);
      document.calc.tot_fv_int.value = fns(Vtot_fv_int,2,1,1,1);
      jQuery('.email-my-results').removeClass('hidden');
   }

}

function clear_results(form) {

   document.calc.mo_int.value = "";
   document.calc.tot_int.value = "";
   document.calc.tot_fv.value = "";
   document.calc.tot_fv_int.value = "";

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
<br><h4 align="center">Simple vs. Compound Interest Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter amount invested:
</td>
<td align="center">
<input type="text" name="principal" size="15" value="10000" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter the annual interest rate (%):
</td>
<td align="center">
<input type="text" name="interest" size="15" value="4" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter number of years for compounding:
</td>
<td align="center">
<input type="text" name="years" size="15" value="3" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><br>
</td>
</tr>
<tr>
<td>
Simple Monthly Interest Income Payment:
</td>
<td align="center">
<input type="text" name="mo_int" size="15">
</td>
</tr>
<tr>
<td>
Total of interest payments:
</td>
<td align="center">
<input type="text" name="tot_int" size="15">
</td>
</tr>
<tr>
<td>
Future value if you compound interest:
</td>
<td align="center">
<input type="text" name="tot_fv" size="15">
</td>
</tr>
<tr>
<td>
This is how much more interest you will earn by compounding your earnings:
</td>
<td align="center">
<input type="text" name="tot_fv_int" size="15">
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