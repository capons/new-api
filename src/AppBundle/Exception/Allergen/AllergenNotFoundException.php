<?php

namespace AppBundle\Exception\Allergen;

use AppBundle\Exception\NotFoundApiException;

class AllergenNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Allergen not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}