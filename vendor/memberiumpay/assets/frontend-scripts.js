'use strict';

var $doc = document,
wpalUserID = 0,
$wpalModal,
$wpalLoading,
wpalCheckouts = {},
wpalMyAccount = false,
wpalCurrencyData = {},
wpalCountryRegions = false,
wpalEcommFilters = {};

!function(e){var t=e.document.documentElement;function n(){o(document.getElementsByTagName("input"),u),e.setTimeout(function(){e.checkAndTriggerAutoFillEvent(t.querySelectorAll('input:not([type="checkbox"])'))},200)}function r(e){"$$currentValue"in e||(e.$$currentValue=e.getAttribute("value"));var t=e.value,n=e.$$currentValue;return!t&&!n||t===n}function u(e){e.$$currentValue=e.value}function c(e,n){function r(e){var t=e.target;n(t)}t.addEventListener?t.addEventListener(e,r,!0):t.attachEvent(e,r)}function o(e,t){if(e.forEach)return e.forEach(t);var n;for(n=0;n<e.length;n++)t(e[n])}function i(t){var n=e.document.createEvent("HTMLEvents");n.initEvent("change",!0,!0),t.dispatchEvent(n)}e.checkAndTriggerAutoFillEvent=function(e){var t,n;for(e="INPUT"===this.nodeName?[this]:e,t=0;t<e.length;t++)r(n=e[t])||(u(n),i(n))},c("change",u),HTMLInputElement.prototype.checkAndTriggerAutoFillEvent=e.checkAndTriggerAutoFillEvent,c("blur",function(t){e.setTimeout(function(){var n=function(e){for(;e;){if("FORM"===e.nodeName)return e;e=e.parentNode}return null}(t);n&&e.checkAndTriggerAutoFillEvent(n.querySelectorAll('input:not([type="checkbox"])'))},20)}),e.document.addEventListener?e.document.addEventListener("DOMContentLoaded",n,!1):e.document.attachEvent("DOMContentLoaded",n)}(window);


// Document ready
var wpalEcommReady = function wpalEcommReady(callBack) {
    if ($doc.readyState !== 'loading') {
        callBack();
    }
    else if ($doc.addEventListener) {
        $doc.addEventListener('DOMContentLoaded', callBack);
    }
    else {
        $doc.attachEvent('onreadystatechange', function() {
            if ($doc.readyState === 'complete') {
                callBack();
            }
        });
    }
};

// Dom Ready
wpalEcommReady(function() {

    if ( typeof wpal_ecomm_data !== "undefined" ) {

        /*
        console.log({
            wpal_ecomm_data:wpal_ecomm_data
        });
        */

        wpalUserID = wpal_ecomm_data.user_id;

        if( wpal_ecomm_data.hasOwnProperty('country_region_data') ){
            wpalCountryRegions = wpalEcommManageCountryRegionSelectors(wpal_ecomm_data.country_region_data);
        }

        if( wpal_ecomm_data.hasOwnProperty('currency_data') ){
            wpalCurrencyData = wpal_ecomm_data.currency_data;
        }

        // Render Checkouts
        if( wpal_ecomm_data.hasOwnProperty('order_forms') ){
            for ( var i in wpal_ecomm_data.order_forms ) {
                var formID = wpal_ecomm_data.order_forms[i].id;
                wpalCheckouts[formID] = wpalEcommCheckout(wpal_ecomm_data.order_forms[i], i);
                wpalCheckouts[formID].init();
            }
        }
        // Cleanse Param
        if( wpal_ecomm_data.hasOwnProperty('cleanse_param') ){
            wpalEcommQueryParams(wpal_ecomm_data.cleanse_param);
        }
        // My Account
        if( wpal_ecomm_data.hasOwnProperty('my_account') ){
            var accountData = wpal_ecomm_data.my_account;
            wpalLoadScript( accountData.script, function(){
                wpalMyAccount = wpalEcommMyAccount(accountData);
                wpalMyAccount.init();
            });
        }
        // Update CC Form
        if( wpal_ecomm_data.hasOwnProperty('update_cc') ){
            var updateCCData = wpal_ecomm_data.update_cc;
            wpalLoadScript( updateCCData[0].script, function(){
                wpalEcommUpdateCC(updateCCData);
            });
        }
    }
});

// Listen to Custom Events
document.addEventListener('wpal-ecomm-checkout-form-rendered', function(event) {
    if( event.detail.ecID > '' ){
        var $form = wpalCheckouts[event.detail.ecID].getEl('$orderForm'),
            view  = event.detail.hasOwnProperty('view') ? event.detail.view : 'checkout';
        wpalCountryRegions.initView(view, $form);
    }
});

