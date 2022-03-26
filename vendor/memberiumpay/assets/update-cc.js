'use strict';
var wpalEcommUpdateCCMerchants = [];
var wpalEcommUpdateCC = function (shortCodeData) {
    var forms = {};
    for ( var d in shortCodeData ) {
        forms[d] = wpalEcommUpdateCCForm(shortCodeData[d]);
        forms[d].init();
    }
};

var wpalEcommUpdateCCForm = function (data) {

    var thisCC,
        form_id = data.form_id,
        I18n = data.I18n,
        tmpls = {},
        fields = data.fields,
        billingData = false,
        paymentInfo = ( data.payment_info ) ? data.payment_info : false,
        customerID = data.customer_id,
        merchantConfig = data.config,
        contactData = data.contact,
        requiresCardInfo = false,
        els = {
            $form           :   false,
            $content        :   false,
            $cardFieldset   :   false,
            $billingFields  :   false,
            $addressCheck   :   false,
            $cardWrap       :   false,
            $updateButton   :   false,
            $loader         :   false,
        };

    return {
        init : function (){

            thisCC = this;
            els.$form = wpalEcommEl('.wpal-ecomm-update-cc[data-form-id="'+form_id+'"]', document);

            if( ! els.$form ){
                return false;
            }

            els.$content = wpalEcommEl('.wpal-ecomm-update-cc-content', els.$form);

            if( paymentInfo > '' ){
                // Check Card Details
                for ( var profileID in paymentInfo ) {
                    if(paymentInfo[profileID].card){
                        requiresCardInfo = true;
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

            thisCC.renderform();

        },
        renderform : function (){

            var wrapClass = 'wpal-ecomm-update-payment-info',
                content = '',
                currentCardDesc = '',
                canUpdate = false;

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
                    if( parseInt(info.config.can_update) > 0 ){
                        canUpdate = true;
                    }
                }

                // Map Props
                if( requiresCardInfo && fields.payment_info ){
                    fields.payment_info = wpalEcommFieldProps(fields.payment_info);
                }

                // Render Notices
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
                els.$content.insertAdjacentHTML('afterbegin',
                    tmpls.wpal_ecomm_payment_info({
                        I18n        : I18n,
                        className   : wrapClass,
                        legend      : I18n.titles.payment_info,
                        fields      : ( requiresCardInfo && fields.payment_info ) ? fields.payment_info : [],
                        content     : content
                    })
                );

                // Map payment_info fields
                if( fields.payment_info ){
                    fields = wpalEcommMapFields(fields, 'payment_info', els.$content, '');
                }

                if( canUpdate ){
                    // Billing Address Toggle
                    els.$cardFieldset = wpalEcommEl('.' + wrapClass, els.$content);
                    thisCC.renderAddressToggle(els.$cardFieldset);
                }

                // Init Payment Info Scripts
                for ( var profileID in paymentInfo ) {
                    var info = paymentInfo[profileID],
                        invoiceData = info.invoice_table;

                    if( invoiceData > '' ){
                        var pastDueLegend = I18n.titles.past_due,
                            pastDueFooter = '';
                        if( info.config.hasOwnProperty('past_due_legend') ){
                            pastDueLegend = I18n.titles[info.config.past_due_legend];
                        }
                        if( info.config.hasOwnProperty('past_due_footer') ){
                            pastDueFooter = info.config.past_due_footer;
                        }
                        // Invoice Table
                        thisCC.renderInvoiceTable(els.$content, invoiceData, pastDueLegend, pastDueFooter);
                    }

                    // Load Supporting Account Script
                    if( info.config.script > '' ){
                        if( ! info.config.hasOwnProperty('loaded') ){
                            wpalLoadScript( info.config.script, function( loopID ){
                                paymentInfo[loopID].config.loaded = 1;
                                paymentInfo[loopID].config.app = window[paymentInfo[loopID].config.function_name](paymentInfo[loopID], thisCC);
                                paymentInfo[loopID].config.app.init(els.$content);
                            }, profileID );
                        }
                        else{
                            paymentInfo[profileID].config.app.init();
                        }
                    }
                    // Merchant doesn't require script
                    else {
                        paymentInfo[profileID].config.app = {};
                    }
                }

                if( canUpdate ){

                    // Update Button
                    thisCC.updateButton( function(e){
                        setTimeout(function () {
                            var validForm = thisCC.validateForm();
                            if( validForm < 1 ){
                                thisCC.confirmUpdate();
                            }
                        }, 250 );
                    });

                }

                wpalEcommDispatchEvent( 'wpal-ecomm-update-cc-rendered', {
                    form_id : form_id
                } );

            }
            else {
                console.log({
                    func:'renderform',
                    msg:'No Payment Method On File'
                });
            }
        },
        renderAddressToggle : function ( $parent ){
            var name = 'update_cc_address-'+form_id,
                props = [
                    { prop : 'id', value : name },
                    { prop : 'class', value : 'wpal-ecomm-update-cc-address-toggle' },
                    { prop : 'type', value : 'checkbox' },
                    { prop : 'name', value : name },
                    { prop : 'value', value : 1 }
                ],
                $fieldWrap = wpalCreateEl('div', $parent, [
                    { prop : 'class', value : 'wpal-ecomm-field' },
                    { prop : 'data-field', value : 'update_cc_address' }
                ] );
                els.$addressCheck = wpalCreateEl('input', $fieldWrap, props );
                var $label = wpalCreateEl('label', $fieldWrap, [
                    { prop : 'for', value : name },
                ] ).innerHTML = I18n.titles.update_address;

            els.$addressCheck.addEventListener('change', thisCC.toggleBillingFields);
        },
        renderBillingFields : function (){

            var className = 'wpal-ecomm-billing-fields',
                legend = I18n.titles.billing_legend;

            fields.billing = wpalEcommFieldProps(fields.billing);
            els.$cardFieldset.insertAdjacentHTML('afterend', tmpls.wpal_ecomm_billing_fields({
                className   : className,
                fields      : fields.billing,
                legend      : legend
            }));

            els.$billingFields = wpalEcommEl('.'+className, els.$content);
            fields = wpalEcommMapFields(fields, 'billing', els.$billingFields, '');

            // Initialize Country Region Selectors
            wpalCountryRegions.initView('update-cc', els.$form);

        },
        renderInvoiceTable : function ( $parent, invoiceData, legend, footer ){

            if( invoiceData ){
                $parent.insertAdjacentHTML('beforeend',
                    tmpls.wpal_ecomm_fieldset({
                        className   : 'wpal-ecomm-update-cc-invoices',
                        legend      : legend,
                        content     : tmpls.wpal_ecomm_table(invoiceData) + footer,
                    })
                );
            }
        },
        updateButton : function ( callback ){
            // Submit Button
            els.$updateButton = wpalCreateEl('button', els.$content, [
                { prop : 'class', value : 'wpal-ecomm-update' },
                { prop : 'type', value : 'submit' },
                { prop : 'value', value : 'Update' },
            ] );
            els.$updateButton.innerHTML = I18n.titles.update_button;
            els.$updateButton.onclick = function(e){
                e.preventDefault();
                callback(e);
                return false;
            };
        },
        toggleBillingFields : function (e){
            if( e.target.checked ){
                if( ! els.$billingFields ){
                    thisCC.renderBillingFields();
                }
                else{
                    els.$billingFields.style.display = 'block';
                }
            }
            else{
                els.$billingFields.style.display = 'none';
            }
        },
        validateForm : function (){

            var errors = 0,
                invalidCard = false;
            if( requiresCardInfo ){
                for ( var profileID in paymentInfo ) {
                    if( paymentInfo[profileID].config.app.hasOwnProperty('checkCardInvalid') ){
                        invalidCard = paymentInfo[profileID].config.app.checkCardInvalid(true);
                    }
                }
            }
            for ( var sections in fields ) {
                var section = fields[sections];
                if( ! els.$addressCheck.checked && sections === 'billing'){
                    //Skip
                }
                else{
                    for ( var f in section ) {
                        var field = section[f];
                        field.error = wpalEcommValidateField(field);
                        if( field.error ){
                            if( errors < 1 ){
                                errors = 0;
                                wpalEcommManageValidation(field);
                                field.$wrap.scrollIntoView({behavior: 'smooth'});
                            }
                            errors ++;
                        }
                    }
                }
            }
            if( invalidCard > '' ){
                errors ++;
            }
            return (errors > 0) ? 1 : 0;
        },
        confirmUpdate : function (){
            var ccDetails = thisCC.getBillingData(),
                confirmData = thisCC.detailsConfirmData(ccDetails);
            wpalEcommConfirmModal(confirmData, tmpls, function(event){
                wpalEcommLoadingScreen( tmpls, I18n.loading.updating, function(){
                    var confirmCard = false,
                        processData = {
                            success_keys                : data.success_keys,
                            failure_keys                : data.failure_keys,
                            redirect                    : data.redirect,
                        };

                    // Build Details Data
                    processData.merchants = {};
                    for ( var profileID in paymentInfo ) {
                        if( paymentInfo[profileID].config.app.hasOwnProperty('getUpdateBillingData') ){
                            processData = paymentInfo[profileID].config.app.getUpdateBillingData(processData);
                            if( processData.merchants.hasOwnProperty(profileID) ){
                                if( processData.merchants[profileID].hasOwnProperty('confirmCard') ){
                                    //todo will have to revist when introducing other merchants with cards
                                    confirmCard = processData.merchants[profileID].confirmCard;
                                }
                            }
                        }
                    }

                    if( confirmCard ){
                        paymentInfo[confirmCard].config.app.confirmCard( function(response){
                            processData.updated = ( response ) ? 1 : 0;
                            // Process Update
                            if( response ){
                                processData.merchants[confirmCard].payment_method_id = response.payment_method_id;
                                //processData.payment_method_id = response.payment_method_id;
                                processData.merchants[confirmCard].name_on_card = response.name_on_card;
                                //processData.name_on_card = response.name_on_card;
                                processData.merchants[confirmCard].brand = response.brand;
                                //processData.brand = response.brand;
                                processData.merchants[confirmCard].last4 = response.last4;
                                //processData.last4 = response.last4;
                                processData.updated_profile_id = confirmCard;
                                if( paymentInfo[confirmCard].invoice_table > '' ){
                                    processData.merchants[confirmCard].invoices = paymentInfo[confirmCard].invoice_table.rows;
                                }
                                if( els.$addressCheck.checked ){
                                    processData.billing = ccDetails.bill;
                                }
                                thisCC.processUpdate(processData);
                            }
                            // Apply Failure Keys Only
                            else if( response.failure_keys > '' ){
                                thisCC.processUpdate(processData);
                            }
                        });
                    }
                });
            });
        },
        detailsConfirmData : function (ccDetails){
            var content = wpalEcommSprintF(I18n.sprintf.confirm_content,[ccDetails.payment_info.name_on_card]);
            if( els.$addressCheck.checked ){
                var country = ccDetails.bill.billing_country,
                    name = wpalEcommCountryData(country, 'text');
                ccDetails.bill.countryName = name ? name : country;
                content += tmpls.wpal_ecomm_billing_details(ccDetails.bill);
            }
            return {
                id      : 'wpal-ecomm-confirm-update-cc',
                title   : I18n.titles.confirm_title,
                content : content
            };
        },
        processUpdate : function ( processData ){
            wpalEcommPost( {
                action          : 'wpal_ecomm_update_cc',
                user_id         : wpalUserID,
                details         : JSON.stringify( processData ),
            }, function( response ){
                wpalEcommRemoveLoadingScreen();
                var success = ( response.success ),
                    responseData = ( response.data ) ? response.data : {};
                if( responseData.notice ){
                    setTimeout(function () {
                        wpalEcommRenderModal(responseData.notice, tmpls, function(){
                            if( success ){
                                var redirect = responseData.hasOwnProperty('redirect') ? responseData.redirect : '';
                                if( redirect > '' ){
                                    window.location.href = redirect;
                                }
                            }
                            else if( responseData.hasOwnProperty('refresh') ){
                                location.reload();
                            }
                        });
                    }, 500);
                }
            } );
        },
        loadMerchant : function (merchant, callback){

            if( merchant === 'stripe' ){
                if( wpalEcommUpdateCCMerchants.includes(merchant) ){
                    callback(true);
                }
                else{
                    wpalLoadScript('https://js.stripe.com/v3/', function(){
                        wpalEcommUpdateCCMerchants.push(merchant);
                        callback(true);
                    });
                }
                return;
            }
        },
        getBillingData : function (){

            var data = { bill : {} };
            if( els.$addressCheck.checked ){
                data.bill = wpalEcommSectionData( 'billing', fields );
            }
            else{
                data.bill = contactData.bill;
            }

            // Check connected Merchant for Postal Code ( Stripe Card )
            for ( var profileID in paymentInfo ) {
                if( paymentInfo[profileID].config.app.hasOwnProperty('getPostalCode') ){
                    data = paymentInfo[profileID].config.app.getPostalCode(data);
                }
            }
            data.billing_email = contactData.billing_email;
            if( fields.payment_info ){
                data.payment_info = wpalEcommSectionData( 'payment_info', fields );
            }
            return data;
        },
        getI18n : function (){
            return I18n;
        },
        getTmpls : function (){
            return tmpls;
        },
        getFields : function (){
            return fields;
        },
        getEl : function ( prop ){
            if( prop > '' ){
                if( els.hasOwnProperty(prop) ){
                    return els[prop];
                }
            }
            return false;
        }
    }
};