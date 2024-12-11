<?php

class MagicMethod{
    // function __call($name, $arguments)
    // {
    //     echo "Name of the parameters => $name \n";
    //     echo "Parameters provided;";
    //     print_r($arguments);
    // }

    function __debugInfo()
    {
        return [
            "variable"=> "value",
            "variable1"=> "value1",
            "variable2"=> "value2"
        ];
    }
}

$magicMethod = new MagicMethod();
// $magicMethod->doneDone("name","age","class");
var_dump($magicMethod);


