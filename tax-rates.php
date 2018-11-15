<?php 
    require_once('header.php'); 
    // $about_data = array();
    $taxRate = $curl->send_api(array(), 'TaxRate/getTaxrate');
    $taxRate_data = array();
    if($taxRate->code == 200){
        foreach ($taxRate->TaxRate as $t_rate) {
           $taxRate_data[$t_rate->year][$t_rate->tax_rates_category_id]['cat_array'][] =$t_rate;
           $taxRate_data[$t_rate->year][$t_rate->tax_rates_category_id]['cat_name'] =$t_rate->tax_rates_category->name;
        }
    }
?>
<style>table.table {
    max-width: 700px;margin: auto;
    }</style>
            <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(http://18.221.49.101/cpacake/geturl/uploads/feature_photo/1537364753_613913.jpg) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
                <div class="content_wrap">
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="#!">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <a class="breadcrumbs_item home" href="taxcenter.php">Tax Center</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <span class="breadcrumbs_item current">Tax Rates</span>
                    </div>
                    <h1 class="page_title">Tax Rates</h1>
                </div>
            </div>
            <div class="container padding_top_mini">
                <?php 
                    foreach($taxRate_data as $rate_key =>$tax_rate_data_row){
                        if(count($tax_rate_data_row) > 0)
                        {
                            foreach ($tax_rate_data_row as $data_row_value) {
                    ?>            
                    <div class="margin_bottom_big">
                        <h5 class="text-center"><?php echo $rate_key;?> Tax Rates - <?php echo $data_row_value['cat_name'];?></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
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
                                        <td><?php  echo $r_value->income;?></td>
                                        <td><?php  echo $r_value->tax;?>%</td>
                                    </tr>
                                    <?php }  }else{?>
                                    <tr colspan="2">
                                        <td>Record not found</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } } }?>
            </div>
<?php require_once('footer.php'); ?> 