<?php

namespace JesseVooges\PHPvCard\Properties;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Revision extends Property implements PropertyInterface
{
    public function parse(): string
    {
        return 'REV:' . str_replace('+00.00', 'Z', gmdate('c'));
    }
}