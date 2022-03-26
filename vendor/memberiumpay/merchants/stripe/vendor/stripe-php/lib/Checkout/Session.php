<?php

namespace Stripe\Checkout;



class Session extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'checkout.session';

    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;

    
    const SUBMIT_TYPE_AUTO    = 'auto';
    const SUBMIT_TYPE_BOOK    = 'book';
    const SUBMIT_TYPE_DONATE  = 'donate';
    const SUBMIT_TYPE_PAY     = 'pay';
}
