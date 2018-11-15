
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Cost Calculator</title>

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


function calc_cost(n) {

var VsalesTax_fld = document.getElementById("salesTax" + n);
var VpriceTag_fld = document.getElementById("priceTag" + n);
var warCost_fld = document.getElementById("warranty" + n);
var Vlicense_fld = document.getElementById("license" + n);
var VlifeExpect_fld = document.getElementById("lifeExpect" + n);
var Vage_fld = document.getElementById("age" + n);
var int_fld = document.getElementById("intRate" + n);
var VdownPay_fld = document.getElementById("downPay" + n);
var VnPer_fld = document.getElementById("nPer" + n);
var Vmiles_fld = document.getElementById("miles" + n);
var Vmpg_fld = document.getElementById("mpg" + n);
var VperGal_fld = document.getElementById("perGal" + n);
var Vmaint_fld = document.getElementById("maint" + n);
var Vinsure_fld = document.getElementById("insure" + n);

var Vfinance_fld = document.getElementById("finance" + n);

var VsalesTax = sn(VsalesTax_fld.value);
var VpriceTag = sn(VpriceTag_fld.value);
var warCost = sn(warCost_fld.value);
var Vlicense = sn(Vlicense_fld.value);
var VlifeExpect = sn(VlifeExpect_fld.value);
var Vage = sn(Vage_fld.value);
var int = sn(int_fld.value);
var VdownPay = sn(VdownPay_fld.value);
var VnPer = sn(VnPer_fld.value);
var Vmiles = sn(Vmiles_fld.value);
var Vmpg = sn(Vmpg_fld.value);
var VperGal = sn(VperGal_fld.value);
var Vmaint = sn(Vmaint_fld.value);
var Vinsure = sn(Vinsure_fld.value);

var Vfinance = Vfinance_fld.options[Vfinance_fld.selectedIndex].value;

if(VpriceTag == 0) {
  alert("Please enter the purchase price for Scenario #" + n + "");
  VpriceTag_fld.focus();
} else
if(VsalesTax == 0) {
  alert("Please enter the sales tax percentage for Scenario #" + n + "");
  VsalesTax_fld.focus();
} else
if(Vlicense == 0) {
  alert("Please enter the annual licensing cost for Scenario #" + n + "");
  Vlicense_fld.focus();
} else
if(Vfinance == "y" && VnPer == 0) {
  alert("Please enter the number of months you are financing the car for in Scenario #" + n + "");
  VnPer_fld.focus();
} else
if(Vinsure == 0) {
  alert("Please enter the annual insurance cost for Scenario #" + n + "");
  Vinsure_fld.focus();
} else
if(Vmiles == 0) {
  alert("Please enter the number miles you expect to drive the Scenario #" + n + " car per year.");
  Vmiles_fld.focus();
} else
if(Vmpg == 0) {
  alert("Please enter the Miles per Gallon (MPG) rating of the Scenario #" + n + " car.");
  Vmpg_fld.focus();
} else
if(VperGal == 0) {
  alert("Please enter the local cost of one gallon of gas for the Scenario #" + n + " car.");
  VperGal_fld.focus();
} else
if(VlifeExpect == 0) {
  alert("Please enter the number of years you expect to own the Scenario #" + n + " car.");
  VlifeExpect_fld.focus();
} else {

  ageFact = new Array(28,20,16,8,6,5,4,3,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);

  purchCost_fld = document.getElementById("purchCost" + n);
  depreCost_fld = document.getElementById("depreCost" + n);
  intCost_fld = document.getElementById("intCost" + n);
  gas_fld = document.getElementById("gas" + n);
  maintCost_fld = document.getElementById("maintCost" + n);
  insCost_fld = document.getElementById("insCost" + n);
  totCost_fld = document.getElementById("totCost" + n);
  annCost_fld = document.getElementById("annCost" + n);
  mileCost_fld = document.getElementById("mileCost" + n);

  //Tax, License, and warranty Costs

  var tax = 0;
  var taxCost = 0;

  if(VsalesTax >= 1) {tax = VsalesTax / 100; } else {tax = VsalesTax; }

  if(tax > 0) {taxCost = VpriceTag * tax; } else {taxCost = 0; }

  var licCost = 0;
  var totPurch = 0;

  licCost = Vlicense * VlifeExpect;

  totPurch = Number(taxCost) + Number(licCost) + Number(warCost);

  purchCost_fld.value = fns(totPurch,2,1,1,1);


  //Depreciation Costs

  var timePass = Number(Vage);
  var accumDeprec = ageFact[Vage]; 

  while(timePass < Number(VlifeExpect) + Number(Vage) - Number(1)) {
      timePass = Number(timePass + 1);
      accumDeprec = accumDeprec + ageFact[Number(timePass * 1)];
      if(timePass > 50) {break; } else {continue; }
  }

  //newVar
  var VdepreCost = accumDeprec / 100 * VpriceTag;
  depreCost_fld.value = fns(VdepreCost,2,1,1,1);
  

  //Finance Costs

  //newVar
  var VintCost = 0;

  if(Vfinance == "n" || int_fld.value == 0 || VnPer_fld.value == 0) {
     VdownPay_fld.value = 0;
     int_fld.value = 0;
     VnPer_fld.value = 0;
     intCost_fld.value = fns(VintCost,2,1,1,1);
  } else {

     if (int >= 1.0) {int = int / 100.0; }

     int /= 12;

     var prin = Number(VpriceTag) + Number(taxCost) + Number(Vlicense) + Number(warCost) - Number(VdownPay);

     var pmt = 0;

     var pow = 1;

     for(var j = 0; j < VnPer; j++) {

        pow = pow * (1 + int);

     }

     pmt = (prin * pow * int) / (Number(pow) - Number(1));

     if(VnPer / 12 <= VlifeExpect) {
        VintCost = parseInt((pmt * VnPer) - prin,10);
        intCost_fld.value =  fns(VintCost,2,1,1,1);
     } else {

        var intPort = 0;
        var PrinPort = 0;
        var count = 0;
        var accumPrin = 0;
        var accumInt =0;

        while(count < VlifeExpect * 12) {

           intPort = prin * int;
           prinPort = pmt - intPort;
           prin = prin - prinPort;
           accumPrin = accumPrin + prinPort;
           accumInt = accumInt + intPort;
           count = count + 1;
           if(count > 600) {
              break;
           } else {
              continue;
           }

        }
 
        VintCost = accumInt;
        intCost_fld.value = fns(VintCost,2,1,1,1);
     }
  }

  //Operating Costs

  //newVar
  var Vgas = Vmiles * VlifeExpect / Vmpg * VperGal;
  gas_fld.value = fns(Vgas,2,1,1,1);

  //Maintenance & Repair Costs

  var VmaintCost = Vmaint * 12 * VlifeExpect;
  maintCost_fld.value = fns(VmaintCost,2,1,1,1);


  //Insurance Costs

  var VinsCost = Vinsure * VlifeExpect;
  insCost_fld.value = fns(VinsCost,2,1,1,1);


  //Total Costs #1

  var VtotCost = Number(totPurch) + Number(VdepreCost) + Number(VintCost) + Number(Vgas) + Number(VmaintCost) + Number(VinsCost);
  totCost_fld.value = fns(VtotCost,2,1,1,1);

  var VannCost = VtotCost / VlifeExpect;
  annCost_fld.value = fns(VannCost,2,1,1,1);

  var VmileCost = VannCost / Vmiles;
  mileCost_fld.value = fns(VmileCost,2,1,1,1);

}

}


