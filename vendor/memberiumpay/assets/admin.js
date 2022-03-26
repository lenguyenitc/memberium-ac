//App reference
var wpalEcomm,
wpalProcess = false,
runStatusFilter = true,
curPage,
wpalSaveError = false,
$wpalWrap = null;

(function( $ ) {
	'use strict';

	$(function() {

		wpalEcomm = wpAdminTemplater(wpal_ecomm_data);
		curPage = wpalEcomm.page;
		$wpalWrap = document.getElementById('wpwrap');
		if( wpal_ecomm_data.hasOwnProperty('save_error')){
			wpalSaveError = {
				params : wpal_ecomm_data.save_error,
				$wrap : document.getElementById('post')
 			};
		}

		wpalEcomm.registerFilters( 'location_reload', function( data ){
			location.reload();
		});

		if( wpal_ecomm_data.hasOwnProperty('settings_screen') ){

			wpalEcomm.registerFilters( 'add_payment_profile', function( data ){
				if( data.tab > '' ){
					window.location.href = wpal_ecomm_data.screenUri + '&tab=' + data.tab;
				}
			});

			wpalEcomm.registerFilters( 'delete_payment_profile', function( data ){
				window.location.href = wpal_ecomm_data.screenUri;
			});

			wpalEcomm.registerFilters( 'generate_webhook_key', function( $el ){
				$el.onclick = function(e){
					wpalEcommGetWebhookKey($el, e);
				};
			});

			wpalEcomm.registerFilters( 'generate_sandbox_webhook_key', function( $el ){
				$el.onclick = function(e){
					wpalEcommGetWebhookKey($el, e);
				};
			});

			//Init
			wpalEcomm.init();
			if(wpalSaveError){
				wpalEcomm.renderNotice(wpalSaveError.params, wpalSaveError.$wrap);
			}
		}
		else if( curPage === 'wpal_ecomm_products' ){

			var currencyData = wpal_ecomm_data.currency_data,
				timezoneData = wpal_ecomm_data.timezone_data,
				dateSettings = { year: "numeric", month: "long", day: "numeric", timeZone: timezoneData.zone },
				bulkCancelData = {},
				$publish = $doc.getElementById('publish');
			if( wpal_ecomm_data.hasOwnProperty('bulk_cancel_data') ){
				bulkCancelData = wpal_ecomm_data.bulk_cancel_data;
			}

			// Detect Open Plans on Publish
			$publish.addEventListener("click", function(e) {
				var inlineEdits = $doc.querySelectorAll('.inline-edit-row'),
					planLength = inlineEdits.length;
				if( planLength > 0 ){
					e.preventDefault();
					if( planLength > 1 ){
						alert( wpalEcomm.I18n.save_plans );
					}
					else{
						inlineEdits[0].querySelector('.inline-edit-save .button.save').click();
						setTimeout(function(){
							$publish.click();
						}, 500);
					}
					return false;
				}
			});

			// Plans
			wpalEcomm.registerFilters( 'init_add_new_plan', function( $section ){
				var $legend = $section.previousElementSibling;
				$legend.insertAdjacentHTML('beforeend', wpAdminTmpls.button( {
					label :  wpalEcomm.I18n.add_new_plan,
					attrs : [
						{ prop: 'id', value : 'wpal_ecomm_product_plans-toggle' },
						{ prop: 'class', value : 'button button-add-new button-primary' },
					]
				} ) );
			});

			// Product Plans Filter
			wpalEcomm.registerFilters( 'wpal_ecomm_product_plans_table', function( tableData ){
				var I18n = wpalEcomm.I18n;
				_.each( tableData.rows, function( row, r ) {
					// Price Per Text
					var currency = row.currency.toUpperCase(),
						symbol = currencyData[currency].symbol,
						details = wpatSprintF(I18n.price_plan_per,[
							symbol,
							row.amount,
							currency,
							row.interval
						]);
					details += ' ';
					// End Type
					switch (row.end) {
						case 'count':
							var count = parseInt(row.count),
								s = ( count > 1 ) ? 's' : '';
							details += wpatSprintF(I18n.price_plan_end_count,[count,row.interval,s]);
							break;
						case 'date':
							var d = new Date(row.date);
							details += wpatSprintF(I18n.price_plan_end_date,[d.toDateString()]);
							break;
						case 'infinite':
							details += I18n.price_plan_end_infinite;
							break;
						default:
					}
					// Offers Trial
					var trial = parseInt(row.trial),
						trialDays = parseInt(row.trial_days);
					if( trial > 0 && trialDays > 0 ){
						details += '</br>';
						var plural = ( trialDays > 1 ) ? 's' : '';
						details += wpatSprintF(I18n.price_plan_trial,[trialDays,plural]);
					}
					if( row.description > '' ){
						details += ' </br>' + row.description;
					}
					// Details
					tableData.rows[r].plan_id = row.id;
					tableData.rows[r].plan_name = row.name;
					tableData.rows[r].plan_description = row.description;
					// Pricing
					tableData.rows[r].plan_currency = row.currency;
					tableData.rows[r].plan_end = row.end;
					tableData.rows[r].interval_amount = row.amount;
					tableData.rows[r].interval_count = row.count;
					tableData.rows[r].interval_date = row.date;
					tableData.rows[r].plan_details = details;
				});
				return tableData;
			});

			// Price Plan Billing Interval On Render
			wpalEcomm.registerFilters( 'billing_interval_render', function( $el ){
				wpalEcommBillingInterval($el);
			});

			// Price Plan Billing Interval On Change
			wpalEcomm.registerFilters( 'billing_interval_change', function( $el ){
				wpalEcommBillingInterval($el);
			});

			wpalEcomm.registerFilters( 'bill_interval_listener', function( $el ){

				$el.addEventListener('keyup', function(e){
					var key = e.key,
						$thisEl = e.target,
						numVal = $thisEl.value,
						check1 = ( key.length === 1 && !wpalEcommNumbersOnly('0123456789', key) ),
						check2 = ( key === '.' && wpalEcommNumbersOnly(numVal, '.') ),
						invalidkey = ( check1 || check2 );
					if( invalidkey ){
						e.preventDefault();
					}
					else{
						if( $thisEl.hasAttribute('max') ){
							var max = parseInt($thisEl.getAttribute('max'));
							if( parseInt(numVal) > max ){
								e.preventDefault();
								$thisEl.value = max;
							}
						}
					}
				});
			});

			var wpalEcommNumbersOnly = function(stringValue, charValue){
				return stringValue.indexOf(charValue) > -1;
			};

			// Edit Plan Template Data Filter
			wpalEcomm.registerFilters( 'wpal_ecomm_product_plans_edit', function(data, rowData, tableData){

				var merchantIds = rowData.merchant_ids,
					planId = rowData.id;
				// Uneditable settings
				if( merchantIds > '' ){
					var I18n = wpalEcomm.I18n,
						selectedCurrency = rowData.plan_currency.toUpperCase(),
						endType = rowData.plan_end,
						choices = wpal_ecomm_data.choices,
						currencyData = wpal_ecomm_data.currency_data,
						lockedWrap = I18n.locked_wrapper;
					data.className += ' locked-plan';
					data.confirm = 'wpal_ecomm_product_plans_bulk_edit_confirm';
					_.each( data.settings, function( setting, s ) {
						var slug = setting.slug,
							content = data.settings[s].content;
						if( slug === 'wpal_ecomm_product_plans-section-pricing' ){
							data.settings[s].desc = wpatSprintF(I18n.section_desc, [I18n.locked_plan]);
						}
						else if( slug === 'plan_currency' ){
							var currencyText = wpalEcommDataText(choices.currencies,rowData[slug]);
							data.settings[s].content = wpatSprintF(lockedWrap, [content, currencyText]);
						}
						else if( slug === 'interval' ){
							var intervalText = wpalEcommDataText(choices.subscription_intervals,rowData[slug]);
							data.settings[s].content = wpatSprintF(lockedWrap, [content, intervalText]);
						}
						else if( slug === 'bill_interval' ){
							var intervalBillCount = ( rowData[slug] ) ? rowData[slug] : 1;
							data.settings[s].content = wpatSprintF(lockedWrap, [content, intervalBillCount]);
						}
						else if( slug === 'interval_amount' ){
							var display = currencyData[selectedCurrency].symbol + rowData[slug];
							data.settings[s].content = wpatSprintF(lockedWrap, [content, display]);
						}
						else if( slug === 'plan_end' ){
							var endText = wpalEcommDataText(choices.subscription_ends,rowData[slug]);
							data.settings[s].content = wpatSprintF(lockedWrap, [content, endText]);
						}
						else if( slug === 'interval_count' && endType === 'count' ){
							data.settings[s].content = wpatSprintF(lockedWrap, [content, rowData[slug]]);
						}
						else if( slug === 'interval_date' && endType === 'date' ){
							data.settings[s].content = wpatSprintF(lockedWrap, [content, rowData[slug]]);
						}
						if( slug === 'wpal_ecomm_product_plans-section-trial' ){
							data.settings[s].desc = wpatSprintF(I18n.section_desc, [I18n.locked_plan_trial]);
						}
						else if( slug === 'trial' ){
							data.settings[s].content = data.settings[s].content.replace( /input/g, "input disabled='disabled'" );
						}
						else if( slug === 'trial_days' ){
							data.settings[s].content = wpatSprintF(lockedWrap, [content, rowData[slug]]);
						}
					});
				}

				if( bulkCancelData.hasOwnProperty(planId) ){
					data.className += ' cancel-in-progress';
					_.each( data.settings, function( setting, s ) {
						var slug = setting.slug,
							content = data.settings[s].content;
						if( slug === 'wpal_ecomm_product_plans-section-bulk-cancel' ){
							var d = wpatTimestampArray( bulkCancelData[planId] ),
								humanDate = wpalEcommHumanDate(d.year + '-' + d.month + '-' + d.day),
								cancelDecs = wpatSprintF(I18n.bulk_cancel_in_progress, [humanDate] );
							data.settings[s].desc = wpatSprintF(I18n.section_desc, [cancelDecs]);
						}
					});
				}

				return data;
			});

			var wpalEcommHumanDate = function( dateString ){
				var parts = dateString.split('-'),
					monthIndex = parseInt(parts[1]) - 1,
					months = ['January','February','March','April','May','June','July','August','September','October','November','December'],
					month = months[monthIndex];
				 return month + ' ' + parts[2] + ' ' + parts[0];
			};

			// Bulk Edit Confirmation
			wpalEcomm.registerFilters( 'wpal_ecomm_product_plans_bulk_edit_confirm', function(formData, tableData){
				if( parseInt(formData.bulk_cancel) > 0 ){
					var planName = formData.plan_name,
						productName = document.querySelector('#titlewrap input#title[name="post_title"]').value,
						dateString = formData.bulk_cancel_date,
						humanDate = wpalEcommHumanDate(dateString),
						confirmed = confirm(wpatSprintF(wpalEcomm.I18n.confirm_bulk_cancel, [productName, planName, humanDate]));
					if(confirmed){
						var parts = dateString.split('-'),
							month = parseInt(parts[1]) - 1,
							year = parseInt(parts[0]),
							day = parseInt(parts[2]),
							utc = new Date(Date.UTC(year, month, day)),
							timestamp = utc.getTime() / 1000;
						if( timezoneData.sign === '-' ){
							timestamp = ( timestamp + timezoneData.value );
						}
						else{
							timestamp = ( timestamp - timezoneData.value );
						}
						bulkCancelData[formData.plan_id] = timestamp;
						return true;
					}
					else{
						return false;
					}
				}
				else{
					return true;
				}
			});

			// Update Price Plan Billing Interval Text and Max Numbers
			var wpalEcommBillingInterval = function wpalEcommBillingInterval($el){
				var $section = wpalEcommSection($el),
					interval = $el.value,
					titles = $section.querySelectorAll('span.interval-amount-text'),
					$intervalBillCount = $section.querySelector('#bill_interval'),
					currentCount = parseInt($intervalBillCount.value),
					max = wpal_ecomm_data.bill_interval_max;
				for ( var i = 0; i < titles.length; ++i) {
					titles[i].innerHTML = interval;
				}

				$intervalBillCount.setAttribute('max', max[interval]);
				if( currentCount > max[interval] ){
					$intervalBillCount.value = max[interval];
				}

			};

			// Price Plan Ends On Render
			wpalEcomm.registerFilters( 'plan_ends_render', function( $el ){
				wpalEcommPlanEnd($el);
			});

			// Price Plan Ends On Change
			wpalEcomm.registerFilters( 'plan_ends_change', function( $el ){
				wpalEcommPlanEnd($el);
			});

			// Maintain data-end-type attribute
			var wpalEcommPlanEnd = function wpalEcommPlanEnd($el){
				var $section = wpalEcommSection($el);
				$section.setAttribute('data-end-type', $el.value);
			};

			// Find Parent Wrapper Add New or Edit
			var wpalEcommSection = function wpalEcommSection($el){
				var $section = $el.closest('.wpat_quick_edit_form');
				if( ! $section ){
					$section = $el.closest('section.wpat_section');
				}
				return $section;
			};

			// Init
			wpalEcomm.init();
			if(wpalSaveError){
				wpalEcomm.renderNotice(wpalSaveError.params, wpalSaveError.$wrap);
			}

			// Set Elements and Vars
			var $configTable = document.getElementById('product-config-table'),
				$typeSelectWrap = document.getElementById('product-type-select-wrap'),
				$label = $typeSelectWrap.querySelector('label[for="product-type-select"]'),
				$labelText = $label.querySelector('.wpat-label-text'),
				$typeSelect = null,
				productTypeIndex = wpatIndexOf(wpal_ecomm_data.settings, 'slug', "product_type"),
				productSetting = wpal_ecomm_data.settings[productTypeIndex],
				productSettingChangeFunc = productSetting.change,
				productType = productSetting.value,
				proDialog = false,
				$proDialog = null;


			// Add Select
			wpalEcomm.registerFilters( productSettingChangeFunc, function( $el ){
				var changeEvent = $el.getAttribute('data-change'),
					productType = $el.value;
				if( changeEvent === 'product_type_onchange' ){
					$configTable.setAttribute('data-product-type',productType);
					if( productType === 'subscription' ){
						if(wpalEcomm.tab === 'pricing'){
							var $tab = $configTable.querySelector('.subscriptions_tab a').click();
						}
					}
					else if( productType === 'single' ){
						if(wpalEcomm.tab === 'subscriptions'){
							$configTable.querySelector('.pricing_tab a').click();
						}
					}
				}
				else {
					if( productType === 'subscription' ){
						// Force Settings to Single
						$configTable.setAttribute('data-product-type','single');
						jQuery($el).val('single').trigger('change.wpalSelect2');
						if( ! proDialog ){
							var dialogIndex = wpatIndexOf(wpal_ecomm_data.settings, 'slug', "pro_product_type_dialog"),
								dialogSetting = wpal_ecomm_data.settings[dialogIndex];
							document.body.insertAdjacentHTML('beforeend',wpatSetting( dialogSetting ));
							$proDialog = document.getElementById('wpat_dialog');
							proDialog = new window.A11yDialog($proDialog, $wpalWrap);
						}
						proDialog.show();
					}
				}
			});

			$label.insertAdjacentHTML('beforeend', wpatSetting(productSetting) );
			wpalEcomm.initTmpls($typeSelectWrap);
		}
		//todo dynamic wpal_ecomm prefix
		else if( curPage === 'wpal_ecomm_forms' ){

			// Common Vars
			var orderFormConfig = {
				$table			: null,
				$type			: null,
				$currency		: null,
				$products		: null,
				$merchants		: null,
				$pricePlans		: null,
				$proDialog		: null,
				proDialog		: false
			},
			orderTypeIndex = wpatIndexOf(wpal_ecomm_data.settings, 'slug', "order_form_type"),
			orderTypeSetting = wpal_ecomm_data.settings[orderTypeIndex],
			orderTypeChangeFunc = orderTypeSetting.change;

			// Initial Load Section Render
			wpalEcomm.registerFilters('order_form_config_render', function($el){
				orderFormConfig.$table = $doc.querySelector('#order-form-config-table');
				orderFormConfig.$type = $el.querySelector('#order_form_type');
				orderFormConfig.$currency = $el.querySelector('#order_form_currency');
				orderFormConfig.$products = $el.querySelector('#order_form_products');
				orderFormConfig.$merchants = $el.querySelector('#order_form_merchants');
				orderFormConfig.$pricePlans = $el.querySelector('#order_form_pricing_plans');
				orderFormConfig.$table.setAttribute('data-order-form-type',orderFormConfig.$type.value);
				wpalEcommUpdateOptions();
			});
			// Type Change
			wpalEcomm.registerFilters(orderTypeChangeFunc, function( $el ){
				var changeEvent = $el.getAttribute('data-change'),
					productType = $el.value;
				if( changeEvent === 'order_form_type_change' ){
					orderFormConfig.$table.setAttribute('data-order-form-type',productType);
					wpalEcommUpdateOptions();
				}
				else {
					if( productType === 'subscription' ){
						// Force Settings to Single
						orderFormConfig.$table.setAttribute('data-product-type','single');
						jQuery($el).val('single').trigger('change.wpalSelect2');
						if( ! orderFormConfig.proDialog ){
							var dialogIndex = wpatIndexOf(wpal_ecomm_data.settings, 'slug', "pro_product_type_dialog"),
								dialogSetting = wpal_ecomm_data.settings[dialogIndex];
							document.body.insertAdjacentHTML('beforeend',wpatSetting( dialogSetting ));
							orderFormConfig.$proDialog = document.getElementById('wpat_dialog');
							orderFormConfig.proDialog = new window.A11yDialog(orderFormConfig.$proDialog, $wpalWrap);
						}
						orderFormConfig.proDialog.show();
						wpalEcommUpdateOptions();
					}
				}
			});
			// Currency Change
			wpalEcomm.registerFilters('order_form_currency_change', function( $el ){
				wpalEcommUpdateOptions();
			});
			// Product Change
			wpalEcomm.registerFilters('order_form_product_change', function( $el ){
				wpalEcommUpdateOptions();
			});

			// Update Profiles and Product Options
			var wpalEcommUpdateOptions = function wpalEcommUpdateOptions(){
				wpatRequest('POST', {
					action	 	: 'wpal_ecomm_order_form_admin_data',
					currency 	: orderFormConfig.$currency.value,
					type	 	: orderFormConfig.$type.value,
					product_id  : orderFormConfig.$products.value
				}, function(response){
					var success = response.success,
						data = ( response.data ) ? response.data : {};
					wpatInitSelect( orderFormConfig.$merchants, {data:data.merchants}, wpalEcomm );
					wpatInitSelect( orderFormConfig.$products, {data:data.products}, wpalEcomm );
					wpatInitSelect( orderFormConfig.$pricePlans, {data:data.price_plans}, wpalEcomm );

				});
			};

			// Thank You On Render
			wpalEcomm.registerFilters( 'render_thankyou_panel', function( $section ){
				var $panel = document.getElementById('thank-you_options_data');
				$panel.setAttribute('data-thankyou', wpal_ecomm_data.thankyou);
			});
			// Thank You On Change
			wpalEcomm.registerFilters( 'toggle_thankyou_type', function( $el ){
				var $panel = document.getElementById('thank-you_options_data');
				$panel.setAttribute('data-thankyou', $el.value);
			});
			// Init
			wpalEcomm.init();
			if(wpalSaveError){
				wpalEcomm.renderNotice(wpalSaveError.params, wpalSaveError.$wrap);
			}
		}
		//todo dynamic wpal_ecomm prefix
		else if( curPage === 'wpal_ecomm_orders' ){

			var currencySymbol = wpal_ecomm_data.order_currency,
				newOrder = ( wpal_ecomm_data.new_order ) ? parseInt(wpal_ecomm_data.new_order) : 0,
				orderData = ( wpal_ecomm_data.meta_data ) ? wpal_ecomm_data.meta_data : {},
				currentStatus = wpal_ecomm_data.status,
				orderType = wpal_ecomm_data.order_type,
				sandbox = wpal_ecomm_data.sandbox,
				canCancel = wpal_ecomm_data.can_cancel;

			// Customer Details Change
			wpalEcomm.registerFilters( 'wpal_ecomm_order_customer_change', function( $select ){
				var customer_id = $select.value;
			});

			wpalEcomm.registerFilters( 'wpal_ecomm_status_render', function( $input ){
				var buttonData = wpal_ecomm_data.wpat_buttons.save,
					$label = $input.closest('label'),
					renderButton = false;
				if( currentStatus === 'active' || currentStatus === 'trial' || currentStatus === 'past_due' ){
					if(canCancel){
						if( orderType === 'subscription' ){
							buttonData.label = wpalEcomm.I18n.cancel;
						}
						else{
							buttonData.label = wpalEcomm.I18n.cancel;
						}
						if( parseInt(canCancel) > 0 ){
							renderButton = true;
						}
					}
				}
				else if ( currentStatus === 'cancel-pending' ){
					buttonData.label = wpalEcomm.I18n.cancel_now;
					renderButton = true;
				}

				if( renderButton ){
					var cancelDialog = false,
						$cancelDialog = null,
						$cancelNowToggle = null,
						$updateStatus = null;
					wpalEcommRenderSaveButton( buttonData, $label, function( $el, e ){
						if( ! cancelDialog ){
							document.body.insertAdjacentHTML('beforeend',wpatSetting( wpal_ecomm_data.cancel_dialog ));
							$cancelDialog = document.getElementById('wpat_dialog');
							$cancelNowToggle = $cancelDialog.querySelector('[data-setting="cancel_now"]');
							$updateStatus = $cancelDialog.querySelector('button.cancel_subscription');
							cancelDialog = new window.A11yDialog($cancelDialog, document.getElementById('wpwrap'));
							$updateStatus.onclick = function(e){
								e.preventDefault();
								wpalEcommCancelSubscription(cancelDialog, wpal_ecomm_data.cancel_dialog);
								return false;
							};
							cancelDialog.on('show', function(){
								if( document.getElementById('status').value === 'cancel-pending' ){
									//$cancelNowRow.style.display = 'none';
								}
							});
						}
						cancelDialog.show();
					});
				}

			});

			wpalEcomm.registerFilters( 'wpal_ecomm_billing_details', function( $section ){
				var $ul = $section.querySelector('.billing-details'),
					$formTable = $section.querySelector('.form-table'),
					tmplData = orderData;
				tmplData.billingPrefix = 'billing';

				if( $ul != null && newOrder < 1 ){
					var $detailsWrap = document.createElement("div");
					$detailsWrap.classList.add('billing-details-wrap');
					$detailsWrap.innerHTML = wpAdminTmpls.billing_address( tmplData );
					$ul.parentNode.replaceChild($detailsWrap, $ul);
					$formTable.style.display = "none";

					// todo better to have is editable check
					if( orderType === 'subscription' ){

						var $editButton = document.createElement("button"),
						$icon = document.createElement("span"),
						$text = document.createElement("span");
						$editButton.classList.add('edit-billing-details');
						$icon.classList.add('dashicons', 'dashicons-edit');
						$text.classList.add('screen-reader-text');
						$text.innerHTML = 'Edit';
						$icon.appendChild($text);
						$editButton.appendChild($icon);
						$detailsWrap.appendChild($editButton);
						$editButton.onclick = function(e){
							e.preventDefault();
							$formTable.style.display = "table";
							$detailsWrap.style.display = "none";
							var buttonData = wpal_ecomm_data.wpat_buttons.save;
							buttonData.label = wpalEcomm.I18n.update;
							wpalEcommRenderSaveButton( buttonData, $section, function( $el, e ){
								wpalEcommBilling($el, $section);
							});
							return false;
						};
					}
				}

			});

			// Country Change - Billing Address
			wpalEcomm.registerFilters( 'wpal_ecomm_country_change', function( $select ){
				var name = $select.name,
					regionName = name.replace('country', "state"),
					$wrap = $select.closest('section.wpat_section'),
					$regionSelect = $wrap.querySelector('input[name="'+regionName+'"]');
				wpalEcommRenderRegions($regionSelect,$select.value,'');
			});

			// Customer Details Region Render
			wpalEcomm.registerFilters( 'wpal_ecomm_render_region_select', function( $select ){
				var region = $select.value,
					countryCode = wpalGetCountryCodeFromRegion($select);
					wpalEcommRenderRegions($select,countryCode,region);
			});

			// Order Items Filter
			wpalEcomm.registerFilters( 'wpal_ecomm_order_items_table', function( tableData ){
				_.each( tableData.rows, function( row, r ) {
					var cost = tableData.rows[r].price,
					costClassName = 'cost',
					discount = tableData.rows[r].discount,
					total = tableData.rows[r].total;
					costClassName += ( discount > 0 ) ? ' discounted' : costClassName;

					// Add Cost Detail
					tableData.rows[r].cost_display = currencySymbol + '<span class="'+costClassName+'">'+wpalEcommPrice(cost)+'</span>';
					if( discount > 0 ){
						tableData.rows[r].cost_display += '<span class="discounted-price">'+currencySymbol + '<span class="cost">'+wpalEcommPrice(total)+'</span>';
					}
					// Total
					tableData.rows[r].total_display = currencySymbol + '<span class="total">'+wpalEcommPrice(total)+'</span>';
					if( tableData.rows[r].image > '' ){
						tableData.rows[r].image = '<img src="'+tableData.rows[r].image+'" />';
					}
				});
				return tableData;
			});

			// Subscription Order Billing Items Filter
			wpalEcomm.registerFilters( 'wpal_ecomm_subscription_billing_table', function( tableData ){
				_.each( tableData.rows, function( row, r ) {
					var details = tableData.rows[r].desc + '<br/>';
					details += tableData.rows[r].period;
					tableData.rows[r].details = details;
				});
				return tableData;
			});
			// Download Table Action Filter
			wpalEcomm.registerFilters( 'download_invoice', function( tableData, id, $btn ){
				var rowIndex = wpatIndexOf( tableData.rows, 'id', id ),
					row = ( tableData.rows[rowIndex] ) ? tableData.rows[rowIndex] : false,
					download = ( row ) ? row.download : false;
				if( download ){
					window.open(download);
				}
			});
			// View Table Action Filter
			wpalEcomm.registerFilters( 'view_invoice', function( tableData, id, $btn ){
				var rowIndex = wpatIndexOf( tableData.rows, 'id', id ),
					row = ( tableData.rows[rowIndex] ) ? tableData.rows[rowIndex] : false,
					view = ( row ) ? row.view : false;
				if( view ){
					window.open(view,'_blank');
				}
			});

			wpalEcomm.init();
			if(wpalSaveError){
				wpalEcomm.renderNotice(wpalSaveError.params, wpalSaveError.$wrap);
			}

		}
		// Default Init
		else {
			wpalEcomm.init();
			if(wpalSaveError){
				wpalEcomm.renderNotice(wpalSaveError.params, wpalSaveError.$wrap);
			}
		}

    });

})( jQuery );

