<?php

namespace JesseVooges\PHPvCard;

use JesseVooges\PHPvCard\Exceptions\MissingPropertiesException;
use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\Properties\Begin;
use JesseVooges\PHPvCard\Properties\End;
use JesseVooges\PHPvCard\Properties\FormattedName;
use JesseVooges\PHPvCard\Properties\ProductID;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Version;
use InvalidArgumentException;

final class VCard 
{
    /**
     * Properties required as per the vCard 4.0 spec
     */
    private array $required = [
        FormattedName::class
    ];

    private array $properties = [];
    private string $content = "";

    /** 
     * @param Property|Property[] $toAdd The property/properties to add.
     * 
     * @throws InvalidArgumentException
     */
    public function __construct(mixed $toAdd = null)
    {
        if($toAdd !== null)
        {
            TypeChecker::check($toAdd, Property::class);
            
            /**
            * Check if $toAdd is an array and cast to array if it isn't, then add it to the properties array.
            */
            $this->properties = array_merge(
                $this->properties, 
                gettype($toAdd) === 'array' 
                    ? $toAdd 
                    : [$toAdd]
            );
        }
    }

    /** 
     * Adds the property/properties to the vCard instance.
     * 
     * @param Property|Property[] $toAdd The property/properties to add.
     * 
     * @throws InvalidArgumentException
     */
    public function add(mixed $toAdd) : void
    {
        /**
         * Check if vCard contains an End property
         */
        $key = array_search(new End(), $this->properties);

        /**
         * Remove End property if vCard contains End property
         */
        if($key)        
        {
            unset($this->properties);

            $this->properties = array_values($this->properties);
        }

        TypeChecker::check($toAdd, Property::class);

        /**
        * Check if $toAdd is an array and cast to array if it isn't, then add it to the properties array.
        */
        $this->properties = array_merge(
            $this->properties, 
            gettype($toAdd) === 'array' 
                ? $toAdd 
                : [$toAdd]
        );
    }

    /**
     * Creates a string representation of the vCard. If run again, will replace existing string.
     * 
     * @throws MissingPropertiesException
     * 
     * @return String
     */
    public function parse() : string
    {
        /**
         * Check if all required properties are present
         */
        $this->checkProperties();

        /**
         * Clear content
         */
        $this->content = "";

        $properties = array_merge([new Begin(), new Version(), new ProductID()], $this->properties);


        foreach($properties as $p)
        {
            $this->content .= $p->parse() . "\r\n";
        }

        $this->content .= (new End())->parse() . "\r\n";
        
        return $this->content;
    }

    public function getProperties() : array
    {
        return $this->properties;
    }

    /** 
     * Checks wether or not the vcard instance contains all required properties as per the vCard 4.0 spec.
     * 
     * @throws MissingPropertiesException
     */
    private function checkProperties() : void
    {
        foreach($this->required as $r)
        {
            $isPresent = false;

            foreach($this->properties as $p)
            {
                if($p instanceof $r)
                {
                    /**
                     * Property is found on the vcard instance.
                     */
                    $isPresent = true;
                }
            }

            if(!$isPresent)
            {
                throw new MissingPropertiesException('The property ' . $r . ' is missing.');
            }
        }
    }
}