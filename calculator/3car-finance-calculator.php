
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Car Finance Calculator - Compare & Save</title>

<?php include_once 'include/header.php'; ?>
<script Language='JavaScript'>

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
<table class="fmcalc" cellpadding="1" cellspacing="0">
<tbody>
<tr>
<td colspan="5"> Enter the amount to finance($):</td>
<td align="center">
<input type="text" id="principal" name="principal" size="12" onkeyup="clear_results(this.form)">
</td>
</tr>
<tr>
<td>
<b>
# of months
</b> </td>
<td align="center">
<b>
<input type="text" id="term_1" name="term_1" size="4" onkeyup="clear_results(this.form)">
</b> </td>
<td align="center">
<b>
<input type="text" id="term_2" name="term_2" size="4" onkeyup="clear_results(this.form)">
</b> </td>
<td align="center">
<b>
<input type="text" id="term_3" name="term_3" size="4" onkeyup="clear_results(this.form)">
</b>
</td>
<td align="center">
<b>
<input type="text" id="term_4" name="term_4" size="4" onkeyup="clear_results(this.form)">
</b>
</td>
<td align="center">
<b>
<input type="text" id="term_5" name="term_5" size="4" onkeyup="clear_results(this.form)">
</b>
</td>
</tr>
<tr>
<td>
<b>
Interest Rate &gt;&gt;&gt;
</b>
</td>
<td align="center" style="white-space: nowrap;">
<b>
<input type="text" id="rate_1" name="rate_1" size="4" onkeyup="clear_results(this.form)">%
</b>
</td>
<td align="center" style="white-space: nowrap;">
<b>
<input type="text" id="rate_2" name="rate_2" size="4" onkeyup="clear_results(this.form)">%
</b>
</td>
<td align="center" style="white-space: nowrap;">
<b>
<input type="text" id="rate_3" name="rate_3" size="4" onkeyup="clear_results(this.form)">%
</b>
</td>
<td align="center" style="white-space: nowrap;">
<b>
<input type="text" id="rate_4" name="rate_4" size="4" onkeyup="clear_results(this.form)">%
</b>
</td>
<td align="center" style="white-space: nowrap;">
<b>
<input type="text" id="rate_5" name="rate_5" size="4" onkeyup="clear_results(this.form)">%
</b>
</td>
</tr>
<tr>
<td align="center" colspan="6">
<input type="button" value="Calculate" onclick="computeForm(this.form)">
<input type="reset" value="Reset">
<div class="fmcalc-separator"></div>
<div class="clearfix"></div><div class="email-my-results text-center hidden"><button class="button email-my-results-btn launch-popup">Email My Results<br><small>Click Here</small></button></div><br>
</td>
</tr>
<tr>
<td>
Monthly payment:
</td>
<td align="center">
<input type="text" id="moPmt_1" name="moPmt_1" size="6">
</td>
<td align="center">
<input type="text" id="moPmt_2" name="moPmt_2" size="6">
</td>
<td align="center">
<input type="text" id="moPmt_3" name="moPmt_3" size="6">
</td>
<td align="center">
<input type="text" id="moPmt_4" name="moPmt_4" size="6">
</td>
<td align="center">
<input type="text" id="moPmt_5" name="moPmt_5" size="6">
</td>
</tr>
<tr>
<td>
Total principal:
</td>
<td align="center">
<input type="text" id="totPrin_1" name="totPrin_1" size="6">
</td>
<td align="center">
<input type="text" id="totPrin_2" name="totPrin_2" size="6">
</td>
<td align="center">
<input type="text" id="totPrin_3" name="totPrin_3" size="6">
</td>
<td align="center">
<input type="text" id="totPrin_4" name="totPrin_4" size="6">
</td>
<td align="center">
<input type="text" id="totPrin_5" name="totPrin_5" size="6">
</td>
</tr>
<tr>
<td>
Total interest:
</td>
<td align="center">
<input type="text" id="totInt_1" name="totInt_1" size="6">
</td>
<td align="center">
<input type="text" id="totInt_2" name="totInt_2" size="6">
</td>
<td align="center">
<input type="text" id="totInt_3" name="totInt_3" size="6">
</td>
<td align="center">
<input type="text" id="totInt_4" name="totInt_4" size="6">
</td>
<td align="center">
<input type="text" id="totInt_5" name="totInt_5" size="6">
</td>
</tr>
<tr>
<td>
 Total payments:
</td>
<td align="center">
<input type="text" id="totPmts_1" name="totPmts_1" size="6">
</td>
<td align="center">
<input type="text" id="totPmts_2" name="totPmts_2" size="6">
</td>
<td align="center">
<input type="text" id="totPmts_3" name="totPmts_3" size="6">
</td>
<td align="center">
<input type="text" id="totPmts_4" name="totPmts_4" size="6">
</td>
<td align="center">
<input type="text" id="totPmts_5" name="totPmts_5" size="6">
</td>
</tr>
</tbody>
</table>
</form>
                        </div>
                    </div>
                </main>
<?php include_once 'include/footer.php'; ?>