// Ecomm Checkout Shortcode
// TODO - this should be seperated to it's own file
var wpalEcommCheckout = function (data, instance) {

    // Common Elements
    var els = {
        $orderForm      : false,
        $validForm      : false,
        $loginWrap      : false,
        $loginTrigger   : false,
        $modal          : false,
        $contactFields  : false,
        $billingFields  : false,
        $consentFields  : false,
        $cart           : false,
        $methodsWrap    : false,
        $buttonWrap     : false,
        $loader         : false,
        $subscriptions  : false
    };

    // Vars
    var thisEC,
        formType = data.type,
        ecID = data.id,
        orderFormID = data.order_form_id,
        orderID = 0,
        currency = data.currency,
        symbol = wpalEcommSymbol(currency),
        amounts = [],
        cart = data.cart,
        products = data.products,
        canPurchaseProduct = true,
        purchasedProductMessage = '',
        selectedPlanID = '',
        fields = data.fields,
        $lastFieldsRendered = false,
        merchants = data.merchants,
        loadedMerchants = [],
        currentMerchant = data.default,
        descriptor = data.descriptor,
        I18n = data.I18n,
        tmpls = {},
        filters = {};

    return {
        filters: filters,
        init   : function (){

            // Common reference to this
            thisEC = this;

            // Register Filters Event
            wpalEcommDispatchEvent('wpal-ecomm-checkout-register-filters', { ecID : ecID, app : thisEC } );

            // Set common elements
            els.$orderForm = wpalEcommEl('[data-order-form-id="'+ecID+'"]', document);
            if( ! els.$orderForm ){
                return false;
            }

            //Add Overflow Visible to content for sticky sidebar
            var $content = wpalEcommEl('#content', document);
            if( $content ){
                $content.style.overflow = 'visible';
            }

            // Generate Underscore Templates Array
            if( data.tmpls ){
                for ( var t in data.tmpls ) {
                    var tmpl = data.tmpls[t];
                    if( ! tmpls.hasOwnProperty(tmpl) ){
                        tmpls[tmpl] = wp.template(tmpl);
                    }
                }
            }

            if( wpalUserID < 1 ){
                thisEC.renderLogin();
                thisEC.initLogin();
                thisEC.renderSeperator( I18n.titles.or, els.$loginWrap );
            }

            wpalEcommLoadResizeListeners(function(){
                wpalEcommContainerWidth(els.$orderForm, 767, 767);
            });

            // Hidden Input to Trigger Valid Actions (Paypal)
            thisEC.renderValidInput();

            for( var f in fields ){
                if( fields[f].length ){
                    thisEC.renderFormSection( f );
                }
            }

            thisEC.setProductPurchased(products);
            thisEC.renderProductDetails( products );

            if( thisEC.isSubscription() ){
                // review - adds labels to plans
                // should add to admin and just remove this function
                thisEC.subscriptionData(products);
                thisEC.renderSubscriptions( products );
                thisEC.initSubscriptions();
            }

            thisEC.renderCart( cart );
            var paypalOnly = ( Object.keys(merchants).length === 1 && currentMerchant === 'paypal' );
            if( ! paypalOnly ){
                thisEC.renderMerchantSelect();
            }
            thisEC.renderButtonWrap();
            thisEC.renderMerchant(currentMerchant);

            wpalEcommDispatchEvent( 'wpal-ecomm-checkout-form-rendered', {
                ecID : ecID
            } );

        },
        getEl : function ( prop ){
            if( prop > '' ){
                if( els.hasOwnProperty(prop) ){
                    return els[prop];
                }
            }
            return false;
        },
        getI18n : function (){
            return I18n;
        },
        getTmpls : function (){
            return tmpls;
        },
        addFilter:function( name, func ){
            if( typeof func !== "function" ){
                return false;
            }
            if( ! this.filters.hasOwnProperty(name) ){
                this.filters[name] = {};
            }
            var i = Object.keys(this.filters[name]).length;
            this.filters[name][i++] = func;
        },
        applyFilters:function( name, data ){
            if( this.filters.hasOwnProperty(name) ){
                for( var i in this.filters[name] ){
                    var func = this.filters[name][i];
                    if( typeof func === "function" ){
                        data = func(data);
                    }
                }
            }
            return data;
        },
        getorderFormID : function (){
            return orderFormID;
        },
        getOrderID : function (){
            return orderID;
        },
        setOrderID : function (id){
            orderID = id;
        },
        getCart : function (){
            return cart;
        },
        getFields : function (){
            return fields;
        },
        cartData : function ( cart ){

            cart.subtotal = 0;
            cart.tax = 0;
            cart.discount = 0;
            cart.total = 0;
            cart.currency = currency;
            cart.symbol = symbol;
            cart.nextdue = 0;

            for ( var i in cart.items ) {
                // Item Amounts
                cart.items[i] = thisEC.itemAmounts(cart.items[i]);
                var item = cart.items[i];
                if( item.regular > 0 ){
                    cart.subtotal += item.regular;
                }
                if( item.tax > 0 ){
                    cart.tax += item.tax;
                }
                if( item.discount > 0 ){
                    cart.discount += item.discount;
                }
                if( item.total > 0 ){
                    var isTrial = ( item.hasOwnProperty('trial') && item.trial > 0 ) ? 1 : 0;
                    if( isTrial ){
                        cart.nextdue += item.total;
                    }
                    else {
                        cart.total += item.total;
                    }
                }
            }

            cart.priceDisplays = wpalEcommTotalsData(cart, I18n.totals);
        },
        itemAmounts : function ( item ){

            var total = item.price,
                qty = parseInt(item.qty),
                discountAmount = 0,
                regularAmount = total;

            if( parseInt(item.on_sale) > 0 ){
                total = item.sale_price;
                var saleDiscount = item.price - item.sale_price;
                discountAmount = saleDiscount;
            }

            if( item.hasOwnProperty('discount_price') ){
                var promoDiscount = total - item.discount_price;
                total = item.discount_price;
                discountAmount = discountAmount + promoDiscount;
            }
            item.regular = regularAmount * qty;
            item.discount = discountAmount;
            item.total = total * qty;
            item.priceDisplays = {};
            var i = 0;
            if( item.discount > 0 ){
                item.priceDisplays[0] = wpalEcommCartPrice(item, 'regular');
                i = 1;
            }
            item.priceDisplays[i] = wpalEcommCartPrice(item, 'total');
            return item;
        },
        renderValidInput : function (){

            els.$validForm = wpalCreateEl('input', els.$orderForm, [
                { prop : 'type', value : 'hidden' },
                { prop : 'id', value : 'valid-form-'+ecID },
                { prop : 'value', value : 0 },
            ] );
        },
        renderLogin : function (){

            var className = 'wpal-ecomm-login',
                $wrap = wpalEcommEl('.'+className+'-wrap', els.$orderForm);
            $wrap = ( ! $wrap ) ? els.$orderForm : $wrap;
            els.$loginWrap = wpalEcommEl('wpal-ecomm-login', $wrap);
            if( ! els.$loginWrap ){
                els.$loginWrap = wpalCreateEl('fieldset', $wrap, [
                    { prop : 'class', value : 'wpal-ecomm-login' }
                ] );
                var $loginLegend = wpalCreateEl('legend', els.$loginWrap).innerHTML = I18n.titles.login;
                els.$loginTrigger = wpalCreateEl('button', els.$loginWrap, [
                    { prop : 'class', value : 'wpal-ecomm-login-trigger' },
                ] );
                els.$loginTrigger.innerHTML = I18n.titles.login_trigger;
            }
            else{
                els.$loginTrigger = wpalEcommEl('wpal-ecomm-login', els.$loginWrap);
            }

        },
        renderProductDetails : function ( products ){
            var className = 'wpal-ecomm-products',
                legend = I18n.titles.products,
                $wrap = wpalEcommEl('.'+className+'-wrap', els.$orderForm);
            $wrap = ( ! $wrap ) ? els.$orderForm : $wrap;
            $wrap.insertAdjacentHTML('beforeend', tmpls.wpal_ecomm_product_details({
                className   : className,
                products    : products,
                legend      : legend
            }));
        },
        renderSubscriptions : function ( products ){

            var className = 'wpal-ecomm-subscriptions',
                legend = I18n.titles.subscriptions,
                $wrap = wpalEcommEl('.'+className+'-wrap', els.$orderForm);
            $wrap = ( ! $wrap ) ? els.$orderForm : $wrap;

            $wrap.insertAdjacentHTML('beforeend', tmpls.wpal_ecomm_subscriptions({
                className   : className,
                products    : products,
                legend      : legend
            }));
            els.$subscriptions = wpalEcommEl('.'+className, els.$orderForm);

        },
        renderFormSection : function( key ){

            var className = 'wpal-ecomm-'+key+'-fields',
                legend    = I18n.titles.hasOwnProperty(key) ? I18n.titles[key] : '',
                $wrap     = wpalEcommEl('.'+className+'-wrap', els.$orderForm),
                position  = 'beforeend',
                tmplKey   = 'wpal_ecomm_'+key+'_fields';

            tmplKey = tmpls.hasOwnProperty(tmplKey) ? tmplKey : 'wpal_ecomm_billing_fields';
            legend = ( key === 'contact' && wpalUserID < 1 ) ? I18n.titles.create_account : legend;
            fields[key] = wpalEcommFieldProps(fields[key]);

            if( !$wrap && $lastFieldsRendered ){
                $wrap = $lastFieldsRendered;
                position = 'afterend';
            }
            $wrap = ( !$wrap ) ? els.$orderForm : $wrap;

            $wrap.insertAdjacentHTML(position, tmpls[tmplKey]({
                className   : className,
                fields      : fields[key],
                legend      : legend
            }));
            els["$"+key+"Fields"] = wpalEcommEl('.'+className, els.$orderForm);
            fields = wpalEcommMapFields(fields, key, els["$"+key+"Fields"], ecID);
            $lastFieldsRendered = els["$"+key+"Fields"];
        },
        renderCart : function ( cart ){

            // Ensure Cart Data is up to date
            thisEC.cartData( cart );

            var className = 'wpal-ecomm-cart',
                legend = I18n.titles.order,
                $wrap = wpalEcommEl('.'+className+'-wrap', els.$orderForm);
            $wrap = ( ! $wrap ) ? els.$orderForm : $wrap;
            $wrap.innerHTML = tmpls.wpal_ecomm_cart({
                className   : className,
                legend      : legend,
                cart        : cart,
            });

            els.$cart = wpalEcommEl('.'+className, $wrap);

        },
        renderMerchantSelect : function (){

            for ( var merchant in merchants ) {
                merchants[merchant].checked = ( currentMerchant == merchant ) ? ' checked' : '';
            }

            var className = 'wpal-ecomm-payment-methods',
                legend = I18n.titles.merchants,
                $wrap = wpalEcommEl('.'+className+'-wrap', els.$orderForm);
            $wrap = ( ! $wrap ) ? els.$orderForm : $wrap;

            $wrap.innerHTML = tmpls.wpal_ecomm_payment_methods({
                className   : className,
                legend      : legend,
                merchants   : merchants,
            });

            els.$methodsWrap = wpalEcommEl('.'+className, $wrap);
            var radios = {};
            for ( var merchant in merchants ) {
                radios[merchant] = els.$methodsWrap.querySelector('input[value="'+merchant+'"]');
                radios[merchant].addEventListener('change', function(e){
                    thisEC.isValidForm();
                    thisEC.renderMerchant(e.target.value);
                });
            }

        },
        renderButtonWrap : function (){

            var className = 'wpal-ecomm-button-wrap';
            els.$buttonWrap = wpalEcommEl('.'+className, els.$orderForm );
            if( ! els.$buttonWrap ){
                els.$buttonWrap = wpalCreateEl('div', els.$orderForm, [
                    { prop : 'class', value : className }
                ]);
            }
        },
        renderMerchant : function (merchant){

            var config = merchants[merchant],
                hasRendered = ( loadedMerchants.includes(merchant) );
            currentMerchant = merchant;
            config.orderFormID = orderFormID;
            config.ecID = ecID;
            config.descriptor = descriptor;
            if( merchant === 'stripe' ){
                currency = config.currency;
                symbol = wpalEcommSymbol(currency);
                if( ! hasRendered ){
                    //todo - script url should be coming from backend
                    wpalLoadScript( 'https://js.stripe.com/v3/', function(){
                        var wpalEcommStripeApp = wpalEcommStripe(config,thisEC);
                        wpalEcommStripeApp.init();
                        loadedMerchants.push('stripe');
                    });
                }
            }
            else if( merchant === 'paypal' ){
                symbol = wpalEcommSymbol(config.currency),
                currency = config.currency.toUpperCase();
                if( ! hasRendered ){
                    //todo - script url shoul be coming from backend
                    var paypalScript = 'https://www.paypal.com/sdk/js?client-id=';
                    paypalScript += config.client_id;
                    paypalScript += ( currency != 'USD' ) ? '&currency='+currency : '';
                    paypalScript += '&disable-funding=sepa';
                    paypalScript += ',card';
                    if( thisEC.isSubscription() ){
                        paypalScript += '&vault=true';
                        //intent=subscription - seeing error about this but nothing in docs
                    }
                    wpalLoadScript( paypalScript, function(){
                        var wpalEcommPayPalApp = wpalEcommPayPal(config,thisEC);
                        wpalEcommPayPalApp.init();
                        loadedMerchants.push('paypal');
                    });
                }
            }
            els.$orderForm.setAttribute('data-merchant', merchant);
        },
        renderProductImage : function ( product, className, $parent ){
            if( product.image > '' ){
                var $fig = wpalCreateEl('figure', $parent, [
                    { prop : 'class', value : className },
                ] );
                wpalCreateEl('img', $fig, [
                    { prop : 'src', value : product.image },
                ] );
            }
        },
        renderProductTitle : function ( product, className, $parent ){
            // Title
            wpalCreateEl('div', $parent, [
                { prop : 'class', value : className },
            ] ).innerHTML = '<span>' + product.name + '</span>';
        },
        initSubscriptions : function (){

            var plans = els.$subscriptions.querySelectorAll('.subscription-plan');
            for ( var p = 0; p < plans.length; ++p) {
                if( plans[p].checked ){
                    selectedPlanID = plans[p].value;
                }
                plans[p].addEventListener('change', thisEC.subscriptionChange);
            }

        },
        initLogin : function (){

            if( els.$loginTrigger ){

                els.$loginTrigger.onclick = function(e){
                    e.preventDefault();
                    wpalEcommRenderModal({
                        id      : 'wpal-ecomm-login-form',
                        title   : I18n.titles.login_form,
                        content : tmpls.wpal_ecomm_login()
                    }, tmpls );
                    return false;
                }
            }

        },
        renderPlanRadio : function ( plan, $wrap ){
            var name = 'plan_'+plan.id,
            radioProps = [
                { prop : 'id', value : name },
                { prop : 'class', value : 'subscription-plan' },
                { prop : 'type', value : 'radio' },
                { prop : 'name', value : 'product_'+plan.product_id },
                { prop : 'value', value : plan.id }
            ];
            if( plan.checked > '' ){
                selectedPlanID = plan.id;
                radioProps.push( { prop : 'checked', value : plan.checked } );
            }
            var $radio = wpalCreateEl('input', $wrap, radioProps );
            var $label = wpalCreateEl('label', $wrap, [
                { prop : 'for', value : name },
            ] ).innerHTML = plan.label;

            $radio.addEventListener('change', thisEC.subscriptionChange);

        },
        subscriptionData : function (products){

            for ( var p in products ) {
                var plans = products[p].plans;
                for ( var i in plans ) {
                    var plan = plans[i];
                    if( ! plan.hasOwnProperty('label') ){
                        var intervalText = plan.interval;
                        if( parseInt(plan.bill_interval) > 1 ){
                            intervalText = plan.bill_interval + ' ' + wpal_ecomm_data.subscription_intervals_plural[plan.interval];
                        }
                        var label = wpalEcommSprintF(I18n.sprintf.subscription,[
                            symbol, plan.amount, currency.toUpperCase(), intervalText
                        ] ),
                        info = '';
                        if( wpalEcommIsTrial(plan) ){
                            info = wpalEcommSprintF(I18n.sprintf.trial,[plan.trial_days]);
                        }
                        products[p].plans[i].label = label;
                        products[p].plans[i].info = info;
                    }
                }
            }
            return products;
        },
        isSubscription : function (){
            return ( formType === 'subscription' );
        },
        getSelectedPlanID : function(){
            return selectedPlanID;
        },
        subscriptionChange : function (e){

            selectedPlanID = parseInt(e.target.value);
            var plan = products[0].plans.filter(function (obj) {
                return obj.id === selectedPlanID;
            }),
            amount = plan[0].amount;
            cart.items[0].plan_id = selectedPlanID;
            cart.items[0].trial = wpalEcommIsTrial(plan[0]) ? 1 : 0;
            cart.items[0].price = amount;
            cart.items[0].regular = amount;
            cart.items[0].total = amount;

            thisEC.renderCart(cart);
        },
        cartTotals : function (){
            return {
                subtotal : cart.subtotal,
                tax      : cart.tax,
                discount : cart.discount,
                total    : cart.total
            };
        },
        cartItemData : function (){
            var items = {};
            for (var i = 0; i < cart.items.length; i++) {
                var item = cart.items[i];
                items[i] = {
                    id          : item.id,
                    type        : item.product_type,
                    name        : item.name,
                    qty         : item.qty,
                    price       : item.price,
                    discount    : item.discount,
                    total       : item.total
                };
                if( item.hasOwnProperty('plan_id') ){
                    items[i].plan_id = item.plan_id;
                    if( item.hasOwnProperty('trial') ){
                        items[i].trial = item.trial;
                    }
                }

            }
            return items;
        },
        createOrder : function ( data, callback ){

            // Create Order Post
            wpalEcommLoadingScreen( tmpls, I18n.loading.creating_order );
            wpalEcommPost(data, callback);

        },
        orderPostData : function (){

            return wpalEcommExtend( wpalEcommFieldsData(fields), {
                action        : 'wpal_ecomm_process_order',
                type          : formType,
                order_form_id : orderFormID,
                order_id      : thisEC.getOrderID(),
                profile_id    : merchants[currentMerchant].profile_id,
                merchant      : currentMerchant,
                user_id       : wpalUserID,
                currency      : currency,
                symbol        : symbol,
                sandbox       : merchants[currentMerchant].sandbox,
                cart          : thisEC.cartTotals(),
                items         : thisEC.cartItemData(),
            });

        },
        renderSeperator : function ( title, $parent ){

            if( tmpls.seperator ){
                $parent.insertAdjacentHTML('afterend', tmpls.seperator({
                    title:title
                }));
            }
            else{
                var $seperator = $doc.createElement('div');
                $seperator.className = 'wpal-ecomm-separator';
                $parent.parentNode.insertBefore($seperator, $parent.nextSibling);

                var $seperatorSpan = wpalCreateEl('span', $seperator, [
                    { prop : 'class', value : 'wpal-ecomm-separator-content' }
                ] );
                $seperatorSpan.innerHTML = title;
            }

        },
        finalizeOrder : function( data ){

            var thankYou = (data.thank_you) ? data.thank_you : false,
                customerID = ( data.customer_id ) ? data.customer_id : '';

            // Check if WP User needs to be created
            if( parseInt(wpalUserID) < 1 ){
                thisEC.createUser( customerID, function (response){

                    if( ! response.succcess ){
                        thankYou.error = response.data.error;
                    }
                    thankYou.refresh = true;
                    thisEC.thankYou(thankYou);
                });
            }
            else{
                thisEC.thankYou(thankYou);
            }

        },
        createUser : function ( customerID, callback ){

            wpalEcommLoadingScreen( tmpls, I18n.loading.finalize_order );
            wpalEcommPost(wpalEcommExtend( wpalEcommFieldsData(fields), {
                    action      : 'wpal_ecomm_create_user',
                    customer_id : customerID,
                    order_id    : thisEC.getOrderID(),
                    profile_id  : merchants[currentMerchant].profile_id,
                    merchant    : currentMerchant,
            }), callback);

        },
        thankYou : function (data){

            if( data.url > '' ){
                window.location.replace(data.url);
            }
            else if( data.content > '' ){
                // Reload Page
                if( data.hasOwnProperty('refresh') ){
                    var url = location.href,
                        param = 'success='+thisEC.getOrderID();
                    url = ( url.indexOf('?') !== -1 ) ? url+'&'+param : url+'?'+param;
                    window.location.replace(url);
                }
                // Replace Content
                else{
                    els.$orderForm.innerHTML = data.content;
                    wpalEcommRemoveLoadingScreen();
                    els.$orderForm.scrollIntoView({behavior: 'smooth'});
                }
            }

        },
        merchantChange : function (e){
            var merchant = e.target.value;
            thisEC.renderMerchant(merchant);
        },
        isValidForm : function ( displayErrors ){

            var validForm = parseInt(els.$validForm.value),
                isValid = ( thisEC.validateForm( displayErrors ) < 1 ) ? 1 : 0;
            if( isValid != validForm ){
                thisEC.validFormEvent(isValid);
            }
            return ( isValid > 0 );
        },
        validFormEvent : function(isValid){
            els.$validForm.value = isValid;
            wpalEcommTriggerEvent(els.$validForm, 'change');
        },
        validateForm : function ( displayErrors ){
            var errors = 0;
            for ( var sections in fields ) {
                var section = fields[sections];
                //todo check for shipping
                for ( var f in section ) {
                    var field = section[f];
                    field.error = wpalEcommValidateField(field);
                    if( field.error ){
                        if( errors < 1 ){
                            errors = 0;
                            if( displayErrors ){
                                wpalEcommManageValidation(field);
                                field.$wrap.scrollIntoView({behavior: 'smooth'});
                            }
                        }
                        errors ++;
                    }
                }
            }
            if( ! canPurchaseProduct ){
                wpalEcommRenderError( els.$buttonWrap, purchasedProductMessage );
                errors ++;
            }
            return (errors > 0) ? 1 : 0;
        },
        setProductPurchased : function(products){
            for(var p in products){
                var product = products[p];
                if( product.hasOwnProperty('duplicates') && parseInt(product.duplicates) > 0 ){
                    if( product.hasOwnProperty('purchased') && parseInt(product.purchased) > 0 ){
                        canPurchaseProduct = false;
                        purchasedProductMessage = product.duplicate_message;
                    }
                }
            }
        }
    }
};

