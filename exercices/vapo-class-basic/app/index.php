<?php

namespace App;

require '../vendor/autoload.php';
// les uses
use App\Model\Tank;
use App\Model\Vapo;
use App\Model\Battery;
use App\Exceptions\TankException;
use App\Exceptions\VapoException;
use App\Exceptions\BatteryException;

require '../templates/header.php';

// dump($_SERVER);

try {
    $maVapo = new Vapo("    ma nouvelle vapoteuse du futur    ");
    $tank100 = new Tank("tank100", 100);
    // $tank50 = new Tank("tank50", 50);
    $tank50 = new Tank("Battery50", 50);
    $battery = new Battery("Battery100", 100);
    $tank100->changeCapacity(100);
    // $tank100->setCapacity(100);
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
    echo "<br>Erreur Vapo : <br>$error->getMessage()<br>";
} catch (TankException $error) {
    echo "<br>Erreur Tank : <br>{$error->getMessage()}<br>";
} catch (BatteryException $error) {
    echo "<br>Erreur Battery : <br>{$error->getMessage()}<br>";
    dump($error);
    // var_dump($error);
} catch (\Exception $error) {
    $trace = $error->getTrace()[count($error->getTrace()) - 1]; // count($error->getTrace())
    dump($trace);
    echo "<br>Exception : <br>{$error->getMessage()}<br>";
}


include "../templates/footer.php";
