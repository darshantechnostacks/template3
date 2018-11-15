
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Payment Calculator</title>

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

function computeForm(form)  {

   if(document.calc.amount.value.length == 0) {
      alert("Please enter a dollar amount.");
      document.calc.amount.focus();
   } else
   if(document.calc.year1.selectedIndex == document.calc.year2.selectedIndex) {
      alert("Please select two different years.");
      document.calc.amount.focus();
   } else {


      var cpiArr = new Array();
      cpiArr[0] = "9.88"
      cpiArr[1] = "10.02"
      cpiArr[2] = "10.11"
      cpiArr[3] = "10.88"
      cpiArr[4] = "12.83"
      cpiArr[5] = "15.04"
      cpiArr[6] = "17.33"
      cpiArr[7] = "20.04"
      cpiArr[8] = "17.85"
      cpiArr[9] = "16.75"
      cpiArr[10] = "17.05"
      cpiArr[11] = "17.13"
      cpiArr[12] = "17.54"
      cpiArr[13] = "17.7"
      cpiArr[14] = "17.36"
      cpiArr[15] = "17.16"
      cpiArr[16] = "17.16"
      cpiArr[17] = "16.7"
      cpiArr[18] = "15.21"
      cpiArr[19] = "13.64"
      cpiArr[20] = "12.93"
      cpiArr[21] = "13.38"
      cpiArr[22] = "13.73"
      cpiArr[23] = "13.87"
      cpiArr[24] = "14.38"
      cpiArr[25] = "14.09"
      cpiArr[26] = "13.91"
      cpiArr[27] = "14.01"
      cpiArr[28] = "14.73"
      cpiArr[29] = "16.33"
      cpiArr[30] = "17.31"
      cpiArr[31] = "17.59"
      cpiArr[32] = "17.99"
      cpiArr[33] = "19.52"
      cpiArr[34] = "22.33"
      cpiArr[35] = "24.04"
      cpiArr[36] = "23.81"
      cpiArr[37] = "24.07"
      cpiArr[38] = "25.96"
      cpiArr[39] = "26.55"
      cpiArr[40] = "26.77"
      cpiArr[41] = "26.85"
      cpiArr[42] = "26.78"
      cpiArr[43] = "27.18"
      cpiArr[44] = "28.09"
      cpiArr[45] = "28.86"
      cpiArr[46] = "29.15"
      cpiArr[47] = "29.58"
      cpiArr[48] = "29.89"
      cpiArr[49] = "30.25"
      cpiArr[50] = "30.63"
      cpiArr[51] = "31.02"
      cpiArr[52] = "31.51"
      cpiArr[53] = "32.46"
      cpiArr[54] = "33.36"
      cpiArr[55] = "34.78"
      cpiArr[56] = "36.68"
      cpiArr[57] = "38.83"
      cpiArr[58] = "40.49"
      cpiArr[59] = "41.82"
      cpiArr[60] = "44.4"
      cpiArr[61] = "49.31"
      cpiArr[62] = "53.82"
      cpiArr[63] = "56.91"
      cpiArr[64] = "60.61"
      cpiArr[65] = "65.23"
      cpiArr[66] = "72.58"
      cpiArr[67] = "82.41"
      cpiArr[68] = "90.93"
      cpiArr[69] = "96.5"
      cpiArr[70] = "99.6"
      cpiArr[71] = "103.88"
      cpiArr[72] = "107.57"
      cpiArr[73] = "109.61"
      cpiArr[74] = "113.63"
      cpiArr[75] = "118.26"
      cpiArr[76] = "123.97"
      cpiArr[77] = "130.66"
      cpiArr[78] = "136.19"
      cpiArr[79] = "140.32"
      cpiArr[80] = "144.46"
      cpiArr[81] = "148.23"
      cpiArr[82] = "152.38"
      cpiArr[83] = "156.85"
      cpiArr[84] = "160.52"
      cpiArr[85] = "163.01"
      cpiArr[86] = "166.58"
      cpiArr[87] = "172.2"
      cpiArr[88] = "177.07"
      cpiArr[89] = "179.88"
      cpiArr[90] = "183.88"
      cpiArr[91] = "188.9"
      cpiArr[92] = "195.3"
      cpiArr[93] = "201.6"
      cpiArr[94] = "207.342"
      cpiArr[95] = "215.303"
      cpiArr[96] = "214.537"
      cpiArr[97] = "218.056"
      cpiArr[98] = "224.939"


      var Vamount = sn(document.calc.amount.value);

      var Vyear1 = document.calc.year1.options[document.calc.year1.selectedIndex].value;
      var Vyear1Sel = document.calc.year1.selectedIndex;
      var Vyear1cpi = cpiArr[Vyear1Sel];

      var Vyear2 = document.calc.year2.options[document.calc.year2.selectedIndex].value;
      var Vyear2Sel = document.calc.year2.selectedIndex;
      var Vyear2cpi = cpiArr[Vyear2Sel];
      var multiplier = Vyear2cpi / Vyear1cpi;;
      var VresultValue = Vamount * multiplier;

      document.calc.displayAmt1.value = "$" + fn(Vamount,2,1);
      document.calc.displayYear1.value = Vyear1;


      document.calc.displayAmt2.value = "$" + fn(VresultValue,2,1);
      document.calc.displayYear2.value = Vyear2;
      jQuery('.email-my-results').removeClass('hidden');

   }

}

