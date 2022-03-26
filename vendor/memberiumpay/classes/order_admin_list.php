<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_order_admin_list {

    
	static 
function add_hooks($post_type) {
		if( empty($_GET['delete-any']) ){
			add_filter("post_row_actions", [__CLASS__,'order_list_row_actions'], 100, 2);
		}
		add_filter("bulk_actions-edit-{$post_type}", '__return_empty_array', 100);
        add_action('admin_head-edit.php',[__CLASS__, 'order_titles']);
        add_filter("manage_{$post_type}_posts_columns" , [__CLASS__, 'order_columns']);
        add_filter("manage_{$post_type}_posts_custom_column", [__CLASS__, 'order_column'], 10, 2);
        add_action("restrict_manage_posts", [__CLASS__,'orders_admin_list_ui'] );
        add_filter("parse_query", [__CLASS__,'orders_admin_list_filter'], 11, 1);
        add_filter("months_dropdown_results", "__return_empty_array");
        add_action("admin_enqueue_scripts", [__CLASS__, 'enqueue_filter_scripts']);
		add_filter("views_edit-{$post_type}", [__CLASS__,'order_list_quicklinks']);
    }

	static 
function order_list_quicklinks( $views ){
		return [];
	}

    	static 
function order_list_row_actions($actions, $post){
		if( isset($actions['edit']) && isset($actions['trash']) ){
			$sandbox = wpal_ecomm()->functions()->is_sandbox_order($post->ID);
			$filtered = [
				'edit' => $actions['edit']
			];
			if( $sandbox ){
				$filtered['trash'] = $actions['trash'];
			}
			return $filtered;
		}
		else {
			return $actions;
		}
	}

    	static 
function order_titles(){
		add_filter('the_title', function( $title, $post_id ) {
			$full_name = wpal_ecomm()->functions()->generate_full_name($post_id);
			return "{$title} {$full_name}";
		}, 10, 2 );
	}

		static 
function order_columns( $columns ){
		unset($columns['cb'], $columns['date']);
		$pos = array_search('title', array_keys($columns));
		$pos ++;
		return array_merge(
			array_slice($columns, 0, $pos),
			[ 'email' 	=> __('Email', 'wpal_ecomm') ],
			[ 'details'	=> __('Details', 'wpal_ecomm') ],
			[ 'status'	=> __('Status', 'wpal_ecomm') ],
			[ 'dates'	=> __('Dates', 'wpal_ecomm') ],
			array_slice($columns, $pos)
		);
	}

		static 
function order_column( $column, $post_id ){
		if( $column === 'email' ){
			$email = get_post_meta($post_id, "billing_email", true);
			if( $email > ''){
				echo $email;
			}
		}
		if( $column === 'details' ){
			$type = wpal_ecomm()->functions()->get_order_type($post_id);
			if( $type === 'subscription' ){
				echo wpal_ecomm()->functions()->get_subscription_details($post_id);
			}
						else {
				echo wpal_ecomm()->functions()->get_order_details($post_id);
			}
		}
		if( $column === 'status' ){
			$status = wpal_ecomm()->functions()->get_order_status_text($post_id);
			echo '<span class="wpal-ecomm-order-status">'.$status.'</span>';
		}
		if( $column === 'dates' ){
			$meta = wpal_ecomm()->functions()->get_order_metadata($post_id);
			$dates = [
				"date_created" 			=> __('Created', 'wpal_ecomm'),
				"subscription/modified"	=> __('Subscription Modified', 'wpal_ecomm'),
				"canceled/date"			=> __('Cancel Requested', 'wpal_ecomm')
			];
			$string = '<span class="wpal-ecomm-date-title">%s :</span><span class="wpal-ecomm-date-display">%s</span>';
			foreach ($dates as $key => $label) {
				$date = wpal_ecomm()->functions()->formated_order_date($meta, $key);
				if($date > ''){
					printf($string, $label, $date);
				}
			}
		}
	}

        static 
function orders_admin_list_ui(){
		$statuses = self::order_status_filter();
		$status = !empty($_GET['order-status']) ? esc_attr($_GET['order-status']): 'all';
		$from = !empty($_GET['order-date-from']) ? esc_attr($_GET['order-date-from']) : '';
		$to = !empty($_GET['order-date-to']) ? esc_attr($_GET['order-date-to']) : '';
		$product_data = self::order_products_filter();
		$products = !empty($_GET['order-products']) ? $_GET['order-products'] : [];
		include WPAL_ECOMM_TMPL_DIR . 'admin/admin-list-order-filters.php';
	}

        static 
function enqueue_filter_scripts(){
		        $wpal_select_woo_js = apply_filters('wpalSelect2/js/src', '');
        wp_enqueue_script('wpalSelect2',$wpal_select_woo_js,['jquery'],'1.0.4');
        $wpal_select_woo_css = apply_filters('wpalSelect2/css/src', '');
        wp_enqueue_style('wpalSelect2',$wpal_select_woo_css,false,'5.7.2');
		wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css');
		wp_enqueue_script('jquery-ui-datepicker');
	}

		static 
function orders_admin_list_filter( $query ){

		$paged = !empty($query->query['paged']) ? (int)$query->query['paged'] : 1;
		$per_page = !empty($query->query['posts_per_page']) ? (int)$query->query['posts_per_page'] : 20;

		$meta_query = [];
		$prefix = wpal_ecomm()->functions()->get_prefix();
		$search_string = ( !empty($_GET['s']) && !is_numeric($_GET['s']) ) ? strtolower($_GET['s']) : false;
		if( $search_string ){
						$query->set('s', '' );
			unset($query->query['s']);
			$query->is_search = false;

			$email_search = filter_var($search_string, FILTER_VALIDATE_EMAIL);
			if( $email_search ){
				$meta_query['email_clause'] = [
					'key'		=> "billing_email",
					'value'		=> $search_string,
					'compare'	=> 'LIKE'
				];
				add_filter('get_search_query', function() use($search_string) {
					return  sprintf(__('Billing Email : %s'), $search_string);
				});
			}
		}

				$status = ( !empty($_GET['order-status']) ) ? esc_attr($_GET['order-status']) : false;
		$statuses = wp_list_pluck(self::order_status_filter(), 'text', 'id');
		if( $status && $status !== 'all' && array_key_exists($status, $statuses) ){
			$status_key = "{$prefix}status";
			if($status === 'failed'){
				$meta_query['status_clause'] = [
					'key'		=> $status_key,
					'value'		=> ['failed', 'past_due', 'unpaid'],
					'compare'	=> 'IN'
				];
			}
			else{
				$meta_query['status_clause'] = [
					'key'		=> $status_key,
					'value'		=> $status,
					'compare'	=> '='
				];
			}
		}

				$from = !empty($_GET['order-date-from']) ? esc_attr($_GET['order-date-from']) : '';
		$to = !empty($_GET['order-date-to']) ? esc_attr($_GET['order-date-to']) : '';
		if( $from > '' || $to > '' ){
						if( $from > '' && $to > '' ){
				$from_range = self::day_start_end($from);
				$to_range = self::day_start_end($to);
				$date_query = [
					'value'		=> [ $from_range['start'], $to_range['end'] ],
					'type'		=> 'numeric',
					'compare'	=> 'BETWEEN'
				];
			}
						else if( $from > '' ){
				$date_query = [
					'value'		=> $from,
					'type'		=> 'numeric',
					'compare'	=> '>='
				];
			}
						else if( $to > '' ){
				$date_query = [
					'value'		=> $to,
					'type'		=> 'numeric',
					'compare'	=> '<='
				];
			}
						$created = $modified = $date_query;
			$created['key'] = "{$prefix}date_created";
			$modified['key'] = "{$prefix}subscription/modified";
			$meta_query['order_date_query'] = [
				'relation' 		=> 'OR',
								'created'	=> $created,
								'modified' => [
					'relation'		=> 'AND',
					'subscriptions'	=> [
						'key'		=> "{$prefix}type",
						'value'		=> 'subscription',
						'compare'	=> '='
					],
					$modified
				]
			];
		}

				$products = !empty($_GET['order-products']) ? $_GET['order-products'] : [];
		if( !empty($products) ){
			$product_ids = $plan_ids = [];
			foreach ($products as $product) {
				$plan = explode('-', $product);
				if( !empty($plan[1]) ){
					$plan_ids[] = $plan[1];
				}
                else{
					$product_ids[] = $product;
				}
			}
			$product_count = count($product_ids);
			$plan_count = count($plan_ids);
			if( $product_count > 0 || $plan_count > 0 ){
				$meta_query['order_product_query'] = [];
				if( $product_count > 0 && $plan_count > 0 ){
					$meta_query['order_product_query']['relation'] = 'OR';
				}
				if( $product_count > 0 ){
					$meta_query['order_product_query'][] = [
						'key'		=> "{$prefix}product/id",
						'value'		=> ( $product_count > 1 ) ? $product_ids : $product_ids[0],
						'compare'	=> ( $product_count > 1 ) ? 'IN' : '='
					];
				}
				if( $plan_count > 0 ){
					$meta_query['order_product_query'][] = [
						'key'		=> "{$prefix}plan/id",
						'value'		=> ( $plan_count > 1 ) ? $plan_ids : $plan_ids[0],
						'compare'	=> ( $plan_count > 1 ) ? 'IN' : '='
					];
				}
			}
		}

				if( !empty($meta_query) ){
			if( count($meta_query) > 1 ){
				$meta_query['relation'] = 'AND';
			}
			$query->set('meta_query',$meta_query);
			if( $paged > 1 ){
				$query = self::manage_query_paged($query, $paged, $per_page);
			}
		}

		return $query;
	}

	static 
function manage_query_paged($query, $paged, $per_page) {

		remove_action( 'parse_query', [__CLASS__, 'orders_admin_list_filter'], 11 );
		$dummy_vars = $query->query_vars;
		$dummy_vars['paged'] = 1;
		$dummy_vars['posts_per_page'] = -1;
		$dummy_query = new WP_Query($dummy_vars);
		$found = $dummy_query->found_posts;
		if( $found >= $per_page ){
			$num_pages = ceil($found / $per_page);
		}
		else{
			$num_pages = 1;
		}
		if( $paged > $num_pages ){
			$query->set('paged', 1);
			$query = $query->query($query->query_vars);
		}
		return $query;
	}

    static 
function order_status_filter(){
        $ns = 'wpal_ecomm';
        $statuses = apply_filters("wpal/ecomm/order/statuses", [
			'all'				=> __('All', $ns),
			'active'			=> __('Active',$ns),
			'cancel-pending'	=> __('Cancel Pending', $ns),
			'canceled'			=> __('Canceled', $ns),
			'completed'			=> __('Completed', $ns),
			'failed' 			=> __('Failed', $ns),
			'refunded'			=> __('Refunded', $ns),
			'trial'				=> __('Trial', $ns),
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
function order_products_filter(){
		$data = [];
		$products = wpal_ecomm_products::get_all_products_and_plans();
		if( $products ){
			foreach ($products as $index => $p) {
				$plans = ( !empty($p['plans']) && is_array($p['plans']) && count($p['plans']) > 0 ) ? $p['plans'] : false;
				$data[$index] = [
					'id'	=> $p['ID'],
					'text'	=> $p['post_title']
				];
				if( $plans ){
					$children = [];
					foreach ($plans as $plan) {
						$children[] = [
							'id'	=> "{$p['ID']}-{$plan['ID']}",
							'text'	=> $plan['post_title']
						];
					}
					$data[$index]['children'] = $children;
				}
			}
			$data = array_values($data);
		}
		return $data;
	}

	static 
function day_start_end($date_string){
		$date = new DateTime($date_string, new DateTimeZone(wp_timezone_string()));
		$start = clone $date;
		$start->modify('today');
		$end = clone $start;
		$end->modify('tomorrow');
		$end_stamp = $end->getTimestamp();
		$end_of_day = $end_stamp - 1;
		$end->setTimestamp($end_of_day);
		return[
			'start' => $start->format('U'),
			'end'	=> $end->format('U'),
		];
	}

}
