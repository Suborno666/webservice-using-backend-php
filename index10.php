<?php

$b = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
$chunkSize = 8;
$numChunks = round(count($b) / $chunkSize);

for ($i = 0; $i < $numChunks; $i++) {
    $chunk = array_slice($b, $i * $chunkSize, $chunkSize);
    print_r($chunk);
}

?>