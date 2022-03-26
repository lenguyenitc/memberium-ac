<?php
if (! defined('ABSPATH')) {
   header('HTTP/1.0 403 Forbidden');
   die();
}




class wp_admin_templater {

        private $path = false;
        private $url = false;
 	 	protected $json = [];
        protected $I18n = [];
        private $choices_data = [];
        protected $name = 'wpAdminTemplater';
        protected $script_handle;
        protected $data_name;
        protected $page_hook;
        protected $hooks = [];
    protected $hook;
        protected $post_types = [];
        protected $post_type = false;
        protected $dependencies;
        protected $version = '1.2.1';

    
 	
function init() {
        $this->dependencies = [
            'wp-util',
            'underscore',
            'jquery',
            'wpAdminTemplater'
        ];
        $this->actions();
        $this->filters();
    }

 	
 	
function actions() {
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue'], PHP_INT_MAX);
		add_action('admin_footer', [$this, 'print_scripts']);
 	}

    
    
function filters(){
        add_filter('wp/admin/templater/setting/value/media-uploader', ['wp_admin_templater_data','image_data']);
        add_filter('wp/admin/templater/settings/choices/pagelist', ['wp_admin_templater_data','get_pagelist_data']);
        add_filter('wp/admin/templater/settings/choices/userlist', ['wp_admin_templater_data','get_userlist_data']);
    }

 	
 	
function admin_enqueue( $hook ) {

        if( ! $this->is_registered_hook($hook) ){
            return;
        }

        $this->hook = $hook;
        $url = $this->get_url();
        $name = $this->name;
        $version = $this->version;
        wp_enqueue_style(
            $name,
            $url . 'css/wp-admin-templater.css',
            [],
            $version,
            'all'
		);

                $wpal_select_woo_js = apply_filters('wpalSelect2/js/src', '');
        wp_register_script(
            'wpalSelect2',
            $wpal_select_woo_js,
            ['jquery'],
            '1.0.4'
        );
        $wpal_select_woo_css = apply_filters('wpalSelect2/css/src', '');
        wp_enqueue_style(
            'wpalSelect2',
            $wpal_select_woo_css,
            false,
            '5.7.2'
        );
                wp_register_script(
            'wpat-a11y-dialog',
            'https://cdn.jsdelivr.net/npm/a11y-dialog@6/dist/a11y-dialog.min.js',
            [],
            '6.0.0'
        );

        wp_register_script(
            $name,
            $url . 'js/wp-admin-templater.js',
            ['wp-util', 'underscore', 'jquery'],
            $version,
            false
		);

 	}

    
	
function print_scripts(){

        $json = $this->get_json();

			    if ( empty($json) ){
	        return;
		}

                $name = $this->name;
        $settings = ( isset($json['settings']) ) ? $json['settings'] : false;
                $json = $this->tmpl_includes($json);
                $json = $this->tmpl_scripts($json);
                $json['choices'] = $this->choices_data;
                if( !isset($json['wpat_buttons']) ){
            $json = $this->wpat_buttons($json);
        }
                $json['ajaxUrl'] = admin_url( 'admin-ajax.php' );
        $protocol = is_ssl() ? 'https' : 'http';
                if( $this->post_type ){

            $json['page'] = $this->post_type;
            $post_url = get_admin_url( null, "/{$this->hook}", $protocol );
            $url_args = [];
                        if( $this->hook === 'post.php' ){
                $post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : '';
                $get_action = ( isset( $_GET['action'] ) ) ? $_GET['action'] : '';
                $url_args['post'] = $post_id;
                $url_args['action'] = $get_action;
            }
                        else if( $this->hook === 'edit.php' ){
                $url_args['post_type'] = $this->post_type;
            }
                        else if( $this->hook === 'post-new.php' ){
                $url_args['post_type'] = $this->post_type;
            }
            $json['screenUri'] = add_query_arg( $url_args, $post_url );
        }
        else{
            $get_page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : '';
            $json['page'] = $get_page;
            $json['screenUri'] = add_query_arg( ['page' => $get_page ], get_admin_url( null, '/admin.php', $protocol ) );
        }
                $this->set_I18n('dismissable', __('Dismiss this notice.'));
		$this->set_I18n('filter', __('Filter'));
		$this->set_I18n('confirm_delete', __("Are you sure you want to delete"));
        $this->set_I18n('error-required', __("Required field") );
        $this->set_I18n('error-generic', __("Error : review setting") );
        $this->set_I18n('error-min-date', __("Error : must use a minimum date of %s") );
        $this->set_I18n('error-max-date', __("Error : must use a maximum date of %s") );
        $json['I18n'] = $this->I18n;
        wp_enqueue_script( $name );
        $script_handle = $this->get_script_handle();
        $data_name = $this->get_data_name();
        $this->json = $json;

        if($script_handle && $data_name){
            $json = apply_filters('wp/admin/templater/json', $json, $data_name);
            if( is_array($json) ){
                wp_localize_script( $script_handle, $data_name, $json );
                wp_enqueue_script( $script_handle );
            }
        }
    }

    
	
function tmpl_includes($json){

				$tmpls = [];
		$loaded = [];
		$settings = ( isset($json['settings']) ) ? $json['settings'] : [];
        $include_dialog = false;

		if( !empty($settings) ){

			$path = $this->get_path();

						require_once $path . 'templates/wpat-form-elements.php';
			$tmpls = [
				'button'	       => 'wpat_button',
				'switch'	       => 'wpat_switch',
				'input'		       => 'wpat_input',
				'textarea'	       => 'wpat_textarea',
                'media_uploader'   => 'wpat_media_uploader',
			];

						require_once $path . 'templates/wpat-admin-notice.php';
			$tmpls['notice'] = 'wpat_admin_notice';
			$tmpls['loader'] = 'wpat_loader';

			if( isset( $json['tabs'] ) || isset( $json['add_new_form'] ) ){
								require_once $path . 'templates/wpat-admin-ui-elements.php';
				$tmpls['tabs']		= 'wpat_opt_tabs';
				$tmpls['panel']		= 'wpat_opt_panel';
				$tmpls['section']	= 'wpat_section';
				$tmpls['row'] 		= 'wpat_table_row_ui';
			}

                        if( isset( $json['add_new_form'] ) ){
                $json = $this->wpat_buttons($json);
            }
            $table_loaded = false;
            			if( isset($json['list_table']) ){
                $table_loaded = true;
                $tmpls = $this->table_tmpls($tmpls);
                if( isset($json['list_table']['filters']) ){
                    $this->table_filters($json['list_table']['filters']);
                }
			}
                        if( isset($json['dialog']) ){
                $include_dialog = true;
                            }

			            foreach ($settings as $s => $setting) {
                                $template = ( isset($setting['tmpl']) ) ? $setting['tmpl'] : false;
    			if( $template ){
    				$tmpl_slug = ( isset($template['slug']) ) ? $template['slug'] : false;
    				if( $tmpl_slug && !array_key_exists( $tmpl_slug, $tmpls ) ){
    					$tmpl_path = ( isset($template['path']) ) ? $template['path'] : false;

                        if( $tmpl_path && file_exists($tmpl_path) ){
    						$tmpl_name = ( isset($template['name']) ) ? $template['name'] : false;
    						if($tmpl_name){
    							    							if( !in_array($tmpl_slug,$tmpls) ){
    								$tmpls[$tmpl_slug] = $tmpl_name;
    							}
    							    							if( !in_array($tmpl_path, $loaded) ){
    								$loaded[] = $tmpl_path;
                                    $wrap = ( isset($template['wrap']) ) ? $template['wrap'] : false;
                                    echo ($wrap) ? "<script type=\"text/html\" id=\"tmpl-{$tmpl_slug}\">" : "";
                                        require_once $tmpl_path;
                					echo ($wrap) ? "</script>" : "";
    								require_once $tmpl_path;
    							}
                                $json['settings'][$s]['tmpl'] = $tmpl_name;
    						}
    					}
    				}
    			}
                                $type = $setting['type'];
                                if($type === 'table'){
                    if(!$table_loaded){
                        $table_loaded = true;
                        $tmpls = $this->table_tmpls($tmpls);
                    }
                    if( isset($setting['data']['filters']) ){
                        $this->table_filters($setting['data']['filters']);
                    }
                }
                else if($type === 'add_new_form'){
                    $json = $this->wpat_buttons($json);
                }
                else if($type === 'dialog'){
                    $include_dialog = true;
                                    }
            }
		}

        if( $include_dialog ){
            require_once $path . 'templates/wpat-dialog.php';
            $tmpls['dialog'] = 'wpat_dialog';
            $json = $this->load_script('dialog', $json);
        }

		$json['tmpls'] = $tmpls;
		return $json;
	}

    
    
function table_tmpls($tmpls){
        $path = $this->get_path();
        require_once $path . 'templates/wpat-list-table.php';
        $tmpls['list_table'] = 'wpat_list_table';
        $tmpls['list_table_edit'] = 'wpat_list_table_edit';
        $this->set_I18n('quick_edit',__("Quick Edit"));
        $this->set_I18n('cancel',__("Cancel"));
        $this->set_I18n('update',__("Update"));
        return $tmpls;
    }

    
    
function table_filters( $filters ){
        foreach ($filters as $key => $filter) {
            $this->build_choices_data($filter);
        }
    }

    
    
function wpat_buttons($json){
        $json['wpat_buttons'] = [
            'add_new' => $this->button(
                'add_new', __('Add New'),
                'button-add-new button-primary'
            ),
            'cancel' => $this->button(
                'cancel', __('Cancel'),
                'button-cancel'
            ),
            'save' => $this->button(
                'save', __('Save'),
                'button-save button-primary'
            ),
            'delete' => $this->button(
                'delete', __('Delete'),
                'button-delete'
            ),
        ];
        return $json;
    }

    
	
function tmpl_scripts($json){
		$loaded = [];
		$settings = ( isset($json['settings']) ) ? $json['settings'] : [];
		foreach ($settings as $s => $setting) {
			$type = ( isset($setting['type']) ) ? $setting['type'] : false;
                        if( $type === 'add_new_form' ){
                $form_settings = ( isset($setting['data']) ) ? $setting['data'] : false;
                if($form_settings){
                    foreach ($form_settings as $d => $form_setting) {
                        $form_setting_type = ( isset($form_setting['type']) ) ? $form_setting['type'] : false;
                        if( $form_setting_type && !in_array($form_setting_type, $loaded) ){
                            $loaded[] = $form_setting_type;
                            $json = $this->load_script($form_setting_type, $json);
                        }
                        $this->build_choices_data($form_setting);
                    }
                }
            }
                        if( $type === 'table' ){
                            }
                        else{
                if( $type && !in_array($type, $loaded) ){
                    $loaded[] = $type;
                    $json = $this->load_script($type, $json);
                }
                $this->build_choices_data($setting);
            }
		}
		return $json;
	}

    
    
function load_script($type, $json){

        switch ($type) {
                        case 'multi_select':
            case 'select':
                wp_enqueue_script('wpalSelect2');
                break;
                        case 'editor':

                wp_enqueue_editor();
                wp_enqueue_media();
                wp_print_media_templates();

                                                $json['editor_config'] = apply_filters( 'wp/admin/templater/settings/editor/config', [
                    'mediaButtons'  => false,
                    'tinymce'       => ['wpautop' => true],
                    'quicktags'     => true,
                ] );
                                break;
                        case 'media-uploader':
                wp_enqueue_media();
                break;
                        case 'editor-html':
            case 'editor-css':
            case 'editor-js':
                wp_enqueue_code_editor( [ 'type' => 'text/html' ] );
                wp_enqueue_style('wp-codemirror');
                break;
                        case 'dialog':
                wp_enqueue_script('wpat-a11y-dialog');
                break;
            default:
                break;
        }

        return $json;
    }

    
    
function build_choices_data($setting){

        $choices = ( isset($setting['choices']) ) ? $setting['choices'] : false;
        if($choices){
            if( !array_key_exists($choices, $this->choices_data) ){
                $data = apply_filters('wp/admin/templater/settings/choices/'.$choices, [], $setting );
                if(is_array($data)){
                    $this->choices_data[$choices] = $data;
                }
            }
        }
    }

    
    
function validate_sanitize( $value, $setting ){
        $slug = $setting['slug'];
        $value = apply_filters('wp/admin/templater/validate/field/' . $slug, $value, $setting);
        $type = $setting['type'];
        switch ($type) {
            case 'select':
            case 'multi_select':
            case 'switch_group':
                                $trimmed = trim($value,',');
                $value = preg_replace('/\s+/', ' ', $trimmed);
                break;
            case 'textarea':
            case 'editor':
                $value = wp_kses(htmlentities(stripslashes($value)),[]);
                break;
            case 'text':
            case 'input':
            case 'number':
            case 'hidden':
            case 'password':
                $value = sanitize_text_field($value);
                break;
            case 'price':
                $value = $this->wpat_price(sanitize_text_field($value));
                break;
            case 'datetime':
                $timestring = $value . ' ';
                                $timestring .= ( isset($_POST["{$slug}_hours"]) ) ? $_POST["{$slug}_hours"] : '00';
                $timestring .= ':';
                $timestring .= ( isset($_POST["{$slug}_minutes"]) ) ? $_POST["{$slug}_minutes"] : '00';
                $date = DateTime::createFromFormat('Y-m-d H:i', $timestring);
                $value = $date->getTimestamp();
                break;
            default:
                break;
        }
        return $value;
    }

    
    
function get_path(){
        if( ! $this->path ){
            $this->path = apply_filters('wp/admin/templater/path', __DIR__ . '/');
        }
        return $this->path;
    }

    
    
function get_url(){
        if( ! $this->url ){
            $this->url = apply_filters('wp/admin/templater/url', plugin_dir_url(__FILE__));
        }
        return $this->url;
    }

    
    
function set_script_handle($name){
        $this->script_handle = $name;
    }

    
function get_script_handle(){
        return $this->script_handle;
    }

    
function set_data_name($name){
        $this->data_name = $name;
    }

    
function get_data_name(){
        return $this->data_name;
    }

    
    
function register_hooks( $hooks = false ){
        if( is_array($hooks) ){
            $this->hooks = array_merge($this->hooks, $hooks);
        }
    }

    
    
function get_registered_hooks(){
        return $this->hooks;
    }

    
    
function is_registered_hook($hook){

        $hooks = $this->get_registered_hooks();

        if( ! in_array($hook, $hooks) ){

            $post_hooks = [ 'edit.php', 'post.php', 'post-new.php' ];
            $post_hook = in_array($hook, $post_hooks);

                        if( $post_hook ){
                global $current_screen;
                if( isset($current_screen) && is_object($current_screen) ){
                    $post_type = $current_screen->post_type;
                    return $this->is_registered_post_type($post_type, $hook);
                }
            }

        }
        else {
            return true;
        }
    }

    
    
function register_post_types( $post_type = false ){
        if( is_array($post_type) ){
            $this->post_types = array_merge($this->post_types, $post_type);
        }
    }

    
    
function get_registered_post_types(){
        return $this->post_types;
    }

    
    
function is_registered_post_type( $post_type, $hook ){

        $registered_post_types = $this->post_types;
        if( is_array($registered_post_types) ){
            if( array_key_exists($post_type, $registered_post_types) ){
                $hooks = $registered_post_types[$post_type];
                if( is_array($hooks) && in_array( $hook, $hooks ) ){
                    $this->post_type = $post_type;
                    return true;
                }
                else {
                    if( $hooks === 'all' ){
                        $this->post_type = $post_type;
                        return true;
                    }
                }
            }
        }
        return false;
    }


    
    
function dependencies( $dependencies = false ){
        if( is_array($dependencies) ){
            $this->dependencies = array_merge($this->dependencies, $dependencies);
        }
    }

    
    
function button( $slug, $title, $class, $attrs = [] ){
		$defaults =  [
			[ 'prop' => 'class', 'value' => 'button ' . $class ],
		];
		$attrs = wp_parse_args($attrs, $defaults);
		return [
			'slug'		=> $slug,
			'title'		=> $title,
			'type'    	=> 'button',
			'attrs' 	=> $attrs,
		];
	}

    
    
function to_json($key, $value = false) {
		if ($value) {
			$this->json[$key] = $value;
		}
		else {
			unset($this->json[$key]);
		}
	}

    
	
function get_json($key = false) {
		if ($key) {
			return (isset($this->json[$key])) ? $this->json[$key] : null;
		}
		else {
			return $this->json;
		}
	}

    
	
function set_I18n($key, $value = false) {
        if ($value) {
			$this->I18n[$key] = $value;
		}
	}

    
     
function wpat_price($number){
         $round = round($number, 2, PHP_ROUND_HALF_UP);
         return number_format((float)$round, 2, '.', '');
     }

    
    private 
function __construct() {}

 	
 	public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
            $instance->init();
		}
        return $instance;
 	}

 }

 
 
function wp_admin_templater(){
 	return wp_admin_templater::get_instance();
 }
