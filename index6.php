<?php

class MyIterator implements Iterator{

    private $arr = [];

    private $pointer = 0;
    function __construct($arr)
    {
        $this->arr = array_values($arr);
    }

    function current(): mixed
    {
        return $this->arr[$this->pointer];
    }

    function next(): void
    {
        $this->pointer++;
    }
    
    function rewind(): void
    {
        $this->pointer = 0;
    }

    function valid(): bool
    {
        return $this->pointer < count($this->arr);
    }

    function key(): mixed
    {
        return $this->pointer;
    }
}

function IterateThroughArray(iterable $iteratorArray){
    foreach($iteratorArray as $items):
        echo $items;
    endforeach;
}

$iterator = new MyIterator(['a','p','q','r','s']);

IterateThroughArray($iterator);