// Utility : Return Country Code from Select
var wpalGetCountryCodeFromRegion = function wpalGetCountryCodeFromRegion($select){
	var name = $select.name,
		countryName = name.replace('state', "country"),
		$wrap = $select.closest('section.wpat_section'),
		$countrySelect = $wrap.querySelector('input[name="'+countryName+'"]');
	return $countrySelect.value;
};

// Utility : Render Region wpalSelect2
var wpalEcommRenderRegions = function wpalEcommRenderRegions( $select, countryCode, regionCode ){

	var crData = wpal_ecomm_data.country_region_data,
		countryIndex = wpatIndexOf(crData, 'countryShortCode', countryCode),
		countryData = ( countryIndex ) ? crData[countryIndex] : false,
		regions = ( countryData && countryData.hasOwnProperty('regions') ) ? countryData.regions : false,
		data = [],
		selected = false;

	if( regions ){
		for ( var r in regions ) {
			var region = regions[r];
			selected = ( region.shortCode === regionCode ) ? true : selected;
			data.push({ id:region.shortCode, text:region.name });
		};
		regionCode = ( ! selected ) ? data[0].id : regionCode;
	}

	jQuery($select).html('').wpalSelect2({data: data}).val(regionCode).trigger('change');
};

// Cancel Subscription
var wpalEcommCancelSubscription = function( dialog, settings ){

	var $dialog = dialog.dialog,
		$wrap = document.getElementById('post'),
		formData = wpatGenerateFormData(settings.content, $dialog),
		data = formData.data;
	data.ID = document.getElementById('post_ID').value;
	data.action = 'wpat_ajax';
	data.data_name = 'wpal/ecomm/cancel/subscription';
	wpalEcomm.renderLoading('Updating Status', $wrap);
	dialog.hide();
	wpatRequest('POST', data, function(response){
		if( response.success ){
			location.reload();
		}
		else{
			wpalEcomm.els.$preloader.remove();
			var data = ( response.data ) ? response.data : {};
			if( data.notice ){
				wpalEcomm.renderNotice(data.notice,$wrap);
			}
		}

	});
};

