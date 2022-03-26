jQuery(document).ready(function(event) {

    jQuery('#reset').submit(ajaxSubmit);

    function ajaxSubmit() {
        var email = jQuery('#user_email').val();
        var data  = {
            action: 'reset',
            user_email: email,
            afp_nonce: resetajax.reset_nonce
        };
        jQuery.ajax({
            type: "POST",
            url: resetajax.reset_ajax_url,
            // dataType: "json",
            data: data,
            success: function (data) {
                jQuery("#message").html(data);
            },
            error: function (data) {
                jQuery("#message").html(data);
            }
        });
        return false;
    }
});