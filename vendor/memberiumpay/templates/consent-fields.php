<?php

?>
<fieldset class="{{data.className}} wpal-ecomm-accent_border_color">
    <# if(data.legend > ''){ #>
    <legend>{{{data.legend}}}</legend>
    <# } #>
    <# _.each( data.fields, function( field ) { #>
    <div class="wpal-ecomm-field" data-field="{{field.name}}">
        <label for="{{field.name}}">
        <{{field.type}}{{{field.attrs_string}}}>
        <# if( field.type !== 'input' ){ #>
        </{{field.type}}>
        <# } #>
        {{{field.label}}}</label>
    </div>
    <# }) #>

</fieldset>
