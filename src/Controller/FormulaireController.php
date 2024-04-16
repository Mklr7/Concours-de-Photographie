<?php

namespace App\Controller;

use App\Entity\Gps;
use App\Entity\Participant;
use App\Entity\Photo;
use App\Form\GpsType;
use App\Form\ImageType;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Image;

class FormulaireController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/formulaire-document', name: 'app_formulaire_document')]
    public function document(Request $request , EntityManagerInterface $entityManager, Security $security): Response
    {

        
            $document = new Participant();
            $currentUser = $security->getUser();
            $form = $this->createForm(ParticipantType::class, $document, [
                'current_user' => $currentUser,
        ]);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
            //Récuperer le fichier  uploadé
            $file = $form->get('attestation')->getData();
            //Générer un nom de fichier unique
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            //Déplacer le fichier dans le répertoire où sont stockées les images
            try {
            $file->move(
                $this->getParameter('app.path.attestation'),
                $fileName
            );
        } catch (FileException $e){
            // Gérer l'exception si besoin
            // Par exemple, enregistrez l'erreur dans un journal
            $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier.');
            
        }
          //Mettre à jour la propriété illustration pour stocker le nom du fichier

          $document->setAttestation($fileName);

            $entityManager->persist($document);
            $entityManager->flush();
            return $this->redirectToRoute('app_formulaire_image');

        }
        return $this->render('formulaire/document.html.twig',[
            'form' => $form->createView(),
        ]);
    }


    #[Route('/formulaire-image', name: 'app_formulaire_image')]
    public function image(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        

           $image = new Photo();
           $currentUser = $security->getUser();
           $form = $this->createForm(ImageType::class, $image, [
            'current_user' => $currentUser,
           ]);
           $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
            //Récuperer le fichier  uploadé
            $file = $form->get('illustration')->getData();
            //Générer un nom de fichier unique
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            //Déplacer le fichier dans le répertoire où sont stockées les images
            try {
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
        } catch (FileException $e){
            //Gérer l'exception si besoin
        }
            //Mettre à jour la propriété illustration pour stocker le nom du fichier

            $image->setIllustration($fileName);
            
            $entityManager->persist($image);
            $entityManager->flush();

        
            

             return $this->redirectToRoute('app_formulaire_gps'); 
        }
        return $this->render('formulaire/image.html.twig',[
            'form' => $form->createView(),
        ]);
    }


    #[Route('/formulaire-gps', name: 'app_formulaire_gps')]
    public function gps(Request $request , EntityManagerInterface $entityManager): Response
    {
       
        $gps = new Gps();
        $form = $this->createForm(GpsType::class, $gps , [
            'current_user' => $this->getUser(),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($gps);
            $entityManager->flush();

        
            

            return $this->redirectToRoute('app_validate');
        }
        return $this->render('formulaire/gps.html.twig',[
            'form' => $form->createView(),
        ]);
    }


}
