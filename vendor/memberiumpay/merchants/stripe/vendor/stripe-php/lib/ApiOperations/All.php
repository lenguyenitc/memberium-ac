<?php

namespace Stripe\ApiOperations;


trait All
{
    
    public static 
function all($params = null, $opts = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \Stripe\Util\Util::convertToStripeObject($response->json, $opts);
        if (!($obj instanceof \Stripe\Collection)) {
            throw new \Stripe\Exception\UnexpectedValueException(
                'Expected type ' . \Stripe\Collection::class . ', got "' . get_class($obj) . '" instead.'
            );
        }
        $obj->setLastResponse($response);
        $obj->setFilters($params);
        return $obj;
    }
}
