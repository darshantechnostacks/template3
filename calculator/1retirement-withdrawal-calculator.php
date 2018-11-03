
<!DOCTYPE html>
<html lang="en-US" >
<head>
<meta charset="UTF-8" />
<title>Retirement Withdrawal Calculator</title>
<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>


<?php include_once 'include/header.php'; ?>

<style type="text/css">
	a.pinit-button.custom {
		}

	a.pinit-button.custom span {
		}

	.pinit-hover {
		opacity: 1 !important;
		filter: alpha(opacity=100) !important;
	}
	a.pinit-button {
	border-bottom: 0 !important;
	box-shadow: none !important;
	margin-bottom: 0 !important;
}
a.pinit-button::after {
    display: none;
}</style>


<style type="text/css">
.related_post_title {
}
ul.related_post {
}
ul.related_post li {
}
ul.related_post li a {
}
ul.related_post li img {
}</style>

<style>.async-hide { opacity: 0 !important} </style>

<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:300|Roboto:500,100,300,700,300italic,400,400italic,500italic' rel='stylesheet' type='text/css'>

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

if(document.calc.now_age.value == null || document.calc.now_age.value.length == 0) {
   alert("Please enter your current age.");
   document.calc.now_age.focus();
} else
if(document.calc.retire_age.value == null || document.calc.retire_age.value.length == 0) {
   alert("Please enter the age you plan to retire at.");
   document.calc.retire_age.focus();
} else
if(document.calc.principal.value == null || document.calc.principal.value.length == 0) {
   alert("Please enter the amount you would like to withdraw each month.");
   document.calc.principal.focus();
} else
if(document.calc.payments.value == null || document.calc.payments.value.length == 0) {
   alert("Please enter the number of years you would like to make monthly withdrawels from your investment.");
   document.calc.payments.focus();
} else
if(document.calc.interest.value == null || document.calc.interest.value.length == 0) {
   alert("Please enter the annual interest rate you expect to earn from your investment.");
   document.calc.interest.focus();
} else {

    var v_interest = sn(document.calc.interest.value);
    var i_1 = v_interest;

    if (i_1 >= 1.0) {

        i_1 = i_1 / 100.0;
        } else {
        i_1 = i_1;
    }

   i_1 = i_1 /12

   var inflate = sn(document.calc.inflate.value);

   var inflate_perc = inflate;
   if(inflate_perc >= 1) {
      inflate_perc /=100;
   }

   var inflate_fact = Number(1) + Number(inflate_perc);
   var v_now_age = sn(document.calc.now_age.value);
   var v_retire_age = sn(document.calc.retire_age.value);
   var inflate_years = Number(v_retire_age) - Number(v_now_age);

   var prin = sn(document.calc.principal.value);

   var inflate_prin = prin;

   for(var j = 0; j<inflate_years; j++) {

      inflate_prin = inflate_prin * inflate_fact;
   }




   var nPer = sn(document.calc.payments.value);
   nPer *= 12;

   var count_1 = 0;
   var factor_1 = eval(1) + eval(i_1);
   var denom_1 = 1;
    
    while(count_1 < nPer) {
       denom_1 = denom_1 * factor_1;
        count_1 = eval(count_1) + eval(1);
        }

    var Vpv_1 = eval(1) - eval(1 / denom_1);
    Vpv_1 = Vpv_1 / i_1;
  
    var Vpv_1 = prin * Vpv_1;
    document.calc.pv.value = "$" + fn(Vpv_1,2,1);

    var v_cur_savings = sn(document.calc.cur_savings.value);
    var v_cur_fv = FVsingleDep(v_cur_savings , v_interest, inflate_years, 12);

    var v_pv_save_gap = Number(Vpv_1) - Number(v_cur_fv);
    var v_pv_save = 0;
    if(v_pv_save_gap > 0) {
      v_pv_save = mo_save(i_1, v_pv_save_gap, inflate_years);
    }
    document.calc.pv_save.value = "$" + fn(v_pv_save,2,1);

   var i_2 = Number(i_1) - Number(inflate_perc / 12);
   //var i_2 = i_1;

   var count_2 = 0;
   var factor_2 = eval(1) + eval(i_2);
   var denom_2 = 1;
    
    while(count_2 < nPer) {
       denom_2 = denom_2 * factor_2;
        count_2 = eval(count_2) + eval(1);
        }

    var Vpv_2 = eval(1) - eval(1 / denom_2);
    Vpv_2 = Vpv_2 / i_2;
  
 
    var v_pv_inflate = inflate_prin * Vpv_2;

    document.calc.pv_inflate.value = "$" + fn(v_pv_inflate,2,1);
    //document.calc.pv_inflate.value = "$" + fn(inflate_prin,2,1);

    var v_pv_inflate_save_gap = Number(v_pv_inflate) - Number(v_cur_fv);
    var v_pv_inflate_save = 0;
    if(v_pv_inflate_save_gap > 0) {
       v_pv_inflate_save = mo_save(i_1, v_pv_inflate_save_gap, inflate_years);
    }
    document.calc.pv_inflate_save.value = "$" + fn(v_pv_inflate_save,2,1);

    jQuery('.email-my-results').removeClass('hidden');
    }
}

