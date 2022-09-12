<?php

namespace JesseVooges\PHPvCard\Tests;

use InvalidArgumentException;
use JesseVooges\PHPvCard\Exceptions\MissingPropertiesException;
use JesseVooges\PHPvCard\Parsers\VCardParser;
use JesseVooges\PHPvCard\Properties\Email;
use JesseVooges\PHPvCard\VCard;
use JesseVooges\PHPvCard\Properties\FormattedName;
use JesseVooges\PHPvCard\Properties\Name;
use JesseVooges\PHPvCard\Properties\Organisation;
use JesseVooges\PHPvCard\Properties\Telephone;
use JesseVooges\PHPvCard\Properties\Title;
use PHPUnit\Framework\TestCase;

final class VCardTest extends TestCase
{
    /**
     * Constructor tests
     */

    public function testInvalidConstructorParameter() : void
    {
        $this->expectException(InvalidArgumentException::class);

        new VCard('test');
    }

    public function testInvalidConstructorParameters() : void
    {
        $this->expectException(InvalidArgumentException::class);

        new VCard(['test', 'invalid']);
    }

    public function testEmptyConstructor() : void
    {
        $this->expectNotToPerformAssertions();

        new VCard();
    }

    public function testValidConstructorParameter() : void
    {
        $this->expectNotToPerformAssertions();

        $parameter = new FormattedName('Test Case');

        new VCard($parameter);
    }

    public function testValidConstructorParameters() : void
    {
        $this->expectNotToPerformAssertions();

        $parameters = [
            new FormattedName('Test Case'),
            new Name('Case', 'Test')
        ];

        new VCard($parameters);
    }
    
    /**
     * Add-function tests
     */

    public function testAddInvalidParameter() : void
    {
        $vCard = new VCard();

        $this->expectException(InvalidArgumentException::class);

        $vCard->add(null);
    }

    public function testAddInvalidParameters() : void
    {
        $vCard = new VCard();

        $this->expectException(InvalidArgumentException::class);

        $vCard->add([null, null]);
    }

    public function testAddValidParameter() : void
    {
        $vCard = new VCard();

        $this->expectNotToPerformAssertions();

        $parameter = new FormattedName('Test Case');

        $vCard->add($parameter);
    }

    public function testAddValidParameters() : void
    {
        $vCard = new VCard();

        $this->expectNotToPerformAssertions();

        $parameters = [
            new FormattedName('Test Case'),
            new Name('Case', 'Test')
        ];

        $vCard->add($parameters);
    }

    /**
     * Parse-function tests
     */

    public function testParse() : void
    {
        $expected = "BEGIN:VCARD\r\nVERSION:4.0\r\nPRODID:JesseVooges/PHPvCard\r\nN:Doe;John;;\r\nTEL;TYPE=cell:+12025550125\r\nORG:Company\r\nFN:John Doe\r\nTITLE:Developer\r\nEMAIL:email@example.org\r\nEND:VCARD\r\n";

        $properties = [
            new Name('Doe', 'John'),
            new Telephone('+1-202-555-0125'),
            new Organisation('Company', 'Development'),
            new FormattedName('John Doe'),
            new Title('Developer'),
            new Email('email@example.org')
        ];
        
        $vCard = new VCard($properties);
        
        $this->assertSame($vCard->parse(), $expected);
    }

    /**
     * checkProperties-tests
     */

    public function testMissingProperties() : void
    {
        $vCard = new VCard();

        $this->expectException(MissingPropertiesException::class);

        $vCard->parse();
    }

    public function testNoMissingProperties() : void
    {
        $vCard = new VCard(new FormattedName('Test Case'));

        $this->expectNotToPerformAssertions();

        $vCard->parse();
    }

    /**
     * getProperties tests
     */

    public function testGetProperties() : void
    {
        $vCard = new VCard();

        $this->assertIsArray($vCard->getProperties());
    }
}