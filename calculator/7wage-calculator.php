
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Wage Calculator - Convert Salary To Hourly Pay</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Wage Calculator - Convert Salary Into Hourly Pay
//ALL RIGHTS RESERVED
//Created: 01/17/2001
//Last Modified: 06/12/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-32-1256
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


function compute(form)  {

      var Vppy = document.calc.ppy.value;
      var Vtakehome = sn(document.calc.takehome.value);
      var VMoIncome = 0;

      VMoIncome = (Vtakehome * Vppy / 12);
      document.calc.MoIncome.value = fns(VMoIncome,2,1,1,1);

      var VMoExp = 0;
      var Vcarmiles = sn(document.calc.carmiles.value);
      var Vworkdays = sn(document.calc.workdays.value);
      var Vothertran = sn(document.calc.othertran.value);
      var Vdaycare = sn(document.calc.daycare.value);
      var Vmeals = sn(document.calc.meals.value);
      var Vclothing = sn(document.calc.clothing.value);
      var Vunion = sn(document.calc.union.value);
      var Vgifts = sn(document.calc.gifts.value);

      if(Vcarmiles > 0) {
         Vcarmiles = (Vcarmiles * Vworkdays * Vppy / 12 * .32);
      }

      if(Vothertran > 0) {
         Vothertran = (Vothertran * Vworkdays * Vppy / 12);
      }

      if(Vdaycare > 0) {
         Vdaycare = (Vdaycare * Vppy /12);
      }

      if(Vmeals > 0) {
         Vmeals = (Vmeals * Vworkdays * Vppy / 12 * .66);
      }

      if(Vclothing > 0) {
         Vclothing = Vclothing;
      }

      if(Vunion > 0) {
         Vunion = (Vunion * Vppy / 12);
      }

      VMoExp = Number(Vcarmiles) + Number(Vothertran) + Number(Vdaycare) + Number(Vmeals) + Number(Vclothing) + Number(Vunion) + Number(Vgifts);

      document.calc.MoExp.value = fns(VMoExp,2,1,1,1);

      var VMoProfit = Number(VMoIncome) - Number(VMoExp);

      document.calc.MoProfit.value = fns(VMoProfit,2,1,1,1);

      var VMoHours = 0;
      var Vunpaidmin = sn(document.calc.unpaidmin.value);
      var Vcommute = sn(document.calc.commute.value);
      var Vgetready = sn(document.calc.getready.value);
      var Vpaidhrs = sn(document.calc.paidhrs.value);

      if(Vunpaidmin > 0) {
         Vunpaidmin = Vunpaidmin * Vworkdays * Vppy /12 / 60;
      }

      if(Vcommute > 0) {
         Vcommute = Vcommute * Vworkdays * Vppy /12 / 60;
      }

      if(Vgetready > 0) {
         Vgetready = Vgetready * Vworkdays * Vppy /12 / 60;
      }

      if(Vpaidhrs > 0) {
         Vpaidhrs = Vpaidhrs * Vworkdays * Vppy /12;
      }

      VMoHours = Number(Vunpaidmin) + Number(Vcommute) + Number(Vgetready) + Number(Vpaidhrs);

      document.calc.MoHours.value = fns(VMoHours,0,1,0,0);

      if(VMoProfit == 0 || VMoHours == 0) {
         document.calc.RHW.value = fns(0,2,1,1,1);
      } else {
         var VRHW = Number(VMoProfit) / Number(VMoHours);
         document.calc.RHW.value = fns(VRHW,2,1,1,1);
         document.calc.hiddenRHW.value = VRHW;
      }

      jQuery('.email-my-results').removeClass('hidden');

}

