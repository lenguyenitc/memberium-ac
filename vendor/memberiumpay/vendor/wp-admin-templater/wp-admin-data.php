<?php
if (! defined('ABSPATH')) {
   header('HTTP/1.0 403 Forbidden');
   die();
}



class wp_admin_templater_data {

    protected $ignored_post_types = null;
    protected $public_post_types = null;

    
    static 
function get_pagelist_data( $params = [], $none = true ){

        global $wpdb;
        $wpat_data = self::get_instance();

        $defaults = [
            'exclude' => $wpat_data->get_ignored_post_types(),
            'entries' => [],
        ];
        $params = wp_parse_args($params, $defaults);
        unset($defaults);

        $params['exclude'] = "'" . implode( "','", explode( ',', $params['exclude'] ) ) . "'";
        $public_posts_types = $wpat_data->get_public_post_types();
        $sql   = "SELECT `ID`, `post_title`
            FROM `{$wpdb->posts}`
            WHERE `post_status` = 'publish'
            AND `post_type`
            IN ( '" . implode( "','", $public_posts_types ) . "' )
            AND `post_type`
            NOT IN ( " . $params['exclude'] . " )
            ORDER BY `id` ASC;";

        $pages = $wpdb->get_results( $sql, OBJECT_K );
        if( $none ){
            $json_pagelist[] = ['id'=>0, 'text' =>'( None )'];
        }
        foreach ( $pages as $id => $page ) {
            $json_pagelist[] = array( 'id' => $id, 'text' => "{$page->post_title} ({$id})");
            unset( $pages[$id] );
        }
        unset( $page, $sql );
        return $json_pagelist;
    }

    
    
function get_ignored_post_types() {

        if( is_null($this->ignored_post_types) ){
            $types = ['topic','reply'];
            $types = apply_filters('wp/admin/templater/ignored_post_types', $types);
    		$types = implode(',', $types);
            $this->ignored_post_types = $types;
        }
        return $this->ignored_post_types;
	}

    
    
function get_public_post_types() {

        if( is_null($this->public_post_types) ){
    		$public_post_types = [];
    		$post_types = get_post_types(['public' => true]);
    		if ( is_array( $post_types ) ) {
    			foreach( $post_types as $post_type ) {
                    $public_post_types[] = $post_type;
    			}
    		}
            $this->public_post_types = $public_post_types;
        }
		return $this->public_post_types;
	}

    
	static 
function setting_values( $settings, $data ){
		foreach ($settings as $s => $setting) {
			$slug = ( isset($setting['slug']) ) ? $setting['slug'] : false;
			if( $slug && isset($data[$slug]) ){
				$type = ( isset($setting['type']) ) ? $setting['type'] : false;
				$value = ($type) ? apply_filters( 'wp/admin/templater/setting/value/'.$type, $data[$slug] ) : $data[$slug];
				$settings[$s]['value'] = apply_filters( 'wp/admin/templater/setting/value/'.$slug, $value, $data );
			}
			else if( isset($settings[$s]['default']) ){
				$settings[$s]['value'] = $settings[$s]['default'];
			}
		}
		return $settings;
	}

    
    static 
function image_data( $value ){
        if( (int)$value > 0 ){
            $src = wp_get_attachment_url($value);
            if( $src > '' ){
                return [
                    'id'  => $value,
                    'src' => $src
                ];
            }
        }
        return $value;
    }

    
    static 
function get_userlist_data(){

        $data = [];

        $wp_users = get_users();
        foreach ($wp_users as $key => $user) {

            $user_data = $user->data;
            $text = $user_data->display_name;
            $text .= " ( {$user_data->display_name} )";
            $data[] = [
				'id'	=> $user->ID,
				'text' 	=> $text
			];
        }

        return $data;

    }

    
    private 
function __construct() {}

 	
 	public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
		}
        return $instance;
 	}
}