function computeForm(form) {

calc_cost(1);

var VpriceTag_fld = document.getElementById("priceTag2");
var VpriceTag = sn(VpriceTag_fld.value);

if(VpriceTag > 0) {

  calc_cost(2);


  annCost1_fld = document.getElementById("annCost1");
  annCost2_fld = document.getElementById("annCost2");

  VannCost1 = sn(annCost1_fld.value);
  VannCost2 = sn(annCost2_fld.value);


  var fsummary = 0;
  var scenario = "";

  var v_summary_cell = document.getElementById("summary");

  if(Number(VannCost1) - Number(VannCost2) < .01 && Number(VannCost2) - Number(VannCost1) < .01) {
     v_summary_cell.innerHTML = ("<font face='arial'><small>No savings generated.</small></font>");
  } else {

     if(VannCost1 > VannCost2) {
        fsummary = Number(VannCost1) - Number(VannCost2);
        scenario = "Scenario #2";
     } else {
        fsummary = Number(VannCost2) - Number(VannCost1);
        scenario = "Scenario #1"; 
     }

     v_summary_cell.innerHTML = ("<font face='arial'><small>" + scenario + " will save you " + fns(fsummary,2,1,1,1) + " per year.</small></font>");
  }

}
jQuery('.email-my-results').removeClass('hidden');
}

