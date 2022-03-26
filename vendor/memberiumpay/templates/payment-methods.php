<?php

?>
<fieldset class="{{data.className}} wpal-ecomm-accent_border_color">

    <# if( data.legend > '' ){ #>
    <legend>{{{data.legend}}}</legend>
    <# } #>
    <# _.each( data.merchants, function( config, merchant ) { #>
        <# var sandboxClass = ( parseInt(config.sandbox) > 0 ) ? ' payment-sandbox' : '',
            checked = ( config.checked > '' ) ? ' checked="checked"' : '';
        #>
        <label class="payment-method{{sandboxClass}}" data-method="{{merchant}}">
            <# if( _.size( data.merchants) > 1 ){ #>
                <input type="radio" name="payment_method" value="{{merchant}}"{{checked}}>
                <i><span class="screen-reader-text">{{merchant}}</span></i>
            <# } else{ #>
                <input type="hidden" name="payment_method" value="{{merchant}}"{{checked}}>
            <#  } #>
        </label>
    <# }) #>

</fieldset>
