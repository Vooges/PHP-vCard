<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Email extends Property implements PropertyInterface
{
    private string $email;

    /**
     * Represents the email property on a vCard.
     * 
     * @param String $email The person's e-mail address.
     * @param String $type The type of e-mail.
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function parse(): string
    {
        return 'EMAIL:' . $this->email;
    }
}