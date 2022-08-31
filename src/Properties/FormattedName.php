<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class FormattedName extends Property implements PropertyInterface
{
    private string $name;

    /**
     * Represents the formatted name property on a vCard.
     * 
     * @param String $name The person's formatted name.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function parse(): string
    {
        return 'FN:' . $this->name;
    }
}