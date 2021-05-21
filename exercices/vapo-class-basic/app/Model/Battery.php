<?php

namespace App\Model;

use App\Model\Container;

class Battery extends Container
{
    protected string $name = "battery";
    protected float $capacity = 0;
    protected float $capacityMax;

    public function __construct(string $name, int $capacityMax = 100)
    {
        $this->setName($name);
        $this->capacityMax = $capacityMax;

        echo "Création : '{$this->getName()}' capacité max de '{$this->getCapacityMax()}'<br>";
    }

    #region name
    // public function getName(): string
    // {
    //     return $this->name;
    // }
    // public function setName(string $newName): void
    // {
    //     $this->name = trim($newName) == "" ? $this->name : $newName;
    // }

    #endregion name

    #region capacity
    private function capacityLimit($newCapacity): int
    {
        if ($newCapacity < 0) {
            return 0;
        }
        if ($newCapacity > $this->capacityMax) {
            $tropPlein = $newCapacity - $this->capacityMax;
            echo "trop plein {$tropPlein}";
            return $this->capacityMax;
        }
        return $newCapacity;
    }

    public function changeCapacity(int $content = 1): int
    {
        echo "Nouvelle capacité'{$this->getName()}' '{$this->capacityLimit($this->capacity +$content)}/{$this->getCapacityMax()}'<br>";
        return $this->capacity = $this->capacityLimit($this->capacity + $content);
    }

    public function getCapacity(): float
    {
        return $this->capacity;
    }

    public function getCapacityMax(): float
    {
        return $this->capacityMax;
    }
    #endregion capacity
}
