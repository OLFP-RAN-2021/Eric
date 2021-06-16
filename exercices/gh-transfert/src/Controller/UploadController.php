<?php

namespace App\Controller;

use FastRoute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadController extends AbstractController
{

    #[Route('/upload/{directory}', name: 'Upload')]
    public function show(array $args)
    {
        // dd($args);

        $response = new Response();
        $content = "Html pour upload fichier.";

        $response->setContent($content);
        return $response;
    }
}
