<?php

namespace JesseVooges\PHPvCard\Exceptions;

use Exception;
use Throwable;

final class VCardNotFoundException extends Exception
{
    public function __construct($message = 'Could not find the provided vCard', $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}