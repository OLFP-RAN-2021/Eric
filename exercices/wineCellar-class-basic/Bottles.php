<?php
namespace Bottles;

use Bottle\Bottle;

class Bottles 
{

    private $items = [];
    private static $_instance;

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Bottles();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->id = uniqid();
        
    }

    public function getID()
    {
        return $this->id;
    }

    public function add(Bottle $bottle)
    {
        $this->items[] = $bottle;
    }

    public function getBottles()
    {       
        return $this->items;
    }

    public function toHTML()
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

    public function loadJSON()
    {
        $json = file_get_contents("datas.json");
        $jsonItems = json_decode($json);
        foreach($jsonItems as $item){
            $this->items[] = Bottle::fromJSON($item);
        }
    }

    public function saveJSON()
    {
        $json = json_encode($this->items);
        $file = fopen('datas.json','w');
        fwrite($file, $json);
        fclose($file);
    }
}
