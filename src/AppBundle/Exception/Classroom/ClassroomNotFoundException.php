<?php

namespace AppBundle\Exception\Classroom;

use AppBundle\Exception\NotFoundApiException;

class ClassroomNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Classroom not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}