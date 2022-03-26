<?php

?>
<script type="text/html" id="tmpl-wpat_list_table">
    <# //console.log({ tmpl:'wpat_list_table', data:data }); #>
    <# var wrap_attrs = ( data.wrap_attrs > '' ) ? data.wrap_attrs : {},
        table_attrs   = ( data.table_attrs > '' ) ? data.table_attrs : {},
        loading       = ( data.loading ) ? true : false,
        search_input  = ( data.search_input ) ? data.search_input : false,
        search_string = ( data.search_string ) ? data.search_string : '',
        row_actions   = ( data.row_actions ) ? data.row_actions : {},
        filters       = ( data.filters ) ? data.filters : false,
        pagination    = ( data.pagination ) ? data.pagination : false,
        columns       = ( data.columns ) ? data.columns : {},
        hidden        = ( data.hidden ) ? data.hidden : [],
        colspan       = ( data.colspan ) ? data.colspan : _.size(columns),
        tbodys        = ( data.tbodys ) ? data.tbodys : false,
        cur_body      = '',
        rows          = ( data.rows ) ? data.rows : {},
        items_total   = _.size(rows),
        show_cb       = ( parseInt(data.show_cb) > 0 ) ? true : false,
        bulk_actions  = ( data.bulk_actions ) ? data.bulk_actions : false,
        I18n          = data.I18n,
        item_txt      = ( items_total > 1 ) ? I18n.items : I18n.item;
     #>
    <div <# _.each( wrap_attrs, function( attr ) { #>{{attr.prop}}="{{attr.value}}"<# }); #>>

    <# if(loading) { #>
    <div class="table-loader-wrap">
      <div class="table-loader-center">
        <div class="table-loader">Loading</div>
      </div>
    </div>
    <# } #>

    <?php
     ?>
    <# if( search_input ){ #>
        <p class="search-box">
            <label class="screen-reader-text" for="{{search_input}}">{{I18n.search}}:</label>
            <input type="search" id="{{search_input}}" name="s" value="{{search_string}}">
            <input type="submit" id="search-submit" class="button" value="{{I18n.search}}">
        </p>
    <# } #>

    <?php
     ?>
    <div class="tablenav top">

    <# if( bulk_actions ){ #>
        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
            <select  id="bulk-action-selector-top" name="action">
                <option value="-1">Bulk Actions</option>
                <# _.each( bulk_actions, function( label, value ) { #>
                    <option value="{{value}}">{{label}}</option>
                <# }); #>
            </select>
            <button id="wpat-apply-bulk-action-top" class="button action">Apply</button>
        </div>
    <# } #>

      <# if( filters ){ #>
      <div class="alignleft actions">
          <# _.each( filters, function( filter ) { #>
             {{{filter.content}}}
          <# }); #>
      </div>
      <# } #>

      <# if( items_total > 0 ){ #>
      <div class="tablenav-pages">
        <span class="displaying-num">{{ items_total }} {{item_txt}}</span>
        <# if( pagination ){ #>
        <span class="pagination-links">{{{pagination}}}</span>
        <# } #>
      </div>
      <# } #>
    </div>


    <table <# _.each( table_attrs, function( attr ) { #>{{attr.prop}}="{{attr.value}}"<# } ) #>>
    <?php  ?>
      <thead>
        <tr>
            <# if(show_cb){ #>
            <td class="manage-column column-cb check-column">
                <input type="checkbox">
            </td>
            <# } #>
            <# _.each( columns, function( value, key ) { #>
                <# var is_hidden = ( hidden.indexOf(key) !== -1 ) ? ' wpat-hidden-col' : ''; #>
                <th scope="col" id="{{key}}" class="manage-column column-{{key}}{{is_hidden}}">
                    <span>{{{value}}}</span>
                </th>
            <# }); #>
        </tr>
      </thead>

      <?php
       ?>
      <tfoot>
        <tr>
            <# if(show_cb){ #>
            <td class="manage-column column-cb check-column">
                <input type="checkbox">
            </td>
            <# } #>
            <# _.each( columns, function( title, key ) { #>
                <# var is_hidden = ( hidden.indexOf(key) !== -1 ) ? ' wpat-hidden-col' : ''; #>
                <th scope="col" id="{{key}}" class="manage-column column-{{key}}{{is_hidden}}">
                    <span>{{{title}}}</span>
                </th>
            <# }); #>
        </tr>
      </tfoot>

      <?php
       ?>
      <# if( !tbodys ) { #>
      <tbody id="the-list">
      <# } #>
      <# if( items_total > 0 ){ #>
          <# _.each( rows, function( row, r ) { #>
              <# var row_id = ( row.id ) ? row.id : r,
                group = ( tbodys && row.group ) ? row.group : false;
             if( tbodys && group != cur_body ){
                  if(cur_body > ''){#>
        </tbody>
                  <# } #>
        <tbody data-group="{{group}}">
            <tr>
                <th colspan="{{colspan}}">
                    <label>{{group}}</label>
                </th>
            </tr>
                <# cur_body = group; #>
              <# } #>
          <tr id="wpat_row_id_{{row_id}}" class="{{row.class}}">
              <# if(show_cb){ #>
              <th scope="row" class="check-column">
                  <input type="checkbox" name="item[]" value="{{row_id}}">
              </th>
              <# } #>
              <# _.each( columns, function( title, key ) { #>
                  <# var is_hidden = ( hidden.indexOf(key) !== -1 ) ? ' wpat-hidden-col' : ''; #>
              <td class="column-{{key}}{{is_hidden}}">
                  <# if(row[key]){ #>
                      {{{row[key]}}}
                  <# } #>
                  <# if(row_actions[key]){ #>
                  <div class="row-actions">
                      <# _.each( row_actions[key], function( label, label_key ) { #>
                      <span class="{{label_key}}">
                          <?php ?>
                          <a href="#" data-id="{{row_id}}" data-action="{{label_key}}">{{ label }}</a>
                      </span>
                      <# }); #>
                  </div>
                  <# } #>
              </td>
              <# }); #>
          </tr>
          <# }); #>
        <# } else { #>
        <tr class="empty">
          <td colspan="{{colspan}}">{{ I18n.no_results }}</td>
        </tr>
        <# } #>
        <# if( !tbodys ) { #>
        </tbody>
        <# } #>
    </table>
    <?php
    ?>
    <div class="tablenav bottom">
      <# if( items_total > 0 ){ #>
      <div class="tablenav-pages">
        <span class="displaying-num">{{ items_total }} {{item_txt}}</span>
        <# if( pagination ){ #>
        <span class="pagination-links">{{{pagination}}}</span>
        <# } #>
      </div>
      <# } #>
    </div>

  </div>
</script>

<?php

 ?>
<script type="text/html" id="tmpl-wpat_list_table_edit">
    <# //console.log({ tmpl:'wpat_list_table_edit', data:data }); #>
    <tr id="wpat_row_id_{{data.id}}_hidden" class="hidden"></tr>
    <tr id="wpat_row_id_{{data.id}}_edit" class="inline-edit-row quick-edit-row inline-editor {{data.className}}">
        <td colspan="{{data.colspan}}" class="colspanchange">
            <div id="wpat_form_id_{{data.id}}" class="wpat_quick_edit_form">
                <fieldset class="inline-edit-col-left">
                    <legend class="inline-edit-legend">{{data.I18n.quick_edit}}</legend>
                    <div class="inline-edit-col">
                        <# _.each( data.settings, function( setting, s ) { #>
                            <# if( setting.type === 'section' ){ #>
                                <div class="wpat_quick_heading heading-{{setting.slug}}">
                                    <div class="wpat_quick_heading_inner wpat_section">
                                    <# if( setting.label && setting.label > '' ){ #>
                                    <h4>{{{setting.label}}}</h4>
                                    <# } #>
                                    <# if( setting.desc  && setting.desc > '' ){ #>
                                        {{{setting.desc}}}
                                    <# } #>
                                    </div>
                                </div>
                            <# }  else { #>
                            <div class="wpat_quick_setting setting-{{setting.slug}}">
                                <# if(setting.type !== 'hidden'){ #>
                                    <span class="title">{{{setting.label}}}
                                        <# if( setting.tooltip || setting.tooltip_title ){ #>
                                        <div class="wpat_tooltip">&nbsp;
                                          <# if( setting.help_id ){ #>
                                            <a href="{{setting.doc_url}}?p={{setting.help_id}}" target="_blank">
                                          <# } #>
                                                <i class="dashicons dashicons-info"></i>
                                          <# if( setting.help_id ){ #>
                                            </a>
                                          <# } #>
                                          <div class="right">
                                          <# if(setting.tooltip_title){ #>
                                              <h3 style="color:white;">{{{setting.tooltip_title}}}</h3>
                                          <# } #>
                                            <p>{{{setting.tooltip}}}</p>
                                         </div>
                                    </div>
                                        <# } #>
                                    </span>
                                <# } #>
                                <span class="wpat-setting-wrap input-{{setting.type}}-wrap">
                                    {{{setting.content}}}
                                </span>
                            </div>
                            <# } #>
                        <# }); #>

                        <div class="submit inline-edit-save">
                            <button type="button" class="button cancel alignleft">{{data.I18n.cancel}}</button>
                            <# var confrimData = ( data.confirm > '' ) ? ' data-confirm="'+data.confirm+'"' : ''; #>
                            <button type="button" class="button button-primary save alignright"{{{confrimData}}}>{{data.I18n.update}}</button>
                        </div>

                    </div>

                </fieldset>

            </div>
        </td>
    </tr>
</script>
