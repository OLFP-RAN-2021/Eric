<?php

class Number
{
    public function __construct(
        public int|float $number
    ) {
    }
}

$number = new Number(1);
echo "<br>{$number->number}";
$number = new Number(1.5);
echo "<br>{$number->number}";
$number = new Number('NaN');
echo "<br>{$number->number}";
