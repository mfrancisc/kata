<?php
require './src/StringCalculator.php';

/**
 * StringCalculatorTest
 *
 * @group StringCalculator
 */
class StringCalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $stringCalculator;
    public function setUp() {
        $this->stringCalculator = new StringCalculator();
    }
    
    //tests
    public function testIfEmptyStringReturnsZero() {
        $this->assertEquals(0, $this->stringCalculator->add(""));
    }
    public function testIfReturnsNumber() {
        $this->assertEquals(1, $this->stringCalculator->add("1"));
        $this->assertEquals(2, $this->stringCalculator->add("2"));
        $this->assertEquals(3, $this->stringCalculator->add("3"));
    }
    public function testReturnSumOfTwoNumbers() {
        $this->assertEquals(1, $this->stringCalculator->add("0,1"));
        $this->assertEquals(2, $this->stringCalculator->add("1,1"));
        $this->assertEquals(3, $this->stringCalculator->add("1,2"));
        $this->assertNotEquals(3, $this->stringCalculator->add("2,2"));
        $this->assertEquals(16, $this->stringCalculator->add("9,7"));
        $this->assertEquals(20, $this->stringCalculator->add("9,11"));
        $this->assertEquals(40, $this->stringCalculator->add("10,30"));
        $this->assertEquals(160, $this->stringCalculator->add("100,60"));
    }
    
    public function testIfSumsUnknouwnAmountOfNumbers() {
        $this->assertEquals(1, $this->stringCalculator->add("0,0,1"));
        $this->assertEquals(2, $this->stringCalculator->add("0,1,1"));
        $this->assertEquals(3, $this->stringCalculator->add("1,1,1"));
        $this->assertEquals(4, $this->stringCalculator->add("2,1,1"));
        $this->assertEquals(24, $this->stringCalculator->add("3,10,11"));
        $this->assertEquals(34, $this->stringCalculator->add("3,9,10,12"));
        $this->assertEquals(110, $this->stringCalculator->add("5,5,10,12,20,28,30"));
    }
    public function testIfSumsUnknownAmountOfnumbersWithNewLinesAndCommasAsSeparators() {
        $this->assertEquals(6, $this->stringCalculator->add("1\n2,3"));
        $this->assertEquals(6, $this->stringCalculator->add("1,2\n3"));
        $this->assertEquals(6, $this->stringCalculator->add("1\n2\n3"));
        $this->assertNotEquals(6, $this->stringCalculator->add("2\n2\n3"));
    }
    public function testIfCanGetDelimiter() {
        $this->assertEquals(3, $this->stringCalculator->add("//[;]\n1;2"));
        $this->assertEquals(4, $this->stringCalculator->add("//[,]\n2,2"));
        $this->assertEquals(5, $this->stringCalculator->add("//[|]\n3|2"));
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage negatives not allowed -1
     */
    public function testIfWrongNegativeNumbersWithComa() {
        $this->stringCalculator->add("0,1,-1");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage negatives not allowed -2
     */
    public function testIfWrongNegativeNumbersWithSep() {
        $this->stringCalculator->add("//[;]\n3;-2");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage negatives not allowed -2
     */
    public function testIfWrongNegativeNumbersSpaceAndComma() {
        $this->stringCalculator->add("1\n3,-2");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage negatives not allowed -1,-2,-3
     */
    public function testIfShowsMoreThenOneNegativeNumberInExeception() {
        $this->stringCalculator->add("-1,-2,-3");
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage negatives not allowed -1,-3
     */
    public function testIfShowsMoreThenOneNegativeNumberWithSep() {
        $this->stringCalculator->add("-1\n0,-3");
    }
    public function testIfRefusesNumbersGt100() {
        $this->assertEquals(2, $this->stringCalculator->add("//[;]\n1001;2"));
        $this->assertEquals(1000, $this->stringCalculator->add("//[;]\n999;1"));
        $this->assertEquals(1001, $this->stringCalculator->add("1000,1"));
    }
    public function testIfDelimiterCanBenOfAnyLength()
    {
        $this->assertEquals(6, $this->stringCalculator->add("//[***]\n1***2***3"));
        $this->assertEquals(3, $this->stringCalculator->add("//[---]\n1---2"));
    
    }
}
