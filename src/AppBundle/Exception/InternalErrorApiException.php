<?php

namespace AppBundle\Exception;

class InternalErrorApiException extends ApiException
{
    CONST StatusCode = 500;
    CONST Message = 'Internal application error';

    public function __construct($data = self::Message)
    {
        parent::__construct($data, self::StatusCode);
    }
}