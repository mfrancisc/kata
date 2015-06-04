<?php
class StringCalculator
{
    public function add($stringOfValues) {
        
        
        $result = 0;
    
            $values = preg_split("/[\s,]/", $stringOfValues);
            foreach ($values as $key => $value) {
                $result+= $value;
            }
           
        return $result;
    }
}
