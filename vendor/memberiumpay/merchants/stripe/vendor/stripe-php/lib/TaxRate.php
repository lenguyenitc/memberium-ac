<?php

namespace Stripe;



class TaxRate extends ApiResource
{
    const OBJECT_NAME = 'tax_rate';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
