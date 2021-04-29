<?php

namespace Device;
use Vapoteuse\Vapoteuse;

/**
 * [x] Revoir nom de la class
 * [ ] Integrer la capacité
 */
abstract class Device
{
    private $parent = null;
    private $name = "Device"; // :(

    public function setName($name)
    {
        $this->name = trim($name) == "" ? $this->name : $name;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function hasVapo(): bool
    {
        return $this->vapo ? true : false;
    }

    public function addVapo(Vapoteuse $vapo): bool
    {
        if (!$this->hasVapo()) {
            $this->parent = $vapo;
            return true;
        }
        return false;
    }
    public function removeVapo(Vapoteuse $vapo): bool
    {
        if ($this->hasVapo() == $vapo) {
            $this->parent = null;
            return true;
        }
        return false;
    }
}





?>