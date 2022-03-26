<?php

namespace Stripe\Exception;

if (interface_exists(\Throwable::class)) {
    
    interface ExceptionInterface extends \Throwable
    {
    }
} else {
    
        interface ExceptionInterface
    {
    }
    }
