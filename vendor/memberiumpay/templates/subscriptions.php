<?php

?>
<fieldset class="{{data.className}}">
    <legend>{{{data.legend}}}</legend>
    <div class="subscription-items">
        <ul>
        <# _.each( data.products, function( product ) { #>
            <li class="subscription-product" data-id="{{product.id}}">
                <# if( product.plans > '' ){ #>
                <div class="subscription-product-plans">
                    <# _.each( product.plans, function( plan ) { #>
                        <# checked = ( plan.checked > '' ) ? 'checked="checked"' : '';#>
                    <input id="plan_{{plan.id}}"
                        class="subscription-plan"
                        type="radio"
                        name="product_{{product.id}}"
                        value="{{plan.id}}" {{checked}}>
                    <label for="plan_{{plan.id}}">{{{plan.label}}}{{{plan.info}}}</label>
                    <# }) #>
                </div>
                <# } #>
            </li>
            <# }) #>
        </ul>
    </div>
</fieldset>
