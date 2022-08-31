<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Organisation extends Property implements PropertyInterface
{
    private string $organisation;
    private array $specifics;

    /**
     * Represents the organisation property on a vCard.
     * 
     * @param String $organisation The organistation the person is working for.
     * @param String $specifics Optional. The specific departments, teams, and/or groups etc. the person belongs to.
     */
    public function __construct(string $organisation, string ...$specifics)
    {
        $this->organisation = $organisation;

        if(isset($specifics))
        {
            $this->specifics = $specifics;
        }
    }

    public function parse(): string
    {
        $string = 'ORG:' . $this->organisation;

        if(isset($this->specifics)){
            $string . ';' . implode(';', $this->specifics);
        }

        return $string;
    }
}