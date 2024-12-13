<?php

$n = 10;
for($i = 0; $i<$n;$i++ ){
    if($i%2 === 0):
        echo $i;
        die("Something in the way");
    endif;
}