<?php
    declare(strict_types=1);
   
    require "Modele\Bottles.php";
    require "Modele\Bottle.php";

    use Modele\Bottles\Bottles;
    

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wineCellar class basic</title>
</head>
<body>


<?php

    $bottles = new Bottles("mes bouteilles");

    echo "Bottles id : {$bottles->getId()}<br>";

    $bottles->toHTML();
    
    $bottles->loadJSON();
    // $bottles->saveJSON();
    $bottles->toHTML();

    // classement alpha
    echo "<pre>";
    print_r($bottles->sortByName());
    echo "</pre>";

?>
    
    </body>
</html>