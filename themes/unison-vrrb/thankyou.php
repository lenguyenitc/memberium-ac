<?php
/*
Template Name: Downloads 
*/
get_header(); ?>

<section id="pCart" class="downloads_wrap">

  <div class="banner"><h2>Downloads</h2></div>

  <div class="cart-wrap">
    <ul class="step">
      <li>
        <strong>1</strong>
        <span>Review Cart </span>
        <em></em>
      </li>
      <li>
        <strong>2</strong>
        <span>CHECKOUT</span>
        <em></em>
      </li>
      <li class="active">
        <strong>3</strong>
        <span>Download</span>
      </li>
    </ul>
<div class="overview-user"> 
<?php 
global $wpdb;
$downloads   = array();
$customer_orders = get_posts( array(
        'numberposts' => 1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() ),
    ) );
$last_order_id = $customer_orders[0]->ID;
$download_query = "SELECT wp_woocommerce_downloadable_product_permissions.*,wp_posts.post_title FROM wp_woocommerce_downloadable_product_permissions LEFT JOIN wp_posts on wp_posts.ID = wp_woocommerce_downloadable_product_permissions.product_id WHERE order_id= '".$last_order_id."'";
$results_p = $wpdb->get_results($download_query);
foreach ($results_p as $result_p)
{
	$downloads[] = array(
				'download_url'        => add_query_arg(
					array(
						'download_file' => $result_p->product_id,
						'order'         => $result_p->order_key,
						'email'         => $result_p->user_email,
						'key'           => $result_p->download_id
					),
					home_url( '/' )
				),
				'download_id'         => $result_p->download_id,
				'product_id'          => $result_p->product_id,
				'download_name'       => $result_p->post_title,
				'order_id'            => $result_p->order_id,
				'order_key'           => $result_p->order_key,
				'downloads_remaining' => $result_p->downloads_remaining,
				'access_expires' 	  => $result_p->access_expires
			);

}
$has_downloads = (bool) $downloads;
do_action( 'woocommerce_before_account_downloads', $has_downloads ); ?>
<?php if ( $has_downloads ) : ?>
	<?php do_action( 'woocommerce_before_available_downloads' ); ?>
	<table class="woocommerce-MyAccount-downloads shop_table shop_table_responsive soundbank_download">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<?php foreach ( $downloads as $download ) :
		print_r($download['product_id']); ?>
			<tr>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) : ?>
							<?php do_action( 'woocommerce_account_downloads_column_' . $column_id, $download ); ?>

						<?php elseif ( 'download-product' === $column_id ) : ?>
							<?php 
							$attr = array(
							    'id' => 'YOUR-UNIQUE-ID',
							);
							if(has_post_thumbnail($download['product_id'])){
								echo '<div class="thumb_download">';
								echo get_the_post_thumbnail( $download['product_id'], array(100, 100), $attr );
								echo '</div>';
							}else{
								echo '<div class="thumb_download"><img src="'.site_url().'/wp-content/plugins/woocommerce/assets/images/placeholder.png" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" id="YOUR-UNIQUE-ID" sizes="(max-width: 100px) 100vw, 100px" width="100" height="100"></div>';
							}
							
							?>
							<a href="<?php echo esc_url( get_permalink( $download['product_id'] ) ); ?>">
								<?php echo esc_html( $download['download_name'] ); ?>
							</a>

						<?php elseif ( 'download-remaining' === $column_id ) : ?>
							<?php
								if ( is_numeric( $download['downloads_remaining'] ) ) {
									echo esc_html( $download['downloads_remaining'] );
								} else {
									_e( '&infin;', 'woocommerce' );
								}
							?>

						<?php elseif ( 'download-expires' === $column_id ) : ?>
							<?php if ( ! empty( $download['access_expires'] ) ) : ?>
								<time datetime="<?php echo date( 'Y-m-d', strtotime( $download['access_expires'] ) ); ?>" title="<?php echo esc_attr( strtotime( $download['access_expires'] ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ); ?></time>
							<?php else : ?>
								<?php _e( 'Never', 'woocommerce' ); ?>
							<?php endif; ?>

						<?php elseif ( 'download-file' === $column_id ) : ?>
							<?php
								$actions = array(
									'download'  => array(
										'url'  => $download['download_url'],
										'name' => __( 'Download', 'woocommerce' )
									)
								);
								if ( $actions = apply_filters( 'woocommerce_account_download_actions', $actions, $download) ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="button woocommerce-Button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									}
								}
							?>

						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php else : ?>
	<div class="download_text">
	<?php esc_html_e( 'All downloads are available for 7 days. For any issues or further assistance email support@unison.audio.', 'woocommerce' ); ?>
	</div>
	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php esc_html_e( 'Go Shop', 'woocommerce' ) ?>
		</a>
		<?php esc_html_e( 'No downloads available yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_downloads', $has_downloads ); ?>
</div>
</section>

<?php 
get_footer();
?>