function copyPaste(form) {

document.calc.priceTag2.value = document.calc.priceTag1.value;
document.calc.salesTax2.value =  document.calc.salesTax1.value;
document.calc.warranty2.value = document.calc.warranty1.value;
document.calc.license2.value = document.calc.license1.value;
document.calc.downPay2.value = document.calc.downPay1.value;
document.calc.insure2.value = document.calc.insure1.value;
document.calc.finance2.selectedIndex = document.calc.finance1.selectedIndex;
document.calc.intRate2.value = document.calc.intRate1.value;
document.calc.nPer2.value = document.calc.nPer1.value;
document.calc.miles2.value = document.calc.miles1.value;
document.calc.mpg2.value = document.calc.mpg1.value;
document.calc.perGal2.value = document.calc.perGal1.value;
document.calc.maint2.value = document.calc.maint1.value;
document.calc.age2.value = document.calc.age1.value;
document.calc.lifeExpect2.value = document.calc.lifeExpect1.value;
document.calc.purchCost2.value = document.calc.purchCost1.value;
document.calc.depreCost2.value = document.calc.depreCost1.value;
document.calc.intCost2.value = document.calc.intCost1.value;
document.calc.insCost2.value = document.calc.insCost1.value;
document.calc.gas2.value = document.calc.gas1.value;
document.calc.maintCost2.value = document.calc.maintCost1.value;
document.calc.totCost2.value = document.calc.totCost1.value;
document.calc.annCost2.value = document.calc.annCost1.value;
document.calc.mileCost2.value = document.calc.mileCost1.value;

var v_summary_cell = document.getElementById("summary");
v_summary_cell.innerHTML = ("<font face='arial'><small>Change the variables in either Scenario and compute.</small></font>");

clear_results(document.calc);

}

function clear_results(form) {

document.calc.purchCost1.value = "";
document.calc.depreCost1.value = "";
document.calc.intCost1.value =  "";
document.calc.gas1.value = "";
document.calc.maintCost1.value = "";
document.calc.insCost1.value = "";
document.calc.totCost1.value = "";
document.calc.annCost1.value = "";
document.calc.mileCost1.value = "";

document.calc.purchCost2.value = "";
document.calc.depreCost2.value = "";
document.calc.intCost2.value =  "";
document.calc.gas2.value = "";
document.calc.maintCost2.value = "";
document.calc.insCost2.value = "";
document.calc.totCost2.value = "";
document.calc.annCost2.value = "";
document.calc.mileCost2.value = "";

var v_summary_cell = document.getElementById("summary");
v_summary_cell.innerHTML = "";

}

function reset_calc(form) {

var v_summary_cell = document.getElementById("summary");
v_summary_cell.innerHTML = "";

document.calc.reset();

}

function skip_col(formEl) {

if(document.calc.singleDbl.value == 1) {

  var next_x;

  for( var x=0; x< calc.length; x++) {
     if (calc[x].id == formEl.id) {
        next_x = x + 1;
     }
  }


  calc[next_x].focus();
  if(calc[next_x].type == "text") {
     calc[next_x].select();
  }

}
}


function switchSingle(form) {
document.calc.singleDbl.value = 1;
}

