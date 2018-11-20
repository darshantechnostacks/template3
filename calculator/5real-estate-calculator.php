
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Real Estate Calculator For Analyzing Investment Property</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>
function stripNum(num) {

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




function formatNumberDec(num, places, comma) {

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
    myPlaces = eval(myPlaces) + eval(1);
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


function calc_prop(form) {


var v_price = stripNum(document.calc.price.value);
var v_down = stripNum(document.calc.down.value);
var v_term = stripNum(document.calc.term.value);
var v_rate = stripNum(document.calc.rate.value);
var v_pi_pmt = stripNum(document.calc.pi_pmt.value);
var v_cc = stripNum(document.calc.cc.value);
var v_gsi = stripNum(document.calc.gsi.value);
var v_vac_rate = stripNum(document.calc.vac_rate.value);
var v_units = stripNum(document.calc.units.value);
var v_other_inc = stripNum(document.calc.other_inc.value);
var v_req_cap_rate = stripNum(document.calc.req_cap_rate.value);

if(v_price <= 0) {
   alert("Please enter the purchase price of the property.");
   document.calc.price.focus();
} else
if(v_term <= 0) {
   alert("Please enter the property's loan terms in number of years.");
   document.calc.term.focus();
} else
if(v_rate <= 0) {
   alert("Please enter the property loan's annual interest rate.");
   document.calc.rate.focus();
} else
if(v_pi_pmt <= 0) {
   alert("Please enter or calculate the P & I payment.");
   document.calc.pi_pmt.focus();
} else
if(v_gsi <= 0) {
   alert("Please enter the propery's Gross Schedule Income (GSI).");
   document.calc.gsi.focus();
} else
if(v_units <= 0) {
   alert("Please enter the number of units in the building.");
   document.calc.units.focus();
} else {

   var v_ie_tot_exp = 0;
   var v_exp = 0;

   for(var i = 1; i<25; i++) {

      v_exp_cell = document.getElementById("exp_" + i + "");
      v_exp = stripNum(v_exp_cell.value);
      v_ie_tot_exp = Number(v_ie_tot_exp) + Number(v_exp);

   }

   document.calc.ie_tot_exp.value = "$" + formatNumberDec(v_ie_tot_exp,0,1);

   v_ie_gsi = v_gsi;
   document.calc.ie_gsi.value = "$" + formatNumberDec(v_ie_gsi,0,1);

   var v_ie_vac = v_vac_rate / 100 * v_gsi;
   document.calc.ie_vac.value = "$" + formatNumberDec(v_ie_vac,0,1);

   var v_ie_tot_inc = Number(v_ie_gsi) - Number(v_ie_vac);
   document.calc.ie_tot_inc.value = "$" + formatNumberDec(v_ie_tot_inc,0,1);

   var v_ie_other_inc = v_other_inc;
   document.calc.ie_other_inc.value = "$" + formatNumberDec(v_ie_other_inc,0,1);

   var v_ie_goi = Number(v_ie_tot_inc) + Number(v_ie_other_inc);
   document.calc.ie_goi.value = "$" + formatNumberDec(v_ie_goi,0,1);

   var v_ie_noi = Number(v_ie_goi) - Number(v_ie_tot_exp);
   document.calc.ie_noi.value = "$" + formatNumberDec(v_ie_noi,0,1);

   var v_ie_adc = v_pi_pmt * 12;
   document.calc.ie_adc.value = "$" + formatNumberDec(v_ie_adc,0,1);

   var v_ie_btcf = Number(v_ie_noi) - Number(v_ie_adc);
   document.calc.ie_btcf.value = "$" + formatNumberDec(v_ie_btcf,0,1);

   var v_cap = (v_ie_noi / v_price) * 100;
   document.calc.cap.value = formatNumberDec(v_cap,2,0) + "%";

   var v_tot_cash = Number(v_down) + Number(v_cc);
   var v_coc = (v_ie_btcf / v_tot_cash) * 100;
   document.calc.coc.value = formatNumberDec(v_coc,2,0) + "%";

   var v_grm = v_price / v_ie_gsi;
   document.calc.grm.value = formatNumberDec(v_grm,2,0);

   var v_nim = v_price / v_ie_noi;
   document.calc.nim.value = formatNumberDec(v_nim,2,0);

   var v_dcr = v_ie_noi / v_ie_adc;
   document.calc.dcr.value = formatNumberDec(v_dcr,2,0);

   var v_er = (v_ie_tot_exp / v_ie_goi) * 100;
   document.calc.er.value = formatNumberDec(v_er,2,0) + "%";

   var v_ppu = v_price / v_units;
   document.calc.ppu.value = "$" + formatNumberDec(v_ppu,0,1);

   if(v_req_cap_rate > 0) {

      var v_prop_val = v_ie_noi / (v_req_cap_rate / 100);
      document.calc.prop_val.value = "$" + formatNumberDec(v_prop_val,0,1);

   } else {

      document.calc.prop_val.value = "N/A";
   }
   jQuery('.email-my-results').removeClass('hidden');
}
}

function calc_down(form) {

var v_price = stripNum(document.calc.price.value);
var v_down_perc = stripNum(document.calc.down_perc.value);

if(v_price == 0) {
   alert("Please enter a purchase price.");
   document.calc.price.focus();
} else
if(v_down_perc == 0) {
   alert("Please enter a down payment percentage.");
   document.calc.down_perc.focus();
} else {

   var v_down = v_down_perc / 100 * v_price;
   document.calc.down.value = formatNumberDec(v_down,0,0);
   document.calc.pi_pmt.value = "";
}

}

function calc_taxes(form) {

var v_price = stripNum(document.calc.price.value);
var v_tax_perc = stripNum(document.calc.tax_perc.value);

if(v_price == 0) {
   alert("Please enter a purchase price.");
   document.calc.price.focus();
} else
if(v_tax_perc == 0) {
   alert("Please enter a real estate tax percentage.");
   document.calc.tax_perc.focus();
} else {

   var v_exp_16 = v_tax_perc / 100 * v_price;
   document.calc.exp_16.value = formatNumberDec(v_exp_16,0,0);

}

}

function calc_ins(form) {

var v_price = stripNum(document.calc.price.value);
var v_ins_perc = stripNum(document.calc.ins_perc.value);

if(v_price == 0) {
   alert("Please enter a purchase price.");
   document.calc.price.focus();
} else
if(v_ins_perc == 0) {
   alert("Please enter an insurance percentage.");
   document.calc.ins_perc.focus();
} else {

   var v_exp_14 = v_ins_perc / 100 * v_price;
   document.calc.exp_14.value = formatNumberDec(v_exp_14,0,0);

}

}

function calc_mgmt(form) {

var v_gsi = stripNum(document.calc.gsi.value);
var v_mgmt_perc = stripNum(document.calc.mgmt_perc.value);

if(v_gsi == 0) {
   alert("Please enter a Gross Schedule Income (GSI).");
   document.calc.gsi.focus();
} else
if(v_mgmt_perc == 0) {
   alert("Please enter a property management percentage.");
   document.calc.mgmt_perc.focus();
} else {

   var v_exp_15 = v_mgmt_perc / 100 * v_gsi;
   document.calc.exp_15.value = formatNumberDec(v_exp_15,0,0);

}

}

function calc_pmt(form) {

var v_price = stripNum(document.calc.price.value);
var v_down = stripNum(document.calc.down.value);
var v_rate = stripNum(document.calc.rate.value);
var v_term = stripNum(document.calc.term.value);

if(v_price <= 0) {
   alert("Please enter the purchase price of the property.");
   document.calc.price.focus();
} else
if(v_rate <= 0) {
   alert("Please enter the loan's annual interest rate.");
   document.calc.rate.focus();
} else
if(v_term <= 0) {
   alert("Please enter the term of the loan in number of years.");
   document.calc.term.focus();
} else {

   var v_principal = Number(v_price) - Number(v_down);

   if(document.calc.pmt_type.selectedIndex == 0) {

      var v_npr = v_term * 12;
      var v_pmt = computeMonthlyPayment(v_principal, v_npr, v_rate);

   } else {
   
      var v_pmt = v_rate / 100 / 12 * v_principal;

   }

   document.calc.pi_pmt.value = formatNumberDec(v_pmt,2,0);

}

}



function help(help_id,txt) {

var help_cell = document.getElementById("help_" + help_id + "");
help_cell.innerHTML = "<font face='arial'><small>" + txt + "</small></font>";

for(var i = 1; i<6; i++) {

   if(i != help_id) {

      var clear_cell = document.getElementById("help_" + i + "");
      clear_cell.innerHTML = "";
   }
}

}

function clear_calc(form) {

if(confirm("Are you sure you want to clear all of the calculator's entries and results?")) {

   document.calc.price.value = "";
   document.calc.down.value = "";
   document.calc.term.value = "";
   document.calc.rate.value = "";
   document.calc.pi_pmt.value = "";
   document.calc.cc.value = "";
   document.calc.gsi.value = "";
   document.calc.vac_rate.value = "";
   document.calc.units.value = "";
   document.calc.other_inc.value = "";
   document.calc.req_cap_rate.value = "";

   for(var i = 1; i<25; i++) {
      v_exp_cell = document.getElementById("exp_" + i + "");
      v_exp_cell.value = "";
   }


   document.calc.ie_tot_exp.value = "";
   document.calc.ie_gsi.value = "";
   document.calc.ie_vac.value = "";
   document.calc.ie_tot_inc.value = "";
   document.calc.ie_other_inc.value = "";
   document.calc.ie_goi.value = "";
   document.calc.ie_noi.value = "";
   document.calc.ie_adc.value = "";
   document.calc.ie_btcf.value = "";
   document.calc.cap.value = "";
   document.calc.coc.value = "";
   document.calc.grm.value = "";
   document.calc.nim.value = "";
   document.calc.dcr.value = "";
   document.calc.er.value = "";
   document.calc.ppu.value = "";
   document.calc.prop_val.value = "";

   for(var j = 1; j<6; j++) {

      var clear_cell = document.getElementById("help_" + j + "");
      clear_cell.innerHTML = "";

   }
}
}


function clear_results(form) {

   document.calc.ie_tot_exp.value = "";
   document.calc.ie_gsi.value = "";
   document.calc.ie_vac.value = "";
   document.calc.ie_tot_inc.value = "";
   document.calc.ie_other_inc.value = "";
   document.calc.ie_goi.value = "";
   document.calc.ie_noi.value = "";
   document.calc.ie_adc.value = "";
   document.calc.ie_btcf.value = "";
   document.calc.cap.value = "";
   document.calc.coc.value = "";
   document.calc.grm.value = "";
   document.calc.nim.value = "";
   document.calc.dcr.value = "";
   document.calc.er.value = "";
   document.calc.ppu.value = "";
   document.calc.prop_val.value = "";

}

function calc_b(num) {

var v_result = document.calc.result.value;
var v_new_result = v_result + "" + num;
document.calc.result.value = v_new_result;

}

function calc_sign(sgn) {

   document.calc.h_sign.value = sgn;
   document.calc.h_num_1.value = document.calc.result.value;
   document.calc.result.value = "";
   document.calc.result.focus();
}

function calc_equal(form) {

   var v_1 = Number(document.calc.h_num_1.value);
   var v_2 = Number(document.calc.result.value);
   var v_sign = document.calc.h_sign.value;
   eval("var v_new_result = " + v_1 + " " + v_sign + " " + v_2 + ";");
   document.calc.result.value = v_new_result;
   document.calc.h_num_1.value = v_new_result;
   document.calc.h_sign.value = "";
   document.calc.result.focus();

}

function calc_clr(form) {
document.calc.result.value = "";
document.calc.h_num_1.value = "";
document.calc.h_sign.value = "";
document.calc.result.focus();

}


function show_calc(num) {

var v_tbl = "<p>";


v_tbl += "<table border='0' cellspacing='0' cellpadding='1' bgcolor='#000000'>";
v_tbl += "<tr>";
v_tbl += "<td colspan='3' align='center'>";
v_tbl += "<input type='text' name='result' size='15'>";
v_tbl += "<input type='hidden' name='h_num_1'>";
v_tbl += "<input type='hidden' name='h_sign'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center'>"; 
v_tbl += "<input type='button' value='1' onClick='calc_b(1)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='2' onClick='calc_b(2)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value=' + ' onClick='calc_sign("+ '"+"' + ")'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='3' onClick='calc_b(3)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='4' onClick='calc_b(4)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value=' - ' onClick='calc_sign("+ '"-"' + ")'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='5' onClick='calc_b(5)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='6' onClick='calc_b(6)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value=' X ' onClick='calc_sign("+ '"*"' + ")'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='7' onClick='calc_b(7)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='8' onClick='calc_b(8)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value=' / ' onClick='calc_sign("+ '"/"' + ")'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='9' onClick='calc_b(9)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='0' onClick='calc_b(0)'>";
v_tbl += "</td>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value=' = ' onClick='calc_equal(this.form)'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center'>";
v_tbl += "<input type='button' value='.' onClick='calc_b("+ '"."' + ")'>";
v_tbl += "</td>";
v_tbl += "<td align='center' colspan='2'>";
v_tbl += "<input type='button' value='Clear' onClick='calc_clr(this.form)'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "<tr>";
v_tbl += "<td align='center' colspan='3'>";
v_tbl += "<input type='button' value='Hide Calc' onClick='hide_calc(" + num + ")'>";
v_tbl += "</td>";
v_tbl += "</tr>";

v_tbl += "</table>";

var v_calc_cell = document.getElementById("calc_div_" + num + "");
v_calc_cell.innerHTML = v_tbl;

}


function hide_calc(num) {

var v_calc_cell = document.getElementById("calc_div_" + num + "");
v_calc_cell.innerHTML = "<input type='button' value='Show Calc' onClick='show_calc(" + num + ")'>";



}


function create_report(form) {

   var exp_arr = new Array();
   exp_arr[0] = "Blank";
   exp_arr[1] = "Accounting";
   exp_arr[2] = "Admin/Bank Charges";
   exp_arr[3] = "Advertising";
   exp_arr[4] = "Electricity";
   exp_arr[5] = "Elevator";
   exp_arr[6] = "Gas";
   exp_arr[7] = "Landscaping";
   exp_arr[8] = "Legal";
   exp_arr[9] = "Maintenance & Repair";
   exp_arr[10] = "Payroll taxes";
   exp_arr[11] = "Permits and licenses";
   exp_arr[12] = "Pest control";
   exp_arr[13] = "Pool";
   exp_arr[14] = "Property Insurance";
   exp_arr[15] = "Property Management";
   exp_arr[16] = "Real Estate Taxes";
   exp_arr[17] = "Security";
   exp_arr[18] = "Supplies";
   exp_arr[18] = "Telephone";
   exp_arr[20] = "Tenant buyout";
   exp_arr[21] = "Trash";
   exp_arr[22] = "Water";
   exp_arr[23] = "Other";
   exp_arr[24] = "Other";


   var head = "<head><title>Residential Income Property Analysis</title><STY";
   head += "LE>";
   head += ".cell_title { font-family: arial; font-size: small; font-weight: bold; text-align: left; }";
   head += ".cell_txt_lt { font-family: arial; font-size: x-small; font-weight: normal; text-align: left; }";
   head += ".cell_txt_rt { font-family: arial; font-size: x-small; font-weight: normal; text-align: right; }";
   head += ".cell_txt_rt_b { font-family: arial; font-size: x-small; font-weight: bold; text-align: right; }";
   head += "</STY";
   head += "LE></head>";
   head += "<body bgcolor = '#FFFFFF'><br><br><center>";
   head += "<font face='arial'><big><strong>Residential Income Property Analysis</strong></big></font>";
   head += "</center>";
   head += "<br>";
   head += "<br>";
   head += "<center>";

   var tbl = "<table width='500' border='1' cellpadding='2' cellspacing='0' bordercolor='#EEEEEE'>";

   tbl += "<tr>";
   tbl += "<td colspan='3' class='cell_title'>";
   tbl += "Property Assumptions";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Purchase Price";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.price.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Down Payment";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.down.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Loan Term";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.term.value),0,0) + " Years";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Interest Rate";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.rate.value),2,0) + "%";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   if(document.calc.pmt_type.selectedIndex == 0) {
      tbl += "Principal & Interest Payment";
   } else {
      tbl += "Interest-Only Payment";
   }
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.pi_pmt.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Closing Costs";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.cc.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Gross Scheduled Income (GSI)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.gsi.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";


   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Vacancy Rate";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.vac_rate.value),2,0) + "%";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Number of Units";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.units.value),0,0) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='3' class='cell_title'>";
   tbl += "Pro-forma Income Statement & Cash Flow";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Gross Scheduled Income (GSI)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.gsi.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Less Vacancy";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_vac.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Total Actual Annual Income";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_tot_inc.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Other Income (Laundry, Late Fees, etc.)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_other_inc.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Gross Operating Income (GOI)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_goi.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='3' class='cell_title'>";
   tbl += "Annual Opertating Expenses";
   tbl += "</td>";
   tbl += "</tr>";

   var exp_amt = 0;

   for(var i = 1; i<25; i++) {

      tbl += "<tr>";
      tbl += "<td class='cell_txt_lt'>";
      tbl += "" + exp_arr[i] + "";
      tbl += "</td>";
      tbl += "<td class='cell_txt_rt'>";
      eval("exp_amt = stripNum(document.calc.exp_" + i + ".value);");

      tbl += "$" + formatNumberDec(exp_amt,0,1) + "";
      tbl += "</td>";
      tbl += "<td class='cell_txt_lt'>";
      tbl += " ";
      tbl += "</td>";
      tbl += "</tr>";

   }

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Total Operating Expenses";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_tot_exp.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Net Operating Income (NOI)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_noi.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Annual Debt Service (mortgage payments)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_adc.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Before Tax Cash Flows (BTCF)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ie_btcf.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='3' class='cell_title'>";
   tbl += "Key Operating Ratios";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Capitalization Rate";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.cap.value),2,0) + "%";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Cash on Cash (COC)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.coc.value),2,0) + "%";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Gross Rent Mulitplier (GRM)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.grm.value),2,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Net Income Mulitplier (NIM)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.nim.value),2,0) + "";
   tbl += "</td>";
   tbl += "</tr>";


   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Debt  Coverage Ratio (DCR)";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.dcr.value),2,0) + "";
   tbl += "</td>";
   tbl += "</tr>";


   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Expense Ratio (ER) Per Unit";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "" + formatNumberDec(stripNum(document.calc.er.value),2,0) + "%";
   tbl += "</td>";
   tbl += "</tr>";

   tbl += "<tr>";
   tbl += "<td colspan='2' class='cell_txt_lt'>";
   tbl += "Price Per Unit";
   tbl += "</td>";
   tbl += "<td class='cell_txt_rt'>";
   tbl += "$" + formatNumberDec(stripNum(document.calc.ppu.value),0,1) + "";
   tbl += "</td>";
   tbl += "</tr>";

   if(document.calc.prop_val.value != "N/A") {
      tbl += "<tr>";
      tbl += "<td colspan='2' class='cell_txt_lt'>";
      tbl += "Propery Value Based on " + document.calc.req_cap_rate.value + "% Required CAP Rate";
      tbl += "</td>";
      tbl += "<td class='cell_txt_rt'>";
      tbl += "$" + formatNumberDec(stripNum(document.calc.prop_val.value),0,1) + "";
      tbl += "</td>";
      tbl += "</tr>";

   }

   tbl += "</table>";
   tbl += "</center>";

   var foot = "<center><form method='post'>";
   foot += "<input type='button' value='Print Report' onClick='window.print()'><br>";
   foot += "<input type='button' value='Close Window' onClick='window.close()'></form>";
   foot += "</center></body></html>";

   var report = (head + "" + tbl + "" + foot + "");


  reportWin = window.open("","","width=600,height=500,toolbar=yes,menubar=yes,scrollbars=yes,resizable=yes");
  reportWin.document.write(report);
  reportWin.document.close();

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
                        <form name="calc" method="post">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="3">
