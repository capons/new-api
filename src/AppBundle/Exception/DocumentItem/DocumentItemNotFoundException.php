<?php

namespace AppBundle\Exception\DocumentItem;

use AppBundle\Exception\NotFoundApiException;

class DocumentItemNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Document item not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}