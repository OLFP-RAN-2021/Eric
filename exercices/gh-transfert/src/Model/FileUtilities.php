<?php

namespace App\Model;

class FileUtilities
{
    public function createDirectory(string $dir): string
    {
        $directoryTmp = '../upload/' . $dir;
        if (!is_dir($directoryTmp)) {
            mkdir($directoryTmp);
            return $dir;
        }
        throw new \Exception("Création répertoire impossible");
    }

    public function filesChecker(array $files): array
    {
        $error = 0;
        $size = 0;
        foreach ($files as  $file) {
            $error += $file['error'];
            $size += $file['size'];
        }
        return [
            'nbfiles' => count($files),
            'error' => $error,
            'size' => $size
        ];
    }

    public function filesReorder(string $inputName): array
    {
        $files = [];
        $nbFiles = count($_FILES[$inputName]['name']);
        for ($i = 0; $i < $nbFiles; $i++) {
            $files[$i] = [
                'name' => $_FILES['files']['name'][$i],
                'type' => $_FILES['files']['type'][$i],
                'tmp_name' => $_FILES['files']['tmp_name'][$i],
                'error' => $_FILES['files']['error'][$i],
                'size' => $_FILES['files']['size'][$i],
            ];
        }
        return $files;
    }

    public function saveFiles($directoryTmp, $files)
    {
        foreach ($files as $file) {

            if (is_uploaded_file($file['tmp_name'])) {
                move_uploaded_file($file['tmp_name'], '../upload/' . $directoryTmp . "/" . $file['name']);
                // echo "fichier {$file['name']} enregistré.<br>";
            }
        }
    }
}
