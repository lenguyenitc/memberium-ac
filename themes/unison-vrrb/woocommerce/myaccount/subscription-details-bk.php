<?php
/**
 * Subscription details table
 *
 * @author  Prospress
 * @package WooCommerce_Subscription/Templates
 * @since 2.2.19
 * @version 2.6.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( sizeof( $subscription_items = $subscription->get_items() ) > 0 ) {
    foreach ( $subscription_items as $item_id => $item ) {
        $_product = apply_filters('woocommerce_subscriptions_order_item_product', $item->get_product(), $item);
        $is_switched = wcs_is_product_switchable_type($_product);
        $attributes = array_filter($_product->get_attributes(), 'wc_attributes_array_filter_visible');
        $upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);

            $variations = get_variations_for_product($item['product_id']);
            $min_variation = get_post_meta($item['product_id'], '_min_variation_regular_price');
            $max_variation = get_post_meta($item['product_id'], '_max_variation_regular_price');
            $min_variation_period = get_post_meta($item['product_id'], '_min_variation_period');
            $max_variation_period = get_post_meta($item['product_id'], '_max_variation_period');
    }
}

?>
<div class="filter plan">

<!-- <div class="modal-overlay closed" id="modal-overlay"></div>
<div class="modal-change-plan closed" id="modal-change-plan">
    <div class="modal-guts">
        <img class="img-fluid pointer close"
             src="<?php bloginfo('template_url') ?>/assets/images/close-icon.png"
             id='close-x' style="min-width: 15px !important">
        <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12 mt-6 mx-auto align-items-center text-center">
            <h3 class="p-0">Change Plan</h3>
            <p class="title">Whether you're just starting out or want to produce like a pro, there's a
                plan for you.
            </p>
        </div>
        <div class="col-xxxl-12 row mx-auto align-items-center justify-content-between text-center p-0">
            <?php
            foreach ($variations as $key => $variation) :
            $title = explode(':', $variation->post_excerpt);
            $price = $variation->price;
            $thumb = $variation->thumb;

            if ($price) :
            if ($price == $min_variation[0]) : ?>
            <div class="card-green green-glow" id="cardGreen">
                <?php elseif ($price == $max_variation[0]) : ?>
                <div class="card-white green-glow">
                    <?php else : ?>
                    <div class="card-blue green-glow">
                        <?php endif; ?>
                        <div class="text-content text-center mt-0 pt-0" style="height: 100%">
                            <div class='col-12 row mx-auto align-items-center text-center justify-content-center justify-content-around'>
                                <?php echo $thumb; ?>
                                <h4 class="title-card"><?php echo $title[1]; ?></h4>
                            </div>
                            <p
                                    class="<?php if ($price != $max_variation[0]) echo 'text-white'; ?> pt-0 font-weight-bold p1 subtitle">
                                Here's What <span style="color: #01BFA6;"> You'll Get: </span></p>
                            <div class="<?php if ($price == $min_variation[0]) {
                                echo 'card-green-opacity text-white';
                            } elseif ($price == $max_variation[0]) {
                                echo 'card-blue-linear';
                            } else {
                                echo 'bg-opacity text-white card-blue-opacity';
                            } ?> ">

                                <div
                                        class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0 align-items-top">
                                    <div class="col-xxxl-1 col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 pl-0"
                                         style="font-size: 20px; margin-right: 10.5px">
                                        <img src="<?php bloginfo('template_url') ?>/assets/images/check white.png"
                                             style="min-width: 15px !important">
                                    </div>
                                    <div
                                            class="col-xxxl-6 col-xxl-10 col-xl-10  col-lg-10  col-md-10 col-sm-10 col-xs-10 text-left p-0">
                                        <p class="text-white midis-month">MIDI BOX</p>
                                        <p class="text-white midis-month">(200 MIDI's/month)</p>
                                    </div>
                                </div>
                                <ul class="row  justify-content-between m-0 p-0" style="width: 100%">
                                    <div class="col-xxxl-7 col-xxl-12 col-xl-12 col-lg-12 mt-6 pr-0 mr-0 ml-0 pl-0">
                                        <li class="text-white  text-left m-0 align-items-center"><i
                                                    class="fa fa-circle"></i>48 Chord Progressions
                                        </li>
                                    </div>


                                    <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12  mt-6 m-0 p-0">
                                        <li class="text-white text-left p-0">
                                            <i class="fa fa-circle"></i>48 Melodies
                                        </li>
                                    </div>
                                    <div class="col-xxxl-7 col-xxl-12 col-xl-12 col-lg-12 mt-6 pr-0 mr-0 ml-0 pl-0">
                                        <li class="text-white text-left m-0 p-0 mt-10"><i
                                                    class="fa fa-circle"></i>48
                                            Basslines
                                        </li>
                                    </div>
                                    <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12  mt-6 pr-0 mr-0 ml-0 pl-0">
                                        <li class="text-white  text-left m-0 p-0 mt-10"><i
                                                    class="fa fa-circle"></i>56
                                            Drum Patterns
                                        </li>
                                    </div>
                                </ul>
                            </div>

                        </div>
                        <?php $sale_price = get_post_meta($variation->ID, '_sale_price'); ?>
                        <div class="radio-item">
                            <input class="product_variation" type="radio"
                                   id="ritem<?php echo($key + 1); ?>" name="ritem"
                                   data-product-id="<?php echo $variation->ID; ?>"
                                   data-price="<?php echo $price ?>"
                                   value="<?php echo $title[1]; ?>">
                            <!-- <input type="hidden" class="sale_price" value="
                                            <?php //echo $sale_price[0]
                            ?>
                            <label class="mb-0 pointer" for="ritem<?php echo($key + 1); ?>"></label>
                        </div>

                    </div>
                    <?php
                    endif;
                    endforeach; ?>
                </div>

                <div class=" col-xxxl-4 col-xxl-7 col-xl-7 col-lg-10 col-md-12 col-xs-11 col-sm-12 mx-auto align-items-bottom text-center justify-content-between"
                     style="margin-top: 15px !important;">
                    <div class="row  align-items-center">
                        <p class="text-white  text-left previous-price mx-auto p-0">
                            From:
                            <?php echo wc_price($_product->get_price()); ?>/month
                            ><span class="new_sale_price"></span>/month
                        </p>
                        <p class="text-white text-left pr-0 white-text mx-auto p-0">
                            DUE TODAY: <span
                                    class="p1 font-weight-bold green-text new_sale_price"></span>
                        </p>
                    </div>
                </div>

                <div class="col-xxxl-6 col-xxl-6 text-center mx-auto  mt-xl-0 pr-0 pl-0">
                    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

                    <form class="update-plan" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="add-to-cart"
                               value="<?php echo esc_attr($item['product_id']); ?>"/>
                        <input type="hidden" id="variation" name="variation_id" value=""/>
                        <button type="submit" class="mx-auto btn-update">UPDATE PLAN</button>
                    </form>

                </div>
                <div
                        class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12 mt-6  text-white text-center mx-auto  mt-3 mt-xl-0 p-0">
                    <p class='mx-auto text-small'>
                        You'll get instant access to your new plan's "CURRENTMONTH" MIDI Box and your
                        recurring billing
                        date will be changed to the "TODAY'S MONTH DAY NUMBER" of each month.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> -->
                            
<div class="align-items-top border-bottom-new padding-bottom pt-5 pb-5 active-plan">
	<div class="media-body col-xs-12">
		<div class="row align-items-md-top align-items-lg-center pr-0 justify-content-between">
			<div class="d-flex col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-10 col-md-10 col-xs-9 text-left align-items-md-top align-items-lg-center">
				<div class="col-xxxl-3  col-xxl-4 col-xl-3 col-lg-3  col-sm-4 col-md-4 col-xs-3 p-0">
                    <?php echo $_product->get_image(); ?>
                </div>
				<div class="col-xxxl-9 col-xxl-8 col-xl-8 col-lg-8  col-sm-8 col-md-8 col-xs-9 text-left pr-0">
					<h5 class="mt-0"><?php echo $item->get_name(); ?></h5>
					<h6 class="font-weight-normal my-1" style="font-size: 14px;"><?php echo $subscription->get_formatted_order_total(); ?></h6>
					<?php if ( $subscription->get_status() === 'pending-cancel' ) { ?>
						<span class="text-left active-text" style="color: #ECE289; border-color: #ECE289;">Inactive</span>
					<?php } elseif ( $subscription->get_status() === 'active' ) { ?>
						<span class="text-left active-text"><?php echo $subscription->get_status(); ?></span>
					<?php } ?>
				</div>
			</div>
			<div class="col-xxl-2 col-xl-6 col-lg-6 col-sm-2 col-md-2 col-xs-3 text-right mt-xl-0 pr-0 pl-0">
				<?php $actions = wcs_get_all_user_actions_for_subscription( $subscription, get_current_user_id() ); ?>
				<?php if ( ! empty( $actions ) ) : ?>
					<?php foreach ( $actions as $key => $action ) : ?>
						<?php if ( $subscription->get_status() === 'pending-cancel' && $action['name'] === 'Reactivate' ) : ?>
							<a href="<?php echo esc_url( $action['url'] ); ?>" class="pointer <?php echo sanitize_html_class( $key ) ?>"><?php echo esc_html( $action['name'] ); ?></a>
						<?php endif ?>
						<?php if ( $subscription->get_status() === 'pending-cancel' ) : ?>
							<p class="pointer change text-white" onclick="openModalChangePlan()"><span class="desk-text">or</span> <u>Change Plan</u></p>
						<?php endif ?>
						<?php if ( $action['name'] === 'Cancel' ) : ?>
							<p class="pointer change" onclick="openModalChangePlan()">Change Plan</p>
							<a href="<?php echo esc_url( $action['url'] ); ?>" class="pointer cancel <?php echo sanitize_html_class( $key ) ?>" id="cancel-sub"><?php echo esc_html( $action['name'] ); ?></a>
						<?php endif ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<script>
    $('.change').on('click', function () {
        window.history.replaceState(null, null, "<?php echo $upgrade_downgrade_button; ?>");
    });

</script>

<?php if ( $notes = $subscription->get_customer_order_notes() ) : ?>
	<h2><?php esc_html_e( 'Subscription updates', 'woocommerce-subscriptions' ); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo esc_html( date_i18n( _x( 'l jS \o\f F Y, h:ia', 'date on subscription updates list. Will be localized', 'woocommerce-subscriptions' ), wcs_date_to_time( $note->comment_date ) ) ); ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wp_kses_post( wpautop( wptexturize( $note->comment_content ) ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>
    <script type="text/javascript">
        function openModalChangePlan() {
            $('.modal-change-plan').removeClass('closed');
            $('.modal-overlay').removeClass('closed');
           
        }

        $(document).ready(function() {
            $('#close-x').on('click', function() {
                $('.modal-change-plan').addClass('closed');
                $('.modal-overlay').addClass('closed');
            });

            $('#ritem1').click(function() {
                $('#variation').val('');
                $('#variation').val($(this).attr('data-product-id'));
                $('.new_sale_price').text('');
                $('.new_sale_price').text('$' + $(this).attr('data-price'));
                $('.card-green').addClass('glow-card');
                $('.card-blue').removeClass('glow-card');
                $('.card-white').removeClass('glow-card');
            });
            $('#ritem2').click(function() {
                $('#variation').val('');
                $('#variation').val($(this).attr('data-product-id'));
                $('.new_sale_price').text('');
                $('.new_sale_price').text('$' + $(this).attr('data-price'));
                $('.card-blue').addClass('glow-card');
                $('.card-green').removeClass('glow-card');
                $('.card-white').removeClass('glow-card');

            });
            $('#ritem3').click(function() {
                $('#variation').val('');
                $('#variation').val($(this).attr('data-product-id'));
                $('.new_sale_price').text('');
                $('.new_sale_price').text('$' + $(this).attr('data-price'));
                $('.card-white').addClass('glow-card');
                $('.card-green').removeClass('glow-card');
                $('.card-blue').removeClass('glow-card');

            });

        });
    </script>