<?php

namespace AppBundle\Exception;

class NotFoundApiException extends ApiException
{
    CONST StatusCode = 404;
    CONST Message = 'Not found';

    public function __construct($data = self::Message)
    {
        parent::__construct($data, self::StatusCode);
    }
}