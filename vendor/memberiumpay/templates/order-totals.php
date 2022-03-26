<# var prefix = data.totalsPrefix; #>
<# if( data.totals > '' ){ #>
<ul class="{{prefix}}">
<# _.each( data.totals, function( price ) { #>
    <li class="{{prefix}}-line {{price.type}}">
        <div>
            <span class="price-label">{{price.label}}</span>
            <span class="price-wrap">
                <i>{{data.symbol}}</i>
                <span class="price">{{price.amount}}</span>
                <span class="currency">({{data.currency}})</span>
            </span>
        </div>
    </li>
<# }) #>
</ul>
<# } #>
