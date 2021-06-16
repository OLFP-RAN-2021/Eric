<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    #[Route('/user/{id:\d+}', name: 'User')]
    // public function list($userName, $userId = NULL)
    // {
    //     return 'User name = ' . $userName . ', User id = ' . $userId ?? 'N/A';
    // }

    public function show($data): Response
    {
        $userId = $data['id'] ?? 'N/A';
        // $template = new HomeTemplate();
        $content = 'User id = ' . $userId;

        $response = new Response();

        $response->setContent($content);

        return $response;
    }
}
