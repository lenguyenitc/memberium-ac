<?php

namespace Stripe;



class Topup extends ApiResource
{
    const OBJECT_NAME = 'topup';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    
    const STATUS_CANCELED  = 'canceled';
    const STATUS_FAILED    = 'failed';
    const STATUS_PENDING   = 'pending';
    const STATUS_REVERSED  = 'reversed';
    const STATUS_SUCCEEDED = 'succeeded';

    
    public 
function cancel($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/cancel';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
