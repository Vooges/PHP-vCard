<?php

namespace JesseVooges\PHPvCard\Tests\Parsers;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use JesseVooges\PHPvCard\Exceptions\VCardNotFoundException;
use JesseVooges\PHPvCard\Parsers\VCardParser;
use JesseVooges\PHPvCard\Properties\Email;
use JesseVooges\PHPvCard\Properties\FormattedName;
use JesseVooges\PHPvCard\Properties\Name;
use JesseVooges\PHPvCard\Properties\Organisation;
use JesseVooges\PHPvCard\Properties\Telephone;
use JesseVooges\PHPvCard\Properties\Title;
use JesseVooges\PHPvCard\VCard;

final class VCardParserTest extends TestCase
{
    /**
     * Constructor tests
     */
    
    public function testInvalidConstructorParameter() : void
    {
        $this->expectException(InvalidArgumentException::class);

        new VCardParser('Test case');
    }

    public function testSingleItemConstructorParameter() : void
    {
        $this->expectNotToPerformAssertions();
        
        $properties = [
            new Name('Doe', 'John'),
            new Telephone('+1-202-555-0125'),
            new Organisation('Company', 'Development'),
            new FormattedName('John Doe'),
            new Title('Developer'),
            new Email('email@example.org')
        ];
        
        $vCard = new VCard($properties);
        
        new VCardParser($vCard);
    }

    public function testArrayConstructorParameter() : void
    {
        $this->expectNotToPerformAssertions();
        
        $properties = [
            new Name('Doe', 'John'),
            new Telephone('+1-202-555-0125'),
            new Organisation('Company', 'Development'),
            new FormattedName('John Doe'),
            new Title('Developer'),
            new Email('email@example.org')
        ];
        
        $vCard = new VCard($properties);
        $vCard2 = new VCard($properties);
        
        new VCardParser([$vCard, $vCard2]);
    }

    public function testEmptyConstructorParameter() : void
    {
        $this->expectNotToPerformAssertions();

        new VCardParser();
    }

    /**
     * Add-function tests
     */

    public function testAddSingleItem() : void
    {
        $vCardParser = new VCardParser();

        $this->expectNotToPerformAssertions();

        $vCardParser->add(new VCard());
    }

    public function testAddMultipleItems() : void
    {
        $vCardParser = new VCardParser();

        $this->expectNotToPerformAssertions();

        $vCardParser->add([new VCard(), new VCard()]);
    }

    public function testAddInvalidItem() : void
    {
        $vCardParser = new VCardParser();

        $this->expectException(InvalidArgumentException::class);

        $vCardParser->add('Test case');
    }

    /**
     * Remove-function tests
     */

    public function testRemoveSingleItem() : void 
    {
        $vCard = new VCard();

        $vCardParser = new VCardParser($vCard);

        $this->expectNotToPerformAssertions();

        $vCardParser->remove(0);
    }

    public function testRemoveMultipleItems() : void 
    {
        $vCard = new VCard();
        $vCard2 = new VCard();

        $vCardParser = new VCardParser([$vCard, $vCard2]);

        $this->expectNotToPerformAssertions();

        $vCardParser->remove([0, 1]);
    }

    public function testRemoveSingleItemWithInvalidParameter() : void
    {
        $vCard = new VCard();

        $vCardParser = new VCardParser($vCard);

        $this->expectException(InvalidArgumentException::class);

        $vCardParser->remove('0');
    }

    public function testRemoveNonExistentItem() : void 
    {
        $vCard = new VCard();

        $vCardParser = new VCardParser($vCard);

        $this->expectException(VCardNotFoundException::class);

        $vCardParser->remove(1);
    }

    public function testParseVCardInformation() : void 
    {
        $parameter = new FormattedName('Test Case');

        $vCard = new VCard($parameter);
        $vCard2 = new VCard($parameter);

        $vCardParser = new VCardParser([$vCard, $vCard2]);

        $expected = "BEGIN:VCARD\r\nVERSION:4.0\r\nPRODID:JesseVooges/PHPvCard\r\nFN:Test Case\r\nEND:VCARD\r\nBEGIN:VCARD\r\nVERSION:4.0\r\nPRODID:JesseVooges/PHPvCard\r\nFN:Test Case\r\nEND:VCARD\r\n";

        $actual = $vCardParser->parse();

        $this->assertSame($expected, $actual);
    }

    /**
     * Getter tests
     */

    public function testGetVCards() : void
    {
        $parameter = new FormattedName('Test Case');

        $vCard = new VCard($parameter);
        $vCard2 = new VCard($parameter);

        $vCardParser = new VCardParser([$vCard, $vCard2]);

        $expected = [$vCard, $vCard2];

        $actual = $vCardParser->getVCards();

        $this->assertSame($expected, $actual);
    }
}