// Ecomm Country Regions
// TODO - this should be seperated to it's own file
var wpalEcommManageCountryRegionSelectors = function(data){

    var countrySelector = '.wpal-ecomm-field [data-country]',
        regionSelector  = '.wpal-ecomm-field [data-state]',
        thisCR;

    return {
        data     : data,
        initView : function( view, $form ){
            thisCR = this;
            var countries       = $form.querySelectorAll(countrySelector),
                regions         = $form.querySelectorAll(regionSelector),
                hasSelectors    = countries.length > 0;
            jQuery(countrySelector, $form).wpalSelect2({
                placeholder     : "Select a country",
                templateResult  : thisCR.countrySelect2Tmpl,
                data            : thisCR.countrySelectData()
            }).on('wpalSelect2:select', function (e) {
                //jQuery(e.target).removeClass('wpal-triggered');
                var countySelectData = thisCR.getCountryData(e.target.value),
                    countySelectCode = countySelectData ? countySelectData.id : '',
                    countryAttr      = e.target.getAttribute('data-country-state'),
                    $regionCountry   = wpalEcommEl('.wpal-ecomm-field [name="'+countryAttr+'"]', $form);
                if( $regionCountry ){
                    var regionShortCode = thisCR.getRegionData(countySelectCode, $regionCountry.value, 'id');
                    $regionCountry.setAttribute('data-county-code', countySelectCode);
                    jQuery($regionCountry).wpalSelect2({placeholder: "Select a region", data: countySelectData.regions});
                    jQuery($regionCountry).val(regionShortCode).trigger('change');
                }
            }).on('change', function (e) {
                var code = thisCR.getCountryData(e.target.value, 'id');
                    setTimeout(function () {
                        if( jQuery(e.target).hasClass('wpal-triggered') ){
                            jQuery(e.target).removeClass('wpal-triggered');
                            jQuery(e.target).trigger(thisCR.countryEventParams(e));
                        }
                        else{
                            jQuery(e.target).addClass('wpal-triggered');
                            jQuery(e.target).wpalSelect2({
                                placeholder     : "Select a country",
                                templateResult  : thisCR.countrySelect2Tmpl,
                                data            : thisCR.countrySelectData(code)
                            });
                            jQuery(e.target).val(thisCR.getCountryData(e.target.value, 'id'))
                                .trigger('change')
                                .trigger(thisCR.countryEventParams(e));
                        }
                  });
              });


            jQuery(regionSelector, $form).wpalSelect2({
                placeholder : "Select a region",
            }).on('change', function (e) {
                // Clear Errors
                var $input = e.target,
                 $wrapper = $input.closest('.wpal-ecomm-field');
                if( $wrapper !== null && $wrapper.classList.contains('wpal-ecomm-field-error') && $input.value > '' ){
                    wpalEcommRemoveError($wrapper);
                }
            });

            // Populate Regions on init
            for (var r = 0, regionLength = regions.length; r < regionLength; r++) {
                if( regions[r].value > '' ){
                    var $regionCountry = wpalEcommEl('.wpal-ecomm-field [name="'+regions[r].getAttribute('data-state-country')+'"]', $form);
                    if( $regionCountry ){
                        var regionInitData = thisCR.getUpdatedRegionData($regionCountry.value, regions[r].value);
                        jQuery(regions[r]).wpalSelect2({placeholder : "Select a region", data:regionInitData});
                    }
                }
            }

        },
        getCountryData  : function( country, key ){
            thisCR = this;
            key    = wpalCheckDefined(key);
            var i  = wpalEcommIndex(thisCR.data, 'countryShortCode', country);
            i = i !== -1 ? i : wpalEcommIndex(thisCR.data, 'countryName', country);
            var data = ( i !== -1 && thisCR.data[i] ) ? thisCR.data[i] : false,
            data = data ? {
                    i           : i,
                    id          : data ? data['countryShortCode'] : '',
                    text        : data ? data['countryName'] : '',
                    regions     : data ? data['regions'] : [],
            } : false;

            // Normalize Select Data
            if( data && ( ! key || ( key === 'regions' && data.hasOwnProperty('regions') ) ) ) {
                data.regions = thisCR.regionSelectData(data['regions']);
            }

            if ( ! key ) {
                return data;
            }
            else {
                return data.hasOwnProperty(key) ? data[key] : false;
            }
        },
        getRegionData : function( country, region, key ){
            var regions = thisCR.getCountryData(country, 'regions');
            regions = regions ? regions : false;
            key = wpalCheckDefined(key);

            var idRegionIndex = regions ? wpalEcommIndex(regions, 'id', region) : false,
                textRegionIndex = regions ? wpalEcommIndex(regions, 'text', region) : false,
                data = false;
            if( idRegionIndex !== -1 || textRegionIndex !== -1 ){
                data = idRegionIndex !== -1 ? regions[idRegionIndex] : regions[textRegionIndex];
            }
            if ( ! key ) {
                return data;
            }
            else {
                return data && data.hasOwnProperty(key) ? data[key] : '';
            }
        },
        countryEventParams: function ( e ){

            var data = this.getCountryData(e.target.value);
            return {
                type : 'wpalSelect2:select', params: { data :{
                   id   : data ? data.id   : '',
                   text : data ? data.text : ''
                } }
            }
        },
        countrySelectData: function( selected ){
            var data = [];
            for ( var c in thisCR.data ) {
                var obj = {
                    id   : thisCR.data[c].countryShortCode,
                    text : thisCR.data[c].countryName
                };
                if( selected === obj.id ){
                    obj.selected = true;
                }
                data.push(obj);
            }
            return data;
        },
        // Select 2 Country Flag Template
        countrySelect2Tmpl: function (country){
            if ( ! country.id ) { return country.text; }
            var sprintfStr = '<span class="flag-icon flag-icon-%s flag-icon-md"></span>';
            sprintfStr += '<span class="wpal-ecomm-flag-text">%s</span>';
            var countryStr = wpalEcommSprintF(sprintfStr, [country.id.toUpperCase(), country.text]);
            return jQuery(countryStr);
        },
        regionSelectData: function( regions ){
            var data = [];
            for ( var r in regions ) {
                var region = regions[r],
                    opt = { id: region.shortCode, text: region.name};
                data.push(opt);
            }
            return data;
        },
        getUpdatedRegionData: function( country, selected ){
            selected = wpalCheckDefined(selected);
            var data = thisCR.getCountryData(country, 'regions');
            if( data.length && selected > '' && selected ){
                for ( var d in data ) {
                    if( selected === data[d].id || selected === data[d].text ){
                        data[d].selected = true;
                    }
                }
            }
            return data;
        }
    };
};

