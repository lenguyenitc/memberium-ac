jQuery( document ).ready( function() {
	memberium_meta_update();

	if ( jQuery('.actionset-selector' ).length > 0 ) {
		jQuery( '.actionset-selector' ).wpalSelect2();
	}
	if ( ( typeof automationlist !== 'undefined' ) && jQuery( '.automationdropdown' ).length > 0 ) {
		jQuery('.automationdropdown').wpalSelect2( { data: automationlist } );
	}
	if ( ( typeof taglist !== 'undefined' ) && jQuery( '.tag-selector' ).length > 0 ) {
		jQuery('.tag-selector').wpalSelect2( { data: taglist } );
	}

});

function memberium_meta_update() {
	var prohibited_action = jQuery( '#_memberium_prohibited_action option:selected' ).text();
	if ( prohibited_action !== 'Redirect' && prohibited_action !== 'Site Default (Redirect)' ) {
		jQuery( '#_memberium_redirect_url' ).prop( 'disabled', true );
	}

	if ( jQuery( "#_memberium_force_public" ).is(":checked") ) {
		jQuery( '.memberium_membership_checkbox' ).prop( 'checked', false );
		jQuery( '#_memberium_anymembership' ).prop( 'checked', false );
		jQuery( '#_memberium_anonymous_only' ).prop( 'checked', false );
		jQuery( '#_memberium_loggedin' ).prop( 'checked', false );
		jQuery( '.memb_redirect_options' ).hide();
		jQuery( '.memb_access_options' ).hide();
		jQuery( '#_memberium_redirect_url' ).prop( 'disabled', true );
	}

	if ( jQuery( "#_memberium_loggedin" ).is(":checked") ) {
		jQuery(".memberium_membership_checkbox").prop( "checked", false );
		jQuery("#_memberium_force_public").prop( "checked", false );
		jQuery("#_memberium_anymembership").prop( "checked", false );
		jQuery("#_memberium_anonymous_only").prop("checked", false );
	}

	if ( jQuery( "#_memberium_anonymous_only" ).is(":checked") ) {
		jQuery(".memberium_membership_checkbox").prop( "checked", false);
		jQuery("#_memberium_force_public").prop( "checked", false );
		jQuery("#_memberium_anymembership").prop("checked", false);
		jQuery("#_memberium_loggedin").prop("checked", false);
	}

	if ( jQuery( "#_memberium_anymembership" ).is(":checked") ) {
		jQuery(".memberium_membership_checkbox").prop( "checked", true);
		jQuery("#_memberium_anonymous_only").prop( "checked", false );
		jQuery("#_memberium_loggedin").prop( "checked", false );
	}

	if ( ! jQuery( ".memberium_membership_checkbox" ).is(":checked") ) {
		jQuery( '#_memberium_anymembership' ).prop( 'checked', false );
	}

	jQuery("#_memberium_prohibited_action").change( function() {
		var prohibited_action = jQuery("#_memberium_prohibited_action option:selected").text();
		if ( prohibited_action !== "Redirect" && prohibited_action !== "Site Default (Redirect)" ) {
			jQuery(".memb_redirect_options").prop( "disabled", true );
			jQuery(".memb_redirect_options").hide();
		}
		else {
			jQuery(".memb_redirect_optionsl").prop( "disabled", false );
			jQuery(".memb_redirect_options").show();
		}
	});

	jQuery("#_memberium_force_public").change( function() {
		if ( jQuery( "#_memberium_force_public" ).is(":checked") ) {
			jQuery( '.memberium_membership_checkbox' ).prop( 'checked', false );
			jQuery( '#_memberium_anymembership' ).prop( 'checked', false );
			jQuery( '#_memberium_anonymous_only' ).prop( 'checked', false );
			jQuery( '#_memberium_loggedin' ).prop( 'checked', false );
			jQuery( '.memb_redirect_options' ).hide();
			jQuery( '.memb_access_options' ).hide();
			jQuery( '#_memberium_redirect_url' ).prop( 'disabled', true );
		}
		else {
			jQuery( '.memb_redirect_options' ).show();
			jQuery( '.memb_access_options' ).show();
			jQuery( '#_memberium_redirect_url' ).prop( 'disabled', false );
		}
	});

	jQuery("#_memberium_loggedin").change( function() {
		if ( jQuery( "#_memberium_loggedin" ).is(":checked") ) {
			jQuery( '#_memberium_force_public' ).prop( 'checked', false );
			jQuery(".memberium_membership_checkbox").prop( "checked", false );
			jQuery("#_memberium_anymembership").prop( "checked", false );
			jQuery("#_memberium_anonymous_only").prop("checked", false );
		}
	});

	jQuery("#_memberium_anonymous_only").change( function() {
		if ( jQuery( "#_memberium_anonymous_only" ).is(":checked") ) {
			jQuery(".memberium_membership_checkbox").prop( "checked", false);
			jQuery("#_memberium_anymembership").prop("checked", false);
			jQuery( '#_memberium_force_public' ).prop( 'checked', false );
			jQuery("#_memberium_loggedin").prop("checked", false);
		}
		else {
		}
	});

	jQuery(".memberium_membership_checkbox").change( function() {
		if ( jQuery( ".memberium_membership_checkbox" ).is(":checked") ) {
			jQuery( '#_memberium_force_public' ).prop( 'checked', false );
			jQuery("#_memberium_anonymous_only").prop("checked", false );
			jQuery("#_memberium_anymembership").prop( "checked", false );
			jQuery("#_memberium_loggedin").prop( "checked", false );
		}
		else {
		}
	});

	jQuery("#_memberium_anymembership").change( function() {
		if ( jQuery( "#_memberium_anymembership" ).is(":checked") ) {
			jQuery(".memberium_membership_checkbox").prop( "checked", true);
			jQuery( '#_memberium_force_public' ).prop( 'checked', false );
			jQuery("#_memberium_anonymous_only").prop( "checked", false );
			jQuery("#_memberium_loggedin").prop( "checked", false );
		}
		else {
			jQuery("#_memberium_anymembership").prop( "disabled", false );
			jQuery("#_memberium_loggedin").prop( "disabled", false );
		}
	});
}
