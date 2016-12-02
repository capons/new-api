<?php

namespace AppBundle\Exception\Article;

use AppBundle\Exception\NotFoundApiException;

class ArticleTypeNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Article type not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}