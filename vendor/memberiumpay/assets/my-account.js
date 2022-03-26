'use strict';

var wpalEcommMyAccountRenderedViews = {};

// After View Rendered
document.addEventListener('wpal-ecomm-my-account-view-rendered', function(event) {
    if( event.detail.app > '' ){
        var $form = event.detail.app.getEl('$account'),
            view  = event.detail.view,
            viewFilters = event.detail.viewFilters;
        if( viewFilters.hasOwnProperty(view) && viewFilters[view].hasOwnProperty('render') ){
            if( viewFilters[view].render.includes("ManageCountryRegionSelectors") ){
                wpalCountryRegions.initView(view, $form);
            }
        }
    }
});

var wpalEcommMyAccount = function (data) {

    var thisMA,
        sectionDataName = 'data-wpal-ecomm-account-section',
        selectorSprintF = '[%s="%s"]',
        orders = ( data.orders.single ) ? data.orders.single : false,
        ordersTableData = ( orders ) ? data.orders_table : false,
        subscriptions = ( data.orders.subscription ) ? data.orders.subscription : false,
        subscriptionsTableData = ( subscriptions ) ? data.subscriptions_table : false,
        itemsTableConfig = data.items_table,
        menu = data.menu,
        fields = data.fields,
        viewFilters = ( data.view_filters ) ?  data.view_filters : {},
        paymentInfo = ( data.payment_info ) ? data.payment_info : false,
        I18n = data.I18n,
        tmpls = {},
        baseURL = data.base_url,
        view = ( data.view ) ? data.view : 'contact',
        orderID = ( data.order ) ? parseInt(data.order) : 0,
        contactData = false,
        billingData = false,
        hasPaymentInfo = false,
        appMA = false,
        activeClass = data.active_class;

    // Common Elements
    var els = {
        $account        : false,
        $accountInfo    : false,
        $modal          : false,
        $contactFields  : false,
        $billingFields  : false,
        $updateButton   : false,
        $loader         : false,
        $subscriptions  : false,
        $cardWrap       : false,
        $methodSelect   : false,
        $currentMenu    : false
    };

    return {
        init : function (){

            // Set common elements
            els.$account = wpalEcommEl('.wpal-ecomm-account', document);
            if( ! els.$account ){
                return false;
            }
            els.$accountInfo = wpalEcommEl('.wpal-ecomm-account-info', els.$account);

            // Common reference to this
            thisMA = this;

            if( paymentInfo > '' ){
                // Check Card Details
                for ( var profileID in paymentInfo ) {
                    if(paymentInfo[profileID].card){
                        hasPaymentInfo = true;
                    }
                }
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
            // Container Width Listener ( When displayed with Sidebars etc )
            wpalEcommLoadResizeListeners(function(){
                wpalEcommContainerWidth(els.$account, 666, 1140);
            });
            thisMA.renderView( view );
            thisMA.initActions();

        },
        getI18n : function (){
            return I18n;
        },
        getTmpls : function (){
            return tmpls;
        },
        getEl : function ( prop ){
            if( prop > '' ){
                if( els.hasOwnProperty(prop) ){
                    return els[prop];
                }
            }
            return false;
        },
        getFields : function (){
            return fields;
        },
        setView : function ( currentView ){
            view = currentView;
        },
        renderView : function ( display ){
            if( viewFilters.hasOwnProperty(display) && viewFilters[display].hasOwnProperty('init') ){
                if( viewFilters[display].init.includes("loadMerchants") ){

                    for ( var profileID in paymentInfo ) {
                        var info = paymentInfo[profileID];
                        // Load Supporting Account Script
                        if( info.config.script > '' ){
                            var initMerchant = viewFilters[display].init.includes("initMerchants");
                            if( ! info.config.hasOwnProperty('loaded') ){
                                wpalLoadScript( info.config.script, function( loopID ){
                                    paymentInfo[loopID].config.loaded = 1;
                                    paymentInfo[loopID].config.app = window[paymentInfo[loopID].config.function_name](paymentInfo[loopID], thisMA);
                                    if( initMerchant ){
                                        paymentInfo[loopID].config.app.init(els.$accountInfo);
                                    }
                                }, profileID );
                            }
                            else {
                                if( initMerchant ){
                                    paymentInfo[profileID].config.app.init(els.$accountInfo);
                                }
                            }
                        }
                        else{
                            paymentInfo[profileID].config.app = {};
                        }
                    }
                }
            }

            if( display === 'contact' ){
                if( fields.contact.length ){
                    thisMA.renderContactFields();
                }
            }
            else if( display === 'billing' || display === 'update_billing' ){
                view = 'billing';
                els.$accountInfo.innerHTML = '';
                thisMA.renderPaymentOptions();
                thisMA.renderBillingFields();
            }
            else if( display === 'subscriptions' ){
                if( orderID > 0 ){
                    view = view+'/'+orderID;
                    thisMA.viewSubscription(orderID);
                    orderID = 0;
                }
                else{
                    thisMA.renderSubscriptionsTable();
                }
            }
            else if( display === 'orders' ){
                if( orderID > 0 ){
                    view = view+'/'+orderID;
                    thisMA.viewOrder(orderID);
                    orderID = 0;
                }
                else{
                    thisMA.renderOrdersTable();
                }
            }
            else if( display === 'password' ){
                thisMA.renderPasswordUpdate();
            }
            else{
                // Custom Render
                wpalEcommDispatchEvent( 'wpal-ecomm-my-account-render-view', {
                    app         : thisMA,
                    view        : display,
                    viewFilters : viewFilters
                } );
            }

            wpalEcommDispatchEvent( 'wpal-ecomm-my-account-view-rendered', {
                app         : thisMA,
                view        : display,
                orderID     : orderID,
                viewFilters : viewFilters
            } );
        },
        initActions : function (){

            // Click Event Delegation
            els.$account.addEventListener('click', function (e) {

                var $el = e.target;

                // Menu
                if ($el.matches('.wpal-ecomm-menu-item')) {
                    thisMA.removeActive();
                    var newView = $el.getAttribute('value'),
                        locationURL = $el.getAttribute('data-url');
                    if( locationURL > '' ){
                        window.location.href = locationURL;
                    }
                    else{
                        if( newView != view ){
                            $el.classList.add(activeClass);
                            thisMA.renderView(newView);
                            view = newView;
                            wpalEcommNewURL(baseURL + view + '/');
                        }
                    }
                }
                // View Subscription Trigger
                else if ($el.matches('.view-subscriptions')) {
                    var subscriptionID = $el.getAttribute('data-subscription-id');
                    view = 'subscriptions/' + subscriptionID;
                    thisMA.viewSubscription(subscriptionID);
                    wpalEcommNewURL(baseURL + view + '/');
                }

                // View Order Trigger
                else if ($el.matches('.view-order')) {
                    var orderID = $el.getAttribute('data-order-id');
                    view = 'orders/' + orderID;
                    thisMA.viewOrder(orderID);
                    wpalEcommNewURL(baseURL + view + '/');
                }

                // Cancel Subscription
                else if($el.matches('.cancel-subscription')){
                    var cancelID = $el.getAttribute('data-subscription-id');
                    thisMA.cancelConfirmation(cancelID);
                }

            }, false);
        },
        removeActive : function (){
             var $active = els.$account.querySelector('.wpal-ecomm-menu-item.'+activeClass);
             if( $active != null ){
                 $active.classList.remove(activeClass);
             }
        },
        renderContactFields : function (){

            var className = 'wpal-ecomm-contact-fields',
                legend = I18n.titles.contact;
            if( ! contactData ){
                fields.contact = wpalEcommFieldProps(fields.contact);
            }
            els.$accountInfo.innerHTML = tmpls.wpal_ecomm_contact_fields({
                className   : className,
                fields      : fields.contact,
                legend      : legend
            });
            els.$contactFields = wpalEcommEl('.'+className, els.$accountInfo);
            fields = wpalEcommMapFields(fields, 'contact', els.$contactFields, '');

            // Current Vales
            if( ! contactData ){
                contactData = wpalEcommSectionData( 'contact', fields );
            }
            // Update
            thisMA.updateButton( function(e){
                thisMA.updateContact();
            });
        },
        updateContact : function(){
            if( thisMA.validateForm( fields.contact, true ) < 1 ){
                var updatedData = wpalEcommSectionData( 'contact', fields );
                if( wpalEcommIsEqual( contactData, updatedData ) ){
                    thisMA.noChangeModal();
                }
                else{
                    wpalEcommLoadingScreen( tmpls, I18n.loading.updating, function(){
                        // Build Details Data
                        updatedData.merchants = {};
                        for ( var profileID in paymentInfo ) {
                            var info = paymentInfo[profileID];
                            if( paymentInfo[profileID].config.app.hasOwnProperty('getUpdateContactMerchantData') ){
                                updatedData = paymentInfo[profileID].config.app.getUpdateContactMerchantData(updatedData);
                            }
                        }
                        thisMA.processUpdate('contact', updatedData, function(success, data){
                            if( success ){
                                contactData = data.data;
                            }
                        });
                    });
                }
            }
        },
        renderPaymentOptions : function (){

            var wrapClass = 'wpal-ecomm-account-payment-info',
                content = '';

            if( paymentInfo > '' ){

                // Render Payment Info Templates
                for ( var profileID in paymentInfo ) {
                    var info = paymentInfo[profileID];

                    if( info.config.hasOwnProperty('tmpl') ){
                        var tmplData = info.config.tmpl_data;
                        tmplData.I18n = I18n;
                        tmplData.paymentMethod = info;
                        content += tmpls[info.config.tmpl](tmplData);
                    }

                }

                // Map Props
                if( hasPaymentInfo && fields.payment_info ){
                    fields.payment_info = wpalEcommFieldProps(fields.payment_info);
                }

                // Render Notices and Payment Info Scripts
                for ( var profileID in paymentInfo ) {
                    var info = paymentInfo[profileID];
                    // Notice Templates
                    if( info.config.hasOwnProperty('notice_tmpl') ){
                        var noticeData = info.config.notice_tmpl_data;
                        noticeData.I18n = I18n;
                        content += tmpls[info.config.notice_tmpl](noticeData);
                    }
                }

                // Render Template
                els.$accountInfo.insertAdjacentHTML('afterbegin',
                    tmpls.wpal_ecomm_payment_info({
                        I18n        : I18n,
                        className   : wrapClass,
                        legend      : I18n.titles.payment_info,
                        fields      : fields.payment_info,
                        content     : ( content > '' ) ? content : wpalEcommSprintF(I18n.sprintf.not_found_wrap,[
                            '', I18n.errors.no_saved_methods
                        ] )
                    })
                );

                // Map payment_info fields
                if( fields.payment_info ){
                    fields = wpalEcommMapFields(fields, 'payment_info', els.$accountInfo, '');
                }
            }
        },
        renderBillingFields : function (){

            var className = 'wpal-ecomm-billing-fields',
                legend = I18n.titles.billing;
            if( ! billingData ){
                fields.billing = wpalEcommFieldProps(fields.billing);
            }

            els.$accountInfo.insertAdjacentHTML('beforeend', tmpls.wpal_ecomm_billing_fields({
                className   : className,
                fields      : fields.billing,
                legend      : legend
            }));

            els.$billingFields = wpalEcommEl('.'+className, els.$accountInfo);
            fields = wpalEcommMapFields(fields, 'billing', els.$billingFields, '');

            // Current Values
            if( ! billingData ){
                setTimeout(function(){
                    billingData = thisMA.getBillingData(fields);
                }, 1000);
            }

            // Update
            thisMA.updateButton( function(e){
                thisMA.updateBilling();
            });
        },
        updateBilling : function (){

            if( thisMA.validateBilling() ){
                var updatedBilling = thisMA.getBillingData(fields);
                if( wpalEcommIsEqual( billingData, updatedBilling ) ){
                    thisMA.noChangeModal();
                }
                else{
                    if( ! contactData ){
                        contactData = wpalEcommSectionData( 'contact', fields );
                    }
                    var detailsData = wpalEcommExtend(contactData, updatedBilling),
                        confirmData = thisMA.detailsConfirmData(detailsData),
                        confirmCard = false;
                    wpalEcommConfirmModal(confirmData, tmpls, function(event){

                        // Build Details Data
                        detailsData.merchants = {};
                        for ( var profileID in paymentInfo ) {
                            if( paymentInfo[profileID].config.app.hasOwnProperty('getUpdateBillingData') ){
                                detailsData = paymentInfo[profileID].config.app.getUpdateBillingData(detailsData);
                                if( detailsData.merchants.hasOwnProperty(profileID) ){
                                    if( detailsData.merchants[profileID].hasOwnProperty('confirmCard') ){
                                        //todo will have to revist when introducing other merchants with cards
                                        confirmCard = detailsData.merchants[profileID].confirmCard;
                                    }
                                }
                            }
                        }

                        wpalEcommLoadingScreen( tmpls, I18n.loading.updating, function(){
                            if( hasPaymentInfo && confirmCard ){
                                paymentInfo[confirmCard].config.app.confirmCard( function(result){
                                    if( result ){
                                        // Update Payment Info
                                        paymentInfo[confirmCard].card.brand = result.brand.toUpperCase();
                                        paymentInfo[confirmCard].card.last4 = result.last4;
                                        paymentInfo[confirmCard].card.display = result.billing_details;
                                        paymentInfo[confirmCard].payment_method_id = result.payment_method_id;
                                        detailsData.merchants[confirmCard] = wpalEcommExtend(detailsData.merchants[confirmCard], result);
                                        thisMA.processUpdate('billing', detailsData, thisMA.updateBillingResponse);
                                    }
                                });
                            }
                            else{
                                thisMA.processUpdate('billing', detailsData, thisMA.updateBillingResponse);
                            }
                        });
                    });
                }
            }
        },
        updateBillingResponse : function (success, data){
            if( success ){
                //Update Billing Fields
                billingData = data.data.billing;
                for (var b in fields.billing) {
                    var field = fields.billing[b];
                    if( billingData.hasOwnProperty(field.name) ){
                        fields.billing[b].value = billingData[field.name];
                    }
                }
                fields.payment_info = data.data.payment_info;
                // Render View
                view = 'update_billing';
                thisMA.renderView(view);
            }
        },
        renderSubscriptionsTable : function (){

            var content = '';
            if ( subscriptionsTableData ){
                content = tmpls.wpal_ecomm_table(subscriptionsTableData);
            }
            els.$accountInfo.innerHTML = tmpls.wpal_ecomm_fieldset({
                className   : 'wpal-ecomm-account-subscriptions',
                legend      : I18n.titles.subscriptions,
                content     : ( content > '' ) ? content : wpalEcommSprintF(I18n.sprintf.not_found_wrap,[
                    '', I18n.errors.no_subscriptions
                ] ),
            });

        },
        renderOrdersTable : function (){

            var content = '';
            if ( ordersTableData ){
                content = tmpls.wpal_ecomm_table(ordersTableData);
            }
            els.$accountInfo.innerHTML = tmpls.wpal_ecomm_fieldset({
                className   : 'wpal-ecomm-account-orders',
                legend      : I18n.titles.orders,
                content     : ( content > '' ) ? content : wpalEcommSprintF(I18n.sprintf.not_found_wrap,[
                    '', I18n.errors.no_orders
                ] ),
            });

        },
        viewSubscription : function (id){

            var subscription = ( subscriptions && subscriptions[id] ) ? subscriptions[id] : false;
            if( subscription ){
                var itemTable = wpalEcommClone(itemsTableConfig),
                    totals = {
                        tax         : 0,
                        discount    : 0,
                        subtotal    : 0,
                        total       : 0
                    },
                    interval = subscription['subscription/interval'],
                    billInterval = subscription['subscription/bill/interval'];

                itemTable.rows = {};
                for (var i in subscription.items) {
                    var item = subscription.items[i];
                    if( item.type === 'subscription' && ! item.hasOwnProperty('interval') ){
                        subscription.items[i].interval = interval;
                        subscription.items[i].billInterval = billInterval;
                    }
                    totals.tax = (item.tax) ? ( totals.tax + item.tax ) : totals.tax;
                    totals.discount = (item.discount) ? ( totals.discount + item.discount ) : totals.discount;
                    totals.total = (item.total) ? ( totals.total + item.total ) : totals.total;
                    itemTable.rows[i] = thisMA.itemPriceDisplays(item, subscription.currency_symbol);
                }
                subscription.item_table = tmpls.wpal_ecomm_table(itemTable);
                subscription.totals = wpalEcommTotalsData(totals, I18n.totals);
                subscription.I18n = I18n;
                subscription.symbol = wpalEcommSymbol(subscription.currency);
                subscription = thisMA.countryName(subscription);
                subscription.billingPrefix = 'wpal-ecomm-billing';
                subscription.totalsPrefix = 'wpal-ecomm-order-totals';
                subscription.billingDetails = tmpls.wpal_ecomm_billing_details(subscription);
                subscription.orderTotals = tmpls.wpal_ecomm_order_totals(subscription);
                els.$accountInfo.innerHTML = tmpls.wpal_ecomm_account_subscription(subscription);
            }
            else{
                els.$accountInfo.innerHTML = wpalEcommSprintF(I18n.sprintf.not_found_wrap,[
                    '', wpalEcommSprintF(I18n.errors.subscription_not_found,[id])
                ]);
            }
        },
        viewOrder : function (id){

            var orderData = ( orders && orders[id] ) ? orders[id] : false;
            if(orderData){
                var itemTable = wpalEcommClone(itemsTableConfig);
                itemTable.rows = {};
                for (var i in orderData.items) {
                    var item = orderData.items[i];
                    itemTable.rows[i] = thisMA.itemPriceDisplays(item, orderData.currency_symbol);
                }
                orderData.item_table = tmpls.wpal_ecomm_table(itemTable);
                orderData.totals = wpalEcommTotalsData(orderData, I18n.totals);
                orderData.I18n = I18n;
                orderData.symbol = wpalEcommSymbol(orderData.currency);
                orderData = thisMA.countryName(orderData);
                orderData.billingPrefix = 'wpal-ecomm-billing';
                orderData.totalsPrefix = 'wpal-ecomm-order-totals';
                orderData.billingDetails = tmpls.wpal_ecomm_billing_details(orderData);
                orderData.orderTotals = tmpls.wpal_ecomm_order_totals(orderData);
                els.$accountInfo.innerHTML = tmpls.wpal_ecomm_account_order(orderData);
            }
            else{
                els.$accountInfo.innerHTML = wpalEcommSprintF(I18n.sprintf.not_found_wrap,[
                    '', wpalEcommSprintF(I18n.errors.order_not_found,[id])
                ]);
            }

        },
        renderPasswordUpdate : function (){

            els.$accountInfo.innerHTML = tmpls.wpal_ecomm_fieldset({
                className   : 'wpal-ecomm-account-password',
                legend      : I18n.titles.password_change,
                content     : tmpls.wpal_ecomm_account_password({
                    password1_label : I18n.titles.new_password,
                    password1_name  : 'account_password',
                    password2_label : I18n.titles.new_password,
                    password2_name  : 'account_password_repeat',
                })
            });

            // Password Show / Hide
            //wpalEcommPasswordToggle(els.$accountInfo, '.show-hide-password-icon');


        },
        validateBilling : function (){
            // TODO review other merchants
            var validBill = ( thisMA.validateForm( fields.billing, true ) < 1 );
            if( hasPaymentInfo ){
                var validInfo = ( thisMA.validateForm( fields.payment_info, true ) < 1 );
                return ( validBill && validInfo );
            }
            else{
                return validBill;
            }
        },
        getBillingData : function (fields){

            var bill = wpalEcommSectionData( 'billing', fields ),
                data;

            if( hasPaymentInfo ){
                var info = wpalEcommSectionData( 'payment_info', fields );
                data = wpalEcommExtend(bill, info);
                for ( var profileID in paymentInfo ) {
                    if( paymentInfo[profileID].config.app.hasOwnProperty('getPaymentID') ){
                        data = paymentInfo[profileID].config.app.getPaymentID(data);
                    }
                }
            }
            else{
                data = bill;
            }
            return data;
        },
        detailsConfirmData : function (data){
            data = thisMA.countryName(data);
            var content = '';
            if( hasPaymentInfo ){
                content = wpalEcommSprintF(I18n.sprintf.label_value,['Name on Card',data.name_on_card]);
            }
            content += tmpls.wpal_ecomm_billing_details(data);
            return {
                id : 'wpal-ecomm-confirm-billing-update',
                title : I18n.titles.update_billing,
                content : content
            };
        },
        itemPriceDisplays : function(item, symbol){

            var cost = item.price,
                costClassName = 'cost',
                discount = item.discount,
                total = item.total,
                interval = ( item.hasOwnProperty('interval') ) ? item.interval : '',
                billInterval = ( item.hasOwnProperty('billInterval') ) ? parseInt(item.billInterval) : 1,
                intervalText = '';
            costClassName += ( discount > 0 ) ? ' discounted' : costClassName;

            if( interval > '' ){
                intervalText += ' / ';
                if( billInterval > 1 ){
                    intervalText += billInterval + ' ' + wpal_ecomm_data.subscription_intervals_plural[interval];
                }
                else {
                    intervalText += interval;
                }
            }

            // Add Cost Detail
            item.cost_display = symbol + '<span class="'+costClassName+'">'+wpalEcommPrice(cost)+intervalText+'</span>';
            if( discount > 0 ){
                item.cost_display += '<span class="discounted-price">'+symbol + '<span class="cost">'+wpalEcommPrice(total)+intervalText+'</span>';
            }
            // Total
            item.total_display = symbol + '<span class="total">'+wpalEcommPrice(total)+'</span>';
            return item;
        },
        countryName : function( data ){
            var countryName  = wpalEcommCountryData(data.billing_country, 'text');
            data.countryName = countryName ? countryName : data.billing_country;
            return data;
        },
        updateButton : function ( callback ){
            // Submit Button
            els.$updateButton = wpalCreateEl('button', els.$accountInfo, [
                { prop : 'class', value : 'wpal-ecomm-update' },
                { prop : 'type', value : 'submit' },
                { prop : 'value', value : 'Update' },
            ] );
            els.$updateButton.innerHTML = I18n.titles.update_button;
            els.$updateButton.onclick = function(e){
                e.preventDefault();
                callback(e);
            };
        },
        validateForm : function ( form, displayErrors ){
            var errors = 0;
            for ( var f in form ) {
                var field = form[f];
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
            return (errors > 0) ? 1 : 0;
        },
        noChangeModal : function (){
            wpalEcommRenderModal({
                id      : 'wpal-ecomm-notice',
                title   : I18n.titles.no_change_title,
                content : I18n.titles.no_change_content
            }, tmpls );
        },
        cancelConfirmation : function (id){

            var subscription = ( subscriptions && subscriptions[id] ) ? subscriptions[id] : false,
                content = wpalEcommSprintF(I18n.sprintf.confirm_cancel,[ subscription['subscription/name'] ]);
                content += '<div class="wpal-ecomm-field" data-field="cancellation_reason">';
                content += '<label>'+I18n.titles.cancel_reason_label+'</label>';
                content += '<textarea placeholder="'+I18n.titles.cancel_reason_placeholder+'"></textarea>';
                content += '</div>';
            wpalEcommConfirmModal({
                id          : 'wpal-ecomm-cancel-subscription-modal',
                title       : I18n.titles.cancel_confirm,
                content     : content
            }, tmpls, function(event){
                var $reason = $doc.querySelector('[data-field="cancellation_reason"] textarea'),
                    reason = $reason.value;
                wpalEcommLoadingScreen(tmpls, I18n.loading.updating, function(){
                    thisMA.processUpdate('subscription', {
                        order_id        : id,
                        subscription_id : subscription.subscription_id,
                        operation       : 'cancel',
                        reason          : reason
                    }, function(success, data){
                        if( success ){
                            window.location.href = baseURL + 'subscriptions/' + id;
                        }
                    });
                });
            });
        },
        processUpdate : function ( type, data, processCallBack ){
            wpalEcommPost( {
                action  : 'wpal_ecomm_account_update',
                update  : type,
                user_id : wpalUserID,
                details : JSON.stringify( data )
            }, function( response ){

                wpalEcommRemoveLoadingScreen();

                var success = ( response.success ) ? true : false,
                    data = ( response.data ) ? response.data : {};
                if( data.notice ){
                    setTimeout(function () {
                        if( processCallBack ){
                            wpalEcommRenderModal(data.notice, tmpls, function(){
                                processCallBack( success, data );
                            });
                        }
                        else {
                            wpalEcommRenderModal(data.notice, tmpls);
                        }
                    }, 500);
                }
                else if( processCallBack ){
                    processCallBack( success, data );
                }

            });
        },
    };
};