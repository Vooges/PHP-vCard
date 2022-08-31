<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Categories extends Property implements PropertyInterface
{
    private array $categories;

    /**
     * Represents the categories property on a vCard.
     * 
     * @param String|String[] $categories The categories the person belongs to.
     * 
     * @throws UnsupportedTypeException
     */
    public function __construct(mixed $categories)
    {
        TypeChecker::check($categories, 'string');

        $this->categories = gettype($categories) === 'array' ? $categories : [$categories];
    }

    public function parse(): string
    {
        return 'CATEGORIES:' . implode(',', $this->categories);
    }
}