<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}




class wpal_ecomm_dynamic_css {

	static 
function order_form_styles( $config ){

				$unique_id = $config['id'];
		$main_selector = ".wpal-ecomm-order-form[data-order-form-id=\"{$unique_id}\"] ";

				$color__main = $config['color__main'];
		$color__accent = $config['color__accent'];

				$styles = "";

				if( $color__main > '' ){

			$main_bg = "background-color:{$color__main};";
			$main_color = "color:{$color__main};";

			$styles .= $main_selector . ".wpal-ecomm-main_color_bg{".$main_bg."}";
			$styles .= $main_selector . ".wpal-ecomm-main_color{".$main_color."}";

		}

				if( $color__accent > '' ){

			$accent_bg = "background-color:{$color__accent};";
			$accent_color = "color:{$color__accent};";
			$accent_border_color = "border-color:{$color__accent};";

			$styles .= $main_selector . ".wpal-ecomm-accent_color_bg,".
					   $main_selector  .".subscription-product-plans input[type='radio']:checked + label,".
					   $main_selector  .".subscription-product-plans input[type='radio']:focus + label,".
					   $main_selector  .".subscription-product-plans label:hover,
					   					.wpal-ecomm-field small.wpal-ecomm-error,
					   					  input[type='submit']{".$accent_bg."}";
			$styles .= $main_selector . ".wpal-ecomm-accent_color{".$accent_color."}";

						$styles .= $main_selector . "fieldset{".$accent_border_color."}";

						$styles .= $main_selector . "legend,.wpal-ecomm-separator .wpal-ecomm-separator-content{".$accent_color."}";

						$styles .= $main_selector . "button,.wpal-ecomm-separator::after,.wpal-ecomm-separator::before{".$accent_bg."}";
		}

				$styles = apply_filters('wpal/ecomm/order/form/styles', $styles, $config );

		if( $styles > '' ){
			self::print_styles($styles);
		}
	}

	static 
function print_styles( $styles ){
		$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
		echo "<style{$type_attr}>{$styles}</style>";
	}

}
