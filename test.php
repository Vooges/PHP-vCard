<?php

require './vendor/autoload.php';

use JesseVooges\PHPvCard\Parsers\VCardParser;
use JesseVooges\PHPvCard\Properties\Email;
use JesseVooges\PHPvCard\Properties\FormattedName;
use JesseVooges\PHPvCard\Properties\Name;
use JesseVooges\PHPvCard\Properties\Organisation;
use JesseVooges\PHPvCard\Properties\Telephone;
use JesseVooges\PHPvCard\Properties\Title;
use JesseVooges\PHPvCard\VCard;

$properties = [
    new Name('Doe', 'John'),
    new Telephone('+1-202-555-0125'),
    new Organisation('Company', 'Development'),
    new FormattedName('John Doe'),
    new Title('Developer'),
    new Email('email@example.org')
];

$vCard = new VCard($properties);

$vCardParser = new VCardParser($vCard);

//Show string representation
echo $vCardParser->parse();

$vCardParser->toFile(__DIR__);