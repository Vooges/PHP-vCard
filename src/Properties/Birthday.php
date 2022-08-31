<?php

namespace JesseVooges\PHPvCard\Properties;

use DateTimeImmutable;
use DateTimeInterface;
use JesseVooges\PHPvCard\Exceptions\InvalidDateException;
use JesseVooges\PHPvCard\Exceptions\UnsupportedTypeException;
use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Birthday extends Property implements PropertyInterface
{
    private string $birthday;

    /**
     * Represents the birthday property on a vCard.
     * 
     * @param String|DateTimeImmutable $birthday The person's birthday.
     */
    public function __construct(mixed $birthday)
    {
        if(is_string($birthday)){
            $birthday = new DateTimeImmutable($birthday);

            if(!$birthday){
                throw new InvalidDateException();
            }
        }

        if($birthday instanceof DateTimeInterface){
            $this->birthday = $birthday->format('Ymd');
        } else {
            throw new UnsupportedTypeException('Only strings and DateTimeInterface objects are supported');
        }
    }

    public function parse(): string
    {
        return 'BDAY:' . $this->birthday;
    }
}