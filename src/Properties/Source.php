<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Source extends Property implements PropertyInterface
{
    private string $url;

    /**
     * Represents the source property on a vCard.
     * 
     * @param String $url The url that can be used to get the latest version of the vCard.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function parse(): string
    {
        return 'SOURCE:' . $this->url;
    }
}