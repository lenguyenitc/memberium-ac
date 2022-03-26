<?php

namespace Stripe;



class Collection extends StripeObject implements \IteratorAggregate
{
    const OBJECT_NAME = 'list';

    use ApiOperations\Request;

    
    protected $filters = [];

    
    public static 
function baseUrl()
    {
        return Stripe::$apiBase;
    }

    
    public 
function getFilters()
    {
        return $this->filters;
    }

    
    public 
function setFilters($filters)
    {
        $this->filters = $filters;
    }

    public 
function offsetGet($k)
    {
        if (is_string($k)) {
            return parent::offsetGet($k);
        } else {
            $msg = "You tried to access the {$k} index, but Collection " .
                   "types only support string keys. (HINT: List calls " .
                   "return an object with a `data` (which is the data " .
                   "array). You likely want to call ->data[{$k}])";
            throw new Exception\InvalidArgumentException($msg);
        }
    }

    public 
function all($params = null, $opts = null)
    {
        self::_validateParams($params);
        list($url, $params) = $this->extractPathAndUpdateParams($params);

        list($response, $opts) = $this->_request('get', $url, $params, $opts);
        $obj = Util\Util::convertToStripeObject($response, $opts);
        if (!($obj instanceof \Stripe\Collection)) {
            throw new \Stripe\Exception\UnexpectedValueException(
                'Expected type ' . \Stripe\Collection::class . ', got "' . get_class($obj) . '" instead.'
            );
        }
        $obj->setFilters($params);
        return $obj;
    }

    public 
function create($params = null, $opts = null)
    {
        self::_validateParams($params);
        list($url, $params) = $this->extractPathAndUpdateParams($params);

        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        return Util\Util::convertToStripeObject($response, $opts);
    }

    public 
function retrieve($id, $params = null, $opts = null)
    {
        self::_validateParams($params);
        list($url, $params) = $this->extractPathAndUpdateParams($params);

        $id = Util\Util::utf8($id);
        $extn = urlencode($id);
        list($response, $opts) = $this->_request(
            'get',
            "$url/$extn",
            $params,
            $opts
        );
        return Util\Util::convertToStripeObject($response, $opts);
    }

    
    public 
function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    
    public 
function getReverseIterator()
    {
        return new \ArrayIterator(array_reverse($this->data));
    }

    
    public 
function autoPagingIterator()
    {
        $page = $this;

        while (true) {
            $filters = $this->filters ?: [];
            if (array_key_exists('ending_before', $filters) &&
                !array_key_exists('starting_after', $filters)) {
                foreach ($page->getReverseIterator() as $item) {
                    yield $item;
                }
                $page = $page->previousPage();
            } else {
                foreach ($page as $item) {
                    yield $item;
                }
                $page = $page->nextPage();
            }

            if ($page->isEmpty()) {
                break;
            }
        }
    }

    
    public static 
function emptyCollection($opts = null)
    {
        return Collection::constructFrom(['data' => []], $opts);
    }

    
    public 
function isEmpty()
    {
        return empty($this->data);
    }

    
    public 
function nextPage($params = null, $opts = null)
    {
        if (!$this->has_more) {
            return static::emptyCollection($opts);
        }

        $lastId = end($this->data)->id;

        $params = array_merge(
            $this->filters ?: [],
            ['starting_after' => $lastId],
            $params ?: []
        );

        return $this->all($params, $opts);
    }

    
    public 
function previousPage($params = null, $opts = null)
    {
        if (!$this->has_more) {
            return static::emptyCollection($opts);
        }

        $firstId = $this->data[0]->id;

        $params = array_merge(
            $this->filters ?: [],
            ['ending_before' => $firstId],
            $params ?: []
        );

        return $this->all($params, $opts);
    }

    private 
function extractPathAndUpdateParams($params)
    {
        $url = parse_url($this->url);
        if (!isset($url['path'])) {
            throw new Exception\UnexpectedValueException("Could not parse list url into parts: $url");
        }

        if (isset($url['query'])) {
                                    $query = [];
            parse_str($url['query'], $query);
            $params = array_merge($params ?: [], $query);
        }

        return [$url['path'], $params];
    }
}
