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
    
    // tests
    public function testIfEmptyStringReturnsZero() {
        $this->assertEquals(0, $this->stringCalculator->add(""));
    }
    public function testIfReturnsNumber() {
        $this->assertEquals(1, $this->stringCalculator->add("1"));
        $this->assertEquals(2, $this->stringCalculator->add("2"));
        $this->assertEquals(3, $this->stringCalculator->add("3"));
    }		
    public function testReturnSumOfTwoNumbers()
    {
    	$this->assertEquals(1, $this->stringCalculator->add("0,1"));
    	$this->assertEquals(2, $this->stringCalculator->add("1,1"));
    	$this->assertEquals(3, $this->stringCalculator->add("1,2"));
    	$this->assertNotEquals(3, $this->stringCalculator->add("2,2"));
    	$this->assertEquals(16, $this->stringCalculator->add("9,7"));
    	$this->assertEquals(20, $this->stringCalculator->add("9,11"));
    	$this->assertEquals(40, $this->stringCalculator->add("10,30"));
    	$this->assertEquals(160, $this->stringCalculator->add("100,60"));
    }
    
    public function testIfSumsUnknouwnAmountOfNumbers()
    {
    	$this->assertEquals(1, $this->stringCalculator->add("0,0,1"));
    	$this->assertEquals(2, $this->stringCalculator->add("0,1,1"));
    	$this->assertEquals(3, $this->stringCalculator->add("1,1,1"));
    	$this->assertEquals(4, $this->stringCalculator->add("2,1,1"));
    	$this->assertEquals(24, $this->stringCalculator->add("3,10,11"));
    	$this->assertEquals(34, $this->stringCalculator->add("3,9,10,12"));
    	$this->assertEquals(110, $this->stringCalculator->add("5,5,10,12,20,28,30"));
    }
    public function testIfSumsUnknownAmountOfnumbersWithNewLinesAndCommasAsSeparators()
    {
    	$this->assertEquals(6, $this->stringCalculator->add("1\n2,3"));
    	$this->assertEquals(6, $this->stringCalculator->add("1,2\n3"));
    	$this->assertEquals(6, $this->stringCalculator->add("1\n2\n3"));
    }
}
