
<!DOCTYPE html>
<html lang="en-US" >
<head>
<meta charset="UTF-8" />
<title>Retirement Investment Calculator</title>


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

   if(document.calc.downPay.value == "" || document.calc.downPay.value == 0) {
      alert("Please enter an amount in Line #1.");
      document.calc.downPay.focus();
   } else
      if(document.calc.intRate.value == "" || document.calc.intRate.value == 0) {
      alert("Please enter an amount in Line #3.");
      document.calc.intRate.focus();
   } else
      if(document.calc.numYears.value == "" || document.calc.numYears.value == 0) {
      alert("Please enter an amount in Line #4.");
      document.calc.numYears.focus();
   } else {

      var VdownPay = sn(document.calc.downPay.value);

      var VsaveBal = sn(document.calc.saveBal.value);

      var VnumYears = sn(document.calc.numYears.value);

      var intRate = sn(document.calc.intRate.value);

 
      intRate = intRate / 100.0;

      var factor1 = eval(intRate) + eval(1);

      var denom1 = 1;

      var count1 = 0;

      while(count1 < VnumYears) {
         denom1 = denom1 * factor1;
         count1 = eval(count1) + eval(1);
      }

      var VsaveFV = VsaveBal * denom1;

      document.calc.saveFV.value = "$" + fn(VsaveFV,2,1);

      var VsaveGap = eval(VdownPay) - eval(VsaveFV);

      document.calc.saveGap.value = "$" + fn(VsaveGap,2,1);

   
      var count2 = 0;

      var intRate2 = intRate / 12;

      var numMonths = VnumYears * 12;

      var factor2 = eval(1) + eval(intRate2);

      var denom2 = 1;
    
      while(count2 < numMonths) {
         denom2 = denom2 * factor2;
         count2 = eval(count2) + eval(1);
      }

      var Vpv = eval(denom2) - eval(1);

      Vpv = intRate2 / Vpv;

      Vpv = Vpv * VsaveGap;

      document.calc.moSave.value = "$" + fn(Vpv,2,1);
      jQuery('.email-my-results').removeClass('hidden');
   }
    
}



function help(num,txt) {

   var v_help_cell_1 = document.getElementById("help_1");
   var v_help_cell_2 = document.getElementById("help_2");

   if(num == 1) {
      v_help_cell_1.innerHTML = "<font face='arial'><small>" + txt + "</small></font>";
      v_help_cell_2.innerHTML = "";
   } else {
      v_help_cell_1.innerHTML = "";
      v_help_cell_2.innerHTML = "<font face='arial'><small>" + txt + "</small></font>";
   }
}

function clear_results(num) {

   var v_help_cell_1 = document.getElementById("help_1");
   var v_help_cell_2 = document.getElementById("help_2");

   if(num == 1) {
      v_help_cell_2.innerHTML = "";
   } else {
      v_help_cell_1.innerHTML = "";
   }

   document.calc.saveFV.value = "";
   document.calc.saveGap.value = "";
   document.calc.moSave.value = "";


}

function reset_calc(num) {

   document.calc.downPay.value = "";
   document.calc.saveBal.value = "";
   document.calc.numYears.value = "";
   document.calc.intRate.value = "";


   var v_help_cell_1 = document.getElementById("help_1");
   var v_help_cell_2 = document.getElementById("help_2");
   v_help_cell_1.innerHTML = "";
   v_help_cell_2.innerHTML = "";


   document.calc.saveFV.value = "";
   document.calc.saveGap.value = "";
   document.calc.moSave.value = "";


}