function clear_results(form) {

   document.calc.displayAmt1.value = "";
   document.calc.displayAmt2.value = "";
   document.calc.displayYear1.value = "";
   document.calc.displayYear2.value = "";


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
<br><h4 align="center">Inflation Calculator</h4>
<div class="fmcalc-separator"></div>
</td>
</tr>
<tr>
<td>
Dollar amount (USD):
</td>
<td align="center">
<input type="text" name="amount" size="15" onkeyup="clear_results(this.form)"></td>
</tr>
<tr>
<td>
Base year:
</td>
<td align="center">
<select name="year1" size="1" onchange="clear_results(this.form)">
<option value="1913">1913</option>
<option value="1914">1914</option>
<option value="1915">1915</option>
<option value="1916">1916</option>
<option value="1917">1917</option>
<option value="1918">1918</option>
<option value="1919">1919</option>
<option value="1920">1920</option>
<option value="1921">1921</option>
<option value="1922">1922</option>
<option value="1923">1923</option>
<option value="1924">1924</option>
<option value="1925">1925</option>
<option value="1926">1926</option>
<option value="1927">1927</option>
<option value="1928">1928</option>
<option value="1929">1929</option>
<option value="1930">1930</option>
<option value="1931">1931</option>
<option value="1932">1932</option>
<option value="1933">1933</option>
<option value="1934">1934</option>
<option value="1935">1935</option>
<option value="1936">1936</option>
<option value="1937">1937</option>
<option value="1938">1938</option>
<option value="1939">1939</option>
<option value="1940">1940</option>
<option value="1941">1941</option>
<option value="1942">1942</option>
<option value="1943">1943</option>
<option value="1944">1944</option>
<option value="1945">1945</option>
<option value="1946">1946</option>
<option value="1947">1947</option>
<option value="1948">1948</option>
<option value="1949">1949</option>
<option value="1950">1950</option>
<option value="1951">1951</option>
<option value="1952">1952</option>
<option value="1953">1953</option>
<option value="1954">1954</option>
<option value="1955">1955</option>
<option value="1956">1956</option>
<option value="1957">1957</option>
<option value="1958">1958</option>
<option value="1959">1959</option>
<option value="1960">1960</option>
<option value="1961">1961</option>
<option value="1962">1962</option>
<option value="1963">1963</option>
<option value="1964">1964</option>
<option value="1965">1965</option>
<option value="1966">1966</option>
<option value="1967">1967</option>
<option value="1968">1968</option>
<option value="1969">1969</option>
<option value="1970">1970</option>
<option value="1971">1971</option>
<option value="1972">1972</option>
<option value="1973">1973</option>
<option value="1974">1974</option>
<option value="1975">1975</option>
<option value="1976">1976</option>
<option value="1977">1977</option>
<option value="1978">1978</option>
<option value="1979">1979</option>
<option value="1980">1980</option>
<option value="1981">1981</option>
<option value="1982">1982</option>
<option value="1983">1983</option>
<option value="1984">1984</option>
<option value="1985">1985</option>
<option value="1986">1986</option>
<option value="1987">1987</option>
<option value="1988">1988</option>
<option value="1989">1989</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
</select>
</td>
</tr>
<tr>
<td>
Result year:
</td>
<td align="center">
<select name="year2" size="1" onchange="clear_results(this.form)">
<option value="1913">1913</option>
<option value="1914">1914</option>
<option value="1915">1915</option>
<option value="1916">1916</option>
<option value="1917">1917</option>
<option value="1918">1918</option>
<option value="1919">1919</option>
<option value="1920">1920</option>
<option value="1921">1921</option>
<option value="1922">1922</option>
<option value="1923">1923</option>
<option value="1924">1924</option>
<option value="1925">1925</option>
<option value="1926">1926</option>
<option value="1927">1927</option>
<option value="1928">1928</option>
<option value="1929">1929</option>
<option value="1930">1930</option>
<option value="1931">1931</option>
<option value="1932">1932</option>
<option value="1933">1933</option>
<option value="1934">1934</option>
<option value="1935">1935</option>
<option value="1936">1936</option>
<option value="1937">1937</option>
<option value="1938">1938</option>
<option value="1939">1939</option>
<option value="1940">1940</option>
<option value="1941">1941</option>
<option value="1942">1942</option>
<option value="1943">1943</option>
<option value="1944">1944</option>
<option value="1945">1945</option>
<option value="1946">1946</option>
<option value="1947">1947</option>
<option value="1948">1948</option>
<option value="1949">1949</option>
<option value="1950">1950</option>
<option value="1951">1951</option>
<option value="1952">1952</option>
<option value="1953">1953</option>
<option value="1954">1954</option>
<option value="1955">1955</option>
<option value="1956">1956</option>
<option value="1957">1957</option>
<option value="1958">1958</option>
<option value="1959">1959</option>
<option value="1960">1960</option>
<option value="1961">1961</option>
<option value="1962">1962</option>
<option value="1963">1963</option>
<option value="1964">1964</option>
<option value="1965">1965</option>
<option value="1966">1966</option>
<option value="1967">1967</option>
<option value="1968">1968</option>
<option value="1969">1969</option>
<option value="1970">1970</option>
<option value="1971">1971</option>
<option value="1972">1972</option>
<option value="1973">1973</option>
<option value="1974">1974</option>
<option value="1975">1975</option>
<option value="1976">1976</option>
<option value="1977">1977</option>
<option value="1978">1978</option>
<option value="1979">1979</option>
<option value="1980">1980</option>
<option value="1981">1981</option>
<option value="1982">1982</option>
<option value="1983">1983</option>
<option value="1984">1984</option>
<option value="1985">1985</option>
<option value="1986">1986</option>
<option value="1987">1987</option>
<option value="1988">1988</option>
<option value="1989">1989</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
</select>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="button" value="Calculate Inflation" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="text" name="displayAmt1" size="15">
in <input type="text" name="displayYear1" size="6">
<br>
has the same buying power as
<br>
<input type="text" name="displayAmt2" size="15">
in
<input type="text" name="displayYear2" size="6">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>