var wpalEcommCountryData = function( country, key ){
    return wpalCountryRegions.getCountryData(country, key);
};

var wpalEcommRegionData = function( country, region, key ){
    return wpalCountryRegions.getRegionData( country, region, key );
};

// Utility : Resize/Load Listeners
var wpalEcommLoadResizeListeners = function(callback){
    window.addEventListener("resize", wpalDebounce(callback, 10));
    window.addEventListener("load", callback);
};

// Utility : Manage Container Width Data Attribute for Styling Purposes
var wpalEcommContainerWidth = function( $container, mobile, tablet ){
    var containerWidth = $container.offsetWidth,
        currentView = 'mobile';
    if( containerWidth > mobile && containerWidth < tablet ){
        currentView = 'tablet';
    }
    else if( containerWidth > tablet ){
        currentView = 'desktop';
    }
    $container.setAttribute('data-wpal-ecomm-container', currentView);
    return {
        currentView : currentView,
        windowWidth : window.innerWidth
    }
};

var wpalIsAutofill = function ($el) {
    return window.getComputedStyle($el, null).getPropertyValue('appearance') === 'menulist-button';
};

// Utility : Dispatch Event
var wpalEcommDispatchEvent = function( eventName, args ){
    document.dispatchEvent(new CustomEvent(eventName, { detail : args }));
};

