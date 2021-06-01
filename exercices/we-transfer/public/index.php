<?php

$loader = require '../vendor/autoload.php';

use App\Model\MyMail;

if (isset($_POST["message"])) {
    echo "\$_POST : <br>";
    dump($_POST);
    die;
    $myMail = new MyMail();
    dump($myMail);

    $myMail->sendEmail();
}

include "../src/View/IndexTemplate.php";
