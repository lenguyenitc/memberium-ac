<?php

namespace Stripe;



class Person extends ApiResource
{
    const OBJECT_NAME = 'person';

    use ApiOperations\Delete;
    use ApiOperations\Update;

    
    const GENDER_MALE   = 'male';
    const GENDER_FEMALE = 'female';

    
    const VERIFICATION_STATUS_PENDING    = 'pending';
    const VERIFICATION_STATUS_UNVERIFIED = 'unverified';
    const VERIFICATION_STATUS_VERIFIED   = 'verified';

    
    public 
function instanceUrl()
    {
        $id = $this['id'];
        $account = $this['account'];
        if (!$id) {
            throw new Exception\UnexpectedValueException(
                "Could not determine which URL to request: " .
                "class instance has invalid ID: $id",
                null
            );
        }
        $id = Util\Util::utf8($id);
        $account = Util\Util::utf8($account);

        $base = Account::classUrl();
        $accountExtn = urlencode($account);
        $extn = urlencode($id);
        return "$base/$accountExtn/persons/$extn";
    }

    
    public static 
function retrieve($_id, $_opts = null)
    {
        $msg = "Persons cannot be retrieved without an account ID. Retrieve " .
               "a person using `Account::retrievePerson('account_id', " .
               "'person_id')`.";
        throw new Exception\BadMethodCallException($msg, null);
    }

    
    public static 
function update($_id, $_params = null, $_options = null)
    {
        $msg = "Persons cannot be updated without an account ID. Update " .
               "a person using `Account::updatePerson('account_id', " .
               "'person_id', \$updateParams)`.";
        throw new Exception\BadMethodCallException($msg, null);
    }
}