function fillPPY(form) {

   if(document.calc.periodCalc.selectedIndex == 0 || document.calc.periodCalc.selectedIndex == 7) {
      document.calc.ppy.value = "";
      alert("Please manually enter the number of pay periods per year in the field provided");
      document.calc.ppy.focus();
   } else
   if(document.calc.periodCalc.selectedIndex == 1) {
      document.calc.ppy.value = "365";
      document.calc.workdays.focus();
   } else
   if(document.calc.periodCalc.selectedIndex == 2) {
      document.calc.ppy.value = "52";
      document.calc.workdays.focus();
   } else
   if(document.calc.periodCalc.selectedIndex == 3) {
      document.calc.ppy.value = "26";
      document.calc.workdays.focus();
   } else
   if(document.calc.periodCalc.selectedIndex == 4) {
      document.calc.ppy.value = "24";
      document.calc.workdays.focus();
   } else
   if(document.calc.periodCalc.selectedIndex == 5) {
      document.calc.ppy.value = "12";
      document.calc.workdays.focus();
   } else
   if(document.calc.periodCalc.selectedIndex == 6) {
      document.calc.ppy.value = "4";
      document.calc.workdays.focus();
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


function convertTime(form) {
   if(document.calc.price.value == "" || document.calc.price.value == 0) {
      alert("Please enter the price of the product or service you are thinking of purchasing.");
      document.calc.price.focus();
   } else
   if(document.calc.hiddenRHW.value == "" || document.calc.hiddenRHW.value == 0) {
      alert("Please compute your Real Hourly Wage before attempting to use this portion of the calculator.");
      document.calc.price.focus();
   } else {
   var Vprice = sn(document.calc.price.value);
   var Vrhw = document.calc.hiddenRHW.value;
   document.calc.timeHours.value = fns(Vprice / Vrhw,0,1,0,0);
   }
}

function ClearTime(form) {
   document.calc.price.value = "";
   document.calc.timeHours.value = "";
}

function clear_results(form) {

      document.calc.MoIncome.value = "";
      document.calc.MoExp.value = "";
      document.calc.MoProfit.value = "";
      document.calc.MoHours.value = "";
      document.calc.RHW.value = "";
      document.calc.hiddenRHW.value = "";
      document.calc.timeHours.value = "";

}

function clear_results_2(form) {

      document.calc.timeHours.value = "";

}

function reset_calc(form) {

   for(var i = 1; i<6; i++) {

      var clear_cell = document.getElementById("help_" + i + "");
      clear_cell.innerHTML = "";
   }

   document.calc.reset();

}

function createReport(form)  {

      var Vppy = document.calc.ppy.value;
      var Vtakehome = sn(document.calc.takehome.value);
      var VMoIncome = 0;

      VMoIncome = (Vtakehome * Vppy / 12);
      document.calc.MoIncome.value = fns(VMoIncome,2,1,1,1);

      var VMoExp = 0;
      var Vcarmiles = sn(document.calc.carmiles.value);
      var Vworkdays = sn(document.calc.workdays.value);
      var Vothertran = sn(document.calc.othertran.value);
      var Vdaycare = sn(document.calc.daycare.value);
      var Vmeals = sn(document.calc.meals.value);
      var Vclothing = sn(document.calc.clothing.value);
      var Vunion = sn(document.calc.union.value);
      var Vgifts = sn(document.calc.gifts.value);
      var VtotCarMiles = sn(document.calc.carmiles.value);

      if(Vcarmiles > 0) {
         Vcarmiles = (Vcarmiles * Vworkdays * Vppy / 12 * .32);
      }

      if(Vothertran > 0) {
         Vothertran = (Vothertran * Vworkdays * Vppy / 12);
      }

      if(Vdaycare > 0) {
         Vdaycare = (Vdaycare * Vppy /12);
      }

      if(Vmeals > 0) {
         Vmeals = (Vmeals * Vworkdays * Vppy / 12 * .66);
      }

      if(Vclothing > 0) {
         Vclothing = Vclothing;
      }

      if(Vunion > 0) {
         Vunion = (Vunion * Vppy / 12);
      }

      VMoExp = Number(Vcarmiles) + Number(Vothertran) + Number(Vdaycare) + Number(Vmeals) + Number(Vclothing) + Number(Vunion) + Number(Vgifts);

      document.calc.MoExp.value = fns(VMoExp,2,1,1,1);

      var VMoProfit = Number(VMoIncome) - Number(VMoExp);

      document.calc.MoProfit.value = fns(VMoProfit,2,1,1,1);

      var VMoHours = 0;
      var Vunpaidmin = sn(document.calc.unpaidmin.value);
      var Vcommute = sn(document.calc.commute.value);
      var Vgetready = sn(document.calc.getready.value);
      var Vpaidhrs = sn(document.calc.paidhrs.value);

      if(Vunpaidmin > 0) {
         Vunpaidmin = Vunpaidmin * Vworkdays * Vppy /12 / 60;
      }

      if(Vcommute > 0) {
         Vcommute = Vcommute * Vworkdays * Vppy /12 / 60;
      }

      if(Vgetready > 0) {
         Vgetready = Vgetready * Vworkdays * Vppy /12 / 60;
      }

      if(Vpaidhrs > 0) {
         Vpaidhrs = Vpaidhrs * Vworkdays * Vppy /12;
      }

      VMoHours = Number(Vunpaidmin) + Number(Vcommute) + Number(Vgetready) + Number(Vpaidhrs);

      document.calc.MoHours.value = fns(VMoHours,0,1,0,0);

      var VRHW = Number(VMoProfit) / Number(VMoHours);

      document.calc.RHW.value = fns(VRHW,2,1,1,1);
      document.calc.hiddenRHW.value = VRHW;

      var report = "<head><title>My Real Hourly Wage Report</title></head>";
      report += "<b";
      report += "od";
      report += "y bgcolor='#FFFFFF'><br /><br /><center><font face='arial'><big><strong>";
      report += "My Real Hourly Wage Report</strong></big></font></center><P><center>";
      report += "<table border=0 cellpadding=4><tr>";
      report += "<td><font face='arial'><small><strong>Monthly Take Home Pay:<strong></small></font></td>";
      report += "<td></td><td align='right'><font face='arial'><small><strong>" + fns(VMoIncome,2,1,1,1) + "</strong></small></font>";
      report += "<hr /></td></tr>";
      report += "<tr><td colspan=3><font face='arial'><small><strong><I>Monthly Work-Related Expenses</I></strong></small></font></td></tr>";
      report += "<tr><td><font face='arial'><small>Monthly Automobile Costs (" + fns(VtotCarMiles,0,1,0,0) + " miles):</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vcarmiles,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr><tr>";
      report += "<td><font face='arial'><small>Monthly Other Transportation Costs:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vothertran,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr>";
      report += "<tr><td><font face='arial'><small>Monthly Daycare Cost:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vdaycare,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr><tr>";
      report += "<td><font face='arial'><small>Monthly Dining-Out Cost:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vmeals,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr><tr>";
      report += "<td><font face='arial'><small>Monthly Clothing Cost:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vclothing,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr><tr>";
      report += "<td><font face='arial'><small>Monthly Union-Dues Cost:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vunion,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr><tr><td><font face='arial'><small>Monthly Office-Gift Cost:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vgifts,2,1,1,1) + "</small></font></td>";
      report += "<td></td></tr><tr>";
      report += "<td><font face='arial'><small><strong>Total Monthly Work-Related Expenses:<strong></small></font></td>";
      report += "<td></td><td align='right'>";
      report += "<font face='arial'><small><strong>" + fns(VMoExp,2,1,1,1) + "</strong></small></font><hr /></td>";
      report += "</tr><tr><td>";
      report += "<font face='arial'><small><strong>Total Monthly Net-Profit/(Loss):<strong></small></font></td>";
      report += "<td></td><td align='right'>";
      report += "<font face='arial'><small><strong><U>" + fns(VMoProfit,2,1,1,1) + "</U></strong></small></font><hr /></td>";
      report += "</tr><tr><td colspan=3>";
      report += "<font face='arial'><small><strong><I>Time Allocated to Work</I></strong></small></font></td>";
      report += "</tr><tr><td>";
      report += "<font face='arial'><small>Monthly Hours of Unpaid Breaks:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vunpaidmin,0,1,0,0) + "</small></font></td>";
      report += "<td></td></tr><tr><td><font face='arial'><small>Monthly Hours of Commute Time:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vcommute,0,1,0,0) + "</small></font></td>";
      report += "<td></td></tr><tr><td>";
      report += "<font face='arial'><small>Monthly Hours of Prep Time:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vgetready,0,1,0,0) + "</small></font></td>";
      report += "<td></td></tr><tr><td>";
      report += "<font face='arial'><small>Monthly Hours of Paid Time:</small></font></td>";
      report += "<td align='right'><font face='arial'><small>" + fns(Vpaidhrs,0,1,0,0) + "</small></font></td>";
      report += "<td></td></tr><tr><td>";
      report += "<font face='arial'><small><strong>Total Monthly Hours Allocated to Work:<strong></small></font></td>";
      report += "<td></td><td align='right'>";
      report += "<font face='arial'><small><strong>" + fns(VMoHours,0,1,0,0) + "</strong></small></font><hr /></td>";
      report += "</tr><tr><td>";
      report += "<font face='arial'><small><strong>My Real Hourly Wage:<strong></small></font></td>";
      report += "<td></td><td align='right'>";
      report += "<font face='arial'><small><strong>" + fns(VRHW,2,1,1,1) + "</strong></small></font></td>";
      report += "</tr></table><p><font face='arial'><small><small>This report was created with the <U>Wage Calculator ";
      report += "Salary Into Hourly Pay</U><br />Courtesy of FinancialMentor.Com<br />Calculator can be ";
      report += "found at https://financialmentor.com/calculator</small></small></font></p><p>";
      report += "<form method='post'><input type='button' value='Close Window' onClick='window.close()'></form>";
      report += "</p></center></body></html>";






      reportWin = window.open("","","width=500,height=300,toolbar=yes,menubar=yes,scrollbars=yes");
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
                        <form name="calc" method="post" action="#">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="3">
<br><h4 align="center">Wage Calculator – Convert Salary To Hourly Pay</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="2">
<b>
Take Home Wage
</b>
</td>
<td align="center">
<b>
Help/Instruct
</b>
</td>
</tr>
<tr>
<td>
Take Home Salary Per Pay Period:
</td>
<td align="center">
<input type="text" name="takehome" size="9" onfocus="help(1,'Enter your take home salary per pay period. Be sure to add benefits like insurance, retirement, vacation, bonus, etc.')" onkeyup="clear_results(this.form)">
</td>
<td width="125" align="center" valign="top" rowspan="2">
<div width="120" id="help_1" align="left">
</div>
</td>
</tr>
<tr>
<td>
How Many Pay Periods Per Year:
<select name="periodCalc" size="1" onchange="fillPPY(this.form)" onfocus="help(1,'Your pay periods per year will fill in automatically when you select from the pull down menu. Otherwise you may enter the number manually.')">
<option value="0">Select</option>
<option value="1">Daily</option>
<option value="2">Weekly</option>
<option value="3">Bi-Weekly</option>
<option value="4">Semi-Monthly</option>
<option value="5">Monthly</option>
<option value="6">Quarterly</option>
<option value="7">Other</option>
</select>
</td>
<td align="center">
<input type="text" name="ppy" size="9" onfocus="help(1,'If you select your pay period interval from the pull down menu, your pay periods per year will fill in automatically. Otherwise you may enter the number manually.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
<b>Calculate Total Hours On Work Related Tasks</b>
</td>
<td align="center">
<b>
Help/Instruct
</b>
</td>
</tr>
<tr>
<td>
How Many Workdays Per Pay Period?
</td>
<td align="center">
<input type="text" name="workdays" size="9" onfocus="help(2,'Enter the average number of days you work per pay period.')" onkeyup="clear_results(this.form)">
</td>
<td width="125" align="center" valign="top" rowspan="5">
<div width="120" id="help_2" align="left">
</div>
</td>
</tr>
<tr>
<td>
How Many Paid Hours Per Workday:
</td>
<td align="center">
<input type="text" name="paidhrs" size="9" onfocus="help(2,'Enter the number of hours you are actually paid per workday. If you work from 8-5, with a half-hour, unpaid break for lunch, you would enter 8.5. Be sure to include any overtime hours.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Minutes Of Unpaid Breaks Per Workday:
</td>
<td align="center">
<input type="text" name="unpaidmin" size="9" onfocus="help(2,'Enter the average number of minutes of unpaid breaks per workday including both early arrival and late departure.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Minutes Commuting Per Day:
</td>
<td align="center">
<input type="text" name="commute" size="9" onfocus="help(2,'Enter the number of minutes you spend commuting to and from work per workday.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Minutes Preparing For Work Each Day:
</td>
<td align="center">
<input type="text" name="getready" size="9" onfocus="help(2,'Enter the number of minutes you spend getting ready for work each day. Also include any minutes spent unwinding after work.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td colspan="2">
<b>Unreimbursed Work
Expenses</b>
</td>
<td align="center">
<b>
Help/Instruct
</b>
</td>
</tr>
<tr>
<td>
Miles Driven Per Day For Work:
</td>
<td align="center">
<input type="text" name="carmiles" size="9" onfocus="help(3,'Enter the average number of work-related miles you drive your own car per day. Include miles driven to and from lunch. The calculator will calculate your cost at 55-cents per mile.')" onkeyup="clear_results(this.form)">
</td>
<td width="125" align="center" valign="top" rowspan="7">
<div width="120" id="help_3" align="left">
</div>
</td>
</tr>
<tr>
<td>
Other Work Travel Costs Per Day:
</td>
<td align="center">
<input type="text" name="othertran" size="9" onfocus="help(3,'Enter any other work-related travel costs per, such as fares, parking fees and tolls.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Daycare Costs Per Pay Period:
</td>
<td align="center">
<input type="text" name="daycare" size="9" onfocus="help(3,'Enter your share of daycare costs per pay period if both spouses work. Or, enter the entire daycare cost if you are single or if quitting work would mean you would have no daycare costs.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Dining Out Expense Per Day:
</td>
<td align="center">
<input type="text" name="meals" size="9" onfocus="help(3,'Enter the average amount you spend on dining-out per day assuming you dine out more frequently because of hours spent on the job. Be sure to include the tips! The calculator will compute costs at 66% of the total (average restaurant mark-up).')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Unreimbursed Work-Related Clothing Costs Per Month:
</td>
<td align="center">
<input type="text" name="clothing" size="9" onfocus="help(3,'Enter the average amount spent on non-reimbursed, work-related clothing per month. Be sure to include any dry-cleaning costs.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Union Dues Per Pay Period:
</td>
<td align="center">
<input type="text" name="union" size="9" onfocus="help(3,'Enter any union or professional dues that you must pay per pay period to maintain your employment.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
Office Gifts Per Month:
</td>
<td align="center">
<input type="text" name="gifts" size="9" onfocus="help(3,'Enter the average amount you spend each month on work-related gifts.')" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Calculate Hourly Pay" onclick="compute(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="2">
<b>Results</b>
</td>
<td align="center">
<b>
Help/Instruct
</b>
</td>
</tr>
<tr>
<td>
Monthly Take Home Pay:
</td>
<td align="center">
<input type="text" name="MoIncome" size="15" onfocus="help(4,'This is your calculated monthly take-home pay.')">
</td>
<td width="125" align="center" valign="top" rowspan="5">
<div width="120" id="help_4" align="left">
</div>
</td>
</tr>
<tr>
<td>
Monthly Unpaid Work-Related Expenses:
</td>
<td align="center">
<input type="text" name="MoExp" size="15" onfocus="help(4,'This is the calculated total of all of your monthly work-related expenses.')">
</td>
</tr>
<tr>
<td>
Monthly Net Salary:
</td>
<td align="center">
<input type="text" name="MoProfit" size="15" onfocus="help(4,'This is the what is left after subtracting your monthly work-related expenses from your monthly take-home pay.')">
</td>
</tr>
<tr>
<td>
Total Monthly Work Hours:
</td>
<td align="center">
<input type="text" name="MoHours" size="15" onfocus="help(4,'This is the calculated total number of hours dedicated to work each month.')">
</td>
</tr>
<tr>
<td>
Real Hourly Pay:
</td>
<td align="center">
<input type="text" name="RHW" size="15" onfocus="help(4,'This is result of dividing your monthly net profit by the number of hours related to work each month.')">
</td>
</tr>
<tr>
<td colspan="2">
<b>The Life Energy Cost To Buy Anything</b><input type="HIDDEN" name="hiddenRHW">
</td>
<td align="center">
<b>
Help/Instruct
</b>
</td>
</tr>
<tr>
<td>
Enter The Price Of The Item:
</td>
<td align="center">
<input type="text" name="price" size="15" onfocus="help(5,'To see how many hours you will need to allocate to work in order to purchase something just enter the price here. Be sure to include sales-tax and any finance charges that might apply.')" onkeyup="clear_results_2(this.form)">
</td>
<td width="125" align="center" valign="top" rowspan="3">
<div width="120" id="help_5" align="left">
</div>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Hourly Wage Cost" onclick="convertTime(this.form)">
<input type="button" value="Clear Form" onclick="ClearTime(this.form)">
</td>
</tr>
<tr>
<td>
Work-hours Spent To Buy Item:
</td>
<td align="center">
<input type="text" name="timeHours" size="15" onfocus="help(5,'Based on your Real Hourly Wage, this is how many hours you will need to to work just to pay for the item.')">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