function mo_save(f_rate, f_gap, f_years) {

//FIGURE PRESENT VALUE OF ADJUSTED SAVINGS GAP
   
   var f_count = 0;

   var f_i = f_rate;

   var f_months = f_years * 12;

   var f_factor = Number(1) + Number(f_i);

   var f_denom = 1;
    
   while(f_count < f_months) {
      f_denom = f_denom * f_factor;
      f_count = Number(f_count) + Number(1);
   }

   var f_pv = Number(f_denom) - Number(1);

   f_pv = f_i / f_pv;

   f_pv = f_pv * f_gap;

   return f_pv;
}

function clear_results(form) {
   document.calc.pv.value = "";
   document.calc.pv_save.value = "";
   document.calc.pv_inflate.value = "";
   document.calc.pv_inflate_save.value = "";
}</script>

<style type="text/css">.essb_displayed_postfloat { margin-left: -60px !important; }.essb_displayed_postfloat.essb_postfloat_fixed { top: 50px !important; }</style>
<script type="text/javascript">

</script>
<style type="text/css">.broken_link, a.broken_link {
	text-decoration: line-through;
}
</style>
</head>
<body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-6907 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none retirement-withdrawal-calculator not_home feature-box-none footer-height-tall calculator" itemscope >
    <div class="site-container">

<div class="banner-bg">
    <nav class="nav-primary">
<div class="wrap">
</div>
</nav>
</div>
<div class="site-inner">
    <div class="content-sidebar-wrap">
        <main class="content">
            <article class="post-6907 page type-page status-publish has-post-thumbnail entry" itemscope >
 
                
                </p>
<p><div class="fmcalc-inner-container fmcalc-ic-c2">
<div class="fmcalc-wrapper">
<form name="calc" method="post" action="#">
<table class="fmcalc" cellpadding='4' cellspacing='0'>
<tbody>
<tr>
<td colspan='2'>
<br><h4 align=center>Retirement Withdrawal Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Enter your current age (#):
</td>
<td>
<input type="text" name="now_age" value="49" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td>
Enter the age you plan to retire at (#):
</td>
<td>
<input type="text" name="retire_age" value="65" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td>
Enter the amount you would like to withdraw each month ($):
</td>
<td>
<input type="text" name="principal" value="500" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td>
Enter the Annual Interest Rate you expect to earn (%):
</td>
<td>
<input type="text" name="interest" value="7" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td>
Enter the number of years you would like to make the monthly withdrawals (#):
</td>
<td>
<input type="text" name="payments" value="20" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td>
Enter the expected average annual rate of inflation (%):
</td>
<td>
<input type="text" name="inflate" value="4" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td>
Enter the amount of your current retirement savings ($):
</td>
<td>
<input type="text" name="cur_savings" value="0" SIZE="15" onKeyUp="clear_results(this.form)" />
</td>
</tr>
<tr>
<td COLSPAN="2" align="center"><input type="button" value="Calculate" onClick="computeForm(this.form)" /> <input type="reset" VALUE="Reset" />
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><br />
</td>
</tr>
<tr>
<td>
This is how much you need to have saved not accounting for inflation:
</td>
<td>
<input type="text" name="pv" SIZE="15" />
</td>
</tr>
<tr>
<td>
This is how much you need to save each month (not accounting for inflation):
</td>
<td>
<input type="text" name="pv_save" SIZE="15" />
</td>
</tr>
<tr>
<td>
This is how much you need to have saved accounting for inflation:
</td>
<td>
<input type="text" name="pv_inflate" SIZE="15" />
</td>
</tr>
<tr>
<td>
This is how much you need to save each month (accounting for inflation):
</td>
<td>
<input type="text" name="pv_inflate_save" SIZE="15" />
</td>
</tr>
</tbody>
</table>
</form>
</div>
</div><br />

</div></article></main>
        
        </div>
    </div>
    


</div>
<?php include_once 'include/footer.php'; ?>

</body>
</html>
