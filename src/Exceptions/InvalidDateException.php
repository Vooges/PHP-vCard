<?php

namespace JesseVooges\PHPvCard\Exceptions;

use Exception;
use Throwable;

class InvalidDateException extends Exception
{
    public function __construct($message = 'The provided date is invalid', $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}