<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Note extends Property implements PropertyInterface
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

    public function parse() : string
    {
        /**
         * Notes SHOULD be folded every 75 octets according to the vCard 4.0 spec.
         */
        return 'NOTE:' . $this->fold($this->note);
    }
}