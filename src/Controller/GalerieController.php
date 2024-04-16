<?php

namespace App\Controller;


use App\Entity\Photo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GalerieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/galerie', name: 'app_galerie')]
    public function index(): Response
    {
        // TANQUE LE JURY  n'aura pas choisi les photos primées Il rest desactivé. 
        //puis créer une function pour les photos primées

       /*  $photos = $this->entityManager->getRepository(Photo::class)->findAll(); */



        return $this->render('galerie/index.html.twig', [
            /* 'photos' => $photos, */

        ]);
    }
}
