'use strict';

var wpalEcommPayPal = function wpalEcommPayPal(config, thisEC) {

    // common Elements
    var $buttonWrap, $wrap, $validForm;

    // common vars
    var thisPP,
        ppStyle = {
            layout	: 'vertical',
            color	: 'gold',
            label	: 'checkout',
            shape	: 'rect',
            size	: 'responsive',
            tagline	: false
        },
        ppID = 'paypal-'+config.ecID,
        orderFormID = config.orderFormID,
        descriptor = config.descriptor,
        softDescriptor = config.softDescriptor,
        I18n = thisEC.getI18n(),
        orderData,
        cart = thisEC.getCart(),
        currency = config.currency.toUpperCase(),
        planIDs = false,
        paypalPayerID = ( config.hasOwnProperty('payer_id') ) ? config.payer_id : '',
        currentDebugID = '';

    return {
        init : function(){
            thisPP = this;
            thisPP.render();
        },
        render : function(){

            $buttonWrap = thisEC.getEl('$buttonWrap');
            $validForm = thisEC.getEl('$validForm');

            // Create Elements
            $wrap = wpalCreateEl('div',$buttonWrap, [
                { prop : 'id', value : ppID + '-wrap'},
                { prop : 'class', value : 'wpal-ec-field paypal-element' },
            ] );

            var $label = wpalCreateEl('label', $wrap, [
                { prop : 'for', value : ppID },
                { prop : 'class', value : 'screen-reader-text' },
            ] ).innerHTML = 'Paypal Checkout',
            $paypal = wpalCreateEl('div', $wrap, [
                { prop : 'id', value : ppID},
                { prop : 'class', value : 'wpal-ec-paypal wpal-ecomm-submit-button' },
            ] );
            thisPP.renderButtons();
        },
        renderButtons : function (){
            var args = thisPP.defaultArgs();
            // Subscriptions
            if( thisEC.isSubscription() ){
                planIDs = config.plan_ids;
                args.createSubscription = function(data, actions) {
                    var subscriptionDetails = thisPP.subscriptionDetails();
                    return actions.subscription.create(subscriptionDetails);
                };
            }
            // Orders
            else{
                args.createOrder = function(data, actions) {
                    var orderDetails = thisPP.orderDetails();
                    // Create Order
                    return actions.order.create(orderDetails);
                };
            }
            paypal.Buttons(args).render('#'+ppID);
        },
        defaultArgs : function(){
            return {
                style   : ppStyle,
                onInit  : function(data, actions) {
                    currentDebugID = data.correlationID;
                    // Disable the buttons
                    if( ! thisEC.isValidForm() ){
                        actions.disable();
                    }
                    $validForm.addEventListener('change', function() {
                        var valid = parseInt($validForm.value) === 1;
                        if ( valid ) {
                            actions.enable();
                        }
                        else {
                            actions.disable();
                        }
                    });
                },
                onClick : function(data, actions) {
                    // Disable and scroll to error
                    if( ! thisEC.isValidForm(true) ){
                        return;
                    }
                },
                onApprove: function(data, actions) {

                    wpalEcommLoadingScreen(thisEC.getTmpls(), I18n.loading.approve_paypal_order);

                    var paypalOrderId = data.orderID;

                    // Subscription Order
                    if( thisEC.isSubscription() ){
                        data.debug_id = currentDebugID;
                        wpalEcommWriteToLog('subscription', 'paypal', data);
                        var processData = {
                            paypal_order_id        : paypalOrderId,
                            paypal_subscription_id : data.subscriptionID
                        };
                        return thisPP.processSubscription( processData );
                    }
                    // Regular Order
                    else{
                        return actions.order.capture().then(function(details) {
                            details.debug_id = currentDebugID;
                            wpalEcommWriteToLog('capture', 'paypal', details);
                            return thisPP.processOrder( paypalOrderId, details );
                        });
                    }
                },
                onError: function (err) {
                    var data = {
                        debug_id : currentDebugID
                    };
                    if( err > '' ){
                        var varType = ( typeof err );
                        // Object
                        if( varType === 'object' ){
                            data = wpalEcommExtend( data, err );
                        }
                        else if( varType === 'string' || varType === 'number' ){
                            data.error = err;
                        }
                    }
                    wpalEcommWriteToLog('error', 'paypal', data);
                }
            };
        },
        subscriptionDetails : function(){
            var details = {
                plan_id     : thisPP.selectedPlanID(),
                quantity    : '1',
                subscriber  : thisPP.payerData(true),
                custom_id   : 'WPUID-' + wpalUserID,
                //application_context : https://developer.paypal.com/docs/api/subscriptions/v1/#definition-application_context
                application_context : {
                    //user_action : 'CONTINUE', // default SUBSCRIBE_NOW
                    shipping_preference : 'NO_SHIPPING' // GET_FROM_FILE || SET_PROVIDED_ADDRESS
                }
            };
            return details;
        },
        selectedPlanID : function(){
              var wpPlanID = thisEC.getSelectedPlanID();
              if( planIDs && planIDs.hasOwnProperty(wpPlanID) ){
                  return planIDs[wpPlanID];
              }
              else{
                  return '';
              }
        },
        orderDetails : function (){

            var custom_id = 'WPUID-' + wpalUserID,
                cartDetails = thisPP.cartData(),
                orderDetails = {
                    intent: 'CAPTURE',
                },
                description = cartDetails.items[0].name;
            if( description.length > 127 ){
                description.substring(0, 127);
            }

            // Order Details
            orderDetails.purchase_units = [{
                reference_id       :    orderFormID,
                description        :    description,
                soft_descriptor    :    descriptor,
                custom_id          :    custom_id,
                items              :    cartDetails.items,
                amount             :    {
                    value			:   cartDetails.total,
                    currency_code	:   currency,
                    breakdown		:    {
                        item_total	:    {
                            value          : cartDetails.total,
                            currency_code  : currency
                        }
                    }
                }
            }];

            // Payer Data
            orderDetails.payer = thisPP.payerData(false);
            return orderDetails;
        },
        cartData : function (){

            var details = {
                    items   : [],
                    total   : parseFloat(cart.total).toFixed(2)
                };
            for ( var i in cart.items ) {
                var item = cart.items[i];
                details.items.push({
                    name		: item.name,
                    quantity	: item.qty,
                    sku			: "WPID-"+item.id,
                    unit_amount	: {
                        value			: wpalEcommItemPrice(item),
                        currency_code	: currency
                    },
                });
            }
            return details;
        },
        payerData : function ( is_subscription ){
            var formData = wpalEcommFieldsData(thisEC.getFields()),
            payer = {
                name : {
                    given_name	:	formData.contact.billing_first_name,
                    surname		:	formData.contact.billing_last_name
                },
                email_address   :   formData.contact.billing_email,
                address         : {
                    address_line_1  :	formData.billing.billing_address_1,
                    address_line_2  :	formData.billing.billing_address_2,
                    admin_area_1	:	formData.billing.billing_state,
                    admin_area_2	:	formData.billing.billing_city,
                    postal_code		:	formData.billing.billing_postcode,
                    country_code	:	formData.billing.billing_country,
                }
            };
            if( formData.contact.billing_phone > '' ){
                payer.phone = {
                    phone_type : 'MOBILE',
                    phone_number : {
                        national_number: formData.contact.billing_phone
                    }
                };
            }

            if( paypalPayerID > '' ){
                payer.payer_id = paypalPayerID;
            }

            return payer;
        },
        processSubscription : function( args ){

            setTimeout(function () {
                wpalEcommLoadingScreen(thisEC.getTmpls(), I18n.loading.finalize_order);
                orderData = wpalEcommExtend( thisEC.orderPostData(), args );
                orderData.debug_id = currentDebugID;
                thisEC.createOrder(orderData, thisPP.createOrderResponse);
            }, 500);
        },
        processOrder : function( paypalOrderId, details ){
            setTimeout(function () {
                wpalEcommLoadingScreen(thisEC.getTmpls(), I18n.loading.finalize_order);
                orderData = thisEC.orderPostData();
                orderData.paypal_order_id = paypalOrderId;
                orderData.paypal_transaction_id = wpalPaypalTransactionID(details);
                orderData.debug_id = currentDebugID;
                orderData = wpalPaypalPayerID(orderData, details);
                thisEC.createOrder(orderData, thisPP.createOrderResponse);
            }, 500);
        },
        createOrderResponse : function(response, callback){

            var data = response.data,
                message = (data.message) ? data.message : '';

            // Set OrderID main app
            thisEC.setOrderID( (data.order_id) ? data.order_id : '' );
            // Set Global User ID
            wpalUserID = (data.user_id) ? data.user_id : 0;

            // Update App vars
            if( response.success ){
                thisEC.finalizeOrder(data);
            }
            else{
                if( ! message > '' ){
                    message = I18n.errors.order_creation;
                }
                wpalEcommRenderModal({
                    id      : 'wpal-ecomm-order-error',
                    title   : I18n.titles.order_error,
                    content : message
                }, thisEC.getTmpls() );
                wpalEcommRemoveLoadingScreen();
            }
        },
        subscriptionResponse : function( data ){

        }
    };
};

// Paypal : Get Transaction ID From Details
var wpalPaypalTransactionID = function(details){
    var transactionID = '';
    if( details.purchase_units[0] ){
        if( details.purchase_units[0].payments ){
            if( details.purchase_units[0].payments.captures ){
                if( details.purchase_units[0].payments.captures[0] ){
                    transactionID = details.purchase_units[0].payments.captures[0].id;
                }
            }
        }
    }
    return transactionID;
};

// Paypal : Get Payer ID From Details
var wpalPaypalPayerID = function( data, details){
    var payer_id = '';
    if( details.payer ){
        if( details.payer.payer_id ){
            data.paypal_payer_id = details.payer.payer_id;
        }
    }
    return data;
};