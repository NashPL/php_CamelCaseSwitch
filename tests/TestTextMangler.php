<?php
declare(strict_types=1);
set_include_path('../../');
include_once('src/TextMangler.php');
use Text\TextMangler;
use PHPUnit\Framework\TestCase;

final class TestTextMangler extends TestCase
{
    public function testInitializeClassWithNoString() : void
    {
        $this->expectException(ArgumentCountError::class);
        $mangler = new TextMangler();
    }

    public function testInitializeClassWithMinus1() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $mangler = new TextMangler(-1);
    }

    public function testInitializeClassWithNullValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $mangler = new TextMangler(null);
    }

    public function testInitializeClassWithEmptyString() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $mangler = new TextMangler('');
    }

    public function testInitializeClassWithSimpleString() : void 
    {
        $string = 'This is a Test StRing';
        $txtMangler = new TextMangler($string);
        $getString = $txtMangler->getString();
        $this->assertNotEmpty($getString);
        $this->assertSame(strtolower($string), $getString);
    }

    public function testGetSymbolCountWithPunctuation() : void
    {
        $string = 'this.. is !! a test';
        $txtMangler = new TextMangler($string);
        $result = $txtMangler->getSymbolCount(true);
        $count = array('!' => 2, '.' => 2, 'a' => 1, 'e' => 1, 'h' => 1, 'i' => 2, 's' => 3, 't' => 3);
        $percent = array('!' => 13.333333333333, '.' => 13.333333333333, 
            'a' => 6.6666666666667, 'e' => 6.6666666666667, 
            'h' => 6.6666666666667, 'i' => 13.333333333333, 
            's' => 20, 't' => 20);
        $this->assertEquals($count, $result['count']);
        $this->assertEquals($percent, $result['percent']);
    }

    public function testGetSymbolCountWithoutPunctuation() : void 
    {
        $string = 'this.. is !! a test';
        $txtMangler = new TextMangler($string);
        $result = $txtMangler->getSymbolCount(false);
        $count = array('a' => 1, 'e' => 1, 'h' => 1, 'i' => 2, 's' => 3, 't' => 3);
        $percent = array('a' => 9.0909090909091, 'e' => 9.0909090909091, 
            'h' => 9.0909090909091, 'i' => 18.181818181818, 
            's' => 27.272727272727, 't' => 27.272727272727);
        $this->assertEquals($count, $result['count']);
        $this->assertEquals($percent, $result['percent']);
    }

    public function testGetNoneAlphanumericCount() : void
    {
        $string = 'this.. is !! a test';
        $txtMangler = new TextMangler($string);
        $result = $txtMangler->getNoneAlphanumericCount();
        $count = array(' ' =>  4, '!' => 2, '.' => 2);
        $percent = array(' ' => 50, '!' => 25, '.' => 25);
        $this->assertEquals($count, $result['count']);
        $this->assertEquals($percent, $result['percent']);
    }
}
