<?php

namespace AppBundle\Exception\Order;

use AppBundle\Exception\NotFoundApiException;
class OrderNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Order not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}