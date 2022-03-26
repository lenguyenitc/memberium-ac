<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}




class wpal_ecomm_data {

	
	static 
function get_unique_index( $data ){

		$key = bin2hex(random_bytes(4));
		if(  array_key_exists($key, $data) ){
			do {
				$key = bin2hex(random_bytes(4));
			}
			while ( array_key_exists($key, $data) );
		}
		return $key;
	}

	
	static 
function get_index_where( $data, $name, $value, $single = true ){
		$keys = array_keys(array_combine(array_keys($data),array_column($data,$name)),$value);
		if( $single ){
			return ( isset($keys[0]) ) ? $keys[0] : false;
		}
		else{
			return ( !empty($keys) ) ? $keys : false;
		}
	}

	
	static 
function product_types_select_data(){

		$ns = 'wpal_ecomm';

		return [
			[
				'id'	=> 'single',
				'text' 	=> __( 'Single Payment', $ns )
			],
			[
				'id'	=> 'subscription',
				'text' 	=> __( 'Subscription Payments', $ns )
			]
		];
	}

    
	static 
function currencies_data(){
		$data = [];
		$currencies = self::$currencies;
		$currencies = apply_filters('wpal/ecomm/allowed/currencies', $currencies);
		foreach ($currencies as $currency) {
			$data[] = [
				'id'	=> strtolower($currency['code']),
				'text' 	=> strtoupper($currency['code']) . ' - ' . $currency['name']
			];
		}
		return $data;
	}

	
	static 
function wpal_ecomm_order_form_admin_data(){

		$data = false;
		$products = [];
		$price_plans = [];

		$currency = isset($_POST['currency']) ? $_POST['currency'] : false;
		$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : false;
		$type = isset($_POST['type']) ? $_POST['type'] : false;
		if( ! wpal_ecomm()->is_pro_install() ){
			$type = 'single';
		}

				$merchants = self::merchants_select_data($currency);

				$product_posts = self::get_product_posts($type,$currency);

		if( $product_posts ){
			foreach ($product_posts as $key => $post) {
				$products[] = [
					'id'	 => $post->ID,
					'text'	 =>	"{$post->post_title} ({$post->ID})",
				];
			}
			if( (int)$product_id > 0 ){
				$id = array_search($product_id, array_column($products, 'id'));
				if ($id !== false) {
					$plan_meta_prefix = wpal_ecomm_products::PLAN_META_PREFIX;
					$args = [
						'meta_key' 	 => "{$plan_meta_prefix}currency",
						'meta_value' => $currency
					];
					$plans = self::get_product_plans($product_id,$args);
					if($plans){
						foreach ($plans as $key => $plan) {
							$price_plans[] = [
								'id'	 => $plan['id'],
								'text'	 =>	"{$plan['name']} ({$plan['id']})",
							];
						}
					}
				}
			}
		}

		wp_send_json_success( [
			'merchants' 	=> $merchants,
			'products'		=> $products,
			'price_plans'	=> $price_plans
		] );

	}

	
	static 
function get_product_posts($type,$currency){

		global $wpdb;
		$post_type = wpal_ecomm()->get_config('products_slug');
		$product_meta_prefix = wpal_ecomm_products::PRODUCT_META_PREFIX;
		$plan_meta_prefix = wpal_ecomm_products::PLAN_META_PREFIX;

		$sql = "SELECT DISTINCT product.ID, product.post_title
			FROM {$wpdb->posts} product";

		if( $type === 'single' ){
			$sql .= " LEFT JOIN {$wpdb->postmeta} single
				ON single.post_id = product.ID
				AND single.meta_key = '{$product_meta_prefix}type'
				LEFT JOIN {$wpdb->postmeta} currency
				ON currency.post_id = product.ID
				AND currency.meta_key = '{$product_meta_prefix}currency'
				WHERE product.post_status = 'publish'
				AND single.meta_value = 'single'
				AND single.post_id = currency.post_id
				AND product.post_parent = '0'";
		}
		else if( $type === 'subscription' ){
			$sql .= " INNER JOIN {$wpdb->posts} plan
				ON plan.post_parent = product.ID
				LEFT JOIN {$wpdb->postmeta} currency
				ON currency.post_id = plan.ID
				AND currency.meta_key = '{$plan_meta_prefix}currency'
				WHERE product.post_status = 'publish'";
		}

		$sql .= " AND currency.meta_value = '{$currency}'
			AND product.post_type = '{$post_type}'
			ORDER BY product.post_title, product.ID ASC";

		$posts = $wpdb->get_results( $sql );

		return ( is_null($posts) ) ? false : $posts;

	}

	
	static 
function get_product_plans( $product_id, $args = [] ){
		$plans = [];
		$products_slug = wpal_ecomm()->get_config('products_slug');
		$default = [
			'post_type' 		=> $products_slug,
			'posts_per_page' 	=> -1,
			'post_parent'		=> $product_id,
			'post_status'		=> 'publish',
			'fields'			=> ['ID','post_title','post_content']
	  	];
		$args = wp_parse_args( $args, $default );
		$query = new WP_Query( $args );
		if( $query->have_posts() ){
			foreach ($query->posts as $post) {
				$plan = json_decode($post->post_content, true);
				$plan['id'] = $post->ID;
				$plans[] = $plan;
			}
		}
		return $plans;
	}

