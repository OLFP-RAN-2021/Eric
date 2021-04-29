<?php

namespace Bottle;

class Bottle {
    
    public static function fromJSON($json)
    {
        $dummy = new Bottle($json->name, $json->millesime);
        $dummy->id = $json->id;
        return $dummy;
    }

    public function __construct(string $name, string $millesime)
    {
        $this->id = uniqid();
        $this->name = $name;
        $this->millesime = $millesime;

    }

    public function toHTML()
    {
        return "
        <ul>
        <li>{$this->id}</li>
        <li>{$this->name}</li>
        <li>{$this->millesime}</li>
        </ul>
        ";
    }
}