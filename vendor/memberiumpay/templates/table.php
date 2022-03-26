<# var attrs   = ( data.attrs > '' ) ? data.attrs : {},
    columns       = ( data.columns ) ? data.columns : {},
    hidden        = ( data.hidden ) ? data.hidden : [],
    rows          = ( data.rows ) ? data.rows : {},
    items_total   = _.size(rows),
    I18n          = data.I18n,
    item_txt      = ( items_total > 1 ) ? I18n.items : I18n.item;
#>
<table <# _.each( attrs, function( attr ) { #>{{attr.prop}}="{{attr.value}}"<# } ) #>>
    <?php  ?>
    <thead>
        <tr>
        <# _.each( columns, function( value, key ) { #>
            <# var is_hidden = ( hidden.indexOf(key) !== -1 ) ? ' wpal-ecomm-hidden-col' : ''; #>
            <th scope="col" id="{{key}}" class="manage-column column-{{key}}{{is_hidden}}">
                <span>{{{value}}}</span>
            </th>
        <# }); #>
        </tr>
    </thead>
    <?php  ?>
    <# if( items_total > 0 ){ #>
    <tbody>
        <# _.each( rows, function( row, r ) { #>
        <# var row_id = ( row.id ) ? row.id : r; #>
        <tr>
            <# _.each( columns, function( title, key ) { #>
            <# var is_hidden = ( hidden.indexOf(key) !== -1 ) ? ' wpal-ecomm-hidden-col' : ''; #>
            <td class="column-{{key}}{{is_hidden}}">
                <# if(title){ #>
                <span class="wpal-ecomm-table-title-mobile">
                    {{{title}}}
                </span>
                <# } #>
                <# if(row[key]){ #>
                    <span class="wpal-ecomm-td-content">
                        {{{row[key]}}}
                    </span>
                <# } #>
            </td>
            <# }); #>
        </tr>
        <# }); #>
    </tbody>
    <# } #>
</table>
