
<!DOCTYPE html>
<html lang="en-US" >
    <head>
        <meta charset="UTF-8" />
        <title>Simple Retirement Savings Calculator - Easy To Use</title>

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
            }
        </style>


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

                var isNeg = 0;

                if (num < 0) {
                    num = num * -1;
                    isNeg = 1;
                }

                var myDecFact = 1;
                var myPlaces = 0;
                var myZeros = "";
                while (myPlaces < places) {
                    myDecFact = myDecFact * 10;
                    myPlaces = Number(myPlaces) + Number(1);
                    myZeros = myZeros + "0";
                }

                onum = Math.round(num * myDecFact) / myDecFact;

                integer = Math.floor(onum);

                if (Math.ceil(onum) == integer) {
                    decimal = myZeros;
                } else {
                    decimal = Math.round((onum - integer) * myDecFact)
                }
                decimal = decimal.toString();
                if (decimal.length < places) {
                    fillZeroes = places - decimal.length;
                    for (z = 0; z < fillZeroes; z++) {
                        decimal = "0" + decimal;
                    }
                }

                if (places > 0) {
                    decimal = "." + decimal;
                }

                if (comma == 1) {
                    integer = integer.toString();
                    var tmpnum = "";
                    var tmpinteger = "";
                    var y = 0;

                    for (x = integer.length; x > 0; x--) {
                        tmpnum = tmpnum + integer.charAt(x - 1);
                        y = y + 1;
                        if (y == 3 & x > 1) {
                            tmpnum = tmpnum + ",";
                            y = 0;
                        }
                    }

                    for (x = tmpnum.length; x > 0; x--) {
                        tmpinteger = tmpinteger + tmpnum.charAt(x - 1);
                    }


                    finNum = tmpinteger + "" + decimal;
                } else {
                    finNum = integer + "" + decimal;
                }

                if (isNeg == 1) {
                    finNum = "-" + finNum;
                }

                return finNum;
            }




            function sn(num) {

                num = num.toString();


                var len = num.length;
                var rnum = "";
                var test = "";
                var j = 0;

                var b = num.substring(0, 1);
                if (b == "-") {
                    rnum = "-";
                }

                for (i = 0; i <= len; i++) {

                    b = num.substring(i, i + 1);

                    if (b == "0" || b == "1" || b == "2" || b == "3" || b == "4" || b == "5" || b == "6" || b == "7" || b == "8" || b == "9" || b == ".") {
                        rnum = rnum + "" + b;

                    }

                }

                if (rnum == "" || rnum == "-") {
                    rnum = 0;
                }

                rnum = Number(rnum);

                return rnum;

            }

            function computeForm(form) {

                if (document.calc.goal.value.length == 0) {
                    alert("Please enter your savings goal.");
                    document.calc.goal.focus();
                } else
                if (document.calc.moAdd.value.length == 0) {
                    alert("Please enter the Monthly Addition.");
                    document.calc.moAdd.focus();
                } else
                if (document.calc.interest.value.length == 0) {
                    alert("Please enter the Annual Interest Rate.");
                    document.calc.interest.focus();
                } else {


                    var i = sn(document.calc.interest.value);

                    if (i >= 1.0) {
                        i /= 100;
                    }
                    i /= 12;

                    var ma = sn(document.calc.moAdd.value);

                    var prin = sn(document.calc.principal.value);
                    var Vgoal = sn(document.calc.goal.value);
                    var VmoAdd = sn(document.calc.moAdd.value);
                    var count = 0;

                    while (prin < Vgoal) {
                        prin += VmoAdd;
                        prin = (prin * i) + Number(prin);
                        count = count + 1;
                        if (count > 1200) {
                            alert("It will take you more than 100 years to reach your goal");
                            break;
                        } else {
                            continue;
                        }
                    }


                    if (count > 1200) {
                        document.calc.months.value = "1200+";
                        document.calc.years.value = "100+";
                    } else {
                        document.calc.months.value = count;
                        document.calc.years.value = fn(count / 12, 2, 1);
                    }
                    jQuery('.email-my-results').removeClass('hidden');

                }

            }


            function clear_results(form) {

                document.calc.months.value = "";
                document.calc.years.value = "";

            }</script>



        <style type="text/css">.broken_link, a.broken_link {
                text-decoration: line-through;
            }
        </style>
    </head>

    <body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-7034 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none retirement-savings-calculator not_home feature-box-none footer-height-tall calculator" itemscope >
        <div class="site-container">

            <div class="banner-bg">


            </div>
            <div class="site-inner">
                <div class="content-sidebar-wrap"><main class="content">
                        <article class="post-7034 page type-page status-publish has-post-thumbnail entry" itemscope itemtype="https://schema.org/CreativeWork">

                            
                            <div class="entry-content" itemprop="text"><span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">

                                </span>
                                <input class="jpibfi" type="hidden">
                                <div class="visible-xs" style="text-align: center">


                                </div>


                                <p></div></p>
                            <p>
                            <div class="fmcalc-inner-container fmcalc-ic-c3">
                                <div class="fmcalc-wrapper">
                                    <form name="calc" method="post" action="#">
                                        <table class="fmcalc" cellpadding='4' cellspacing='0'>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">
                                                        <br><h4 align=center>Simple Retirement Savings Calculator</h4>
                                                        <div class="fmcalc-separator"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enter the amount you currently have set aside:
                                                    </td>
                                                    <td align="center">
                                                        <input type="text" name="principal" size="15" onKeyUp="clear_results(this.form)" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enter the amount you want to accumulate (goal):
                                                    </td>
                                                    <td align="center">
                                                        <input type="text" name="goal" size="15" onKeyUp="clear_results(this.form)" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enter the monthly addition:
                                                    </td>
                                                    <td align="center">
                                                        <input type="text" name="moAdd" size="15" onKeyUp="clear_results(this.form)" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enter the annual interest rate:
                                                    </td>
                                                    <td align="center">
                                                        <input type="text" name="interest" size="15" onKeyUp="clear_results(this.form)" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" colspan=2>
                                                        <input type="button" value="Calculate" onClick="computeForm(this.form)" />
                                                        <input type="reset" value="Reset" />
                                                        <div class="fmcalc-separator"></div>
                                                        <div class="clearfix"></div>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        # of months until goal is met:
                                                    </td>
                                                    <td align="center">
                                                        <input type="text" name="months" size="15" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        # of years until goal is met:
                                                    </td>
                                                    <td align="center">
                                                        <input type="text" name="years" size="15" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div><br />

                            </p>

                            </div>
                        </article>
                    </main>

                </div></div>
            <div class="clearfix"></div>

        </div>



 <?php include_once 'include/footer.php'; ?>