</script>
<style type="text/css">.essb_displayed_postfloat { margin-left: -60px !important; }.essb_displayed_postfloat.essb_postfloat_fixed { top: 50px !important; }</style>
<script type="text/javascript">
    var essb_settings = {"ajax_url":"https:\/\/financialmentor.com\/wp-admin\/admin-ajax.php","essb3_nonce":"0d7a28ae0d","essb3_plugin_url":"https:\/\/financialmentor.com\/wp-content\/plugins\/easy-social-share-buttons3","essb3_facebook_total":true,"essb3_admin_ajax":false,"essb3_internal_counter":true,"essb3_stats":false,"essb3_ga":false,"essb3_ga_mode":"simple","essb3_counter_button_min":0,"essb3_counter_total_min":0,"blog_url":"https:\/\/financialmentor.com\/","ajax_type":"wp","essb3_postfloat_stay":false,"essb3_no_counter_mailprint":false,"essb3_single_ajax":false,"twitter_counter":"self","post_id":7043,"postfloat_top":"50"};</script><style type="text/css">.broken_link, a.broken_link {
	text-decoration: line-through;
}</style></head>
<body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-7043 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none retirement-investment-calculator not_home feature-box-none footer-height-tall calculator" itemscope >
    <div class="site-container">


        <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content"><article class="post-7043 page type-page status-publish has-post-thumbnail entry" itemscope itemtype="https://schema.org/CreativeWork">
                       
                        <div class="entry-content" itemprop="text"><span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">

</span>
<input class="jpibfi" type="hidden">
<div class="visible-xs" style="text-align: center">

<div class="adsense">
<ins class="adsbygoogle" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-2975943641474809" data-ad-slot="6931488756"></ins>
</div>
</div>


<div class="fmcalc-inner-container fmcalc-ic-c4">
<div class="fmcalc-wrapper">
<form name="calc" method="post" action="#">
<table class="fmcalc" cellpadding='4' cellspacing='0'>
<tbody>
<tr>
<td colspan="3">
<br><h4 align=center>Retirement Investment Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
1. Savings Goal.
</td>
<td align="center">
<input type="text" name="downPay" size="15" onKeyUp="clear_results(1)" onFocus="help(1,'Line #1: Enter the amount of your future savings goal.')" />
</td>
<td width="125" align="center">
<b>
Instructions
</b>
</td>
</tr>
<tr>
<td>
2. Current savings balance.
</td>
<td align="center">
<input type="text" name="saveBal" size="15" onKeyUp="clear_results(1)" onFocus="help(1,'Line #2: Enter the amount of money you currently have set aside (in an interest earning account) for applying toward your future savings goal.')" />
</td>
<td width="125" align="center" valign="top" rowspan="3">
<div width="120" id="help_1" align="left">
</div>
</td>
</tr>
<tr>
<td nowrap>
3. Annual percentage rate (APR).
</td>
<td align="center">
<input type="text" name="intRate" size="15" onKeyUp="clear_results(1)" onFocus="help(1,'Line #3: Enter the annual percentage rate (as a whole number, e.g. if 6.5%, enter 6.5) that you expect your savings will grow at.')" />
</td>
</tr>
<tr>
<td>
4. Number of years.
</td>
<td align="center">
<input type="text" name="numYears" size="15" onKeyUp="clear_results(1)" onFocus="help(1,'Line #4: Enter the number of years between now and when you want to accomplish your savings goal. Then click on the [Calculate] button.')" />
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" VALUE="Calculate" onClick="computeForm(this.form)" />
<input type="button" VALUE="Reset" onClick="reset_calc(this.form)" />
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br />
</td>
<td width="125" align="center">
<b>
Explanations
</b>
</td>
</tr>
<tr>
<td>
5. Current savings future value (FV).
</td>
<td align="center">
<input type="text" name="saveFV" size="15" onFocus="help(2,'Line #5: This is the amount your current savings will grow to at the end of the specified number of years.')" />
</td>
<td width="125" align="center" valign="top" rowspan="3">
<div width="120" id="help_2" align="left">
</div>
</td>
</tr>
<tr>
<td>
6. Total savings gap.
</td>
<td align="center">
<input type="text" name="saveGap" size="15" onFocus="help(2,'Line #6: This is the total additonal amount you will need to meet your savings goal.')" />
</td>
</tr>
<tr>
<td>
7. Monthly deposit required.
</td>
<td align="center">
<input type="text" name="moSave" size="15" onFocus="help(2,'Line #7: This is how much money you will need to save every month to reach your future savings goal.')" />
</td>
</tr>
</tbody>
</table>
</form>
</div>
</div>

</div></div>
            
                
        </div>
        
    </div>
    <br/><br/><br/><br/>
    <br/><br/><br/><br/>
    <?php include_once 'include/footer.php'; ?>
</body>
</html>








  




