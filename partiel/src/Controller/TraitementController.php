<?php

namespace App\Controller;

use App\Entity\Traitement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
//AJOUTER LE USE APP FORM DE FORM ADHERENT
use App\Form\TraitementType;


class TraitementController extends AbstractController
{
    #[Route('/traitement', name: 'app_traitement')]
    public function index(): Response
    {
        return $this->render('traitement/index.html.twig', [
            'controller_name' => 'TraitementController',
        ]);
    }

    
    #[Route('/traitements', name: 'traitements')]
    public function getTraitements(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Traitement::class);
        $lesTraitements=$repository->findAll();
        return $this->render('traitement/index.html.twig', [
            'title' => 'LES TRAITEMENTS',
            'traitements' => $lesTraitements,
            

        ]);
    }

    #[Route('/traitement/{id}', name: 'traitement')]
    public function getUnTraitement(ManagerRegistry $doctrine, $id): Response
    {
        //accès au répository de la classe adherent
        $repository=$doctrine->getRepository(Traitement::class);
        //recup de tous les adherents
        $unTraitement=$repository->find($id);

        return $this->render('traitement/index.html.twig', [
            'title'=>'Le traitement',
            'traitements'=>$unTraitement
        ]);
    }

    #[Route('/ajout_traitement', name: 'add_traitement')]
    public function ajouter_traitement(ManagerRegistry $doctrine, Request $request): Response
    {
        $em=$doctrine->getManager();
        $traitement=new Traitement();
        
          $form = $this->createForm(TraitementType::class, $traitement);
          $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $traitement = $form->getData();
                $em->persist($traitement);
                $em->flush();
                // redirection vers la liste des adhérents
                return $this->redirectToRoute('traitements');
                //NOM DE LOGIQUE APP_ADHERENTS
         }
        return $this->render('base/formulaire.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    #[Route('/modif_traitement/{id}', name: 'app_modif_traitement')]
    public function modif_traitement(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        //accès au répository de la classe adherent
        $repository=$doctrine->getRepository(Traitement::class);
        //recup de tous les adherents
        $traitement=$repository->find($id);
        $em=$doctrine->getManager();

        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $traitement = $form->getData();
              $em->persist($traitement);
              $em->flush();
              // redirection vers la liste des adhérents
              return $this->redirectToRoute('traitements');
              //NOM DE LOGIQUE APP_ADHERENTS
            }
            return $this->render('base/formulaire.html.twig', array(
                'form' => $form->createView(),
    ));
    }

    #[Route('/supp_traitement/{id}', name: 'app_supp_traitement')]
    public function delete_traitement(ManagerRegistry $doctrine, $id, Request $request): Response
    {
         //acces repository
         $repository=$doctrine->getRepository(Traitement::class);
         //modif
         $traitement = $repository->find($id);
        
         $em=$doctrine->getManager();
         //supprimer
         $em ->remove($traitement);
        //INDICATION FOREIGN KEY
         $em->flush();
         
         return $this->redirectToRoute('traitements');
    }
}
