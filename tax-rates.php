<?php
require_once('header.php');
// $about_data = array();
$taxRate = $curl->send_api(array(), 'TaxRate/getTaxrate');
$taxRate_data = array();
if ($taxRate->code == 200) {
    foreach ($taxRate->TaxRate as $t_rate) {
        $taxRate_data[$t_rate->year][$t_rate->tax_rates_category_id]['cat_array'][] = $t_rate;
        $taxRate_data[$t_rate->year][$t_rate->tax_rates_category_id]['cat_name'] = $t_rate->tax_rates_category->name;
    }
}
?>
    <div class="clearfix mb4 mt3">
        <div class="container">
            <div class="mb2">
                <div class="table-responsive">
                    <?php
                    foreach ($taxRate_data as $rate_key => $tax_rate_data_row) {
                        if (count($tax_rate_data_row) > 0) {
                            foreach ($tax_rate_data_row as $data_row_value) {
                                ?>
                                <table class="font-regular table table-bordered table-striped"
                                       style="max-width: 700px;margin: auto;">
                                    <thead>
                                    <tr>
                                        <th class="font-medium text-center font-18" colspan="2">
                                            <?= $rate_key ?> Tax Rates - <?= $data_row_value['cat_name'] ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-left">INCOME</th>
                                        <th class="text-left">TAX</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(count($data_row_value['cat_array'])>0){
                                        foreach ($data_row_value['cat_array'] as $r_value) {
                                            ?>
                                            <tr>
                                                <td><?= $r_value->income ?></td>
                                                <td><?= $r_value->tax ?>%</td>
                                            </tr>
                                        <?php }  }else{?>
                                        <tr colspan="2">
                                            <td>Record not found</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php }
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>