		static 
function get_content_config( $post_id ){
		$config = false;
		$post = get_post($post_id);
		if( ! is_null($post) ){
			$config = json_decode($post->post_content, true);
			$config['id'] = $post_id;
		}
		return $config;
	}

	
	static 
function products_select_data( $args = false ){

		$data = [];
		$defaults = [
			'post_type'		=> wpal_ecomm()->get_config('products_slug'),
			'posts_per_page'=> -1,
			'post_status'	=> 'publish',
			'fields'		=> ['ID','post_title']
	  	];
		$args = ($args) ? wp_parse_args($args,$defaults) : $defaults;
		$query = new WP_Query( $args );
		if( $query->have_posts() ){
			foreach ($query->posts as $post) {
				$data[] = [
					'id'	 => $post->ID,
					'text'	 =>	"{$post->post_title} ({$post->ID})",
					'parent' => $post->post_parent
				];
			}
		}
		return $data;
	}

	
	static 
function merchants_select_data( $currency = false, $type = false ){

		$data = [];

		$profile_methods = wpal_ecomm()->settings->get_option('profile_methods');
		if( !empty($profile_methods) ){
			$methods =  wpal_ecomm()->settings->get_option_select('active_payment_methods');
						foreach ($profile_methods as $id => $profile) {
				$method = $profile['method'];
				if( in_array($method, $methods) ){
					$add = true;
					if( $currency ){
						$add = ( $currency === $profile['currency'] );
					}
					if( $add ){
						$data[] = [
							'id'	=>	$id,
							'text'  => $profile['name'],
							'html'	=>	"<span class=\"wpal-ecomm-method-icon {$method}\">{$profile['name']}</span>"
						];
					}
				}
			}
		}

		return $data;
	}

	
	static 
function thankyou_types_select_data(){

		$ns = 'wpal_ecomm';
		return [
			[
				'id' 	=> 'page',
				'text'	=> __('Existing Page', $ns)
			],
			[
				'id' 	=> 'url',
				'text'	=> __('URL', $ns)
			],
			[
				'id' 	=> 'custom',
				'text'	=> __('Custom Content', $ns)
			],
		];
	}

	
	static 
function subscription_intervals(){

		$ns = 'wpal_ecomm';

		return [
			[
				'id' 	=> 'day',
				'text'	=> __('Daily', $ns)
			],
			[
				'id' 	=> 'week',
				'text'	=> __('Weekly', $ns)
			],
			[
				'id' 	=> 'month',
				'text'	=> __('Monthly', $ns)
			],
			[
				'id' 	=> 'year',
				'text'	=> __('Yearly', $ns)
			],
			

		];
	}

