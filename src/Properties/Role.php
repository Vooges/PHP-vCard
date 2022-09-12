<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Role extends Property implements PropertyInterface
{
    private string $role;

    /**
     * Represents the role property on a vCard.
     * 
     * @param String $role The person's role.
     */
    public function __construct(string $role)
    {
        $this->role = $role;
    }

    public function parse() : string
    {
        return 'ROLE:' . $this->role;
    }
}