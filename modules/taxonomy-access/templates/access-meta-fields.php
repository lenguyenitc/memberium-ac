<?php
if (! class_exists('m4ac_c6rqypiacz4') ) {
	return;
}


?></tbody>
<?php     echo sprintf('<tbody data-term-id="%s" data-user-status="%s" data-prohibited-action="%s" class="%s-tbody">',
        $m4ac_ywev7t0y6, $m4ac_x_1654tdgb, $m4ac_yzrsmw3k2hul, $m4ac_n5dw3y7vlku
    );
?>
    <tr class="form-field">
		<th scope="row" colspan="2">
            <h3>
                <?php echo WPAL_TAX_SETTINGS_TITLE; ?>
            </h3>
        </th>
	</tr>
    <?php foreach ($m4ac_ld06b5vztcj as $m4ac_ukqvxo6ne7 => $m4ac_wc9s2dnt4y){
        $m4ac_pzocy3nw  = $m4ac_wc9s2dnt4y['name'];
        $m4ac_ss6bwxopg8  = $m4ac_wc9s2dnt4y['type'];
        $m4ac_lj_fwoc5ub1y    = esc_attr("{$m4ac_pzocy3nw}-{$m4ac_ywev7t0y6}");
		$m4ac_sv5rmko0 = $m4ac_wc9s2dnt4y['label'];
		if( !empty($m4ac_wc9s2dnt4y['info']) ){
			$m4ac_sv5rmko0 .= "<div class=\"wpal-tooltip\"><span class=\"dashicons dashicons-info\"></span>";
			$m4ac_sv5rmko0 .= "<span class=\"wpal-tooltiptext\">{$m4ac_wc9s2dnt4y['info']}</span></div>";
		}
                echo "<tr class=\"{$m4ac_n5dw3y7vlku}-field-control\" data-setting=\"{$m4ac_pzocy3nw}\">";
                        echo "<th scope=\"row\">";
                echo sprintf('<label for="%s" class="%s-field-label">%s</label>',
                    $m4ac_lj_fwoc5ub1y, $m4ac_n5dw3y7vlku, $m4ac_sv5rmko0
                );
                        echo "</th>";
                        echo "<td>";
            if( $m4ac_ss6bwxopg8 === 'text' ){
                echo sprintf('<input type="%s" name="wpal_taxonomy[%s]" id="%s" value="%s" class="widefat %s-field-input"/>',
                    $m4ac_ss6bwxopg8, $m4ac_pzocy3nw, $m4ac_lj_fwoc5ub1y, esc_attr($m4ac_wc9s2dnt4y['value']), $m4ac_n5dw3y7vlku
                );
            }
            else if( $m4ac_ss6bwxopg8 === 'select2' ){
                $m4ac_md7c8zsu2o          = isset($m4ac_wc9s2dnt4y['data']) ? $m4ac_wc9s2dnt4y['data'] : 0;
                $m4ac_ogn6vq1eu   = isset($m4ac_wc9s2dnt4y['multiple']) ? (int)$m4ac_wc9s2dnt4y['multiple'] : 0;
                $m4ac_kavsp4kce = $m4ac_ogn6vq1eu > 0 ? " data-multiple=\"1\"" : "";
                $m4ac_i0o1iavh529n        = isset($m4ac_wc9s2dnt4y['change']) ? $m4ac_wc9s2dnt4y['change'] : false;
                $m4ac_ppijhg52   = !empty($m4ac_i0o1iavh529n) ? " data-change=\"{$m4ac_i0o1iavh529n}\"" : "";
                $m4ac_uemk2vhif   = isset($m4ac_wc9s2dnt4y['disable-search']) ? " data-disable-search=\"1\"" : "";
                echo sprintf('<input type="text" name="wpal_taxonomy[%s]" id="%s" value="%s" class="widefat %s-field-input" data-wpal-taxonomy-select2="%s"%s%s%s/>',
                    $m4ac_pzocy3nw, $m4ac_lj_fwoc5ub1y, esc_attr($m4ac_wc9s2dnt4y['value']), $m4ac_n5dw3y7vlku, $m4ac_md7c8zsu2o, $m4ac_kavsp4kce, $m4ac_ppijhg52, $m4ac_uemk2vhif
                );
            }
            else if( $m4ac_ss6bwxopg8 === 'textarea' ){
                $m4ac_x_1sx47rpefc = isset($m4ac_wc9s2dnt4y['rows']) ? (int)$m4ac_wc9s2dnt4y['rows'] : 1;
                                echo sprintf('<textarea name="wpal_taxonomy[%s]" id="%s" class="widefat %s-field-textarea" rows="%s">%s</textarea>', $m4ac_pzocy3nw, $m4ac_lj_fwoc5ub1y, $m4ac_n5dw3y7vlku, $m4ac_x_1sx47rpefc, $m4ac_wc9s2dnt4y['value'] );
            }
            if( isset($m4ac_wc9s2dnt4y['desc']) && $m4ac_wc9s2dnt4y['desc'] > '' ){
                echo sprintf('<p class="%s-description description">%s</p>', $m4ac_n5dw3y7vlku, $m4ac_wc9s2dnt4y['desc']);
            }
                        echo '</td>';
                echo '</tr>';
        } ?>
</tbody>
