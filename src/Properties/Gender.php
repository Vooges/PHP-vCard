<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Gender extends Property implements PropertyInterface
{
    private string $gender;

    /**
     * Represents the formatted name property on a vCard. Type is left out intentionally.
     * 
     * @param String $name The person's gender.
     */
    public function __construct(string $gender)
    {
        $this->gender = $gender;
    }

    public function parse(): string
    {
        return 'GENDER:' . $this->gender;
    }
}