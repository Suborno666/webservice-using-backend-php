<?php

// trait message1{
//     function msg1(){
//         echo "Your brother Billy";
//     }
// }

// trait message2{
//     function msg2(){
//         echo "whatever happened there 😣";
//     }
// }

// class reply{
//     use message1,message2;
// }
// $reply = new reply;

// echo $reply->msg1(),", ",$reply->msg2();

//   .
//  / \
//   |
//   |
// Comment out from/to here
//   |
//   |
//  \ /
//   .

// class Fruit {
//   public $name;
//   public $color;
//   public $weight;

//   function set_name($n) {  
//     $this->name = $n;
//   }
//   protected function set_color($n) { 
//     $this->color = $n;
//   }
//   private function set_weight($n) {
//     $this->weight = $n;
//   }
// }

// $mango = new Fruit();
// $mango->set_name('Mango'); 

// class Protein extends Fruit{
//   function __construct($color)
//   {
//     $this->color = $color;
//   }

// }

// $fruit = new Fruit();
// $fruit->set_name('Bananna');
// echo $fruit->name.PHP_EOL;
// $protein = new Protein('Red');
// echo $protein->color.PHP_EOL;


//   .
//  / \
//   |
//   |
// Comment out from/to here
//   |
//   |
//  \ /
//   .

// class Greetings{
//   const MESSAGE = "DO I WANNA KNOW? IF THE FEELINGS GOES BOTH WAYS?";
//   function goodNight(){
//     echo self::class.self::MESSAGE;
//   }
// }

// $greeting = new Greetings;
// echo $greeting->goodNight();


//   .
//  / \
//   |
//   |
// Comment out from/to here
//   |
//   |
//  \ /
//   .
abstract class parentClass{
  abstract function intro();
  abstract function greetings();
  abstract function farewell();
}

class childClass extends parentClass{
  function intro()
  {
    echo "Greetings";
  }
  function greetings()
  {
    echo "Merry Christmas";
  }
  function farewell()
  {
    echo "GoodNight";
  }
}

$child = new childClass();
$child->intro();
$child->greetings();