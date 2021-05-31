<?php

#[Attribute]
class User
{
  public function __construct(private string $name, private int $age)
  {
  }

  public function printHTML(): void
  {
    echo "<br>name : " . $this->name;
    echo "<br>age : " . $this->age;
  }
}

#[User(name: 'Linux', age: 32)]
class Admin
{

  function printHTML()
  {
    echo "<br>name : " . $this->name;
  }
}

$reflector = new \ReflectionClass(Admin::class);
$attrs = $reflector->getAttributes();

echo "<br>****<br>";
print_r($attrs);
echo "<br>****<br>";

foreach ($attrs as $attribute) {
  echo "<br>instance : <br>";
  echo "<pre>";
  print_r($attribute->newInstance());
  echo "</pre>";
}
