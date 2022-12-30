<?php
$post_title = "Reciepe Post";
$result = get_page_by_title($post_title,"OBJECT","receipe");
$post_id = $result->ID;
$product_name = get_post_meta($post_id,'product_name',false);
$quantity = get_post_meta($post_id,'quantity',false);
$unit = get_post_meta($post_id,'unit',false);
// print_r($quantity[0][0]);
// print_r($unit[0][0]);
// die;

?>
<form id="form_id">
    <div id="add_row" class="border">
        <div id="main_div">
            <label>Product Name :</label>
            <select class="product-select-2-ajax form-control" name="product_name[]">
            </select>
            <label>Quantity :</label>
            <input type="number" name="quantity[]" class="form-control" value="<?php echo $quantity[0][0]; ?>">
            <label>Unit :</label>
            <select class="unit-select-2-ajax form-control" name="unit[]">
            </select>
        </div>
        <input type="button" class="btn btn-primary" value="Add" onclick="add_row()">
    </div>
</form>
