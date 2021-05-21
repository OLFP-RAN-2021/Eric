<?php

namespace App\Model;

use App\Model\Vapo;
use App\Model\Container;
use App\Interfaces\Mountable;
use App\Exceptions\TankException;
use App\Exceptions\VapoException;
use App\Exceptions\BatteryException;

class Tank extends Container
{
    protected ?Vapo $vapo = null;
    protected string $name = "tank";
    protected float $capacity = 0;
    protected float $capacityMax;

    public function __construct(string $name, int $capacityMax = 100)
    {
        $this->setName($name);
        $this->capacityMax = $capacityMax;

        echo "Création : '{$this->getName()}' capacité max de '{$this->getCapacityMax()}'<br>";
    }


    public function changeCapacity(int $content = 1): float
    {
        $newCapacity = $this->capacity + $content;
        if ($newCapacity < 0) {
            throw new TankException("Erreur Réservoir vide");
        }
        if ($newCapacity > $this->capacityMax) {
            throw new TankException("Erreur capacité max du réservoir atteinte");
        }
        return $this->capacity = $newCapacity;
    }
}
