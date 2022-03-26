<?php

?>
<# var cart = data.cart,
    currency = cart.currency,
    symbol = cart.symbol,
    items = cart.items,
    totals = cart.priceDisplays;
#>
<fieldset class="{{data.className}}">

    <# if( data.legend > '' ){ #>
    <legend>{{{data.legend}}}</legend>
    <# } #>

    <# if( items ){ #>
    <div class="cart-items">
        <ul>
        <# _.each( data.cart.items, function( item ) { #>
            <li class="cart-item wpal-ecomm-main_color" data-id="{{item.id}}">
                <# if( item.image > '' ){ #>
                <figure class="cart-item-image">
                    <img src="{{{item.image}}}">
                </figure>
                <# } #>
                <div class="cart-item-title">
                    <span>{{{item.name}}}</span>
                </div>
                <# if( item.priceDisplays > '' ){ #>
                <# price_count = _.size( item.priceDisplays ) #>
                <# if( price_count > 1){ #>
                    <div class="cart-item-price-container">
                <# } #>
                <# _.each( item.priceDisplays, function( price ) { #>
                    <div class="cart-item-{{price.type}}">
                        <span class="price-wrap">
                            <i>{{symbol}}</i>
                            <span class="price">{{price.amount}}</span>
                            <span class="currency">({{currency}})</span>
                            <# if( price.details > '' ){ #>
                            <span class="billed-text">{{price.details.billed_text}}</span>
                            <# } #>
                        </span>
                    </div>
                <# }) #>
                <# if( price_count > 1){ #>
                    </div>
                <# } #>
                <# } #>
            </li>
        <# }) #>
        </ul>
    </div>
    <# } #>

    <# if( totals > '' ){ #>
    <div class="cart-totals">
        <ul>
        <# _.each( totals, function( price ) { #>
            <li class="total {{price.type}}">
                <div>
                    <span class="price-label">{{{price.label}}}</span>
                    <# if(price.hasOwnProperty('amount')){ #>
                    <span class="price-wrap">
                        <i>{{symbol}}</i>
                        <span class="price">{{price.amount}}</span>
                        <span class="currency">({{currency}})</span>
                    </span>
                    <# } #>
                </div>
            </li>
        <# }) #>
        </ul>
    </div>
    <# } #>

</fieldset>
