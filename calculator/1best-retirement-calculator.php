
<!DOCTYPE html>
<html lang="en-US" >
    <head>
        
        <title>Ultimate Retirement Calculator</title>

        <script type="text/javascript">
            window._wpemojiSettings = {"baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.4\/72x72\/", "ext": ".png", "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.4\/svg\/", "svgExt": ".svg", "source": {"concatemoji": "https:\/\/financialmentor.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=998c08572d0ecc8b9f0fa09a45c0aa11"}};
            !function (a, b, c) {
                function d(a, b) {
                    var c = String.fromCharCode;
                    l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, a), 0, 0);
                    var d = k.toDataURL();
                    l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, b), 0, 0);
                    var e = k.toDataURL();
                    return d === e
                }
                function e(a) {
                    var b;
                    if (!l || !l.fillText)
                        return!1;
                    switch (l.textBaseline = "top", l.font = "600 32px Arial", a) {
                        case"flag":
                            return!(b = d([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819])) && (b = d([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]), !b);
                        case"emoji":
                            return b = d([55357, 56692, 8205, 9792, 65039], [55357, 56692, 8203, 9792, 65039]), !b
                    }
                    return!1
                }
                function f(a) {
                    var c = b.createElement("script");
                    c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
                }
                var g, h, i, j, k = b.createElement("canvas"), l = k.getContext && k.getContext("2d");
                for (j = Array("flag", "emoji"), c.supports = {everything:!0, everythingExceptFlag:!0}, i = 0; i < j.length; i++)
                    c.supports[j[i]] = e(j[i]), c.supports.everything = c.supports.everything && c.supports[j[i]], "flag" !== j[i] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[j[i]]);
                c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function () {
                    c.DOMReady = !0
                }, c.supports.everything || (h = function () {
                    c.readyCallback()
                }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", h, !1), a.addEventListener("load", h, !1)) : (a.attachEvent("onload", h), b.attachEvent("onreadystatechange", function () {
                    "complete" === b.readyState && c.readyCallback()
                })), g = c.source || {}, g.concatemoji ? f(g.concatemoji) : g.wpemoji && g.twemoji && (f(g.twemoji), f(g.wpemoji)))
            }(window, document, window._wpemojiSettings);
        </script>

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
       
      
        <script type="text/javascript">
                    (function (e, a) {
                if (!a.__SV) {
                    var b = window;
                    try {
                        var c, l, i, j = b.location, g = j.hash;
                        c = function (a, b) {
                            return(l = a.match(RegExp(b + "=([^&]*)"))) ? l[1] : null
                        };
                        g && c(g, "state") && (i = JSON.parse(decodeURIComponent(c(g, "state"))), "mpeditor" === i.action && (b.sessionStorage.setItem("_mpcehash", g), history.replaceState(i.desiredHash || "", e.title, j.pathname + j.search)))
                    } catch (m) {
                    }
                    var k, h;
                    window.mixpanel = a;
                    a._i = [];
                    a.init = function (b, c, f) {
                        function e(b, a) {
                            var c = a.split(".");
                            2 == c.length && (b = b[c[0]], a = c[1]);
                            b[a] = function () {
                                b.push([a].concat(Array.prototype.slice.call(arguments,
                                        0)))
                            }
                        }
                        var d = a;
                        "undefined" !== typeof f ? d = a[f] = [] : f = "mixpanel";
                        d.people = d.people || [];
                        d.toString = function (b) {
                            var a = "mixpanel";
                            "mixpanel" !== f && (a += "." + f);
                            b || (a += " (stub)");
                            return a
                        };
                        d.people.toString = function () {
                            return d.toString(1) + ".people (stub)"
                        };
                        k = "disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
                        for (h = 0; h < k.length; h++)
                            e(d, k[h]);
                        a._i.push([b, c, f])
                    };
                    a.__SV = 1.2;
                    b = e.createElement("script");
                    b.type = "text/javascript";
                    b.async = !0;
                    b.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
                    c = e.getElementsByTagName("script")[0];
                    c.parentNode.insertBefore(b, c)
                }
            })(document, window.mixpanel || []);
            mixpanel.init("ae358da44814014c49bc290a392cb1bc");
        </script>
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
            }
        </style>
      
        <style>.async-hide { opacity: 0 !important} </style>
        <script>(function (a, s, y, n, c, h, i, d, e) {
                s.className += ' ' + y;
                h.start = 1 * new Date;
                h.end = i = function () {
                    s.className = s.className.replace(RegExp(' ?' + y), '')
                };
                (a[n] = a[n] || []).hide = h;
                setTimeout(function () {
                    i();
                    h.end = null
                }, c);
                h.timeout = c;
            })(window, document.documentElement, 'async-hide', 'dataLayer', 4000,
                    {'GTM-TSP4PPK': true});
        </script>


        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:300|Roboto:500,100,300,700,300italic,400,400italic,500italic' rel='stylesheet' type='text/css'>
        
        <script Language='JavaScript'>


            function FVsingleDep(prin, intRate, numMonths, numCompPerYr) {

                var i = 0;
                var intEarn = 0;
                var singleFV = prin;

                intRate /= 100;

                if (numCompPerYr == "" || numCompPerYr == 0) {
                    numCompPerYr = 12;
                }
                intRate /= numCompPerYr;

                var numPeriods = numMonths / 12 * numCompPerYr;

                singleFV = Math.pow((eval(1) + eval(intRate)), numPeriods) * singleFV;

                return singleFV;

            }



            function PVsingleAmt(f_fv, f_rate, f_yrs, f_cpy) {

                var f_prin = f_fv;
                var f_i = f_rate;
                var f_npr = f_yrs * f_cpy;

                var f_count = 0;
                var f_factor = 1;

                f_i /= 100;
                f_i /= f_cpy;
                var f_pow = Number(1) + Number(f_i);


                while (f_count < f_npr) {


                    f_factor = f_factor * f_pow;
                    f_count += 1;

                }

                f_prin = f_fv / f_factor;
                return f_prin;

            }



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

            function mo_save(f_rate, f_gap, f_years) {

                //FIGURE PRESENT VALUE OF ADJUSTED SAVINGS GAP

                var f_count = 0;

                var f_i = f_rate / 100;

                var f_months = f_years;

                var f_factor = Number(1) + Number(f_i);

                var f_denom = 1;

                while (f_count < f_months) {
                    f_denom = f_denom * f_factor;
                    f_count = Number(f_count) + Number(1);
                }

                var f_pv = Number(f_denom) - Number(1);

                f_pv = f_i / f_pv;

                f_pv = f_pv * f_gap;

                return f_pv;
            }

            function schedule(form) {

                var sched_area = document.getElementById("sched_div");
                sched_area.innerHTML = "";

                if (document.calc.now_age_1.value.length == 0 || document.calc.now_age_1.value == 0) {
                    alert("Please enter age at the end of current year.");
                    document.calc.now_age_1.focus();
                } else
                if (document.calc.retire_age_1.value.length == 0 || document.calc.retire_age_1.value == 0) {
                    alert("Please enter the age you plan to retire at.");
                    document.calc.retire_age_1.focus();
                } else
                if (Number(document.calc.now_age_1.value) >= Number(document.calc.retire_age_1.value)) {
                    alert("Please enter a retirement age that is greater than your current age.");
                    document.calc.retire_age_1.focus();
                } else
                if (document.calc.life_age_1.value.length == 0 || document.calc.life_age_1.value == 0) {
                    alert("Please enter the age you expect to live until.");
                    document.calc.life_age_1.focus();
                } else
                if (document.calc.ann_ret_inc.value.length == 0 || document.calc.ann_ret_inc.value == 0) {
                    alert("Please enter the desired annual retirement income.");
                    document.calc.ann_ret_inc.focus();
                } else
                if (Number(document.calc.reduce_ret_inc_perc.value) > 0 && Number(document.calc.reduce_ret_inc_yrs.value) == 0) {
                    alert("Please enter year increments you would like to reduce our retirement income need.");
                    document.calc.reduce_ret_inc_yrs.focus();
                } else
                if (Number(document.calc.cur_contrib_1.value) > 0 && Number(document.calc.stop_contrib_1.value) == 0) {
                    alert("Please enter the age to stop contributions.");
                    document.calc.stop_contrib_1.focus();
                } else
                if (document.calc.rate.value.length == 0 || document.calc.rate.value == 0) {
                    alert("Please enter the Annual Interest Rate you expect to earn.");
                    document.calc.rate.focus();
                } else
                if (sn(document.calc.ret_inc_1_1.value) > 0 && (sn(document.calc.ret_1_start_age_1.value) == 0 || sn(document.calc.ret_1_stop_age_1.value) == 0)) {
                    alert("Please enter a start and stop age for " + document.calc.ret_1_name.value + " in order to have it included in the calculations.");
                    document.calc.ret_1_start_age_1.focus();
                } else
                if (sn(document.calc.ret_inc_2_1.value) > 0 && (sn(document.calc.ret_2_start_age_1.value) == 0 || sn(document.calc.ret_2_stop_age_1.value) == 0)) {
                    alert("Please enter a start and stop age for " + document.calc.ret_2_name.value + " in order to have it included in the calculations.");
                    document.calc.ret_2_start_age_1.focus();
                } else
                if (sn(document.calc.ret_inc_3_1.value) > 0 && (sn(document.calc.ret_3_start_age_1.value) == 0 || sn(document.calc.ret_3_stop_age_1.value) == 0)) {
                    alert("Please enter a start and stop age for " + document.calc.ret_3_name.value + " in order to have it included in the calculations.");
                    document.calc.ret_3_start_age_1.focus();
                } else
                if (sn(document.calc.one_time_amt_1.value) > 0 && sn(document.calc.one_time_age_1.value) == 0) {
                    alert("Please enter the age you expect to receive the " + document.calc.one_time_amt_name_1.value + " in order to have it included in the calculations.");
                    document.calc.one_time_age_1.focus();
                } else
                if (sn(document.calc.one_time_amt_2.value) > 0 && sn(document.calc.one_time_age_2.value) == 0) {
                    alert("Please enter the age you expect to receive the " + document.calc.one_time_amt_name_2.value + " in order to have it included in the calculations.");
                    document.calc.one_time_age_2.focus();
                } else
                if (sn(document.calc.one_time_amt_3.value) > 0 && sn(document.calc.one_time_age_3.value) == 0) {
                    alert("Please enter the age you expect to receive the " + document.calc.one_time_amt_name_3.value + " in order to have it included in the calculations.");
                    document.calc.one_time_age_3.focus();
                } else
                if (sn(document.calc.one_time_amt_4.value) > 0 && sn(document.calc.one_time_age_4.value) == 0) {
                    alert("Please enter the age you expect to receive the " + document.calc.one_time_amt_name_4.value + " in order to have it included in the calculations.");
                    document.calc.one_time_age_4.focus();
                } else {

                    var today = new Date();
                    var dayFactor = today.getTime();
                    var pmtDay = today.getDate();
                    var loanMM = today.getMonth() + 1;
                    var loanYY = today.getYear();
                    if (loanYY < 1900) {
                        loanYY += 1900;
                    }
                    var loanDate = (loanMM + "/" + pmtDay + "/" + loanYY);
                    document.calc.report_date.value = loanDate;
                    var monthMS = 86400000 * 30.4;

                    var cur_yr = loanYY;

                    var v_now_age_1 = sn(document.calc.now_age_1.value);
                    var v_retire_age_1 = sn(document.calc.retire_age_1.value);
                    var v_life_age_1 = sn(document.calc.life_age_1.value);

                    //ANNUAL YEARS AND AGES ***CHANGED***
                    var v_yrs_till_ret_1 = Number(v_retire_age_1) - Number(v_now_age_1);
                    var v_pre_yrs = v_yrs_till_ret_1;

                    var age_1 = v_now_age_1;

                    //MAX RETIREMENT YEARS ***CHANGED***
                    var v_tot_yrs_1 = Number(v_life_age_1) - Number(v_now_age_1);
                    var rep_yrs = v_tot_yrs_1;

                    //ANNUAL CONTRIBUTIONS
                    var v_cur_contrib_1 = sn(document.calc.cur_contrib_1.value);
                    var cur_yr_cont = Number(12) - Number(loanMM);
                    var pre_mon_contrib = Number(v_cur_contrib_1);
                    var ann_contrib = 0;
                    var v_stop_contrib_1 = sn(document.calc.stop_contrib_1.value);

                    //CURRENT SAVINGS
                    var v_cur_savings_1 = sn(document.calc.cur_savings_1.value);
                    var cur_savings_tot = Number(v_cur_savings_1);


                    //ANNUAL INTEREST EARNED
                    var v_rate = sn(document.calc.rate.value);
                    var int = v_rate / 100;
                    var ann_int_earn = 0;
                    var accum_save = cur_savings_tot;
                    var beg_bal = 0;
                    var end_bal = 0;

                    //ANNUAL INFLATION
                    var v_ann_ret_inc = sn(document.calc.ann_ret_inc.value);
                    var v_inflate = sn(document.calc.inflate.value);
                    var base_fact = v_inflate / 100;
                    var ann_infl_mult = Number(1) + Number(base_fact);
                    var accum_infl_fact = 1;
                    var infl_ann_inc = 0;

                    //POST RETIREMENT INCOME TAX
                    var v_tax_rate = sn(document.calc.tax_rate.value);
                    var tax_perc = v_tax_rate / 100;

                    //RETIREMENT INCOME
                    var v_ret_inc_1_1 = sn(document.calc.ret_inc_1_1.value);
                    var v_ret_1_start_age_1 = sn(document.calc.ret_1_start_age_1.value);
                    var v_ret_1_stop_age_1 = sn(document.calc.ret_1_stop_age_1.value);
                    var v_ret_1_col = sn(document.calc.ret_1_col.value);
                    var ret_1_col = Number(1) + Number(v_ret_1_col / 100);
                    var accum_ret_1_col = Number(1);
                    var v_ret_1_col_start = document.calc.ret_1_col_start.selectedIndex;

                    var v_ret_inc_2_1 = sn(document.calc.ret_inc_2_1.value);
                    var v_ret_2_start_age_1 = sn(document.calc.ret_2_start_age_1.value);
                    var v_ret_2_stop_age_1 = sn(document.calc.ret_2_stop_age_1.value);
                    var v_ret_2_col = sn(document.calc.ret_2_col.value);
                    var ret_2_col = Number(1) + Number(v_ret_2_col / 100);
                    var accum_ret_2_col = Number(1);
                    var v_ret_2_col_start = document.calc.ret_2_col_start.selectedIndex;

                    var v_ret_inc_3_1 = sn(document.calc.ret_inc_3_1.value);
                    var v_ret_3_start_age_1 = sn(document.calc.ret_3_start_age_1.value);
                    var v_ret_3_stop_age_1 = sn(document.calc.ret_3_stop_age_1.value);
                    var v_ret_3_col = sn(document.calc.ret_3_col.value);
                    var ret_3_col = Number(1) + Number(v_ret_3_col / 100);
                    var accum_ret_3_col = Number(1);
                    var v_ret_3_col_start = document.calc.ret_3_col_start.selectedIndex;


                    var ret_inc = 0;

                    //ONE-TIME BENEFIT
                    var v_one_time_amt_1 = sn(document.calc.one_time_amt_1.value);
                    var v_one_time_age_1 = sn(document.calc.one_time_age_1.value);

                    var v_one_time_amt_2 = sn(document.calc.one_time_amt_2.value);
                    var v_one_time_age_2 = sn(document.calc.one_time_age_2.value);

                    var v_one_time_amt_3 = sn(document.calc.one_time_amt_3.value);
                    var v_one_time_age_3 = sn(document.calc.one_time_age_3.value);

                    var v_one_time_amt_4 = sn(document.calc.one_time_amt_4.value);
                    var v_one_time_age_4 = sn(document.calc.one_time_age_4.value);


                    //REDUCTION IN RETIREMENT INCOME NEEDS
                    var v_reduce_ret_inc_yrs = sn(document.calc.reduce_ret_inc_yrs.value);
                    var v_reduce_ret_inc_perc = sn(document.calc.reduce_ret_inc_perc.value);
                    var reduce_perc = Number(1) - Number(v_reduce_ret_inc_perc / 100);
                    var reduce_period = 0;


                    //RETIREMENT NEED ADJUSTMENTS
                    var adj_need = 0;

                    //TOTAL OF WITHDRAWELS
                    var accum_draw = 0;


                    //SHORTFALL
                    var accum_shortfall = 0;

                    //ESTATE
                    var v_estate = sn(document.calc.estate.value);

                    //PRESENT VALUES OF NEEDS
                    var per_npv = 0;
                    var ret_yr = 0;
                    var v_ret_fund = 0;
                    var v_accum_npv = 0;



                    var row = "<table width='90%' border='1' cellspacing='0' cellpadding='2' bordercolor='CCCCCC'>";
                    row += "<tr bgcolor='#D3DCE3'>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Year</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Age</small></strong></font>";
                    row += "</td>";

                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Year<br />Begin<br />Balance</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Contri-<br />butions</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Interest<br />Earnings</small></strong></font>";
                    row += "</td>";
                    //row += "<td align='center'>";
                    //row += "<font face='arial'><strong><small>I Fact</small></strong></font>";
                    //row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Inflated<br />Need</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Need<br />Redu-<br>ctions<br />(Inc-<br>ome)</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Adjusted<br />Need</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Pre-tax<br />Need</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Net<br />Present<br />Value</small></strong></font>";
                    row += "</td>";
                    row += "<td align='center'>";
                    row += "<font face='arial'><strong><small>Year<br />End<br />Balance</small></strong></font>";
                    row += "</td>";
                    row += "</tr>";

                    for (var i = 1; i <= rep_yrs + 1; i++) {


                        ann_contrib = 0;
                        ret_inc = 0;

                        if (v_ret_1_col_start == 0) {
                            accum_ret_1_col = accum_ret_1_col * ret_1_col;
                        }
                        if (v_ret_2_col_start == 0) {
                            accum_ret_2_col = accum_ret_2_col * ret_2_col;
                        }
                        if (v_ret_3_col_start == 0) {
                            accum_ret_3_col = accum_ret_3_col * ret_3_col;
                        }

                        //PRE RETIREMENT
                        if (i <= v_pre_yrs) {

                            if (i == 1) {
                                ann_contrib = 0;
                                beg_bal = cur_savings_tot;
                                end_bal = beg_bal;
                                accum_infl_fact = 1;
                            } else {
                                beg_bal = end_bal;
                                accum_infl_fact = accum_infl_fact * ann_infl_mult;
                                if (age_1 < v_stop_contrib_1) {
                                    ann_contrib += (v_cur_contrib_1 * 12);
                                }
                            }

                            //10/25/2012
                            //ONE-TIME BENEFITS
                            if (v_one_time_age_1 == age_1) {
                                ann_contrib += v_one_time_amt_1;
                            }
                            if (v_one_time_age_2 == age_1) {
                                ann_contrib += v_one_time_amt_2;
                            }
                            if (v_one_time_age_3 == age_1) {
                                ann_contrib += v_one_time_amt_3;
                            }
                            if (v_one_time_age_4 == age_1) {
                                ann_contrib += v_one_time_amt_4;
                            }

                            end_bal += ann_contrib;
                            ann_int_earn = beg_bal * int;

                            end_bal += ann_int_earn;
                            v_ret_fund = end_bal;

                            infl_ann_inc = v_ann_ret_inc * accum_infl_fact;

                            row += "<tr>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + cur_yr + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + age_1 + "</small></font>";
                            row += "</td>";

                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(beg_bal, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(ann_contrib, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(ann_int_earn, 0, 1) + "</small></font>";
                            row += "</td>";
                            //row += "<td align='right'>";
                            //row += "<font face='arial'><small>" + fn(accum_infl_fact,4,0) + "</small></font>";
                            //row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(infl_ann_inc, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += " ";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += " ";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += " ";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += " ";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(end_bal, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "</tr>";


                            //POST RETIREMENT
                        } else {



                            reduce_period += 1;
                            ret_yr += 1;

                            beg_bal = end_bal;

                            if (age_1 < v_stop_contrib_1) {
                                ann_contrib += (v_cur_contrib_1 * 12);
                            }

                            if (reduce_period > v_reduce_ret_inc_yrs) {
                                v_ann_ret_inc = v_ann_ret_inc * reduce_perc;
                                reduce_period = 1;
                            }

                            accum_infl_fact = accum_infl_fact * ann_infl_mult;
                            infl_ann_inc = v_ann_ret_inc * accum_infl_fact;

                            if (v_ret_1_col_start == 1) {
                                accum_ret_1_col = accum_ret_1_col * ret_1_col;
                            }

                            if (v_ret_inc_1_1 > 0 && age_1 >= v_ret_1_start_age_1 && age_1 <= v_ret_1_stop_age_1) {
                                ret_inc += (v_ret_inc_1_1 * 12 * accum_ret_1_col);
                            }


                            if (v_ret_2_col_start == 1) {
                                accum_ret_2_col = accum_ret_2_col * ret_2_col;
                            }

                            if (v_ret_inc_2_1 > 0 && age_1 >= v_ret_2_start_age_1 && age_1 <= v_ret_2_stop_age_1) {
                                ret_inc += (v_ret_inc_2_1 * 12 * accum_ret_2_col);
                            }


                            if (v_ret_3_col_start == 1) {
                                accum_ret_3_col = accum_ret_3_col * ret_3_col;
                            }


                            if (v_ret_inc_3_1 > 0 && age_1 >= v_ret_3_start_age_1 && age_1 <= v_ret_3_stop_age_1) {
                                ret_inc += (v_ret_inc_3_1 * 12 * accum_ret_3_col);
                            }


                            //ONE-TIME BENEFITS
                            if (v_one_time_age_1 == age_1) {
                                ret_inc += v_one_time_amt_1;
                            }
                            if (v_one_time_age_2 == age_1) {
                                ret_inc += v_one_time_amt_2;
                            }
                            if (v_one_time_age_3 == age_1) {
                                ret_inc += v_one_time_amt_3;
                            }
                            if (v_one_time_age_4 == age_1) {
                                ret_inc += v_one_time_amt_4;
                            }


                            adj_need = Number(infl_ann_inc) - Number(ret_inc);

                            if (adj_need > 0) {
                                tax_ann_inc = adj_need / (Number(1) - Number(tax_perc));
                            } else {
                                tax_ann_inc = adj_need;
                            }

                            per_npv = PVsingleAmt(tax_ann_inc, v_rate, ret_yr, 1);
                            v_accum_npv += per_npv;


                            accum_draw += tax_ann_inc;
                            end_bal -= tax_ann_inc;

                            if (end_bal < 0) {

                                accum_shortfall += end_bal;
                                ann_int_earn = 0;
                                end_bal = 0;

                            } else {

                                ann_int_earn = beg_bal * int;
                                end_bal += ann_int_earn;
                            }

                            row += "<tr>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + cur_yr + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            if (age_1 == 200) {
                                row += " ";
                            } else {
                                row += "<font face='arial'><small>" + age_1 + "</small></font>";
                            }
                            row += "</td>";

                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(beg_bal, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(ann_contrib, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(ann_int_earn, 0, 1) + "</small></font>";
                            row += "</td>";
                            //row += "<td align='right'>";
                            //row += "<font face='arial'><small>" + fn(accum_infl_fact,4,0) + "</small></font>";
                            //row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(infl_ann_inc, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(ret_inc, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(adj_need, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(tax_ann_inc, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(per_npv, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "<td align='right'>";
                            row += "<font face='arial'><small>" + fn(end_bal, 0, 1) + "</small></font>";
                            row += "</td>";
                            row += "</tr>";





                        }


                        cur_yr += 1;

                        if (age_1 + 1 > v_life_age_1) {
                            age_1 = 200;
                        } else {
                            age_1 += 1;
                        }


                    }



                    row += "</table>";


                    sched_area.innerHTML = row;

                    accum_shortfall -= v_estate;

                    //ESTATE FIX 02/11/2011****************************
                    if (v_estate > 0) {
                        var v_npv_estate = PVsingleAmt(v_estate, v_rate, ret_yr, 1);
                        v_accum_npv += v_npv_estate;
                    }
                    //*************************************************

                    //document.calc.shortfall.value = fn(accum_shortfall,0,1);

                    if (accum_shortfall < 0) {
                        var v_gap = accum_shortfall * -1;

                        //var v_shortfall_contrib = mo_save(v_rate, v_gap, v_pre_yrs);
                        //var v_shortfall_contrib = mo_save(7,735787,16);
                        //document.calc.surp_short.value = fn(v_shortfall_contrib,0,1);

                    }

                    document.calc.accum_npv.value = "$" + fn(v_accum_npv, 0, 1);

                    document.calc.ret_fund.value = "$" + fn(v_ret_fund, 0, 1);

                    var v_save_gap = Number(v_ret_fund) - Number(v_accum_npv);
                    document.calc.save_gap.value = "$" + fn(v_save_gap, 0, 1);
                    if (v_save_gap < 0) {
                        v_save_gap = v_save_gap * -1;
                    } else {
                        v_save_gap = 0;

                    }

                    var save_yrs = Number(v_pre_yrs) - Number(1);
                    var ann_add_contrib = mo_save(v_rate, v_save_gap, save_yrs);
                    var v_add_contrib = ann_add_contrib / 12;
                    document.calc.add_contrib.value = "$" + fn(v_add_contrib, 0, 1);

                    var v_now_contrib = Number(v_cur_contrib_1);
                    document.calc.now_contrib.value = "$" + fn(v_now_contrib, 0, 1);

                    var v_tot_contrib = Number(v_add_contrib) + Number(v_now_contrib);
                    document.calc.tot_contrib.value = "$" + fn(v_tot_contrib, 0, 1);

                    jQuery('.email-my-results').removeClass('hidden');
                }

            }

            function clear_results(form) {

                document.calc.accum_npv.value = "";
                document.calc.ret_fund.value = "";
                document.calc.save_gap.value = "";
                document.calc.add_contrib.value = "";
                document.calc.now_contrib.value = "";
                document.calc.tot_contrib.value = "";

                var sched_area = document.getElementById("sched_div");
                sched_area.innerHTML = "";
            }


            function reset_calc(form) {

                if (confirm("Are you sure you want to clear the calculator?")) {

                    var sched_area = document.getElementById("sched_div");
                    sched_area.innerHTML = "";

                    document.calc.reset();

                    document.calc.now_age_1.focus();

                }
            }


            function help(help_id, fld) {


                var help_ar = new Array();
                help_ar[0] = "";
                help_ar[1] = "Enter your age at the end of the current year. If you are creating this plan for more than one person, enter the age of the oldest person.";
                help_ar[2] = "Enter the age you plan to retire at. If you are creating this plan for more than one person, enter the retirement age for the oldest person.";
                help_ar[3] = "Enter the age you expect to live to. If you are creating this plan for more than one person, enter the life-expectancy age of the person expected to live the longest.";
                help_ar[4] = "Enter the desired annual household retirement income, without adjusting for taxes or inflation - just the amount you need to spend. The calculator will adjust this number for taxes and inflation.";
                help_ar[5] = "If you believe your retirement income needs will decrease as your retirement years pass, enter number of years between need reductions. Otherwise, leave blank.";
                help_ar[6] = "If you believe your retirement income needs will decrease as your retirement years pass, enter reduction percentage here. Otherwise, leave blank.";
                help_ar[7] = "If you would like to leave an estate to your hiers, enter the dollar amount here. Your retirement savings will deplete to this value instead of zero.";
                help_ar[8] = "Enter the expected average annual rate of inflation between now and the end of your retirement plan.";


                help_ar[9] = "Enter the amount of your current retirement savings.";
                help_ar[10] = "Enter the amount of your current monthly contributions to your retirement fund.";
                help_ar[11] = "Enter the age you plan to stop making contributions to your retirement fund.";
                help_ar[12] = "Enter the annual interest rate (or return on investment) you expect to earn on your retirement investment. Enter as a whole number (for 6.5% enter 6.5).";
                help_ar[13] = "Enter your projected combined Federal and State income tax rate percentage during your retirement. Be careful to use your gross effective tax rate and not your marginal tax rate because the latter will overstate taxes. This is a common mistake.";



                help_ar[14] = "If you would like to give this one-time benefit a name for the report, you can do so in this field.";
                help_ar[15] = "If expect to receive a one-time addition to your retirement fund (sale of home, etc.), enter the amount here. IMPORTANT: In order to have this one-time benefit included in the calculations, you must enter both the amount and the age you expect to receive it in the field below.";
                help_ar[16] = "Enter the age you expect to add the one-time benefit amount to your retirement fund.";

                help_ar[17] = "If you would like to give this one-time benefit a name for the report, you can do so in this field.";
                help_ar[18] = "If expect to receive a one-time addition to your retirement fund (sale of home, etc.), enter the amount here. IMPORTANT: In order to have this one-time benefit included in the calculations, you must enter both the amount and the age you expect to receive it in the field below.";
                help_ar[19] = "Enter the age you expect to add the one-time benefit amount to your retirement fund.";

                help_ar[20] = "If you would like to give this one-time benefit a name for the report, you can do so in this field.";
                help_ar[21] = "If expect to receive a one-time addition to your retirement fund (sale of home, etc.), enter the amount here. IMPORTANT: In order to have this one-time benefit included in the calculations, you must enter both the amount and the age you expect to receive it in the field below.";
                help_ar[22] = "Enter the age you expect to add the one-time benefit amount to your retirement fund.";

                help_ar[23] = "If you would like to give this one-time benefit a name for the report, you can do so in this field.";
                help_ar[24] = "If expect to receive a one-time addition to your retirement fund (sale of home, etc.), enter the amount here. IMPORTANT: In order to have this one-time benefit included in the calculations, you must enter both the amount and the age you expect to receive it in the field below.";
                help_ar[25] = "Enter the age you expect to add the one-time benefit amount to your retirement fund.";

                help_ar[26] = "If you would like to give this retirement income a name for the report, you can do so in this field.";
                help_ar[27] = "Retirement Income #1: If you expect this retirement income to receive an annual COLA (Cost of Living Adjustment), enter the percentage here. Otherwise, leave blank.";
                help_ar[28] = "Retirement Income #1: If you expect this retirement income to receive an annual COLA (Cost of Living Adjustment), choose when the annual COLA should begin.";
                help_ar[29] = "Retirement Income #1: Enter the monthly amount net of taxes for this expected retirement income. IMPORTANT: In order to have this income included in the calculations, you must enter both a start and a stop age in the fields below.";
                help_ar[30] = "Retirement Income #1: Enter the age to begin this expected monthly retirement income. Must be greater than or equal to retirement age entered in top section.";
                help_ar[31] = "Retirement Income #1: Enter the age to end this expected retirement income.";

                help_ar[32] = "If you would like to give this retirement income a name for the report, you can do so in this field.";
                help_ar[33] = "Retirement Income #2: If you expect this retirement income to receive an annual COLA (Cost of Living Adjustment), enter the percentage here. Otherwise, leave blank.";
                help_ar[34] = "Retirement Income #2: If you expect this retirement income to receive an annual COLA (Cost of Living Adjustment), choose when the annual COLA should begin.";
                help_ar[35] = "Retirement Income #2: Enter the monthly amount net of taxes for this expected retirement income. IMPORTANT: In order to have this income included in the calculations, you must enter both a start and a stop age in the fields below.";
                help_ar[36] = "Retirement Income #2: Enter the age to begin this expected monthly retirement income. Must be greater than or equal to retirement age entered in top section.";
                help_ar[37] = "Retirement Income #2: Enter the age to end this expected retirement income.";

                help_ar[38] = "If you would like to give this retirement income a name for the report, you can do so in this field.";
                help_ar[39] = "Retirement Income #3: If you expect this retirement income to receive an annual COLA (Cost of Living Adjustment), enter the percentage here. Otherwise, leave blank.";
                help_ar[40] = "Retirement Income #3: If you expect this retirement income to receive an annual COLA (Cost of Living Adjustment), choose when the annual adjustment should begin.";
                help_ar[41] = "Retirement Income #3: Enter the monthly amount net of taxes for this expected retirement income. IMPORTANT: In order to have this income included in the calculations, you must enter both a start and a stop age in the fields below.";
                help_ar[42] = "Retirement Income #3: Enter the age to begin this expected monthly retirement income. Must be greater than or equal to retirement age entered in top section.";
                help_ar[43] = "Retirement Income #3: Enter the age to end this expected retirement income.";

                help_ar[44] = "This is the amount you will need to have saved by retirement age in order to fund your retirement plan.";
                help_ar[45] = "Based on your current savings, current contributions and expected annual return on your retirement investments, this is how much you will have saved by retirement age.";
                help_ar[46] = "This is the difference between how much you will need to have saved and how much you will have saved based on your present entries. A positive number represents a surplus, whereas a negative number represents a shortfall.";
                help_ar[47] = "If your retirement plan shows a shortfall, this is the additional monthly contributions you will need to start making now in order to fully fund your retirement plan.";
                help_ar[48] = "This is your current monthly contributions.";
                help_ar[49] = "This is the total monthly contributions you need to start making now in order to fully fund your plan.";



                var help_cell = document.getElementById("help_" + help_id + "");
                help_cell.innerHTML = "<font face='arial'><small>" + help_ar[fld] + "</small></font>";

                for (var i = 1; i < 6; i++) {

                    if (i != help_id) {

                        var clear_cell = document.getElementById("help_" + i + "");
                        clear_cell.innerHTML = "";
                    }
                }

            }

            function create_report(form) {

                var rep_rows = "<table width='90%' border='1' cellspacing='0' cellpadding='2' bordercolor='CCCCCC'>";

                rep_rows += "<tr bgcolor='#D3DCE3'>";
                rep_rows += "<td colspan='3'>";
                rep_rows += "<font face='arial'><strong>Retirement Needs</strong></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Age at the end of current year";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.now_age_1.value), 0, 0) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Age you plan to retire at";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.retire_age_1.value), 0, 0) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Life expectancy";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.life_age_1.value), 0, 0) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Desired annual retirement income";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.ann_ret_inc.value), 0, 1) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                if (sn(document.calc.reduce_ret_inc_yrs.value) > 0 && sn(document.calc.reduce_ret_inc_perc.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "Every " + document.calc.reduce_ret_inc_yrs.value + " years of retirement, reduce our income need by this percentage";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td align='right'>";
                    rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.reduce_ret_inc_perc.value), 2, 0) + "%</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Desired estate";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.estate.value), 0, 1) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Expected average annual rate of inflation";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.inflate.value), 2, 0) + "%</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr bgcolor='#D3DCE3'>";
                rep_rows += "<td colspan='3'>";
                rep_rows += "<font face='arial'><strong>Retirement Funding</strong></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Current retirement savings";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.cur_savings_1.value), 0, 1) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Current monthly contributions";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.cur_contrib_1.value), 0, 1) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Age to stop contributions";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.stop_contrib_1.value), 0, 0) + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Annual Interest Rate you expect to earn";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.rate.value), 2, 0) + "%</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Combined Federal & State Tax Rate during retirement";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + fn(sn(document.calc.tax_rate.value), 2, 0) + "%</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr  class='ChartColHead1'>";
                rep_rows += "<td colspan='3'>";
                rep_rows += "Lump Sum Contributions";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr bgcolor='#D3DCE3'>";
                rep_rows += "<td colspan='3'>";
                rep_rows += "<font face='arial'><strong>One Time Benefits</strong></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                if (sn(document.calc.one_time_amt_1.value) > 0 && sn(document.calc.one_time_age_1.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.one_time_amt_name_1.value + " at age " + document.calc.one_time_age_1.value + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "$" + fn(sn(document.calc.one_time_amt_1.value), 0, 0) + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }
                if (sn(document.calc.one_time_amt_2.value) > 0 && sn(document.calc.one_time_age_2.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.one_time_amt_name_2.value + " at age " + document.calc.one_time_age_2.value + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "$" + fn(sn(document.calc.one_time_amt_2.value), 0, 0) + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }
                if (sn(document.calc.one_time_amt_3.value) > 0 && sn(document.calc.one_time_age_3.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.one_time_amt_name_3.value + " at age " + document.calc.one_time_age_3.value + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "$" + fn(sn(document.calc.one_time_amt_3.value), 0, 0) + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }
                if (sn(document.calc.one_time_amt_4.value) > 0 && sn(document.calc.one_time_age_4.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.one_time_amt_name_4.value + " at age " + document.calc.one_time_age_4.value + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "$" + fn(sn(document.calc.one_time_amt_4.value), 0, 0) + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }

                rep_rows += "<tr bgcolor='#D3DCE3'>";
                rep_rows += "<td colspan='3'>";
                rep_rows += "<font face='arial'><strong>Post-Retirement Income (Pension, SS, Wages, etc.)</strong></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";


                if (sn(document.calc.ret_inc_1_1.value) > 0 &&
                        sn(document.calc.ret_1_start_age_1.value) > 0 &&
                        sn(document.calc.ret_1_stop_age_1.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.ret_1_name.value + ": Monthly from ";
                    rep_rows += "age " + fn(sn(document.calc.ret_1_start_age_1.value), 0, 0) + " to ";
                    rep_rows += "age " + fn(sn(document.calc.ret_1_stop_age_1.value), 0, 0) + ", ";
                    rep_rows += "" + fn(sn(document.calc.ret_1_col.value), 1, 0) + "% COL starting ";
                    rep_rows += "" + document.calc.ret_1_col_start.options[document.calc.ret_1_col_start.selectedIndex].text + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td align='right'>";
                    rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.ret_inc_1_1.value), 2, 0) + "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }

                if (sn(document.calc.ret_inc_2_1.value) > 0 &&
                        sn(document.calc.ret_2_start_age_1.value) > 0 &&
                        sn(document.calc.ret_2_stop_age_1.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.ret_2_name.value + ": Monthly from ";
                    rep_rows += "age " + fn(sn(document.calc.ret_2_start_age_1.value), 0, 0) + " to ";
                    rep_rows += "age " + fn(sn(document.calc.ret_2_stop_age_1.value), 0, 0) + ", ";
                    rep_rows += "" + fn(sn(document.calc.ret_2_col.value), 1, 0) + "% COL starting ";
                    rep_rows += "" + document.calc.ret_2_col_start.options[document.calc.ret_2_col_start.selectedIndex].text + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td align='right'>";
                    rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.ret_inc_2_1.value), 2, 0) + "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }

                if (sn(document.calc.ret_inc_3_1.value) > 0 &&
                        sn(document.calc.ret_3_start_age_1.value) > 0 &&
                        sn(document.calc.ret_3_stop_age_1.value) > 0) {
                    rep_rows += "<tr>";
                    rep_rows += "<td>";
                    rep_rows += "<font face='tahoma'><small>";
                    rep_rows += "" + document.calc.ret_3_name.value + ": Monthly from ";
                    rep_rows += "age " + fn(sn(document.calc.ret_3_start_age_1.value), 0, 0) + " to ";
                    rep_rows += "age " + fn(sn(document.calc.ret_3_stop_age_1.value), 0, 0) + ", ";
                    rep_rows += "" + fn(sn(document.calc.ret_3_col.value), 1, 0) + "% COL starting ";
                    rep_rows += "" + document.calc.ret_3_col_start.options[document.calc.ret_3_col_start.selectedIndex].text + "";
                    rep_rows += "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "<td align='right'>";
                    rep_rows += "<font face='tahoma'><small>$" + fn(sn(document.calc.ret_inc_3_1.value), 2, 0) + "</small></font>";
                    rep_rows += "</td>";
                    rep_rows += "</tr>";
                }


                rep_rows += "<tr bgcolor='#D3DCE3'>";
                rep_rows += "<td colspan='3'>";
                rep_rows += "<font face='arial'><strong>Results</strong></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Savings Needed at Retirement Age";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + document.calc.accum_npv.value + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Savings at Retirement Based on Present Entries";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + document.calc.ret_fund.value + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Savings Surplus (negative number indicates a ShortFall)";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + document.calc.save_gap.value + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Additional Monthly Contribution Needed to Fully Fund Plan";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + document.calc.add_contrib.value + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";

                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Present Monthly Contributions";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + document.calc.now_contrib.value + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";


                rep_rows += "<tr>";
                rep_rows += "<td>";
                rep_rows += "<font face='tahoma'><small>";
                rep_rows += "Total Monthly Contribution Needed to Fully Fund Plan";
                rep_rows += "</small></font>";
                rep_rows += "</td>";
                rep_rows += "<td align='right'>";
                rep_rows += "<font face='tahoma'><small>" + document.calc.tot_contrib.value + "</small></font>";
                rep_rows += "</td>";
                rep_rows += "</tr>";




                rep_rows += "</table><br /><br />";

                var sched_area = document.getElementById("sched_div");
                var sched_tbl = sched_area.innerHTML;

                var part_1 = "<head><title>Retirement Planning Report</title></head>";
                part_1 += "<";
                part_1 += "bo";
                part_1 += "dy ";
                part_1 += "bgcolor='#FFFFFF'>";
                part_1 += "<br /><center>";


                part_1 += "<font face='arial'><big><strong>Retirement Planning Report</strong></big></font><br />";
                part_1 += "<font face='arial'><small><strong>" + document.calc.report_date.value + "</strong></small></font><br /><br />";

                var part_4 = "<form method='post'>";
                part_4 += "<br /><input type='button' value='Close Window' onClick='window.close()'>";
                part_4 += "</form></center></body></html>";

                var schedule = (part_1 + "" + rep_rows + "" + sched_tbl + "" + part_4 + "");


                reportWin = window.open("", "", "width=700,height=500,toolbar=yes,menubar=yes,scrollbars=yes,resizable=yes");
                reportWin.document.write(schedule);
                reportWin.document.close();


            }</script>
        <style type="text/css">.essb_displayed_postfloat { margin-left: -60px !important; }.essb_displayed_postfloat.essb_postfloat_fixed { top: 50px !important; }</style>
       
        <style type="text/css">.broken_link, a.broken_link {
                text-decoration: line-through;
            }
        </style>
    </head>
    <body class="page-template page-template-templates page-template-calculator-content-sidebar page-template-templatescalculator-content-sidebar-php page page-id-6911 page-child parent-pageid-6715 header-image header-full-width content-sidebar fmfb_none best-retirement-calculator not_home feature-box-none footer-height-tall calculator" itemscope itemtype="https://schema.org/WebPage"><div class="site-container">
          
            <div class="banner-bg">
                <nav class="nav-primary">
                    <div class="wrap">
                    </div>
                </nav>
            </div>
            <div class="site-inner">
                <div class="content-sidebar-wrap"><main class="content"><article class="post-6911 page type-page status-publish has-post-thumbnail entry" itemscope itemtype="https://schema.org/CreativeWork">
                            

                            <div class="entry-content" itemprop="text">
                            
                                <input class="jpibfi" type="hidden"><div class="visible-xs" style="text-align: center">

                                    
                                </div>
                                
                                <p>
                                <div class="fmcalc-inner-container fmcalc-ic-c1">
                                    <div class="fmcalc-wrapper">
                                        <form name="calc" method="post" action="#">
                                            <table class="fmcalc" cellpadding='4' cellspacing='0'>
                                                <tbody>
                                                    <tr>
                                                        <td colspan='3'>
                                                            <br><h4 align=center>Ultimate Retirement Calculator</h4>
                                                            <div class="fmcalc-separator"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">
                                                            <b>Retirement Needs</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Combined</b>
                                                        </td>
                                                        <td align="center">
                                                            <b><strong>Explain</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Enter age at the end of current year:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="now_age_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 1)" />
                                                        </td>
                                                        <td valign="top" width="125" align="center" rowspan="7">
                                                            <div id="help_1" width="120" align="left">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Enter the age you plan to retire:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="retire_age_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 2)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Enter life expectancy:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="life_age_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 3)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Desired annual retirement income:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ann_ret_inc" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 4)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Every <input type="text" name="reduce_ret_inc_yrs" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(1, 5)" />
                                                            years of retirement, reduce our income need by (%):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="reduce_ret_inc_perc" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 6)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Desired estate ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="estate" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 7)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Estimated average annual inflation rate (%):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="inflate" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(1, 8)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">
                                                            <b>Retirement Funding</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Combined</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Explain</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Current total retirement savings ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="cur_savings_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(2, 9)" />
                                                        </td>
                                                        <td valign="top" width="125" align="center" rowspan="5">
                                                            <div id="help_2" width="120" align="left">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Current monthly savings contributions ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="cur_contrib_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(2, 10)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Age to stop contributions:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="stop_contrib_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(2, 11)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Expected average annual return on investment (%):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="rate" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(2, 12)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Estimated tax rate during retirement (%):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="tax_rate" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(2, 13)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">
                                                            <b>One-Time Benefits</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Combined</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Explain</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="one_time_amt_name_1" value="One-Time Benefit #1" size="25" onFocus="help(3, 14)"> ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_amt_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(3, 15)" />
                                                        </td>
                                                        <td valign="top" width="125" align="center" rowspan="8">
                                                            <div id="help_3" width="120" align="left">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Age to Apply One-Time Benefit #1 (#):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(3, 16)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="one_time_amt_name_2" value="One-Time Benefit #2" size="25" onFocus="help(3, 17)"> ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_amt_2" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(3, 18)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Age to Apply One-Time Benefit #2 (#):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_age_2" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(3, 19)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="one_time_amt_name_3" value="One-Time Benefit #3" size="25" onFocus="help(3, 20)"> ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_amt_3" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(3, 21)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Age to Apply One-Time Benefit #3 (#):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_age_3" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(3, 22)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="one_time_amt_name_4" value="One-Time Benefit #4" size="25" onFocus="help(3, 23)"> ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_amt_4" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(3, 24)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Age to Apply One-Time Benefit #4 (#):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="one_time_age_4" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(3, 25)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">
                                                            <b>Post-Retirement Income (Pension, SS, Wages, etc. Enter amount net of taxes)</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Combined</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Explain</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="ret_1_name" value="Monthly Retirement income #1" size="25" onFocus="help(4, 26)"> ($):<br />
                                                            Annual COL Adjustment <input type="text" name="ret_1_col" value="" size="3" onKeyUp="clear_results(this.form)" onFocus="help(4, 27)" />%
                                                            Starting <select name="ret_1_col_start" size="1" onChange="clear_results(this.form)" onFocus="help(4, 28)">
                                                                <option value="0">Now</option>
                                                                <option value="1">Retirement</option>
                                                            </select>
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ret_inc_1_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(4, 29)" />
                                                        </td>
                                                        <td valign="top" width="125" align="center" rowspan="6">
                                                            <div id="help_4" width="120" align="left">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Start & Stop Ages for Retirement Income #1 ($):
                                                        </td>
                                                        <td align="center" style="white-space: nowrap;">
                                                            <input type="text" name="ret_1_start_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(4, 30)" />
                                                            to
                                                            <input type="text" name="ret_1_stop_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(4, 31)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="ret_2_name" value="Monthly Retirement income #2" size="25" onFocus="help(4, 32)"> ($):<br />
                                                            Annual COL Adjustment <input type="text" name="ret_2_col" value="" size="3" onKeyUp="clear_results(this.form)" onFocus="help(4, 33)" />%
                                                            Starting <select name="ret_2_col_start" size="1" onChange="clear_results(this.form)" onFocus="help(4, 34)">
                                                                <option value="0">Now</option>
                                                                <option value="1">Retirement</option>
                                                            </select>
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ret_inc_2_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(4, 35)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Start & Stop Ages for Retirement Income #2 ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ret_2_start_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(4, 36)" />
                                                            to
                                                            <input type="text" name="ret_2_stop_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(4, 37)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="ret_3_name" value="Monthly Retirement income #3" size="25" onFocus="help(4, 38)"> ($):<br />
                                                            Annual COL Adjustment <input type="text" name="ret_3_col" value="" size="3" onKeyUp="clear_results(this.form)" onFocus="help(4, 39)" />%
                                                            Starting <select name="ret_3_col_start" size="1" onChange="clear_results(this.form)" onFocus="help(4, 40)">
                                                                <option value="0">Now</option>
                                                                <option value="1">Retirement</option>
                                                            </select>
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ret_inc_3_1" value="" size="10" onKeyUp="clear_results(this.form)" onFocus="help(4, 41)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Start & Stop Ages for Retirement Income #3 ($):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ret_3_start_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(4, 42)" />
                                                            to
                                                            <input type="text" name="ret_3_stop_age_1" value="" size="2" onKeyUp="clear_results(this.form)" onFocus="help(4, 43)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="center">
                                                            <input type="button" value="Calculate & Create Schedule" onClick="schedule(this.form)" />
                                                            <input type="button" value="Reset" onClick="reset_calc(this.form)" />
                                                            <input type="hidden" name="report_date" />
                                                            <div class="fmcalc-separator"></div>
                                                            <div class="clearfix"></div>
                                                            <!--<div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div>-->
                                                            <br />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" colspan="2">
                                                            <b>Results</b>
                                                        </td>
                                                        <td align="center">
                                                            <b>Explain</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Savings Needed at Retirement Age:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="accum_npv" size="10" onFocus="help(5, 44)" />
                                                        </td>
                                                        <td valign="top" width="125" align="center" rowspan="6">
                                                            <div id="help_5" width="120" align="left">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Savings at Retirement Based on Present Entries:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="ret_fund" size="10" onFocus="help(5, 45)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Savings Surplus (negative number indicates a ShortFall):
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="save_gap" size="10" onFocus="help(5, 46)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Additional Monthly Contribution Needed to Fully Fund Plan:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="add_contrib" size="10" onFocus="help(5, 47)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Present Monthly Contributions:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="now_contrib" size="10" onFocus="help(5, 48)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Total Monthly Contribution Needed to Fully Fund Plan:
                                                        </td>
                                                        <td align="center">
                                                            <input type="text" name="tot_contrib" size="10" onFocus="help(5, 49)" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" colspan="3">
                                                            <div id="sched_div">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="fmcalc_lshadow"></div><div class='fmcalc-rshadow'></div>
                                </div><br />

                                </p>


                            </div></article></main>
                    <div class="clearfix toldya" style="clear:both;"></div></div></div>
            <div class="clearfix"></div>

        </div>
        <div class="overlay" style="display: none"></div>


<?php include_once 'include/footer.php'; ?>
       
    </body>
</html>
