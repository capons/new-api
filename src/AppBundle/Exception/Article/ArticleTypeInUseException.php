<?php

namespace AppBundle\Exception\Article;

use AppBundle\Exception\ForbiddenApiException;
use AppBundle\Exception\NotFoundApiException;

class ArticleTypeInUseException extends ForbiddenApiException
{
    const MESSAGE = 'Article type in use';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}