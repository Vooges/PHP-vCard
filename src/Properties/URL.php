<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class URL extends Property implements PropertyInterface
{
    private string $url;

    /**
     * Represents the url property on a vCard.
     * 
     * @param String $url The url pointing to a website that represents the person.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function parse(): string
    {
        return 'URL:' . $this->url;
    }
}