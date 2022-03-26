<?php

?>
<fieldset class="{{data.className}}">
    <legend>{{{data.legend}}}</legend>
    <div class="product-details">
        <ul>
        <# _.each( data.products, function( product ) { #>
            <li class="product" data-id="{{product.id}}">
                <# if( product.image > '' ){ #>
                <figure class="product-image">
                    <img src="{{product.image}}">
                </figure>
                <# } #>
                <div class="product-title">
                    <span>{{{product.name}}}</span>
                </div>
                <# if( product.content > '' ){ #>
                <div class="product-description">
                    <div>{{{product.content}}}</div>
                </div>
                <# } #>
            </li>
            <# }) #>
        </ul>
    </div>
</fieldset>
