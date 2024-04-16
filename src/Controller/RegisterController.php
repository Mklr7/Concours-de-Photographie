<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'app_register')]
    public function index( Request $request, UserPasswordHasherInterface $encoder): Response
    {
   
    $user = new User();
    $form = $this->createForm(RegisterType::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        
        $user = $form->getData();

        $hashedPassword = $encoder->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        $userType = $form->get('roles')->getData();

        $user->setRoles([$userType]);

        
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_login');

    }


        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