function switchDouble(form) {
document.calc.singleDbl.value = 2;
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
<tr]>
</tr]><table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="3">
<br><h4 align="center">Car Cost Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="radio" name="calcMethod" value="single" checked="" onclick="switchSingle(this.form)"> Single Car Calculation
<input type="radio" name="calcMethod" value="double" onclick="switchDouble(this.form)"> Double Car Calculation
<input type="hidden" name="singleDbl" value="1">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" value="Copy Car #1 Entries to Car #2" onclick="copyPaste(this.form)">
</td>
</tr>
<tr><td align="center">
<b>
Entry Descriptions
</b>
</td>
<td align="center">
<b>
Car #1
</b>
</td>
<td align="center">
<b>
Car #2
</b>
</td>
</tr>
<tr>
<td>
Purchase price:
</td>
<td align="center">
<input type="text" id="priceTag1" name="priceTag1" value="25000" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="priceTag2" name="priceTag2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter sales-tax percentage:
</td>
<td align="center">
<input type="text" id="salesTax1" name="salesTax1" value="7.35" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="salesTax2" name="salesTax2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter annual license cost:
</td>
<td align="center">
<input type="text" id="license1" name="license1" value="137" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="license2" name="license2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter extended warranty cost:
</td>
<td align="center">
<input type="text" id="warranty1" name="warranty1" value="0" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="warranty2" name="warranty2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Will you be financing this car?:
</td>
<td align="center">
<select id="finance1" name="finance1" size="1" onchange="clear_results(this.form)">
<option value="y" selected="">Yes</option>
<option value="n">No</option>
</select>
</td>
<td align="center">
<select id="finance2" name="finance2" size="1" onfocus="skip_col(this);" onchange="clear_results(this.form)">
<option value="y" selected="">Yes</option>
<option value="n">No</option>
</select>
</td>
</tr>
<tr>
<td>
Enter down payment amount:
</td>
<td align="center">
<input type="text" id="downPay1" name="downPay1" value="1000" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="downPay2" name="downPay2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter financing rate (APR):
</td>
<td align="center">
<input type="text" id="intRate1" name="intRate1" value="7.9" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="intRate2" name="intRate2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter financing term (# months):
</td>
<td align="center">
<input type="text" id="nPer1" name="nPer1" value="60" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="nPer2" name="nPer2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter annual insurance cost:
</td>
<td align="center">
<input type="text" id="insure1" name="insure1" value="850" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="insure2" name="insure2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter expected annual driving mileage:
</td>
<td align="center">
<input type="text" id="miles1" name="miles1" value="20000" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="miles2" name="miles2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter car Miles Per Gallon rating:
</td>
<td align="center">
<input type="text" id="mpg1" name="mpg1" value="22" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="mpg2" name="mpg2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter cost of one gallon of gasoline:
</td>
<td align="center">
<input type="text" id="perGal1" name="perGal1" value="2.45" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="perGal2" name="perGal2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
How many years old is the car?:
</td>
<td align="center">
<input type="text" id="age1" name="age1" value="0" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="age2" name="age2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
How many years do you expect to own this car?:
</td>
<td align="center">
<input type="text" id="lifeExpect1" name="lifeExpect1" value="3" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="lifeExpect2" name="lifeExpect2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Enter estimated monthly maintenance/ repair cost:
</td>
<td align="center">
<input type="text" id="maint1" name="maint1" value="35" size="9" onkeyup="clear_results(this.form)">
</td>
<td align="center">
<input type="text" id="maint2" name="maint2" size="9" onfocus="skip_col(this);" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Calculate Car Cost" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Tax, License, and Warranty Costs:
</td>
<td align="center">
<input type="text" id="purchCost1" name="purchCost1" size="9">
</td>
<td align="center">
<input type="text" id="purchCost2" name="purchCost2" size="9">
</td>
</tr>
<tr>
<td>
Depreciation Costs:
</td>
<td align="center">
<input type="text" id="depreCost1" name="depreCost1" size="9">
</td>
<td align="center">
<input type="text" id="depreCost2" name="depreCost2" size="9">
</td>
</tr>
<tr>
<td>
Finance Costs:
</td>
<td align="center">
<input type="text" id="intCost1" name="intCost1" size="9">
</td>
<td align="center">
<input type="text" id="intCost2" name="intCost2" size="9">
</td>
</tr>
<tr>
<td>
Insurance Costs:
</td>
<td align="center">
<input type="text" id="insCost1" name="insCost1" size="9">
</td>
<td align="center">
<input type="text" id="insCost2" name="insCost2" size="9">
</td>
</tr>
<tr>
<td>
Fuel Costs:
</td>
<td align="center">
<input type="text" id="gas1" name="gas1" size="9">
</td>
<td align="center">
<input type="text" id="gas2" name="gas2" size="9">
</td>
</tr>
<tr>
<td>
Maintenance &amp; Repair Costs:
</td>
<td align="center">
<input type="text" id="maintCost1" name="maintCost1" size="9">
</td>
<td align="center">
<input type="text" id="maintCost2" name="maintCost2" size="9">
</td>
</tr>
<tr>
<td>
Total cost of owning the car:
</td>
<td align="center">
<input type="text" id="totCost1" name="totCost1" size="9">
</td>
<td align="center">
<input type="text" id="totCost2" name="totCost2" size="9">
</td>
</tr>
<tr>
<td>
Annual cost to own this car:
</td>
<td align="center">
<input type="text" id="annCost1" name="annCost1" size="9">
</td>
<td align="center">
<input type="text" id="annCost2" name="annCost2" size="9">
</td>
</tr>
<tr>
<td>
Cost per mile:
</td>
<td align="center">
<input type="text" id="mileCost1" name="mileCost1" size="9">
</td>
<td align="center">
<input type="text" id="mileCost2" name="mileCost2" size="9">
</td>
</tr>
<tr>
<td align="center" colspan="3" id="summary">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
