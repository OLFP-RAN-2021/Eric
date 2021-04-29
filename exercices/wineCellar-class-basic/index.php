<?php
    namespace App;

    include_once "./Bottles.php";
    include_once "./Bottle.php";

use Bottle\Bottle;
use Bottles\Bottles as Bottles;
    

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
    $testBottles = [
        [
            'name'=>'Chardonney',
            'millesime' => '1984'
        ],
        [
            'name'=>'Bordeau',
            'millesime' => '2018'
        ],
        [
            'name'=>'Bourgogne',
            'millesime' => '2020'
        ]
    ];

    $bottles = Bottles::getInstance();

    echo "id : {$bottles->getID()}<br>";

    $bottles->toHTML();
    
    $bottles->loadJSON();
    // $bottles->saveJSON();
    $bottles->toHTML();



?>
    
    </body>
</html>