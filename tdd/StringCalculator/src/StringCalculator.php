<?php
class StringCalculator
{
    public function add($stringOfValues) {
        
        $result = 0;
        $delimiter = "[\s,]";
        if (substr($stringOfValues, 0, 2) === "//") {
            $delimiter = substr($stringOfValues, 2, 1);
        }
        $values = preg_split("/$delimiter/", $stringOfValues);
        foreach ($values as $key => $value) {
            $result+= $value;
        }
        
        return $result;
    }
}
