<?php

namespace JesseVooges\PHPvCard\Helpers;

use JesseVooges\PHPvCard\Exceptions\UnsupportedTypeException;

final class TypeChecker
{
    /**
     * Checks if the provided item is a different type than the specified type. If the provided
     * 
     * @param mixed $item the item to check.
     * @param string $type the type the item should be.
     * 
     * @throws UnsupportedTypeException
     */
    static function check(mixed $item, mixed $type)
    {
        if(gettype($item) === 'array'){
            foreach($item as $i)
            {
                self::check($i, $type);
            }
        } else if(!$item instanceof $type)
            {
                throw new UnsupportedTypeException(
                    'Found an item of type ' . gettype($item) . 
                    ' where a type of ' . $type . ' was expected.'
                );
            }
    }
}