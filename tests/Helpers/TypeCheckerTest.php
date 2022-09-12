<?php

namespace JesseVooges\PHPvCard\Tests\Helpers;

use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\Properties\Begin;
use JesseVooges\PHPvCard\Properties\Property;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use JesseVooges\PHPvCard\Properties\End;

final class TypeCheckerTest extends TestCase
{
    public function testInvalidItem() : void
    {
        $this->expectException(InvalidArgumentException::class);

        TypeChecker::check('String', Property::class);
    }

    public function testValidItem() : void
    {
        $this->expectNotToPerformAssertions();

        TypeChecker::check(new Begin(), Begin::class);
    }

    public function testArrayWithSingleInvalidItem() : void
    {
        $this->expectException(InvalidArgumentException::class);

        $array = [
            new Begin(),
            'String'
        ];

        TypeChecker::check($array, Property::class);
    }
    
    public function testArrayWithMultipleInvalidItems() : void
    {
        $this->expectException(InvalidArgumentException::class);

        $array = [
            1,
            'String'
        ];

        TypeChecker::check($array, Property::class);
    }

    public function testArrayWithValidItems() : void
    {
        $this->expectNotToPerformAssertions();

        $array = [
            new Begin(),
            new End()
        ];

        TypeChecker::check($array, Property::class);
    }
}