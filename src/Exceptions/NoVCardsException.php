<?php

namespace JesseVooges\PHPvCard\Exceptions;

use Exception;
use Throwable;

class NoVCardsException extends Exception
{
    public function __construct($message = 'No vCards were found', $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}