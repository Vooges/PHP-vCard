<?php

namespace JesseVooges\PHPvCard\Properties;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Begin extends Property implements PropertyInterface
{
    public function parse() : string
    {
        return 'BEGIN:VCARD';
    }
}