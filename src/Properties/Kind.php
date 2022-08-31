<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Exceptions\InvalidTypeException;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Kind extends Property implements PropertyInterface
{
    private array $kinds = [
        'individual',
        'group',
        'org',
        'location'
    ];

    private string $kind;

    public function __construct(string $kind)
    {
        if(!in_array(strtolower($kind), $this->kinds)){
            throw new InvalidTypeException('The kind ' . $kind . 'is not in the allowed list of kinds. The allowed kinds are: ' . implode(', ', $this->kinds));
        }

        $this->kind = $kind;
    }

    public function parse(): string
    {
        return 'KIND:' . $this->kind;
    }
}