(function( $ ) {
	'use strict';

    var select2Data = wpal_menu_data.select2Data,
        I18n = wpal_menu_data.I18n;

    // Initialize Select2 on new Menu Items
	$('#update-nav-menu').on('click', '.item-edit', function(e) {
        e.preventDefault();
		var $parent = $(this).closest('.menu-item');
        if ($parent.hasClass('select2-rendered') ) {
            return;
        }
        // Find all Select2 Inputs
        $('input[data-wpal-menu-select2]', $parent).each( function() {
            var $el = $(this),
                data = $(this).attr("data-wpal-menu-select2");
            wpalMenuSelect2($el, $parent, data);
        });
        $parent.addClass('select2-rendered');
	});

	window.resetWpalMenuSelect2 = function( $el, $parent ){
		$el = ($el instanceof jQuery) ? $el[0] : $el;
		$el.value = '';
		$el.dispatchEvent(new Event('change'));
		// Destroy Existing
		$($el).selectWoo('destroy');
		wpalMenuSelect2($($el), $parent, $($el).attr("data-wpal-menu-select2"));
	};

	window.setWpalMenuSelect2 = function( $el, $parent, value ){
        $($el).selectWoo('destroy');
        $el[0].value = 1;
        $el[0].dispatchEvent(new Event('change'));
        wpalMenuSelect2($el, $parent, $($el).attr("data-wpal-menu-select2"));
    };

     // Initialize Select2 Input
     var wpalMenuSelect2 = function( $el, $parent, dataName ) {
         var data = ( select2Data.hasOwnProperty(dataName) ) ? select2Data[dataName] : [],
             cleansed = wpalMenuSelect2Cleanse($el.val(), data),
			 args = {
	             data           : data,
	             dropdownParent : $parent
	         },
			 multiple = $el.attr("data-multiple"),
			 onChange = $el.attr("data-change"),
			 disableSearch = $el.attr("data-disable-search");
		 if (parseInt(multiple) > 0 ) {
			 args.multiple = true;
		 }
		 if (parseInt(disableSearch) > 0) {
	       args.minimumResultsForSearch = -1;
	     }

		 // Check Removed
         if (cleansed.removed.length > 0 ) {
            $el.val(cleansed.value);
            //wpale_trigger_event( $el, 'input' );
            var message = I18n.ids_removed,
                $label = $("label[for='" + $el.attr('id') + "']");
            message += ' ' + cleansed.removed,
            $('<span class="wpal-menu-access-notice">'+message+'</span>').insertAfter($label);
         }

		 // Init
         $el.selectWoo(args);

		 //On Change trigger
		 if (onChange > '' ) {
			 if (typeof window[onChange] === "function" ) {
				 $el.on('change.select2', function () {
					 window[onChange]($el);
				 });
			 }
		 }
     };

    // Remove Saved Key IDs that no longer Exist
    var wpalMenuSelect2Cleanse = function(value, tags) {
 		var removed = [],
 		    cleansed = [],
            tags = ( tags > '' ) ? tags : [];
 		if (value > '' ) {
 			if (tags.length > 0 ) {
 				var tag_ids = value.split(',');
 				if (tag_ids.length > 0 ) {
 					tag_ids.forEach(function (tag_id) {
 						var found = false;
 						for(var i = 0; i < tags.length; i++) {
 							if (tags[i].id == tag_id) {
 								found = true;
 								cleansed.push(tag_id);
 								break;
 							}
 						}
 						if (!found) {
 							removed.push(tag_id);
 						}
 					});
 				}
 			}
 			else{
 	            return {
 	                value : '',
 	                removed : value
 	            };
 	        }
 		}
 		return {
 			value : ( cleansed.length > 0 ) ? cleansed.join() : '',
 			removed : ( removed.length > 0 ) ? removed.join() : ''
 		};
 	};

})( jQuery );

// Update Fieldset Data Attr & Remove Values if not logged in
window["wpal_menu_access_status_toggle"] = function($el) {
	var $fieldset  = jQuery( $el.closest('.wpal-menu-access-fieldset') ),
		userStatus = parseInt($el.val()),
		keys       = wpal_menu_data.loggedInOnlyKeys;
	$fieldset.attr('data-user-status', userStatus);
	for( var k in keys ){
		var key = keys[k],
			$wrap = jQuery('.wpal-menu-access-field-control[data-setting="'+key+'"]', $fieldset),
			$input = $wrap ? jQuery('input[data-wpal-menu-select2]', $wrap) : null;

		if( $input && $input !== null ){
			// Not Logged In Clear Values
			if( userStatus !== 1 ){
				resetWpalMenuSelect2( $input, $fieldset );
			}
		}
	}
};

// Set to Logged In Users
window["wpal_menu_contact_toggle"] = function($el){
    if( $el.val() > '' ){
		var $fieldset  = jQuery( $el.closest('.wpal-menu-access-fieldset') ),
            $status    = jQuery('[data-change="wpal_menu_access_status_toggle"]', $fieldset),
            userStatus = $status.val();
        if( userStatus != "1" ){
            setWpalMenuSelect2($status, $fieldset, '1');
        }
    }
};