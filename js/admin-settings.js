jQuery(document).ready(function() {
	if (jQuery('.basic-single').length > 0) {
		jQuery( '.basic-single' ).wpalSelect2();
	}
	if ( jQuery( '.roles-selector' ).length > 0 ) {
		jQuery( '.roles-selector' ).wpalSelect2();
	}

	if ( jQuery( '.memb-multiple-select' ).length > 0 ) {
		jQuery( '.memb-multiple-select' ).wpalSelect2({multiple:true});
	}

	if (typeof automationlist !== 'undefined') {
		jQuery('.automationdropdown').wpalSelect2({data: automationlist});
	}

	if (typeof taglist !== 'undefined') {
		jQuery('.tag-selector').wpalSelect2({ data: taglist });
		jQuery('.taglistdropdown').wpalSelect2({ data: taglist });
		jQuery('.multitaglist').wpalSelect2({ data: taglist, multiple:true });
		jQuery('.disabledmultitaglist').wpalSelect2({});
		if ( jQuery( '.taglistdropdown-notnone' ).length > 0 ) {
			var taglistPopulated = JSON.parse(JSON.stringify(taglist));
			if( taglistPopulated[0].id === 0 ){
				delete taglistPopulated[0];
			}
			jQuery('.taglistdropdown-notnone').wpalSelect2({ data: taglistPopulated });
		}
	}

	if ( typeof pagelist !== 'undefined' ) {
		jQuery( '.pagelistdropdown' ).wpalSelect2({ data: pagelist });
	}

	if ( typeof listlist !== 'undefined' ) {
		jQuery( '.listlistdropdown' ).wpalSelect2({ data: listlist });
		jQuery('.multilistlist').wpalSelect2({ data: listlist, tags: listlist });
	}

	if ( typeof requiredtaglist !== 'undefined' ) {
		jQuery( '.requiredtaglistdropdown' ).wpalSelect2({ data: requiredtaglist });
	}

	if ( typeof membershiptaglist !== 'undefined' ) {
		jQuery( '.membershiptaglistdropdown' ).wpalSelect2({ data: membershiptaglist });
	}

	if ( typeof themelist !== 'undefined' ) {
		jQuery( '.themelistdropdown' ).wpalSelect2({ data: themelist });
	}

	if ( typeof badgeoslist !== 'undefined' ) {
		jQuery( '.badgeos-selector' ).wpalSelect2({ data: badgeoslist });
	}

});
