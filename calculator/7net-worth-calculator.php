
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Net Worth Calculator - Calculate Your Personal Balance Sheet</title>

<?php include_once 'include/header.php'; ?>
<script language="JavaScript">
//*******************************************
//COPYWRITE INFO!
//Net Worth Calculator - How To Calculate Your Personal Balance Sheet
//ALL RIGHTS RESERVED
//Created: 03/31/2004
//Last Modified: 05/09/2009
//This script may not be copied, edited, distributed or reproduced
//Commercial User Licence #:6133-1551-127-1256
//Commercial Licence Date:2012-02-07
//*******************************************



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

function calcNW(form) {

   var ln_arr = [
      ["blank","blank","blank","blank","blank","blank","blank","blank"],
      ["blank","Cash (checking & savings accounts, from below)","Short-Term Investments","Treasury Bills","Savings Certificates","Money Market Funds","Cash Value of Life Insurance (from below)","Other"],
      ["blank","Notes Receivable","Marketable Securities","Securities","Bonds","Real Estate (investment)","Tax Incentive Investments","Retirement Funds"],
      ["blank","Residence","Vacation Property","Art, Antiques","Furnishings","Vehicles","Other","blank"],
      ["blank","Credit Cards","Car Loan","Construction Liens/Notes/Balances Due","Loan on Life Insurance","Installment Loans","Accrued Income Taxes","Other Debt"],
      ["blank","Loans to Purchase Personal Assets","Loan to Acquire Business","Mortgage on Personal Residence(s)","Note to Business","Other","Other","Other"],
      ["blank","Endorser","Guarantor (SBA Loan)","Damage Claims","Taxes","Other","Other","blank"]
   ]

   var head_arr = new Array(0,'Liquid Assets','Investment Assets','Personal Assets','Short-Term Liabilities','Long-Term Liabilities','Contingent Liabilities');
   var sec_arr = new Array(0,'la','ia','pa','sl','ll','cl');
   var cnt_arr = new Array(0,7,7,6,7,7,6);

   //SET REPORT FONTS/STYLES
   var head_row_start = "<tr><td colspan='2'><font face='arial'><small><b>";
   var head_row_end = "</b></small></font></td></tr>n";

   var sub_head_row_start = "<tr><td colspan='2'><font face='arial'><small><i>";
   var sub_head_row_end = "</i></small></font></td></tr>n";

   var line_item_row_start = "<tr><td><font face='arial'><small>";
   var line_item_row_mid = "</small></font></td><td align='right'><font face='arial'><small>$";
   var line_item_row_end = "</small></font></td></tr>n";

   var sub_total_row_start = "<tr bgcolor='#EEEEEE'><td align='right'><font face='arial'><small>";
   var sub_total_row_mid = "</small></font></td><td align='right'><font face='arial'><small>$";
   var sub_total_row_end =  "</small></font></td></tr>n";

   var total_row_start = "<tr><td align='right'><font face='arial'><small><b>";
   var total_row_mid = "</b></small></font></td><td align='right'><font face='arial'><small><b>$";
   var total_row_end = "</small></font></td></tr>n";

   var nw_row_start = "<tr bgcolor='#EEEEEE'><td align='right'><font face='arial'><small>";
   nw_row_start += "<b>Net Worth</b></small></font></td><td align='right'><font face='arial'><small><b>";
   var nw_row_end = "</b></small></font></td></tr>n";

   var rpt_rows = "";
   rpt_rows += "<table width='500' border='1' bordercolor='#CCCCCC' cellpadding='4' cellspacing='0'>";
   rpt_rows += head_row_start + "Assets" + head_row_end;

   var sec_tot = 0;
   var ass_tot = 0;
   var lia_tot = 0;

   var nw = 0;
   var amt = 0;

   for (var i = 1; i<7; i++) {

      sec_tot = 0;
      rpt_rows += sub_head_row_start + "" + head_arr[i] + "" + sub_head_row_end;

      for(var j = 1; j<=cnt_arr[i]; j++) {

         var amt_cell = document.getElementById("" + sec_arr[i] + "_" + j + "");
         amt = sn(amt_cell.value);

         sec_tot += amt;


         if(amt > 0) {
            rpt_rows += line_item_row_start + "" + ln_arr[i][j] + "" + line_item_row_mid + "" + fn(amt,0,1) + "" + line_item_row_end;

         }

      }

      if(i<4) {
         ass_tot += sec_tot;
      } else {
         lia_tot += sec_tot;
      }

      var sub_tot_cell = document.getElementById("total_" + sec_arr[i] + "");
      sub_tot_cell.value = "$" + fn(sec_tot,2,1);

      rpt_rows += sub_total_row_start + "" + "Total " + head_arr[i] + "" + sub_total_row_mid + "" + fn(sec_tot,0,1) + "" + sub_total_row_end;

      if(i==3) {
         document.cash.total_a.value = "$" + fn(ass_tot,2,1);
         rpt_rows += total_row_start + "Total Assets" + "" + total_row_mid + "" + fn(ass_tot,0,1) + "" + total_row_end;

         rpt_rows += head_row_start + "Liabilities" + head_row_end;
      }

   }



   document.cash.total_l.value = "$" + fn(lia_tot,2,1);
   rpt_rows += total_row_start + "Total Liabilities" + "" + total_row_mid + "" + fn(lia_tot,0,1) + "" + total_row_end;

   nw = Number(ass_tot) - Number(lia_tot);

   if(nw < 0) {
     nw = nw * -1;
     document.cash.nw.value = "-$" + fn(nw,2,1);
     rpt_rows += nw_row_start + "-$" + fn(nw,0,1) + "" + nw_row_end;
   } else {
      document.cash.nw.value = "$" + fn(nw,2,1);
      rpt_rows += nw_row_start + "$" + fn(nw,0,1) + "" + nw_row_end;
   }

   rpt_rows += "</table>n";

   document.cash.report_rows.value = rpt_rows;


}

