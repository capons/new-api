<?php

namespace AppBundle\Exception;

use AppBundle\Exception\BadRequestApiException;

class WrongOrderTypeException extends BadRequestApiException
{
    const MESSAGE = 'Wrong order type. Possible types: ';

    public function __construct($types)
    {
        parent::__construct(self::MESSAGE . implode(', ', $types));
    }
}