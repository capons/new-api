<?php

namespace AppBundle\Exception;

class UnauthorizedApiException extends ApiException
{
    CONST StatusCode = 401;
    CONST Message = 'OAuth authorization required';

    public function __construct($data = self::Message)
    {
        parent::__construct($data, self::StatusCode);
    }
}