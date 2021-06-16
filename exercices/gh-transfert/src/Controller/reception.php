<?php

$loader = require '../vendor/autoload.php';

echo "dans reception.php";
if (!empty($_POST)) {
    dd($_FILES);
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

    // existance repertoire upload sinon creation
    // if (!is_dir('../upload')) {
    //     mkdir('../upload');
    // }
    $directoryTmp = '../upload' . uniqid('rep');
    if (!is_dir($directoryTmp)) {
        mkdir($directoryTmp);
    }


    foreach ($files as $number => $file) {

        if (is_uploaded_file($file['tmp_name'])) {
            move_uploaded_file($file['tmp_name'], $directoryTmp . '/' . $file['name']);
            echo "fichier {$file['name']} enregistré.";
        }
    }
}
