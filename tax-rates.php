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
      $coverImageUrl =  "img/text-center-banner.png";   
    
?>
<style>table.table {
    max-width: 700px;margin: auto;
    }</style>
           

<div class="sub-page-banner">
    <div class="banner-img">
        <img src="<?php echo $coverImageUrl; ?>" class="img-responsive" style="max-height: 250px;background-size: cover; " />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tax Rates</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix mb4 mt3">
        <div class="container">
            <?php 
                    foreach($taxRate_data as $rate_key =>$tax_rate_data_row){
                        if(count($tax_rate_data_row) > 0)
                        {
                            foreach ($tax_rate_data_row as $data_row_value) {
                    ?>  
            <div class="mb2">
                <center>   <h4 class="font-medium mb2"><?php echo $rate_key;?> Tax Rates - <?php echo $data_row_value['cat_name'];?></h4></center>
                <div class="table-responsive">
                    <table class="font-regular table table-bordered table-striped" style="max-width: 500px;margin: auto;">
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
</div>
            

<div class="mt4"></div>

<?php require_once('footer.php'); ?> 