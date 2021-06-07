<?php

$loader = require '../vendor/autoload.php';

use App\Model\MyMail;

function sendMail()
{
    $myMail = new MyMail();
    dump($myMail);

    $myMail->sendEmail();
}

if (!empty($_POST)) {
    dump($_POST);

    dump($_FILES);
    // $files
    $nbFiles = count($_FILES['files']['name']);
    for ($i = 0; $i < $nbFiles; $i++) {
        $files[$i] = [
            'name' => $_FILES['files']['name'][$i],
            'type' => $_FILES['files']['type'][$i],
            'tmp_name' => $_FILES['files']['tmp_name'][$i],
            'error' => $_FILES['files']['error'][$i],
            'size' => $_FILES['files']['size'][$i],
        ];
    }



    dump($files);
    foreach ($_FILES['files'] as $key => $value) {

        echo $key . '<br>'; //. "=>" . $value . "<br>";
    }
}
if (empty($_POST)) {
    include "../src/View/IndexTemplate.php";
}
