<?php

namespace Modele\Bottles;

use ArrayObject;
use Modele\Bottle\Bottle;

class Bottles 
{

    private ?string $id = null;
    private ?string $name = null;
    private array $items = [];

    public function __construct(string $name, ?string $id = null)
    {       
        $id ? $this->id = trim($id) : $this->id = uniqid() ;
        $this->name = trim($name);
        
    }

    public function getId():string
    {
        return $this->id;
    }
    public function getName():string
    {
        return $this->name;
    }


    public function getBottles():array
    {       
        return $this->items;
    }

    private function compareName(Bottle $bottle1, Bottle $bottle2):int
    {
        return strcasecmp($bottle1->getName(), $bottle2->getName()); 

    }

    public function sortByName():ArrayObject
    {
        $arrayBottles = new ArrayObject($this->items);
        $callback = array($this, 'compareName');
        $arrayBottles->uasort($callback);
                
        return $arrayBottles;
    }

    public function toHTML():void
    {
        echo "<h2>Liste bottles : </h2>";
        if(count($this->items) != 0) {
            foreach($this->items as $item) {
                echo $item->toHTML();
            }
            return;
        }
        echo "<ul><li>pas de bouteille</li></ul>";
    }

    public function loadJSON():void
    {
        $json = file_get_contents("datas.json");
        $jsonItems = json_decode($json);
        foreach($jsonItems as $item){
            $this->items[] = Bottle::fromJSON($item);
        }
    }

    public function saveJSON():void
    {
        $json = json_encode($this->items);
        $file = fopen('datas.json','w');
        fwrite($file, $json);
        fclose($file);
    }
}
