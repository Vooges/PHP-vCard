<?php

namespace JesseVooges\PHPvCard\Helpers;

use InvalidArgumentException;

final class TypeChecker
{
    /**
     * Checks if the provided item is a different type than the specified type. If the provided item is an array, it will loop through it and check each item.
     * 
     * @param mixed $item the item to check.
     * @param string $type the type the item should be.
     * 
     * @throws InvalidArgumentException
     */
    static function check(mixed $item, mixed $type) : void
    {
        if(gettype($item) === 'array')
        {
            foreach($item as $i)
            {
                self::check($i, $type);
            }
        } 
        else if(!$item instanceof $type)
        {
            throw new InvalidArgumentException(
                'Found an item of type ' . gettype($item) . 
                ' where a type of ' . $type . ' was expected.'
            );
        }
    }
}