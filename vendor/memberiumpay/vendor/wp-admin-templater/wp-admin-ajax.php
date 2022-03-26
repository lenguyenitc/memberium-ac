<?php
if (! defined('ABSPATH')) {
   header('HTTP/1.0 403 Forbidden');
   die();
}



class wp_admin_templater_ajax {

    
	public static 
function admin_ajax(){
		$success = false;
		$data = false;
		$notice = [
			'type'			=> 'error',
			'title' 		=> __('Error'),
			'content'		=> __('There has been an error'),
			'dismissable' 	=> __('Dismiss this notice.'),
		];
        $name = (isset($_POST['data_name'])) ? $_POST['data_name'] : false;

		if( $name ){
            $results = apply_filters("wp/admin/templater/save/{$name}", $_POST);
            $success = ( isset($results['success']) ) ? $results['success'] : false;
            if(isset($results['message'])){
                $notice['content'] = $results['message'];
            }
            $data = ( isset($results['data']) ) ? $results['data'] : false;
		}
		else {
			$success = false;
            $notice['content'] = __('There has been an error : data name not set');
        }

		if( $success ){
			$notice['type'] = 'success';
			$notice['title'] = __('Success');
			wp_send_json_success( [
				'data'		=> $data,
				'notice'	=> $notice,
			] );
		}
		else {
			wp_send_json_error( [
				'data'		=> $data,
				'notice'	=> $notice,
			] );
		}
		die();
	}
}
