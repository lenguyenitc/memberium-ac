<section id="report-generator" class="postbox">
    <h2><?php _e( 'Report Generator', $ns ); ?></h2>
    <form method="get" action="<?php echo admin_url("admin.php?page={$page}"); ?>">
        <input name="page" value="<?php echo $page; ?>" type="hidden">
        <div class="grid-fields">
            <label class="field-col"><?php _e('Start Date:', $ns); ?><br/>
                <input type="date" name="start_date" value="<?php echo $start_date; ?>">
			</label>
			<label class="field-col"><?php _e('End Date:', $ns); ?><br/>
                <input id="end_date" type="date" name="end_date" value="<?php echo $end_date; ?>">
            </label>
            <div class="field-col">
                <label><?php _e( 'New Business Only?', $ns ); ?></label>
                <div class="wpat_toggle_group">
                  <label class="wpat_toggle_switch">
                      <input type="hidden" value="0" name="new_business_only" />
                      <input id="new_business_only"
                          type="checkbox"
                          class="wpat_switch_input"
                          value="1"
                          name="new_business_only"
                          <?php checked( $new_business, 1 ); ?>
                      >
                    <span class="wpat_switch_label" data-on="Yes" data-off="No"></span>
                    <span class="wpat_switch_handle"></span>
                  </label>
                </div>
            </div>
            <div class="field-col">
                <button type="submit" class="button">
                    <i class="dashicons dashicons-chart-pie"></i><?php _e('Generate Report', $ns); ?>
                </button>
            </div>
		</div>
	</form>
</section>