// Utility : Trigger Event
var wpalEcommTriggerEvent = function( $el, eventName ){
    var e = new Event(eventName);
    $el.dispatchEvent(e);
};

// Utility : Ajax Write to log
var wpalEcommWriteToLog = function( logType, merchant, data ){
    wpalEcommPost( {
        action      : 'wpal_ecomm_write_log',
        log_type    : logType,
        merchant    : merchant,
        data        : data,
        user_id     : wpalUserID
    } );
};

// Utility : Load Script with Callback
var wpalLoadScript = function (src, callback, callbackParams){
    var script = document.createElement('script');
    script.setAttribute('src', src);
    if( callback ){
        if (typeof callbackParams !== 'undefined') {
            script.addEventListener('load', function(){
                callback(callbackParams);
            });
        }
        else{
            script.addEventListener('load', callback);
        }
    }
    document.head.appendChild(script);
};

// Utility : Currency Symbol
var wpalEcommSymbol = function (code){
    code = code.toUpperCase();
    if( wpalCurrencyData.hasOwnProperty(code) ){
        return wpalCurrencyData[code].symbol;
    }
    else {
        return false;
    }
};

// Utility : Totals Display Data
var wpalEcommTotalsData = function (data, labels){

    var totals = {},
        t = 0,
        showTax = ( data.tax > 0 ),
        showDiscount = ( data.discount > 0 ),
        showSub = ( showTax || showDiscount ),
        isSubscription = data.subscription,
        nextDue = ( isSubscription && data.nextdue > 0 );

    if( showSub ){
        totals[t] = {
            type    : 'subtotal',
            label   : labels.subtotal,
            amount  :  wpalEcommPrice(data.subtotal)
        };
        t++;
    }
    if( showTax ){
        totals[t] = {
            type    : 'tax',
            label   : labels.tax,
            amount  :  wpalEcommPrice(data.tax)
        };
        t++;
    }
    if( showDiscount ){
        totals[t] = {
            type    : 'discount',
            label   : labels.discount,
            amount  : wpalEcommPrice(data.discount)
        };
        t++;
    }

    totals[t] = {
        type    : 'total',
        label   : nextDue ? labels.due_today : labels.total,
        amount  : wpalEcommPrice( data.total, labels )
    }

    if( nextDue ){
        t++;
        totals[t] = {
            type    : 'next_due',
            label   : wpalEcommNextBillInfo( data.items[0], labels.next_due ),
            amount  : wpalEcommPrice(data.nextdue)
        }
    }
    else if( isSubscription ){
        t++;
        totals[t] = {
            type    : 'next_bill',
            label   : wpalEcommNextBillInfo( data.items[0], labels.next_bill ),
            //amount  : wpalEcommPrice(data.nextdue)
        }
    }
    return totals;
};

// Utility : Price to decimals
var wpalEcommPrice = function (amount){
    return parseFloat(amount).toFixed(2);
};

// Utility : Item Price
var wpalEcommItemPrice = function (item){
    var price = item.price;
    if( parseInt(item.on_sale) > 0 ){
        price = item.sale_price;
    }
    return wpalEcommPrice(price);
};

// Utility : Cart Item Price Display
var wpalEcommCartPrice = function ( item, type ){
    var details = '';
    if( item.product_type === 'subscription' ){
        details = wpalEcommGetPlanDetails(item, item.plan_id);
    }
    return {
        type    : type,
        amount  : wpalEcommPrice(item[type]),
        details : details
    };
};

// Utility : Next Bill Date Info
var wpalEcommNextBillInfo = function( item, label ){
    var details = wpalEcommGetPlanDetails(item,item.plan_id);
    return  wpalEcommSprintF(label,[details.next_bill]);
};

// Utility : Get Plan Details
var wpalEcommGetPlanDetails = function (item, id){
    var plan = item.plans.filter(function (obj) {
        return obj.id === id;
    });
    return ( plan.length ) ? plan[0] : false;
};

// Utility : Check if Plan is Trial
var wpalEcommIsTrial = function (plan){
    return parseInt(plan.trial) > 0 && parseInt(plan.trial_days);
};

