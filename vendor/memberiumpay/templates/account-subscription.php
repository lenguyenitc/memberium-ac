<# //console.log({ tmpl : 'account_subscription', data : data }); #>
<# var titles = data.I18n.titles,
    na = data.I18n.errors.not_applicable,
    nextBillDate = ( data.next_bill_date && data.next_bill_date != na ) ? data.next_bill_date : false,
    canceledDate = ( data.canceled_date && data.canceled_date > '' ) ? data.canceled_date : false,
    canceledEndDate = ( data.canceled_date && data.canceled_date > ''  ) ? data.canceled_date : false,
    showAction = ( data.status === 'trial' || data.status === 'active' ),
    allowCancel = ( data.allow_cancel && parseInt(data.allow_cancel) > 0 );
    canceledEndDate = ( data.cancel_on_date && data.cancel_on_date > '' ) ? data.cancel_on_date : data.current_end_date;
#>
<fieldset class="wpal-ecomm-account-subscription">

    <legend>{{{data.name}}}</legend>

    <div class="wpal-ecomm-order-header">
        <fieldset class="wpal-ecomm-left">
            <legend>{{titles.subscription_details}}</legend>
            <div class="wpal-ecomm-status">
                <span class="wpal-ecomm-label">
                    {{{titles.subscription_status}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{data.status}}}
                </span>
            </div>

            <# if( canceledDate ) { #>
            <div class="wpal-ecomm-dates">
                <span class="wpal-ecomm-label">
                    {{{titles.canceled_date}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{canceledDate}}}
                </span>
            </div>
            <div class="wpal-ecomm-dates">
                <span class="wpal-ecomm-label">
                    {{{titles.end_date}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{canceledEndDate}}}
                </span>
            </div>
            <# } #>

            <# if( nextBillDate  ) { #>
            <div class="wpal-ecomm-dates">
                <span class="wpal-ecomm-label">
                    {{{titles.next_bill_date}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{{nextBillDate}}}
                </span>
            </div>

            <div class="wpal-ecomm-amount">
                <span class="wpal-ecomm-label">
                    {{{titles.next_bill_amount}}}
                </span>
                <span class="wpal-ecomm-value">
                    {{data.currency_symbol}}{{data['next/due/amount']}}
                    <span>({{data.currency.toUpperCase()}})</span>
                </span>
            </div>
            <# } #>

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

            <# if( showAction && ! canceledDate && allowCancel ) { #>
            <div class="wpal-ecomm-subscription-actions">
                <span class="wpal-ecomm-label">
                    {{{titles.subscription_actions}}}
                </span>
                <button class="cancel-subscription" data-subscription-id={{data.ID}}>
                    {{{titles.cancel_button}}}
                </button>
            </div>
            <# } #>

        </fieldset>
        <fieldset class="wpal-ecomm-right">
            <legend>{{titles.billing_address}}</legend>
            <div class="wpal-ecomm-order-billing-details">
                {{{data.billingDetails}}}
            </div>
        </fieldset>
    </div>

    <fieldset class="wpal-ecomm-order-items">
        <legend>{{titles.subscription_items}}</legend>
        {{{data.item_table}}}
    </fieldset>

    <# if( data.orderTotals > '' ){ #>
    <fieldset class="order-totals">
        <legend>{{titles.subscription_totals}}</legend>
        {{{data.orderTotals}}}
    </fieldset>
    <# } #>

</fieldset>
