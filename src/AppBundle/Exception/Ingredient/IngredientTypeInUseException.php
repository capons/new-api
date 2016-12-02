<?php

namespace AppBundle\Exception\Ingredient;

use AppBundle\Exception\ForbiddenApiException;
use AppBundle\Exception\NotFoundApiException;

class IngredientTypeInUseException extends ForbiddenApiException
{
    const MESSAGE = 'Ingredient type in use';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}