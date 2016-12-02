<?php

namespace AppBundle\Exception\Role;

use AppBundle\Exception\NotFoundApiException;

class RolePermissionNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Role permission not found';
    
    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}