<?php

namespace AppBundle\Exception\Department;

use AppBundle\Exception\NotFoundApiException;

class DepartmentNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Department not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}