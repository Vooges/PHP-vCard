<?php

namespace JesseVooges\PHPvCard\Properties;

use DateTimeImmutable;
use DateTimeInterface;
use JesseVooges\PHPvCard\Exceptions\InvalidDateException;
use JesseVooges\PHPvCard\Exceptions\UnsupportedTypeException;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Anniversary extends Property implements PropertyInterface
{
    private string $anniversary;

    /**
     * Represents the anniversary property on a vCard.
     * 
     * @param String|DateTimeImmutable $anniversary The person's anniversary.
     */
    public function __construct(mixed $anniversary)
    {
        if(is_string($anniversary)){
            $anniversary = new DateTimeImmutable($anniversary);

            if(!$anniversary){
                throw new InvalidDateException();
            }
        }

        if($anniversary instanceof DateTimeInterface){
            $this->anniversary = $anniversary->format('Ymd');
        } else {
            throw new UnsupportedTypeException('Only strings and DateTimeInterface objects are supported');
        }
    }

    public function parse(): string
    {
        return 'ANNIVERSARY:' . $this->anniversary;
    }
}