// Utility : Render Modal Popup
var wpalEcommRenderModal = function(data, tmpls, callback){

    $doc.body.insertAdjacentHTML('afterbegin', tmpls.wpal_ecomm_modal(data));
    $wpalModal = wpalEcommEl('#'+data.id, $doc.body);
    MicroModal.show(data.id,{
        onClose: function( modal ){
            $doc.body.removeChild($wpalModal);
            $wpalModal = false;
            if( callback > '' ){
                callback();
            }
        },
        disableScroll: true
    });

};

// Utility : Render Modal Confirm Popup
var wpalEcommConfirmModal = function(data, tmpls, callback){

    var buttons = {
            cancel    : {
                label       : 'Cancel',
                dataAttr    : 'data-micromodal-close',
            },
            confirm   : {
                label       : 'Confirm',
                dataAttr    : 'data-micromodal-close'
            }
        },
        footer = '',
        buttonStr = '<button class="%s"%s>%s</button>';
    for ( var slug in buttons ) {
        var button = buttons[slug];
        footer += wpalEcommSprintF(buttonStr,[slug, button.dataAttr, button.label]);
    }
    data.footer = footer;
    wpalEcommRenderModal(data,tmpls);
    var $confirm = $wpalModal.querySelector('.confirm');
    $confirm.onclick = function(e){
        e.preventDefault();
        callback(e);
    };
};

// Utility : Render Loading Screen
var wpalEcommLoadingScreen = function ( tmpls, message, callback ){

    wpalEcommRemoveLoadingScreen();

    $doc.body.insertAdjacentHTML('afterbegin', tmpls.wpal_ecomm_loading({
        message : message,
        //className : ( className > '' ) ? className : '',
    }));

    $wpalLoading = wpalEcommEl('.wpal-ecomm-overlay', $doc.body);

    if( callback > '' ){
        setTimeout(function () {
            callback();
        }, 500);
    }

};

// Utility : Remove Loading Screen
var wpalEcommRemoveLoadingScreen = function (){
    if( $wpalLoading ){
        $doc.body.removeChild($wpalLoading);
    }
    $wpalLoading = false;
};

// Utility : Create El, set attrs and append to $parent
var wpalCreateEl = function (type, $parent, props){
    var $el = $doc.createElement(type);
    if( props && props.length){
        wpalEcommProps($el, props);
    }
    $parent.appendChild($el);
    return $el;
};

// Utility : Create Checkbox, set attrs and append to $parent
var wpalCheckbox = function ( $parent, props, label ){

    // Default prop
    props.push({ prop : 'type', value : 'checkbox' });
    props.push({ prop : 'value', value : 1 });

    // Check ID
    var id,
        idObj = props.filter(function (obj) {
        return obj.prop === 'id';
    });
    id = ( ! idObj.length ) ? false : idObj[0].value;
    if( ! id ){
        // Get Name
        var nameObj = props.filter(function (obj) {
            return obj.prop === 'name';
        });
        id = nameObj[0].value;
        props.push({ prop : 'id', value : id });
    }

    // Add Label
    var $label = wpalCreateEl('label', $parent, [
        { prop : 'for', value : id },
        { prop : 'class', value : 'wpal-ecomm-checkbox' },
    ] ),
    $checkbox = wpalCreateEl( 'input', $label, props );
    wpalCreateEl('span', $label).innerHTML = label;

    return $checkbox;
};

// Utility : Applies an array of attrs to element
var wpalEcommProps = function ($el, props){
    for ( var p in props ) {
        var attr = props[p];
        $el.setAttribute(attr.prop,attr.value);
    };
};

// Utility : Convert an array of attrs to string
var wpalEcommAttrString = function (props){
    var attrs = '';
    for ( var p in props ) {
        var attr = props[p];
        attrs += wpalEcommSprintF(' %s="%s"', [ attr.prop, attr.value]);
    };
    return attrs;
};

// Utility : Query Element | false
var wpalEcommEl = function (selector, $parent){
    if( $parent !== null ){
        var $el = $parent.querySelector(selector);
        return ( $el !== null ) ? $el : false;
    }
    return false;
};

// Utility : sprintf type function
var wpalEcommSprintF = function (format, args){
    var i = 0;
    return format.replace(/%s/g, function() {
        return args[i++];
    });
};

// Utility : Clone Object
var wpalEcommClone = function (x){
    return JSON.parse(JSON.stringify(x));
};

// Utility : Add Class ( if not exists )
var wpalAddClass = function($el,className){
    if( ! $el.classList.contains(className) ){
        $el.classList.add(className);
    }
};

// Utility : Remove Class
var wpalRemoveClass = function($el,className){
    if( $el.classList.contains(className) ){
        $el.classList.remove(className);
    }
};

// Utility : Debounce
var wpalDebounce = function(func, wait, immediate){
    var timeout;
    return function() {
        var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate){
                func.apply(context, args);
            }
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow){
            func.apply(context, args);
        }
	};
};

// Utility : Validate Email
var wpalValidateEmail = function(email){
    var expression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return ( expression.test(email) );
};

// Utility : Validate Phone
var wpalValidatePhone = function(phone){
    var cleaned = ('' + phone).replace(/\D/g, '');
    return ( cleaned.length > 9 && cleaned.length < 13 );
};

// Utility : Numbers Only
var wpalNumOnly = function(stringValue, charValue){
    return stringValue.indexOf(charValue) > -1;
};

// Utility : Password Validation
var wpalValidatePassword = function(password, $el){
    if( ! password > '' ){
        return false;
    }
    // Ensure no spaces
    if (/\s/.test(password)) {
        return false;
    }
    // Ensure length
    var min = parseInt($el.getAttribute('minlength')),
        passwordLength = password.length;
    if( passwordLength < min ){
        return false;
    }
    else{
        return true;
    }
};

// Utility : Make POST Request
var wpalEcommPost = function( postData, callback ){

    var request = new XMLHttpRequest();
    if( ! postData.hasOwnProperty('security') ){
        postData.security = wpal_ecomm_data.security;
    }
    var encodedData = Object.keys(postData).map(function(key) {
        var keyData = postData[key];
        if( keyData !== null && keyData !== 'undefined' && 'object' === typeof keyData ){
            keyData = JSON.stringify(keyData);
        }
        return key + '=' + encodeURIComponent(keyData)
    }).join('&');

    request.open('POST', wpal_ecomm_data.ajax_url, false);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onload = function () {
        // Process the response
        if (request.status >= 200 && request.status < 300) {
            var response = wpalEcommJSONparse(request.responseText);
            if (typeof callback === "function") {
                callback(response);
            }
        }
        else{
            console.log({
                func: 'wpalEcommPost',
                status: request.status,
                statusText: request.statusText
            });
        }
    }
    request.send(encodedData);
};

// Utility : Try Catch JSON Parse
var wpalEcommJSONparse = function( raw ){
    try {
        return JSON.parse(raw);
    }
    catch (err) {
        return false;
    }
};

// Utility : Extend Object
var wpalEcommExtend = function () {

	var extended = {},
    deep = false,
    i = 0;
	// Check if a deep merge
	if (typeof (arguments[0]) === 'boolean') {
		deep = arguments[0];
		i++;
	}
	// Merge the object into the extended object
	var merge = function (obj) {
		for (var prop in obj) {
			if (obj.hasOwnProperty(prop)) {
				if (deep && Object.prototype.toString.call(obj[prop]) === '[object Object]') {
					// If we're doing a deep merge and the property is an object
					extended[prop] = wpalEcommExtend(true, extended[prop], obj[prop]);
				}
                else {
					// Otherwise, do a regular merge
					extended[prop] = obj[prop];
				}
			}
		}
	};
	// Loop through each object and conduct a merge
	for (; i < arguments.length; i++) {
		merge(arguments[i]);
	}
	return extended;
};

