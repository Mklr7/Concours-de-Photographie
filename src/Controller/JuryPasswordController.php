<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class JuryPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/jury/modification_mdp', name: 'app_jury_password')]
    public function index(Request $request, UserPasswordHasherInterface $pass): Response
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('old_password')->getData();

            if ($pass->isPasswordValid($user, $oldPassword)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $pass->hashPassword($user, $new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();

                $notification = "Votre mot de passe a bien été mis à jour.";
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
        }
        return $this->render('jury/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
