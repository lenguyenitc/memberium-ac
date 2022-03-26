<# var prefix = ( data.billingPrefix ) ? data.billingPrefix : 'billing';#>
<ul class="{{prefix}}-details">
    <# if(data.billing_first_name > '' && data.billing_last_name > '' && ! data.name_on_card) { #>
    <li class="{{prefix}}-name">{{data.billing_first_name}} {{data.billing_last_name}}</li>
    <# } #>
    <li class="{{prefix}}-line1">{{data.billing_address_1}}</li>
    <# if( data.billing_address_2 > '' ){ #>
    <li class="{{prefix}}-line2">{{data.billing_address_2}}</li>
    <# } #>
    <li class="{{prefix}}-city-state">{{data.billing_city}}, {{data.billing_state}}</li>
    <li class="{{prefix}}-postal">{{data.billing_postcode}}</li>
    <li class="{{prefix}}-country">{{data.countryName}}</li>
    <# if( data.billing_phone > '' ){ #>
    <li class="{{prefix}}-phone">{{data.billing_phone}}</li>
    <# } #>
    <# if( data.billing_email > '' ){ #>
    <li class="{{prefix}}-email">{{data.billing_email}}</li>
    <# } #>
</ul>
