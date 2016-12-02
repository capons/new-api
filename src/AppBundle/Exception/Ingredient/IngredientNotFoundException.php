<?php

namespace AppBundle\Exception\Ingredient;

use AppBundle\Exception\NotFoundApiException;

class IngredientNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Ingredient not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}