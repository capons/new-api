<?php

namespace AppBundle\Exception\Client;

use AppBundle\Exception\NotFoundApiException;

class ClientNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Client not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}