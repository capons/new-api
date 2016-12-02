<?php

namespace AppBundle\Exception\Category;

use AppBundle\Exception\NotFoundApiException;

class CategoryNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Category not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}