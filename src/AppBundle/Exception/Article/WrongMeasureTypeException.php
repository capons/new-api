<?php

namespace AppBundle\Exception\Article;

use AppBundle\Exception\BadRequestApiException;

class WrongMeasureTypeException extends BadRequestApiException
{
    const MESSAGE = 'Wrong measure type. Possible types: ';

    public function __construct($types)
    {
        parent::__construct(self::MESSAGE . implode(', ', $types));
    }
}