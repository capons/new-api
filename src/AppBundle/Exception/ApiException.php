<?php
namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class ApiException extends HttpException
{
    private $statusCode;
    private $data;
    
    public function __construct($data, $statusCode, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
        parent::__construct($this->statusCode, $this->data, $previous, $headers, $code);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getData()
    {
        return $this->data;
    }
}