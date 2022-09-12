<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class CalendarSchedulingURL extends Property implements PropertyInterface
{
    private string $url;

    /**
     * Represents the Calander Scheduling-URL property on a vCard.
     * 
     * @param String $url The url to use for sending a scheduling request to the person's calendar.
     */
    public function __construct(string $url)
    {
        
        $this->url = $url;
    }

    public function parse() : string
    {
        return 'CALADRURI:' . $this->url;
    }
}