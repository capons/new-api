<?php

namespace AppBundle\Exception\Document;

use AppBundle\Exception\ForbiddenApiException;

class DocumentTypeInUseException extends ForbiddenApiException
{
    const MESSAGE = 'Document type in use';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}