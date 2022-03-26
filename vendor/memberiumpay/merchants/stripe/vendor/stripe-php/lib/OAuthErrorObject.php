<?php

namespace Stripe;



class OAuthErrorObject extends StripeObject
{
    
    public 
function refreshFrom($values, $opts, $partial = false)
    {
                                $values = array_merge([
            'error' => null,
            'error_description' => null,
        ], $values);
        parent::refreshFrom($values, $opts, $partial);
    }
}
