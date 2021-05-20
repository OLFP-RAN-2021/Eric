<?php

namespace App\Modele;

class Bottle {
    
    private string $name;
    private string $millesime;
    private string $id;

    public static function fromJSON($json)
    {
        return new Bottle($json->name, $json->millesime, $json->id);
    }

    public function __construct(string $name, string $millesime, string $id = null)
    {
        !$id ? $this->id = uniqid(): $this->id = $id;
        $this->name = $name;
        $this->millesime = $millesime;

    }

    public function getName(): string
    {
        return $this->name;
    }
    
    public function toHTML():string
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