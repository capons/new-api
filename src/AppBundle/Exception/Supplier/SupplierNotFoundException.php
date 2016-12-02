<?php

namespace AppBundle\Exception\Supplier;

use AppBundle\Exception\NotFoundApiException;

class SupplierNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Supplier not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}