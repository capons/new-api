<?php

namespace AppBundle\Exception\Role;

use AppBundle\Exception\NotFoundApiException;

class RoleNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Role not found';
    
    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}