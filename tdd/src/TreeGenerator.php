<?php
class TreeGenerator
{
  private $input;
  function __construct($input) {
    $this->input = $input;
  }
  function getInput() {
    return $this->input;
  }
  function output() {
    return $this->outputLevel($this->input, 0);
  }
  function outputLevel($nodeList, $level) {
    $output = '';
    foreach ($nodeList as $node) {
      $output.= str_repeat(' ', $level) . $node['data'] . PHP_EOL;
      $output .=$this->outputLevel($node['children'], $level + 1);
    }
    return $output;
  }
}
