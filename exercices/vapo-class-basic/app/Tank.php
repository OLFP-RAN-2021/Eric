<?php

namespace App;

use App\Vapo;
use App\Exceptions\VapoException;
use App\Exceptions\BatteryException;
use App\Exceptions\TankException;

class Tank 
{
    private $vapo = null;
    private $name = "tank";
    private $capacity = 0;
    private $capacityMax;

    public function __construct(string $name, int $capacityMax = 100)
    {
        $this->setName($name);
        $this->capacityMax = $capacityMax;

        echo "Création : '{$this->getName()}' capacité max de '{$this->getCapacityMax()}'<br>";
    }
    
    public function setName($name)
    {
        $this->name = trim($name) == "" ? $this->name : $name;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function mount(Vapo $vapo): bool
    {
        if($this->isMount()) {
            throw new TankException("Montage Tank impossible, déjà utilisé");
        }
        echo $this->isMount();
        echo "Montage '{$this->getName()}' sur '{$vapo->getName()}' <br>";
        $this->vapo = $vapo;
        return true;
    }

    public function dismount(Vapo $vapo): bool
    {
        if ($this->isMount() == $vapo) {
            $this->vapo = null;
            return true;
        }
        return false;
    }

    public function changeCapacity(int $content = 1): ?int
    {
        $newCapacity = $this->capacity + $content;
        if ( $newCapacity < 0)
        {
            throw new TankException("Erreur Réservoir vide");
        }
        if($newCapacity > $this->capacityMax) {
            throw new TankException("Erreur capacité max du réservoir atteinte");
        }
        return $this->capacity = $newCapacity;

    }

    public function getCapacity():? int
    {
        return $this->capacity;
    }
    
    public function getCapacityMax():? int
    {
        return $this->capacityMax;
    }
    
    public function isMount():bool
    {
        return !is_null($this->vapo);
    }


}
