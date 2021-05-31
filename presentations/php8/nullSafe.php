<?php

class Battery
{
  function __construct(
    protected float $capacity
  ) {
  }
  public function getCapacity()
  {
    return $this->capacity;
  }
}
class Camera
{
  function __construct(
    protected ?Battery $battery
  ) {
  }
  public function getBattery()
  {
    return $this->battery;
  }
}
class Session
{
  function __construct(
    public Camera $camera
  ) {
  }
}
$battery = new Battery(100);
$camera = new Camera($battery);
$session = new Session($camera);

var_dump($session->camera->getBattery()->getCapacity());

// pour provoquer une erreur
$camera = new Camera(null);
$session = new Session($camera);

// pas d'erreur
var_dump($session?->camera?->getBattery()?->getCapacity());

// erreur
var_dump($session->camera->getBattery()->getCapacity());
