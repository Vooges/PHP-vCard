<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class FreeOrBusyURL extends Property implements PropertyInterface
{
    private string $url;

    /**
     * Represents the free-or-busy-url property on a vCard.
     * 
     * @param String $url The person's free-or-busy-url.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function parse() : string
    {
        return 'FBURL:' . $this->url;
    }
}