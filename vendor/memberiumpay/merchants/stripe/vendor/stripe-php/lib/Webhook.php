<?php

namespace Stripe;

abstract 
class Webhook
{
    const DEFAULT_TOLERANCE = 300;

    
    public static 
function constructEvent($payload, $sigHeader, $secret, $tolerance = self::DEFAULT_TOLERANCE)
    {
        WebhookSignature::verifyHeader($payload, $sigHeader, $secret, $tolerance);

        $data = json_decode($payload, true);
        $jsonError = json_last_error();
        if ($data === null && $jsonError !== JSON_ERROR_NONE) {
            $msg = "Invalid payload: $payload "
              . "(json_last_error() was $jsonError)";
            throw new Exception\UnexpectedValueException($msg);
        }
        $event = Event::constructFrom($data);

        return $event;
    }
}
