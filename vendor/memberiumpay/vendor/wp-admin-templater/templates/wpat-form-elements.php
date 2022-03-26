<?php

?>
<script type="text/html" id="tmpl-wpat_switch">
  <# var data_on = ( data.on ) ? data.on : 'On',
    data_off = ( data.off ) ? data.off : 'Off',
    checked = ( parseInt(data.checked) > 0 ) ? ' checked="checked"' : '',
    disabled = data.disabled ? ' disabled="disabled"' : ''; #>
  <div class="wpat_toggle_group">
    <label class="wpat_toggle_switch">
        <input type="hidden"
            value="0"
            name="{{data.name}}"
        />
        <input id="{{data.css_id}}"
            type="checkbox"
            class="wpat_switch_input {{data.css_class}}"
            value="1"
            name="{{data.name}}"
            {{checked}}
            {{disabled}}
        >
      <span class="wpat_switch_label" data-on="{{data_on}}" data-off="{{data_off}}"></span>
      <span class="wpat_switch_handle"></span>
    </label>
  </div>
</script>


<?php

?>
<script type="text/html" id="tmpl-wpat_input">
  <# //console.log({data:data, tmpl:'wpat_input'}); #>
  <# if( data.wrapEl ){ #>
    <{{data.wrapEl}}<# if( data.wrapElClass ){ #> class="{{data.wrapElClass}}"<# } #>>
  <# } #>

  <# if( data.labelPos && data.labelPos === 'after' ){ #>
    <# if( data.inputAttr ){ #>
      <input
      <# _.each( data.inputAttr, function( attr ) { #>
        {{attr.prop}}="{{attr.value}}"
        <# } ) #>
      />
    <# } #>
  <# } #>

  <# if( data.labelWrapEl ){ #>
    <{{data.labelWrapEl}} class="label_text<# if( data.labelWrapElClass ){ #> {{data.labelWrapElClass}}<# } #>">
  <# } #>
    <# if( data.label ){ #>
    {{data.label}}
    <# } #>
  <# if( data.labelWrapEl ){ #>
    </{{data.labelWrapEl}}>
  <# } #>

  <# if( !data.labelPos || data.labelPos === 'before' ){ #>
    <# if( data.inputAttr ){ #>
      <input
      <# _.each( data.inputAttr, function( attr ) { #>
        {{attr.prop}}="{{attr.value}}"
        <# } ) #>
      />
    <# } #>
  <# } #>

  <# if( data.wrapEl ){ #>
  </{{data.wrapEl}}>
  <# } #>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_button">
  <# //console.log({data:data, tmpl:'wpat_button'}); #>
  <# var el = (data.el) ? data.el : 'button'; #>
  <# var attrs = ''; #>
  <# if( data.attrs ){ #>
    <# _.each( data.attrs, function( attr ) { #>
      <# attrs += ' ' + attr.prop + '="'+attr.value+'"'; #>
    <# } ) #>
  <# } #>
  <{{{el}}}{{{attrs}}}>{{{data.label}}}</{{{el}}}>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_textarea">
  <# //console.log({data:data, tmpl:'wpat_textarea'}); #>
  <# var rows = ( data.rows ) ? data.rows : 5,
    css_class = ( data.css_class ) ? ' ' + data.css_class : '',
    content = ( data.content ) ? data.content : '';
  #>
  <textarea id="{{data.css_id}}"
    rows="{{rows}}"
    name="{{data.name}}"
    class="widefat textarea{{css_class}}">{{{content}}}</textarea>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_media_uploader">
    <div id="{{data.css_id}}" class="wpat-media-uploader {{data.css_class}}">
        <a title="{{data.upload_text}}" href="#" class="wpat-media-uploader-button">
            <# if( ! data.src > '' ){ #>
            <span class="button button-primary">{{data.upload_text}}</span>
            <# } else { #>
                <img src="{{data.src}}" />
            <# } #>
        </a>
        <input type="hidden" name="{{data.name}}" value="{{data.value}}" />
        <# if( data.src > '' ){ #>
            <a href="#" class="button wpat-remove-image">{{data.remove_text}}</a>
        <# } #>
    </div>
</script>
