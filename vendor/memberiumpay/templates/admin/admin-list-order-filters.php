<select class="wpal-ecomm-order-filter" name="order-status">
    <?php
    foreach ($statuses as $opt ) {
        $selected = selected( $opt['id'], $status, false );
        echo "<option value=\"{$opt['id']}\" {$selected}>{$opt['text']}</option>";
    }
?>
</select>
<input class="wpal-ecomm-order-filter" type="text" name="order-date-from" placeholder="<?php _e('Date From', 'wpal_ecomm');?>" value="<?php echo $from; ?>" autocomplete="off" />
<input class="wpal-ecomm-order-filter" type="text" name="order-date-to" placeholder="<?php _e('Date To', 'wpal_ecomm');?>" value="<?php echo $to; ?>" autocomplete="off"/>
<div class="wpal-ecomm-order-filter-wpalSelect2-wrapper">
    <select class="wpal-ecomm-order-filter" multiple name="order-products[]">
<?php
    foreach ($product_data as $product) {
        if( !empty($product['children']) ){
            echo "<optgroup label=\"{$product['text']}\">";
            foreach ($product['children'] as $plan) {
                $selected = in_array($plan['id'], $products) ? ' selected="selected"' : '';
                echo "<option value=\"{$plan['id']}\"{$selected}>{$plan['text']}</option>";
            }
            echo "</optgroup>";
        }
        else{
            $selected = in_array($product['id'], $products) ? ' selected="selected"' : '';
            echo "<option value=\"{$product['id']}\"{$selected}>{$product['text']}</option>";
        }
    }
?>
    </select>
</div>

<script>
    jQuery( function($) {
        // Date FIlter
        var $from = $('input[name="order-date-from"]'),
            $to = $('input[name="order-date-to"]'),
            args = {dateFormat : "yy-mm-dd"};
        $from.datepicker(args).on('change', function(){
            $to.datepicker('option','minDate', $from.val());
        });
        $to.datepicker(args).on('change', function(){
            $from.datepicker('option','maxDate', $to.val());
        });
        //Select Woo
        var $products = $('select[name="order-products[]"]');
        $products.wpalSelect2({
            placeholder: '<?php _e('Select Products', 'wpal_ecomm'); ?>'
        });
    });
</script>
