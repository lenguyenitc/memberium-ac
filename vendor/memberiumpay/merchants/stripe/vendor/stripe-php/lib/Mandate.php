<?php

namespace Stripe;



class Mandate extends ApiResource
{
    const OBJECT_NAME = 'mandate';

    use ApiOperations\Retrieve;
}