	static 
function subscription_intervals_plural( $key = false ){
		$ns = 'wpal_ecomm';
		$data = [
			'day' 	=> __('days', $ns),
			'week' 	=> __('weeks', $ns),
			'month' => __('months', $ns),
			'year' 	=> __('years', $ns),
		];
		if( $key ){
			return $data[$key];
		}
		else{
			return $data;
		}
	}

	static 
function get_interval_billed_text( string $interval, int $bill_interval = 1 ){
		if( $bill_interval > 1 ){
			return sprintf( __( 'Billed every %s %s', 'wpal_ecomm' ), $bill_interval, self::subscription_intervals_plural($interval) );
		}
		else{
			$data = self::subscription_intervals();
			$i = array_search($interval, array_column($data, 'id'));
			$text = ( $data[$i] ) ? $data[$i]['text'] : '';
			return ( $text > '' ) ? sprintf( __( 'Billed %s', 'wpal_ecomm' ), $text ) : '';
		}
	}

	
	static 
function subscription_ends(){
		$ns = 'wpal_ecomm';

		return [
			[
				'id'	=> 'date',
				'text' 	=> __( 'Specific Date', $ns )
			],
			[
				'id'	=> 'count',
				'text' 	=> __( 'Number of Billing Intervals', $ns )
			],
			[
				'id'	=> 'infinite',
				'text' 	=> __( 'When Cancelled', $ns )
			]
		];
	}

    
	static 
function countries_data(){
		$data = [];
				$countries = self::get_countries();
		$countries = apply_filters('wpal/ecomm/allowed/countries', $countries);
        if( is_array( $countries ) ){
            foreach ($countries as $code => $country) {
    			$data[] = [
    				'id'	=> $code,
    				'text' 	=> $country
    			];
    		}
        }
		return $data;
	}

	
	static 
function order_status_select_data(){

		$data = [];
		$ns = 'wpal_ecomm';
		$statuses = apply_filters("wpal/ecomm/order/statuses", [
			'pending' 		=> __('Pending payment', $ns),
			'processing'	=> __('Processing payment', $ns),
			'hold'			=> __('On Hold', $ns),
			'completed'		=> __('Completed', $ns),
			'canceled'		=> __('Canceled', $ns),
			'refunded'		=> __('Refunded', $ns),
			'failed'		=> __('Failed', $ns),
		]);
        if( is_array( $statuses ) ){
            foreach ($statuses as $id => $text) {
    			$data[] = [
    				'id'	=> $id,
    				'text' 	=> $text
    			];
    		}
        }
		return $data;
	}

	
	static 
function subscription_status_select_data(){

		$data = [];
		$ns = 'wpal_ecomm';
		$statuses = apply_filters("wpal/ecomm/subscription/statuses", [
			'pending' 		=> __('Pending payment', $ns),
			'processing'	=> __('Processing payment', $ns),
			'trial'			=> __('Trial', $ns),
			'active'		=> __('Active', $ns),
			'expired'		=> __('Expired', $ns),
			'canceled'		=> __('Canceled', $ns),
			'past_due'		=> __('Past Due', $ns),
			'failed'		=> __('Failed', $ns),
			'unpaid'		=> __('Unpaid', $ns),
		]);

        if( is_array( $statuses ) ){
            foreach ($statuses as $id => $text) {
    			$data[] = [
    				'id'	=> $id,
    				'text' 	=> $text
    			];
    		}
        }
		return $data;
	}


	
	static $currencies = [
		"CAD"	=>	[
			"code"				=> "CAD",
			"symbol"			=> "$",
			"html"				=> "&#36;",
			"name"				=> "Canadian Dollar",
			"name_plural"		=> "Canadian dollars"
		],
		"USD"	=>	[
			"code"				=>	"USD",
			"symbol"			=>	"$",
			"html"				=> "&#36;",
			"name"				=>	"US Dollar",
			"name_plural"		=>	"US dollars"
		],
		"EUR"	=> [
			"code"				=> "EUR",
			"symbol"			=> "€",
			"html"				=> "&#8364;",
			"name"				=> "Euro",
			"name_plural"		=> "euros"
		],
		"GBP"	=> [
			"code"				=> "GBP",
			"symbol"			=> "£",
			"html"				=> "&#163;",
			"name"				=> "British Pound Sterling",
			"name_plural"		=> "British pounds sterling"
		],
		'AUD'	=>	[
			"code"				=> "AUD",
			"symbol"			=> "$",
			"html"				=> "&#36;",
			"name"				=> "Australian Dollar",
			"name_plural"		=> "Australian dollars"
		],
		'NZD'	=>	[
			"code"				=> "NZD",
			"symbol"			=> "$",
			"html"				=> "&#36;",
			"name"				=> "New Zealand Dollar",
			"name_plural"		=> "New Zealand dollars"
		]
	];

	
	static 
function get_countries( $value = 'countryName', $id = 'countryShortCode' ){

		if( !empty(self::$countries) ){
			return self::$countries;
		}

		$cr_data = self::get_country_region_data();
		$countries = wp_list_pluck( $cr_data, $value, $id );
		return $countries;
	}

	
	static 
function get_country_region_data(){

		if( !empty(self::$country_region_data) ){
			return self::$country_region_data;
		}
		$cr_data = get_option('wpal/ecomm/country_region_data', false);
		if($cr_data){
			$cr_data = apply_filters('memberiumpay/country/region/data', $cr_data);
			self::$country_region_data = $cr_data;
			return self::$country_region_data;
		}
		else {
			$assets = wpal_ecomm()->get_config('assets_url');
			$url = "{$assets}country-region-data.json";
			$request = wp_remote_get($url,['sslverify' => false]);
			if( is_wp_error( $request ) ) {
				$msg = $request->get_error_message();
				if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : {$msg}" );
				return [];
			}
			$body    = wp_remote_retrieve_body( $request );
			$cr_data = json_decode( $body, true );
			$cr_data = apply_filters('memberiumpay/country/region/data', $cr_data);
			self::$country_region_data = $cr_data;
			add_option('wpal/ecomm/country_region_data', self::$country_region_data, false, false);
			return self::$country_region_data;
		}
	}

	
	static 
function get_currency_symbol_by_code($code, $html = false){
		$symbol = '';
		$code = ($code > '') ? strtoupper($code) : false;
		if($code){
			$currencies = wpal_ecomm_data::$currencies;
			if( isset($currencies[$code]) ){
				$key = $html ? 'html' : 'symbol';
				$symbol = $currencies[$code][$key];
			}
		}
		return $symbol;
	}

	static 
function default_currency_symbol(){
		$currency = wpal_ecomm()->settings->get_option('default_currency');
		return wpal_ecomm_data::get_currency_symbol_by_code($currency);
	}

	
	static $country_region_data = false;

    
	static $countries = false;

	
	static 
function payment_methods_select_data(){

		$data = [];
		$registered_payment_methods = wpal_ecomm()->settings->get_option_select('registered_payment_methods');

		if( is_array($registered_payment_methods) ){
			foreach ($registered_payment_methods as $method) {
				$id     = strtolower($method);
				$data[] = [
					'id'   => $id,
					'text' => ucfirst($id)
				];
			}
		}

		return $data;
	}

	
	static 
function active_payment_methods_select_data(){

		$data = [];
		$active_payment_methods = wpal_ecomm()->settings->get_option_select('active_payment_methods');
		if( is_array($active_payment_methods) ){
						foreach ($active_payment_methods as $method) {
				$method_class = wpal_ecomm()->get_merchant($method);
				$data[] = [
					'id'    => strtolower($method),
					'text'  => $method_class->get_name()
				];
			}
		}

		return $data;
	}
}
