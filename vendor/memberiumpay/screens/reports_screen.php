<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class wpal_ecomm_reports_screen {

    	static public 
function init() {
		self::show();
	}

    static 
function show(){

        $ns           = 'wpal_ecomm';
        $page         = esc_attr($_GET['page']);
        $reports      = wpal_ecomm_reports::get_instance();
        $start_date	  = ! empty($_GET['start_date']) ? date('Y-m-d', strtotime($_GET['start_date'])) : date('Y-m-01');
        $end_date     = ! empty($_GET['end_date']) ? date('Y-m-d', strtotime($_GET['end_date']) ) : date('Y-m-d');
        $new_business = ! empty($_GET['new_business_only']) ? 1 : 0;
        $args = [
            'start_date'		=> $start_date,
            'end_date'			=> $end_date,
            'new_business_only'	=> $new_business,
        ];

        echo '<div id="wpal-ecomm-reports" class="wrap">';
            echo "<h2 class=\"page-title\">" . __( 'eCommerce Report', $ns ), '</h2>';

            include WPAL_ECOMM_TMPL_DIR . 'admin/report-generator-form.php';

                $leaderboard = $reports->run($args);
        echo $leaderboard['html'];
        echo '</div>'; 
    }
}
