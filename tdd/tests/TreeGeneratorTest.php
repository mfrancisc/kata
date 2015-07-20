<?php
/**
 * TreeGeneratorTest
 *
 */
include_once 'src/TreeGenerator.php';

/**
 * TreeGeneratorTest
 *
 */
class TreeGeneratorTest extends \PHPUnit_Framework_TestCase
{
	private $treeGenerator;
	protected function setUp()
    {
        $input = require 'data/input.php';
    	$this->treeGenerator = new TreeGenerator($input);
    }
    public function testReadsInput()
    {
    	$input = $this->treeGenerator->getInput();

    	$this->assertNotEmpty($input, 'Input is empty');
    	$this->assertTrue(is_array($input), 'Input is not an array');
    }
    public function testOutput()
    {
    	$this->assertEquals(<<<STR
parent1
 uno
 due
 tre
  a
parent2
 uno
 due
 tre
  b

STR
    		,
    		$this->treeGenerator->output()
		);
    }
}
