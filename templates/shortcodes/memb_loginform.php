<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

$args = [
	'echo'           => true,
	'form_id'        => $data->form_id,
	'label_log_in'   => $data->button_label,
	'label_password' => $data->password_label,
	'label_remember' => $data->remember_label,
	'label_username' => $data->username_label,
	'redirect'       => $data->redirect,
	'remember'       => $data->remember,
];

if (! empty($data->error) ) {
	echo '<p class="memberium-login-error">' . $data->error . '</p>';
}

wp_login_form($args);
