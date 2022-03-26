<?php

?>
<# var titles = data.I18n.titles; #>
<fieldset class="wpal-ecomm-account-payment-info {{data.className}}">

    <# if( data.legend > '' ){ #>
    <legend>{{{data.legend}}}</legend>
    <# } #>

    <# if( data.desc > '' ){ #>
        <p class="wpal-ecomm-desc">{{{data.desc}}}</p>
    <# } #>

    <# _.each( data.fields, function( field ) { #>
    <div class="wpal-ecomm-field" data-field="{{field.name}}">
        <label for="{{field.name}}">{{field.label}}</label>
        <{{field.type}}{{{field.attrs_string}}}>
        <# if( field.type !== 'input' ){ #>
        </{{field.type}}>
        <# } #>
    </div>
    <# }) #>

    {{{data.content}}}

</fieldset>
