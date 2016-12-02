<?php

namespace AppBundle\Exception\User;

use AppBundle\Exception\NotFoundApiException;

class UserNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'User not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}