<?php

namespace Stripe;



class Source extends ApiResource
{
    const OBJECT_NAME = 'source';

    use ApiOperations\Create;
    use ApiOperations\NestedResource;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    
    const FLOW_REDIRECT          = 'redirect';
    const FLOW_RECEIVER          = 'receiver';
    const FLOW_CODE_VERIFICATION = 'code_verification';
    const FLOW_NONE              = 'none';

    
    const STATUS_CANCELED   = 'canceled';
    const STATUS_CHARGEABLE = 'chargeable';
    const STATUS_CONSUMED   = 'consumed';
    const STATUS_FAILED     = 'failed';
    const STATUS_PENDING    = 'pending';

    
    const USAGE_REUSABLE   = 'reusable';
    const USAGE_SINGLE_USE = 'single_use';

    
    public 
function detach($params = null, $opts = null)
    {
        self::_validateParams($params);

        $id = $this['id'];
        if (!$id) {
            $class = get_class($this);
            $msg = "Could not determine which URL to request: $class instance "
             . "has invalid ID: $id";
            throw new Exception\UnexpectedValueException($msg, null);
        }

        if ($this['customer']) {
            $base = Customer::classUrl();
            $parentExtn = urlencode(Util\Util::utf8($this['customer']));
            $extn = urlencode(Util\Util::utf8($id));
            $url = "$base/$parentExtn/sources/$extn";

            list($response, $opts) = $this->_request('delete', $url, $params, $opts);
            $this->refreshFrom($response, $opts);
            return $this;
        } else {
            $message = "This source object does not appear to be currently attached "
               . "to a customer object.";
            throw new Exception\UnexpectedValueException($message);
        }
    }

    
    public 
function sourceTransactions($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/source_transactions';
        list($response, $opts) = $this->_request('get', $url, $params, $opts);
        $obj = \Stripe\Util\Util::convertToStripeObject($response, $opts);
        $obj->setLastResponse($response);
        return $obj;
    }

    
    public static 
function allSourceTransactions($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, '/source_transactions', $params, $opts);
    }

    
    public 
function verify($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/verify';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