// Utility : Render Save Button with Callback
var wpalEcommRenderSaveButton = function ( data, $parent, callback ){

	$parent.insertAdjacentHTML('beforeend',wpAdminTmpls.button(data));
	var $el = $parent.querySelector('.button-save');
	$el.onclick = function(e){
		if( wpalProcess === false ){
			e.preventDefault();
			callback($el, e);
		}
	}
};

// Utitlity : Update Billing
var wpalEcommBilling = function ($button, $section){
	if (window.confirm("Are you sure you want to update the billing details for this order?")){
		wpalProcess = true;
		$button.click();
	}
};

// Utility : Webhook Key
var wpalEcommGetWebhookKey = function wpalEcommGetWebhookKey($el, e){
	e.preventDefault();
	var prefix = $el.getAttribute('data-prefix'),
		sandbox = (prefix.substr(-7) === 'sandbox') ? true : false,
		merchant = $el.getAttribute('data-type'),
		$panel = $el.closest('.wpat_option_panel.active'),
		s = ( sandbox ) ? 'sandbox-' : '',
		$public = $panel.querySelector('input[data-'+s+'public]'),
		$secret = $panel.querySelector('input[data-'+s+'secret]'),
		$hook_id = $panel.querySelector('#'+prefix+'_webhook_id'),
		$hook_key = $panel.querySelector('#'+prefix+'_webhook_key'),
		publicKey = ( $public.value > '' ) ? $public.value : false,
		secretKey = ( $secret.value > '' ) ? $secret.value : false,
		tab = wpalEcomm.tab,
		$profileKey = $panel.querySelector('#'+tab+'_key'),
		profileKey = ( $profileKey.value > '' ) ? $profileKey.value : false;

	if( ! publicKey || ! secretKey ){

		alert('Please enter both a Public Key and Secret Key');

	}
	else {
		wpalEcomm.renderLoading('Generating Webhook Key', $panel);
		var postData = {
			action:'generate_webhook_key',
			tab:tab,
			sandbox:sandbox ? 1 : 0,
			merchant:merchant,
			public_key:publicKey,
			secret_key:secretKey,
			profile_key:profileKey,
		};
		wpatRequest('POST', postData, function(response){
			var success = response.success,
			data = ( response.data ) ? response.data : {},
			webhook = ( data.data ) ? data.data : false;
			wpalEcomm.els.$preloader.remove();
			if( data.notice ){
				wpalEcomm.renderNotice(data.notice,$panel);
			}
			if( webhook ){
				if( webhook.id ){
					if( $hook_id ){
						$hook_id.value = webhook.id;
					}
				}
				if( webhook.key ){
					if( $hook_key ){
						$hook_key.value = webhook.key;
					}
				}
			}
		});
	}
	return false;
};

// Utility : Formats a Prices
var wpalEcommPrice = function (amount){
	return parseFloat(amount).toFixed(2);
};

// Utility : Return Text From Matching ID
var wpalEcommDataText = function ( data, value ){
	var i = wpatIndexOf(data,'id',value);
	return data[i].text;
};