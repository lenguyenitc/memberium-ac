<?php

namespace Stripe\Exception\OAuth;


abstract 
class OAuthErrorException extends \Stripe\Exception\ApiErrorException
{
    protected 
function constructErrorObject()
    {
        if (is_null($this->jsonBody)) {
            return null;
        }

        return \Stripe\OAuthErrorObject::constructFrom($this->jsonBody);
    }
}
