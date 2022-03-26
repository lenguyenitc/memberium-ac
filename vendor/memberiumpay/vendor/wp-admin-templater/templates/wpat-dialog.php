<?php

?>
<script type="text/html" id="tmpl-wpat_dialog">
    <div id="wpat_dialog" class="wpat_dialog_container {{data.css_class}}" aria-hidden="true" {{{data.data_attrs}}}>
        <div tabindex="-1" class="wpat_dialog_overlay" data-a11y-dialog-hide></div>
        <div role="dialog" class="wpat_dialog_content wpat_section" aria-labelledby="wpat_dialog">
            <div role="document">
                <button type="button" class="wpat_dialog_close" data-a11y-dialog-hide aria-label="<?php _e('Close dialog');?>">&times;</button>
                <# if( data.legend_css_class || data.title ) { #>
                    <div class="wpat_dialog_title_wrap">
                    <# if( data.legend_css_class ) { #>
                        <span class="wpat_dialog_legend {{data.legend_css_class}}"></span>
                    <# } #>
                    <# if( data.title ) { #>
                        <h1 class="wpat_dialog_title">{{{data.title}}}</h1>
                    <# } #>
                    </div>
                <# } #>
                <# if( data.form_id ) { #>
                    <form id="{{data.form_id}}" class="wpat_dialog_form" name={{data.form_id}} method="post">
                <# } #>
                <# if( data.content ) { #>
                    <div class="wpat_dialog_inner_content">{{{data.content}}}</div>
                <# } #>
                <# if( data.buttons ) { #>
                    <div class="wpat_dialog_footer">{{{data.buttons}}}</div>
                <# } #>
                <# if( data.form_id ) { #>
                    </form>
                <# } #>
            </div>
        </div>
    </div>
</script>
