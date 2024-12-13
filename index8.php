<?php

final class F{
    function __call($name_of_the_function,$argument){
        if($name_of_the_function == "area"){
            switch (count($argument)) {
                case 1:
                    return 3.14*$argument[0];
                    break;
                case 2:
                    return $argument[0] * $argument[1];
                    break;
            }
        }else{
            return $name_of_the_function;
        }
    }
}

$name = new F();
echo($name->area(4)).PHP_EOL;
echo($name->area(4,4)).PHP_EOL;
echo($name->nevermind(4,4)).PHP_EOL;


?>

function overloading: Function Overloading is a process where a class can take multiple arguments and based on the number of arguments, the class performs task based on the number of arguments.
function overwriting: Function overwriting is the process by which both parent and child class should have same function name with and same number of arguments.