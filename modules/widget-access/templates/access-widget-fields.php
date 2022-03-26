<?php
if (! class_exists('m4ac_c6rqypiacz4') ) {
	return;
}
?>
<fieldset data-widget-id="<?php echo $m4ac_lj_fwoc5ub1y ;?>" data-user-status="<?php echo $m4ac_x_1654tdgb; ?>" class="<?php echo $m4ac_n5dw3y7vlku; ?>-fieldset">

    <legend class="<?php echo $m4ac_n5dw3y7vlku; ?>-legend">
        <?php echo WPAL_WIDGET_SETTINGS_TITLE; ?>
    </legend>

    <?php foreach ($m4ac_u9uhl_ci87 as $m4ac_wc9s2dnt4y){
        $m4ac_pzocy3nw       = $m4ac_wc9s2dnt4y['name'];
        $m4ac_ss6bwxopg8       = $m4ac_wc9s2dnt4y['type'];
        $m4ac_uxtpu8skb   = $m4ac_n_2w8gtz->get_field_id($m4ac_pzocy3nw);
        $m4ac_woab9rpxw = $m4ac_n_2w8gtz->get_field_name($m4ac_pzocy3nw);
        $m4ac_ihnr7cyv      = isset($m4ac_u4tpxcro19[$m4ac_pzocy3nw]) ? $m4ac_u4tpxcro19[$m4ac_pzocy3nw] : '';
		$m4ac_jpwyv954sc2       = !empty($m4ac_wc9s2dnt4y['info']) ? $m4ac_wc9s2dnt4y['info'] : false;

                echo "<div class=\"{$m4ac_n5dw3y7vlku}-field-control\" data-setting=\"{$m4ac_pzocy3nw}\">";
		$m4ac_sv5rmko0 = $m4ac_wc9s2dnt4y['label'];
		if( $m4ac_jpwyv954sc2 ){
			$m4ac_sv5rmko0 .= "<div class=\"wpal-tooltip\"><span class=\"dashicons dashicons-info\"></span>";
			$m4ac_sv5rmko0 .= "<span class=\"wpal-tooltiptext\">{$m4ac_jpwyv954sc2}</span></div>";
		}
        echo sprintf('<label for="%s" class="%s-field-label">%s</label>', $m4ac_uxtpu8skb, $m4ac_n5dw3y7vlku, $m4ac_sv5rmko0);

		if( $m4ac_ss6bwxopg8 === 'text' ){
            echo sprintf('<input type="%s" name="%s" id="%s" value="%s" class="widefat %s-field-input"/>',
                $m4ac_ss6bwxopg8, $m4ac_woab9rpxw, $m4ac_uxtpu8skb, esc_attr($m4ac_ihnr7cyv), $m4ac_n5dw3y7vlku
            );
        }
        else if ($m4ac_ss6bwxopg8 === 'select2') {
            $m4ac_md7c8zsu2o = isset($m4ac_wc9s2dnt4y['data']) ? $m4ac_wc9s2dnt4y['data'] : 0;
            $m4ac_ogn6vq1eu = isset($m4ac_wc9s2dnt4y['multiple']) ? (int)$m4ac_wc9s2dnt4y['multiple'] : 0;
            $m4ac_kavsp4kce = ( $m4ac_ogn6vq1eu > 0 ) ? " data-multiple=\"1\"" : "";
            $m4ac_i0o1iavh529n = ( isset($m4ac_wc9s2dnt4y['change']) ) ? $m4ac_wc9s2dnt4y['change'] : false;
            $m4ac_zd0bzutril6x = !empty($m4ac_i0o1iavh529n) ? " data-change=\"{$m4ac_i0o1iavh529n}\"" : "";
            $m4ac_zd0bzutril6x .= isset($m4ac_wc9s2dnt4y['disable-search']) ? " data-disable-search=\"1\"" : "";
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" class="widefat %s-field-input" data-wpal-widget-select2="%s"%s%s/>',
                $m4ac_woab9rpxw, $m4ac_uxtpu8skb, esc_attr($m4ac_ihnr7cyv), $m4ac_n5dw3y7vlku, $m4ac_md7c8zsu2o, $m4ac_kavsp4kce, $m4ac_zd0bzutril6x
            );
        }
        else if($m4ac_ss6bwxopg8 === 'textarea') {
            $m4ac_x_1sx47rpefc = ( isset($m4ac_wc9s2dnt4y['rows']) ) ? (int)$m4ac_wc9s2dnt4y['rows'] : 1;
            echo sprintf('<textarea name="%s" id="%s" class="widefat %s-field-textarea" rows="%s">%s</textarea>',
                $m4ac_woab9rpxw, $m4ac_uxtpu8skb, $m4ac_n5dw3y7vlku, $m4ac_x_1sx47rpefc, $m4ac_ihnr7cyv
            );
        }

        if( isset($m4ac_wc9s2dnt4y['desc']) && $m4ac_wc9s2dnt4y['desc'] > '' ){
            echo sprintf('<p class="%s-description description">%s</p>', $m4ac_n5dw3y7vlku, $m4ac_wc9s2dnt4y['desc']);
        }

        echo '</div>';
    } ?>

</fieldset>
