<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class ProductID extends Property implements PropertyInterface
{
    public function parse(): string
    {
        return 'PRODID:JesseVooges//PHPvCard';
    }
}