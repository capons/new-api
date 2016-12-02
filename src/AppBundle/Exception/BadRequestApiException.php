<?php

namespace AppBundle\Exception;

class BadRequestApiException extends ApiException
{
    CONST StatusCode = 400;
    CONST Message = 'Bad request';
    
    public function __construct($data = self::Message)
    {
        parent::__construct($data, self::StatusCode);
    }
}