<br><h4 align="center">Investment Property Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td width="75%" align="center" colspan="2">
<b>
Investment Property Information
</b>
</td>
<td width="25%" align="center">
<b>
Help &amp; Instruct
</b>
</td>
</tr>
<tr>
<td align="left">
Purchase Price:
</td>
<td align="center">
<input type="text" name="price" value="" size="15" tabindex="1" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the purchase price of the property.')">
</td>
<td align="center" rowspan="12" valign="top">
<small>
To receive help and/or instructions on any given line item, click inside the adjacent entry field.<br><hr><br>
</small>
<div id="help_1" style="height: 120px; text-align: left;">
</div>
<p>
</p><div id="calc_div_1">
<input type="button" value="Show Calc" onclick="show_calc(1)">
</div>
</td>
</tr>
<tr>
<td align="left">
Down Payment: <input type="text" name="down_perc" value="20" size="4" tabindex="2" onkeyup="clear_results(this.form)" onfocus="help(1,'To have the down payment amount figured for you, enter the percent down as a whole number (for 20%, enter 20) and click the [Calc Down Payment] button.')">% <input type="button" value="Calc Down Payment >>>" onclick="calc_down(this.form)">
</td>
<td align="center">
<input type="text" name="down" value="" size="15" tabindex="2" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the amount of the down payment, or enter a percentage in field in the left hand column and click the [Calc Down Payment] button.')">
</td>
</tr>
<tr>
<td align="left">
Loan Term (Years):
</td>
<td align="center">
<input type="text" name="term" value="" size="15" tabindex="3" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the term of the loan in number of years.')">
</td>
</tr>
<tr>
<td align="left">
Interest Rate (%):
</td>
<td align="center">
<input type="text" name="rate" value="" size="15" tabindex="4" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the annual interest rate of the loan.')">
</td>
</tr>
<tr>
<td align="left">
Payment Type (Select One):
</td>
<td align="center">
<select name="pmt_type" size="1" onchange="clear_results(this.form)" tabindex="5" onfocus="help(1,'If you would like the calculator to calculate the mortgage payment amount for you, select the payment type, be sure all of the loan terms are entered, and click the [Calc Payment] button.')">
<option value="1">P &amp; I</option>
<option value="2">Interest-Only</option>
</select>
</td>
</tr>
<tr>
<td align="left">
P &amp; I Payment ($): <input type="button" value="Calc Payment >>>" onclick="calc_pmt(this.form)">
</td>
<td align="center">
<input type="text" name="pi_pmt" value="" size="15" tabindex="6" onkeyup="clear_results(this.form)" onfocus="help(1,'If you know the monthly mortgage payment, enter it in the space provided. Otherwise, if you want the calculator to compute the payment for you, be sure the loan terms are entered in the appropriate fields and click the [Calc Payment] button.')">
</td>
</tr>
<tr>
<td align="left">
Closing Costs ($):
</td>
<td align="center">
<input type="text" name="cc" value="" size="15" tabindex="7" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the closing costs of the loan.')">
</td>
</tr>
<tr>
<td align="left">
Gross Scheduled Income (GSI):
</td>
<td align="center">
<input type="text" name="gsi" value="" size="15" tabindex="8" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the Gross Scheduled Income (GSI). GSI is the maximum possible annual income generated by rent collections.')">
</td>
</tr>
<tr>
<td align="left">
Vacancy Rate (%):
</td>
<td align="center">
<input type="text" name="vac_rate" value="" size="15" tabindex="9" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the expected vacancy rate as a whole number (for 10%, enter 10).')">
</td>
</tr>
<tr>
<td align="left">
Number of Units:
</td>
<td align="center">
<input type="text" name="units" value="" size="15" tabindex="10" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the number of units in the building.')">
</td>
</tr>
<tr>
<td align="left">
Other Income (laundry, late fees, etc.):
</td>
<td align="center">
<input type="text" name="other_inc" value="" size="15" tabindex="11" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter additional income generated by late fees, laundry fees, storage fees, etc.')">
</td>
</tr>
<tr>
<td align="left">
Capitalization Rate Required (Optional):
</td>
<td align="center">
<input type="text" name="req_cap_rate" value="" size="15" tabindex="12" onkeyup="clear_results(this.form)" onfocus="help(1,'If you want the calculator to compute the Property Value based on your required capitalization rate, enter the rate in this field. Otherwise you can leave it blank.')">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<b>
Annual Operating Expenses
</b>
</td>
<td align="center">
<b>
Help &amp; Instruct
</b>
</td>
</tr>
<tr>
<td align="left">
Accounting ($):
</td>
<td align="center">
<input type="text" id="exp_1" name="exp_1" value="" size="15" tabindex="13" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of accounting.')">
</td>
<td align="center" rowspan="12" valign="top">
<small>
To receive help and/or instructions on any given line item, click inside the adjacent entry field.<br><hr><br>
</small>
<div id="help_2" style="height: 120px; text-align: left;">
</div>
<p>
</p><div id="calc_div_2">
<input type="button" value="Show Calc" onclick="show_calc(2)">
</div>
</td>
</tr>
<tr>
<td align="left">
Admin/Legal/Bank Charges ($):
</td>
<td align="center">
<input type="text" id="exp_2" name="exp_2" value="" size="15" tabindex="14" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of administration and bank charges.')">
</td>
</tr>
<tr>
<td align="left">
Advertising ($):
</td>
<td align="center">
<input type="text" id="exp_3" name="exp_3" value="" size="15" tabindex="15" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost advertising.')">
</td>
</tr>
<tr>
<td align="left">
Electricity ($):
</td>
<td align="center">
<input type="text" id="exp_4" name="exp_4" value="" size="15" tabindex="16" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual electricity expense.')">
</td>
</tr>
<tr>
<td align="left">
Elevator ($):
</td>
<td align="center">
<input type="text" id="exp_5" name="exp_5" value="" size="15" tabindex="17" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual elevator expense.')">
</td>
</tr>
<tr>
<td align="left">
Gas ($):
</td>
<td align="center">
<input type="text" id="exp_6" name="exp_6" value="" size="15" tabindex="18" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of natural gas and propane.')">
</td>
</tr>
<tr>
<td align="left">
Landscaping ($):
</td>
<td align="center">
<input type="text" id="exp_7" name="exp_7" value="" size="15" tabindex="19" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of landscaping.')">
</td>
</tr>
<tr>
<td align="left">
Legal ($):
</td>
<td align="center">
<input type="text" id="exp_8" name="exp_8" value="" size="15" tabindex="20" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of legal fees.')">
</td>
</tr>
<tr>
<td align="left">
Maintenance &amp; Repair ($):
</td>
<td align="center">
<input type="text" id="exp_9" name="exp_9" value="" size="15" tabindex="21" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of maintenance &amp; repairs.')">
</td>
</tr>
<tr>
<td align="left">
Payroll Taxes ($):
</td>
<td align="center">
<input type="text" id="exp_10" name="exp_10" value="" size="15" tabindex="22" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of payroll taxes.')">
</td>
</tr>
<tr>
<td align="left">
Permits &amp; Licenses ($):
</td>
<td align="center">
<input type="text" id="exp_11" name="exp_11" value="" size="15" tabindex="23" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of permits &amp; licenses.')">
</td>
</tr>
<tr>
<td align="left">
Pest Control ($):
</td>
<td align="center">
<input type="text" id="exp_12" name="exp_12" value="" size="15" tabindex="24" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual cost of pest control.')">
</td>
</tr>
<tr>
<td align="left">
Pool ($):
</td>
<td align="center">
<input type="text" id="exp_13" name="exp_13" value="" size="15" tabindex="25" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual pool expenses.')">
</td>
<td align="center" rowspan="12" valign="top">
<small>
To receive help and/or instructions on any given line item, click inside the adjacent entry field.<br><hr><br>
</small>
<div id="help_3" style="height: 120px; text-align: left;">
</div>
<p>
</p><div id="calc_div_3">
<input type="button" value="Show Calc" onclick="show_calc(3)">
</div>
</td>
</tr>
<tr>
<td align="left">
Property Insurance ($): <input type="text" name="ins_perc" value="" size="4" tabindex="26" onkeyup="clear_results(this.form)" onfocus="help(3,'To have the insurance amount calculated for you, enter a percentage as a whole number (for .5%, enter .5) and click the [Calc Insurance] button.')">% <input type="button" value="Calc Insurance >>>" onclick="calc_ins(this.form)">
</td>
<td align="center">
<input type="text" id="exp_14" name="exp_14" value="" size="15" tabindex="26" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual property insurance. If you would like the calculator to compute it for you, enter a percentage in % field and click the [Calc Insurance] button.')">
</td>
</tr>
<tr>
<td align="left">
Property Management ($): <input type="text" name="mgmt_perc" value="" size="4" tabindex="27" onkeyup="clear_results(this.form)" onfocus="help(3,'To have the property management amount calculated for you (percentage of GSI), enter a percentage as a whole number (for 5%, enter 5) and click the [Calc Mgmt] button.')">% <input type="button" value="Calc Mgmt >>>" onclick="calc_mgmt(this.form)">
</td>
<td align="center">
<input type="text" id="exp_15" name="exp_15" value="" size="15" tabindex="27" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual cost of property management If you would like the calculator to compute it for you, enter a percentage in % field and click the [Calc Mgmt] button.')">
</td>
</tr>
<tr>
<td align="left">
Real Estate Taxes ($): <input type="text" name="tax_perc" value="" size="4" tabindex="28" onkeyup="clear_results(this.form)" onfocus="help(3,'To have the real estates taxes calculated for you, enter a percentage as a whole number (for 1.25%, enter 1.25) and click the [Calc Taxes] button.')">% <input type="button" value="Calc Taxes >>>" onclick="calc_taxes(this.form)">
</td>
<td align="center">
<input type="text" id="exp_16" name="exp_16" value="" size="15" tabindex="28" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter annual real estate taxes for the propery. If you would like the calculator to compute it for you, enter a percentage in % field and click the [Calc Taxes] button')">
</td>
</tr>
<tr>
<td align="left">
Security ($):
</td>
<td align="center">
<input type="text" id="exp_17" name="exp_17" value="" size="15" tabindex="29" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual security expenses.')">
</td>
</tr>
<tr>
<td align="left">
Supplies ($):
</td>
<td align="center">
<input type="text" id="exp_18" name="exp_18" value="" size="15" tabindex="30" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual cost of supplies.')">
</td>
</tr>
<tr>
<td align="left">
Telephone ($):
</td>
<td align="center">
<input type="text" id="exp_19" name="exp_19" value="" size="15" tabindex="31" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual telephone expenses.')">
</td>
</tr>
<tr>
<td align="left">
Tenant buyout ($):
</td>
<td align="center">
<input type="text" id="exp_20" name="exp_20" value="" size="15" tabindex="32" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual cost of tenant buyouts.')">
</td>
</tr>
<tr>
<td align="left">
Trash ($):
</td>
<td align="center">
<input type="text" id="exp_21" name="exp_21" value="" size="15" tabindex="33" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual trash expenses.')">
</td>
</tr>
<tr>
<td align="left">
Water ($):
</td>
<td align="center">
<input type="text" id="exp_22" name="exp_22" value="" size="15" tabindex="34" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the annual cost of water &amp; sewer.')">
</td>
</tr>
<tr>
<td align="left">
Other ($):
</td>
<td align="center">
<input type="text" id="exp_23" name="exp_23" value="" size="15" tabindex="35" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the other annual expenses not listed above.')">
</td>
</tr>
<tr>
<td align="left">
Other ($):
</td>
<td align="center">
<input type="text" id="exp_24" name="exp_24" value="" size="15" tabindex="36" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the other annual expenses not listed above.')">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" value="Calculate" onclick="calc_prop(this.form)">
<input type="button" value="Reset" onclick="clear_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td></tr>
<tr>
<td align="center" colspan="2">
<b>
Income Statement &amp; Cash Flow
</b>
</td>
<td align="center">
<b>
Explanations
</b>
</td>
</tr>
<tr>
<td align="right">
Gross Scheduled Income (GSI):
</td>
<td align="center">
<input type="text" name="ie_gsi" value="" tabindex="37" size="15" onfocus="help(4,'Gross Scheduled Income [GSI]. The maximum possible annual income generated by rent collections.')">
</td>
<td rowspan="9" valign="top">
<small>
For an explantion of any result, click in the adjacent result field.<br><hr><br>
</small>
<div id="help_4">
</div>
</td>
</tr>
<tr>
<td align="right">
Less Vacancy:
</td>
<td align="center">
<input type="text" name="ie_vac" value="" tabindex="38" size="15" onfocus="help(4,'Vacancy. This equal to the Gross Operating income times the vacancy rate.')">
</td>
</tr>
<tr>
<td align="right">
Total Actual Annual Income:
</td>
<td align="center">
<input type="text" name="ie_tot_inc" value="" tabindex="39" size="15" onfocus="help(4,'Total Actual Annual Income. This is the actual annual income collected after deducting vacancy amount.')">
</td>
</tr>
<tr>
<td align="right">
Other Income:
</td>
<td align="center">
<input type="text" name="ie_other_inc" value="" tabindex="40" size="15" onfocus="help(4,'Other Income. This is the additional income generated by late fees, laundry fees, storage fees etc.')">
</td>
</tr>
<tr>
<td align="right">
Gross Operating Income (GOI):
</td>
<td align="center">
<input type="text" name="ie_goi" value="" tabindex="41" size="15" onfocus="help(4,'Gross Operating Income [GOI]. GOI is calculating by subtracting the vacancy amount from the GSI and then adding other income.')">
</td>
</tr>
<tr>
<td align="right">
Total Operating Expenses:
</td>
<td align="center">
<input type="text" name="ie_tot_exp" value="" tabindex="42" size="15" onfocus="help(4,'Total Operating Expenses. This is the sum of all annual operating expenses.')">
</td>
</tr>
<tr>
<td align="right">
Net Operating Income (NOI):
</td>
<td align="center">
<input type="text" name="ie_noi" value="" tabindex="43" size="15" onfocus="help(4,'Net Operating Income [NOI]. Represents the profit amount the property generates after deducting all expenses, excluding the debt service (mortgage payments).')">
</td>
</tr>
<tr>
<td align="right">
Annual Debt Service (Mortgage Payments):
</td>
<td align="center">
<input type="text" name="ie_adc" value="" tabindex="44" size="15" onfocus="help(4,'Annual Debt Service. The total annual mortgage payment that includes the principal and interest, or interest-only in the case of an interest-only mortgage.')">
</td>
</tr>
<tr>
<td align="right">
Before Tax Cash Flows:
</td>
<td align="center">
<input type="text" name="ie_btcf" value="" tabindex="45" size="15" onfocus="help(4,'Before Tax Cash Flows [BTCF]. The positive cash flow the property generates on an annual basis.')">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<b>
Key Operating Ratios
</b>
</td>
<td align="center">
<b>
Explanations
</b>
</td>
</tr>
<tr>
<td align="right">
Capitalization Rate (CAP):
</td>
<td align="center">
<input type="text" name="cap" value="" tabindex="46" size="15" onfocus="help(5,'Capitalization Rate [CAP]. Net operating income (NOI) divided by the purchase price of the property, expressed as a percentage. The higher the better.')">
</td>
<td rowspan="8" valign="top">
<small>
For an explantion of any result, click in the adjacent result field.<br><hr><br>
</small>
<div id="help_5">
</div>
</td>
</tr>
<tr>
<td align="right">
Cash on Cash (COC):
</td>
<td align="center">
<input type="text" name="coc" value="" tabindex="47" size="15" onfocus="help(5,'Cash on Cash [COC]. The return on investment. It is equal to the Before Tax Cash Flow (BTCF) divided by the sum of all out-of-pocket aquisition costs (down payment, closings costs, etc.).')">
</td>
</tr>
<tr>
<td align="right">
Gross Rent Multiplier (GRM):
</td>
<td align="center">
<input type="text" name="grm" value="" tabindex="48" size="15" onfocus="help(5,'Gross Rent Multiplier [GRM]. Purchase price divided by the Gross Scheduled Income (GSI). The lower the number the better.')">
</td>
</tr>
<tr>
<td align="right">
Net Income Multiplier (NIM):
</td>
<td align="center">
<input type="text" name="nim" value="" tabindex="48" size="15" onfocus="help(5,'Net Income Multiplier [NIM]. The purchase price divided by the Net Operating Income (NOI). The lower the NIM the better.')">
</td>
</tr>
<tr>
<td align="right">
Debt Coverage Ratio (DCR):
</td>
<td align="center">
<input type="text" name="dcr" value="" tabindex="49" size="15" onfocus="help(5,'Debt Coverage Ratio [DCR]. The Net Operating Income (NOI) divided by the Annual Debt Service. The higher the DCR the better. A DCR below 1.0 means the property is generating a negative cash flow. A DCR above 1.2 is considered to be a good cash flowing property.')">
</td>
</tr>
<tr>
<td align="right">
Expense Ratio (ER) per Unit :
</td>
<td align="center">
<input type="text" name="er" value="" tabindex="50" size="15" onfocus="help(5,'Expense Ratio (ER) per Unit. Total Operating Expense divided by Gross Operating Income (GOI), expressed as a percentage. A percentage below 35 is considered good.')">
</td>
</tr>
<tr>
<td align="right">
Price Per Unit:
</td>
<td align="center">
<input type="text" name="ppu" value="" tabindex="51" size="15" onfocus="help(5,'Price Per Unit. Purchase price divided by the number of units in the building.')">
</td>
</tr>
<tr>
<td align="right">
Property Value Based on Required CAP Rate (if entered):
</td>
<td align="center">
<input type="text" name="prop_val" value="" tabindex="52" size="15" onfocus="help(5,'Property Value. This is the value of the property based on your Required Capitalization Rate, if you entered one.')">
</td>
</tr>
</tbody></table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
