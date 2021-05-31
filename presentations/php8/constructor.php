<?php


class MaClass
{
  function __construct(
    private string $name,
    protected int $age = 0,
    protected string $ville = 'inconnue'
  ) {
    // du code ...
  }
}

$class = new Maclass('test', ville: "Mulhouse");
var_dump($class);
