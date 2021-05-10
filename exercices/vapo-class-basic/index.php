<?php
    namespace App;

    require __DIR__ . '/vendor/autoload.php';
    // les uses
    use App\Vapo;
    use App\Tank;
    use App\Battery;
    use App\Exceptions\VapoException;
    use App\Exceptions\TankException;
    use App\Exceptions\BatteryException;


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vapo class basic</title>
</head>
<body>

<?php


try{
    $maVapo = new Vapo("    ma nouvelle vapoteuse du futur    ");
    $tank100 = new Tank("tank100", 100);
    $tank50 = new Tank("tank50", 50);
    $battery = new Battery("Battery100", 100);
    $tank100->changeCapacity(100);
    // teste démontage tank inexistant
    // $maVapo->removeTank();
    $maVapo->addTank($tank100);
    // echo "2eme tank pour erreur : <br>";
    // $maVapo->addTank($tank50);

    $tank100->changeCapacity(-10);
    // $maVapo->vaping(1); // test vaping sans battery
    $maVapo->addBattery($battery);
    // test vap battery vide
    // $maVapo->vaping(1);
    
    $battery->changeCapacity(20);
    $maVapo->vaping(15);
    
    // test battery error
    $maVapo->vaping(10);
    
} catch (VapoException $error) {
    echo "<br>Erreur Vapo : <br>{$error->getMessage()}<br>";
} catch (TankException $error) {
    echo "<br>Erreur Tank : <br>{$error->getMessage()}<br>";
} catch (BatteryException $error) {
    echo "<br>Erreur Battery : <br>{$error->getMessage()}<br>";
} catch (\Exception $error) {
    echo "<br>{$error->getMessage()}<br>";
}



?>
    
    </body>
</html>
