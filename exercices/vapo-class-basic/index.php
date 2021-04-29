<?php
    namespace App;

    // les includes
    include_once "./Tank.php";
    include_once "./Battery.php";
    include_once "./Vapo.php";
    // les uses
    use Battery\Battery;
    use Tank\Tank as Tank;
    use Vapo\Vapo as Vapo;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo class v1</title>
</head>
<body>

<?php

    $maVapo = new Vapo("    ma nouvelle vapoteuse du futur    ");
    $tank = new Tank("", 100);
    $battery = new Battery("Battery100", 100);
    $tank->changeCapacity(1);
    $maVapo->vaping(1);
    $maVapo->addTank($tank);
    $tank->changeCapacity(10);
    $maVapo->addBattery($battery);

    $maVapo->vaping(1);

    $battery->changeCapacity(20);
    $maVapo->vaping(15);
    
    $maVapo->vaping(10);

?>
    
    </body>
</html>
