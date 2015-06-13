<?php
class StringCalculator
{
    const SEP_START = "//[";
    const SEP_END = "]\n";
    const DEFAULT_SEP = "\s,";
    public $result;
    private $negNumbers;
    
    private function resetResult() {
        $this->result = 0;
    }
    private function resetNegNumbersList() {
        $this->negNumbers = FALSE;
    }
    public function setResultStringAndSep($stringOfValues, $sep) {
        return $result = array('sep' => $sep, 'stringOfValues' => $stringOfValues);
    }
    private function escapeDefaultSeparator($stringOfValues) {
        $sep = [self::DEFAULT_SEP];
        return $this->setResultStringAndSep($stringOfValues, $sep);
    }
    private function escapeSeparator($stringOfValues) {
        if (substr($stringOfValues, 0, 2) === "//") {
            $sep = [];
            while ($sep[] = $this->get_string_between($stringOfValues, self::SEP_START, self::SEP_END) !== '') {
                $stringOfValues = $this->delete_all_between($stringOfValues, self::SEP_START, self::SEP_END);
            }
            return $this->setResultStringAndSep($stringOfValues, $sep);
        }
        return $this->escapeDefaultSeparator($stringOfValues);
    }
    private function getArrayValuesFromString($sep, $stringOfValues) {
        $arrayValues = [];

        foreach ($sep as $nr => $sepValue) {
            
            $arrayValues = $arrayValues + preg_split("/[$sepValue]/", $stringOfValues);
        }
        return $arrayValues;
    }
    private function isValidNumber($number) {
        if ($number < 0) {
            $this->negNumbers.= $number . ',';
            return FALSE;
        }
        if ($number > 1000) {
            return FALSE;
        }
        return TRUE;
    }
    public function get_string_between($string, $start, $end) {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return "";
        $ini+= strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    function delete_all_between($string, $beginning, $end) {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
            return $string;
        }
        
        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
        
        return str_replace($textToDelete, '', $string);
    }
    public function add($stringOfValues) {
        $this->resetResult();
        $result = $this->escapeSeparator($stringOfValues);
        
        $this->resetNegNumbersList();
        print_r($result);
        foreach ($this->getArrayValuesFromString($result['sep'], $result['stringOfValues']) as $key => $number) {
            
            if ($this->isValidNumber($number)) $this->result+= $number;
        }
        if ($this->negNumbers !== FALSE) throw new InvalidArgumentException('negatives not allowed ' . $this->negNumbers);
        
        return $this->result;
    }
}
