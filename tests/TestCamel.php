<?php
declare(strict_types=1);
set_include_path('../../');
include_once('src/Camel.php');
use Text\Camel;
use PHPUnit\Framework\TestCase;

final class TestCamel extends TestCase
{
    protected static $camel;
    protected static $string;
    public function setUp() : void
    {
        self::$string = "I check my article table, there is no test data anymore, it seems that setup() has cleaned it up. Is it how it should work?";
        self::$camel = new Camel(self::$string);
        $this->assertSame('I check my article table, there is no test data anymore, it seems that setup() has cleaned it up. Is it how it should work?', 
            self::$string);
    }

    public function testInitializeClassWithSimpleString() : void 
    {
        $string = "This is a Test StRing";
        $camel = new Camel($string);
        $getString = $camel->getOriginalText();
        $this->assertNotEmpty($getString);
        $this->assertSame($string, $getString);
    }

    public function testInitializeClassWithNoString() : void
    {
        $this->expectException(ArgumentCountError::class);
        $camel = new Camel();
    }

    public function testInitializeClassWithMinus1() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $camel = new Camel(-1);
    }

    public function testInitializeClassWithNullValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $camel = new Camel(null);
    }

    public function testInitializeClassWithEmptyString() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $camel = new Camel('');
    }

    public function testSwitchCaseFunction() : void
    {
        $getString = self::$camel->switchCase();
        $this->assertNotEmpty($getString);
        $this->assertSame('i CHECK MY ARTICLE TABLE, THERE IS NO TEST DATA ANYMORE, IT SEEMS THAT SETUP() HAS CLEANED IT UP. iS IT HOW IT SHOULD WORK?', $getString);
    }

    public function testSwitchNtoCaseEvery2() : void 
    {
        $getString = self::$camel->switchNtoCase(2);
        $this->assertNotEmpty($getString);
        $this->assertSame('I cHeCk mY ArTiClE TaBlE, tHeRe iS No tEsT DaTa aNyMoRe, It sEeMs tHaT SeTuP() HaS ClEaNeD It uP. IS It hOw iT ShOuLd wOrK?', $getString);
    }

    public function testSwitchNtoCaseEvery5() : void 
    {
        $getString = self::$camel->switchNtoCase(5);
        $this->assertNotEmpty($getString);
        $this->assertSame('I chEck mY artIcle Table, theRe is no tEst dAta aNymorE, it seemS thaT setUp() Has cLeaneD it Up. IS it How iT shoUld wOrk?', $getString);
    }

    public function testSwitchNtoCaseEvery0() : void 
    {
        $getString = self::$camel->switchNtoCase(0);
        $this->assertNotEmpty($getString);
        $this->assertSame(self::$string, $getString);
    }

    public function testSwitchNtoCaseEveryNegative1() : void 
    {
        $this->expectException(InvalidArgumentException::class);
        $getString = self::$camel->switchNtoCase(-1);
    }

    public function testSwitchNtoCaseForNull() : void 
    {
        $this->expectException(InvalidArgumentException::class);
        $getString = self::$camel->switchNtoCase(null);
    }

    public function testSwitchNtoCaseForEmpty() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $getString = self::$camel->switchNtoCase('');
    }


}