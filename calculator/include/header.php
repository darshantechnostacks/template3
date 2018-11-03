 <link rel='stylesheet' id='bundle.css-css' href='calculator/css/app.bundle.css' type='text/css' media='all' />
 <style>
 .mb5 {
    margin-bottom: 5vw !important;
}
</style>
 <script Language='JavaScript'>
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
 </script>
 