function createReport(form) {

   var Vrpt_rows = document.cash.report_rows.value;

   var fin_stmt = "<head><title>Personal Financial Statement</title></head>";
   fin_stmt += "<body bgcolor= '#FFFFFF'><center><font face='arial'><big>";
   fin_stmt += "<strong>Personal Financial Statement of</strong></big></font><br />";
   fin_stmt += "<font face='arial'><small><strong>" + document.cash.name.value + "</strong></small></font><br />";
   fin_stmt += "<font face='arial'><small><strong>as of:</strong></small></font><br />";
   fin_stmt += "<font face='arial'><small><strong>" + document.cash.date.value + "</strong></small></font></center><p />";
   fin_stmt += "<center>" + Vrpt_rows + "</center><p /><center><form method='post'>";
   fin_stmt += "<input type='button' value='Close Window' onClick='window.close()'>";
   fin_stmt += "</form></center></body></html>";

   printWin = window.open("","","width=600,height=400,toolbar=yes,menubar=yes,scrollbars=yes");
   printWin.document.write(fin_stmt);
   printWin.document.close();

}

function noEntry(elem) {

   var next_cell = document.getElementById("" + elem + "_1");
   next_cell.focus();

}</script>
</head>
<body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-6815 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none mortgage-payoff-calculator not_home feature-box-none footer-height-tall calculator" itemscope itemtype="https://schema.org/WebPage">
    <div class="site-container">
         <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content mb5">
                    <div class="fmcalc-inner-container fmcalc-ic-c14">
                        <div class="fmcalc-wrapper">
                        <form name="cash" method="post" action="#">
