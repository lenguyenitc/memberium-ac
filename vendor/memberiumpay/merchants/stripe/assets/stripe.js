'use strict';

var wpalEcommStripe = function wpalEcommStripe(config, thisEC) {

    // common Elements
    var $wrap, $submit, $confirm, $card, $paymentMethodSelect;

    // common vars
    var thisStripe,
        app,
        stripeElements,
        stripeStyle = {
            /*
            base: {
                color: '#32325d',
    		    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    		    fontSmoothing: 'antialiased',
    		    fontSize: '16px',
    		    '::placeholder': {
                    color: '#aab7c4'
    		    }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
            */
        },
        cardID = 'stripe-card-'+config.ecID,
        orderFormID = config.orderFormID,
        I18n = thisEC.getI18n(),
        paymentMethodConfig = config.payment_method,
        paymentMethod = ( paymentMethodConfig.id ),
        intentID = config.intent_id,
        clientSecret = config.client_secret,
        orderData,
        customerID = ( config.customer_id > '' ) ? config.customer_id : '',
        subscriptionID;

    return {
        init : function (){

            thisStripe = this;
            app = Stripe(config.public_key);
            stripeElements = app.elements();
            thisStripe.render();
            // Saved Payment Method Select
            if( paymentMethod > '' ){
                thisStripe.renderSavedPaymentMethod();
            }
            thisStripe.initActions();
        },
        render : function (){

            // TODO - determine if element exists( custom templates or if we are creating )
            $wrap = wpalCreateEl('div', thisEC.getEl('$methodsWrap'), [
                { prop : 'id', value : cardID + '-wrap'},
                { prop : 'class', value : 'wpal-ecomm-field stripe-element' },
            ] );

            wpalCreateEl('label', $wrap, [
                { prop : 'for', value : cardID },
                { prop : 'class', value : 'screen-reader-text' },
            ] ).innerHTML = 'Credit card';

            wpalCreateEl('div', $wrap, [
                { prop : 'id', value : cardID },
            ] );

            // Submit Button
            $submit = wpalCreateEl('button', thisEC.getEl('$buttonWrap'), [
                { prop : 'class', value : 'stripe-submit stripe-element wpal-ecomm-submit-button' },
                { prop : 'type', value : 'submit' },
                { prop : 'value', value : 'Submit' },
            ] );
            $submit.innerHTML = I18n.titles.checkout_btn;

        },
        renderSavedPaymentMethod : function (){

            $paymentMethodSelect = wpalCreateEl('select', $wrap,[
                { prop : 'class', value : 'payment-methods-select' }
            ]);
            var $opt = wpalCreateEl('option', $paymentMethodSelect, [
                { prop : 'value', value : paymentMethodConfig.id },
                { prop : 'selected', value : 'selected' }
            ]);
            $opt.innerHTML = wpalEcommSprintF(I18n.sprintf.payment_method,[
                paymentMethodConfig.brand,
                paymentMethodConfig.last4
            ]);
            var $newOpt = wpalCreateEl('option', $paymentMethodSelect, [
                { prop : 'value', value : 'new' },
            ]);
            $newOpt.innerHTML = I18n.titles.new_card;

        },
        initActions : function (){

            $card = stripeElements.create('card', {
                style			: stripeStyle,
                hidePostalCode 	: true
            });
            $card.mount('#'+cardID);

            // On Card Change Listen for Errors
            $card.addEventListener('change', wpalDebounce(function(e) {

                if(e.error){
                    wpalEcommRenderError( $wrap, e.error.message );
                }
                else {
                    wpalEcommRemoveError( $wrap );
                }
            }, 250 ) );

            // On Card Element Submit
            $submit.onclick = function (e){

                e.preventDefault();

                if( ! thisEC.isValidForm(true) ){
                    return false;
                }
                else{
                    // Disable Button
                    $submit.disabled = true;
                    wpalEcommLoadingScreen(thisEC.getTmpls(), I18n.loading.process_payment);
                    thisStripe.onSubmit();
                }
                return false;
            };
            if( paymentMethod > '' ){
                $wrap.setAttribute('data-card', 'default');
                $paymentMethodSelect.onchange = function(){
                    var selectedVal = $paymentMethodSelect.value,
                        attr = ( selectedVal === 'new' ) ? 'new' : 'existing';
                    if( paymentMethod === selectedVal ){
                        attr = 'default';
                        $card.clear();
                    }
                    $wrap.setAttribute('data-card', attr);
                };
            }

        },
        initConfirm : function (){

            $confirm.onclick = function (e){
                e.preventDefault();
                // Disable Button
                $confirm.disabled = true;
                wpalEcommLoadingScreen(thisEC.getTmpls(), I18n.loading.process_payment);
                thisStripe.onConfirm();
                return false;
            };

        },
        billingDetails : function (){

            // Build Contact Object
			var formData = wpalEcommFieldsData(thisEC.getFields()),
                billing = {
                    //todo review specify cardholder name | give option?
                    name	:	formData.contact.billing_full_name,
                    email	:	formData.contact.billing_email,
                    address :	{
                        city            :	formData.billing.billing_city,
                        country         :	formData.billing.billing_country,
                        state           :   formData.billing.billing_state,
                        line1           :	formData.billing.billing_address_1,
                        line2           :	formData.billing.billing_address_2,
                        postal_code     :	formData.billing.billing_postcode,
                    }
                };
            if( formData.contact.billing_phone > '' ){
                billing.phone = formData.contact.billing_phone;
            }
            return billing;
        },
        paymentDetails : function ( data ){
            return wpalEcommSprintF(I18n.sprintf.payment_method,[
                data.brand.toUpperCase(),
                data.last4
            ]);
        },
        onSubmit : function (){

            orderData = thisEC.orderPostData();
            orderData.update_intent = 0;

            var paymentMethodID = ( paymentMethod > '' ) ? paymentMethod : false,
                createPaymentMethod = false;
            if( $paymentMethodSelect ){
                paymentMethodID = $paymentMethodSelect.value;
            }
            if( ! paymentMethodID || paymentMethodID === 'new' ){
                createPaymentMethod = true;
                orderData.attach_payment_method = 1;
            }
            else if( paymentMethodID === paymentMethodConfig.id ){
                orderData.payment_details = thisStripe.paymentDetails(paymentMethodConfig);
            }
            orderData.stripe_customer = customerID;
            orderData.payment_method_id = (paymentMethodID) ? paymentMethodID : '';
            orderData.payment_intent_id = intentID;
            if( subscriptionID ){
                orderData.subscription_id = subscriptionID;
            }

            // Create Payment Method
            if( createPaymentMethod ){
                thisStripe.createPaymentMethod( function(paymentMethod){
                    orderData.payment_method_id = paymentMethod.id;
                    orderData.payment_details = thisStripe.paymentDetails(paymentMethod.card);
                    orderData.update_intent = 1;
                    thisEC.createOrder(orderData, thisStripe.createOrderResponse );
                });
            }
            else{
                if( paymentMethodID != paymentMethod ){
                    orderData.update_intent = 1;
                }

                thisEC.createOrder(orderData, thisStripe.createOrderResponse );
            }

        },
        createPaymentMethod : function ( callback ){
            app.createPaymentMethod({
                type            : 'card',
                card            : $card,
                billing_details : thisStripe.billingDetails(),
                metadata        : { order_form_id : orderFormID }
            }).then( function(result) {
                if (result.error) {
                    thisStripe.showError(result.error.message);
                }
                else{
                    wpalEcommRemoveError($wrap);
                    callback(result.paymentMethod);
                }
            });
        },
        createOrderResponse : function ( response ){

            var data = ( response ) ? response.data : {},
                message = (data.message) ? data.message : '';

            // Set OrderID main app
            thisEC.setOrderID( (data.order_id) ? data.order_id : '' );
            // Set Global User ID
            wpalUserID = (data.user_id) ? data.user_id : 0;

            // Update App vars
            customerID = ( data.customer_id ) ? data.customer_id : '';

            if( response.success ){

                if( thisEC.isSubscription() ){
                    thisStripe.subscriptionResponse(data);
                }
                else{
                    thisStripe.confirmCardPayment( clientSecret, function(confirmResponse){
                        if(confirmResponse){
                            thisEC.finalizeOrder(data);
                        }
                    });
                }

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
                $submit.disabled = false;
            }

        },
        confirmCardPayment : function (secret, callback){

            app.confirmCardPayment(secret).then(function (result) {
                var returnResult = result;
                if (result.error) {
                    thisStripe.showError(result.error.message);
                    returnResult = false;
                }
                callback(returnResult);
            });

        },
        subscriptionResponse : function (data){

            var subscription = ( data.subscription ) ? data.subscription : false;
            if( ! subscription ){
                var error = ( data.card_error ) ? data.card_error : I18n.errors.generic_order;
                thisStripe.showError(error);
                return false;
            }
            var status = ( subscription.status ) ? subscription.status : false,
                latestInvoice = (subscription.latest_invoice) ? subscription.latest_invoice : {},
                paymentIntent = (latestInvoice.payment_intent) ? latestInvoice.payment_intent : false,
                intentStatus = (paymentIntent && paymentIntent.status) ? paymentIntent.status : false;

            subscriptionID = ( subscription.id ) ? subscription.id : false;

            // Active Subscription
            if( status === 'active' ){
                if (paymentIntent) {
                    if (intentStatus === 'requires_action') {
                        thisStripe.confirmCardPayment( clientSecret, function(confirmResponse){
                            if(confirmResponse){
                                thisEC.finalizeOrder(data);
                            }
                        });
                    }
                    else{
                        thisEC.finalizeOrder(data);
                    }
                }
                else{
                    thisEC.finalizeOrder(data);
                }
            }
            // Trial Subscription
            else if( status === 'trialing' ){
                var pending_setup_intent = (subscription.pending_setup_intent) ? subscription.pending_setup_intent : false;
                if(pending_setup_intent){
                    // Confirm Card is ready for future payments
                    var set_up_status = pending_setup_intent.status,
                        set_up_client_secret = pending_setup_intent.client_secret;
                    if (set_up_status === "requires_action") {
                        app.confirmCardSetup(set_up_client_secret).then(function(result) {
                            if (result.error) {
                                thisStripe.showError(result.error.message);
                            }
                            else {
                                thisEC.finalizeOrder(data);
                            }
                        });
                    }
                }
                else{
                    thisEC.finalizeOrder(data);
                }
            }

            // Incomplete
            else if( status === 'incomplete' ){

                var lastPaymentError;
                // Payment Method Failed
                // @link https://stripe.com/docs/billing/subscriptions/payment#handling-failure
                if (intentStatus === 'requires_payment_method') {
                    lastPaymentError = paymentIntent.last_payment_error;
                    var errorMessage = lastPaymentError.message;
                    errorMessage += ' ' + I18n.errors.try_new_card;
                    thisStripe.showError(errorMessage);
                }
                // Further Action Required
                // @link https://stripe.com/docs/billing/subscriptions/payment#handling-action-required
                else if(intentStatus === 'requires_action'){
                    thisStripe.confirmCardPayment( paymentIntent.client_secret, function(confirmResponse){
                        if(confirmResponse){
                            thisEC.finalizeOrder(data);
                        }
                    });
                }
                //Unknown
                else {
                    wpalEcommRenderModal({
                        id      : 'wpal-ecomm-login-form',
                        title   : I18n.titles.payment_error,
                        content : I18n.error.unknown_error
                    }, thisEC.getTmpls() );
                    $submit.disabled = false;
                    wpalEcommWriteToLog('error', 'Stripe', {
                        subscription_id:subscriptionID,
                        subscription:subscription,
                        latestInvoice:latestInvoice,
                        paymentIntent:paymentIntent
                    });
                }
            }
        },
        updateSession : function (data, callback){

            var postData = thisEC.orderPostData();
            postData.action = 'wpal_ecomm_update_merchant_session';
            postData.payment_method_id = stripe.payment_method;
            postData.payment_intent_id = stripe.intent_id;
            postData.stripe_customer = ( stripe.customer_id ) ? stripe.customer_id : '';
            postData = wpalEcommExtend(true, postData, data);

            wpalEcommPost(postData, callback);
        },
        showError : function ( error ){
            wpalEcommRenderError( $wrap, error );
            $wrap.scrollIntoView({behavior: 'smooth'});
            wpalEcommRemoveLoadingScreen();
            $submit.disabled = false;
            wpalEcommWriteToLog('error', 'Stripe', error);
        }
    }
};