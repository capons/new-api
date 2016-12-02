<?php

namespace AppBundle\Exception\Ingredient;

use AppBundle\Exception\NotFoundApiException;

class IngredientTypeNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Ingredient type not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}