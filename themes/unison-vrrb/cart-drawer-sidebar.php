<?php
global $post;
$current_url = get_permalink($post->ID);
?>
<script type="text/javascript">
    jQuery(document).on('submit', '.cs_add_to_cart_footer, .cart', function() {
        var product_id = jQuery(this).find('input[name="add-to-cart"]').val();
        console.log('aaaaaaaaa', product_id);

        if (product_id != '') {
                openCartDrawer(product_id);
        }
        return false;
    });

    jQuery(document).on('click', '.cs_trigger_hide_popup', function() {
        jQuery('.close').trigger('click');
        // jQuery('#cs_drawer_main_nav').toggleClass('cs_drawer_menu_expanded');
        // jQuery('#cs_drawer_main_nav').parent().toggleClass('cs_drawer_menu_expanded');
    });

    function GetUpsellProductOnAjaxAddToCart(product_id) {
        //alert();
        var data = {
            action: 'my_cs_get_product_upsell_action',
            product_id: product_id,
        };
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: data,
            beforeSend: function(response) {
                jQuery('.cs_get_upsell_producton_ajax').html();
            },
            complete: function(response) {

            },
            success: function(response) {
                console.log('Testing');
                jQuery('.cs_get_upsell_producton_ajax').html(response);
            },
        });

        console.log(product_id);

    }
</script>
<script type="text/javascript">
    //Usage:
    // add cs_drawer_menu_open class to menu icon
    // add data-menu attr with the id of the menu to be expanded
    // add id to the menu element and the cs_drawer_js_menu class
    // wrap menu in cs_drawer_menu_context class
    // add cs_drawer_js_menu--right or cs_drawer_js_menu--left to set the slide direction 
    // action: my_cs_add_to_cart_drawer_action 
    //function addRedirectPage(product_id){
    //    window.location.href = '<?php //echo $current_url; 
                                    ?>///?added_to_cart='+product_id;
    //}

    jQuery(document).ready(function() {
        var product_id = '<?php echo $_GET['added_to_cart']; ?>';
        if (product_id != '') {
            openCartDrawer(product_id);
            window.history.pushState({}, document.title);
        }

        jQuery('.openCart').on('click', function(e) {
            e.preventDefault();
            jQuery("#playbar").css('z-index', '599')
            openCartDrawerOnClick();
        })
    });

    function removeCartDrawerProduct(product_id) {
        var data = {
            action: 'my_cs_remove_cart_product_drawer_action',
            product_id: product_id,
        };
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: data,
            beforeSend: function(response) {

            },
            complete: function(response) {

            },
            success: function(response) {
                jQuery('.get_cart_drawer_content').html(response);
            },
        });

        console.log(product_id);

    }

    function openCartDrawer(product_id, is_upsell = '') {
        var data = {
            action: 'my_cs_add_to_cart_drawer_action',
            product_id: product_id,
        };
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: data,
            beforeSend: function(response) {

            },
            complete: function(response) {

            },
            success: function(response) {
                if (response.error && response.product_url) {
                    console.log(response);
                    //window.location = response.product_url;
                    return;
                } else {

                    jQuery('#cs_drawer_main_nav').toggleClass('cs_drawer_menu_expanded');
                    jQuery('#cs_drawer_main_nav').parent().toggleClass('cs_drawer_menu_expanded');
                    jQuery('.get_cart_drawer_content').html(response);
                    jQuery('#playbar').css('z-index', '599');
                    if (is_upsell == '') {
                        GetUpsellProductOnAjaxAddToCart(product_id);
                        
                    } else {
                        jQuery('#cs_drawer_main_nav').toggleClass('cs_drawer_menu_expanded');
                        jQuery('#cs_drawer_main_nav').parent().toggleClass('cs_drawer_menu_expanded');
                    
                    }
                    //jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });

        console.log(product_id);

    }

    function openCartDrawerOnClick() {
        var data = {
            action: 'get_cs_cart_drawer_items',
        };
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: data,
            beforeSend: function(response) {

            },
            complete: function(response) {

            },
            success: function(response) {
                if (response.error) {
                    console.log(response);
                    //window.location = response.product_url;
                    return;
                } else {

                    jQuery('#cs_drawer_main_nav').toggleClass('cs_drawer_menu_expanded');
                    jQuery('#cs_drawer_main_nav').parent().toggleClass('cs_drawer_menu_expanded');
                    jQuery('.get_cart_drawer_content').html(response);
                    //jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });
    }
    jQuery(document).on('touchend click', '.cs_drawer_menu_close', function(event) {
        event.preventDefault();
        // console.log('good');
        if (jQuery(event.target).hasClass('cs_drawer_menu_context') || jQuery(event.target).hasClass('cs_drawer_menu_close')) {
            jQuery('.cs_drawer_menu_expanded').removeClass('cs_drawer_menu_expanded');
        }

    });
    jQuery(document).on('touchend click', '.cs_drawer_menu_context, .cs_drawer_menu_close', function(event) {
        console.log('aaaaa');
        if (jQuery(event.target).hasClass('cs_drawer_menu_context') || jQuery(event.target).hasClass('cs_drawer_menu_close')) {
            jQuery('.cs_drawer_menu_expanded').removeClass('cs_drawer_menu_expanded');
        }
    });
</script>
<div class="cs_drawer_menu_context">
    <div id="cs_drawer_main_nav" class="cs_drawer_js_menu cs_drawer_js_menu--right">
        <div>
            <h3>
                <img class="cs_drawer_menu_close" src="<?php bloginfo('template_url') ?>/assets/images/cart-arrow.svg" />
                <span class="cs_drawer_heading">CART</span>
                <span class="cs_drawer_cart">
                    <img src="<?php bloginfo("template_url") ?>/assets/images/cart-icon-green.svg" class="cart-cart-icon" />
                </span>
            </h3>
        </div>
        <div class="get_cart_drawer_content">
            <p>You have no items in your cart.</p>
        </div>
    </div>
</div>