<table class="fmcalc" cellpadding="4" cellspacing="0">
<tbody>
<tr>
<td colspan="5">
<br><h4 align="center">Net Worth Calculator – Personal Balance Sheet</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Your Name
</td>
<td align="center">
<input type="text" id="name" name="name" size="12" tabindex="1">
</td><td bgcolor="#CCCCCC"> </td>
<td>
Enter date to display on report
</td>
<td align="center">
<input type="text" id="date" name="date" size="12" tabindex="2">
</td>
</tr>
<tr>
<td colspan="2">
<b>
Assets
</b>
</td>
<td bgcolor="#CCCCCC"> </td>
<td colspan="2">
<b>
Liabilities
</b>
</td>
</tr>
<tr>
<td colspan="2">
<i>
Liquid Assets
</i>
</td>
<td bgcolor="#CCCCCC"> </td>
<td colspan="2">
<i>
Short-Term
</i>
</td>
</tr>
<tr>
<td>
Cash (checking &amp; savings accounts)
</td>
<td align="center">
<input type="text" id="la_1" name="la_1" size="12" tabindex="3" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Credit Cards
</td>
<td align="center">
<input type="text" id="sl_1" name="sl_1" size="12" tabindex="23" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Short-Term Investments
</td>
<td align="center">
<input type="text" id="la_2" name="la_2" size="12" tabindex="4" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Car Loan
</td>
<td align="center">
<input type="text" id="sl_2" name="sl_2" size="12" tabindex="24" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Treasury Bills
</td>
<td align="center">
<input type="text" id="la_3" name="la_3" size="12" tabindex="5" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Construction Liens/Notes/Balances Due
</td>
<td align="center">
<input type="text" id="sl_3" name="sl_3" size="12" tabindex="25" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Savings Certificates
</td>
<td align="center">
<input type="text" id="la_4" name="la_4" size="12" tabindex="6" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Loan on Life Insurance
</td>
<td align="center">
<input type="text" id="sl_4" name="sl_4" size="12" tabindex="26" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Money Market Funds
</td>
<td align="center">
<input type="text" id="la_5" name="la_5" size="12" tabindex="7" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Installment Loans
</td>
<td align="center">
<input type="text" id="sl_5" name="sl_5" size="12" tabindex="27" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Cash Value of Life Insurance
</td>
<td align="center">
<input type="text" id="la_6" name="la_6" size="12" tabindex="8" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Accrued Income Taxes
</td>
<td align="center">
<input type="text" id="sl_6" name="sl_6" size="12" tabindex="28" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Other
</td>
<td align="center">
<input type="text" id="la_7" name="la_7" size="12" tabindex="9" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Other Debt
</td>
<td align="center">
<input type="text" id="sl_7" name="sl_7" size="12" tabindex="29" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td align="right">
<b>
Total Liquid Assets
</b>
</td>
<td align="center">
<input type="text" id="total_la" name="total_la" size="12" tabindex="46" onfocus="noEntry('ia')" [field_ouput_style_odd]="">
</td>
<td bgcolor="#CCCCCC"> </td>
<td align="right">
<b>
Total Short-Term Liabilities
</b>
</td>
<td align="center">
<input type="text" id="total_sl" name="total_sl" size="12" tabindex="47" onfocus="noEntry('ll')" [field_ouput_style_odd]="">
</td>
</tr>
<tr>
<td colspan="2">
<i>
Investment Assets
</i>
</td>
<td bgcolor="#CCCCCC"> </td>
<td colspan="2">
<i>
Long-Term
</i>
</td>
</tr>
<tr>
<td>
Notes Receivable
</td>
<td align="center">
<input type="text" id="ia_1" name="ia_1" size="12" tabindex="10" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Loans to Purchase Personal Assets
</td>
<td align="center">
<input type="text" id="ll_1" name="ll_1" size="12" tabindex="30" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Marketable Securities
</td>
<td align="center">
<input type="text" id="ia_2" name="ia_2" size="12" tabindex="11" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Loan to Acquire Business
</td>
<td align="center">
<input type="text" id="ll_2" name="ll_2" size="12" tabindex="31" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Securities
</td>
<td align="center">
<input type="text" id="ia_3" name="ia_3" size="12" tabindex="12" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Mortgage on Personal Residence(s)
</td>
<td align="center">
<input type="text" id="ll_3" name="ll_3" size="12" tabindex="32" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Bonds
</td>
<td align="center">
<input type="text" id="ia_4" name="ia_4" size="12" tabindex="13" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Note to Business
</td>
<td align="center">
<input type="text" id="ll_4" name="ll_4" size="12" tabindex="33" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Real Estate (investment)
</td>
<td align="center">
<input type="text" id="ia_5" name="ia_5" size="12" tabindex="14" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Other
</td>
<td align="center">
<input type="text" id="ll_5" name="ll_5" size="12" tabindex="34" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Tax Incentive Investments
</td>
<td align="center">
<input type="text" id="ia_6" name="ia_6" size="12" tabindex="15" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Other
</td>
<td align="center">
<input type="text" id="ll_6" name="ll_6" size="12" tabindex="35" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Retirement Funds
</td>
<td align="center">
<input type="text" id="ia_7" name="ia_7" size="12" tabindex="16" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Other
</td>
<td align="center">
<input type="text" id="ll_7" name="ll_7" size="12" tabindex="36" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td align="right">
<b>
Total Investment Assets
</b>
</td>
<td align="center">
<input type="text" id="total_ia" name="total_ia" size="12" tabindex="48" onfocus="noEntry('pa')" [field_ouput_style_odd]="">
</td>
<td bgcolor="#CCCCCC"> </td>
<td align="right">
<b>
Total Long-Term Liabilities
</b>
</td>
<td align="center">
<input type="text" id="total_ll" name="total_ll" size="12" tabindex="49" onfocus="noEntry('cl')" [field_ouput_style_odd]="">
</td>
</tr>
<tr>
<td colspan="2">
<i>
Personal Assets
</i>
</td>
<td bgcolor="#CCCCCC"> </td>
<td colspan="2">
<i>
Contingent Liabilities
</i>
</td>
</tr>
<tr>
<td>
Residence
</td>
<td align="center">
<input type="text" id="pa_1" name="pa_1" size="12" tabindex="17" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Endorser
</td>
<td align="center">
<input type="text" id="cl_1" name="cl_1" size="12" tabindex="37" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Vacation Property
</td>
<td align="center">
<input type="text" id="pa_2" name="pa_2" size="12" tabindex="18" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Guarantor (SBA Loan)
</td>
<td align="center">
<input type="text" id="cl_2" name="cl_2" size="12" tabindex="38" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Art, Antiques
</td>
<td align="center">
<input type="text" id="pa_3" name="pa_3" size="12" tabindex="19" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Damage Claims
</td>
<td align="center">
<input type="text" id="cl_3" name="cl_3" size="12" tabindex="39" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Furnishings
</td>
<td align="center">
<input type="text" id="pa_4" name="pa_4" size="12" tabindex="20" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Taxes
</td>
<td align="center">
<input type="text" id="cl_4" name="cl_4" size="12" tabindex="40" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Vehicles
</td>
<td align="center">
<input type="text" id="pa_5" name="pa_5" size="12" tabindex="21" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Other
</td>
<td align="center">
<input type="text" id="cl_5" name="cl_5" size="12" tabindex="41" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td>
Other
</td>
<td align="center">
<input type="text" id="pa_6" name="pa_6" size="12" tabindex="22" onkeyup="calcNW(this.form)">
</td>
<td bgcolor="#CCCCCC"> </td>
<td>
Other
</td>
<td align="center">
<input type="text" id="cl_6" name="cl_6" size="12" tabindex="42" onkeyup="calcNW(this.form)">
</td>
</tr>
<tr>
<td align="right">
<b>
Total Personal Assets
</b>
</td>
<td align="center">
<input type="text" id="total_pa" name="total_pa" size="12" tabindex="50" onfocus="noEntry('pa')" [field_ouput_style_even]="">
</td>
<td bgcolor="#CCCCCC"> </td>
<td align="right">
<b>
Total Contingent Liabilities
</b>
</td>
<td align="center">
<input type="text" id="total_cl" name="total_cl" size="12" tabindex="51" onfocus="noEntry('cl')" [field_ouput_style_even]="">
</td>
</tr>
<tr>
<td align="right">
<b>
Total Assets
</b>
</td>
<td align="center">
<input type="text" id="total_a" name="total_a" size="12" tabindex="52" onfocus="noEntry('pa')" [field_ouput_style_odd]="">
</td>
<td bgcolor="#CCCCCC"> </td>
<td align="right">
<b>
Total Liabilities
</b>
</td>
<td align="center">
<input type="text" id="total_l" name="total_l" size="12" tabindex="53" onfocus="noEntry('cl')" [field_ouput_style_odd]="">
</td>
</tr>
<tr>
<td colspan="4" align="right">
<b>
Net Worth
</b>
</td>
<td align="center">
<input type="text" id="nw" name="nw" size="12" tabindex="54" onfocus="noEntry('cl')" [field_ouput_style_even]="">
</td>
</tr>
<tr>
<td align="center" colspan="5">
<input type="reset" value="Clear Form">
<input type="hidden" name="report_rows">
</td>
</tr>

</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
