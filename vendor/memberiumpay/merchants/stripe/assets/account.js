'use strict';

var wpalEcommStripeAccount = function wpalEcommStripeAccount(paymentInfo, thisMA) {

    // common Elements
    var $infoWrap, $wrap, $submit, $confirm, $card, $paymentMethodSelect;

    // common vars
    var thisSA,
        app,
        merchant = 'stripe',
        tmpls,
        stripeElements,
        stripeStyle = {},
        I18n = thisMA.getI18n(),
        profileID = paymentInfo.profile_id,
        config = paymentInfo.config,
        cardID = config.card_id,
        loadedMerchant = false,
        publicKey = '',
        clientSecret = '',
        customerID = ( paymentInfo.customer_id > '' ) ? paymentInfo.customer_id : '',
        cardInteraction = false,
        invalidCard = true,
        cardConfig = ( config.hasOwnProperty('cardConfig') ) ? config.cardConfig : {
            style			: stripeStyle,
            hidePostalCode 	: true
        },
        cardEvent = {};

    return {
        init : function( $infoWrap ){

            thisSA = this;
            tmpls = thisMA.getTmpls();
            // todo do better than set timeout - hook into custom event.
            setTimeout( function() {
                // Wrapper El
                $wrap = wpalEcommEl('#'+cardID+'-wrap', $infoWrap);

                // Method Select
                $paymentMethodSelect = wpalEcommEl('.payment-methods-select', $infoWrap );
                if( $paymentMethodSelect ){
                    $paymentMethodSelect.onchange = function(e){
                        thisSA.methodSelectChange(e);
                    };
                }
            }, 600 );

        },
        getPaymentID : function(billingData){
            billingData.payment_method_id = $paymentMethodSelect.value;
            return billingData;
        },
        getUpdateContactMerchantData : function(billingData){
            billingData.merchants[paymentInfo.profile_id] = {
                merchant            : merchant,
                profile_id          : paymentInfo.profile_id,
                customer_id         : paymentInfo.customer_id,
                payment_method_id   : paymentInfo.payment_method_id
            };
            return billingData;
        },
        getUpdateBillingData : function(billingData){

            billingData.merchants[paymentInfo.profile_id] = {
                merchant                    : merchant,
                current_payment_method_id   : paymentInfo.payment_method_id,
                profile_id                  : paymentInfo.profile_id,
                customer_id                 : paymentInfo.customer_id
            };
            if( $paymentMethodSelect.value === 'new' ){
                billingData.merchants[paymentInfo.profile_id].confirmCard = paymentInfo.profile_id;
            }
            return billingData;
        },
        initStripe : function ( type ){

            app = Stripe(publicKey);
            stripeElements = app.elements();

            if( type === 'card' ){
                thisSA.initCard();
            }

        },
        initCard : function (){

            $card = stripeElements.create('card', cardConfig);
            $card.mount('#'+cardID);

            // On Card Change Listen for Errors
            $card.addEventListener('change', wpalDebounce(function(e) {
                cardInteraction = true;
                cardEvent = e;
                if(e.error){
                    invalidCard = e.error.message;
                    wpalEcommRenderError( $wrap, e.error.message );
                }
                else {
                    invalidCard = false;
                    wpalEcommRemoveError( $wrap );
                }
            }, 250 ) );

        },
        methodSelectChange : function (e){
            var selected = $paymentMethodSelect.value,
                attr = ( selected === 'new' ) ? 'new' : 'default';
            if( attr === 'new' ){
                if( ! loadedMerchant ){
                    wpalEcommLoadingScreen( tmpls, I18n.loading.loading, function(){
                        thisSA.loadMerchant( function(response){
                            if(response){
                                thisSA.initStripe('card');
                            }
                        });
                    });
                }
                else {
                    thisSA.initStripe('card');
                }
            }
            else {
                if(loadedMerchant){
                    $card.clear();
                }
            }
            $wrap.setAttribute('data-card', attr);
        },
        loadMerchant : function (callback){

            var ajaxData = {
                    action  : 'wpal_ecomm_account_update',
                    update  : 'merchant',
                    user_id : wpalUserID,
                    details : JSON.stringify( {
                        merchant      : merchant,
                		profile_id    : profileID,
                		customer_id   : customerID
                    } )
                };

            wpalEcommPost( ajaxData, function( response ){
                var success = ( response.success ),
                    data = ( response.data ) ? response.data : {};
                if( ! success ){
                    wpalEcommRemoveLoadingScreen();
                    wpalEcommRenderModal(data.notice, tmpls);
                    callback(false);
                }
                else {
                    // Load Stripe w/ debouce as it was very fast and looked jumpy
                    wpalLoadScript( 'https://js.stripe.com/v3/', wpalDebounce( function(){
                        loadedMerchant = 'stripe';
                        publicKey = data.data.public_key;
                        clientSecret = data.data.client_secret;
                        wpalEcommRemoveLoadingScreen();
                        callback(true);
                    }, 500 ));
                }
            });

        },
        confirmCard : function ( callback ){

            var data = {
                expand : ['payment_method'],
                payment_method : {
                    card            : $card,
                    billing_details : thisSA.billingDetails()
                }
            };
            app.confirmCardSetup(clientSecret, data).then(function(result) {
                if (result.error) {
                    thisSA.showError(result.error.message);
                    callback(false);
                }
                else {
                    var method = result.setupIntent.payment_method,
                        returnData = {
                            name_on_card        : method.billing_details.name,
                            billing_full_name   : method.billing_details.name,
                            billing_email       : method.billing_details.email,
                            payment_method_id   : method.id,
                            brand               : method.card.brand,
                            last4               : method.card.last4,
                            billing_details     : thisSA.paymentDetails(method.card),
                        };
                    if( method.billing_details.phone > '' ){
                        returnData.billing_phone = method.billing_details.phone;
                    }
                    callback(returnData);
                }
            });
        },
        billingDetails : function (){

            // Build Contact Object
            var formData = wpalEcommFieldsData(thisMA.getFields()),
                contact  = formData.hasOwnProperty('contact') ? formData.contact : false,
                info     = formData.hasOwnProperty('payment_info') ? formData.payment_info : false,
                name     = '';

            if( info && info.hasOwnProperty('name_on_card') && info.name_on_card > '' ){
                name = info.name_on_card;
            }
            if( ! name > '' && contact && contact.hasOwnProperty('billing_full_name') && contact.billing_full_name > '' ){
                name = contact.billing_full_name;
            }
            var billing = {
                    name	:	name,
                    address :	{
                        city            :	formData.billing.billing_city,
                        country         :	formData.billing.billing_country,
                        state           :   formData.billing.billing_state,
                        line1           :	formData.billing.billing_address_1,
                        line2           :	formData.billing.billing_address_2,
                        postal_code     :	formData.billing.billing_postcode,
                    }
                };
            if( contact ){
                if( contact.hasOwnProperty('billing_email') && contact.billing_email > '' ){
                    billing.email = contact.billing_email;
                }
                if( contact.hasOwnProperty('billing_phone') && contact.billing_phone > '' ){
                    billing.phone = contact.billing_phone;
                }
            }
            return billing;
        },
        paymentDetails : function ( data ){
            if( data.brand && data.last4 ){
                return wpalEcommSprintF(I18n.sprintf.payment_method,[
                    data.brand.toUpperCase(),
                    data.last4
                ]);
            }
            else {
                return '';
            }
        },
        checkCardInvalid : function( display ){
            var message = false;
            if( ! cardInteraction ){
                message = 'Please enter card details';
            }
            else{
                if( invalidCard ){
                    message = invalidCard;
                }
            }
            if( display && message ){
                thisSA.showError(message);
            }
            return message;
        },
        showError : function ( error ){
            wpalEcommRenderError( $wrap, error );
            $wrap.scrollIntoView({behavior: 'smooth'});
            wpalEcommRemoveLoadingScreen();
        },
        getPostalCode : function( billingData ){
            if( cardConfig.hasOwnProperty('hidePostalCode') && cardConfig.hidePostalCode ){
                //no change
            }
            else{
                if( cardEvent.hasOwnProperty('value') && cardEvent.value.hasOwnProperty('postalCode') ){
                    billingData.bill.billing_postcode = cardEvent.value.postalCode;
                }
            }
            return billingData;
        }
    }
};