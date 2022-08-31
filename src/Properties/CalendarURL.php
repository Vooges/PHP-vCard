<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class CalendarURL extends Property implements PropertyInterface
{
    private string $url;

    /**
     * Represents the Calendar-URL property on a vCard.
     * 
     * @param String $url The url to the person's calendar.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function parse(): string
    {
        return 'CALURI:TYPE=' . $this->type . ':' . $this->url;
    }
}