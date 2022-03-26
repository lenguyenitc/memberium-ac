<?php

?>
<script type="text/html" id="tmpl-wpat_opt_filter">
  <# //console.log({data:data, tmpl:'wpat_opt_filter' }) #>
  <div id="{{data.id}}" class="wpat_opt_bar wp-filter {{data.class}}">
    <ul class="filter-links">
      <# _.each( data.lis, function( li ) { #>
        <# var attrs = ''; #>
        <# if( li.attrs ){ #>
          <# _.each( li.attrs, function( attrs ) { #>
            <# attrs += ' ' + attrs.prop + '="' + attrs.value +'"'; #>
          <# } ) #>
        <# } #>
        <li{{attrs}}>{{{li.content}}}</li>
      <# } ) #>
    </ul>
  </div>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_opt_tabs">
  <# var css_id = ( data.css_id ) ? ' id="'+data.css_id+'"' : '',
      css_class = ( data.css_class ) ? data.css_class : '';#>
  <ul{{css_id}} class="wpat_data_tabs {{css_class}}">
    <# _.each( data.lis, function( li ) { #>
      <# var active = ( li.slug === data.activeTab ) ? ' active' : ''; #>
    <li class="{{li.slug}}_options {{li.slug}}_tab{{active}}">
      <a href="#{{li.slug}}_options_data">
        <# if( li.icon > '' ){ #>
        <i class="{{li.icon}}"></i>
        <# } #>
        <span>{{li.label}}</span>
      </a>
    </li>
    <# } ) #>
  </ul>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_opt_panel">
  <# var active = ( data.slug === data.activeTab ) ? ' active' : ''; #>
  <div id="{{data.slug}}_options_data" class="panel wpat_option_panel{{active}}">
    <legend class="{{data.slug}}_legend">
      <# if( data.icon > '' ){ #>
      <i class="{{data.icon}}"></i>
      <# } #>
      <# if( data.label > '' ){ #>
      <span class="{{data.slug}}_legend_text">{{data.label}}</span>
      <# } #>
    </legend>
    <# if( data.content ){ #>
      {{{data.content}}}
    <# } #>
  </div>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_section">
    <# var title = ( data.title > '' ) ? data.title : false,
        desc = ( data.desc > '' ) ? data.desc : false,
        content = ( data.content > '') ? data.content : false,
        className = ( data.className > '') ? ' ' + data.className : '';
    #>
    <section id="{{data.slug}}" class="wpat_section{{className}}">
    <# if( title ){ #>
        <h4>{{{title}}}</h4>
    <# } #>
    <# if(desc){ #>
        <p class="description wpat_section-desc">{{{desc}}}</p>
    <# } #>
    <table class="form-table">
      <tbody class="wpat_section_content">
        {{{content}}}
      </tbody>
    </table>
  </section>
</script>

<?php

?>
<script type="text/html" id="tmpl-wpat_table_row_ui">
  <tr class="wpat_setting_label" data-type="{{data.type}}" data-setting={{data.slug}}>
    <# if( data.type === 'table' || data.type === 'add_new_form' ){ #>
        {{{data.content}}}
    <# } else { #>
    <th scope="row">
      {{{data.label}}}
      <# if( data.tooltip || data.tooltip_title ){ #>
      <div class="wpat_tooltip">&nbsp;
        <# if( data.help_id ){ #>
          <a href="{{data.doc_url}}?p={{data.help_id}}" target="_blank">
        <# } #>
          <i class="dashicons dashicons-info"></i>
        <# if( data.help_id ){ #>
          </a>
        <# } #>
      <div class="right">
        <# if(data.tooltip_title){ #>
        <h3 style="color:white;">{{{data.tooltip_title}}}</h3>
        <# } #>
        <p>{{{data.tooltip}}}</p>
      </div>
      <# } #>
    </th>
    <td>
    <# if( data.type === "switch_group" ) { #>
    {{{data.content}}}
    <# } else { #>
    <label style="valign:top;">
    {{{data.content}}}
    </label>
    <# } #>
         <# if( data.desc ){ #>
             <p class="description wpat_setting_desc">{{{data.desc}}}</p>
         <# } #>
    </td>
    <# } #>
  </tr>
</script>
