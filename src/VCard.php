<?php

namespace JesseVooges\PHPvCard;

use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\Properties\Property;

final class VCard 
{
    private array $properties;
    private string $content;

    /** 
     * @param Property|Property[] $toAdd The property/properties to add.
     * 
     * @throws UnsupportedTypeException
     */
    public function __construct(mixed $toAdd = null)
    {
        if($toAdd !== null)
        {
            TypeChecker::check($toAdd, Property::class);
        }

        $this->properties = gettype($toAdd) === 'array' ? $toAdd : [$toAdd];
    }

    /** 
     * Adds the property/properties to the vCard instance.
     * 
     * @param Property|Property[] $toAdd The property/properties to add.
     * 
     * @throws UnsupportedTypeException
     */
    public function addProperty(mixed $toAdd)
    {
        TypeChecker::check($toAdd, Property::class);

        array_push($this->properties, gettype($toAdd) === 'array' ? $toAdd : [$toAdd]);
    }

    /**
     * Creates a string representation of the vCard. If run again, will replace existing string.
     * 
     * @return String
     */
    public function parse(): string
    {
        $this->content = "BEGIN:VCARD\r\nVERSION:4.0\r\n";

        foreach($this->properties as $p)
        {
            $this->content .= $p->parse() . "\r\n";
        }

        $this->content .= "END:VCARD";
        
        return $this->content;
    }

    public function __toString()
    {
        return $this->content ? $this->content : $this->parse();
    }
}