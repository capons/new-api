<?php

namespace AppBundle\Exception\Article;

use AppBundle\Exception\NotFoundApiException;

class ArticleGroupNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Article group not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}