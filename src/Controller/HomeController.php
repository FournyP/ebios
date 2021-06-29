<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route("/{reactRouting}", name:"index", defaults:["reactRouting" => null], requirements: ["reactRouting" => "^(?!.*api).*$"])]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
