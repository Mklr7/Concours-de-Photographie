<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JuryController extends AbstractController
{
    #[Route('/jury', name: 'app_jury')]
    public function index(): Response
    {
        return $this->render('jury/index.html.twig');
    }
}
