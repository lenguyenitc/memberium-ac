// Update Fieldset User Data Attr
window["wpal_taxonomy_access_status_toggle"] = function ($el) {
    var $tbody     = jQuery($el.closest(".wpal-taxonomy-access-tbody")),
        userStatus = parseInt($el.val()),
		keys       = wpal_tax_data.loggedInOnlyKeys;
        $tbody.attr("data-user-status", userStatus);
	for( var k in keys ){
		var key = keys[k],
			$wrap = jQuery('.wpal-taxonomy-access-field-control[data-setting="'+key+'"]', $tbody),
			$input = $wrap ? jQuery('input[data-wpal-taxonomy-select2]', $wrap) : null;

		if( $input && $input !== null ){
			// Not Logged In Clear Values
			if( userStatus !== 1 ){
				resetWpalTaxSelect2( $input, $tbody );
			}
		}
	}
};

// Update Fieldset Prohibited Actions Data Attr
window["wpal_taxonomy_prohibited_action_toggle"] = function ($el) {
    var $tbody = jQuery($el.closest(".wpal-taxonomy-access-tbody"));
    $tbody.attr("data-prohibited-action", $el.val());
};

// Set to Logged In Users
window["wpal_taxonomy_contact_toggle"] = function($el){
    if( $el.val() > '' ){
        var $tbody     = jQuery($el.closest(".wpal-taxonomy-access-tbody")),
            $status    = jQuery('[name="wpal_taxonomy[status]"]', $tbody),
            userStatus = $status.val();
        if( userStatus != "1" ){
            setWpalTaxSelect2($status, $tbody, '1');
        }
    }
};

(function ($) {
  "use strict";

  var select2Data = wpal_tax_data.select2Data,
    I18n = wpal_tax_data.I18n,
    $tbody = $(".wpal-taxonomy-access-tbody");

  window.resetWpalTaxSelect2 = function( $el, $parent ){
      $el = ($el instanceof jQuery) ? $el[0] : $el;
      $el.value = '';
      $el.dispatchEvent(new Event('change'));
      // Destroy Existing
      $($el).selectWoo('destroy');
      wpalTaxSelect2($($el), $parent, $($el).attr("data-wpal-taxonomy-select2"));
  };

  window.setWpalTaxSelect2 = function( $el, $parent, value ){
      $($el).selectWoo('destroy');
      $el[0].value = 1;
      $el[0].dispatchEvent(new Event('change'));
      wpalTaxSelect2($el, $parent, $($el).attr("data-wpal-taxonomy-select2"));
  };

  // Initialize Select2 Input
  var wpalTaxSelect2 = function ($el, $parent, dataName) {
      var data = select2Data.hasOwnProperty(dataName)
      ? select2Data[dataName]
      : [],
      cleansed = wpalTaxSelect2Cleanse($el.val(), data),
      args = {
          data: data,
          dropdownParent: $parent
      },
      multiple = $el.attr("data-multiple"),
      onChange = $el.attr("data-change"),
      disableSearch = $el.attr("data-disable-search");
      if (parseInt(multiple) > 0) {
          args.multiple = true;
      }
      if (parseInt(disableSearch) > 0) {
          args.minimumResultsForSearch = -1;
      }

      // Check Removed
      if (cleansed.removed.length > 0) {
          $el.val(cleansed.value);
          //wpale_trigger_event( $el, 'input' );
          var message = I18n.ids_removed,
            $label = $("label[for='" + $el.attr("id") + "']");
          (message += " " + cleansed.removed),
          $('<span class="wpal-taxonomy-access-notice">' + message + "</span>").insertAfter($label);
      }

      // Init
      $el.selectWoo(args);

      //On Change trigger
      if (onChange > "") {
          if (typeof window[onChange] === "function") {
              $el.on("change.select2", function () {
                  window[onChange]($el);
              });
          }
      }
  };

  // Remove Saved Key IDs that no longer Exist
  var wpalTaxSelect2Cleanse = function (value, tags) {
      var removed = [],
      cleansed = [],
      tags = tags > "" ? tags : [];
      if (value > "") {
          if (tags.length > 0) {
              var tag_ids = value.split(",");
              if (tag_ids.length > 0) {
                  tag_ids.forEach(function (tag_id) {
                      var found = false;
                      for (var i = 0; i < tags.length; i++) {
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
          else {
              return {
                  value: "",
                  removed: value
              };
          }
      }
      return {
          value   : cleansed.length > 0 ? cleansed.join() : "",
          removed : removed.length > 0  ? removed.join()  : "",
      };
  };

  $( document ).ready(function() {
      $("input[data-wpal-taxonomy-select2]", $tbody).each(function () {
          var $el = $(this),
          data = $(this).attr("data-wpal-taxonomy-select2"),
          $parent = $(this).closest("td");
          wpalTaxSelect2($el, $parent, data);
      });
  });

})(jQuery);