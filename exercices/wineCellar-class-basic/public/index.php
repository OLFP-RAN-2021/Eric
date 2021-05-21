<?php


$loader = require "../vendor/autoload.php";

use App\Modele\Bottles;

$page = array(
    "title" => "wineCellar class basic"
);

$bottles = new Bottles("mes bouteilles");

$title = "wineCellar class basic";

ob_start();
include "../src/View/Header.php";
include "../src/View/Form.php";

$bottles->toHTML();

$bottles->loadJSON("../src/datas/datas.json");
// $bottles->saveJSON();
$bottles->toHTML();
// dump($bottles);
include "../src/View/Footer.php";


$contenu = ob_get_clean();
echo $contenu;
