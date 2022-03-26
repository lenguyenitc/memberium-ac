<?php

?>
<# var titles = data.I18n.titles;
    paymentMethod = data.paymentMethod,
    card = paymentMethod.card,
    default_card = ( paymentMethod.id ) ? 'default' : 'new';
 #>
<div id="{{data.id}}-wrap"
    class="wpal-ecomm-field stripe-element {{data.className}}"
    data-card="{{data.default_card}}">

    <label for="{{data.id}}">
        {{{titles.credit_card}}}
    </label>

    <?php ?>
    <div id="{{data.id}}"></div>

    <?php ?>
    <# if( paymentMethod > '' ) { #>
    <select class="payment-methods-select">
        <option value="{{paymentMethod.payment_method_id}}" selected="selected">
            {{card.brand}} **** {{card.last4}}
        </option>
        <option value="new">{{{titles.new_card}}}</option>
    </select>
    <# } #>
</div>
