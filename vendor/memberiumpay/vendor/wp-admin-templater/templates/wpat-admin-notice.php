<?php

?>
<script type="text/html" id="tmpl-wpat_admin_notice">
    <# var title = ( data.title ) ? data.title : data.type,
    dismissable = ( data.dismissable > '' ) ? ' is-dismissible' : ''; #>
    <div id="{{data.id}}" class="wpat-admin-notice-wrap">
        <div class="notice notice-{{data.type}} {{data.type}} wpat-admin-notice{{dismissable}}">
            <p>
                <strong class="wpat-notice-title">{{title}}: </strong>
                {{{ data.content }}}
            </p>
            <# if(dismissable > ''){ #>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"></span>
            </button>
            <# } #>
        </div>
    </div>
</script>

<?php

 ?>
<script type="text/html" id="tmpl-wpat_loader">
  <div class="wpat_overlay">
      <div class="wpat_preloader"></div>
      <# if( data.msg ){ #>
      <div class="wpat_preloader_msg">{{{data.msg}}}</div>
      <# } #>
  </div>
</script>
