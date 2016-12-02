<?php

namespace AppBundle\Exception\Document;

use AppBundle\Exception\NotFoundApiException;
class DocumentTypeNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Document type not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}