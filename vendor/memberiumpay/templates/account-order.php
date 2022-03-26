<# var titles = data.I18n.titles; #>
<fieldset class="wpal-ecomm-account-order">

    <legend>{{{data.name}}}</legend>

    <div class="wpal-ecomm-order-header">
        <fieldset class="wpal-ecomm-left">
            <legend>{{titles.order_details}}</legend>
            <div class="wpal-ecomm-status">
                <span class="wpal-ecomm-label">
                    {{{titles.order_status}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{data.status}}}
                </span>
            </div>

            <div class="wpal-ecomm-dates">
                <span class="wpal-ecomm-label">
                    {{{titles.order_created}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{data.order_created}}}
                </span>
            </div>

            <div class="wpal-ecomm-payment-method">
                <span class="wpal-ecomm-label">
                    {{{titles.payment_method}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{data.payment_details}}}
                </span>
            </div>
        </fieldset>
        <fieldset class="wpal-ecomm-right">
            <legend>{{titles.billing_address}}</legend>
            <div class="wpal-ecomm-order-billing-details">
                {{{data.billingDetails}}}
            </div>
        </fieldset>
    </div>


    <fieldset class="wpal-ecomm-order-items">
        <legend>{{titles.order_items}}</legend>
        {{{data.item_table}}}
    </fieldset>

    <# if( data.orderTotals > '' ){ #>
    <fieldset class="order-totals">
        <legend>{{titles.order_totals}}</legend>
        {{{data.orderTotals}}}
    </fieldset>
    <# } #>

</fieldset>
