<?php

namespace Stripe;



class Card extends ApiResource
{
    const OBJECT_NAME = 'card';

    use ApiOperations\Delete;
    use ApiOperations\Update;

    
    const CVC_CHECK_FAIL        = 'fail';
    const CVC_CHECK_PASS        = 'pass';
    const CVC_CHECK_UNAVAILABLE = 'unavailable';
    const CVC_CHECK_UNCHECKED   = 'unchecked';

    
    const FUNDING_CREDIT  = 'credit';
    const FUNDING_DEBIT   = 'debit';
    const FUNDING_PREPAID = 'prepaid';
    const FUNDING_UNKNOWN = 'unknown';

    
    const TOKENIZATION_METHOD_APPLE_PAY  = 'apple_pay';
    const TOKENIZATION_METHOD_GOOGLE_PAY = 'google_pay';

    
    public 
function instanceUrl()
    {
        if ($this['customer']) {
            $base = Customer::classUrl();
            $parent = $this['customer'];
            $path = 'sources';
        } elseif ($this['account']) {
            $base = Account::classUrl();
            $parent = $this['account'];
            $path = 'external_accounts';
        } elseif ($this['recipient']) {
            $base = Recipient::classUrl();
            $parent = $this['recipient'];
            $path = 'cards';
        } else {
            $msg = "Cards cannot be accessed without a customer ID, account ID or recipient ID.";
            throw new Exception\UnexpectedValueException($msg);
        }
        $parentExtn = urlencode(Util\Util::utf8($parent));
        $extn = urlencode(Util\Util::utf8($this['id']));
        return "$base/$parentExtn/$path/$extn";
    }

    
    public static 
function retrieve($_id, $_opts = null)
    {
        $msg = "Cards cannot be retrieved without a customer ID or an " .
               "account ID. Retrieve a card using " .
               "`Customer::retrieveSource('customer_id', 'card_id')` or " .
               "`Account::retrieveExternalAccount('account_id', 'card_id')`.";
        throw new Exception\BadMethodCallException($msg);
    }

    
    public static 
function update($_id, $_params = null, $_options = null)
    {
        $msg = "Cards cannot be updated without a customer ID or an " .
               "account ID. Update a card using " .
               "`Customer::updateSource('customer_id', 'card_id', " .
               "\$updateParams)` or `Account::updateExternalAccount(" .
               "'account_id', 'card_id', \$updateParams)`.";
        throw new Exception\BadMethodCallException($msg);
    }
}
