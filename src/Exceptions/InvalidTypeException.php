<?php

namespace JesseVooges\PHPvCard\Exceptions;

use Exception;
use Throwable;

final class InvalidTypeException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}