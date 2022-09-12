<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Nickname extends Property implements PropertyInterface
{
    private array $nicknames;

    /**
     * Represents the nickname property on a vCard.
     * 
     * @param String|String[] $nicknames The person's nickname(s).
     * @throws InvalidArgumentException
     */
    public function __construct(mixed $nicknames)
    {
        TypeChecker::check($nicknames, 'string');

        $this->categories = gettype($nicknames) === 'array' ? $nicknames : [$nicknames];
    }

    public function parse() : string
    {
        return 'NICKNAME:' . implode(',', $this->nicknames);
    }
}