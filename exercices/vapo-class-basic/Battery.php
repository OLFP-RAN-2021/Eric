<?php

namespace Battery;

use Vapo\Vapo;

class Battery 
{
    private $vapo = null;
    private $name = "battery";
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
        if (!$this->isMount()) {

            echo "Montage '{$this->getName()}' sur '{$vapo->getName()}' <br>";
            $this->vapo = $vapo;
            return true;
        }
        return false;
    }

    public function dismount(Vapo $vapo): bool
    {
        if ($this->isMount() == $vapo) {
            $this->vapo = null;
            return true;
        }
        return false;
    }

    private function capacityLimit($newCapacity): int
    {
        if ($newCapacity < 0)
        {
            return 0;
        }
        if ($newCapacity > $this->capacityMax)
        {
            $tropPlein = $newCapacity - $this->capacityMax;
            echo "trop plein {$tropPlein}";
            return $this->capacityMax;
        }
        return $newCapacity;
    }

    public function changeCapacity(int $content = 1): int
    {
        echo "Nouvelle capacité'{$this->getName()}' '{$this->capacityLimit($this->capacity + $content)}/{$this->getCapacityMax()}'<br>";
        return $this->capacity = $this->capacityLimit($this->capacity + $content);

    }

    public function getCapacity():? int
    {
        return $this->capacity;
    }
    
    public function getCapacityMax():? int
    {
        return $this->capacityMax;
    }
    
    public function isMount():? int
    {
        return $this->vapo ? true : false;
    }


}
