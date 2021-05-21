<?php

namespace App\Model;

use Exception;
use App\Interfaces\NameableInterface;
use App\Interfaces\MountableInterface;

abstract class Container implements NameableInterface, MountableInterface
{
    protected ?Vapo $vapo = null;
    protected float $capacity = 0;
    protected float $capacityMax = 0;
    protected string $name = "";


    #region name
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $newName): void
    {
        if (strlen($newName) == 0) {
            throw new Exception("name ne doit pas etre vide");
        }
        $this->name = $newName;
    }
    #endregion name

    #region capacity
    public function getCapacity(): float
    {
        return $this->capacity;
    }
    public function getCapacityMax(): float
    {
        return $this->capacityMax;
    }
    protected function setCapacity(float $newCapacity): void
    {
        if ($newCapacity < 0) {
            throw new Exception("Erreur contenance inferieure a la demande");
        }
        if ($newCapacity > $this->capacityMax) {
            throw new Exception("Erreur depassement de capacité");
        }
        $this->capacity = $newCapacity;
    }
    protected function setCapacityMax(float $newCapacityMax): void
    {
        if ($newCapacityMax < 0) {
            throw new Exception("Erreur contenance Maximum ne peut etre inferieur à zéro");
        }
        $this->capacityMax = $newCapacityMax;
    }
    #endregion capacity

    #region mountable
    public function dismount(Vapo $vapo): bool
    {
        if ($this->isMount() == $vapo) {
            $this->vapo = null;
            return true;
        }
        return false;
    }

    public function isMount(): bool
    {
        return !isset($this->vapo) ? false : true;
    }
    public function mount(Vapo $vapo): bool
    {
        if (!$this->isMount()) {

            echo "Montage '{$this->getName()}' sur '{$vapo->getName()}' <br>";
            $this->vapo = $vapo;
            return true;
        }
        return false;
    }
    #endregion mountable
}
