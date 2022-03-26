<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_email {

	
	    static 
function send_mail( $to, $args ){

                $sender_email = wpal_ecomm()->settings->get_sender_email();
        $sender_name = wpal_ecomm()->settings->get_option('sender_name');
        $headers = ["Content-Type: text/html; charset=UTF-8"];
        $headers[] = "From: {$sender_name} <{$sender_email}>";

        $defaults = [
                        'fontfamily'            => '"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;',
            'body_bg_color'         => '#f6f6f6',
            'table_bg_color'        => '#ffffff',
            'table_bg_border'       => '1px solid #f0f0f0',
            'h1_title_color'        => '#23282d',
            'button_bg_colour'      => '#007cba',
            'button_text_colour'    => '#ffffff',
                        'subject'   => __('Message From : ') . get_bloginfo('name'),
            'name'      => '',
            'title'     => '',
            'content'   => []
        ];
        $args = wp_parse_args($args,$defaults);
        $args = apply_filters('wpal/ecomm/email/args', $args);

                $font_family = 'font-family: '.htmlentities($args['fontfamily']);
                $font100 = 'font-size:100%;line-height:1.6;';
        $margin_zero = 'margin:0;';
        $pad_zero = 'padding:0;';
        $pad_20 = 'padding:20px;';
        $zero = $margin_zero.$pad_zero;
        $margin_auto = 'margin:0 auto!important;';
        $max_width = 'max-width:600px;';
        $w_100 = 'width:100%!important;';

        $style1 = $zero.$font_family.$font100;
        $style2 = $zero.$font_family.'font-size:14px;line-height:1.6;margin-bottom:10px;font-weight:normal;';

                $body_bg_color = $args['body_bg_color'];
        $body_style = $style1.$w_100.' -webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;height:100%;';

                $table_bg_border = $args['table_bg_border'];
        $table_bg_color = $args['table_bg_color'];
        $container_style = $margin_auto.$pad_20.$font_family.$font100.'border:'.$table_bg_border.';';
        $container_style .= 'display:block!important;max-width:600px!important;clear:both!important;';

                $h1_title_color = $args['h1_title_color'];
        $h1_title_style = 'margin: 40px 0 10px;'.$pad_zero.'font-size:24px;line-height:1.2;font-weight:400;';
        $h1_title_style .= $font_family.'color:'.$h1_title_color.';';

                $button_text_color = $args['button_text_colour'];
        $button_bg_colour = $args['button_bg_colour'];
        $button_style = $margin_zero.$font_family.'font-size:100%;font-weight:bold;padding:7px 10px;';
        $button_style .= 'display:inline-block;border-radius:0px;text-align:center;cursor:pointer;';
        $button_style .= 'text-decoration:none;line-height:2;border-width:10px 20px;';
        $button_style .= 'color:'.$button_text_color.'; background-color:'.$button_bg_colour.';border: solid '.$button_bg_colour.';';

                $subject = $args['subject'];
                $name = $args['name'];
        $sections = ( is_array($args['content']) && !empty($args['content']) ) ? $args['content'] : false;
        $title = ( $args['title'] > '' ) ? $args['title'] : $subject;

        
                $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $html .= '<html xmlns="http://www.w3.org/1999/xhtml" style="'.$style1.'">';

                $html .= '<head style="'.$style1.'">';
        $html .= '<meta name="viewport" content="width=device-width" style="'.$style1.'">';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="'.$style1.'">';
        $html .= '<title style="'.$style1.'">'.$subject.'</title>';
        $html .= '</head>';

                $html .= '<body bgcolor="'.$body_bg_color.'" style="'.$body_style.'">';
        $html .= '<table class="body-wrap" bgcolor="'.$body_bg_color.'" style="'.$margin_zero.$pad_20.$font_family.$font100.$w_100.'">';
        $html .= '<tr style="'.$style1.'">';
        $html .= '<td style="'.$style1.'"></td>';
        $html .= '<td class="container" bgcolor="'.$table_bg_color.'" style="'.$container_style.'">';

                $html .= '<div class="content" style="'.$margin_auto.$pad_zero.$font_family.$font100.$max_width.'display:block;">';

                $html .= '<table style="'.$style1.$w_100.'">';
        $html .= '<tr style="'.$style1.'">';
        $html .= '<td style="'.$style1.'">';

                        $html .= ( $name > '' ) ? '<p style="'.$style2.'">'.__('Hello, ').$name.'</p>' : '';

                        if( $title > '' ){
                $html .= '<h1 style="'.$h1_title_style.'">';
                $html .= $title . '</h1>';
    		}

                                    if( $sections ){
                foreach( $sections as $section ){
                    $type = isset($section['type']) ? $section['type'] : 'paragrah';
                    $content = $section['content'];
                    if($type === 'paragrah'){
                        $html .= '<p style="'.$style2.'">';
                        $html .= $content. '</p>';
                    }
                    else if($type === 'button'){
                        $html .= '<table style="'.$style1.$w_100.'">';
                        $html .= '<tr style="'.$style1.'">';
                        $html .= '<td class="padding" style="padding:10px 0;'.$margin_zero.$font_family.$font100.'">';
                        $html .= '<p style="'.$style2.'">';
                            $html .= '<a style="'.$button_style.'" href="'.$section['url'].'" class="btn-primary" >';
                            $html .= $content.'</a>';
                        $html .= '</p></td></tr></table>';
                    }
                }
            }

                $html .= '</td></tr></table>';
                $html .= '</div>';
                $html .= '<td style="'.$style1.'"></td>';
        $html .= '</tr></table>';
                $html .= '</body>';
                $html .= '</html>';

        $wp_mail = wp_mail( $to, $subject, $html, $headers);

		return ($wp_mail);
    }

}
