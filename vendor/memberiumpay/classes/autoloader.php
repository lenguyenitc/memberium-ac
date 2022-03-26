<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}

spl_autoload_register(['wpal_ecomm_autoloader', 'load']);

final 
class wpal_ecomm_autoloader {

	private static $classes = false;
	private static $paths   = false;

	private static 
function init() {
		self::$classes = [
						'wpal_ecomm_reports'      => WPAL_ECOMM_HOME_DIR . 'classes/reports',
			'wp_admin_templater'      => WPAL_ECOMM_HOME_DIR . 'vendor/wp-admin-templater/wp-admin-templater',
			'wp_admin_templater_ajax' => WPAL_ECOMM_HOME_DIR . 'vendor/wp-admin-templater/wp-admin-ajax',
			'wp_admin_templater_data' => WPAL_ECOMM_HOME_DIR . 'vendor/wp-admin-templater/wp-admin-data',
			'wp_custom_db_crud'       => WPAL_ECOMM_HOME_DIR . 'vendor/wp-custom-db-crud',
		];
		self::$paths = [
						WPAL_ECOMM_CLASS_DIR,
			WPAL_ECOMM_HOME_DIR . 'screens/',
			WPAL_ECOMM_HOME_DIR . 'merchants/',
		];
	}

	public static 
function load( $class ) {
		if ( ! self::$classes ) {
			self::init();
		}

		$class = trim( $class );
		if ( array_key_exists( $class, self::$classes ) && file_exists( self::$classes[$class] . '.php' ) ) {
			include_once self::$classes[$class] . '.php';
		}
		else {
			foreach(self::$paths as $path) {
				$file = $path . substr($class,11) . '.php';
				if (file_exists($file)) {
					include_once $file;
				}
			}
		}

		if (substr($class, 0, 10) <> 'wpal_ecomm') {
			return;
		}
	}

	public static 
function register( $class, $file ) {
		$class = trim( $class );
		if ( ! array_key_exists( $class, self::$classes ) ) {
			self::$classes[$class] = $file;
		}
	}

	public static 
function register_path( $path ) {
		$class = trim($path);

		if (! in_array($path, self::$paths)) {
			self::$paths[] = $path;
		}
	}

	}