// Utility : Update Query Params leave value empty to delete
var wpalEcommQueryParams = function (key, value){
   var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
   urlQueryString = document.location.search,
   newParam = key + '=' + value,
   params = '?' + newParam;
   // If the "search" string exists, then build params from it
   if (urlQueryString) {
	   var updateRegex = new RegExp('([\?&])' + key + '[^&]*'),
	   removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');
	   // Remove param if value is empty
       value = wpalCheckDefined(value);
	   if( ! value || value == '' ) {
		   params = urlQueryString.replace(removeRegex, "$1");
		   params = params.replace( /[&;]$/, "" );
		   params = ( params === '?' ) ? '' : params;
	   }
	   // If param exists already, update it
	   else if (urlQueryString.match(updateRegex) !== null) {
		   params = urlQueryString.replace(updateRegex, "$1" + newParam);
	   }
	   // Otherwise, add it to end of query string
	   else {
		   params = urlQueryString + '&' + newParam;
	   }
	   window.history.replaceState({}, "", baseUrl + params);
   }
};

// Utility : Render Field into Parent element
var wpalEcommRenderField = function (field, $parent){

    var $formWrap = wpalCreateEl('div', $parent, [
        { prop : 'class', value : 'wpal-ecomm-field' },
        { prop : 'data-field', value : field.name },
    ] );

    var $label = wpalCreateEl('label', $formWrap, [
        { prop : 'for', value : field.name },
    ] ).innerHTML = field.label;

    return {
        $wrap   : $formWrap,
        $el     : wpalCreateEl(field.type, $formWrap, field.attrs )
    };
};

// Utility : Builds Form Fields Property Array & String
var wpalEcommFieldProps = function (fields){

    wpalEcommSort(fields,'priority');

    for ( var f in fields ) {
        var field = fields[f],
        attrs = [
            { prop : 'name', value : field.name }
        ];
        if( ! field.hasOwnProperty('type') ){
            fields[f].type = 'input';
        }
        var type = fields[f].type,
        isCountrySelector = ( type === 'country_select' ),
        isRegionSelector = ( type === 'region_select' );
        if ( isCountrySelector || isRegionSelector ) {
            fields[f].type = 'input';
            var dataType = ( isCountrySelector ) ? 'country' : 'state',
                fullName = field.hasOwnProperty('fullname') && field.fullname > '' ? field.fullname : false,
                code     = field.hasOwnProperty('shortcode') && field.shortcode > '' ? field.shortcode : false;
            attrs.push({ prop : 'data-'+dataType, value : field.name + '-select' });
            attrs.push({ prop : 'type', value : 'text' });
            // Set Country Value as Shortcode
            if( isCountrySelector ){
                var countryData = code ? wpalEcommCountryData(code) : false;
                countryData = !countryData && fullName ? wpalEcommCountryData(code) : countryData;
                if( countryData ){
                    field.value = countryData.id;
                    attrs.push({ prop : 'data-country-name', value : countryData.text });
                }
                attrs.push({ prop : 'data-country-state', value : field.name.replace("country", "state") });
            }
            // Set Region Value as Shortcode
            else{
                var countryFieldName  = field.name.replace("state", "country"),
                    countryFieldIndex = wpalEcommIndex(fields, 'name', countryFieldName),
                    countryFieldData  = countryFieldIndex !== -1 ? fields[countryFieldIndex] : false;
                if( countryFieldData ){
                    var countryKey = countryFieldData.hasOwnProperty('shortcode') && countryFieldData.shortcode > '' ? countryFieldData.shortcode : false;
                    countryKey = !countryKey && countryFieldData.hasOwnProperty('value') && countryFieldData.value > '' ? countryFieldData.value : false;
                    if( countryKey && countryKey > '' ){
                        var regionData = fullName ? wpalEcommRegionData(countryKey, fullName) : false;
                        regionData = !regionData && code ? wpalEcommRegionData(countryKey, code) : false;
                        if( regionData ){
                            field.value = regionData.id;
                            attrs.push({ prop : 'data-state-name', value : regionData.text });
                        }
                    }
                }
                attrs.push({ prop : 'data-state-country', value : countryFieldName });
            }
        }

        if( type === 'checkbox' ){
            fields[f].type = 'input';
            attrs.push({ prop : 'type', value : 'checkbox' });
            attrs.push({ prop : 'id', value : fields[f].name });
            if( fields[f].hasOwnProperty('checked') && parseInt(fields[f].checked) > 0 ){
                attrs.push({ prop : 'checked', value : 'checked' });
            }
        }

        if( type === 'password' ){
            fields[f].type = 'input';
            attrs.push({ prop : 'type', value : 'password' });
        }

        if( field.hasOwnProperty('required') && parseInt(field.required) > 0 ){
            attrs.push({ prop : 'required', value : true });
            if( type === 'checkbox' ){
                field.validate = 'checkbox';
            }
        }
        if( field.hasOwnProperty('validate') ){
            attrs.push({ prop : 'data-validate', value : field.validate });
        }
        if( field.hasOwnProperty('className') ){
            attrs.push({ prop : 'class', value : field.className });
        }
        if( field.hasOwnProperty('value') ){
            attrs.push({ prop : 'value', value : field.value });
        }
        if( field.hasOwnProperty('autocomplete') ){
            attrs.push({ prop : 'autocomplete', value : field.autocomplete });
        }

        if( field.hasOwnProperty('attrs') ){
            attrs = wpalEcommUniqueArrayObjects(field.attrs, attrs, 'prop');
        }

        fields[f].attrs = attrs;
        fields[f].attrs_string = wpalEcommAttrString(attrs);
    }
    return fields;
};

// Utility : Map Fields
var wpalEcommMapFields = function (fields, fieldType, $parent, checkoutID){

    var selectedCountry = '';
    for ( var f in fields[fieldType] ) {
        var field = fields[fieldType][f];
        if(checkoutID > ''){
            fields[fieldType][f].checkoutID = checkoutID;
        }
        fields[fieldType][f].$el = wpalEcommEl('[name="'+field.name+'"]', $parent);
        if( ! fields[fieldType][f].$el ){
            var formObj = wpalEcommRenderField( field, $parent );
            fields[fieldType][f].$wrap = formObj.$wrap;
            fields[fieldType][f].$el = formObj.$el;
        }
        else{
            fields[fieldType][f].$wrap = wpalEcommEl('.wpal-ecomm-field[data-field="'+field.name+'"]', $parent);
        }

        // Country Region Selectors
        if( fields[fieldType][f].$el.hasAttribute('data-country') || fields[fieldType][f].$el.hasAttribute('data-region') ){
        }
        else{
            // Validation  Listeners
            wpalEcommFieldListeners( field );
            if( field.validate === 'password' ){
                wpalEcommPasswordToggle(field.$wrap, '.show-hide-password-icon');
            }
        }
    };
    return fields;
};

// Utility : Map Fields
var wpalEcommValidForm = function(field){

    if( field.hasOwnProperty('checkoutID') ){
        wpalCheckouts[field.checkoutID].isValidForm(false);
    }
};

// Utility : Field Validation Listenrs
var wpalEcommFieldListeners = function ( field ){

    if( ! field.hasOwnProperty('validate') ){
        field.error = false;
        return;
    }

    field.timeout = null;
    // Key Down Listeners
    field.$el.addEventListener('keydown', function (e) {
        if (e.defaultPrevented) {
            return;
        }
        field.error = false;
        var key = e.key || e.keyCode,
            charCode = (typeof e.which == "number") ? e.which : key,
            validate = field.validate;
        if( charCode ){
            if( validate === 'common' ){
                var not_allowed = [
                    33, 34, 35, 36, 37, 38,
                    40, 41, 42, 43, 44, 46, 47,
                    58, 59, 60, 61, 62, 63, 64,
                    91, 92, 93, 96, 123, 124, 125, 126
                ];
                //Not allowed or numbers
                if ( not_allowed.includes( charCode ) || (charCode >= 48 && charCode <= 57) ) {
                    e.preventDefault();
                    field.error = true;
                }
            }
            else if( validate === 'phone' || validate === 'numbers' ){
                var invalidKey = key.length === 1 && ! wpalNumOnly('0123456789', key) || key === '.' && wpalNumOnly(field.$el.value, '.');
                if( invalidKey ){
                    e.preventDefault();
                    field.error = true;
                }
            }
        }
        wpalEcommValidForm(field);
    });
    // Change
    field.$el.addEventListener('change', function (e) {
        wpalEcommValidateField(field);
        wpalEcommManageValidation(field);
        wpalEcommValidForm(field);
    });
    // Blur
    field.$el.addEventListener('blur', function (e) {
        wpalEcommValidateField(field);
        wpalEcommManageValidation(field);
        wpalEcommValidForm(field);
    });
};

