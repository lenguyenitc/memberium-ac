<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_reports {
	private static $instance = false;

	private $start_date   = '';
	private $end_date     = '';
	private $new_business = 0;
	private $merchants    = [];
	private $products     = [];
	private $leaderboard  = [];
	private $plans        = [];

	
function __construct() {
		$today          = date('Y-m-d');
		$this->products = wpal_ecomm_products::get_all_products_and_plans();
		add_action('admin_footer', [__CLASS__, 'admin_footer'], PHP_INT_MAX);
	}

	static 
function get_instance() {
		if (! self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	
function set_start_date($start_date) {
		$this->start_date                = $start_date;
		$this->leaderboard['start_date'] = $start_date;
	}

	
function get_start_date() {
		return $this->start_date;
	}

	
function set_end_date($end_date) {
		$this->end_date                = $end_date;
		$this->leaderboard['end_date'] = $end_date;
	}

	
function get_end_date() {
		return $this->end_date;
	}

	
function set_new_business_only( $bool ){
		$this->new_business = $bool;
	}

	
function get_new_business_only(){
		return $this->new_business;
	}

	private 
function init_leaderboard() {
		$this->leaderboard = [];
		$this->merchants   = wpal_ecomm()->get_merchants();
		$this->plans       = $this->get_plans();


		$this->leaderboard['plan_types'] = [
			'subscription' => 0,
			'single'       => 0,
		];

		foreach($this->merchants as $k => $v) {
			$this->leaderboard['merchants'][$k] = [
				'count' => 0,
			];
			$this->leaderboard['start_date'] = $this->get_start_date();
			$this->leaderboard['end_date']   = $this->get_end_date();
		}

		foreach($this->plans as $id => $plan) {
			$data     = json_decode($plan['post_content'], true);
			$currency = isset($data['currency']) ? $data['currency'] : '';

			if (! empty($currency)) {
				$bill_interval = !empty($data['bill_interval']) ? $data['bill_interval'] : 1;
				$this->leaderboard['plans'][$id] = [
					'name'     => $plan['post_title'],
					'count'    => 0,
					'revenue'  => 0,
					'currency' => $currency,
					'interval' => $bill_interval . ' ' . $data['interval'],
				];

				foreach($this->leaderboard['merchants'] as $id => $merchant) {
					$this->leaderboard['merchants'][$id][$currency] = 0;
				}
			}
		}

		return $this->leaderboard;
	}

	private 
function get_plans() {
		static $plans = [];

		if (empty($plans) ) {
			$products = wpal_ecomm_products::get_all_products_and_plans();
			$plans    = [];

			foreach($products as $product_index => $product) {
				$product_id                         = $product['ID'];
				$plans[$product_id]['post_title']   = $product['post_title'];
				$plans[$product_id]['post_content'] = $product['post_content'];

				if (! empty($product['plans']) && is_array($product['plans'])) {
					foreach($product['plans'] as $plan_index => $plan) {
						$plan_id                         = $plan['ID'];
						$plans[$plan_id]['post_title']   = $plan['post_title'];
						$plans[$plan_id]['post_content'] = $plan['post_content'];
					}
				}

				unset($plans[$product['ID']]['plans']);
			}
		}

		return $plans;
	}

	private 
function render_report_data(){

		$data = $this->leaderboard;

		if (! is_array($data) || empty($data)) {
			return;
		}

		$ns = "wpal_ecomm";
		$report = [
			'generated' => [
				'version'			=> 'v20201015',
				'start'				=> empty($data['start_date']) ? 'All Time' : $data['start_date'],
				'end'				=> empty($data['end_date']) ? 'All Time' : $data['end_date'],
				'new_business_only'	=> $this->get_new_business_only() ? 'Yes' : 'No'
			]
		];
		if (! empty($data['plan_types'])) {

			$report['product_types'] = [
				'label'			=> __('Product Type Breakdown', $ns),
				'total'			=> empty($data['transactions']) ? 0 : (int)$data['transactions'],
				'data'			=> [
					'subscription'	=> empty($data['plan_types']['subscription']) ? 0 : (int)$data['plan_types']['subscription'],
					'single'		=> empty($data['plan_types']['single']) ? 0 : (int)$data['plan_types']['single']
				]
			];
		}
		if (! empty($data['merchants'])) {

			$report['merchants'] = [
				'label' => __('Merchant Processor Breakdown', $ns),
				'data'	=> [],
				'total'	=> 0
			];
			$total = 0;

			uasort($data['merchants'], function($a, $b) {
				if ($a['usd'] == $b['usd']) {
					return 0;
				}
				return ($a['usd'] < $b['usd']) ? -1 : 1;
			});

			foreach($data['merchants'] as $id => $metrics) {
				$collected = empty($metrics['usd']) ? 0 : $metrics['usd'];
				$total     = $total + $collected;
				$collected = $this->price_no_commas($collected);
				$report['merchants']['data'][$id] = [
					'orders'	=> empty($metrics['count']) ? 0 : (int)$metrics['count'],
					'collected' => $collected
				];
			}
			$report['merchants']['total'] = $this->price_no_commas($total);
		}

		if (! empty($data['plans'])) {
			$report['plans'] = [
				'label'	=> __('Product Sales Breakdown', $ns),
				'data'	=> []
			];
			uasort($data['plans'], function($a, $b) {
				$a_us = !empty($a['usd']) ? $a['usd'] : 0;
				$b_us = !empty($b['usd']) ? $b['usd'] : 0;
				if ($a_us == $b_us) {
					return 0;
				}
				return ($a_us > $b_us) ? -1 : 1;
			});

			foreach($data['plans'] as $plan_id => $details) {
				$details['interval'] = isset($details['interval']) ? $details['interval'] : '';
				$report['plans']['data'][$plan_id] = [
					'label'		=> "{$details['name']} {$details['interval']}",
					'sold'		=> (int)$details['count'],
					'revenue'	=> !empty($details['usd']) ? $this->price_no_commas($details['usd']) : 0
				];
			}
		}

		return $report;

	}

	private 
function render_report() {

		$leaderboard = $this->leaderboard;

		if (! is_array($leaderboard) || empty($leaderboard)) {
			return;
		}

		if( empty($leaderboard['report']) ){
			$leaderboard['report'] = $this->render_report_data();
		}

		$html = "";

		$data = $leaderboard['report'];
		$html .= "<section id=\"generated-results\" class=\"postbox\">";
		$html .= "<p class=\"report-version\">Report {$data['generated']['version']}</p>";
		$html .= "<h2>Generated Report Details</h2>";

		$html .= "<div class=\"grid-fields\">";
			$html .= "<label class=\"field-col\">Start Date: {$data['generated']['start']}</label>";
			$html .= "<label class=\"field-col\">End Date: {$data['generated']['end']}</label>";
			$html .= "<label class=\"field-col\">New Business Only: {$data['generated']['new_business_only']}</label>";
			$html .= "<label class=\"field-col\"/>";
			$html .= wpal_ecomm_export::export_orders_link([
				'start_date'        => $this->get_start_date(),
				'end_date'          => $this->get_end_date(),
				'new_business_only' => $this->get_new_business_only()
			]);
			$html .= "</label>";

		$html .= "</div>";
		$html .= "</section>";

		$html .= "<section class=\"wpal-ecomm-report-grid\">";

		if (! empty($data['product_types'])) {
			$html .= "<div id=\"product_types\" class=\"wpal-ecomm-report-types postbox\">";
				$html .= "<h2>{$data['product_types']['label']}</h2>";
				$html .= "<div class=\"graph\">";
					$html .= "<div class=\"graph-inner\">";
						$html .= "<canvas id=\"chartjs-product_types\" class=\"chartjs\"></canvas>";
					$html .= "</div>";
				$html .= "</div>";
				$html .= "<div class=\"details\">";
					$html .= "<p><strong>Product Types</strong></p>";
					$html .= "<p>New Subscriptions: {$data['product_types']['data']['subscription']}</p>";
					$html .= "<p>One Time Orders: {$data['product_types']['data']['single']}</p>";
					$html .= "<hr>";
					$html .= "<p>Total Transactions: {$data['product_types']['total']}</p>";
				$html .= "</div>";
			$html .= "</div>";
		}

		if (! empty($data['merchants'])) {
			$html .= "<div id=\"merchants\" class=\"wpal-ecomm-report-types postbox\">";
				$html .= "<h2>{$data['merchants']['label']}</h2>";
				$html .= "<div class=\"graph\">";
					$html .= "<div class=\"graph-inner\">";
						$html .= "<canvas id=\"chartjs-merchants\" class=\"chartjs\"></canvas>";
					$html .= "</div>";
				$html .= "</div>";
				$html .= "<div class=\"details\">";
				foreach ($data['merchants']['data'] as $id => $merchant) {
					$html .= "<div class=\"merchant-col\">";
					$html .= "<p><strong>" . ucwords($id) . "</strong></p>";
					$html .= "<p>Total Orders: {$merchant['orders']}</p>";
					$html .= "<p>Collected (USD): $" . $this->price($merchant['collected']) . "</p>";
					$html .= "</div>";
				}
				$html .= "<hr>";
				$html .= "<p>Total Collected (USD): $" . $this->price($data['merchants']['total']) . "</p>";
				$html .= "</div>";
			$html .= "</div>";
		}

		$html .= "</section>";

		if (! empty($data['plans'])) {
			$html .= "<div id=\"plans\" class=\"wpal-ecomm-report-types postbox\">";
				$html .= "<h2>{$data['plans']['label']}</h2>";
				$html .= "<div class=\"graph\">";
					$html .= "<div class=\"graph-inner\">";
						$html .= "<canvas id=\"chartjs-plans\" class=\"chartjs\"></canvas>";
					$html .= "</div>";
				$html .= "</div>";
				$html .= "<h2>All Products</h2>";
				$html .= "<div class=\"details\">";
				foreach($data['plans']['data'] as $plan_id => $plan) {
					$html .= "<p><strong>{$plan['label']}</strong><br />";
					$html .= "Units Sold: {$plan['sold']}<br>";
					$html .= "Revenue: $" . $this->price($plan['revenue']) . "<br>";
					$html .= "</p>";
				}
				$html .= "</div>";
			$html .= "</div>";
		}

		return $html;
	}

	
function run( $args ) {
		$this->leaderboard = $this->init_leaderboard();

		$default_start_date = date('Y-m-01');
		$default_end_date   = date('Y-m-d');

		if (! empty($args['start_date'])) {
			$default_start_date = date('Y-m-d', strtotime($args['start_date']) );
		}

		if (! empty($args['end_date'])) {
			$default_end_date = date('Y-m-d', strtotime($args['end_date']) );
		}

		$new_business_only = ! empty($args['new_business_only']);

		$this->set_start_date($default_start_date);
		$this->set_end_date($default_end_date);
		$this->set_new_business_only( $new_business_only ? 1 : 0 );

		$plans = $this->get_plans();
		$params = [
			'start_date'        => $this->get_start_date(),
			'end_date'          => $this->get_end_date(),
			'new_business_only' => $this->get_new_business_only(),
		];

		$orders = wpal_ecomm_orders::get_orders_by_payment_date($params);

		foreach($orders as $k => $order_id) {
			$parent_id         = get_post_field('post_parent', $order_id, 'raw');
			$is_invoice        = ! empty($parent_id);
			$invoice_id        = $is_invoice ? $order_id : false;
			$parent_id         = empty($parent_id) ? $order_id : $parent_id;
			$post_id           = $order_id;
			$order_type        = strtolower(get_post_meta($parent_id, '/wpal/ecomm/order/type', true) );
			$merchant          = strtolower(get_post_meta($parent_id, '/wpal/ecomm/order/merchant', true) );
			$currency          = strtolower(get_post_meta($parent_id, '/wpal/ecomm/order/currency', true) );
			$plan_id           = (int) get_post_meta($parent_id, '/wpal/ecomm/order/product/id', true);
			$line_item         = get_post_meta($parent_id, '/wpal/ecomm/order/line/item', true);
			$price             = isset($line_item['total']) ? $line_item['total'] : 0;
			$quantity          = isset($line_item['qty'])   ? $line_item['qty'] : 1;
			$plan_type         = isset($line_item['type'])  ? $line_item['type'] : '';
			$payment_collected = false;
			$post_date         = get_the_date('', $post_id);
			$is_sandbox        = (bool) get_post_meta($post_id, '/wpal/ecomm/order/sandbox', true);
			$is_trial          = false;

			if ($order_type == 'single') {
				$status =  get_post_meta($post_id, '/wpal/ecomm/order/status', true);
				$payment_collected = 'completed' == $status;
			}
			else if ($order_type == 'subscription') {

								if( $new_business_only && ! $invoice_id ){
					$invoice_id = (int) wpal_ecomm()->functions()->get_first_invoice_id($parent_id);
				}

				if( !empty($invoice_id) ){
					$status = get_post_meta($invoice_id, '/wpal/ecomm/invoice/status', true);
					$payment_collected = 'paid' == $status;
				}

				if ( $payment_collected && $invoice_id ) {
					$price    = get_post_meta($invoice_id, "_wpal/ecomm/payment/paid", true);
					$price    = $price ? $this->price_no_commas($price) : 0;
					$is_trial = ( $price < 1 && ! empty($line_item['trial']) );
				}
			}

			if ($payment_collected) {
				if (! $plan_id) {
					if (isset($line_item['plan_id']) ) {
						$plan_id = isset($line_item['plan_id']) ? $line_item['plan_id'] : 0;
					}
				}
			}

			if ($payment_collected && $price > 0 || $payment_collected && $is_trial) {
				if ($plan_id) {
					$this->leaderboard['plans'][$plan_id]['name'] = $plans[$plan_id]['post_title'];
					if ($payment_collected) {
						if(!isset($this->leaderboard['plans'][$plan_id]['count'])){
							$this->leaderboard['plans'][$plan_id]['count'] = 0;
						}
						$this->leaderboard['plans'][$plan_id]['count'] = $this->leaderboard['plans'][$plan_id]['count'] + $quantity;
						if(!isset($this->leaderboard['plans'][$plan_id][$currency])){
							$this->leaderboard['plans'][$plan_id][$currency] = 0;
						}
						$this->leaderboard['plans'][$plan_id][$currency] = $this->price_no_commas($this->leaderboard['plans'][$plan_id][$currency] + $price);
					}
					else {
						$this->leaderboard['plans'][$plan_id]['unpaid_count'] = $this->leaderboard['plans'][$plan_id]['count'] + $quantity;
						$this->leaderboard['plans'][$plan_id]["Unpaid {$currency}"] = $this->price_no_commas($this->leaderboard['plans'][$plan_id][$currency] + $price);
					}
				}

				if (! empty($merchant) ) {
					$this->leaderboard['merchants'][$merchant]['count']++;
					$this->leaderboard['plan_types'][$plan_type]++;

					if(! empty($currency) && ! isset($this->leaderboard['merchants'][$merchant][$currency]) ){
						$this->leaderboard['merchants'][$merchant][$currency] = 0;
					}

					if (! empty($price) ) {
						$this->leaderboard['merchants'][$merchant][$currency] = $this->price_no_commas($this->leaderboard['merchants'][$merchant][$currency] + $price);
					}
				}
			}


						if (false) {
				$url = admin_url('post.php?post=');
				if ($payment_collected) {
					$name = $this->leaderboard['plans'][$plan_id]['name'];

					if ($post_id == $parent_id) {
						$link = "<a href=\"{$url}{$post_id}&action=edit\" target=\"_blank\">{$post_id}</a>";
					}
					else {
						$link = "<a href=\"{$url}{$parent_id}&action=edit\" target=\"_blank\">{$parent_id}</a>";
					}

					echo $post_date, ' ', $link, ':  ', $order_type, ' - ', $status, ' - $', $price, ' ', $currency, ' / ', $name;
					echo " Merchant {$merchant}";
					echo $is_sandbox ? ' Sandbox' : '';
					echo $is_trial ? ' Trial' : '';
					echo '<br>';
				}
				else{
					if ($post_id == $parent_id) {
						$link = "<a href=\"{$url}{$post_id}&action=edit\" target=\"_blank\">{$post_id}</a>";
					}
					else {
						$link = "<a href=\"{$url}{$parent_id}&action=edit\" target=\"_blank\">{$parent_id}</a>";
					}
					echo "Not collected {$link}<br>";
				}
			}

		}
		$types = empty($this->leaderboard['plan_types']) ? [] : $this->leaderboard['plan_types'];
		$single = empty($types['single']) ? 0 : number_format($types['single']);
		$subscription = empty($types['subscription']) ? 0 : number_format($types['subscription']);
		$this->leaderboard['transactions'] = $single + $subscription;
		$this->leaderboard['report'] = $this->render_report_data();
		$this->leaderboard['html'] = $this->render_report();

		return $this->leaderboard;
	}

	
function price_no_commas($price){
		return number_format( str_replace(' ', '', $price), 2, '.', '');
	}

	
function price($price){
		return number_format(str_replace(' ', '', $price), 2);
	}

	static 
function admin_footer(){
				wp_enqueue_script('wpal_ecomm_chart_js');
		$data = self::get_instance()->leaderboard['report'];
		$data['currency_symbol'] = wpal_ecomm_data::default_currency_symbol();
		?>
		<script>
		(function( $ ) {
			'use strict';
			$(function() {
				var reports = <?php echo json_encode( $data, JSON_PRETTY_PRINT ); ?>,
					currencySymbol = reports.currency_symbol,
					rgbs = [
						'51,102,204', '220,57,18', '255,153,0', '16,150,24', '153,0,153',
						'59,62,172', '0,153,198', '221,68,119', '102,170,0', '184,46,46',
						'49,99,149', '153,68,153', '34,170,153', '170,170,17', '102,51,204',
						'230,115,0', '139,7,7', '50,146,98', '85,116,166', '59,62,172'
					 ];
				/*
				console.log({
					reports:reports
				});
				*/
				var renderProductTypes = function($el, data){
					var args = {
						type: 'doughnut',
						data: {
							labels: [ "Subscriptions", "One Time Orders" ],
							datasets: [{
								data: [ data.subscription, data.single ],
								backgroundColor:["rgb(51, 165, 50)","rgb(184,28,21)"]
							}]
						}
					};
					new Chart($el, args);
				};

				var renderMerchants = function($el, data){
					var args = {
						type: 'doughnut',
						data: {
							labels:  [ 'Paypal', 'Stripe' ],
							datasets: [{
								label:'Merchant Revenue',
								fill:false,
								data:[ data.paypal.collected, data.stripe.collected ],
								backgroundColor: [ "rgb(255,196,57, 0.8)", "rgb(66,134,204, 0.8)" ],
								borderColor:["rgb(255,196,57)", "rgb(66,134,204)"],
								borderWidth:1
							}]
						},
						options: {
							tooltips: currencyTooltips()
						}
					};
					new Chart($el, args);
				};

				var renderPlans = function($el, data){
					var earners = [],
						labels = [],
						bgColors = [],
						borderColors = [],
						colourIndex = 0;
					for( var id in data ){
						var revenue = parseFloat(data[id].revenue);
						if( revenue > 0 ){
							earners.push(revenue);
							labels.push(data[id].label);
							colourIndex = ! rgbs.hasOwnProperty(colourIndex) ? 0 : colourIndex;
							bgColors.push( "rgb("+rgbs[colourIndex]+", 0.2)" );
							borderColors.push( "rgb("+rgbs[colourIndex]+")" );
							colourIndex += 1;
						}
					}
					var args = {
						type: 'bar',
						data: {
							labels:  labels,
							datasets: [{
								label:'Product Revenue',
								fill:false,
								data:earners,
								backgroundColor: bgColors,
								borderColor:borderColors,
								minBarLength: 5,
								borderWidth:1
							}]
						},
						options: {
							tooltips: currencyTooltips(),
							scales:{
								yAxes:[{
									ticks:{
										beginAtZero:true,
										// Include a dollar sign in the ticks
										callback: function(value, index, values) {
											return currencySymbol + value;
										}
									}
								}]
							}
						}
					};
					new Chart($el, args);
				};

				var currencyTooltips = function(){
					return {
						mode: 'label',
						callbacks: {
							label: function(tooltipItem, tipData) {
								return currencySymbol + displayPrice(tipData['datasets'][0]['data'][tooltipItem['index']]);
							}
						}
					};
				};

				// Format Price with conditional commas and decimals
				var displayPrice = function(amount){
					return parseFloat(amount).toLocaleString(undefined, {
						minimumFractionDigits: 2,
						maximumFractionDigits: 2
					});
				};

				if( reports.hasOwnProperty('product_types') ){
					var $productTypes = document.getElementById('chartjs-product_types').getContext('2d');
					if( $productTypes !== null ){
						renderProductTypes($productTypes, reports.product_types.data);
					}
				}

				if( reports.hasOwnProperty('merchants') ){
					var $merchant = document.getElementById('chartjs-merchants').getContext('2d');
					if( $merchant !== null ){
						renderMerchants($merchant, reports.merchants.data);
					}
				}

				if( reports.hasOwnProperty('plans') ){
					var $plans = document.getElementById('chartjs-plans').getContext('2d');
					if( $plans !== null ){
						renderPlans($plans, reports.plans.data);
					}
				}
			});
		})( jQuery );
		</script>
		<?php
	}

}
