<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Name extends Property implements PropertyInterface
{
    private string $lastname;
    private string $firstname;

    /**
     * Represents the name property on a vCard.
     * 
     * @param String $lastname The person's last name.
     * @param String $firstname The person's first name.
     */
    public function __construct(string $lastname, string $firstname)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
    }

    public function parse() : string
    {
        return 'N:' . $this->lastname . ';' . $this->firstname .';;';
    }
}