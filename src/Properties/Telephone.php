<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Telephone extends Property implements PropertyInterface
{
    private string $number;
    private string $phoneType;

    /**
     * Represents the telephone property on a vCard.
     * 
     * @param String $number The telephone number.
     * @param String $phoneType Optional. The type of telephone number.
     */
    public function __construct(string $number, string $phoneType = 'cell')
    {
        $this->number = str_replace(' ', '', str_replace('-', '', $number));
        $this->phoneType = $phoneType;
    }

    public function parse() : string
    {
        return 'TEL;TYPE='. $this->phoneType . ':' . $this->number;
    }
}