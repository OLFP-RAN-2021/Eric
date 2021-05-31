<?php

function maFunction(string $arg1, ?int $arg2 = null, int $arg3 = 1): void
{
  echo "<br>{$arg1}, {$arg2}, {$arg3}<br>";
}

// php 7
maFunction("php 7", null, 7);

// php 8
maFunction("php 8", arg3: 8);
