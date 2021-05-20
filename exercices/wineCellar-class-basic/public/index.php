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

?>
<form action="">
    <input type="text" name="nom" id="nom" placeholder="Nom de la bouteille">
    <input type="number" name="annee" id="annee" placeholder="2021" min="1900" max="4000">
    <button>Créer</button>
</form>
<?php

$bottles->toHTML();

$bottles->loadJSON("../src/datas/datas.json");
// $bottles->saveJSON();
$bottles->toHTML();
// dump($bottles);
?>

</body>

</html>

<?php
$contenu = ob_get_clean();
echo $contenu;

?>