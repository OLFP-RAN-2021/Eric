<?php

namespace Vapo;

use Battery\Battery;
use Tank\Tank;

/**
 * TODO :
 * [ ] Gestion de la batterie
 * [ ] Ajout d'un ID?
 * [x] Verouillage appartenance tank (parent)
 * [ ] Ajout compteur de vapotage?
 * [ ] vapo ne gere pas le liquide?
 */
class Vapo
{
    private $name = "vapo";
    private $battery = null;
    private $tank = null;

    public function __construct(string $name)
    {
        $this->setName($name);
        echo "Création d'un vapo : '{$this->getName()}'<br>";
    }

    public function addDevice(Tank|Battery $device)
    {
        $class = get_class($device);
        echo $class;
        switch ($class) {
            case 'Tank':
                echo 'ajout Tank';
                break;
            case 'Battery':
                echo 'ajout Battery';
                break;
            
            default:
                echo "non ajout {$class}";
                break;
        }
    }

    public function addBattery(Battery $battery):bool
    {
        if ($battery->mount($this)) {
            $this->battery = $battery;
            return true;
        }
        echo "IMPOSSIBLE ajout de '{$battery->getName()}' à '{$this->getName()}'<br>";
        return false;
    }

    public function removeBattery(): bool
    {
        if ($this->battery->removeVapo($this)) {
            $this->battery = null;
            return true;
        }
        return false;
    }

    public function hasBattery(): bool
    {
        return $this->battery ? true : false;
    }
    
    public function getBattery(): object
    {
        return $this->battery;
    }
  
    public function addTank(Tank $tank): bool
    {
        if ($tank->mount($this)) {
            $this->tank = $tank;
            return true;
        }
        echo "IMPOSSIBLE ajout de '{$tank->getName()}' à '{$this->getName()}'<br>";
        return false;
    }

    public function removeTank(): bool
    {
        if ($this->tank->dismount($this)) {
            $this->tank = null;
            return true;
        }
        return false;
    }

    public function hasTank(): bool
    {
        return $this->tank ? true : false;
    }

    public function getTank(): object
    {
        return $this->tank;
    }
  
    // TODO : get capacity of a device passed in params
    // did I implement that? 
    public function getCapacity(object $device = null): ?int
    {
        if($device instanceof Tank) {
            return $this->hasTank() ? $this->tank->getCapacity() : null;
        }
        return null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        if(isset($name) && trim($name) != "") {
            $this->name = trim($name);
        }
    }

    public function canVape(int $time): bool 
    {
        if(!$this->hasTank() || !$this->hasBattery()) {
            echo "<br>Vaping impossible '{$this->getName()}' => '{$time}s'<br>";
            if(!$this->hasTank()) {echo "---pas de tank<br>";
            }
            if(!$this->hasBattery()) {echo "---pas de battery<br>";
            }
            return false;     
        }
        if ($this->tank->getCapacity() < $time || $this->battery->getCapacity() < $time) {
            echo "<br>Vaping impossible '{$this->getName()}' => '{$time}s'<br>";
            echo "---'{$this->tank->getName()}' capacité '{$this->tank->getCapacity()}'<br>";
            echo "---'{$this->battery->getName()}' capacité '{$this->battery->getCapacity()}'<br>";
            return false;
        }
        return true;
    }
    public function vaping(int $time = 1): bool
    {
        
        if(!$this->canVape($time)) {
            return false;
        }
        echo "<br>Vaping '{$this->getName()}' => '{$time}s'<br>";
        $this->tank->changeCapacity(-$time);
        $this->battery->changeCapacity(-$time);
        
        return true;
    }

    public function printInfosHTML(string $title) 
    {
        
        $tankCapacity = 'pas de tank';
        $tankName = $tankCapacity;
        if($this->hasTank()){
            $tankCapacity = $this->getCapacity($this->tank) ? $this->getCapacity($this->tank) : "tank vide";
            $tankName = $this->tank->getName();
        }
        
        echo "<h2>{$this->getName()} : {$title}</h2>
        <ul>
        <li>Nom : {$this->getName()}</li>
        <li>Tank : {$tankName}</li>
        <li>Contenance : {$tankCapacity}</li>
        
        </ul>";
    }
}
        