// Utility : Is Required Field
var wpalEcommIsRequired = function (field){
    return ( field.hasOwnProperty('required') && parseInt(field.required) > 0 );
};

// Utility : Validate Field
var wpalEcommValidateField = function (field){

    var validate = field.validate,
        value    = field.$el.value,
        required = wpalEcommIsRequired(field),
        disabled = field.$el.hasAttribute('data-wpal-ecomm-disabled');

    field.error = false;

    // Not required and no value
    if( disabled || ( ! required && ! value > '' ) ){
        return false;
    }

    if( validate === 'common' || validate === 'length' ){
        if( ! value > '' ){
            field.error = true;
        }
    }
    else if( validate === 'phone' ){
        if( ! wpalValidatePhone(value) ){
            field.error = true;
        }
    }
    else if( validate === 'number' ){
        if( ! wpalNumOnly(value) ){
            field.error = true;
        }
    }
    else if( validate === 'email' ){
        if( ! wpalValidateEmail(value) ){
            field.error = true;
        }
    }
    else if( validate === 'checkbox' ){
        if( ! field.$el.checked ){
            field.error = true;
        }
    }
    else if( validate === 'password' ){
        if( ! wpalValidatePassword(value, field.$el) ){
            field.error = true;
        }
    }
    else if( validate === 'country' ){
        if( ! value > '' && wpalEcommCountryData(value) ){
            field.error = true;
        }
    }
    else if( validate === 'region' ){
        if( ! wpalValidateRegion(value, field) ){
            field.error = true;
        }
    }
    return field.error;
};

// Utility : Validate Region is Selected
var wpalValidateRegion = function( value, field ){
    var countrySelector = field.$el.getAttribute('data-state-country'),
        $countryEl      = wpalEcommEl('.wpal-ecomm-field [name="'+countrySelector+'"]', field.$wrap.parentElement),
        country         = $countryEl ? $countryEl.value : false;
    if( country > '' && value > '' ){
        return wpalEcommRegionData( country, value );
    }
    else{
        return false;
    }
};

// Utility : Manage Validation
var wpalEcommManageValidation = function (field){

    field.timeout = setTimeout(function () {
        if( field.error && ! field.$el.hasAttribute('data-wpal-ecomm-disabled') ){
            wpalEcommRenderError( field.$wrap, field.msg );
            field.$el.addEventListener("change", function(e) {
                wpalEcommRemoveError( field.$wrap );
            });
            field.$el.addEventListener("focus", function(e) {
                wpalEcommRemoveError( field.$wrap );
            });
        }
        else {
            wpalEcommRemoveError( field.$wrap );
        }
    }, 500);
};

// Utility : Render Field Error
var wpalEcommRenderError = function ($el, error){

    wpalAddClass($el,'wpal-ecomm-field-error');
    var $small = $el.querySelector('small.wpal-ecomm-error');
    if( $small === null ){
        $small = wpalCreateEl('small', $el, [
            { prop : 'class', value : 'wpal-ecomm-error' },
            { prop : 'role', value : 'alert' }
        ] );
    }
    $small.innerHTML = error;
    return $small;
};

// Utility : Remove Field Error
var wpalEcommRemoveError = function ($el){

    wpalRemoveClass($el,'wpal-ecomm-field-error');
    var $small = $el.querySelector('small.wpal-ecomm-error');
    if( $small ){
        $small.parentNode.removeChild($small);
    }
};

// Utility : Fields Data
var wpalEcommFieldsData = function( fields ){
    var data = {};
    for ( var key in fields ) {
        data[key] = wpalEcommSectionData( key, fields );
    }
    return data;
};

// Utility : Return Data for a section
var wpalEcommSectionData = function ( section, fields ){

    var data = {};
    for ( var f in fields[section] ) {
        var value = fields[section][f].value,
            name = fields[section][f].name;
        if( fields[section][f].hasOwnProperty('$el') ){
            if (fields[section][f].$el.matches('[type="checkbox"]') ) {
                value = fields[section][f].$el.checked;
            }
            else{
                value = fields[section][f].$el.value;
            }
        }
        data[name] = value;
    }

    if( section === 'contact' ){
        if( ! data.hasOwnProperty('billing_full_name') || ! data.billing_full_name > '' ){
            var fullName = data.billing_first_name > '' ? data.billing_first_name : '';
            fullName += ( fullName > '' && data.billing_last_name > '' ) ? ' ' : '';
            fullName += data.billing_last_name > '' ? data.billing_last_name : '';
            data.billing_full_name = fullName;
        }
        if( data.hasOwnProperty('billing_phone') && data.billing_phone > '' ){
            data.billing_phone = data.billing_phone.replace(/[^0-9]/g, '');
        }
    }

    return data;
};

// Utility : Find Index by Key Value
var wpalEcommIndex = function (data, key, value){
    var index = data.map(function (e) {
        return e[key];
    }).indexOf(value);
    return index;
};

// Sort Array of Objects by Key
var wpalEcommSort = function ( objects, key, order ){
    order = ( order != 'desc' ) ? 'asc' : 'desc';
    objects.sort(wpalEcommCompareValues(key, order));
    return objects;
};

// Utility : Compares Values in array of objects for sorting
var wpalEcommCompareValues = function (key, order) {

    order = ( order != 'desc' ) ? 'asc' : 'desc';
    return function innerSort(a, b) {
        if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) {
            return 0;
        }
        var varA = typeof a[key] === 'string' ? a[key].toUpperCase() : a[key],
            varB = typeof b[key] === 'string' ? b[key].toUpperCase() : b[key],
            comparison = 0;

        if (varA > varB) {
            comparison = 1;
        }
        else if (varA < varB) {
            comparison = -1;
        }
        return order === 'desc' ? comparison * -1 : comparison;
    };
};

// Utility : Is equal wrapper @uses lodash
var wpalEcommIsEqual = function ( object1, object2 ){
    return _.isEqual(object1, object2);
};

// Utility : Make 2 Arrays of Objects Unique by Property @uses lodash
var wpalEcommUniqueArrayObjects = function ( array1, array2, prop ){
    return _.uniq(_.union(array1, array2), false, _.property(prop));
};

// Utility : Password Toggle
var wpalEcommPasswordToggle = function ( $wrap, selector ){

    var toggles = $wrap.querySelectorAll(selector);
    for ( var t = 0; t < toggles.length; ++t) {
        toggles[t].onclick = function(e){
            var $el = e.target,
                $input = $el.parentElement.querySelector('input'),
                show = 'show-password-input',
                hide = 'hide-password-input';
            // Show Password
            if( $el.classList.contains(show) ){
                $el.classList.remove(show);
                $el.classList.add(hide);
                $input.setAttribute('type','text');
            }
            else{
                $el.classList.remove(hide);
                $el.classList.add(show);
                $input.setAttribute('type','password');
            }
        };
    }
};

// Utility : Push URL State
var wpalEcommNewURL = function( url ){
    window.history.pushState(null,null,url);
};

// Utility : Undefined Variable Check
var wpalCheckDefined = function( check ){
    return ( typeof check === 'undefined' || check === null ) ? false : check;
};