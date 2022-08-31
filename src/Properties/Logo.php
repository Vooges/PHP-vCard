<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Logo extends Property implements PropertyInterface
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function parse(): string
    {
        return 'LOGO:' . $this->url;
    }
}