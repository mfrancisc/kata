<?php
class StringCalculator
{
    public $result;
    private $negNumbers;
    
    private function resetResult() {
        $this->result = 0;
    }
    private function resetNegNumbersList() {
        $this->negNumbers = FALSE;
    }
    private function getDefaultSeparator() {
        return "[\s,]";
    }
    private function getSeparator($stringOfValues) {
        if (substr($stringOfValues, 0, 2) === "//") {
            return substr($stringOfValues, 2, 1);
        }
        return $this->getDefaultSeparator();
    }
    private function getArrayValuesFromString($sep, $stringOfValues) {
        return preg_split("/$sep/", $stringOfValues);
    }
    public function add($stringOfValues) {
        $this->resetResult();
        $sep = $this->getSeparator($stringOfValues);
        
        $this->resetNegNumbersList();
        foreach ($this->getArrayValuesFromString($sep, $stringOfValues) as $key => $value) {
            if ($value < 0) $this->negNumbers.= $value . ',';
            $this->result+= $value;
        }
        if ($this->negNumbers) throw new InvalidArgumentException('negatives not allowed ' . $this->negNumbers);
        
        return $this->result;
    }
}
