<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Title extends Property implements PropertyInterface
{
    private string $title;

    /**
     * Represents the title property on a vCard.
     * 
     * @param String $title The person's job title.
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function parse(): string
    {
        return 'TITLE:' . $this->title;
    }
}