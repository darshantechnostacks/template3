<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Present Value of Annuity Calculator</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>



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

function pv_pmt(f_rate, f_years, f_fv, f_pmt, f_ppy) {

   var f_pv = 0;
   var denom = 1;
   var f_int = f_rate / 100 / f_ppy;
   var factor = Number(1) + Number(f_int);

   var pmt_pv = 0;
   var pmt_fact = 0;
   var f_npr = f_years * f_ppy;

   for(var i = 0; i < f_npr; i++) {

      denom = denom * factor;

      pmt_pv = f_pmt / denom;

      f_pv = Number(f_pv) + Number(pmt_pv);

   }

   return f_pv;

}




function compute(form) {

   if(document.calc.pmt.value.length == 0 || document.calc.pmt.value == 0) {
      alert("Please enter the payment amount.");
      document.calc.pmt.focus();
   } else
   if(document.calc.rate.value.length == 0 || document.calc.rate.value == 0) {
      alert("Please enter the discount rate.");
      document.calc.rate.focus();
   } else
   if(document.calc.years.value.length == 0 || document.calc.years.value == 0) {
      alert("Please enter the number of years.");
      document.calc.years.focus();
   } else {

      var v_pmt = sn(document.calc.pmt.value);
      var v_rate = sn(document.calc.rate.value);
      var v_years = sn(document.calc.years.value);

      var v_ppy = document.calc.ppy.options[document.calc.ppy.selectedIndex].value;
      var v_npr = v_years * v_ppy;

      var v_pv = pv_pmt(v_rate, v_years, 0, v_pmt, v_ppy);

      document.calc.pv.value = "$" + fn(v_pv,2,1);


      jQuery('.email-my-results').removeClass('hidden');
   }


}


function clear_results(form) {

   document.calc.pv.value = "";

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
<br><h4 align="center">Present Value of Annuity Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Payment amount ($):
</td>
<td align="center">
<input type="text" name="pmt" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Interest rate (%):
</td>
<td align="center">
<input type="text" name="rate" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Number of years (#):
</td>
<td align="center">
<input type="text" name="years" size="15" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Payment interval:
</td>
<td align="center">
<select name="ppy" size="1" onchange="clear_results(this.form)">
<option value="12">Monthly</option>
<option value="4">Quarterly</option>
<option value="2">Semi-Annually</option>
<option value="1" selected="">Annually</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="button" value="Calculate Present Value of Annuity" onclick="compute(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden">
    </div><br>
</td>
</tr>
<tr>
<td>
Present value:
</td>
<td align="center">
<input type="text" name="pv" size="15">
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