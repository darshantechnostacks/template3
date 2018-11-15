
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Rent vs. Buy Calculator - Compares Renting vs. Buying Costs</title>

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


function computeForm(form) {
   var VmoRent = sn(document.calc.moRent.value);
   var VhomeCost = sn(document.calc.homeCost.value);
   var VnoYears = sn(document.calc.noYears.value);
   var v_pay_rate = sn(document.calc.payRate.value);
   var VstayYrs = sn(document.calc.stayYrs.value);

   if(VmoRent == 0) {
      alert("Please enter the amount of your monthly rent payment.");
      document.calc.moRent.focus();
   } else
      if(VhomeCost == 0) {
      alert("Please enter the purchase price of the home.");
      document.calc.homeCost.focus();
   } else
      if(VnoYears == 0) {
      alert("Please your number of years you are financing the home for.");
      document.calc.noYears.focus();
   } else
      if(v_pay_rate == 0) {
      alert("Please enter the mortgage's annual interest rate.");
      document.calc.payRate.focus();
   } else
      if(VstayYrs == 0) {
      alert("Please enter the number of years you plan to stay in this property.");
      document.calc.stayYrs.focus();
   } else {

      //GET RENTAL INFO
      var VtotRent = 0;

      var VmoRentIns = sn(document.calc.moRentIns.value);
      if(VmoRentIns == "" || VmoRentIns == 0) {
         VmoRentIns = 0
      }

      var VinflateRate = sn(document.calc.inflateRate.value);
      if(VinflateRate == "" || VinflateRate == 0) {
         VinflateRate = 0
      } else
      if(VinflateRate >= 1) {
         VinflateRate = VinflateRate / 100;
      }
      VinflateRate = Number(VinflateRate) + Number(1);

      //GET TIME INFO & CONVERT TO MONTHS
      var VstayMonths = VstayYrs * 12;
      var count = 0;

      //GET LOAN INFO
      if(v_pay_rate > 1.0) {
         v_pay_rate = v_pay_rate / 100.0;
      }
      v_pay_rate /= 12;

      var VdownPmt = sn(document.calc.downPmt.value);

      var VorigPrin = Number(VhomeCost) - Number(VdownPmt);
      var intPort = 0;
      var VaccumInt = 0;
      var prinPort = 0;
      var prin = VorigPrin;

      //CALULCATE MONTHLY MORTGAGE PAYMENT
      var noMonths = VnoYears * 12;

      var pow = 1;
      for (var j = 0; j < noMonths; j++) {
         pow = pow * (1 + v_pay_rate);
      }

      var VmoPmt = (VorigPrin * pow * v_pay_rate) / (pow - 1);

      //GET HOME APPRECIATION INFO
      var VapprecRate = sn(document.calc.apprecRate.value);
      if(VapprecRate == "" || VapprecRate == 0) {
         VapprecRate = 0;
      } else
      if(VapprecRate >= 0) {
         VapprecRate = VapprecRate / 100;
      }
      VapprecRate = Number(VapprecRate) + Number(1);
      var VaccumApprec = VhomeCost * VapprecRate;

      //GET PMI (PRIVATE MORTGAGE INSURANCE) INFO
      var Vpmi = sn(document.calc.pmi.value);
      if(Vpmi == 0 || Vpmi == "") {
         Vpmi = 0;
      } else
      if(Vpmi >= .01) {
         Vpmi = Vpmi / 100;
      }
      Vpmi = Vpmi / 12;
      var pmiYN = 0;
      var VaccumPmi = 0;
      var downPayPerc = VdownPmt / VhomeCost;
      if(downPayPerc < .20) {
         pmiYN = 1;
         VaccumPmi = 0;
      }

      //*******CALCULATE CLOSING COSTS

      //POINTS
      var Vfees = sn(document.calc.fees.value);
      if(Vfees == 0 || Vfees == "") {
         Vfees = 0;
      } else
      if(Vfees >= 1 ) {
         Vfees = Vfees / 100;
      }
      var VfeeCost = VorigPrin * Vfees;

      //ORIGINATION FEE
      var Vpoints = sn(document.calc.points.value);
      if(Vpoints == 0 || Vpoints == "") {
         Vpoints = 0;
      } else
      if(Vpoints >= 1 ) {
         Vpoints = Vpoints / 100;
      }
      var VpointCost = VorigPrin * Vpoints;

      //OTHER LOAN COSTS
      var VloanCosts= sn(document.calc.loanCosts.value);
      if(VloanCosts == 0 || VloanCosts == "") {
         VloanCosts = 0;
      }

      //TOTAL CLOSING COSTS
      var VclosingCosts = Number(VpointCost) + Number(VfeeCost) + Number(VloanCosts);

      //GET INVESTMENT INFO
      var VinvestIntPort = 0;
      var VinvestPrin = Number(VdownPmt) + Number(VclosingCosts);

      var earnInt = sn(document.calc.saveRate.value);
      earnInt /= 100;
      earnInt /= 12;

      //INITIATE INFLATION FACTOR
      var VaccumInflate = 1;

      //*****CYCLE THROUGH NUMBER OF MONTHS
      while(count < VstayMonths) {

         //ACCUMULATE RENT PAYMENTS & INSURANCE & APPRECIATION
         if(count > 0 && count % 12 == 0) {
            VaccumApprec = VaccumApprec * VapprecRate;
            VmoRent = VmoRent * VinflateRate;
            VaccumInflate = VaccumInflate * VinflateRate;
         }
         VtotRent = Number(VtotRent) + Number(VmoRent);
         VtotRent = Number(VtotRent) + Number(VmoRentIns);

         //ACCUMULATE INTEREST PAYMENTS
         if(count < noMonths) {
            intPort = prin * v_pay_rate;
            VaccumInt = Number(VaccumInt) + Number(intPort)
            prinPort = Number(VmoPmt) - Number(intPort);
            prin = Number(prin) - Number(prinPort);
         }

         //IF PMI APPLICABLE, ACCUMULATE
         if(pmiYN == 1) {
            VaccumPmi = Number(VaccumPmi) + Number(Vpmi * prin);
         }

         //AMORTIZE INVESTED DOWNPAYMENT AND CLOSING COSTS
         VinvestIntPort = earnInt * VinvestPrin;
         VinvestPrin = Number(VinvestPrin) + Number(VinvestIntPort);

         //INCREASE COUNT
         count = Number(count) + Number(1);
      }

      //CALCULATE TOTAL ASSOCIATION DUES
      var VassocDues = sn(document.calc.assocDues.value);
      if(VassocDues == "" || VassocDues == 0) {
         VassocDues = 0;
      }
      var VtotAssocDues = VassocDues * 12 * VstayYrs * VaccumInflate;

      //CALCULATE TOTAL PROPERTY TAXES
      var VpropTax = sn(document.calc.propTax.value);
      if(VpropTax == "" || VpropTax == 0) {
         VpropTax = 0;
      }
      var VtotPropTax = VpropTax * VstayYrs * VaccumInflate;

      //CALCULATE TOTAL MAINTENANCE COSTS
      var Vmaint = document.calc.maint.value;
      if(Vmaint == "" || Vmaint == 0) {
         Vmaint = 0;
      }
      var VtotMaintCost = Vmaint * 12 * VstayYrs * VaccumInflate;

      //CALCULATE TOTAL HOMEOWNER INSURANCE COSTS
      var VhomeIns = sn(document.calc.homeIns.value);
      if(VhomeIns == "" || VhomeIns == 0) {
         VhomeIns = 0;
      } else
      if(VhomeIns >= .01) {
         VhomeIns = VhomeIns / 100;
      }
      var VtotHomeInsCost = VhomeIns * VhomeCost * VstayYrs * VaccumInflate;

      //CALCULATE NET GAIN ON HOME
      var VnetGain = Number(VaccumApprec) - Number(VhomeCost);

      //CALCULATE TAX SAVINGS ON INTEREST, POINTS AND PROPERTY TAXES
      var VtotTaxDeduct = Number(VaccumInt) + Number(VtotPropTax) + Number(VfeeCost);
      var VincomeTax = sn(document.calc.incomeTax.value);
      if(VincomeTax == 0 || VincomeTax == "") {
         VincomeTax = 0;
      } else
      if(VincomeTax >= 1) {
         VincomeTax = VincomeTax / 100;
      }
      var VtotTaxSave = VincomeTax * VtotTaxDeduct;

      //CALCULATE REALTOR COMMISSION ON SALE OF HOME
      var VrealtorCom = sn(document.calc.realtorCom.value);
      if(VrealtorCom == 0 || VrealtorCom == "") {
         VrealtorCom = 0;
      } else
      if(VrealtorCom >= 1) {
         VrealtorCom = VrealtorCom / 100;
      }
      var VsellCost = VaccumApprec * VrealtorCom;

      //CALCULATE NET EARNINGS ON INVESTMENT
      var VinvestEarn = Number(VinvestPrin) - Number(VdownPmt) - Number(VclosingCosts);

      document.calc.totRent.value = VtotRent;
      document.calc.moPmt.value = VmoPmt;
      document.calc.accumInt.value = VaccumInt;
      document.calc.closeCosts.value = VclosingCosts;
      document.calc.totPropTax.value = VtotPropTax;
      document.calc.totMaintCost.value = VtotMaintCost;
      document.calc.totHomeInsCost.value = VtotHomeInsCost;
      document.calc.netGain.value = VnetGain;
      document.calc.pmiCost.value = VaccumPmi;
      document.calc.investPrin.value = VinvestEarn;
      document.calc.totAssocDues.value = VtotAssocDues;
      document.calc.totTaxSave.value = VtotTaxSave;
      document.calc.sellCost.value = VsellCost;

      var VtotRentCosts = VtotRent;
      document.calc.totRentCosts.value = VtotRentCosts;
      var VtotRentBenefits = VinvestEarn;
      document.calc.totRentBenefits.value = VtotRentBenefits;
      var VnetRentCost = Number(VtotRent) - Number(VinvestEarn);

      var VtotBuyCosts = Number(VaccumInt) + Number(VclosingCosts) + Number(VtotPropTax) + Number(VtotMaintCost) + Number(VtotHomeInsCost) + Number(VaccumPmi) + Number(VtotAssocDues) + Number(VsellCost);
      document.calc.totBuyCosts.value = VtotBuyCosts;

      var VtotBuyBenefits = Number(VnetGain) + Number(VtotTaxSave);
      document.calc.totBuyBenefits.value = VtotBuyBenefits;
      var VnetBuyCost = Number(VtotBuyCosts) - Number(VtotBuyBenefits);


      document.calc.netRentCost.value = fns(VnetRentCost,2,1,1,1);
      document.calc.netBuyCost.value = fns(VnetBuyCost,2,1,1,1);

      var diff = 0;
      var Vsummary = "";
      if(VnetRentCost > VnetBuyCost) {
         diff = Number(VnetRentCost) - Number(VnetBuyCost);
         Vsummary = "You will save " + fns(diff,2,1,1,1) + " if you buy instead of rent."
      } else {
         diff = Number(VnetBuyCost) - Number(VnetRentCost);
         Vsummary = "You will save " + fns(diff,2,1,1,1) + " if you rent instead of buy."
      }

      document.calc.h_summary.value = Vsummary;

      var v_summary_cell = document.getElementById("summary");
      v_summary_cell.innerHTML = "<font face='arial'><small><strong>Summary:</strong> " + Vsummary + "</small></font>";
      showReport(form);
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

function clear_results(form) {
   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   document.calc.netRentCost.value = "";
   document.calc.netBuyCost.value = "";
   document.getElementById("report").innerHTML = "";
}

function reset_calc(form) {
   var v_summary_cell = document.getElementById("summary");
   v_summary_cell.innerHTML = "";

   var help_cell_1 = document.getElementById("help_1");
   help_cell_1.innerHTML = "";

   var help_cell_2 = document.getElementById("help_2");
   help_cell_2.innerHTML = "";

   var help_cell_3 = document.getElementById("help_3");
   help_cell_3.innerHTML = "";

   var help_cell_4 = document.getElementById("help_4");
   help_cell_4.innerHTML = "";

   var help_cell_5 = document.getElementById("help_5");
   help_cell_5.innerHTML = "";
   document.calc.reset();
   document.getElementById("report").innerHTML = "";
}

function showReport(form) {
   var part1 = "";
   var part2 = "<center><table border=''1 cellspacing='0' cellpadding='4'><tr>";
   part2 += "<td colspan='2' align='center'><font face='arial'><big><strong>Rent</strong></big></font>";
   part2 += "</td><td align='center'><font face='arial'><big><strong>vs.</strong></big></font></td>";
   part2 += "<td colspan=2 align='center'><font face='arial'><big><strong>Buy</strong></big></font>";
   part2 += "</td></tr><tr><td colspan=2 valign='top'><font face='arial'><small><strong>";
   part2 += "Monthly Rent Payment: " + fns(document.calc.moRent.value,2,1,1,1) + "<br />";
   part2 += "Annual Return on Investment: " + fns(document.calc.saveRate.value,2,0,2,1) + "</strong>";
   part2 += "</small></font></td><td> </td><td colspan=2><font face='arial'><small><strong>";
   part2 += "Purchase Price: " + fns(document.calc.homeCost.value,2,1,1,1) + "<br />Down ";
   part2 += "Payment: " + fns(document.calc.downPmt.value,2,1,1,1) + "<br />Mortgage ";
   part2 += "Term: " + document.calc.noYears.value + " years<br />Interest ";
   part2 += "Rate: " + fns(document.calc.payRate.value,2,0,2,1) + "<br />Monthly Mortgage ";
   part2 += "Payment: " + fns(document.calc.moPmt.value,2,1,1,1) + "<br /></strong></small></font>";
   part2 += "</td></tr><tr><td colspan=5><center><font face='arial'><big><strong>Cost Benefit ";
   part2 += "Analysis</strong></big></font><br /><font face='arial'><small><small>Calculations ";
   part2 += "are based upon a " + document.calc.inflateRate.value + "% annual inflation rate over ";
   part2 += "the course of " + document.calc.stayYrs.value + " years (the time between now and ";
   part2 += "when you estimate you would sell the home). Please allow for slight rounding";
   part2 += " differences.</small></small></font></center></td></tr><tr bgcolor='#CCCCCC'>";
   part2 += "<td><font face='arial'><small><strong>Renting Costs</strong></small></font></td><td>";
   part2 += "<font face='arial'><small><strong>Amount</strong></small></font></td><td> </td><td>";
   part2 += "<font face='arial'><small><strong>Buying Costs</strong></small></font></td><td>";
   part2 += "<font face='arial'><small><strong>Amount</strong></small></font></td></tr>";

   var rows = "";
   rows += "<tr><td><font face='arial'><small>Total Rent & Insurance Payments:</small>";
   rows += "</font></td><td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.totRent.value,2,1,1,1) + "</small></font></td>";
   rows += "<td> </td><td><font face='arial'><small>Total of Interest Payments:</small>";
   rows += "</font></td><td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.accumInt.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Total Closing Costs:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.closeCosts.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Total Property Tax Costs:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.totPropTax.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Total Maintenance Costs:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.totMaintCost.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Total Homeowner's Insurance Costs:</small>";
   rows += "</font></td><td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.totHomeInsCost.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Total Association Dues:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.totAssocDues.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Total PMI Costs:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.pmiCost.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Cost of selling home:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.sellCost.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'><font face='arial'><small><strong>Total Costs</strong></small>";
   rows += "</font></td><td align='right'><font face='arial'><small>";
   rows += "<strong>" + fns(document.calc.totRentCosts.value,2,1,1,1) + "</strong></small></font></td>";
   rows += "<td> </td><td align='right'><font face='arial'><small><strong>Total Costs</strong>";
   rows += "</small></font></td><td align='right'><font face='arial'><small>";
   rows += "<strong>" + fns(document.calc.totBuyCosts.value,2,1,1,1) + "</strong></small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td> </td>";
   rows += "<td align='right'> </td></tr>";

   rows += "<tr bgcolor='#CCCCCC'><td><font face='arial'><small><strong>Renting Benefits</strong>";
   rows += "</small></font></td><td><font face='arial'><small><strong>Amount</strong></small></font>";
   rows += "</td><td> </td><td><font face='arial'><small><strong>Buying Benefits</strong></small>";
   rows += "</font></td><td><font face='arial'><small><strong>Amount</strong></small></font></td></tr>";

   rows += "<tr><td><font face='arial'><small>Interest Earned on Invested Funds:</small>";
   rows += "</font></td><td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.investPrin.value,2,1,1,1) + "</small></font></td>";
   rows += "<td> </td><td><font face='arial'><small>Tax Savings:</small></font></td>";
   rows += "<td align='right'><font face='arial'>";
   rows += "<small>" + fns(document.calc.totTaxSave.value,2,1,1,1) + "</small></font></td></tr>";

   rows += "<tr><td align='right'> </td><td> </td><td> </td><td>";
   rows += "<font face='arial'><small>Home Appreciation:</small></font></td><td align='right'>";
   rows += "<font face='arial'><small>" + fns(document.calc.netGain.value,2,1,1,1) + "</small>";
   rows += "</font></td></tr>";

   rows += "<tr><td align='right'><font face='arial'><small><strong>Total Benefits</strong></small></font>";
   rows += "</td><td align='right'><font face='arial'><small>";
   rows += "<strong>" + fns(document.calc.totRentBenefits.value,2,1,1,1) + "</strong></small></font></td>";
   rows += "<td> </td><td align='right'><font face='arial'><small><strong>Total Benefits</strong>";
   rows += "</small></font></td><td align='right'><font face='arial'><small>";
   rows += "<strong>" + fns(document.calc.totBuyBenefits.value,2,1,1,1) + "</strong></small></font></td></tr>";

   rows += "<tr><td align='right'><font face='arial'><small><strong>NET COST OF RENTING:</strong>";
   rows += "</small></font></td><td align='right'><font face='arial'><small>";
   rows += "<strong>" + document.calc.netRentCost.value + "</strong></small></font></td><td> </td>";
   rows += "<td align='right'><font face='arial'><small><strong>NET COST OF BUYING:</strong></small>";
   rows += "</font></td><td align='right'><font face='arial'><small>";
   rows += "<strong>" + document.calc.netBuyCost.value + "</strong></small></font></td></tr>";

   rows += "<tr bgcolor='#CCCCCC'><td colspan='5'><font face='arial'><small><strong>";
   rows += "Summary:</strong> " + document.calc.h_summary.value + "</small></font></td></tr>";

   var part4 = "</table>";

   var schedule = (part1 + "" + part2 + "" + rows + "" + part4 + "");
   console.log(schedule);
   document.getElementById("report").innerHTML = schedule;
   jQuery('.email-my-results').removeClass('hidden');
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
<br><h4 align="center">Rent vs. Buy Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td align="center">
<b>Entry Descriptions</b>
</td>
<td align="center">
<b>Entry Fields</b>
</td>
<td align="center">
<b>Explain/Instruct</b>
</td>
</tr>
<tr>
<td>
Monthly rent ($):
</td>
<td align="center">
<input type="text" name="moRent" size="15" value="800" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the amount of the monthly rent payment.')">
</td>
<td rowspan="5" width="125" align="center" valign="top">
<div id="help_1" style="width: 120px; text-align: left; padding-top: 6px">
</div>
</td>
</tr>
<tr>
<td>
Monthly rental insurance ($):
</td>
<td align="center">
<input type="text" name="moRentIns" size="15" value="15" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the monthly rental insurance premium.')">
</td>
</tr>
<tr>
<td>
Estimated annual inflation rate (%):
</td>
<td align="center">
<input type="text" name="inflateRate" size="15" value="4" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the annual inflation rate. Enter 4% as 4. This is used to inflate the costs of rent, insurance, maintenance, dues and property taxes for the length of time you will own the home.')">
</td>
</tr>
<tr>
<td>
Purchase price of home ($):
</td>
<td align="center">
<input type="text" name="homeCost" size="15" value="100000" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the total purchase price of the home -- not including closing costs.')">
</td>
</tr>
<tr>
<td>
Down payment amount ($):
</td>
<td align="center">
<input type="text" name="downPmt" size="15" value="10000" onkeyup="clear_results(this.form)" onfocus="help(1,'Enter the amount you will have available to put down on the house after you have set aside the cash you will need to pay the closing costs.')">
</td>
</tr>
<tr>
<td>
Length of mortgage term (# of years):
</td>
<td align="center">
<input type="text" name="noYears" size="15" value="30" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the number of years you are financing the home for.')">
</td>
<td rowspan="5" width="125" align="center" valign="top">
<div id="help_2" style="width: 120px; text-align: left; padding-top: 6px">
</div>
</td>
</tr>
<tr>
<td>
Mortgage's annual interest rate (%):
</td>
<td align="center">
<input type="text" name="payRate" size="15" value="7" onkeyup="clear_results(this.form)" onfocus="help(2,'Enter the annual interest rate of the mortgage. Enter 8% as simply 8 (do not include percent sign).')">
</td>
</tr>
<tr>
<td>
Discount points on home purchase (%):
</td>
<td align="center">
<input type="text" name="points" size="15" value="1" onkeyup="clear_results(this.form)" onfocus="help(2,'Discount points are paid up front in order to reduce the interest rate of your mortgage. Each point represents 1% of your mortgage balance. Enter 1% as simply 1 (do not include percent sign).')">
</td>
</tr>
<tr>
<td>
Origination fee (%):
</td>
<td align="center">
<input type="text" name="fees" size="15" value="1" onkeyup="clear_results(this.form)" onfocus="help(2,'The percentage (often as high as 1% of the loan amount) that a lending institution charges for processing and originating a loan.')">
</td>
</tr>
<tr>
<td>
Other loan costs ($):
</td>
<td align="center">
<input type="text" name="loanCosts" size="15" value="0" onkeyup="clear_results(this.form)" onfocus="help(2,'The total of other loan related costs, such as filing fees, appraiser fees, etc.')">
</td>
</tr>
<tr>
<td>
Mortgage Insurance (PMI %):
</td>
<td align="center">
<input type="text" name="pmi" size="15" value=".4" onkeyup="clear_results(this.form)" onfocus="help(3,'If your down-payment is less than 20% of the value of the home you are buying, you may be required to pay mortgage insurance between 0.2% and 0.5% of your principal balance each month. Enter .04% simply as .4 (do not include percent sign).')">
</td>
<td rowspan="5" width="125" align="center" valign="top">
<div id="help_3" style="width: 120px; text-align: left; padding-top: 6px">
</div>
</td>
</tr>
<tr>
<td>
Homeowner's insurance rate (%):
</td>
<td align="center">
<input type="text" name="homeIns" size="15" value=".5" onkeyup="clear_results(this.form)" onfocus="help(3,'Your homeowner insurance rate -- entered as a percentage of the value of your home. Typical rate is 0.5%. Enter .5% simply as .5 (do not include percent sign).')">
</td>
</tr>
<tr>
<td>
Monthly association dues ($):
</td>
<td align="center">
<input type="text" name="assocDues" size="15" value="0" onkeyup="clear_results(this.form)" onfocus="help(3,'If you are a member of a homeowner association, enter your monthly dues in this field.')">
</td>
</tr>
<tr>
<td>
Estimated monthly maintenance ($):
</td>
<td align="center">
<input type="text" name="maint" size="15" value="100" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the amount you expect to spend on repairing and maintaining your home.')">
</td>
</tr>
<tr>
<td>
Annual property tax ($):
</td>
<td align="center">
<input type="text" name="propTax" size="15" value="2000" onkeyup="clear_results(this.form)" onfocus="help(3,'Enter the amount of property taxes you expect to pay each year.')">
</td>
</tr>
<tr>
<td>
State plus Federal income tax rate (%):
</td>
<td align="center">
<input type="text" name="incomeTax" size="15" value="28" onkeyup="clear_results(this.form)" onfocus="help(4,'Enter your combined state and federal income tax percentage rate. Enter 28% simply as 28 (do not include percent sign).')">
</td>
<td rowspan="5" width="125" align="center" valign="top">
<div id="help_4" style="width: 120px; text-align: left; padding-top: 6px">
</div>
</td>
</tr>
<tr>
<td>
Interest rate you expect to earn on savings (%):
</td>
<td align="center">
<input type="text" name="saveRate" size="15" value="7" onkeyup="clear_results(this.form)" onfocus="help(4,'Enter the annual interest rate you expect to earn on the down payment and closing costs you will invest if you decide to rent instead of buy. Enter 7% simply as 7 (do not include percent sign).')">
</td>
</tr>
<tr>
<td>
Expected annual home appreciation rate (%):
</td>
<td align="center">
<input type="text" name="apprecRate" size="15" value="3" onkeyup="clear_results(this.form)" onfocus="help(4,'Enter the percentage amount you expect your house to appreciate each year. Enter 3% simply as 3 (do not include percent sign).')">
</td>
</tr>
<tr>
<td>
Number of years you will stay in this house:
</td>
<td align="center">
<input type="text" name="stayYrs" size="15" value="5" onkeyup="clear_results(this.form)" onfocus="help(4,'Enter the number of years you expect to rent or own this house. Typically, if you plan to move out of a home in less than 5 years from the date of purchase, you may be better off renting.')">
</td>
</tr>
<tr>
<td>
Realtor commission rate (%):
</td>
<td align="center">
<input type="text" name="realtorCom" size="15" value="7" onkeyup="clear_results(this.form)" onfocus="help(4,'Enter the percentage of your home selling price that you expect to pay a real estate agent or broker when it is time to sell your home. Enter 6% simply as 6 (do not include percent sign).')">
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="button" value="Reset" onclick="reset_calc(this.form)">
<input type="hidden" name="totRent" size="12">
<input type="hidden" name="moPmt" size="12">
<input type="hidden" name="accumInt" size="12">
<input type="hidden" name="closeCosts" size="12">
<input type="hidden" name="totPropTax" size="12">
<input type="hidden" name="totMaintCost" size="12">
<input type="hidden" name="totHomeInsCost" size="12">
<input type="hidden" name="totAssocDues" size="12">
<input type="hidden" name="pmiCost" size="12">
<input type="hidden" name="investPrin" size="12">
<input type="hidden" name="totTaxSave" size="12">
<input type="hidden" name="netGain" size="12">
<input type="hidden" name="sellCost" size="12">
<input type="hidden" name="totRentCosts" size="12">
<input type="hidden" name="totBuyCosts" size="12">
<input type="hidden" name="totRentBenefits" size="12">
<input type="hidden" name="totBuyBenefits" size="12">
<input type="hidden" name="h_summary" size="12">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td align="center">
<b>Result Descriptions</b>
</td>
<td align="center">
<b>Result Fields</b>
</td>
<td align="center">
<b>Explain/Instruct</b>
</td>
</tr>
<tr>
<td>
Total estimated cost of renting:
</td>
<td align="center">
<input type="text" name="netRentCost" size="15" onfocus="help(5,'Total estimated cost of renting.')">
</td>
<td rowspan="2" width="125" align="center" valign="top">
<div id="help_5" style="width: 120px; text-align: left; padding-top: 6px">
</div>
</td>
</tr>
<tr>
<td>
Total estimated cost of buying:
</td>
<td align="center">
<input type="text" name="netBuyCost" size="15" onfocus="help(5,'Total estimated cost of buying.')">
</td>
</tr>
<tr>
<td colspan="3" id="summary">
</td>
</tr>
</tbody>
</table>
<div id="report"></div>
</form>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
