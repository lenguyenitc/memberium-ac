<?php

namespace Stripe;



class SubscriptionSchedule extends ApiResource
{
    const OBJECT_NAME = 'subscription_schedule';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    
    public 
function cancel($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/cancel';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }

    
    public 
function release($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/release';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
