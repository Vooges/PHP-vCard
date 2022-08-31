<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Logo extends Property implements PropertyInterface
{
    private string $note;

    /**
     * Represents the note property on a vCard.
     * 
     * @param String $note The note regarding the person.
     */
    public function __construct(string $note)
    {
        $this->note = $note;
    }

    public function parse(): string
    {
        return 'NOTE:' . $this->fold($this->note);
    }
}