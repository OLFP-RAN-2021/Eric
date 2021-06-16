<?php

namespace App\Controller;

use App\View\HomeTemplate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name: 'Home')]
    public function show(): Response
    {
        $template = new HomeTemplate();
        $content = $template->render();

        $response = new Response();

        $response->setContent($content);

        return $response;
    }
}
