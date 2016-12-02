<?php

namespace AppBundle\Exception\Document;

use AppBundle\Exception\NotFoundApiException;
class DocumentNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Document not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}