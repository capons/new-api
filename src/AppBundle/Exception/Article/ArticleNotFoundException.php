<?php

namespace AppBundle\Exception\Article;

use AppBundle\Exception\NotFoundApiException;

class ArticleNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Article not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}