
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Cash Flow Calculator - For Forecasting and Analysis</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">

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

function makeReport(desc1,amt1,desc2,amt2,desc3,amt3,desc4,amt4,desc5,amt5,desc6,amt6,desc7,amt7,desc8,amt8,desc9,amt9,desc10,amt10) {

var report = "";

if(desc1.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc1 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt1 + "</small></font></TD></TR>");
  }

if(desc2.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc2 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt2 + "</small></font></TD></TR>");
  }

if(desc3.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc3 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt3 + "</small></font></TD></TR>");
  }

if(desc4.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc4 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt4 + "</small></font></TD></TR>");
  }

if(desc5.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc5 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt5 + "</small></font></TD></TR>");
  }

if(desc6.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc6 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt6 + "</small></font></TD></TR>");
  }

if(desc7.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc7 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt7 + "</small></font></TD></TR>");
  }

if(desc8.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc8 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt8 + "</small></font></TD></TR>");
  }

if(desc9.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc9 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt9 + "</small></font></TD></TR>");
  }

if(desc10.length > 0) {
   report = (report + "<TR><TD><font face='arial'><small>" + desc10 + "</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + amt10 + "</small></font></TD></TR>");
  }

return report;

}


function makeLibs() {

var incomeRpt = makeReport(document.cashflow.income_1.value,document.cashflow.income_moAmt1.value,document.cashflow.income_2.value,document.cashflow.income_moAmt2.value,document.cashflow.income_3.value,document.cashflow.income_moAmt3.value,document.cashflow.income_4.value,document.cashflow.income_moAmt4.value,document.cashflow.income_5.value,document.cashflow.income_moAmt5.value,document.cashflow.income_6.value,document.cashflow.income_moAmt6.value,document.cashflow.income_7.value,document.cashflow.income_moAmt7.value,document.cashflow.income_8.value,document.cashflow.income_moAmt8.value,document.cashflow.income_9.value,document.cashflow.income_moAmt9.value,document.cashflow.income_10.value,document.cashflow.income_moAmt10.value);

incomeRpt = (incomeRpt + "<TR><TD ALIGN=RIGHT><font face='arial'><small><B>Total Cash Inflow:</B></small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.income_totMoAmt.value + "</small></font></TD></TR>");

var adminRpt = makeReport(document.cashflow.admin_1.value,document.cashflow.admin_moAmt1.value,document.cashflow.admin_2.value,document.cashflow.admin_moAmt2.value,document.cashflow.admin_3.value,document.cashflow.admin_moAmt3.value,document.cashflow.admin_4.value,document.cashflow.admin_moAmt4.value,document.cashflow.admin_5.value,document.cashflow.admin_moAmt5.value,document.cashflow.admin_6.value,document.cashflow.admin_moAmt6.value,document.cashflow.admin_7.value,document.cashflow.admin_moAmt7.value,document.cashflow.admin_8.value,document.cashflow.admin_moAmt8.value,document.cashflow.admin_9.value,document.cashflow.admin_moAmt9.value,document.cashflow.admin_10.value,document.cashflow.admin_moAmt10.value);

adminRpt = (adminRpt + "<TR><TD ALIGN=RIGHT><font face='arial'><small><B>Total Administrative Outflow:</B></small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.admin_totMoAmt.value + "</small></font></TD></TR>");

var personRpt = makeReport(document.cashflow.person_1.value,document.cashflow.person_moAmt1.value,document.cashflow.person_2.value,document.cashflow.person_moAmt2.value,document.cashflow.person_3.value,document.cashflow.person_moAmt3.value,document.cashflow.person_4.value,document.cashflow.person_moAmt4.value,document.cashflow.person_5.value,document.cashflow.person_moAmt5.value,document.cashflow.person_6.value,document.cashflow.person_moAmt6.value,document.cashflow.person_7.value,document.cashflow.person_moAmt7.value,document.cashflow.person_8.value,document.cashflow.person_moAmt8.value,document.cashflow.person_9.value,document.cashflow.person_moAmt9.value,document.cashflow.person_10.value,document.cashflow.person_moAmt10.value);

personRpt = (personRpt + "<TR><TD ALIGN=RIGHT><font face='arial'><small><B>Total Personnel Outflow:</B></small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.person_totMoAmt.value + "</small></font></TD></TR>");

var transRpt = makeReport(document.cashflow.trans_1.value,document.cashflow.trans_moAmt1.value,document.cashflow.trans_2.value,document.cashflow.trans_moAmt2.value,document.cashflow.trans_3.value,document.cashflow.trans_moAmt3.value,document.cashflow.trans_4.value,document.cashflow.trans_moAmt4.value,document.cashflow.trans_5.value,document.cashflow.trans_moAmt5.value,document.cashflow.trans_6.value,document.cashflow.trans_moAmt6.value,document.cashflow.trans_7.value,document.cashflow.trans_moAmt7.value,document.cashflow.trans_8.value,document.cashflow.trans_moAmt8.value,document.cashflow.trans_9.value,document.cashflow.trans_moAmt9.value,document.cashflow.trans_10.value,document.cashflow.trans_moAmt10.value);

transRpt = (transRpt + "<TR><TD ALIGN=RIGHT><font face='arial'><small><B>Total Transportation Outflow:</B></small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.trans_totMoAmt.value + "</small></font></TD></TR>");

var resideRpt = makeReport(document.cashflow.reside_1.value,document.cashflow.reside_moAmt1.value,document.cashflow.reside_2.value,document.cashflow.reside_moAmt2.value,document.cashflow.reside_3.value,document.cashflow.reside_moAmt3.value,document.cashflow.reside_4.value,document.cashflow.reside_moAmt4.value,document.cashflow.reside_5.value,document.cashflow.reside_moAmt5.value,document.cashflow.reside_6.value,document.cashflow.reside_moAmt6.value,document.cashflow.reside_7.value,document.cashflow.reside_moAmt7.value,document.cashflow.reside_8.value,document.cashflow.reside_moAmt8.value,document.cashflow.reside_9.value,document.cashflow.reside_moAmt9.value,document.cashflow.reside_10.value,document.cashflow.reside_moAmt10.value);

resideRpt = (resideRpt + "<TR><TD ALIGN=RIGHT><font face='arial'><small><B>Total Residential Outflow:</B></small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.reside_totMoAmt.value + "</small></font></TD></TR>");


var entertainRpt = makeReport(document.cashflow.entertain_1.value,document.cashflow.entertain_moAmt1.value,document.cashflow.entertain_2.value,document.cashflow.entertain_moAmt2.value,document.cashflow.entertain_3.value,document.cashflow.entertain_moAmt3.value,document.cashflow.entertain_4.value,document.cashflow.entertain_moAmt4.value,document.cashflow.entertain_5.value,document.cashflow.entertain_moAmt5.value,document.cashflow.entertain_6.value,document.cashflow.entertain_moAmt6.value,document.cashflow.entertain_7.value,document.cashflow.entertain_moAmt7.value,document.cashflow.entertain_8.value,document.cashflow.entertain_moAmt8.value,document.cashflow.entertain_9.value,document.cashflow.entertain_moAmt9.value,document.cashflow.entertain_10.value,document.cashflow.entertain_moAmt10.value);

entertainRpt = (entertainRpt + "<TR><TD ALIGN=RIGHT><font face='arial'><small><B>Total Entertainment Outflow:</B></small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.entertain_totMoAmt.value + "</small></font></TD></TR>");

var totalRpt =("<TR><TD><font face='arial'><small>Cash Inflows</TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.income_total.value + "</small></font></TD></TR><TR><TD><font face='arial'><small>Administrative Outflows</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.admin_total.value + "</small></font></TD></TR><TR><TD><font face='arial'><small>Personnel Outflows</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.person_total.value + "</small></font></TD></TR><TR><TD><font face='arial'><small>Transportation Outflows</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.trans_total.value + "</small></font></TD></TR><TR><TD><font face='arial'><small>Residential Outflows</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.reside_total.value + "</small></font></TD></TR><TR><TD><font face='arial'><small>Entertainment Outflows</small></font></TD><TD ALIGN=RIGHT><font face='arial'><small>" + document.cashflow.entertain_total.value + "</small></font></TD></TR><TR><TD><font face='arial'><small><B>Total Cash Outflows</B></small></font></TD><TD><font face='arial'><small>" + document.cashflow.totalOut.value + "</small></font></TD></TR><TR><TD><B>NET CASH FLOW</B></small></font></TD><TD><font face='arial'><small><B>" + document.cashflow.netFlow.value + "</B></small></font></TD></TR>");



var Vcashflow = "<HEAD><TITLE>Cash Flow Report</TITLE></HEAD>" + "<BODY BGCOLOR =  '#FFFFFF'><CENTER><FONT face='arial'><big><strong>Cash Flow Report</strong></big></FONT></CENTER><P><TABLE><TR><TD COLSPAN=2><HR><font face='arial'><small><B>Cash Inflow</B></small></font></TD></TR>" + incomeRpt + "<TR><TD COLSPAN=2><HR><font face='arial'><small><B>Administrative Outflows</B></small></font></TD></TR>" + adminRpt + "<TR><TD COLSPAN=2><HR><font face='arial'><small><B>Personnel Outflows</B></small></font></TD></TR>" + personRpt + "<TR><TD COLSPAN=2><HR><font face='arial'><small><B>Transporation Outflows</B></small></font></TD></TR>" + transRpt + "<TR><TD COLSPAN=2><HR><font face='arial'><small><B>Residential</B></small></font></TD></TR>" + resideRpt + "<TR><TD COLSPAN=2><HR><font face='arial'><small><B>Entertainment Outflows</B></small></font></TD></TR>" + entertainRpt + "<TR><TD COLSPAN=2><HR><font face='arial'><small><B>Total Inflows & Outflows</B></small></font></TD></TR>" + totalRpt + "</TABLE><P><center><font face='arial'><small>This report was created with <U>The Cash Flow Calculator</U><BR>Courtesy of FinancialMentor.Com<BR>Calculator can be found at http://www.financialmentor.com/calculator/cash-flow-calculator/</small></font><p><form method='post'><input type='button' value='Close Window' onClick='window.close()'></form></CENTER></body></html>";

libsWin = window.open("","","width=400,height=350,toolbar=yes,menubar=yes,scrollbars=yes");

libsWin.document.write(Vcashflow);
libsWin.document.close();
}

function computeLine(pmtPerYear,pmtAmount) {

var moAmount = 0;

if(pmtPerYear == "" || pmtPerYear == 0) {
      moAmount = 0;
      } else {
      moAmount = ((pmtPerYear * pmtAmount) /12);
      }
      return parseInt(moAmount,10);
   }

function computeForm(form) {

jQuery('.email-my-results').removeClass('hidden');
var accumBal = 0;

//COMPUTE INCOME

var Vincome_totMoAmt = 0;

var Vincome_ppYr1 = sn(form.income_ppYr1.value);
var Vincome_pmt1 = sn(form.income_pmt1.value);
if(Vincome_ppYr1 > 0 && Vincome_pmt1 > 0) {
   var Vincome_moAmt1 = (Vincome_ppYr1 * Vincome_pmt1) / 12;
   form.income_moAmt1.value = fn(Vincome_moAmt1,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt1);
}

var Vincome_ppYr2 = sn(form.income_ppYr2.value);
var Vincome_pmt2 = sn(form.income_pmt2.value);
if(Vincome_ppYr2 > 0 && Vincome_pmt2 > 0) {
   var Vincome_moAmt2 = (Vincome_ppYr2 * Vincome_pmt2) / 12;
   form.income_moAmt2.value = fn(Vincome_moAmt2,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt2);
}

var Vincome_ppYr3 = sn(form.income_ppYr3.value);
var Vincome_pmt3 = sn(form.income_pmt3.value);
if(Vincome_ppYr3 > 0 && Vincome_pmt3 > 0) {
   var Vincome_moAmt3 = (Vincome_ppYr3 * Vincome_pmt3) / 12;
   form.income_moAmt3.value = fn(Vincome_moAmt3,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt3);
}

var Vincome_ppYr4 = sn(form.income_ppYr4.value);
var Vincome_pmt4 = sn(form.income_pmt4.value);
if(Vincome_ppYr4 > 0 && Vincome_pmt4 > 0) {
   var Vincome_moAmt4 = (Vincome_ppYr4 * Vincome_pmt4) / 12;
   form.income_moAmt4.value = fn(Vincome_moAmt4,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt4);
}

var Vincome_ppYr5 = sn(form.income_ppYr5.value);
var Vincome_pmt5 = sn(form.income_pmt5.value);
if(Vincome_ppYr5 > 0 && Vincome_pmt5 > 0) {
   var Vincome_moAmt5 = (Vincome_ppYr5 * Vincome_pmt5) / 12;
   form.income_moAmt5.value = fn(Vincome_moAmt5,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt5);
}

var Vincome_ppYr6 = sn(form.income_ppYr6.value);
var Vincome_pmt6 = sn(form.income_pmt6.value);
if(Vincome_ppYr6 > 0 && Vincome_pmt6 > 0) {
   var Vincome_moAmt6 = (Vincome_ppYr6 * Vincome_pmt6) / 12;
   form.income_moAmt6.value = fn(Vincome_moAmt6,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt6);
}

var Vincome_ppYr7 = sn(form.income_ppYr7.value);
var Vincome_pmt7 = sn(form.income_pmt7.value);
if(Vincome_ppYr7 > 0 && Vincome_pmt7 > 0) {
   var Vincome_moAmt7 = (Vincome_ppYr7 * Vincome_pmt7) / 12;
   form.income_moAmt7.value = fn(Vincome_moAmt7,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt7);
}

var Vincome_ppYr8 = sn(form.income_ppYr8.value);
var Vincome_pmt8 = sn(form.income_pmt8.value);
if(Vincome_ppYr8 > 0 && Vincome_pmt8 > 0) {
   var Vincome_moAmt8 = (Vincome_ppYr8 * Vincome_pmt8) / 12;
   form.income_moAmt8.value = fn(Vincome_moAmt8,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt8);
}

var Vincome_ppYr9 = sn(form.income_ppYr9.value);
var Vincome_pmt9 = sn(form.income_pmt9.value);
if(Vincome_ppYr9 > 0 && Vincome_pmt9 > 0) {
   var Vincome_moAmt9 = (Vincome_ppYr9 * Vincome_pmt9) / 12;
   form.income_moAmt9.value = fn(Vincome_moAmt9,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt9);
}

var Vincome_ppYr10 = sn(form.income_ppYr10.value);
var Vincome_pmt10 = sn(form.income_pmt10.value);
if(Vincome_ppYr10 > 0 && Vincome_pmt10 > 0) {
   var Vincome_moAmt10 = (Vincome_ppYr10 * Vincome_pmt10) / 12;
   form.income_moAmt10.value = fn(Vincome_moAmt10,2,1);
   Vincome_totMoAmt = Number(Vincome_totMoAmt) + Number(Vincome_moAmt10);
}

form.income_totMoAmt.value = fn(Vincome_totMoAmt,2,1);
accumBal = Vincome_totMoAmt;

form.adminBal.value = fn(accumBal,2,1);

//COMPUTE ADMIN

var Vadmin_totMoAmt = 0;

var Vadmin_ppYr1 = sn(form.admin_ppYr1.value);
var Vadmin_pmt1 = sn(form.admin_pmt1.value);
if(Vadmin_ppYr1 > 0 && Vadmin_pmt1 > 0) {
   var Vadmin_moAmt1 = (Vadmin_ppYr1 * Vadmin_pmt1) / 12;
   form.admin_moAmt1.value = fn(Vadmin_moAmt1,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt1);
}

var Vadmin_ppYr2 = sn(form.admin_ppYr2.value);
var Vadmin_pmt2 = sn(form.admin_pmt2.value);
if(Vadmin_ppYr2 > 0 && Vadmin_pmt2 > 0) {
   var Vadmin_moAmt2 = (Vadmin_ppYr2 * Vadmin_pmt2) / 12;
   form.admin_moAmt2.value = fn(Vadmin_moAmt2,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt2);
}

var Vadmin_ppYr3 = sn(form.admin_ppYr3.value);
var Vadmin_pmt3 = sn(form.admin_pmt3.value);
if(Vadmin_ppYr3 > 0 && Vadmin_pmt3 > 0) {
   var Vadmin_moAmt3 = (Vadmin_ppYr3 * Vadmin_pmt3) / 12;
   form.admin_moAmt3.value = fn(Vadmin_moAmt3,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt3);
}

var Vadmin_ppYr4 = sn(form.admin_ppYr4.value);
var Vadmin_pmt4 = sn(form.admin_pmt4.value);
if(Vadmin_ppYr4 > 0 && Vadmin_pmt4 > 0) {
   var Vadmin_moAmt4 = (Vadmin_ppYr4 * Vadmin_pmt4) / 12;
   form.admin_moAmt4.value = fn(Vadmin_moAmt4,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt4);
}

var Vadmin_ppYr5 = sn(form.admin_ppYr5.value);
var Vadmin_pmt5 = sn(form.admin_pmt5.value);
if(Vadmin_ppYr5 > 0 && Vadmin_pmt5 > 0) {
   var Vadmin_moAmt5 = (Vadmin_ppYr5 * Vadmin_pmt5) / 12;
   form.admin_moAmt5.value = fn(Vadmin_moAmt5,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt5);
}

var Vadmin_ppYr6 = sn(form.admin_ppYr6.value);
var Vadmin_pmt6 = sn(form.admin_pmt6.value);
if(Vadmin_ppYr6 > 0 && Vadmin_pmt6 > 0) {
   var Vadmin_moAmt6 = (Vadmin_ppYr6 * Vadmin_pmt6) / 12;
   form.admin_moAmt6.value = fn(Vadmin_moAmt6,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt6);
}

var Vadmin_ppYr7 = sn(form.admin_ppYr7.value);
var Vadmin_pmt7 = sn(form.admin_pmt7.value);
if(Vadmin_ppYr7 > 0 && Vadmin_pmt7 > 0) {
   var Vadmin_moAmt7 = (Vadmin_ppYr7 * Vadmin_pmt7) / 12;
   form.admin_moAmt7.value = fn(Vadmin_moAmt7,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt7);
}

var Vadmin_ppYr8 = sn(form.admin_ppYr8.value);
var Vadmin_pmt8 = sn(form.admin_pmt8.value);
if(Vadmin_ppYr8 > 0 && Vadmin_pmt8 > 0) {
   var Vadmin_moAmt8 = (Vadmin_ppYr8 * Vadmin_pmt8) / 12;
   form.admin_moAmt8.value = fn(Vadmin_moAmt8,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt8);
}

var Vadmin_ppYr9 = sn(form.admin_ppYr9.value);
var Vadmin_pmt9 = sn(form.admin_pmt9.value);
if(Vadmin_ppYr9 > 0 && Vadmin_pmt9 > 0) {
   var Vadmin_moAmt9 = (Vadmin_ppYr9 * Vadmin_pmt9) / 12;
   form.admin_moAmt9.value = fn(Vadmin_moAmt9,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt9);
}

var Vadmin_ppYr10 = sn(form.admin_ppYr10.value);
var Vadmin_pmt10 = sn(form.admin_pmt10.value);
if(Vadmin_ppYr10 > 0 && Vadmin_pmt10 > 0) {
   var Vadmin_moAmt10 = (Vadmin_ppYr10 * Vadmin_pmt10) / 12;
   form.admin_moAmt10.value = fn(Vadmin_moAmt10,2,1);
   Vadmin_totMoAmt = Number(Vadmin_totMoAmt) + Number(Vadmin_moAmt10);
}

form.admin_totMoAmt.value = fn(Vadmin_totMoAmt,2,1);
accumBal = Number(accumBal) - Number(Vadmin_totMoAmt);

form.personBal.value = fn(accumBal,2,1);

//COMPUTE PERSONNEL

var Vperson_totMoAmt = 0;

var Vperson_ppYr1 = sn(form.person_ppYr1.value);
var Vperson_pmt1 = sn(form.person_pmt1.value);
if(Vperson_ppYr1 > 0 && Vperson_pmt1 > 0) {
   var Vperson_moAmt1 = (Vperson_ppYr1 * Vperson_pmt1) / 12;
   form.person_moAmt1.value = fn(Vperson_moAmt1,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt1);
}

var Vperson_ppYr2 = sn(form.person_ppYr2.value);
var Vperson_pmt2 = sn(form.person_pmt2.value);
if(Vperson_ppYr2 > 0 && Vperson_pmt2 > 0) {
   var Vperson_moAmt2 = (Vperson_ppYr2 * Vperson_pmt2) / 12;
   form.person_moAmt2.value = fn(Vperson_moAmt2,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt2);
}

var Vperson_ppYr3 = sn(form.person_ppYr3.value);
var Vperson_pmt3 = sn(form.person_pmt3.value);
if(Vperson_ppYr3 > 0 && Vperson_pmt3 > 0) {
   var Vperson_moAmt3 = (Vperson_ppYr3 * Vperson_pmt3) / 12;
   form.person_moAmt3.value = fn(Vperson_moAmt3,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt3);
}

var Vperson_ppYr4 = sn(form.person_ppYr4.value);
var Vperson_pmt4 = sn(form.person_pmt4.value);
if(Vperson_ppYr4 > 0 && Vperson_pmt4 > 0) {
   var Vperson_moAmt4 = (Vperson_ppYr4 * Vperson_pmt4) / 12;
   form.person_moAmt4.value = fn(Vperson_moAmt4,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt4);
}

var Vperson_ppYr5 = sn(form.person_ppYr5.value);
var Vperson_pmt5 = sn(form.person_pmt5.value);
if(Vperson_ppYr5 > 0 && Vperson_pmt5 > 0) {
   var Vperson_moAmt5 = (Vperson_ppYr5 * Vperson_pmt5) / 12;
   form.person_moAmt5.value = fn(Vperson_moAmt5,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt5);
}

var Vperson_ppYr6 = sn(form.person_ppYr6.value);
var Vperson_pmt6 = sn(form.person_pmt6.value);
if(Vperson_ppYr6 > 0 && Vperson_pmt6 > 0) {
   var Vperson_moAmt6 = (Vperson_ppYr6 * Vperson_pmt6) / 12;
   form.person_moAmt6.value = fn(Vperson_moAmt6,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt6);
}

var Vperson_ppYr7 = sn(form.person_ppYr7.value);
var Vperson_pmt7 = sn(form.person_pmt7.value);
if(Vperson_ppYr7 > 0 && Vperson_pmt7 > 0) {
   var Vperson_moAmt7 = (Vperson_ppYr7 * Vperson_pmt7) / 12;
   form.person_moAmt7.value = fn(Vperson_moAmt7,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt7);
}

var Vperson_ppYr8 = sn(form.person_ppYr8.value);
var Vperson_pmt8 = sn(form.person_pmt8.value);
if(Vperson_ppYr8 > 0 && Vperson_pmt8 > 0) {
   var Vperson_moAmt8 = (Vperson_ppYr8 * Vperson_pmt8) / 12;
   form.person_moAmt8.value = fn(Vperson_moAmt8,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt8);
}

var Vperson_ppYr9 = sn(form.person_ppYr9.value);
var Vperson_pmt9 = sn(form.person_pmt9.value);
if(Vperson_ppYr9 > 0 && Vperson_pmt9 > 0) {
   var Vperson_moAmt9 = (Vperson_ppYr9 * Vperson_pmt9) / 12;
   form.person_moAmt9.value = fn(Vperson_moAmt9,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt9);
}

var Vperson_ppYr10 = sn(form.person_ppYr10.value);
var Vperson_pmt10 = sn(form.person_pmt10.value);
if(Vperson_ppYr10 > 0 && Vperson_pmt10 > 0) {
   var Vperson_moAmt10 = (Vperson_ppYr10 * Vperson_pmt10) / 12;
   form.person_moAmt10.value = fn(Vperson_moAmt10,2,1);
   Vperson_totMoAmt = Number(Vperson_totMoAmt) + Number(Vperson_moAmt10);
}

form.person_totMoAmt.value = fn(Vperson_totMoAmt,2,1);
accumBal = Number(accumBal) - Number(Vperson_totMoAmt);

form.transBal.value = fn(accumBal,2,1);

//COMPUTE TRANSPORTATION

var Vtrans_totMoAmt = 0;

var Vtrans_ppYr1 = sn(form.trans_ppYr1.value);
var Vtrans_pmt1 = sn(form.trans_pmt1.value);
if(Vtrans_ppYr1 > 0 && Vtrans_pmt1 > 0) {
   var Vtrans_moAmt1 = (Vtrans_ppYr1 * Vtrans_pmt1) / 12;
   form.trans_moAmt1.value = fn(Vtrans_moAmt1,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt1);
}

var Vtrans_ppYr2 = sn(form.trans_ppYr2.value);
var Vtrans_pmt2 = sn(form.trans_pmt2.value);
if(Vtrans_ppYr2 > 0 && Vtrans_pmt2 > 0) {
   var Vtrans_moAmt2 = (Vtrans_ppYr2 * Vtrans_pmt2) / 12;
   form.trans_moAmt2.value = fn(Vtrans_moAmt2,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt2);
}

var Vtrans_ppYr3 = sn(form.trans_ppYr3.value);
var Vtrans_pmt3 = sn(form.trans_pmt3.value);
if(Vtrans_ppYr3 > 0 && Vtrans_pmt3 > 0) {
   var Vtrans_moAmt3 = (Vtrans_ppYr3 * Vtrans_pmt3) / 12;
   form.trans_moAmt3.value = fn(Vtrans_moAmt3,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt3);
}

var Vtrans_ppYr4 = sn(form.trans_ppYr4.value);
var Vtrans_pmt4 = sn(form.trans_pmt4.value);
if(Vtrans_ppYr4 > 0 && Vtrans_pmt4 > 0) {
   var Vtrans_moAmt4 = (Vtrans_ppYr4 * Vtrans_pmt4) / 12;
   form.trans_moAmt4.value = fn(Vtrans_moAmt4,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt4);
}

var Vtrans_ppYr5 = sn(form.trans_ppYr5.value);
var Vtrans_pmt5 = sn(form.trans_pmt5.value);
if(Vtrans_ppYr5 > 0 && Vtrans_pmt5 > 0) {
   var Vtrans_moAmt5 = (Vtrans_ppYr5 * Vtrans_pmt5) / 12;
   form.trans_moAmt5.value = fn(Vtrans_moAmt5,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt5);
}

var Vtrans_ppYr6 = sn(form.trans_ppYr6.value);
var Vtrans_pmt6 = sn(form.trans_pmt6.value);
if(Vtrans_ppYr6 > 0 && Vtrans_pmt6 > 0) {
   var Vtrans_moAmt6 = (Vtrans_ppYr6 * Vtrans_pmt6) / 12;
   form.trans_moAmt6.value = fn(Vtrans_moAmt6,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt6);
}

var Vtrans_ppYr7 = sn(form.trans_ppYr7.value);
var Vtrans_pmt7 = sn(form.trans_pmt7.value);
if(Vtrans_ppYr7 > 0 && Vtrans_pmt7 > 0) {
   var Vtrans_moAmt7 = (Vtrans_ppYr7 * Vtrans_pmt7) / 12;
   form.trans_moAmt7.value = fn(Vtrans_moAmt7,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt7);
}

var Vtrans_ppYr8 = sn(form.trans_ppYr8.value);
var Vtrans_pmt8 = sn(form.trans_pmt8.value);
if(Vtrans_ppYr8 > 0 && Vtrans_pmt8 > 0) {
   var Vtrans_moAmt8 = (Vtrans_ppYr8 * Vtrans_pmt8) / 12;
   form.trans_moAmt8.value = fn(Vtrans_moAmt8,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt8);
}

var Vtrans_ppYr9 = sn(form.trans_ppYr9.value);
var Vtrans_pmt9 = sn(form.trans_pmt9.value);
if(Vtrans_ppYr9 > 0 && Vtrans_pmt9 > 0) {
   var Vtrans_moAmt9 = (Vtrans_ppYr9 * Vtrans_pmt9) / 12;
   form.trans_moAmt9.value = fn(Vtrans_moAmt9,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt9);
}

var Vtrans_ppYr10 = sn(form.trans_ppYr10.value);
var Vtrans_pmt10 = sn(form.trans_pmt10.value);
if(Vtrans_ppYr10 > 0 && Vtrans_pmt10 > 0) {
   var Vtrans_moAmt10 = (Vtrans_ppYr10 * Vtrans_pmt10) / 12;
   form.trans_moAmt10.value = fn(Vtrans_moAmt10,2,1);
   Vtrans_totMoAmt = Number(Vtrans_totMoAmt) + Number(Vtrans_moAmt10);
}

form.trans_totMoAmt.value = fn(Vtrans_totMoAmt,2,1);
accumBal = Number(accumBal) - Number(Vtrans_totMoAmt);

form.resideBal.value = fn(accumBal,2,1);


//COMPUTE RESIDENTIAL

var Vreside_totMoAmt = 0;

var Vreside_ppYr1 = sn(form.reside_ppYr1.value);
var Vreside_pmt1 = sn(form.reside_pmt1.value);
if(Vreside_ppYr1 > 0 && Vreside_pmt1 > 0) {
   var Vreside_moAmt1 = (Vreside_ppYr1 * Vreside_pmt1) / 12;
   form.reside_moAmt1.value = fn(Vreside_moAmt1,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt1);
}

var Vreside_ppYr2 = sn(form.reside_ppYr2.value);
var Vreside_pmt2 = sn(form.reside_pmt2.value);
if(Vreside_ppYr2 > 0 && Vreside_pmt2 > 0) {
   var Vreside_moAmt2 = (Vreside_ppYr2 * Vreside_pmt2) / 12;
   form.reside_moAmt2.value = fn(Vreside_moAmt2,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt2);
}

var Vreside_ppYr3 = sn(form.reside_ppYr3.value);
var Vreside_pmt3 = sn(form.reside_pmt3.value);
if(Vreside_ppYr3 > 0 && Vreside_pmt3 > 0) {
   var Vreside_moAmt3 = (Vreside_ppYr3 * Vreside_pmt3) / 12;
   form.reside_moAmt3.value = fn(Vreside_moAmt3,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt3);
}

var Vreside_ppYr4 = sn(form.reside_ppYr4.value);
var Vreside_pmt4 = sn(form.reside_pmt4.value);
if(Vreside_ppYr4 > 0 && Vreside_pmt4 > 0) {
   var Vreside_moAmt4 = (Vreside_ppYr4 * Vreside_pmt4) / 12;
   form.reside_moAmt4.value = fn(Vreside_moAmt4,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt4);
}

var Vreside_ppYr5 = sn(form.reside_ppYr5.value);
var Vreside_pmt5 = sn(form.reside_pmt5.value);
if(Vreside_ppYr5 > 0 && Vreside_pmt5 > 0) {
   var Vreside_moAmt5 = (Vreside_ppYr5 * Vreside_pmt5) / 12;
   form.reside_moAmt5.value = fn(Vreside_moAmt5,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt5);
}

var Vreside_ppYr6 = sn(form.reside_ppYr6.value);
var Vreside_pmt6 = sn(form.reside_pmt6.value);
if(Vreside_ppYr6 > 0 && Vreside_pmt6 > 0) {
   var Vreside_moAmt6 = (Vreside_ppYr6 * Vreside_pmt6) / 12;
   form.reside_moAmt6.value = fn(Vreside_moAmt6,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt6);
}

var Vreside_ppYr7 = sn(form.reside_ppYr7.value);
var Vreside_pmt7 = sn(form.reside_pmt7.value);
if(Vreside_ppYr7 > 0 && Vreside_pmt7 > 0) {
   var Vreside_moAmt7 = (Vreside_ppYr7 * Vreside_pmt7) / 12;
   form.reside_moAmt7.value = fn(Vreside_moAmt7,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt7);
}

var Vreside_ppYr8 = sn(form.reside_ppYr8.value);
var Vreside_pmt8 = sn(form.reside_pmt8.value);
if(Vreside_ppYr8 > 0 && Vreside_pmt8 > 0) {
   var Vreside_moAmt8 = (Vreside_ppYr8 * Vreside_pmt8) / 12;
   form.reside_moAmt8.value = fn(Vreside_moAmt8,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt8);
}

var Vreside_ppYr9 = sn(form.reside_ppYr9.value);
var Vreside_pmt9 = sn(form.reside_pmt9.value);
if(Vreside_ppYr9 > 0 && Vreside_pmt9 > 0) {
   var Vreside_moAmt9 = (Vreside_ppYr9 * Vreside_pmt9) / 12;
   form.reside_moAmt9.value = fn(Vreside_moAmt9,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt9);
}

var Vreside_ppYr10 = sn(form.reside_ppYr10.value);
var Vreside_pmt10 = sn(form.reside_pmt10.value);
if(Vreside_ppYr10 > 0 && Vreside_pmt10 > 0) {
   var Vreside_moAmt10 = (Vreside_ppYr10 * Vreside_pmt10) / 12;
   form.reside_moAmt10.value = fn(Vreside_moAmt10,2,1);
   Vreside_totMoAmt = Number(Vreside_totMoAmt) + Number(Vreside_moAmt10);
}

form.reside_totMoAmt.value = fn(Vreside_totMoAmt,2,1);
accumBal = Number(accumBal) - Number(Vreside_totMoAmt);

form.entertainBal.value = fn(accumBal,2,1);

//COMPUTE ENTERTAINMENT

var Ventertain_totMoAmt = 0;

var Ventertain_ppYr1 = sn(form.entertain_ppYr1.value);
var Ventertain_pmt1 = sn(form.entertain_pmt1.value);
if(Ventertain_ppYr1 > 0 && Ventertain_pmt1 > 0) {
   var Ventertain_moAmt1 = (Ventertain_ppYr1 * Ventertain_pmt1) / 12;
   form.entertain_moAmt1.value = fn(Ventertain_moAmt1,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt1);
}

var Ventertain_ppYr2 = sn(form.entertain_ppYr2.value);
var Ventertain_pmt2 = sn(form.entertain_pmt2.value);
if(Ventertain_ppYr2 > 0 && Ventertain_pmt2 > 0) {
   var Ventertain_moAmt2 = (Ventertain_ppYr2 * Ventertain_pmt2) / 12;
   form.entertain_moAmt2.value = fn(Ventertain_moAmt2,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt2);
}

var Ventertain_ppYr3 = sn(form.entertain_ppYr3.value);
var Ventertain_pmt3 = sn(form.entertain_pmt3.value);
if(Ventertain_ppYr3 > 0 && Ventertain_pmt3 > 0) {
   var Ventertain_moAmt3 = (Ventertain_ppYr3 * Ventertain_pmt3) / 12;
   form.entertain_moAmt3.value = fn(Ventertain_moAmt3,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt3);
}

var Ventertain_ppYr4 = sn(form.entertain_ppYr4.value);
var Ventertain_pmt4 = sn(form.entertain_pmt4.value);
if(Ventertain_ppYr4 > 0 && Ventertain_pmt4 > 0) {
   var Ventertain_moAmt4 = (Ventertain_ppYr4 * Ventertain_pmt4) / 12;
   form.entertain_moAmt4.value = fn(Ventertain_moAmt4,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt4);
}

var Ventertain_ppYr5 = sn(form.entertain_ppYr5.value);
var Ventertain_pmt5 = sn(form.entertain_pmt5.value);
if(Ventertain_ppYr5 > 0 && Ventertain_pmt5 > 0) {
   var Ventertain_moAmt5 = (Ventertain_ppYr5 * Ventertain_pmt5) / 12;
   form.entertain_moAmt5.value = fn(Ventertain_moAmt5,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt5);
}

var Ventertain_ppYr6 = sn(form.entertain_ppYr6.value);
var Ventertain_pmt6 = sn(form.entertain_pmt6.value);
if(Ventertain_ppYr6 > 0 && Ventertain_pmt6 > 0) {
   var Ventertain_moAmt6 = (Ventertain_ppYr6 * Ventertain_pmt6) / 12;
   form.entertain_moAmt6.value = fn(Ventertain_moAmt6,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt6);
}

var Ventertain_ppYr7 = sn(form.entertain_ppYr7.value);
var Ventertain_pmt7 = sn(form.entertain_pmt7.value);
if(Ventertain_ppYr7 > 0 && Ventertain_pmt7 > 0) {
   var Ventertain_moAmt7 = (Ventertain_ppYr7 * Ventertain_pmt7) / 12;
   form.entertain_moAmt7.value = fn(Ventertain_moAmt7,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt7);
}

var Ventertain_ppYr8 = sn(form.entertain_ppYr8.value);
var Ventertain_pmt8 = sn(form.entertain_pmt8.value);
if(Ventertain_ppYr8 > 0 && Ventertain_pmt8 > 0) {
   var Ventertain_moAmt8 = (Ventertain_ppYr8 * Ventertain_pmt8) / 12;
   form.entertain_moAmt8.value = fn(Ventertain_moAmt8,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt8);
}

var Ventertain_ppYr9 = sn(form.entertain_ppYr9.value);
var Ventertain_pmt9 = sn(form.entertain_pmt9.value);
if(Ventertain_ppYr9 > 0 && Ventertain_pmt9 > 0) {
   var Ventertain_moAmt9 = (Ventertain_ppYr9 * Ventertain_pmt9) / 12;
   form.entertain_moAmt9.value = fn(Ventertain_moAmt9,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt9);
}

var Ventertain_ppYr10 = sn(form.entertain_ppYr10.value);
var Ventertain_pmt10 = sn(form.entertain_pmt10.value);
if(Ventertain_ppYr10 > 0 && Ventertain_pmt10 > 0) {
   var Ventertain_moAmt10 = (Ventertain_ppYr10 * Ventertain_pmt10) / 12;
   form.entertain_moAmt10.value = fn(Ventertain_moAmt10,2,1);
   Ventertain_totMoAmt = Number(Ventertain_totMoAmt) + Number(Ventertain_moAmt10);
}

form.entertain_totMoAmt.value = fn(Ventertain_totMoAmt,2,1);
accumBal = Number(accumBal) - Number(Ventertain_totMoAmt);


form.income_total.value = fn(Vincome_totMoAmt,2,1);
form.admin_total.value = fn(Vadmin_totMoAmt,2,1);
form.person_total.value = fn(Vperson_totMoAmt,2,1);
form.trans_total.value = fn(Vtrans_totMoAmt,2,1);
form.reside_total.value = fn(Vreside_totMoAmt,2,1);
form.entertain_total.value = fn(Ventertain_totMoAmt,2,1);

var VtotalOut = Number(Vadmin_totMoAmt) + Number(Vperson_totMoAmt) + Number(Vtrans_totMoAmt) + Number(Vreside_totMoAmt) + Number(Ventertain_totMoAmt);

form.totalOut.value = fn(VtotalOut,2,1);

var VnetFlow = Number(Vincome_totMoAmt) - Number(VtotalOut);
form.netFlow.value = fn(VnetFlow,2,1);

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
                        <form name="cashflow" method="post" action="#">
<table class="fmcalc" cellspacing="0">
<tbody>
<tr>
<td colspan="5">
<br><h4 align="center">Cash Flow Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="5" align="center">
<b>Cash Inflows</b>
</td>
</tr>
<tr>
<td align="center"><span id="income">
<b>Example Accounts</b>
</span></td>
<td align="center"><b>Inflow<br>Description</b></td>
<td align="center"><b># of Pmts<br>Per Year</b></td>
<td align="center"><b>Amt of<br>Each Pmt</b></td>
<td align="center"><b>Monthly<br>Amount</b></td>
</tr>
<tr>
<td valign="top" rowspan="8">
<small>
Your Primary Job<br>
Spouse's Primary Job<br>
Your Second Job<br>
Spouse's Second Job<br>
Your Business Revenues<br>
Spouse's Business Revenues<br>
Interest &amp; Dividend Income<br>
Rental Income<br>
Cash Gifts<br>
Gambling Winnings<br>
Rummage Sale Receipts<br>
Tax Refund
</small>
</td>
<td align="center"><input type="text" name="income_1" size="30"></td>
<td align="center"><input type="text" name="income_ppYr1" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt1" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt1" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_2" size="30"></td>
<td align="center"><input type="text" name="income_ppYr2" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt2" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt2" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_3" size="30"></td>
<td align="center"><input type="text" name="income_ppYr3" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt3" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt3" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_4" size="30"></td>
<td align="center"><input type="text" name="income_ppYr4" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt4" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt4" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_5" size="30"></td>
<td align="center"><input type="text" name="income_ppYr5" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt5" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt5" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_6" size="30"></td>
<td align="center"><input type="text" name="income_ppYr6" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt6" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt6" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_7" size="30"></td>
<td align="center"><input type="text" name="income_ppYr7" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt7" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt7" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_8" size="30"></td>
<td align="center"><input type="text" name="income_ppYr8" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt8" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt8" size="9"></td>
</tr>
<tr>
<td rowspan="4">
<small>
<a href="#instruct">Instructions</a><br>
Inflows<br>
<a href="#admin">Administrative</a><br>
<a href="#person">Personnel</a><br>
<a href="#trans">Transportation</a><br>
<a href="#reside">Residential</a><br>
<a href="#entertain">Entertainment</a><br>
<a href="#totals">Totals</a>
</small> 
</td>
<td align="center"><input type="text" name="income_9" size="30"></td>
<td align="center"><input type="text" name="income_ppYr9" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt9" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt9" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="income_10" size="30"></td>
<td align="center"><input type="text" name="income_ppYr10" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_pmt10" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="income_moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Monthly Inflow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="right">
Total Monthly Inflow:
</td>
<td align="center">
<input type="text" name="income_totMoAmt" size="9">
</td>
</tr>
<tr>
<td colspan="2"><span id="admin"></span>
<b>Administrative Outflows</b>
</td>
<td colspan="2" align="RIGHT">
Balance Forward:
</td>
<td align="center"><input type="text" name="adminBal" size="9">
</td>
</tr>
<tr>
<td align="center">
<b>Example Accounts</b>
</td>
<td align="center"><b>Outflow<br>Description</b></td>
<td align="center"><b># of Pmts<br>Per Year</b></td>
<td align="center"><b>Amt of<br>Each Pmt</b></td>
<td align="center"><b>Monthly<br>Amount</b></td>
</tr>
<tr>
<td valign="top" rowspan="8">
<small>
Savings Deposits<br>
Investment Deposits<br>
Office Supplies<br>
Postage<br>
Basic Phone<br>
Tax Preparation<br>
Computer Supplies<br>
Legal Expenses<br>
Misc. Payments<br>
Brokerage Fees<br>
Income Tax Payments<br>
Health Insurance<br>
Life Insurance<br>
Charitable Gifts<br>
Tools<br>
Reference Materials<br>
Classified Ads
</small>
</td>
<td align="center"><input type="text" name="admin_1" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr1" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt1" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt1" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_2" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr2" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt2" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt2" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_3" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr3" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt3" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt3" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_4" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr4" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt4" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt4" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_5" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr5" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt5" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt5" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_6" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr6" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt6" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt6" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_7" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr7" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt7" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt7" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_8" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr8" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt8" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt8" size="9"></td>
</tr>
<tr>
<td rowspan="4">
<small>
<a href="#instruct">Instructions</a><br>
<a href="#income">Inflows</a><br>
Administrative<br>
<a href="#person">Personnel</a><br>
<a href="#trans">Transportation</a><br>
<a href="#reside">Residential</a><br>
<a href="#entertain">Entertainment</a><br>
<a href="#totals">Totals</a>
</small>
</td>
<td align="center"><input type="text" name="admin_9" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr9" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt9" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt9" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="admin_10" size="30"></td>
<td align="center"><input type="text" name="admin_ppYr10" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_pmt10" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="admin_moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Monthly Admin Outflow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="RIGHT">
Total Monthly Adminsitrative Outflow:
</td>
<td align="center">
<input type="text" name="admin_totMoAmt" size="9">
</td>
</tr>
<tr>
<td colspan="2"><span id="person"></span>
<b>Personnel Outflows</b>
</td>
<td colspan="2" align="right">
Balance Forward
</td>
<td align="center"><input type="text" name="personBal" size="9">
</td>
</tr>
<tr>
<td align="center">
<b>Example Accounts</b>
</td>
<td align="center"><b>Outflow<br>Description</b></td>
<td align="center"><b># of Pmts<br>Per Year</b></td>
<td align="center"><b>Amt of<br>Each Pmt</b></td>
<td align="center"><b>Monthly<br>Amount</b></td>
</tr>
<tr>
<td valign="top" rowspan="8">
<small>
Groceries<br>
Vegetable Gardening<br>
School Lunches<br>
Toiletries &amp; Grooming<br>
Hair &amp; Make-up<br>
Medical, Dental, &amp; Optical<br>
Medication &amp; Prescriptions<br>
Clothing &amp; Laundry<br>
Dry Cleaning<br>
Education<br>
Daycare<br>
Child Support<br>
Health Club Memberships<br>
Therapy
</small>
</td>
<td align="center"><input type="text" name="person_1" size="30"></td>
<td align="center"><input type="text" name="person_ppYr1" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt1" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt1" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_2" size="30"></td>
<td align="center"><input type="text" name="person_ppYr2" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt2" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt2" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_3" size="30"></td>
<td align="center"><input type="text" name="person_ppYr3" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt3" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt3" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_4" size="30"></td>
<td align="center"><input type="text" name="person_ppYr4" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt4" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt4" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_5" size="30"></td>
<td align="center"><input type="text" name="person_ppYr5" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt5" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt5" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_6" size="30"></td>
<td align="center"><input type="text" name="person_ppYr6" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt6" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt6" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_7" size="30"></td>
<td align="center"><input type="text" name="person_ppYr7" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt7" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt7" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_8" size="30"></td>
<td align="center"><input type="text" name="person_ppYr8" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt8" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt8" size="9"></td>
</tr>
<tr>
<td rowspan="4">
<small>
<a href="#instruct">Instructions</a><br>
<a href="#income">Inflows</a><br>
<a href="#admin">Administrative</a><br>
Personnel<br>
<a href="#trans">Transportation</a><br>
<a href="#reside">Residential</a><br>
<a href="#entertain">Entertainment</a><br>
<a href="#totals">Totals</a>
</small>
</td>
<td align="center"><input type="text" name="person_9" size="30"></td>
<td align="center"><input type="text" name="person_ppYr9" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt9" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt9" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="person_10" size="30"></td>
<td align="center"><input type="text" name="person_ppYr10" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_pmt10" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="person_moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Monthly Personnel Outflow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="right">
Total Monthly Personnel Outflow:
</td>
<td align="center">
<input type="text" name="person_totMoAmt" size="9">
</td>
</tr>
<tr>
<td colspan="2"><span id="trans"></span>
<b>Transportation Outflows</b>
</td>
<td colspan="2" align="RIGHT">
Balance Forward
</td>
<td align="center"><input type="text" name="transBal" size="9">
</td>
</tr>
<tr>
<td align="center">
<b>Example Accounts</b>
</td>
<td align="center"><b>Outflow<br>Description</b></td>
<td align="center"><b># of Pmts<br>Per Year</b></td>
<td align="center"><b>Amt of<br>Each Pmt</b></td>
<td align="center"><b>Monthly<br>Amount</b></td>
</tr>
<tr>
<td valign="top" rowspan="8">
<small>
Gasoline<br>
Car Repairs &amp; Maintenance<br>
Car Insurance<br>
Car Payments<br>
Lease Payments<br>
Fares and tolls<br>
Parking<br>
Licenses &amp; Permits<br>
Fines &amp; Tickets
</small>
</td>
<td align="center"><input type="text" name="trans_1" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr1" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt1" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt1" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_2" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr2" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt2" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt2" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_3" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr3" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt3" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt3" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_4" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr4" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt4" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt4" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_5" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr5" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt5" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt5" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_6" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr6" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt6" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt6" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_7" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr7" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt7" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt7" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_8" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr8" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt8" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt8" size="9"></td>
</tr>
<tr>
<td rowspan="4">
<small>
<a href="#instruct">Instructions</a><br>
<a href="#income">Inflows</a><br>
<a href="#admin">Administrative</a><br>
<a href="#person">Personnel</a><br>
Transportation<br>
<a href="#reside">Residential</a><br>
<a href="#entertain">Entertainment</a><br>
<a href="#totals">Totals</a>
</small>
</td>
<td align="center"><input type="text" name="trans_9" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr9" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt9" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt9" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="trans_10" size="30"></td>
<td align="center"><input type="text" name="trans_ppYr10" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_pmt10" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="trans_moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Monthly Transportation Outflow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="right">
Total Monthly Transportation Outflow:
</td>
<td align="center">
<input type="text" name="trans_totMoAmt" size="9">
</td>
</tr>
<tr>
<td colspan="2"><span id="reside"></span>
<b>Residential Outflows</b>
</td>
<td colspan="2" align="right">
Balance Forward
</td>
<td align="center"><input type="text" name="resideBal" size="9">
</td>
</tr>
<tr>
<td align="center">
<b>Example Accounts</b>
</td>
<td align="center"><b>Outflow<br>Description</b></td>
<td align="center"><b># of Pmts<br>Per Year</b></td>
<td align="center"><b>Amt of<br>Each Pmt</b></td>
<td align="center"><b>Monthly<br>Amount</b></td>
</tr>
<tr>
<td valign="top" rowspan="8">
<small>
Grounds Maintenance<br>
Building Repairs &amp; Maint.<br>
Cleaning Supplies<br>
Furniture &amp; Fixtures<br>
Appliances<br>
Pest Control<br>
Interior Decorating<br>
Rent or Lease Payments<br>
Mortgage Payments<br>
Property Taxes<br>
Propane, Fuel Oil, &amp; Wood<br>
Electricty<br>
Property Insurance<br>
Snow Removal<br>
Alarm Systems
</small>
</td>
<td align="center"><input type="text" name="reside_1" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr1" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt1" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt1" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_2" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr2" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt2" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt2" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_3" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr3" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt3" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt3" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_4" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr4" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt4" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt4" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_5" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr5" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt5" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt5" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_6" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr6" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt6" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt6" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_7" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr7" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt7" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt7" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_8" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr8" size="4"></td>
<td align="center"><input type="text" name="reside_pmt8" size="9"></td>
<td align="center"><input type="text" name="reside_moAmt8" size="9"></td>
</tr>
<tr>
<td rowspan="4">
<small>
<a href="#instruct">Instructions</a><br>
<a href="#income">Inflows</a><br>
<a href="#admin">Administrative</a><br>
<a href="#person">Personnel</a><br>
<a href="#trans">Transportation</a><br>
Residential<br>
<a href="#entertain">Entertainment</a><br>
<a href="#totals">Totals</a>
</small>
</td>
<td align="center"><input type="text" name="reside_9" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr9" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt9" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt9" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="reside_10" size="30"></td>
<td align="center"><input type="text" name="reside_ppYr10" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_pmt10" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="reside_moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4">
<center>
<input type="button" value="Calculate Monthly Residential Outflow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
</center>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="right">
Total Monthly Residential Outflow:
</td>
<td align="center">
<input type="text" name="reside_totMoAmt" size="9">
</td>
</tr>
<tr>
<td colspan="2"><span id="entertain"></span>
<b>Entertainment Outflows</b>
</td>
<td colspan="2" align="right">
Balance Forward
</td>
<td align="center"><input type="text" name="entertainBal" size="9">
</td>
</tr>
<tr>
<td align="center">
<b>Example Accounts</b>
</td>
<td align="center"><b>Outflow<br>Description</b></td>
<td align="center"><b># of Pmts<br>Per Year</b></td>
<td align="center"><b>Amt of<br>Each Pmt</b></td>
<td align="center"><b>Monthly<br>Amount</b></td>
</tr>
<tr>
<td valign="top" rowspan="8">
<small>
Movies &amp; Theatrical<br>
Long Distance Calls<br>
Vidio &amp; Movie Rental<br>
Cable &amp; Satelite<br>
Sporting Events &amp; Activities<br>
Hobbies &amp; Crafts<br>
Games, Arcade, and Amusement<br>
Parties &amp; Entertaining<br>
Gifts<br>
Dining Out<br>
Nightclubs<br>
Gambling<br>
Pets &amp; Pet Supplies<br>
Music<br>
Vacation Propery Payments<br>
Vacation &amp; Travel
</small>
</td>
<td align="center"><input type="text" name="entertain_1" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr1" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt1" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt1" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_2" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr2" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt2" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt2" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_3" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr3" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt3" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt3" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_4" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr4" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt4" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt4" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_5" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr5" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt5" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt5" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_6" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr6" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt6" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt6" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_7" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr7" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt7" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt7" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_8" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr8" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt8" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt8" size="9"></td>
</tr>
<tr>
<td rowspan="4">
<small>
<a href="#instruct">Instructions</a><br>
<a href="#income">Inflows</a><br>
<a href="#admin">Administrative</a><br>
<a href="#person">Personnel</a><br>
<a href="#trans">Transportation</a><br>
<a href="#reside">Residential</a><br>
Entertainment<br>
<a href="#totals">Totals</a>
</small>
</td>
<td align="center"><input type="text" name="entertain_9" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr9" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt9" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt9" size="9"></td>
</tr>
<tr>
<td align="center"><input type="text" name="entertain_10" size="30"></td>
<td align="center"><input type="text" name="entertain_ppYr10" size="4" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_pmt10" size="9" onchange="computeForm(this.form)"></td>
<td align="center"><input type="text" name="entertain_moAmt10" size="9"></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Monthly Entertainment Outflow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td colspan="3" align="right">
Total Monthly Entertainment Outflow:
</td>
<td align="center">
<input type="text" name="entertain_totMoAmt" size="9">
</td>
</tr>
<tr>
<td colspan="5" align="center"><span id="totals"></span>
<b>Summary of Cash Flows</b>
</td>
</tr>
<tr>
<td align="center">
<b>Links</b>
</td>
<td colspan="2" align="center">
<b>Category</b>
</td>
<td align="center">
<b>Outflows</b>
</td>
<td align="center">
<b>Inflows</b>
</td>
</tr>
<tr>
<td valign="top" rowspan="9">
<small>
<a href="#instruct">Instructions</a><br>
<a href="#income">Inflows</a><br>
<a href="#admin">Administrative</a><br>
<a href="#person">Personnel</a><br>
<a href="#trans">Transportation</a><br>
<a href="#reside">Residential</a><br>
<a href="#entertain">Entertainment</a><br>
Totals
</small>
</td>
<td colspan="2">
Monthly Inflow
</td>
<td align="center"> </td>
<td align="center">
<input type="text" name="income_total" size="9">
</td>
</tr>
<tr>
<td colspan="2">
Monthly Administrative Outflow
</td>
<td align="center">
<input type="text" name="admin_total" size="9">
</td>
<td align="center"> </td>
</tr>
<tr>
<td colspan="2">
Monthly Personnel Outflow
</td>
<td align="center">
<input type="text" name="person_total" size="9">
</td>
<td align="center"> </td>
</tr>
<tr>
<td colspan="2">
Monthly Transportation Outflow
</td>
<td align="center">
<input type="text" name="trans_total" size="9">
</td>
<td align="center"> </td>
</tr>
<tr>
<td colspan="2">
Monthly Residential Outflow
</td>
<td align="center">
<input type="text" name="reside_total" size="9">
</td>
<td align="center"> </td>
</tr>
<tr>
<td colspan="2">
Monthly Entertainment Outflow
</td>
<td align="center">
<input type="text" name="entertain_total" size="9">
</td>
<td align="center"> </td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="Calculate Cash Flow" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="2" align="right">
Total Monthly Outflows
</td>
<td align="center">
<input type="text" name="totalOut" size="9">
</td>
<td align="center"> </td>
</tr>
<tr>
<td colspan="3" align="RIGHT">
Net Cash Flow
</td>
<td align="center">
<input type="text" name="netFlow" size="9">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
