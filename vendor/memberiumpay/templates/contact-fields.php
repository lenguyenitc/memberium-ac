<?php

?>
<fieldset class="{{data.className}} wpal-ecomm-accent_border_color">

    <legend>{{{data.legend}}}</legend>

    <# _.each( data.fields, function( field ) { #>
    <div class="wpal-ecomm-field" data-field="{{field.name}}">
        <label for="{{field.name}}">{{{field.label}}}</label>
        <# if( field.validate === 'password' ){ #>
        <span class="wpal-ecomm-password-input">
        <# } #>
        <{{field.type}}{{{field.attrs_string}}}>
        <# if( field.type !== 'input' ){ #>
        </{{field.type}}>
        <# } #>
        <# if( field.validate === 'password' ){ #>
            <span class="show-hide-password-icon show-password-input"></span>
        </span>
        <?php  ?>
        <# } #>
    </div>
    <# }) #>

</fieldset>
