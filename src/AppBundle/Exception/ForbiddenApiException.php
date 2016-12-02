<?php

namespace AppBundle\Exception;

class ForbiddenApiException extends ApiException
{
    CONST StatusCode = 403;
    CONST Message = 'Forbidden';

    public function __construct($data = self::Message)
    {
        parent::__construct($data, self::StatusCode);
    }
}