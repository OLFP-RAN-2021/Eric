<?php

namespace App\Model;

use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class FileUtilities
{
    public function createDirectory(string $path, string $dir): string
    {
        $directoryTmp = $path . $dir;
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

    public function saveFiles(string $directoryTmp, array $files)
    {
        foreach ($files as $file) {

            if (is_uploaded_file($file['tmp_name'])) {
                move_uploaded_file($file['tmp_name'], '../upload/' . $directoryTmp . "/" . $file['name']);
                // echo "fichier {$file['name']} enregistré.<br>";
            }
        }
    }

    function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..'))) {
                    continue;
                }

                $file = realpath($file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } else if (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }
}
